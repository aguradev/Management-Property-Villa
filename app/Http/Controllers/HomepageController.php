<?php

namespace App\Http\Controllers;

use App\Models\PropertyVilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{

    public function __construct()
    {
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();
    }

    public function index()
    {

        $villa = PropertyVilla::with(['category', 'features'])->get()->take(3);
        $villaImage = [];

        foreach ($villa as $villa_img) {
            $villaImage[] = $this->dropbox->getTemporaryLink($villa_img->img_thumbnail);
        }

        return view('frontend.index', compact('villa', 'villaImage'));
    }

    public function propertyDetail(PropertyVilla $propertiesVilla)
    {

        $thumbnail = $this->dropbox->getTemporaryLink($propertiesVilla->img_thumbnail);

        $galleries = [];

        foreach ($propertiesVilla->galleries as $gallery) {
            $galleries[] =  $this->dropbox->getTemporaryLink($gallery->image);
        }

        return view('frontend.pages.property-detail', compact('propertiesVilla', 'thumbnail', 'galleries'));
    }

    public function properties()
    {

        $villa = PropertyVilla::with(['category', 'features'])->paginate(6);
        $villaImage = [];

        foreach ($villa as $villa_img) {
            $villaImage[] = $this->dropbox->getTemporaryLink($villa_img->img_thumbnail);
        }

        return view('frontend.pages.properties', compact('villa', 'villaImage'));
    }
}
