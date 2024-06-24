<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katagori extends Model
{
    use HasFactory;
    protected $table = 'katagori';
    protected $primaryKey = 'katagori_id';

    protected $fillable = [
        'user_id',
        'nama',
        'gambar',
    ];

    public $timestamps = true;
}
