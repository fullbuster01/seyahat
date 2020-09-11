<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = ['travel_packages_id', 'image', 'm', 'l'];

    // public const UPLOAD_DIR = 'gallery';
    public const m = '160x200';
    public const l = '260x380';

    public function travel_package(){
        return $this->belongsTo(TravelPackage::class, 'travel_packages_id', 'id');
    }

    public function thumb()
    {
        return $this->hasMany(Thumb::class, 'galleries_id', 'id');
    }
}
