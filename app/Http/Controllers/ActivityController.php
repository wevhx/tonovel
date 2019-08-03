<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use DB;
class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
    public static function cek($id,$type,$action,$object){
        $today = date("Y-m-d");
        $check = Activity::where('type',$type)->where('user_id',$id)->where('action',$action)->where('object',$object)->whereDate('created_at', DB::raw('CURDATE()'))->get();
        if($check == false){
            return true;
        }else{
            return false;
        }
    }
    public static function akt($id,$type,$action,$object){
        if(ActivityController::cek($id,$type,$action,$object)){
        $activity = new Activity;
        $activity->user_id = $id;
        $activity->type = $type;
        $activity->action = $action;
        $activity->object = $object;
        $activity->view = 1;
        $activity->save();    
        }
    }
}
