<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Novel;
use App\Library;
use App\Chapter;
use App\Comment;
use App\People;
use App\Group;
use DB;
use Image;
class UserController extends Controller
{
    //
    public function page()
    {
        $user = User::orderBy('total_exp','DESC')->take(6)->get();
        $novel = Novel::orderBy('created_at','DESC')->take(6)->get();
        $chapter = Chapter::orderBy('created_at','DESC')->paginate(5);
        $random = Novel::inRandomOrder()->get()->take(5);
        $randomp = People::inRandomOrder()->get()->take(24);
        $comments = Comment::orderBy('created_at','DESC')->take(5)->get();
        $rankn = Library::select(DB::raw('status, novel_id, COUNT(*) as count'))->where('status', '=', 1)->orderBy('score','DESC')->groupBy('status','novel_id')->havingRaw('COUNT(*) > 1')->get();
        return view('home.index')->withComments($comments)->withRanks($rankn)->withRandomp($randomp)->withRandoms($random)->withChapter($chapter)->withNovel($novel)->withUser($user);
    }
    public function comment(Request $request)
    {
        if($request->get('order') == 'asc'){
            $comment = Comment::whereKomentarLoca($request->type)->whereKomentarObject($request->object)->whereKomentarReply(0)->orderBy('created_at','ASC')->paginate(10);    
        }else{
            $comment = Comment::whereKomentarLoca($request->type)->whereKomentarObject($request->object)->whereKomentarReply(0)->orderBy('created_at','DESC')->paginate(10);    
        }
        if($comment == false){
            return abort(404);
        }
        return view('home.comment')->withComments($comment);
    }
    public function getAll(){
        $user = User::paginate('20');
        return view('user.index')->withUser($user);
    }
    public function getRankUser(){
        $user = User::orderBy('total_exp','DESC')->paginate('20');
        return view('ranking.user')->withUser($user);
    }
    public function getRankNovel(){
        $novel = Library::select(DB::raw('status, novel_id, COUNT(*) as count'))->where('status', '=', 1)->orderBy('score','DESC')->groupBy('status','novel_id')->havingRaw('COUNT(*) > 1')->get();
        return view('ranking.novel')->withNovel($novel);
    }
    public function getRankPpl(){
        $people = DB::table('people_user')->join('people', 'people.id', '=', 'people_user.people_id')->select(DB::raw('user_id, people_id, ppl_name, ppl_slug, ppl_thumb, COUNT(*) as count'))->groupBy('user_id','people_id','ppl_name','ppl_slug','ppl_thumb')->havingRaw('COUNT(*) > 1')->get();
        return view('ranking.people')->withPeoples($people);
    }
    public function getUser($id){
        $user = User::whereName($id)->first();
        if($user == false){
            return abort(404);
        }
        return view('user.user')->withUser($user)->withType('beranda');
    }
    public function getGroup($id){
        $group = Group::whereSlug($id)->first();if($group == false){
            return abort(404);
        }
        $chapter = Chapter::where('group_id',$group->id)->orderBy('created_at','DESC')->paginate(5);
        return view('user.group')->withGroups($group)->withChapter($chapter)->withType('beranda');
    }
    public function getUsercat($slug,$cat){
        $user = User::whereName($slug)->first();
        if($user == false){
            return abort(404);
        }
        if(!in_array($cat, array('bacaan','aktifitas','ulasan','rekomendasi','statistik'), true)) abort(404);
        return view('user.user')->withUser($user)->withType($cat);
    }
    public function getGroupcat($slug,$cat){
        $group = Group::whereSlug($slug)->first();
        if($group == false){
            return abort(404);
        }
        if(!in_array($cat, array('proyek','news','stat'), true)) abort(404);
        return view('user.group')->withGroups($group)->withType($cat);
    }
    public function image($slug){
        $novel = Novel::whereSlug($slug)->first();
        $img = Image::cache(function($image) use ($novel) {
            $image->make('uploads/poster/0/'.$novel->thumb)->blur(80)->contrast(5)->brightness(15)->fit(880, 440);
            $watermark = Image::make('uploads/poster/0/'.$novel->thumb);
            $image->insert($watermark, 'center');
        }, 10, true);
        // create a new Image instance for inserting
        return $img->response();
    }
}
