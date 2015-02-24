<?php
include "../../config/config.php";
$menu_id = 99;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

$RETRIEVE_PEROLEHAN = new RETRIEVE_PEROLEHAN;

$dataArr = $RETRIEVE_PEROLEHAN->get_diagnose($_GET);
// pr($dataArr);
?>
	
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Checker</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">PHP Checker</div>
				<div class="subtitle">Dont ever try without admin permission!!</div>
			</div>		

		<section class="formLegend">
		<div>
			
			<h4>ASET</h4>
			<table cellpadding="0" cellspacing="0" border="0" class="display">
				<thead>
					<tr>
						<th>Aset_ID</th>
						<th>Kode Kelompok</th>
						<th>Kode Satker</th>
						<th>Tahun</th>
						<th>TipeAset</th>
						<th>StatusValidasi</th>
						<th>StatusTampil</th>
						<th>Status_Validasi_Barang</th>
						<th>TglPembukuan</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($dataArr['aset']){
						foreach ($dataArr['aset'] as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td class="center"><?=$value['Aset_ID']?></td>
						<td class="center"><?=$value['kodeKelompok']?></td>
						<td class="center"><?=$value['kodeSatker']?></td>
						<td class="center"><?=$value['Tahun']?></td>
						<td class="center"><?=$value['TipeAset']?></td>
						<td class="center"><?=$value['StatusValidasi']?></td>
						<td class="center"><?=$value['StatusTampil']?></td>
						<td class="center"><?=$value['Status_Validasi_Barang']?></td>
						<td class="center"><?=$value['TglPembukuan']?></td>
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

			<h4><?=$_GET['tbl']?></h4>
			<table cellpadding="0" cellspacing="0" border="0" class="display">
				<thead>
					<tr>
						<th>Aset_ID</th>
						<th>KIB_ID</th>
						<th>StatusValidasi</th>
						<th>StatusTampil</th>
						<th>Status_Validasi_Barang</th>
						<th>TglPembukuan</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($dataArr['kib']){
						foreach ($dataArr['kib'] as $key => $value) {
								
				?>
					<tr class="gradeA">
						<td class="center"><?=$value['Aset_ID']?></td>
						<td class="center"><?=$value[ucfirst($_GET['tbl']).'_ID']?></td>
						<td class="center"><?=$value['StatusValidasi']?></td>
						<td class="center"><?=$value['StatusTampil']?></td>
						<td class="center"><?=$value['Status_Validasi_Barang']?></td>
						<td class="center"><?=$value['TglPembukuan']?></td>
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

			<h4>Log_<?=$_GET['tbl']?></h4>
			<table cellpadding="0" cellspacing="0" border="0" class="display">
				<thead>
					<tr>
						<th>Aset_ID</th>
						<th>KIB_ID</th>
						<th>StatusValidasi</th>
						<th>StatusTampil</th>
						<th>Status_Validasi_Barang</th>
						<th>TglPembukuan</th>
						<th>TglPerubahan</th>
						<th>Kd_Riwayat</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($dataArr['log']){
						foreach ($dataArr['log'] as $key => $value) {
								
				?>
					<tr class="gradeA">
						<td class="center"><?=$value['Aset_ID']?></td>
						<td class="center"><?=$value[ucfirst($_GET['tbl']).'_ID']?></td>
						<td class="center"><?=$value['StatusValidasi']?></td>
						<td class="center"><?=$value['StatusTampil']?></td>
						<td class="center"><?=$value['Status_Validasi_Barang']?></td>
						<td class="center"><?=$value['TglPembukuan']?></td>
						<td class="center"><?=$value['TglPerubahan']?></td>
						<td class="center"><?=$value['Kd_Riwayat']?></td>
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
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>


