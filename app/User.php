<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role', 'email','phone', 'fb', 'blood_group', 'last_donated', 'about', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->belongsTo('App\Post', 'id', 'postedBy');
    }


    /** Online visitor checking method **/
    public function isOnline() {
        return Cache::has('user-is-online-' . $this->id);
    }
}
