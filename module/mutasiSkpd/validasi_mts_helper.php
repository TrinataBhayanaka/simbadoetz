<?php
//include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idmutasi = $argv[1];
echo "Id mutasi : ".$idmutasi."\n\n";


//start process
$time_start = microtime(true); 

//UPDATE PENETAPAN MUTASI DI MUTASI 
$queryUPD = "UPDATE mutasi
				SET FixMutasi = '3'
			where Mutasi_ID = '{$idmutasi}' " or die("Error in the consult.." . mysqli_error($link));

//update usulan
$quertUS = "UPDATE usulan SET Status = '1'
			WHERE Penetapan_ID IN ($idmutasi)"
			or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);	
//echo "quertUS : ".$quertUS."\n\n";

//update mutasi
$queryPnghps = "UPDATE mutasi SET FixMutasi = '3'
				WHERE Mutasi_ID = '{$idmutasi}'" or die("Error in the consult.." . mysqli_error($link));
$execPnghps = $link->query($queryPnghps);	
//echo "queryPnghps : ".$queryPnghps."\n\n";

//get all aset
$sqlAst = "SELECT pa.*,p.TglSKKDH,p.NoSKKDH FROM mutasiaset as pa 
    INNER JOIN mutasi as p ON p.Mutasi_ID = pa.Mutasi_ID  
    where pa.Mutasi_ID = '{$idmutasi}'" or die("Error in the consult.." . mysqli_error($link));

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
	$Aset_ID = ''; 
	$Aset_ID = $val['Aset_ID'];
	$tgl_mutasi = $val['TglSKKDH'];
	$NoSKKDH = $val['NoSKKDH'];
    echo "Aset_ID : ".$Aset_ID."\n\n";
    /*echo "jenis_hapus : ".$jenis_hapus."\n\n";
    echo "tgl_hapus : ".$tgl_hapus."\n\n";*/
    
    //update usulan aset
	$quertUSA = "UPDATE usulanaset SET StatusValidasi='1'
			WHERE Aset_ID = '{$Aset_ID}' AND Penetapan_ID = '{$idmutasi}'" or die("Error in the consult.." . mysqli_error($link));	
	$execUSA = $link->query($quertUSA);	
	//echo "quertUS : ".$quertUSA."\n\n";

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

	$SatkerTujuan = $val['SatkerTujuan']; 
    $kodeSatker = explode('.', $SatkerTujuan);
    $kodePemilik = substr($ListParam['kodeLokasi'], 0,3);
	$kodeLokasi = $kodePemilik."11.33.".$kodeSatker[0].".".$kodeSatker[1].".".substr($ListParam['Tahun'],-2).".".$kodeSatker[2].".".$kodeSatker[3];
    //$NomorRegBaru = $val['NomorRegBaru'];  

    //NomorRegBaru
	$sqlAsetNew = "SELECT noRegister FROM aset WHERE kodeKelompok = '{$ListParam['kodeKelompok']}' AND kodeLokasi = '{$kodeLokasi}' ORDER BY noRegister DESC LIMIT 1";
	//echo "queryPA : ".$sqlAsetNew."\n\n";
	$resultAsetNew = $link->query($sqlAsetNew);
	$detailAsetNew = mysqli_fetch_assoc($resultAsetNew);
	//print_r($detailAsetNew);
	if($detailAsetNew['noRegister'] == ''){
        $startreg = 0; 
        $NomorRegBaru = $startreg + 1;
    }else{
    	$NomorRegBaru = intval($detailAsetNew['noRegister']) + 1;
    }

      //update mutasiaset			
	$queryPA = "UPDATE mutasiaset SET Status = '1',NomorRegBaru = '{$NomorRegBaru}'
				WHERE Mutasi_ID = '{$idmutasi}' 
						AND Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));
	$execPA = $link->query($queryPA);	
	//echo "queryPA : ".$queryPA."\n\n";

	//update aset
	$quertAST = "UPDATE aset SET kodeLokasi = '{$kodeLokasi}' ,kodeSatker='{$SatkerTujuan}',noRegister = '{$NomorRegBaru}',TglPembukuan = '{$tgl_mutasi}'
		WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
	$execAST = $link->query($quertAST);	
	//echo "quertAST : ".$quertAST."\n\n";

	//update tabel sqlKIB
	$quertKIB = "UPDATE {$table} SET kodeLokasi = '{$kodeLokasi}' ,kodeSatker='{$SatkerTujuan}',noRegister = '{$NomorRegBaru}', TglPembukuan = '{$tgl_mutasi}'
		WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
	$execKIB = $link->query($quertKIB);	
	//echo "quertKIB : ".$quertKIB."\n\n";

	// log pertama
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

	$AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,No_Dokumen";
	$action = "Data Mutasi sebelum diubah";
	$changeDate = date('Y-m-d');
	$TglPerubahan = $tgl_mutasi;
	$Kd_Riwayat = '3';
	$NilaiPerolehan_Awal = $ListParam['NilaiPerolehan'];
	$No_Dokumen = $NoSKKDH;
	
	//insert log
	$QueryLog  = "INSERT INTO {$tableLog} ($implodeField,$AddField)
					VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal','$No_Dokumen')" or die("Error in the consult.." . mysqli_error($link));
	
	$execLog = $link->query($QueryLog);	
	//echo "quertAST : ".$QueryLog."\n\n";

	//log kedua
	//get all param to log
	$sqlKIB2 = "SELECT * FROM {$table} where 
				Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));;
	//echo "sqlKIB : ".$sqlKIB."\n\n";
	$result2 = $link->query($sqlKIB2); 
	$ListParam2 = array();
	while($rows2 = mysqli_fetch_assoc($result2)) {
		$ListParam2 = $rows2;
	} 
	
	// log kedua
	$tmpField2 = array();
	$tmpVal2 = array();
	$sign2 = "'"; 	
	foreach ($ListParam2 as $key2 => $val2) {
		//print_r($ListParam);
		//print_r($key);
		//print_r($val);
		$tmpField2[] = $key2;
		if ($val2 =='' || $val2 == NULL){
			$tmpVal2[] = 'NULL';
		}else{
			if($key2 == 'TglPembukuan'){
				$tmpVal2[] = $sign2.addslashes($tgl_mutasi).$sign2;
			}else{
				$tmpVal2[] = $sign2.addslashes($val2).$sign2;			
			}
		}
	}

	$implodeField2 = implode (',',$tmpField2);
	$implodeVal2 = implode (',',$tmpVal2);

	$AddField2 = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,No_Dokumen";
	$action2 = "Sukses Mutasi";
	$changeDate2 = date('Y-m-d');
	$TglPerubahan2 = $tgl_mutasi;
	$Kd_Riwayat2 = '3';
	$NilaiPerolehan_Awal2 = $ListParam['NilaiPerolehan'];
	$No_Dokumen2 = $NoSKKDH;
	
	//insert log
	$QueryLog2  = "INSERT INTO {$tableLog} ($implodeField2,$AddField2)
					VALUES ($implodeVal2,'$action2','$changeDate2','$TglPerubahan2','$Kd_Riwayat2','$NilaiPerolehan_Awal2','$No_Dokumen2')" or die("Error in the consult.." . mysqli_error($link));
	
	$execLog2 = $link->query($QueryLog2);	
	//echo "quertAST : ".$QueryLog2."\n\n";

}

//update mutasi
$queryPnghps = "UPDATE mutasi SET FixMutasi = '1'
				WHERE Mutasi_ID = '{$idmutasi}'" or die("Error in the consult.." . mysqli_error($link));
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
