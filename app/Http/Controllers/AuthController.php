<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {

        return view('themes.auth.register');
    }

    public function checkRegister(Request $request)
    {
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
