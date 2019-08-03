@extends('main')
@section('title', "Group ".$groups->name)
@section('stylesheets')
<style>
#app{
padding:5px;
}
</style>
@endsection
@section('blurred')
    <div id="ch-tp"></div>
<div class="group-header"  @if(!empty($groups->backg)) style='background: url("/uploads/group/cover/{{$groups->backg}}") center center / cover no-repeat rgb(255, 255, 255);' @endif data-group="{{$groups->id}}">
        <div class="group-header-wrapper">
            <div class="header-avatar">
                <a href="{{route('group.group',$groups->slug)}}"><img class="header-avatar-img" src="{{ToNovel::imggo('group',0,$groups->thumb)}}" alt="{{$groups->name}}"></a>
            </div>
            <div class="header-msg">
                <h3 id="EgogroupWrap" data-id="{{$groups->id}}"><a href="{{route('group.group',$groups->slug)}}">{{ucfirst($groups->name)}}</a></h3>
                <div class="header-msg-desc">Bergabung {{\Carbon\Carbon::parse($groups->created_at)->diffForHumans()}}</div>
                
                <div class="header-msg-title">{{$groups->description}}</div>
                
                <div class="header-msg-data">
                    <span class="mr8">Pengikut :<strong class="header-msg-strong">{{$groups->users->count()}}</strong></span><span class="ml12 mr8">Proyek :<strong class="header-msg-strong">1</strong></span>
                    
                </div>
            </div>
        </div>
    </div>
            </div>

@endsection
@section('content')
<div class="row">
<div class="col-md-3">
<div class="list-group">
  <a href="#proyek" data-toggle="tab" class="list-group-item">Atur Proyek</a>
  <a href="#rilisan" data-toggle="tab" class="list-group-item">Atur Rilisan</a>
  <a href="#berita" data-toggle="tab" class="list-group-item">Atur Berita</a>
</div>
</div>
<div class="col-md-9 tab-content">
<div id="info" class="tab-pane fade {{ Request::get('filter') != 'proyek' && Request::get('filter') != 'release' && Request::get('filter') != 'news' ? "active in" : ""}}">
<div class="content shadow text-center">
<div class="alert alert-info"><i class="glyphicon glyphicon-inbox gly-4x"></i><br><br>Klik Tab disamping<br><small>Gunakan bilah box disamping untuk berpindah.</small></div></div>
</div>
<div id="proyek" class="tab-pane fade {{ Request::get('filter') == 'proyek' ? "active in" : ""}}">
<div class="panel panel-default">
  <div class="panel-heading">Daftar Proyek</div>
<?php
$grn = $groups->projects()->where('group_status',1)->get();
?>
  @if(!$grn->isEmpty())
<ul class="tonovellist__tonovels">
  @foreach($grn as $novel)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('group.viewproyek',['slug'=>$groups->slug,'id'=>$novel->id])}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$novel->thumb)}}">
</a>
<a href="{{route('group.viewproyek',['slug'=>$groups->slug,'id'=>$novel->id])}}" title="{{$novel->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$novel->title}}</h3>
<h2 class="tonovellist-item__desc">{{$novel->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($novel->slug)) < 2) ? ToNovel::getscore($novel->slug).'.0': substr(ToNovel::getscore($novel->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">AKTIF</li>
<li class="item-label score">Total {{@$novel->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
  @endforeach
  </ul>
  @endif
  <?php
$grn = $groups->projects()->where('group_status',0)->get();
?>
  @if(!$grn->isEmpty())
<ul class="tonovellist__tonovels">
  @foreach($grn as $novel)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('group.viewproyek',['slug'=>$groups->slug,'id'=>$novel->id])}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$novel->thumb)}}">
</a>
<a href="{{route('group.viewproyek',['slug'=>$groups->slug,'id'=>$novel->id])}}" title="{{$novel->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$novel->title}}</h3>
<h2 class="tonovellist-item__desc">{{$novel->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($novel->slug)) < 2) ? ToNovel::getscore($novel->slug).'.0': substr(ToNovel::getscore($novel->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status" style="background: #ff0000;">DROPPED</li>
<li class="item-label score">Total {{@$novel->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
  @endforeach
  </ul>
  @endif
  <?php
$grn = $groups->projects()->where('group_status',2)->get();
?>
  @if(!$grn->isEmpty())
<ul class="tonovellist__tonovels">
  @foreach($grn as $novel)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('group.viewproyek',['slug'=>$groups->slug,'id'=>$novel->id])}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$novel->thumb)}}">
</a>
<a href="{{route('group.viewproyek',['slug'=>$groups->slug,'id'=>$novel->id])}}" title="{{$novel->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$novel->title}}</h3>
<h2 class="tonovellist-item__desc">{{$novel->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($novel->slug)) < 2) ? ToNovel::getscore($novel->slug).'.0': substr(ToNovel::getscore($novel->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status" style="background: #ff6a00;">HIATUS</li>
<li class="item-label score">Total {{@$novel->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
  @endforeach
  </ul>
  @endif
</div>
</div>
<div id="rilisan" class="tab-pane fade {{ Request::get('filter') == 'release' ? "active in" : ""}}">
<div class="panel panel-default">
  <div class="panel-heading">Daftar Rilisan</div>
 <div class="list-group">
 @if(!$release->isEmpty())
 @foreach($release as $rilis)
  <a href="{{route('group.viewrilis',['slug'=>$groups->slug,'id'=>$rilis->id])}}" class="list-group-item">
    <h4 class="list-group-item-heading">{{$rilis->title}}</h4>
    <p class="list-group-item-text">V{{$rilis->volume}}B{{$rilis->numba}} - {{$rilis->desc ? $rilis->desc:"Tanpa deskripsi"}}</p>
    <div class="status" >{{$rilis->novels->title}}</div>
  </a>
  @endforeach
<div class="centered"> {{$release->appends(['filter' => 'release'])}}</div>
 @else
 @endif
</div>
</div>
</div>
<div id="berita" class="tab-pane fade {{ Request::get('filter') == 'news' ? "active in" : ""}}">
<div class="panel">
<div class="panel panel-heading">Berita</div>
<?php
$newss = \App\News::where('type',1)->where('object',$groups->id)->orderBy('created_at','DESC')->paginate(10);
?>
<div class="list-group">
@foreach($newss as $news)
  <a href="{{route('group.viewnews',['slug'=>$groups->slug,'id'=>$news->id])}}" class="list-group-item">
    <h4 class="list-group-item-heading">{{$news->title}}</h4>
    <div class="status">{{\Carbon\Carbon::parse($news->created_at)->diffForHumans()}}</div>
    <p class="list-group-item-text">{{ substr($news->content, 0, 100) }}{{ strlen($news->content) > 100 ? "..." : "" }}</p>
  </a>
@endforeach
<div class="centered"> {{$newss->appends(['filter' => 'news'])}}</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection