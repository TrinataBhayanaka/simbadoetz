<?php
include "../../config/config.php";


$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 50;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$resetDataView = $DBVAR->is_table_exists('penilaian_'.$SessionUser['ses_uoperatorid'], 0);

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Penilaian</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Entri Hasil Penilaian</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Entri Hasil Penilaian</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
		
		<form method="POST" action="<?php echo "$url_rewrite"?>/module/penilaian/entri_penilaian_daftar.php?pid=1" name="penilaian">
			<ul>
							<li>
								<span class="span2">ID Aset (System ID)</span>
								<input type='text'  name='pen_ID_aset' style="width: 200px;"/>
							</li>
							<li>
								<span class="span2">Nama Aset</span>
								<input type='text' name='pen_nama_aset'style="width: 480px;" />
							</li>
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input type='text' name='pen_nomor_kontrak' style="width: 200px;"/>
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input type='text' name='pen_tahun_perolehan'/>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
										 <input type="text" name="pem_kelompok" id="pem_kelompok" style="width:450px;" readonly="readonly" value="">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
												<?php
													//include "$path/function/dropdown/function_kelompok.php";
													$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
													$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
													js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"pem_kelompok","kelompok_id",'kelompok','pemkelompokfilter');
													$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radiokelompok($style,"kelompok_id",'kelompok','pemkelompokfilter');
			?>
                        </div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									    <input type="text" name="pem_lokasi" id="pem_lokasi" style="width:450px;" readonly="readonly" value="">
								 <input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
											
														<?php
													   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
														$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
														$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

														js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"pem_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
														$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
			?> 
        
                </div>
								</div>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									<input type="text" name="pem_skpd" id="pem_skpd" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
												
												<?php
													//include "$path/function/dropdown/function_skpd.php";
													$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
													$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
													js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"pem_skpd","skpd_id",'skpd','pemskpdfilter');
													$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radioskpd($style2,"skpd_id",'skpd','pemskpdfilter');
			?>  
                       
            </div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Lanjut" />
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
	
<?php
	include"$path/footer.php";
?>