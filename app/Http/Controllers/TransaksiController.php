<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        
        return view('Transaksi.index', compact(['transaksi']));
    }

    public function create()
    {
        $customer = User::where('level','customer')
            ->get();
        $petugas = User::where('level','admin')
            ->orWhere('level','petugas')
            ->get();
        $barang = Barang::all();

        if ($customer->first() === null || $petugas->first() === null || $barang === null) {
            return redirect('/transaksi')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Reference Data is Empty'
                ]);

        } else {
            return view('Transaksi.create', compact(['customer','petugas','barang']));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'required|max:11',
            'id_petugas' => 'required|max:11',
            'id_barang' => 'required|numeric',
            'kuantitas' => 'required|numeric',
            'catatan' => 'max:255',
        ]);

        $target_barang = Barang::where('id',$request->id_barang)
            ->first();

        $cache_stok = Cache::put('c_stk',$target_barang->stok, now()->addMinute(20));

        
        if ($request->kuantitas > $target_barang->stok) {
            return back()
            ->with('status',[
                'type' => 'danger',
                'message' => 'Quantity is Exceeding Stock'
            ]);    
            
        } else {
            $total_harga =  $target_barang->harga * $request->kuantitas;
            $update_stok = $target_barang->stok - $request->kuantitas;
            $tanggal_bayar = Carbon::today();
            
            try {
                $target_barang->update([
                    'stok' => $update_stok
                ]);

                Transaksi::create([
                    'id_customer' => $request->id_customer,
                    'id_petugas' => $request->id_petugas,
                    'id_barang' => $request->id_barang,
                    'kuantitas' => $request->kuantitas,
                    'total_harga' => $total_harga,
                    'tanggal_bayar' => $tanggal_bayar,
                    'catatan' => $request->catatan,
                ]);
    
                return redirect('/transaksi')
                    ->with('status',[
                        'type' => 'success',
                        'message' => 'Data Successfully Created'
                    ]);
    
            } catch (\Throwable $th) {
                return redirect('/transaksi')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Error Store Data'
                    ]);
            }
        }



    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        $customer = User::where('level','customer')
            ->get();
        $petugas = User::where('level','admin')
            ->orWhere('level','petugas')
            ->get();
        $barang = Barang::all();

        if ($transaksi === null) {
            return redirect('/transaksi')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);

        } else if ($customer->first() === null || $petugas->first() === null || $barang === null) {
            return redirect('/transaksi')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Reference Data is Empty'
                ]);

        } else {
            return view('Transaksi.show', compact(['transaksi','customer','petugas','barang']));
        }
        
        
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);

        if ($transaksi === null) {
            return redirect('/transaksi')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);
                
        } else {
            $request->validate([
                'id_customer' => 'required|max:11',
                'id_petugas' => 'required|max:11',
                'id_barang' => 'required|numeric',
                'kuantitas' => 'required|numeric',
                'tanggal_bayar' => 'required|date',
                'catatan' => 'max:255',
            ]);


            $target_barang = Barang::where('id',$request->id_barang)
                ->first();

            $cache_stok = Cache::get('c_stk');
            
            if ($request->kuantitas > $cache_stok) {
                return back()
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Quantity is Exceeding Stock'
                ]);    

            } else {
                $update_stok = $cache_stok - $request->kuantitas;
                $total_harga =  $target_barang->harga * $request->kuantitas;

                try {
                    $target_barang->update([
                        'stok' => $update_stok
                    ]);
    
                    $transaksi->update([
                        'id_customer' => $request->id_customer,
                        'id_petugas' => $request->id_petugas,
                        'id_barang' => $request->id_barang,
                        'kuantitas' => $request->kuantitas,
                        'total_harga' => $total_harga,
                        'tanggal_bayar' => $request->tanggal_bayar,
                        'catatan' => $request->catatan,
                    ]);

                    return redirect('/transaksi')
                        ->with('status',[
                            'type' => 'success',
                            'message' => 'Data Successfully Updated'
                        ]);

                } catch (\Throwable $th) {
                    return redirect('/transaksi')
                        ->with('status',[
                            'type' => 'danger',
                            'message' => 'Error Update Data'
                        ]);
                }
            }
        }
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);

        if ($transaksi === null) {
            return redirect('/transaksi')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);
                
        } else {
            try {
                $transaksi->delete();

                return redirect('/transaksi')
                        ->with('status',[
                            'type' => 'warning',
                            'message' => 'Data Successfully Deleted'
                        ]);

            } catch (\Throwable $th) {
                return redirect('/transaksi')
                        ->with('status',[
                            'type' => 'danger',
                            'message' => 'Error Destroy Data'
                        ]);
            }
        }
    }
}
