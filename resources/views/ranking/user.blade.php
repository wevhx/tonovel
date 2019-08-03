@extends('main')
@section('title', "Ranking Pengguna")
@section('content')
<div class="row">
<div class="col-md-12">
<h2 style="font-size: 20px">Ranking Pengguna <div class="pull pull-right"></div></h2>
<div class="row">
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
</ul>
@else
<div class="well well-sm centered">Belum ada ranking pengguna</div>
@endif
      @if($user instanceof \Illuminate\Pagination\LengthAwarePaginator )
       <div style="text-align:center">
          {{ $user->links() }}
       </div>
        @endif
</div>
</div>
</div>
</div>
@endsection