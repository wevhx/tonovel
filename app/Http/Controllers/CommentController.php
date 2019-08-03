<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Chapter;
use App\People;
use App\Publisher;
use App\Group;
use App\News;
use Auth;

class CommentController extends Controller
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
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
    // 
    public function sendCommentAPI(Request $request){
        @$userid = Auth::user()->id;
        if(!empty($userid)){
            // 0 as novel , 1 as chapter , 2 as group , 3 as artist , 4 as publisher , 5 as etc ...
            if($request->loca == 1){
            $linking = Chapter::where('slug','=',$request->object)->first();
            }elseif($request->loca == 2){
                $linking = Group::where('slug','=',$request->object)->first();
            }elseif($request->loca == 3){
                $linking = People::where('ppl_slug','=',$request->object)->first();
            }elseif($request->loca == 4){
                $linking = Publisher::where('slug','=',$request->object)->first();
            }elseif($request->loca == 5){
                $linking = User::where('name','=',$request->object)->first();
            }elseif($request->loca == 6){
                $linking = News::find($request->object);
            }else{
                $linking = false;
            }
            if($linking  == true && strlen($request->messsage) > 1 && preg_match('/^[0-9 +-]+$/',$request->loca) && preg_match('/^[0-9 +-]+$/',$request->reply)){
                // store in the database
                $komentar = new Comment;
                $komentar->komentar_type = 1;
                $komentar->user_id = Auth::user()->id;
                $komentar->komentar_object = $request->object;
                $komentar->komentar_content = $request->messsage;
                $komentar->komentar_loca = $request->loca;
                if(empty($request->reply)) $request->reply = 0;
                $komentar->komentar_reply = $request->reply;
                $komentar->save();
                $komen['id'] = $komentar->id;
                $komen['message'] = $komentar->komentar_content;
                $komen['date'] = $komentar->created_at->timestamp;
                $komen['user'] = Auth::user();
                $arr = array('response'=>1,'data'=>$komen);
                return $arr;
            }else{
                if(empty($request->message)) $error = 'Referensi komentar tidak ditemukan';
                if(empty($request->loca)) $error = 'Path tak boleh kosong';
                $arr = array('response'=>0,'data'=>$error);
                return $arr;
            }
        }else{
        $arr = array('response'=>0,'data'=>'Login untuk berkomentar');
        return $arr;
    }
    }
    public function getCommentAPI($id){
        $query=  Input::get('reply');
        if($query){
        $comment = Comment::where('komentar_type','=',1)->where('komentar_object','=',$id)->where('komentar_reply','=',$query)->orderBy('created_at','desc')->get();
        if($comment == false){
            $arr = array('response'=>'Success','reply'=>[]);
            return json_encode($arr);
        }else{
            $i = 0;
            foreach($comment as $comm){
                
                $total = Comment::where('komentar_reply','=',$comm->id)->count();
                if($total != 0){
                    $komen[$i]['totalc'] =  $total;
                }else{
                    $komen[$i]['totalc'] = 0;
                }
                $komen[$i]['id'] = $comm->id;
                $komen[$i]['message'] = $comm->komentar_content;
                $komen[$i]['date'] = $comm->created_at->timestamp;
                $komen[$i]['user'] = $comm->users;
                $i++;
            }
            if(!isset($komen)) $komen = array();
            $arr = array('response'=>'Success','reply'=>$komen);
            return $arr;
        }
        }else{
            $comment = Comment::where('komentar_type','=',1)->where('komentar_object','=',$id)->where('komentar_reply','=',0)->orderBy('created_at','desc')->get();
            if($comment == false){
                $arr = array('response'=>'Success','comment'=>[]);
                return json_encode($arr);
            }else{
                $i = 0;
                foreach($comment as $comm){
                    $total = Comment::where('komentar_reply','=',$comm->id)->count();
                    if($total != 0){
                        $komen[$i]['totalc'] =  $total;
                    }else{
                        $komen[$i]['totalc'] = 0;
                    }
                    $komen[$i]['id'] = $comm->id;
                    $komen[$i]['message'] = $comm->komentar_content;
                    $komen[$i]['date'] = $comm->created_at->timestamp;
                    $komen[$i]['user'] = $comm->users;
                    $i++;
                }
                if(!isset($komen)) $komen = array();
                $arr = array('response'=>'Success','comment'=>$komen);
                return $arr;
            }
        }
    }
}
