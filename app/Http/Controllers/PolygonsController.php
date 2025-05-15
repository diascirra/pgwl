<?php

namespace App\Http\Controllers;

use App\Models\PolygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    public function __construct()
    {
        $this->polygon = new PolygonsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation data
        $request->validate(
            [
                'name' => 'required|unique:polygons,name',
                'description' => 'required',
                'geom_polygon' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:30'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polygon.required' => 'Geometry point is required',
            ]
        );

        //create image directory
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        //create data
        if (!$this->polygon->create($data)) {
            return redirect()->route('map')->with('error', 'Polygon Failed to added');
        }

        //Redirect to map
        return redirect()->route('map')->with('success', 'Polygon has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polygon',
            'id' => $id,
        ];
        return view('edit-polygon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation data
        $request->validate([
            'name' => 'required|unique:polygons,name,' . $id,
            'description' => 'required',
            'geom_polygon' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:3072', // max 3MB (sesuaikan)
        ], [
            'name.required' => 'Name is required',
            'name.unique' => 'Name already exists',
            'description.required' => 'Description is required',
            'geom_polygon.required' => 'Geometry polygon is required',
        ]);

        // Create image directory if not exist
        if (!is_dir(public_path('storage/images'))) {
            mkdir(public_path('storage/images'), 0777, true);
        }

        $polygon = $this->polygon->find($id);

        if (!$polygon) {
            return redirect()->route('map')->with('error', 'Polygon not found');
        }

        // Get old image file name
        $old_image = $this->polygon->find($id)->image;

        // Handle new image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move(public_path('storage/images'), $name_image);

            // Delete old image if exists
            if ($old_image != null) {
                $oldPath = public_path('storage/images/' . $old_image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        } else {
            $name_image = $old_image;
        }

        // Prepare data array
        $data = [
            'geom' => $request->geom_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        // Update data
        if (!$this->polygon->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Polyline Failed to update');
        }

        // Redirect with success message
        return redirect()->route('map')->with('success', 'Polygon has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polygon->find($id)->image;

        if (!$this->polygon->destroy($id)) {
            return redirect()->route('map')->with('error', 'Polygon failed to delete');
        }

        // delete image file if exists
        if ($imagefile != null) {
            $imagePath = public_path('storage/images/' . $imagefile);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        return redirect()->route('map')->with('success', 'Polygon has been deleted');
    }
}
