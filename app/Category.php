<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function travel_package(){
        return $this->hasMany(TravelPackage::class, 'category_id', 'id');
    }
}
