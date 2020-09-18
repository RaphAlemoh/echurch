<?php

use Carbon\Carbon;
use App\Comment;

function formatDate($date)
{
    return Carbon::parse($date)->format('d M, Y');
}


function presentYear()
{
    return Carbon::now()->format('Y');
}


function show_name($data){
    if ( $data->user_id != ''){
       return  firstChracterUC($data->user->name);
    }else{
       return firstChracterUC($data->name);
    }
}

function firstChracterUC($letter){
    return ucfirst($letter);
}



function adminNotify($user_is_authenticated){
    if(!empty($user_is_authenticated)){
        $comment_notifications = Comment::select('id')->where(['status' => false])->get();
        return $comment_notifications;
    }

}