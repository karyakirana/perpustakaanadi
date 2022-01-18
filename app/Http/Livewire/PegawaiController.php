<?php

namespace App\Http\Livewire;

use App\Models\Master\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;

class PegawaiController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idPegawai;
    public $kode;
    public $nama;
    public $gender;
    public $jenis_pengenal;
    public $pengenal_id;
    public $tempat_lahir;
    public $tgl_lahir;
    public $telepon;
    public $email;
    public $alamat;
    public $keterangan;

    public $successMessage;

    protected $messages = [
        'nama.required'=>'Nama harus diisi.',
        'jenis_pengenal.required'=>'Jenis Pengenal harus diisi.',
        'pengenal_id.required'=>'Nomor Pengenal harus diisi.',
        'alamat.required'=>'Alamat harus diisi.',
        'telepon.required'=>'Nomor Telepon harus diisi.',
    ];

    protected function kode()
    {
        $idPegawai = Pegawai::latest('kode')->first();
        $num = null;
        if(!$idPegawai)
        {
            $num = 1;
        } else {
            $urutan = (int) substr($idPegawai->kode, 1, 5);
            $num = $urutan + 1;
        }
        $id = "P".sprintf("%05s", $num);
        return $id;
    }

    public function simpan(){
        $this->validate([
            'nama'=>'required|max:255',
            'gender'=>'required',
            'jenis_pengenal'=>'required',
            'pengenal_id'=>'required',
            'tempat_lahir'=>'required',
            'tgl_lahir'=>'required',
            'telepon'=>'required',
            'email'=>'required',
            'alamat'=>'required',
            'keterangan'=>'required',
        ]);

        $store = Pegawai::Create([
            'kode'=>$this->kode(),
            'nama'=>$this->nama,
            'gender'=>$this->gender,
            'jenis_pengenal'=>$this->jenis_pengenal,
            'pengenal_id'=>$this->pengenal_id,
            'tempat_lahir'=>$this->tempat_lahir,
            'tgl_lahir'=>$this->tgl_lahir,
            'telepon'=>$this->telepon,
            'email'=>$this->email,
            'alamat'=>$this->alamat,
            'keterangan'=>$this->keterangan,

        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function update(){
        $this->validate([
            'nama'=>'required|max:255',
            'gender'=>'required',
            'jenis_pengenal'=>'required',
            'pengenal_id'=>'required',
            'tempat_lahir'=>'required',
            'tgl_lahir'=>'required',
            'telepon'=>'required',
            'email'=>'required',
            'alamat'=>'required',
        ]);

        $store = Pegawai::where('id', $this->idPegawai['id'])
            ->update([

            'nama'=>$this->nama,
            'gender'=>$this->gender,
            'jenis_pengenal'=>$this->jenis_pengenal,
            'pengenal_id'=>$this->pengenal_id,
            'tempat_lahir'=>$this->tempat_lahir,
            'tgl_lahir'=>$this->tgl_lahir,
            'telepon'=>$this->telepon,
            'email'=>$this->email,
            'alamat'=>$this->alamat,
            'keterangan'=>$this->keterangan,

        ]);
        $this->resetData();
        $this->emit('storeData');
    }

    public function edit($id)
    {
        $data = Pegawai::find($id);
        $this->idPegawai = $data->id;
        $this->kode = $data->kode;
        $this->nama = $data->nama;
        $this->gender = $data->gender;
        $this->jenis_pengenal = $data->jenis_pengenal;
        $this->pengenal_id = $data->pengenal_id;
        $this->tempat_lahir = $data->tempat_lahir;
        $this->tgl_lahir = $data->tgl_lahir;
        $this->telepon = $data->telepon;
        $this->email = $data->email;
        $this->alamat = $data->alamt;
        $this->keterangan = $data->keterangan;

    }

    public function removeData($id)
    {
        Pegawai::where('id', $id)->delete();
    }

    protected function resetData()
    {
        $this->idPegawai = '';
        $this->kode = '';
        $this->nama = '';
        $this->gender = '';
        $this->jenis_pengenal = '';
        $this->pengenal_id = '';
        $this->tempat_lahir = '';
        $this->tgl_lahir = '';
        $this->telepon = '';
        $this->email = '';
        $this->alamat = '';
        $this->keterangan = '';
    }

    public function render()
    {
        return view('livewire.pegawai-controller',[
        'dataPegawai'=>Pegawai::paginate(10),
        ])->layout('layouts.metronics');
    }
}
