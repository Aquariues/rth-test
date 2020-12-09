<?php

namespace App\Http\Controllers;
use App\Http\Flash;
use App\helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;
use DB;
use App\Models\Categories;

class AuthController extends Controller
{
    public function register()
    {
      $list_category = Categories::where('delete_status',0)->get();
      $data['list_category'] = ['0'=>'Select category'];
      foreach($list_category as $r){
        $data['list_category'][$r->id] = $r->name;
      }
      $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];
      return view('themes.auth.register',$data);
    }

    public function checkRegister(Request $request)
    {
        $check = DB::table('users')
        ->select('id')->where('email',$request->email)->get();

        if(!$check->isEmpty()){
            flash('error','Email already exits !','error');
            return back();
        }
        DB::beginTransaction();
        try{
          DB::table('users')->insert([
              'name'      =>  $request->name,
              'email'     =>  $request->email,
              'password'  =>  Hash::make($request->password),
              'api_token' =>  Str::random(50),
          ]);
          DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            flash('error','Error when register !','error');
            return back();
        }
        $users = DB::table('users')->where('email',$request->email)->get()->first();
        Session::put('users',$users);
        flash('success','Welcome to AQ Blog !','success');
        return redirect(url('/'));
    }

    public function login()
    {
      $list_category = Categories::where('delete_status',0)->get();
      $data['list_category'] = ['0'=>'Select category'];
      foreach($list_category as $r){
        $data['list_category'][$r->id] = $r->name;
      }
      $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];
      return view('themes.auth.login',$data);
    }

    public function checkLogin(Request $request){
        $users = DB::table('users')->where('email',$request->email)->get();
        if($users->isEmpty()){
            flash('error','Your Email is not exits, please register your account first !','error');
            return back();
        }
        if(!Hash::check($request->password,$users[0]->password)){
            flash('error','Wrong password, please try again !','error');
            return back();
        }
        Session::put('users',$users[0]);
        flash('success','Welcome to AQ Blog !','success');
        return redirect(url('/'));
    }

    public function logout()
    {
        Session::flush();
        flash('success','Goodbye, Have fun <3','success');
        return redirect(url('/'));
    }
}
