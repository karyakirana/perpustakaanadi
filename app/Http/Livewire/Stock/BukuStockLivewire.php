<?php

namespace App\Http\Livewire\Stock;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Stock\BukuStock;

class BukuStockLivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idBukuStock;
    public $buku_id;
    public $jumlah;

    protected $messages = [
        'buku_id.required'=>'Kode harus diisi.',
    ];


    public function simpan(){
        $this->validate([
            'buku_id'=>'required',
            'jumlah'=>'required',
        ]);

        $store = BukuStock::updateOrCreate(
            [
                'id'=>$this->idBukuStock
            ]
            ,[
            'buku_id'=>$this->buku_id,
            'jumlah'=>$this->jumlah,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function edit($id)
    {
        $data = BukuStock::find($id);
        $this->idBukuStock = $data->id;
        $this->buku_id = $data->buku_id;
        $this->jumlah = $data->jumlah;

    }

    public function removeData($id)
    {
        BukuStock::where('id', $id)->delete();
    }

    protected function resetData()
    {
        $this->idBukuStock = '';
        $this->buku_id = '';
        $this->jumlah= '';

    }




    public function render()
    {
        return view('livewire.stock.buku-stock-livewire',[
            'dataBukuStock'=>BukuStock::paginate(10)],[
        ])->layout('layouts.metronics');
    }

}
