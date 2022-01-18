<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\BukuKategori as BukuKategoriModel;
use Livewire\Component;
use Livewire\WithPagination;

class BukuKategori extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idbuku_kategori;
    public $kode_kategori;
    public $deskripsi;
    public $keterangan;


    protected function kode()
    {
        $idbuku_kategori = BukuKategoriModel::latest('kode_kategori')->first();
        $num = null;
        if(!$idbuku_kategori)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idbuku_kategori->kode_kategori, 1, 5);
            $num = $urutan + 1;
        }
        $id = "K".sprintf("%05s", $num);
        return $id;
    }

    public function simpan(){
        $this->validate([
            'deskripsi'=>'required',
        ]);

        $store = BukuKategoriModel::Create([
            'kode_kategori'=>$this->kode(),
            'deskripsi'=>$this->deskripsi,
            'keterangan'=>$this->keterangan,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function update()
    {
        $this->validate([
            'deskripsi'=>'required',
        ]);

        $store = BukuKategoriModel::where('id', $this->idbuku_kategori['id'])
            ->update([
            'deskripsi'=>$this->deskripsi,
            'keterangan'=>$this->keterangan,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function edit($id)
    {
        $data = BukuKategoriModel::find($id);
        $this->idbuku_kategori = $data->id;
        $this->kode_kategori = $data->kode_kategori;
        $this->deskripsi = $data->deskripsi;
        $this->keterangan = $data->keterangan;
    }

    public function removeData($id)
    {
        BukuKategoriModel::where('id', $id)->delete();
    }

    protected function resetData()
    {
        $this->idbuku_kategori = '';
        $this->keterangan = '';
        $this->deskripsi = '';
        $this->kode_kategori = '';
    }




    public function render()
    {
        return view('livewire.master.buku-kategori',[
            'databuku_kategori'=>BukuKategoriModel::paginate(10),
        ])->layout('layouts.metronics');
    }
}
