<?php
include "../../config/config.php";
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

//$LAYANAN = new RETRIEVE_LAYANAN;
/*$data = $LAYANAN->remove_data_aset($_POST);	
	if ($data){
		?>
		<script>
		alert('Aset sudah dihapus');
		document.location="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_daftar.php";
        
        </script>
		<?php
	}*/
//pr($_POST);
//exit;
if(isset($_POST)){
	//pr("masuk");
	//exit;
	$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
	$kodeSatker = $_POST['kodeSatker'];
	$date = date("Y-m-d_H:i:s");
	$log = "hapus_aset_".$kodeSatker.'_'.$date;
	//pr($log);
	//exit;
	$apl_userasetlistHPS = $PENGHAPUSAN->apl_userasetlistHPS("LYNAN");
	$addExplode = explode(",",$apl_userasetlistHPS[0]['aset_list']);
	$cleanArray = array_filter($addExplode);
	$implodeAset_ID = implode(",",$cleanArray);
	$arr = array("0"=>$implodeAset_ID);
	/*pr($apl_userasetlistHPS);
	pr($cleanArray);
	pr($implodeAset_ID);*/
	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("LYNAN");

	$data = $arr['0'];
	$jenisaset = $_POST['jenisaset'];
	if($jenisaset == 'A'){
		$table = 'tanah';
		$tableLog = "log_tanah";
	}elseif($jenisaset == 'B'){
		$table = 'mesin';
		$tableLog = "log_mesin";
	}elseif($jenisaset == 'C'){
		$table = 'bangunan';
		$tableLog = "log_bangunan";
	}elseif($jenisaset == 'D'){
		$table = 'jaringan';
		$tableLog = "log_jaringan";
	}elseif($jenisaset == 'E'){
		$table = 'asetlain';
		$tableLog = "log_asetlain";
	}elseif($jenisaset == 'F'){
		$table = 'kdp';
		$tableLog = "log_kdp";
	}
	
	
	if($data){
		//pr("ada data");
		$status=exec("php hapus_layanan_helper.php $kodeSatker $data $table $tableLog > ../../log/$log.txt 2>&1 &");
		echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/layanan/lihat_aset_filter2.php\">";    
	    exit;
	}else{
		//pr("tidak ada data");
		echo "<script>alert('Tidak Ada Data Yang Dipilih');</script>";
		echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/layanan/lihat_aset_filter2.php\">";   
	}

}else{
	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/layanan/lihat_aset_filter2.php\">"; 
}


	
	
?>
	