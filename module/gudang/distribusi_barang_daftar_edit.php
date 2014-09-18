<?php
include "../../config/config.php";


$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_GET['id']))
{
unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	$get_data_filter = $RETRIEVE->retrieve_distribusi_detail(array('param'=> array('id'=>$_GET['id']), 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
}
include "$path/header.php";
?>

<html>
    
<body>
<form action='distribusi_barang_eksekusi_data_tambah_edit.php' method='post' name='myform' >
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
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_checkbox.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
<script>
$(function()
{
$('#tanggal1').datepicker($.datepicker.regional['id']);
$('#tanggal2').datepicker($.datepicker.regional['id']);
}
);
</script> 
<script type="text/javascript">

function show_confirm()
{
var r=confirm("Keluarkan barang ?");
if (r==true)
{

document.location="distribusi_barang.php";
}
else
{
document.location="distribusi_barang_eksekusi_data.php";
}
}
</script>
								
<script type="text/javascript">
function spoiler(obj)
    {
	var data_full=obj.id;
	var no=data_full.split("_");
	no=no[1];
	var id="view_"+no;
	var inner = obj.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
	if (inner.style.display =="none") {
		inner.style.display = "";
		document.getElementById(id).value="Tutup Detail";}
		else {
		inner.style.display = "none";
		document.getElementById(id).value="View Detail";
		}
	}
	
function spoilsub(obj)
    {
    var data_full=obj.id;
	var no=data_full.split("_");
	no=no[1];
	var id='sub_'+no;
	var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
	if (inner.style.display =="none") {
	inner.style.display = "";
	document.getElementById(id).value="Tutup Sub Detail";}
	else {
	inner.style.display = "none";
	document.getElementById(id).value="Sub Detail";
	}
    }
    </script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="ie_office.css" />
<![endif]-->
<div id="bottomright">

<table width="100%">
<tr>
<td style="border: 1px solid #004933; height:25px; padding:2px;"><u>Daftar aset yang akan dikeluarkan dari gudang :</u></td>
</tr>
<?php
$no =1;
// pr($get_data_filter);
foreach ($get_data_filter as $key => $row)
//while($row = mysql_fetch_array($exc))
{
if ($row->AsetOpr==0)
$select="selected='selected'";
if ($row->AsetOpr==1)
$select2="selected='selected'";

if($row->SumberAset=='sp2d')
$pilih="selected='selected'";
if($row->SumberAset=='hibah')
$pilih2="selected='selected'";

if($row->Pemilik=='12')
$pemilik="Pemerintah Kab/Kota";
if($row->Pemilik=='00')
$pemilik="Kementrian Lembaga";
if($row->Pemilik=='11')
$pemilik="Pemerintah Provinsi";
if($row->Pemilik=='99')
$pemilik="Yayasan/Masyarakat";

$ruangan = "SELECT NamaSatker FROM satker where Satker_ID = '$row->Ruangan'";
$exe = mysql_fetch_object(mysql_query ($ruangan));
if($exe)$ruang = $row->Ruangan." (".$exe->NamaSatker.")";
// echo "ruang".$ruang; 
/*
list($tahun,$bulan,$tanggal)=explode("-",$row->TglTransfer);
list($tahun_spbb,$bulan_spbb,$tanggal_spbb)=explode("-",$row->Tgl_SPBB_distribusi_barang);
*/																		
echo "<tr>
<td style='border: 1px solid #004933; height:50px; padding:2px;'>

<table width='100%'>
<tr>
<td></td>
<td>".$no.".</td>

<td>".$row->NomorReg." 
- ".$row->Kode.".".$row->kode_ruangan."</td>
<td align='right'><input type='button' id='view_".$row->Aset_ID."' value='View Detail' onclick='spoiler(this)'></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>".$row->NamaAset."</td>
</tr>

<tfoot style='display:none;'>
<tr>
<td></td>
<td></td>
<td colspan=2>
<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

<table border=0 width=100%>
<tr>
<td>
Kode Pemilik  
<input type='text' value='$row->Pemilik ($pemilik)' size='1px' style='text-align:center' readonly = 'readonly'> 
No Registrasi 
<input type='text' value='".$row->NomorReg."' size='10px' style='text-align:center' readonly = 'readonly'>
Kode Jenis Barang 
<input type='text' value='".$row->Kode."' size='20px' style='text-align:center' readonly = 'readonly'>
Kode Ruangan
<input type='text' value='$ruang' size='5px' style='text-align:center' readonly = 'readonly'>
<input type='hidden' name='fromsatker' value='".$row->OrigSatker_ID."' size='5px' style='text-align:center' readonly = 'readonly'>
Aset ID
<input type='text' id='aset' name='aset[]' value='".$row->Aset_ID."' size='5px' style='text-align:center' readonly = 'readonly'>
</td>
<td align='right'><input type='button' id ='sub_".$row->Aset_ID."' value='Sub Detail' onclick='spoilsub(this);'></td>
</tr>
</table>

<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
<table width=100%>
<tr>
<td valign='top' align='left' width=10%>Nama Aset</td>
<td valign='top' align='left' style='font-weight:bold'>
".$row->NamaAset."
</td>
</tr>

<tr>
<td valign='top' align='left'>Satuan Kerja</td>
<td valign='top' align='left' style='font-weight:bold'>
".$row->NamaSatker."
</td>
</tr>

<tr>
<td valign='top' align='left'>Jenis Barang</td>
<td valign='top' align='left' style='font-weight:bold'>
".$row->Uraian."
</td>
</tr>

</table>
</div>

<div style='display:none; padding:5px; border:1px solid #999999;'>
<table width=100%>
<tr>
<td width='*' align='left' style='background-color: #cccccc; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
</tr>
</table>

<table>
<tr>
<td valign='top' style='width:150px;'>Nomor Kontrak</td>
<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='".$row->NoKontrak."'></td>
</tr>

<tr>
<td valign='top' style='width:150px;'>Operasional/Program</td>
<td valign='top'>
<select style='width:130px' readonly>
<option value=''></option>
<option value='0' $select>Program</option>
<option value='1' $select2>Operasional</option>
</select>
</td>
</tr>

<tr>
<td valign='top' style='width:150px;'>Kuantitas</td>
<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='".$row->Kuantitas."'>
Satuan
<input type='text' readonly='readonly' style='width:130px' value='".$row->Satuan."'>
</td>
</tr>

<tr>
<td valign='top' style='width:150px;'>Cara Perolehan</td>
<td valign='top'>
<select style='width:130px' readonly>
<option value='-'>-</option>
<option value='sp2d' $pilih>Pengadaan</option>
<option value='hibah' $pilih2>Hibah</option>
</select>
</td>
</tr>

<tr>
<td valign='top' style='width:150px;'>Tanggal Perolehan</td>
<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='".$row->TglPerolehan."'></td>
</tr>

<tr>
<td valign='top' style='width:150px;'>Nilai Perolehan</td>
<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='".$row->NilaiPerolehan."'></td>
</tr>

<tr>
<td valign='top' style='width:150px;'>Alamat</td>
<td valign='top'><textarea style='width:90%' readonly>".$row->Alamat."</textarea><br>
RT/RW
<input type='text' readonly='readonly' style='width:50px' value='".$row->RTRW."'></td>
</tr>

<tr>
<td valign='top' style='width:150px;'>Lokasi</td>
<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='".$row->NamaLokasi."'></td>
</tr>
</table>

</div>

</div>
</td>
</tr>
</tfoot>
																							
</table>



</td>
</tr>";
$no++;
}
?>
</table>
<?php
//retrieve transfer
$get_data_filter = $RETRIEVE->retrieve_distribusi_barang_cetak(array('param'=> array('id'=>$_GET['id']), 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
// pr($get_data_filter);
foreach ($get_data_filter as $key => $row)
//while($row = mysql_fetch_array($exc))
{

list($tahun,$bulan,$tanggal)=explode("-",$row->TglTransfer);
list($tahun_spbb,$bulan_spbb,$tanggal_spbb)=explode("-",$row->Tgl_SPBB_distribusi_barang);
	
?>
<table width='100%'>
<tr>
	<td colspan=6><hr></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
<td></td>
</tr>
<tr>
<td>Transfer ke SKPD</td>
<td colspan=6>
<input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
<input type="text" name="transferke" id="transferke" style="width:450px;" value="<?php echo $row->NamaSatker; ?>">
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
// include "$path/function/dropdown/radio_function_skpd.php";
$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"transferke","skpd_id",'skpd','sk');
$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radioskpd($style2,"skpd_id",'skpd','sk|'.$row->ToSatker_ID);

?>
</div>
</td>
</tr>
<tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Nomor Dokumen</td>
<td style="width:200px;" colspan=5><input type="text" name="no_dokumen" id="no_dokumen" value="<?php echo $row->NoDokumen;?>" style="width:180px;"><span id='pesan'></span></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Tanggal Distribusi</td>
<td style="width:200px;" colspan=5><input id="tanggal1"type="text" name="tanggal_proses" value="<?php echo $tanggal."/".$bulan."/".$tahun;?>"  style="width:180px;"></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Alasan</td>
<td style="width:200px;" colspan=5><textarea name="alasan" cols="90" rows="5"><?php echo $row->InfoTransfer; ?></textarea></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>No. SPBB</td>
<td style="width:200px;" colspan=5><input type="text" name="no_spbb" value="<?php echo $row->No_SPBB_distribusi_barang;?>" style="width:180px;"></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Tanggal SPBB</td>
<td style="width:200px;" colspan=5><input id="tanggal2"type="text" name="tgl_spbb" value="<?php echo $tanggal_spbb."/".$bulan_spbb."/".$tahun_spbb;?>"  style="width:180px;"></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td colspan=6><hr></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan ="2" style="font-weight:bold; font-size:18px;">Pihak Penyimpan</td>
<td colspan ="2" style="font-weight:bold; font-size:18px;">Pihak Pengurus</td>
</tr>
<tr>
<td colspan=6><hr></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td>Nama</td>
<td width='200px'><input type="text" name="nama_penyimpan" value="<?php echo $row->Nama_Penyimpan;?>" style="width:180px;"></td>
<td width='200px'>Nama</td>
<td><input type="text" name="nama_pengurus" value="<?php echo $row->Nama_pengurus;?>" style="width:180px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Pangkat/Golongan</td>
<td><input type="text" name="pangkat_penyimpan" value="<?php echo $row->Pangkat_penyimpan;?>" style="width:180px;"></td>
<td>Pangkat/Golongan</td>
<td><input type="text" name="pangkat_pengurus" value="<?php echo $row->Pangkat_pengurus;?>" style="width:180px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>NIP</td>
<td><input type="text" name="nip_penyimpan" value="<?php echo $row->NIP_penyimpan;?>" style="width:180px;"></td>
<td>NIP</td>
<td><input type="text" name="nip_pengurus" value="<?php echo $row->NIP_pengurus;?>" style="width:180px;"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Nama Atasan</td>
<td ><input type="text" name="nama_atasan" value="<?php echo $row->Nama_atasan_penyimpan;?>" style="width:180px;"></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Pangkat/Golongan</td>
<td><input type="text" name="pangkat_atasan_penyimpan" value="<?php echo $row->Pangkat_atasan_penyimpan;?>" style="width:180px;"></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>NIP</td>
<td><input type="text" name="nip_atasan_penyimpan" value="<?php echo $row->NIP_atasan_penyimpan;?>" style="width:180px;"></td>
<td></td>
<td></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td>Jabatan</td>
<td><input type="text" name="jabatan_penyimpan" value="<?php echo $row->Jabatan_penyimpan;?>" style="width:180px;"></td>
<td></td>
<td></td>
</tr>
<?php
}
?>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" id="simpan" value="Distribusi Barang"><a href="distribusi_barang_daftar.php?pid=1">&nbsp;&nbsp;<input type="button" name="back" value="Batal"></a></td>
<td></td>
<td></td>
<td></td>
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