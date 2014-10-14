<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_kontrak();
// pr($get_data_filter);
?>

<?php
  include"$path/meta.php";
  include"$path/header.php";
  include"$path/menu.php";
  
?>
  <!-- SQL Sementara -->
 <?php
  if(isset($_POST['noKontrak'])){
    if($_POST['id'] == "")
    {
      $dataArr = $STORE->store_kontrak($_POST);
    }  else
    {
      $dataArr = $STORE->store_edit_kontrak($_POST,$_POST['id']);
    }
      

  }

  if(isset($_GET['id']))
  {
     $sql = mysql_query("SELECT * FROM kontrak WHERE id = '{$_GET['id']}'");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
            $kontrak[] = $dataKontrak;
        }
  }

 ?>
  <!-- End Sql -->
  <section id="main">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
        <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
        <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
        <li class="active">Tambah Kontrak</li>
        <?php SignInOut();?>
      </ul>
      <div class="breadcrumb">
        <div class="title">Kontrak</div>
        <div class="subtitle">Tambah Kontrak</div>
      </div>    

    <section class="formLegend">
      
      <form action="" method="POST">
         <div class="formKontrak">
            <h3 class="grs-bottom"><i class="fa fa-file-text"></i>&nbsp;<span>Kontrak</span></h3>
            <ul>
              <li>
                <span class="labelkontrak">No.SPK/Perjanjian Kontrak</span>
                <input type="text" name="noKontrak" value="<?=(isset($kontrak)) ? $kontrak[0]['noKontrak'] : '' ?>" required/>
              </li>
              <li>
                <span class="labelkontrak">Tgl.SPK/Perjanjian Kontrak</span>

                <input type="text" name="tglKontrak" id="datepicker" value="<?=(isset($kontrak)) ? $kontrak[0]['tglKontrak'] : '' ?>" required/>

              </li>
              <li>
                <span class="labelkontrak">Keterangan</span>
                <textarea name="keterangan"><?=(isset($kontrak)) ? $kontrak[0]['keterangan'] : '' ?></textarea>
              </li>
              <li>
                <span  class="labelkontrak">Jangka Waktu</span>
                <input type="text" name="jangkaWkt" value="<?=(isset($kontrak)) ? $kontrak[0]['jangkaWkt'] : '' ?>"/>
              </li>
              <li>
                <span  class="labelkontrak">Nilai</span>
                <input type="text" name="nilai" value="<?=(isset($kontrak)) ? $kontrak[0]['nilai'] : '' ?>" required/>
              </li>
              <li>
                <span  class="labelkontrak">Jenis Posting</span>
                <input type="radio" name="tipeAset" value="1" <?=(isset($kontrak)) ? (($kontrak[0]['tipeAset']== "1") ? 'checked' : '') : '' ?>/>&nbsp;Aset Baru
                <input type="radio" name="tipeAset" value="2" <?=(isset($kontrak)) ? (($kontrak[0]['tipeAset']== "2") ? 'checked' : '') : '' ?>/>&nbsp;Kapitalisasi
                <input type="radio" name="tipeAset" value="3" <?=(isset($kontrak)) ? (($kontrak[0]['tipeAset']== "3") ? 'checked' : '') : '' ?>/>&nbsp;Ubah Status
              </li>
            </ul>
              
          </div>
          <div class="formPerusahaan">
            <h3 class="grs-bottom"><i class="fa fa-briefcase"></i>&nbsp;<span>Perusahaan</span></h3>
            <ul>
              <li>
                <span class="labelperusahaan">Nama</span>
                <input type="text" name="nm_p" value="<?=(isset($kontrak)) ? $kontrak[0]['nm_p'] : '' ?>"/>
              </li>
              <li>
                <span class="labelperusahaan">Bentuk</span>
                <input type="text" name="bentuk" value="<?=(isset($kontrak)) ? $kontrak[0]['bentuk'] : '' ?>"/>
              </li>
              <li>
                <span class="labelperusahaan">Alamat</span>
                <input type="text" name="alamat" value="<?=(isset($kontrak)) ? $kontrak[0]['alamat'] : '' ?>"/>
              </li>
              <li>
                <span class="labelperusahaan">Pimpinan</span>
                <input type="text" name="pimpinan_p" value="<?=(isset($kontrak)) ? $kontrak[0]['pimpinan_p'] : '' ?>"/>
              </li>
              <li>
                <span class="labelperusahaan">NPWP</span>
                <input type="text" name="npwp_p" value="<?=(isset($kontrak)) ? $kontrak[0]['npwp_p'] : '' ?>"/>
              </li>
              <li>
                <span class="labelperusahaan">Bank</span>
                <input type="text" name="bank_p" value="<?=(isset($kontrak)) ? $kontrak[0]['bank_p'] : '' ?>"/>
              </li>
              <li>
                <span class="labelperusahaan">Atas Nama</span>
                <input type="text" name="norek_p" value="<?=(isset($kontrak)) ? $kontrak[0]['norek_p'] : '' ?>"/>
              </li> 
              <li>
                <span class="labelperusahaan">No.Rekening</span>
                <input type="text" name="norek_pemilik" value="<?=(isset($kontrak)) ? $kontrak[0]['norek_pemilik'] : '' ?>"/>
              </li>
            </ul>
          </div>
          
        </div>
      
        <!-- Hidden -->
        <input type="hidden" name="id" value="<?=(isset($kontrak)) ? $kontrak[0]['id'] : '' ?>"/>

      <div class="modal-footer">
        <button class="btn" type="reset">Reset</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
      
    </section>        
  </section>
  
<?php
  include"$path/footer.php";
?>