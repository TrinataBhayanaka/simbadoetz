<?php
include "../../config/config.php";
$menu_id = 5;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$idubah=$_POST['ID'];

if (isset($_POST['edit']))
	    {
			
		unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
						
		// parameter yang dimasukan adalah menuID, type, post dan paging
		$get_data_filter = $RETRIEVE->retrieve_rkb_edit(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
		
	    }

foreach ($get_data_filter as $key => $hsl_data)

//while($hsl_data=mysql_fetch_array($exec))
{
	$select_tahun	= $hsl_data->Tahun;
	$select_skpd	= $hsl_data->Satker_ID;
	$select_lokasi	= $hsl_data->Lokasi_ID;
	$select_njb		= $hsl_data->Kelompok_ID;
	$select_merk	= $hsl_data->Merk;
	$select_korek	= $hsl_dataKodeRekening;
	$select_jml		= $hsl_data->Kuantitas;
	$Pemeliharaan 	= $hsl_data->Pemeliharaan ;
	$select_thrg	= $hsl_data->NilaiAnggaran;
}
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
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
		
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_radio.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/tabel.js"></script>
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Rencana Kebutuhan Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Rencana Kebutuhan Barang</div>
			<div class="subtitle">Edit Data</div>
		</div><section class="formLegend">
			
			<div class="detailright">
				<a href="<?php echo"$url_rewrite/module/perencanaan/rkb_daftar_data.php";?>" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form name="rkbeditdata" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>rkb-proses.php" method="post">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<input class="span1" name="rkb_edit_tahun" id="tahun_id" type="text" value="<?php echo $select_tahun; ?>" required="required" />
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									<input class="span5" name="rkb_edit_skpd" id="rkb_edit_skpd" type="text" value="<?php echo show_skpd($select_skpd); ?>" required="required" readonly="readonly"/>
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											//include "$path/function/dropdown/radio_function_skpd.php";
											$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
											js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"rkb_edit_skpd","skpd_id",'skpd','rkbskpdedit');
											$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radioskpd($style2,"skpd_id",'skpd',"rkbskpdedit|$select_skpd");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input class="span5" name="rkb_edit_lokasi" id="rkb_edit_lokasi" type="text" value="<?php echo show_lokasi($select_lokasi); ?>" required="required" readonly="readonly"/>
									<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_edit_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input class="span5" name="rkb_edit_njb" id="rkb_edit_njb" type="text" value="<?php echo show_kelompok($select_njb); ?>" required="required" readonly="readonly"/>
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"rkb_edit_njb","kelompok_id",'kelompok','rkbkelompokedit');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok',"rkbkelompokedit|$select_njb");
										?>
									</div>
								</div>
							</li>
							
									<script>
											function get_data_merek(kelompok,tahun,data){
											var nilai_kelompok=document.getElementById(kelompok).value;
											var tahun=document.getElementById(tahun).value;
											url="<?php echo $url_rewrite?>/module/perencanaan/api_merek.php?kelompok="+nilai_kelompok+"&tahun="+tahun;
											//alert(url);
											ambilData(url,data);
											
											}
										</script>
										
							<li>
								<span class="span2">Spesifikasi</span>
								<input name="button" name="Show Merek" type="button" value="Show Spesifikasi" onclick="get_data_merek('kelompok_id','tahun_id','isi_merek');" />
								
									<div id='isi_merek'>
									<span class="span2">&nbsp;</span>
									<?php
										$query_merek="select Spesifikasi from StandarHarga where Kelompok_ID='$select_njb' and TglUpdate like '$select_tahun%'";//print_r($query_merek);													
										$result_merek=mysql_query($query_merek)or die(mysql_error()); 	
										echo "<select name='Merek' onClick=\"get_data_hrg(this,'kelompok_id','rkb_add_hrg')\">";
										echo "<option value=''>--None--</option>";
										while ($row=mysql_fetch_object($result_merek)){
										$merk=$row->Spesifikasi;
										if($merk==$select_merk)
											echo "<option value='$merk' selected>$merk</option>";
										else
											echo "<option value='$merk'>$merk</option>";	
										}
										echo "</select>";
									?>
												</div>
							</li>
						</ul>
										<script>
											function get_data_skb(skpd,lokasi,kelompok,here,data,tahun){
											var tahun = document.getElementById(tahun).value;
											var nilai_skpd=document.getElementById(skpd).value;
											var nilai_lokasi=document.getElementById(lokasi).value;
											var nilai_kelompok=document.getElementById(kelompok).value;
											showSpoiler(here);
											url="<?php echo $url_rewrite?>/module/perencanaan/api_rkb.php?skpd="+nilai_skpd+"&lokasi="+nilai_lokasi+"&kelompok="+nilai_kelompok+"&tahun="+tahun;	
											//alert(url);
											ambilDataPenerimaan(url,data);
											}
											
										</script>
										
										<script>
										function get_data_hrg(id,kelompok,harga,tahun){
											var tahun = document.getElementById(tahun).value;
											var spesifikasi	= id.value;
											var nilai_kelompok=document.getElementById(kelompok).value;
											url="<?php echo $url_rewrite?>/module/perencanaan/api_hrg.php?spesifikasi="+spesifikasi+"&kelompok="+nilai_kelompok+"&tahun="+tahun;
											ambilDataPenerimaan(url,harga);
											
										}
										</script>
							<br/>
							<ul>
								<li>
								<span class="span1">&nbsp;</span>
														<input type="button" value="View Detail" onclick="get_data_skb('skpd_id','lokasi_id','kelompok_id',this,'rkb_edit_jbskb|rkb_edit_jbbi|rkb_rkba','tahun_id');" style="vertical-align:middle" />
													<div style="display: none;">

															<table width="100%" class="style1">
																<tbody>
																	<tr>
																		<td width="25%">Jumlah berdasarkan Standar Kebutuhan Barang</td>
																		<td>
																			<input class="w30" name="rkb_edit_jbskb" id="rkb_edit_jbskb" type="integer" value="" readonly="readonly"/>
																		</td>
																	</tr>
																	<tr>
																		<td width="25%">Jumlah berdasarkan Buku Inventaris</td>
																		<td>
																			<input class="w30" name="rkb_edit_jbbi" id="rkb_edit_jbbi" type="integer" value="" readonly="readonly"/>
																		</td>
																	</tr>
																	<tr>
																		<td width="25%">RKB yang dianjurkan yaitu <=</td>
																		<td>
																			<input class="w30" name="rkb_rkba" id="rkb_rkba" type="integer" value="" readonly="readonly"/>
																		</td>
																	</tr>
																</tbody>
															</table>

														</div>
								</li>
							</ul>
							<ul>
							<li>
								<span class="span2">Kode Rekening</span>
								<div class="input-append">
									<input class="span5" name="rkb_edit_rekening" id="rkb_edit_rekening" type="text" value="<?php echo show_namarekening($select_korek); ?>" required="required" readonly="readonly" />
									<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_rekening="$url_rewrite/function/dropdown/radio_simpul_rekening.php";
											$alamat_search_rekening="$url_rewrite/function/dropdown/radio_search_rekening.php";
											js_radiorekening($alamat_simpul_rekening, $alamat_search_rekening,"rkb_edit_rekening","rekening_id",'rekening','rek');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiorekening($style1,"rekening_id",'rekening',"rek|$select_korek");
										?>
									</div>
								</div>
							</li>
								
							<li>
								<span class="span2">Jumlah Barang</span>
								<input class="span1" name="rkb_edit_jml" id="rkb_edit_jml" type="text" value="<?php echo $select_jml; ?>" required="required" onchange="total();"/>
							</li>	
								<script>
										function total(){
										var jml= document.getElementById("rkb_add_jml").value;
										var harga=document.getElementById("rkb_add_hrg").value;
										var total=jml*harga;
										document.getElementById("rkb_add_thrg").value=total;
										}
								</script>
							<li>
								<span class="span2">Harga</span>				
								<input class="span2" name="rkb_edit_hrg" id="rkb_add_hrg" type="text" value="" required="required" readonly="readonly" onchange="total();"/>
							</li>
											
								<script src="accounting.js"></script>
								<script type="text/javascript">
										function format_nilai(){
										
										var get_nilai = document.getElementById('rkb_edit_thrg2');
										document.getElementById('rkb_edit_thrg').value=get_nilai.value;
										nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
										get_nilai.value=nilai;
									}
								</script>
							<li>
								<span class="span2">Total Harga</span>				
								<input type="text" onchange="return format_nilai();" name="rkb_edit_thrg2" id="rkb_edit_thrg2" required=" required"  class="span2" value="<?php echo number_format($select_thrg,2,',','.')?>" />
								<input type="hidden" name="rkb_edit_thrg" id="rkb_edit_thrg" value="<?php echo $select_thrg; ?>" onload="return format_nilai();"> 
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="hidden" name="ID" value="<?php echo $_POST['ID']?>">
								<input type="submit" name="submit_edit" class="btn btn-primary" value="Edit" onclick=""/>
								<input type="reset" name="reset" class="btn" value="reset" />
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>