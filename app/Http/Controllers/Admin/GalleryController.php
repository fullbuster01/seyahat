<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $travel_packages = TravelPackage::orderBy('title')->get();
        return view('pages.admin.gallery.create', ['travel_packages' => $travel_packages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = Gallery::all();
        if ($request->has('image')) {
            foreach ($gallery as $id) {
                if ($request->travel_packages_id == $id->travel_packages_id) {
                    session()->flash('error', 'Gallery Untuk Travel tersebut sudah ada silahkan gunakan Travel yang lain!');
                    return redirect()->back();
                }
            }
            $travel = TravelPackage::findOrFail($request->travel_packages_id);
            $image = $request->file('image');
            $name = $travel->slug . '_' . time();
            $fileName = $name . '.' . $image->getClientOriginalExtension();
            $folder = 'gallery';
            $filePath = $image->storeAs($folder .  '/original', $fileName, 'public');
            $resizedImage = $this->_resizeImage($image,  $fileName, $folder);
            $params = array_merge(
                [
                    'travel_packages_id' => $request->travel_packages_id,
                    'image' => $filePath,
                ],
                $resizedImage
            );

            Gallery::create($params);

            session()->flash('success', 'Gallery berhasil ditambahkan, Silahkan dilanjutakn dengan menambah Thumbnail!');

            return redirect()->route('gallery.index');
        }
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
        $item = Gallery::findOrFail($id);
        // $travel_packages = TravelPackage::all();

        return view('pages.admin.gallery.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $item = Gallery::findOrFail($id);
        $travel = TravelPackage::findOrFail($item->travel_packages_id);
        $image = $request->file('image');
        $name = $travel->slug . '_' . time();
        $fileName = $name . '.' . $image->getClientOriginalExtension();
        $folder = 'gallery';
        $filePath = $image->storeAs($folder .  '/original', $fileName, 'public');
        $resizedImage = $this->_resizeImage($image,  $fileName, $folder);
        $params = array_merge(
            [
                'image' => $filePath,
                'travel_packages_id' => $item->travel_packages_id
            ],
            $resizedImage
        );

        $item->update($params);

        session()->flash('success', 'Gallery berhasil diubah!');

        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);
        $item->delete();

        session()->flash('success', 'Gallery berhasil dihapus!');

        return redirect()->route('gallery.index');
    }


    private function _resizeImage($image, $fileName, $folder)
    {
        $resizedImage = [];

        $mediumImageFilePath = $folder . '/medium/' . $fileName;
        $size = explode('x', Gallery::m);
        list($width, $height) = $size;

        $mediumImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put('public/' . $mediumImageFilePath, $mediumImageFile)) {
            $resizedImage['m'] = $mediumImageFilePath;
        }

        $largeImageFilePath = $folder . '/large/' . $fileName;
        $size = explode('x', Gallery::l);
        list($width, $height) = $size;

        $largeImageFile = ImageManagerStatic::make($image)->resize($width, $height)->stream();
        if (Storage::put('public/' . $largeImageFilePath, $largeImageFile)) {
            $resizedImage['l'] = $largeImageFilePath;
        }

        return $resizedImage;
    }


    public function data_ajax()
    {
        $items = Gallery::with('travel_package')->latest()->get();

        return datatables()->of($items)
            ->addColumn('travel_id', function ($i) {
                return $i->travel_package->title;
            })
            ->addColumn('img', function ($i) {
                return '<img src="' . Storage::url($i->m) . '" alt="img thumb" class="img-thumbnail">';
            })
            ->addColumn('action', function ($i) {
                return '<a href="' . route('gallery.edit', $i->id) . '" class="btn btn-info"><i class="fa fa-pencil-alt"></i></a>
                        <form action="' . route('gallery.destroy', $i->id) . '" method="POST" class="d-inline">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="delete">
                            <button class="btn btn-danger" onclick="return confirm(\'anda yakin ingin menghapus ?\')"><i class="fa fa-trash"></i></button>
                        </form>';
            })
            ->rawColumns(['img', 'action'])
            ->make(true);
    }
}
