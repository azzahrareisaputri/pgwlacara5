<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\RectangleController;

// POINT
Route::post('/points/store',[PointController::class,'store']);

// POLYLINE
Route::post('/polylines/store',[PolylinesController::class,'store']);

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

Route::post('/rectangles/store', [RectangleController::class, 'store']);

require __DIR__.'/settings.php';
