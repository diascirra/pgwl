<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PolygonsModel extends Model
{
    protected $table = 'polygons';

    protected $guarded = ['id'];

    public function geojson_polygons()
    {
        $polygons = $this->newQuery()
            ->select(DB::raw('id, st_asgeojson(geom) as geom, st_area(geom, true) as luas_m2, st_area(geom, true)/1000000 as luas_km2,
            st_area(geom, true)/10000 as luas_hektar, name, description, image, created_at, updated_at '))
            ->get();

        // Struktur GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), // Konversi dari JSON
                'properties' => [
                'id' =>$p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'luas_m2' => $p->luas_m2,
                    'luas_km2' => $p->luas_km2,
                    'area_hektar' => $p->luas_hektar,
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
    public function geojson_polygonss($id)
    {
        $polygons = $this->newQuery()
            ->select(DB::raw('id, st_asgeojson(geom) as geom, st_area(geom, true) as luas_m2, st_area(geom, true)/1000000 as luas_km2,
            st_area(geom, true)/10000 as luas_hektar, name, description, image, created_at, updated_at '))
            ->where('id', $id)
            ->get();

        // Struktur GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom), // Konversi dari JSON
                'properties' => [
                'id' =>$p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'luas_m2' => $p->luas_m2,
                    'luas_km2' => $p->luas_km2,
                    'area_hektar' => $p->luas_hektar,
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
