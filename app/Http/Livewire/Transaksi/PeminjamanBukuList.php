<?php

namespace App\Http\Livewire\Transaksi;

use App\Models\Transaksi\Peminjaman;
use Livewire\Component;
use Livewire\WithPagination;

class PeminjamanBukuList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idpeminjaman_buku;
    public $kode_peminjaman;
    public $peminjam;
    public $tgl_pinjam;
    public $tgl_kembali;
    public $user_id;
    public $total_bayar;
    public $keterangan;

    protected $messages =[

    ];

    protected function kode()
    {
        $idpeminjaman_buku = Peminjaman::latest('kode_peminjaman')->first();
        $num = null;
        if(!$idpeminjaman_buku)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idpeminjaman_buku->kode_peminjaman, 1, 5);
            $num = $urutan + 1;
        }
        $id = "P".sprintf("%05s", $num);
        return $id;
    }

    public function simpan(){
        $this->validate([
            'kode_peminjaman'=>'required',
            'peminjam'=>'required',
            'tgl_pinjam'=>'required',
            'tgl_kembali'=>'required',
            'user_id'=>'required',
            'total_bayar'=>'required',
            'keterangan'=>'required',
        ]);

        $store = Peminjaman::updateOrCreate(
            [
                'id'=>$this->idpeminjaman_buku
            ]
            ,[
                'kode_peminjaman'=>$this->kode(),
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
        $data = Peminjaman::find($id);
        $this->idpeminjaman_buku = $data->id;
        $this->kode_peminjaman = $data->kode_peminjaman;
        $this->peminjam = $data->peminjam;
        $this->tgl_pinjam = $data->tgl_pinjam;
        $this->tgl_kembali = $data->tgl_kembali;
        $this->user_id = $data->user_id;
        $this->total_bayar = $data->total_bayar;
        $this->keterangan = $data->keterangan;
    }

    public function removeData($id)
    {
        Peminjaman::where('id', $id)->delete();
    }

    public function render()
    {
        return view('livewire.transaksi.peminjaman-buku-list',[
            'datapeminjaman_buku'=>Peminjaman::paginate(10),
        ]);
    }
}
