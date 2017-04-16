<?php
error_reporting (0);
include "../config/config.php";


$text_cari=$_GET['cari'];
$log_table="log_jaringan";
echo "Cari data Selisih di $log_table<br/>";
/*$query_data = "SELECT aset_id FROM log_jaringan WHERE kd_riwayat=51 AND
                tglperubahan='2015-12-31 00:00:00' AND kodesatker ='05.01.01.01' AND
                 aset_id IN (SELECT aset_id FROM log_jaringan WHERE kd_riwayat=50 AND 
                 tglperubahan LIKE '2015-01-01%' AND kodesatker ='05.01.01.01' AND NilaiBuku=0)";*/
$myfile = fopen ("data-selisih-jaringan-2015", "r") or die("Unable to open file!");
$aset_id_cek = fread ($myfile, filesize ("data-selisih-jaringan-2015"));
fclose ($myfile);
$query_data = "SELECT aset_id FROM $log_table WHERE kd_riwayat=51 AND 
                tglperubahan='2015-12-31 00:00:00' and aset_id in ($aset_id_cek) ";

$result = $DBVAR->query ($query_data) or die($DBVAR->error ());
$data_selisih="";
$satker=array();
$i=0;
$total=0;
while ($row = $DBVAR->fetch_array ($result)) {
    $total++;
    $Aset_ID = $row[ 'aset_id' ];

    //get log_id starting from audit
    $query_log = "SELECT log_id FROM $log_table WHERE aset_id=$Aset_ID AND kd_riwayat=50
                     AND TglPerubahan LIKE '2015-01-01%'";
    $result_log = $DBVAR->query ($query_log) or die($DBVAR->error ());
    while ($row_log = $DBVAR->fetch_array ($result_log)) {
        $log_id_start = $row_log[ log_id ];
    }

    $query_jaringan = "select log_id,kodekelompok,kodeSatker,tahun,noregister,kd_riwayat,umurekonomis,MasaManfaat,tglperubahan,NilaiPerolehan,
                    NilaiPerolehan_Awal,(NilaiPerolehan-Nilaiperolehan_awal)as NP,
                    AkumulasiPenyusutan,AkumulasiPenyusutan_Awal,
                    (AkumulasiPenyusutan-AkumulasiPenyusutan_awal)as AKM,
                     NilaiBuku,NilaiBuku_Awal,(NilaiBuku-NilaiBuku_Awal) as NB,MasaManfaat,umurekonomis 
                    from $log_table where aset_id=$Aset_ID and log_id>=$log_id_start
                     ";
    $result_jaringan = $DBVAR->query ($query_jaringan) or die($DBVAR->error ());
    echo "$total == Data Aset==$Aset_ID<br/>";
    echo "<table border='1' style='border: 1px solid black;'>
            <tr>
                <td>Log_ID</td>
                <td>kodekelompok</td>
                <td>kodeSatker</td>
                <td>tahun</td>
                <td>register</td>
                <td>riwayat</td>
                <td>Umur Ekonomis</td>
                <td>MasaManfaat</td>
                <td>TglPerubahan</td>
                <td>NilaiPerolehan</td>
                <td>NilaiPerolehan_Awal</td>
                <td>Selish NP</td>
                <td>AkumulasiPenyusutan</td>
                <td>AkumulasiPenyusutan_awal</td>
                 <td>Selisih AKM</td>
                <td>NilaiBuku</td>
                <td>NilaiBukuAwal</td>
                <td>Selisih NB</td>
                 <td>Status</td>
            </tr>
            ";

    while ($row_jaringan = $DBVAR->fetch_array ($result_jaringan)) {
        $log_id = $row_jaringan[ log_id ];
        $kodekelompok = $row_jaringan[ kodekelompok ];
        $kodeSatker = $row_jaringan[ kodeSatker ];
        $tahun = $row_jaringan[ tahun ];
        $register = $row_jaringan[ noregister ];


        $kd_riwayat = $row_jaringan[ kd_riwayat ];
        $umurekonomis = $row_jaringan[ umurekonomis ];
        $MasaManfaat = $row_jaringan[ MasaManfaat ];
        $TglPerubahan = $row_jaringan[ tglperubahan ];
        $NilaiPerolehan = $row_jaringan[ NilaiPerolehan ];
        $NilaiPerolehan_Awal = $row_jaringan[ NilaiPerolehan_Awal ];
        $selisih_np = $row_jaringan[ NP ];
        $AkumulasiPenyusutan = $row_jaringan[ AkumulasiPenyusutan ];

        $AkumulasiPenyusutan_Awal = $row_jaringan[ AkumulasiPenyusutan_Awal ];

        $NilaiBuku = $row_jaringan[ NilaiBuku ];
        $NilaiBuku_Awal = $row_jaringan[ NilaiBuku_Awal ];
        $selisih_akm = $row_jaringan[ AKM ];
        $selisih_nb = $row_jaringan[ NB ];
        $text_status="";
        if($kd_riwayat=="2" || $kd_riwayat=="29"){
            $status=0;
            $cek_nb=$NilaiPerolehan-$AkumulasiPenyusutan;
            if($NilaiBuku!=$cek_nb){
                $cek_nb=$cek_nb-$NilaiBuku;
                $text_status="$Aset_ID false ($cek_nb)";
                if($i==0)
                    $data_selisih="$Aset_ID";
                else $data_selisih="$data_selisih,$Aset_ID";
                $satker[$i]=$kodeSatker;

                $i++;
            }
        }
        echo "<tr>
                <td>$log_id</td>
                <td>$kodekelompok</td>
                <td>$kodeSatker</td>
                <td>$tahun</td>
                <td>$register</td>
                <td>$kd_riwayat</td>
                <td>$umurekonomis</td>
                <td>$MasaManfaat</td>
                <td>$TglPerubahan</td>
                <td>$NilaiPerolehan</td>
                <td>$NilaiPerolehan_Awal</td>
                <td>$selisih_np</td>
                <td>$AkumulasiPenyusutan</td>
                <td>$AkumulasiPenyusutan_Awal </td>
                 <td>$selisih_akm</td>
                <td>$NilaiBuku</td>
                <td>$NilaiBuku_Awal</td>
                <td>$selisih_nb</td>
                <td>$text_status</td>
            </tr>";

    }
    echo "</table>";
    echo "hasil rekonstruksi ====<br/>";


}
echo ($data_selisih);
echo "<br/> Jumlah Selisih ==$i dari $total. Satker yang terkena: <br/>";
echo json_encode($satker);

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
        echo " masuk 11 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";
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

        echo " masuk 00 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";

        if($persen > $prosentase3) {
            echo "1 =3";

            $hasil = $penambahan3;
        } else if($persen > $prosentase2 && $persen <= $prosentase3) {
            echo "1 =2 ";
            $hasil = $penambahan3;
        } else if($persen > $prosentase1 && $persen <= $prosentase2) {
            echo "1 =3 ";
            $hasil = $penambahan2;
        } else if($persen <= $prosentase1) {
            echo "1 ";
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

?>