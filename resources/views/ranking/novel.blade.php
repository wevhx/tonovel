@extends('main')
@section('title', "Ranking Novel")
@section('content')
<div class="row">
<div class="col-md-12">
<h2 style="font-size: 20px">Ranking Novel <div class="pull pull-right"></div></h2>
<div class="row">

<ul class="tonovellist__tonovels">
@php $i = 1; @endphp
  @foreach ($novel as $rank)
  @php $nov = $rank->novels; @endphp
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.lihat',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($nov->slug)) < 2) ? ToNovel::getscore($nov->slug).'.0': substr(ToNovel::getscore($nov->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$nov->category->name}}</li>
<h3 class="tonovellist-item__genres">
<span style="font-size: 12px;" class="label label-warning label-md">#{{$i}}</span>
<span style="font-size: 12px;" class="label label-success label-md"><i class="glyphicon glyphicon-bookmark"></i> {{$rank->count}}</span>
</h3>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
@php $i++; @endphp
@endforeach
</ul>
</div>
</div>
</div>
</div>
@endsection
