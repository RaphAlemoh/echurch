<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;

class CommentController extends Controller
{

    public function index(){

        return view('blog.comment.index');

    }

    public function comment(Request $request){

        $post_id = $request->post_id;
    
        if(Auth::user()){
        $user_id = Auth::user()->id;
            $this->validate($request, [
                'comment' => 'required|string|max:255',
        ]);
        $data['user_id'] = $user_id;
        }

        if(!Auth::user()){
        $this->validate($request, [
                'comment' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email ;
        }

        $data['comment'] = $request->comment;
        $data['post_id'] = $post_id;

        $comment = Comment::create($data);

        if($comment){
            return redirect()->back()->with('success_msg', 'Your comment will be approved shortly!');
        }else{
            return redirect()->back()->withErrors('Comment not successfully!');
        }

    }



    public function edit(Request $request){

        if($request->ajax()){
            $user_id = $request->user_id;
            $comment_id = $request->comment_id;
            $comment = Comment::where(['user_id' => $user_id, 'id' => $comment_id])->first();
            if(!empty($comment)){
            return response()->json(array(
                'message' => $comment->comment,
                'status' => 1
            ), 200);   

            }else{
                return response()->json(array(
                    'message' => 'No comment found!',
                    'status' => 0
                ), 200);  
            }
 
    
        }
    }



    public function delete(Request $request){
        $user_id = Auth::user()->id;
        $comment_id = $request->comment_id;
        $comment = Comment::where(['id' => $comment_id, 'user_id' => $user_id])->delete(); 
        if ($comment)
        {
            return redirect('users');
        }  
    }


}
