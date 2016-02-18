<?php
include "../../config/config.php";
$menu_id = 15;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_searchAsetDist_detail($_GET);
// pr($get_data_filter);
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
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Distribusi Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Detail Daftar Aset</div>
				<div class="subtitle">Pilih Aset Untuk Distribusi</div>
			</div>	

		<section class="formLegend">
		
		<div style="height:5px;width:100%;clear:both"></div>	
		<form action="" method=POST name="checks" ID="Form2">

			<div id="demo">
				
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="example">
				<thead>
					<tr>
						<th>Noreg</th>
						<th>Tahun</th>
						<th>Kode Kelompok</th>
						<th>Nama Barang</th>
						<th>Kode Lokasi</th>
						<th>Nilai Perolehan</th>
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
							<td width="2%"><?=$value['noRegister']?></td>
							<td><?=$value['Tahun']?></td>
							<td><?=$value['kodeKelompok']?></td>
							<td><?=$value['uraian']?></td>
							<td><?=$value['kodeLokasi']?></td>
							<td><?=number_format($value['NilaiPerolehan'])?></td>
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
			</form>
			<div class="spacer"></div>
			    
		</section> 
		       
	</section>
	
<?php
	include"$path/footer.php";
?>