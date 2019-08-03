<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    //
    protected $hidden = ['id','created_at','updated_at'];

    public function novels()
    {
        return $this->belongsTo('App\Novel','novel_id');
    }
}
