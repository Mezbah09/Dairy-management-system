<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->getMethod()=="POST"){
            if($request->password==env('super','rajkumar123')){
                session(['key_12ee3nnn'=>mt_rand(1000000,9999999)]);
                return redirect(session('redirect'));
            }
        }else{
            return view('admin.password.index');
        }
    }
    public function logout()
    {
        session()->forget('key_12ee3nnn');
        return redirect()->route('admin.dashboard');
    }
}
