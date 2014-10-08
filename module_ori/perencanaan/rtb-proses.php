<?php
ob_start();
include "../../config/config.php";
$menu_id = 7;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if(isset($_POST['validasi'])){
	$checkbox	= $_POST['checkbox'];
	//echo "<pre>";
	//print_r($checkbox);
	//pr($checkbox);

	foreach ($checkbox as $value)
	{
		$dataArr = $UPDATE->update_rtb_validasi($value);
		
		//echo "ada";
			echo "<script type=text/javascript>window.location='rtb_validasi.php'</script>";
		// header ("location:rtb_validasi.php");
	}
	
	//exit;
}
if(isset($_POST['novalidasi'])){
	$checkbox	= $_POST[checkbox];
	
	foreach ($checkbox as $value)
	{
		$dataArr = $UPDATE->update_rtb_nonvalidasi($value);
		header ("location:rtb_daftar_data.php");
	}
}
?>