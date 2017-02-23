 
<?php
include "../../config/config.php";
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	 $menu_id = 1;
     $SessionUser = $SESSION->get_session_user();
     ($SessionUser['ses_uid'] != '') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title' => 'GuestMenu', 'ses_name' => 'menu_without_login'));
     $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	 $resetDataView = $DBVAR->is_table_exists('lihat_daftar_aset_'.$SessionUser['ses_uoperatorid'], 0);
	
?>	
     <script type="text/javascript">
      $(document).ready(function(){
        $("#Tahun").mask("9999");
        $("select").select2();
      });
     </script>
     
  <section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Layanan Umum</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Lihat Daftar Aset</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Lihat Daftar Aset</div>
			<div class="subtitle">Filter Daftar Aset</div>
		</div>
		<section class="formLegend">
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/layanan/lihat_aset_daftar2.php" >
				<ul>
					<li>
            <i>*) <u>cukup isi field <strong class="blink_text_red" >Tipe Aset</strong> & <strong class="blink_text_red">Kode Satker</strong> & <strong class="blink_text_red">Status Aset</strong> untuk menampilkan seluruh data </u></i></li>
					<li>&nbsp;</li>
					<li>
					    <span class="span2">Tahun Perolehan</span>
						  <input type='text' id="Tahun" maxlength="4" name="bup_tahun" placeholder="" />
					</li>
				  	<?php selectAset('kodeKelompok','235',true,false); ?>
          <li>&nbsp;</li>
          <li><span class="span2 select2-chosen">Status Aset</span>
              <select name="statusaset" style="width:205px"required >
                  <option value="1">Terdistribusi</option>
                  <option value="0">Belum Terdistribusi</option>
                  <option value="27">Dihapus</option>
                  <option value="13">Perubahan Status</option>
                  
              </select>
          </li>
          <li>&nbsp;</li>
					<li>
						  <span class="span2">Tipe Aset</span>
						    <select name="jenisaset" style="width:205px" id="jenisaset" required>
    							<!--<option value="">Pilih Tipe Aset</option>-->
    							<option value="A">Tanah</option>
    							<option value="B">Mesin</option>
    							<option value="C">Bangunan</option>
    							<option value="D">Jaringan</option>
    							<option value="E">Aset Tetap Lain</option>
    							<option value="F">KDP</option>
						    </select>
          </li>  
          <li>&nbsp;</li>
          <?=selectSatker('kodeSatker','205',true,false,'required');?>
          <li>&nbsp;</li>
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
						<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					</li>
				</ul>
			</form>
			    
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>

