<?php
	include "../../config/config.php";
                  include"$path/header.php";
	include"$path/title.php";
        
        $menu_id = 38;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/script.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
	<!--<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  //document.location="daftar_usulan_penghapusan_lanjut.php";
                                        document.forms[0].submit();
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="daftar_usulan_penghapusan_filter.php";
		  }
		}
	</script>-->
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	<body>
	<div id="content">
	<?php
		include"$path/menu.php";
	?>
    </div>			
	<div id="tengah1">	
		<div id="frame_tengah1">
			<div id="frame_gudang">
				<div id="topright">
						Daftar Usulan Penghapusan
				</div>
				<div id="bottomright">
					<u>Seleksi Pencarian :</u>
					<form method="POST" action="<?php echo"$url_rewrite"?>/module/penghapusan/daftar_usulan_penghapusan_lanjut.php?pid=1">
					<table>
						<tr> 
							<td>ID Aset (System ID)</td>
						</tr>
						<tr>
							<td><input type='text' size=30px name="bup_idaset"/></td>
						</tr>
						<tr> 
							<td>Nama Aset</td>
						</tr>
						<tr>
							<td><input type='text' size=100px name="bup_namaaset"/></td>
						</tr>
						<tr> 
							<td>Nomor Kontrak</td>
						</tr>
						<tr>
							<td><input type='text' size=30px name="bup_nokontrak"/></td>
						</tr>
						<tr> 
							<td>Tahun Perolehan</td>
						</tr>
						<tr>
							<td><input type='text' size=10px name="bup_tahun"/></td>
						</tr>
						 <tr> 
							<td>Kelompok<br>
									<input type="text" name="lda_kelompok" id="lda_kelompok"style="width:480px;"readonly="readonly" placeholder="(semua Kelompok)">
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
										<style>
											.tabel th {
											background-color: #eeeeee;
											border: 1px solid #dddddd;
											}
											.tabel td {
											border: 1px solid #dddddd;
											}
										</style>	
                                                                                                                                                                                        <?php
                                                                                                                                                                                        
                                                                                                                                                                                        $alamat_simpul_kelompok="$url_rewrite/function/dropdown/simpul_kelompok.php";
                                                                                                                                                                                        $alamat_search_kelompok="$url_rewrite/function/dropdown/search_kelompok.php";
                                                                                                                                                                                        js_checkboxkelompok($alamat_simpul_kelompok,
                                                                                                                                                                                        $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','yuda');
                                                                                                                                                                                        $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                                                                                                        checkboxkelompok($style,"kelompok_id",'kelompok','yuda');
                                                                                                                                                                                        ?>

									</div>
							</td>
						</tr>
						<tr>
							<td>Lokasi<br>
								<input type="text" name="lda_lokasi" id="lda_lokasi" style="width:480px;" readonly="readonly" placeholder="(semua Lokasi)">
								<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
                                                                                                                                                                            <?php
                                                                                                                                                                            
                                                                                                                                                                            $alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
                                                                                                                                                                            $alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
                                                                                                                                                                            js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','yuda1');
                                                                                                                                                                            $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                                                                                            checkboxlokasi($style1,"lokasi_id",'lokasi','yuda1');
                                                                                                                                                                            ?>

									</div>
							</td>
						</tr>
						<tr>
							<td> SKPD<br>
							<input type="text" name="lda_skpd" id="lda_skpd" style="width:480px;" readonly="readonly" placeholder="(semua SKPD)">
							<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih" onclick = "showSpoiler(this);">
								<div class="inner" style="display:none;">
                                                                                                                                                            <?php
                                                                                                                                                            
                                                                                                                                                            $alamat_simpul_skpd="$url_rewrite/function/dropdown/simpul_skpd.php";
                                                                                                                                                            $alamat_search_skpd="$url_rewrite/function/dropdown/search_skpd.php";
                                                                                                                                                            js_checkboxskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda2');
                                                                                                                                                            $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                                                                            checkboxskpd($style2,"skpd_id",'skpd','yuda2');
                                                                                                                                                            ?>

								</div>
							</td>
						</tr>
						<tr>
							<td>NGO<br>
								<input type="text" name="lda_ngo" id="lda_ngo" style="width:480px;" readonly="readonly" placeholder="(semua NGO)">
								<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
									<div class="inner" style="display:none;">
                                                                                                                                                                            <?php
                                                                                                                                                                            
                                                                                                                                                                            $alamat_simpul_ngo="$url_rewrite/function/dropdown/simpul_ngo.php";
                                                                                                                                                                            $alamat_search_ngo="$url_rewrite/function/dropdown/search_ngo.php";
                                                                                                                                                                            js_checkboxngo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo","ngo_id",'ngo','yuda3');
                                                                                                                                                                            $style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                                                                                            checkboxngo($style3,"ngo_id",'ngo','yuda3');
                                                                                                                                                                            ?>

									</div>
                                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                                <td><br>
                                                                                                                                                <hr />
                                                                                                                                                        <input type='submit' name='tampil' value='Lanjut'/>
                                                                                                                                                <hr />
                                                                                                                                </td>
                                                                                                            </tr>
					</table>
					</form>
				</div>
			</div>
		</div>
	</div>
                    
	<?php
		include"$path/footer.php";
	?>
    </body>
</html>	
