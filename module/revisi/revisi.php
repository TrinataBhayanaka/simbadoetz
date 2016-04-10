<?php
include "../../config/config.php";
// $menu_id = 66;
$menu_id = 72;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$data= $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
// pr($Session);
if($Session['ses_uaksesadmin'] == 1){
	$param = "";
}else{
	$param = $Session['ses_satkerkode'];
}
$get_data_penyusutan= $PENYUSUTAN->getStatusPenyusutansatker_berjalan($param);
//echo "masukk gak";
// echo "<pre>";
// print_r($get_data_penyusutan);
// pr($get_data_penyusutan);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>

<section id="main">
	<ul class="breadcrumb">
	  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
	  <li><a href="#">Revisi Log-Kapitalisasi, Penghapusan Sebagian, dan </a><span class="divider"><b>&raquo;</b></span></li>
	  <li class="active">revisi</li>
	  <?php SignInOut();?>
	</ul>
	<div class="breadcrumb">
		<div class="title">Revisi Log Kapitalisasi</div>
		<div class="subtitle">Daftar Aset</div>
	</div>	

	<section class="formLegend">
		
		<!-- <a class="btn btn-danger btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Kontrak Simral</a>
		&nbsp; --></p>	
		<div id="demo">
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
				<tr>
					<th>No</th>
					<th>Satuan Kerja</th>
					<th>Kelompok Aset</th>
					<th>Tahun Berjalan</th>
					<th>Status Penyusutan</th>
					<th>Status Revisi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>	
			<?php
			// echo "<pre>";
			// print_r($get_data_penyusutan);
			if($get_data_penyusutan){
				$no = 1;
				foreach($get_data_penyusutan as $val){
				// pr($val[UserNm]);
				$text_status=array("0"=>"Belum disusutkan",
							  "1"=>"Sedang disusutkan",
							  "2"=>"Telah disusutkan");
				$text_revisi=array("0"=>"Belum revisi",
							  "1"=>"Sedang revisi",
							  "2"=>"Telah revisi");
				

				$namaSatker = $PENYUSUTAN->getNamaSatkercustome($val[kodeSatker]);
				/*$namaSatker = $PENYUSUTAN->getNamaSatkercustome($val[UserNm]);*/
				if($namaSatker){
					$ketNamaSatker = $namaSatker[0]['NamaSatker']." "."[".$namaSatker[0]['kode']."]";
				}
			?>
			<tr class="gradeA">
				<td><?=$no?></td>
				<td><?=$ketNamaSatker?></td>
				<td><?=$val['KelompokAset']?></td>
				<td><?=$val['Tahun']?></td>
				<td><?=$text_status[$val['StatusRunning']]?></td>
				<td><?=$text_revisi[$val['status_revisi']]?></td>
				<td>
			<?php
			if($Session['ses_uaksesadmin'] == 1){
				if($val['StatusRunning']==0 &&$val['status_revisi']==0)
			
					echo "<a href=\"running_revisi.php?id={$val['id']}\" class=\"btn btn-warning\">Lakukan Revisi</a>";
		
			}
			 ?></td>
			</tr>
				<?php
					$no++;
				}
			}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="6">&nbsp;</th>
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