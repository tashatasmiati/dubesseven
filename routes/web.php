<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use  App\Http\Controllers\ProdukController;
use  App\Http\Controllers\GalleryProdukController;
use  App\Http\Controllers\TransaksiController;
use  App\Http\Controllers\UserController;
use  App\Http\Controllers\MyTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [FrontendController::class, index])->name('indeks');
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/details/{slug}', [FrontendController::class, 'details'])->name('details');


/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
    Route::post('/cart/{id}', [FrontendController::class, 'cartAdd'])->name('cart-add');
    Route::delete('/cart/{id}', [FrontendController::class, 'cartDelete'])->name('cart-delete');
    Route::post('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [FrontendController::class, 'success'])->name('checkout-success');
    
    
});


Route::middleware(['auth:sanctum', 'verified'])->name('dashboard.')->prefix('dashboard')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('index'); //dashboard.index
    
    Route::resource('my-transaction', MyTransactionController::class)->only([
        'index', 'show', 
    ]); 

    Route::middleware(['admin'])->group(function () {
        Route::resource('produk', ProdukController::class); 
        Route::resource('produk.gallery', GalleryProdukController::class)->shallow()->only([
            'index', 'create', 'store', 'destroy'
        ]); 

        Route::resource('transaksi', TransaksiController::class)->only([
            'index', 'show', 'edit', 'update'
        ]); 
        
        Route::resource('user', UserController::class)->only([
            'index', 'edit', 'update', 'destroy'
        ]);
    });
});
