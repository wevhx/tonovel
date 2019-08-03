<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    //
    public function novels()
    {
    	return $this->belongsToMany('App\Novel');
    }
    public function chapters()
    {
    	return $this->belongsToMany('App\Chapter');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
