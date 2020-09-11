<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\Gallery;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $country =  Country::count();
        $galleries = Gallery::all();
        $populars = $this->populars();
        $categories = Category::orderBy('name')->get();
        return view('pages.home', compact('galleries', 'categories', 'populars', 'country'));
    }

    public function populars()
    {
        return DB::table('travel_packages')
        ->join('views', 'travel_packages.id', '=', 'views.viewable_id')
        ->select(DB::raw('count(viewable_id) as count'), 'travel_packages.id', 'travel_packages.title', 'travel_packages.slug', 'travel_packages.location')
        ->groupBy('id', 'title', 'slug', 'location')
        ->orderBy('count', 'desc')
        ->take(4)
            ->get();
    }
}
