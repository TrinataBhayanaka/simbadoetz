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
	$idKontrak = $_GET['id'];
	$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}'");
		while ($dataKontrak = mysql_fetch_assoc($sql)){
				$kontrak[] = $dataKontrak;
			}

	if(isset($_GET['idsp2d'])){
		$sql = mysql_query("SELECT * FROM sp2d WHERE id='{$_GET['idsp2d']}'");
		while ($datasp2d = mysql_fetch_assoc($sql)){
				$sp2d = $datasp2d;
			}
	}

	//post
	if(isset($_POST['nosp2d'])){
		if($_POST['id'] == ""){
			$dataArr = $STORE->store_sp2d($_POST,$idKontrak);
		} else {
			$dataArr = $STORE->store_edit_sp2d($_POST,$idKontrak);
		}
			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/sp2dtermin.php?id={$idKontrak}\">";

	}

	//getdata
	$sql = mysql_query("SELECT * FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '1'");
		while ($dataSP2D = mysql_fetch_array($sql)){
				$sp2d[] = $dataSP2D;
			}
	$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$idKontrak}' AND type = '1'");
		while ($sumsp2d = mysql_fetch_array($sql)){
				$totalsp2d[] = $sumsp2d;
			}
	$sisaKontrak = $kontrak[0]['nilai']-$totalsp2d[0]['total'];

	//end SQL
?>
	<script>
    jQuery(function($) {
        $('#totalmask').autoNumeric('init', {vMin: '0', vMax: '999999999999999' });
        //$("#datepicker").attr('readonly',true);
        $("#datepicker").mask("0000-00-00");
    });

    function getCurrency(item){
      $('#total').val($(item).autoNumeric('get'));
    }
  </script>
	<section id="main">
	<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">SP2D Termin</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">SP2D Termin</div>
				<div class="subtitle">Tambah SP2D Termin</div>
			</div>	
		<section class="formLegend">
			<div style="height:5px;width:100%;clear:both"></div>

			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="labelInfo">No. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['noKontrak']?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Tgl. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['tglKontrak']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							<li>
								<span class="labelInfo">Nilai Kontrak</span>
								<input type="text" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Total SP2D</span>
								<input type="text" value="<?=isset($totalsp2d) ? number_format($totalsp2d[0]['total']-$sp2d['nilai']) : '0'?>" disabled/>
							</li>
							<li style="display:none">
								<span  class="labelInfo">Sisa Kontrak</span>
								<input type="text" id="sisaKontrak" value="<?=isset($sisaKontrak) ? number_format($sisaKontrak+$sp2d['nilai']) : 0?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>

			<form action="" method="POST">
				
				 <div class="formKontrak">
						
						<ul>
							<li>
								<span class="span2">No.SP2D</span>
								<input type="text" name="nosp2d" value="<?=(isset($sp2d)) ? $sp2d['nosp2d'] : '' ?>" required/>
							</li>
							<li>
								<span class="span2">Tgl.SP2D</span>
								<input type="text" placeholder="yyyy-mm-dd" name="tglsp2d" id="datepicker" value="<?=(isset($sp2d)) ? $sp2d['tglsp2d'] : '' ?>" required/>
							</li>
							<li>
								<span  class="span2">Nilai</span>
								<input type="text" id="totalmask" data-a-sign="Rp " data-a-dec="," data-a-sep="." value="<?=(isset($sp2d)) ? $sp2d['nilai'] : '' ?>" onkeyup="return getCurrency(this);" required/>
								<input type="hidden" name="nilai" id="total" value="<?=(isset($sp2d)) ? $sp2d['nilai'] : '' ?>" />
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea name="keterangan"><?=(isset($sp2d)) ? $sp2d['keterangan'] : '' ?></textarea>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<button class="btn" type="reset">Reset</button>
								<button class="btn btn-primary">Simpan</button>
							</li>
						</ul>
							<!-- Hidden -->
							<input type="hidden" name="idKontrak" value="<?=$idKontrak?>" >
							<input type="hidden" name="type" value="1" >
							<input type="hidden" name="id" value="<?=(isset($sp2d)) ? $sp2d['id'] : '' ?>" >
					</div>
					
		</form>
		</section> 
		       
	</section>

	<script type="text/javascript">
		$(document).on('submit', function(){
		var perolehan = $("#total").val();
		var sisaKontrak = $("#sisaKontrak").val();
		var sk = parseInt(sisaKontrak.replace(/[^0-9\.]+/g, ""));

		if(perolehan > sk) {
			alert("Total SP2D barang melebihi nilai Kontrak");
			return false;	
		}
	})
	</script>
	
<?php
	include"$path/footer.php";
?>