<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
class StatisController extends Controller
{
    //
    public function show($slug) {
		$methodName = camel_case($slug);
		if ( ! method_exists($this, $methodName)) {
			return $this->loadViewFromSlug($slug); 
		}
		return $this->$methodName();
	}
	// You can override a slug2view behavior
	protected function yourCustomMethod()
	{
        	// Return whatever you want
        	return view('static.your_view');
	}
	protected function loadViewFromSlug($slug)
	{
            $slug = $this->slugToSnakeCase($slug);
            if(!ctype_upper($slug)){
	        try {
	        	return view("static.{$slug}");
	        } catch (\InvalidArgumentException $e) {
	        	abort(404);
	        }}else{
	        	abort(404);
            }
	}
	protected function slugToSnakeCase($slug) {
		return str_replace('-', '_', $slug);
	}
}
