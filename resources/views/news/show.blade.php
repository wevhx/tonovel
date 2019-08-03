@extends('main')
@section('title', $news->title)
<?php
if($news->type == 1){
$info = 'Oleh Group '.'<a href="/group/'.ToNovel::ugroup($news->object)['slug'].'">'.ToNovel::ugroup($news->object)['name'].'</a>';
}elseif($news->type == 0){
$info = 'Oleh User '.'<a href="/profile/'.strtolower(ToNovel::uinfo($news->object)['name']).'">'.ucfirst(ToNovel::uinfo($news->object)['name']).'</a>';
}
?>
@section('stylesheets')
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
<h2>{{$news->title}}</h2>
<time style="font-size:15px">{{\Carbon\Carbon::parse($news->created_at)->diffForHumans()}}</time>
<div style="padding:10px;float:right">
  <small>{!! $info !!}</small></div><hr>
<div class="panel panel-default">
  <div class="panel-body">
    {{$news->content}}
  </div>
</div>
</div>
<div class="col-md-12">
<div class="panel">
  <div class="panel-heading">Komentar</div>
  <iframe id="comment-box" frameborder="0" onload="autoResize()" scrolling="no" width="100%" src="{{route('comment').'?type=6&object='.$news->id}}"></iframe>
</div>
</div>
</div>
</div>
</div>
@endsection