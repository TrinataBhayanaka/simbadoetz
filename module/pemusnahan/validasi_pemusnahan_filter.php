<?php
include "../../config/config.php";

		$menu_id = 48;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
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
		  <li><a href="#">Pemusnahan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Validasi Pemusnahan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Validasi Pemusnahan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="form" method="POST" action="<?php echo "$url_rewrite"; ?>/module/pemusnahan/validasi_pemusnahan_lanjut.php?pid=1">
			<ul>
							<li>
								<span class="span2">No BA Pemusnahan</span>
								<input type="text" name="buph_val_noskpemusnahan" style="width:200px;" id="" placeholder="No BA Pemusnahan...">
							</li>
							<li>
								<span class="span2">Tanggal Awal</span>
								<input type="text" name="buph_val_tgl_awal" style="width:200px;" id="tanggal13" placeholder="Tanggal Awal...">
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<input type="text" name="buph_val_tgl_akhir" style="width:200px;" id="tanggal12" placeholder="Tanggal Akhir..." />
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<div class="input-append">
										<input type="text" name="lda_lokasi" readonly="readonly" id="lda_lokasi" class="span5" placeholder="(Semua Lokasi)">
                                            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
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