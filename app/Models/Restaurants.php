<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    //
    protected $fillable = [
        'name',
        'type',
        'location',
        'description',
        'image_url',
        'phone',
        'open_time',
        'close_time',
        'average_price',
        'website_url',
        'google_maps_url',
    ];
}
