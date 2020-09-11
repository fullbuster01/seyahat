<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionRequest;
use App\Transaction
;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('pages.admin.transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        Transaction::create($data);

        session()->flash('success', 'Product berhasil ditambahkan!');

        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Transaction::with([
            'details', 'travel_package', 'user'
        ])->findOrFail($id);

        return view('pages.admin.transaction.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = Transaction::findOrFail($id);
        $item->update($data);

        session()->flash('success', 'Product berhasil diubah!');

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        session()->flash('success', 'Product berhasil dihapus!');

        return redirect()->route('transaction.index');
    }


    public function data_ajax()
    {
        $items = Transaction::with(['travel_package', 'user'
        ])->latest()->get();

        return datatables()->of($items)
            ->addColumn('travel_id', function ($i) {
                return $i->travel_package->title;
            })
            ->addColumn('user', function ($i) {
                return $i->user->name;
            })
            ->addColumn('action', function ($i) {
                return '<a href="'. route('transaction.show', $i->id).'" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <a href="'. route('transaction.edit', $i->id).'" class="btn btn-info"><i class="fa fa-pencil-alt"></i></a>
                        <form action="'. route('transaction.destroy', $i->id). '" method="POST" class="d-inline">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="delete">
                            <button class="btn btn-danger" onclick="return confirm(\'Apakah anda yakin ingin menghapus?\')" alert><i class="fa fa-trash"></i></button>
                        </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
