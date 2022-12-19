<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriesProperty;
use App\Models\PropertyVilla;
use Illuminate\Http\Request;

class HomeDashboardController extends Controller
{
    public function index()
    {
        $CategoriesCount = CategoriesProperty::all()->count();
        $PropertyCount = PropertyVilla::all()->count();

        return view('backend.dashboard', compact('CategoriesCount', 'PropertyCount'));
    }
}
