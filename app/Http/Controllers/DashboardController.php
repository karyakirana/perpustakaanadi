<?php

namespace App\Http\Controllers;

use App\Models\Master\Buku;
use App\Models\Master\Pegawai;
use App\Models\Master\Peminjam;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // dashboard admin
        if (Auth::user()->role != 'pegawai'){
            return redirect()->to('dashboard/'.Auth::user()->role);
        }
        return view('pages.dashboard', [
            'jumlah_koleksi_buku'=>Buku::query()->count(),
            'jumlah_pegawai'=>Pegawai::query()->count(),
            'jumlah_peminjam'=>Peminjam::query()->count(),
            'peminjaman'=>Peminjaman::query()
                ->with(['peminjamPerson'])
                ->latest('kode_peminjaman')
                ->limit(10)->get(),
            'pengembalian'=>Pengembalian::query()
                ->with(['peminjamPerson'])
                ->latest('kode_pengembalian')
                ->limit(10)->get(),

        ]);
    }

    public function siswa()
    {
        // dashboard siswa approve
        return view('pages.dashboard-user-approved',[
            'jumlah_koleksi_buku'=>Buku::query()->count(),
            'jumlah_pegawai'=>Pegawai::query()->count(),
            'jumlah_peminjam'=>Peminjam::query()->count(),
            'peminjaman'=>Peminjaman::query()
                ->with(['peminjamPerson'])
                ->latest('kode_peminjaman')
                ->limit(10)->get(),
            'pengembalian'=>Pengembalian::query()
                ->with(['peminjamPerson'])
                ->latest('kode_pengembalian')
                ->limit(10)->get(),

        ]);
    }

    public function siswaNonApproved()
    {
        // dashboard siswa non approve
        return view('pages.dashboard-user-nonapproved');
    }
}
