<?php

namespace App\Http\Livewire\Stock;

use App\Http\Repositories\Transaksi\StockRepository;
use App\Models\Master\Buku;
use App\Models\Stock\BukuStockPerubahan;
use App\Models\Stock\BukuStockPerubahanDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BukuStockTransaksi extends Component
{
    public $pembuat, $tglMasuk, $tglKeluar, $tglPerubahan, $keterangan;
    public $detailStock = [];
    public $idBuku, $kodeBuku, $deskripsiBuku, $jumlahBuku;
    public $update, $indexItem;

    protected $listeners = ['getItemToForm'];

    public function getItemToForm(Buku $buku)
    {
        $this->idBuku = $buku->id;
        $this->kodeBuku = $buku->kode_buku;
        $this->deskripsiBuku = $buku->judul;
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
        $this->detailStock[] = [
            'id'=>$this->idBuku,
            'kodeBuku'=>$this->kodeBuku,
            'judulBuku'=>$this->deskripsiBuku,
            'jumlah'=>$this->jumlahBuku,
        ];
        $this->resetForm();
    }

    public function editItemTable($index)
    {
        $this->update = true;
        $this->indexItem = $index;
        $this->idBuku = $this->detailStock[$index]['id'];
        $this->kodeBuku = $this->detailStock[$index]['kodeBuku'];
        $this->deskripsiBuku = $this->detailStock[$index]['judulBuku'];
        $this->jumlahBuku = $this->detailStock[$index]['jumlah'];
    }

    public function updateItem()
    {
        $index = $this->indexItem;
        $this->detailStock[$index]['id'] = $this->idBuku;
        $this->detailStock[$index]['kodeBuku'] = $this->kodeBuku;
        $this->detailStock[$index]['judulBuku'] = $this->deskripsiBuku;
        $this->detailStock[$index]['jumlah'] = $this->jumlahBuku;
    }

    public function deleteItem($index)
    {
        unset($this->detailStock[$index]);
        $this->detailStock = array_values($this->detailStock);
    }

    public function storeAll()
    {
        $this->validate([
            'tglPerubahan'=>'required|date',
        ]);
        DB::beginTransaction();
        try {
            $stock = BukuStockPerubahan::create([
                'jenis' => (new StockRepository())->kodeStock(),
                'tgl_perubahan' => tanggalan_database_format($this->tglPerubahan, 'd M Y'),
                'pembuat'=> auth()->id(),
                'keterangan' => $this->keterangan,
            ]);
            foreach ($this->detailStock as $row)
            {
                BukuStockPerubahanDetail::create([
                    'stock_perubahan_id'=>$stock->id,
                    'buku_id'=>$row['id'],
                    'jumlah'=>$row['jumlah'],
                ]);
            }
            DB::commit();
            session()->flash('message', 'Data Sudah Disimpan');
            return redirect()->to('/stock');
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            session()->flash('message', 'Data Tidak Bisa Disimpan .<br>Keterangan : <br>'.$e);
        }
    }

    public function mount()
    {
        $this->tglPerubahan = tanggalan_format(now('Asia/Jakarta'));
    }

    public function render()
    {
        return view('livewire.stock.buku-stock-transaksi');
    }
}
