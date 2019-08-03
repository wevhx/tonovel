<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;
use \Torann\GeoIP\Facades\GeoIP;
use App\Chapter;
use App\Group;
use App\Novel;
use DB;
use CryptoJSAES;
use Response;
use Illuminate\Http\Request;

class ChapterController extends Controller
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
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        //
    }
    public function getChapterAPI(Request $request,$id){
        $keyword = $request->search['value'];
        $data = Chapter::where('novel_id', $id)->select(['id','desc','slug', 'numba', 'volume', 'title']);
         return Datatables::of($data)
            ->filter(function ($query) use ($keyword) {
                if(!$keyword){
                $query->orderBy(DB::raw("CAST('numba' AS DECIMAL(2,1))"));
                }else{
                $query->where("title", "LIKE", "%{$keyword}%")->orderBy(DB::raw("CAST('numba' AS DECIMAL(2,1))"));
                }
            })
            ->addColumn('volume', function ($data) {
                return 'V'.$data->volume.'B'.$data->numba;
            })->addColumn('action', function ($data) {
                return '<a href="/read/'.$data->slug.'" class="btn btn-sm btn-default" title="Baca Sekarang"><i class="glyphicon glyphicon-eye-open"></i> Baca</a>';
            })
            ->escapeColumns()
            ->editColumn('chapter', '#{{$numba}}')
             ->make(true);
    }
    public function lihat(Request $request,$id){
        $chapter = Chapter::where('slug','=',$id)->first();
        $header = $request->header('ToNovel');
        if($chapter == true){
            if($header == '1'){
                $text['chapter'] = $chapter->title;
                @$prev = Chapter::where('numba', $chapter->numba-1)->where('novel_id',$chapter->novel_id)->first();
                @$next = Chapter::where('numba', $chapter->numba+1)->where('novel_id',$chapter->novel_id)->first();
                @$diff = $chapter->differ->sortByDesc('id');
                @$konten = current($diff);
                @$return = reset($konten);
                $text['content'] = @str_replace('<img','<img width="100%" height="100%" class="img-responsive centered"',$return->content);
                $text['group'] = @$chapter->groups->name;
                $text['group_slug'] = $chapter->groups->slug;
                $text['source'] = $chapter->content;
                $text['chapter'] = $chapter->title;
                $text['novel_id'] = $chapter->novel_id;
                $text['chapter_id'] = $chapter->id;
                $text['chapter_slug'] = $chapter->slug;
                $text['next_cap'] = @$next->slug;
                $text['before_cap'] = @$prev->slug;
                $text['differ'] = $chapter->differ->count();
                $text['views'] = $chapter->total_views;
                $text = json_encode($text);
                $key = "tonovelcryptokey";
                $response = Response::make(view('novel.read')->withChapter($chapter)->withNext($next)->withPrev($prev), 200);
                $response->header('ToNovelKey', CryptoJSAES::encrypt($text, $key));
                return $response;
            }else{
                @$prev = Chapter::where('numba', $chapter->numba-1)->where('novel_id',$chapter->novel_id)->first();
                @$next = Chapter::where('numba', $chapter->numba+1)->where('novel_id',$chapter->novel_id)->first();
                return view('novel.read')->withChapter($chapter)->withNext($next)->withPrev($prev);
            }
        }else{
            return abort(404);
        }
    }
    
    public function tampil($id){
        DB::enableQueryLog();
        $chapter = Chapter::where('slug','=',$id)->first();
        $j['info'] = $chapter;
        $j['novel'] = $chapter->novels;
        $j['differ'] = $chapter->differ;
        //$j['raw'] = (DB::getQueryLog());
        return dd(DB::getQueryLog());
    }
}
