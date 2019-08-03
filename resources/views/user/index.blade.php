@extends('main')
@section('title', "Daftar Pengguna")
@section('content')
<div class="row">
<div class="col-md-12">
<h2 style="font-size: 20px">Daftar Pengguna <div class="pull pull-right"></div></h2>
<div class="row">
@if(!$user->isEmpty())
@foreach($user as $use)
<div class="col-md-4">
<div class="comment-wrap" id="comment-wrap" data-comment="{{$use->id}}" data-username="{{$use->name}}">
<div class="photo">
<div class="avatar-review" style="background-image: url({{ToNovel::imggo('user',1,$use->userimg)}})"></div></div>
<div class="comment-block"><div class="comment-user"><a href="{{route('user.user',$use->name)}}">{{$use->name}}</a></div><p class="comment-text read-more-wrap">{!!($use->bio) ? $use->bio: '<br>'!!}</p><div class="bottom-comment"><div class="comment-date">{{\Carbon\Carbon::parse($use->created_at)->diffForHumans()}}</div><ul class="comment-actions"></ul></div></div> </div>
</div>
@endforeach
@else
<div class="well well-sm centered">Belum ada ulasan</div>
@endif
      @if($user instanceof \Illuminate\Pagination\LengthAwarePaginator )
       <div style="text-align:center">
          {{ $user->links() }}
       </div>
        @endif
</div>
</div>
@endsection