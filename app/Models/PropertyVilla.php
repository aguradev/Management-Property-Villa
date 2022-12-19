<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyVilla extends Model
{
    use HasFactory;
    protected $table = "properties_villa";
    protected $fillable = ["category_id", "property_villa_name", "slug", "location", "price", "description", "img_thumbnail"];
    protected $guarded = ["id"];
    public $timestamps = true;

    function getRouteKeyName()
    {
        return 'slug';
    }

    function galleries()
    {
        return $this->hasMany(PropertyGallery::class, 'properties_id');
    }

    function features()
    {
        return $this->hasMany(PropertyFeatures::class, 'properties_id');
    }

    function category()
    {
        return $this->belongsTo(CategoriesProperty::class);
    }
}
