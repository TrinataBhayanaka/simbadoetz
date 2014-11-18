<?php
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['edit']))
{
unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
$get_data_filter = $RETRIEVE->retrieve_shpb_edit(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
}


//Mengambil data yang akan diedit
foreach ($get_data_filter as $key => $hsl_data)
//while($hsl_data=mysql_fetch_array($exec))
{

$select_njb	= $hsl_data->Kelompok_ID;
$select_mat	= $hsl_data->Merk;
$select_bhn	= $hsl_data->Spesifikasi;

$tanggal	= explode("-",$hsl_data->TglUpdate);
$select_tgl	= $tanggal[2]."/".$tanggal[1]."/".$tanggal[0];

$select_ket	= $hsl_data->Keterangan;
$select_hrg	= $hsl_data->NilaiStandar;
$select_pem	= $hsl_data->Pemeliharaan;

}
?>

<html>
	<?php
	include "$path/header.php";
	?>
	
		<!-- Script Tangggal -->
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
		<script>
			$(function()
			{
			$('#tanggal1').datepicker($.datepicker.regional['id']);
			$('#tanggal2').datepicker($.datepicker.regional['id']);
			$('#tanggal3').datepicker($.datepicker.regional['id']);
			$('#tanggal4').datepicker($.datepicker.regional['id']);
			$('#tanggal5').datepicker($.datepicker.regional['id']);
			$('#tanggal6').datepicker($.datepicker.regional['id']);
			$('#tanggal7').datepicker($.datepicker.regional['id']);
			$('#tanggal8').datepicker($.datepicker.regional['id']);
			$('#tanggal9').datepicker($.datepicker.regional['id']);
			$('#tanggal10').datepicker($.datepicker.regional['id']);
			$('#tanggal11').datepicker($.datepicker.regional['id']);
			$('#tanggal12').datepicker($.datepicker.regional['id']);
			$('#tanggal13').datepicker($.datepicker.regional['id']);
			$('#tanggal14').datepicker($.datepicker.regional['id']);
			$('#tanggal15').datepicker($.datepicker.regional['id']);
			}
			);
		</script>   
		<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
        <!-- Script Tangggal -->
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
							Buat Standar Harga Barang
						</div>
						<div id="bottomright">                                                                                                      
                            <div>
								<table border="0" width="100%">
									<tr>		
										<td width="50%"></td>
										<td width="25%" align="right">
											<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_daftar_data.php">
											<input type="button" value="Kembali ke Halaman Sebelumnya" >
										</td>
									</tr>
								</table>
                            </div>
                                                                                        
							<div id="perencanaan_new">
								
								<!-- Form Edit Data -->
								
								<form name="shbeditdata" method="POST" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb-proses.php" method="post">
									<table width="100%" class="style1">
										<!-- script untuk js table dropdown-->
										<script type="text/javascript" src="../../JS/tabel.js"></script> 
										<tr bgcolor="#004933">
											<td class="white" colspan="2" align=left>Tambah Data Baru</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Nama/Jenis Barang</td>
											<td>
												<input type="text" name="shb_edit_njb" id="shb_edit_njb" class="w450" value="<?php echo show_kelompok($select_njb); ?>" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td width="25%" class="style6">Merk/Tipe</td>
											<td><input class="w300" name="shb_edit_mat" id="shpb_edit_mat" type="text" value="<?php echo $select_mat; ?>" readonly="readonly"/></td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Tanggal</td>
											<td><input type="text"  style="text-align:center;" name="shpb_edit_tgl" value="<?php echo $select_tgl; ?>" id="tanggal12" readonly="readonly"/></td>
										</tr>
										<tr>
											<td width="25%" class="style6">Spesifikasi</td>
											<td><input class="w300" name="shb_edit_bhn" id="shpb_edit_bhn" type="text" value="<?php echo $select_bhn; ?>" readonly="readonly"/></td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Keterangan</td>
											<td><textarea rows="4" cols="100" name="shb_edit_ket" id="shpb_edit_ket" /><?php echo $select_ket; ?></textarea></td>
										</tr>
										<tr>
											<td width="25%" class="style6">Harga</td>
											<td><input class="w100" name="shb_edit_hrg" id="shpb_edit_hrg" type="integer" value="<?php echo number_format($select_hrg,2,',','.')?>" readonly="readonly"/></td>
										</tr>
										<tr>
											<td width="25%"  class="style6">Harga Pemeliharaan</td>
										<!--	<td><input style="width: 100px;" name="shpb_edit_pem" id="shpb_edit_pem" type="integer" value="<?php echo $select_pem; ?>" required="required" /></td> -->
											<script src="accounting.js"></script>
														<script type="text/javascript">
														function format_nilai(){
														
														var get_nilai = document.getElementById('shpb_edit_pem2');
														document.getElementById('shpb_edit_pem').value=get_nilai.value;
														nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
														get_nilai.value=nilai;
													}
																							</script>
													<td><input type="text" onchange="return format_nilai()"; name="shpb_edit_pem2" id="shpb_edit_pem2" required=" required"  value="<?php echo number_format($select_pem,2,',','.')?>"</td>
													
													<input type="hidden" name="shpb_edit_pem" id="shpb_edit_pem" value="<?php echo $select_pem; ?>" onload="return format_nilai();"> </td>  
										</tr>
										<tr>
											<td colspan=2 align="right" width="25%"  class="style6">
												<input type="hidden" name="ID" value="<?php echo $_POST['ID']?>">
												<input type="submit" name="submit_edit" value="Pelihara" onclick=""/>
												<input type="reset" name="reset" value="reset" />
											</td>
										</tr>
									</table>
								
								<!-- Akhir Form Tambah Data -->
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

