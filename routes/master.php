<?php

use Illuminate\Support\Facades\Route;

Route::get('/master/peminjam', [\App\Http\Controllers\Master\PeminjamController::class, 'index'])->name('master.peminjam');
