<?php

namespace App\Models\Stock;

use App\Models\User;
use App\Models\Stock\BukuStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuStockPerubahan extends Model
{
    use HasFactory;
    protected $table = 'stock_perubahan';
    protected $fillable = [
        'jenis',
        'tgl_perubahan',
        'pembuat',
        'keterangan',
    ];
}
