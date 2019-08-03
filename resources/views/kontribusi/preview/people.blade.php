@extends('main')
@section('title', "Preview Perubahan")
@section('stylesheets')
<style>
#app{
padding:20px;
}
</style>
@endsection
<?php
$people = json_decode($kontens->content);
?>
@section('blurred')
<div class="people-header" data-people="5">
        <div class="people-header-wrapper">
            <div class="header-avatar">
                <a href="#"><img class="header-avatar-img" src="{{ToNovel::imggo('people',0,$people->images)}}" alt="{{$people->ppl_name}}"></a>
                <a class="header-avatar-vip icon icon-cv" href="" target="_blank"></a>
            </div>
            <div class="header-msg">
                <h3 id="EgoPplWrap" data-id="5"><a href="#">{{$people->ppl_name}}</a></h3>
                <div class="header-msg-desc">{{$people->ppl_bio}}</div>
                <div class="header-msg-data">
                    <div class="pull pull-right pull-inmobile">
                    <a href="#" class="btn btn-info">Ikuti</a>
                                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
      <div class="row">
        <div class="col-sm-3 col-sm-push-9">
        <div class="row">
        <div class="col-md-12">
        <h2 style="font-size: 20px">Lainnya :</h2>
        <div class="panel">
        <div class="list-group">
  <li class="fist-group-item">
    <span class="aniled">{{$people->ppl_birthday}}</span>
    <span style="left: right;text-align: right;font-size: .84em;">Ulang Tahun</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ToNovel::country($people->ppl_country)}}</span>
    <span style="left: right;text-align: right;font-size: .84em;">Negara</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">0</span>
    <span style="left: right;text-align: right;font-size: .84em;">Pengikut</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">0</span>
    <span style="left: right;text-align: right;font-size: .84em;">Total Karya</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{!!($people->ppl_link) ? '<a href="'.$people->ppl_link.'">'.$people->ppl_link.'</a>' : 'Tak ada'!!}</span>
    <span style="left: right;text-align: right;font-size: .84em;">Web/Sosial</span>
  </li>
  </div>
        </div>
        </div>
        <div class="col-md-12">
        <h2 style="font-size: 20px">Pengikut : <small>(0)</small></h2>
        <div class="panel panel-body">
        Tidak tersedia saat preview
        </div>
        </div>
        </div>
        </div>
        <div class="col-sm-9 col-sm-pull-3">
        <div class="row">
        <div class="col-md-12">
        <h2 style="font-size: 20px">Daftar Karya :</h2>
     <div class="content shadow text-center">
<div class="alert alert-danger"><i class="glyphicon glyphicon-remove gly-4x"></i><br><br>Tidak ditemukan<br><small>Jika ada silahkan tambahkan karya nya di tab kontribusi.</small></div></div>
          </div>
        </div>
                <div class="panel"><div class="panel panel-heading">Komentar</div>
                <div class="alert alert-info">Tak tersedia saat ini</div>
                </div>
        </div>
        </div>
        </div>
@endsection