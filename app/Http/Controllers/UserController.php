<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->level === 'admin') {
            $petugas = User::where('level','admin')
                ->orWhere('level','petugas')
                ->get();
            return view('User.Petugas.index', compact(['petugas']));

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
        if (Auth::user()->level === 'admin') {
            return view('User.Petugas.create');

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
        ]);

        try {
            User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                $request->except(['_token'])
            ]);

            return redirect('/petugas')
                ->with('status',[
                    'type' => 'success',
                    'message' => 'Data Successfully Created'
                ]);

        } catch (\Throwable $th) {
            return redirect('/petugas')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Error Store Data'
                ]);
        }
    }

    public function show($id)
    {
        if (Auth::user()->level === 'admin') {
            $petugas = User::find($id);
    
            if ($petugas === null) {
                return redirect('/petugas')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
    
            } else {
                return view('User.Petugas.show', compact(['petugas']));
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
        $petugas = User::find($id);

        if ($petugas === null) {
            return redirect('/petugas')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);
                
        } else {
            $request->validate([
                'nama' => 'required|max:50',
                'username' => 'required|max:50',
                'no_telp' => 'required|max:13',
                'email' => 'required|max:50|email',
                'level' => 'required',
            ]);

            try {
                $petugas->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'no_telp' => $request->no_telp,
                    'email' => $request->email,
                    'level' => $request->level,
                    $request->except(['_token'])
                ]);

                return redirect('/petugas')
                ->with('status',[
                    'type' => 'success',
                    'message' => 'Data Successfully Updated'
                ]);

            } catch (\Throwable $th) {
                return redirect('/petugas')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Error Update Data'
                ]);
            }
        }
        
    }

    public function destroy($id)
    {
        if (Auth::user()->level === 'admin') {
            $petugas = User::find($id);
    
            if ($petugas === null) {
                return redirect('/petugas')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
                    
            } else {
                try {
                    $petugas->delete();
    
                    return redirect('/petugas')
                    ->with('status',[
                        'type' => 'warning',
                        'message' => 'Data Successfully Deleted'
                    ]);
    
                } catch (\Throwable $th) {
                    return redirect('/petugas')
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
        if (Auth::user()->level === 'admin') {
            $petugas = User::find($id);
    
            if ($petugas === null) {
                return redirect('/petugas')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Invalid Target Data'
                    ]);
                    
            } else {
                return view('User.Petugas.show-password', compact(['petugas']));
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
        $petugas = User::find($id);

        if ($petugas === null) {
            return redirect('/petugas')
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
                    $petugas->update([
                        'password' => bcrypt($request->confirm_password),
                        $request->except(['_token'])
                    ]);

                    return redirect('/petugas')
                        ->with('status',[
                            'type' => 'success',
                            'message' => 'Password Successfully Changed'
                        ]);

                } catch (\Throwable $th) {
                    return redirect('/petugas')
                        ->with('status',[
                            'type' => 'danger',
                            'message' => 'Error Change Password'
                        ]);
                }
            }
        }
    }
}
