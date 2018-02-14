<?php
include "../../config/database.php";  
open_connection();  
		
	$id = $_POST['id'];
	
	$sql = mysql_query("SELECT kodeSatker,kodeKelompok,noRegister,TglPerolehan,TglPembukuan,kondisi,NilaiPerolehan,Info FROM aset WHERE Aset_ID = '{$id}'");
	$row = mysql_fetch_assoc($sql);
	$tipeAset = explode('.', $row['kodeKelompok']);
	if($tipeAset['0'] == '02'){
		$sqlAset = mysql_query("SELECT kodeSatker,kodeKelompok,noRegister,TglPerolehan,TglPembukuan,kondisi,NilaiPerolehan,Info,NoSeri,NoRangka,NoSTNK FROM mesin WHERE Aset_ID = '{$id}' ");
	}else{
		$sqlAset = mysql_query("SELECT kodeSatker,kodeKelompok,noRegister,TglPerolehan,TglPembukuan,kondisi,NilaiPerolehan,Info FROM aset WHERE Aset_ID = '{$id}'");
	}

	while ($rows = mysql_fetch_assoc($sqlAset)){
				$data= $rows;
	}
		echo json_encode($data);
	exit;

?>