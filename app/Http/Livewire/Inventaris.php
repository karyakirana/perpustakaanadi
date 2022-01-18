<?php

namespace App\Http\Livewire;

use App\Models\Stock\Inventaris as InventarisModel;
use Livewire\WithPagination;
use Livewire\Component;

class Inventaris extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idInventaris;
    public $kode_inventaris;
    public $tgl_perolehan;
    public $status;
    public $jenis;
    public $deskripsi;
    public $keterangan;

    protected $messages = [
        'deskripsi.required'=>'Deskripsi harus diisi.',
        'keterangan.required'=>'Keterangan Telepon harus diisi.',
    ];

    protected function kode()
    {
        $idInventaris = InventarisModel::latest('kode_inventaris')->first();
        $num = null;
        if(!$idInventaris)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idInventaris->kode_inventaris, 1, 5);
            $num = $urutan + 1;
        }
        $id = "I".sprintf("%05s", $num);
        return $id;
    }

    public function simpan(){
        $this->validate([
            'jenis'=>'required',
            'tgl_perolehan'=>'required|date',
            'deskripsi'=>'required',
            'keterangan'=>'required',
        ]);

        $store = InventarisModel::Create([
            'kode_inventaris'=>$this->kode(),
            'tgl_perolehan'=>tanggalan_database_format($this->tgl_perolehan, 'd M Y'),
            'status'=>$this->status,
            'jenis'=>$this->jenis,
            'deskripsi'=>$this->deskripsi,
            'keterangan'=>$this->keterangan,
        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function update(){
        $this->validate([
            'jenis'=>'required',
            'deskripsi'=>'required',
            'keterangan'=>'required',
        ]);

        $store = InventarisModel::where('id', $this->idInventaris['id'])
            ->update([

                'tgl_perolehan'=>$this->tgl_perolehan,
                'status'=>$this->status,
                'jenis'=>$this->jenis,
                'deskripsi'=>$this->deskripsi,
                'keterangan'=>$this->keterangan,
            ]);
        $this->resetData();
        $this->emit('storeData');
    }


    public function edit($id)
    {
        $data = InventarisModel::find($id);
        $this->idInventaris = $data->id;
        $this->kode_inventaris = $data->kode_inventaris;
        $this->tgl_perolehan = $data->tgl_perolehan;
        $this->status = $data->status;
        $this->jenis = $data->jenis;
        $this->deskripsi = $data->deskripsi;
        $this->keterangan = $data->keterangan;
    }

    public function removeData($id)
    {
        InventarisModel::where('id', $id)->delete();
    }

    protected function resetData()
    {
        $this->idInventaris = '';
        $this->tgl_perolehan = '';
        $this->status = '';
        $this->jenis = '';
        $this->deskripsi = '';
        $this->keterangan = '';
    }
    public function mount()
    {
        $this->tgl_perolehan = tanggalan_format(now('Asia/Jakarta'));
    }

    public function render()
    {
        return view('livewire.inventaris',[
            'datainventaris'=>InventarisModel::paginate(10),
        ])->layout('layouts.metronics');
    }
}
