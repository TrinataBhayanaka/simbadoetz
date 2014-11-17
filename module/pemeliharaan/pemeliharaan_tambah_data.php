<?php

$id = $_GET['id'];	
			
if(isset($_POST['submit'])){
$dataArr = $STORE->store_pemeliharaan_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));	
echo "<script type=text/javascript>alert(\"Data Berhasil Disimpan\");window.location.href=\"$url_rewrite/module/pemeliharaan/pemeliharaan_view_detail.php?id=$id&pid=1\";</script>";
// exit;				
}

?>
<html>
<body>

<!-- Script Tangggal -->
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
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
	}
	);
</script>   
<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
<!-- Script Tangggal -->

<form action="" method="POST">
	<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
        <tr>
			<th align="left" class="" style="font-weight: bold; font-style: underline; text-decoration: underline;">Dokumen Pemeliharaan</th>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left" width="150px" >No BA Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" name="idpemeliharaan_nomor" id="idpemeliharaan_nomor" value="" required="required">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Tanggal Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:100px; text-align: center;" name="idpemeliharaan_tanggal" id="tanggal12" datepicker="true" value="" required="required">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Jenis Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<select name="idpemeliharaan_jenis" id="idpemeliharaan_jenis" style="width:100px">
					<option value="Ringan"  >Ringan</option>
					<option value="Sedang"  >Sedang</option>
					<option value="Berat"  >Berat</option>
				</select>
			</td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Biaya Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" id="idpemeliharaan_biaya" name="idpemeliharaan_biaya" value="0,00" required="required" onchange="return format_nilai_3();">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Keterangan Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<textarea style="width:90%;"name="idpemeliharaan_keterangan" id="idpemeliharaan_keterangan" required="required"></textarea>
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Nama Pemelihara</td>
			<td class="listdata" valign="top" align="left"> 
				<input type="text" style="width:90%;" name="idpemeliharaan_nama" id="idpemeliharaan_nama" value="" >
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">NIP Pemelihara</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" name="idpemeliharaan_nip" id="idpemeliharaan_nip" value="" >
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Jabatan Pemelihara</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:90%;" name="idpemeliharaan_jabatan" id="idpemeliharaan_jabatan" value="" >
            </td>
        </tr>
		<tr>
			<td class="listdata" valign="top" align="left">Nama Penyedia Jasa</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:90%;"   name="idpemeliharaan_penyedia" id="idpemeliharaan_penyedia" value="" >
            </td>
        </tr>        
        <tr>
			<td colspan="2" style="border:0px;">&nbsp;</td>
        </tr>
    </table>
	  
    <br>
	  
    <table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
		<tr>
			<th align="left"  class="listdata" colspan="2" style="font-weight: bold; font-style: underline; text-decoration: underline;">Perubahan Nilai Yang Terjadi</th>
		</tr>
        <tr>
			<td class="listdata" valign="top" align="left" width="150px">Nilai Aset Sebelum Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" id="idnilai_sebelum" name="idnilai_sebelum"  value="0,00" required="required" onchange="return format_nilai_1();">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Nilai Aset Setelah Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" id="idnilai_setelah" name="idnilai_setelah" value="0,00" required="required" onchange="return format_nilai_2();">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Keterangan Nilai</td>
			<td class="listdata" valign="top" align="left">
				<textarea id="idnilai_keterangan" name="idnilai_keterangan" style="width: 90%;" required="required"></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2" style="border:0px;">&nbsp;</td>
        </tr>
	</table>
      
	<br>
      
	<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
		<tr>
			<th align="left" class="listdata" colspan="2" style="font-weight: bold; font-style: underline; text-decoration: underline;">Perubahan Kondisi Yang Terjadi</th>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left" width="150px">Kondisi</td>
			<td class="listdata" valign="top" align="left">
				<input type="radio" name="kondisi" value="baik" /> Baik <br />
				<input type="radio" name="kondisi" value="ringan" /> Rusak Ringan <br />
				<input type="radio" name="kondisi" value="berat" /> Rusak Berat
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Info Kondisi</td>
			<td class="listdata" valign="top" align="left">
				<textarea style="width:90%;" name="idkondisi_info" id="idkondisi_info"></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2" style="border:0px;">&nbsp;</td>
        </tr>
        <tr>
			<td colspan="2" style="border:1px solid #cccccc; padding:5px; text-align:right;">
				<input type="submit" style="width:100px;" id="submit" name="submit" value="Simpan">
				<input type="button" style="width:100px;" id="idbtnactcancel" name="idbtnactcancel" value="Batal" onclick="document.location='pemeliharaan_view_detail.php?id=21&pid=1'">
            </td>
        </tr>
    </table>
</form>
</body>
</html>