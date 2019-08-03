<?php

namespace App\Http\Controllers;

use App\People;
use App\Novel;
use App\Chapter;
use App\Changelog;
use DB;
use Illuminate\Http\Request;
use ToNovel;
use Auth;
use Image;
class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::paginate(20);
        return view('kontribusi.people.index')->withPeoples($people);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kontribusi.people.create');
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
        $all = $request->all();
        $messages = [
            'ppl_thumb.required' => 'Avatar tidak boleh kosong',
            'ppl_thumb.image' => 'Avatar haruslah berbentuk gambar',
            'ppl_thumb.mimes' => 'Dengan format jenis jpeg,png,jpg,gif',
            'ppl_thumb.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ];
        $thumb = '';
        if(!empty($request->hasFile('ppl_thumb'))) $thumb = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';        
        $this->validate(request(), [
            'ppl_thumb' => $thumb,
            'ppl_name' => 'required',
            'ppl_alt' => 'required',
            'ppl_type' => 'required',
        ],$messages);
        @$userimg = $request->file('ppl_thumb');
        if(!empty($request->hasFile('ppl_thumb'))) $filename = md5($userimg->getClientOriginalName()) . '.' . $userimg->getClientOriginalExtension();
        if(Auth::user()->type > 0){
            $people = new People;
            $people->ppl_name = $request->ppl_name;
            $people->ppl_alt = $request->ppl_alt;
            $people->ppl_country = $request->ppl_country;
            $people->ppl_slug = ToNovel::slugify($request->ppl_name);
            $people->ppl_type = $request->ppl_type;
            if(!empty($request->hasFile('ppl_thumb'))){
                $people->ppl_thumb = $filename;
            Image::make($userimg)->resize(100, 100)->save( public_path('uploads/people/0/' . $filename ) );
            }
            $people->ppl_bio = $request->ppl_bio;
            $people->ppl_link = $request->ppl_link;
            $people->ppl_birthday = $request->ppl_birthday;
            $people->save();
            request()->session()->flash('success', ' Penulis/Ilustrator berhasil ditambahkan !');
            return redirect()->route('people.index');
        }else{
            $all['images'] = $filename;
            Image::make($userimg)->resize(77, 100)->save( public_path('uploads/poster/0/' . $filename ));
            $changelog = new Changelog;
            $changelog->changed = 'npeople';
            $changelog->content = json_encode($all);
            $changelog->user_id = Auth::user()->id;
            $changelog->status = 0;
            $changelog->type = 0;
            $changelog->save();
            request()->session()->flash('success', ' Penulis/Ilustrator berhasil ditambahkan dan masuk ke daftar antrian !');
            return redirect()->route('people.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function edit(People $people,$slug)
    {
        $people = People::wherePplSlug($slug)->first();
        return view('kontribusi.people.update')->withPeople($people);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, People $people,$id)
    {
        $all = $request->all();
        $messages = [
            'ppl_thumb.required' => 'Avatar tidak boleh kosong',
            'ppl_thumb.image' => 'Avatar haruslah berbentuk gambar',
            'ppl_thumb.mimes' => 'Dengan format jenis jpeg,png,jpg,gif',
            'ppl_thumb.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ];
        $thumb = '';
        if(!empty($request->hasFile('ppl_thumb'))) $thumb = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';        
        $this->validate(request(), [
            'ppl_thumb' => $thumb,
            'ppl_name' => 'required',
            'ppl_alt' => 'required',
            'ppl_type' => 'required',
        ],$messages);
        @$userimg = $request->file('ppl_thumb');
        if(!empty($request->hasFile('ppl_thumb'))) $filename = md5($userimg->getClientOriginalName()) . '.' . $userimg->getClientOriginalExtension();
        if(Auth::user()->type > 0){
            $people = People::find($id);
            $people->ppl_name = $request->ppl_name;
            $people->ppl_alt = $request->ppl_alt;
            $people->ppl_country = $request->ppl_country;
            $people->ppl_slug = ToNovel::slugify($request->ppl_name);
            $people->ppl_type = $request->ppl_type;
            if(!empty($request->hasFile('ppl_thumb'))){
                $people->ppl_thumb = $filename;
            Image::make($userimg)->resize(100, 100)->save( public_path('uploads/people/0/' . $filename ) );
            }
            $people->ppl_bio = $request->ppl_bio;
            $people->ppl_link = $request->ppl_link;
            $people->ppl_birthday = $request->ppl_birthday;
            $people->save();
            request()->session()->flash('success', ' Penulis/Ilustrator berhasil ditambahkan !');
            return redirect()->route('people.index');
        }else{
            if(!isset($filename)) $filename = '';
            $all['images'] = $filename;
            if($filename != ''){
                Image::make($userimg)->resize(100, 100)->save( public_path('uploads/poster/0/' . $filename ));    
            }
            $changelog = new Changelog;
            $changelog->changed = 'upeople';
            $changelog->content = json_encode($all);
            $changelog->user_id = Auth::user()->id;
            $changelog->status = 0;
            $changelog->type = 0;
            $changelog->save();
            request()->session()->flash('success', ' Penulis/Ilustrator berhasil ditambahkan dan masuk ke daftar antrian !');
            return redirect()->route('people.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(People $people)
    {
        //
    }
    public function getRankAttribute()
    {
        return $this->newQuery()->where('people_id', '>=', $this->people_id)->count();
    }
    public function getPeople($id){
        $people = People::where('ppl_slug','=',$id)->first();
        if($people == false){
            return abort(404);
        }
        return view('novel.people')->withPeople($people);
    }
    public function followor(Request $request,$id){
        $people = People::where('ppl_slug','=',$id)->first();
        if($people == false OR !isset(Auth::user()->id)){
            return abort(404);
        }
        $follow = DB::table('people_user')->where('people_id',$people->id)->where('user_id',Auth::user()->id)->get();
        if($follow->isEmpty()){
            $add = DB::table('people_user')->insert(
                ['people_id' => $people->id, 'user_id' => Auth::user()->id]
            );
            request()->session()->flash('success', ' Berhasil mengikuti !!');
            return redirect()->route('author.show',$people->ppl_slug);
        }else{
            DB::table('people_user')->where('people_id',$people->id)->where('user_id',Auth::user()->id)->delete();
            request()->session()->flash('success', ' Berhasil tidak mengikuti !!');
            return redirect()->route('author.show',$people->ppl_slug);
        }
    }
    public function tampil(){
        DB::enableQueryLog();
        $j['data'] = People::find(1)->novels;
        $j['raw'] = (DB::getQueryLog());
        return ($j);
    }

}
