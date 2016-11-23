<?php
include "../../config/config.php";
//modif
try {
    // First of all, let's begin a transaction
    //$db->beginTransaction();

    // A set of queries; if one fails, an exception should be thrown
    //$db->query('first query');
    //$db->query('second query');
    //$db->query('third query');

    // If we arrive here, it means that no exception was thrown
    // i.e. no query has failed, and we can commit the transaction

    //$db->commit();
	

	$DBVAR->begin();
	$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
	$kodeRuangan = $_POST['kodeRuang'];
	if($kodeRuangan){
		$kodeRuang = trim($kodeRuangan);
	}else{
		$kodeRuang = 'NULL';
	}
	
	$kodeSatker = $_POST['kodeSatker'];
	$tgl = $_POST['tglPerubahan'];
	$menu_id = 59;
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$SessionUser = $SESSION->get_session_user();
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
		
	//select Aset_ID dari tabel apl_userasetlist
	$data_post=$PENGHAPUSAN->apl_userasetlistHPS("KIRASETDETAIL");
	$addExplode = explode(",",$data_post[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	
	//implode Aset_ID
	$implodeAset_ID = implode(",",$cleanArray);
	
	//sql sementara
	//update ruangan di tabel aset
	$QueryAset	  = "UPDATE aset SET kodeRuangan = $kodeRuang WHERE Aset_ID in ($implodeAset_ID)";
	//pr($QueryAset);
	//	exit;
	$ExeQueryAset = $DBVAR->query($QueryAset);
	if(!$ExeQueryAset){
		$DBVAR->rollback();
		echo "<script>
			alert('Data gagal masuk #001. Silahkan coba lagi');
		</script>";	
		redirect($url_rewrite.'/module/kir/filter_ruangan_kir.php');
		exit();
	}
	$POST=$_POST;
	$POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
	
	$hitung = count($POST_data);
	for($i = 0; $i < $hitung; $i++){
		$Aset_ID = $POST_data[$i];
		$queryTipeAset = "SELECT TipeAset FROM aset WHERE Aset_ID = '$Aset_ID'";
		$exequeryTipeAset = $DBVAR->query($queryTipeAset);
		$resultqueryTipeAset = $DBVAR->fetch_array($exequeryTipeAset);
		
		if($resultqueryTipeAset['TipeAset'] == 'A'){
			$tableKib = 'tanah';
			$tableLog = 'log_tanah';
		}elseif($resultqueryTipeAset['TipeAset'] == 'B'){
			$tableKib = 'mesin';
			$tableLog = 'log_mesin';
		}elseif($resultqueryTipeAset['TipeAset'] == 'C'){
			$tableKib = 'bangunan';
			$tableLog = 'log_bangunan';
		}elseif($resultqueryTipeAset['TipeAset'] == 'D'){
			$tableKib = 'jaringan';
			$tableLog = 'log_jaringan';
		}elseif($resultqueryTipeAset['TipeAset'] == 'E'){
			$tableKib = 'asetlain';
			$tableLog = 'log_asetlain';
		}elseif($resultqueryTipeAset['TipeAset'] == 'F'){
			$tableKib = 'kdp';
			$tableLog = 'log_kdp';
		}
		
		//select field dan value tabel kib and koderuangan lama
		$QueryKibSelect	  = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
		$exequeryKibSelect = $DBVAR->query($QueryKibSelect);
		$resultqueryKibSelect = $DBVAR->fetch_object($exequeryKibSelect);
		
		$tmpField = array();
		$tmpVal = array();
		$sign = "'"; 
		foreach ($resultqueryKibSelect as $key => $val) {
            $tmpField[] = $key;
			if ($val =='' || $val == NULL){
				$tmpVal[] = 'NULL';
			}else{
				$tmpVal[] = $sign.addslashes($val).$sign;
			}
		}
			
		$implodeField = implode (',',$tmpField);
		$implodeVal = implode (',',$tmpVal);
		
		$AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,Kd_Riwayat";
		$action = "Update Ruangan ".$kodeSatker.'_'.$kodeRuang;
		$changeDate = date('Y-m-d');
		$TglPerubahan = $tgl;
		$NilaiPerolehan_Awal = $resultqueryKibSelect->NilaiPerolehan;
		$Kd_Riwayat = '4';
		

		//update ruangan di tabel kib
		$QueryKib	  = "UPDATE $tableKib SET kodeRuangan = $kodeRuang WHERE Aset_ID = '$Aset_ID'";
		$ExeQueryKib = $DBVAR->query($QueryKib);
		if(!$ExeQueryKib){
			$DBVAR->rollback();
			echo "<script>
				alert('Data gagal masuk #002. Silahkan coba lagi');
			</script>";	
			redirect($url_rewrite.'/module/kir/filter_ruangan_kir.php');
			exit();
		}
		//insert log
		$QueryLog  = "INSERT INTO $tableLog ($implodeField,$AddField)
					VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$Kd_Riwayat')";
	
		$exeQueryLog = $DBVAR->query($QueryLog);
		if(!$exeQueryLog){
			$DBVAR->rollback();
			echo "<script>
				alert('Data gagal masuk #003. Silahkan coba lagi');
			</script>";	
			redirect($url_rewrite.'/module/kir/filter_ruangan_kir.php');
			exit();
		}
	}
	
	$DBVAR->commit();
	if($data_post){
	 $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("KIRASETDETAIL");
	}
	// exit;
  echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
redirect($url_rewrite.'/module/kir/filter_ruangan_kir.php');

} catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    //$db->rollback();
    $DBVAR->rollback();
    echo "<script>
		alert('Data gagal masuk #999. Silahkan coba lagi');
	</script>";	
	redirect($url_rewrite.'/module/kir/filter_ruangan_kir.php');
	exit();
}


?>