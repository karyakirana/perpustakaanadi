<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\Buku as BukuModel;
use App\Models\Master\BukuKategori;
use function Symfony\Component\Translation\t;

class Buku extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idBuku;
    public $kode_buku;
    public $kategori_id;
    public $penerbit;
    public $penulis;
    public $isbn;
    public $judul;
    public $harga_sewa;
    public $keterangan;

    protected $messages = [
        'kategori_id'=>'Kategori harus diisi.',
        'judul.required'=>'Alamat harus diisi.',
        'isbn.required'=>'Nomor Telepon harus diisi.',
    ];

    protected function kode()
    {
        $idBuku = BukuModel::latest('kode_buku')->first();
        $num = null;
        if(!$idBuku)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idBuku->kode_buku, 1, 5);
            $num = $urutan + 1;
        }
        $id = "B".sprintf("%05s", $num);
        return $id;
    }


    public function simpan(){
        $this->validate([
            'judul'=>'required',
            'harga_sewa'=>'required',
            'penerbit'=>'required',
            'penulis'=>'required',
            'isbn'=>'required',
        ]);

        $store = BukuModel::Create([
            'kode_buku'=>$this->kode(),
            'kategori_id'=>$this->kategori_id,
            'penerbit'=>$this->penerbit,
            'penulis'=>$this->penulis,
            'isbn'=>$this->isbn,
            'judul'=>$this->judul,
            'harga_sewa'=>$this->harga_sewa,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function update(){
        $this->validate([
            'judul'=>'required',
            'harga_sewa'=>'required',
            'penerbit'=>'required',
            'penulis'=>'required',
            'isbn'=>'required',
        ]);

        $store = BukuModel::where('id', $this->idBuku['id'])
            ->update([

            'penerbit'=>$this->penerbit,
            'penulis'=>$this->penulis,
            'isbn'=>$this->isbn,
            'judul'=>$this->judul,
            'harga_sewa'=>$this->harga_sewa,
            'keterangan'=>$this->keterangan,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }


    public function edit($id)
    {
        $data = BukuModel::find($id);
        $this->idBuku = $data->id;
        $this->kode_buku = $data->kode_buku;
        $this->kategori_id = $data->kategori_id;
        $this->penerbit = $data->penerbit;
        $this->penulis = $data->penulis;
        $this->isbn = $data->isbn;
        $this->judul = $data->judul;
        $this->harga_sewa = $data->harga_sewa;
        $this->keterangan = $data->keterangan;
    }

    public function removeData($id)
    {
        BukuModel::where('id', $id)->delete();
    }

    protected function resetData()
    {
        $this->idBuku = '';
        $this->kategori_id = '';
        $this->penulis = '';
        $this->penerbit = '';
        $this->kode_buku = '';
        $this->isbn = '';
        $this->judul = '';
        $this->harga_sewa = '';
        $this->keterangan = '';
    }

    public function render()
    {
        return view('livewire.master.buku',[
            'databuku'=>BukuModel::paginate(10),
            'databuku_kategori'=>BukuKategori::all(),
        ])->layout('layouts.metronics');
    }
}
