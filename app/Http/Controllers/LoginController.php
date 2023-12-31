<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index ()
    {
        return view('login');
    }

    public function postlogin (Request $request)
    {
        $request->validate([
            'username' => 'required|max:20',
            'password' => 'required|max:12'
        ]);

        if (Auth::attempt($request->only('username','password'))) {
            if (Auth::user()->level === 'admin') {
                return redirect('/dashboard');

            } else if (Auth::user()->level === 'petugas') {
                return redirect('/dashboard/petugas');

            } else if (Auth::user()->level === 'customer') {
                return redirect('/dashboard/customer');
            
            } else {
                return redirect('/dashboard/supplier');
            }

        } else {
            return back()
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Login Failed'
                ]);
        }
    }

    public function logout ()
    {
        Auth::logout();

        return redirect('/')->with('status',[
            'type' => 'success',
            'message' => 'Successfully Logged Out'
        ]);
    }
}
