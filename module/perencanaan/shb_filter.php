<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 2;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
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
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Standar Harga Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Standar Harga Barang</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="pencarian" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shb_daftar_data.php?pid=1" method="post">
			<ul>
							<li>
								<span class="span2">Tahun</span>
								<input name="shb_thn" type="text" class="span2" id="shb_thn" type="text" />&nbsp;<span id="errmsg"></span>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<div class="input-append">
									<input type="text" name="shb_njb" id="shb_njb"  style="width:480px;"  value="" />
									<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);" />
									<div class="inner" style="display:none;">
										<?php
											$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
											$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
											js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"shb_njb","kelompok_id",'kelompok','shbkelompokfilter');
											$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
											radiokelompok($style,"kelompok_id",'kelompok','shbkelompokfilter');
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<input type="text" name="shb_ket" id="shb_ket" class="span3" size="51" value="">
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>