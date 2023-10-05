<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = User::where('level','customer')
            ->get();
        return view('User.Customer.index', compact(['customer']));
    }

    public function create()
    {
        return view('User.Customer.create');
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
                'level' => 'customer'
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
                    'alamat' => $request->alamat
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
    }

    public function show_password ($id)
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
            return view('User.Customer.show-password', compact(['customer']));
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
                        'password' => bcrypt($request->confirm_password)
                    ]);
    
                    return redirect('/customer')
                        ->with('status',[
                            'type' => 'success',
                            'message' => 'Password Successfully Changed'
                        ]);
    
                } catch (\Throwable $th) {
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
