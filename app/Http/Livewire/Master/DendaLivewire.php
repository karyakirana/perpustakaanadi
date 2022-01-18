<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\Denda;
use function Couchbase\defaultEncoder;

class DendaLivewire extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $idDenda;
    public $kode_denda;
    public $deskripsi;
    public $nominal;
    public $keterangan;

    protected function kode()
    {
        $idDenda = Denda::latest('kode_denda')->first();
        $num = null;
        if(!$idDenda)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idDenda->kode_denda, 1, 5);
            $num = $urutan + 1;
        }
        $id = "D".sprintf("%05s", $num);
        return $id;
    }

    public function simpan(){
        $this->validate([
            'deskripsi'=>'required',
            'nominal'=>'required',
            'keterangan'=>'required',
        ]);

        $store = Denda::Create([
            'kode_denda'=>$this->kode(),
            'deskripsi'=>$this->deskripsi,
            'nominal'=>$this->nominal,
            'keterangan'=>$this->keterangan,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function update()
    {
        $this->validate([
            'deskripsi'=>'required',
            'nominal'=>'required',
            'keterangan'=>'required',
        ]);

        $store = Denda::where('id', $this->idDenda['id'])
            ->update([
                'deskripsi'=>$this->deskripsi,
                'keterangan'=>$this->keterangan,
            ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function edit($id)
    {
        $data = Denda::find($id);
        $this->idDenda = $data->id;
        $this->kode_denda = $data->kode_kategori;
        $this->deskripsi = $data->deskripsi;
        $this->nominal = $data->nominal;
        $this->keterangan = $data->keterangan;
    }

    public function removeData($id)
    {
        Denda::where('id', $id)->delete();
    }

    protected function resetData()
    {
        $this->idDenda = '';
        $this->keterangan = '';
        $this->deskripsi = '';
        $this->kode_denda = '';
        $this->nominal = '';
    }




    public function render()
    {
        return view('livewire.master.denda-livewire',[
            'dataDenda'=>Denda::paginate(10),
        ])->layout('layouts.metronics');
    }
}
