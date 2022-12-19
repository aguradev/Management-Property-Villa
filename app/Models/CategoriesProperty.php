<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesProperty extends Model
{
    use HasFactory;

    protected $table = "categories_property";
    protected $guard = ["id"];
    protected $fillable = ["category_name", "description", "slug"];
    public $timestamps = true;

    function getRouteKeyName()
    {
        return 'slug';
    }

    function propertiesVilla()
    {
        return $this->hasMany(PropertyVilla::class, 'category_id');
    }
}
