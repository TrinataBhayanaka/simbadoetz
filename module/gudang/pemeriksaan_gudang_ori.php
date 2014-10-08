<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 17;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$resetDataView = $DBVAR->is_table_exists('gudang_pemeriksaan_'.$SessionUser['ses_uoperatorid'], 0);
?>
<script type="text/javascript">
/*function show_confirm(form)
{

var nama_aset=document.getElementById('nama_aset');
var no_kontrak=document.getElementById('no_kontrak');
var idkelompok=document.getElementById('idkelompok');
if (nama_aset.value=="" && no_kontrak.value=="" && idkelompok.value=="<?php echo $_SESSION['ses_satkername'] ; ?>") {
alert('masukk');
var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
if (r==true)
return true;
else return false;

}
}*/
</script>
<html>
<?php
include"$path/header.php";
?>
<body>
<form action='gudang_pemeriksaan_daftar.php?pid=1' method='post' name='formcek'>
<div id="content">
<?php
include"$path/title.php";
include"$path/menu.php";
?>
<div id="tengah1">
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">
Pemeriksaan Gudang

</div>
<div id="bottomright">
<table>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_checkbox.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>


<tr>
<td colspan="2"><u><b>Seleksi Pencarian :</b></u></td>
<td></td>
</tr>
<tr>
	<td>Nama Aset
	<br /><input type="text" name="gdg_pemgud_namaaset" id = 'nama_aset' style="width:200px;"></td>
</tr>
<tr>
	<td>Nomor Kontrak
	<br /><input type="text" name="gdg_pemgud_nokontrak" id='no_kontrak' style="width:450px;"></td>
</tr>
<tr>
	<td>SKPD
	<br />
<input type="hidden" name="gdg_pemgud_gudang" id="idgetkelompok" value="">
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

</div>
<table width="100%" align="left" border="0" class="tabel">

<tr>
<td colspan="3"></td>
</tr>
</table>
</div>
</td>
</tr>
<tr>
<td colspan="2"></td>
<td></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="tampil" value="Lanjut" ></td>
<td></td>
</tr>
<tr>
<td colspan="2"></td>
<td></td>
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
		</form>
    </body>
</html>
