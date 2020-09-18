<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail());
    }

    public function authorizeRoles($roles){
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
            dd('something is wrong here');
        }
        return $this->hasRole($roles) || dd('No such role error');
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
    return null !== $this->roles()->where('name', $role)->first();
    }    

    public function avatarUrl(){

        return 'images/profile/'.$this->avatar_url;
    }


    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }


    public function user_streaming(){
        return $this->hasMany(Tv::class);
    }


    public function user_media(){
        return $this->hasMany(Media::class);
    }
    
}
