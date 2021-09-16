<?php

namespace App\Http\Controllers;
use App\Models\GalleryProduk;
use App\Models\Produk;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\GalleryProdukRequest;
use Illuminate\Http\Request;

class GalleryProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Produk $produk)
    {
        if (request()->ajax())
        {
            $query = GalleryProduk::where('id_produk', $produk->id);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    
                    <form class="inline-block" action="' . route('dashboard.gallery.destroy', $item->id) . '" method="POST">
                    <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Delete
                        </button>
                    '. method_field('delete'). csrf_field().'
                    </form>
                    ';
                })
                ->editColumn('gambar', function($item){
                    return '<img style="max-width: 150px" src="'. Storage::url($item->gambar).'">';
                })
                ->editColumn('is_featured', function($item){
                    return $item->is_featured ? 'Yes' :'No';                
                })
                ->rawColumns(['action', 'gambar'])
                ->make();
        }
        return view('pages.dashboard.gallery.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Produk $produk)
    {
        return view('pages.dashboard.gallery.create', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryProdukRequest $request, Produk $produk)
    {
        $files = $request->file('files');

        if($request->hasFile('files'))
        {
            foreach($files as $file)
            {
                $path = $file->store('public/gallery');

                GalleryProduk::create([
                    'id_produk' => $produk->id,
                    'gambar' => $path
                ]);
            }
        }
        return redirect()->route('dashboard.produk.gallery.index', $produk->id);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryProduk $gallery)
    {
        $gallery->delete();

        return redirect()->route('dashboard.produk.gallery.index', $gallery->id_produk);
    }
}
