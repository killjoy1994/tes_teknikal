<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    
    protected $table = "transaksi";
    
    protected $fillable = [
        'barang_id',
        'quantity',
        'stok_sisa',
    ];

    public function barang() {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
