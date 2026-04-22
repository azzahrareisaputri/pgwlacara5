<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use App\Models\polylinesModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $points;
    protected $polylines;

    public function __construct()
    {
        $this->points = new pointsModel();
        $this->polylines = new polylinesModel();
    }

    public function geojson_points()
    {
        return pointsModel::getPoints();
    }

    public function geojson_polylines()
    {
        return polylinesModel::getPolylines();
    }

    public function getGeoJSON()
    {
        $points = $this->geojson_points();
        return response()->json($points, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polygons()
    {
    return \App\Models\polygonsModel::getPolygons();
    }

    public function geojson_rectangles()
    {
    return \App\Models\rectanglesModel::getRectangles();
    }
}
