<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Component;

class PegawaiForm extends Component
{
    // listener
    protected $listeners = [
        'resetForm'=>'resetForm',
        'edit'=>'edit',
        'setUsers'=>'setUsers',
        'destroy'=>'destroy',
    ];

    // for pegawai table
    public $pegawai_id, $kode, $nama, $gender, $jenis_pengenal, $pengenal_id;
    public $tempat_lahir, $tgl_lahir, $telepon, $email, $alamat, $keterangan;

    // for users table
    public $username, $role, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.master.pegawai-form');
    }

    protected function kode()
    {
        $pegawai = Pegawai::latest('kode')->first();
        if (!$pegawai){
            $num = 1;
        } else {
            $lastNum = (int) $pegawai->last_num_kode;
            $num = $lastNum + 1;
        }
        return "P".sprintf("%05s", $num);
    }

    public function resetForm()
    {
        $this->reset([
            'pegawai_id', 'kode', 'nama', 'gender', 'jenis_pengenal',
            'pengenal_id', 'tempat_lahir', 'tgl_lahir', 'telepon', 'email', 'alamat', 'keterangan'
        ]);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function addData()
    {
        $this->emit('showPegawaiModal');
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
                Rule::unique('pegawai', 'email')->ignore($this->pegawai_id)
            ]
        ]);
        $store = Pegawai::query()
            ->updateOrCreate(
                [
                    'id'=>$this->pegawai_id
                ],
                [
                    'kode'=> $this->kode(),
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
                ]
            );

        if ($this->pegawai_id)
        {
            $pegawai = Pegawai::query()->find($this->pegawai_id);
            $users = $pegawai->users();
            if ($users->exists()){
                $users->update([
                    'email'=>$this->email
                ]);
            }
        }
        $this->resetForm();
        $this->emit('hidePegawaiModal');
        $this->emit('refreshPegawaiTable');
    }

    public function edit(Pegawai $pegawai)
    {
        $this->pegawai_id = $pegawai->id;
        $this->kode = $pegawai->kode;
        $this->nama = $pegawai->nama;
        $this->gender = $pegawai->gender;
        $this->jenis_pengenal = $pegawai->jenis_pengenal;
        $this->pengenal_id = $pegawai->pengenal_id;
        $this->tempat_lahir = $pegawai->tempat_lahir;
        $this->tgl_lahir = $pegawai->tgl_lahir;
        $this->telepon = $pegawai->telepon;
        $this->email = $pegawai->email;
        $this->alamat = $pegawai->alamat;
        $this->keterangan = $pegawai->keterangan;
        $this->emit('showPegawaiModal');
        $this->emit('refreshPegawaiTable');
    }

    public function setUsers($id)
    {
        $this->pegawai_id = $id;
        $pegawai = Pegawai::query()->find($id);
        if ($pegawai->users()->count() > 0)
        {
            $users = $pegawai->users;
            $this->username = $users->username;
            $this->role = $users->role;
        }
        $this->emit('showUsersModal');
    }

    public function storeUsers()
    {
        $pegawai = Pegawai::query()->find($this->pegawai_id);
        $users = $pegawai->users();
//        dd($pegawai->users->id);

        if ($users->count() == 0)
        {
            $this->validate([
                'username'=>['required', Rule::unique('users','username')],
                'role'=>'required',
                'password'=>['required']
            ]);

            $users->create([
                'name'=>$pegawai->nama,
                'username'=>$this->username,
                'email'=>$pegawai->email,
                'password'=>Hash::make($this->password),
                'role'=>$this->role,
            ]);
        }
        else
        {
            $this->validate([
                'username'=>['required', Rule::unique('users','username')->ignore($pegawai->users->id)],
                'role'=>'required',
            ]);

            if ($this->password){
                $users->update([
                    'username'=>$this->username,
                    'password'=>Hash::make($this->password),
                    'role'=>$this->role,
                ]);
            } else {
                $users->update([
                    'username'=>$this->username,
                    'role'=>$this->role,
                ]);
            }

        }
        $this->reset(['pegawai_id', 'password', 'password_confirmation', 'username', 'role']);

        $this->emit('hideUsersModal');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::query()->find($id);
        $pegawai->users()->delete();
        $pegawai->delete();
        $this->emit('refreshPegawaiTable');
    }

    public function updateUsers()
    {
        $this->emit('hideUsersModal');
    }
}
