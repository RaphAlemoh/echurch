<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;




class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('blog.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'slug'  => 'required|alpha_dash|unique:posts,slug',
            'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = 1;
        $post = auth()->user()->posts()->save($post);
        if($post){
            return redirect()->back()->with('success_msg', 'Post published successfully!');
        }else{
            return redirect()->back()->withErrors('Post not published!');
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
        $post = Post::find($id);
        return view('blog.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('blog.posts.edit')->with(compact(['post']));
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
        $post = Post::find($id);
        
        $this->validate($request,[
            'title' => 'required',
            'slug'  => 'required|alpha_dash',
            'body' => 'required'
        ]);

        $data['title'] = $request->title;
        $data['slug'] = $request->slug;
        $data['body'] = $request->body;
        $data['user_id'] = auth()->user()->id;
        $post->update($data);
        if($post){
            return redirect()->back()->with('success_msg', 'Post updated successfully!');
        }else{
            return redirect()->back()->withErrors('Post not update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id); 
        if ($post->delete())
        {
            return redirect('posts');
        }  
    }
}
