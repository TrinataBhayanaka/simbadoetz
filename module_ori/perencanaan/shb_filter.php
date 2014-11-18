<?php
include "../../config/config.php";
$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 2;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<html>
	<?php
	include "$path/header.php";
	?>
		
	<!--Script Number Only-->
    <style>
        #msg { color:green; }
    </style>
	<script type="text/javascript">
        $(document).ready(function(){

            //dipanggil ketika diisi
                $("#lda_ia").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //tampilan pesan error
                        $("#msg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });
    </script>
	<script type="text/javascript">
	function show_confirm()
	{
	var r=confirm("Tidak ada data yang dijadikan filter. Seluruh isian filter kosong");
	if (r==true)
			{
				//document.location="katalog_aset_informasi.php";
				//alert("Dokumen telah dicetak");
				document.forms[0].submit();

			}
			else
			{
				document.location="katalog_aset.php";
				//alert("Batal cetak dokumen");
			}
	}
	</script>
	<!--Akhir Script Number Only-->
	
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_checkbox.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/jquery.min.js"></script>
        <body>
            <div id="content">
                <?php
                include "$path/title.php";
                include "$path/menu.php";
                ?>
	    
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                        <div id="topright">
                        Buat Standar Harga Barang
                        </div>
                            <div id="bottomright">
								<div id="perencanaan_new">
									<!edit isi content!>

										<!--Form Pencarian -->
										<form name="pencarian" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shb_daftar_data.php?pid=1" method="post">
											<table border="0">
												<script type="text/javascript" src="../../JS/tabel.js"></script>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td>Tahun</td>
														<td>
															<input name="shb_thn" type="text" id="shb_thn" type="text" />&nbsp;<span id="errmsg"></span>
														</td>
												</tr>
												<tr>            
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td>Nama/Jenis Barang</td>
														<td>
															<input type="text" name="shb_njb" id="shb_njb"  class="w450"  value="" />
															<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);" />
															<div class="inner" style="display:none;">
																<?php
																	$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
																	$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
																	js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"shb_njb","kelompok_id",'kelompok','shbkelompokfilter');
																	$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																	radiokelompok($style,"kelompok_id",'kelompok','shbkelompokfilter');
																?>
															</div>
														</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td>Keterangan</td>
														<td>
															<input type="text" name="shb_ket" id="shb_ket" size="51" value="">
														</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td></td>
														<td>
															<input type="submit" name="submit" value="Tampilkan Data" />
															<input type="reset" name="reset" value="Bersihkan Data">
														</td>
												</tr>
											</table>
										</form>
										<!-- Akhir Form Pencarian -->
								</div>	
                            </div>
                    </div>
                </div>
            </div>
        </div>
         
     <?php 
     include "$path/footer.php";
     ?>
     </body>
</html>	
