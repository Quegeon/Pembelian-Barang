<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CustomerController extends Controller
{
    public function index()
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'customer') {
            $customer = User::where('level','customer')
                ->get();
            return view('User.Customer.index', compact(['customer']));

        } else {
            Auth::logout();
            return redirect('/')->with('status',[
                'type' => 'danger',
                'message' => 'User do not have access'
            ]);
        }
    }

    public function create()
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'customer') {
            return view('User.Customer.create');

        } else {
            Auth::logout();
            return redirect('/')->with('status',[
                'type' => 'danger',
                'message' => 'User do not have access'
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'username' => 'required|max:20',
            'no_telp' => 'required|max:13',
            'email' => 'required|max:50|email',
            'password' => 'required|max:12',
            'alamat' => 'required|max:225'
        ]);

        $rand_num = random_int(1000,9999);
        $id_customer = 'C' . $rand_num;

        try {
            User::create([
                'id_customer' => $id_customer,
                'nama' => $request->nama,
                'username' => $request->username,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'alamat' => $request->alamat,
                'level' => 'customer',
                $request->except(['_token'])
            ]);

            return redirect('/customer')
                ->with('status',[
                    'type' => 'success',
                    'message' => 'Data Successfully Created'
                ]);
            
        } catch (\Throwable $th) {
            return redirect('/customer')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Error Store Data'
                ]);
        }
    }

    public function show($id)
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'customer') {
            $customer = User::where('id_customer',$id)
                ->first();
    
            if ($customer === null) {
                return redirect('/customer')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
    
            } else {
                return view('User.Customer.show', compact(['customer']));
            }

        } else {
            Auth::logout();
            return redirect('/')->with('status',[
                'type' => 'danger',
                'message' => 'User do not have access'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $customer = User::where('id_customer',$id)
            ->first();

        if ($customer === null) {
            return redirect('/customer')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);

        } else {
            $request->validate([
                'nama' => 'required|max:50',
                'username' => 'required|max:20',
                'no_telp' => 'required|max:13',
                'email' => 'required|max:50|email',
                'alamat' => 'required|max:225'
            ]);

            try {
                $customer->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'no_telp' => $request->no_telp,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    $request->except(['_token'])
                ]);

                return redirect('/customer')
                    ->with('status',[
                        'type' => 'success',
                        'message' => 'Data Successfully Update'
                    ]);

            } catch (\Throwable $th) {
                return redirect('/customer')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Error Update Data'
                    ]);
            }
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'customer') {
            $customer = User::where('id_customer',$id)
                ->first();
    
            if ($customer === null) {
                return redirect('/customer')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
    
            } else {
                try {
                    $customer->delete();
    
                    return redirect('/customer')
                        ->with('status',[
                            'type' => 'warning',
                            'message' => 'Data Successfully Deleted'
                        ]);
    
                } catch (\Throwable $th) {
                    return redirect('/customer')
                        ->with('status',[
                            'type' => 'danger',
                            'message' => 'Error Destroy Data'
                        ]);
                }
            }

        } else {
            Auth::logout();
            return redirect('/')->with('status',[
                'type' => 'danger',
                'message' => 'User do not have access'
            ]);
        }
    }

    public function show_password ($id)
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'customer') {
            $customer = User::where('id_customer',$id)
                ->first();
            
            if ($customer === null) {
                return redirect('/customer')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
    
            } else {
                return view('User.Customer.show-password', compact(['customer']));
            }

        } else {
            Auth::logout();
            return redirect('/')->with('status',[
                'type' => 'danger',
                'message' => 'User do not have access'
            ]);
        }
    }

    public function change_password (Request $request, $id)
    {
        $customer = User::where('id_customer',$id)
            ->first();
        
        if ($customer === null) {
            return redirect('/customer')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);

        } else {
            $request->validate([
                'new_password' => 'required|max:12',
                'confirm_password' => 'required|max:12'
            ]);

            if ($request->new_password !== $request->confirm_password) {
                return back()
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Password does not match'
                    ]);

            } else {
                try {
                    $customer->update([
                        'password' => bcrypt($request->confirm_password),
                        $request->except(['_token'])
                    ]);

                    if (Auth::user()->level === 'customer') {
                        return redirect('/customer/profile')
                            ->with('status',[
                                'type' => 'success',
                                'message' => 'Password Successfully Changed'
                            ]);

                    } else {
                        return redirect('/customer')
                            ->with('status',[
                                'type' => 'success',
                                'message' => 'Password Successfully Changed'
                            ]);
                    }
    
    
                } catch (\Throwable $th) {
                    if (Auth::user()->level === 'customer') {
                        return redirect('/customer/profile')
                            ->with('status',[
                                'type' => 'danger',
                                'message' => 'Error Change Password'
                            ]);

                    } else {
                        return redirect('/customer')
                            ->with('status',[
                                'type' => 'danger',
                                'message' => 'Error Change Password'
                            ]);
                    }
                }
            }
        }
    }

    public function index_buy ()
    {
        if (Auth::user()->level === 'customer') {
            $barang = Barang::where('stok','>',0)
                ->get();
            
            return view('User.Customer.index-buy', compact(['barang']));

        } else {
            Auth::logout();
            return redirect('/')->with('status',[
                'type' => 'danger',
                'message' => 'User do not have access'
            ]);
        }
    }

    public function show_buy ($id)
    {
        if (Auth::user()->level === 'customer') {
            $barang = Barang::find($id);
            $petugas = User::where('level','admin')
                ->orWhere('level','petugas')
                ->get();

            if ($barang === null) {
                return redirect('/customer/index-bayar')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
    
            } else if ($petugas->first() === null) {
                return redirect('/customer/index-buy')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Reference Data is Empty'
                    ]);
    
            } else {
                return view('User.Customer.show-buy', compact(['barang','petugas']));
            }

        } else {
            Auth::logout();
            return redirect('/')->with('status',[
                'type' => 'danger',
                'message' => 'User do not have access'
            ]);
        }
    }

    public function buy (Request $request)
    {
        $request->validate([
            'id_customer' => 'required|max:11',
            'id_petugas' => 'required|max:11',
            'id_barang' => 'required|numeric',
            'kuantitas' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric',
            'catatan' => 'max:255',
        ]);

        $target_barang = Barang::where('id',$request->id_barang)
            ->first();

        Cache::put('c_stk',$target_barang->stok, now()->addMinute(20));

        
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

            if ($request->jumlah_bayar < $total_harga) {
                return back()
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Jumlah Bayar need to match Total Harga!'
                    ]); 
                    
            } else {
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
                        $request->except(['_token'])
                    ]);
        
                    return redirect('/customer/index-buy')
                        ->with('status',[
                            'type' => 'success',
                            'message' => 'Data Successfully Created'
                        ]);
        
                } catch (\Throwable $th) {
                    return redirect('/customer/index-buy')
                        ->with('status',[
                            'type' => 'danger',
                            'message' => 'Error Store Data'
                        ]);
                }
            }
        }
    }

    public function index_profile ()
    {
        if (Auth::user()->level === 'customer') {
            return view('User.Customer.index-profile');

        } else {
            Auth::logout();
                return redirect('/')->with('status',[
                    'type' => 'danger',
                    'message' => 'User do not have access'
                ]);
        }
    }

    public function show_profile ()
    {
        if (Auth::user()->level === 'customer') {
            return view('User.Customer.show-profile');

        } else {
            Auth::logout();
                return redirect('/')->with('status',[
                    'type' => 'danger',
                    'message' => 'User do not have access'
                ]);
        }
    }

    public function change_profile (Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'username' => 'required|max:20',
            'no_telp' => 'required|max:13',
            'email' => 'required|max:50|email',
            'alamat' => 'required|max:225'
            ]);

            $customer = User::where('id_customer', Auth::user()->id_customer)
                ->first();

            try {
                $customer->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'no_telp' => $request->no_telp,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    $request->except(['_token'])
                ]);

                return redirect('/customer/profile')
                    ->with('status',[
                        'type' => 'success',
                        'message' => 'Data Successfully Update'
                    ]);

            } catch (\Throwable $th) {
                return redirect('/customer/profile')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Error Update Data'
                    ]);
            }
    }
}
