<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\User;
use Auth;
use Session;
use Redirect;
class ReviewController extends Controller
{
    public function getAll(){
        $review = Review::paginate(10);
        return view('review.index')->withReviews($review);
    }
    public function getReview($id){
        $user = User::where('name','=',$id)->first();
        if($user == false){
            return abort(404);
        }
        $review = Review::where('user_id', '=',$user->id)->paginate(10);
        return view('review.user')->withReviews($review)->withUser($user);
    }
    //Kirim Review
    public function sentReview(Request $request){
        if($request->action == 'change'){
            $messages = [
                'content.required' => 'Ulasan tak boleh kosong'
            ];
            $this->validate($request, array(
                    'novel_id'  => 'required',
                    'content'  => 'required'
            ),$messages);
            $review = Review::find($request->id);
            $review->user_id = Auth::user()->id;
            $review->novel_id = $request->novel_id;
            $review->content = $request->content;
            $review->reply = 0;
            $review->save();
            Session::flash('success', 'Ulasan kamu berhasil diubah!');
            return Redirect::to(redirect()->getUrlGenerator()->previous());
        }elseif($request->action == 'delete'){
            $review = Review::find($request->id);
            if($review->user_id != Auth::user()->id){
                Session::flash('danger', 'Tidak dapat menghapus ulasan orang lain!');
                return Redirect::to(redirect()->getUrlGenerator()->previous());
            }
            $review->delete();
            Session::flash('success', 'Ulasan kamu berhasil dihapus!');
            return Redirect::to(redirect()->getUrlGenerator()->previous());
        }else{
        $review = Review::where('novel_id', '=', $request->novel_id)->where('user_id', '=', Auth::user()->id)->first();
        if(count($review) > 0)
        {
            Session::flash('danger', 'Kamu sudah mengulas novel ini tidak bisa lagi');
            return Redirect::to(redirect()->getUrlGenerator()->previous());
        }
        $messages = [
            'content.required' => 'Ulasan tak boleh kosong'
        ];
        $this->validate($request, array(
                'novel_id'  => 'required',
                'content'  => 'required'
            ),$messages);
        $review = new Review;
        $review->user_id = Auth::user()->id;
        $review->novel_id = $request->novel_id;
        $review->content = $request->content;
        $review->reply = 0;
        $review->save();
        
        Session::flash('success', 'Ulasan kamu berhasil dikirim!');
        
        return Redirect::to(redirect()->getUrlGenerator()->previous());
        }
    }
}
