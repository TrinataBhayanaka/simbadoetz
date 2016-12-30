<?php
//include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idPenghapusan = $argv[1];
echo "Id Penghapusan : ".$idPenghapusan."\n\n";


//start process
$time_start = microtime(true); 

//update usulan
$quertUS = "UPDATE usulan SET Status = '1'
			WHERE Penetapan_ID IN ($idPenghapusan)"
			or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);	
//echo "quertUS : ".$quertUS."\n\n";

//update penghapusan
$queryPnghps = "UPDATE penghapusan SET Status = '3'
				WHERE Penghapusan_ID = '{$idPenghapusan}'" or die("Error in the consult.." . mysqli_error($link));
$execPnghps = $link->query($queryPnghps);	
//echo "queryPnghps : ".$queryPnghps."\n\n";

//get all aset
$sqlAst = "SELECT pa.Aset_ID,pa.jenis_penghapusan,p.TglHapus FROM 	        penghapusanaset as pa 
    INNER JOIN penghapusan as p ON p.Penghapusan_ID = pa.Penghapusan_ID  
    where pa.Penghapusan_ID = '{$idPenghapusan}'" or die("Error in the consult.." . mysqli_error($link));

//echo "sqlAst : ".$sqlAst."\n\n";
$result = $link->query($sqlAst); 
$data =array();
while($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
} 
//print_r($data);
echo "Total Data List Aset : ".count($data)."\n\n";
//$temp = array();
foreach ($data as $val) {
    
	//clear value
	$Aset_ID = ''; $jenis_hapus = '';
	$Aset_ID = $val['Aset_ID'];
	$jenis_hapus = $val['jenis_penghapusan'];
	$tgl_hapus = $val['TglHapus'];
    
    /*echo "Aset_ID : ".$Aset_ID."\n\n";
    echo "jenis_hapus : ".$jenis_hapus."\n\n";
    echo "tgl_hapus : ".$tgl_hapus."\n\n";*/
    
    //update penghapusanaset			
	$queryPA = "UPDATE penghapusanaset SET Status = '1'
				WHERE Penghapusan_ID = '{$idPenghapusan}' 
						AND Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));
	$execPA = $link->query($queryPA);	
	//echo "queryPA : ".$queryPA."\n\n";

    //update usulan aset
	$quertUSA = "UPDATE usulanaset SET StatusValidasi='1'
			WHERE Aset_ID = '{$Aset_ID}' AND Penetapan_ID = '{$idPenghapusan}'" or die("Error in the consult.." . mysqli_error($link));	
	$execUSA = $link->query($quertUSA);	
	//echo "quertUS : ".$quertUSA."\n\n";

	//update aset
	$quertAST = "UPDATE aset SET fixPenggunaan = '0' ,StatusValidasi='0',Status_Validasi_Barang = '0'
		WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
	$execAST = $link->query($quertAST);	
	//echo "quertAST : ".$quertAST."\n\n";

	//select tipe aset
	//get all aset
	$sqlTpAst = "SELECT kodeKelompok FROM aset where 
				Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));;
	//echo "sqlTpAst : ".$sqlTpAst."\n\n";
	$result = $link->query($sqlTpAst); 
	while($row = mysqli_fetch_assoc($result)) {
		$TpAst = $row['kodeKelompok'];
	} 

	//get param table
	$exp = explode('.', $TpAst);
	if($exp['0'] == '01'){
		$table = "tanah";
		$tableLog = "log_tanah";
	}elseif ($exp['0'] == '02') {
		$table = "mesin";
		$tableLog = "log_mesin";
	}elseif ($exp['0'] == '03') {
		$table = "bangunan";
		$tableLog = "log_bangunan";
	}elseif ($exp['0'] == '04') {
		$table = "jaringan";
		$tableLog = "log_jaringan";
	}elseif ($exp['0'] == '05') {
		$table = "asetlain";
		$tableLog = "log_asetlain";
	}elseif ($exp['0'] == '06') {
		$table = "kdp";
		$tableLog = "log_kdp";
	}
	//echo "table : ".$table."\n\n";
    //echo "tableLog : ".$tableLog."\n\n";
	
	//get all param to log
	$sqlKIB = "SELECT * FROM {$table} where 
				Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));;
	//echo "sqlKIB : ".$sqlKIB."\n\n";
	$result = $link->query($sqlKIB); 
	$ListParam = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$ListParam = $rows;
	} 
	//print_r($ListParam);
	//update tabel kib
	$quertKIB = "UPDATE {$table} SET StatusTampil = '0' ,StatusValidasi='0',Status_Validasi_Barang = '0'
		WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
	$execKIB = $link->query($quertKIB);	
	//echo "quertKIB : ".$quertKIB."\n\n";

	$tmpField = array();
	$tmpVal = array();
	$sign = "'"; 	
	foreach ($ListParam as $key => $val) {
		//print_r($ListParam);
		//print_r($key);
		//print_r($val);
		$tmpField[] = $key;
		if ($val =='' || $val == NULL){
			$tmpVal[] = 'NULL';
		}else{
			$tmpVal[] = $sign.addslashes($val).$sign;
		}
	}

	$implodeField = implode (',',$tmpField);
	$implodeVal = implode (',',$tmpVal);

	$AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,		AkumulasiPenyusutan_Awal,jenis_hapus";
	$action = "26";
	$changeDate = date('Y-m-d');
	$TglPerubahan = $tgl_hapus;
	$Kd_Riwayat = '26';
	$NilaiPerolehan_Awal = $ListParam['NilaiPerolehan'];
	$AkumulasiPenyusutan_Awal = $ListParam['AkumulasiPenyusutan'];
	$jenis_hapus = $jenis_hapus;
	
	//insert log
	$QueryLog  = "INSERT INTO {$tableLog} ($implodeField,$AddField)
					VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal',
					'$AkumulasiPenyusutan_Awal','$jenis_hapus')" or die("Error in the consult.." . mysqli_error($link));
	
	$execLog = $link->query($QueryLog);	
	//echo "quertAST : ".$QueryLog."\n\n";
}

//update penghapusan
$queryPnghps = "UPDATE penghapusan SET Status = '1'
				WHERE Penghapusan_ID = '{$idPenghapusan}'" or die("Error in the consult.." . mysqli_error($link));
$execPnghps = $link->query($queryPnghps);	
//echo "queryPnghps : ".$queryPnghps."\n\n";
//
$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
