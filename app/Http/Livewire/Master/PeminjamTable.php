<?php

namespace App\Http\Livewire\Master;

use App\Http\Repositories\Master\PeminjamRepository;
use App\Models\Master\Peminjam;
use Livewire\Component;
use Livewire\WithPagination;

class PeminjamTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $formPeminjam = [];

    protected $messages = [
        'formPeminjam.nama.required'=>'Nama harus diisi.',
        'formPeminjam.jenis.required'=>'Jenis Pengenal harus diisi.',
        'formPeminjam.pengenal.required'=>'Nomor Pengenal harus diisi.',
        'formPeminjam.gender.required'=>'Gender harus diisi.',
        'formPeminjam.telepon.required'=>'Nomor Telepon harus diisi.',
    ];

    public function render()
    {
        return view('livewire.master.peminjam-table' ,[
            'datapeminjam'=>Peminjam::paginate(10),
        ]);
    }

    protected function kode()
    {
        $idCustomer = Peminjam::latest('kode_peminjam')->first();
        $num = null;
        if(!$idCustomer)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idCustomer->kode_peminjam, 1, 5);
            $num = $urutan + 1;
        }
        $id = "C".sprintf("%05s", $num);
        return $id;
    }

    protected function resetForm()
    {
        $this->formPeminjam['id']='';
        $this->formPeminjam['nama']='';
        $this->formPeminjam['jenis']='';
        $this->formPeminjam['pengenal']='';
        $this->formPeminjam['gender']='';
        $this->formPeminjam['tempatLahir']='';
        $this->formPeminjam['tglLahir']='';
        $this->formPeminjam['telepon']='';
        $this->formPeminjam['email']='';
        $this->formPeminjam['alamat']='';
        $this->formPeminjam['keterangan']='';
    }

    public function store()
    {
        $this->validate([
            'formPeminjam.nama'=>'required',
            'formPeminjam.jenis'=>'required',
            'formPeminjam.pengenal'=>'required|unique:peminjam,pengenal_id',
            'formPeminjam.gender'=>'required',
            'formPeminjam.telepon'=>'required',
        ]);
        Peminjam::create([
            'kode_peminjam'=>$this->kode(),
            'nama'=>$this->formPeminjam['nama'],
            'gender'=>$this->formPeminjam['gender'],
            'jenis_pengenal'=>$this->formPeminjam['jenis'],
            'pengenal_id'=>$this->formPeminjam['pengenal'],
            'tempat_lahir'=>$this->formPeminjam['tempatLahir'],
            'tgl_lahir'=>$this->formPeminjam['tglLahir'],
            'telepon'=>$this->formPeminjam['telepon'],
            'email'=>$this->formPeminjam['email'],
            'alamat'=>$this->formPeminjam['alamat'],
            'keterangan'=>$this->formPeminjam['keterangan'],
        ]);
        $this->resetForm();
        $this->emit('modalHide');
    }

    public function update()
    {
        $this->validate([
            'formPeminjam.id'=>'required',
            'formPeminjam.nama'=>'required',
            'formPeminjam.jenis'=>'required',
            'formPeminjam.gender'=>'required',
            'formPeminjam.telepon'=>'required',
        ]);

        Peminjam::where('id', $this->formPeminjam['id'])
            ->update([
                'nama'=>$this->formPeminjam['nama'],
                'gender'=>$this->formPeminjam['gender'],
                'jenis_pengenal'=>$this->formPeminjam['jenis'],
                'pengenal_id'=>$this->formPeminjam['pengenal'],
                'tempat_lahir'=>$this->formPeminjam['tempatLahir'],
                'tgl_lahir'=>$this->formPeminjam['tglLahir'],
                'telepon'=>$this->formPeminjam['telepon'],
                'email'=>$this->formPeminjam['email'],
                'alamat'=>$this->formPeminjam['alamat'],
                'keterangan'=>$this->formPeminjam['keterangan'],
            ]);
        $this->resetForm();
        $this->emit('modalHide');
    }
}
