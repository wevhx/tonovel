<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function chapters()
    {
        return $this->hasMany('App\Chapter');
    }
    public function admins()
    {
        return $this->belongsTo('App\User','staff');
    }
    public function members()
    {
        return $this->belongsTo('App\User','member');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function projects()
    {
        return $this->belongsToMany('App\Novel');
    }
}
