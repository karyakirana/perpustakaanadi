<?php

namespace App\Models\Master;

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
}
