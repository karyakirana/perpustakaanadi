<?php

namespace App\Http\Livewire\Transaksi;

use App\Http\Repositories\Transaksi\PengembalianRepository;
use App\Models\Master\Buku;
use App\Models\Master\Peminjam;
use App\Models\Transaksi\Pengembalian;
use App\Models\Transaksi\PengembalianDetail as PengembalianDetailModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PengembalianDetail extends Component
{
    public $customerId, $customer, $pembuat, $tglPinjam, $tglKembali, $keterangan;
    public $detailPengembalian = [];
    public $idBuku, $kodeBuku, $deskripsiBuku, $jumlahBuku;
    public $update, $indexItem;

    protected $listeners = ['getItemToForm', 'getPeminjamToForm'];

    public function getItemToForm(Buku $buku)
    {
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
        $this->detailPengembalian[] = [
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
        $this->idBuku = $this->detailPengembalian[$index]['id'];
        $this->kodeBuku = $this->detailPengembalian[$index]['kodeBuku'];
        $this->deskripsiBuku = $this->detailPengembalian[$index]['judulBuku'];
        $this->jumlahBuku = $this->detailPengembalian[$index]['jumlah'];
    }

    public function updateItem()
    {
        $index = $this->indexItem;
        $this->detailPengembalian[$index]['id'] = $this->idBuku;
        $this->detailPengembalian[$index]['kodeBuku'] = $this->kodeBuku;
        $this->detailPengembalian[$index]['judulBuku'] = $this->deskripsiBuku;
        $this->detailPengembalian[$index]['jumlah'] = $this->jumlahBuku;
    }

    public function deleteItem($index)
    {
        unset($this->detailPengembalian[$index]);
        $this->detailPengembalian = array_values($this->detailPengembalian);
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
            $pengembalian = Pengembalian::create([
                'kode_pengembalian' => (new PengembalianRepository())->kodePengembalian(),
                'peminjam' => $this->customerId,
                'tgl_pinjam' => tanggalan_database_format($this->tglPinjam, 'd M Y'),
                'tgl_kembali' => tanggalan_database_format($this->tglKembali, 'd M Y'),
                'user_id' => auth()->id(),
                'total_bayar' => 0,
                'keterangan' => $this->keterangan,
                ]);
            foreach ($this->detailPengembalian as $row)
            {
                PengembalianDetailModel::insert([
                   'pengembalian_id'=>$pengembalian->id,
                    'buku_id'=>$row['id'],
                    'jumlah'=>$row['jumlah'],
                    'denda'=>0,
                    'sub_total'=>0,
                ]);
            }
            DB::commit();
            session()->flash('message', 'Data Sudah Disimpan');
            return redirect()->to('/pengembalian');
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            session()->flash('message', 'Data Tidak Bisa Disimpan .<br>Keterangan : <br>'.$e);
        }
    }

    public function mount()
    {
        $this->tglPinjam = tanggalan_format(now('Asia/Jakarta'));
        $this->tglKembali = tanggalan_format(now('Asia/Jakarta')->addDay(5));
    }


    public function render()
    {
        return view('livewire.transaksi.pengembalian-detail');
    }
}
