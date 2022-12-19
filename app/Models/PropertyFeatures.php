<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeatures extends Model
{
    use HasFactory;
    protected $table = "property_features";
    protected $guarded = ['id'];
    protected $fillable = ['properties_id', 'name_feature'];

    function PropertyVilla()
    {
        return $this->belongsTo(PropertyVilla::class, 'properties_id');
    }
}
