<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Thumb;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ThumbRequest;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class thumbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.thumb.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $galleries = Gallery::all();
        return view('pages.admin.thumb.create', ['galleries' => $galleries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThumbRequest $request)
    {
        // $data = $request->all();
        // $data['thumb'] = $request->file('thumb')->store(
        //     'assets/thumb',
        //     'public'
        // );

        $gallery = Gallery::findOrFail($request->galleries_id);
        $image = $request->file('thumb');
        $name = $gallery->travel_package->slug . '_' . time();
        $fileName = $name . '.' . $image->getClientOriginalExtension();
        $folder = 'thumb';
        $filePath = $image->storeAs($folder .  '/original', $fileName, 'public');
        $resizedImage = $this->_resizeImage($image,  $fileName, $folder);
        $params = array_merge(
            [
                'galleries_id' => $request->galleries_id,
                'thumb' => $filePath,
            ],
            $resizedImage
        );
        Thumb::create($params);

        session()->flash('success', 'Thumbnail berhasil ditambahkan!');

        return redirect()->route('thumb.index');
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
        // $item = thumb::findOrFail($id);
        // $galleries = Gallery::all();

        // return view('pages.admin.thumb.edit', [
        //     'item' => $item,
        //     'galleries' => $galleries
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThumbRequest $request, $id)
    {
        // $data = $request->all();
        // $data['thumb'] = $request->file('thumb')->store(
        //     'assets/thumb',
        //     'public'
        // );

        // $item = Thumb::findOrFail($id);
        // $item->update($data);

        // return redirect()->route('thumb.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Thumb::findOrFail($id);
        $item->delete();

        session()->flash('success', 'Product berhasil dihapus!');

        return redirect()->route('thumb.index');
    }


    private function _resizeImage($image, $fileName, $folder)
    {
        $resizedImage = [];

        $mediumImageFilePath = $folder . '/medium/' . $fileName;
        $size = explode('x', Thumb::m);
        list($width, $height) = $size;

        $mediumImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put('public/' . $mediumImageFilePath, $mediumImageFile)) {
            $resizedImage['m'] = $mediumImageFilePath;
        }

        $largeImageFilePath = $folder . '/large/' . $fileName;
        $size = explode('x', Thumb::l);
        list($width, $height) = $size;

        $largeImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put('public/' . $largeImageFilePath, $largeImageFile)) {
            $resizedImage['l'] = $largeImageFilePath;
        }

        return $resizedImage;
    }

    public function data_ajax()
    {
        $items = Thumb::with('galleries')->latest()->get();

        return datatables()->of($items)
            ->addColumn('gallery_id', function ($i) {
                return $i->galleries->id;
            })
            ->addColumn('thumb', function ($i) {
                return '<img src="' . Storage::url($i->m) . '" alt="img thumb" class="img-thumbnail">';
            })
            ->addColumn('action', function ($i) {
                return '<form action="'. route('thumb.destroy', $i->id). '" method="POST" class="d-inline">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="delete">
                            <button class="btn btn-danger" onclick="return confirm(\'anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
                        </form>';
            })
            ->rawColumns(['thumb', 'action'])
            ->make(true);
    }
}
