<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock\BukuStockPerubahan as StockPerubahan;
use Livewire\WithPagination;
use Livewire\Component;

class BukuStockPerubahan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idstock_perubahan;
    public $jenis;
    public $tgl_perubahan;
    public $pembuat;
    public $keterangan;

    protected function kode()
    {
        $idstock_perubahan = StockPerubahan::latest('jenis')->first();
        $num = null;
        if(!$idstock_perubahan)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idstock_perubahan->jenis, 1, 5);
            $num = $urutan + 1;
        }
        $id = "S".sprintf("%05s", $num);
        return $id;
    }

    public function simpan(){
        $this->validate([
            'jenis'=>'required',
            'tgl_perubahan'=>'required',
            'pembuat'=>'required',
            'keterangan'=>'required',
        ]);

        $store = StockPerubahan::updateOrCreate(
            [
                'id'=>$this->idstock_perubahan
            ]
            ,[
            'jenis'=>$this->kode(),
            'tgl_perubahan'=>$this->tgl_perubahan,
            'pembuat'=>$this->pembuat,
            'keterangan'=>$this->keterangan,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function edit($id)
    {
        $data = StockPerubahan::find($id);
        $this->idstock_perubahan = $data->id;
        $this->jenis = $data->jenis;
        $this->tgl_perubahan = $data->tgl_perubahan;
        $this->keterangan = $data->keterangan;
    }

    public function removeData($id)
    {
        StockPerubahan::where('id', $id)->delete();
    }


    public function render()
    {
        return view('livewire.stock.buku-stock-perubahan', [
            'datastock_perubahan'=>StockPerubahan::paginate(10),
        ]);
    }
}
