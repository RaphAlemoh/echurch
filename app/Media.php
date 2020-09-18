<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'user_id', 'title', 'minister', 'media', 'type', 'media_path',
        'media_url',  'status',
     ];
     
     public function user(){
     return $this->belongsTo(User::class);
     }
    
}
