<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;
    protected $table = 'inventaris';
    protected $fillable = [
        'kode_inventaris',
        'tgl_perolehan',
        'status',
        'jenis',
        'deskripsi',
        'keterangan',
    ];
}
