<?php

namespace App\Http\Controllers;

use App\Differ;
use App\Chapter;
use Illuminate\Http\Request;
use Auth;
class DifferController extends Controller
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
     * @param  \App\Differ  $differ
     * @return \Illuminate\Http\Response
     */
    public function show(Differ $differ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Differ  $differ
     * @return \Illuminate\Http\Response
     */
    public function edit(Differ $differ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Differ  $differ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Differ $differ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Differ  $differ
     * @return \Illuminate\Http\Response
     */
    public function destroy(Differ $differ)
    {
        //
    }
    public function getDiff($id)
    {
        $chapter = Chapter::whereSlug($id)->first();
        if($chapter == false){
            return abort(404);
        }else{
            $diff = Differ::where('chapter_id',$chapter->id)->paginate(10);
            return view('diff.show')->withDiffer($diff)->withChapter($chapter);
        }
        
    }
    public function EditorDiff(Request $request,$id)
    {
        $chapter = Chapter::whereSlug($id)->first();
        if($request->diff == 'yes'){
            $messages = [
                'content.required' => 'Deskripsi tidak boleh kosong'
            ];
            $this->validate(request(), [
                'content' => 'required',
            ],$messages);
            $diff = new Differ;
            if(isset($request->lastdiff)){
            $diff->lastdiff = strip_tags($request->lastdiff);
            }else{
                $diff->lastdiff = 0; 
            }
            $diff->type = 1;
            $diff->chapter_id = $chapter->id;
            $diff->user_id = Auth::user()->id;
            $diff->comment = $request->comment;
            $diff->content = $request->content;
            $diff->save();
            request()->session()->flash('success', ' Berhasil menambahkan data !');
            return redirect()->route('diff.show',$chapter->slug);
        }elseif($request->changed == 'yes'){
            
        }else{
            
        if($chapter == false){
            return abort(404);
        }else{
            if($request->last){
                $diff = Differ::where('chapter_id',$chapter->id)->where('id',$request->last)->orderBy('created_at','DESC')->first();
            }else{
                $diff = Differ::where('chapter_id',$chapter->id)->orderBy('created_at','DESC')->first();
            }return view('diff.create')->withDiffer($diff)->withChapter($chapter);
        }
        }
        
    }
}
