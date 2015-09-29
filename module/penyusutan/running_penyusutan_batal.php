<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
include "../../config/config.php";

$Penyusutan_ID = $_GET['idPenyusutan'];	
$Satker = $_GET['satker'];
// pr($_GET);
$queryBatalPenyusutan = "SELECT Aset_ID,StatusRunning,Tahun FROM penyusutan_pertahun WHERE Penyusutan_ID='{$Penyusutan_ID}'";
$exeBatalPenyusutan = $DBVAR->query($queryBatalPenyusutan) or die($DBVAR->error());
$data = $DBVAR->fetch_object($exeBatalPenyusutan);	
// pr($data);
$status_running = $data->StatusRunning;
// exit;	 
session_write_close();                    
	if($status_running==2){
		//update StatusRunning = 3 tanda pernah dilakukan pembatalan penyusutan
		$query="update  penyusutan_pertahun  set StatusRunning=3 where Penyusutan_ID=$Penyusutan_ID";
		// $query="delete FROM penyusutan_pertahun where Penyusutan_ID=$Penyusutan_ID";
		// echo $query; 
		// exit;
		$DBVAR->query($query) or die($DBVAR->error());
		// $status=exec("php running_penyusutan_batal_server_custome.php $Penyusutan_ID $Satker  > log/penyusutan-custome-batal.txt 2>&1 &");
		$status=exec("php running_penyusutan_batal_server_custome.php $Penyusutan_ID $Satker  > log/penyusutan-custome-batal.txt &");
		 header('Location: validasi_pnystn.php?pid=1');
	}
	
    function microtime_float()
	{
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	redirect($url_rewrite.'/module/penyusutan/validasi_pnystn.php?pid=1');

?>
