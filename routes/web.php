<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokInController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\KembaliController;
use App\Http\Controllers\StokOutController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\PeminjamanController;

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
//     return view('welcome');
// });

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'dologin']);
    Route::post('/register', [RegisterController::class, 'index']);
    Route::post('/register/create', [RegisterController::class, 'store']);

});

Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/redirect', [RedirectController::class, 'cek']);
Auth::routes();

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'checkrole:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // kategori
    Route::resource('kategori', KategoriController::class);

    // stok masuk
    Route::prefix('stokIn')->group(function () {
        Route::get('/export-excel', [StokInController::class, 'exportExcel'])->name('stokIn.export');
        Route::get('/export-pdf', [StokInController::class, 'exportPdf'])->name('stokIn.exportPdf');
    });
    Route::resource('stokIn', StokInController::class);

    // stok keluar
    Route::prefix('stokOut')->group(function () {
        Route::get('/export-excel', [StokOutController::class, 'exportExcel'])->name('stokOut.export');
        Route::get('/export-pdf', [StokOutController::class, 'exportPdf'])->name('stokOut.exportPdf');
    });
    Route::resource('stokOut', StokOutController::class);

    // stok total
    Route::prefix('stok')->group(function () {
        Route::get('/export-excel', [StokController::class, 'exportExcel'])->name('stok.export');
        Route::get('/export-pdf', [StokController::class, 'exportPdf'])->name('stok.exportPdf');
    });
    Route::resource('stok', StokController::class);

    // produk
    Route::prefix('produk')->group(function () {
        Route::get('/export-excel', [ProdukController::class, 'exportExcel'])->name('produk.export');
        Route::get('/export-pdf', [ProdukController::class, 'exportPdf'])->name('produk.exportPdf');
    });
    Route::resource('produk', ProdukController::class);

    Route::resource('tempat', TempatController::class);
    Route::resource('peminjaman', PinjamController::class);
    // Route::resource('pengembalian', KembaliController::class);
    Route::prefix('pengembalian')->group(function () {
        Route::get('/', [PinjamController::class, 'pengembalianIndex'])->name('pengembalian.index');
        Route::get('edit/{id}', [PinjamController::class, 'pengembalianEdit'])->name('pengembalian.edit');
        Route::put('/{id}', [PinjamController::class, 'pengembalian'])->name('pengembalian.update');
    });
});

Route::group(['prefix' => '/guru', 'middleware' => ['auth', 'checkrole:user']], function(){
    Route::get('dashboard', [GuruDashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('peminjamanguru', PeminjamanController::class);

    Route::prefix('pinjam')->group(function () {
        Route::get('/export-excel', [PeminjamanController::class, 'exportExcel'])->name('pinjam.export');
        Route::get('/export-pdf', [PeminjamanController::class, 'exportPdf'])->name('pinjam.exportPdf');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
