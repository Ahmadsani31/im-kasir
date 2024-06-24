<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'meja';
    protected $primaryKey = 'meja_id';

    protected $fillable = [
        'user_id',
        'nama',
        'harga',
        'jenis',
        'gambar',
    ];

    public $timestamps = true;
}
