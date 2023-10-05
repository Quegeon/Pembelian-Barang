<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Barang;
use App\Models\Transaksi;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id_customer',
        'id_supplier',
        'nama',
        'username',
        'no_telp',
        'email',
        'password',
        'nama_perusahaan',
        'alamat',
        'level'
    ];

    protected $hidden = [
        'password'
    ];

    public function Supplier ()
    {
        return $this->hasMany(Barang::class, 'id_supplier', 'id_supplier');
    }

    public function Customer ()
    {
        return $this->hasMany(Barang::class, 'id_customer', 'id_customer');
    }

    public function Petugas ()
    {
        return $this->hasMany(Barang::class, 'id_petugas', 'id');
    }
}
