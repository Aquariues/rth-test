<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Flash;
use App\helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;
use DB;
use App\Models\Categories;
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

      $list_category = Categories::where('delete_status',0)->get();
      $data['list_category'] = ['0'=>'Select category'];
      foreach($list_category as $r){
        $data['list_category'][$r->id] = $r->name;
      }
      $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];

      return view('themes.home.index',$data);
    }
}
