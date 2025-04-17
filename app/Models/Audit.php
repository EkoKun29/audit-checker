<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'storage',
        'barang',
        'dus',
        'btl',
        'total',
        'total_real',
        'sudah_disimpan'
    ];
}
