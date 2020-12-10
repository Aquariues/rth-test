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
    $post = DB::table('posts')->where('delete_status',0)->get();
    return response()->json($post);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $check_user = DB::table('users')->where('api_token',$request->header('USER-TOKEN'))->get()->first();
    if($check_user == null)
    return ['message'=>"Sorry we can't authenticate who are you, please try again"];

    $arr_request = ['category','title','contents'];
    foreach($arr_request as $r){
      if($request->input($r) == null)
      return ['message','Missing params '.$r];
    }
    $check_category = DB::table('categories')->where('id',$request->input('category'))->get()->first();
    if($check_category == null)
      return ['message'=>"Category not found, please check category params agains"];
    if($request->file('image') == null){
      return ['message','Missing image files'];
    }
    try{
      $path = $request->file('image')->storeOnCloudinary()->getSecurePath();
      $resize_path = cloudinary()->upload($request->file('image')->getRealPath(), [
        'folder' => 'uploads',
        'transformation' => [
          'width' => 500,
          'height' => 500
          ]])->getSecurePath();

          $post = new Post();
          $post->title = $request->input('title');
          $post->categories_id = $request->input('category');
          $post->created_by = $check_user->id;
          $post->contents = $request->input('contents');
          $post->count_view = rand(1,100);
          $post->image = $path;
          $post->image_resize = $resize_path;
          $post->save();
          return ['message' => 'Your post created ! <a href="'.url('/posts/'.$post->id).'"'];
        }catch(Exception $e){
          return ['message'=>'Sorry your post not create, check the params again'];
        }
      }

      /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function show($id)
      {
        $post = DB::table('posts')->where([['id',$id],['delete_status',0]])->get()->first();
        if($post == null)
          return ['message' => 'The post you looking for not found'];
        return response()->json($post);
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

        $check_user = DB::table('users')->where('api_token',$request->header('USER-TOKEN'))->get()->first();
        if($check_user == null)
          return ['message'=>"Sorry we can't authenticate who are you, please try again"];
        $check_posts = DB::table('posts')->where([['id',$id],['created_by',$check_user->id]])->get()->first();
        $check_category = DB::table('categories')->where('id',$request->input('category'))->get()->first();
        if($check_category == null)
          return ['message'=>"Category not found, please check category params agains"];
        if($check_posts == null)
          return ['message'=>"Sorry you can't edit posts which you not create"];
        try{
          $posts = new Post();
          $post = $posts::find($id);
          if($request->file('image') != null){
            try{
              $path = $request->file('image')->storeOnCloudinary()->getSecurePath();
              $resize_path = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'uploads',
                'transformation' => [
                  'width' => 500,
                  'height' => 500
                  ]])->getSecurePath();
                  $post->image = $path;
                  $post->image_resize = $resize_path;
                  dump($path);
                }catch(Exception $e){
                  return ['message'=>"Sorry we can't upload your image"];
                }
              }
              if($request->input('title') != null){
                $post->title = $request->input('title');
              }
              if($request->input('category')){
                $post->categories_id = $request->input('category');
              }
              if($request->input('contents')){
                $post->contents = $request->input('contents');
              }
              $post->updated_by = $check_user->id;
              $post->save();
              return ['message'=>"Your post update successfuly"];
            }catch(Exception $e){
              return ['message'=>"Sorry we can't update your post"];
            }
          }

          /**
          * Remove the specified resource from storage.
          *
          * @param  int  $id
          * @return \Illuminate\Http\Response
          */
          public function destroy(Request $request, $id)
          {
            $check_user = DB::table('users')->where('api_token',$request->header('USER-TOKEN'))->get()->first();
            if($check_user == null)
              return ['message'=>"Sorry we can't authenticate who are you, please try again"];
            $check_posts = DB::table('posts')->where([['id',$id],['created_by',$check_user->id]])->get()->first();
            if($check_posts == null)
              return ['message'=>"Sorry you can't delete post which you not create"];
              $posts = new Post();
              $post = $posts::find($id);
              $post->updated_by = $check_user->id;
              $post->delete_status = 1;
              $post->save();
            return ['message'=>'Your post was deleted'];
          }

          public function search(Request $request){
            $query    = DB::table('posts')
            ->select(['posts.*','categories.name as categories_name'])
            ->join('categories','categories.id','=','posts.categories_id')
            ->where([
              ['posts.delete_status',0],
            ]);

            if($request->input('keyword') != null)
            $query->where('title','like','%'.$request->input('keyword').'%');
            if($request->input('category') != '0' && $request->input('category') != null)
            $query->where('categories_id',$request->input('category'));
            switch ($request->input('sort')) {
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
