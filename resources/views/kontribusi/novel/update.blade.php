@extends('main')
@section('title', "Kontribusi Novel")
@section('stylesheets')
<style>
input[type="file"] {
  opacity:0;
  position:absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
}
    </style>
@endsection
@section('content')
<div class="row">
<div class="alert alert-info centered">Baca kebijakan kami agar kamu paham penggunaanya</div>
{!! Form::model($novel, ['route' => ['novel.update', $novel->id], 'method' => 'PUT','files' => true]) !!}
<div class="col-md-3">
<div class="panel panel-default">
<h4 class="centered">Upload Poster</h4>
      <div class="cover-panel">
      {{ Form::file('thumb', ['class' => 'profile-img-container centered','onchange'=>'loadFile(event)']) }}
  <img src="{{ToNovel::imggo('poster',0,$novel->thumb)}}" id="output" class="cover-img output">
  </div>
  
</div>
</div>
<div class="col-md-9">
<div class="panel panel-default">
<div class="panel panel-heading">
<h4>Form Modifikasi series</h4>
</div>
<div class="panel panel-body">
				{{ Form::label('title', 'Judul:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
				{{ Form::label('alt_title', 'Judul Lain:') }}
				{{ Form::text('alt_title', null, array('class' => 'form-control input-sm', 'placeholder' => 'Pisahkan dengan koma ex: example title,example title','required' => '', 'maxlength' => '255')) }}
				{{ Form::label('slug', 'Slug:') }}
                {{ Form::text('slug', null, array('class' => 'form-control input-sm', 'placeholder' => 'Karakter yg diperbolehkan adalah : abcABC123-','required' => '', 'maxlength' => '255')) }}
                {{ Form::label('type', 'Jenis Novel:') }}                
                {{ Form::select('type', $categories, null, ['class' => 'selectpicker','title' => 'Pilih Jenis Novel','data-header' => 'Pilih Jenis Novel','data-style' => 'btn-default','data-width' => '100%']) }}
                {{ Form::label('author', 'Penulis:') }} <a href="/kontribusi/people/create"><small>Buat People</small></a>
                {{ Form::select('author[]', $author, null, ['id' =>'author','class' => 'selectpicker','title' => 'Pilih Penulis','data-live-search'=>'true','data-header' => 'Pilih Penulis','data-style' => 'btn-default','data-width' => '100%']) }}
				{{ Form::label('artist', 'Ilustrator:') }} <a href="/kontribusi/people/create"><small>Buat People</small></a>
                {{ Form::select('artist[]', $artist, null, ['id' =>'artist','class' => 'selectpicker','title' => 'Pilih Ilustrator','data-live-search'=>'true','data-header' => 'Pilih Ilustrator','data-style' => 'btn-default','data-width' => '100%']) }}
				{{ Form::label('genre', 'Genre:') }}
                {{ Form::select('genre[]', $genres, null, ['id' =>'genre','class' => 'selectpicker','title' => 'Pilih Genre','data-live-search'=>'true','data-header' => 'Pilih Genre','multiple data-selected-text-format' => 'count > 10','data-style' => 'btn-default','data-width' => '100%']) }}
                {{ Form::label('licensed', "Lisensi:") }}
                {{ Form::select('licensed', ['Sudah ada','Belum ada'], null, ['class' => 'selectpicker','data-header' => 'Pilih Status Lisensi','data-style' => 'btn-default','data-width' => '100%']) }}
                {{ Form::label('country', "Negara:") }}
                {{ Form::select('country', ['ID'=>'Indonesia','JP'=>'Jepang','MY'=>'Malaysia','CN'=>'China','VN'=>'Vietnam','TH'=>'Thailand','KR'=>'Korea'], null, ['class' => 'selectpicker','data-header' => 'Pilih Negara','data-style' => 'btn-default','data-width' => '100%']) }}
				{{ Form::label('publisher', 'Penerbit [EN]:') }} <a href="/kontribusi/publisher/create"><small>Buat Publisher</small></a>
                {{ Form::select('enpub', $enpub, null, ['class' => 'selectpicker','title' => 'Pilih Penerbit EN','data-live-search'=>'true','data-header' => 'Pilih Penerbit EN','data-style' => 'btn-default','data-width' => '100%']) }}
				{{ Form::label('publisher', 'Penerbit [ID]:') }} <a href="/kontribusi/publisher/create"><small>Buat Publisher</small></a>
                {{ Form::select('idpub', $idpub, null, ['class' => 'selectpicker','title' => 'Pilih Penerbit ID','data-live-search'=>'true','data-header' => 'Pilih Penerbit ID','data-style' => 'btn-default','data-width' => '100%']) }}
				{{ Form::label('synopsis', 'Sinopsis:') }}                
				{{ Form::textarea('synopsis', null, array('class' => 'form-control', 'required' => '')) }}
                {{ Form::label('year', 'Tahun:') }}
                {{ Form::selectYear('year', date('Y'), date('Y')-10, null, ['class' => 'selectpicker','title' => 'Pilih Tahun','data-header' => 'Pilih Tahun','data-style' => 'btn-default','data-width' => '100%']) }}				
                {{ Form::label('status', 'Status:') }}                
                {{ Form::select('status', [0=>'Tamat',1=>'Masih Berlanjut'], null, ['class' => 'selectpicker','title' => 'Pilih Status','data-header' => 'Pilih Status','data-style' => 'btn-default','data-width' => '100%']) }}
                <hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('novel.index', 'Batalkan', null, array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Kirim Perubahan', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
		{!! Form::close() !!}
</div>
</div>
</div>
</div>
</div>
@endsection
@section('javascript')

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    if (!event.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    event.target.value = '';
    }else{
    output.src = URL.createObjectURL(event.target.files[0]);
    }
  };
  
$('#genre').selectpicker('val', {!! json_encode($novel->genres()->pluck('genre_id')->toArray()) !!});
$('#artist').selectpicker('val', {!! json_encode($novel->peoples()->where('type','=',2)->pluck('people_id')->toArray()) !!});
$('#author').selectpicker('val', {!! json_encode($novel->peoples()->where('type','=',1)->pluck('people_id')->toArray()) !!});
</script>
@endsection
