<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 3/11/17
 * Time: 10:39 PM
 */

error_reporting (0);
include "../config/config.php";


$query = "SELECT log_id,Aset_ID,NilaiPerolehan,NilaiPerolehan_Awal,(NilaiPerolehan-NilaiPerolehan_awal) AS kapitalisasi,
          NilaiBuku,NilaiBuku_Awal FROM log_jaringan WHERE Kd_Riwayat IN (2)        
          AND kodesatker LIKE '05%' AND Tglperubahan >'2015-12-31' ";
$ExeQuery = $DBVAR->query ($query) or die($DBVAR->error ());

echo "/*Data Perbaikan Log Jaringan untuk perhitungan penyusutan 2016 -- kodesatker DPU (05):*/\n";
$i=1;
while ($Data = $DBVAR->fetch_array ($ExeQuery)) {

    $log_id= $Data['log_id'];
    $Aset_ID = $Data[ 'Aset_ID' ];
    $NilaiPerolehan = $Data[ 'NilaiPerolehan' ];
    $NilaiPerolehan_Awal = $Data[ 'NilaiPerolehan_Awal' ];
    $Kapitalisasi = $Data[ 'kapitalisasi' ];
    $NilaiBuku = $Data[ 'NilaiBuku' ];
    $NilaiBuku_Awal = $Data[ 'NilaiBuku_Awal' ];
    $NilaiBukuKapitalisasi=$NilaiBuku+$Kapitalisasi;

    echo "\n/*$i--Aset_ID=$Aset_ID--*/\n";

    $query_update="update log_jaringan set NilaiBuku='$NilaiBukuKapitalisasi',NilaiBuku_Awal='$NilaiBuku' where log_id='$log_id'; ";
    echo "$query_update\n";
    //$result_update=$DBVAR->fetch_array ($query_update);

    $query_update="update jaringan set NilaiBuku='$NilaiBukuKapitalisasi'  where Aset_ID='$Aset_ID'; ";
    echo "$query_update\n";
    //$result_update=$DBVAR->fetch_array ($query_update);

    $query_update="update aset set NilaiBuku='$NilaiBukuKapitalisasi'  where Aset_ID='$Aset_ID'; ";
    echo "$query_update\n";
    //$result_update=$DBVAR->fetch_array ($query_update);
    $i++;
}

