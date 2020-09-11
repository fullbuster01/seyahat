<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class TravelPackage extends Model implements Viewable
{
    use SoftDeletes;
    use InteractsWithViews;

    protected $fillable = ['category_id', 'country_id', 'title', 'slug', 'location','about', 'featured_event', 'language', 'foods', 'departure_date', 'duration', 'type', 'price'];

    protected $hidden = [];

    public function galleries(){
        return $this->hasMany(Gallery::class, 'travel_packages_id', 'id');
    }

    public function thumb()
    {
        return $this->hasMany(Thumb::class, 'galleries_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
