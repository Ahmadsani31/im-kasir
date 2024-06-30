<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'user_id',
        'transaksi_uuid',
        'invoice',
        'cashier_nama',
        'costumer_nama',
        'sub_harga',
        'pajak',
        'total_harga',
        'bayar',
        'metode_bayar',
        'kembalian',
        'diskon'
    ];

    public $timestamps = true;
}
