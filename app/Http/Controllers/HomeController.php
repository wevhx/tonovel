<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Library;
use App\Novel;
use App\Chapter;
use App\People;
use App\Genres;
use App\User;
use Auth;
use Image;
use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        $libs = Library::where('user_id','=',Auth::user()->id)->get();
        return view('home')->withLibs($libs);
    }
    public function setting()
    {
        $userlibs = Auth::user();
        return view('user')->withUser($userlibs);
    }
    public function changePassword(Request $request)
    {
        if($request->input('otomatis') != '' && $request->input('ads') != ''){
            $user = Auth::user();
            $this->validate(request(), [
                'otomatis' => 'required|integer',
                'opt_size' => 'required|integer',
                'opt_font' => 'required',
                'opt_color' => 'required'
            ]);
            $user->otomatis = $request->input('otomatis');
            $user->opt_size = $request->input('opt_size');
            $user->opt_font = $request->input('opt_font');
            $user->opt_color = $request->input('opt_color');
                    $user->save(); 
                    request()->session()->flash('success', 'Pengaturan disimpan !');
                return redirect()->route('changePassword');
        }elseif($request->input('basic') == 'yes'){
            $user = Auth::user();
            $this->validate(request(), [
                'bio' => 'required',
                'gender' => 'required'
            ]);
            $user->bio = $request->input('bio');
            $user->gender = $request->input('gender');
            $user->save(); 
            request()->session()->flash('success', ' Informasi Berhasil diubah !');
            return redirect()->route('changePassword');
        }elseif($request->input('avatar') == 'yes'){
            $messages = [
                'userimg.required' => 'Avatar tidak boleh kosong',
                'userimg.image' => 'Avatar haruslah berbentuk gambar',
                'userimg.mimes' => 'Dengan format jenis jpeg,png,jpg,gif',
                'userimg.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
            ];
            $this->validate(request(), [
                'userimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],$messages);
    		$userimg = $request->file('userimg');
    		$filename = md5(time()) . '.' . $userimg->getClientOriginalExtension();
            Image::make($userimg)->resize(100, 100)->save( public_path('uploads/user/0/' . $filename ) );
            Image::make($userimg)->resize(42, 42)->save( public_path('uploads/user/1/' . $filename ) );
            Image::make($userimg)->resize(25, 25)->save( public_path('uploads/user/2/' . $filename ) );
            $user = Auth::user();
            if(!empty($user->userimg) && $user->userimg != '/uploads/user/default.png') File::delete(public_path($user->userimg));
    		$user->userimg = $filename;
            $user->save(); 
            request()->session()->flash('success', ' Avatar Berhasil diubah !');
        return redirect()->route('changePassword');
        }else{
        $messages = [
            'current_password' => 'Old Password not right',
            're_password.same' => 'Password Confirmation should match the Password',
        ];
        $this->validate(request(), [
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:6',
            're_password' => 'required|string|min:6|same:new_password',
        ],$messages);
    
        request()->user()->fill([
            'password' => Hash::make(request()->input('new_password')
            )
        ])->save();
        request()->session()->flash('success', 'Password changed !');
    
        return redirect()->route('changePassword');
        }
    }
}
