<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointsModel;
use App\Models\PolylinesModel;
use App\Models\PolygonsModel;


class TableController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polyline = new PolylinesModel();
        $this->polygon = new PolygonsModel();
    }

    public function index()
    {
        // Ambil data dari model
        $points = $this->points->all();
        $polylines = $this->polyline->all();
        $polygons = $this->polygon->all();

        // Kirim data ke view
        $data = [
            'title' => 'Table',
            'points' => $points,
            'polyline' => $polylines,
            'polygons' => $polygons
        ];

        return view('table', $data);
    }
}
