<?php
include "../../config/config.php";

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;

$menu_id = 5;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);


$paging = $LOAD_DATA->paging($_GET['pid']);	
if (isset($_POST['submit']))	
{
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	// $get_data_filter = $RETRIEVE->retrieve_rkb_filter(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
} else
		{
	    $sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
		// $get_data_filter = $RETRIEVE->retrieve_rkb_filter(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
	    }  

	// echo '<pre>';	    
	// print_r($get_data_filter);
	// echo '</pre>';	
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$data = $PEMANFAATAN->retrieve_rkb_filter($_POST,1);


			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Buat Rencana Kebutuhan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Rencana Kebutuhan Barang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_import_data.php";?>" class="btn">
								Tambah Data: Import</a>
								<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_tambah_data.php";?>" class="btn">
								Tambah Data: Manual</a>
							</li>
							<li>
								<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_filter.php";?>" class="btn">
									   Kembali ke halaman utama : Form Filter
								 </a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Keterangan Jenis/Nama Barang</th>
						<th>Total Harga</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
						if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
						if (!empty($get_data_filter))
						{
							$disabled = '';
						//$no = 1;
						$pid = 0;
						$check=0;
						
						foreach ($get_data_filter as $key => $hsl_data)

					//while($hsl_data=mysql_fetch_array($exec))
						{
				?>
						  
					<tr class="gradeA">
						<td><?php echo $no;?></td>
						<td>
							<table border="0" width=100%>
								<tr>
									<td width="20%">Tahun</td>
									<td><?php echo $hsl_data->Tahun;?></td>
								</tr>
								<tr>
									<td width="20%">SKPD</td>
									<td><?php echo show_skpd($hsl_data->Satker_ID);?></td>
								</tr>
								<tr>
									<td width="20%">Lokasi</td>
									<td><?php echo show_lokasi($hsl_data->Lokasi_ID);?></td>
								</tr>
								<tr>
									<td width="20%">Nama/Jenis Barang</td>
									<td><?php echo show_kelompok($hsl_data->Kelompok_ID);?></td>
								</tr>
								<tr>
									<td width="20%">Spesifikasi</td>
									<td><?php echo $hsl_data->Merk;?></td>
								</tr>
								<tr>
									<td>Kode Rekening</td>
									<td>[<?php echo show_koderekening($hsl_data->KodeRekening);?>]-<?php echo show_namarekening($hsl_data->KodeRekening);?></td>
								</tr>
								<tr>
									<td>Jumlah Barang</td>
									<td><?php echo $hsl_data->Kuantitas;?></td>
								</tr>
								<tr>
									<td>Harga</td>
											<td>
									<?php
									$query_shpb = "SELECT NilaiStandar FROM StandarHarga WHERE Kelompok_ID IN (".$hsl_data->Kelompok_ID.") AND TglUpdate LIKE '%".$hsl_data->Tahun."%' ";
									//print_r($query_shpb);
									$result		= mysql_query($query_shpb);
									if($result){
										$hasil		= mysql_fetch_array($result);
										 //echo $hasil['NilaiStandar']; 
										 
									echo number_format($hasil['NilaiStandar'],2,',','.');
									 
										
									}
									?>
									</td>
								</tr>
							</table>
						</td>
						<td><?php echo number_format($hsl_data->NilaiAnggaran,2,',','.')?></td>
						<td>	
						<form method="POST" action="rkb_edit_data.php" onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->Kelompok_ID);?> ini ingin diedit?'); ">
							<input type="hidden" name="ID" value="<?php echo $hsl_data->Perencanaan_ID;?>" id="ID_<?php echo $i?>">
							<input type="submit" value="Edit" class="btn btn-success" name="edit"/>
						</form>
						<form method="POST" action="rkb-proses.php"  onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->Kelompok_ID);?> ini ingin dihapus?'); ">
							<input type="hidden" name="ID" value="<?php echo $hsl_data->Perencanaan_ID;?>" id="ID_<?php echo $i?>">
							<input type="submit" value="Hapus" class="btn btn-danger" name="submit_hapus"/>
						</form>
						</td>
					</tr>
					
				     <?php
						$no++;
						$pid++;
					 }
				}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>