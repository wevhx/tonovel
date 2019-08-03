<?php

namespace App\Http\Controllers;

use App\Group;
use App\Novel;
use App\Chapter;
use Illuminate\Http\Request;
use Auth;
use DB;
use Image;
use ToNovel;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('group.index');
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
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
    public function groupindex(Request $request){
        if($request->create == 'yes'){
            $messages = [
                'name.required' => 'Nama Group tidak boleh kosong',
                'description.required' => 'Deskripsi tidak boleh kosong'
            ];
            $this->validate(request(), [
                'name' => 'required',
                'description' => 'required',
            ],$messages);
            $group = new Group;
            $group->name = $request->name;
            $group->slug = ToNovel::slugify(strtolower($request->name));
            $group->description = $request->description;
            $group->staff = Auth::user()->id;
            $group->thumb = 'default.png';
            $group->backg = 'default.jpg';
            $group->rightclick = 0;
            $group->adsbox = 0;
            $group->member = '[]';
            $group->save();
            request()->session()->flash('success', ' Berhasil membuat group !');
            return redirect()->route('group.group',$group->slug);
        }
        if($request->join == 'yes'){
            $messages = [
                'code.required' => 'Deskripsi tidak boleh kosong'
            ];
            $this->validate(request(), [
                'code' => 'required',
            ],$messages);
            $group = Group::where('privatekey','=',$request->code)->first();
            if($group == false){
                request()->session()->flash('danger', ' Kode undangan tidak ditemukan!');
                return redirect()->route('group.index');
            }else{
                $groups = Group::find($group->id);
                $array = json_decode($group->member);
                if(empty($groups->member)) $groups->member = '[]';
                if(!in_array(@Auth::user()->id, json_decode($groups->member))){
                if($array == null){
                    $data = "[".Auth::user()->id."]";
                }else{
                    array_push($array,Auth::user()->id);
                    $data = json_encode($array);
                }
                $groups->member = $data;
                $groups->save();
                request()->session()->flash('success', ' Berhasil menjadi anggota group ini!');
                return redirect()->route('group.group',$group->slug);
                }else{
                    request()->session()->flash('danger', ' Kamu sudah menjadi anggota group '.$groups->name);
                    return redirect()->route('group.index');
                }
            }
        }
    }
    public function setting($id){
        $groups = Group::whereSlug($id)->first();
        if(empty($groups->member)) $groups->member = '[]';
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){
        if($groups == false){
            return abort(404);
        }
        return view('group.edit')->withGroups($groups);
        }else{
            return abort(404);
        }
    }
    public function groupset(Request $request,$id){
        $groups = Group::whereSlug($id)->first();
        if($groups->staff == @Auth::user()->id){
        if($groups == false){
            return abort(404);
        }
        if($request->thumb == 'yes'){
            $messages = [
                'thumbs.required' => 'Thumb tidak boleh kosong',
                'thumbs.image' => 'Thumb haruslah berbentuk gambar',
                'thumbs.mimes' => 'Dengan format jenis jpeg,png,jpg,gif',
                'thumbs.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ];
            $this->validate(request(), [
                'thumbs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],$messages);
    		$thumbs = $request->file('thumbs');
    		$filename = md5(time()) . '.' . $thumbs->getClientOriginalExtension();
            Image::make($thumbs)->resize(100, 100)->save( public_path('uploads/group/0/' . $filename ) );
            Image::make($thumbs)->resize(42, 42)->save( public_path('uploads/group/1/' . $filename ) );
            Image::make($thumbs)->resize(25, 25)->save( public_path('uploads/group/2/' . $filename ) );
            $group = Group::find($groups->id);
            $group->thumb = $filename;
            $group->save();
            request()->session()->flash('success', ' Pengaturan thumbnail group diubah !');
            return redirect()->route('group.setting',$group->slug);
        }
        if($request->cover == 'yes'){
            $messages = [
                'backg.required' => 'Cover tidak boleh kosong',
                'backg.image' => 'Cover haruslah berbentuk gambar',
                'backg.mimes' => 'Dengan format jenis jpeg,png,jpg,gif',
                'backg.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ];
            $this->validate(request(), [
                'backg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],$messages);
            $backg = $request->file('backg');
    		$filename = md5(time()) . '.' . $backg->getClientOriginalExtension();
            Image::make($backg)->blur(20)->save( public_path('uploads/group/cover/' . $filename ) );
            $group = Group::find($groups->id);
            $group->backg = $filename;
            $group->save();
            request()->session()->flash('success', ' Pengaturan cover group diubah !');
            return redirect()->route('group.setting',$group->slug);
        }
        if($request->basic =='yes'){
            $messages = [
                'name.required' => 'Nama Group tidak boleh kosong',
                'slug.required' => 'URL Slug khusus tidak boleh kosong',
                'description.required' => 'Deskripsi tidak boleh kosong',
                'rightclick.required' => 'Pilihan tidak boleh kosong',
            ];
            $this->validate(request(), [
                'name' => 'required',
                'slug' => 'required|regex:/[a-z]{1}[a-z0-9\-]*/i',
                'description' => 'required',
                'rightclick' => 'required',
            ],$messages);
            $group = Group::find($groups->id);
            $group->name = $request->name;
            $group->slug = str_replace(' ', '', strtolower($request->slug));
            $group->description = $request->description;
            $group->rightclick = $request->rightclick;
            $group->save();
            request()->session()->flash('success', ' Pengaturan dasar grup diubah !');
            return redirect()->route('group.setting',$group->slug);
        }
        if($request->feed =='off'){
            $group = Group::find($groups->id);
            $group->url = '';
            $group->save();
            request()->session()->flash('success', ' Feed telah dimatikan !');
            return redirect()->route('group.setting',$groups->slug);
        }
        if($request->feed =='yes'){
            $messages = [
                'url.required' => 'Alamat URL tidak boleh kosong',
                'url.active_url' => 'Alamat URL tidak valid'
            ];
            $this->validate(request(), [
                'url' => 'required|active_url'
            ],$messages);
            $check = 'we<meta name="tonovel" content="tonovel-verification" />';
            if(strpos($check, '<meta name="tonovel" content="tonovel-verification" />') !== false){
                $group = Group::find($groups->id);
                $group->url = $request->url;
                $group->save();
                request()->session()->flash('success', ' Feed telah aktif !');
                return redirect()->route('group.setting',$groups->slug);
            }else{
                request()->session()->flash('danger', ' Meta tak ditemukan !');
                return redirect()->route('group.setting',$groups->slug);
            }
        }
        if($request->ads =='yes'){
            $messages = [
                'adsbox.required' => 'Source iklan tidak boleh kosong'
            ];
            $this->validate(request(), [
                'adsbox' => 'required'
            ],$messages);
            $group = Group::find($groups->id);
            $group->adsbox = $request->adsbox;
            $group->save();
            request()->session()->flash('success', ' Pengaturan iklan group diubah !');
            return redirect()->route('group.setting',$group->slug);
        }
        if($request->undangan =='yes'){
            $group = Group::find($groups->id);
            $group->privatekey = md5(time());
            $group->save();
            request()->session()->flash('success', ' Tautan berhasil di generate !');
            return redirect()->route('group.setting',$group->slug);
        }
        }else{
            return abort(404);
        }
    }
    public function memberdelete($slug,$id){
        $groups = Group::whereSlug($slug)->first();
        if($groups->staff == @Auth::user()->id){
               $json = json_decode($groups->member);
               $del = array_diff($json, [$id]);    
               $group = Group::find($groups->id);
               $group->member = json_encode($del);
               $group->save();
               $j['error'] = 200;
               $j['status'] = 'success';
               $j['msg'] = 'Berhasil mengupdate member group';
               return $j;   
        }else{
            $j['error'] = 403;
            $j['status'] = 'failed';
            $j['msg'] = 'Tidak bisa menghapus sesuatu yg tiada';
            return $j;
        }
    }
    public function manajer($id){
        $groups = Group::whereSlug($id)->first();
        if(empty($groups->member)) $groups->member = '[]';
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){            
        $release = Chapter::where('group_id',$groups->id)->paginate(10);
        if($groups == false){
            return abort(404);
        }
        return view('group.manajer')->withGroups($groups)->withRelease($release);
        }else{
            return abort(404);
        }
    }
    public function getRilisan($slug,$id){
        $groups = Group::whereSlug($slug)->first();
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){
        $release = Chapter::where('id',$id)->where('group_id',$groups->id)->first();
        if($groups == false){
            return abort(404);
        }
        return view('group.update')->withGroups($groups)->withRelease($release)->withType('rilisan');
        }else{
            return abort(404);
        }
    }
    public function getProyek($slug,$id){
        $groups = Group::whereSlug($slug)->first();
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){
        $proyek = DB::table('group_novel')->where('novel_id',$id)->first();
        if($groups == false OR $proyek == false ){
            return abort(404);
        }
        return view('group.update')->withGroups($groups)->withProyek($proyek)->withType('proyek');
        }else{
            return abort(404);
        }
    }
    public function updateProyek(Request $request,$slug,$id){
        $groups = Group::whereSlug($slug)->first();
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){
        $proyek = DB::table('group_novel')->where('novel_id',$id)->first();
        $messages = [
            'manager.required' => 'Manajer Proyek tidak boleh kosong',
            'group_status.required' => 'Poster tidak boleh kosong',
            'team.required' => 'Penerjemah tidak boleh kosong',
            'editor.required' => 'Penyunting tidak boleh kosong',
        ];
        $this->validate(request(), [
            'manager' => 'required',
            'team' => 'required',
            'editor' => 'required',
            'group_status' => 'required',
        ],$messages);
        DB::table('group_novel')
        ->where('id', $proyek->id)
        ->update(array('group_manager' => $request->manager,'group_team' => json_encode($request->team),'group_editor' => json_encode($request->editor),'group_status' => $request->group_status));
        request()->session()->flash('success', ' Proyek Berhasil diubah !');
        return redirect()->route('group.viewproyek',['slug'=>$slug,'id'=>$id]);
        }else{
            return abort(404);
        }
    }
    public function updateRilisan(Request $request,$slug,$id){
        $groups = Group::whereSlug($slug)->first();
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){
            $chapter = Chapter::find($id);
            $messages = [
                'volume.required' => 'Volume tidak boleh kosong',
                'volume.integer' => 'Volume haruslah angka',
                'numba.integer' => 'Volume haruslah angka',
                'title.required' => 'Judul tidak boleh kosong',
                'numba.required' => 'Bab tidak boleh kosong',
                'description.required' => 'Deskripsi tidak boleh kosong',
                'content.active_url' => 'Alamat URL yang kamu masukkan tidak benar',
            ];
            $url = '';
            if(isset($request->content)) $url = 'active_url';
            $this->validate(request(), [
                'volume' => 'required|integer',
                'numba' => 'required|integer',
                'description' => 'required',
                'content' => $url,
                'title' => 'required'
            ],$messages);
            $chapter->bab = $request->numba;
            $chapter->title = $request->title;
            $chapter->volume = $request->volume;
            $chapter->desc = $request->description;
            $konten = $request->content;
            if(empty($konten)) $konten = 0;
            $chapter->content = $konten;
            $chapter->save();
            request()->session()->flash('success', ' Rilisan Berhasil diubah !');
            return redirect()->route('group.viewrilis',['slug'=>$slug,'id'=>$id]);
        }else{
            return abort(404);
        }
    }
    public function createproject(Request $request,$id){
        $groups = Group::whereSlug($id)->first();
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){
            if($request->proyek == 'yes'){
                $novel = Novel::find($request->judul);
                if($novel == true){
                    DB::table('group_novel')->insert(
                        ['group_id' => $groups->id,
                         'novel_id' => $novel->id,
                          'group_status' => 1,
                           'group_manager' => $request->manager,
                            'group_team' => json_encode($request->team),
                             'group_editor' => json_encode($request->editor)
                             ]
                    );
                    request()->session()->flash('success', ' Berhasil membuat proyek !!');
                    return redirect()->route('group.group',$groups->slug);
                }
            }else{
                request()->session()->flash('danger', 'Novel dari proyek kamu tidak tersedia !!');
                return redirect()->route('group.group',$groups->slug);
            }
        }else{
            return abort(403);
        }
    }
    public function createrilisan(Request $request,$id){
        $groups = Group::whereSlug($id)->first();
        if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member))){            
        $messages = [
            'vbab.required' => 'VBAB tidak boleh kosong',
            'vbab.regex' => 'Format VBAB Salah',
            'title.required' => 'Judul tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'content.active_url' => 'Alamat URL yang kamu masukkan tidak benar',
        ];
        $url = '';
        if(isset($request->content)) $url = 'active_url';
        $this->validate(request(), [
            'vbab' => 'required|regex:/(^([V]+)(\d+)([B]+)(\d+)?$)/u',
            'description' => 'required',
            'content' => $url,
            'title' => 'required'
        ],$messages);
        $novel = Novel::find($request->proyek);
        list($volume,$bab) = explode("B",$request->vbab);
        $chapter = new Chapter;
        $chapter->novel_id = $request->proyek;
        $chapter->group_id = $groups->id;
        $chapter->slug = $novel->slug.'-'.strtolower($request->vbab);
        $chapter->bab = $bab;
        $chapter->title = $request->title;
        $chapter->volume = str_replace('V','',$volume);
        $chapter->desc = $request->description;
        $konten = $request->content;
        $numba = DB::table('chapters')->where('novel_id',$novel->id)->max('numba')+1;
        if(empty($konten)) $konten = 0;
        if(empty($numba)) $numba = 0;
        $chapter->content = $konten;
        $chapter->numba = $numba;
        $chapter->views = 0;
        $chapter->total_views = 0;
        $chapter->save();
        if(empty($request->content)){
            request()->session()->flash('success', ' Rilisan telah dibuat silahkan masukkan konten disini !!');
            return redirect()->route('diff.create',$novel->slug.'-'.strtolower($request->vbab));
        }
        request()->session()->flash('success', ' Berhasil membuat rilisan !!');
        return redirect()->route('group.group',$groups->slug);
        }else{
            request()->session()->flash('danger', 'Aksi tidak tersedia !!');
            return redirect()->route('group.group',$groups->slug);
        }
    }
    public function groupwor(Request $request,$id){
        $group = Group::whereSlug($id)->first();
        if($group == false OR !isset(Auth::user()->id)){
            return abort(404);
        }
        $follow = DB::table('group_user')->where('group_id',$group->id)->where('user_id',Auth::user()->id)->get();
        if($follow->isEmpty()){
            $add = DB::table('group_user')->insert(
                ['group_id' => $group->id, 'user_id' => Auth::user()->id]
            );
            request()->session()->flash('success', ' Berhasil mengikuti !!');
            return redirect()->route('group.group',$group->slug);
        }else{
            DB::table('group_user')->where('group_id',$group->id)->where('user_id',Auth::user()->id)->delete();
            request()->session()->flash('success', ' Berhasil tidak mengikuti !!');
            return redirect()->route('group.group',$group->slug);
        }
    }
}
