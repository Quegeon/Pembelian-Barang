<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaksi;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_supplier',
        'nama_barang',
        'jenis',
        'stok',
        'harga'
    ];

    public function Supplier ()
    {
        return $this->belongsTo(User::class, 'id_supplier', 'id_supplier');
    }

    public function Barang ()
    {
        return $this->hasMany(Transaksi::class, 'id_barang', 'id');
    }
}
