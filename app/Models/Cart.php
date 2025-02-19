<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'cashier_id',
        'produk_id',
        'jumlah',
        'harga',
    ];

    public $timestamps = true;
}
