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
            ->select(DB::raw('polyline.id, ST_AsGeoJSON(geom) as geom, polyline.name, polyline.description, polyline.image, st_length(geom, true) as length_m,
            st_length(geom, true)/1000 as length_km, polyline.created_at, polyline.updated_at, polyline.user_id, users.name as user_created'))
            ->leftJoin('users', 'polyline.user_id', '=', 'users.id')
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
                    'id' =>$p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'length_m' => $p->length_m,
                    'length_km'=> $p->length_km,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,
                ],
            ];

            // Tambahkan ke dalam array GeoJSON
            $geojson['features'][] = $feature;
        }

        return $geojson;
    }
    public function geojson_polylines($id)
    {
        $polyline = $this->newQuery()
            ->select(DB::raw('id, ST_AsGeoJSON(geom) as geom, name, description, image, st_length(geom, true) as length_m,
            st_length(geom, true)/1000 as length_km, created_at, updated_at'))
            ->where('id', $id)
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
                    'id' =>$p->id,
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
