<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\RectangleController;

// POINT
Route::post('/points/store',[PointController::class,'store']);
Route::delete('/points/{id}', [PointController::class, 'destroy'])->name('points.destroy');

// POLYLINE
Route::post('/polylines/store',[PolylinesController::class,'store']);
Route::delete('/polylines/{id}', [PolylinesController::class, 'destroy'])->name('polylines.destroy');

// HOME
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 🔥 FIX DI SINI (WAJIB)
Route::get('/peta', [PageController::class, 'peta'])->name('peta');

// TABLE
Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');

// ABOUT
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::post('/polygons/store',[PolygonController::class,'store']);
Route::delete('/polygons/{id}', [PolygonController::class, 'destroy'])->name('polygons.destroy');

Route::post('/rectangles/store', [RectangleController::class, 'store']);
Route::delete('/rectangles/{id}', [RectangleController::class, 'destroy'])->name('rectangles.destroy');
require __DIR__.'/settings.php';
