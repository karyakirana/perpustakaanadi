<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Master\Peminjam;
use Livewire\Component;

class PeminjamTable extends Component
{
    public function render()
    {
        return view('livewire.transaksi.peminjam-table', [
            'dataPeminjam'=>Peminjam::paginate(10)
        ]);
    }

    public function setPeminjamToForm($id)
    {
        $this->emit('getPeminjamToForm', $id);
    }
}
