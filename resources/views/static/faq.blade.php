@extends('main')

@section('title', 'FAQ')
<?php
$rteks = array('Malu bertanya sesat dikomentar','Terlalu banyak bertanya tersleding kepala','Tanyakan pada rumput bergoyang','Hati hati bertanya di komentar','Tidak bertanya ? tidak apa apa','Sudahkah kalian bertanya ke madoka-sama','Silahkan bertanya tanpa dibalas disini');
$rando = array_rand($rteks,7);
$random = $rteks[$rando[rand(0,2)]];
?>
@section('content')

	<div class="row">
		<div class="col-md-12">
      <h3 class="judul"><b>F.A.Q</b> <div class="pull pull-right"><a href="" class="btn btn-black btn-md"><i class="fa fa-question-circle"></i> Tanyakan Pertanyaanmu</a></div><br>
      <small>Pusat Bantuan dan pertanyaan</h3></small><hr>
      <div class="ani-ani"></div>
<div class="panel panel-default">
  <div class="panel-heading" style="font-weight:700">Apa itu Tonovel? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Tonovel adalah proyek yang terinspirasi dari bakatsuki, dimana para penerjemah dapat berinteraksi membuat terjemahan dan membagikan kontennya ke publik. proyek ini 100% bebas iklan dan di danai oleh para sesepuh dalam dunia TL 
  </div>
  <div class="panel-heading" style="font-weight:700">Kenapa harus daftar? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Kamu harus mendaftar untuk menikmati fitur didalamnnya seperti komentar , perpustakaan , group manajer dan sebagiannya
  </div>
  <div class="panel-heading" style="font-weight:700">Kenapa saya melihat harus mematikan pemblokir iklan? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Situs ini tidak memiliki iklan dari administrator tetapi para group dapat memasang iklan mereka.
    </div>
  <div class="panel-heading" style="font-weight:700">Bagaimana cara membuat group? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Kamu dapat membuat group atau masuk ke group dengan kode undangan klik tautan <a href="">disini</a>
    </div>
  <div class="panel-heading" style="font-weight:700">Apa itu Diff? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Diff adalah sebutan revisi untuk mengubah konten dari bab kamu 
    </div>
  <div class="panel-heading" style="font-weight:700">Apa itu kontribusi? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Kontribusi layaknya wikipedia dimana kamu dapat mengubah isi data dari konten yang ingin kamu ubah
    </div>
  <div class="panel-heading" style="font-weight:700">Apa itu fitur Follow? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Follow berguna untuk memberikan kamu notifikasi update dan mendukung fitur ranking kami
    </div>
  <div class="panel-heading" style="font-weight:700">Kenapa saat saya mencoba memasukkan konten ditangguhkan? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Biasa ini terjadi jika jenis akun kamu diubah oleh administrator terkait penyimpangan 
    </div>
  <div class="panel-heading" style="font-weight:700">Apakah disini membuka lowongan staff? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Tentu saja hubungi email kami dibawah
    </div>
  <div class="panel-heading" style="font-weight:700">Apa itu Feed? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Feed ialah fitur untuk mengambil konten dari website kamu secara otomatis untuk ditampilkan di menu utama group
    </div>
  <div class="panel-heading" style="font-weight:700">Apa itu otomatis grabber? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Sebenarnya fitur ini berguna untuk mengambil konten dari web kamu untuk dijadiin diff utama tetapi kamu dapat mematikan nya 
    </div>
  <div class="panel-heading" style="font-weight:700">Dimana link forum nya ? <label class="btn btn-danger btn-xs" style="float:right">Wajib diketahui</label></div>
  <div class="panel-body">
    Forum saat ini tidak ada silahkan masuk group facebook untuk info selanjutnya.
    </div>
  <div class="panel-heading" style="font-weight:700">Saya menemukan celah keamanan apa yang saya harus lakukan? <label class="btn btn-green btn-xs" style="float:right">Ethical Atitudue</label></div>
  <div class="panel-body">
  Untuk permasalahan bug dan kerentanan keamanan , kamu dapat melaporkannya ke email kami qya@vivaldi.net
  </div>
</div>
<div class="panel panel-info blue">
<div class="panel panel-heading">Masih Bingung ?<br><small>{{ $random }}</small></div>
<div class="panel panel-body">
  <iframe id="comment-box" frameborder="0" onload="autoResize()" scrolling="no" width="100%" src="{{route('comment').'?type=6&object=1'}}"></iframe>
</div>

		</div>
	</div>
</div>
</div>
@endsection