<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Categories;
use App\Http\Flash;
use App\helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;
use DB;
use App\Article;

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

        $data['list_category'] = [];
        foreach($list_category as $r){
          $data['list_category'][$r->id] = $r->name;
        }
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

        $resize = str_replace('<img src=','<img class="resize-image" src=',$request->{'article-trixFields'}['content']);
        $content =  str_replace('/public/storage/','/storage/app/public/',$resize);
        $content = str_replace(url(''),'',$content);

        $post = new Post();
        $post->title = $request->title;
        $post->categories_id = $request->category;
        $post->created_by = Session::get('users')->id;
        $post->contents = $content;
        $post->count_view = rand(1,100);
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

        $data['list_category'] = [];
        foreach($list_category as $r){
          $data['list_category'][$r->id] = $r->name;
        }
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
        // dd($request->request);
        $resize = str_replace('<img src=','<img class="resize-image" src=',$request->contents);
        $content =  str_replace('/public/storage/','/storage/app/public/',$resize);
        $content = str_replace(url(''),'',$content);

        $posts = new Post();
        $post = $posts::find($id);
        $post->title = $request->title;
        $post->categories_id = $request->category;
        $post->created_by = Session::get('users')->id;
        $post->contents = $content;
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
      $data['title']    = 'My Posts';
      return view('themes.posts.myposts',$data);
    }
}
