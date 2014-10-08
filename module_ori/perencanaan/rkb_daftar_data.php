<?php
include "../../config/config.php";
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
	$get_data_filter = $RETRIEVE->retrieve_rkb_filter(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
} else
		{
	    $sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
		$get_data_filter = $RETRIEVE->retrieve_rkb_filter(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
	    }  

	// echo '<pre>';	    
	// print_r($get_data_filter);
	// echo '</pre>';		
?>

<html>
		
	
			<?php
			include "$path/header.php";
			?>
		<body>
		<div id="content">
			<?php
			include "$path/title.php";
			include "$path/menu.php";
			?>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
				$('#example').dataTable( {
						"aaSorting": [[ 0, "asc" ]]
					} );
				} );
			</script>
			<div id="tengah1">	
				<div id="frame_tengah1">
					<div id="frame_gudang">
						<div id="topright">
							Buat Rencana Kebutuhan Barang
						</div>
						<div id="bottomright">
							
							<div>
								<table border=0 width="100%">
									<tr>
										<td>
											<strong><u>Filter data: Tidak ada filter (View seluruh data)</u> </strong>
										</td>
									</tr>
								</table>																						
							</div>
							
							<div>
								<table border=0 width=100%>
									<tr>		
										<td align=right>
											<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_import_data.php";?>">
											<input type="button" value="Tambah Data: Import" >
											<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_tambah_data.php";?>">
											<input type="button" value="Tambah Data: Manual" >
										</td>
									</tr>								
									<tr align=right>
										<td><a href="<?php echo"$url_rewrite/module/perencanaan/rkb_filter.php";?>">
											<input type="button" value="Kembali ke halaman utama : Form Filter" >
										</td>
									</tr>
									
								</table>
                            </div>
							<table border="0" width=100% >
								<td colspan ="2" align="right">
								<!--<input type="button" value="Prev" <?php //echo $disabled?> onclick="window.location.href='?pid=<?php //echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php //echo $disabled?> onclick="window.location.href='?pid=<?php //echo $_GET[pid] + 1; ?>'">-->
									<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
									<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
									<span><input type="button" value="<< Prev" class="buttonprev"/>
									Page
									<input type="button" value="Next >>" class="buttonnext"/></span>
								</td>

								</table>
							<div id="perencanaan_new">		
								<table cellpadding="0" cellspacing="0" border="1" class="display" id="example" width="100%">		
									<thead>
										<tr>
											<th align="center" colspan="4" class="style2">Daftar Rencana Kebutuhan Barang</th>
										</tr>
										<tr>
											<th align="center" colspan="4" class="style3">&nbsp;</th>
										</tr>
										<tr>
											<th width=3% align="center" class="style2">No</th>
											<th align="center" class="style2">Keterangan Jenis/Nama Barang</th>
											<th width=15% align="center" class="style2">Total Harga</th>
											<th width=13% align="center" class="style2">Tindakan</th>
										</tr>
										</thead>
										<tbody>
											<?php
												//mencek session
												//echo '<pre>';
												//print_r($_SESSION);
												//echo '</pre>';
												
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
										<tr>
											<td align="center" class="style5"><?php echo $no;?></td>
											<td align="center" class="style5">
												<table border=0 width=100%>
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
											<td align="center" class="style5"><?php echo number_format($hsl_data->NilaiAnggaran,2,',','.')?> </td>
											<td align="center" class="style5">
												<form method="POST" action="rkb_edit_data.php" onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->Kelompok_ID);?> ini ingin diedit?'); ">
													<input type="hidden" name="ID" value="<?php echo $hsl_data->Perencanaan_ID;?>" id="ID_<?php echo $i?>">
													<input type="submit" value="Edit" name="edit"/>
												</form>
												<form method="POST" action="rkb-proses.php"  onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->Kelompok_ID);?> ini ingin dihapus?'); ">
													<input type="hidden" name="ID" value="<?php echo $hsl_data->Perencanaan_ID;?>" id="ID_<?php echo $i?>">
													<input type="submit" value="Hapus" name="submit_hapus"/>
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
											<th colspan="4">Daftar Rencana Kebutuhan Barang</th>
										</tr>
									</tfoot>
								</table>
								<div class="spacer"></div>
								<!--<table border="0" width=100% >
								<td colspan ="2" align="right">
								<input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
								</td>

								</table>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

	
	<?php
	include "$path/footer.php";
	?>
	
	</body>
</html>	
