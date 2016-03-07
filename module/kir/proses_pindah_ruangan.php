<?php
include "../../config/config.php";
	// echo "masuk";
	
	// exit;
	// $KIR = new RETRIEVE_KIR;
	$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
	// pr($_POST);
	$kodeRuang = $_POST['kodeRuang'];
	$kodeSatker = $_POST['kodeSatker'];
	$tgl = $_POST['tglPerubahan'];
	// EXIT;
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
	// echo "implode ".$implodeAset_ID;
	// exit;
	
	//sql sementara
	//update ruangan di tabel aset
	$QueryAset	  = "UPDATE aset SET kodeRuangan = '$kodeRuang' WHERE Aset_ID in ($implodeAset_ID)";
	// pr($QueryAset);
	$ExeQueryAset = $DBVAR->query($QueryAset);
	$POST=$_POST;
	$POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
	
	$hitung = count($POST_data);
	/*echo "hitung = ".$hitung;
	echo "<br>";
	echo "aset 1 =".$POST_data[0];
	exit;*/
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
		
		//update ruangan di tabel kib
		$QueryKib	  = "UPDATE $tableKib SET kodeRuangan = '$kodeRuang' WHERE Aset_ID = '$Aset_ID'";
		$ExeQueryKib = $DBVAR->query($QueryKib);
		
		//select field dan value tabel kib
		$QueryKibSelect	  = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
		$exequeryKibSelect = $DBVAR->query($QueryKibSelect);
		$resultqueryKibSelect = $DBVAR->fetch_object($exequeryKibSelect);
		
		$tmpField = array();
		$tmpVal = array();
		$sign = "'"; 
		foreach ($resultqueryKibSelect as $key => $val) {
            $tmpField[] = $key;
			if ($val ==''){
				// $tmpVal[] = $sign.NULL.$sign;
				$tmpVal[] = $sign.$sign;
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
		
		//insert log
		$QueryLog  = "INSERT INTO $tableLog ($implodeField,$AddField)
					VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$Kd_Riwayat')";
	
		$exeQueryLog = $DBVAR->query($QueryLog);
		
	}
	
	if($data_post){
	 $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("KIRASETDETAIL");
	}
	// exit;
  echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
redirect($url_rewrite.'/module/kir/filter_ruangan_kir.php');
?>