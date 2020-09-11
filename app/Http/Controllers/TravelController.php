<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\TravelPackage;

class TravelController extends Controller
{
    public function all_travel(){
        $travels = TravelPackage::with(['galleries'])->latest()->paginate(8);
        $categories = Category::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        return view('pages.travel', compact('travels','categories', 'countries'));
    }

    public function category(Category $category){
        $travels = TravelPackage::with(['galleries'])->latest()->paginate(8);
        $travels = $category->travel_package()->latest()->paginate(8);
        $categories = Category::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        return view('pages.travel', compact('travels', 'categories', 'countries'));
    }

    public function country(Country $country)
    {
        $travels = TravelPackage::with(['galleries'])->latest()->paginate(8);
        $travels = $country->travel_package()->latest()->paginate(8);
        $categories = Category::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();
        return view('pages.travel', compact('travels', 'categories', 'countries'));
    }

    
}
