<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyGallery;
use App\Models\PropertyVilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyGalleryController extends Controller
{

    function __construct()
    {
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = PropertyGallery::with('PropertyVilla')->orderBy('properties_id', 'asc')->paginate(5);
        $images = [];

        foreach ($galleries as $data) {
            array_push($images, $this->dropbox->getTemporaryLink($data->image));
        }

        return view('backend.galleries.index', compact('galleries', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $villa = PropertyVilla::all();

        return view('backend.galleries.create', compact('villa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "properties_villa" => ['required'],
            "images" => ["required"],
            "images.*" => ["image", "mimes:jpg,png", "max:500"]
        ];
        $request->validate($rules);

        $propertyVilla = $request->properties_villa;
        $dataId = PropertyVilla::where('slug', $propertyVilla)->first()->id;

        foreach ($request->file('images') as $imageFile) {

            $uploadImage = Storage::disk('dropbox')->put('public/galleries', $imageFile);

            $data = [
                "properties_id" => $dataId,
                "image" => $uploadImage
            ];

            PropertyGallery::create($data);
        }

        return redirect()->route('properties-gallery.index')->with('flash_message', 'data gallery success created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyGallery  $propertyGallery
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyGallery $propertyGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyGallery  $propertyGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyGallery $propertiesGallery)
    {
        $villa = PropertyVilla::all();
        $getTempImg = $this->dropbox->getTemporaryLink($propertiesGallery->image);

        return response()->json(["villa" => $villa, "galleries" => $propertiesGallery, "galleries_category" => $propertiesGallery->PropertyVilla()->get('slug'), "imageTemp" => $getTempImg]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyGallery  $propertyGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyGallery $propertiesGallery)
    {
        $rules = [
            'properties_villa' => ['required'],
            'images' => ['image', 'mimes:jpg,png', 'max:500']
        ];

        $request->validate($rules);

        $getDataId = PropertyVilla::where('slug', $request->properties_villa)->first()['id'];

        if ($request->file('images')) {
            if (Storage::disk('dropbox')->exists($propertiesGallery->image)) {
                Storage::disk('dropbox')->delete($propertiesGallery->image);
            }
            $image = Storage::disk('dropbox')->put('public/galleries', $request->file('images'));
        } else {
            $image = $propertiesGallery->image;
        }

        $data = [
            "properties_id" => $getDataId,
            "image" => $image
        ];

        $propertiesGallery->update($data);

        return redirect()->route('properties-gallery.index')->with('flash_message', 'data gallery success updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyGallery  $propertyGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyGallery $propertiesGallery)
    {
        if (Storage::disk('dropbox')->exists($propertiesGallery->image)) {
            Storage::disk('dropbox')->delete($propertiesGallery->image);
        }

        $propertiesGallery->delete();

        return response()->json('Data Success Deleted', 200);
    }
}
