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
		
	//post
	if(isset($_POST['kdRekening'])){

		foreach ($_POST as $key => $val) {
				$tmpfield[] = $key;
				$tmpvalue[] = "'$val'";
			}
			$field = implode(',', $tmpfield);
			$value = implode(',', $tmpvalue);

			$query = mysql_query("INSERT INTO sp2d_rinc ({$field}) VALUES ($value)");

			//sum total 
			$sqlsum = mysql_query("SELECT SUM(jumlah) as total FROM sp2d_rinc WHERE idsp2d = '{$_POST['idsp2d']}'");
			while ($sum = mysql_fetch_array($sqlsum)){
						$jmlTotal = $sum;
					}	

			$updquery = mysql_query("UPDATE sp2d SET nilai = '{$jmlTotal['total']}' WHERE id = '{$_POST['idsp2d']}'");
			
			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/sp2dpenunjang_rinc.php?idsp2d={$idsp2d}&idkontrak={$kontrak[0]['id']}\">";

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
	<script>
	function autoKelompok(from,dest){

		var id = $('#'+from).val();	
	
		$.post("<?=$url_rewrite?>/module/perolehan/ajaxRekening.php", { id: id, idhtml: from}, 
					function(data){ 
						$("#li"+dest).removeAttr("style");
						var locType = $('#'+dest);
						$('#'+dest)
							.find('option')
							.remove()
							.end()
						;
						locType.append("<option value=''>--Pilih "+dest+"--</option>")
						for(i=0;i<data.length;i++){
							locType.append("<option value='" + data[i].KodeRekening+"'>" + data[i].NamaRekening + "</option>")
						}
				}, "JSON");
		
	}
	</script>
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
							<li>
								<span class="span2">Rekening</span>
								<select id="tipe" onchange="autoKelompok('tipe','kelompok')">
									<option value="0">--Pilih Tipe--</option>
									<?php
										foreach ($Tipe as $key => $val) {
											echo "<option value='{$val['KodeRekening']}'>{$val['NamaRekening']}</option>";
										}
									?>
								</select><span>	
							</li>
							<li id="likelompok" style="display:none">
								<span class="span2">&nbsp;</span>
								<select id="kelompok" onchange="autoKelompok('kelompok','jenis')">
									<option></option>
								</select>	
							</li>
							<li id="lijenis" style="display:none">
								<span class="span2">&nbsp;</span>
								<select id="jenis" onchange="autoKelompok('jenis','objek')">
									<option></option>
								</select>	
							</li>
							<li id="liobjek" style="display:none">
								<span class="span2">&nbsp;</span>
								<select id="objek" onchange="autoKelompok('objek','rincianobjek')">
									<option></option>
								</select>	
							</li>
							<li id="lirincianobjek" style="display:none">
								<span class="span2">&nbsp;</span>
								<select id="rincianobjek" name="kdRekening" >
									<option></option>
								</select>	
							</li>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" name="jumlah" />
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<button class="btn" data-dismiss="modal">Kembali</button>
								<button class="btn btn-primary">Simpan</button>
							</li>
						</ul>
							<!-- Hidden -->
							<input type="hidden" name="idsp2d" value="<?=$idsp2d?>" >
				
					
			</div>
			
		</form>
		</section> 
		      
	</section>
	
<?php
	include"$path/footer.php";
?>