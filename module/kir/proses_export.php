<?php
include "../../config/config.php";
// pr($_POST);

$TahunAsal = $_POST['TahunAsal'];
$TahunTujuan = $_POST['TahunTujuan'];
$hitung = count($_POST['id_tahun']);
/*echo "tahun asal".$TahunAsal;
echo "<br>";
echo "tahun tujuan".$TahunTujuan;
echo "<br>";
echo "hitung".$hitung;
echo "<br>";*/
	
	for($i = 0; $i < $hitung; $i++){
		$id = $_POST['id_tahun'][$i];
		/*$query = "SELECT KodeSektor,KodeSatker,kode,NamaSatker,Gudang,KodeUnit,Kd_Ruang 
												FROM satker 
												WHERE Satker_ID = $id";*/
		
		$result = mysql_fetch_array(mysql_query("SELECT KodeSektor,KodeSatker,kode,NamaSatker,Gudang,KodeUnit,Kd_Ruang 
												FROM satker 
												WHERE Satker_ID = $id"));
		$insert_export =("INSERT INTO satker(KodeSektor,
											KodeSatker,
											kode,
											NamaSatker,
											Gudang,
											KodeUnit,
											Kd_Ruang,
											Tahun) 
									VALUES('$result[KodeSektor]',
										   '$result[KodeSatker]',
										   '$result[kode]',                                 
										   '$result[NamaSatker]',
										   '$result[Gudang]',
										   '$result[KodeUnit]',
										   '$result[Kd_Ruang]',
										   '$TahunTujuan'
										   )");	
										   
		$exec_export = mysql_query($insert_export) or die(mysql_error);										
	}
  echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
redirect($url_rewrite.'/module/kir/filter_ruangan_export.php');
?>