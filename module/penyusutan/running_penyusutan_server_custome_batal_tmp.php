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

$kib 	= $argv[1];
$tahun 	= $argv[2];
$kodeSatker=$argv[3];
$id=$argv[4];

/*if($tahun == 2014 || $tahun == 2015){
	$newTahun = '2014';
}else{
	$newTahun = $tahun - 1; 
}*/
$newTahun = $tahun - 1; 

$aColumns = array('a.Aset_ID','a.kodeKelompok','k.Uraian','a.Tahun','a.Info','a.NilaiPerolehan','a.noRegister','a.PenyusutanPerTahun','a.AkumulasiPenyusutan','a.TipeAset','a.kodeSatker','a.Status_Validasi_Barang');
$fieldCustom = str_replace(" , ", " ", implode(", ", $aColumns));
$sTable = "aset_tmp as a";
$sTable2 = "aset_tmp2 as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok ="k.Kode = a.kodeKelompok ";
$status = "a.Status_Validasi_Barang = 1 AND";


if($kib == 'B'){
    $queryKib 		= "create temporary table aset_tmp as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
                                            from mesin a where a.TglPerolehan <= '$newTahun-12-31'  and a.kodeSatker='$kodeSatker'";
    $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());
    
    $queryAlter = "ALTER table aset_tmp add primary key(Mesin_ID)";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
    $queryAlter = "Update aset_tmp set TipeAset='B';";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
    $queryLog 		= "replace into aset_tmp (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                 kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                                 AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
                                                 NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
                                                 NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
                                                 select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'B',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                                       a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                       a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                       a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
                                                       if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
                                                 from log_mesin a
                                                 inner join mesin t on t.Aset_ID=a.Aset_ID
                                                 inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                                 where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31' and a.TglPerubahan>'$tahun-12-31'"
            . "              order by a.log_id desc";
         $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());
     
         //untuk table selanjutnya
          $queryKib 		= "create temporary table aset_tmp2 as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
                                            from mesin a where  a.kodeSatker='$kodeSatker' and  a.TglPerolehan <= '$newTahun-12-31' ";
    $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());
    
        $queryAlter = "ALTER table aset_tmp2 add primary key(Mesin_ID)";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
    $queryAlter = "Update aset_tmp2 set TipeAset='B';";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
    $queryLog 		= "replace into aset_tmp2 (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                 kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                                 AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
                                                 NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
                                                 NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
                                                 select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'B',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                                       a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                       a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                       a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
                                                       if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
                                                 from log_mesin a
                                                 inner join mesin t on t.Aset_ID=a.Aset_ID
                                                 inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                                 where (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and  a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31' and a.TglPerubahan>'$tahun-12-31'"
            . "                          order by a.log_id desc";
         $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());
    
    
	$flagKelompok = '02';
	$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";
			
	$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=300000 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$newTahun-12-31'";				   
}elseif($kib == 'C'){
     	$queryKib 		= "create temporary table aset_tmp  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
                                                 from bangunan a
                                                 where  a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31'";
      $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());
      
          $queryAlter = "ALTER table aset_tmp add primary key(Bangunan_ID)";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
    $queryAlter = "Update aset_tmp set TipeAset='C';";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
      
      $queryLog 		= "replace into aset_tmp (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                  kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
                                                  CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
                                                  NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
                                                  KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
                                            select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'C',
                                                  a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                  a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                  a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                  a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
                                                  if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun)  
                                            from log_bangunan a
                                            inner join bangunan t on t.Aset_ID=a.Aset_ID
                                            inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                            where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31' and a.TglPerubahan>'$tahun-12-31' "
              . ""
              . "    order by a.log_id desc";
        
      $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());
      
        //untuk tabel temp selanjutnya
        
        $queryKib 		= "create temporary table aset_tmp2  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
                                                 from bangunan a
                                                 where  a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31'";
      $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());
      
                $queryAlter = "ALTER table aset_tmp2 add primary key(Bangunan_ID)";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
    $queryAlter = "Update aset_tmp2 set TipeAset='C';";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
      
      
      $queryLog 		= "replace into aset_tmp2 (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                  kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
                                                  CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
                                                  NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
                                                  KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
                                            select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'C',
                                                  a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                  a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                  a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                  a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
                                                  if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun)  
                                            from log_bangunan a
                                            inner join bangunan t on t.Aset_ID=a.Aset_ID
                                            inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                            where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31' and a.TglPerubahan>'$tahun-12-31' "
              . "   order by a.log_id desc";
        $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

	$flagKelompok = '03';
	$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";
			
	$AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=10000000 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$newTahun-12-31'";
}elseif($kib == 'D'){
     	$queryKib 		= "create temporary table aset_tmp as
                                           select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
                                                 a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                 a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
                                                 a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
                                                 a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
                                           from jaringan a
                                           where  a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31'";
            $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());
            
                $queryAlter = "ALTER table aset_tmp add primary key(Jaringan_ID)";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    
    $queryAlter = "Update aset_tmp set TipeAset='D';";
    $ExeQuery = $DBVAR->query($queryAlter ) or die($DBVAR->error());
    

      
      $queryLog 		= "replace into aset_tmp (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, TipeAset
                                            kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                            AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
                                            NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
                                            AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
                                      select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 'C',
                                            a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                            a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
                                            a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
                                            if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun)  
                                      from log_jaringan a
                                      inner join jaringan t on t.Aset_ID=a.Aset_ID
                                      inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                      where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker='$kodeSatker' and a.TglPerolehan <= '$newTahun-12-31' and a.TglPerubahan>'$tahun-12-31' "
              . "             order by a.log_id desc";
      $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());
      
	$flagKelompok = '04';
	$AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3'
							AND a.TglPerolehan <= '$newTahun-12-31'";
	$AddCondtn_2 = "";
}
//untuk tanggal perubahan reset log andreas
                                                                      if($tahun == 2014){
                                                                           $plus_tahun=$tahun+1;
                                                                     $TglPerubahan = $plus_tahun."-01"."-01";
                                                                      } 
                                                                     else
                                                                           $TglPerubahan = $tahun."-12"."-31";

$sWhere=" WHERE $status a.AkumulasiPenyusutan IS NOT NULL AND a.PenyusutanPerTahun IS NOT NULL  
			  AND a.kodeSatker='$kodeSatker' AND a.kodeKelompok like '$flagKelompok%'";

if($kib == 'B' || $kib == 'C'){ 				   
$sQuery = "
		SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_1 
		UNION ALL
			SELECT $fieldCustom
			FROM   $sTable2 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_2 ";	
}elseif($kib == 'D'){
$sQuery = "
		SELECT $fieldCustom
			FROM   $sTable 
			INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
			$sWhere
			$AddCondtn_1";
}	
echo "masukk";
// $time_start = microtime_float();
//select Tgl Penyusutan
$ExeQuery = $DBVAR->query($sQuery) or die($DBVAR->error());
while($Data = $DBVAR->fetch_array($ExeQuery)){
		$Aset_ID = $Data['Aset_ID'];
		
		//proses perhitungan penyusutan
		$kodeKelompok=$Data['kodeKelompok'];
        $tmp_kode= explode(".", $kodeKelompok);
		$NilaiPerolehan=$Data['NilaiPerolehan'];
        $Tahun=$Data['Tahun'];
  
		//cek untuk rollback
			//$ceck = $tahun - 2015;
			
			if($tahun == 2014){
			//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
			$QueryAset	  = "UPDATE aset SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTaun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                     TahunPenyusutan=NULL
							WHERE Aset_ID = '$Aset_ID'";
			$ExeQueryAset = $DBVAR->query($QueryAset);
			//untuk log txt
			echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";
			//untuk tanggal perubahan reset log andreas
			$TglPerubahan = $tahun."-01"."-01";

			//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
			if($Data['TipeAset'] == 'B'){
				$tableKib = 'mesin';
				$tableLog = 'log_mesin';
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                   TahunPenyusutan=NULL
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryKib = $DBVAR->query($QueryKib);
				
				//update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                   TahunPenyusutan=NULL
								WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan' ";
				$ExeQueryKib = $DBVAR->query($QueryKib);
				
			}elseif($Data['TipeAset'] == 'C'){
				$tableKib = 'bangunan';
				$tableLog = 'log_bangunan';
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                   TahunPenyusutan=NULL
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryKib = $DBVAR->query($QueryKib);

				//update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                   TahunPenyusutan=NULL
								WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan' ";
				$ExeQueryKib = $DBVAR->query($QueryKib);

				
			}elseif($Data['TipeAset'] == 'D'){
				$tableKib = 'jaringan';
				$tableLog = 'log_jaringan';
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                   TahunPenyusutan=NULL
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryKib = $DBVAR->query($QueryKib);


				//update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
				$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                   TahunPenyusutan=NULL
								WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan' ";
				$ExeQueryKib = $DBVAR->query($QueryKib);

			}

		
			$action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
			
			//insert log
			// $QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat = '50' and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}' and YEAR(TglPerubahan) = {$tahun}";
			$QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat  IN ('49','50') and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}'";
			$exeQueryLog = $DBVAR->query($QueryLog);
                  
                  //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
						$QueryKib	  = "UPDATE $tableLog SET MasaManfaat = NULL,
											 AkumulasiPenyusutan = NULL,	
											 PenyusutanPerTahun = NULL,
											 NilaiBuku = NULL,
											 UmurEkonomis = NULL,
                                                                   TahunPenyusutan=NULL
										WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan' ";
						$ExeQueryKib = $DBVAR->query($QueryKib);
		}elseif($tahun >= 2015){
				$QueryLogSelect = "select PenyusutanPerTahun_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,MasaManfaat,UmurEkonomis from $tableLog where Aset_ID = {$Aset_ID} order by log_id desc limit 1";
				$exeQueryLogSelect = $DBVAR->query($QueryLogSelect);
				$resultQueryLogSelect = $DBVAR->fetch_array($exeQueryLogSelect);
			
				$AkumulasiPenyusutan_Awal = $resultQueryLogSelect['AkumulasiPenyusutan_Awal'];
				$NilaiBuku_Awal = $resultQueryLogSelect['NilaiBuku_Awal'];
				$PenyusutanPerTahun_Awal = $resultQueryLogSelect['PenyusutanPerTahun_Awal'];
				$MasaManfaat_Awal = $resultQueryLogSelect['MasaManfaat'];
				$UmurEkonomis = $resultQueryLogSelect['UmurEkonomis'];
				
				//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
				$QueryAset	  = "UPDATE aset SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTaun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
								WHERE Aset_ID = '$Aset_ID'";
				$ExeQueryAset = $DBVAR->query($QueryAset);
				
				//update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
				if($Data['TipeAset'] == 'B'){
					$tableKib = 'mesin';
					$tableLog = 'log_mesin';
					$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTahun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
									WHERE Aset_ID = '{$Aset_ID}'";
					$ExeQueryKib = $DBVAR->query($QueryKib);
					
				}elseif($Data['TipeAset'] == 'C'){
					$tableKib = 'bangunan';
					$tableLog = 'log_bangunan';
					$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTahun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
									WHERE Aset_ID = '{$Aset_ID}'";
					$ExeQueryKib = $DBVAR->query($QueryKib);
					
				}elseif($Data['TipeAset'] == 'D'){
					$tableKib = 'jaringan';
					$tableLog = 'log_jaringan';
					$QueryKib	  = "UPDATE $tableKib SET MasaManfaat = '{$MasaManfaat_Awal}',
												 AkumulasiPenyusutan = '{$AkumulasiPenyusutan_Awal}',	
												 PenyusutanPerTahun = '{$PenyusutanPerTahun_Awal}',
												 NilaiBuku = '{$NilaiBuku_Awal}',
												 UmurEkonomis = '{$UmurEkonomis}'
									WHERE Aset_ID = '{$Aset_ID}'";
					$ExeQueryKib = $DBVAR->query($QueryKib);
				}
				$action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
				// $QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat = '50' and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}' and YEAR(TglPerubahan) = {$tahun}";
				$QueryLog ="DELETE FROM $tableLog WHERE  Aset_ID = '{$Aset_ID}' and Kd_Riwayat = '50' and kodeSatker = '{$Data[kodeSatker]}' and action ='{$action}' ";
				$exeQueryLog = $DBVAR->query($QueryLog);
		
			}
		
		
		}
		
	
		// exit;
	
	 
    //update table status untuk penyusutan
     $query="update penyusutan_tahun  set StatusRunning=0 where id=$id";
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
