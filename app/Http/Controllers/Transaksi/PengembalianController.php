<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        return view('pages.pengembalian-index');
    }

    public function create()
    {
        return view('pages.pengembalian-transaksi');
    }


}
