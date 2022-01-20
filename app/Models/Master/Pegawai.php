<?php

namespace App\Models\Master;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = [
        'kode',
        'nama',
        'gender',
        'jenis_pengenal',
        'pengenal_id',
        'tempat_lahir',
        'tgl_lahir',
        'telepon',
        'email',
        'alamat',
        'keterangan',
    ];

    public function users()
    {
        return $this->morphOne(User::class, 'userable', 'userable_type', 'userable_id');
    }
}
