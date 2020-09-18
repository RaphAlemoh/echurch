<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Auth;

class ReplyController extends Controller{

    public function reply(Request $request){

        $comment_id = $request->comment_id;
        
        $user_id = Auth::user()->id;
            $this->validate($request, [
                'reply' => 'required|string|max:255',
        ]);
        $data['user_id'] = $user_id;
        $data['comment_id'] = $comment_id;
        $data['reply'] = $request->reply;
        $reply = Reply::create($data);
        
        if($reply){
            return redirect()->back()->with('success_msg', 'Your reply will be approved shortly!');
        }else{
            return redirect()->back()->withErrors('reply not successfully!');
        }
        
        }
        
        

    public function edit(Request $request){

        if($request->ajax()){
            $user_id = $request->user_id;
            $reply_id = $request->reply_id;
            $reply = Reply::where(['user_id' => $user_id, 'id' => $reply_id])->first();
            if(!empty($reply)){
            return response()->json(array(
                'id' => $reply->id,
                'message' => $reply->reply,
                'status' => 1
            ), 200);   

            }else{
                return response()->json(array(
                    'message' => 'No reply found!',
                    'status' => 0
                ), 200);  
            }
 
    
        }
    }



    public function update(Request $request){
        $user_id = Auth::user()->id;
            $this->validate($request, [
                'reply' => 'required|string|max:255',
        ]);
        $data['reply'] = $request->reply;
        $update = Reply::where(['user_id' => $user_id, 'id' => $request->reply_id])->update($data);
        if($update){
            return redirect()->back();
        }

    }


    public function delete(Request $request){
        $user_id = Auth::user()->id;
        $reply_id = $request->reply_id;
        $reply = Reply::where(['id' => $reply_id, 'user_id' => $user_id])->delete(); 
        if ($reply)
        {
            return redirect()->back()->withErrors('Reply deleted!');
        }  
    }


}
