<?php
include "../../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	// pr($_SESSION);
	foreach ($_POST['aset'] as $key => $value) {
		$dataaset[] = explode("|", $value);
	}
	// pr($_POST);exit;
	foreach ($dataaset as $key => $val) {
		$data['kodeSatker'] = $val[0];
		$data['kodeRuangan'] = $val[8];
		$data['kodeKelompok'] = $val[4];
		$data['Merk'] = $val[10];
		$data['Model'] = $val[11];
		$data['Ukuran'] = $val[12];
		$data['Pabrik'] = $val[14];
		$data['NoMesin'] = $val[16];
		$data['NoBPKB'] = $val[18];
		$data['Material'] = $val[13];
		$data['NoRangka'] = $val[15];
		$data['TglPerolehan'] = $val[1];
		$data['Kuantitas'] = $val[19];
		$data['Satuan'] = $val[20];
		$data['NilaiPerolehan'] = $val[19]*$val[20];
		$data['Info'] = $val[7];
		$data['id'] = $_POST['kontrakid'];
		$data['noKontrak'] = $val[6];
		$data['kondisi'] = 1;
		$data['UserNm'] = $_SESSION['ses_uoperatorid'];
		$data['Tahun'] = $val[2];
		$data['TipeAset'] = $val[9];

		$data['xls'] = 1;
	
		//insert data
		$dataArr = $STORE->store_aset($data);	
	}
	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_barang.php?id={$_POST['kontrakid']}\">";
	exit;
	// pr($data);
	// pr($dataaset);exit;
		//kontrak
		
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$_POST['kontrakid']}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak[] = $dataKontrak;
				}
		// pr($kontrak);

		//sum total 
		$sqlsum = mysql_query("SELECT SUM(NilaiPerolehan) as total FROM aset WHERE noKontrak = '{$kontrak[0]['noKontrak']}'");
		while ($sum = mysql_fetch_array($sqlsum)){
					$sumTotal = $sum;
				}		

		
	?>
	<!-- End Sql -->

	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Rincian Barang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Import xls</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Import Data xls</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_simbada.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Kontrak</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perolehan/kontrak_rincian.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Rincian Barang</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_sp2d.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">SP2D</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_penunjang.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">4</i>
				    </span>
					<span class="text">Penunjang</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perolehan/kontrak_posting.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">5</i>
				    </span>
					<span class="text">Posting</span>
				</a>
			</div>	

		<section class="formLegend">
			
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
								<span class="labelInfo">Nilai SPK</span>
								<input type="text" id="spk" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Total Rincian Barang</span>
								<input type="text" id="totalRB" value="<?=isset($sumTotal) ? number_format($sumTotal['total']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
						<p>
							Jumlah data sukses di import : 10 </br>
							Jumlah data gagal di import :1
						</p>
						<div id="demo">
							
						<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="example">
							<thead>
								<tr>
									<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
									<th>Kode Kelompok</th>
									<th>Nama Barang</th>
									<th>Kode Lokasi</th>
									<th>No.Reg</th>
									<th>Jumlah</th>
									<th>Nilai</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if($xlsdata)
								{
									$i = 1;
									foreach ($xlsdata as $key => $value) {
							?>
									<tr class="gradeA">
										<td class="checkbox-column"><input type="checkbox" id="check_<?=$i?>" class="icheck-input" name="aset[]" value="<?=$value['tabel']?>_<?=$value['kodeKelompok']?>_<?=$value['kodeLokasi']?>_<?=$value['min']?>-<?=$value['max']?>" onchange="return AreAnyCheckboxesChecked();"></td>
										<td><?=$value['kodeKelompok']?></td>
										<td><?=$value['uraian']?></td>
										<td><?=$value['kodeLokasi']?></td>
										<td><?=$value['noRegister']?></td>
										<td><?=$value['Jumlah']?></td>
										<td><?=$value['NilaiPerolehan']?></td>
									</tr>
							<?php
									$i++;
									}
								}	
							?>	
							
							</tbody>
							<tfoot>
								<tr>
									<th colspan="5">&nbsp;</th>
								</tr>
							</tfoot>
						</table>
					
						</div>
						
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

