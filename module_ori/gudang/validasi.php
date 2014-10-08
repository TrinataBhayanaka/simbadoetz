<?php
include "../../config/config.php";
$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 16;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<html>
<?php
include"$path/header.php";
?>

<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_checkbox.js"></script>

<script>
$(function()
{
	$('#tanggal1').datepicker($.datepicker.regional['id']);
}
);
<!-- end TAnggal-->
</script>  
  
<body>
<form action='gudang_validasi_daftar.php?pid=1' method='post' name='formvalid'>
<div id="content">

<?php
include"$path/title.php";
include"$path/menu.php";
?>

<div id="tengah1">
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">
Validasi Distribusi Barang 
</div>

<div id="bottomright">

<table border=0>

<tr>
<td>Tanggal Distribusi</td>
<td>&nbsp;</td>
<td><input id="tanggal1" type="text" name="gdg_tglpengeluaran" style="width:150px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Nomor Dokumen</td>
<td>&nbsp;</td>
<td><input type="text" name="gdg_nomorpengeluaran" style="width:150px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Transfer ke SKPD </td>
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','sk');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiopengadaanskpd($style2,"skpd_id",'skpd','sk');
?>



<table width="100%" align="left" border="0" class="tabel">


<tr>
<td colspan="3"></td>
</tr>

	</table>
	</div>
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
	<td align="" valign="top">
		<input type="submit" value="Tampilkan Data" name="Lanjut" /><input type="reset" value="Bersihkan Filter" name="reset" />
	</td>
</tr>	
	</table>
	</form>
	</div>
	</div>
	</div>
	</div>
	</div>
	
<?php
include"$path/footer.php";
?>

	</form>
	</body>
	</html>
