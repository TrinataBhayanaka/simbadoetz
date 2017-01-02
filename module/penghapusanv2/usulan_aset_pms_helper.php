<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$idUsulan = $argv[1];
echo "Id Usulan : ".$idUsulan."\n\n";

$ListAset = $argv[2];
$sample = array($ListAset);
$expl = explode(",", $sample[0]);
$clearList = array_filter($expl);
echo "Total Data List Aset : ".count($clearList)."\n\n";

//get jenis_hapus
$sql = "SELECT jenis_hapus FROM usulan where Usulan_ID = '{$idUsulan}'";
$result = $link->query($sql); 
while($row = mysqli_fetch_assoc($result)) {
  $jns_hps = $row['jenis_hapus'];
} 

$jenis_hapus = $jns_hps;
//echo "Jenis Hapus : ".$jenis_hapus."\n\n";

$time_start = microtime(true); 

foreach ($clearList as $val) {
    # code...
    //counting process loop
    echo "Aset_ID : ".$val."\n\n";
    $field = "Usulan_ID,Aset_ID,Jenis_Usulan,jenis_hapus";
    $value = "'{$idUsulan}','{$val}','PMS','{$jenis_hapus}'";
    $query = "INSERT INTO usulanaset ({$field}) VALUES ({$value})" or die("Error in the consult.." . mysqli_error($link));
    
    //echo "query : ".$query."\n\n";
            
    $exec = $link->query($query);
}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
