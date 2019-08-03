@extends('main')
@section('title', "Group ".$groups->name)
@section('stylesheets')
@if($type == 'news')
<link rel="stylesheet" href="{{asset('vendor/trumbowyg/ui/trumbowyg.min.css')}}" />
@endif
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
  <a href="{{route('group.manajer',$groups->slug).'?filter=proyek'}}" class="list-group-item {{Request::is('*/proyek/*') ? "active":""}}">Atur Proyek</a>
  <a href="{{route('group.manajer',$groups->slug).'?filter=release'}}" class="list-group-item {{Request::is('*/rilisan/*') ? "active":""}}">Atur Rilisan</a>
  <a href="{{route('group.manajer',$groups->slug).'?filter=news'}}" class="list-group-item {{Request::is('*/news/*') ? "active":""}}">Atur Berita</a>
</div>
</div>
<div class="col-md-9 tab-content">
@if($type == 'rilisan')
<div class="panel">
<div class="panel panel-heading">Ubah V{{$release->volume}}B{{$release->numba}} dari {{$release->novels->title}}</div>
<div class="panel panel-body">
      	{!! Form::model($release,['route' => ['updateRilisan','slug'=>$groups->slug,'id'=>$release->id], 'method' => 'POST']) !!}
        {{ Form::hidden('rilisan', 'yes') }}
        {{ Form::label('volume', 'Volume (0 jika tidak ada volume)') }}
        {{ Form::input('volume', 'volume', null, ['placeholder'=>'Masukkan volume','class' => 'form-control input-sm']) }}        
        {{ Form::label('numba', 'Chapter / Bab') }}
        {{ Form::input('numba', 'numba', null, ['placeholder'=>'Masukkan bab','class' => 'form-control input-sm']) }}        
        {{ Form::label('title', 'Title Rilisan') }}
        {{ Form::input('title', 'title', null, ['placeholder'=>'Contoh : Pertarungan Dimulai','class' => 'form-control input-sm']) }}
        {{ Form::label('description', 'Deskripsi (wajib)') }}
        {{ Form::textarea('description', null, ['class' => 'form-control','size' => '10x2']) }}			
        {{ Form::label('content', 'URL/Link Rilisan (Opsional)') }}
        {{ Form::input('content', 'content', null, ['placeholder'=>'Jika rilisan kamu web dan bukan dari internal silahkan isi','class' => 'form-control input-sm']) }}<br>
        {{ Form::submit('Update Rilisan', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}      
				{!! Form::close() !!}
</div>
</div>
@elseif($type == 'news')
<div class="panel">
<div class="panel panel-heading">Ubah Berita</div>
<div class="panel panel-body">
 {!! Form::model($news,['route' => ['updatenews','slug'=>$groups->slug,'id'=>$news->id], 'method' => 'POST']) !!}
        {{ Form::label('title', 'Judul') }}
        {{ Form::input('title', 'title', null, ['placeholder'=>'Masukkan judul','class' => 'form-control input-sm']) }}        
        {{ Form::label('content', 'Isi') }}
        {{ Form::textarea('content', null, ['class' => 'form-control','size' => '10x10']) }}			
        {{ Form::label('status', 'Status Berita') }}
        {{ Form::select('status', [0=>'Tidak dipublish', 1=>'Dipublish', 2=>'Draf'] ,$news->status,['class'=> 'form-control']) }}<br>
        {{ Form::submit('Update Berita', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}      
		{!! Form::close() !!}
</div>
</div>
@elseif($type == 'proyek')
      <?php 
      $i =0;
      foreach(json_decode($groups->member) as $member){
      $json[$member] = ucfirst(ToNovel::uinfo($member)['name']);
      $i++;
      }
      ?>
       <div class="panel">
<div class="panel panel-heading">Ubah Manajemen Proyek <b>{{$proyek->id}}</b></div>
<div class="panel panel-body">
        {!! Form::model($proyek,['route' => ['updateProyek','slug'=>$groups->slug,'id'=>$proyek->novel_id], 'method' => 'POST']) !!}
        {{ Form::label('manager', 'Manajer Proyek') }}
        {{ Form::select('manager', $json, $proyek->group_manager, ['class' => 'selectpicker','title' => 'Pilih Manajer','data-live-search'=>'true','data-header' => 'Pilih Manajer','data-style' => 'btn-default','data-width' => '100%']) }}        
        {{ Form::label('team', 'Penerjemah:') }}
        {{ Form::select('team[]', $json, json_decode($proyek->group_team), ['class' => 'selectpicker','title' => 'Pilih Staff','data-live-search'=>'true','data-header' => 'Pilih Staff','multiple data-selected-text-format' => 'count > 10','data-style' => 'btn-default','data-width' => '100%']) }}
        {{ Form::label('editor', 'Editor:') }}
        {{ Form::select('editor[]', $json, json_decode($proyek->group_editor), ['class' => 'selectpicker','title' => 'Pilih Staff','data-live-search'=>'true','data-header' => 'Pilih Staff','multiple data-selected-text-format' => 'count > 10','data-style' => 'btn-default','data-width' => '100%']) }}
        {{ Form::label('group_status', 'Status Proyek: (?)') }}
        {{ Form::select('group_status', [0=>'Dropped', 1=>'Aktif', 2=>'Hiatus'] ,$proyek->group_status,['class'=> 'form-control']) }}
        
      </div>
      <div class="modal-footer">
        {{ Form::submit('Update Proyek', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}      
		{!! Form::close() !!}
      </div>
      </div>
@endif
</div>
</div>
</div>
@endsection
@section('javascript')
@if($type=="news")
<script src="{{asset('vendor/trumbowyg/trumbowyg.min.js')}}"></script>
<script src="{{asset('vendor/trumbowyg/langs/id.min.js')}}"></script>
<script>
$('#content').trumbowyg({
  lang: 'id'
});
</script>
@endif
@endsection