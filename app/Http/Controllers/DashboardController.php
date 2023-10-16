<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index ()
    {
        $sum_customer = User::where('level','customer')
            ->count();
        $sum_supplier = User::where('level','supplier')
            ->count();
        $sum_barang = Barang::count();

        $start_date = Carbon::today()->firstOfMonth();
        $dupe_stdate = Carbon::today()->firstOfMonth();
        $sum_day = Carbon::today()->daysInMonth;
        $end_date = $dupe_stdate->addDays($sum_day);

        $total_transaksi = Transaksi::select(Transaksi::raw('SUM(total_harga) as tb'))
            ->whereBetween('tanggal_bayar',[$start_date,$end_date])
            ->first();

        $history = Transaksi::select()
            ->orderBy('tanggal_bayar','desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(['sum_customer','sum_supplier','sum_barang','total_transaksi','history']));
    }

    public function index_petugas ()
    {
        $start_date = Carbon::today()->firstOfMonth();
        $dupe_stdate = Carbon::today()->firstOfMonth();
        $sum_day = Carbon::today()->daysInMonth;
        $end_date = $dupe_stdate->addDays($sum_day);

        $total_transaksi = Transaksi::select(Transaksi::raw('SUM(total_harga) as tb'))
            ->whereBetween('tanggal_bayar',[$start_date,$end_date])
            ->first();

        $history = Transaksi::select()
            ->orderBy('tanggal_bayar','desc')
            ->limit(5)
            ->get();
            
        return view('User.Petugas.dashboard', compact(['total_transaksi','history']));    
    }

    public function index_supplier ()
    {
        $sum_barang = Barang::where('id_supplier', Auth::user()->id_supplier)
            ->count();

        $supplier_barang = Barang::where('id_supplier', Auth::user()->id_supplier)
            ->get();

        // $summary = Transaksi::where('id_barang', $target_barang);        

        return view('User.Supplier.dashboard', compact(['sum_barang','supplier_barang']));
    }

    public function index_customer ()
    {
        $sum_barang = Barang::where('stok','>',0)
            ->count();
        $history = Transaksi::where('id_customer', Auth::user()->id_customer)
            ->get();

        return view('User.Customer.dashboard', compact(['sum_barang','history']));
    }
}
