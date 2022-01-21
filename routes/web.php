<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function (){

    // dashboard
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('master/pegawai', [\App\Http\Controllers\Master\PegawaiController::class, 'index'])->name('pegawai');
    Route::get('master/peminjam', [\App\Http\Controllers\Master\PeminjamController::class, 'index'])->name('peminjam');
    Route::get('master/peminjam/nonapproved', [\App\Http\Controllers\Master\PeminjamController::class, 'indexNonApproved'])->name('peminjam.nonapproved');
    Route::get('master/buku/kategori', \App\Http\Livewire\Master\BukuKategori::class);
    Route::get('master/buku', \App\Http\Livewire\Master\Buku::class);
    Route::get('transaksi/buku/stock', \App\Http\Livewire\Stock\BukuStockLivewire::class);
    Route::get('transaksi/denda', \App\Http\Livewire\Master\DendaLivewire::class);

    Route::get('transaksi/peminjaman', [\App\Http\Controllers\Transaksi\PeminjamanBukuController::class, 'index'])->name('peminjaman.index');
    Route::get('transaksi/peminjaman/new', [\App\Http\Controllers\Transaksi\PeminjamanBukuController::class, 'create'])->name('peminjamannew.index');

    Route::get('transaksi/pengembalian', [\App\Http\Controllers\Transaksi\PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('transaksi/pengembalian/new', [\App\Http\Controllers\Transaksi\PengembalianController::class, 'create'])->name('pengembaliannew.index');
    Route::get('manajemen/stock', [\App\Http\Controllers\Transaksi\StockPerubahanController::class,'index'])->name('stock.index');
    Route::get('manajemen/stock/perubahan', [\App\Http\Controllers\Transaksi\StockPerubahanController::class,'create'])->name('stockperubahan.index');
    Route::get('manajemen/inventaris',\App\Http\Livewire\Inventaris::class);

});


Route::get('/login', [\App\Http\Controllers\Custom\AuthController::class, 'index'])->name('login')
    ->middleware('guest');
Route::post('/login', [\App\Http\Controllers\Custom\AuthController::class, 'signin']);

Route::get('/register', [\App\Http\Controllers\Custom\AuthController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Custom\AuthController::class, 'register']);

Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

//require __DIR__.'/auth.php';
//require __DIR__.'/master.php';
