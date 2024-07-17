<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    function city()
    {
        return $this->belongsTo(City::class, 'ship_city_id');
    }
    function country()
    {
        return $this->belongsTo(Country::class, 'ship_country_id');
    }
}
