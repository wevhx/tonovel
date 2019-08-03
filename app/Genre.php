<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    public function novels()
    {
        return $this->belongsToMany('App\Novel');
    }
}
