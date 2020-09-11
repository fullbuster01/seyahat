<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\TravelPackage;
use Illuminate\Support\Str;

class TravelPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.travel-package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $countries = Country::orderBy('name')->get();
        return view('pages.admin.travel-package.create', compact('categories', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TravelPackageRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        TravelPackage::create($data);

        session()->flash('success', 'Product berhasil ditambahkan, Silahkan dilanjutkan dengan menambahkan Gallery!');

        return redirect()->route('travel-package.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = TravelPackage::with(['category'])->findOrFail($id);
        // $category = Category::all();
        return view('pages.admin.travel-package.show', compact('item', ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = TravelPackage::findOrFail($id);
        $categories = Category::all();
        $countries = Country::all();

        return view('pages.admin.travel-package.edit', compact('item', 'categories', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TravelPackageRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = TravelPackage::findOrFail($id);
        $item->update($data);

        session()->flash('success', 'Product berhasil diubah!');

        return redirect()->route('travel-package.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = TravelPackage::findOrFail($id);
        $item->delete();

        session()->flash('success', 'Product berhasil dihapus!');

        return redirect()->route('travel-package.index');
    }


    public function data_ajax()
    {
        $items = TravelPackage::with('country')->latest()->get();

        return datatables()->of($items)
            ->addColumn('country', function ($i) {
                return $i->country->name;
            })
            ->addColumn('action', function ($i) {
                return ' <a href="'. route('travel-package.show', $i->id).'" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <a href="'. route('travel-package.edit', $i->id).'" class="btn btn-info"><i class="fa fa-pencil-alt"></i></a>
                        <form action="'. route('travel-package.destroy', $i->id). '" method="POST" class="d-inline">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="delete">
                            <button class="btn btn-danger" onclick="return confirm(\'Apakah anda yakin ingin menghapus ?\')" alert><i class="fa fa-trash"></i></button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
