<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Categories;
use DB;

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

        $post = new Post();
        $post->title = $request->title;
        $post->categories_id = $request->category;
        $post->contents = $request->{'article-trixFields'}['content'];
        $post->save();
        // Post::create([
        //   'post-trixFields' => request('post-trixFields'),
        //   'attachment-post-trixFields' => request('attachment-post-trixFields')
        // ]);
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
                                ->select(['posts.*','categories.name as categories_name'])
                                ->join('categories','categories.id','=','posts.categories_id')
                                ->where([
                                  ['posts.delete_status',0],
                                  ['posts.id',$id]
                                ])
                                ->orderBy('posts.created_at','desc')
                                ->get()
                                ->first();

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
