<?php
include "../../config/config.php";



	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";



?>

                <!--buat number only-->
                <style>
                    #errmsg { color:red; }
                    #errmsg2 { color:red; }
                </style>
                <script src="<?php echo "$url_rewrite/"; ?>JS/jquery-latest.js"></script>
                <script src="<?php echo "$url_rewrite/"; ?>JS/jquery.js"></script>
                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
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
                <script type="text/javascript">
                    $(document).ready(function(){

                        //called when key is pressed in textbox
                            $("#posisiKolom2").keypress(function (e)  
                            { 
                            //if the letter is not digit then display error and don't type anything
                            if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                            {
                                    //display error message
                                    $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                return false;
                        }	
                            });
                    });
                </script>
                
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemanfaatan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Penetapan Pemanfaatan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Penetapan Pemanfaatan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_tambah_data.php?pid=1">
			<ul>
							
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input type="text" name="peman_penet_filt_add_nokontrak" placeholder="" style="width:200px;" id="">&nbsp;<span id="errmsg"></span>
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input type="text" name="peman_penet_filt_add_thn" placeholder="" style="" id="">&nbsp;<span id="errmsg"></span>
							</li>
							<?=selectSatker('kodeSatker',$width='205',$br=true,(isset($kontrak)) ? $kontrak[0]['kodeSatker'] : false);?>
							<!--
							<li>
								<span class="span2">Pilih Lokasi</span>
								<div class="input-append">
									<input type="text" name="entri_lokasi" id="entri_lokasi" class="span5" readonly="readonly" placeholder="(Semua Kelompok)">
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
								<span class="span2">Satker</span>
								<div class="input-append">
									<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" placeholder="(Semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
							</li>-->
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