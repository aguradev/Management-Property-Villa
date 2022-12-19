<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    use HasFactory;

    protected $table = "property_galleries";
    protected $fillable = ['properties_id', 'image'];
    protected $guarded = ['id'];

    function PropertyVilla()
    {
        return $this->belongsTo(PropertyVilla::class, 'properties_id');
    }
}
