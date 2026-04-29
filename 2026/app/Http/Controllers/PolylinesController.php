<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\polylinesModel;

class PolylinesController extends Controller
{
    protected $polylines;

    public function __construct()
    {
        $this->polylines = new polylinesModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->polylines->all();
        return view('polylines.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('polylines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // upload gambar
    if($request->hasFile('image')){
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('images', $filename, 'public');
    } else {
        $path = null;
    }

    $imagePath = null;

if($request->hasFile('image')){
    $imagePath = $request->file('image')->store('polylines', 'public');
}

    DB::insert("
        INSERT INTO polylines (name, description, geom, image)
        VALUES (?, ?, ST_GeomFromText(?, 4326), ?)
    ", [
        $request->name,
        $request->description,
        $request->geometry,
        $imagePath
    ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->polylines->find($id);
        return view('polylines.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->polylines->find($id);
        return view('polylines.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::update("
            UPDATE polylines
            SET name = ?, description = ?, geom = ST_GeomFromText(?, 4326)
            WHERE id = ?
        ", [
            $request->name,
            $request->description,
            $request->geometry,
            $id
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::delete("DELETE FROM polylines WHERE id = ?", [$id]);

        return redirect()->back();
    }
}
