@extends('main')
@section('title', "Group Terjemahan")
@section('stylesheets')
<style>
#app{
    padding : 5px;
}
header.to__nov {
    margin-bottom: 10px;
    background: no-repeat center center;
    background-color: #868e96;
    background-attachment: scroll;
    position: relative;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover
}

header.to__nov .overlay {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: #212529;
    opacity: .5
}

header.to__nov .page-heading,header.to__nov .post-heading,header.to__nov .site-heading {
    padding: 80px 0 150px;
    color: #fff
}

@media only screen and (min-width: 768px) {
    header.to__nov .page-heading,header.to__nov .post-heading,header.to__nov .site-heading {
        padding:80px 0
    }
}

header.to__nov .page-heading,header.to__nov .site-heading {
    text-align: center
}

header.to__nov .page-heading h1,header.to__nov .site-heading h1 {
    font-size: 50px;
    margin-top: 0
}

header.to__nov .page-heading .subheading,header.to__nov .site-heading .subheading {
    font-size: 24px;
    font-weight: 300;
    line-height: 1.1;
    display: block;
    margin: 10px 0 0;
    font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif
}

header.to__nov .post-heading .meta,header.to__nov .post-heading .subheading {
    line-height: 1.1;
    display: block
}

header.to__nov .post-heading .subheading {
    font-size: 24px;
    font-weight: 600;
    margin: 10px 0 30px;
    font-family: 'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif
}
</style>
@endsection
@section('blurred')
<script>
document.getElementsByClassName("navbar-fixed-top")[0].className += " transparent";
</script>
<div id="ch-tp"></div>
<header class="to__nov" style="background-image: url('img/nogp.png')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 mx-auto">
            <div class="site-heading">
              <h1>Group Terjemahan</h1>
              <span class="subheading">Satu tempat untuk semuanya</span>
<a href="#" data-toggle="modal" data-target="#createModal" class="btn btn-danger" style="margin:5px">Buat Group</a>
            </div>
          </div>
        </div>
      </div>
    </header>
@endsection
@section('content')
<div class="row">
<div class="col-md-8 col-md-offset-2 centered">
<div class="panel panel-default">
  <div class="panel-heading">Kenapa adanya Group ?</div>
  <div class="panel-body">
    Group adalah tempat dimana pembaca dan penerjemah dapat berinteraksi dalam membahas proyek dan melanjutkan langkah penerjemahan
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Memiliki kode undangan ?</div>
  <div class="panel-body">
  @if(isset(Auth::user()->id))
    {!! Form::model(null,['route' => 'groupindex', 'method' => 'POST']) !!}
    {{ Form::hidden('join', 'yes') }}
    {{ Form::label('code', 'Kode Undangan') }}
        {{ Form::input('code', 'code', null, ['class' => 'form-control']) }}<br>
        {{ Form::submit('Kirim', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
		{!! Form::close() !!}
  @else
  <pre>Login untuk melihat form ini</pre>
  @endif
</div>
</div>
</div>
</div>
<div id="createModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buat Group baru</h4>
      </div>
      <div class="modal-body">
  @if(isset(Auth::user()->id))
    {!! Form::model(null,['route' => 'groupindex', 'method' => 'POST']) !!}
    {{ Form::hidden('create', 'yes') }}
    {{ Form::label('name', 'Nama Group') }}
        {{ Form::input('name', 'name', null, ['class' => 'form-control']) }}
    {{ Form::label('description', 'Deskripsi Group') }}
    {{ Form::textarea('description', null, ['placeholder'=>'Seperti apa group ini ?','class' => 'form-control','size' => '10x2']) }}<br>
    <pre class="centered">Dengan mengklik tombol membuat kamu setuju semua persyaratan dari kami</pre><br>
    {{ Form::submit('Buat Group', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
		{!! Form::close() !!}
  @else
  <pre>Login untuk melihat form ini</pre>
  @endif
      </div>
    </div>

  </div>
</div>
</div>
@endsection