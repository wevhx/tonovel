@extends('main')
@section('title', "Indeks")
@section('content')
<div class="row">
<div class="col-md-12">
<h2 style="font-size: 20px">DAFTAR NOVEL <div class="pull pull-right"></div></h2>
<div class="panel panel-footer filter-novel">
        {{ Form::open(array('method' => 'get','class'=>'form-inline centered')) }}
        {{ Form::hidden('filter', 'yes') }}
        <div class="form-group">{{ Form::select('genre[]', $genres, null, ['class' => 'selectpicker','title' => 'Semua Genre','data-header' => 'Pilih Genre','multiple data-selected-text-format' => 'count > 3','data-style' => 'btn-default','data-width' => '100%']) }}</div>  
        <div class="form-group">{{ Form::select('category', $category, null, ['class' => 'selectpicker','title' => 'Semua Jenis','data-header' => 'Pilih Jenis','data-style' => 'btn-default','data-width' => '100%']) }}     </div>
        <div class="form-group">{{ Form::select('status', ['Tamat','Berlanjut'], null, ['class' => 'selectpicker','title' => 'Semua Status','data-header' => 'Pilih Status','data-style' => 'btn-default','data-width' => '100%']) }}     </div>
        <div class="form-group">{{ Form::select('country', ['ID'=>'Indonesia','JP'=>'Jepang','CN'=>'Cina','TH'=>'Thailand','MY'=>'Malaysia'], null, ['class' => 'selectpicker','title' => 'Semua Negara','data-header' => 'Pilih Negara','data-style' => 'btn-default','data-width' => '100%']) }}     </div>
        <div class="form-group">{{ Form::selectYear('year', date('Y'), date('Y')-100, null, ['class' => 'selectpicker','title' => 'Semua Tahun','data-header' => 'Pilih Tahun','data-style' => 'btn-default','data-width' => '100%']) }}     </div>
        <div class="form-group">{{ Form::select('sort', ['default'=>'Default','name-asc'=>'Nama A-Z','name-desc'=>'Nama Z-A','newer'=>'Baru ditambahkan','older'=>'Terlama ditambahkan','viewer-asc'=>'Terbanyak Dilihat','viewer-desc'=>'Sedikit Dilihat'], null, ['class' => 'selectpicker','title' => 'Semua Sortir','data-header' => 'Pilih Sortiran','data-style' => 'btn-default','data-width' => '100%']) }} </div>    
        {{ Form::button('<i class="glyphicon glyphicon-filter"></i>',array('class' => 'btn btn-black','type'=>'submit'))}}
        {!! Form::close() !!}
  </div>
      @if(!$novel->isEmpty())
<?php
$i = 0;
$len = $novel->count();
?>
<ul class="tonovellist__tonovels">
  @foreach ($novel as $nov)
  @if($len % 2 == 0)
  @if($i == 0)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.lihat',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
{{--  @if(!$nov->genres->isEmpty())
<h3 class="tonovellist-item__genres">
				@foreach ($nov->genres as $genre)
					<span style="font-size: 12px;" class="label label-default label-md">{{ $genre->name }}</span>
				@endforeach
</h3>
@endif  --}}
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i>{!! (strlen(ToNovel::getscore($nov->slug)) < 2) ? ToNovel::getscore($nov->slug).'.0': substr(ToNovel::getscore($nov->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$nov->category->name}}</li>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li>  
@elseif($i == $len - 1)
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.lihat',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i>{!! (strlen(ToNovel::getscore($nov->slug)) < 2) ? ToNovel::getscore($nov->slug).'.0': substr(ToNovel::getscore($nov->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$nov->category->name}}</li>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li>  
@else
<li class="tonovellist-item">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.lihat',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i>{!! (strlen(ToNovel::getscore($nov->slug)) < 2) ? ToNovel::getscore($nov->slug).'.0': substr(ToNovel::getscore($nov->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$nov->category->name}}</li>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li>  
@endif
@else
<li class="tonovellist-item full-list">
<div class="tonovellist-item__content">
<a href="{{route('novel.lihat',$nov->slug)}}" class="tonovellist-item__image">
<img src="{{ToNovel::imggo('poster',1,$nov->thumb)}}">
</a>
<a href="{{route('novel.lihat',$nov->slug)}}" title="{{$nov->title}}" class="tonovellist-item__main">
<h3 class="tonovellist-item__title">{{$nov->title}}</h3>
<h2 class="tonovellist-item__desc">{{$nov->synopsis}}</h2>
<div class="tonovellist-item__viewer" style="color:black"><i class="glyphicon glyphicon-star gold-d"></i>{!! (strlen(ToNovel::getscore($nov->slug)) < 2) ? ToNovel::getscore($nov->slug).'.0': substr(ToNovel::getscore($nov->slug), 0, 3) !!}</div>
<ul class="tonovellist-item__info">
<li class="item-label status">{{$nov->category->name}}</li>
<li class="item-label score">Total {{@$nov->chapters->count()}} Bab</li>
</ul>
</a>
</div>
</li>  
@endif
<?php $i++?>
@endforeach
</ul>
       @if($novel instanceof \Illuminate\Pagination\LengthAwarePaginator )
       <div style="text-align:center">
       {{ $novel->appends(['filter' => Request::get('filter'),'genre' => Request::get('genre'),'season' => Request::get('season'),'type' => Request::get('type'),'status' => Request::get('status'),'year' => Request::get('year')])->links() }}
       </div>
        @endif
@else
    <div class="content shadow text-center">
<div class="alert alert-danger"><i class="glyphicon glyphicon-remove gly-4x"></i><br><br>Tidak ditemukan<br><small>Please change your filters or try a different search term.</small></div></div>
 @endif
</div></div></div>
@endsection