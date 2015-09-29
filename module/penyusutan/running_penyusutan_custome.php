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
// echo "masuk";
// exit;
$Penyusutan_ID = $_GET['idPenyusutan'];	
$queryPenyusutan = "SELECT Penyusutan_ID,StatusRunning FROM penyusutan_pertahun WHERE Penyusutan_ID	='{$Penyusutan_ID}'";
$exePenyusutan = $DBVAR->query($queryPenyusutan) or die($DBVAR->error());
$data = $DBVAR->fetch_object($exePenyusutan);	
$status_running = $data->StatusRunning;
				 
session_write_close();                    
	if($status_running==0){
		$query="update  penyusutan_pertahun  set StatusRunning=1 where Penyusutan_ID=$Penyusutan_ID";
		$DBVAR->query($query) or die($DBVAR->error());
		 
		// $status=exec("php running_penyusutan_server_custome.php $Penyusutan_ID > log/penyusutan-custome.txt 2>&1 &");
		$status=exec("php running_penyusutan_server_custome.php $Penyusutan_ID > log/penyusutan-custome.txt &");
		header('Location: validasi_pnystn.php?pid=1');
	}
	 
?>
