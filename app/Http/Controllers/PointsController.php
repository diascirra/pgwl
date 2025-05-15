<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Map'
        ];
        return view('map', $data);
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
                'name' => 'required|unique:points,name',
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:30'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Geometry point is required'
            ]
        );

        //create image directory
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        //create data
        if (!$this->points->create($data)) {
            return redirect()->route('map')->with('error', 'Point Failed to added');
        }

        //Redirect to map
        return redirect()->route('map')->with('success', 'Point has been added');
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
            'title' => 'Edit Point',
            'id' => $id,
        ];
    return view('edit-point', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //validation data
        $request->validate(
            [
                'name' => 'required|unique:points,name,' .$id,
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:30'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Geometry point is required'
            ]
        );

// create image directory
if (!is_dir(public_path('storage/images'))) {
    mkdir(public_path('storage/images'), 0777, true);
}

// get old image file name
$old_image = $this->points->find($id)->image;

// get image file
if ($request->hasFile('image')) {
    $image = $request->file('image');
    $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
    $image->move(public_path('storage/images'), $name_image);

    // delete old image
    if ($old_image != null) {
        $oldPath = public_path('storage/images/' . $old_image);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }
} else {
    $name_image = $old_image;
}


        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
        ];

        //update data
        if (!$this->points->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Point Failed to update');
        }

        //Redirect to map
        return redirect()->route('map')->with('success', 'Point has been updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->points->find($id)->image;

        if (!$this->points->destroy($id)) {
            return redirect()->route('map')->with('error', 'Point failed to delete');
        }

        // delete image file if exists
        if ($imagefile != null) {
            $imagePath = public_path('storage/images/' . $imagefile);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        return redirect()->route('map')->with('success', 'Point has been deleted');
    }
}
