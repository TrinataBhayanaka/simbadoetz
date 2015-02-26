<?php
include "../../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
$RETRIEVE_PEROLEHAN = new RETRIEVE_PEROLEHAN;

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	$dataArr = $RETRIEVE_PEROLEHAN->get_aplasetlist('XLSIMP');
	$cleardata = explode(",", $dataArr['aset_list']);
	$counter2 = 0;
	foreach ($cleardata as $key => $val) {
		$counter2++;
		if ($counter2 == 201) {
			$counter2 = 0;
			sleep(1);
		}

		$tmp = explode("|", $val);

		$datatmp = $RETRIEVE_PEROLEHAN->get_slowtmpData($tmp[0]);
		

		$data['kodeSatker'] = $datatmp['kodeSatker'];
		$data['kodeRuangan'] = $datatmp['kodeRuangan'];
		$data['kodeKelompok'] = $datatmp['kodeKelompok'];
		$data['Judul'] = $datatmp['Judul'];
		$data['Pengarang'] = $datatmp['Pengarang'];
		$data['Penerbit'] = $datatmp['Penerbit'];
		$data['Spesifikasi'] = $datatmp['Spesifikasi'];
		$data['AsalDaerah'] = $datatmp['AsalDaerah'];
		$data['Material'] = $datatmp['Material'];
		$data['Ukuran'] = $datatmp['Ukuran'];
		$data['TglPerolehan'] = $datatmp['TglPerolehan'];
		$data['Alamat'] = $datatmp['Alamat'];
		$data['Kuantitas'] = $datatmp['Jumlah'];
		$data['Satuan'] = $datatmp['NilaiPerolehan'];
		$data['NilaiPerolehan'] = $datatmp['NilaiPerolehan'];
		$data['NilaiTotal'] = $datatmp['NilaiTotal'];
		$data['Info'] = $datatmp['Info'];
		$data['id'] = $_GET['id'];
		$data['noKontrak'] = $datatmp['noKontrak'];
		$data['kondisi'] = 1;
		$data['UserNm'] = $_SESSION['ses_uoperatorid'];
		$data['Tahun'] = $datatmp['Tahun'];
		$data['TipeAset'] = $datatmp['TipeAset'];
		$data['AsalUsul'] = 'Pembelian';
		$data['GUID'] = $datatmp['GUID'];
		$data['xls'] = 1;
		// pr($data);exit;
		//insert data
		$kontrak = $RETRIEVE_PEROLEHAN->upd_kontrak($_GET['id']);
		$dataArr = $STORE->store_aset($data);	
	}
	$datatmp = $RETRIEVE_PEROLEHAN->del_xlsOldData('tmp_asetlain','XLSIMP');
	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_barang.php?id={$_GET['id']}\">";
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

