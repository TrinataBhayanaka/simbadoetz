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
		while ($dataKontrak = mysql_fetch_array($sql)){
				$kontrak[] = $dataKontrak;
			}

	//post
	if(isset($_POST['nosp2d'])){

		foreach ($_POST as $key => $val) {
				$tmpfield[] = $key;
				$tmpvalue[] = "'$val'";
			}
			$field = implode(',', $tmpfield);
			$value = implode(',', $tmpvalue);

			$query = mysql_query("INSERT INTO sp2d ({$field}) VALUES ($value)");

			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/sp2dpenunjang.php?id={$idKontrak}\">";

	}

	//end SQL
?>
	
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">SP2D Penunjang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">SP2D Penunjang</div>
				<div class="subtitle">Tambah SP2D Penunjang</div>
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
								<span class="labelInfo">Total SP2D Penunjang</span>
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
								<input type="text" name="nosp2d"/>
							</li>
							<li>
								<span class="span2">Tgl.SP2D</span>
								<input type="text" name="tglsp2d" id="datepicker"/>
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
							<li>
							<span class="span2">&nbsp;</span>
							<button class="btn" data-dismiss="modal">Kembali</button>
							<button class="btn btn-primary">Simpan</button>	
							</li>
							
						</ul>
							<!-- Hidden -->
							<input type="hidden" name="idKontrak" value="<?=$idKontrak?>" >
							<input type="hidden" name="type" value="2" >
					</div>
					
			
		</form>
			
		</section> 
		      
	</section>
	
<?php
	include"$path/footer.php";
?>