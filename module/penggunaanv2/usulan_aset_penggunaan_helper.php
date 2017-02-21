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

$kodeSatker = $argv[3];

$time_start = microtime(true); 

foreach ($clearList as $val) {
    # code...
    //counting process loop
    echo "Aset_ID : ".$val."\n\n";
    $field = "Penggunaan_ID,Aset_ID,kodeSatker,Status";
    $value = "'{$idUsulan}','{$val}','{$kodeSatker}','0'";
    $query = "INSERT INTO penggunaanaset ({$field}) VALUES ({$value})" or die("Error in the consult.." . mysqli_error($link));
    
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
