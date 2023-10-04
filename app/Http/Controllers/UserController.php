<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $petugas = User::where('level','admin')
            ->orWhere('level','petugas')
            ->get();
        // dd($petugas);
        return view('User.Petugas.index', compact(['petugas']));
    }

    public function create()
    {
        return view('User.Petugas.create');
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
    }

    public function show_password ($id) 
    {
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
                        'password' => bcrypt($request->confirm_password)
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
