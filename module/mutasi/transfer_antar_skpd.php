<?php
include "../../config/config.php";

 $USERAUTH = new UserAuth();

	$SESSION = new Session();

$menu_id = 22;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

    $resetDataView = $DBVAR->is_table_exists('filter_mutasi_'.$SessionUser['ses_uoperatorid'], 0);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>

   
    
    <!--buat date-->
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
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
        
    <!--buat number only-->
    <style>
        #errmsg { color:red; }
        #errmsg2 { color:red; }
    </style>
    <!--
    <script src="../../JS/jquery-latest.js"></script>
    <script src="../../JS/jquery.js"></script>
    -->
    <script type="text/javascript">
        $(document).ready(function(){

            //called when key is pressed in textbox
                $("#posisiKolom").keypress(function (e)  
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
   
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Mutasi</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Transfer Antar SKPD</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Transfer Antar SKPD</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_filter.php?pid=1">
			<ul>
							<li>
								<span class="span2">ID Aset (System ID)</span>
								 <input type="text" placeholder="" name="mutasi_trans_filt_idaset"style="width: 200px;"/>
							</li>
							<li>
								<span class="span2">Nama Aset</span>
								<input  type="text" placeholder="" style="width:480px;" name="mutasi_trans_filt_nmaset" style="width: 480px;"/>
							</li>
							<li>
								<span class="span2">Nomor Kontrak</span>
								 <input  type="text" placeholder="" name="mutasi_trans_filt_nokontrak" id="posisiKolom" style="width: 200px;"/>&nbsp;<span id="errmsg"></span>
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input  type="text" placeholder="" name="mutasi_trans_filt_thn" id="" style=""/>&nbsp;<span id="errmsg"></span>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
									<input type="text" name="pem_kelompok" id="pem_kelompok" class="span5" readonly="readonly" value="">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
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
									<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" placeholder="(Semua SKPD)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
									
											<?php
											
											$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
											$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
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