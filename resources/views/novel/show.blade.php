@php
$i = 0;
foreach ($novel->publishers as $data) {
    if($data->type == 0){
    @$idpub[$i] = '<a href="/publisher/'.$data->slug.'">'.$data->name.'</a> ';
    }
    if($data->type == 1){
    @$enpub[$i] = '<a href="/publisher/'.$data->slug.'">'.$data->name.'</a> ';
    }
    $i++;
}
foreach ($novel->peoples as $data) {
    if($data->ppl_type == 2){
    @$artist[$i] = '<a href="/people/'.$data->ppl_slug.'">'.$data->ppl_name.'</a> ';
    }
    if($data->ppl_type == 1){
    @$author[$i] = '<a href="/people/'.$data->ppl_slug.'">'.$data->ppl_name.'</a> ';
    }
    $i++;
}
if($novel->status == 0) $status = 'Tamat';
if($novel->status == 1) $status = 'Masih Berlanjut';
if($novel->status == 2) $status = 'Berhenti Rilis';
if($novel->status == 3) $status = 'Tak Diketahui';
if(empty($idpub)) $idpub = 'Belum ada';
if(empty($enpub)) $enpub = 'Belum ada';
if(empty($author)) $author = 'Unknown';
if(empty($artist)) $artist = 'Unknown';
$voter = ToNovel::getVote($novel->slug);
@endphp
@extends('main')
@section('title', $novel->title)
@section('blurred')
@if(isset($novel->blurred) && $novel->blurred != $novel->thumb)
<style>
.bg-ani {position: absolute;top:52px;left: 0;width: 100%;height: 100%;background-position: center center;background-size: cover;background-repeat: no-repeat;z-index: 0;}
      div.bg-image:before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        display: block;
        background-image: radial-gradient(at 10% 30%, #352235 0%, #f5f5f5 0%);
        will-change: opacity;
        filter: opacity(100%);
        transition: filter 1s;
      }

      div.bg-image.lazyloaded:before {
       filter: opacity(92%);
      }
    

    div.bg-image:before {
      content: '';
      position: absolute;
      left: 0;
      right: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      display: block;
      background-image: radial-gradient(at 10% 30%, #352235 0%, #f5f5f5 0%);
      will-change: opacity;
      filter: opacity(100%);
      transition: filter 1s;
    }
</style>
<div class="bg-image bg-ani lazyloaded" data-parallax="scroll" style="filter: blur(100%); transform: translate3d(0px, 0px, 0px); opacity: 1; background-image: url(&quot;{{ $novel->blurred }}&quot;);"></div>
@else
<style>
.bg-ani {
    display: none;
}
</style>
@endif
@endsection
@section('content')
<div class="row">
      <div class="col-md-3">
      <div class="top-m-desc"></div>
      <div class="panel panel-default">
      <div class="cover-panel">
  <img src="data:image/gif;base64,R0lGODdhAQABAPAAAMPDwwAAACwAAAAAAQABAAACAkQBADs=" data-src="{{ ToNovel::imggo('poster',0,$novel->thumb) }}" onerror="imgError(this);" class="cover-img">
  </div>
  <div class="panel">
  
  <div class="list-group">
@if(isset($type) && in_array($type, array('terkait','rekomendasi','jilid','group')))
  <div class="block-info" style="display:fixed">
<a href="{{route('novel.lihat',$novel->slug)}}" class="list-group-item novel-chapter" title="Bab Novel">
<h6 class="list-group-item-heading" style="margin-bottom: 0px;"><b><i class="glyphicon glyphicon-th-list"></i> Daftar Isi</b></h6>
</a>
<a href="{{route('novel.cat',['slug'=>$novel->slug,'cat'=>'terkait'])}}" class="list-group-item novel-terkait" title="Novel Terkait">
<h6 class="list-group-item-heading" style="margin-bottom: 0px;"><b><i class="glyphicon glyphicon-link"></i> Novel Terkait</b></h6>
</a>
{{--  <a href="{{route('novel.cat',['slug'=>$novel->slug,'cat'=>'rekomendasi'])}}" class="list-group-item novel-rekomendasi" title="Rekomendasi Novel">
<h6 class="list-group-item-heading" style="margin-bottom: 0px;"><b><i class="glyphicon glyphicon-heart-empty"></i> Rekomendasi Novel</b></h6>
</a>  --}}
</div>
@else
  <div class="block-info" style="display:none">
<a href="{{route('novel.cat',['slug'=>$novel->slug,'cat'=>'terkait'])}}" class="list-group-item novel-terkait" title="Novel Terkait">
<h6 class="list-group-item-heading" style="margin-bottom: 0px;"><b><i class="glyphicon glyphicon-link"></i> Novel Terkait</b></h6>
</a>
</div>
@endif
  <li class="fist-group-item">
    <span class="aniled"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($novel->slug)) < 2) ? ToNovel::getscore($novel->slug).'.0': substr(ToNovel::getscore($novel->slug), 0, 3) !!}
    </span>
    <span style="left: right;text-align: right;font-size: .84em;">AVG.SCORE</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ ($novel->licensed) ? 'Ada': 'Belum ada' }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">LISENSI</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ ToNovel::country($novel->country) }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">NEGARA</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled truncate">{!! implode(', ',(array)@$author) !!}</span>
    <span style="left: right;text-align: right;font-size: .84em;">PENULIS</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ $novel->category->name }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">TYPE</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ $status }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">STATUS</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{ $novel->year }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">TAHUN</span>
  </li>
  <div class="block-info" style="display:none">
  <li class="fist-group-item">
    <span class="aniled">{!! implode(', ',(array)$artist) !!}</span>
    <span style="left: right;text-align: right;font-size: .84em;">ILUSTRATOR</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{!! implode(', ',(array)$idpub) !!}</span>
    <span style="left: right;text-align: right;font-size: .84em;">PENERBIT (EN)</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{!! implode(', ',(array)$enpub) !!}</span>
    <span style="left: right;text-align: right;font-size: .84em;">PENERBIT (ID)</span>
  </li>
  <label><small style="margin:4px">Statistik</small></label>
  <li class="fist-group-item">
    <span class="aniled"><i class="glyphicon glyphicon-eye-open"></i> {{ Counter::showAndCount('novel-profile', $novel->id) }}x</span>
    <span style="left: right;text-align: right;font-size: .84em;">DILIHAT</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled"><i class="glyphicon glyphicon-heart red-d"></i> {{@($voter['loved']) ? $voter['loved'] : 0 }}</span>
    <span style="left: right;text-align: right;font-size: .84em;">DIFAVORITKAN </span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{$voter['total']}} Vote <a href="#" id="ack-voter">>></a></span>
    <span style="left: right;text-align: right;font-size: .84em;">VOTERs (ID)</span>
  </li>
  <div style="display:none" id="voter-item">
  <li class="fist-group-item">
    <span class="aniled">{{@($voter['votg'][5]['avg']) ? $voter['votg'][5]['avg'] : 0}}% / {{($voter['data'][5]) ? $voter['data'][5] : 0}} User</span>
    <span style="left: right;text-align: right;font-size: .84em;"><span class="_tonovr"><span style="width: 65px;"></span></span></span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{@($voter['votg'][4]['avg']) ? $voter['votg'][4]['avg'] : 0}}% / {{($voter['data'][4]) ? $voter['data'][4] : 0}} User</span>
    <span style="left: right;text-align: right;font-size: .84em;"><span class="_tonovr"><span style="width: 52px;"></span></span></span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{@($voter['votg'][3]['avg']) ? $voter['votg'][3]['avg'] : 0 }}% / {{($voter['data'][3]) ? $voter['data'][3] : 0}} User</span>
    <span style="left: right;text-align: right;font-size: .84em;"><span class="_tonovr"><span style="width: 39px;"></span></span></span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{@($voter['votg'][2]['avg']) ? $voter['votg'][2]['avg'] : 0 }}% / {{($voter['data'][2]) ? $voter['data'][2] : 0 }} User</span>
    <span style="left: right;text-align: right;font-size: .84em;"><span class="_tonovr"><span style="width: 26px;"></span></span></span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{@($voter['votg'][1]['avg']) ? $voter['votg'][1]['avg'] : 0 }}% / {{($voter['data'][1]) ? $voter['data'][1] : 0}} User</span>
    <span style="left: right;text-align: right;font-size: .84em;"><span class="_tonovr"><span style="width: 13px;"></span></span></span>
  </li>
  </div>
  </div>
  <a href="#" class="more"><i class="glyphicon glyphicon-triangle-bottom gly-buzz"></i></a>
  </div>
  </div>
</div>
      </div>
      <div class="col-md-9">
      <div class="top-desc">

      <h2><b>{{ $novel->title }}</b>@if(isset(Auth::user()->id)) <small><a href="{{route('novel.edit',$novel->slug)}}" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-retweet"></i> Sunting</a></small>@endif</h2>
      
  @if($novel->title != $novel->alt_title)
      <h5>{{ $novel->alt_title }}</h5>
      @endif
<input type="hidden" id="novelid" value="{{$novel->id}}"/>
      @auth
      <div class="pull pull-right">
        @if($libr == true)
      <div class="btn-group dropdown">
  <button class="btn btn-sm btn-blue dropdown-toggle" type="button" id="status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    @if($libr->status == 1)
    <i class="glyphicon glyphicon-eye-open"></i> Dibaca
    <span class="caret"></span>
    @elseif($libr->status == 2)
    <i class="glyphicon glyphicon-check"></i> Selesai
    <span class="caret"></span>
    @elseif($libr->status == 3)
    <i class="glyphicon glyphicon-pushpin"></i> Ditahan
    <span class="caret"></span>
    @elseif($libr->status == 4)
    <i class="glyphicon glyphicon-hourglass"></i> Direncanakan
    <span class="caret"></span>
    @elseif($libr->status == 5)
    <i class="glyphicon glyphicon-trash"></i> Dibuang
    <span class="caret"></span>
    @else
    <i class="glyphicon glyphicon-plus"></i> Tambahkan ke library 
    <span class="caret"></span>
    @endif
  </button>
  <ul class="dropdown-menu status-menu" aria-labelledby="status">
    <li><a href="#" title="Ditonton"><i class="glyphicon glyphicon-eye-open"></i> Dibaca</a></li>
    <li><a href="#" title="Selesai"><i class="glyphicon glyphicon-check"></i> Selesai</a></li>
    <li><a href="#" title="Ditahan"><i class="glyphicon glyphicon-pushpin"></i> Ditahan</a></li>
    <li><a href="#" title="Direncanakan"><i class="glyphicon glyphicon-hourglass"></i> Direncanakan</a></li>
    <li class="divider"></li>
    <li><a href="#" title="Home"><i class="glyphicon glyphicon-trash"></i> Dibuang</a></li>
    <li><a href="#" title="Hapus dari entry"><i class="glyphicon glyphicon-remove"></i> Hapus dari entry</a></li>
  </ul>
</div>

    @if($libr->loved == 1)
<div class="btn-group tool-library">
  <a href="#" class="btn btn-pink btn-sm" id="favorite" title="Urungkan favorite"><i class="glyphicon glyphicon-heart-empty"></i></a>
</div>
  @else
<div class="btn-group tool-library">
  <a href="#" class="btn btn-red btn-sm" id="favorite" title="Favoritekan"><i class="glyphicon glyphicon-heart-empty gly-beat"></i></a>
</div>
  @endif
<div class="btn-group tool-library">
      <div id="rating" data-rateyo-rating="{{$libr->score}}" data-rateyo-max-value="5"></div>
</div>
@else
      <div class="btn-group dropdown">
  <button class="btn btn-sm btn-blue dropdown-toggle" type="button" id="status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="glyphicon glyphicon-plus"></i> Tambahkan ke library 
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu status-menu" aria-labelledby="status">
    <li><a href="#" title="Dibaca"><i class="glyphicon glyphicon-eye-open"></i> Dibaca</a></li>
    <li><a href="#" title="Selesai"><i class="glyphicon glyphicon-check"></i> Selesai</a></li>
    <li><a href="#" title="Ditahan"><i class="glyphicon glyphicon-pushpin"></i> Ditahan</a></li>
    <li><a href="#" title="Direncanakan"><i class="glyphicon glyphicon-hourglass"></i> Direncanakan</a></li>
    <li class="divider"></li>
    <li><a href="#" title="Home"><i class="glyphicon glyphicon-trash"></i> Dibuang</a></li>
    <li><a href="#" title="Hapus dari entry"><i class="glyphicon glyphicon-remove"></i> Hapus dari entry</a></li>
  </ul>
</div>
<div class="btn-group tool-library" style="display:none" >
  <a href="#" class="btn btn-pink btn-sm" id="favorite" title="Favorit"><i class="glyphicon glyphicon-heart-empty gly-beat"></i></a>
</div>
      <div class="btn btn-sm tool-library"  style="display:none" >
      <div id="rating"></div>
</div>
@endif
</div>
@endauth
      			<div class="genre spaned-top">
            @if(!$novel->genres->isEmpty())
				@foreach ($novel->genres as $genre)
					<a href="/genre/{{ strtolower(trans($genre->slug)) }}" style="text-decoration: none;" title="{{ $genre->name }}"><span style="font-size: 12px;" class="label label-default label-md">{{ $genre->name }}</span></a>
				@endforeach
        @endif
			</div>
      <hr>
      <div class="ani-desc read-more-wrap">{!! $novel->synopsis !!}</div>
    </div>
  <input type="hidden" id="novel-id" value="{{ $novel->id }}"/>
  
@if(isset($type) && $type == 'jilid')
<pre><b>Belum tersedia saat ini</b></pre>
<div class="panel panel-default">
@elseif(isset($type) && $type == 'group')
<h4>Group terkait :</h4>
@php 
$groups = \App\Chapter::select('group_id')->where('novel_id',$novel->id)->distinct()->get();
@endphp
@if(!$groups->isEmpty())
<div class="panel panel-default">
<ul class="list-group">
@foreach($groups as $group)
<li class="list-group-item"><a href="{{route('group.group',$group->groups->slug)}}"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('group',0,$group->groups->thumb)}}" width="50" height="50" class="img-rounded" alt="Thumbnail"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{$group->groups->name}}</h5> <div> <span>{{$group->groups->description}}</span> </div> </div> </div></a> </li>
@endforeach
</ul>
@else 
<div class="alert alert-info centered" style="padding: 6px;"><i class="glyphicon glyphicon-registration-mark gly-4x"></i><br>Tidak ditemukan<br><small>Woaah keliatannya kosong masukin ke daftar group jika ingin.</small></div>
<div class="panel panel-default">
@endif
@elseif(isset($type) && $type == 'terkait')
<h4>Novel terkait :</h4>
<ul class="tonovellist__tonovels">
@if(!$novel->relateds->isEmpty())
  @foreach($novel->relateds as $rel)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$rel->novels->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$rel->novels->thumb)}}">
</a>
<a href="{{route('novel.lihat',$rel->novels->slug)}}" title="{{$rel->novels->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$rel->novels->title}}</h3>
<h2 class="tonovellist-item__desc">{{$rel->novels->synopsis}}</h2>
@if(!$rel->novels->genres->isEmpty())
<h3 class="tonovellist-item__genres">
				@foreach ($rel->novels->genres as $genre)
					<span style="font-size: 12px;" class="label label-default label-md">{{ $genre->name }}</span>
				@endforeach
</h3>
@endif
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($rel->novels->slug)) < 2) ? ToNovel::getscore($rel->novels->slug).'.0': substr(ToNovel::getscore($rel->novels->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status" style="background-color:#ca240a;">{{$rel->type}}</li>
<li class="item-label score">Total {{@$rel->novels->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
  @endforeach
  </ul>
<div class="panel panel-default">
  @else
<div class="panel panel-default">
<div class="panel panel-body">
<div class="centered">Tidak ada Novel yang terkait</div>
</div>
  @endif
  @else
<div class="panel panel-default">
<div class="panel-body">
<table id="chapter-list" class="table table-striped table-hover" cellspacing="0" width="100%">
<div class="pull pull-left" style="position:relative;width:50%"><a href="{{url()->current().'/group'}}" class="btn btn-info btn-xs">Group yang terlibat</a> <a href="{{url()->current().'/jilid'}}" class="btn btn-warning btn-xs">Jilid</a>
<thead>
<tr>
<th width="10px" class="sorting_disabled">VBAB</th>
<th width="90%">Judul</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
@endif
</div>
<div class="rns"></div>
<div class="panel panel-footer">
@if(isset(Auth::user()->id))
@if(!@$ref)
<div class="form-group">
<a href="#" class="btn btn-block btn-info" id="ack-review"><i class="glyphicon glyphicon-pencil"></i> Kirim Ulasan</a>
</div>
<div class="form-group" id="review-form" style="display:none">
				{!! Form::open(array('url'=>route('novel.lihat',$novel->slug))) !!}
        {{ Form::hidden('novel_id', $novel->id) }}
        {{ Form::label('content', 'Berikan Ulasan Kamu') }}
        {{ Form::textarea('content',null,['class' => 'form-control','size' => '10x2','placeholder' => 'Berikan Ulasan kamu disini']) }}
        {{ Form::submit('Kirim', ['style'=>'margin:5px','class' => 'btn btn-primary btn-h1-spacing']) }}
				{!! Form::close() !!}
</div>
@endif
@else
<div class="well well-sm centered">
  Login untuk memberikan Ulasan
</div>
@endif
@if(!$novel->reviews->isEmpty())
@foreach($novel->reviews()->orderBy('id','DESC')->get() as $review)
@php
$library = DB::table('libraries')->where('novel_id', $novel->id)->where('user_id', $review->user->id)->first();
$nilai = @$library->score;
if(empty($nilai)) $nilai = 0;
if(isset(Auth::user()->id) && $review->user_id == Auth::user()->id){
 $userid = '<a href="" data-toggle="modal" data-target="#myReview">Sunting</a>';
}else{
  $userid = '';
}
@endphp
<div class="comment-wrap" id="comment-wrap" data-comment="{{$review->id}}" data-username="{{$review->user->name}}"><div class="photo"><div class="avatar-review" style="background-image: url({{ToNovel::imggo('user',1,$review->user->userimg)}})"></div></div><div class="comment-block"><div class="comment-user"><a href="{{route('user.user',$review->user->name)}}">{{$review->user->name}}</a> <span class="_tonovr" aria-label="Diberi nilai {{$nilai}}"><span style="width: {{$nilai*13}}px;"></span></span><small class="pull-right"><a href="{{route('ulasan.user',$review->user->name)}}">Ulasan lain dari user ini</a></small></div><p class="comment-text read-more-wrap">{{$review->content}}</p><div class="bottom-comment"><div class="comment-date">{{\Carbon\Carbon::parse($review->created_at)->diffForHumans()}}</div><ul class="comment-actions"><li class="reply">{!!$userid!!}</li><li class="complain" onclick="reportr({{$review->id}})"><i class="glyphicon glyphicon-flag"></i></li></ul></div></div> </div>
@endforeach
@else
<div class="well well-sm centered">Belum ada ulasan</div>
@endif
</div>
      </div>
      </div>
      </div>
      
@if(@$ref)
      <div id="myReview" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ubah Ulasan kamu</h4>
      </div>
      <div class="modal-body">
<div class="form-group" id="review-form">
				{!! Form::open(array('url'=>route('novel.lihat',$novel->slug))) !!}
        {{ Form::hidden('action', 'delete') }}
        {{ Form::hidden('id', $ref->id) }}
        {{ Form::submit('Hapus', ['class' => 'pull-right btn btn-xs btn-danger ']) }}
				{!! Form::close() !!}
				{!! Form::model($ref,['route' => array('sentReview', $novel->slug), 'method' => 'POST']) !!}
        {{ Form::hidden('action', 'change') }}
        {{ Form::hidden('id', $ref->id) }}
        {{ Form::hidden('novel_id', $novel->id) }}
        {{ Form::label('content', 'Ulasan Kamu') }}
        {{ Form::textarea('content',null,['class' => 'form-control','size' => '10x2','placeholder' => 'Ulasan kamu disini']) }}
        {{ Form::submit('Kirim', ['style'=>'margin:5px','class' => 'btn btn-primary btn-h1-spacing']) }}
				{!! Form::close() !!}
</div>
      </div>
    </div>

  </div>
</div>
@endif
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
@endsection
@section('addon')
@endsection