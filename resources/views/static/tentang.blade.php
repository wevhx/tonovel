@extends('main')
@section('title', "Tentang kami")
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
.list {
    padding-left: 0;
    border-radius: 3px;
}
.list-item {
    display: block;
    position: relative;
    padding: 12px 16px;
}
</style>
@endsection
@section('blurred')
<script>
document.getElementsByClassName("navbar-fixed-top")[0].className += " transparent";
</script>
<div id="ch-tp"></div>
<header class="to__nov" style="background-image: url('/img/tentang.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 mx-auto">
            <div class="site-heading">
              <h1>Tentang Kami</h1>
              <span class="subheading">Membaca adalah sumber ilmu</span>
            </div>
          </div>
        </div>
      </div>
    </header>
@endsection
@section('content')
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<ul class="list">
<li class="list-item">
<h6><a class="about text-primary">Tujuan Kami:</a></h6>
<div>
Tujuan ToNovel.co adalah untuk menyediakan tempat bagi penggemar Novel sebuah situs di mana mereka dapat membuat daftar bacaan mereka sendiri, mendiskusikan novel dengan orang-orang yang berpikiran sama, menemukan novel baru untuk dibaca, dan berkomentar bersama para penerjemah dan pengguna lainnya.</div>
</li>
<li class="list-item">
<h6><a class="about text-primary">Tentang kami:</a></h6>
<div>ToNovel.co pertama kali diluncurkan pada tanggal 8 Desember 2017 mengalami pengembangan keras dan pengujian beta oleh beberapa pengguna. Saat ini, situs ini masih dalam mode Beta, karena tidak sempurna (karena kesempurnaan hanya milik diatas :P ). ToNovel adalah proyek berbasis komunitas dimana pengguna dari semua latar belakang dapat menambahkan ke database yang luas dari semua novel asia. Karena ToNovel adalah situs komunitas, opini dan umpan balik Anda penting untuk membuat situs ini lebih baik jadi harap kirimkan umpan balik <a href="#">disini</a>, atau kirimkan kami email ke <a href="mailto:support@tonovel.co" class="email text-primary">support@tonovel.co</a> dengan subyek “Umpan Balik”.</div>
</li>
<li class="list-item">
<h6><a class="about text-primary">Bagaimana cara membantu ?</a></h6>
<div>Menyukai situs ini, tapi bingung untuk bisa membantu kami ?<br>
Ada beberapa cara yang bisa membantu pengguna. Yang utama adalah dengan menambahkan Novel yang belum ada ke database.<br>
Cara kedua adalah dengan memberitahu lebih banyak orang tentang ToNovel.co karena semakin banyak orang di situs ini, maka situs ini akan semakin berkembang.<br>
Dan tentu saja Anda selalu bisa menggunakan imajinasi Anda dan membantu kami dengan cara Anda sendiri :p !</div>
</li>
<li class="list-item">
<h6><a class="about text-primary">Aku punya pertanyaan ! Jawab atau aku makan biskuitmu !!</a></h6>
<div>Pertama kalem! Kedua, itu biskuit aku -_- !<br>
Jika Kamu memiliki pertanyaan, periksa <a href="/page/faq">Sering ditanyakan</a>dan jika pertanyaan anda masih belum terjawab email kami di <a href="mailto:support@tonovel.co" class="email text-primary">support@tonovel.co</a> dengan subyek “Pertanyaan“ dijudul pesan kamu</div>
</li>
</ul>
</div>
</div>
</div>
</div>
@endsection