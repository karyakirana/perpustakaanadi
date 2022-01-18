<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Master\Buku;
use Livewire\Component;

class BukuTable extends Component
{
    public function render()
    {
        return view('livewire.transaksi.buku-table', [
            'dataBuku'=>Buku::paginate(10),
        ]);
    }

    public function setItemToForm($idBuku)
    {
        $this->emit('getItemToForm', $idBuku);
    }
}
