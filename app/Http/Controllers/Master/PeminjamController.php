<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Peminjam;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeminjamController extends Controller
{
    public function index()
    {
        return view('pages.peminjaman-index');
    }

    public function indexNonApproved()
    {
        return view('pages.dashboard-user-nonapproved');
    }

    public function create()
    {
        // approval users
    }
}
