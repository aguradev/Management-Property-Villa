<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyFeatures;
use App\Models\PropertyVilla;
use Illuminate\Http\Request;

class PropertyFeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataView = PropertyFeatures::with(['PropertyVilla'])->paginate(5);

        return view('backend.features.index', compact('dataView'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villa = PropertyVilla::all();

        return view('backend.features.create', compact('villa'));
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
            'properties_villa' => ['required'],
            'name_feature' => ['required', 'min:4']
        ];

        $request->validate($rules);

        $getDataId = PropertyVilla::where('slug', $request->properties_villa)->first()['id'];

        $data = [
            'properties_id' => $getDataId,
            'name_feature' => $request->name_feature
        ];

        PropertyFeatures::create($data);

        return redirect()->route('properties-feature.index')->with('flash_message', 'Data Success Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyFeatures  $propertyFeatures
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyFeatures $propertyFeatures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyFeatures  $propertyFeatures
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyFeatures $propertiesFeature)
    {
        $villa = PropertyVilla::all();

        return response()->json(["villa" => $villa, "features" => $propertiesFeature, "propertySlug" => $propertiesFeature->PropertyVilla()->get('slug')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyFeatures  $propertyFeatures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyFeatures $propertiesFeature)
    {
        $rules = [
            'properties_villa' => ['required'],
            'name_feature' => ['required', 'min:4']
        ];

        $request->validate($rules);

        $getDataId = PropertyVilla::where('slug', $request->properties_villa)->first()['id'];

        $data = [
            'properties_id' => $getDataId,
            'name_feature' => $request->name_feature
        ];

        $propertiesFeature->update($data);

        return redirect()->route('properties-feature.index')->with('flash_message', 'Data Success Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyFeatures  $propertyFeatures
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyFeatures $propertiesFeature)
    {
        $propertiesFeature->delete();

        return response()->json(['data success deleted'], 200);
    }
}
