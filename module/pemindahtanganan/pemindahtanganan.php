<?php
include "../../config/config.php";



$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$menu_id = 42;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$resetDataView = $DBVAR->is_table_exists('pemindahtanganan_'.$SessionUser['ses_uoperatorid'], 0);

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemindahatanganan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active"> Buat Usulan pemindahtanganan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Usulan pemindahtanganan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			 <form method="POST" action="<?php echo "$url_rewrite";?>/module/pemindahtanganan/daftar_pemindahtanganan_barang.php?pid=1"  name="usulan_pemindahtanganan" >
			<ul>
							<li>
								<span class="span2">ID Aset (System ID)</span>
								<input type="text" name="bupt_idaset" placeholder="" style="width:200px;" class="aset_id">
							</li>
							<li>
								<span class="span2">Nama Aset</span>
								<input type="text" name="bupt_namaaset" placeholder="" style="width:450px;" class="aset_name">
							</li>
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input type="text" name="bupt_nokontrak" placeholder="" style="width:200px;" class="no_kontrak">
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input type="text" name="bupt_tahun" placeholder="" style="width:130px;" class="thn_perolehan">
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
										 <input type="text" name="lda_kelompok" id="lda_kelompok" class="span5" readonly="readonly" placeholder="">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
														
														<?php
														$alamat_simpul_kelompok="$url_rewrite/function/dropdown/simpul_kelompok.php";
														$alamat_search_kelompok="$url_rewrite/function/dropdown/search_kelompok.php";
														js_radiokelompok($alamat_simpul_kelompok,
														$alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','yuda1');
														$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radiokelompok($style,"kelompok_id",'kelompok','yuda1');

														?>		    
														
												</div>
								</div>
							</li>
							<li>
								<span class="span2">Pilih Lokasi</span>
								<div class="input-append">
									<input type="text" name="entri_lokasi" id="entri_lokasi" class="span5" readonly="readonly" placeholder="">
									<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn" value="Pilih" onclick = "showSpoiler(this);">
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
									<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" placeholder="" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
													<?php
													$alamat_simpul_skpd="$url_rewrite/function/dropdown/simpul_skpd.php";
													$alamat_search_skpd="$url_rewrite/function/dropdown/search_skpd.php";
													js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
													$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radioskpd($style2,"skpd_id",'skpd','yuda');
													?>

													
											</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
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