<?php

namespace App\Http\Repositories\Transaksi;

use App\Models\Stock\BukuStockPerubahan;

class StockRepository
{
    public function kodeStock()
    {
        $data = BukuStockPerubahan::latest('jenis')->first();
        $num = null;
        if (!$data){
            $num = 1;
        } else {
            $urutan = (int) substr($data->jenis, 0, 4);
            $num = $urutan + 1;
        }
        return sprintf('%04s', $num)."/SB/".date('Y');
    }
}
