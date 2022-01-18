<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockPerubahanController extends Controller
{
    public function index()
    {
        return view('pages.stock-index');
    }

    public function create()
    {
        return view('pages.stock-transaksi');
    }
}
