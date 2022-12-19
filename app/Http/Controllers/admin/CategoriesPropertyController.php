<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriesProperty;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoriesRequest;

class CategoriesPropertyController extends Controller
{
    private $CategoryProperty;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->CategoryProperty = new CategoriesProperty();
    }

    public function index()
    {
        $dataView = CategoriesProperty::all();
        $no = 1;

        return view("backend.categories.index", compact('dataView', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $data = [
            "category_name" => $request->category_name,
            "slug" => Str::slug($request->category_name, "-"),
            "description" => $request->description
        ];

        $this->CategoryProperty->create($data);

        return redirect()->route("categories-property.index")->with("flash_message", "Data success created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriesProperty  $categoriesProperty
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriesProperty $categoriesProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriesProperty  $categoriesProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriesProperty $categoriesProperty)
    {
        return response()->json(['data' => $categoriesProperty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriesProperty  $categoriesProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesProperty $categoriesProperty)
    {
        $request->validate([
            "category_name" => ["required"],
            "description" => ["required"]
        ]);

        $data = [
            "category_name" => $request->category_name,
            "slug" => Str::slug($request->category_name, "-"),
            "description" => $request->description
        ];

        $categoriesProperty->update($data);

        return redirect()->route("categories-property.index")->with("flash_message", "Data Success Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriesProperty  $categoriesProperty
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesProperty $categoriesProperty)
    {
        $categoriesProperty->delete();

        return response()->json(['message' => 'data successful deleted!']);
    }
}
