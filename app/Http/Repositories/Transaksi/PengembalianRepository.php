<?php

namespace App\Http\Repositories\Transaksi;

use App\Models\Transaksi\Pengembalian;

class PengembalianRepository
{
    public function kodePengembalian()
    {
        $data = Pengembalian::latest('kode_pengembalian')->first();
        $num = null;
        if (!$data){
            $num = 1;
        } else {
            $urutan = (int) substr($data->kode_pengembalian, 0, 4);
            $num = $urutan + 1;
        }
        return sprintf('%04s', $num)."/BM/".date('Y');
    }
}
