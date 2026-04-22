<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class rectanglesModel extends Model
{
    protected $table = 'rectangles';

    public static function getRectangles()
    {
        $rectangles = DB::table('rectangles')
            ->select(
                'id',
                DB::raw('ST_AsGeoJSON(geom) as geojson'),
                'name',
                'description',
                'image',
                'created_at',
                'updated_at'
            )
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        foreach ($rectangles as $r) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($r->geojson),
                'properties' => [
                    'id' => $r->id,
                    'name' => $r->name,
                    'description' => $r->description,
                    'image' => $r->image,
                    'created_at' => $r->created_at,
                    'updated_at' => $r->updated_at
                ]
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
