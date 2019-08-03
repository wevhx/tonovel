@extends('main')
@section('title', "Group ".$groups->name)
@section('stylesheets')
<style>
#app{
padding:10px;
}
div>#content {
    width: 100%;
    padding: 10px;
    transition: all 0.3s;
    position: relative;
    top: 0px;
    right: 0;
}
</style>
@php if(empty($groups->member)) $groups->member = '[]'; @endphp
@if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member)))
@if($type == 'news')
<link rel="stylesheet" href="{{asset('vendor/trumbowyg/ui/trumbowyg.min.css')}}" />
@elseif($type == 'proyek')
<style>
.bootstrap-select .status{background:#f0f0f0;clear:both;color:#999;font-size:11px;font-style:italic;font-weight:500;line-height:1;margin-bottom:-5px;padding:10px 20px}
</style>
@endif
@endif
@endsection
@section('blurred')
<script>
document.getElementsByClassName("navbar-fixed-top")[0].className += " transparent";
</script>
    <div id="ch-tp"></div>
<div class="group-header" @if(!empty($groups->backg)) style='background: url("/uploads/group/cover/{{$groups->backg}}") center center / cover no-repeat rgb(255, 255, 255);' @endif data-group="{{$groups->id}}">
        <div class="group-header-wrapper">
            <div class="header-avatar">
                <a href="{{route('group.group',$groups->slug)}}"><img class="header-avatar-img" src="{{ToNovel::imggo('group',0,$groups->thumb)}}" alt="{{$groups->name}}"></a>
                <a class="header-avatar-vip icon icon-cv" href="" target="_blank"></a>
            </div>
            <div class="header-msg">
                <h3 id="EgogroupWrap" data-id="{{$groups->id}}"><a href="{{route('group.group',$groups->slug)}}">{{ucfirst($groups->name)}}</a></h3>
                <div class="header-msg-desc">Bergabung {{\Carbon\Carbon::parse($groups->created_at)->diffForHumans()}}</div>
                
                <div class="header-msg-title">{{$groups->description}}</div>
                
                <div class="header-msg-data">
                    <span class="mr8">Pengikut :<strong class="header-msg-strong">{{$groups->users->count()}}</strong></span><span class="ml12 mr8">Proyek :<strong class="header-msg-strong">{{ $groups->projects()->count()}}</strong></span>
                    <div class="pull pull-right pull-inmobile">
                  @guest
                  <a href="{{url('login')}}" class="btn btn-info">Follow</a>
                  @else
                  {!! Form::open(array('url'=>route('Groupwor',$groups->slug))) !!}
                  @php $follow = $groups->users()->where('group_id',$groups->id)->where('user_id',Auth::user()->id)->get(); @endphp
                  @if($follow->isEmpty())
                  {{ Form::submit('Follow', ['class' => 'btn btn-info']) }}
                  @else
                  {{ Form::submit('Unfollow', ['class' => 'btn btn-info']) }}
                  @endif
                  @if($groups->staff == Auth::user()->id)
                  <a href="{{route('group.group',$groups->slug).'/setting'}}" class="btn btn-success"><i class="glyphicon glyphicon-cog"></i></a>
                  @endif
                  {!! Form::close() !!}
                  @endguest
                  </div>
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
@if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member)))
<a href="{{route('group.manajer',$groups->slug)}}" class="btn btn-block btn-red">Staff Manajemen</a><br>
@if($type == 'proyek')
<a href="#" data-toggle="modal" data-target="#bProyek" class="btn btn-block btn-purple">Buat Proyek</a>
<a href="#" data-toggle="modal" data-target="#bRilisan" class="btn btn-block btn-warning">Buat Rilisan</a><br>
@elseif($type == 'news')
<a href="#" data-toggle="modal" data-target="#bBerita" class="btn btn-block btn-info">Buat Berita</a><br>
@endif
@endif
  <a href="{{route('group.group',$groups->slug).'/proyek'}}" class="list-group-item {{ Request::is('*/proyek') ? "active" : ""}}">
    Proyek
  </a>
  <a href="{{route('group.group',$groups->slug).'/news'}}" class="list-group-item {{ Request::is('*/news') ? "active" : ""}}">Berita
  </a>
  <a href="{{route('group.group',$groups->slug).'/stat'}}" class="list-group-item {{ Request::is('*/stat') ? "active" : ""}}">Statistik
  </a>
</div>
<div class="panel panel-default">
  <div class="panel-heading">Daftar Pengikut</div>
  <div class="panel-body">
        @if($groups->users->count() != 0)
        @php $i = 0; @endphp
        @foreach($groups->users as $user)
        <a href="{{route('user.user',$user->name)}}"><img src="{{ToNovel::imggo('user',2,$user->userimg)}}" class="w-40 avatar" title="{{$user->name}}"></a>
        @if ($i > 13) <i class="glyphicon glyphicon-option-horizontal" style="margin:10px 5px"></i> @break; @endif
        @php $i++; @endphp
        @endforeach
        @else
        <center>Jadilah yang pertama mengikutinya</center>
        @endif
  </div>
</div>
</div>
<div class="col-md-9">
@if($type == 'proyek')
<div class="panel">
<?php
$grn = $groups->projects()->where('group_status',1)->get();
?>
<div class="panel panel-heading">Daftar Proyek Aktif <b>({{$grn->count()}})</b></div>
  @if(!$grn->isEmpty())
<ul class="tonovellist__tonovels">
  @foreach($grn as $novel)
{{--  @php $novel = $data->novels @endphp  --}}
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$novel->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$novel->thumb)}}">
</a>
<a href="{{route('novel.lihat',$novel->slug)}}" title="{{$novel->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$novel->title}}</h3>
<h2 class="tonovellist-item__desc">{{$novel->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($novel->slug)) < 2) ? ToNovel::getscore($novel->slug).'.0': substr(ToNovel::getscore($novel->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$novel->category->name}}</li>
<li class="item-label score">Total {{@$novel->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
  @endforeach
  </ul>
  @else
   <div class="content shadow text-center">
<div class="alert alert-danger"><i class="glyphicon glyphicon-remove gly-4x"></i><br><br>Tidak ditemukan<br><small>Jika kamu pemilik/staff silahkan tambahkan proyek.</small></div></div>
  @endif
</div>
<div class="panel">
<?php
$grn = $groups->projects()->where('group_status',0)->get();
?>
<div class="panel panel-heading">Daftar Proyek Drop : <b>({{$grn->count()}})</b></div>
  @if(!$grn->isEmpty())
<ul class="tonovellist__tonovels">
  @foreach($grn as $novel)
{{--  @php $novel = $data->novels @endphp  --}}
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$novel->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$novel->thumb)}}">
</a>
<a href="{{route('novel.lihat',$novel->slug)}}" title="{{$novel->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$novel->title}}</h3>
<h2 class="tonovellist-item__desc">{{$novel->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($novel->slug)) < 2) ? ToNovel::getscore($novel->slug).'.0': substr(ToNovel::getscore($novel->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$novel->category->name}}</li>
<li class="item-label score">Total {{@$novel->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
  @endforeach
  </ul>
  @else
   <div class="content shadow text-center">
<div class="alert alert-success"><i class="glyphicon glyphicon-check gly-4x"></i><br><br>Tidak ditemukan<br><small>Group ini sangat serius menggarap proyek.</small></div></div> 
@endif
</div>
<div class="panel">
<?php
$grn = $groups->projects()->where('group_status',2)->get();
?>
<div class="panel panel-heading">Daftar Proyek Hiatus <b>({{$grn->count()}})</b></div>
  @if(!$grn->isEmpty())
<ul class="tonovellist__tonovels">
  @foreach($grn as $novel)
{{--  @php $novel = $data->novels @endphp  --}}
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$novel->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$novel->thumb)}}">
</a>
<a href="{{route('novel.lihat',$novel->slug)}}" title="{{$novel->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$novel->title}}</h3>
<h2 class="tonovellist-item__desc">{{$novel->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($novel->slug)) < 2) ? ToNovel::getscore($novel->slug).'.0': substr(ToNovel::getscore($novel->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$novel->category->name}}</li>
<li class="item-label score">Total {{@$novel->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
  @endforeach
  </ul>
  @else
   <div class="content shadow text-center">
<div class="alert alert-success"><i class="glyphicon glyphicon-check gly-4x"></i><br><br>Tidak ditemukan<br><small>Group ini sangat serius menggarap proyek.</small></div></div>
  @endif
</div>
@elseif($type == 'news')
<div class="panel">
<div class="panel panel-heading">Berita</div>
<?php
$newss = \App\News::where('type',1)->where('status',1)->where('object',$groups->id)->orderBy('created_at','DESC')->get();
?>
@if(!$newss->isEmpty())
<div class="list-group">
@foreach($newss as $news)
  <a href="{{route('news.lihat',$news->id)}}" class="list-group-item">
    <h4 class="list-group-item-heading">{{$news->title}}</h4>
    <div class="status">{{\Carbon\Carbon::parse($news->created_at)->diffForHumans()}}</div>
    <p class="list-group-item-text">{{ substr($news->content, 0, 100) }}{{ strlen($news->content) > 100 ? "..." : "" }}</p>
  </a>
@endforeach
</div>
@else
<div class="centered">
    <p><i class="glyphicon glyphicon-remove gly-4x"></i></p>
    <p><small>Saat ini tidak ada</small></p>
</div>
@endif
</div>
@elseif($type == 'stat')
<div class="panel">
<ul class="list-group">
<li class="list-group-item"><span class="status" style="background-color:#c89b2a">#PEMILIK</span><a href="{{route('user.user',$groups->admins->name)}}"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$groups->admins->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{ucfirst($groups->admins->name)}}</h5> <div> <span>{{$groups->admins->bio}}</span> </div> </div> </div></a> </li>
</ul>
</div>
<div class="panel">
<div class="panel panel-heading">Statistik</div>
<div class="panel panel-body">
<div class="row">
<div class="col-md-6">
@if($groups->projects()->count() > 0)
<div id="canvas-holder" style="width:100%">
        <canvas id="chart-area" />
    </div>
@else
<div class="centered kosong"></div>
@endif
</div>
<div class="col-md-6">
<ul class="list-group">
  <li class="list-group-item">
    <span class="badge">{{$groups->projects()->count()}}</span>
    Total Proyek
  </li>
  <li class="list-group-item">
    <span class="badge">{{$groups->projects()->where('group_status',1)->count()}}</span>
    Total Proyek Aktif
  </li>
  <li class="list-group-item">
    <span class="badge">{{$groups->projects()->where('group_status',2)->count()}}</span>
    Total Proyek Hiatus
  </li>
  <li class="list-group-item">
    <span class="badge">{{$groups->projects()->where('group_status',0)->count()}}</span>
    Total Proyek Dropped
  </li>
</ul>
</div>
</div>
</div>
</div>
<div class="panel">
<div class="panel panel-heading">Staff / Editor / Kontributor</div>
<ul class="list-group">
@foreach(json_decode($groups->member) as $member)
<?php $use = ToNovel::uinfo($member); ?>
<li class="list-group-item"><span class="status" style="background-color: #a00505;">【{{ToNovel::exp($use->total_exp)['rank']}}】</span><a href="{{route('user.user',$use->name)}}"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$use->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{ucfirst($use->name)}}</h5> <div> <span>{{$use->bio}}</span> </div> </div> </div></a> </li>
@endforeach
</ul>
</div>
@else
<h2 style="font-size:16px">Rilisan Terbaru</h2>
<div class="panel">
@if(!$chapter->isEmpty())
 @foreach($chapter->groupBy(function($date) {return $date->created_at->format('d, M Y');}) as $key => $value)
<h2 style="font-size: 14px;margin:10px;">{{$key}}</h2>
<table class="table table-striped rilisan" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="80%">Judul</th>
                <th width="20%">Rilisan</th>
            </tr>
        </thead>
        <tbody>
 @foreach($value as $chapt)
            <tr>
                <td><a style="font-weight:400" href="{{route('novel.lihat',$chapt->novels->slug)}}">{{$chapt->novels->title}}</a></td>
                <td><a style="font-weight:400" href="{{route('chapter.lihat',$chapt->slug)}}">V{{$chapt->volume}}B{{$chapt->bab}}</a></td>
              </tr>
@endforeach
          </tbody>
          </table>

@endforeach
        <div class="centered">
        {{$chapter->links()}}
        </div>
@else
<div class="well well-sm centered kosong"></div>
@endif
</div>
@endif
        <div class="panel"><div class="panel panel-heading">Komentar</div><iframe id="comment-box" frameborder="0" onload="autoResize()" scrolling="no" width="100%" src="{{route('comment').'?type=2&object='.$groups->slug}}"></iframe></div>
</div></div></div>
<!-- Modal -->
@if($type == 'proyek')
<div id="bRilisan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buat Rilisan Baru</h4>
      </div>
      <div class="modal-body">
      <?php
      $grn = $groups->projects()->where('group_status',1)->get();
      $i = 0;
      foreach($grn as $nov){  
        $vo[$nov->id] = $nov->title;
        $i++;
      }
      if(empty($vo)) $vo = array();
			?>
      	{!! Form::model(null,['route' => array('group.rilisan',$groups->slug), 'method' => 'POST']) !!}
        {{ Form::hidden('rilisan', 'yes') }}
        {{ Form::label('proyek', 'Proyek') }}
        {{ Form::select('proyek', $vo, null, ['class' => 'selectpicker','title' => 'Pilih Proyek yang Aktif','data-live-search'=>'true','data-header' => 'Pilih Proyek Aktif','data-style' => 'btn-default','data-width' => '100%']) }}        
        {{ Form::label('vbab', 'Volume Bab') }}
        {{ Form::input('vbab', 'vbab', null, ['placeholder'=>'Masukkan volume or bab contoh: V0B1 = Volume 1 Bab 1','class' => 'form-control input-sm']) }}        
        {{ Form::label('title', 'Title Rilisan') }}
        {{ Form::input('title', 'title', null, ['placeholder'=>'Contoh : Pertarungan Dimulai','class' => 'form-control input-sm']) }}
        {{ Form::label('description', 'Deskripsi (Wajib)') }}
        {{ Form::textarea('description', null, ['class' => 'form-control','size' => '10x2']) }}			
        {{ Form::label('content', 'URL/Link Rilisan (Opsional)') }}
        {{ Form::input('content', 'content', null, ['placeholder'=>'Jika rilisan kamu web dan bukan dari internal silahkan isi','class' => 'form-control input-sm']) }}
        {{ Form::label('otomatis', 'Otomatis grabbing: (?)') }}
        {{ Form::select('otomatis', ['Nonaktif', 'Aktif'] ,null ,['class'=> 'form-control']) }}
        </div>
      <div class="modal-footer">
        {{ Form::submit('Buat Rilisan', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}      
				{!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
<div id="bProyek" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buat Proyek</h4>
      </div>
      <div class="modal-body">
      <?php 
      $i =0;
      foreach(json_decode($groups->member) as $member){
      $json[$member] = ucfirst(ToNovel::uinfo($member)['name']);
      $i++;
      }
      if(empty($json)) $json = array();
       ?>
      {!! Form::open(array('route' => array('group.project',$groups->slug),'files' => false)) !!}
        {{ Form::hidden('proyek', 'yes') }}
        {{ Form::label('judul', 'Judul Novel') }}
        {{ Form::select('judul',array(), null, ['class' => 'selectpicker with-ajax','title' => 'Pilih Novel','data-live-search'=>'true','data-header' => 'Pilih Novel','data-style' => 'btn-default','data-width' => '100%','data-live-search'=>'true']) }}        
        {{ Form::label('manager', 'Manajer Proyek') }}
        {{ Form::select('manager', $json, null, ['class' => 'selectpicker','title' => 'Pilih Manajer','data-live-search'=>'true','data-header' => 'Pilih Manajer','data-style' => 'btn-default','data-width' => '100%']) }}        
        {{ Form::label('team', 'Penerjemah:') }}
        {{ Form::select('team[]', $json, null, ['class' => 'selectpicker','title' => 'Pilih Staff','data-live-search'=>'true','data-header' => 'Pilih Staff','multiple data-selected-text-format' => 'count > 10','data-style' => 'btn-default','data-width' => '100%']) }}
        {{ Form::label('editor', 'Editor:') }}
        {{ Form::select('editor[]', $json, null, ['class' => 'selectpicker','title' => 'Pilih Staff','data-live-search'=>'true','data-header' => 'Pilih Staff','multiple data-selected-text-format' => 'count > 10','data-style' => 'btn-default','data-width' => '100%']) }}
      </div>
      <div class="modal-footer">
        {{ Form::submit('Buat Proyek', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}      
				{!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
@elseif($type == 'news')
<div id="bBerita" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buat Berita Baru</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => array('creategroupnews',$groups->slug))) !!}
        {{ Form::hidden('news', 'yes') }}
        {{ Form::label('title', 'Judul') }}
        {{ Form::input('title', 'title', null, ['class' => 'form-control']) }}
        {{ Form::label('content', 'Isi') }}
        {{ Form::textarea('content', null, ['class' => 'form-control','size' => '10x2']) }}			
        </div>
      <div class="modal-footer">
        {{ Form::submit('Buat Berita', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}      
				{!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
@endif
@endsection
@section('javascript')
@if($type=="stat")
<script type="text/javascript" src="http://www.chartjs.org/dist/2.7.1/Chart.bundle.js"></script>
<script>
window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

    var config = {
        type: 'pie',
        data: {
            datasets: [{
                data: {{json_encode(array($groups->projects()->where('group_status',1)->count(),$groups->projects()->where('group_status',2)->count(),$groups->projects()->where('group_status',0)->count()))}},
                backgroundColor: [
                    window.chartColors.blue,
                    window.chartColors.orange,
                    window.chartColors.red
                ],
                label: 'Statistik'
            }],
            labels: [
                "Aktif",
                "Hiatus",
                "Drop"
            ]
        },
        options: {
            responsive: true
        }
    };

    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx, config);
    };
    var colorNames = Object.keys(window.chartColors);
</script>
@endif
@if($groups->staff == @Auth::user()->id OR @in_array(@Auth::user()->id, json_decode($groups->member)))
@if($type=="news")
<script src="{{asset('vendor/trumbowyg/trumbowyg.min.js')}}"></script>
<script src="{{asset('vendor/trumbowyg/langs/id.min.js')}}"></script>
<script>
$('#content').trumbowyg({
  lang: 'id'
});
</script>
@elseif($type=="proyek")
<script src="{{asset('js/ajax-bootstrap-select.min.js')}}"></script>
<script>

    var options = {
        ajax          : {
            url     : 'http://localhost:8000/api/search',
            type    : 'GET',
            dataType: 'json',
            data    : {
                s: '@{{{q}}}'
            }
        },
        locale        : {
            emptyTitle: 'Ketik untuk mencari'
        },
        log           : 0,
        preprocessData: function (data) {
            var i, l = data.novel.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data.novel[i], {
                        text : data.novel[i].title,
                        value: data.novel[i].id,
                        data : {
                            subtext: data.novel[i].alt_title
                        }
                    }));
                }
            }
            return array;
        }
    };
    $('#judul').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
    //$('#judul').append('<option value="" data-subtext="" selected="selected">CarI Novel</option>').selectpicker('refresh');
    $('#judul').trigger('change');
</script>
@endif
@endif
@endsection