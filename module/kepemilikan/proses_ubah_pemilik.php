<?php
include "../../config/config.php";
	
	$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
	// pr($_POST);
	$kodepemilik = $_POST['kodepemilik'];
	$kodeSatker = $_POST['kodeSatker'];
	$tgl = $_POST['tglPerubahan'];
	// EXIT;
	$menu_id = 69;
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$SessionUser = $SESSION->get_session_user();
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
		
	//select Aset_ID dari tabel apl_userasetlist
	$data_post=$PENGHAPUSAN->apl_userasetlistHPS("koreksipemilik");
	$addExplode = explode(",",$data_post[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	
	
	// pr($cleanArray);exit;
	
	foreach ($cleanArray as $key => $value) {
		$sql = "SELECT * FROM aset WHERE Aset_ID = '{$value}'";
		$exec = $DBVAR->query($sql);
		$aset = $DBVAR->fetch_array($exec);
		// pr($aset);exit;
		$old = explode(".", $aset['kodeLokasi']);
		$old[0] = $kodepemilik;
		$new = implode(".", $old);
		
		$sql = "SELECT MAX(noRegister) AS lastreg FROM aset WHERE kodeKelompok = '{$aset['kodeKelompok']}' AND kodeLokasi = '{$new}'";
        $exec = $DBVAR->query($sql);
		$noreg = $DBVAR->fetch_array($exec);
        $noRegister = intval($noreg['lastreg'])+1;

        //UPDATE ASET
        $sql = "UPDATE aset SET kodeLokasi = '{$new}', noRegister = '{$noRegister}' WHERE Aset_ID = '{$value}'";
		$exec = $DBVAR->query($sql);

		if($aset['TipeAset'] == 'A'){
			$tableKib = 'tanah';
			$tableLog = 'log_tanah';
		}elseif($aset['TipeAset'] == 'B'){
			$tableKib = 'mesin';
			$tableLog = 'log_mesin';
		}elseif($aset['TipeAset'] == 'C'){
			$tableKib = 'bangunan';
			$tableLog = 'log_bangunan';
		}elseif($aset['TipeAset'] == 'D'){
			$tableKib = 'jaringan';
			$tableLog = 'log_jaringan';
		}elseif($aset['TipeAset'] == 'E'){
			$tableKib = 'asetlain';
			$tableLog = 'log_asetlain';
		}elseif($aset['TipeAset'] == 'F'){
			$tableKib = 'kdp';
			$tableLog = 'log_kdp';
		}

		//SELECT DATA KIB
		$sql = "SELECT * FROM {$tableKib} WHERE Aset_ID = '{$value}'";
		$exec = $DBVAR->query($sql);
		$kib = $DBVAR->fetch_object($exec);

		//UPDATE KIB
        $sql = "UPDATE {$tableKib} SET kodeLokasi = '{$new}', noRegister = '{$noRegister}' WHERE Aset_ID = '{$value}'";
		$exec = $DBVAR->query($sql);

		
		//INSERT LOG
		$kib->Kd_Riwayat = 22;
		$kib->action = 'Ubah Pemilik';
        $kib->TglPerubahan = $tgl;         
		$kib->changeDate = date("Y-m-d");
		$kib->operator = $_SESSION['ses_uoperatorid'];
		
		unset($tmpField);
        unset($tmpValue);
        foreach ($kib as $key => $val) {
          $tmpField[] = $key;
          $tmpValue[] = "'".$val."'";
        }
         
        $fileldImp = implode(',', $tmpField);
        $dataImp = implode(',', $tmpValue);

        $sql = "INSERT INTO {$tableLog} ({$fileldImp}) VALUES ({$dataImp})";
        $exec = $DBVAR->query($sql);

	}


	// exit;
  	echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
	redirect($url_rewrite.'/module/kepemilikan/filter_data.php');
	exit;
?>