<?php

namespace App\Http\Livewire\Transaksi;

use App\Http\Repositories\Transaksi\PeminjamanRepository;
use App\Models\Master\Buku;
use App\Models\Master\Peminjam;
use App\Models\Transaksi\Peminjaman;
use App\Models\Transaksi\PeminjamanDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PeminjamanBukuTransaction extends Component
{
    public $customerId, $customer, $pembuat, $tglPinjam, $tglKembali, $keterangan;
    public $detailPeminjaman = [];
    public $idBuku, $kodeBuku, $deskripsiBuku, $jumlahBuku;
    public $update, $indexItem;

    protected $listeners = ['getItemToForm', 'getPeminjamToForm'];

    public function getItemToForm(Buku $buku)
    {
        // dd($buku);
        $this->idBuku = $buku->id;
        $this->kodeBuku = $buku->kode_buku;
        $this->deskripsiBuku = $buku->judul;
    }

    public function getPeminjamToForm(Peminjam $peminjam)
    {
        $this->customerId = $peminjam->id;
        $this->customer = $peminjam->nama;
    }

    public function resetForm()
    {
        $this->idBuku = '';
        $this->kodeBuku = '';
        $this->deskripsiBuku = '';
        $this->jumlahBuku = '';
    }

    public function setItemToTable()
    {
        $this->detailPeminjaman[] = [
            'id'=>$this->idBuku,
            'kodeBuku'=>$this->kodeBuku,
            'judulBuku'=>$this->deskripsiBuku,
            'jumlah'=>$this->jumlahBuku
        ];
        $this->resetForm();
    }

    public function editItemTable($index)
    {
        $this->update = true;
        $this->indexItem = $index;
        $this->idBuku = $this->detailPeminjaman[$index]['id'];
        $this->kodeBuku = $this->detailPeminjaman[$index]['kodeBuku'];
        $this->deskripsiBuku = $this->detailPeminjaman[$index]['judulBuku'];
        $this->jumlahBuku = $this->detailPeminjaman[$index]['jumlah'];
    }

    public function updateItem()
    {
        $index = $this->indexItem;
        $this->detailPeminjaman[$index]['id'] = $this->idBuku;
        $this->detailPeminjaman[$index]['kodeBuku'] = $this->kodeBuku;
        $this->detailPeminjaman[$index]['judulBuku'] = $this->deskripsiBuku;
        $this->detailPeminjaman[$index]['jumlah'] = $this->jumlahBuku;
        $this->resetForm();
        unset($this->update);
    }

    public function deleteItem($index)
    {
        unset($this->detailPeminjaman[$index]);
        $this->detailPeminjaman = array_values($this->detailPeminjaman);
    }

    public function storeAll()
    {
        $this->validate([
            'customerId'=>'required',
            'tglPinjam'=>'required|date',
            'tglKembali'=>'required|date',
        ]);
        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::create([
                'kode_peminjaman'=>(new PeminjamanRepository())->kodePeminjaman(),
                'status'=>'pending',
                'peminjam'=>$this->customerId,
                'tgl_pinjam'=>tanggalan_database_format($this->tglPinjam, 'd M Y'),
                'tgl_kembali'=>tanggalan_database_format($this->tglKembali, 'd M Y'),
                'user_id'=>auth()->id(),
                'total_bayar'=>0,
                'keterangan'=>$this->keterangan,
            ]);

            foreach ($this->detailPeminjaman as $row)
            {
                PeminjamanDetail::create([
                    'peminjaman_id'=>$peminjaman->id,
                    'buku_id'=>$row['id'],
                    'jumlah'=>$row['jumlah'],
                    'harga_sewa'=>0,
                    'sub_total'=>0,
                ]);
            }
            DB::commit();
            session()->flash('message', 'Data Sudah Disimpan.');
            return redirect()->to('/peminjaman');
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            session()->flash('message', 'Data Tidak Bisa Disimpan.<br>Keterangan : <br>'.$e);
        }
    }

    public function mount()
    {
        $this->tglPinjam = tanggalan_format(now('Asia/Jakarta'));
        $this->tglKembali = tanggalan_format(now('Asia/Jakarta')->addDay(3));
    }

    public function render()
    {
        return view('livewire.transaksi.peminjaman-buku-transaction');
    }
}
