<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Related extends Model
{
    //
    protected $table = 'novel_related';
    public function novels()
    {
    	return $this->belongsto('App\Novel','novel_to');
    }
}
