<!DOCTYPE html>
<html lang="en">
  <head>
@section('title', 'Home'))
    @include('partials._head')
  </head>
  <body>
    @include('partials._nav')    

    @yield('blurred')
    <div class="container">
      @include('partials._messages')
<div class="container" id="app">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
  <div class="panel-heading">DAFTAR LIBRARY
  <div class="pull pull-right">
  </div>
  </div>
      @if(!$libs->isEmpty())
<div class="list-group" id="library">
<div class="side">
<ul>
  @foreach ($libs as $lib)
<?php
$novels = $lib->novels;
if(empty($novels->total)) $novels->total = '?';  
if($lib->status == 1){
$link = 'dibaca';
}elseif($lib->status == 2){
$link = 'selesai';
}elseif($lib->status == 3){
$link = 'ditahan';
}elseif($lib->status == 4){
$link = 'direncanakan';
}elseif($lib->status == 5){
$link = 'dibuang';
}else
?>
    <li class="{{$link}}-li">
        <div class="bor">
            <div class="limit {{$link}}">
            <a href="/novel/{{$novels->slug}}" title="{{$novels->title}}">
            <img width="150" height="150" src="{{ ToNovel::imggo('poster',2,$novels->thumb) }}" class="loading">
            </a>
            </div>
        </div>
        <div class="right"> 
        <span class="pull pull-right">
        @if($lib->loved == 1)
        <h4><b>{{$lib->score}}</b> <small><i class="glyphicon glyphicon-heart red-d"></i></small></h4>
        @else
        <h4><b>{{$lib->score}}</b> <small><i class="glyphicon glyphicon-star gold-d"></i></small></h4>
        @endif
        </span>
        <span class="title"><a class="series" href="/novel/{{$novels->slug}}">{{$novels->title}}</a></span>
        <span class="latest">
      <i class="glyphicon glyphicon-book"></i> {{$novels->category->name}} 
        </span>
        </div>
    </li>

		@endforeach
</ul>
</div>
</div>
</div>
    @else
<div class="panel-body red">
<center><i class="glyphicon glyphicon-remove-circle gly-4x"></i><br> <em><b>Sepertinya library kamu kosong</b></em><br><small>Tambahkan ke daftar tonton untuk melihat episode terbaru</small></center>
                </div>
</div>
</div>
    @endif
</div>
        <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
  <div class="panel-heading">UPDATE LIST</div>
      @if(!$libs->isEmpty())
  <ul class="list-group">
  @foreach ($libs as $lib)
  <?php
  @$next = DB::table('chapters')->where('novel_id','=',$lib->novel_id)->where('numba', $lib->last_numba+1)->first();
$novels = DB::table('novels')->where('id', $lib->novel_id)->first();
?>
   @if(!empty($next) && $lib->status == 1)
  <li class="list-group-item">
    <span class="badge" style="background-color:rgba(255, 255, 255, 0)"><a class="myani" href="{{ route('chapter.lihat',$novels->slug)}}">BAB.{{ $next->numba }}</a></span>
    <b style="font-size:1.12em"><a class="myani" href="{{ route('novel.show',['slug'=>$novels->slug])}}">{{ $novels->title }}</a></b> <small style="margin-left: .75em; font-size: 1rem;">{{$last}}</small>
  </li>
  @else
<div class="panel-body red">
<center><i class="glyphicon glyphicon-remove-sign gly-4x"></i><br> <em><b>Bab novel terbaru dari library Kosong</b></em><br><small>Tambahkan lagi daftar bacaan</small></center>
                </div>
        @break
  @endif
		@endforeach
</ul>
    @else
<div class="panel-body red">
<center><i class="glyphicon glyphicon-remove-sign gly-4x"></i><br> <em><b>Bab novel terbaru dari library Kosong</b></em><br><small>Tambahkan ke daftar baca untuk melihat bab terbaru</small></center>
                </div>
    @endif
</div>
</div>
</div>
</div>
</div>
</div>
      @include('partials._footer')

      @yield('addon')

        @include('partials._modal')
    </div> <!-- end of .container --> 

        @include('partials._javascript')

        @yield('scripts')

  </body>
</html>
