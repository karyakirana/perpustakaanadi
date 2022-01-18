<?php

namespace App\Models\Transaksi;

use App\Models\Master\Peminjam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian_buku';
    protected $fillable = [
        'kode_pengembalian',
        'peminjam',
        'tgl_pinjam',
        'tgl_kembali',
        'user_id',
        'total_bayar',
        'keterangan',
    ];
    public function peminjamPerson()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
