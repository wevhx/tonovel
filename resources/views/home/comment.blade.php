@extends('main')
@section('title',"Komentar")
@section('stylesheets')
<script>
document.addEventListener('contextmenu', event => event.preventDefault());
document.documentElement.className += (window.self == window.top ? " top" : " framed");
</script>
<style>
html.framed .navbar-fixed-top {
    display: none;
    padding: 0;
}
html.framed #app {
    padding: 0px;
    margin: -10px 0px 0px;
    width: 100%;
}
html.framed pre {
    display: none;
}
html.framed footer {
    display: none;
}
.send {
    display: none;
    padding : 10px;
    }
.commentlist{
    max-height: auto; 
    overflow-y: unset;
}
.mb-2, .my-2 {
    margin-bottom: .5rem!important;
}
.comments__total {
    font-size: 18px;
    border-bottom: 1px solid #eee;
}
.float-right {
    float: right!important;
}
.pagination{
    margin: 0px 0
} 
textarea:focus + .send { display: block; }
textarea:not(:placeholder-shown) + .send { display: block; }
</style>
@endsection
@section('content')
<pre id="refer">Hash Comment {{md5(rand(0,99))}}</pre>
<div class="panel-body">
<div class="form-group">
<div class="input-group" style="width:100%"> 
<span class="u-rep" style="display: none;"></span>
              <input type="hidden" name="current-comment" id="current-comment" value="{{Request::get('type')}}">
                    <input type="hidden" value="0" id="reply-status">
                    <input type="hidden" value="0" id="reply-options">
              <input type="hidden" name="val-current" id="val-current" value="{{Request::get('object')}}">
<textarea class="form-control u-comment u-focus" placeholder="Tambah Komentar"></textarea>
<div class="pull pull-right send"><a href="#" id="comment-send" class="btn btn-info">Kirim</a></div>
</div>
</div>
<div class="clearfix mb-2">
<div class="dropdown float-right">
  <button class="btn btn-link btn-xs dropdown-toggle" type="button" data-toggle="dropdown">@if(Request::get('order') == 'asc') Terlama @elseif(Request::get('order') == 'desc') Terbaru  @else Sortir berdasarkan @endif
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="{{str_replace(array('&order=asc','&order=desc'),'',Request::fullUrl())}}&order=desc">Terbaru</a></li>
    <li><a href="{{str_replace(array('&order=asc','&order=desc'),'',Request::fullUrl())}}&order=asc">Terlama</a></li>
  </ul>
</div> 
    <div class="comments__total">
      <integer id="total_comment">{{$comments->total()}}</integer> Komentar 
    </div></div>    
       @if($comments instanceof \Illuminate\Pagination\LengthAwarePaginator )
       <div style="float:right;">
       {{ $comments->appends(['type' => Request::get('type'),'object' => Request::get('object'),'order' => Request::get('order')])->links() }}
       </div>
        @endif
<div class="commentlist">
@if(!$comments->isEmpty())
@foreach($comments as $comment)
@if(Auth::user()->id == $comment->users->id)
    <div class="comment-wrap dibaca" id="comment-wrap" data-comment="{{$comment->id}}" data-username="{{ucfirst($comment->users->name)}}"><div class="photo"><div class="avatar" style="background-image: url({{ToNovel::imggo('user',2,$comment->users->userimg)}})"></div></div><div class="comment-block"><div class="comment-user"><a target="_blank" href="{{route('user.user',$comment->users->name)}}">{{ucfirst($comment->users->name)}}</a></div><p class="comment-text">{{$comment->komentar_content}}</p><div class="bottom-comment"><div class="comment-date" data-livestamp="{{trim($comment->created_at->timestamp)}}">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</div><ul class="comment-actions"><li class="reply" onclick="replyget({{$comment->id}})">{{\App\Comment::where('komentar_reply','=',$comment->id)->count()}} Balasan</li><li class="complain" onclick="reportc({{$comment->id}})"><i class="glyphicon glyphicon-flag"></i></li></ul></div><div class="comment-reply-{{$comment->id}}" id="comment-reply-{{$comment->id}}"><br></div></div> </div>
@else
    <div class="comment-wrap" id="comment-wrap" data-comment="{{$comment->id}}" data-username="{{ucfirst($comment->users->name)}}"><div class="photo"><div class="avatar" style="background-image: url({{ToNovel::imggo('user',2,$comment->users->userimg)}})"></div></div><div class="comment-block"><div class="comment-user"><a target="_blank" href="{{route('user.user',$comment->users->name)}}">{{ucfirst($comment->users->name)}}</a></div><p class="comment-text">{{$comment->komentar_content}}</p><div class="bottom-comment"><div class="comment-date" data-livestamp="{{trim($comment->created_at->timestamp)}}">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</div><ul class="comment-actions"><li class="reply" onclick="replyget({{$comment->id}})">{{\App\Comment::where('komentar_reply','=',$comment->id)->count()}} Balasan</li><li class="complain" onclick="reportc({{$comment->id}})"><i class="glyphicon glyphicon-flag"></i></li></ul></div><div class="comment-reply-{{$comment->id}}" id="comment-reply-{{$comment->id}}"><br></div></div> </div>
@endif
@endforeach
@else
<div class="well centered rem-wrap"><i class="glyphicon glyphicon-file gly-2x"></i><br><h5>Belum ada komentar</h5></div>
@endif
</div>
</div>
</div>
@endsection
@section('javascript')
<script>
function resize()
{
    window.parent.autoResize();
}
$(window).on('resize', resize);
</script>
@endsection