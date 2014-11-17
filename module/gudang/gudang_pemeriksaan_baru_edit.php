<?php
include "../../config/config.php";


$menu_id = 17;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_GET['id']))

{


	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	$get_data_filter = $RETRIEVE->retrieve_pemeriksaan_gudang_aset(array('param'=> array('id'=>$_GET['id']), 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
}
?>

<html>
<?php
include"$path/header.php";
?>
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
Pemeriksaan Gudang
</div>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/JS";?>/tabber.js"></script>
<link rel="stylesheet" href="<?php echo "$url_rewrite/css/";?>example.css" TYPE="text/css" MEDIA="screen">
<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
<script>
$(function()
{
$('#tanggal1').datepicker($.datepicker.regional['id']);

}
);
</script> 

<script type="text/javascript">
function spoiler(obj)
    {
    var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
	//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
    if (inner.style.display =="none") {
	inner.style.display = "";
	document.getElementById('view').value="Tutup Detail";}
	else {
	inner.style.display = "none";
	document.getElementById('view').value="View Detail";}
    }
	
function spoilsub(obj)
    {
    var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
	//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
    if (inner.style.display =="none") {
	inner.style.display = "";
	document.getElementById('sub').value="Tutup Sub Detail";}
	else {
	inner.style.display = "none";
	document.getElementById('sub').value="Sub Detail";}
    }
    </script>



<div id="bottomright">


<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<tbody>
<?php
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

list($tahun,$bulan,$tanggal)=explode("-",$row->TglTransfer);
list($tahun_spbb,$bulan_spbb,$tanggal_spbb)=explode("-",$row->Tgl_SPBB_distribusi_barang);
?>
<tr>
<td></td>
<td>
<table width="100%">
<!--<tr>
<td><p style="float:left;">Aset ID : <?php //echo $row->Aset_ID;?> 
</p><p style="float:right;"><input type="button" onclick="spoiler(this)" id="view" name="#" value="View Detail"></p></td>
</tr>
<tr>
<td>Nomor Registrasi : <?php //echo $row->NomorReg."- ".$row->Kode;?></td>
</tr>
<tr>
<td><?php //echo $row->NamaAset;?></td>
</tr>
<tr>
<td><hr></td>
</tr>-->
<tr>
	<td width="150px">Nomor Registrasi</td>
	<td>:</td>
	<td><?php echo $row->NomorReg."- ".$row->Kode;?>
		<p style="float:right;"><input type="button" onclick="spoiler(this)" id="view" name="#" value="View Detail"></p>
	</td>
</tr>
<tr>
	<td>Nama Aset</td>
	<td>:</td>
	<td><?php echo $row->NamaAset;?></td>
</tr>
<tr>
<td></td>
</tr>
<?php
echo "
<tfoot style='display:none;'>
<tr>


<td colspan=3>
<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

<table border=0 width=100%>
<tr>
<td>
<input type='text' value='".$row->Pemilik."' size='1px' style='text-align:center' readonly = 'readonly'> - 
<input type='text' value='".$row->NomorReg."' size='10px' style='text-align:center' readonly = 'readonly'> - 
<input type='text' value='".$row->Kode."' size='20px' style='text-align:center' readonly = 'readonly'> - 
<input type='text' value='".$row->kode_ruangan."' size='5px' style='text-align:center' readonly = 'readonly'>
</td>
<td align='right'><input type='button' id ='sub' value='Sub Detail' onclick='spoilsub(this);'></td>
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
<td width='*' align='left' style='background-color:#004933; color:white; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
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

<tr>
<td valign='middle' style='width:150px;'>Koordinat</td>
<td valign='top'>Bujur Lintang</td>
</tr>
</table>

</div>

</div>
</td>
</tr>
</tfoot>";
?>
</table>
</td>
</tr>
<?php
}
?>

</tbody>
</table>
<div class="tabber">


<div class="tabbertab">
<h2>Edit Data</h2>
<form action ='gudang_pemeriksaan_baru_editdb.php' method='post' name='formentri'>
<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<tr style="background-color:#004933;">
<td align="left" style="height:25px; color:white; padding-left:5px;" colspan=3>Dokumen Pemeriksaan Gudang</td>
<td></td>

<td></td>
</tr>
<?php

$get_data_filter = $RETRIEVE->retrieve_pemeriksaan_gudang_edit(array('param'=> array('id'=>$_GET['id'],'gid'=>$_GET['gid']), 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));

foreach ($get_data_filter['PemeriksaanGudang'] as $key => $row)
//while($row = mysql_fetch_array($exc))
{
$aset					 = $row->Aset_ID;
$gudang_id				 = $row->PemeriksaanGudang_ID;
$TglPemeriksaanGudang    = $row->TglPemeriksaanGudang;
$AlasanPemeriksaanGudang = $row->AlasanPemeriksaanGudang;
$NoBAPemeriksaanGudang   = $row->NoBAPemeriksaanGudang;
$NamaKetuaPanitia        = $row->NamaKetuaPanitia;
$GolonganKetuaPanitia    = $row->GolonganKetuaPanitia;
$NIPKetuaPanitia         = $row->NIPKetuaPanitia;
$JabatanKetuaPanitia     = $row->JabatanKetuaPanitia;
}
list($tahun, $bulan, $tanggal)=explode ('-', $TglPemeriksaanGudang);
$values1="-";
$values2="Stock Opname/Rutin";
$values3="Pergantian Penyimpan Barang";
$values4="Kebakaran";
$values5="Pencurian";
$values6="Bencana Alam";
if($AlasanPemeriksaanGudang==$values1)
$values1="selected='selected'";
if($AlasanPemeriksaanGudang==$values2)
$values2="selected='selected'";
if($AlasanPemeriksaanGudang==$values3)
$values3="selected='selected'";
if($AlasanPemeriksaanGudang==$values4)
$values4="selected='selected'";
if($AlasanPemeriksaanGudang==$values5)
$values5="selected='selected'";
if($AlasanPemeriksaanGudang==$values6)
$values6="selected='selected'";
?>

<tr>
<td>No BA Pemeriksaan Gudang</td>
<td>:</td>
<td><input type="text" name="gdg_dbedb_nobapemeriksa" value="<?php echo $NoBAPemeriksaanGudang;?>"  id="posisiKolom"><span id="errmsg"></span>
<input type='hidden' name='aset' value='<?php echo $aset;?>'>
<input type='hidden' name='gudang_id' value='<?php echo $gudang_id;?>'>
</td>
</tr>
<tr>
<td>Tanggal Pemeriksaan Gudang</td>
<td>:</td>
<td><input type="text" input id="tanggal1" name="gdg_dbedb_tglpemeriksa" value="<?php echo "$tanggal/$bulan/$tahun";?>"></td>
</tr>
<tr>
<td>Alasan Pemeriksaan</td>
<td>:</td>
<td><select name="gdg_dbedb_alasanpemeriksa">
<option value="-" <?php echo $values1; ?>>-</option>
<option value="Stock Opname/Rutin" <?php echo $values2; ?>>Stock Opname/Rutin</option>
<option value="Pergantian Penyimpan Barang" <?php echo $values3; ?>>Pergantian Penyimpan Barang</option>
<option value="Kebakaran" <?php echo $values4; ?>>Kebakaran</option>
<option value="Pencurian" <?php echo $values5; ?>>Pencurian</option>
<option value="Bencana Alam" <?php echo $values6; ?>>Bencana Alam</option>
</select>
</td>
</tr>
<tr style="background-color:#004933;">
<td align="left" style="height:25px; color:white; padding-left:5px;" colspan=3>Informasi Ketua Panitia Pemeriksaan Gudang</td>
<td></td>
<td></td>
</tr>
<tr>
<td>Nama</td>
<td>:</td>
<td><input type="text" name="gdg_dbedb_nama" value="<?php echo $NamaKetuaPanitia;?>"></td>
</tr>
<tr>
<td>Pangkat/Golongan</td>
<td>:</td>
<td><input type="text" name="gdg_dbedb_pangkat_gol"value="<?php echo $GolonganKetuaPanitia;?>"></td>
</tr>
<tr>
<td>NIP</td>
<td>:</td>
<td><input type="text" name="gdg_dbedb_nip" value="<?php echo $NIPKetuaPanitia;?>" id="posisiKolom1"><span id="errmsg1"></span></td>
</tr>
<tr>
<td>Jabatan</td>
<td>:</td>
<td><input type="text" name="gdg_dbedb_jabatan" value="<?php echo $JabatanKetuaPanitia;?>"></td>
</tr>
</tbody>
<?php
pr($get_data_filter['Kondisi']);
foreach ($get_data_filter['Kondisi'] as $key => $row)
//while($row = mysql_fetch_array($exc))
{
$TidakDitemukan = $row->TidakDitemukan;
$Baik 	  		= $row->Baik;
$RusakRingan   	= $row->RusakRingan;
$RusakBerat     = $row->RusakBerat;
$InfoKondisi    = $row->InfoKondisi;
}
$cek=1;
if($TidakDitemukan==$cek)
$cek="checked='checked'";
else $cek="";





if($Baik==1){
$values1="selected='selected'";
$values2="";
$values3="";
// echo "masukkkk";
}
if($RusakRingan==1){
$values1="";
$values2="selected='selected'";
$values3="";}

if($RusakBerat==1){
$values1="";
$values2="";
$values3="selected='selected'";
// echo "masukkkk sini";
}
if($Baik && $RusakRingan && $RusakBerat==0)
$values4="selected='selected'";

?>

<tr style="background-color:#004933;">
<td align="left" style="height:25px; color:white; padding-left:5px;" colspan=3>Perubahan Kondisi Setelah Pemeriksaan Gudang</td>
<td></td>
<td></td>
</tr>
<tr>
<td>Aset tidak ditemukan</td>
<td>&nbsp;</td>
<td><input type="checkbox" name="aset_tidak_ditemukan" <?php echo $cek;?>></td>
</tr>
<tr>
<td>Kondisi</td>
<td>:</td>
<td><select name="gdg_dbedb_kondisi">
<option <?php echo $values4;?> value="-">-</option>
<option <?php echo $values1;?> value="Baik">Baik</option>
<option <?php echo $values2;?> value="Rusak Ringan">Rusak Ringan</option>
<option <?php echo $values3;?> value="Rusak Berat">Rusak Berat</option>

</select>
</td>
</tr>
<tr>
<td>Tindak Lanjut</td>
<td>:</td>
<td><textarea name="gdg_dbedb_tindaklanjut" cols="80" rows="5"><?php echo $InfoKondisi;?></textarea></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td><input type="submit" name="#" value="Simpan"> &nbsp&nbsp; 
		<a href=<?php echo "$url_rewrite/module/gudang/gudang_pemeriksaan_baru.php?id=$aset&pid=1";?>> <input type="button" name="#" value="Batal"></a>
	</td>
</tr>


</table>
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