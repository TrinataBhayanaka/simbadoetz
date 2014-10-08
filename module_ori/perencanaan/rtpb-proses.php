<?php
ob_start();
include "../../config/config.php";
$menu_id = 8;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if(isset($_POST['validasi'])){
	$checkbox	= $_POST[checkbox];
	//echo "<pre>";
	//print_r($checkbox);
	//echo "</pre>";

	foreach ($checkbox as $value)
	{
			$dataArr = $UPDATE->update_rtpb_validasi($value);
			//header('location:rtpb_validasi.php');
			echo "<script type=text/javascript>window.location='rtpb_validasi.php'</script>";
	}
}
if(isset($_POST['novalidasi'])){
	$checkbox	= $_POST[checkbox];
	
	foreach ($checkbox as $value)
	{
		$dataArr = $UPDATE->update_rtpb_nonvalidasi($value);
		header ("location:rtpb_daftar_data.php");
	}
}
?>