<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
error_reporting(0);
include "../../config/config.php";
session_write_close();
$kib 	= $argv[1];
$tahun 	= $argv[2];
$kodeSatker=$argv[3];
$id=$argv[4];

$tahun ="2013";
$tahun_next="2014";
$query="`Aset_ID`, `kodeKelompok`, `kodeSatker`, `tahunAset`, "
        . "`MasaManfaat`, `Status_Validasi_Barang`, "
        . "`umurEkonomis`, `nilaiPerolehan_Awal`,"
        . " `nilaiPerolehan_Akhir`, "
        . "`selisih`, `persentaseSelisihtoPerolehan`, ,"
        . " `penambahanMasaManfaat`, "
        . "`AkumulasiPenyusutan`, "
        . "`PenyusutanPerTahun`, "
        . "`id_tabel_penyusutan_berjalan`, "
        . "`keterangan` "
        . "FROM `history_penyusutan_berjalan`";

$query="select a.Aset_ID,a.kodeKelompok,a.kodeSatker,a.Tahun,
               a.MasaManfaat,a.Status_Validasi_Barang,UmurEkonomis,a.NilaiPerolehan,a.NilaiPerolehan_Awal,
               a.AkumulasiPenyusutan,a.PenyusutanPerTahun,GUID
	
 from log_mesin a where a.NilaiPerolehan!=a.NilaiPerolehan_Awal 
and a.TglPerubahan>'$tahun_next-01-01' 
and a.Tahun <$tahun 
    and a.Kd_Riwayat!=27 and a.Kd_Riwayat!=0 and a.Kd_Riwayat!=26
 order by a.log_id desc";
echo $query;
exit();
$ExeQuery = $DBVAR->query($query) or die($DBVAR->error());
while($Data = $DBVAR->fetch_array($ExeQuery)){
     $Aset_ID=$Data['Aset_ID'];
     $kodeKelompok=$Data['kodeKelompok'];
     $kodeSatker=$Data['kodeSatker'];
     $tahun=$Data['Tahun'];
     $MasaManfaat=$Data['MasaManfaaat'];
     $Status_Validasi_Barang=$Data['Status_Validasi_Barang'];
     $UmurEkonomis=$Data['UmurEkonomis'];
     $NilaiPerolehan=abs($Data['NilaiPerolehan']);
      $NilaiPerolehan_Awal=abs($Data['NilaiPerolehan_Awal']);
      $selisih=$NilaiPerolehan-$NilaiPerolehan_Awal;
      
      
      $AkumulasiPenyusutan=$Data['AkumulasiPenyusutan'];
      $PenyusutanPerTahun=$Data['PenyusutanPerTahun'];
              $keterangan=$Data['GUID'];
              
        $cek_data="select Aset_ID from history_penyusutan_berjalan where Aset_ID='$Aset_ID' limit 1";
        $result_cek=$DBVAR->query($cek_data) or die($DBVAR->error());
        $cek_aset_ID="";
        while($row_cek=$DBVAR->fetch_array($result_cek)){
             $cek_aset_ID=$row_cek['Aset_ID'];
        }
        if($cek_aset_ID!=""){
             //replace atau update
            //insert
             $query_history="replace into history_penyusutan_berjalan(`Aset_ID`, `kodeKelompok`, `kodeSatker`, `tahunAset`, "
                     . "                     `MasaManfaat`, `Status_Validasi_Barang`, `umurEkonomis`,"
                     . "                      `nilaiPerolehan_Akhir`, `selisih`, `persentaseSelisihtoPerolehan`, `penambahanMasaManfaat`,"
                     . "                      `AkumulasiPenyusutan`, `PenyusutanPerTahun`, `id_tabel_penyusutan_berjalan`, `keterangan`) values"
                     . "('$Aset_ID','$kodeKelompok','$kodeSatker','$tahun',"
                     . "'$MasaManfaat','$Status_Validasi_Barang','$UmurEkonomis',"
                     . " '$NilaiPerolehan', 'NULL',NULL,NULL,"
                     . " '$AkumulasiPenyusutan','$PenyusutanPerTahun',NULL,NULL)";
        }else{
             //insert
             $query_history="insert into history_penyusutan_berjalan(`Aset_ID`, `kodeKelompok`, `kodeSatker`, `tahunAset`, "
                     . "                     `MasaManfaat`, `Status_Validasi_Barang`, `umurEkonomis`, `nilaiPerolehan_Awal`,"
                     . "                      `nilaiPerolehan_Akhir`, `selisih`, `persentaseSelisihtoPerolehan`, `penambahanMasaManfaat`,"
                     . "                      `AkumulasiPenyusutan`, `PenyusutanPerTahun`, `id_tabel_penyusutan_berjalan`, `keterangan`) values"
                     . "('$Aset_ID','$kodeKelompok','$kodeSatker','$tahun',"
                     . "'$MasaManfaat','$Status_Validasi_Barang','$UmurEkonomis','$NilaiPerolehan_Awal',"
                     . " '$NilaiPerolehan', 'NULL',NULL,NULL,"
                     . " '$AkumulasiPenyusutan','$PenyusutanPerTahun',NULL,NULL)";
                     
        }
        $result_history=$DBVAR->query($query_history) or die($DBVAR->error());

}
echo "Berhasil";
?>
