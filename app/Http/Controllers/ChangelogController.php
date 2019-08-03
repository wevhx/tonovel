<?php

namespace App\Http\Controllers;

use App\Changelog;
use Illuminate\Http\Request;

class ChangelogController extends Controller
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
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function show(Changelog $changelog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function edit(Changelog $changelog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Changelog $changelog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Changelog  $changelog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Changelog $changelog)
    {
        //
    }
    public function kontribhistory(){
        $konten = Changelog::paginate(10);
        return view('kontribusi.index')->withKontens($konten);
    }
    public function preview(Request $request,$id){
        $konten = Changelog::find(base64_decode($id));
        if($konten == false){
            return abort(404);
        }
        if(strpos($konten->changed,'people')){
            return view('kontribusi.preview.people')->withKontens($konten);
        }elseif(strpos($konten->changed,'novel')){
            return view('kontribusi.preview.novel')->withKontens($konten);
        }else{
            return 'Preview tak tersedia';
        }
    }
}
