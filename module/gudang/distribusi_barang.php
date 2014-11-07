<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
$resetDataView = $DBVAR->is_table_exists('filter_distribusi_barang_'.$SessionUser['ses_uoperatorid'], 0);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>


<script>
$(function()
{
$('#tanggal1').datepicker($.datepicker.regional['id']);
$('#tanggal2').datepicker($.datepicker.regional['id']);
}
);

function OnSubmitForm()
	{
		var gdg_disbar_tglawal=document.myform.gdg_disbar_tglawal.value; 
		var gdg_disbar_tglakhir=document.myform.gdg_disbar_tglakhir.value; 
		var gdg_disbar_nopengeluaran=document.myform.gdg_disbar_nopengeluaran.value; 
		var skpd_id2=document.myform.skpd_id2.value; 
		
		if(gdg_disbar_tglawal == '' && gdg_disbar_tglakhir == '' && gdg_disbar_nopengeluaran == '' && skpd_id2 == ''){
			var r=confirm('Tidak ada isian filter');
				if (r==true){
					document.myform.action ="<?php echo "$url_rewrite/module/gudang/";?>distribusi_barang_daftar.php?pid=1";
				}else{
					document.myform.action ="<?php echo "$url_rewrite/module/gudang/";?>distribusi_barang.php";
				}
		}else{
			document.myform.action ="<?php echo "$url_rewrite/module/gudang/";?>distribusi_barang_daftar.php?pid=1";
		}
	return true;
	}
</script>  
 
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Distribusi Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Distribusi Barang</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="myform" method="post" onsubmit="return OnSubmitForm();">
			<ul>
							<li>
								<span class="span2">Tanggal Distribusi Awal</span>
								<input id="tanggal1"type="text" name="gdg_disbar_tglawal"value="" style="width:150px;">
							</li>
							<li>
								<span class="span2">Tanggal Distribusi Akhir</span>
								<input id="tanggal2"type="text" name="gdg_disbar_tglakhir"value="" style="width:150px;">
							</li>
							<li>
								<span class="span2">Nomor Dokumen</span>
								<input type="text" name="gdg_disbar_nopengeluaran" value="" style="width:150px;">
							</li>
							<li>
								<span class="span2">Transfer ke SKPD</span>
								<div class="input-append">
										<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
										<input type="text" name="lda_skpd2" id="lda_skpd2" class="span5" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
										<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
										<div class="inner" style="display:none;">

										<?php
										
										$alamat_simpul_skpd2="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
										$alamat_search_skpd2="$url_rewrite/function/dropdown/radio_search_skpd.php";
										js_radioskpd($alamat_simpul_skpd2, $alamat_search_skpd2,"lda_skpd2","skpd_id2",'skpd2','sk2');
										$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
										radiopengadaanskpd($style2,"skpd_id2",'skpd2','sk2');
										?>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="tampil" class="btn btn-primary" value="Tampilkan Data" />
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