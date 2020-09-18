<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function blog(){
        $posts = Post::where('status', true)->paginate(5);
        return view('blog.blog')->with(compact(['posts']));
    }

    public function show(Request $request){
        $id = $request->id;
        $post = Post::where('id', $id)
        ->with(['comments' => function ($query){
            $query->where('status', true);
        }])
        ->first();
        return view('blog.show')->with(compact('post'));
    }

}
