<?php
include "../../../config/config.php";
//modif
    $DBVAR->begin();
	$sqlRencanaPengadaan	 = "SELECT * FROM `rencana` WHERE Kode_Satker = '{$_POST[kodeSatker]}' AND Tahun = '{$_POST[tahun]}' limit 1";
	//pr($sqlRencanaPengadaan);
	$execRencanaPengadaan = $DBVAR->query($sqlRencanaPengadaan);
	//$result = $DBVAR->fetch_object($execRencanaPengadaan);
	while ($result = $DBVAR->fetch_object($execRencanaPengadaan)) {
		$data = $result;
		$sign = "'";
		$tmpField = array();
		$tmpVal = array(); 
		foreach ($data as $key => $val) {
			if($key == 'Harga_Pemeliharaan' || $key == 'Status_Pemeliharaan' || $key == 'Uraian_Pemeliharaan' ){
				//nothing
			}else{
				$tmpField[] = $key;
				if ($val =='' || $val == NULL){
					$tmpVal[] = 'NULL';
				}else{
					$tmpVal[] = $sign.addslashes($val).$sign;
				}	
			}
		}
		$kodeKelompok = str_replace("'", "", $tmpVal['1']);
		$tipe = explode('.', $kodeKelompok);
		if($tipe['0'] == '01'){
			$tableRencana 	= 'prcn_tanah';
			$tableRencanaDPA 	= 'prcn_dpa_tanah';
		}elseif($tipe['0'] == '02'){
			$tableRencana = 'prcn_mesin';
			$tableRencanaDPA = 'prcn_dpa_mesin';
		}elseif($tipe['0'] == '03'){
			$tableRencana = 'prcn_bangunan';
			$tableRencanaDPA = 'prcn_dpa_bangunan';
		}elseif($tipe['0'] == '04'){
			$tableRencana = 'prcn_jaringan';
			$tableRencanaDPA = 'prcn_dpa_jaringan';
		}elseif($tipe['0'] == '05'){
			$tableRencana = 'prcn_asettetaplain';
			$tableRencanaDPA = 'prcn_dpa_asettetaplain';
		}elseif($tipe['0'] == '06'){
			$tableRencana = 'prcn_kdp';
			$tableRencanaDPA = 'prcn_dpa_kdp';
		}

		//cek exist
		$Rencana_ID  = str_replace("'", "", $tmpVal['0']);	
		$sqlCountRencanDpa = "SELECT COUNT(Rencana_ID) as CountRecanaDpa FROM `rencana_dpa` WHERE 
					  	  Rencana_ID = '{$Rencana_ID}'";
		$execCountRencanDpa =  $DBVAR->query($sqlCountRencanDpa);
		$rowCountRencanDpa = $DBVAR->fetch_object($execCountRencanDpa);
		if($rowCountRencanDpa->CountRecanaDpa > 0){
			$sql  = "DELETE FROM rencana_dpa WHERE Rencana_ID = '{$Rencana_ID}'" or die("Error in the consult.." . mysqli_error($link));
			$exec = $DBVAR->query($sql);
			if(!$exec){
				$DBVAR->rollback();
				echo "<script>
					alert('Data gagal masuk #001. Silahkan coba lagi');
				</script>";	
				redirect($url_rewrite.'/module/perencanaan/rencana/import.php'); 
				exit();
			}
			$sql2  = "DELETE FROM {$tableRencanaDPA} WHERE Rencana_ID = '{$Rencana_ID}'" or die("Error in the consult.." . mysqli_error($link));
			$exec2 = $DBVAR->query($sql2);
			if(!$exec2){
				$DBVAR->rollback();
				echo "<script>
					alert('Data gagal masuk #002. Silahkan coba lagi');
				</script>";	
				redirect($url_rewrite.'/module/perencanaan/rencana/import.php'); 
				exit();
			}
		}
		$implodeField = implode (',',$tmpField);
		$implodeVal = implode (',',$tmpVal);
		
	    $sqlRencanaDpa  = "INSERT INTO `rencana_dpa`({$implodeField}) VALUES ({$implodeVal})" or die("Error in the consult.." . mysqli_error($link));
	    $execRencanaDpa = $DBVAR->query($sqlRencanaDpa);
	    if(!$execRencanaDpa){
				$DBVAR->rollback();
				echo "<script>
					alert('Data gagal masuk #003. Silahkan coba lagi');
				</script>";	
				redirect($url_rewrite.'/module/perencanaan/rencana/import.php'); 
				exit();
		}
	    $sqlRencanaPengadaanDetail = "SELECT * FROM {$tableRencana} WHERE Rencana_ID = '{$Rencana_ID}'";
		$execRencanaPengadaanDetail =  $DBVAR->query($sqlRencanaPengadaanDetail);
		while ($rowRencanaPengadaanDetail = $DBVAR->fetch_object($execRencanaPengadaanDetail)) {
			$temp2 = $rowRencanaPengadaanDetail;
			$sign2 = "'";
			$tmpField2 = array();
			$tmpVal2 = array(); 
			foreach ($temp2 as $key2 => $val2) {
				
					$tmpField2[] = $key2;
					if ($val2 =='' || $val2 == NULL){
						$tmpVal2[] = 'NULL';
					}else{
						$tmpVal2[] = $sign2.addslashes($val2).$sign2;
					}	
				
			}
			$implodeField2 = implode (',',$tmpField2);
			$implodeVal2 = implode (',',$tmpVal2);
		    $sqlRencanaDpa = "INSERT INTO `{$tableRencanaDPA}`({$implodeField2}) VALUES ({$implodeVal2})"; 
		    $execRencanaDpaDetail = $DBVAR->query($sqlRencanaDpa);
		    if(!$execRencanaDpaDetail){
				$DBVAR->rollback();
				echo "<script>
					alert('Data gagal masuk #004. Silahkan coba lagi');
				</script>";	
				redirect($url_rewrite.'/module/perencanaan/rencana/import.php'); 
				exit();
			}
		}
	}
	$DBVAR->commit();
	echo "<script>
			alert('Data Berhasil DiImport');
		</script>";	
	redirect($url_rewrite.'/module/perencanaan/rencana/import.php'); 
	exit();
?>