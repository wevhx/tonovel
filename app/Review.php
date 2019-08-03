<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    public function novels()
    {
        return $this->belongsTo('App\Novel','novel_id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
