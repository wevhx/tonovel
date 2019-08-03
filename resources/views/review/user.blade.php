@extends('main')
@section('title', "Ulasan dari $user->name")
@section('content')
<div class="row">
<div class="col-md-12">
<h2 style="font-size: 20px">Ulasan dari {{$user->name}} <div class="pull pull-right"></div></h2>

@if(!$reviews->isEmpty())
@foreach($reviews as $review)
@php
$library = DB::table('libraries')->where('novel_id', $review->novel_id)->where('user_id', $review->user->id)->first();
$nilai = @$library->score;
if(empty($nilai)) $nilai = 0;
$userid = '';
@endphp
<div class="comment-wrap" id="comment-wrap" data-comment="{{$review->id}}" data-username="{{$review->user->name}}">
<div class="photo">
<div class="avatar-review" style="background-image: url({{ToNovel::imggo('user',1,$review->user->userimg)}})"></div></div>
<div class="comment-block"><div class="comment-user"><a href="{{route('user.user',$review->user->name)}}">{{$review->user->name}}</a> <span class="_tonovr" aria-label="Diberi nilai {{$nilai}}"><span style="width: {{$nilai*13}}px;"></span></span><small class="pull-right"><a href="{{route('novel.lihat',$review->novels->slug)}}">{{$review->novels->title}}</a></small></div><p class="comment-text read-more-wrap">{{$review->content}}</p><div class="bottom-comment"><div class="comment-date">{{\Carbon\Carbon::parse($review->created_at)->diffForHumans()}}</div><ul class="comment-actions"><li class="reply">{!!$userid!!}</li><li class="complain" onclick="reportr({{$review->id}})"><i class="glyphicon glyphicon-flag"></i></li></ul></div><div class="comment-reply-5" id="comment-reply-5"><br></div></div> </div>
@endforeach
@else
<div class="well well-sm centered">Belum ada ulasan</div>
@endif
       @if($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator )
       <div style="text-align:center">
          {{ $reviews->links() }}
       </div>
        @endif
</div>
</div>
</div>
@endsection