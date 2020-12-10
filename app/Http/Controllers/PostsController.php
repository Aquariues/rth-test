<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Categories;
use App\Http\Flash;
use App\helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Session;
use DB;
use Storage;
use App\Article;
use Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']    = 'List Posts';
        $data['posts']    = DB::table('posts')
        ->select(['posts.*','categories.name as categories_name'])
        ->join('categories','categories.id','=','posts.categories_id')
        ->where([
          ['posts.delete_status',0]
        ])
        ->orderBy('posts.created_at','desc')
        ->get();
        $list_category = Categories::where('delete_status',0)->get();
        $data['list_category'] = ['0'=>'Select category'];
        foreach($list_category as $r){
          $data['list_category'][$r->id] = $r->name;
        }
        $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];
        return view('themes.posts.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!checkLogin()){
          flash('error','You must login for this feature !','error');
          return back();
        }
        $list_category = Categories::where('delete_status',0)->get();
        $data['list_category'] = ['0'=>'Select category'];
        foreach($list_category as $r){
          $data['list_category'][$r->id] = $r->name;
        }
        $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];
        return view('themes.posts.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!checkLogin()){
          flash('error','You must login for this feature !','error');
          return back();
        }
        try{
          $response = $request->file('image')->storeOnCloudinary()->getSecurePath();
          dd($response);
          $name = $request->file('image')->getClientOriginalName();
          $path = $request->file('image')->storeAs('images/posts',$name);
        }catch(Exception $e){
          flash('error','Upload file failed !','error');
          return back();
        }
        $real_path = str_replace('public','storage/app/',url('').$path);
        $post = new Post();
        $post->title = $request->title;
        $post->categories_id = $request->category;
        $post->created_by = Session::get('users')->id;
        $post->contents = $request->{'article-trixFields'}['content'];
        $post->count_view = rand(1,100);
        $post->image = $real_path;
        $post->image_resize = url('/').'/assets/img/post-'.$request->category.'.jpg';
        $post->save();
        flash('success','Your posts is created, thank you <3','success');
        return redirect(url('posts/'.$post->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title']    = 'Post Detail';
        $data['detail']   = DB::table('posts')
        ->select(['posts.*','categories.name as categories_name','users.name as author'])
        ->join('categories','categories.id','=','posts.categories_id')
        ->join('users','users.id','=','posts.created_by')
        ->where([
          ['posts.delete_status',0],
          ['posts.id',$id]
        ])
        ->orderBy('posts.created_at','desc')
        ->get()
        ->first();

        $data['comments'] = DB::table('comments')
        ->select(['comments.*','users.name'])
        ->join('users','users.id','=','comments.created_by')
        ->where([
          ['posts_id',$id],
          ['comments.delete_status',0]
        ])
        ->get();
        $list_category = Categories::where('delete_status',0)->get();
        $data['list_category'] = ['0'=>'Select category'];
        foreach($list_category as $r){
          $data['list_category'][$r->id] = $r->name;
        }
        $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];

        return view('themes.posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!checkLogin()){
          flash('error','You must login for this feature !','error');
          return back();
        }

        $list_category = Categories::where('delete_status',0)->get();
        $data['list_category'] = ['0'=>'Select category'];
        foreach($list_category as $r){
          $data['list_category'][$r->id] = $r->name;
        }
        $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];

        $data['posts'] = Post::where('id',$id)->get()->first();
        return view('themes.posts.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!checkLogin()){
          flash('error','You must login for this feature !','error');
          return back();
        }

        $posts = new Post();
        $post = $posts::find($id);
        if($request->file('image') !== null){
          try{
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images/posts',$name);
          }catch(Exception $e){
            flash('error','Upload file failed !','error');
            return back();
          }
          $real_path = str_replace('public','storage/app/',url('').$path);
          $post->image = $real_path;
        }

        $post->title = $request->title;
        $post->categories_id = $request->category;
        $post->created_by = Session::get('users')->id;
        $post->updated_by = Session::get('users')->id;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->contents = $request->contents;
        $post->count_view = rand(1,100);

        $post->save();
        flash('success','Your post is updated !','success');
        return redirect(url('posts/'.$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!checkLogin()){
          flash('error','You must login for this feature !','error');
          return back();
        }
    }

    public function myPosts(){
      if(!checkLogin()){
        flash('error','You must login for this feature !','error');
        return back();
      }
      $data['posts']    = DB::table('posts')
      ->select(['posts.*','categories.name as categories_name'])
      ->join('categories','categories.id','=','posts.categories_id')
      ->where([
        ['posts.delete_status',0],
        ['posts.created_by',Session::get('users')->id]
      ])
      ->orderBy('posts.created_at','desc')
      ->get();
      $list_category = Categories::where('delete_status',0)->get();
      $data['list_category'] = ['0'=>'Select category'];
      foreach($list_category as $r){
        $data['list_category'][$r->id] = $r->name;
      }
      $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];
      $data['title']    = 'My Posts';
      return view('themes.posts.myposts',$data);
    }

    public function search(Request $request){

      $data['title']    = 'Search result';
      $query    = DB::table('posts')
      ->select(['posts.*','categories.name as categories_name'])
      ->join('categories','categories.id','=','posts.categories_id')
      ->where([
        ['posts.delete_status',0],
      ]);

      if($request->keyword != null)
        $query->where('title','like','%'.$request->keyword.'%');
      if($request->category != '0')
        $query->where('categories_id',$request->category);
      switch ($request->sort) {
        case '1':
          $query->orderBy('created_at','desc');
          break;
        case '2':
          $query->orderBy('created_at','asc');
          break;

        default:
          // code...
          break;
      }

      $data['posts'] = $query->get();
      $list_category = Categories::where('delete_status',0)->get();
      $data['list_category'] = ['0'=>'Select category'];
      foreach($list_category as $r){
        $data['list_category'][$r->id] = $r->name;
      }
      $data['sort'] = ['1' => 'Newest to oldest', '2' => 'Oldest to newest'];
      return view('themes.posts.index',$data);
    }
}
