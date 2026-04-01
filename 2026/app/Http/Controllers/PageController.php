<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function tabel()
    {
        $data = [
            'title' => 'Table',
        ];
        return view('table', $data);
    }

    // 🔥 TAMBAHAN INI
    public function peta()
    {
        $polylines = DB::select("
            SELECT id, name, description,
            ST_AsGeoJSON(geom) as geojson
            FROM polylines
        ");

        return view('pages.map', compact('polylines'));
    }
}
