<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'transaksi_detail_id';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'harga',
        'jumlah',
        'total_harga'
    ];

    public $timestamps = true;
}
