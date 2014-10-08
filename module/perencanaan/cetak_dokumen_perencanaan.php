<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 5;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Cetak Dokumen Perencanaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Cetak Dokumen Perencanaan</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>	
		<section class="formLegend">
			
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#shb" data-toggle="tab">Standar Harga Barang</a></li>
						<li><a href="#shpb" data-toggle="tab">Standar Harga Pemeliharaan</a></li>
						<li><a href="#skb" data-toggle="tab">Standar Kebutuhan Barang</a></li>
						<li><a href="#rkb" data-toggle="tab">RKB</a></li>
						<li><a href="#rkpb" data-toggle="tab">RKPB</a></li>
						<li><a href="#rtb" data-toggle="tab">RTB</a></li>
						<li><a href="#rtpb" data-toggle="tab">RTPB</a></li>
						<li><a href="#dkbmd" data-toggle="tab">DKBMD</a></li>
						<li><a href="#dkpbmd" data-toggle="tab">DKPBMD</a></li>
					  </ul>
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						<div class="tab-pane active" id="shb">
						<div class="breadcrumb">
							<div class="titleTab">Standar Harga Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_standarhargabarang.php"; ?>"target="_blank"> 
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_1" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_kelompok1" id="lda_kelompok1" class="w480" readonly="readonly" value="(semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;"> 
										

										<?php
										$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
										$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
										js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok1","kelompok_id1",'kelompok1','skl1');
										$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiokelompok($style,"kelompok_id1",'kelompok1','skl1');
										?>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<input type="text" name="cdp_shb_ket" id="cdp_shb_ket" size="51" value="" />
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>

							<input type="hidden" name="menuID" value="9">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="1">
						</form>
						</div>
						<div class="tab-pane" id="shpb">
						<div class="breadcrumb">
							<div class="titleTab">Standar Harga Pemeliharaan Barang</div>
						</div>
						  <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_standarhargapemeliharaan.php"; ?>"target="_blank"> 
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_2" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_kelompok2" id="lda_kelompok2" class="w480" readonly="readonly" value="(semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;"> 
										
										<?php
										$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
										$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
										js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok2","kelompok_id2",'kelompok2','skl2');
										$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiokelompok($style,"kelompok_id2",'kelompok2','skl2');
										?>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<input type="text" name="cdp_shpb_ket" size="51" value="">
							</li>
							
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						<input type="hidden" name="menuID" value="9">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="2">
						</form>
						</div>
						<div class="tab-pane" id="skb">
						<div class="breadcrumb">
							<div class="titleTab">Standar Kebutuhan Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_standarkebutuhanbarang.php"; ?>"> 
			<ul>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_kelompok3" id="lda_kelompok3" class="w480" readonly="readonly" value="(semua Kelompok)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;"> 
							
										<?php
										
										$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
										$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
										js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok3","kelompok_id3",'kelompok3','skl3');
										$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiokelompok($style,"kelompok_id3",'kelompok3','skl3');
										?>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd1" id="lda_skpd1" class="w450" readonly="readonly" value="(semua SKPD)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd1","skpd_id1",'skpd1','sk1');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id1",'skpd1','sk1');
										?>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
									<input type="text" name="rkb_lokasi" id="rkb_lokasi" class="w450" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
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
						<input type="hidden" name="menuID" value="9">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="3">
						</form>
						</div>
						
						<div class="tab-pane" id="rkb">
						<div class="breadcrumb">
							<div class="titleTab">Renacana Kebutuhan Barang</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rkbu.php"; ?>"target="_blank"> 
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_3" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd2" id="lda_skpd2" class="w450" readonly="readonly" value="(semua SKPD)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd2","skpd_id2",'skpd2','sk2');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id2",'skpd2','sk2');
										?>
										</div>	
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
									<input type="text" name="rkb_lokasi2" id="rkb_lokasi2" class="w450" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi2","lokasi_id2",'lokasi2','p_provinsi2','p_kabupaten2','p_kecamatan2','p_desa2','lok2');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id2",'lokasi2',"lok2");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok4" id="lda_kelompok4" class="w480" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;"> 
									

									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok4","kelompok_id4",'kelompok4','skl4');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id4",'kelompok4','skl4');
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
                                                        <input type="text" id="p_desa2" name="p_desa2" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan2" name="p_kecamatan2" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten2" name="p_kabupaten2" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi2" name="p_provinsi2" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
						<input type="hidden" name="menuID" value="9">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="4">
						</form>
						</div>
						<div class="tab-pane" id="rkpb">
						<div class="breadcrumb">
							<div class="titleTab">Rencana Kebutuhan Pemeliharaan Barang</div>
						</div>
						<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rkpbu.php"; ?>"target="_blank"> 
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_4" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd3" id="lda_skpd3" class="w450" readonly="readonly" value="(semua SKPD)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd3","skpd_id3",'skpd3','sk3');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id3",'skpd3','sk3');
										?>
				
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
									<input type="text" name="rkb_lokasi3" id="rkb_lokasi3" class=""w450" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi3","lokasi_id3",'lokasi3','p_provinsi3','p_kabupaten3','p_kecamatan3','p_desa3','lok3');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id3",'lokasi3',"lok3");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok5" id="lda_kelompok5" class="w480" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;"> 
									

									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok5","kelompok_id5",'kelompok5','skl5');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id5",'kelompok5','skl5');
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
                                                        <input type="text" id="p_desa3" name="p_desa3" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan3" name="p_kecamatan3" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten3" name="p_kabupaten3" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi3" name="p_provinsi3" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
						<input type="hidden" name="menuID" value="9">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="5">
						</form>
						</div>
						<div class="tab-pane" id="rtb">
						<div class="breadcrumb">
							<div class="titleTab">Rencana Tahunan Barang</div>
						</div>
						<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rtb.php"; ?>"target="_blank"> 
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_5" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd4" id="lda_skpd4" class="w450" readonly="readonly" value="(semua SKPD)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd4","skpd_id4",'skpd4','sk4');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id4",'skpd4','sk4');
										?>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
									<input type="text" name="rkb_lokasi4" id="rkb_lokasi4" class="w450" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi4","lokasi_id4",'lokasi4','p_provinsi4','p_kabupaten4','p_kecamatan4','p_desa4','lok4');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id4",'lokasi4',"lok4");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok6" id="lda_kelompok6" class="w480"readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;"> 
									

									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok6","kelompok_id6",'kelompok6','skl6');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id6",'kelompok6','skl6');
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
                                                        <input type="text" id="p_desa4" name="p_desa4" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan4" name="p_kecamatan4" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten4" name="p_kabupaten4" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi4" name="p_provinsi4" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
						<input type="hidden" name="menuID" value="9">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="6">
						</form>
						</div>
						<div class="tab-pane" id="rtpb">
						<div class="breadcrumb">
							<div class="titleTab">Rencana Tahunana Pemeliharaan Barang</div>
						</div>
						<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_rtpb.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_6" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd5" id="lda_skpd5" class="w450" readonly="readonly" value="(semua SKPD)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd5","skpd_id5",'skpd5','sk5');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id5",'skpd5','sk5');
										?>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
									<input type="text" name="rkb_lokasi5" id="rkb_lokasi5" class="w450" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi5","lokasi_id5",'lokasi5','p_provinsi5','p_kabupaten5','p_kecamatan5','p_desa5','lok5');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id5",'lokasi5',"lok5");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok7" id="lda_kelompok7" class="w480" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;"> 
									

									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok7","kelompok_id7",'kelompok7','skl7');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id7",'kelompok7','skl7');
									?>
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
                                                        <input type="text" id="p_desa5" name="p_desa5" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan5" name="p_kecamatan5" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten5" name="p_kabupaten5" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi5" name="p_provinsi5" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
							<input type="hidden" name="menuID" value="9">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="7">
						</form>
						</div>
						<div class="tab-pane" id="dkbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Kebutuhan Barang Milik Daerahn</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_dkbmd.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_7" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd6" id="lda_skpd6" class="w450" readonly="readonly" value="(semua SKPD)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										
										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd6","skpd_id6",'skpd6','sk6');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id6",'skpd6','sk6');
										?>
										</div>	
								</div>	
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
									<input type="text" name="rkb_lokasi6" id="rkb_lokasi6" class="w450" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi6","lokasi_id6",'lokasi6','p_provinsi6','p_kabupaten6','p_kecamatan6','p_desa6','lok6');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id6",'lokasi6',"lok6");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok8" id="lda_kelompok8" class="w480" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;"> 
									
									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok8","kelompok_id8",'kelompok8','skl8');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id8",'kelompok8','skl8');
									?>
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
                                                        <input type="text" id="p_desa6" name="p_desa6" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan6" name="p_kecamatan6" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten6" name="p_kabupaten6" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi6" name="p_provinsi6" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
							<input type="hidden" name="menuID" value="9">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="8">
						</form>
						</div>
						<div class="tab-pane" id="dkpbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Kebutuhan Pemeliharaan Barang Milik Daerah</div>
						</div>
					<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/report_perencanaan_cetak_dkpbmd.php"; ?>"target="_blank">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<select name="tahun_8" >
								<?php for ($thn=1;$thn<50;$thn++){ ?>
								<option value="<?php echo(2000+$thn);?>">
								<?php echo (2000+$thn);?></option>
								<?php } ?>
								</select>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd7" id="lda_skpd7" class="w450" readonly="readonly" value="(semua SKPD)">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
										

										<?php
										$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd7","skpd_id7",'skpd7','sk7');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id7",'skpd7','sk7');
										?>
										</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="hidden" name="idgetlokasi" id="idgetlokasi" value="">
									<input type="text" name="rkb_lokasi7" id="rkb_lokasi7" class="w450" readonly="readonly" value="(semua Lokasi)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
											$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

											js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"rkb_lokasi7","lokasi_id7",'lokasi7','p_provinsi7','p_kabupaten7','p_kecamatan7','p_desa7','lok7');
											$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiopengadaanlokasi($style1,"lokasi_id7",'lokasi7',"lok7");
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
									<input type="text" name="lda_kelompok9" id="lda_kelompok9" class="w480" readonly="readonly" value="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;"> 
									

									<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok9","kelompok_id9",'kelompok9','skl9');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id9",'kelompok9','skl9');
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
                                                        <input type="text" id="p_desa7" name="p_desa7" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan7" name="p_kecamatan7" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten7" name="p_kabupaten7" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi7" name="p_provinsi7" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
							<input type="hidden" name="menuID" value="9">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="9">
						</form>
						</div>
					  </div>
			</div> 
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>