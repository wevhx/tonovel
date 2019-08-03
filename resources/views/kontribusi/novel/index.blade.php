@extends('main')
@section('title', "Kontribusi Novel")
@section('content')
<div class="row">
<div class="col-md-12">

<h2 style="font-size: 20px">KONTRIBUSI NOVEL <div class="pull pull-right"><a href="" class="btn btn-success btn-xs">Reload</a></div></h2>
<div class="btn-group btn-group-justified">
  <a href="/kontribusi/novel/create" class="btn btn-info">Buat Series</a>
  <a href="/kontribusi/history" class="btn btn-warning">Ubahan terakhir</a>
  <a href="#" disabled class="btn btn-danger">Hapus Series</a>
</div><br>
<ul class="tonovellist__tonovels">
  @foreach ($novel as $nov)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.edit',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.edit',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
<div class="tonovellist-item__viewer"><i class="glyphicon glyphicon-eye-open"></i> {{$nov->total_views}}</div>
<ul class="tonovellist-item__info">
<li class="item-label status" style="background-color:purple">SUNTING</li>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li>  
@endforeach
</div>
<div class="centered">{{$novel->links()}}</div>
</div>
</div>
@endsection
