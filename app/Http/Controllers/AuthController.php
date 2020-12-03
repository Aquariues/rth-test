<?php

namespace App\Http\Controllers;
use App\Http\Flash;
use App\helpers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {

        return view('themes.auth.register');
    }

    public function checkRegister(Request $request)
    {

        flash('error','Email already exits !','error');
        return back();
        dd($request->request);
    }

    public function login()
    {

        return view('themes.auth.login');
    }

    public function logout()
    {

        dd('logout');
    }
}
