<?php

include "../../config/config.php";
ob_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$id=$_GET['id'];


$query="UPDATE Mutasi SET FixMutasi=0 WHERE Mutasi_ID='$id'";
$exec=mysql_query($query) or die(mysql_error());

$query2="UPDATE PenggunaanAset SET StatusMutasi=0 WHERE Mutasi_ID='$id'";
$exec2=mysql_query($query2) or die(mysql_error());

//==========================================================
$tes="SELECT Aset_ID, SatkerAwal, NomorRegAwal FROM MutasiAset where Mutasi_ID='$id'";
$dt=mysql_query($tes) or die(mysql_error());
while($arr=  mysql_fetch_array($dt)){
    $aset_id[]=$arr['Aset_ID'];
    $SA[]=$arr['SatkerAwal'];
    $no_reg_awal[]=$arr['NomorRegAwal'];
}


$f=count($aset_id);

for($i=0; $i<$f; $i++){
    
    $query4="UPDATE Aset SET LastMutasi_ID=0, LastSatker_ID='$SA[$i]', NomorReg='$no_reg_awal[$i]' WHERE Aset_ID='$aset_id[$i]'";
    //print_r($query4);
    $exec4=mysql_query($query4) or die(mysql_error());
    
}
//===================================================


$query3="DELETE FROM MutasiAset WHERE Mutasi_ID='$id'";
$exec3=mysql_query($query3) or die(mysql_error());



echo "<script>alert('Data Berhasil Dihapus'); document.location='transfer_hasil_daftar.php';</script>";




?>