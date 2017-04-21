<?php
error_reporting (0);
include "../config/config.php";


$log_table = "log_mesin";
$table="mesin";

$query_data = "SELECT  aset_id,umurekonomis,MasaManfaat,kd_riwayat,TglPerubahan,NilaiPerolehan,NilaiPerolehan_Awal,(NilaiPerolehan-NilaiPerolehan_Awal)as np,AkumulasiPenyusutan,AkumulasiPenyusutan_Awal,(AkumulasiPenyusutan-AkumulasiPenyusutan_Awal)as akm,nilaibuku,NilaiBuku_Awal, PenyusutanPerTahun,PenyusutanPerTahun_Awal,bp_log,bp,(bp-bp_log)as selisih FROM `perhitungan_reklas_mesin` where ((bp_log-bp)>2 or (bp_log-bp)<-2) and Kd_Riwayat in(50,51) group by aset_id ";
$result = $DBVAR->query ($query_data) or die($DBVAR->error ());
$data_selisih = "";
$satker = array();
$i = 0;
$total = 0;

while ($row = $DBVAR->fetch_array ($result)) {
    $total++;
    
    $Aset_ID = $row[ 'aset_id' ];

    $info="/*Penelusuran eksekusi revisi reklas untuk aset_id=$Aset_ID*/\n\n";
    echo "$info<br/>";
    logfile($info,"eksekusiBPK-mesin/revisi-$Aset_ID.txt");

    $query_cek="SELECT aset_id,UmurEkonomis,kodeSatker,kodeLokasi,noRegister,Kd_Riwayat,TahunPenyusutan,
    kodeKelompok,kodeRuangan,
        Tahun,TglPerolehan,TglPembukuan,kodeKA,StatusValidasi,Status_Validasi_Barang,StatusTampil,jenis_hapus,
        MasaManfaat,kd_riwayat,TglPerubahan,NilaiPerolehan,NilaiPerolehan_Awal,(NilaiPerolehan-NilaiPerolehan_Awal)as np,AkumulasiPenyusutan,AkumulasiPenyusutan_Awal,(AkumulasiPenyusutan-AkumulasiPenyusutan_Awal)as akm,NilaiBuku,NilaiBuku_Awal, PenyusutanPerTahun,PenyusutanPerTahun_Awal,bp_log,bp,(bp-bp_log)as selisih FROM `perhitungan_reklas_mesin` where ((bp_log-bp)>2 or (bp_log-bp)<-2) and Kd_Riwayat in(50,51)
        and aset_id='$Aset_ID';";
   
    $NilaibUku=0;
    $AkumulasiPenyusutan=0;
    $PenyusutanPerTahun=0;
    $kapitalisasi=0;
    $np_awal=0;               
    $status_pertama=0;
    $i=0;
    $result_history=$DBVAR->query ($query_cek) or die($DBVAR->error ());
    while($row_history=$DBVAR->fetch_array ($result_history)){

            /**Data Primer**/
            $kodeSatker=$row_history['kodeSatker'];
            $kodeLokasi=$row_history['kodeLokasi'];
            $noRegister=$row_history['noRegister'];
            $kodeKelompok=$row_history['kodeKelompok'];
            //$NilaiPerolehan=$row_history['NilaiPerolehan'];
            //$NilaiPerolehan_Awal=$row_history['NilaiPerolehan_Awal'];
            $selisih=$row_history['selisih'];
           
            $Kd_Riwayat=$row_history['Kd_Riwayat'];
            $NilaiBuku_log=$row_history['NilaiBuku'];
            $AkumulasiPenyusutan_log=$row_history['AkumulasiPenyusutan'];
          
             $AkumulasiPenyusutan_log_awal=$row_history['AkumulasiPenyusutan_Awal'];
        
            $PenyusutanPerTahun=$row_history['PenyusutanPerTahun'];
            $TahunPenyusutan=$row_history['TahunPenyusutan'];
            $TahunPerolehan=$row_history['Tahun'];
             /**Data Primer**/

            /**Data Sekunder**/
            $UmurEkonomis=$row_history['UmurEkonomis'];
            $MasaManfaat=$row_history['MasaManfaat'];
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

             echo "<br/>selisih $selisih<br/>";



             $query_log="SELECT aset_id,UmurEkonomis,kodeSatker,kodeLokasi,noRegister,Kd_Riwayat,TahunPenyusutan,
        Tahun,TglPerolehan,TglPembukuan,kodeKA,StatusValidasi,Status_Validasi_Barang,StatusTampil,jenis_hapus,
        MasaManfaat,kd_riwayat,TglPerubahan,NilaiPerolehan,NilaiPerolehan_Awal,(NilaiPerolehan-NilaiPerolehan_Awal)as np,AkumulasiPenyusutan,AkumulasiPenyusutan_Awal,(AkumulasiPenyusutan-AkumulasiPenyusutan_Awal)as akm,NilaiBuku,NilaiBuku_Awal, PenyusutanPerTahun,PenyusutanPerTahun_Awal FROM `log_mesin` where Kd_Riwayat in(50,51) and TglPerubahan='2016-12-31'
        and aset_id='$Aset_ID' limit 1;";
        $result_log = $DBVAR->query ($query_log) or die($DBVAR->error ());
        while($row_log=$DBVAR->fetch_array ($result_log)){
            $kodeSatker_log =$row_log['kodeSatker'];
            $kodeLokasi_log =$row_log['kodeLokasi'];
            $noRegister_log =$row_log['noRegister'];
            $NilaiPerolehan =$row_log['NilaiPerolehan'];
            $NilaiPerolehan_Awal_log =$row_log['NilaiPerolehan_Awal'];
            $selisih_log =$row_log['selisih'];
           
            $Kd_Riwayat_log =$row_log['Kd_Riwayat'];
            $NilaiBuku_log_log =$row_log['NilaiBuku'];
            $AkumulasiPenyusutan_log_log =$row_log['AkumulasiPenyusutan'];
          
             $AkumulasiPenyusutan_log_awal_log =$row_log['AkumulasiPenyusutan_Awal'];
        
            $PenyusutanPerTahun_log_log =$row_log['PenyusutanPerTahun'];
            $TahunPenyusutan_log =$row_log['TahunPenyusutan'];
            $TahunPerolehan_log =$row_log['Tahun'];
             /**Data Primer**/

            /**Data Sekunder**/
            $UmurEkonomis_log_log =$row_log['UmurEkonomis'];
            $MasaManfaat_log_log =$row_log['MasaManfaat'];
            $TglPerolehan_log =$row_log['TglPerolehan'];
            $TglPembukuan_log =$row_log['TglPembukuan'];
            $TglPerubahan_log =$row_log['TglPerubahan'];
            $kodeKA_log =$row_log['kodeKA'];
            $kodeRuangan_log =$row_log['kodeRuangan'];
            $StatusValidasi_log =$row_log['StatusValidasi'];
            $Status_Validasi_Barang_log =$row_log['Status_Validasi_Barang'];
            $StatusTampil_log =$row_log['StatusTampil'];
            $jenis_hapus_log =$row_log['jenis_hapus'];
            
        
        }
        //hitungannya=
        if($status_pertama==0){
            //ngambil dari log dahulu
            $NilaiPerolehan_Awal=$NilaiPerolehan;
            $AkumulasiPenyusutan=$AkumulasiPenyusutan_log_log+$selisih;
            $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
            echo "AKM:$AkumulasiPenyusutan=$AkumulasiPenyusutan_log_log+$selisih;<br/>
            NB: $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;";
            $AkumulasiPenyusutan_log=$AkumulasiPenyusutan_log_log;
            $NilaiBuku_log=$NilaiBuku_log_log;
            $PenyusutanPerTahun_log=$PenyusutanPerTahun_log_log;
            $status_pertama=1;

        }else{
            $AkumulasiPenyusutan_log=$AkumulasiPenyusutan;
            $AkumulasiPenyusutan=$AkumulasiPenyusutan+$selisih;
            $NilaiBuku_log=$NilaiBuku;
            $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;

            $PenyusutanPerTahun_log=$PenyusutanPerTahun;
            
        }
        

                 $query="INSERT INTO `log_mesin`(`log_id`, `Aset_ID`, `kodeKelompok`,
                             `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`, 
                             `TglPembukuan`, `TglPerubahan`,
                              `kodeKA`, `kodeRuangan`, 
                              `StatusValidasi`, `Status_Validasi_Barang`,
                               `Tahun`, `NilaiPerolehan`,`NilaiPerolehan_Awal`, `Kd_Riwayat`, 
                               `StatusTampil`, `MasaManfaat`, 
                               `AkumulasiPenyusutan`, `NilaiBuku`,
                                `PenyusutanPerTahun`, `AkumulasiPenyusutan_Awal`,
                                 `NilaiBuku_Awal`, `PenyusutanPerTahun_Awal`, 
                                 `UmurEkonomis`, `TahunPenyusutan`, `jenis_hapus`)VALUES
                            (NULL, '$Aset_ID', '$kodeKelompok',
                             '$kodeSatker', '$kodeLokasi', '$noRegister', '$TglPerolehan', 
                             '$TglPembukuan','2016-12-31',
                              '$kodeKA', '$kodeRuangan', 
                              '$StatusValidasi', '$Status_Validasi_Barang',
                               '$TahunPerolehan', '$NilaiPerolehan','$NilaiPerolehan_Awal', '55', 
                               '$StatusTampil', '$MasaManfaat', 
                               '$AkumulasiPenyusutan', '$NilaiBuku',
                                '$PenyusutanPerTahun', '$AkumulasiPenyusutan_log',
                                 '$NilaiBuku_log', '$PenyusutanPerTahun_log', 
                                 '$UmurEkonomis', '$TahunPenyusutan', '$jenis_hapus');\n\n";

              $query_aset="update aset set NilaiBuku='$NilaiBuku',AkumulasiPenyusutan='$AkumulasiPenyusutan',
                                PenyusutanPerTaun='$PenyusutanPerTahun',
                                UmurEkonomis='$UmurEkonomis',TahunPenyusutan='$TahunPenyusutan' 
                                where aset_id='$Aset_ID'; \n\n";
             $query_master="update bangunan set NilaiBuku='$NilaiBuku',AkumulasiPenyusutan='$AkumulasiPenyusutan',
                                PenyusutanPerTahun='$PenyusutanPerTahun',
                                UmurEkonomis='$UmurEkonomis',TahunPenyusutan='$TahunPenyusutan' 
                                where aset_id='$Aset_ID'; ";

             $hasil="$query\n$query_aset\n$query_master\n\n";
        
        logfile($query,"eksekusiBPK-mesin/revisi-$Aset_ID.txt");

        $i++;

    }



}

?>