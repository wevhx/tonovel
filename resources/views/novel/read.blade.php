<?php
if(isset($chapter->differ)){
@$diff = $chapter->differ->sortByDesc('id');
@$konten = current($diff);
@$return = reset($konten);
}
?>
@extends('main')
@section('title', $chapter->title)
@section('stylesheets')
<style>
footer{display:none;}</style>
@endsection
@section('content')
@include('partials._sidebar')  
            <div id="content" class="plcgo placeholders">
              <input type="hidden" name="val-top" id="val-top" value="0">
              <input type="hidden" name="val-before-capt" id="val-before-capt" value="{{@$prev->slug}}">
              <input type="hidden" name="val-novel" id="val-novel" value="{{$chapter->novel_id}}">
              <input type="hidden" name="val-current" id="val-current" value="{{$chapter->slug}}">
              <input type="hidden" name="current-comment" id="current-comment" value="1">
                <nav class="navibar navbar-default">
                    <div class="container-fluid">

                        <div class="navibar-header">
                            <h4 class="plcgo-slug"><a href="/novel/{{$chapter->novels->slug}}">{{$chapter->novels->title}}</a></h2>
                            <h2 class="plcgo-title" id="tonl-chapter">{{$chapter->title}}</h2>
                            <h4 class="plcgo-title" id="tonl-author">Oleh <a href="/group/{{@$chapter->groups->slug}}">{{@$chapter->groups->name}}</a></h4>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right plcgo-title">
                                <li><a href="#"><i class="glyphicon glyphicon-eye-open"></i> <span id="tonl-viewer" class="noveltips" title="Total dilihat">{{$chapter->total_views}}</span></a></li>
                                <li><a href="{{route('diff.show',$chapter->slug)}}"><i class="glyphicon glyphicon-list-alt"></i> <span id="tonl-diff" class="noveltips" title="Perbaikan kata">{{$chapter->differ->count()}}</span></a></li>
                                <li><a href="#" data-toggle="modal" data-target="#report" class="noveltips" title="Laporkan Masalah"><i class="glyphicon glyphicon-info-sign"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="panel panel-default">
  <div class="panel-body" id="tonovel-isi">
    <div class="preload">
                <p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p>
                <p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p><p class="plcgo-panel"></p>
    </div>
    <div id="konten">
    @if(!empty($return->content))
    {!! @str_replace('<img','<img width="100%" height="100%" class="img-responsive centered"',$return->content) !!}
    @else
    <h1 style="text-align:center" onclick="reqt('{{$chapter->slug}}')"><i class="glyphicon glyphicon-info-sign gly-buzz" style="font-size:115px"></i></h1><h4 style="font-size:12px;color:brown;text-align:center;">Fitur bacaan tidak tersedia silahkan mengunjungi tautan <a href="/redirect?url={{$chapter->content}}" style="color:blue">disini</a><br><br><a href="/diff/{{$chapter->slug}}" class="btn btn-primary">Buat diff disini</a></h4>
    @endif
    </div>
    <div id="a-konten" class="centered"></div>
    </div>
        </div>
  <input type="hidden" value="0" id="val-bottom" />
  <input type="hidden" value="{{@$next->slug}}" id="val-next-capt" />
    Sumber : <a href="{{$chapter->content}}">Klik Disini</a>
  </div>
<div id="report" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b color="black">Laporkan</b></h4>
      </div>
      <div class="modal-body">
    <div class="form-group">
  <label class="control-label" for="jenis-font">Yang Dilaporkan ?</label><a href="#" class="noveltips" title="Pilih masalah yang kamu alami"> <i class="glyphicon glyphicon-question-sign"></i></a>
        <select class="form-control" id="problem">
        <option value="">Terjemahan Buruk</option>
        <option value="">Salah Volume/BAB</option>
        <option value="">Konten rusak/dibajak</option>
        <option value="">Fitur tak berfungsi</option>
        </select>
      </div>
    <div class="form-group">
  <label class="control-label" for="jenis-font">Isi Form Berikut dan Jelaskan secara rinci !</label>
   <textarea class="form-control">Asuuuuuuuuuu</textarea>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-info">Kirim</button>
    </div>

  </div>
</div>
</div>
</div>
<div id="info" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b color="black">Fitur Terbaru</b></h4>
      </div>
      <div class="modal-body">
        <img src="/img/shorcut.png" class="img-responsive center-block"><hr>
        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Oke Saya Paham</button>
      </div>
    </div>

  </div>
</div>
@endsection
@section('javascript')
@endsection
@section('addon')
@endsection