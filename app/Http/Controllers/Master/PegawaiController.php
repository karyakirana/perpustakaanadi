<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pages.pegawai-index');
    }
    public function datatables()
    {
        // data pegawai dan user
    }
    // buat user dengan nama pegawai
}
