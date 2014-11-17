<?php
include "../../config/config.php";
$menu_id = 4;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
if (isset($_POST['submit']))
{
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	
	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	$get_data_filter = $RETRIEVE->retrieve_skb_filter(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
} else {
		$sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
		$get_data_filter = $RETRIEVE->retrieve_skb_filter(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
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
							Buat Standar Kebutuhan Barang
						</div>
						
						<div id="bottomright">
							<div>
								<table>
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
											<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb_tambah_data.php">
											<input type="button" value="Tambah Data" >
										</td>
									</tr>
									
									<tr align=right>
										<td><a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb_filter.php">
											<input type="button" value="Kembali ke halaman utama : Form Filter" >
										</td>
									</tr>
									
								</table>
                            </div>
							<table border="0" width=100% >
								<td colspan ="2" align="right">
								<!--<input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
								<input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
								echo $_GET[pid] + 1; ?>'">-->
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
											<th align="center" colspan="7" class="style2">Daftar Standar Kebutuhan Barang</th>
										</tr>
										<tr>
											<th align="center" colspan="7" class="style3">&nbsp;</th>
										</tr>
										<tr>
											<th width=3% align="center" class="style2">No</th>
											<th align="center" class="style2">Nama/Jenis Barang</th>
											<th width=15% align="center" class="style2">SKPD</th>
											<th width=15% align="center" class="style2">Lokasi</th>
											<th width=15% align="center" class="style2">Tanggal</th>
											<th width=15% align="center" class="style2">Jumlah Barang</th>
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
											<td align="center" class="style6"><?php echo $no;?> </td>
											<td align="center" class="style6"><?php echo show_kelompok($hsl_data->skb_njb);?></td>
											<td align="center" class="style6"><?php echo show_skpd($hsl_data->skb_skpd);?></td>
											<td align="center" class="style6"><?php echo show_lokasi($hsl_data->skb_lokasi);?></td>
											<td align="center" class="style6">
												<?php
												$tanggal=explode("-",$hsl_data->skb_tgl);
												$tgl=$tanggal[2]."/".$tanggal[1]."/".$tanggal[0];
												echo $tgl;
												?>
											</td>
											<td align="center" class="style6"><?php echo $hsl_data->skb_jml;?></td>
											<td align="center" class="style6">
												<form method="POST" action="skb_edit_data.php" onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->skb_njb);?> ini ingin diedit?'); ">
													<input type="hidden" name="ID" value="<?php echo $hsl_data->skb_id;?>" id="ID_<?php echo $i?>">
													<input type="submit" value="Edit" name="edit"/>
												</form>
												<form method="POST" action="skb-proses.php" onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->skb_njb);?> ini ingin dihapus?'); ">
													<input type="hidden" name="ID" value="<?php echo $hsl_data->skb_id;?>" id="ID_<?php echo $i?>">
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
											<th colspan="7">Daftar Standar Kebutuhan Barang</th>
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
