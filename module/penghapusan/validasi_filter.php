<?php
include "../../config/config.php";

        $menu_id = 40;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
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
				<script>
                jQuery(function($){
                   $("#jenis_hapus").select2();
                });
                </script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Validasi Penghapusan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Validasi Penghapusan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			 <form name="form" method="POST" action="<?php echo "$url_rewrite/"; ?>/module/penghapusan/validasi_lanjut.php?pid=1" onsubmit="return requiredFilter(false,false)">
			<ul>
							<li>
								<span class="span2">No. SK Penghapusan</span>
								<input type="text" name="bup_pu_noskpenghapusan" placeholder="" style="width:200px;" id="">&nbsp;<span id="errmsg">
							</li>
							<li>
								<span class="span2">Tanggal SK Penghapusan</span>
								<input type="text" name="bup_pu_tanggalhapus" placeholder="" style="width:200px;" id="tanggal12">
							</li>
							<li>
								<span class="span2">Jenis Penghapusan</span>
								<select name="jenis_hapus" id="jenis_hapus" style="width:205px">
									<option value="PMD">Pemindahtanganan</option>
									<option value="PMS">Pemusnahan</option>
									<option value="PSB">Penghapusan Sebagian</option>
								</select>
							</li>
							
                            <li>&nbsp;</li>
							<!-- <li>
                                <span class="span2">Jenis Aset</span>
                                <input type="checkbox" name="jenisaset[]" value="1" class="jenisaset1">Tanah
                                <input type="checkbox" name="jenisaset[]" value="2" class="jenisaset2">Mesin
                                <input type="checkbox" name="jenisaset[]" value="3" class="jenisaset3">Bangunan
                                <input type="checkbox" name="jenisaset[]" value="4" class="jenisaset4">Jaringan
                                <input type="checkbox" name="jenisaset[]" value="5" class="jenisaset5">Aset Lain
                                <input type="checkbox" name="jenisaset[]" value="6" class="jenisaset6">KDP
                            </li>    
                            <li>&nbsp;</li> -->
							<?=selectSatker('kodeSatker',$width='205',$br=true,(isset($kontrak)) ? $kontrak[0]['kodeSatker'] : false);?>
                            <li>&nbsp;</li>
							<!-- <li>
								<span class="span2">Satker</span>
								<div class="input-append">
										<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" placeholder="(Semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
								<span class="span2">Lokasi</span>
								<div class="input-append">
									<input type="text" name="rkb_lokasi" id="rkb_lokasi" class="span5" readonly="readonly" value="" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
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
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="text" name="rkb_njb" id="rkb_njb" class="span5" readonly="readonly" value="">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										
										<?php
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"rkb_njb","kelompok_id",'kelompok','rkbkelompokfilter');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok','rkbkelompokfilter');
											
										?>
									</div>
								</div>
							</li> -->
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