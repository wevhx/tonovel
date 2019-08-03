@extends('main')
@section('title', ucfirst($user->name))
@section('stylesheets')
<style>
#app{
padding:10px;
}
</style>
@endsection
@section('blurred')
<script>
document.getElementsByClassName("navbar-fixed-top")[0].className += " transparent";
</script>
<div id="ch-tp"></div>
<div class="user-header" @if(!empty($user->banner)) style='background: url("/uploads/user/banner/{{$user->banner}}") center center / cover no-repeat rgb(255, 255, 255);' @endif data-user="{{$user->id}}">
        <div class="user-header-wrapper">
            <div class="header-avatar">
                <a href="{{route('user.user',$user->name)}}"><img class="header-avatar-img" src="{{ToNovel::imggo('user',0,$user->userimg)}}" alt="{{$user->name}}"></a>
                <a class="header-avatar-vip icon icon-cv" href="" target="_blank"></a>
            </div>
            <div class="header-msg">
                <h3 id="EgoUserWrap" data-id="{{$user->id}}"><a href="{{route('user.user',$user->name)}}">{{ucfirst($user->name)}}</a><a class="header-msg-level" href="" target="_blank">Lv{{ToNovel::exp($user->total_exp)['level']}}</a></h3>
                <div class="header-msg-desc">Bergabung {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</div>
                
                <div class="header-msg-title">【{{ToNovel::exp($user->total_exp)['rank']}}】</div>
                
                <div class="header-msg-data">
                    <span class="mr8">Point :<strong class="header-msg-strong">{{$user->total_exp}}</strong></span><span class="ml12 mr8">Ulasan :<strong class="header-msg-strong">{{$user->reviews->count()}}</strong></span>
                </div>
            </div>
        </div>
    </div>
            </div>

@endsection
@section('content')
<div class="row">
        <div class="prof-stat col-sm-4 col-sm-push-8 panel">
@php
$app = ToNovel::GetStat($user->name);
@endphp
@if(!empty($app))
<div id="chart-legend"></div>
<canvas class="m-t p-a-xs" id="radar-novel" width="180"></canvas>
<canvas class="p-r m-t-0" id="novel-chart-bar" width="180"></canvas>
<div id="chart-data-light-novel" data-chart='{{$app['rlight']}}'></div>
<div id="chart-data-web-novel" data-chart='{{$app['rweb']}}'></div>
<div id="chart-data-other-novel" data-chart='{{$app['rother']}}'></div>
<div id="chart-bar-lightnovel" data-chart='{{$app['light']}}'></div>
<div id="chart-bar-webnovel" data-chart='{{$app['web']}}'></div>
<div id="chart-bar-othernovel" data-chart='{{$app['other']}}'></div>
@endif
        </div>
        <div class="col-sm-8 col-sm-pull-4">
        <div class="panel panel-body">
        <ul class="nav nav-tabs">
  <li class="{{($type == 'beranda') ? 'active': ''}}"><a href="{{route('user.user',['slug'=>$user->name])}}">Beranda</a></li>
  <li class="{{($type == 'bacaan') ? 'active': ''}}"><a href="{{route('user.cat',['slug'=>$user->name,'cat'=>'bacaan'])}}">Daftar Bacaan</a></li>
  <li class="{{($type == 'aktifitas') ? 'active': ''}}"><a href="{{route('user.cat',['slug'=>$user->name,'cat'=>'aktifitas'])}}">Aktifitas</a></li>
  <li class="{{($type == 'ulasan') ? 'active': ''}}"><a href="{{route('user.cat',['slug'=>$user->name,'cat'=>'ulasan'])}}">Ulasan</a></li>
  <li class="{{($type == 'rekomendasi') ? 'active': ''}}"><a href="{{route('user.cat',['slug'=>$user->name,'cat'=>'rekomendasi'])}}">Rekomendasi</a></li>
</ul>
        <div class="row">
@if($type == 'rekomendasi')
<div class="well well-sm centered kosong"></div>
@elseif($type == 'beranda')
        <div class="col-md-12"><br>
        <div class="panel panel-body">
        {{$user->bio}}
        </div>
        </div>
@elseif($type == 'bacaan')
        <div class="col-md-12"><br>
      @if(!$user->library->isEmpty())
<div class="panel">
<div class="list-group" id="library">
<div class="side">
<ul>
  @foreach ($user->library as $lib)
@php
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
}else{

}
@endphp
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
<div class="well red">
<center><i class="glyphicon glyphicon-remove-circle gly-4x"></i><br><b>Sepertinya pengguna ini belum menambahkan daftar baca</b></center>
                </div>
</div>
</div>
    @endif
</div>
    @elseif($type == 'ulasan')<br>
    @if(!$user->reviews->isEmpty())
<?php $link = $user->reviews()->orderBy('updated_at','DESC')->paginate(4); ?>
@foreach($link as $review)
@php
$library = DB::table('libraries')->where('novel_id', $review->novel_id)->where('user_id', $review->user->id)->first();
$nilai = @$library->score;
if(empty($nilai)) $nilai = 0;
$userid = '';
@endphp
<div class="comment-wrap" id="comment-wrap" data-comment="{{$review->id}}" data-username="{{$review->user->name}}">
<div class="photo">
<div class="avatar-review" style="background-image: url({{ToNovel::imggo('user',2,$review->user->userimg)}})"></div></div>
<div class="comment-block"><div class="comment-user"><a href="{{route('user.user',$review->user->name)}}">{{$review->user->name}}</a> <span class="_tonovr" aria-label="Diberi nilai {{$nilai}}"><span style="width: {{$nilai*13}}px;"></span></span><small class="pull-right"><a href="{{route('novel.lihat',$review->novels->slug)}}">{{$review->novels->title}}</a></small></div><p class="comment-text read-more-wrap">{{$review->content}}</p><div class="bottom-comment"><div class="comment-date">{{\Carbon\Carbon::parse($review->created_at)->diffForHumans()}}</div><ul class="comment-actions"><li class="reply">{!!$userid!!}</li><li class="complain" onclick="reportr({{$review->id}})"><i class="glyphicon glyphicon-flag"></i></li></ul></div><div class="comment-reply-5" id="comment-reply-5"><br></div></div> </div>
@endforeach
<div class="centered">
{{$link->links()}}
</div>
@else
<div class="well well-sm centered">Pengguna ini belum pernah mengulas novel</div>
@endif
    @elseif($type == 'aktifitas')
    @if(!$user->activity->isEmpty())
    <div class="panel">
    <div class="list-group">
    @foreach($user->activity as $activity)
    @if($activity->type == 1)
  @php $ob = Tonovel::minfo(0,$activity->object);@endphp
  <a href="#" class="list-group-item">Melihat Novel {{$ob['title']}}
  <div class="badge-level miniled-top">{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</div>
  </a>
  @elseif($activity->type == 2)
  @php $ob = Tonovel::minfo(1,$activity->object);@endphp
  <a href="#" class="list-group-item">Membaca Novel {{$ob['title']}}
  <div class="badge-level miniled-top">{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</div>
  </a>
  @elseif($activity->type == 3)
  @php $ob = Tonovel::minfo(2,$activity->object);@endphp
  <a href="#" class="list-group-item">Melihat Portofolio {{$ob['ppl_name']}}
  <div class="badge-level miniled-top">{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</div>
  </a>
  @endif
    @endforeach
</div>
</div>
@else
<div class="well well-sm centered kosong"></div>
@endif
        @endif
        
        </div>
        </div>
        <div class="panel"><div class="panel panel-heading">Komentar</div><iframe id="comment-box" frameborder="0" onload="autoResize()" scrolling="no" width="100%" src="{{route('comment').'?type=5&object='.$user->name}}"></iframe></div>
</div>
  </div>
  </div>
  </div>
  </div>
@endsection

@section('javascript')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script>
<script>
function autoResize(){
    $('#comment-box').height($('#comment-box').contents().height());
}
 if($("#radar-novel").length) {
                    var data = {
                            labels: ["Saat ini dibaca", "Selesai", "Akan dibaca", "Ditahan", "Dibuang", "Rahasia"],
                            datasets: [{
                                label: "Light Novel",
                                fillColor: "rgba(108, 199, 136, 0.2)",
                                strokeColor: "#6cc788",
                                pointColor: "#6cc788",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "#6cc788",
                                data: $("#chart-data-light-novel").data("chart")
                            },{
                                label: "Web Novel",
                                fillColor: "rgba(199, 188, 108, 0.2)",
                                strokeColor: "#c7c06c",
                                pointColor: "#c7c06c",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "#c7c06c",
                                data: $("#chart-data-web-novel").data("chart")
                            }, {
                                label: "Other Novel",
                                fillColor: "rgba(2, 117, 216, 0.2)",
                                strokeColor: "#0275D8",
                                pointColor: "#0275D8",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "#0275D8",
                                data: $("#chart-data-other-novel").data("chart")
                            }]
                        },
                        radarChart = new Chart(document.getElementById("radar-novel").getContext("2d")).Radar(data, {
                            legendTemplate: '<ul class="radar-legend">\n                <% for (var i=0; i<datasets.length; i++) { %>\n                  \t<li>\n                  \t<span style="background-color:<%=datasets[i].fillColor%>;border-color:<%=datasets[i].strokeColor%>;"></span>\n                  \t<% if (datasets[i].label) { %><%= datasets[i].label %><% } %>\n                \t</li>\n                <% } %>\n            </ul>',
                            responsive: !0,
                            animationSteps: 1,
                            multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>%"
                        }),
                        legend = radarChart.generateLegend();
                    $("#chart-legend").html(legend);
                    var data = {
                        labels: ["Saat ini dibaca", "Telah selesai", "Akan dibaca", "Ditahan", "Dibuang"],
                        datasets: [{
                            label: "Light Novel",
                            fillColor: "rgba(108, 199, 136, 0.2)",
                            strokeColor: "#6cc788",
                            pointColor: "#6cc788",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "#6cc788",
                            data: $("#chart-bar-lightnovel").data("chart")
                        }, {
                            label: "Web Novel",
                            fillColor: "rgba(199, 188, 108, 0.2)",
                            strokeColor: "#c7c06c",
                            pointColor: "#c7c06c",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "#c7c06c",
                            data: $("#chart-bar-webnovel").data("chart")
                        }, {
                            label: "Novel lainnya",
                            fillColor: "rgba(2, 117, 216, 0.2)",
                            strokeColor: "#0275D8",
                            pointColor: "#0275D8",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "#0275D8",
                            data: $("#chart-bar-othernovel").data("chart")
                        }]
                    };
                    new Chart(document.getElementById("novel-chart-bar").getContext("2d")).Bar(data, {
                        multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>",
                        responsive: !0
                    })
    }
</script>
@endsection