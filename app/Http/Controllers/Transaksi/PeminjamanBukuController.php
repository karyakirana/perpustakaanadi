<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamanBukuController extends Controller
{
    public function index()
    {
        return view('pages.peminjaman-index');
    }

    public function create()
    {
        return view('pages.peminjaman-transaksi');
    }

    public function edit($id)
    {
        //
    }

    public function approved()
    {
        //
    }
}
