<?php

include "../../config/config.php"; 

//$id=$_POST['peman_validasi'];
$query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemanfaatan[]' AND UserSes = '$_SESSION[ses_uid]'";
//print_r($query);
$result = mysql_query($query) or die (mysql_error());

$numRows = mysql_num_rows($result);
if ($numRows)
{
    $dataID = mysql_fetch_object($result);
}

    $explodeID = explode(',',$dataID->aset_list);
    

    $cnt=count($explodeID);
    //echo "$cnt";

for ($i=0; $i<$cnt; $i++){
    //echo "$i";
    //echo "$id[$i]";
    if($explodeID!=""){
    
    $query="UPDATE Pemanfaatan SET Status=1 WHERE Pemanfaatan_ID='$explodeID[$i]'";
    $exec=mysql_query($query) or die(mysql_error());
    
    $query2="UPDATE PemanfaatanAset SET Status=1 WHERE Pemanfaatan_ID='$explodeID[$i]'";
    $exec=mysql_query($query2) or die(mysql_error());
    }
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPemanfaatan[]' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());

echo "<script>alert('Data Telah Divalidasi'); document.location='pemanfaatan_validasi_daftar_valid.php?pid=1';</script>";


?>
