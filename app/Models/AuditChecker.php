<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditChecker extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_audit',
        'produk',
        'dus',
        'btl',
        'kotak',
        'total'
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class, 'id_audit', 'id');
    }
}
