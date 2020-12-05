<?php

namespace App\Http\Controllers;
use App\Http\Flash;
use App\helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class AuthController extends Controller
{
    public function register()
    {

        return view('themes.auth.register');
    }

    public function checkRegister(Request $request)
    {
        $check = DB::table('users')
        ->select('id')->where('email',$request->email)->get();

        if(!$check->isEmpty()){
            flash('error','Email already exits !','error');
            return back();
        }
        DB::table('users')->insert([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  Hash::make($request->password),
            'api_token' =>  Str::random(50);
        ]);
        flash('success','Welcome to AQ Blog !','success');
        return redirect(url('/'));
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
