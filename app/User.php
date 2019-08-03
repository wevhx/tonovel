<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email','opt_size','opt_font','opt_color','bio','gender','location','type','total_exp','created_at','updated_at'
    ];
    public function library()
    {
    	return $this->hasMany('App\Library');
    }
    public function reviews()
    {
    	return $this->hasMany('App\Review');
    }
    public function activity()
    {
    	return $this->hasMany('App\Activity');
    }
}
