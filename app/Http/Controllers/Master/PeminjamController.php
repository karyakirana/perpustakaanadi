<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        return view('pages.master-peminjam');
    }
}
