<?php
include "../../config/config.php";
$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 20;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$resetDataView = $DBVAR->is_table_exists('pemeliharaan_validasi_'.$SessionUser['ses_uoperatorid'], 0);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?> <script type="text/javascript">
        $(document).ready(function(){

            //called when key is pressed in textbox
                $("#pem_ia").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //display error message
                        $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });
    </script>
	<script type="text/javascript">
        /*$(document).ready(function(){

            //called when key is pressed in textbox
                $("#pem_nk").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //display error message
                        $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });*/
    </script>
	<script type="text/javascript">
        $(document).ready(function(){

            //called when key is pressed in textbox
                $("#pem_tp").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //display error message
                        $("#errmsg3").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });
    </script>
	<!--Akhir Script Number Only-->
	
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_checkbox.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/jquery.min.js"></script>
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemeliharaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Validasi Pemeliharaan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Validasi Pemeliharaan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="pem_filter" action="<?php echo "$url_rewrite/module/pemeliharaan/"; ?>pemeliharaan_validasi_daftar_data.php?pid=1" method="post">
			<ul>
							<li>
								<span class="span2">ID Aset (System ID)</span>
								<input name="pem_ia" id="pem_ia" type="text" style="width: 200px;">&nbsp;<span id="errmsg"></span>
							</li>
							<li>
								<span class="span2">Nama Aset</span>
								<input name="pem_na" id="pem_na" type="text" style="width: 480px;">
							</li>
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input name="pem_nk" id="pem_nk" type="text" style="width: 200px;">&nbsp;<span id="errmsg2"></span>
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input name="pem_tp" id="pem_tp" type="text">&nbsp;<span id="errmsg3"></span>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
										<input type="text" name="pem_kelompok" id="pem_kelompok" class="span5" readonly="readonly" value="">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn"  value="Pilih" onclick = "showSpoiler(this);">
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
									<input type="text" name="lda_lokasi" id="lda_lokasi" class="span5" readonly="readonly" value="">
											<input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn"  value="Pilih" onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
										
												<?php
													// include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
													$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
													$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

													js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
													$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
												?>
											</div>
								</div>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<div class="input-append">
									<input type="text" name="pem_skpd" id="pem_skpd" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
											<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
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