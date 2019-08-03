@extends('main')
@section('title', "Kontribusi People")
@section('stylesheets')
<style>
.user-profiles-list-small{
    list-style:none;
    text-align: center;
    margin: 0 auto;
    padding: 0;
}

.user-profiles-list-small li{
    display: inline-block;
    box-sizing:border-box;
    position: relative;

    text-align:left;
    font:normal 14px sans-serif;

    background-color:#f4f8fa;
    border:1px solid #dbe3e7;
    box-shadow: 0 2px 3px #dbe3e7;

    width:100%;
}

.user-profiles-list-small .user-avatar{
    float: left;
    padding: 10px 15px;
}

.user-profiles-list-small .user-avatar img{
    border-radius: 50%;
    border:0;
}

.user-profiles-list-small .user-name{
    white-space: nowrap;
    overflow: hidden;
    text-overflow:ellipsis;
    margin:9px 0 0;
}

.user-profiles-list-small .user-name a{
    color:#5d6569;
    text-decoration: none;
    font-weight: bold;
}

.user-profiles-list-small .user-name span{
    display: block;
    font-size: 11px;
    color:#808d93;
    padding-top:4px;
}


</style>
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
<h2 style="font-size: 20px">KONTRIBUSI PEOPLE <div class="pull pull-right"><a href="" class="btn btn-success btn-xs">Reload</a></div></h2>
<div class="btn-group btn-group-justified">
  <a href="/kontribusi/people/create" class="btn btn-info">Tambah People</a>
  <a href="/kontribusi/history" class="btn btn-warning">Ubahan terakhir</a>
  <a href="#" disabled class="btn btn-danger">Hapus People</a>
</div><br>
<ul class="user-profiles-list-small">
@foreach ($peoples as $people)
<li>

            <div class="user-avatar">
                <a href="#">
                    <img src="{{ToNovel::imggo('people',0,$people->ppl_thumb)}}" class="img-circle" height="48" width="48" alt="Profile of {{$people->ppl_name}}">
                </a>
            </div>

            <p class="user-name">
                <a href="{{route('people.edit',$people->ppl_slug)}}">{{$people->ppl_name}}</a>
                <span>{{$people->ppl_bio}}</span>
            </p>

            

        </li>

@endforeach
</ul>
</div>
<div class="centered">{{$peoples->links()}}</div>
</div>
</div>
@endsection
