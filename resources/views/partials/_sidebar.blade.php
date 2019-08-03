
            <nav id="sidebar">
                <ul class="list-unstyled components">
                    <p>Alat</p>
                    <li>
                        <a href="#" id="act-listing"><i class="glyphicon glyphicon-list"></i></a>
                    </li>
                    <li>
                        <a href="#" id="act-setting"><i class="glyphicon glyphicon-cog"></i></a>
                    </li>
                    <li>
                        <a href="#" id="act-comment"><i class="glyphicon glyphicon-comment"></i></a>
                    </li>
                    <li>
                        <a href="#" id="act-bookmark"><i class="glyphicon glyphicon-bookmark"></i></a>
                    </li>
                </ul>
                <ul class="list-unstyled footer">
                    <li>
                        <a href="#" id="footer"><i class="glyphicon glyphicon-menu-up gly-bounce"></i><span id="counter">N/A</span></a>
                    </li>
                </ul>
            </nav>
            <nav id="infobar" class="infor active">
                <div class="infobar-header">
                  <a href="#" class="_close"><i class="glyphicon glyphicon-remove"></i></a>
                    <h4>Daftar Isi <div class="pull-right"><a href="#" class="btn btn-info btn-sm" id="refresh-capt"><i class="glyphicon glyphicon-refresh"></i></a> <span id="navcapt" style="display: none;"><a href="#" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-chevron-left"></i></a> <a href="#" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-chevron-right"></i></a></span></div></h4>
                </div>
                <div class="panel panel-default">
                    <div class="list-group infolist">
                      <center id="dump-list">
                      <h1><i class="glyphicon glyphicon-refresh"></i></h1>
                      <span>Reload Untuk menampilkan</span>
                      </center>
                    </div>
</nav>
            <nav id="commentbar" class="comment active">
                <div class="commentbar-header">
                  <a href="#" class="_close"><i class="glyphicon glyphicon-remove"></i></a>
                    <h4>Komentar</h4>
                </div>
                <div class="panel panel-default">
  <div class="panel-body commentlist">
                      <center id="dump-comment">
                      <h1><i class="glyphicon glyphicon-eye-close"></i></h1>
                      <a href="#" class="btn btn-info btn-xs" id="comment-ack">Klik Untuk Melihat Komentar</a>
                      </center>
</div>
<div class="panel-footer" style="display: none;position: absolute;
    bottom: 0;">
    <div class="input-group"> 
                    <span class="u-rep"></span>
                    <input class="form-control u-comment u-focus" placeholder="Tambah Komentar"/>
                    <input type="hidden" value="0" id="reply-status" type="text">
                    <input type="hidden" value="0" id="reply-options" type="text">
                    <span class="input-group-addon">
                        <a href="#" id="comment-send"><i class="glyphicon glyphicon-send"></i></a>  
                    </span>
                </div>
</div>
            </nav>
            <nav id="rightbar" class="setting active">
                <div class="rightbar-header">
                  <a href="#" class="_close"><i class="glyphicon glyphicon-remove"></i></a>
                    <h4>Pengaturan</h4>
                </div>
                <div class="panel panel-default">
                  <!-- RAW Config -->
                  <input type="hidden" name="auto" id="cf-auto" value="0"/>
                  <input type="hidden" name="coloring" value="0"/>
  <div class="panel-body">
    <div class="form-group">
  <label class="control-label" for="jenis-font">Tema Bootstrap</label><a href="#" class="noveltips" title="Beberapa tema ada yang tidak support "> <i class="glyphicon glyphicon-question-sign"></i></a>
        <select class="form-control" id="theme">
<option value="default">Default</option>
<option value="cerulean">Cerulean</option>
<option value="cosmo">Cosmo</option>
<option value="flatly">Flatly</option>
<option value="journal">Journal</option>
<option value="lumen">Lumen</option>
<option value="sandstone">Sandstone</option>
<option value="simplex">Simplex</option>
<option value="solar">Solar</option>
<option value="spacelab">Spacelab</option>
<option value="united">United</option>
<option value="yeti">Yeti</option>
        </select>
</div>
    <div class="form-group">
      <div class="col-lg-6">
  <label class="control-label" for="jenis-font">Jenis Font</label><a href="#" class="noveltips" title="Ubah jenis font kamu yang kamu sukai"> <i class="glyphicon glyphicon-question-sign"></i></a>

        <select class="form-control" id="jenis-font">
        <option value="Arial, Helvetica, sans-serif">Arial</option>
        <option value="Merriweather,serif">Merriweather</option>
        <option value="Verdana, Geneva, sans-serif">Verdana</option>
        <option value="Tahoma, Geneva, sans-serif">Tahoma </option>
        <option value="'Lucida Console', Monaco, monospace">Lucida Console </option>
        <option value="'Comic Sans MS', cursive, sans-serif">Comic Sans MS</option>
        </select>
</div>
<div class="col-lg-6">
  <label class="control-label" for="ukuran-font">Ukuran Font</label><a href="#" class="noveltips" title="Ubah ukuran font kamu yang kamu sukai"> <i class="glyphicon glyphicon-question-sign"></i></a>
        <div class="input-group">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                  <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" name="quant[1]" class="form-control input-number" value="15" min="14" max="36">
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
</div>
</div>
    <div class="form-group">
      <div class="col-lg-6">
  <label class="control-label" for="focusedInput">Warna Latar</label><a href="#" class="noveltips" title="Ubah warna latar kamu yang kamu sukai"> <i class="glyphicon glyphicon-question-sign"></i></a>
  <div class="input-group input-append color bg-picker" data-color="rgb(250, 250, 250)" data-color-format="rgb">
  <span class="add-on input-group-addon"><i style="background-color: rgb(250, 250, 250)"></i></span>
  <input type="text" class="span2 form-control" value="" >
</div>
  </div>
      <div class="col-lg-6">
  <label class="control-label" for="focusedInput">Warna Font</label><a href="#" class="noveltips" title="Ubah warna font kamu yang kamu sukai"> <i class="glyphicon glyphicon-question-sign"></i></a>
  <div class="input-group input-append color font-picker" data-color="rgb(51, 51, 51)" data-color-format="rgb">
  <span class="add-on input-group-addon"><i style="background-color: rgb(51, 51, 51)"></i></span>
  <input type="text" class="span2 form-control" value="" >
</div>
  </div>
  </div>
    <div class="form-group">
  <label class="control-label" for="jenis-font">Otomatis Pindah</label><a href="#" class="noveltips" title="Cukup scrolling untuk pindah ke chapter yg baru"> <i class="glyphicon glyphicon-question-sign"></i></a>
        <select class="form-control" id="otomatis">
        <option value="0">Nonaktif</option>
        <option value="1">Aktif</option>
        </select>
</div>
    <div class="form-group">
  <label class="control-label" for="jenis-font">Blokir Iklan</label><a href="#" class="noveltips" title="Paksa iklan untuk diblokir"> <i class="glyphicon glyphicon-question-sign"></i></a>
        <select class="form-control" id="iklan">
        <option value="0">Nonaktif</option>
        <option value="1">Aktif</option>
        </select>
</div>
</div>
            </nav>