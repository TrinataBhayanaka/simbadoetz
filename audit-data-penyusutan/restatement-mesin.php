<?php
error_reporting (0);
include "../config/config.php";

$myfile = fopen ("restatement/data/mesin.txt", "r") or die("Unable to open file!");
$aset_id_cek = fread ($myfile, filesize ("restatement/data/mesin.txt"));
fclose ($myfile);
$log_table="log_mesin";
$query_data = "SELECT aset_id,log_id,NilaiPerolehan,AkumulasiPenyusutan,NilaiBuku,MasaManfaat,UmurEkonomis,Tahun,
				PenyusutanPerTahun
					 FROM $log_table WHERE kd_riwayat=50 AND 
                tglperubahan='2016-12-31' and aset_id in ($aset_id_cek)  ";


$result = $DBVAR->query ($query_data) or die($DBVAR->error ());
$i=1;
while ($row = $DBVAR->fetch_array ($result)) {
	
	$log_id=$row['log_id'];
	$aset_id=$row['aset_id'];
	$NilaiPerolehan=$row['NilaiPerolehan'];
	$AkumulasiPenyusutan=$row['AkumulasiPenyusutan'];
	$AkumulasiPenyusutan_log=$row['AkumulasiPenyusutan'];
	$NilaiBuku=$row['NilaiBuku'];
	$MasaManfaat=$row['MasaManfaat'];
	$UmurEkonomis=$row['UmurEkonomis'];
	$Tahun=$row['Tahun'];
	$PenyusutanPerTahun=$row['PenyusutanPerTahun'];

	$UmurEkonomis_final=$UmurEkonomis-1;
	if($UmurEkonomis_final<=0){
		$AkumulasiPenyusutan_final=$NilaiPerolehan;
		$NilaiBuku_hasil=0;
		$UmurEkonomis_final=0;
	}else{
		$AkumulasiPenyusutan_final=$AkumulasiPenyusutan+$PenyusutanPerTahun;
		$NilaiBuku_hasil=$NilaiPerolehan-$AkumulasiPenyusutan_final;
	}

	$status="/*$i Aset_ID=$aset_id*/\n";
	/*$delete="delete from $log_table where kd_riwayat=50 AND 
                tglperubahan='2016-12-31' and aset_id='$aset_id';\n";*/

	$insert="INSERT INTO `$log_table`(`log_id`, `Mesin_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`,
	 `noRegister`, `TglPerolehan`, `TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, 
	 `Status_Validasi_Barang`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, 
	 `kondisi`, `CaraPerolehan`, `Merk`, `Model`, `Ukuran`, `Silinder`, `MerkMesin`, 
	 `JumlahMesin`, `Material`, `NoSeri`, `NoRangka`, `NoMesin`, `NoSTNK`, `TglSTNK`, `NoBPKB`,
	  `TglBPKB`, `NoDokumen`, `TglDokumen`, `Pabrik`, `TahunBuat`, `BahanBakar`, `NegaraAsal`,
	   `NegaraRakit`, `Kapasitas`, `Bobot`, `GUID`, `changeDate`, `action`, `operator`,
	    `TglPerubahan`, `NilaiPerolehan_Awal`, `Kd_Riwayat`, `No_Dokumen`, `StatusTampil`,
	     `MasaManfaat`, `AkumulasiPenyusutan`, `NilaiBuku`, `PenyusutanPerTahun`,
	      `AkumulasiPenyusutan_Awal`, `NilaiBuku_Awal`, `PenyusutanPerTahun_Awal`, 
	      `Aset_ID_Penambahan`, `UmurEkonomis`, `TahunPenyusutan`, `nilai_kapitalisasi`, 
	      `prosentase`, `penambahan_masa_manfaat`, `mutasi_ak_tambah`, `mutasi_ak_kurang`, 
	      `jenis_belanja`, `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`, `jenis_hapus`)
		    select NULL, `Mesin_ID`, `Aset_ID`, `kodeKelompok`, `kodeSatker`, `kodeLokasi`,
	 `noRegister`, `TglPerolehan`, `TglPembukuan`, `kodeData`, `kodeKA`, `kodeRuangan`, `StatusValidasi`, 
	 `Status_Validasi_Barang`, `Tahun`, `NilaiPerolehan`, `Alamat`, `Info`, `AsalUsul`, 
	 `kondisi`, `CaraPerolehan`, `Merk`, `Model`, `Ukuran`, `Silinder`, `MerkMesin`, 
	 `JumlahMesin`, `Material`, `NoSeri`, `NoRangka`, `NoMesin`, `NoSTNK`, `TglSTNK`, `NoBPKB`,
	  `TglBPKB`, `NoDokumen`, `TglDokumen`, `Pabrik`, `TahunBuat`, `BahanBakar`, `NegaraAsal`,
	   `NegaraRakit`, `Kapasitas`, `Bobot`, `GUID`, `changeDate`, `action`, `operator`,
	    '2016-12-31', `NilaiPerolehan_Awal`, '50', `No_Dokumen`, `StatusTampil`,
	     `MasaManfaat`, '$AkumulasiPenyusutan_final', '$NilaiBuku_hasil', `PenyusutanPerTahun`,
	      '$AkumulasiPenyusutan_log', `NilaiBuku_Awal`, `PenyusutanPerTahun_Awal`, 
	      `Aset_ID_Penambahan`, '$UmurEkonomis_final', '2016', `nilai_kapitalisasi`, 
	      `prosentase`, `penambahan_masa_manfaat`, `mutasi_ak_tambah`, `mutasi_ak_kurang`, 
	      `jenis_belanja`, `kodeKelompokReklasAsal`, `kodeKelompokReklasTujuan`, `jenis_hapus` from $log_table 
		     where log_id='$log_id'; ";

	  $main_table="

    update aset set NilaiBuku='$NilaiBuku_hasil',PenyusutanPerTaun='$PenyusutanPerTahun',
    			AkumulasiPenyusutan='$AkumulasiPenyusutan_final',UmurEkonomis='$UmurEkonomis_final',
    			MasaManfaat='$MasaManfaat' where aset_id='$aset_id';\n

    			update mesin set NilaiBuku='$NilaiBuku_hasil',PenyusutanPerTahun='$PenyusutanPerTahun',
    			AkumulasiPenyusutan='$AkumulasiPenyusutan_final',UmurEkonomis='$UmurEkonomis_final',
    			MasaManfaat='$MasaManfaat' where aset_id='$aset_id';\n	";

	$data="$status $delete $insert $main_table\n ";
	logfile($data,"restatement-mesin.txt");

	$i++;




}

?> 
