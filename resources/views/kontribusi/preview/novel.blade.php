@extends('main')
@section('title', "Preview Perubahan")
@section('content')
<?php
$novel = json_decode($kontens->content);
?>
<div class="alert alert-info">Ini adalah tampilan preview dari novel yang kamu lihat</div>
<div class="row">
      <div class="col-md-3">
      <div class="top-m-desc"></div>
      <div class="panel panel-default">
      <div class="cover-panel">
  <img src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=" data-src="{{ ToNovel::imggo('poster',0,$novel->images) }}" onerror="imgError(this);" class="cover-img">
  </div>
  <div class="panel">
  
  <div class="list-group">
  <li class="fist-group-item">
    <span class="aniled">{{ ($novel->licensed) ? 'Ada': 'Belum ada' }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">LISENSI</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ ToNovel::country($novel->country) }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">NEGARA</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">SESUAI DATA</span>
    <span style="left: right;text-align: right;font-size: .84em;">STATUS</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ $novel->year }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">TAHUN</span>
  </li>
  </div>
</div>
      </div>
      <pre>tak tampil saat preview</pre>
      </div>
      <div class="col-md-9">
      <div class="top-desc">

      <h2><b>{{ $novel->title }}</b></h2>
      <pre>Genre tidak tersedia saat preview</pre>
      <div class="ani-desc read-more-wrap">{!! $novel->synopsis !!}</div>
    </div>
    
      <pre>Review tak tampil saat preview</pre>
</div>
</div>
</div>
@endsection