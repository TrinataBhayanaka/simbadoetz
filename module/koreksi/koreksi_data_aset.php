<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 21;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
<style>
          #errmsg { color:green; }
		</style>
		<style>
          #errmsg2 { color:green; }
		</style>
		<script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#kd_idaset").keypress(function (e)  
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
               $("#kd_tahun").keypress(function (e)  
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
		  function OnSubmitForm()
	{
		var id=document.myform.kd_idaset.value; 
		var nm_aset=document.myform.kd_namaaset.value; 
		var kd_tahun=document.myform.kd_tahun.value; 
		var kd_nokontrak=document.myform.kd_nokontrak.value; 
		var klmpk_id=document.myform.kelompok_id5.value; 
		var skpd_id=document.myform.skpd_id.value; 
		var lokasi_id=document.myform.lokasi_id.value; 
		
		if(id == '' && nm_aset == '' && kd_tahun == '' && kd_nokontrak == '' && klmpk_id == '' && skpd_id == '' && lokasi_id == ''){
			var r=confirm('Tidak ada isian filter');
				if (r==true){
					document.myform.action ="<?php echo "$url_rewrite/module/koreksi/";?>hasil_koreksi_data.php?pid=1";
				}else{
					document.myform.action ="<?php echo "$url_rewrite/module/koreksi/";?>koreksi_data_aset.php";
				}
		}else{
			document.myform.action ="<?php echo "$url_rewrite/module/koreksi/";?>hasil_koreksi_data.php?pid=1";
		}
	return true;
	}
     </script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Koreksi</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Koreksi Data Aset</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Koreksi Data Aset</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			 <form name="myform" method="post" onsubmit="return OnSubmitForm();">
			<ul>
							<li>
								<span class="span2">ID&nbsp;Aset&nbsp;(System&nbsp;ID)</span>
								<input   name="kd_idaset" id="kd_idaset" type="text" ><span id="errmsg"></span>
							</li>
							<li>
								<span class="span2">Nama&nbsp;Aset</span>
								 <input isdatepicker="true" style="width: 480px;"  name="kd_namaaset"   type="text">
							</li>
							<li>
								<span class="span2">Nomor&nbsp;Kontrak</span>
								  <input isdatepicker="true" name="kd_nokontrak"  type="text">
							</li>
							<li>
								<span class="span2">Tahun&nbsp;Perolehan</span>
								<input name="kd_tahun"  type="text" id="kd_tahun"><span id="errmsg2"></span>
							</li>
							<li>
								<span class="span2">Kelompok</span>
								<div class="input-append">
									
                                                                                               
								<input type="text" name="idgetkelompok5" id="idgetkelompok5"
									class="span5" readonly="readonly" placeholder="(Semua Kelompok)">
								<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);"> <div class="inner" style="display:none;">

								<?php
									$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
									$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
									js_radiokelompok($alamat_simpul_kelompok,
									$alamat_search_kelompok,"idgetkelompok5","kelompok_id5",'kelompok5','kas');
									$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
									radiokelompok($style,"kelompok_id5",'kelompok5','kas');
									?>
								
								</div>
								</div>
							</li>
							<li>
								<span class="span2">Lokasi</span>
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
								<span class="span2">SKPD</span>
								<div class="input-append">
									 <input type="text" class="span5"  name="lda_skpd" id="lda_skpd" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>" readonly="readonly">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"class="btn" value="Pilih"onclick = "showSpoiler(this);">
											<div class="inner" style="display:none;">
												
												   <?php
														$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
														$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
														js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd1','sk');
														$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
														radioskpd($style2,"skpd_id",'skpd1','sk');
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