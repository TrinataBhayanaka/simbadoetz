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
$kib=$argv[1];
$id_table_status=$argv[2];
$time_start = microtime_float();

    $tableAset=array("B"=>"mesin",
                                   "C"=>"bangunan",
                                   "D"=>"jaringan",
                                   "E"=>"asetlain");
    
    $query="select Aset_ID ,kodeKelompok,NilaiPerolehan,Tahun from $tableAset[$kib] order by Aset_Id asc ";
    $result=$DBVAR->query($query) or die($DBVAR->error());
   /* echo "<table>";
    echo "<thead>
                    <tr>
                         <td>No</td>
                         <td>Kode Kelompok</td>
                         <td>Tahun Perolehan</td>
                         <td>Nilai Perolehan</td>
                         <td>Masa Manfaat</td>
                         <td>Penyusutan Per Tahun</td>
                         <td>Akumulasi Penyusutan</td>
                         <td>Nilai Buku</td>
                    </tr>
                 </thead> \n
               ";*/
    $no=1;
    while($row=$DBVAR->fetch_object($result)){
         $kodeKelompok=$row->kodeKelompok;
         $tmp_kode=  explode(".", $kodeKelompok);
         $NilaiPerolehan=$row->NilaiPerolehan;
         $Tahun=$row->Tahun;
         $Aset_ID=$row->Aset_ID;
         $masa_manfaat=  cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[3], $DBVAR);
         if ($masa_manfaat!=""){
                    $penyusutan_per_tahun=round($NilaiPerolehan/$masa_manfaat)  ;
                    $Tahun_Aktif=date("Y");
                   $rentang_tahun_penyusutan=$Tahun_Aktif-$Tahun;
                   if($rentang_tahun_penyusutan>=$masa_manfaat){
                        $AkumulasiPenyusutan=$masa_manfaat*$penyusutan_per_tahun;
                        $AkumulasiPenyusutan=$NilaiPerolehan;
                   }else
                        $AkumulasiPenyusutan=$rentang_tahun_penyusutan*$penyusutan_per_tahun;
                   $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
                     echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";
                     $query="update $tableAset[$kib]  set  MasaManfaat=$masa_manfaat,
                                             AkumulasiPenyusutan=$AkumulasiPenyusutan,
                                                  NilaiBuku=$NilaiBuku,
                                                   PenyusutanPerTahun=$penyusutan_per_tahun
                         where Aset_ID='$Aset_ID'";
                     $DBVAR->query($query) or die($DBVAR->error());
         }
            /* echo "<tbody>
                    <tr>
                         <td>$no</td>
                         <td>$kodeKelompok</td>
                         <td>$Tahun</td>
                         <td>$NilaiPerolehan</td>
                         <td>$masa_manfaat</td>
                         <td>$penyusutan_per_tahun</td>
                         <td>$AkumulasiPenyusutan</td>
                         <td>$NilaiBuku</td>
                    </tr>
                 </tbody> \n
               ";*/
       
             $no++;
    }
    echo "</table>\n";
    
    $time_end = microtime_float();
    $time = $time_end - $time_start;
    echo "Waktu proses: $time seconds ";
    
    //update table status untuk penyusutan
     $query="update  penyusutan_tahun_pertama  set StatusRunning=2 where id=$id_table_status";
     $DBVAR->query($query) or die($DBVAR->error());
    
    
    function cek_masamanfaat($kd_aset1,$kd_aset2,$kd_aset3,$DBVAR){
         $query="select * from ref_masamanfaat where kd_aset1='$kd_aset1' "
                 . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
            $result=$DBVAR->query($query) or die($DBVAR->error());
          while($row=$DBVAR->fetch_object($result)){
               $masa_manfaat=$row->masa_manfaat;
          }
          return $masa_manfaat;
    }
    function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
    
?>
