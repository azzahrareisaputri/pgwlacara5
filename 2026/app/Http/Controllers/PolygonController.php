<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PolygonController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('image');
$path = null;

if($image){
    $path = $image->store('images', 'public');
}

DB::insert("
    INSERT INTO polygons (name, description, geom, image)
    VALUES (?, ?, ST_GeomFromText(?, 4326), ?)
", [
    $request->name,
    $request->description,
    $request->geometry,
    $path
]);

        return redirect()->back();
    }

    // ✅ TAMBAH INI
    public function destroy(string $id)
    {
        DB::delete("DELETE FROM polygons WHERE id = ?", [$id]);

        return response()->json([
            'message' => 'Polygon deleted successfully'
        ]);
    }
}
