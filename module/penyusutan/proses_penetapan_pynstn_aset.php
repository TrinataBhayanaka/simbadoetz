<?php
include "../../config/config.php";
	$menu_id = 64;
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$SessionUser = $SESSION->get_session_user();
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
	
	// $PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	// pr($_POST);
	$noPenetapan = $_POST['Penyusutan_ID'];
	$kodeSatker = $_POST['Satker_ID'];
	
	//select Aset_ID dari tabel apl_userasetlist
	$data_post=$PENYUSUTAN->apl_userasetlistHPS("PNTPNUSULASETFIX");
	$addExplode = explode(",",$data_post[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	$implodeAset_ID = implode(",",$cleanArray);
	if($implodeAset_ID != ''){
		//update StatusKonfirmasi di usulanaset
		$QueryUsulanAset	  = "UPDATE usulanaset SET StatusKonfirmasi = '1' WHERE Penetapan_ID = '$noPenetapan' and Aset_ID in ($implodeAset_ID)";
		$ExeQueryUsulanAset = $DBVAR->query($QueryUsulanAset);
		
		$QueryPenyusutan	  = "UPDATE penyusutan SET Status = '1' WHERE Penyusutan_ID = '$noPenetapan'";
		$ExeQueryPenyusutan = $DBVAR->query($QueryPenyusutan);
		
		$tahun = date('Y');
		$QueryPenyusutanPertahun = "INSERT INTO penyusutan_pertahun (Penyusutan_ID,Aset_ID,Tahun) 
								VALUES ('{$noPenetapan}','{$implodeAset_ID}','{$tahun}')";
		$ExeQueryPenyusutanPertahun = $DBVAR->query($QueryPenyusutanPertahun);
		//count Aset_ID
		$POST_data=$PENYUSUTAN->apl_userasetlistHPS_filter($data_post);
		$hitung = count($POST_data);
		
		for($i = 0; $i < $hitung; $i++){
			$Aset_ID = $POST_data[$i];
			$queryUsulanAset = "INSERT INTO penyusutanaset (Penyusutan_ID,Aset_ID,Status) 
								VALUES ($noPenetapan,$Aset_ID,'1')";
			$exeQueryUsulanAset = $DBVAR->query($queryUsulanAset);
		}
		// exit;
	if($data_post){
	 $data_delete=$PENYUSUTAN->apl_userasetlistHPS_del("PNTPNUSULASETFIX");
	}
	// exit;
  echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
}
redirect($url_rewrite.'/module/penyusutan/dftr_penetapan_pnystn.php?pid=1');
?>