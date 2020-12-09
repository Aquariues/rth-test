<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
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
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Post::create($request->all()))
          return ['message' => 'Your post created !'];
        return ['message'=>'Sorry your post not create, check the params again'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(empty(Post::find($id)))
          return ['message' => 'The post you looking for not found'];
        return Post::find($id);
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

    public function search(Request $request){
      // dd($request->request);
      $query    = DB::table('posts')
      ->select(['posts.*','categories.name as categories_name'])
      ->join('categories','categories.id','=','posts.categories_id')
      ->where([
        ['posts.delete_status',0],
      ]);

      if($request->keyword != null)
        $query->where('title','like','%'.$request->keyword.'%');
      if($request->category != '0' && $request->category != null)
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

      $response = $query->get();
      if($response->isEmpty())
        return ['message' => 'The post you looking for not found'];
      return $response;
    }
}
