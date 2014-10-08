<?php
//include "../../config/config.php";
open_connection();

if(isset($_GET['idubah']))
{
	$idubah = $_GET['idubah'];	
	$id		= $_GET['id'];	
}

$query_tampil_edit1	= "SELECT NoBAPemeliharaan, TglPemeliharaan, JenisPemeliharaan, Biaya, KeteranganPemeliharaan,
							NamaPemelihara, NIPPemelihara, JabatanPemelihara, NamaPenyediaJasa
							FROM Pemeliharaan
							WHERE
							Pemeliharaan_ID='".$idubah."' AND Aset_ID='".$id."'
							";
// pr($query_tampil_edit1);							
$result1			= 	mysql_query($query_tampil_edit1) or die (mysql_error());
$hsl_data1 			= 	mysql_fetch_array($result1);

$tgl1=explode("-",$hsl_data1['TglPemeliharaan']);
$tgl2=$tgl1[2]."/".$tgl1[1]."/".$tgl1[0];



$query_tampil_edit2	= "SELECT FromNilai, ToNilai, KeteranganNilai
						FROM NilaiAset
						WHERE
						Pemeliharaan_ID='".$idubah."' AND Aset_ID='".$id."'
						";
// pr($query_tampil_edit2);						
$result2			= 	mysql_query($query_tampil_edit2) or die (mysql_error());
$hsl_data2 			= 	mysql_fetch_array($result2);

$query_tampil_edit3	= "SELECT InfoKondisi, Baik, RusakRingan, RusakBerat
						FROM Kondisi
						WHERE
						Pemeliharaan_ID='".$idubah."' AND Aset_ID='".$id."'
						";
// pr($query_tampil_edit3);						
$result3			= 	mysql_query($query_tampil_edit3) or die (mysql_error());
$hsl_data3 			= 	mysql_fetch_array($result3);


$kondisi ="";
if($hsl_data3[Baik]==1)
	$kondisi="baik";
if ($hsl_data3[RusakRingan]==1)
	$kondisi="ringan";
if($hsl_data3[RusatBerat]==1)
	$kondisi="berat";
					
$InfoKondisi		= $hsl_data3['InfoKondisi'];

//------------------------------------------------------------------------------------------------------------------

if(isset($_POST['submit'])){
	
	$nobapem		= $_POST['idpemeliharaan_nomor'];
	
	$tanggal		= explode("/",$_POST['idpemeliharaan_tanggal']);
	$tglpem			= $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	
	$jenispem		= $_POST['idpemeliharaan_jenis'];
	$biayapemExpld	= explode(",",$_POST['idpemeliharaan_biaya']);
	$biayapem 		= str_replace(".", "", $biayapemExpld[0]);
	
	$ketpem			= $_POST['idpemeliharaan_keterangan'];
	$namapem		= $_POST['idpemeliharaan_nama'];
	$nippem			= $_POST['idpemeliharaan_nip'];
	$jabpem			= $_POST['idpemeliharaan_jabatan'];
	$namajasapem	= $_POST['idpemeliharaan_penyedia'];
	
	$nilai_setelahExpld = explode(",",$_POST['idnilai_setelah']);
	$nilai_setelah 		= str_replace(".", "", $nilai_setelahExpld[0]);
	
	$nilai_sebelumExpld	= explode(",",$_POST['idnilai_sebelum']);
	$nilai_sebelum 		= str_replace(".", "", $nilai_sebelumExpld[0]);
	
	$nilai_keterangan	= $_POST['idnilai_keterangan'];
	
	$kondisi			= $_POST['kondisi'];
	$baik 		= 0;
	$ringan 	= 0;
	$berat 		= 0;
	
	switch ($kondisi) {
		case "baik" : 
			$baik = 1;
			$ringan = 0;
			$berat = 0;
			break;
		
		case "ringan" : 
			$baik = 0;
			$ringan = 1;
			$berat = 0;
			break;
		
		case "berat" : 
			$baik = 0;
			$ringan = 0;
			$berat = 1;
			break;	
	};
	
	$idkondisi_info		= $_POST['idkondisi_info'];
	
	$pemeliharaan_id=get_auto_increment("Pemeliharaan");
	
	$query_simpan1		= 	"UPDATE Pemeliharaan 
							SET
							NoBAPemeliharaan		='".$nobapem."',		
							TglPemeliharaan			='".$tglpem."',			
							JenisPemeliharaan		='".$jenispem."',
							Biaya					='".$biayapem."',
							KeteranganPemeliharaan	='".$ketpem."',	
							NamaPemelihara			='".$namapem."',
							NIPPemelihara			='".$nippem."',
							JabatanPemelihara		='".$jabpem."',
							NamaPenyediaJasa		='".$namajasapem."',
							TglUpdate			='".date('Y-m-d')."'
							WHERE 
							Pemeliharaan_ID = ".$idubah." AND 
							Aset_ID 		= ".$id."
							";
	//print_r($query_simpan1);
	
	$insert1			= 	mysql_query($query_simpan1) or die (mysql_error());
	
	$query_simpan2		= 	"UPDATE NilaiAset
							SET
							ToNilai				='".$nilai_setelah."',
							FromNilai			='".$nilai_sebelum."',
							KeteranganNilai		='".$nilai_keterangan."',
							TglUpdate			='".date('Y-m-d')."'
							WHERE
							Pemeliharaan_ID = ".$idubah." AND 
							Aset_ID 		= ".$id."
							  ";
							  
	$insert2 = mysql_query($query_simpan2) or die (mysql_error());
	
	$query_simpan3		= 	"UPDATE Kondisi
							SET
							InfoKondisi		='".$idkondisi_info."',
							Baik			='".$baik."',
							RusakRingan		='".$ringan."',
							RusakBerat		='".$berat."',
							TglUpdate		='".date('Y-m-d')."'
							WHERE
							Pemeliharaan_ID = ".$idubah." AND 
							Aset_ID 		= ".$id."
							  ";
	// pr($query_simpan3);
	// exit;	
	$insert3 = mysql_query($query_simpan3) or die (mysql_error());
	
	if ($insert1 && $insert2 && $insert3)
	{
			echo "<script type=text/javascript>alert(\"Data Berhasil Disimpan\");window.location.href=\"?id=$id&pid=1\";</script>";
	}
	else{
			echo '<script type=text/javascript>alert("Data Gagal Diedit");</script>';
	}
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
			<td><b>Data Baru</b></td>
        </tr>
        <tr>
			<th align="left" class="listdata" colspan="2"><br>Dokumen Pemeliharaan<br></th>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left" width="150px">No BA Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" name="idpemeliharaan_nomor" id="idpemeliharaan_nomor" value="<?php echo $hsl_data1['NoBAPemeliharaan'];?>">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Tanggal Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:100px; text-align: center;" name="idpemeliharaan_tanggal" id="tanggal12" datepicker="true" value="<?php echo $tgl2;?>">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Jenis Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<select name="idpemeliharaan_jenis" id="idpemeliharaan_jenis" style="width:100px">
					<?php 
					if($hsl_data1['JenisPemeliharaan'] == 'Ringan'){
						$a = "selected";
						$b = "";
						$c = "";
					}elseif($hsl_data1['JenisPemeliharaan'] == 'Sedang'){
						$a = "";
						$b = "selected";
						$c = "";
					}elseif($hsl_data1['JenisPemeliharaan'] == 'Berat'){
						$a = "";
						$b = "";
						$c = "selected";
					}
					
					?>
					<option value="Ringan" <?php echo $a;?>>Ringan</option>
					<option value="Sedang" <?php echo $b;?>>Sedang</option>
					<option value="Berat"  <?php echo $c;?>>Berat</option>
				</select>
			</td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Biaya Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" id="idpemeliharaan_biaya" name="idpemeliharaan_biaya" currencyedit="true" value="<?php echo number_format($hsl_data1['Biaya'],2,',','.') ?>" onchange="return format_nilai_3();">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Keterangan Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<textarea style="width:90%;"name="idpemeliharaan_keterangan" id="idpemeliharaan_keterangan"><?php echo $hsl_data1['KeteranganPemeliharaan'];?></textarea>
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Nama Pemelihara</td>
			<td class="listdata" valign="top" align="left"> 
				<input type="text" style="width:90%;" name="idpemeliharaan_nama" id="idpemeliharaan_nama" value="<?php echo $hsl_data1['NamaPemelihara'];?>">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">NIP Pemelihara</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" name="idpemeliharaan_nip" id="idpemeliharaan_nip" value="<?php echo $hsl_data1['NIPPemelihara'];?>">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Jabatan Pemelihara</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:90%;" name="idpemeliharaan_jabatan" id="idpemeliharaan_jabatan" value="<?php echo $hsl_data1['JabatanPemelihara'];?>">
            </td>
        </tr>
		<tr>
			<td class="listdata" valign="top" align="left">Nama Penyedia Jasa</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:90%;"   name="idpemeliharaan_penyedia" id="idpemeliharaan_penyedia" value="<?php echo $hsl_data1['NamaPenyediaJasa'];?>">
            </td>
        </tr>        
        <tr>
			<td colspan="2" style="border:0px;">&nbsp;</td>
        </tr>
    </table>
	  
    <br>
	  
    <table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
		<tr>
			<th align="left"  class="listdata" colspan="2">Perubahan Nilai Yang Terjadi</th>
		</tr>
        <tr>
			<td class="listdata" valign="top" align="left" width="150px">Nilai Aset Sebelum Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" id="idnilai_sebelum" name="idnilai_sebelum" value="<?php echo number_format($hsl_data2['FromNilai'],2,',','.') ?>" onchange="return format_nilai_1();">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Nilai Aset Setelah Pemeliharaan</td>
			<td class="listdata" valign="top" align="left">
				<input type="text" style="width:180px;" id="idnilai_setelah" name="idnilai_setelah" value="<?php echo number_format($hsl_data2['ToNilai'],2,',','.')?>" onchange="return format_nilai_2();">
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Keterangan Nilai</td>
			<td class="listdata" valign="top" align="left">
				<textarea id="idnilai_keterangan" name="idnilai_keterangan" style="width: 90%;"><?php echo $hsl_data2['KeteranganNilai'];?></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2" style="border:0px;">&nbsp;</td>
        </tr>
	</table>
      
	<br>
      
	<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
		<tr>
			<th align="left" class="listdata" colspan="2">Perubahan Kondisi Yang Terjadi</th>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left" width="150px">Kondisi</td>
			<td class="listdata" valign="top" align="left">
			<?php
					if($hsl_data3['Baik'] == 1 && $hsl_data3['RusakRingan'] == 0 && $hsl_data3['RusakBerat'] == 0){
						echo "<input type=\"radio\" name=\"kondisi\" value=\"baik\" checked/> Baik <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"ringan\" /> Rusak Ringan <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"berat\" /> Rusat Berat<br />";
					
					}elseif($hsl_data3['Baik'] == 0 && $hsl_data3['RusakRingan'] == 1 && $hsl_data3['RusakBerat'] == 0){
						echo "<input type=\"radio\" name=\"kondisi\" value=\"baik\" /> Baik <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"ringan\" checked/> Rusak Ringan <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"berat\" /> Rusat Berat<br />";
					
					}elseif($hsl_data3['Baik'] == 0 && $hsl_data3['RusakRingan'] == 0 && $hsl_data3['RusakBerat'] == 1){
						echo "<input type=\"radio\" name=\"kondisi\" value=\"baik\" > Baik <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"ringan\" /> Rusak Ringan <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"berat\" checked//> Rusat Berat<br />";
					}else{
						echo "<input type=\"radio\" name=\"kondisi\" value=\"baik\" > Baik <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"ringan\" /> Rusak Ringan <br />";
						echo "<input type=\"radio\" name=\"kondisi\" value=\"berat\" //> Rusat Berat<br />";
					}
			?>
            </td>
        </tr>
        <tr>
			<td class="listdata" valign="top" align="left">Info Kondisi</td>
			<td class="listdata" valign="top" align="left">
				<textarea style="width:90%;" name="idkondisi_info" id="idkondisi_info"><?php echo $hsl_data3['InfoKondisi'];?></textarea>
            </td>
        </tr>
        <tr>
			<td colspan="2" style="border:0px;">&nbsp;</td>
        </tr>
        <tr>
			<td colspan="2" style="border:1px solid #cccccc; padding:5px; text-align:right;">
				<input type="submit" style="width:100px;" id="submit" name="submit" value="Simpan">
				<input type="button" style="width:100px;" id="idbtnactcancel" name="idbtnactcancel" value="Batal" onclick="document.location='pemeliharaan_view_detail.php?id=<?=$id?>&pid=1'">
            </td>
        </tr>
    </table>
</form>

</body>
</html>