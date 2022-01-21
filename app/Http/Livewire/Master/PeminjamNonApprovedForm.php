<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Peminjam;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PeminjamNonApprovedForm extends Component
{
    public $peminjam_id, $kode, $jenis_pengenal, $pengenal_id, $gender, $tempat_lahir, $tgl_lahir;
    public $telepon, $email, $alamat, $keterangan;

    // users
    public $user_id, $name, $user_email, $username, $password, $password_confirmation, $role;

    public function render()
    {
        return view('livewire.master.peminjam-non-approved-form');
    }

    public function setApproved($id)
    {
        DB::beginTransaction();
        try {
            $users = User::query()->find($id);
            $peminjam = new Peminjam();
            $peminjam->nama = $users->name;
            $peminjam->email = $users->email;
            $peminjam->save();

            $users->update([
                'userable_type'=>'App\Models\Master\Pegawai',
                'userable->id'=>$peminjam->id
            ]);
            DB::commit();
        } catch (ModelNotFoundException $e){
            DB::rollBack();
        }
    }

    public function setPegawai($id)
    {
        DB::beginTransaction();
        try {
            //
        }
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
