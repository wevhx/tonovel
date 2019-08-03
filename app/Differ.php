<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Differ extends Model
{
    //
    public function chapters()
    {
    	return $this->hasMany('App\Chapter');
    }
    public function users()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
