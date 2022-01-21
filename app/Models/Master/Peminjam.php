<?php

namespace App\Models\Master;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;
    protected $table = 'peminjam';
    protected $fillable = [
        'kode_peminjam',
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

    public function getLastNumKodeAttribute()
    {
        return substr($this->kode_peminjam, 1, 5);
    }

    public function users()
    {
        return $this->morphOne(User::class, 'userable', 'userable_type', 'userable_id');
    }
}
