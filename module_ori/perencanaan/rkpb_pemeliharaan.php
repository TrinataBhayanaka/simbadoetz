<?php
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['pemeliharaan']))
{
unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
$get_data_filter = $RETRIEVE->retrieve_rkpb_pemeliharaan(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
}

foreach ($get_data_filter as $key => $hsl_data)
//while($hsl_data=mysql_fetch_array($exec))
{
	$select_tahun	= $hsl_data->Tahun;
	$select_skpd	= $hsl_data->Satker_ID;
	$select_lokasi	= $hsl_data->Lokasi_ID;
	$select_njb		= $hsl_data->Kelompok_ID;
	$select_merk	= $hsl_data->Merk;
	$select_korek	= $hsl_data->KodeRekening;
	$select_jml		= $hsl_data->Kuantitas;
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
							Buat Rencana Kebutuhan Pemeliharaan Barang
						</div>
						
						<div id="bottomright">                                                                                                          
                            <div>
								<table border=0 width=100%>
									<tr>		
										<td width=50%></td>
										<td width=25% align="right">
											<a href="<?php echo"$url_rewrite/module/perencanaan/rkpb_tambah_data.php";?>">
											<input type="button" value="Kembali ke Halaman Sebelumnya" >
										</td>
									</tr>
								</table>
                            </div>
							
							<div>
								<!-- Form Pemeliharaan Data -->
								
								<form name="rkpb_pemeliharaan" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>rkpb-proses.php" method="post">
									<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
										<tr bgcolor="#004933">
											<td style="color:white;" colspan="2" align=left>
												Tambah Data Baru
											</td>
										</tr>
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Tahun</td>
											<td>
												<input style="width: 50px;" name="rkpb_add_thn" type="text" value="<?php echo $select_tahun; ?>" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">SKPD</td>
											<td>
												<input style="width: 300px;" name="rkpb_add_skpd" type="text" value="<?php echo show_skpd($select_skpd); ?>" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Lokasi</td>
											<td>
												<input style="width: 300px;" name="rkpb_add_lokasi" type="text" value="<?php echo show_lokasi($select_lokasi); ?>" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Nama/Jenis Barang</td>
											<td>
												<input style="width: 300px;" name="rkpb_add_njb" type="text" value="<?php echo show_kelompok($select_njb); ?>" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Merk/Tipe</td>
											<td>
												<input style="width: 300px;" name="rkpb_add_merk" type="text" value="<?php echo $select_merk; ?>" required="required" readonly="readonly"/>
											</td>
										</tr>									
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Kode Rekening</td>
											<td>
												<input style="width: 150px;" name="rkpb_add_korek" type="integer" value="<?php echo show_namarekening($select_korek); ?>" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Jumlah Barang Pada RKB</td>
											<td>
												<input style="width: 30px;" name="rkpb_add_jml" id="rkpb_add_jml" type="integer" value="<?php echo $select_jml; ?>" required="required" readonly="readonly"/>
											</td>
										</tr>

										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Harga Pemeliharaan</td>
											<td>
												<?php
												$query_shpb = "SELECT Pemeliharaan FROM StandarHarga WHERE Kelompok_ID=".$select_njb." AND Spesifikasi='".$select_merk."' ";
												$result		= mysql_query($query_shpb);
												if($result){
													$hasil		= mysql_fetch_array($result);
													echo "<input type=\"text\" id=\"rkpb_add_hrg\" value=\"{$hasil['Pemeliharaan']}\" readonly=\"readonly\"/>";
												}
												?>
											</td>
										</tr>
										<script>
										$( document ).ready(function() {
											var jml = $("#rkpb_add_jml").val();
											var harga = $("#rkpb_add_hrg").val();
											// var jml= document.getElementById("rkpb_add_jml").value;
											// var harga=document.getElementById("rkb_add_hrg").value;
											// console.log(jml);
											var total=jml*harga;
											// $('.rkpb_add_thrg').html(total);
											$('.rkpb_add_thrg').attr('value',total);
											// document.getElementById("rkpb_add_thrg").value=total;
											// console.log(total);
										});
										</script>
										<tr>
											<td width="25%" style="border: 1px solid #004933; color: black;">Total Harga Pemeliharaan</td>
											<td onload="total()">
												<input style="width: 150px;" name="rkpb_add_thrg" class="rkpb_add_thrg" type="integer" value="" required="required" readonly="readonly"/>
											</td>
										</tr>
										<tr>
											<td colspan=2 align="right" width="25%"  style="border: 1px solid #004933; color: black; ">
												<input type="hidden" name="ID" value="<?php echo $_POST['ID']?>">
												<input type="submit" name="submit_pem" value="Pelihara" onclick=""/>
												<!--<input type="reset" name="reset" value="reset" />-->
											</td>
										</tr>
									</table>
								</form>
										
							<!-- Akhir Form Tambah Data -->
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

