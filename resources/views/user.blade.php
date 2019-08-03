<!DOCTYPE html>
<html lang="en">
  <head>
@section('title', 'Pengaturan'))
    @include('partials._head')
    <style>
input[type="file"] {
  opacity:0;
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:30%;
}
    </style>
  </head>
  <body>
    @include('partials._nav')    

    @yield('blurred')
    <div class="container">
<div class="container" id="app">
      @include('partials._messages')  
    <div class="row">
        <div class="col-md-8">
        <div class="panel panel-default">
  <div class="panel-heading">INFORMASI DASAR</div>
  <div class="panel-body">
				{!! Form::model($user,['route' => 'changePassword', 'method' => 'POST']) !!}
        {{ Form::hidden('basic', 'yes') }}
        {{ Form::label('bio', 'Bio') }}
        {{ Form::textarea('bio', null, ['class' => 'form-control','size' => '10x2']) }}
        {{ Form::label('gender', 'Jenis Kelamin') }}
        {{ Form::select('gender', ['Rahasia', 'Pria','Wanita'] ,null ,['class'=> 'form-control']) }}<br>
        {{ Form::submit('Simpan Informasi', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
  </div>
  </div>
        <div class="panel panel-default">
  <div class="panel-heading">PENGATURAN MEMBACA</div>
  <div class="panel-body">

				{!! Form::model($user,['route' => 'changePassword', 'method' => 'POST']) !!}
        {{ Form::label('otomatis', 'Tandai bab telah dibaca otomatis: (?)') }}
        {{ Form::select('otomatis', ['Nonaktif', 'Aktif'] ,null ,['class'=> 'form-control']) }}
        {{ Form::label('opt_size', 'Ukuran Fonts') }}
        {{Form::number('opt_size', null,['class'=> 'form-control','min'=>13,'max'=>36]) }}
        {{ Form::label('opt_font', 'Jenis Fonts') }}
        {{ Form::select('opt_font', ['Arial, Helvetica, sans-serif'=>'Arial','Verdana, Geneva, sans-serif'=>'Verdana','Tahoma, Geneva, sans-serif'=>'Tahoma'] ,null ,['class'=> 'form-control']) }}
        {{ Form::label('opt_color', 'Warna Fonts') }}
        {{ Form::select('opt_color', ['#0000'=>'Hitam', '#4a3a1e'=>'Coklat'] ,null ,['class'=> 'form-control']) }}<br>
					{{ Form::submit('Simpan Pengaturan', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
  </div>
</div>
        </div>
				{!! Form::open(['route' => 'changePassword', 'method' => 'POST','files' => true]) !!}
        <div class="col-md-4">
        <div class="panel panel-default">
  <div class="panel-heading">AVATAR</div>
  <div class="panel-body">
        {{ Form::hidden('avatar', 'yes') }}
        {{ Form::file('userimg', ['class' => 'profile-img-container centered','onchange'=>'loadFile(event)']) }}<center><img id="output" class="" src="{{ ToNovel::imggo('user',0,Auth::user()->userimg) }}" width="100" height="100" style="border-radius:50%"></center><br>
        {{ Form::submit('Ganti Avatar', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
        </div>
  </div>
        <div class="panel panel-default">
				{!! Form::open(['route' => 'changePassword', 'method' => 'POST']) !!}
  <div class="panel-heading">KATA SANDI</div>
  <div class="panel-body">
					{{ Form::label('current_password', 'Password sekarang:') }}
					{{ Form::password('current_password', ['class' => 'form-control']) }}
					{{ Form::label('new_password', 'Password baru:') }}
					{{ Form::password('new_password', ['class' => 'form-control']) }}
					{{ Form::label('re_password', 'Ulang Password baru:') }}
					{{ Form::password('re_password', ['class' => 'form-control']) }}
					<br>
					{{ Form::submit('Ganti Kata Sandi', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
  </div>
</div>
        </div>
    </div>
</div>
</div>
      @include('partials._footer')

      @yield('addon')

        @include('partials._modal')
    </div> <!-- end of .container --> 

        @include('partials._javascript')

        @yield('scripts')
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    if (!event.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    event.target.value = '';
    }else{
    output.src = URL.createObjectURL(event.target.files[0]);
    }
  };
</script>
  </body>
</html>
