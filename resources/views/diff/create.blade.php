@extends('main')
@section('title', $chapter->novels->title.' / BAB '.$chapter->bab)
@section('stylesheets')
<style>

div>#content {
    width: 100%;
    padding: 10px;
    transition: all 0.3s;
    position: relative;
    top: 0px;
    right: 0;
}
</style>
<link rel="stylesheet" href="{{asset('vendor/trumbowyg/ui/trumbowyg.min.css')}}" />
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
<div class="alert alert-info">Baca peraturan dan tata cara penulisan yang baik dan benar disini</div>
<div class="panel">
<div class="panel panel-heading">Diff {{$chapter->novels->title.' / BAB '.$chapter->bab}}</div>
<div class="panel panel-body">
    {!! Form::model($differ,['route' => ['diff.store',$chapter->slug], 'method' => 'POST']) !!}
        {{ Form::hidden('diff', 'yes') }}
        {{ Form::hidden('lastdiff', @$differ->id) }}
        {{ Form::label('content', 'Konten') }}
        {{ Form::textarea('content', null, ['placeholder'=>'Masukkan konten','class' => 'form-control','size' => '10x12']) }}
        {{ Form::label('comment', 'Komentar (opsional)') }}
        {{ Form::input('comment', 'comment', null, ['placeholder'=>'Masukkan alasan perubahan','class' => 'form-control input-sm']) }}<br>
        {{ Form::submit('Simpan Perubahan', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}	
				{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
@section('javascript')
<script src="{{asset('vendor/trumbowyg/trumbowyg.min.js')}}"></script>
<script src="{{asset('vendor/trumbowyg/langs/id.min.js')}}"></script>
<script>
$('#content').trumbowyg({
  lang: 'id'
});
</script>
@endsection