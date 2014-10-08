<?php
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);

$get_data_filter = $RETRIEVE->retrieve_shpb_tambah_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));
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
		
			<div id="tengah1">	
				<div id="frame_tengah1">
					<div id="frame_gudang">
						
						<div id="topright">
							Buat Standar Harga Pemeliharaan
						</div>
						
						<div id="bottomright">
							<div>
								<table border="0" width="100%">
									<tr>
										<td>
										<strong><u>Filter data: Tidak ada filter (View seluruh data)</u> </strong>
										</td>
									</tr>
                                </table>                                                                                         
                            </div>
							
							<div>
								<table border="0" width="100%">
									<tr align="right">
										<td><a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_daftar_data.php">
										<input type="button" value="Kembali ke halaman daftar data" >
										</td>
									</tr>
									
								</table>
                            </div>
							<table border="0" width="100%" >
								<td colspan ="2" align="right">
								<input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
								</td>

								</table>
							<div id="perencanaan_new">		
							
								<table width="100%" class="style1">
									<tbody>
										<tr>
											<th align="center" colspan="6" class="style2">Daftar Standar Harga Barang</th>
										</tr>
										<tr>
											<th align="center" colspan="6" class="style3">&nbsp;</th>
										</tr>
										<tr>
											<th width="3%" align="center" class="style2">No</th>
											<th align="center" class="style2">Keterangan Jenis/Nama Barang</th>
											<th width="13%" align="center" class="style2">Tindakan</th>
										</tr>
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
												<table align="center" width="100%">
													<tr>
														<td width="20%">Nama/Jenis Barang</td>
														<td><?php echo show_kelompok($hsl_data->Kelompok_ID);?></td>
													</tr>
													<tr>
														<td>Merk/Tipe</td>
														<td><?php echo $hsl_data->Merk;?></td>
													</tr>
													<tr>
														<td width="20%">Tanggal</td>
														<td>
														<?php 
														$tanggal=explode("-",$hsl_data->TglUpdate);
														$tgl=$tanggal[2]."/".$tanggal[1]."/".$tanggal[0];
														echo $tgl;
														?>		
														</td>
													</tr>
													<tr>
														<td>Spesifikasi</td>
														<td><?php echo $hsl_data->Spesifikasi;?></td>
													</tr>
													<tr>
														<td>Satuan</td>
														<td><?php echo $hsl_data->Satuan;?></td>
													</tr>
													<tr>
														<td>Keterangan</td>
														<td><?php echo $hsl_data->Keterangan;?></td>
													</tr>
													<tr>
														<td>Standar Harga</td>
														<td><?php echo number_format($hsl_data->NilaiStandar,2,',','.')?></td>
													</tr>
												</table>
											</td>
											<td align="center" class="style5">										
												<form method="POST" action="shpb_pemeliharaan.php?pid=1" onsubmit="konfirmasi(this)">
													<input type="hidden" name="ID" value="<?php echo $hsl_data->StandarHarga_ID;?>" id="ID_<?php echo $i?>">
													<input type="submit" value="Tentukan Pemeliharaan" name="pemeliharaan"/>
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
								</table>
								
								<?php
									
                                    echo "<center>";
                                 ?>
                                    <table border="0" width=100% >
								<td colspan ="2" align="right">
								<input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
								</td>

								</table>
                                    <?php
                                    echo "</center>"; 
                                    ?>
								
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
