<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Http\Controllers\Controller;
use App\Models\PolygonsModel;
use App\Models\PolylinesModel;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polylines = new PolylinesModel();
        $this->polygons = new PolygonsModel();
    }


    public function points()
    {
        $points = $this->points->geojson_points();

        return response()->json($points);
    }

    public function point($id)
    {
        $points = $this->points->geojson_point($id);

        return response()->json($points);
    }
    public function polyline()
    {
        $polyline = $this->polylines->geojson_polyline(); // Pakai $this->polylines, bukan fungsi
        return response()->json($polyline, 200, [], JSON_NUMERIC_CHECK);
    }
    public function polylines($id)
    {
        $polyline = $this->polylines->geojson_polylines($id); // Pakai $this->polylines, bukan fungsi
        return response()->json($polyline, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygons()
    {
        $polygons = $this->polygons->geojson_polygons(); // Pakai $this->polygons, bukan fungsi
        return response()->json($polygons, 200, [], JSON_NUMERIC_CHECK);
    }
    public function polygonss($id)
    {
        $polygons = $this->polygons->geojson_polygonss($id); // Pakai $this->polygons, bukan fungsi
        return response()->json($polygons, 200, [], JSON_NUMERIC_CHECK);
    }
}
