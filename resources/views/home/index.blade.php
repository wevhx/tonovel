@extends('main')
@section('title',"Database Novel")
@section('blurred')
<script>
document.getElementsByClassName("navbar-fixed-top")[0].className += " transparent";
</script>
<style>
#app {
padding:20px;
}
</style>
    <div id="ch-tp"></div>
        <div id="novel-promotion-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#novel-promotion-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#novel-promotion-carousel" data-slide-to="1"></li>
                <li data-target="#novel-promotion-carousel" data-slide-to="2"></li>
                <li data-target="#novel-promotion-carousel" data-slide-to="3"></li>
                <li data-target="#novel-promotion-carousel" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
            @php $i = 0; @endphp
            @php
            $array = array('rotateInDownRight','slideInDown');
            @endphp
            @foreach($randoms as $random)
            @if($i == 1)
            <div class="item active"> <div class="item-background" style="background: #{{rand(562110,980127)}};background: -webkit-linear-gradient(to right, #{{rand(562110,980127)}}, #{{rand(562110,980127)}});background: linear-gradient(to right, #{{rand(562110,980127)}}, #{{rand(562110,980127)}}); "></div><div class="ef-snow"></div><div class="carousel-caption"> <div class="media"> <div class="media-left media-middle hidden-xs animated {{$array[array_rand($array)]}}"> <a href="{{route('novel.lihat',$random->slug)}}"> <img class="media-object img-rounded" title="{{$random->title}}" src="{{ToNovel::imggo('poster',0,$random->thumb)}}"/> </a> </div><div class="media-body media-middle animated slideInRight"> <h3 class="media-heading"> <a href="{{route('novel.lihat',$random->slug)}}">{{$random->title}}</a> </h3> <blockquote> {!! substr($random->synopsis, 0, 150) !!}{!! strlen($random->synopsis) > 150 ? "..." : "" !!} <footer> {{$random->category->name}}, <cite>{{$random->year}}</cite> </footer> </blockquote> </div></div></div></div>
            @else
            <div class="item"> <div class="item-background" style="background: #{{rand(562110,980127)}};background: -webkit-linear-gradient(to right, #{{rand(562110,980127)}}, #{{rand(562110,980127)}});background: linear-gradient(to right, #{{rand(562110,980127)}}, #{{rand(562110,980127)}}); "></div><div class="ef-snow"></div><div class="carousel-caption"> <div class="media"> <div class="media-left media-middle hidden-xs animated {{$array[array_rand($array)]}}"> <a href="{{route('novel.lihat',$random->slug)}}"> <img class="media-object img-rounded" title="{{$random->title}}" src="{{ToNovel::imggo('poster',0,$random->thumb)}}"/> </a> </div><div class="media-body media-middle animated slideInRight"> <h3 class="media-heading"> <a href="{{route('novel.lihat',$random->slug)}}">{{$random->title}}</a> </h3> <blockquote> {!! substr($random->synopsis, 0, 150) !!}{!! strlen($random->synopsis) > 150 ? "..." : "" !!} <footer> {{$random->category->name}}, <cite>{{$random->year}}</cite> </footer> </blockquote> </div></div></div></div>
            @endif
            @php $i++; @endphp
            @endforeach
            </div> <a class="left carousel-control" href="#novel-promotion-carousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#novel-promotion-carousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> </div>
        
@endsection
@section('content')
<div class="row">
<div class="col-md-8">
<h2 style="font-size: 16px">Rilisan Terbaru <div class="pull pull-right"></div></h2>
<div class="panel">
 @foreach($chapter->groupBy(function($date) {return $date->created_at->format('d, M Y');}) as $key => $value)
<h2 style="font-size: 14px;margin:10px;">{{$key}}</h2>
<table class="table table-striped rilisan" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="60%">Judul</th>
                <th width="10%">Rilisan</th>
                <th width="30%">Group / TL</th>
            </tr>
        </thead>
        <tbody>
 @foreach($value as $chapt)
            <tr>
                <td><a style="font-weight:400" href="{{route('novel.lihat',$chapt->novels->slug)}}">{{$chapt->novels->title}}</a></td>
                <td><a style="font-weight:400" href="{{route('chapter.lihat',$chapt->slug)}}">V{{$chapt->volume}}B{{$chapt->bab}}</a></td>
                <td><a style="font-weight:400" href="{{route('group.group',$chapt->groups->slug)}}">{{$chapt->groups->name}}</a></td>
            </tr>
@endforeach
          </tbody>
          </table>

@endforeach
        <div class="centered">
        {{$chapter->links()}}
        </div>
</div>
<h2 style="font-size: 20px">Novel Terbaru <div class="pull pull-right"></div></h2>
<ul class="tonovellist__tonovels">
  @foreach ($novel as $nov)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.lihat',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($nov->slug)) < 2) ? ToNovel::getscore($nov->slug).'.0': substr(ToNovel::getscore($nov->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$nov->category->name}}</li>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li>  
@endforeach
</div>
<div class="col-md-4">
<div class="panel panel-default">
  <div class="panel-heading">Ranking User</div>
@if(!$user->isEmpty())
<ul class="list-group">
@php $i = 1; @endphp
@foreach($user as $use)
@if($i == 1)
<li class="list-group-item"><span class="status" style="background-color:#e88b2a">#{{$i}}</span><a href="{{route('user.user',$use->name)}}"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$use->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{ucfirst($use->name)}}</h5> <div> <span class="label label-primary">{{$use->total_exp}} Exp</span> <span class="label label-default">Terdaftar {{\Carbon\Carbon::parse($use->created_at)->diffForHumans()}}</span> </div> </div> </div></a> </li>
@elseif($i == 2)
<li class="list-group-item"><span class="status" style="background-color:#6f573d">#{{$i}}</span><a href="{{route('user.user',$use->name)}}"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$use->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{ucfirst($use->name)}}</h5> <div> <span class="label label-primary">{{$use->total_exp}} Exp</span> <span class="label label-default">Terdaftar {{\Carbon\Carbon::parse($use->created_at)->diffForHumans()}}</span> </div> </div> </div></a> </li>
@elseif($i == 3)
<li class="list-group-item"><span class="status" style="background-color:#348221">#{{$i}}</span><a href="{{route('user.user',$use->name)}}"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$use->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{ucfirst($use->name)}}</h5> <div> <span class="label label-primary">{{$use->total_exp}} Exp</span> <span class="label label-default">Terdaftar {{\Carbon\Carbon::parse($use->created_at)->diffForHumans()}}</span> </div> </div> </div></a> </li>
@else
<li class="list-group-item"><span class="status" style="background-color:#98836c">#{{$i}}</span><a href="{{route('user.user',$use->name)}}"><div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$use->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body media-middle"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;">{{ucfirst($use->name)}}</h5> <div> <span class="label label-primary">{{$use->total_exp}} Exp</span> <span class="label label-default">Terdaftar {{\Carbon\Carbon::parse($use->created_at)->diffForHumans()}}</span> </div> </div> </div></a> </li>
@endif
@php $i++; @endphp
@endforeach  
@endif
</div>
<div class="panel panel-default">
  <div class="panel-heading">Komentar Terbaru</div>
  <ul class="list-group">
  @foreach($comments as $comment)
  @if($comment->komentar_loca == 1)
  <li class="list-group-item"> <div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$comment->users->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;"> {{ucfirst($comment->users->name)}}</h5>  <a href="/read/{{{$comment->komentar_object}}}"> <label class="label label-info">Bacaan</label> <span class="label label-primary"> Dikirim {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </span> </a>  </div> </div> </li>
  @elseif($comment->komentar_loca == 2)
  <li class="list-group-item"> <div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$comment->users->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;"> {{ucfirst($comment->users->name)}}</h5>  <a href="/group/{{{$comment->komentar_object}}}"> <label class="label label-info">Group</label> <span class="label label-primary"> Dikirim {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </span> </a>  </div> </div> </li>
  @elseif($comment->komentar_loca == 3)
  <li class="list-group-item"> <div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$comment->users->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;"> {{ucfirst($comment->users->name)}}</h5>  <a href="/people/{{{$comment->komentar_object}}}"> <label class="label label-info">People</label> <span class="label label-primary"> Dikirim {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </span> </a>  </div> </div> </li>
  @elseif($comment->komentar_loca == 4)
  <li class="list-group-item"> <div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$comment->users->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;"> {{ucfirst($comment->users->name)}}</h5>  <a href="/publisher/{{{$comment->komentar_object}}}"> <label class="label label-info">Penerbit</label> <span class="label label-primary"> Dikirim {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </span> </a>  </div> </div> </li>
  @elseif($comment->komentar_loca == 5)
  <li class="list-group-item"> <div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$comment->users->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;"> {{ucfirst($comment->users->name)}}</h5>  <a href="/profile/{{{$comment->komentar_object}}}"> <label class="label label-danger">Profile</label> <span class="label label-primary"> Dikirim {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </span> </a>  </div> </div> </li>
  @elseif($comment->komentar_loca == 6)
  <li class="list-group-item"> <div class="media"> <div class="media-left media-middle"> <img src="{{ToNovel::imggo('user',1,$comment->users->userimg)}}" class="img-rounded" alt="avatar"> </div> <div class="media-body"> <h5 class="media-title" style="margin-bottom: 5px; margin-top: 0;"> {{ucfirst($comment->users->name)}}</h5>  <a href="/news/{{{$comment->komentar_object}}}"> <label class="label label-danger">News</label> <span class="label label-primary"> Dikirim {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </span> </a>  </div> </div> </li>
  @endif
  @endforeach
  </ul>
</div>
</div>

<div class="col-md-12">
<h2 style="font-size: 20px">Random Pick <div class="pull pull-right"></div></h2>
<div class="loop owl-carousel owl-theme">
  @foreach ($randomp as $randppl)
            <div class="item">
            <a href="{{route('author.show',$randppl->ppl_slug)}}"><img src="{{ToNovel::imggo('people',0,$randppl->ppl_thumb)}}" class="come_in noveltips" title="{{$randppl->ppl_name}}"></a>
            </div>
  @endforeach
          </div>
<h2 style="font-size: 20px">Terpopuler <div class="pull pull-right"></div></h2>
<ul class="tonovellist__tonovels">
@php $i = 1; @endphp
  @foreach ($ranks as $rank)
  @php $nov = $rank->novels; @endphp
<li class="tonovellist-item">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.lihat',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i> {!! (strlen(ToNovel::getscore($nov->slug)) < 2) ? ToNovel::getscore($nov->slug).'.0': substr(ToNovel::getscore($nov->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$nov->category->name}}</li>
<h3 class="tonovellist-item__genres">
<span style="font-size: 12px;" class="label label-warning label-md">#{{$i}}</span>
<span style="font-size: 12px;" class="label label-success label-md"><i class="glyphicon glyphicon-bookmark"></i> {{$rank->count}}</span>
</h3>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li> 
@php $i++; @endphp
@endforeach
</ul>
</div>
</div>
</div>

@endsection
@section('javascript')
    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<script>
$(document).ready(function() {
    $('.rilisan').DataTable({
      "bLengthChange": false,
      "bInfo": false,
      "searching": false,
      "paging": false
    });
} );
$('.loop').owlCarousel({
    autoWidth:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
</script>
@endsection
