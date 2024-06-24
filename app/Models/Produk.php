<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'produk_id';

    protected $fillable = [
        'user_id',
        'katagori_id',
        'nama',
        'harga',
        'harga_jual',
        'stock',
        'keterangan',
        'gambar',
        'user_at'
    ];

    public $timestamps = true;
}
