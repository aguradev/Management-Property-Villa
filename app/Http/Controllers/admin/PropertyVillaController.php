<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PropertyVilla;
use App\Models\CategoriesProperty;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\PropertyVillaRequest;
use Dcblogdev\Dropbox\Facades\Dropbox;
use Illuminate\Support\Facades\Storage;

use function App\Helpers\setImageThumbnail;

class PropertyVillaController extends Controller
{

    public function __construct()
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
        $properties = PropertyVilla::with(['category'])->paginate(5);
        $dataCategories = CategoriesProperty::all();

        $images = [];

        foreach ($properties as $data) {
            array_push($images, $this->dropbox->getTemporaryLink($data->img_thumbnail));
        }

        return view("backend.properties.index", compact('properties', 'images', 'dataCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dataCategories = CategoriesProperty::all();

        return view('backend.properties.create', compact('dataCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyVillaRequest $request)
    {
        $getIdCategory = CategoriesProperty::where("slug", $request->category)->first();

        try {
            if ($request->has('img_thumbnail')) {

                $thumbnail = $request->file('img_thumbnail');
                $newName = Storage::disk('dropbox')->put('public/thumbnail', $thumbnail);
            }
        } catch (\Throwable $th) {
            return "Message : " . $th->getMessage();
        }

        $propertyName = $request->property_villa_name;

        $data = [
            "property_villa_name" => $propertyName,
            "category_id" => $getIdCategory->id,
            "location" => $request->location,
            "price" => $request->price,
            "description" => $request->description,
            "slug" => Str::slug($propertyName, '-'),
            "img_thumbnail" => $newName
        ];

        PropertyVilla::create($data);

        return redirect()->route('properties-villa.index')->with('flash_message', 'Data Property Success Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyVilla  $propertyVilla
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyVilla $propertyVilla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyVilla  $propertyVilla
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyVilla $propertiesVilla)
    {
        $dropboxImg = $this->dropbox->getTemporaryLink($propertiesVilla->img_thumbnail);
        return response()->json(["dataEdit" => $propertiesVilla, "tempThumbnail" => $dropboxImg, "dataCategory" => $propertiesVilla->category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyVilla  $propertyVilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyVilla $propertiesVilla)
    {
        $rules = [
            "description" => ['min:10'],
            "price" => ['numeric', 'min:5'],
            "img_thumbnail" => ['nullable', 'image', 'file', 'mimes:png,jpg', 'max:2048']
        ];

        $request->validate($rules);

        if ($request->file('img_thumbnail')) {
            $thumbnail = $request->file('img_thumbnail');

            if (Storage::disk('dropbox')->exists($propertiesVilla->img_thumbnail)) {
                Storage::disk('dropbox')->delete($propertiesVilla->img_thumbnail);
                $image = Storage::disk('dropbox')->put('public/thumbnail', $thumbnail);
            }
        } else {
            $image = $propertiesVilla->img_thumbnail;
        }


        $getIdCategory = CategoriesProperty::where("slug", $request->category)->first();
        $propertyName = $request->property_villa_name;

        $data = [
            "property_villa_name" => $propertyName,
            "category_id" => $getIdCategory->id,
            "location" => $request->location,
            "price" => $request->price,
            "description" => $request->description,
            "slug" => Str::slug($propertyName, '-'),
            "img_thumbnail" => $image
        ];

        $propertiesVilla->update($data);

        return redirect()->route('properties-villa.index')->with('flash_message', 'Data Property Success Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyVilla  $propertyVilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyVilla $propertiesVilla)
    {
        if (Storage::disk('dropbox')->exists($propertiesVilla->img_thumbnail)) {
            Storage::disk('dropbox')->delete($propertiesVilla->img_thumbnail);
        }

        $propertiesVilla->delete();

        return response()->json('Data Success Deleted', 200);
    }
}
