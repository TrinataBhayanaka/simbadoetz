<?php
include "../../config/config.php";
$menu_id = 1;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";

	//SQL Sementara
	$idsp2d = $_GET['idsp2d'];
	$sql = mysql_query("SELECT * FROM sp2d WHERE id='{$idsp2d}' LIMIT 1");
		while ($dataSp2d = mysql_fetch_array($sql)){
				$sp2d[] = $dataSp2d;
			}
	$idKontrak = $_GET['idkontrak'];
	$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}'");
		while ($dataKontrak = mysql_fetch_array($sql)){
				$kontrak[] = $dataKontrak;
			}

	//sum total 
	$sqlsum = mysql_query("SELECT SUM(jumlah) as total FROM sp2d_rinc WHERE idsp2d = '{$idsp2d}'");
	while ($sum = mysql_fetch_array($sqlsum)){
				$sumTotal = $sum;
			}	
	$idsql = mysql_query("SELECT * FROM sp2d_rinc WHERE id = '{$_GET['id']}'");
	while ($row = mysql_fetch_assoc($idsql)){
				$rinc = $row;
			}
	// pr($rinc);		
	//post
	if(isset($_POST['kdRekening'])){
		if($_POST['id'] == ""){
			$dataArr = $STORE->store_sp2dpenunjang_rinc($_POST,$idKontrak);
		} else {
			$dataArr = $STORE->store_edit_sp2dpenunjang_rinc($_POST,$_GET);
		}
			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/sp2dpenunjang_rinc.php?idsp2d={$idsp2d}&idkontrak={$kontrak[0]['id']}\">";
			exit;

	}
	//getdata
	//ajax rekening
	//###Tipe###
	$sqlTipe = mysql_query("SELECT * FROM koderekening WHERE Kelompok is NULL AND Jenis is NULL AND Objek is NULL AND RincianObjek is NULL ORDER BY KodeRekening_ID");	
	while ($dataTipe = mysql_fetch_array($sqlTipe)){
				$Tipe[] = $dataTipe;
			}
	$sqlrinc = mysql_query("SELECT * FROM sp2d_rinc WHERE idsp2d='{$idsp2d}'");
		while ($datarinc = mysql_fetch_array($sqlrinc)){
				$sp2drinc[] = $datarinc;
			}
	if($sp2drinc){
		foreach ($sp2drinc as $key => $value) {
			$sqlnmBrg = mysql_query("SELECT NamaRekening FROM koderekening WHERE KodeRekening = '{$value['kdRekening']}' LIMIT 1");
			while ($uraian = mysql_fetch_array($sqlnmBrg)){
					$tmp[] = $uraian;
					$sp2drinc[$key]['uraian'] = $tmp[0]['NamaRekening'];
				}
		}	
	}
	
		
	//end SQL
?>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian SP2D Penunjang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Form Rincian SP2D Penunjang</div>
				<div class="subtitle">Tambah Kontrak</div>
			</div>	
		<section class="formLegend">
			<div style="height:5px;width:100%;clear:both"></div>
			<form action="" method="POST">
				
				 <div class="formKontrak">
						
						<ul>
							<?php selectRekening('kdRekening','205',true,(isset($rinc) ? $rinc['kdRekening'] : false)); ?><br />
							<li>
								<span class="span2">Nilai</span>
								<input type="text" data-a-sign="Rp " id="hrgmask" data-a-dec="," data-a-sep="." value="<?=(isset($rinc)) ? $rinc['jumlah'] : ''?>" onkeyup="return getCurrency(this);" required />
								<input type="hidden" name="jumlah" id="jumlah" value="<?=(isset($rinc)) ? $rinc['jumlah'] : ''?>">
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<button class="btn" data-dismiss="modal">Kembali</button>
								<button class="btn btn-primary">Simpan</button>
							</li>
						</ul>
							<!-- Hidden -->
							<input type="hidden" name="idsp2d" value="<?=$_GET['idsp2d']?>" >
				
					
			</div>
			
		</form>
		</section> 
		      
	</section>
	<script type="text/javascript">
	    jQuery(function($) {
	        $('#hrgmask').autoNumeric('init');  
	    });

	    function getCurrency(item){
	      $('#jumlah').val($(item).autoNumeric('get'));
	    }

	  </script>
<?php
	include"$path/footer.php";
?>