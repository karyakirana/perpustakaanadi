<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuStockPerubahanDetail extends Model
{
    use HasFactory;
    protected $table = 'stock_perubahan_detail';
    protected $fillable = [
        'stock_perubahan_id',
        'buku_id',
        'jumlah',
    ];
}
