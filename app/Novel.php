<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    //
    
    public function genres(){
        return $this->belongsToMany('App\Genre');
    }
    public function peoples()
    {
    	return $this->belongsToMany('App\People')->withPivot('type');
    }
    public function category()
    {
    	return $this->belongsTo('App\Category','type');
    }
    public function publishers()
    {
    	return $this->belongsToMany('App\Publisher');
    }
    public function relateds()
    {
    	return $this->hasmany('App\Related');
    }
    public function chapters()
    {
        return $this->hasmany('App\Chapter');
    }
    public function reviews()
    {
        return $this->hasmany('App\Review');
    }
    public function library()
    {
        return $this->hasmany('App\Library');
    }
    public function groups()
    {
        return $this->hasmany('App\Chapter');
    }
}
