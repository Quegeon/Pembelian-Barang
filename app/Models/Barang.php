<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
}
