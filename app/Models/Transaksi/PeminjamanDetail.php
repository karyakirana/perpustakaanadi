<?php

namespace App\Models\Transaksi;

use App\Models\Master\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_buku_detail';
    protected $fillable = [
        'peminjaman_id',
        'buku_id',
        'jumlah',
        'harga_sewa',
        'sub_total',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
