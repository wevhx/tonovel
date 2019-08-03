<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Group;
use App\Novel;
use App\Chapter;
use Auth;
use DB;
class NewsController extends Controller
{
    //
    public function lihat($id)
    {
        $news = News::find($id);
        return view('news.show')->withNews($news);
    }
    public function getGroupNews($slug,$id){
        $groups = Group::whereSlug($slug)->first();
    if($groups->staff == @Auth::user()->id OR in_array(@Auth::user()->id, json_decode($groups->member))){
    $news = News::find($id);
    return view('group.update')->withNews($news)->withGroups($groups)->withType('news');
    }else{
        return abort(404);
    }
    }
    public function creategroupnews(Request $request,$id)
    {    
    $groups = Group::whereSlug($id)->first();
    if($groups->staff == @Auth::user()->id OR in_array(@Auth::user()->id, json_decode($groups->member))){
        $messages = [
        'content.required' => 'Isi tidak boleh kosong',
        'title.required' => 'Judul tidak boleh kosong',
        ];
        $this->validate(request(), [
            'title' => 'required',
            'content' => 'required'
        ],$messages);
        $news = new News;
        $news->type = 1;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->status = 1;
        $news->object = $groups->id;
        $news->save();
        request()->session()->flash('success', ' Berhasil membuat berita !!');
        return redirect()->route('group.group',$groups->slug);
        }else{
            request()->session()->flash('danger', 'Membuat berita tidak tersedia saat ini !!');
            return redirect()->route('group.group',$groups->slug);
        }
    }
    public function deletegroupnews()
    {

    }
    public function updatenews(Request $request,$slug,$id)
    {   
        $groups = Group::whereSlug($slug)->first();
        if($groups->staff == @Auth::user()->id OR in_array(@Auth::user()->id, json_decode($groups->member))){
        $messages = [
        'content.required' => 'Isi tidak boleh kosong',
        'title.required' => 'Judul tidak boleh kosong',
        ];
        $this->validate(request(), [
            'title' => 'required',
            'content' => 'required'
        ],$messages);
        $news = News::find($id);
        $news->title = $request->title;
        $news->content = $request->content;
        $news->status = $request->status;
        $news->save();
        request()->session()->flash('success', ' Berhasil mengubah berita !!');
        return redirect()->route('group.viewnews',['slug'=>$groups->slug,'id'=>$id]);
        }else{
            request()->session()->flash('danger', 'Mengubah berita tidak tersedia saat ini !!');
            return redirect()->route('group.viewnews',['slug'=>$groups->slug,'id'=>$id]);
        }

    }
}
