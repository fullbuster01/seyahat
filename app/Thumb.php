<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thumb extends Model
{
    use SoftDeletes;

    protected $fillable = ['galleries_id', 'thumb', 'm', 'l'];

    public const m = '120x80';
    public const l = '660x350';

    public function galleries()
    {
        return $this->belongsTo(Gallery::class, 'galleries_id', 'id');
    }

    public function travel_package()
    {
        return $this->belongsTo(TravelPackage::class, 'travel_packages_id', 'id');
    }
}
