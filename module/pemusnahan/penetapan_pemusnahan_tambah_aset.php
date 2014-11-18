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
  <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/script.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS2/tabel.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS2/simbada.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS2/simbada.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemusnahan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Penetapan Pemusnahan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Penetapan Pemusnahan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			 <form method="POST" action="<?php echo "$url_rewrite";?>/module/pemusnahan/penetapan_pemusnahan_tambah_data.php?pid=1">  
			<ul>
							<li>
								<span class="span2">Nama&nbsp;Aset</span>
								<input style="width:480px" type="text" name="idgetnamaaset" id="idgetnamaaset" value="">
							</li>
							<li>
								<span class="span2">Nomor&nbsp;Kontrak</span>
								<input style="width:200px" type="text" name="idgetnokontrak" id="idgetnokontrak" value="">
							</li>
							<li>
								<span class="span2">No&nbsp;Usulan</span>
								<input style="width:200px" type="text" name="nousulan" id="nousulan" value="">
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
										 <input type="text" name="lda_lokasi" id="lda_lokasi" class="span5" readonly="readonly" placeholder="(Semua Lokasi)">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih"  onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
											
												<?php
												
												$alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
												$alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
												js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','yuda1');
												$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
												checkboxlokasi($style1,"lokasi_id",'lokasi','yuda1');
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