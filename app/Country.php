<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'slug'];

    public function travel_package()
    {
        return $this->hasMany(TravelPackage::class, 'country_id', 'id');
    }
}
