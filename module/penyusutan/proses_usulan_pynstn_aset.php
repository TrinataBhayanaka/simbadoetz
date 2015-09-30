<?php
include "../../config/config.php";
	$menu_id = 64;
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$SessionUser = $SESSION->get_session_user();
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
	
	// $PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
	// pr($_POST);
	$noUsulan = $_POST['noUsulan'];
	$kodeSatker = $_POST['kodeSatker'];
	
	//select Aset_ID dari tabel apl_userasetlist
	$data_post=$PENYUSUTAN->apl_userasetlistHPS("USULASET");
	$addExplode = explode(",",$data_post[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	$implodeAset_ID = implode(",",$cleanArray);
	if($implodeAset_ID != ''){
		//sql sementara
		//cek field Aset_ID 
		$QueryAsetCek	  = "select Aset_ID from usulan WHERE Usulan_ID = '$noUsulan'";
		$ExeQueryAcek = $DBVAR->query($QueryAsetCek);
		$resultCek = $DBVAR->fetch_object($ExeQueryAcek);
		$tmpAset_ID = "";
		if(!empty($resultCek->Aset_ID)){
			$tmpAset_ID = $resultCek-> Aset_ID;
			$joinAset_ID = $tmpAset_ID.",".$implodeAset_ID; 	
		}else{
			$joinAset_ID = $implodeAset_ID;
		}
		//update aset di usulan
		$QueryAset	  = "UPDATE usulan SET Aset_ID = '$joinAset_ID' WHERE Usulan_ID = '$noUsulan'";
		// pr($QueryAset);
		$ExeQueryAset = $DBVAR->query($QueryAset);
		
		//count Aset_ID
		$POST_data=$PENYUSUTAN->apl_userasetlistHPS_filter($data_post);
		// pr($POST_data);
		$hitung = count($POST_data);
		/*echo "hitung = ".$hitung;
		exit;*/
		
		for($i = 0; $i < $hitung; $i++){
			$Aset_ID = $POST_data[$i];
			$queryUsulanAset = "INSERT INTO usulanaset (Usulan_ID,Aset_ID,Jenis_Usulan) 
								VALUES ($noUsulan,$Aset_ID,'PNY')";
			$exeQueryUsulanAset = $DBVAR->query($queryUsulanAset);
		}
		// exit;
	if($data_post){
	 $data_delete=$PENYUSUTAN->apl_userasetlistHPS_del("USULASET");
	}
	// exit;
  echo "<script>
			alert('Data Berhasil Disimpan');
		</script>";	
}
redirect($url_rewrite.'/module/penyusutan/dftr_usulan_pnystn.php?pid=1');
?>