<?php

namespace App\Http\Repositories\Master;

use App\Models\Master\Peminjam;

class PeminjamRepository
{
    public function kode()
    {
        $idCustomer = Peminjam::latest('kode_peminjam')->first();
        $num = null;
        if(!$idCustomer)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idCustomer->kode_peminjam, 1, 5);
            $num = $urutan + 1;
        }
        $id = "C".sprintf("%05s", $num);
        return $id;
    }
}
