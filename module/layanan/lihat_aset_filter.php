<?php
include "../../config/config.php";
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	 $menu_id = 1;
     $SessionUser = $SESSION->get_session_user();
     ($SessionUser['ses_uid'] != '') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title' => 'GuestMenu', 'ses_name' => 'menu_without_login'));
     $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	 $resetDataView = $DBVAR->is_table_exists('lihat_daftar_aset_'.$SessionUser['ses_uoperatorid'], 0);
	
?>
	<!-- SQL Sementara -->
	<?php

		if(isset($_POST['noKontrak'])){

			if($_POST['s_posting'] == "on") $_POST['s_posting'] = 1; else $_POST['s_posting'] = 2; 

			foreach ($_POST as $key => $val) {
				$tmpfield[] = $key;
				$tmpvalue[] = "'$val'";
			}
			$field = implode(',', $tmpfield);
			$value = implode(',', $tmpvalue);

			$query = mysql_query("INSERT INTO kontrak ({$field}) VALUES ($value)");

			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_simbada.php\">";

		}

		$sql = mysql_query("SELECT * FROM kontrak");
		while ($dataKontrak = mysql_fetch_array($sql)){
				$kontrak[] = $dataKontrak;
			}
	?>
	
     <script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#lda_ia").keypress(function (e)  
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
               $("#lda_nk").keypress(function (e)  
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
     <script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#lda_tp").keypress(function (e)  
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
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Layanan Umum</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Lihat Daftar Aset</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Lihat Daftar Aset</div>
			<div class="subtitle">Filter Daftar Aset</div>
		</div>
		
		
		<section class="formLegend">
			
			 <form name="lda_filter" action="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_daftar.php?pid=1" method="post">
			<ul>
							<li>
								<span>ID ASET (System ID)</span><br/>
								<input id="lda_ia" name="kd_idaset" class="span3" type="text" >
							</li>
							<li>
								<span>Nama Aset</span><br/>
								<input isdatepicker="true"  name="kd_namaaset" class="span5"  type="text">
							</li>
							<li>
								<span>Nomor Kontrak</span><br/>
								<input isdatepicker="true" id="lda_nk" class="span3" name="kd_nokontrak"  type="text">
							</li>
							<li>
								<span>Tahun Perolehan</span><br/>
								<input name="kd_tahun" id="lda_tp" class="span2"  type="text" >
							</li>
							<li>
								<span>Kelompok</span><br/>
								<div class="input-append">
									<input type="text" name="pem_kelompok" id="pem_kelompok" style="width:480px;" readonly="readonly" value="">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
								
									<div class="inner" style="display:none;">
																	
										<?php
											//include "$path/function/dropdown/function_kelompok.php";
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"pem_kelompok","kelompok_id5",'kelompok','pemkelompokfilter');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id5",'kelompok','pemkelompokfilter');
										?>
									</div>
								</div>	
																
							</li>
							<li>
								<table border=0 cellspacing="6" style="display: none">
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
							</li>
							<li>
								<span>Pilih Lokasi</span><br/>
								<div class="input-append">
									<input type="text" name="entri_lokasi" id="entri_lokasi" style="width:480px;" readonly="readonly" placeholder="(Semua Kelompok)">
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
								<span>SKPD</span><br/>
								<div class="input-append">
									<input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
								
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

							<?php selectSatker(); ?>
							<li>
								<input type='submit' value='Lanjut'  name="submit" class="btn btn-primary">
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>