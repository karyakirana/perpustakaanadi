<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = [
        'kode_buku',
        'kategori_id',
        'penerbit',
        'penulis',
        'isbn',
        'judul',
        'harga_sewa',
        'keterangan',
    ];

    public function kategori()
    {
        return $this->belongsTo(BukuKategori::class, 'kategori_id', 'id');
    }
}
