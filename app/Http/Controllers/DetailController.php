<?php

namespace App\Http\Controllers;

use App\Category;
use App\TravelPackage;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $slug)
    {
        $items = TravelPackage::with(['thumb', 'country', 'category'])->where('slug', $slug)->firstOrFail();
        views($items)->record(); //ini untuk menyimpan view dari package https://github.com/cyrildewit/eloquent-viewable
        $categories = Category::orderBy('name')->get();
        return view('pages.detail', compact('items', 'categories'));
    }
}
