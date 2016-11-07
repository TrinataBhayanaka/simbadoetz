<?php
include "../../config/config.php";
$menu_id = 10;
$SessionUser = $SESSION->get_session_user();
( $SessionUser['ses_uid']!='' ) ? $Session = $SessionUser : $Session = $SESSION->get_session( array( 'title'=>'GuestMenu', 'ses_name'=>'menu_without_login' ) );
$USERAUTH->FrontEnd_check_akses_menu( $menu_id, $Session );

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
if ( isset( $_POST['noKontrak'] ) ) {
  if ( $_POST['id'] == "" ) {
    //pr($_POST);//exit;
    $dataArr = $STORE->store_kontrak( $_POST );
  }  else {
    $dataArr = $STORE->store_edit_kontrak( $_POST, $_POST['id'] );
  }


}

if ( isset( $_GET['id'] ) ) {
  $sql = mysql_query( "SELECT * FROM kontrak WHERE id = '{$_GET['id']}'" );
  while ( $dataKontrak = mysql_fetch_assoc( $sql ) ) {
    $kontrak[] = $dataKontrak;
  }
}

?>
  <!-- End Sql -->
  <script>
    jQuery(function($) {
      $('#nilai_front').autoNumeric('init');
      $("#datepicker").mask("9999-99-99");

       //get jenis belanja 
      var idkontrak  = $('#idkontrak').val();
      if(idkontrak){
      var jenis_posting = $("input[type='radio'].jenis_posting:checked").val();
        if(jenis_posting == 1 || jenis_posting == 2){
        //if(jenis_posting == 1 ){
          var jns_blnj  = $('.jns_blnj').val();
          if(jns_blnj == 0){
            $('#kategori_blnj').show(400);
          }else{
            $('#kategori_blnj').hide(400);
          }
        }else{
          $('#kategori_blnj').hide(400);
        }
      }

      $('.jenis_posting,.jns_blnj').on('change', function(){
      var jenis_posting = $("input[type='radio'].jenis_posting:checked").val();
      var jenis_blnj = $("input[type='radio'].jns_blnj:checked").val();
      if(jenis_posting == 1 || jenis_posting == 2){
      //if(jenis_posting == 1 ){
        if(jenis_blnj == 0){
            $('#kategori_blnj').show(400);
          }else{
            $('#kategori_blnj').hide(400);
        }
      }else{
          $('#kategori_blnj').hide(400);
      }   
    }); 

  });

    function getCurrency(item){
      $('#nilai').val($(item).autoNumeric('get'));
    }

   
  </script>
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

      <form action="" method="POST" id="myform">
         <div class="formKontrak">
            <h3 class="grs-bottom"><i class="fa fa-file-text"></i>&nbsp;<span>Kontrak</span></h3>
            <ul>
              <?php echo selectSatker( 'kodeSatker', '205', true, ( isset( $kontrak ) ) ? $kontrak[0]['kodeSatker'] : false, 'required' );?>
               <li>
                <span  class="span2">&nbsp;</span>
                <div class="checkbox">
                  <em id="info">
                  </em>
                </div>
              </li>
              <li>
                <span class="span2">No.SPK/Perjanjian Kontrak</span>
                <input type="text" name="noKontrak" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['noKontrak'] : '' ?>" onchange="return check_availability(this,'info')" required/>
              </li>
              <li>
                <span class="span2">Tgl.SPK/Perjanjian Kontrak</span>

                <input type="text" placeholder="yyyy-mm-dd" name="tglKontrak" id="datepicker" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['tglKontrak'] : '' ?>" required/>

              </li>
              <li>
                <span class="span2">Keterangan</span>
                <textarea name="keterangan"><?php echo ( isset( $kontrak ) ) ? $kontrak[0]['keterangan'] : '' ?></textarea>
              </li>
              <li>
                <span  class="span2">Jangka Waktu</span>
                <input type="text" name="jangkaWkt" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['jangkaWkt'] : '' ?>"/>
              </li>
              <li>
                <span  class="span2">Nilai</span>
                <input type="text" id="nilai_front" data-a-sign="Rp " data-a-dec="," data-a-sep="." value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['nilai'] : '' ?>" onkeyup="return getCurrency(this);"  required/>
                <input type="hidden" id="nilai" name="nilai" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['nilai'] : '' ?>" required />
              </li>
              <li>
                <span  class="span2">Jenis Posting</span>
        <div class="checkbox">
          <label>
          <input type="radio" required name="tipeAset" class="jenis_posting" value="1" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['tipeAset']== "1" ) ? 'checked' : '' ) : '' ?>/>&nbsp;Aset Baru
          </label>
        </div>
      </li>



      <li>
                <span  class="span2">&nbsp;</span>
        <div class="checkbox">
          <label>
            <input type="radio" class="add-popover jenis_posting" data-toggle="popover" data-html="true" data-trigger="focus" data-placement="left" data-original-title="<label style='color:red'>Peringatan Kapitalisasi!!</label>" data-content="Khusus untuk jenis barang : <br> <b>Mesin</b> : Minimal <u>Rp. 300.000</u> <br> <b>Bangunan</b> : Minimal <u>Rp. 10.000.000</u> " required name="tipeAset" value="2" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['tipeAset']== "2" ) ? 'checked' : '' ) : '' ?>/>&nbsp;Kapitalisasi
          </label>
        </div>
      </li>

      <li>
      <span  class="span2">&nbsp;</span>
        <div class="checkbox">
          <label>
          <input type="radio" required name="tipeAset" class="jenis_posting"  value="3" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['tipeAset']== "3" ) ? 'checked' : '' ) : '' ?>/>&nbsp;Ubah Status
          </label>
        </div>
      </li>

      <li>
      <span  class="span2">Jenis Belanja</span>
        <div class="checkbox">
          <label>
          <input type="radio" class = "jns_blnj" required name="jenis_belanja" value="0" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['jenis_belanja']== "0" ) ? 'checked' : '' ) : '' ?>/>&nbsp;Belanja Modal
          </label>
        </div>
      </li>      
      <li>
      <span  class="span2">&nbsp;</span>
        <div class="checkbox">
          <label>
          <input type="radio" class = "jns_blnj" required name="jenis_belanja" value="1" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['jenis_belanja']== "1" ) ? 'checked' : '' ) : '' ?>/>&nbsp;Belanja Barang dan Jasa
          </label>
        </div>
      </li>
      <br/>
      <div id ="kategori_blnj" style="display: none">
      <li>
      <span  class="span2" >Kategori Belanja Aset</span>
        <select  name="kategori_belanja" class="span2" id="NamaJabatan" required="">
            <option value="" >Pilih Kategori Aset</option>
            <option value="01" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['kategori_belanja']== "01" ) ? 'selected' : '' ) : '' ?>/>Tanah</option>
            <option value="02" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['kategori_belanja']== "02" ) ? 'selected' : '' ) : '' ?>/>Mesin</option>
            <option value="03" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['kategori_belanja']== "03" ) ? 'selected' : '' ) : '' ?>/>Bangunan</option>
            <option value="04" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['kategori_belanja']== "04" ) ? 'selected' : '' ) : '' ?>/>Jaringan</option>
            <option value="05" <?php echo ( isset( $kontrak ) ) ? ( ( $kontrak[0]['kategori_belanja']== "05" ) ? 'selected' : '' ) : '' ?>/>Asetlain</option>
          </select>
      </li> 
      </div>
      </ul>

          </div>
          <div class="formPerusahaan">
            <h3 class="grs-bottom"><i class="fa fa-briefcase"></i>&nbsp;<span>Perusahaan</span></h3>
            <ul>
              <li>
                <span class="span2">Nama </span>
                <input type="text" name="nm_p" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['nm_p'] : '' ?>"/>
              </li>
              <li>
                <span class="span2">Bentuk </span>
                <input type="text" name="bentuk" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['bentuk'] : '' ?>"/>
              </li>
              <li>
                <span class="span2">Alamat </span>
                <input type="text" name="alamat" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['alamat'] : '' ?>"/>
              </li>
              <li>
                <span class="span2">Pimpinan </span>
                <input type="text" name="pimpinan_p" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['pimpinan_p'] : '' ?>"/>
              </li>
              <li>
                <span class="span2">NPWP </span>
                <input type="text" name="npwp_p" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['npwp_p'] : '' ?>"/>
              </li>
              <li>
                <span class="span2">Bank </span>
                <input type="text" name="bank_p" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['bank_p'] : '' ?>"/>
              </li>
              <li>
                <span class="span2">Atas Nama </span>
                <input type="text" name="norek_p" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['norek_p'] : '' ?>"/>
              </li>
              <li>
                <span class="span2">No.Rekening </span>
                <input type="text" name="norek_pemilik" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['norek_pemilik'] : '' ?>"/>
              </li>
        <li>
                <span class="span2">
        <button class="btn" type="reset">Reset</button>
        <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
        </span>
        </li>
            </ul>
          </div>

        </div>

        <!-- Hidden -->
        <input type="hidden" name="id" id="idkontrak" value="<?php echo ( isset( $kontrak ) ) ? $kontrak[0]['id'] : '' ?>"/>
        <input type="hidden" name="UserNm" value="<?php echo $_SESSION['ses_uoperatorid']?>"/>
        <input type="hidden" name="tipe_kontrak" value="1"/>

      </form>

    </section>
  </section>
  <script>
    function check_availability(item,div){

      //get the value
      var value = $(item).val();

      if(value != 0)
      {
        $.post("<?php echo $url_rewrite?>/function/api/checkAvail.php", { value: value},
          function(result){

            var newvar = result;
            // console.log(result);
            //if the result is 1
            if(newvar != true){
              //show that the value is available
              $('#'+div+'').html('No. Kontrak dapat digunakan');
              $('#'+div+'').css("color","green");
              $('#btnSubmit').removeAttr("disabled");
            }else{
              //show that the value is NOT available
              $('#'+div+'').html('No. Kontrak tidak dapat digunakan');
                $('#'+div+'').css("color","red");
                $('#btnSubmit').attr("disabled","disabled");

            }
        }, "JSON");
      }else
      {
        //show that the value is NOT available
              $('#'+div+'').html('No. Kontrak tidak dapat digunakan');
                $('#'+div+'').css("color","red");
                $('#btnSubmit').attr("disabled","disabled");


      }
    }
  </script>

<?php
include"$path/footer.php";
?>
