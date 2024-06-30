<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMejaDetail extends Model
{
    use HasFactory;
    protected $table = 'transaksi_meja_detail';
    protected $primaryKey = 'transaksi_meja_detail_id';

    protected $fillable = [
        'transaksi_id',
        'meja_id',
        'harga',
        'durasi',
        'total_harga',
        'jam_mulai',
        'jam_selesai',
        'lampu',
    ];

    public $timestamps = true;
}
