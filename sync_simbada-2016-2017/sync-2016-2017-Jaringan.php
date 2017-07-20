<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 7/20/17
 * Time: 9:34 PM
 */

error_reporting (0);
include "../config/config.php";
include "name.php";

/**
 * Sinkronisasi Aset untuk Jaringan
 */
$query="select Aset_ID,NilaiBuku,AkumulasiPenyusutan,PenyusutanPerTaun,MasaManfaat,UmurEkonomis,TahunPenyusutan
          from $db_auditied_2016.aset where kodeKelompok like '04%'
            and (TglPerolehan!='0000-00-00' or TglPerolehan is not NULL)
          and (TglPembukuan!='0000-00-00' and TglPembukuan is not NULL)
          ";
$result=mysql_query($query) or die(mysql_error());

echo "-- Aset untuk Jaringan (04)\n";
$no=0;
while($row=mysql_fetch_array($result)){
    $Aset_ID=$row['Aset_ID'];
    $NilaBuku=$row['NilaiBuku'];
    $AkumulasiPenyusutan=$row['AkumulasiPenyusutan'];
    $PenyusutanPerTahun=$row['PenyusutanPerTaun'];
    $MasaManfaat=$row['MasaManfaat'];
    $UmurEkonomis=$row['UmurEkonomis'];
    $TahunPenyusutan=$row['TahunPenyusutan'];

    //echo "$Aset_ID==$NilaBuku==$AkumulasiPenyusutan==$PenyusutanPerTahun==$MasaManfaat==$UmurEkonomis==$TahunPenyusutan <br/>";

    $query="update aset set  NilaiBuku='$NilaBuku', AkumulasiPenyusutan='$AkumulasiPenyusutan',
            PenyusutanPerTaun='$PenyusutanPerTahun',MasaManfaat='$MasaManfaat',
            UmurEkonomis='$UmurEkonomis',TahunPenyusutan='$TahunPenyusutan' where Aset_ID='$Aset_ID'; ";
    $no++;
    echo "$query\n";
}
echo "-- Akhir Aset untuk Jaringan (03)==TOTAL==$no\n\n";
/**
 * Akhir Sinkronisasi Aset untuk Jaringan
 */

/**
 * Sync untuk Jaringan
 */
$query="select Aset_ID,NilaiBuku,AkumulasiPenyusutan,PenyusutanPerTahun,MasaManfaat,UmurEkonomis,TahunPenyusutan,kondisi,status_validasi_barang
          from $db_auditied_2016.jaringan where kodeKelompok like '04%' and (TglPerolehan!='0000-00-00' and TglPerolehan is not NULL)
          and (TglPembukuan!='0000-00-00' and TglPembukuan is not NULL) 
          ";
$result=mysql_query($query) or die(mysql_error());
echo "-- JARINGAN(04)\n\n";
$no=0;
while($row=mysql_fetch_array($result)){
    $Aset_ID=$row['Aset_ID'];
    $NilaBuku=$row['NilaiBuku'];
    $AkumulasiPenyusutan=$row['AkumulasiPenyusutan'];
    $PenyusutanPerTahun=$row['PenyusutanPerTahun'];
    $MasaManfaat=$row['MasaManfaat'];
    $UmurEkonomis=$row['UmurEkonomis'];
    $TahunPenyusutan=$row['TahunPenyusutan'];
    $kondisi=$row['kondisi'];

    //echo "$Aset_ID==$NilaBuku==$AkumulasiPenyusutan==$PenyusutanPerTahun==$MasaManfaat==$UmurEkonomis==$TahunPenyusutan==$kondisi <br/>";

    $query="update jaringan set  NilaiBuku='$NilaBuku', AkumulasiPenyusutan='$AkumulasiPenyusutan',
            PenyusutanPerTahun='$PenyusutanPerTahun',MasaManfaat='$MasaManfaat',
            UmurEkonomis='$UmurEkonomis',TahunPenyusutan='$TahunPenyusutan' where Aset_ID='$Aset_ID'; ";
    $no++;
    echo "$query\n";
}
echo "-- AKHIR JARINGAN(04)==TOTAL=$no\n\n";
/**
 * Akhir Sync untuk Jaringan
 */


?>