@extends('main')
@section('title', $people->ppl_name)
@section('stylesheets')
<style>
#app{
padding:20px;
}
</style>
@endsection
@section('blurred')

<div class="people-header" data-people="{{$people->id}}">
        <div class="people-header-wrapper">
            <div class="header-avatar">
                <a href="{{route('author.show',$people->ppl_slug)}}"><img class="header-avatar-img" src="{{ToNovel::imggo('people',0,$people->ppl_thumb)}}" alt="{{$people->ppl_name}}"></a>
                <a class="header-avatar-vip icon icon-cv" href="" target="_blank"></a>
            </div>
            <div class="header-msg">
                <h3 id="EgoPplWrap" data-id="{{$people->id}}"><a href="{{route('author.show',$people->ppl_slug)}}">{{ucfirst($people->ppl_name)}}</a></h3>
                <div class="header-msg-desc">{{$people->ppl_bio}}</div>
                <div class="header-msg-data">
                    <div class="pull pull-right pull-inmobile">
                  @guest
                  <a href="{{url('login')}}" class="btn btn-info">Follow</a>
                  @else
                  {!! Form::open(array('url'=>route('Followor',$people->ppl_slug))) !!}
                  @php $follow = $people->users()->where('people_id',$people->id)->where('user_id',Auth::user()->id)->get(); @endphp
                  @if($follow->isEmpty())
                  {{ Form::submit('Follow', ['style'=>'margin:5px','class' => 'btn btn-info']) }}
                  @else
                  {{ Form::submit('Unfollow', ['style'=>'margin:5px','class' => 'btn btn-info']) }}
                  @endif
                  {!! Form::close() !!}
                  @endguest
                    </div>
                </div>
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
    <span class="aniled">{{$people->users->count()}}</span>
    <span style="left: right;text-align: right;font-size: .84em;">Pengikut</span>
  </li>
  <li class="fist-group-item">
    <span class="aniled">{{$people->novels->count()}}</span>
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
        <h2 style="font-size: 20px">Pengikut : <small>({{$people->users->count()}})</small></h2>
        <div class="panel panel-body">
        @if($people->users->count() != 0)
        @php $i = 0; @endphp
        @foreach($people->users as $user)
        <a href="{{route('user.user',$user->name)}}"><img src="{{ToNovel::imggo('user',2,$user->userimg)}}" class="w-40 avatar" title="{{$user->name}}"></a>
        @if($i == 10)
        <span>++banyak</span>
        @elseif ($i ==11) @break; @endif
        @php $i++; @endphp
        @endforeach
        @else
        <center>Jadilah yang pertama mengikutinya</center>
        @endif
        </div>
        </div>
        </div>
        </div>
        <div class="col-sm-9 col-sm-pull-3">
        <div class="row">
        <div class="col-md-12">
        <h2 style="font-size: 20px">Daftar Karya :</h2>
  @if(!$people->novels->isEmpty())
<ul class="tonovellist__tonovels">
  @foreach($people->novels as $novel)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$novel->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$novel->thumb)}}">
</a>
<a href="{{route('novel.lihat',$novel->slug)}}" title="{{$novel->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$novel->title}}</h3>
<h2 class="tonovellist-item__desc">{{$novel->synopsis}}</h2>
@if(!$novel->genres->isEmpty())
<h3 class="tonovellist-item__genres">
				@foreach ($novel->genres as $genre)
					<span style="font-size: 12px;" class="label label-default label-md">{{ $genre->name }}</span>
				@endforeach
</h3>
@endif
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
<div class="alert alert-danger"><i class="glyphicon glyphicon-remove gly-4x"></i><br><br>Tidak ditemukan<br><small>Jika ada silahkan tambahkan karya nya di tab kontribusi.</small></div></div>
  @endif
        </div>
        </div>
                <div class="panel"><div class="panel panel-heading">Komentar</div><iframe id="comment-box" frameborder="0" onload="autoResize()" scrolling="no" width="100%" src="{{route('comment').'?type=3&object='.$people->ppl_slug}}"></iframe></div>
        </div>
  </div>
  </div>
@endsection