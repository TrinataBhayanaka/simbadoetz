<?php
include "../../config/config.php";


        $menu_id = 46;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
		
		$resetDataView = $DBVAR->is_table_exists('pemusnahan_filter_'.$SessionUser['ses_uoperatorid'], 0);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/tabel.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_checkbox.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/jquery.min.js"></script>

	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? \n Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("Pencarian data aset akan dilakukan");
		  //document.location="daftar_usulan_pemusnahan_lanjut.php";
                                        document.forms[0].submit();
		  }
		else
		  {
		  alert("Membatalkan pencarian data aset");
		  document.location="daftar_usulan_pemusnahan_filter.php";
		  }
		}
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemusnahan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Daftar Usulan Pemusnahan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title"> Daftar Usulan Pemusnahan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form method="POST" action="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_lanjut.php?pid=1">
			<ul>
							<li>
								<span class="span2">ID Aset (System ID)</span>
								<input type='text' size='30px' name="buph_idaset" placeholder="Isi Aset ID..."/>
							</li>
							<li>
								<span class="span2">Nama Aset</span>
								<input type='text' size='100px' name="buph_namaaset" placeholder="Isi Nama Aset..."/>
							</li>
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input type='text' size='30px' name="buph_nokontrak" placeholder="Isi Nomor Kontrak..."/>
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input type='text' size='10px' name="buph_tahun" placeholder="Isi Tahun..."/>
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
									<input type="text" name="pem_lokasi" id="pem_lokasi" class="span5" readonly="readonly" value="">
								 <input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">
											
														<?php
													   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
														$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
														$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

														js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"pem_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
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
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>