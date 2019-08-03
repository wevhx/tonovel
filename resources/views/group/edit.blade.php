@extends('main')
@section('title', "Group ".$groups->name)
@php if(empty($groups->member)) $groups->member = '[]'; @endphp
@section('stylesheets')
<style>
#app{
padding:10px;
}
input.profile-img-container[type="file"] {
  opacity:0;
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
}
input.cover-img-container[type="file"] {
  opacity:0;
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:80%;
}
</style>
@endsection
@section('blurred')
    <div id="ch-tp"></div>
<div class="group-header" id="group-header"@if(!empty($groups->backg)) style='background: url("/uploads/group/cover/{{$groups->backg}}") center center / cover no-repeat rgb(255, 255, 255);' @endif data-group="{{$groups->id}}">
        <div class="group-header-wrapper">
            <div class="header-avatar">
            {!! Form::open(['route' => ['Groupset',$groups->slug], 'method' => 'POST','files' => true]) !!}
        {{ Form::hidden('thumb', 'yes') }}
                {{ Form::file('thumbs', ['class' => 'profile-img-container centered','onchange'=>'loadThumb(event)']) }}<img id="output" class="header-avatar-img" src="{{ToNovel::imggo('group',0,$groups->thumb)}}" alt="{{$groups->name}}">
        <button class="header-avatar-vip icon icon-cv btn-blue" type="submit" href="#"><i class="glyphicon glyphicon-camera"></i> Ubah</button>
				{!! Form::close() !!}
            </div>
            <div class="header-msg">
                <h3 id="EgogroupWrap" data-id="{{$groups->id}}"><a href="{{route('group.group',$groups->slug)}}">{{ucfirst($groups->name)}}</a></h3>
                <div class="header-msg-desc">Bergabung {{\Carbon\Carbon::parse($groups->created_at)->diffForHumans()}}</div>
                
                <div class="header-msg-title">{{$groups->description}}</div>
                
                <div class="header-msg-data">
                    <span class="mr8">Pengikut :<strong class="header-msg-strong">{{$groups->users->count()}}</strong></span><span class="ml12 mr8">Proyek :<strong class="header-msg-strong">1</strong></span>
                    <div class="pull pull-right pull-inmobile">
                    {!! Form::open(['route' => ['Groupset',$groups->slug], 'method' => 'POST','files' => true]) !!}
                      {{ Form::hidden('cover', 'yes') }}
                      {{ Form::file('backg', ['class' => 'cover-img-container centered','onchange'=>'loadFiles(event)']) }}
                                  
                    <button id="bg-change" data-group="" type="submit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-picture"></i> Ubah</button>
                    {!! Form::close() !!}    
                  </div>
                </div>
            </div>
        </div>
    </div>
            </div>

@endsection
@section('content')
{{--  {{$groups->chapters()->orderBy('created_at','desc')->get()}}  --}}
<div class="row">
<div class="col-md-3">
<div class="list-group">
  <a href="#basic" data-toggle="tab" class="list-group-item">Pengaturan Dasar</a>
  <a href="#anggota" data-toggle="tab" class="list-group-item">Anggota Staff</a>
  <a href="#feed" data-toggle="tab" class="list-group-item">Pengaturan Feed</a>
  <a href="#ads" data-toggle="tab" class="list-group-item">Pengaturan Iklan</a>
</div>
</div>
<div class="col-md-9 tab-content">
<input type="hidden" value="{{$groups->slug}}" id="group-slug">
<div id="basic" class="tab-pane fade active in">
<div class="panel panel-default">
  <div class="panel-heading">Pengaturan Dasar</div>
  <div class="panel-body">
				{!! Form::model($groups,['route' => ['Groupset',$groups->slug], 'method' => 'POST']) !!}
        {{ Form::hidden('basic', 'yes') }}
        {{ Form::label('name', 'Nama') }}
        {{ Form::input('name', 'name', null, ['class' => 'form-control']) }}
        {{ Form::label('slug', 'Slug Khusus') }}
        {{ Form::input('slug', 'slug', null, ['class' => 'form-control form-control-xs']) }}
        {{ Form::label('description', 'Deskripsi') }}
        {{ Form::textarea('description', null, ['class' => 'form-control','size' => '10x2']) }}
        {{ Form::label('rightclick', 'Larang Klik kanan / CTRL+C: (?)') }}
        {{ Form::select('rightclick', ['Nonaktif', 'Aktif'] ,null ,['class'=> 'form-control']) }}<br>
        {{ Form::submit('Simpan Pengaturan', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
  </div>
</div>
</div>
<div id="anggota" class="tab-pane fade">
<div class="panel panel-default">
  <div class="panel-heading">Kode Undangan</div>
  <div class="panel-body centered">
    Kode undangan kamu  
				{!! Form::model($groups,['route' => ['Groupset',$groups->slug], 'method' => 'POST']) !!}
    {{ Form::hidden('undangan', 'yes') }}
    {{ Form::submit('Buat ulang', ['class' => 'btn btn-info btn-xs']) }}
				{!! Form::close() !!}
    <br>
    <pre>{{($groups->privatekey) ? $groups->privatekey: "Klik Buat Ulang"}}</pre>
    </div>
    </div>  
<div class="panel panel-default">
  <div class="panel-heading">Daftar Member</div>
  @if($groups->member != '[]')
<ul class="list-group">
@foreach(json_decode($groups->member) as $member)
<?php $use = ToNovel::uinfo($member); ?>
<li class="list-group-item" id="li-member-{{$use->id}}"><span class="status" style="background-color: #a00505;">Hapus</span><a href="#" onclick="deletemember('{{$use->id}}',event)"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$use->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{ucfirst($use->name)}}</h5> <div> <span>{{$use->bio}}</span> </div> </div> </div></a> </li>
@endforeach
</ul>
@else
<div class="centered"><br>
    <p><i class="glyphicon glyphicon-remove gly-4x"></i></p>
    <p><small>Saat ini belum ada anggota</small></p>
</div>
@endif
    </div>
</div>
<div id="ads" class="tab-pane fade">
<div class="panel panel-default">
  <div class="panel-heading">Pengaturan Iklan</div>
  <div class="panel-body">
    {!! Form::model($groups,['route' => ['Groupset',$groups->slug], 'method' => 'POST']) !!}
        {{ Form::hidden('ads', 'yes') }}
        {{ Form::label('adsbox', 'Source Kode Iklan') }}
        {{ Form::textarea('adsbox', null, ['placeholder'=>'Masukkan iklan kamu bisa gambar / ads / dst','class' => 'form-control','size' => '10x2']) }}<br>
        {{ Form::submit('Simpan Pengaturan', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
  </div>
</div>
</div>
<div id="feed" class="tab-pane fade">
<div class="panel panel-default">
  <div class="panel-heading">Pengaturan Feed</div>
  <div class="panel-body">
  @if(empty($groups->url))
  <div style="text-align:center;" id="box-info">
    <p><i class="glyphicon glyphicon-screenshot gly-4x"></i></p>
    <p><small>Ambil data rilisan langsung dari web kamu</small></p>
    <button class="btn btn-info" id="click-button">Aktifkan Feed Sekarang</button>
  </div>
    <div class="form-group" id="box-check" style="display:none">
    {!! Form::model($groups,['route' => ['Groupset',$groups->slug], 'method' => 'POST']) !!}
        {{ Form::hidden('feed', 'yes') }}
        {{ Form::label('meta', 'Tambahkan meta ini sebelum </head>') }}
        <pre>&#x3C;meta name=&#x22;tonovel&#x22; content=&#x22;tonovel-verification&#x22; /&#x3E;</pre>
        {{ Form::label('url', 'Alamat Website') }}
        {{ Form::input('url', 'url', null, ['class' => 'form-control']) }}<br>
        {{ Form::submit('Cek dan simpan', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				{!! Form::close() !!}
    </div>
  </div>
  @else
  <div style="text-align:center;" id="box-info">
    <p><i class="glyphicon glyphicon-ok gly-4x" style="color:green"></i></p>
    <p><small>Feed saat ini aktif</small></p>
		{!! Form::model($groups,['route' => ['Groupset',$groups->slug], 'method' => 'POST']) !!}
    {{ Form::hidden('feed', 'off') }}
    {{ Form::submit('Matikan Feed', ['class' => 'btn btn-danger']) }}
				{!! Form::close() !!}
  </div>
  @endif
  </div>
</div>
</div>
</div></div></div>
@endsection
@section('javascript')
<script>
  var loadThumb = function(event) {
    var output = document.getElementById('output');
    if (!event.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    event.target.value = '';
    }else{
    output.src = URL.createObjectURL(event.target.files[0]);
    }
  };
  var loadFiles = function(event) {
    var output = document.getElementById('group-header');
    if (!event.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    event.target.value = '';
    }else{
      //    background: 
    $('#group-header').css({'background': "#fff url("+URL.createObjectURL(event.target.files[0])+") center no-repeat","background-size": "cover" })
    }
  };
  $('#click-button').click(function(){
    $('#box-check').show();
    $('#box-info').hide();
});
  function deletemember(id,e){
    e.preventDefault();
    if(confirm('Hapus user ini dari group?')){
            $['ajax']({
                type: 'GET',
                url: '/api/group/delete/'+$('#group-slug').val()+'/member/'+id,
                contentType: 'text/html; charset=UTF-8',
                success: function(_0x7ce2x7) {
                    if (_0x7ce2x7['status'] == 'success') {
                        $('#li-member-'+id).remove();
                        iziToast['success']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    } else {
                        iziToast['warning']({
                            timeout: 2000,
                            title: capi(_0x7ce2x7['status']),
                            message: _0x7ce2x7['msg']
                        })
                    }
                }
            })
    }
  }
</script>
@endsection