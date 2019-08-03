<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $primaryKey = 'id';
    //
    public function novels()
    {
        return $this->belongsTo('App\Novel','novel_id');
    }
    public function groups()
    {
        return $this->belongsTo('App\Group','group_id');
    }
    public function differ()
    {
        return $this->hasmany('App\Differ');
    }
}
