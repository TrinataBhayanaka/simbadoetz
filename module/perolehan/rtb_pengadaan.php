<?php
include "../../config/config.php";
$menu_id = 7;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

	$paging = $LOAD_DATA->paging($_GET['pid']);

if (isset($_POST['submit']))	
{
//echo "<pre>";
//print_r($hsl_data);
//echo "</pre>";
// echo "masukk";
unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
$get_data_filter = $RETRIEVE->retrieve_rtb_filter(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));

	    
}else
		{
		// echo "masukk";
	    $sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
		$get_data_filter = $RETRIEVE->retrieve_rtb_filter(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));
	    }

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
			<div id="tengah1">	
				<div id="frame_tengah1">
					<div id="frame_gudang">
						
						<div id="topright">
							Rencana Tahunan Barang
						</div>
							
						<div id="bottomright">
							<div>                                                                                                                       
                            </div>
							
							<div>
								<table border=0 width=100%>
									<tr align=right>
										<td>
											<a href="<?php echo "$url_rewrite/module/perolehan/"; ?>pengadaan.php">
											<input type="button" value="Kembali ke halaman utama : Form Filter" >
										</td>
									</tr>
									<tr>
										<td align=right>&nbsp;</td>
									</tr>
								</table>
								<table border="0" width=100% >
								<td colspan ="2" align="right">
								<input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
								</td>

								</table>
								<form method="POST" action="perolehan_pengadaan.php" onsubmit="return confirm('Lakukan Pengadaan Dari Data RTB ?'); ">
								<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
									<tbody>
										<tr>
											<th align="center" colspan="7" style="background-color:#004933; color:white; border:1px solid rgb(153,153,204); padding:2px 3px;">Daftar Rencana Tahunan Barang</th>
										</tr>
										<tr>
											<th align="right" colspan="7" style="background-color:"white"; color:white; border:1px solid rgb(153,153,204); padding:2px 3px;">&nbsp;</th>
										</tr>
										<tr>
											<th width=3% align="center" style="background-color:#004933; color:white; border:1px solid rgb(153,153,204); padding:2px 3px;">No</th>
											
											<th width=50% align="center" style="background-color:#004933; color:white; border:1px solid rgb(153,153,204); padding:2px 3px;">Keterangan Jenis/Nama Barang</th>
											<th align="center" style="background-color:#004933; color:white; border:1px solid rgb(153,153,204); padding:2px 3px;">Total Harga</th>
											<th align="center" style="background-color:#004933; color:white; border:1px solid rgb(153,153,204); padding:2px 3px;">Aksi</th>
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
											<td align="center" style="border: 1px solid #004933; height:100px; color: black;"><?php echo $no;?></td>
											
											<td align="center" style="border: 1px solid #004933; height:100px; color: black;">
												<table border=0 width=100%>
													<tr>
														<td width="30%">Tahun</td>
														<td><?php echo $hsl_data->Tahun;?></td>
													</tr>
													<tr>
														<td>SKPD</td>
														<td><?php echo show_skpd($hsl_data->Satker_ID);?></td>
													</tr>
													<tr>
														<td>Lokasi</td>
														<td><?php echo show_lokasi($hsl_data->Lokasi_ID);?></td>
													</tr>
													<tr>
														<td>Nama/Jenis Barang</td>
														<td><?php echo show_kelompok($hsl_data->Kelompok_ID);?></td>
													</tr>
													<tr>
														<td>Merk</td>
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
														<td>Standar Harga Barang</td>
														<td>
														<?php
															$query_shpb = "SELECT NilaiStandar FROM StandarHarga WHERE Kelompok_ID=".$hsl_data->Kelompok_ID." AND Merk='".$hsl_data->Merk."' ";
															//print_r($query_shpb);
															$result		= mysql_query($query_shpb);
															if($result){
																$hasil		= mysql_fetch_array($result);
																echo $hasil['NilaiStandar'];
															}
														?>
														</td>
													</tr>
												</table>
											</td>
											<td align="center" style="border: 1px solid #004933; height:100px; color: black;"><?php echo $hsl_data->NilaiAnggaran?> </td>
											<td align="center" style="border: 1px solid #004933; height:100px; color: black;">
												<a href='perolehan_pengadaan.php?id=<?php echo $hsl_data->Perencanaan_ID?>'><input type="button" value="Pengadaan RTB" > </a>
												
											</td>
											
										</tr>
										<?php 
										$no++;
										$pid++;
										}
										} ?>
									</tbody>
								</table>   
								
								<table border="0" width=100% >
								<td colspan ="2" align="right">
								<input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
								</td>

								</table>
								</form>
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
