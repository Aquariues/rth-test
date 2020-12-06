<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Flash;
use App\helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;
use DB;

class HomeController extends Controller
{
    public function index(){

      $data['title']    = 'List Posts';

      $data['posts_newest']    = DB::table('posts')
                              ->select(['posts.*','categories.name as categories_name'])
                              ->join('categories','categories.id','=','posts.categories_id')
                              ->where([
                                ['posts.delete_status',0]
                              ])
                              ->orderBy('posts.created_at','desc')
                              ->limit(3)
                              ->get();

      $data['posts_most_view']= DB::table('posts')
                              ->select(['posts.*','categories.name as categories_name'])
                              ->join('categories','categories.id','=','posts.categories_id')
                              ->where([
                                ['posts.delete_status',0]
                              ])
                              ->orderBy('posts.count_view','desc')
                              ->limit(3)
                              ->get();

      return view('themes.home.index',$data);
    }
}
