<?php
///include "../../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$Mutasi_ID = $argv[1];
echo "Id Mutasi : ".$Mutasi_ID."\n\n";

$ListAset = $argv[2];
$sample = array($ListAset);
$expl = explode(",", $sample[0]);
$clearList = array_filter($expl);
echo "Total Data List Aset : ".count($clearList)."\n\n";

$time_start = microtime(true); 

foreach ($clearList as $value) {
    # code...
    //counting process loop
    echo "Aset_ID : ".$value."\n\n";

    //HAPUS PENGHAPUSANASET
    $queryHPSAS = "DELETE FROM mutasiaset where Mutasi_ID = '{$Mutasi_ID}' and Aset_ID = '{$value}'" or die("Error in the consult.." . mysqli_error($link));
    //echo "queryHPSAS : ".$queryHPSAS."\n\n";           
    $execHPSAS = $link->query($queryHPSAS);

    //UPDATE USULANASET
    $queryUSLAS = "UPDATE usulanaset SET StatusKonfirmasi = '2'
    	where Penetapan_ID = '{$Mutasi_ID}' and Aset_ID = '{$value}'" or die("Error in the consult.." . mysqli_error($link));
    //echo "queryUSLAS : ".$queryUSLAS."\n\n";           
    $execUSLAS = $link->query($queryUSLAS);

}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
