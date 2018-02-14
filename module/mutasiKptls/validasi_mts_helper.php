<?php
//include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idmutasi = $argv[1];
echo "Id mutasi : ".$idmutasi."\n\n";

$tahunFlag = $argv[2];
echo "Tahun Aktif : ".$tahunFlag."\n\n";

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
	$Aset_ID_Tujuan = $val['Aset_ID_Tujuan'];
	$tgl_mutasi = $val['TglSKKDH'];
	$NoSKKDH = $val['NoSKKDH'];
    echo "Aset_ID : ".$Aset_ID."\n\n";
    /*echo "jenis_hapus : ".$jenis_hapus."\n\n";
    echo "tgl_hapus : ".$tgl_hapus."\n\n";*/
    
    //update usulan aset
	$quertUSA = "UPDATE usulanaset SET StatusValidasi='1'
			WHERE Aset_ID = '{$Aset_ID}' AND Penetapan_ID = '{$idmutasi}'" or die("Error in the consult.." . mysqli_error($link));	
	$execUSA = $link->query($quertUSA);	
	echo "quert update usulan aset : ".$quertUSA."\n\n";

	  //update mutasiaset			
	$queryPA = "UPDATE mutasiaset SET Status = '1'
				WHERE Mutasi_ID = '{$idmutasi}' 
						AND Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));
	$execPA = $link->query($queryPA);	
	echo "query update mutasi aset : ".$queryPA."\n\n";


	//select tipe aset Tujuan
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

	//select tipe aset Asal
	//get all aset
	$sqlTpAstTujuan = "SELECT kodeKelompok FROM aset where 
				Aset_ID = '{$Aset_ID_Tujuan}'" 
				or die("Error in the consult.." . mysqli_error($link));;
	//echo "sqlTpAst : ".$sqlTpAst."\n\n";
	$resultTpAstTujuan = $link->query($sqlTpAstTujuan); 
	while($rowTpAstTujuan = mysqli_fetch_assoc($resultTpAstTujuan)) {
		$TpAstTujuan = $rowTpAstTujuan['kodeKelompok'];
	} 

	//get param table
	$exp2 = explode('.', $TpAstTujuan);
	if($exp2['0'] == '01'){
		$table2 = "tanah";
		$tableLog2 = "log_tanah";
	}elseif ($exp2['0'] == '02') {
		$table2 = "mesin";
		$tableLog2 = "log_mesin";
	}elseif ($exp2['0'] == '03') {
		$table2 = "bangunan";
		$tableLog2 = "log_bangunan";
	}elseif ($exp2['0'] == '04') {
		$table2 = "jaringan";
		$tableLog2 = "log_jaringan";
	}elseif ($exp2['0'] == '05') {
		$table2 = "asetlain";
		$tableLog2 = "log_asetlain";
	}elseif ($exp2['0'] == '06') {
		$table2 = "kdp";
		$tableLog2 = "log_kdp";
	}

	//echo "table : ".$table."\n\n";
    //echo "tableLog : ".$tableLog."\n\n";
	
	//get all param to log
	//Aset_ID Asal Kapitalisasi
	$sqlKIB = "SELECT * FROM {$table} where 
				Aset_ID = '{$Aset_ID}'" 
				or die("Error in the consult.." . mysqli_error($link));;
	//echo "sqlKIB : ".$sqlKIB."\n\n";
	$result = $link->query($sqlKIB); 
	$ListParam = array();
	while($rows = mysqli_fetch_assoc($result)) {
		$ListParam = $rows;
	} 
	$TahunAsetIdAsal = $ListParam['Tahun'];

	//Aset_ID Tujuan Kapitalisasi
	$sqlKIB_2 = "SELECT * FROM {$table2} where 
				Aset_ID = '{$Aset_ID_Tujuan}'" 
				or die("Error in the consult.." . mysqli_error($link));;
	//echo "sqlKIB : ".$sqlKIB."\n\n";
	$result2 = $link->query($sqlKIB_2); 
	$ListParam2 = array();
	while($rows2 = mysqli_fetch_assoc($result2)) {
		$ListParam2 = $rows2;
	}
	$TahunAsetIdTujuan = $ListParam2['Tahun'];
	

	//set koreksi atau kapitalisasi
	if($TahunAsetIdAsal == $tahunFlag){
		//kapitalisasi
		echo "Kapitalisasi"."\n\n";

		//Hitung penyusutan
		$kapitalisasi = $ListParam['NilaiPerolehan'];
		echo "kapitalisasi : ".$kapitalisasi."\n\n";
		
		$nilaiBukuOld = $ListParam2['NilaiBuku'];
		echo "nilaiBukuOld : ".$nilaiBukuOld."\n\n";

		$nilaiBukuNew = $kapitalisasi + $nilaiBukuOld;
		echo "nilaiBukuNew : ".$nilaiBukuNew."\n\n";
		
		$NilaiPerolehanOld = $ListParam2['NilaiPerolehan'];
		echo "NilaiPerolehanOld : ".$NilaiPerolehanOld."\n\n";
		
		$NilaiPerolehanNew = $NilaiPerolehanOld + $kapitalisasi;
		echo "NilaiPerolehanNew : ".$NilaiPerolehanNew."\n\n";
		
		//update aset Tujuan
		$quertASTTujuan = "UPDATE aset SET NilaiBuku = '{$nilaiBukuNew}', NilaiPerolehan = '{$NilaiPerolehanNew}'
			WHERE Aset_ID = '{$Aset_ID_Tujuan}'" or die("Error in the consult.." . mysqli_error($link));	
		$execASTTujuan = $link->query($quertASTTujuan);	
		echo "query aset tujuan : ".$quertASTTujuan."\n\n";

		//update tabel sqlKIB Tujuan
		$quertKIBTujuan = "UPDATE {$table2} SET NilaiBuku = '{$nilaiBukuNew}', NilaiPerolehan = '{$NilaiPerolehanNew}'
			WHERE Aset_ID = '{$Aset_ID_Tujuan}'" or die("Error in the consult.." . mysqli_error($link));	
		$execKIBTujuan = $link->query($quertKIBTujuan);	
		echo "query KIB Tujuan : ".$quertKIBTujuan."\n\n";

		//insert log aset Tujuan
		$tmpFieldAST = array();
		$tmpValAST = array();
		$sign = "'"; 	
		foreach ($ListParam2 as $keyAST => $valAST) {
			//print_r($ListParam);
			//print_r($key);
			//print_r($val);
			$tmpFieldAST[] = $keyAST;
			if ($valAST =='' || $valAST == NULL){
				$tmpValAST[] = 'NULL';
			}else{
				if($keyAST == 'NilaiBuku'){
					$tmpValAST[] = $sign.addslashes($nilaiBukuNew).$sign;
				}elseif($keyAST == 'NilaiPerolehan'){
					$tmpValAST[] = $sign.addslashes($NilaiPerolehanNew).$sign;
				}else{
					$tmpValAST[] = $sign.addslashes($valAST).$sign;			
				}
			}
		}
		$implodeFieldAST = implode (',',$tmpFieldAST);
		$implodeValAST = implode (',',$tmpValAST);

		$AddFieldAST = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,No_Dokumen,NilaiBuku_Awal";
		$action = "Sukses kapitalisasi Mutasi";
		$changeDate = date('Y-m-d');
		$TglPerubahan = $tgl_mutasi;
		$Kd_Riwayat = '291';
		$NilaiPerolehan_Awal = $ListParam2['NilaiPerolehan'];
		$NilaiBuku_Awal = $ListParam2['NilaiBuku'];

		$No_Dokumen = $NoSKKDH;
		
		$QueryLogAST  = "INSERT INTO {$tableLog2} ($implodeFieldAST,$AddFieldAST)
						VALUES ($implodeValAST,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal','$No_Dokumen',$NilaiBuku_Awal)" or die("Error in the consult.." . mysqli_error($link));
		
		$execLog = $link->query($QueryLogAST);	
		echo "query Log Tujuan : ".$QueryLogAST."\n\n";

		//insert log aset Asal
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
		$action = "Aset Penambahan kapitalisasi Mutasi";
		$changeDate = date('Y-m-d');
		$TglPerubahan = $tgl_mutasi;
		$Kd_Riwayat = '29';
		$NilaiPerolehan_Awal = $ListParam['NilaiPerolehan'];
		$No_Dokumen = $NoSKKDH;
		
		//insert log
		$QueryLogAsal  = "INSERT INTO {$tableLog} ($implodeField,$AddField)
						VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal','$No_Dokumen')" or die("Error in the consult.." . mysqli_error($link));
		
		$execLog = $link->query($QueryLogAsal);	
		echo "query Log Asal : ".$QueryLogAsal."\n\n";

		//update aset Asal
		$quertAST = "UPDATE aset SET StatusValidasi = '2',Status_Validasi_Barang = '2'
			WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
		$execAST = $link->query($quertAST);	
		echo "query Aset Asal : ".$quertAST."\n\n";

		//update tabel sqlKIB Asal
		$quertKIB = "UPDATE {$table} SET StatusValidasi = '2',Status_Validasi_Barang = '2',StatusTampil = '2'
			WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
		$execKIB = $link->query($quertKIB);	
		echo "query KIB Asal : ".$quertKIB."\n\n";

	}else{
		//koreksi
		echo "koreksi"."\n\n";

		//Hitung penyusutan
		$koreksi = $ListParam['NilaiPerolehan']; 
		echo "koreksi : ".$koreksi."\n\n";
		
		$NilaiPerolehanOld = $ListParam2['NilaiPerolehan'];
		echo "NilaiPerolehanOld : ".$NilaiPerolehanOld."\n\n";
		
		$NilaiPerolehanNew = $NilaiPerolehanOld + $koreksi;
		echo "NilaiPerolehanNew : ".$NilaiPerolehanNew."\n\n";
		
		$MasaManfaat = $ListParam2['MasaManfaat'];
		echo "MasaManfaat : ".$MasaManfaat."\n\n";
		
		$tmpPPKoreksi = $koreksi / $MasaManfaat;
		echo "tmpPPKoreksi : ".$tmpPPKoreksi."\n\n";
		
		$PPKoreksi = round($tmpPPKoreksi);
		echo "PPKoreksi : ".$PPKoreksi."\n\n";
		
		$tmpAkmKoreksi = $tahunFlag - $TahunAsetIdAsal;
		echo "tahunFlag : ".$tahunFlag."\n\n";
		echo "TahunAsetIdAsal : ".$TahunAsetIdAsal."\n\n";
		echo "tmpAkmKoreksi : ".$tmpAkmKoreksi."\n\n";
		
		$AkmKoreksi = $tmpAkmKoreksi * $PPKoreksi;
		echo "AkmKoreksi : ".$AkmKoreksi."\n\n";
		
		$AkumulasiNew = $ListParam2['AkumulasiPenyusutan'] + $AkmKoreksi;
		echo "AkumulasiNew : ".$AkumulasiNew."\n\n";
		
		$PPNew = $ListParam2['PenyusutanPerTahun'] + $PPKoreksi;
		echo "PPNew : ".$PPNew."\n\n";
		
		$NilaiBukuNew = $NilaiPerolehanNew - $AkumulasiNew;
		echo "NilaiBukuNew : ".$NilaiBukuNew."\n\n";
		
		//update aset Tujuan
		$quertASTTujuan = "UPDATE aset SET NilaiPerolehan = '{$NilaiPerolehanNew}' , AkumulasiPenyusutan = '{$AkumulasiNew}', PenyusutanPertaun = '{$PPNew}', NilaiBuku = '{$NilaiBukuNew}'
			WHERE Aset_ID = '{$Aset_ID_Tujuan}'" or die("Error in the consult.." . mysqli_error($link));	
		$execASTTujuan = $link->query($quertASTTujuan);	
		echo "query aset tujuan : ".$quertASTTujuan."\n\n";

		//update tabel sqlKIB Tujuan
		$quertKIBTujuan = "UPDATE {$table2} SET NilaiPerolehan = '{$NilaiPerolehanNew}',AkumulasiPenyusutan = '{$AkumulasiNew}',
			PenyusutanPerTahun = '{$PPNew}', NilaiBuku = '{$NilaiBukuNew}'
			WHERE Aset_ID = '{$Aset_ID_Tujuan}'" or die("Error in the consult.." . mysqli_error($link));	
		$execKIBTujuan = $link->query($quertKIBTujuan);	
		echo "query KIB Tujuan : ".$quertKIBTujuan."\n\n";

		//insert log aset Tujuan
		$tmpFieldAST = array();
		$tmpValAST = array();
		$sign = "'"; 	
		foreach ($ListParam2 as $keyAST => $valAST) {
			//print_r($ListParam);
			//print_r($key);
			//print_r($val);
			$tmpFieldAST[] = $keyAST;
			if ($valAST =='' || $valAST == NULL){
				$tmpValAST[] = 'NULL';
			}else{
				if($keyAST == 'NilaiPerolehan'){
					$tmpValAST[] = $sign.addslashes($NilaiPerolehanNew).$sign;
				}elseif($keyAST == 'AkumulasiPenyusutan'){
					$tmpValAST[] = $sign.addslashes($AkumulasiNew).$sign;
				}elseif($keyAST == 'PenyusutanPerTahun'){
					$tmpValAST[] = $sign.addslashes($PPNew).$sign;
				}elseif($keyAST == 'NilaiBuku'){
					$tmpValAST[] = $sign.addslashes($NilaiBukuNew).$sign;
				}else{
					$tmpValAST[] = $sign.addslashes($valAST).$sign;			
				}
			}
		}
		$implodeFieldAST = implode (',',$tmpFieldAST);
		$implodeValAST = implode (',',$tmpValAST);

		$AddFieldAST = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,No_Dokumen,AkumulasiPenyusutan_Awal,PenyusutanPerTahun_Awal,NilaiBuku_Awal";
		$action = "Sukses kapitalisasi Mutasi";
		$changeDate = date('Y-m-d');
		$TglPerubahan = $tgl_mutasi;
		$Kd_Riwayat = '281';
		$NilaiPerolehan_Awal = $ListParam2['NilaiPerolehan'];
		$AkumulasiPenyusutan_Awal = $ListParam2['AkumulasiPenyusutan'];
		$PenyusutanPerTahun_Awal = $ListParam2['PenyusutanPerTahun'];
		$NilaiBuku_Awal = $ListParam2['NilaiBuku'];
		$No_Dokumen = $NoSKKDH;
		
		$QueryLogAST  = "INSERT INTO {$tableLog2} ($implodeFieldAST,$AddFieldAST)
						VALUES ($implodeValAST,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal','$No_Dokumen',$AkumulasiPenyusutan_Awal,$PenyusutanPerTahun_Awal,$NilaiBuku_Awal)" or die("Error in the consult.." . mysqli_error($link));
		
		$execLog = $link->query($QueryLogAST);	
		echo "query Log Tujuan : ".$QueryLogAST."\n\n";

		//insert log aset Asal
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
		$action = "Aset Penambahan kapitalisasi Mutasi";
		$changeDate = date('Y-m-d');
		$TglPerubahan = $tgl_mutasi;
		$Kd_Riwayat = '28';
		$NilaiPerolehan_Awal = $ListParam['NilaiPerolehan'];
		$No_Dokumen = $NoSKKDH;
		
		//insert log
		$QueryLogAsal  = "INSERT INTO {$tableLog} ($implodeField,$AddField)
						VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal','$No_Dokumen')" or die("Error in the consult.." . mysqli_error($link));
		
		$execLog = $link->query($QueryLogAsal);	
		echo "query Log Asal : ".$QueryLogAsal."\n\n";

		//update aset Asal
		$quertAST = "UPDATE aset SET StatusValidasi = '2',Status_Validasi_Barang = '2'
			WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
		$execAST = $link->query($quertAST);	
		echo "query Aset Asal : ".$quertAST."\n\n";

		//update tabel sqlKIB Asal
		$quertKIB = "UPDATE {$table} SET StatusValidasi = '2',Status_Validasi_Barang = '2',StatusTampil = '2'
			WHERE Aset_ID = '{$Aset_ID}'" or die("Error in the consult.." . mysqli_error($link));	
		$execKIB = $link->query($quertKIB);	
		echo "query KIB Asal : ".$quertKIB."\n\n";

	}

	//print_r($ListParam);

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
