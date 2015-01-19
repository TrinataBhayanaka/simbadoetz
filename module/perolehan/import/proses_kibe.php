<?php
include "../../../config/config.php";
include "excel_reader.php";
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
	// pr($_POST);
	// pr($_FILES);
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
		// pr($sumTotal);

		$data = new Spreadsheet_Excel_Reader($_FILES['myFile']['tmp_name']);

		// membaca jumlah baris dari data excel
		$baris = $data->rowcount($sheet_index=0);
		$no = 0;
		for ($i=10; $i<=$baris; $i++)
		{
		  $xlsdata[$no]['kodeSatker'] = $_POST['kodeSatker'];
		  $kodeSatker = explode(".",$_POST['kodeSatker']);
		  $xlsdata[$no]['TglPerolehan'] = $data->val($i, 13);
		  $xlsdata[$no]['Tahun'] = substr($xlsdata[$no]['TglPerolehan'], 0,4);
		  $xlsdata[$no]['kodeLokasi'] = "12.33.75.".$kodeSatker[0].".".$kodeSatker[1].".".substr($xlsdata[$no]['Tahun'],-2).".".$kodeSatker[2].".".$kodeSatker[3];		
		  $xlsdata[$no]['kodeKelompok'] = $data->val($i, 3);

		  $sql = mysql_query("SELECT uraian FROM kelompok WHERE kode='{$data->val($i, 3)}' LIMIT 1");
			while ($namaaset = mysql_fetch_assoc($sql)){
					$uraian = $namaaset['uraian'];
				}	
		  $xlsdata[$no]['uraian'] = $uraian;

		  $sql = mysql_query("SELECT MAX(noRegister) AS lastreg FROM {$_POST['jenisaset']} WHERE kodeKelompok = '{$xlsdata[$no]['kodeKelompok']}' AND kodeLokasi = '{$xlsdata[$no]['kodeLokasi']}'");
		  while ($reg = mysql_fetch_assoc($sql)){
					$lastreg = $reg['lastreg'];
				}
		  $xlsdata[$no]['noRegister'] = $lastreg + 1;		
		  $xlsdata[$no]['noKontrak'] = $_POST['noKontrak'];
		  $xlsdata[$no]['Info'] = $data->val($i,16);
		  $xlsdata[$no]['kodeRuangan'] = $_POST['kodeRuangan'];
		  $xlsdata[$no]['TipeAset'] = 'E';
		  $xlsdata[$no]['NilaiPerolehan'] = $data->val($i,14);

		  $xlsdata[$no]['Judul'] = $data->val($i,4);
		  $xlsdata[$no]['Pengarang'] = $data->val($i,5);
		  $xlsdata[$no]['Penerbit'] = $data->val($i,6);
		  $xlsdata[$no]['Spesifikasi'] = $data->val($i,7);
		  $xlsdata[$no]['AsalDaerah'] = $data->val($i,8);
		  $xlsdata[$no]['Material'] = $data->val($i,9);
		  $xlsdata[$no]['Ukuran'] = $data->val($i,10);
		  $xlsdata[$no]['Alamat'] = $data->val($i,11);
		  $xlsdata[$no]['Jumlah'] = $data->val($i,12);
		  $no++;
		}
		// pr($xlsdata);
	?>
	<!-- End Sql -->

	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#btn-dis").removeAttr("disabled");

			}
			else
			{
			   $('#btn-dis').attr("disabled","disabled");
			}}, 100);
		}
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
				<form action="hasil_kibe.php" method=POST name="checks" ID="Form2">
					<p><button type="submit" class="btn btn-success btn-small" id="btn-dis" disabled><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Pilih</button>
							&nbsp;</p>

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
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if($xlsdata)
								{
									$i = 1;
									$total = 0;
									foreach ($xlsdata as $key => $value) {
							?>
									<tr class="gradeA">
										<td class="checkbox-column"><input type="checkbox" id="check_<?=$i?>" class="icheck-input" name="aset[]" 
											value="<?=$value['kodeSatker']?>|<?=$value['TglPerolehan']?>|<?=$value['Tahun']?>|<?=$value['kodeLokasi']?>|<?=$value['kodeKelompok']?>|<?=$value['noRegister']?>|<?=$value['noKontrak']?>|<?=$value['Info']?>|<?=$value['kodeRuangan']?>|<?=$value['TipeAset']?>|<?=$value['Judul']?>|<?=$value['Pengarang']?>|<?=$value['Penerbit']?>|<?=$value['Spesifikasi']?>|<?=$value['AsalDaerah']?>|<?=$value['Material']?>|<?=$value['Alamat']?>|<?=$value['Ukuran']?>|<?=$value['Jumlah']?>|<?=$value['NilaiPerolehan']?>" onchange="return AreAnyCheckboxesChecked();"></td>
										<td><?=$value['kodeKelompok']?></td>
										<td><?=$value['uraian']?></td>
										<td><?=$value['kodeLokasi']?></td>
										<td><?=$value['noRegister']?></td>
										<td><?=$value['Jumlah']?></td>
										<td><?=number_format($value['NilaiPerolehan'])?></td>
										<td><?=number_format($value['Jumlah']*$value['NilaiPerolehan'])?></td>
									</tr>
							<?php
									$total = $total + ($value['Jumlah']*$value['NilaiPerolehan']);
									$i++;
									}
								}	
							?>	
							
							</tbody>
							<tfoot>
								<tr>
									<th colspan="7">&nbsp;</th>
									<!-- <th><label id=""><?=number_format($total)?></label></th> -->
								</tr>
							</tfoot>
						</table>
					
						</div>
						<input type="hidden" name="kontrakid" value="<?=$_POST['kontrakid']?>">
						<input type="hidden" name="jenisaset" value="<?=$_POST['jenisaset']?>">
						</form>
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

