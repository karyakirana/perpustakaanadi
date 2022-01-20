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

    public function datatables()
    {
        // daftar datatables peminjam approved
        $data = Peminjam::query()
            ->latest('kode')->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($item){
                $edit = '<button></button>';
                $delete = '';
                return $edit.$delete;
            })
            ->rawColumns(['actions'])
            ->make('true');
    }

    public function create()
    {
        // approval users
    }

    public function datatablesNonApproved()
    {
        // daftar datatables peminjam semua
    }
}
