<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Exception;
use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;
use App\Models\ItemTransaksi;

class FrontendController extends Controller
{
    public function index (Request $request) 
    {
        $produks = Produk::with(['gallery'])->latest()->get();

        return view('pages.frontend.index', compact('produks'));
    }

    public function details (Request $request, $slug) 
    {
        $produk = Produk::with(['gallery'])->where('slug', $slug)->firstOrFail();
        $recommendations = PRoduk::with(['gallery'])->inRandomOrder()->limit(4)->get();

        return view('pages.frontend.details', compact('produk', 'recommendations'));
    }

    public function cartAdd (Request $request, $id)
    {
        Cart::create([
            'users_id' => Auth::user()->id,
            'id_produk' => $id
        ]);

        return redirect('cart');
    }

    public function cartDelete(Request $request, $id)
    {
        $item = Cart::findOrFail($id);

        $item->delete();

        return redirect('cart');
    }

    public function cart (Request $request) 
    {
        $carts = Cart::with(['produk.gallery'])->where('users_id', Auth::user()->id)->get();

        return view('pages.frontend.cart', compact('carts'));
    }

    public function success (Request $request) 
    {
        return view('pages.frontend.success');
    }
}
