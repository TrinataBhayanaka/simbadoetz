<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_searchAset($_POST,$_SESSION['ses_satkerkode']);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
?>
	<!-- SQL Sementara -->
	
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Pilih Aset Untuk Rubah Status</div>
			</div>	

		<section class="formLegend">
			
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Kelompok</th>
						<th>Nama Barang</th>
						<th>Kode Lokasi</th>
						<th>NoReg</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($get_data_filter)
					{
						$i = 1;
						foreach ($get_data_filter as $key => $value) {
				?>
						<tr class="gradeA">
							<td><?=$i?></td>
							<td><?=$value['kodeKelompok']?></td>
							<td><?=$value['uraian']?></td>
							<td><?=$value['kodeLokasi']?></td>
							<td><?=$value['noRegister']?></td>
							<td><?=number_format($value['NilaiPerolehan'])?></td>
							<td class="center"><a href="kontrak_rincianedit.php?id=<?=$_GET['id']?>&idaset=<?=$value['Aset_ID']?>&noreg=<?=$value['noRegister']?>&tipeaset=<?=$value['tabel']?>" class="btn btn-success btn-small"><i class="icon-edit icon-white"></i>&nbsp;Pilih</a></td>
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