<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Pegawai;
use App\Models\Master\Peminjam;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PeminjamNonApprovedForm extends Component
{
    protected $listeners = [
        'setApproved'=>'setApproved',
        'setPegawai'=>'setPegawai',
        'destroy'=>'destroy'
    ];

    public $peminjam_id, $kode_peminjam, $jenis_pengenal, $pengenal_id, $gender, $tempat_lahir, $tgl_lahir;
    public $telepon, $email, $alamat, $keterangan;

    // users
    public $user_id, $name, $user_email, $username, $password, $password_confirmation, $role;

    public function render()
    {
        return view('livewire.master.peminjam-non-approved-form');
    }

    protected function peminjamKode()
    {
        $peminjam = Peminjam::query()->latest('kode_peminjam')->first();
        if (!$peminjam){
            $num = 1;
        } else {
            $lastNum = (int) $peminjam->last_num_kode;
            $num = $lastNum + 1;
        }
        return "C".sprintf("%05s", $num);
    }

    protected function pegawaiKode()
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

    public function setApproved($id)
    {
        DB::beginTransaction();
        try {
            $users = User::query()->find($id);
            $kodePeminjam = $this->peminjamKode();
            $peminjam = Peminjam::query()->create([
                'kode_peminjam'=>$kodePeminjam,
                'nama'=>$users->name,
                'gender'=>'',
                'email'=>$users->email,
                'jenis_pengenal'=>'belum',
                'pengenal_id'=>$kodePeminjam,
                'telepon'=>0,
            ]);

            $users->update([
                'userable_type'=>'App\Models\Master\Peminjam',
                'userable_id'=>$peminjam->id,
                'role'=>'peminjam'
            ]);
            $this->emit('refreshUsersTable');
            DB::commit();
        } catch (ModelNotFoundException $e){
            session()->flash('hasilSimpan', $e);
            DB::rollBack();
        }
    }

    public function setPegawai($id)
    {
        DB::beginTransaction();
        try {
            $pegawaiKode = $this->pegawaiKode();
            $users = User::query()->find($id);
            $pegawai = Pegawai::query()->create([
                'kode'=>$pegawaiKode,
                'nama'=>$users->name,
                'gender'=>'',
                'email'=>$users->email,
                'jenis_pengenal'=>'belum',
                'pengenal_id'=>$pegawaiKode,
                'telepon'=>0,
            ]);

            $users->update([
                'userable_type'=>'App\Models\Master\Pegawai',
                'userable_id'=>$pegawai->id
            ]);
            $this->emit('refreshUsersTable');
            DB::commit();
        } catch (ModelNotFoundException $e){
            session()->flash('hasilSimpan', $e);
            DB::rollBack();
        }
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
