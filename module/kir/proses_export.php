<?php
include "../../config/config.php";
//pr($_POST);
//exit;
$TahunAsal = $_POST['TahunAsal'];
$TahunTujuan = $_POST['TahunTujuan'];
$hitung = count($_POST['id_tahun']);
$kode = $_POST['kodeSatker'];

	//delete ruangan tahun tujuan
	$query_select_ruangan_fix ="delete from satker where kode = '$kode' 
							and Tahun = '$TahunTujuan' 
							and Kd_Ruang is not null"; 
	//pr($query_select_ruangan_fix);
	$exec =  mysql_query($query_select_ruangan_fix);
	
	for($i = 0; $i < $hitung; $i++){
		$id = $_POST['id_tahun'][$i];
		/*$query = "SELECT KodeSektor,KodeSatker,kode,NamaSatker,Gudang,KodeUnit,Kd_Ruang 
												FROM satker 
												WHERE Satker_ID = $id";*/
		//pr($query);
		$result = mysql_fetch_array(mysql_query("SELECT KodeSektor,KodeSatker,kode,NamaSatker,Gudang,KodeUnit,Kd_Ruang 
												FROM satker 
												WHERE Satker_ID = $id"));
		//pr($result);
		//exit();
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