<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NameRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameRequest $request)
    {
        $name = $request->name;
        Country::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);

        session()->flash('success', 'Country berhasil ditambahkan!');

        return redirect()->route('country.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('pages.admin.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NameRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $name = $request->name;
        $country->update([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);

        session()->flash('success', 'Country berhasil diubah!');

        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        session()->flash('success', 'Country berhasil dihapus!');

        return redirect()->back();
    }


    public function data_ajax()
    {
        $country = Country::latest()->get();

        return datatables()->of($country)
            ->addColumn('action', function ($c) {
                return '<a href="'. route('country.edit', $c->id).'" class="btn btn-info"><i class="fa fa-pencil-alt"></i></a>
                                            <form action="'. route('country.destroy', $c->id).'" method="POST" class="d-inline">
                                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                                <input type="hidden" name="_method" value="delete">
                                                <button class="btn btn-danger" onclick="return confirm(\'Apakah anda yakin ingin menghapus\')" alert><i class="fa fa-trash"></i></button>
                                            </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
