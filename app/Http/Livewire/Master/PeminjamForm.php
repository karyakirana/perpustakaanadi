<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Pegawai;
use App\Models\Master\Peminjam;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PeminjamForm extends Component
{
    protected $listeners = [
        'resetForm'=>'resetForm',
        'edit'=>'edit',
        'setUsers'=>'setUsers',
        'destroy'=>'destroy',
    ];

    public $peminjam_id, $kode_peminjam, $nama, $gender, $jenis_pengenal, $pengenal_id;
    public $tempat_lahir, $tgl_lahir, $telepon, $email, $alamat, $keterangan;

    public function render()
    {
        return view('livewire.master.peminjam-form');
    }

    public function resetForm()
    {
        $this->reset([
            'peminjam_id', 'kode_peminjam', 'nama', 'gender', 'jenis_pengenal',
            'pengenal_id', 'tempat_lahir', 'tgl_lahir', 'telepon', 'email', 'alamat', 'keterangan'
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function edit(Peminjam $peminjam)
    {
        $this->peminjam_id = $peminjam->id;
        $this->kode_peminjam = $peminjam->kode;
        $this->nama = $peminjam->nama;
        $this->gender = $peminjam->gender;
        $this->jenis_pengenal = $peminjam->jenis_pengenal;
        $this->pengenal_id = $peminjam->pengenal_id;
        $this->tempat_lahir = $peminjam->tempat_lahir;
        $this->tgl_lahir = $peminjam->tgl_lahir;
        $this->telepon = $peminjam->telepon;
        $this->email = $peminjam->email;
        $this->alamat = $peminjam->alamat;
        $this->keterangan = $peminjam->keterangan;
        $this->emit('showPeminjamModal');
        $this->emit('refreshPeminjamTable');
    }

    public function store()
    {
        $this->validate([
            'nama'=>'required|min:3',
            'gender'=>'required',
            'jenis_pengenal'=>'required',
            'pengenal_id'=>'required|min:3',
            'telepon'=>'required|min:3',
            'email'=>[
                'required',
                Rule::unique('peminjam', 'email')->ignore($this->peminjam_id)
            ]
        ]);

        $store = Peminjam::query()->find($this->peminjam_id)->update([
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

        if ($this->peminjam_id)
        {
            $peminjam = Peminjam::query()->find($this->peminjam_id);
            $users = $peminjam->users();
            if ($users->exists()){
                $users->update([
                    'email'=>$this->email
                ]);
            }
        }
        $this->resetForm();
        $this->emit('hidePeminjamModal');
        $this->emit('refreshPeminjamTable');
    }

    public function destroy($id)
    {
        $peminjam  = Peminjam::query()->find($id);
        $peminjam->users()->delete();
        $peminjam->delete();
    }
}
