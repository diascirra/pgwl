<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolylinesModel extends Model
{
    protected $table = 'polyline';

    protected $guarded = ['id'];

    public function geojson_polyline()
    {
        $polyline = $this->newQuery()
            ->select(DB::raw('ST_AsGeoJSON(geom) as geom, name, description, image, st_length(geom, true) as length_m,
            st_length(geom, true)/1000 as length_km, created_at, updated_at'))
            ->get();

        // Struktur GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polyline as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), // Konversi dari JSON
                'properties' => [
                    'name' => $p->name,
                    'description' => $p->description,
                    'length_m' => $p->length_m,
                    'length_km'=> $p->length_km,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image
                ],
            ];

            // Tambahkan ke dalam array GeoJSON
            $geojson['features'][] = $feature;
        }

        return $geojson;
    }
}
