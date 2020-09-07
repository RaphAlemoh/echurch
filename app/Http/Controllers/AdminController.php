<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Media;
use App\Chat;
use App\Message;
use App\Subscriber;
use Auth;


class AdminController extends Controller
{
    public function dashboard(){
        $users = User::all()->count();
        $media = Media::all()->count();
        $chats = Chat::all()->count();
        $subscribers = Subscriber::all()->count();
        $new_messages = Message::all()->where('status', '=', '0');
         return view('admin.index')->with(compact('users', 'media', 'chats', 'new_messages', 'subscribers'));
    }

    public function settings(){
        return view('admin.settings');
    }

      public function checkPwd(Request $request){
        $current_pwd = $request->get('current_pwd');
        $check_password = Auth::user();
        if(Hash::check($current_pwd, $check_password->password)){
           return true;
        }else{
           return false;
        }            
    }


      public function updatePwd(Request $request){
        if($request->isMethod('post')) {
            $this->validate($request, [
                'current_pwd' => ['required', 'string', 'min:8'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            $data = $request->all();
            $check_email = User::select('email')->where('email', Auth::user()->email)->first();
            $check_password = Hash::check($data['current_pwd'], Auth::user()->password);
            if($check_password && $check_email){
                $password = bcrypt($data['password']);
                $updatePassword = User::where('email', $check_email['email'])->update(['password' => $password]);
                if($updatePassword){
                    return redirect()->back()->with('success_msg', 'Password Updated successfully!');
                }else{
                    return redirect()->back()->withErrors('Password Update not successfully!');
                }
            }
        }
    }
}
