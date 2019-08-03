<?php

namespace App\Http\Controllers;

use App\Library;
use App\Novel;
use App\Chapter;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LibraryController extends Controller
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
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Library $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Library  $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        //
    }
    public function getAll()
    {
        $userid=  Input::get('id');
        $lib['status'] = 'success';
        $lib['data'] = Library::where('user_id','=',$userid)->get();
        return $lib;
    }
    public function getEpisode($id)
    {
        @$userid = Auth::user()->id;
        if(!empty($userid)){
        $epi = Input::get('episode');
        $idepi = Input::get('episode_id');
        if(!preg_match('/^[0-9 +-]*$/',$epi) OR !preg_match('/^[0-9 +-]+$/',$idepi)){
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Validasi data yg diberikan gagal';
            return $j;
        }else{
        $libr = Library::where('novel_id','=',$id)->where('user_id','=',$userid)->first();
        $ani = Novel::find($id);
        if($libr != false && $ani->id == $libr->novel_id){
            $lib = Library::find($libr->id);
            $lib->novel_id = $ani->id;
            $lib->user_id = $userid;
            if(!isset($epi)) $epi = 0;
            if(!isset($idepi)) $idepi = 0;
            $lib->loved = 0;
            $lib->status = 1;
            $lib->score = 0;
            $lib->last_numba = $epi;
            $lib->last_read_date = new \DateTime();
            $lib->save();
            $j['error'] = 200;
            $j['status'] = 'success';
            $j['msg'] = 'Berhasil update library';
            return $j;
        }elseif($libr == false && $ani == true){
            $lib = new Library;
            $lib->novel_id = $ani->id;
            $lib->user_id = $userid;
            if(!isset($epi)) $epi = 0;
            if(!isset($idepi)) $idepi = 0;
            $lib->loved = 0;
            $lib->status = 1;
            $lib->score = 0;
            $lib->last_numba = $epi;
            $lib->last_read_date = new \DateTime();
            $lib->save();
            $j['error'] = 200;
            $j['status'] = 'success';
            $j['msg'] = 'Berhasil menambahkan ke library';
            return $j;

        }else{
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Tidak bisa menambahkan ke library sesuatu yg tiada';
            return $j;
        }
        }
        }else{
            $j['error'] = 401;
            $j['status'] = 'failed';
            $j['msg'] = 'Authentication required';
            return $j;
        }

    }
    public function getScore($id)
    {
        @$userid = Auth::user()->id;
        if(!empty($userid)){
        $skor = Input::get('score');
        if(!preg_match('/^[0-9. +-]*$/',$skor)){
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Validasi data yg diberikan gagal';
            return $j;
        }else{
        $libr = Library::where('novel_id','=',$id)->where('user_id','=',$userid)->first();
        $ani = Novel::find($id);
        if($libr != false && $ani->id == $libr->novel_id){
            $lib = Library::find($libr->id);
            $lib->novel_id = $ani->id;
            $lib->user_id = $userid;
            if($skor > 10) $skor = 5;
            $lib->score = $skor;
            $lib->save();
            $j['error'] = 200;
            $j['status'] = 'success';
            $j['msg'] = 'Berhasil update skor';
            return $j;
        }elseif($libr == false && $ani == true){
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Novel ini tidak ada di librarymu';
            return $j;
        }else{
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Tidak bisa update kelibrary sesuatu yg tiada';
            return $j;
        }
        }
        }else{
            $j['error'] = 401;
            $j['status'] = 'failed';
            $j['msg'] = 'Authentication required';
            return $j;
        }
    }
    public function getFavorite($id)
    {
        @$userid = Auth::user()->id;
        if(!empty($userid)){
        $loved = Input::get('favorite');
        if(!preg_match('/^[0-1]*$/',$loved)){
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Validasi data yg diberikan gagal';
            return $j;
        }else{
        $libr = Library::where('novel_id','=',$id)->where('user_id','=',$userid)->first();
        $ani = Novel::find($id);
        if($libr != false && $ani->id == $libr->novel_id){
            $lib = Library::find($libr->id);
            $lib->novel_id = $ani->id;
            $lib->user_id = $userid;
            if($loved > 1) $loved = 1;
            $lib->loved = $loved;
            $lib->save();
            $j['error'] = 200;
            $j['status'] = 'success';
            $j['msg'] = 'Berhasil mengupdate favorite';
            return $j;
        }elseif($libr == false && $ani == true){
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Novel ini tidak ada di librarymu';
            return $j;
        }else{
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Tidak bisa update kelibrary sesuatu yg tiada';
            return $j;
        }
        }
        }else{
            $j['error'] = 401;
            $j['status'] = 'failed';
            $j['msg'] = 'Authentication required';
            return $j;
        }

    }
    public function getStatus($id)
    {
        @$userid = Auth::user()->id;
        if(!empty($userid)){
        $status = Input::get('status');
        if(!preg_match('/^[1-5]*$/',$status)){
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Validasi data yg diberikan gagal';
            return $j;
        }else{
        $libr = Library::where('novel_id','=',$id)->where('user_id','=',$userid)->first();
        $ani = Novel::find($id);
        if($libr != false && $ani->id == $libr->novel_id){
            $lib = Library::find($libr->id);
            $lib->novel_id = $ani->id;
            $lib->user_id = $userid;
            if($status > 9) $status = 9;
            $lib->status = $status;
            $lib->save();
            $j['error'] = 200;
            $j['status'] = 'success';
            $j['msg'] = 'Berhasil update status';
            return $j;
        }elseif($libr == false && $ani == true){
            $lib = new Library;
            $lib->novel_id = $ani->id;
            $lib->user_id = $userid;
            if(!isset($epi)) $epi = 0;
            if(!isset($idepi)) $idepi = 0;
            $lib->loved = 0;
            $lib->status = $status;
            $lib->last_numba = 0;
            $lib->score = 0;
            $lib->last_read_date = new \DateTime();
            $lib->save();
            $j['error'] = 200;
            $j['status'] = 'success';
            $j['msg'] = 'Novel ini telah ditambahkan kelibrary kamu';
            return $j;
        }else{
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Tidak bisa update kelibrary sesuatu yg tiada';
            return $j;
        }
        }
        }else{
            $j['error'] = 401;
            $j['status'] = 'failed';
            $j['msg'] = 'Authentication required';
            return $j;
        }
    }
    public function getDelete($id)
    {
        @$userid = Auth::user()->id;
        if(!empty($userid)){
        $libr = Library::where('novel_id','=',$id)->where('user_id','=',$userid)->first();
        $ani = Novel::find($id);
        if($libr != false && $ani->id == $libr->novel_id){
            $lib = Library::find($libr->id);
            $lib->delete();
            $j['error'] = 200;
            $j['status'] = 'success';
            $j['msg'] = 'Berhasil menghapus Novel dari library';
            return $j;
        }elseif($libr == false && $ani == true){
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Novel ini tidak ada / sudah terhapus dari librarymu';
            return $j;
        }else{
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Tidak bisa menghapus library yg tiada';
            return $j;
        }
        }else{
            $j['error'] = 401;
            $j['status'] = 'failed';
            $j['msg'] = 'Authentication required';
            return $j;
        }
    }
}
