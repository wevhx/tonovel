@extends('main')
@section('title', $chapter->novels->title.' / BAB '.$chapter->bab)
@section('stylesheets')
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
<div class="panel">
<div class="panel panel-default">
  <div class="panel-heading">Daftar Perubahan {{$chapter->novels->title}} / BAB {{$chapter->bab}}
  <div class="pull pull-right"><a href="{{Request::url()}}/create" class="btn btn-info btn-xs">Buat Diff Baru</a></div>
  </div>
  <div class="panel-body">
  @if(!$differ->isEmpty())
<table class="table">
    <thead>
      <tr>
        <th width="5%">Ubah</th>
        <th width="5%">#ID</th>
        <th width="20%">Komentar</th>
        <th width="20%">Ubahan</th>
        <th width="20%">Dibuat</th>
        <th width="10%">Ukuran</th>
        <th width="10%">Pengguna</th>
      </tr>
    </thead>
    <tbody>
    {{$differ}}
    @foreach($differ as $diff)
      <tr>
        <td><a href="{{Request::url()}}/create?last={{$diff->id}}" class="btn btn-info btn-xs">Pakai</a></td>
        <td>#{{$diff->id}}</td>
        <td>{{$diff->comment}}</td>
        <td>ID {{$diff->chapter_id}} / REVISI {{$diff->lastdiff}}</td>
        <td>{{$diff->created_at}}</td>
        <td>{{str_word_count(strip_tags($diff->content))}} Kata</td>
        <td><a href="/profile/{{$diff->users->name}}">{{ucfirst($diff->users->name)}}</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
  <div class="centered">
    <p><i class="glyphicon glyphicon-remove gly-4x"></i></p>
    <p><small>Tidak ada data silahkan buat diff</small></p>
</div>
  @endif
  </div>
  </div>
</div>
</div>
</div>
</div>
</div>
@endsection