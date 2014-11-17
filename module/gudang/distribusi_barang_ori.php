<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
$resetDataView = $DBVAR->is_table_exists('filter_distribusi_barang_'.$SessionUser['ses_uoperatorid'], 0);
?>

<html>
<?php
include"$path/header.php";
?>

<!--buat date-->
<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_checkbox.js"></script>


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
 
<body>
<!--<form action='distribusi_barang_daftar.php?pid=1' method='post' name='myform'>-->
<form name="myform" method="post" onsubmit="return OnSubmitForm();">
<div id="content">

<?php
include"$path/title.php";
include"$path/menu.php";
?>

<div id="tengah1">
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">
Distribusi Barang
</div>

<div id="bottomright">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>

<table border=0>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>

<tr>
	<td>Tanggal Distribusi Awal</td>
	<td>&nbsp;</td>
	<td><input id="tanggal1"type="text" name="gdg_disbar_tglawal"value="" style="width:150px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>Tanggal Distribusi Akhir</td>
	<td>&nbsp;</td>
	<td><input id="tanggal2"type="text" name="gdg_disbar_tglakhir"value="" style="width:150px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<!--<tr>
<td>Tgl Distribusi Akhir</td>
<td>&nbsp;</td>
<td><input id="tanggal2"type="text" name="gdg_disbar_tglakhir"value="" style="width:200px;"></td>
</tr>-->

<tr>
<td>Nomor Dokumen</td>
<td>&nbsp;</td>
<td><input type="text" name="gdg_disbar_nopengeluaran" value="" style="width:150px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<!--<tr>
<td>Dari</td>
<td>&nbsp;</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
//include "$path/function/dropdown/function_skpd.php";
/*$alamat_simpul_skpd="$url_rewrite/function/dropdown/simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/search_skpd.php";
js_checkboxskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','sk');
$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
checkboxskpd($style1,"skpd_id",'skpd','sk');*/

/*$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','sk');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiopengadaanskpd($style2,"skpd_id",'skpd','sk');*/
?>


</div>
</td>
</tr>
<tr>-->
<td>Transfer ke SKPD</td>
<td>&nbsp;</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd2" id="lda_skpd2" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
//include "$path/function/dropdown/function_skpd.php";
/*$alamat_simpul_skpd2="$url_rewrite/function/dropdown/simpul_skpd.php";
$alamat_search_skpd2="$url_rewrite/function/dropdown/search_skpd.php";
js_checkboxskpd($alamat_simpul_skpd2, $alamat_search_skpd2,"lda_skpd2","skpd2_id",'skpd2','sp');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
checkboxskpd($style2,"skpd2_id",'skpd2','sp');*/
$alamat_simpul_skpd2="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd2="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd2, $alamat_search_skpd2,"lda_skpd2","skpd_id2",'skpd2','sk2');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiopengadaanskpd($style2,"skpd_id2",'skpd2','sk2');
?>
	</div>
	</td>
	</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" name="tampil" value="Tampilkan Data"><input type="reset" name="reset" value="Bersihkan Filter"></td>
</tr>
</table>
	</div>
	</div>
	</div>
	</div>
	</div> 
<?php
include"$path/footer.php";
?>
	</body>
	</html>