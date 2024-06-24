<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\KatagoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login')->middleware('guest');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('/produk/create', [App\Http\Controllers\ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk-all', [App\Http\Controllers\ProdukController::class, 'getProduk'])->name('produk.all');
    Route::post('/produk/save', [App\Http\Controllers\ProdukController::class, 'save'])->name('produk.save');
    Route::get('/produk/{produk}/edit', [App\Http\Controllers\ProdukController::class, 'edit']);
    Route::delete('/produk/{produk}', [App\Http\Controllers\ProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/katagori', [KatagoriController::class, 'index'])->name('katagori');
    Route::get('/katagori/create', [App\Http\Controllers\KatagoriController::class, 'create'])->name('katagori.create');
    Route::post('/katagori/save', [App\Http\Controllers\KatagoriController::class, 'save'])->name('katagori.save');
    Route::get('/katagori/{katagori}/edit', [App\Http\Controllers\KatagoriController::class, 'edit']);

    Route::get('/meja', [App\Http\Controllers\MejaController::class, 'index'])->name('meja');
    Route::get('/meja/create', [App\Http\Controllers\MejaController::class, 'create'])->name('meja.create');
    Route::post('/meja/save', [App\Http\Controllers\MejaController::class, 'save'])->name('meja.save');
    Route::get('/meja/{meja}/edit', [App\Http\Controllers\MejaController::class, 'edit']);

    Route::get('/transaksi', [App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi');
    Route::get('/transaksi/pesanan/{id}', [App\Http\Controllers\TransaksiController::class, 'pesanan'])->name('transaksi.pesanan');
    Route::post('/transaksi/cart', [App\Http\Controllers\TransaksiController::class, 'cart'])->name('transaksi.cart');

    Route::post('/cart/increase', [App\Http\Controllers\CartController::class, 'Increase'])->name('cart.increase');
    Route::post('/cart/decrease', [App\Http\Controllers\CartController::class, 'Decrease'])->name('cart.decrease');
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{cart}', [App\Http\Controllers\CartController::class, 'destroyCart'])->name('cart.delete');
    Route::delete('/cart-all', [App\Http\Controllers\CartController::class, 'destroyAllCart'])->name('cart.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/datatable', [App\Http\Controllers\DatatableController::class, 'index'])->name('datatable');
});

require __DIR__ . '/auth.php';
