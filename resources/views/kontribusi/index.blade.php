@extends('main')
@section('title', "Indeks Kontribusi")
@section('content')
<div class="row">
<h2 style="font-size: 20px">INDEKS KONTRIBUSI <div class="pull pull-right"><a href="" class="btn btn-success btn-xs">Reload</a></div></h2>
<div class="btn-group btn-group-justified">
  <a href="/kontribusi/novel" class="btn btn-red">Novel Series</a>
  <a href="/kontribusi/people" class="btn btn-info">People DB</a>
</div><br>
<div class="col-md-12">
<div class="list-group">
@foreach($kontens as $konten)
@if($konten->changed == 'nnovel')
  <a href="{{route('previewkontrib',base64_encode($konten->id))}}" class="list-group-item">
  <div class="status">{{\Carbon\Carbon::parse($konten->created_at)->diffForHumans()}}</div>  
    <h4 class="list-group-item-heading">Permintaan Pembuatan Novel Baru</h4>
    <p class="list-group-item-text">User ID #{{$konten->user_id}} Meminta membuat novelbaru dengan request ID : {{md5($konten->id)}}</p>
  <label class="label label-success">3 orang menerima ini</label>
  <label class="label label-danger">3 orang menolak ini</label>
  </a>
@elseif($konten->changed == 'snovel')
  <a href="{{route('previewkontrib',base64_encode($konten->id))}}" class="list-group-item">
  <div class="status">{{\Carbon\Carbon::parse($konten->created_at)->diffForHumans()}}</div>
    <h4 class="list-group-item-heading">Permintaan Mengubah Novel</h4>
    <p class="list-group-item-text">User ID #{{$konten->user_id}} Meminta mengubah novel dengan request ID : {{md5($konten->id)}}</p>
  <label class="label label-success">3 orang menerima ini</label>
  <label class="label label-danger">3 orang menolak ini</label>
  </a>
@elseif($konten->changed == 'npeople')
  <a href="{{route('previewkontrib',base64_encode($konten->id))}}" class="list-group-item">
  <div class="status">{{\Carbon\Carbon::parse($konten->created_at)->diffForHumans()}}</div>  
    <h4 class="list-group-item-heading">Permintaan Pembuatan People Baru</h4>
    <p class="list-group-item-text">User ID #{{$konten->user_id}} Meminta membuat people dengan request ID : {{md5($konten->id)}}</p>
  <label class="label label-success">3 orang menerima ini</label>
  <label class="label label-danger">3 orang menolak ini</label>
  </a>
@elseif($konten->changed == 'upeople')
  <a href="{{route('previewkontrib',base64_encode($konten->id))}}" class="list-group-item">
  <div class="status">{{\Carbon\Carbon::parse($konten->created_at)->diffForHumans()}}</div>
    <h4 class="list-group-item-heading">Permintaan Mengubah People</h4>
    <p class="list-group-item-text">User ID #{{$konten->user_id}} Meminta mengubah people dengan request ID : {{md5($konten->id)}}</p>
    
  <label class="label label-success">3 orang menerima ini</label>
  <label class="label label-danger">3 orang menolak ini</label>
  </a>
@endif
@endforeach
</div>
</div>
</div>
</div>
@endsection