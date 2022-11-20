<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    public function getAllPost ()
    {
        $post = Post::get();

        return response()->json([
            'status' => 'success',
            'post' => $post
        ]);
    }

    public function postSearch(Request $request){
        $posts = Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' => $posts
        ], 200);
    }

    public function postDetails(Request $request){
        $posts = Post::where('post_id',$request->postId)->first();

        return response()->json([
            'post' => $posts
        ], 200);
    }
}
