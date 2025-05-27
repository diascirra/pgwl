<?php

namespace App\Http\Controllers;

use App\Models\PolylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{

    public function __construct()
    {
        $this->polyline = new PolylinesModel();
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
                'name' => 'required|unique:polyline,name',
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:30'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry polyline is required',
            ]
        );

        //create image directory
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image,
            'user_id' => auth()->user()->id,
        ];

        //create data
        if (!$this->polyline->create($data)) {
            return redirect()->route('map')->with('error', 'Polyline Failed to added');
        }

        //Redirect to map
        return redirect()->route('map')->with('success', 'Polyline has been added');
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
            'title' => 'Edit Polyline',
            'id' => $id,
        ];
        return view('edit-polyline', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validation data
        $request->validate(
            [
                'name' => 'required|unique:polyline,name,' . $id,
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:30'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry polyline is required'
            ]
        );

        //create image directory
        if (!is_dir(public_path('storage/images'))) {
            mkdir(public_path('storage/images'), 0777, true);
        }

        //get old image file name
        $old_image = $this->polyline->find($id)->image;

        //get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);


            //delete old image
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
                'geom' => $request->geom_polyline,
                'name' => $request->name,
                'description' => $request->description,
                'image' => $name_image,
            ];

            //update data
            if (!$this->polyline->find($id)->update($data)) {
                return redirect()->route('map')->with('error', 'Polyline Failed to update');
            }

            //Redirect to map
            return redirect()->route('map')->with('success', 'Polyline has been updated');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polyline->find($id)->image;

        if (!$this->polyline->destroy($id)) {
            return redirect()->route('map')->with('error', 'Polyline failed to delete');
        }

        // delete image file if exists
        if ($imagefile != null) {
            $imagePath = public_path('storage/images/' . $imagefile);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        return redirect()->route('map')->with('success', 'Polyline has been deleted');
    }
}
