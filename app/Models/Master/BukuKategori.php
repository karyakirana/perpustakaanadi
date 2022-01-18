<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKategori extends Model
{
    use HasFactory;
    protected $table = 'buku_kategori';
    protected $fillable = [
        'kode_kategori',
        'deskripsi',
        'keterangan',
    ];
}
