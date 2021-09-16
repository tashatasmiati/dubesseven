<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\TransaksiRequest;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax())
        {
            $query = Transaksi::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
                            href="' . route('dashboard.transaksi.show', $item->id) . '">
                            Show
                    </a>
                    <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"  
                    href="'. route('dashboard.transaksi.edit', $item->id) .'">
                        Edit
                    </a>
                  ';
                })
                ->editColumn('total_harga', function($item){
                    return number_format($item->total_harga);
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        if (request()->ajax())
        {
            $query = ItemTransaksi::with(['produk'])->where('id_transaksi', $transaksi->id);

            return DataTables::of($query)
               
                ->editColumn('produk.hargaproduk', function($item){
                    return number_format($item->produk->hargaproduk);
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('pages.dashboard.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        return view('pages.dashboard.transaksi.edit',[
            'item' => $transaksi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransaksiRequest $request, Transaksi $transaksi)
    {
        $data = $request->all();
        $transaksi->update($data);

        return redirect()->route('dashboard.transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
