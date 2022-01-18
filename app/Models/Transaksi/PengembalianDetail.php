<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianDetail extends Model
{
    use HasFactory;
    protected $table = 'pengembalian_buku_detail';
    protected $fillable = [
        'pengembalian_id',
        'buku_id',
        'jumlah',
        'denda',
        'sub-total',
    ];
}
