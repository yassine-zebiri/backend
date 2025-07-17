<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'location',
        'description',
        'image_url',
        'phone',
        'average_price',
        'website_url',
        'google_maps_url',
    ];
}
