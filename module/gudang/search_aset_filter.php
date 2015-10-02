<?php
include "../../config/config.php";
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	 $menu_id = 10;
     $SessionUser = $SESSION->get_session_user();
     ($SessionUser['ses_uid'] != '') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title' => 'GuestMenu', 'ses_name' => 'menu_without_login'));
     $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	 $resetDataView = $DBVAR->is_table_exists('lihat_daftar_aset_'.$SessionUser['ses_uoperatorid'], 0);
	
	 $idkontrak = $_GET['id'];
	 //temp sql
	 $handler = $DBVAR->query("select toSatker from transfer where id='$idkontrak'");
	 $getData = $DBVAR->fetch_array($handler);
	 // pr($getData);
	 $expld = explode('.',$getData['toSatker']);
	 //handler 08
	 $flag = end($expld);
	 // pr($flag);
	 $strlen = strlen($flag);
	 // $strlen = '3';
	 
?>
	<script>
	jQuery(function($){
	   $("#Tahun").mask("9999");
	   $("#kodeLokasi_08").mask("99.99.99.99.99.99.99.999");
	   $("#kodeLokasi").mask("99.99.99.99.99.99.99.99");
	    
	   $("#tipeAset").select2();
	});
	</script>

	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Distribusi Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Cari Aset</div>
			<div class="subtitle">Filter Data Aset</div>
		</div>
		
		
		<section class="formLegend">
			
			 <form name="lda_filter" action="<?php echo "$url_rewrite/module/gudang/"; ?>search_aset_daftar.php?id=<?=$_GET['id']?>" method="post">
			<ul>
							<li>
								<span>Tahun Perolehan</span><br/>
								<input name="Tahun" id="Tahun" class="span2"  type="text" required>
							</li>
							<li>
								<span>Kode Lokasi</span><br/>
								<?php
								if($strlen == '3'){
									echo"<input id=\"kodeLokasi_08\" name=\"kodeLokasi\" type=\"text\" style=\"width:170px\">";
								}elseif($strlen == '2'){
									echo"<input id=\"kodeLokasi\" name=\"kodeLokasi\" type=\"text\" style=\"width:170px\">";
								}
								?>
								
							</li>
							<li>
								<span>Jenis Aset</span><br/>
								<select name="tipeAset" id="tipeAset" style="width:170px">
									<option value="tanah">Tanah</option>
									<option value="mesin">Mesin</option>
									<option value="bangunan">Bangunan</option>
									<option value="jaringan">Jaringan</option>
									<option value="asetlain">Aset Lain</option>
									<option value="kdp">KDP</option>
								</select>
							</li>
							<li>&nbsp;</li>	
							<li>
								<input type='submit' value='Lanjut' class="btn btn-primary">
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>