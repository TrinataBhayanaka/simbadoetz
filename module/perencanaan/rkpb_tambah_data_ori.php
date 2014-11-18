<?php
include "../../config/config.php";
$menu_id = 6;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
$get_data_filter = $RETRIEVE->retrieve_rkpb_tambah_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
?>

<html>
	<?php
	include "$path/header.php";
	?>
    
    <script>
        function konfirmasiEdit(StandarHarga_ID,NamaAset)
	{
                                    var StandarHarga_ID = StandarHarga_ID;
		var NamaAset = NamaAset;
		var jawab;
		                 
		jawab = confirm("Apakah data '"+NamaAset+"' akan di Buat Pemeliharaan?")
		if(jawab)
		{
			window.location = "shpb_edit_data.php?idubah="+StandarHarga_ID;
			return false;
		}else{
			alert("Proses data dibatalkan");
		}
	}
         function konfirmasiHapus(StandarHarga_ID,NamaAset)
	{
                                    var StandarHarga_ID = StandarHarga_ID;
		var NamaAset = NamaAset;
		var jawab;
		                 
		jawab = confirm("Apakah data '"+NamaAset+"' akan di Hapus?")
		if(jawab)
		{
			window.location = "idhapus="+StandarHarga_ID;
			return false;
		}else{
			alert("Penghapusan data dibatalkan");
		}
	}
     </script>
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
							Buat Rencana Kebutuhan Pemeliharaan Barang
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
									<tr align=right>
										<td><a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>rkpb_daftar_data.php">
										<input type="button" value="Kembali ke halaman daftar data" >
										</td>
									</tr>
									<tr>
										<td align=right>Waktu proses: 0.320detik. Jumlah - aset dalam 1 halaman</td>
									</tr>
								</table>
                            </div>
							<table border="0" width=100% >
								<td colspan ="2" align="right">
								<!--<input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">-->
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
											<th align="center" colspan="6" class="style2">Daftar Rencana Kebutuhan Pemeliharaan Barang</th>
										</tr>
										<tr>
											<th align="center" colspan="6" class="style3">&nbsp;</th>
										</tr>
										<tr>
											<th width=3% align="center" class="style2">No</th>
											<th align="center" class="style2">Keterangan Jenis/Nama Barang</th>
											<th width=13% align="center" class="style2">Tindakan</th>
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
										<tr>
											<td align="center" class="style4"><?php echo $no;?> </td>
											<td align="left" class="style4">
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
														<td>Jumlah Barang Berdasarkan RKB</td>
														<td><?php echo $hsl_data->Kuantitas;?></td>
													</tr>
													<tr>
														<td>Harga Pemeliharaan</td>
														<td>
															<?php
															$query_shpb = "SELECT Pemeliharaan FROM StandarHarga WHERE Kelompok_ID=".$hsl_data->Kelompok_ID." AND Spesifikasi='".$hsl_data->Merk."' ";
															$result		= mysql_query($query_shpb);
															if($result){
																$hasil		= mysql_fetch_array($result);
																echo $hasil['Pemeliharaan'];
															}
															?>
														</td>
													</tr>
												</table>
											</td>
											<td align="center" class="style5">										
												<form method="POST" action="rkpb_pemeliharaan.php" onsubmit="konfirmasi(this)">
													<input type="hidden" name="ID" value="<?php echo $hsl_data->Perencanaan_ID;?>" id="ID_<?php echo $i?>">
													<input type="submit" value="Tentukan Pemeliharaan" name="pemeliharaan"/>
												</form>
											</td>
										</tr>
											<?php  
											$no++;
											$pid++;
											}
											} ?>
									</tbody>
									<tfoot>
										<tr>
											<th colspan="4">Daftar Rencana Kebutuhan Pemeliharaan Barang</th>
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
