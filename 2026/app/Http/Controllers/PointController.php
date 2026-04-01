<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{

public function store(Request $request)
{

DB::insert("

INSERT INTO points (name,description,geom)

VALUES

(?,?,ST_GeomFromText(?,4326))

",[
$request->name,
$request->description,
$request->geometry
]);

return redirect()->back();

}

}
