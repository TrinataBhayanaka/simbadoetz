<?php
error_reporting (0);
include "../config/config.php";


$log_table = "log_bangunan";
/*$query_data = "SELECT aset_id FROM log_bangunan WHERE kd_riwayat=51 AND
                tglperubahan='2015-12-31 00:00:00' AND kodesatker ='05.01.01.01' AND
                 aset_id IN (SELECT aset_id FROM log_bangunan WHERE kd_riwayat=50 AND
                 tglperubahan LIKE '2015-01-01%' AND kodesatker ='05.01.01.01' AND NilaiBuku=0)";*/
$myfile = fopen ("data-selisih-bangunan-2015", "r") or die("Unable to open file!");
$aset_id_cek = fread ($myfile, filesize ("data-selisih-bangunan-2015"));
fclose ($myfile);

//$aset_id_cek = "1797738";
//$aset_id_cek="202383";
//$aset_id_cek="1867325";
//$aset_id_cek="1842396";
$query_data = "SELECT aset_id FROM `log_bangunan` WHERE kd_riwayat=51 AND tglperubahan='2015-12-31 00:00:00' and aset_id in($aset_id_cek) ";
$result = $DBVAR->query ($query_data) or die($DBVAR->error ());
$data_selisih = "";
$satker = array();
$i = 0;
$total = 0;
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
     if($log_id_start==""||$log_id_start==0)
        $log_id_start=0;
    $query_jaringan = "select log_id,kodekelompok,kodeSatker,tahun,noregister,kd_riwayat,umurekonomis,MasaManfaat,tglperubahan,NilaiPerolehan,
                    NilaiPerolehan_Awal,(NilaiPerolehan-Nilaiperolehan_awal)as NP,
                    AkumulasiPenyusutan,AkumulasiPenyusutan_Awal,
                    (AkumulasiPenyusutan-AkumulasiPenyusutan_awal)as AKM,
                    PenyusutanPerTahun,
                     NilaiBuku,NilaiBuku_Awal,(NilaiBuku-NilaiBuku_Awal) as NB,MasaManfaat,umurekonomis 
                    from $log_table where aset_id=$Aset_ID and log_id>=$log_id_start and tglperubahan!='0000-00-00 00:00:00'
                     ";
    echo "$query_jaringan<br/>";
    $result_jaringan = $DBVAR->query ($query_jaringan) or die($DBVAR->error ());
    echo "$total == Data Aset==$Aset_ID<br/>";

    $count = 0;
    $status_revisi_2015 = "";
    $kapitalisasi = "0";
    $np_awal = 0;
    $data_history_per_aset = array();

    $log_revisi = 0;
    $log_akhir = 0;
    $data = array();
    $data_log = array();
    $result_log = $result_jaringan;
    while ($row_log = $DBVAR->fetch_array ($result_log)) {
        array_push ($data_log, $row_log);
    }
    $panjang = count ($data_log);
    $log_id_penyusutan_2016 = $data_log[ $panjang - 1 ][ log_id ];
    $log_id_49_penyusutan_2016 = $data_log[ $panjang - 2 ][ log_id ];
    //tahap persiapan

    $delete = "/*Aset_ID=$Aset_ID*/\n delete from log_bangunan where log_id=$log_id_penyusutan_2016;<br/>
            delete from log_bangunan where log_id=$log_id_49_penyusutan_2016;";

    echo "$panjang $delete<br/>";


    echo "<table border='1' style='border: 1px solid black;'>
            <tr>
                <td>Log_ID</td>
                <td>Tahun Pelaporan</td>
                <td>kodekelompok</td>
                <td>kodeSatker</td>
                <td>tahun</td>
                <td>register</td>
                <td>riwayat</td>
                <td>Umur Ekonomis</td>
                <td>MasaManfaat</td>
                <td>PenyusutanPerTahun</td>
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
                 
                <td>NB Seharunya</td>
                <td>NB Awal Seharusnya</td>
                <td>Selisih NB_Perbaikan</td>
                 <td>Status</td>
            </tr>
            ";
    $status_koreksi_kapitalisasi=0;
    $log_geser=array();

    $log_final_2016=0;
    // while ($row_jaringan = $DBVAR->fetch_array ($result_jaringan)) {
    foreach ($data_log as $key => $row_jaringan) {
        $log_id = $row_jaringan[ log_id ];
        $kodekelompok = $row_jaringan[ kodekelompok ];
        $kodeSatker = $row_jaringan[ kodeSatker ];
        $tahun = $row_jaringan[ tahun ];
        $register = $row_jaringan[ noregister ];
        $PenyusutanPerTahun=$row_jaringan['PenyusutanPerTahun'];

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
        $tahun_pelaporan_sblm = $tahun_pelaporan;

        $text_status = "";

        $tmp_tahun_catat = explode ("-", $TglPerubahan);
        $tahun_pelaporan = $tmp_tahun_catat[ 0 ];

        //perbaikan log
        $nb_seharusnya = "";
        $nb_awal_seharusnya = "";

        if($count == 0) {
            $np_awal = $NilaiPerolehan_Awal;
            $nb_awal_seharusnya = $NilaiBuku_Awal;
            $nb_seharusnya = $NilaiBuku;
            $text_status = "$delete";
        } else if($tahun_pelaporan_sblm != $tahun_pelaporan) {
            $np_awal = $NilaiPerolehan_Awal;
        }
        if($kd_riwayat == "2" || $kd_riwayat == "29") {
            ///echo "masukk1231<br/>$log_id $np_awal";
            if($status_koreksi_kapitalisasi==0)
                $nb_awal_seharusnya = $data[ $count - 1 ][ NilaiBuku ];
            else
                $nb_awal_seharusnya = $data[ $count ][ NilaiBuku ];
            if($nb_awal_seharusnya == "")
                $nb_awal_seharusnya = 0;
            $nb_seharusnya = $nb_awal_seharusnya + $selisih_np;
            $kapitalisasi += $selisih_np;

            if($status_koreksi_kapitalisasi==0)
            $text_status = "update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya,
                          NilaiBuku='$nb_seharusnya' where log_id=$log_id;";
            else{

                $index=$count;
                $umurekonomis=$data[ $index ][ umurekonomis ];
                $MasaManfaat=$data[ $index ][ MasaManfaat ];
                $AkumulasiPenyusutan=$data[ $index ][ AkumulasiPenyusutan ];
                $AkumulasiPenyusutan_Awal=$data[ $index ][ AkumulasiPenyusutan_Awal ];
                $PenyusutanPerTahun=$data[ $index ][ PenyusutanPerTahun ];
                $log_id_geser=$log_geser[$log_id];
                $log_id=$log_geser[$log_id];
                $text_status = "update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya,
                          NilaiBuku='$nb_seharusnya',AkumulasiPenyusutan='$AkumulasiPenyusutan',
                          AkumulasiPenyusutan_Awal='$AkumulasiPenyusutan_Awal',
                          umurekonomis='$umurekonomis',MasaManfaat='$MasaManfaat',
                          PenyusutanPerTahun='$PenyusutanPerTahun'
                          where log_id=$log_id_geser;";
            }

        } else if($kd_riwayat == "7" || $kd_riwayat == "21" || $kd_riwayat == "28") {

            if($status_koreksi_kapitalisasi==0)
                $nb_awal_seharusnya = $data[ $count - 1 ][ NilaiBuku ];
            else
                $nb_awal_seharusnya = $data[ $count ][ NilaiBuku ];

            if($nb_awal_seharusnya == "")
                $nb_awal_seharusnya = 0;
            $nb_seharusnya = $NilaiBuku;
            if($status_koreksi_kapitalisasi==0)
                $text_status = "update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya
                              where log_id=$log_id;";
            else{
                $index=$count;
                $umurekonomis=$data[ $index ][ umurekonomis ];
                $MasaManfaat=$data[ $index ][ MasaManfaat ];
                $AkumulasiPenyusutan=$data[ $index ][ AkumulasiPenyusutan ];
                $AkumulasiPenyusutan_Awal=$data[ $index ][ AkumulasiPenyusutan_Awal ];
                $PenyusutanPerTahun=$data[ $index ][ PenyusutanPerTahun ];
                $log_id_geser=$log_geser[$log_id];
                $log_id=$log_geser;
                $text_status = "update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya,
                              ,AkumulasiPenyusutan='$AkumulasiPenyusutan',
                          AkumulasiPenyusutan_Awal='$AkumulasiPenyusutan_Awal',
                          umurekonomis='$umurekonomis',MasaManfaat='$MasaManfaat',
                          PenyusutanPerTahun='$PenyusutanPerTahun'
                              where log_id=$log_id_geser;";
            }


        } else if($kd_riwayat == "49"&& $tahun_pelaporan == "2015") {
            $nb_awal_seharusnya = $data[ $count - 1 ][ NilaiBuku_Awal ];
            $nb_seharusnya = $data[ $count - 1 ][ NilaiBuku ];

            $text_status = "update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya,
                          NilaiBuku='$nb_seharusnya' where log_id=$log_id;";
        } else if($kd_riwayat == "51" && $tahun_pelaporan == "2015") {
            $nb_awal_seharusnya = $data[ $count - 1 ][ NilaiBuku ];
            $nb_seharusnya = $NilaiBuku;

            /*$text_status = "51 2015 -(Kapitalisasi $kapitalisasi--NP $np_awal) update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya,
                          NilaiBuku='$nb_seharusnya' where log_id=$log_id";*/
            $text_status = "update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya,
                          NilaiBuku='$nb_seharusnya' where log_id=$log_id;";
        }
        else if($kd_riwayat == "49" && $tahun_pelaporan == "2016"){
            $index=$count;
            $umurekonomis=$data[ $index ][ umurekonomis ];
            $MasaManfaat=$data[ $index ][ MasaManfaat ];
            $AkumulasiPenyusutan=$data[ $index ][ AkumulasiPenyusutan ];
            $AkumulasiPenyusutan_Awal=$data[ $index ][ AkumulasiPenyusutan_Awal ];
            $PenyusutanPerTahun=$data[ $index ][ PenyusutanPerTahun ];
            $nb_seharusnya=$data[ $index ][ NilaiBuku];
            $nb_awal_seharusnya=$data[ $index ][ NilaiBuku_Awal];

            $text_status="Kapitalisasi $kapitalisasi";
            $log_id=$data[ $index ][ log_id ];
            $log_final_2016=$log_id;

            //pr($log_geser);



            $query_49_kapitalisasi_2016="INSERT INTO `log_bangunan` (`Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`,
`TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`,
 `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, 
 `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`,
  `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, 
  `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`,
  `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`, `UmurEkonomis`, `TahunPenyusutan`,
   `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`,
    `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`,`AkumulasiPenyusutan_Awal`,
                          `NilaiPerolehan_Awal`,`NilaiBuku_Awal`,`kd_riwayat`,`TglPerubahan`)
                          select `Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`,
`TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`,
 `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, 
 `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`,
  `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, 
  `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`,
  `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`, `UmurEkonomis`, `TahunPenyusutan`,
   `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`,
    `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`,
                               `AkumulasiPenyusutan_Awal`,`NilaiPerolehan_Awal`,`NilaiBuku_Awal`,
                               '49','2016-12-31' from log_bangunan where log_id=$log_id;";
            $text_status="$query_49_kapitalisasi_2016";


        }else if(($kd_riwayat=="50"||$kd_riwayat=="51")&& $tahun_pelaporan>2015){
            $index=$count;
            $umurekonomis=$data[ $index ][ umurekonomis ];
            $MasaManfaat=$data[ $index ][ MasaManfaat ];
            $AkumulasiPenyusutan=$data[ $index ][ AkumulasiPenyusutan ];
            $AkumulasiPenyusutan_Awal=$data[ $index ][ AkumulasiPenyusutan_Awal ];
            $PenyusutanPerTahun=$data[ $index ][ PenyusutanPerTahun ];
            $nb_awal_seharusnya=$data[ $index ][ NilaiBuku];
            $Sisa_Masa_Manfaat=$umurekonomis;
         //   pr($data[ $index ]);
            $kodeKelompok_log = $kodekelompok;
            $tmp_kode_log = explode (".", $kodeKelompok_log);
            //penyusutan kapitalisasi
            if($kapitalisasi > 0) {
                $riwayat=51;
                $umurekonomis = $data[ $index ][ umurekonomis ];
                if($umurekonomis < 0)
                    $umurekonomis = 0;
                //$NilaiYgDisusutkan=$nb_buku_log+$selisih;
                $NilaiYgDisusutkan = $data[ $index ][ NilaiBuku ];
                $persen = ($kapitalisasi / $np_awal) * 100;
                $penambahan_masa_manfaat = overhaul ($tmp_kode_log[ 0 ], $tmp_kode_log[ 1 ], $tmp_kode_log[ 2 ], $persen, $DBVAR);
                $Umur_Ekonomis_Final = $umurekonomis + $penambahan_masa_manfaat;
                $umurekonomis_Awal = $umurekonomis;
                $MasaManfaat = cek_masamanfaat ($tmp_kode_log[ 0 ], $tmp_kode_log[ 1 ], $tmp_kode_log[ 2 ], $DBVAR);
                $umurekonomis = $MasaManfaat - ((2014 - $tahun) + 1);//untuk sementara waktu
                if($Umur_Ekonomis_Final > $MasaManfaat) {
                    $Umur_Ekonomis_Final = $MasaManfaat;
                }
                //penyusutannnya berkurang
                $PenyusutanPerTahun_hasil = round ($NilaiYgDisusutkan / $Umur_Ekonomis_Final);
                $AkumulasiPenyusutan_benar = $data[ $index ][ AkumulasiPenyusutan ];
                $AkumulasiPenyusutan_hasil = $AkumulasiPenyusutan_benar + $PenyusutanPerTahun_hasil;
                $NilaiBuku_hasil = $NilaiPerolehan - $AkumulasiPenyusutan_hasil;
                $Sisa_Masa_Manfaat = $Umur_Ekonomis_Final - 1;
                if($Sisa_Masa_Manfaat <= 0) {
                    $NilaiBuku_hasil = 0;
                    $AkumulasiPenyusutan_hasil = $NilaiPerolehan;
                    $Sisa_Masa_Manfaat = 0;
                }



            }else{
                //penyusutan biasa
                $riwayat=50;
                $PenyusutanPerTahun_hasil=$PenyusutanPerTahun;
                $AkumulasiPenyusutan_hasil = $AkumulasiPenyusutan + $PenyusutanPerTahun_hasil;
                $NilaiBuku_hasil = $NilaiPerolehan - $AkumulasiPenyusutan_hasil;
                $Sisa_Masa_Manfaat=$Sisa_Masa_Manfaat-1;
                if($umurekonomis<=0){
                    $AkumulasiPenyusutan_hasil=$NilaiPerolehan;
                    $NilaiBuku_hasil=0;
                }
            }
            //querynya
            $log_sblm=$data[ $index ][ log_id ];
            if($status_koreksi_kapitalisasi==1)
                $log_id=$log_geser[$log_sblm];

            $query_penyusutan_2016="INSERT INTO `log_bangunan`(`Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`,
`TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`,
 `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, 
 `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`,
  `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, 
  `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`,
  `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`, `UmurEkonomis`, `TahunPenyusutan`,
   `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`,
    `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`,

                          `AkumulasiPenyusutan_Awal`,
                          `NilaiPerolehan_Awal`,`NilaiBuku_Awal`,`kd_riwayat`,`TglPerubahan`)
                          select `Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`,
`TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`,
 `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, 
 `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`,
  `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, 
  `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`,
  '$MasaManfaat', '$AkumulasiPenyusutan_hasil', '$NilaiBuku_hasil', '$PenyusutanPerTahun_hasil',  '$Sisa_Masa_Manfaat', '$tahun_pelaporan',
   `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`,
    `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`,
'$AkumulasiPenyusutan',`NilaiPerolehan_Awal`,'$nb_awal_seharusnya',
                               '$riwayat','2016-12-31' from log_bangunan where log_id=$log_final_2016;


                       ";
            $query_jaringan_2016="update jaringan set NilaiBuku='$NilaiBuku_hasil',AkumulasiPenyusutan='$AkumulasiPenyusutan_hasil',
                                              PenyusutanPerTahun='$PenyusutanPerTahun_hasil',UmurEkonomis='$Sisa_Masa_Manfaat',
                                               MasaManfaat='$MasaManfaat' where Aset_ID='$Aset_ID'; ";
            $query_aset_2016="update aset set NilaiBuku='$NilaiBuku_hasil',AkumulasiPenyusutan='$AkumulasiPenyusutan_hasil',
                                              PenyusutanPerTaun='$PenyusutanPerTahun_hasil',UmurEkonomis='$Sisa_Masa_Manfaat',
                                               MasaManfaat='$MasaManfaat' where Aset_ID='$Aset_ID'; ";
            $nb_seharusnya=$NilaiBuku_hasil;
            $text_status="$query_penyusutan_2016<br/>$query_aset_2016<br/>$query_jaringan_2016";
            $data[]= array( "log_id" => $log_id,
                "kodekelompok" => $kodekelompok,
                "kodesatker" => $kodeSatker,
                "tahun" => $tahun,
                "register" => $register,
                "kd_riwayat" => $riwayat,
                "umurekonomis" => $Sisa_Masa_Manfaat,
                "MasaManfaat" => $MasaManfaat,
                "TglPerubahan" => '2016-12-31',
                "NilaiPerolehan" => $NilaiPerolehan,
                "NilaiPerolehan_Awal" => $NilaiPerolehan_Awal,
                "selisih_np" => $selisih_np,
                "AkumulasiPenyusutan" => $AkumulasiPenyusutan_hasil,
                "AkumulasiPenyusutan_Awal" => $AkumulasiPenyusutan,
                "selisih_akm" => "-",
                "NilaiBuku" => $NilaiBuku_hasil,
                "NilaiBuku_Awal" => $NilaiBuku,
                "selisih_nb" => "-",
                "text_status" => "$text_status",
                "tahun_pelaporan" => $tahun_pelaporan,
                "PenyusutanPerTahun"=>$PenyusutanPerTahun_hasil

            );
            $status_selesai=1;

        }else if($kd_riwayat!="50"&&$tahun_pelaporan<=2015){
            if($status_koreksi_kapitalisasi==1)
                $log_id=$log_geser[$log_id];
            $umurekonomis=$data[ $index ][ umurekonomis ];
            $MasaManfaat=$data[ $index ][ MasaManfaat ];
            $AkumulasiPenyusutan=$data[ $index ][ AkumulasiPenyusutan ];
            $AkumulasiPenyusutan_Awal=$data[ $index ][ AkumulasiPenyusutan_Awal ];
            $PenyusutanPerTahun=$data[ $index ][ PenyusutanPerTahun ];
            $nb_seharusnya=$data[ $index ][ NilaiBuku];
            $nb_awal_seharusnya=$data[ $index ][ NilaiBuku_Awal];


            $text_status = "update log_bangunan set NilaiBuku_Awal=$nb_awal_seharusnya,
                              NilaiBuku='$nb_seharusnya',
                              AkumulasiPenyusutan='$AkumulasiPenyusutan',
                          AkumulasiPenyusutan_Awal='$AkumulasiPenyusutan_Awal',
                          umurekonomis='$umurekonomis',MasaManfaat='$MasaManfaat',
                          PenyusutanPerTahun='$PenyusutanPerTahun'
                              where log_id=$log_id;";
        }


        if($tahun_pelaporan != 0) {
            if($status_selesai!=1)
            $data[] = array( "log_id" => $log_id,
                "kodekelompok" => $kodekelompok,
                "kodesatker" => $kodeSatker,
                "tahun" => $tahun,
                "register" => $register,
                "kd_riwayat" => $kd_riwayat,
                "umurekonomis" => $umurekonomis,
                "MasaManfaat" => $MasaManfaat,
                "TglPerubahan" => $TglPerubahan,
                "NilaiPerolehan" => $NilaiPerolehan,
                "NilaiPerolehan_Awal" => $NilaiPerolehan_Awal,
                "selisih_np" => $selisih_np,
                "AkumulasiPenyusutan" => $AkumulasiPenyusutan,
                "AkumulasiPenyusutan_Awal" => $AkumulasiPenyusutan_Awal,
                "selisih_akm" => $selisih_akm,
                "NilaiBuku" => $nb_seharusnya,
                "NilaiBuku_Awal" => $nb_awal_seharusnya,
                "selisih_nb" => $selisih_nb,
                "text_status" => $text_status,
                "tahun_pelaporan" => $tahun_pelaporan,
                "PenyusutanPerTahun"=>$PenyusutanPerTahun

            );
            echo "<tr>
                <td>$count $log_id</td>
                <td>$tahun_pelaporan</td>
                <td>$kodekelompok</td>
                <td>$kodeSatker</td>
                <td>$tahun</td>
                <td>$register</td>
                <td>$kd_riwayat</td>
                <td>$umurekonomis</td>
                <td>$MasaManfaat</td>
                <td>$PenyusutanPerTahun</td>
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
                <td><b>$nb_seharusnya</b></td>
                <td><b>$nb_awal_seharusnya</b></td>
                
               
                <td>$selisih_nb_perbaikan</td>
                <td>$text_status</td>
            </tr>";
            if($kd_riwayat == "51" && $tahun_pelaporan == "2015") {
                //geser log
                $query_geser = "";
                $flag = 1;
                $id_log_koreksi = "";
                echo "koreksi222 $panjang $count";
                for ($j = $panjang - 3; $j >= $count; $j--) {
                    $log_id_tujuan = $data_log[ $panjang - $flag ][ log_id ];
                    if($j==$count &&$flag==1)
                    $log_id_asal = $data_log[ $j+1 ][ log_id ];
                        else
                    $log_id_asal = $data_log[ $j ][ log_id ];

                    $data_log[ $j ][ log_id ]=$log_id_tujuan;
                    echo "masul2";
                    pr( $data_log[ $j ]);
                    if($flag == 1)
                        $id_log_koreksi = "$log_id_asal";
                    $query_geser .= "update log_bangunan set log_id=$log_id_tujuan where log_id=$log_id_asal;<br/>";
                    $log_geser[$log_id_asal]=$log_id_tujuan;
                    $flag++;
                }

                echo "<tr> 
                <td colspan='24'>$count ==$panjang --$query_geser koreksi perbaikan penyusutan untuk tahun 2015</td>
               
            </tr>";
                //hitung penyusutan
                $kodeKelompok_log = $kodekelompok;
                $tmp_kode_log = explode (".", $kodeKelompok_log);
                // $kd_riwayat=$Data_Log->kd_riwayat;

                $status_perubahan_kap = 0;

                if($kapitalisasi > 0) {
                    $umurekonomis = $data[ $count - 1 ][ UmurEkonomis ];
                    if($umurekonomis < 0)
                        $umurekonomis = 0;
                    //$NilaiYgDisusutkan=$nb_buku_log+$selisih;
                    $NilaiYgDisusutkan = $data[ $count - 1 ][ NilaiBuku ];
                    $persen = ($kapitalisasi / $np_awal) * 100;
                    $penambahan_masa_manfaat = overhaul ($tmp_kode_log[ 0 ], $tmp_kode_log[ 1 ], $tmp_kode_log[ 2 ], $persen, $DBVAR);
                    $Umur_Ekonomis_Final = $umurekonomis + $penambahan_masa_manfaat;
                    $umurekonomis_Awal = $umurekonomis;
                    $MasaManfaat = cek_masamanfaat ($tmp_kode_log[ 0 ], $tmp_kode_log[ 1 ], $tmp_kode_log[ 2 ], $DBVAR);
                    $umurekonomis = $MasaManfaat - ((2014 - $tahun) + 1);//untuk sementara waktu
                    if($Umur_Ekonomis_Final > $MasaManfaat) {
                        $Umur_Ekonomis_Final = $MasaManfaat;
                    }
                    //penyusutannnya berkurang
                    $PenyusutanPerTahun_hasil = round ($NilaiYgDisusutkan / $Umur_Ekonomis_Final);
                    $AkumulasiPenyusutan_benar = $data[ $count - 1 ][ AkumulasiPenyusutan ];
                    $AkumulasiPenyusutan_hasil = $AkumulasiPenyusutan_benar + $PenyusutanPerTahun_hasil;
                    $NilaiBuku_hasil = $NilaiPerolehan - $AkumulasiPenyusutan_hasil;
                    $Sisa_Masa_Manfaat = $Umur_Ekonomis_Final - 1;
                    if($Sisa_Masa_Manfaat <= 0) {
                        $NilaiBuku_hasil = 0;
                        $AkumulasiPenyusutan_hasil = $NilaiPerolehan;
                        $Sisa_Masa_Manfaat = 0;
                    }

                    $selish_akm_benar = $AkumulasiPenyusutan_hasil - $AkumulasiPenyusutan;


                    echo "<tr>
                <td colspan='24'>
                    Hasil Koreksi:<br/>
                    Kapitalisasi=$kapitalisasi<br/>
                    persen=$persen<br/>
                    penambahan_masa_manfaat=$penambahan_masa_manfaat<br/>
                    NilaiYgDisusutkan=$NilaiYgDisusutkan<br/>
                    NilaiPerolehan=$NilaiPerolehan<br/>
                    AkumulasiPenyusutan_Awal=$AkumulasiPenyusutan<br>
                    AkumulasiPenyusutanFinal=$AkumulasiPenyusutan_hasil<br/>
                    NilaiBuku_Awal=$NilaiBuku<br/>
                    NilaiBukuFinal=$NilaiBuku_hasil<br/>
                    UmurEkonomis=$Sisa_Masa_Manfaat<br/>
                    koreksiPenyusutan=$PenyusutanPerTahun_hasil<br/>

                </td>
               
            </tr>";


                    $query_update_koreksi_penyusutan = "INSERT INTO `log_bangunan`
(`Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`,
`TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`,
 `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, 
 `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`,
  `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, 
  `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`,
   `TahunPenyusutan`,
   `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`,
    `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`,`NilaiPerolehan_Awal`,
             `kd_riwayat`,`log_id`,`AkumulasiPenyusutan`,`AkumulasiPenyusutan_Awal`,`NilaiBuku`,
             `NilaiBuku_Awal`,`UmurEkonomis`,`MasaManfaat`,`TglPerubahan`,`PenyusutanPerTahun`)

                

select `Bangunan_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`, `noRegister`, `TglPerolehan`,
`TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, `Status_Validasi_Barang`,
 `StatusTampil`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, `kondisi`, `CaraPerolehan`, 
 `TglPakai`, `Konstruksi`, `Beton`, `JumlahLantai`, `LuasLantai`, `Dinding`, `Lantai`, `LangitLangit`,
  `Atap`, `NoSurat`, `TglSurat`, `NoIMB`, `TglIMB`, `StatusTanah`, `NoSertifikat`, `TglSertifikat`, 
  `Tanah_ID`, `Tmp_Tingkat`, `Tmp_Beton`, `Tmp_Luas`, `KelompokTanah_ID`, `GUID`, `TglPembangunan`,
   `TahunPenyusutan`,
   `nilai_kapitalisasi`, `prosentase`, `penambahan_masa_manfaat`, `jenis_belanja`,
    `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`,`NilaiPerolehan_Awal`,
'55','$id_log_koreksi','$AkumulasiPenyusutan_hasil','$AkumulasiPenyusutan','$NilaiBuku_hasil',
             '$NilaiBuku','$Sisa_Masa_Manfaat','$MasaManfaat','2016-01-02','$PenyusutanPerTahun_hasil' from log_bangunan where log_id='$log_id';";
                    $text_status="$query_geser<br/>$query_update_koreksi_penyusutan";
                    $kapitalisasi = 0;
                    $data[]= array( "log_id" => $log_id,
                        "kodekelompok" => $kodekelompok,
                        "kodesatker" => $kodeSatker,
                        "tahun" => $tahun,
                        "register" => $register,
                        "kd_riwayat" => 55,
                        "umurekonomis" => $Sisa_Masa_Manfaat,
                        "MasaManfaat" => $MasaManfaat,
                        "TglPerubahan" => '2016-01-02',
                        "NilaiPerolehan" => $NilaiPerolehan,
                        "NilaiPerolehan_Awal" => $NilaiPerolehan_Awal,
                        "selisih_np" => $selisih_np,
                        "AkumulasiPenyusutan" => $AkumulasiPenyusutan_hasil,
                        "AkumulasiPenyusutan_Awal" => $AkumulasiPenyusutan,
                        "selisih_akm" => $selish_akm_benar,
                        "NilaiBuku" => $NilaiBuku_hasil,
                        "NilaiBuku_Awal" => $NilaiBuku,
                        "selisih_nb" => "-",
                        "text_status" => "$text_status",
                        "tahun_pelaporan" => $tahun_pelaporan,
                        "PenyusutanPerTahun"=>$PenyusutanPerTahun_hasil

                    );
                    $status_koreksi_kapitalisasi=1;


                    echo "<tr >

                <td>Koreksi Penyusutan$id_log_koreksi</td>
                <td>$tahun_pelaporan</td>
                <td>$kodekelompok</td>
                <td>$kodeSatker</td>
                <td>$tahun</td>
                <td>$register</td>
                <td>$kd_riwayat</td>
                <td>$Sisa_Masa_Manfaat</td>
                <td>$MasaManfaat</td>
                <td>$PenyusutanPerTahun_hasil</td>
                <td>2016-01-02</td>
               <td>$NilaiPerolehan</td>
                <td>$NilaiPerolehan_Awal</td>
                <td>$selisih_np</td>
                <td>AKM=$AkumulasiPenyusutan_hasil</td>
                <td>AKMAwAL=$AkumulasiPenyusutan </td>
                 <td>$selish_akm_benar</td>
                <td>NB=$NilaiBuku_hasil</td>
                <td>NB_AWAl=$NilaiBuku</td>
                 <td>-</td>
                <td><b>-</b></td>
                <td><b>-</b></td>
                
               
                <td>$selisih_nb_perbaikan</td>
                <td>$text_status</td>
            </tr>";
                }
                //hitung penyusutan
            }
            $data_plain=str_replace("<br/>", "\n", $text_status);
            logFile($data_plain,"bangunan2015/$Aset_ID.txt");
            $count++;
        }

    }
    echo "</table>";
    echo "hasil rekonstruksi ====<br/>";
    pr($data);
    unset($data);
    $tahun_pelaporan=0;
    $status_selesai=0;
}
echo ($data_selisih);
echo "<br/> Jumlah Selisih ==$i dari $total. Satker yang terkena: <br/>";
echo json_encode ($satker);

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

?>