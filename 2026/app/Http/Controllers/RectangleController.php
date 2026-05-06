<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RectangleController extends Controller
{
    public function store(Request $request)
{
    $image = $request->file('image');
$path = null;

if($image){
    $path = $image->store('images', 'public');
}

DB::table('rectangles')->insert([
    'name' => $request->name,
    'description' => $request->description,
    'geom' => DB::raw("ST_GeomFromText('$request->geometry', 4326)"),
    'image' => $path,
    'created_at' => now(),
    'updated_at' => now()
]);

    return redirect('/peta')->with('success', 'Rectangle berhasil disimpan');
}

// ✅ TAMBAH INI
    public function destroy(string $id)
    {
        DB::delete("DELETE FROM rectangles WHERE id = ?", [$id]);

        return response()->json([
            'message' => 'Rectangle deleted successfully'
        ]);
    }

}
