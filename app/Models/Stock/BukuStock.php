<?php

namespace App\Models\Stock;

use App\Models\Master\Buku;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuStock extends Model
{
    use HasFactory;
    protected $table = 'buku_stock';
    protected $fillable = [
        'buku_id',
        'jumlah',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }
}
