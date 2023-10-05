<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
