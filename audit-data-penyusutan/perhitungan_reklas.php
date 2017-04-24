<?php
error_reporting (0);
include "../config/config.php";


$log_table = "log_jaringan";
$table="jaringan";
$myfile = fopen ("all-kasus-jaringan", "r") or die("Unable to open file!");
$aset_id_cek = fread ($myfile, filesize ("all-kasus-jaringan"));
fclose ($myfile);
/*
$aset_id_cek="2674584,2674612,2674743,718911,203125,203130,202339,202340,202343,202344,202345,202357,202360,202367,202372,202374,202375,202378,202379,202384,202395,202397,202401,202402,202411,202414,202419,202427,202437,202438,202443,202448,202453,202455,202465,202466,202469,202476,202564,1797736,1797738,1836906,1842396,1845548,1867535,1867542,2634289,2634775,2634792,2634936,2635000,2635029,2635030,2635157,2635158,2635159,2635160,2635161,2635162,2635163,2635166,2635167,2635168,2635169,2635170,2635171,2635172,2635173,2635174,2635175,2635176,2635180,2635184,2635187,2635188,2635189,2635190,2635191,2635193,2635194,2635195,2635196,2635197,202778,2668813,1774301 
";*/
//$skip_aset_id="202437, 202448,202453,202473,202909";//karena log 28
$query_data = "SELECT aset_id,umurekonomis,MasaManfaat,kodeKelompok,kodeSatker,NilaiPerolehan FROM `$table`
        WHERE aset_id in($aset_id_cek) ";
$result = $DBVAR->query ($query_data) or die($DBVAR->error ());
$data_selisih = "";
$satker = array();
$i = 0;
$total = 0;

while ($row = $DBVAR->fetch_array ($result)) {
    $total++;
    echo "masuk";
    $Aset_ID = $row[ 'aset_id' ];
    $UmurEkonomis=$row['umurekonomis'];
    $MasaManfaat=$row['MasaManfaat'];
    $kodeKelompok=$row['kodeKelompok'];
    $kodeSatker=$row['kodeSatker'];
    $NilaiPerolehan_akhir=$row['NilaiPerolehan'];
    $kodeKelompok_log = $kodeKelompok;
    $tmp_kode_log = explode (".", $kodeKelompok_log);

    $info="/*Penelusuran kodekelompok reklas untuk aset_id=$Aset_ID*/\n\n";
    logfile($info,'data-reklas-jaringan.txt');

    $query_history="select log_id,NilaiPerolehan,NilaiPerolehan_Awal,Kd_Riwayat,TglPerubahan,
                    (NilaiPerolehan-NilaiPerolehan_Awal) as selisih,TahunPenyusutan,TglPerolehan,
                    TglPembukuan,kodeSatker,kodeLokasi,noRegister,
                    NilaiBuku,AkumulasiPenyusutan,AkumulasiPenyusutan_Awal,
                    (AkumulasiPenyusutan-AkumulasiPenyusutan_Awal) as selisih_akm,
                    kodeKA,kodeRuangan,UmurEkonomis,MasaManfaat,
                     StatusValidasi, Status_Validasi_Barang,StatusTampil,
                    PenyusutanPerTahun,Tahun,jenis_hapus
                    from $log_table where aset_id='$Aset_ID' and Kd_Riwayat in (7,21,29,28,50,51,2)
                    and TglPerubahan!='0000-00-00' and TglPerubahan>='2015-01-01'";
    $result_log = $DBVAR->query ($query_history) or die($DBVAR->error ());
    $data_log = array();
   while ($row_log = $DBVAR->fetch_array ($result_log)) {
        array_push ($data_log, $row_log);
    }
   // echo "$query_history<br/>";
     $NilaibUku=0;
$AkumulasiPenyusutan=0;
$PenyusutanPerTahun=0;
$kapitalisasi=0;
$np_awal=0;               
$status_pertama=0;
$i=0;
    $result_history=$DBVAR->query ($query_history) or die($DBVAR->error ());
    while($row_history=$DBVAR->fetch_array ($result_history)){
            /**Data Primer**/
            echo "$i===$Aset_ID<br/>";
            $log_id=$row_history['log_id'];
            $kodeSatker=$row_history['kodeSatker'];
            $kodeLokasi=$row_history['kodeLokasi'];
            $noRegister=$row_history['noRegister'];
            $NilaiPerolehan=$row_history['NilaiPerolehan'];
            $NilaiPerolehan_Awal=$row_history['NilaiPerolehan_Awal'];
            $selisih=$row_history['selisih'];
            $selisih_akm=$row_history['selisih_akm'];
            $Kd_Riwayat=$row_history['Kd_Riwayat'];
            $NilaiBuku_log=$row_history['NilaiBuku'];
            $AkumulasiPenyusutan_log=$row_history['AkumulasiPenyusutan'];
           /* if($AkumulasiPenyusutan_log==NULL)
                $AkumulasiPenyusutan_log=0;
           */
             $AkumulasiPenyusutan_log_awal=$row_history['AkumulasiPenyusutan_Awal'];
           /*  if($AkumulasiPenyusutan_log_awal==NULL)
                $AkumulasiPenyusutan_log=0;*/
            $bp_log=$AkumulasiPenyusutan_log-$AkumulasiPenyusutan_log_awal;
            $PenyusutanPerTahun_log=$row_history['PenyusutanPerTahun'];
            $TahunPenyusutan=$row_history['TahunPenyusutan'];
            $TahunPerolehan=$row_history['Tahun'];
             /**Data Primer**/

            /**Data Sekunder**/
            $UmurEkonomis_log=$row_history['UmurEkonomis'];
            $MasaManfaat_log=$row_history['MasaManfaat'];
            $TglPerolehan=$row_history['TglPerolehan'];
            $TglPembukuan=$row_history['TglPembukuan'];
            $TglPerubahan=$row_history['TglPerubahan'];
            $kodeKA=$row_history['kodeKA'];
            $kodeRuangan=$row_history['kodeRuangan'];
            $StatusValidasi=$row_history['StatusValidasi'];
            $Status_Validasi_Barang=$row_history['Status_Validasi_Barang'];
            $StatusTampil=$row_history['StatusTampil'];
            $jenis_hapus=$row_history['jenis_hapus'];
             /**Data Sekunder**/

            if($Kd_Riwayat=="50"){
                $np_awal=$NilaiPerolehan;
                
                if($status_pertama==0){
                    $status_penyusutan_pertama=cek_penyusutan_tahun_pertama($Aset_ID,$log_table,$log_id,$DBVAR);
                    if($status_penyusutan_pertama==1)
                        $AkumulasiPenyusutan=0;
                 }   

                if($AkumulasiPenyusutan==0){
                    $PenyusutanPerTahun=$NilaiPerolehan/$MasaManfaat;
                    $rentang_penyusutan=($TahunPenyusutan-$TahunPerolehan)+1;
                    $UmurEkonomis=$MasaManfaat-$rentang_penyusutan;

                    if($UmurEkonomis<=0){
                        $AkumulasiPenyusutan=$NilaiPerolehan;
                        $NilaiBuku=0;
                        $UmurEkonomis=0;
                    }else{
                        $AkumulasiPenyusutan=$rentang_penyusutan*$PenyusutanPerTahun;
                        $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
                    }
                }else{
                    $AkumulasiPenyusutan=$AkumulasiPenyusutan+$PenyusutanPerTahun;
                    $UmurEkonomis=$UmurEkonomis-1;
                    if($UmurEkonomis<=0){
                        $AkumulasiPenyusutan=$NilaiPerolehan;
                        $NilaiBuku=0;
                        $UmurEkonomis=0;
                    }else{
                         $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
                    }
                }
                if($status_pertama==0){
                    $bp=$AkumulasiPenyusutan;
                }else{
                    if($UmurEkonomis<=0)
                        $bp=0;
                    else
                        $bp=$PenyusutanPerTahun;
                }
                $status_pertama=1;
                 /*  echo "Rentang penyusutan dgn Aset_ID=$Aset_ID dan $Kd_Riwayatm $TglPerubahan-->$rentang_penyusutan<br/>
                        
                        PenyusutanPerTahun=$PenyusutanPerTahun-->($NilaiPerolehan/$MasaManfaat)<br/>
                        $AkumulasiPenyusutan=AkumulasiPenyusutan<br/>

                        <br/>
                        ";*/

            }else if($Kd_Riwayat=="7" ||$Kd_Riwayat=="21"||$Kd_Riwayat=="28"){
                //penghabusan sebagain/koreksi nilai //koreksi kapitalisasi
                if($Kd_Riwayat=="28"){
                    $np_next=0;
                    if($NilaiPerolehan==$NilaiPerolehan_Awal){
                        echo "masuk kesini <br/>";
                        $np_next=$data_log[$i+1]['NilaiPerolehan'];
                        $selisih_np_koreksi=$np_next-$NilaiPerolehan;
                        $NilaiPerolehan_Awal=$NilaiPerolehan;
                        $NilaiPerolehan=$np_next;
                        echo "np_next==$np_next<br/>";
                        $update_kd28="update log_jaringan set 
                                    NilaiPerolehan_Awal='$NilaiPerolehan_Awal',
                                    NilaiPerolehan='$NilaiPerolehan' 
                                    where log_id='$log_id' and aset_id='$Aset_ID';\n";
                        logfile("$update_kd28","data-kd-28-jaringan.txt");
                        $selisih_akm=(($TahunPenyusutan-$TahunPerolehan)+1)*($selisih_np_koreksi/$MasaManfaat);
                    }else{
                        echo "gak masukk 28<br/>";
                    }
                }                
                    $AkumulasiPenyusutan=$AkumulasiPenyusutan+$selisih_akm;
                    $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
                   if($PenyusutanPerTahun!=0)
                 {
                    $pp_pengurang=(($NilaiPerolehan-$NilaiPerolehan_Awal)/$MasaManfaat);
                            $PenyusutanPerTahun=$PenyusutanPerTahun+$pp_pengurang;
                 }
                

            }else if($Kd_Riwayat=="2"||$Kd_Riwayat=="29"||$Kd_Riwayat=="291")
            {   
                //kapitalisasi
                $kapitalisasi+=$selisih;
                $NilaiBuku=$NilaiBuku+$selisih;
            }else if($Kd_Riwayat=="51"){
                if($kapitalisasi>0){
                    $persen=($kapitalisasi/$np_awal)*100;
                    
                    $penambahan_masa_manfaat = overhaul ($tmp_kode_log[ 0 ], $tmp_kode_log[ 1 ], $tmp_kode_log[ 2 ], $persen, $DBVAR);
                    $UmurEkonomis=$UmurEkonomis+$penambahan_masa_manfaat;
                    echo "$persen=($kapitalisasi/$np_awal)*100;-->tambah=$penambahan_masa_manfaat-->umur=$UmurEkonomis<br/>";
                    if($UmurEkonomis>$MasaManfaat){
                        $UmurEkonomis=$MasaManfaat;
                    }
                    $PenyusutanPerTahun=$NilaiBuku/$UmurEkonomis;
                    echo "pp=$PenyusutanPerTahun=$NilaiBuku/$UmurEkonomis;<br/>";
                    $AkumulasiPenyusutan=$AkumulasiPenyusutan+$PenyusutanPerTahun;
                    $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
                    $UmurEkonomis=$UmurEkonomis-1;
                    if($UmurEkonomis<=0){
                        $AkumulasiPenyusutan=$NilaiPerolehan;
                        $NilaiBuku=0;
                        $UmurEkonomis=0;
                    }
                     $bp=$PenyusutanPerTahun;
                     $kapitalisasi=0;
                }else{
                    echo "gagal kapitalisasi---";
                    exit();
                }
            }
            echo "$Kd_Riwayat==$bp_log-->$AkumulasiPenyusutan-$AkumulasiPenyusutan_log<br/>";
            
            $query="INSERT INTO `perhitungan_reklas`(`log_id`, `Aset_ID`, `kodeKelompok`,
                             `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`, 
                             `TglPembukuan`, `TglPerubahan`,
                              `kodeKA`, `kodeRuangan`, 
                              `StatusValidasi`, `Status_Validasi_Barang`,
                               `Tahun`, `NilaiPerolehan`,`NilaiPerolehan_Awal`, `Kd_Riwayat`, 
                               `StatusTampil`, `MasaManfaat`, 
                               `AkumulasiPenyusutan`, `NilaiBuku`,
                                `PenyusutanPerTahun`, `AkumulasiPenyusutan_Awal`,
                                 `NilaiBuku_Awal`, `PenyusutanPerTahun_Awal`, 
                                 `UmurEkonomis`, `TahunPenyusutan`, `jenis_hapus`,`bp_log`,`bp`,
                                 `UmurEkonomisLama`,`MasaManfaatLama`)VALUES
                            ('$log_id', '$Aset_ID', '$kodeKelompok',
                             '$kodeSatker', '$kodeLokasi', '$noRegister', '$TglPerolehan', 
                             '$TglPembukuan','$TglPerubahan',
                              '$kodeKA', '$kodeRuangan', 
                              '$StatusValidasi', '$Status_Validasi_Barang',
                               '$TahunPerolehan', '$NilaiPerolehan','$NilaiPerolehan_Awal', '$Kd_Riwayat', 
                               '$StatusTampil', '$MasaManfaat', 
                               '$AkumulasiPenyusutan', '$NilaiBuku',
                                '$PenyusutanPerTahun', '$AkumulasiPenyusutan_log',
                                 '$NilaiBuku_log', '$PenyusutanPerTahun_log', 
                                 '$UmurEkonomis', '$TahunPenyusutan', '$jenis_hapus','$bp_log','$bp','$UmurEkonomis_log','$MasaManfaat_log');\n\n";
        logfile($query,'data-reklas-jaringan.txt');
        $i++;

    }



}

function cek_masamanfaat($kd_aset1, $kd_aset2, $kd_aset3, $DBVAR)
{
    $query = "select * from ref_masamanfaat where kd_aset1='$kd_aset1' "
        . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    $result = $DBVAR->query ($query) or die($DBVAR->error ());
    while ($row = $DBVAR->fetch_object ($result)) {
        $masa_manfaat = $row->masa_manfaat;
    }
    return $masa_manfaat;
}

function overhaul($kd_aset1, $kd_aset2, $kd_aset3, $persen, $DBVAR)
{
    $kd_aset1 = intval ($kd_aset1);
    $kd_aset2 = intval ($kd_aset2);
    $kd_aset3 = intval ($kd_aset3);
    $query = "select * from re_masamanfaat_tahun_berjalan where kd_aset1='$kd_aset1' "
        . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    // echo "$query\n\n";
    $result = $DBVAR->query ($query) or die($query);
    while ($row = $DBVAR->fetch_object ($result)) {
        $masa_manfaat = $row->masa_manfaat;
        $prosentase1 = $row->prosentase1;
        $penambahan1 = $row->penambahan1;
        $prosentase2 = $row->prosentase2;
        $penambahan2 = $row->penambahan2;
        $prosentase3 = $row->prosentase3;
        $penambahan3 = $row->penambahan3;
        $prosentase4 = $row->prosentase4;
        $penambahan4 = $row->penambahan4;
        $prosentase5 = $row->prosentase4;;
    }
    //echo "<pre> ";
    // print($prosentase3);
    if($prosentase4 != 0) {
       // echo " masuk 11 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";
        if($persen > $prosentase4) {
            //  echo "0 =4";
            $hasil = $penambahan4;
        } else if($persen > $prosentase3 && $persen <= $prosentase4) {
            // echo "0 =3";
            $hasil = $penambahan4;
        } else if($persen > $prosentase2 && $persen <= $prosentase3) {
            // echo "0 =2";
            $hasil = $penambahan3;
        } else if($persen > $prosentase1 && $persen <= $prosentase2) {
            // echo "0 =2";
            $hasil = $penambahan2;
        } else if($persen <= $prosentase1) {
            //echo "0 =1";
            $hasil = $penambahan1;
        }
    } else {

       //    echo " masuk 00 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";

        if($persen > $prosentase3) {
            //echo "1 =3";

            $hasil = $penambahan3;
        } else if($persen > $prosentase2 && $persen <= $prosentase3) {
            //echo "1 =2 ";
            $hasil = $penambahan3;
        } else if($persen > $prosentase1 && $persen <= $prosentase2) {
            //echo "1 =3 ";
            $hasil = $penambahan2;
        } else if($persen < $prosentase1) {
            //echo "1 ";
            $hasil = $penambahan1;
        }

    }
    if($hasil == "")
        $hasil = 0;
    echo " prosentase $persen====$hasil \n";

    return $hasil;
}

function microtime_float()
{
    list($usec, $sec) = explode (" ", microtime ());
    return ((float)$usec + (float)$sec);
}


function log_penyusutan($Aset_ID, $tableKib, $Kd_Riwayat, $tahun, $Data, $DBVAR)
{
    //select field dan value tabel kib

    $QueryKibSelect = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
    $exequeryKibSelect = $DBVAR->query ($QueryKibSelect);
    $resultqueryKibSelect = $DBVAR->fetch_object ($exequeryKibSelect);

    $tmpField = array();
    $tmpVal = array();
    $sign = "'";
    $AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal";
    $action = "Penyusutan_" . $tahun . "_" . $Data[ 'kodeSatker' ];
    $TglPerubahan = "$tahun-12-31";
    $changeDate = date ('Y-m-d');
    $NilaiPerolehan_Awal = 0;
    /* $NilaiPerolehan_Awal = $Data['NilaiPerolehan_Awal'];
     if($NilaiPerolehan_Awal ==""||$NilaiPerolehan_Awal ==0){
         $NilaiPerolehan_Awal ="NULL";
     }*/
    $AkumulasiPenyusutan_Awal = $Data[ 'AkumulasiPenyusutan_Awal' ];
    if($AkumulasiPenyusutan_Awal == "" || $AkumulasiPenyusutan_Awal == "0") {
        $AkumulasiPenyusutan_Awal = "NULL";
    }

    $NilaiBuku_Awal = $Data[ 'NilaiBuku_Awal' ];
    if($NilaiBuku_Awal == "" || $NilaiBuku_Awal == "0") {
        $NilaiBuku_Awal = "NULL";
    }

    $PenyusutanPerTahun_Awal = $Data[ 'PenyusutanPerTahun_Awal' ];
    if($PenyusutanPerTahun_Awal == "" || $PenyusutanPerTahun_Awal == "0") {
        $PenyusutanPerTahun_Awal = "NULL";
    }
    foreach ($resultqueryKibSelect as $key => $val) {
        $tmpField[] = $key;
        if($val == '') {
            $tmpVal[] = $sign . "NULL" . $sign;
        } else {
            $tmpVal[] = $sign . addslashes ($val) . $sign;
        }
    }
    $implodeField = implode (',', $tmpField);
    $implodeVal = implode (',', $tmpVal);

    $QueryLog = "INSERT INTO log_$tableKib ($implodeField,$AddField) VALUES"
        . "      ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','{$resultqueryKibSelect->NilaiPerolehan}',$AkumulasiPenyusutan_Awal,"
        . "$NilaiBuku_Awal,$PenyusutanPerTahun_Awal)";
    $exeQueryLog = $DBVAR->query ($QueryLog) or die($DBVAR->error ());;


    return $tableLog;
}

function catatan_hasil_penyusutan($data, $DBVAR)
{
    $Aset_ID = $data[ 'Aset_ID' ];
    $kodeKelompok = $data[ 'kodeKelompok' ];
    $kodeSatker = $data[ 'kodeSatker' ];
    $Tahun = $data[ 'Tahun' ];
    $NilaiPerolehan = $data[ 'NilaiPerolehan' ];
    $MasaManfaat = $data[ 'MasaManfaat' ];
    $NilaiBuku = $data[ 'NilaiBuku' ];
    $info = $data[ 'info' ];
    $log_id = $data[ 'log_id' ];
    $perhitugan = $data[ 'perhitungan' ];
    $TahunPenyusutan = $data[ 'TahunPenyusutan' ];
    $changeDate = $data[ 'changeDate' ];

    $query = "INSERT INTO log_penyusutan (id, Aset_ID, kodeKelompok, kodeSatker, Tahun, NilaiPerolehan, "
        . "             MasaManfaat, NilaiBuku, info, log_id, perhitungan, TahunPenyusutan, changeDate,StatusTampil)"
        . " VALUES (NULL, '$Aset_ID', '$kodeKelompok', '$kodeSatker', '$Tahun', '$NilaiPerolehan', "
        . "     '$MasaManfaat', '$NilaiBuku', '$info', $log_id, '$perhitugan', '$TahunPenyusutan', '$changeDate',1);";
    $exeQueryLog = $DBVAR->query ($query) or die($DBVAR->error ());;
}

function get_data_akumulasi_from_eksisting($Aset_ID, $DBVAR)
{
    $query = "SELECT AkumulasiPenyusutan,UmurEkonomis,MasaManfaat,NilaiBuku,PenyusutanPerTaun,NilaiPerolehan FROM aset WHERE Aset_ID = '$Aset_ID' limit 1";
    $hasil = $DBVAR->query ($query);
    $data = $DBVAR->fetch_array ($hasil);
    $Akumulasi = $data[ 'AkumulasiPenyusutan' ];
    $UmurEkonomis = $data[ 'UmurEkonomis' ];
    $MasaManfaat = $data[ 'MasaManfaat' ];
    $NilaiBuku = $data[ 'NilaiBuku' ];
    $PenyusutanPerTaun = $data[ 'PenyusutanPerTaun' ];
    $NilaiPerolehan = $data[ 'NilaiPerolehan' ];
    return array( $Akumulasi, $UmurEkonomis, $MasaManfaat, $NilaiBuku, $PenyusutanPerTaun, $NilaiPerolehan );
}

function get_data_np_transfer($Aset_ID, $log_id, $table_log, $DBVAR)
{
    $query_1 = "select NilaiPerolehan from $table_log where Aset_ID='$Aset_ID' and log_id > $log_id limit 1";
    $hasil = $DBVAR->query ($query);
    $data = $DBVAR->fetch_array ($hasil);
    $NP = 0;
    $NP = $data[ 'NilaiPerolehan' ];
    if($NP == "" || $NP == "0") {
        $query_1 = "select NilaiPerolehan from aset where Aset_ID='$Aset_ID'  limit 1";
        $hasil = $DBVAR->query ($query_1);
        $data = $DBVAR->fetch_array ($hasil);
        $NP = $data[ 'NilaiPerolehan' ];
    }
    return $NP;
}

function cek_penyusutan_tahun_pertama($Aset_ID,$table_log,$log_id,$DBVAR){
    $query = "select NilaiPerolehan from $table_log where Aset_ID='$Aset_ID' and log_id < $log_id  and kd_riwayat=50 limit 1";
    $hasil = $DBVAR->query ($query);
    $data = $DBVAR->fetch_array ($hasil);
    $NP = $data[ 'NilaiPerolehan' ];
    $panjang=count($data);
    if($panjang>0)
        return 1;
    else return 0;
}
?>