<?php

namespace App\Http\Repositories\Transaksi;

use App\Models\Transaksi\Peminjaman;

class PeminjamanRepository
{
    public function kodePeminjaman()
    {
        $data = Peminjaman::latest('kode_peminjaman')->first();
        $num = null;
        if (!$data){
            $num = 1;
        } else {
            $urutan = (int) substr($data->kode_peminjaman, 0, 4);
            $num = $urutan + 1;
        }
        return sprintf('%04s', $num)."/BK/".date('Y');
    }
}
