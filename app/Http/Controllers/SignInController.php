<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function index () {
        return view('signin-menu');
    }

    public function create_customer ()
    {
        return view('User.Customer.create-signin');
    }

    public function create_supplier ()
    {
        return view('User.Supplier.create-signin');
    }

    public function store_customer (Request $request)
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
                'level' => 'customer'
            ]);

            return redirect('/')
                ->with('status',[
                    'type' => 'success',
                    'message' => 'Customer Account Successfully Created'
                ]);
            
        } catch (\Throwable $th) {
            return redirect('/signin')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Error Store Data Customer'
                ]);
        }
    }

    public function store_supplier (Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'username' => 'required|max:20',
            'nama_perusahaan' => 'required|max:25',
            'password' => 'required|max:12',
            'no_telp' => 'required|max:13',
            'email' => 'required|max:50|email',
            'alamat' => 'required|max:225'
        ]);

        $rand_num = random_int(1000,9999);
        $id_supplier = 'S' . $rand_num;

        try {
            User::create([
                'id_supplier' => $id_supplier,
                'nama' => $request->nama,
                'username' => $request->username,
                'nama_perusahaan' => $request->nama_perusahaan,
                'password' => bcrypt($request->password),
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'level' => 'supplier'
            ]);

            return redirect('/')
                ->with('status',[
                    'type' => 'success',
                    'message' => 'Supplier Account Successfully Created'
                ]);

        } catch (\Throwable $th) {
            return redirect('/signin')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Error Store Data Supplier'
                ]);
        }
    }

}
