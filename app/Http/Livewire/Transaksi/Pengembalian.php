<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Transaksi\Pengembalian as PengembalianBuku;
use Livewire\Component;
use Livewire\WithPagination;

class Pengembalian extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idpengembalian_buku;
    public $kode_pengembalian;
    public $peminjam;
    public $tgl_pinjam;
    public $tgl_kembali;
    public $user_id;
    public $total_bayar;
    public $keterangan;

    protected function kode()
    {
        $idpengembalian_buku = PengembalianBuku::latest('kode_pengembalian')->first();
        $num = null;
        if(!$idpengembalian_buku)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idpengembalian_buku->kode_pengembalian, 1, 5);
            $num = $urutan + 1;
        }
        $id = "K".sprintf("%05s", $num);
        return $id;
    }

    public function simpan(){
        $this->validate([
            'kode_pengembalian'=>'required',
            'peminjam'=>'required',
            'tgl_pinjam'=>'required',
            'tgl_kembali'=>'required',
            'user_id'=>'required',
            'total_bayar'=>'required',
            'keterangan'=>'required',
        ]);

        $store = PengembalianBuku::updateOrCreate(
            [
                'id'=>$this->idpengembalian_buku
            ]
            ,[
            'kode_pengembalian'=>$this->kode(),
            'peminjam'=>$this->peminjam,
            'tgl_pinjam'=>$this->tgl_pinjam,
            'tgl_kembali'=>$this->tgl_kembali,
            'user_id'=>$this->user_id,
            'total_bayar'=>$this->total_bayar,
            'keterangan'=>$this->keterangan,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function edit($id)
    {
        $data = PengembalianBuku::find($id);
        $this->idpengembalian_buku = $data->id;
        $this->kode_pengembalian = $data->kode_pengembalian;
        $this->peminjam = $data->peminjam;
        $this->tgl_pinjam = $data->tgl_pinjam;
        $this->tgl_kembali = $data->tgl_kembali;
        $this->total_bayar = $data->total_bayar;
        $this->keterangan = $data->keterangan;
    }

    public function removeData($id)
    {
        PengembalianBuku::where('id', $id)->delete();
    }



    public function render()
    {
        return view('livewire.transaksi.pengembalian',[
            'datapengembalian_buku'=>PengembalianBuku::paginate(10),
        ]);
    }
}
