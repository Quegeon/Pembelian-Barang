<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Barang;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_petugas',
        'id_barang',
        'kuantitas',
        'total_harga',
        'tanggal_bayar',
        'catatan'
    ];

    public function Customer ()
    {
        return $this->belongsTo(User::class, 'id_customer', 'id_customer');
    }

    public function Petugas ()
    {
        return $this->belongsTo(User::class, 'id_petugas', 'id');
    }

    public function Barang ()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
