<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{

public function store(Request $request)
{

    // 🔽 PROSES UPLOAD GAMBAR
    if($request->hasFile('image')){
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $filename, 'public');
    } else {
        $path = null;
    }

    DB::insert("
        INSERT INTO points (name, description, geom, image)
        VALUES (?, ?, ST_GeomFromText(?,4326), ?)
    ",[
        $request->name,
        $request->description,
        $request->geometry,
        $path
    ]);

    return redirect()->back();
}

public function destroy(int $id)
{
    DB::delete("DELETE FROM points WHERE id = ?", [$id]);

    return response()->json([
        'success' => true,
        'message' => 'Point deleted successfully'
    ]);
}

}
