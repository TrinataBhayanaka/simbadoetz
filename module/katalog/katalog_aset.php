<?php
include "../../config/config.php";
$menu_id = 51;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

            
            
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Katalog Aset</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Katalog Aset</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Katalog Aset</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form method="POST" action="<?php echo "$url_rewrite"?>/module/katalog/katalog_aset_informasi.php?pid=1" 
              name="katalog">
			<ul>
							<li>
								<span class="span2">ID Aset (System ID)</span>
								<input isdatepicker="true" style="width: 270px;" name="ka_id_aset" id="ka_id_aset" type="text">
							</li>
							<li>
								<span class="span2">Nama Aset</span>
								<input isdatepicker="true" style="width: 270px;" name="ka_nama_aset" id="ka_nama_aset" type="text">
							</li>
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input isdatepicker="true" style="width: 270px;" name="ka_no_kontrak" id="ka_no_kontrak" type="text">
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input isdatepicker="true" style="width: 90px;" name="ka_thn_perolehan" id="ka_thn_perolehan" maxlength="4" type="text">
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
									<input type="text" name="lda_kelompok" id="lda_kelompok" style="width:480px;"readonly="readonly"  placeholder="(Semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok', 'kelompk');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id",'kelompok', 'kelompk');
									?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									  <input type="text" name="entri_lokasi" id="entri_lokasi" style="width:480px;" readonly="readonly" placeholder="(Semua Lokasi)">
										<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
											<?php
										   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";
											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"entri_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
											?>
										</div>    
								</div>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									 <input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="(Semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">

											<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
												   
										   <?php
												$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
												$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
												js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd1','sk');
												$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
												radioskpd($style2,"skpd_id",'skpd1','sk');
											?>  
										   
									</div>
								</div>
								</div>
							</li>
							<li>
								<span class="span2">NGO</span>
								<div class="input-append">
									 <input type="hidden" name="idgetkelompok" id="idgetkelompok" placeholder="(Semua SKPD)">
										<input type="text" name="lda_ngo" id="lda_ngo"style="width:480px;"readonly="readonly"value="(semua NGO)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih"onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
											<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
												
												<?php
												$alamat_simpul_ngo="$url_rewrite/function/dropdown/radio_simpul_ngo.php";
												$alamat_search_ngo="$url_rewrite/function/dropdown/radio_search_ngo.php";
												js_radiongo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo","ngo_id",'ngo', 'ngo1');
												$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
												radiongo($style,"ngo_id",'ngo', 'ngo1');
											?>			
											
											</div>

										</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" onclick="show_confirm()" class="btn btn-primary" value="Lanjut" />
							</li>
						</ul>
						<table border="0" cellspacing="6" style="display: none">
                                                <tr>
                                                    <td>Desa</td>
                                                    <td>Kecamatan</td> 
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_desa" name="p_desa" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan" name="p_kecamatan" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten" name="p_kabupaten" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi" name="p_provinsi" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
						</form>
			
		</section>     
	</section>
	<script type="text/javascript">
                    function show_confirm()
                    {
                    var r=confirm("Tidak ada data yang dijadikan filter. Seluruh isian filter kosong");
                    if (r==true)
                            {
                                //document.location="katalog_aset_informasi.php";
                                //alert("Dokumen telah dicetak");
                                document.forms[0].submit();

                            }
                            else
                            {
                                document.location="katalog_aset.php";
                                //alert("Batal cetak dokumen");
                            }
                    }
                    </script>
<?php
	include"$path/footer.php";
?>