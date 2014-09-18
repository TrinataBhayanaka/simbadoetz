<?php
include "../../config/config.php";
?>

<html>
    <?php
    include"$path/header.php";
    ?>
     <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery.min.js"></script>                     <!-- end TAnggal-->
    <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery-ui.min.js"></script>                 <!-- end TAnggal-->                  
    <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/jquery.ui.datepicker-id.js"></script>    <!-- end TAnggal-->
    <link href="<?php echo "$url_rewrite"?>/css/jquery-ui.css" type="text/css" rel="stylesheet">                      <!-- end TAnggal-->
    <script>
        $(function()
                {
                $('#tanggal1').datepicker($.datepicker.regional['id']);
                $('#tanggal2').datepicker($.datepicker.regional['id']);
                $('#tanggal3').datepicker($.datepicker.regional['id']);
                $('#tanggal4').datepicker($.datepicker.regional['id']);
                $('#tanggal5').datepicker($.datepicker.regional['id']);
                $('#tanggal6').datepicker($.datepicker.regional['id']);
                $('#tanggal7').datepicker($.datepicker.regional['id']);
                $('#tanggal8').datepicker($.datepicker.regional['id']);
                $('#tanggal9').datepicker($.datepicker.regional['id']);
                $('#tanggal10').datepicker($.datepicker.regional['id']);
                $('#tanggal11').datepicker($.datepicker.regional['id']);
                $('#tanggal12').datepicker($.datepicker.regional['id']);
                $('#tanggal13').datepicker($.datepicker.regional['id']);
                $('#tanggal14').datepicker($.datepicker.regional['id']);
                $('#tanggal15').datepicker($.datepicker.regional['id']);
                $('#tanggal16').datepicker($.datepicker.regional['id']);
                $('#tanggal17').datepicker($.datepicker.regional['id']);
                $('#tanggal18').datepicker($.datepicker.regional['id']);
                $('#tanggal19').datepicker($.datepicker.regional['id']);
                $('#tanggal20').datepicker($.datepicker.regional['id']);
                $('#tanggal21').datepicker($.datepicker.regional['id']);
                $('#tanggal22').datepicker($.datepicker.regional['id']);
                    $('#tanggal23').datepicker($.datepicker.regional['id']);
                $('#tanggal24').datepicker($.datepicker.regional['id']);
                $('#tanggal25').datepicker($.datepicker.regional['id']);
                $('#tanggal26').datepicker($.datepicker.regional['id']);
                }
        );
        <!-- end TAnggal-->
    </script>    
<body>
<div id="content">
<?php
include"$path/title.php";
include"$path/menu.php";
?>
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">
Cetak Dokumen Gudang
</div>
<div id="bottomright">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>

<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>


<div class="tabber">
<div class="tabbertab">
<h2>Kartu I</h2>
<form name="kartu1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_kartubaranginventaris.php"; ?>"target="_blank">
<p><br><h1>Kartu Barang Inventaris</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/JS";?>/tabber.js"></script>
<link rel="stylesheet" href="<?php echo "$url_rewrite/css/";?>example.css" TYPE="text/css" MEDIA="screen">
<link rel="stylesheet" href="<?php echo "$url_rewrite/css/JS";?>/example-print.css" TYPE="text/css" MEDIA="print">


<tbody>
<tr>
<td>SKPD</td>
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','sk');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id",'skpd','sk');
?>


</div>
</td>
</tr>
<tr>
<td>Jenis Barang</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok" id="lda_kelompok" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','skl');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,"kelompok_id",'kelompok','skl');
?>


</div>
</td>
</tr>	
<tr>
<td>Tanggal Awal</td>
<td><input type="text" id="tanggal1" name="gdg_cdgkar1_tglawal" value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
<tr>
<td>Tanggal Akhir</td>
<td><input type="text" id="tanggal2" name="gdg_cdgkar1_tglakhir"> (format tanggal : dd/mm/yyyy)</td>
</tr>

<tr>
<td></td>
<td><input type="submit"  name="kartu1"value="Lanjut"><input type="reset"  value="Bersihkan Filter"></td>
</tr>

<tr>
<td colspan=2><hr></td>
<td></td>
</tr>

<tr>
<td>Tanggal Cetak Report</td>
<td><input type="text" id="tanggal3" name="gdg_cdgkar1_tglreport" value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
</tbody>
</table>

</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="1">
</form>

</div>

<div class="tabbertab">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<h2>Kartu PH</h2>
<form name="kartuph" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_kartubarangpakaihabis.php"; ?>"target="_blank">
<p>
<br><h1>Kartu Barang Pakai Habis</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>
<tr>
<td>SKPD</td>
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
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd2","skpd_id2",'skpd2','sk2');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id2",'skpd2','sk2');
?>


</div>
</td>
</tr>
<tr>
<td>Jenis Barang</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok2" id="lda_kelompok2" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok2","kelompok_id2",'kelompok2','skl2');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,"kelompok_id2",'kelompok2','skl2');
?>

</div>
</td>
</tr>	
<tr>
<td>Tanggal Awal</td>
<td><input type="text" id="tanggal4"name="gdg_cdgkarph_tglawal"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
<tr>
<td>Tanggal Akhir</td>
<td><input type="text" id="tanggal5"name="gdg_cdgkarph_tglakhir"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="kartuph" onClick="sendit_5()" value="Lanjut" /><input type="reset"  value="Bersihkan Filter"></td>
</tr>
<tr>
<td colspan=2><hr></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td><input type="text" id="tanggal6"name="gdg_cdgkarph_tglreport" value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
</tbody>
</table>
</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="2">
</form>
</div>

<div class="tabbertab">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<h2>Persediaan I</h2>
<form name="persediaan1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupersediaanbaranginventaris.php"; ?>"target="_blank">
<p>
<br><h1>Kartu Persediaan Barang Inventaris</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>
<tr>
<td>Tahun</td>
<td><input name="gdg_cdgper1_tahun" type="text" value="<?php echo date('Y')?>"></td>
</tr>
<tr>
<td>SKPD</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd3" id="lda_skpd3" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd3","skpd_id3",'skpd3','sk3');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id3",'skpd3','sk3');
?>

</div>
</td>
</tr>
<tr>
<td>Jenis Barang</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok3" id="lda_kelompok3" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok3","kelompok_id3",'kelompok3','skl3');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,"kelompok_id3",'kelompok3','skl3');
?>

</div>
</td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="persediaan1" value="Lanjut"><input type="reset" name="#" value="Bersihkan Filter"></td>
</tr>
<tr>
<td colspan=2><hr></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td><input type="text" id="tanggal7"name="gdg_cdgper1_tglreport"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
</tbody>
</table>
</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="3">
</form>
</div>

<div class="tabbertab">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>

<h2>Persediaan PH</h2>
<form name="persediaanph" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupersediaanbarangpakaihabis.php"; ?>"target="_blank">
<p>
<br><h1>Kartu Persediaan Barang Pakai Habis</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>
<tr>
	<td>Tahun</td>
	<td><input name="gdg_cdgperph_tahun" type="text" value="<?php echo date('Y')?>"></td>
</tr>
<tr>
<td>SKPD</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd4" id="lda_skpd4" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd4","skpd_id4",'skpd4','sk4');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id4",'skpd4','sk4');
?>


</div>
</td>
</tr>
<tr>
<td>Jenis Barang</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok4" id="lda_kelompok4" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok4","kelompok_id4",'kelompok4','skl4');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,"kelompok_id4",'kelompok4','skl4');
?>

</div>
</td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="persediaanph" value="Lanjut"><input type="reset" name="#" value="Bersihkan Filter"></td>
</tr>
<tr>
<td colspan=2><hr></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td><input type="text" id="tanggal8"name="gdg_cdgperph_tglreport"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
</tbody>
</table>
</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="4">
</form>
</div>

<div class="tabbertab">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>

<h2>Penerimaan I</h2>
<form name="penerimaan1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupenerimaanbaranginventaris.php"; ?>"target="_blank">

<br><h1>Buku Penerimaan Barang Inventaris</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>
<tr>
<td>SKPD</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd5" id="lda_skpd5" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd5","skpd_id5",'skpd5','sk5');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id5",'skpd5','sk5');
?>

</div>
</td>
</tr>
<tr>
<td>Jenis Barang</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok5" id="lda_kelompok5" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok5","kelompok_id5",'kelompok5','skl5');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,"kelompok_id5",'kelompok5','skl5');
?>

</div>
</td>
</tr>	
<tr>
<td>Tanggal Awal</td>
<td><input type="text" id="tanggal9"name="gdg_cdgpen1_awal"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
<tr>
<td>Tanggal Akhir</td>
<td><input type="text" id="tanggal10"name="gdg_cdgpen1_akhir"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="penerimaan1" value="Lanjut"><input type="reset" name="#" value="Bersihkan Filter"></td>
</tr>
<tr>
<td colspan=2><hr></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td><input type="text" id="tanggal11" name="gdg_cdgpen1_tglreport"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
</tbody>
</table>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="5">
</div>

</form>
</div>

<div class="tabbertab">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<h2>Penerimaan PH</h2>
<form name="penerimaanph" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukupenerimaanbaranginventaris.php";?>"target="_blank">

    <br><h1>Buku Penerimaan Barang Pakai Habis</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>
<tr>
<td>SKPD</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd6" id="lda_skpd6" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd6","skpd_id6",'skpd6','sk6');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id6",'skpd6','sk6');
?>

</div>
</td>
</tr>

<tr>
<td>Jenis Barang</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok6" id="lda_kelompok6" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok6","kelompok_id6",'kelompok6','skl6');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,"kelompok_id6",'kelompok6','skl6');
?>


</div>
</td>
</tr>	
<tr>
<td>Tanggal Awal</td>
<td><input type="text" id="tanggal12" name="gdg_cdgpenph_tglawal"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
<tr>
<td>Tanggal Akhir</td>
<td><input type="text" id="tanggal13"name="gdg_cdgpenphakhir"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="penerimaanph" value="Lanjut"><input type="reset" name="#" value="Bersihkan Filter"></td>
</tr>
<tr>
<td colspan=2><hr></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td><input type="text"id="tanggal14" name="gdg_cp_ph_tglreport"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
</tbody>
</table>
</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="6">
</form>
</div>


<div class="tabbertab">
<form name="pengeluaran1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukubaranginventaris.php"; ?>"target="_blank">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<h2>Buku I</h2>
<br><h1>Buku Barang Inventaris</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>

<tr>
<td>Jenis Barang</td>
<td colspan=2>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok9" id="lda_kelompok9" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok9","kelompok_id9",'kelompok9','skl9');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,"kelompok_id9",'kelompok9','skl9');
?>


</div>
</td>
<td></td>
</tr>	
<tr>
<td>Lokasi</td>
<td colspan=2>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="idlokasi1" id="idlokasi1" style="width:480px;" readonly="readonly" value="(semua Lokasi)">
<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
$alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"idlokasi1","lokasi_id1",'lokasi1','l1');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
checkboxlokasi($style2,"lokasi_id1",'lokasi1','l1');
?>

<tr>
<td colspan="3"></td>
</tr>


</div>
</td>
<td></td>
</tr>
<tr>
<td>SKPD</td>
<td colspan=2>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd9" id="lda_skpd9" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd9","skpd_id9",'skpd9','sk9');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id9",'skpd9','sk9');
?>

</div>
</td>
<td></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="buku1" value="Lanjut"><input type="reset" name="#" value="Bersihkan Filter"></td>
<td></td>
</tr>
<tr>
<td colspan=3><hr></td>
<td></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td colspan=2><input type="text" id="tanggal21"name="gdg_cdg_buku1_tglreport"value=""> (format tanggal : dd/mm/yyyy)</td>
<td></td>
</tr>
</tbody>
</table>

</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="9">
</form>
</div>

<div class="tabbertab">
<form name="pengeluaran1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_bukubarangpakaihabis.php"; ?>"target="_blank">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<h2>Buku PH</h2>
<p>
<br><h1>Buku Barang Pakai Habis</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>
<tr>
<td>Jenis Barang</td>
<td colspan=2>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok10" id="lda_kelompok10" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok10","kelompok_id10",'kelompok10','skl10');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,'kelompok_id10','kelompok10','skl10');
?>

</div>
</td>
<td></td>
</tr>	
<tr>
<td>Lokasi</td>
<td colspan=2>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="idlokasi2" id="idlokasi2" style="width:480px;" readonly="readonly" value="(semua Lokasi)">
<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_lokasi="$url_rewrite/function/dropdown/simpul_lokasi.php";
$alamat_search_lokasi="$url_rewrite/function/dropdown/search_lokasi.php";
js_checkboxlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"idlokasi2","lokasi_id2",'lokasi2','l2');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
checkboxlokasi($style2,"lokasi_id2",'lokasi2','l2');
?>

</div>
</td>
<td></td>
</tr>
<tr>
<td>SKPD</td>
<td colspan=2>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd10" id="lda_skpd10" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd10","skpd_id10",'skpd10','sk10');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,'skpd_id10','skpd10','sk10');
?>

</div>
</td>
<td></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="bukuph" value="Lanjut"><input type="reset" name="#" value="Bersihkan Filter"></td>
<td></td>
</tr>
<tr>
<td colspan=3><hr></td>
<td></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td colspan=2><input type="text" id="tanggal22"name="gdg_cdg_bukuph_tglreport"value=""> (format tanggal : dd/mm/yyyy)</td>
<td></td>
</tr>
</tbody>
</table>
</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="10">
</form>
</div>

<div class="tabbertab">

<form name="buku1" method="POST" action="<?php echo "$url_rewrite/report/template/GUDANG/report_gudang_cetak_laporanpemeriksaanbarangataugudang.php"; ?>"target="_blank">

     <h2>Laporan Pemeriksaan</h2>
<p>
<br><h1>Laporan Pemeriksaan Gudang</h1><br>
<div>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
<tbody>
<tr>
<td>SKPD</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_skpd11" id="lda_skpd11" style="width:450px;" readonly="readonly" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd11","skpd_id11",'skpd11','sk11');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,'skpd_id11','skpd11','sk11');
?>

</div>
</td>
</tr>
<tr>
<td>Jenis Barang</td>
<td>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="lda_kelompok11" id="lda_kelompok11" style="width:480px;" readonly="readonly" value="(semua Kelompok)">
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
//include "$path/function/dropdown/function_kelompok.php";
$alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
$alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
js_radiokelompok($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok11","kelompok_id11",'kelompok11','skl11');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiokelompok($style2,'kelompok_id11','kelompok11','skl11');
?>

</div>
</td>
</tr>	
<tr>
<td>Tanggal Awal</td>
<td><input type="text" id="tanggal23"name="gdg_cdg_lapem_tglawal"value="""></td>
</tr>
<tr>
<td>Tanggal Akhir</td>
<td><input type="text"id="tanggal24" name="gdg_cdg_lapem_tglakhir"value=""></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="laporanpemeriksaan" value="Lanjut"><input type="reset" name="#" value="Bersihkan Filter"></td>
</tr>
<tr>
<td colspan=2><hr></td>
<td></td>
</tr>
<tr>
<td>Tanggal Cetak Report</td>
<td><input type="text"id="tanggal25" name="gdg_cd_lapem_tglreport"value=""> (format tanggal : dd/mm/yyyy)</td>
</tr>
</tbody>
</table>
</div>
				<input type="hidden" name="menuID" value="18">
				<input type="hidden" name="mode" value="1">
				<input type="hidden" name="tab" value="11">
</form>

</div>
</div>
         
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
