<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    protected $table = 'tvs';

    protected $fillable = [
       'user_id', 'title', 'url', 'status', 'stream', 'information',
    ];
    
    public function user(){
    return $this->belongsTo(User::class);
    }

}
