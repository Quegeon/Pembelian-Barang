<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{

    public function index()
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'supplier') {
            $supplier = User::where('level','supplier')
                ->get();
            return view('User.Supplier.index', compact(['supplier']));

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
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'supplier') {
            return view('User.Supplier.create');

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
                'level' => 'supplier',
                $request->except(['_token'])
            ]);

            return redirect('/supplier')
                ->with('status',[
                    'type' => 'success',
                    'message' => 'Data Successfully Created'
                ]);

        } catch (\Throwable $th) {
            return redirect('/supplier')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Error Store Data'
                ]);
        }
    }

    public function show($id)
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'supplier') {
            $supplier = User::where('id_supplier',$id)
                ->first();
    
            if ($supplier === null) {
                return redirect('/supplier')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
            } else {
                return view('User.Supplier.show', compact(['supplier']));
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
        $supplier = User::where('id_supplier',$id)
            ->first();
        
        if ($supplier === null) {
            return redirect('/supplier')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);
        } else {
            $request->validate([
                'nama' => 'required|max:50',
                'username' => 'required|max:20',
                'nama_perusahaan' => 'required|max:25',
                'no_telp' => 'required|max:13',
                'email' => 'required|max:50|email',
                'alamat' => 'required|max:225'
            ]);

            try {
                $supplier->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'no_telp' => $request->no_telp,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    $request->except(['_token'])
                ]);

                return redirect('/supplier')
                    ->with('status',[
                        'type' => 'success',
                        'message' => 'Data Successfully Updated'
                    ]);

            } catch (\Throwable $th) {
                return redirect('/supplier')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Error Update Data'
                    ]);
            }
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'supplier') {
            $supplier = User::where('id_supplier',$id)
                ->first();
            
            if ($supplier === null) {
                return redirect('/supplier')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
            } else {
                try {
                    $supplier->delete();
    
                    return redirect('/supplier')
                        ->with('status',[
                            'type' => 'warning',
                            'message' => 'Data Successfully Deleted'
                        ]);
    
                } catch (\Throwable $th) {
                    return redirect('/supplier')
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
        if (Auth::user()->level === 'admin' || Auth::user()->level === 'supplier') {
            $supplier = User::where('id_supplier',$id)
                ->first();
    
            if ($supplier === null) {
                return redirect('/supplier')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
            } else {
                return view('User.Supplier.show-password', compact(['supplier']));
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
        $supplier = User::where('id_supplier',$id)
            ->first();
        
        if ($supplier === null) {
            return redirect('/supplier')
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
                    $supplier->update([
                        'password' => bcrypt($request->confirm_password),
                        $request->except(['_token'])
                    ]);
    
                    return redirect('/supplier')
                        ->with('status',[
                            'type' => 'success',
                            'message' => 'Password Successfully Changed'
                        ]);
    
                } catch (\Throwable $th) {
                    return redirect('/supplier')
                        ->with('status',[
                            'type' => 'danger',
                            'message' => 'Error Change Password'
                        ]);
                }
            }
        }
    }
}
