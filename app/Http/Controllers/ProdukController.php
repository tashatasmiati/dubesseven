<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProdukRequest;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //boilerpad
    {
        if (request()->ajax())
        {
            $query = Produk::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.produk.gallery.index', $item->id) . '">
                            Gallery
                    </a>
                    <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"  
                    href="'. route('dashboard.produk.edit', $item->id) .'">
                        Edit
                    </a>
                    <form class="inline-block" action="' . route('dashboard.produk.destroy', $item->id) . '" method="POST">
                    <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Delete
                        </button>
                    '. method_field('delete'). csrf_field().'
                    </form>
                    ';
                })
                ->editColumn('hargaproduk', function($item){
                    return number_format($item->hargaproduk);
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.produk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {
        //return $request->all();
        $data = $request->all();
        $data['slug'] = Str::slug($request->namaproduk);

        Produk::create($data);

        return redirect()->route('dashboard.produk.index');
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
    public function edit(Produk $produk)
    {
        return view('pages.dashboard.produk.edit', [
                        'item' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukRequest $request, Produk $produk)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->namaproduk);

        $produk->update($data);

        return redirect()->route('dashboard.produk.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        
        return redirect()->route('dashboard.produk.index');
    }
}
