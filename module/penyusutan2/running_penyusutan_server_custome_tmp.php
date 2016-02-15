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

$kib = $argv[1];
$tahun = $argv[2];
$kodeSatker = $argv[3];
$id = $argv[4];

/* if($tahun == 2014 || $tahun == 2015){
  $newTahun = '2014';
  }else{
  $newTahun = $tahun - 1;
  } */

$newTahun = $tahun;
// $newTahun = $tahun - 1; 
$aColumns = array('a.Aset_ID', 'a.kodeKelompok', 'k.Uraian', 'a.Tahun', 'a.Info', 'a.NilaiPerolehan', 'a.noRegister', 'a.PenyusutanPerTahun', 'a.AkumulasiPenyusutan', 'a.TipeAset', 'a.kodeSatker', 'a.Status_Validasi_Barang','a.MasaManfaat');
$fieldCustom = str_replace(" , ", " ", implode(", ", $aColumns));
$sTable = "aset_tmp as a";
$sTable2 = "aset_tmp2 as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok = "k.Kode = a.kodeKelompok ";
$status = "a.Status_Validasi_Barang = 1 AND";


$TglPerubahan_awal = $tahun . "-01" . "-01";
$TglPerubahan_temp = $tahun . "-12" . "-31";
if ($kib == 'B') {
    $queryKib = "create temporary table aset_tmp as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan
                                            from mesin a where a.TglPerolehan <= '$TglPerubahan_temp'  and a.kodeSatker like '$kodeSatker%'";
    $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());

    $queryAlter = "ALTER table aset_tmp add primary key(Mesin_ID)";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());

    $queryAlter = "Update aset_tmp set TipeAset='B';";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());

    $queryLog = "replace into aset_tmp (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                 kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                                 AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
                                                 NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
                                                 NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                                 select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'B',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                                       a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                       a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                       a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
                                                       if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), 
                                                       if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), 
                                                       if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan
                                                 from log_mesin a
                                                 inner join mesin t on t.Aset_ID=a.Aset_ID
                                                 inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                                 where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp'"
            . "              order by a.log_id desc";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    $queryLog = "replace into aset_tmp (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
              TglPembukuan, kodeData, kodeKA,TipeAset, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
              NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, 
              MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, 
              NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, 
              Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
      select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),
              lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
              a.kodeData, a.kodeKA, 'B',a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
              a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, 
              a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, 
a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen,
a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan from 
view_mutasi_mesin a inner join mesin t 
on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID 
and t.Aset_ID is not null and t.Aset_ID != 0
 where a.TglPerolehan <='$TglPerubahan_temp' AND a.TglSKKDH >'$TglPerubahan_temp' AND "
            . "a.TglPembukuan <='$TglPerubahan_temp' AND a.SatkerTujuan like '$kodeSatker%' "
            . "order by a.TglSKKDH desc;";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    //untuk table selanjutnya
    $queryKib = "create temporary table aset_tmp2 as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis ,a.TahunPenyusutan
                                            from mesin a where  a.kodeSatker like '$kodeSatker%' and  a.TglPerolehan <= '$TglPerubahan_temp' ";
    $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());

    $queryAlter = "ALTER table aset_tmp2 add primary key(Mesin_ID)";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());

    $queryAlter = "Update aset_tmp2 set TipeAset='B';";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());

    $queryLog = "replace into aset_tmp2 (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                 kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                                 AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
                                                 NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
                                                 NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                                 select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'B',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                                       a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                       a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
                                                       a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
                                                       if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), 
                                                       if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan 
                                                 from log_mesin a
                                                 inner join mesin t on t.Aset_ID=a.Aset_ID
                                                 inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                                 where (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp'"
            . "                          order by a.log_id desc";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    $queryLog = "replace into aset_tmp (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
              TglPembukuan, kodeData, kodeKA,TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
              NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, 
              MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, 
              NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, 
              Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
      select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),
              lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
              a.kodeData, a.kodeKA, 'B',a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
              a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, 
              a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, 
a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen,
a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan from 
view_mutasi_mesin a inner join mesin t 
on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID 
and t.Aset_ID is not null and t.Aset_ID != 0
 where a.TglPerolehan <='$TglPerubahan_temp' AND a.TglSKKDH >'$TglPerubahan_temp' AND "
            . "a.TglPembukuan <='$TglPerubahan_temp' AND a.SatkerTujuan like '$kodeSatker%' "
            . "order by a.TglSKKDH desc;";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    $flagKelompok = '02';
    $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";

    $AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=0 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$TglPerubahan_temp'";
} elseif ($kib == 'C') {
    $queryKib = "create temporary table aset_tmp  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan
                                                 from bangunan a
                                                 where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
    $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());

    $queryAlter = "ALTER table aset_tmp add primary key(Bangunan_ID)";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());

    $queryAlter = "Update aset_tmp set TipeAset='C';";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());


    $queryLog = "replace into aset_tmp (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                  kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
                                                  CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
                                                  NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
                                                  KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                            select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'C',
                                                  a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                  a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                  a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                  a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
                                                  if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan  
                                            from log_bangunan a
                                            inner join bangunan t on t.Aset_ID=a.Aset_ID
                                            inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                            where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp' "
            . ""
            . "    order by a.log_id desc";

    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    $queryLog = "replace into aset_tmp (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
           TglPembukuan, kodeData, kodeKA, TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat,
           Info, AsalUsul, kondisi, CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, 
           Lantai, LangitLangit, Atap, NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, 
           Tmp_Tingkat, Tmp_Beton, Tmp_Luas, KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, 
           AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
        select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, 
           a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
           a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA,'C', a.kodeRuangan,
           a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan,
           a.TglPakai, a.Konstruksi, a.Beton, a.
JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, a.NoSurat, 
a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, 
a.Tmp_Beton, a.Tmp_Luas, a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, 
a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis ,t.TahunPenyusutan
from view_mutasi_bangunan a inner join bangunan t on t.Aset_ID=a.Aset_ID 
inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 
where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$TglPerubahan_temp' AND a.TglPembukuan <='$TglPerubahan_temp' "
            . "AND a.SatkerTujuan like '$kodeSatker%' order by a.TglSKKDH desc";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());
    //untuk tabel temp selanjutnya

    $queryKib = "create temporary table aset_tmp2  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis  ,a.TahunPenyusutan
                                                 from bangunan a
                                                 where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
    $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());

    $queryAlter = "ALTER table aset_tmp2 add primary key(Bangunan_ID)";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());

    $queryAlter = "Update aset_tmp2 set TipeAset='C';";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());


    $queryLog = "replace into aset_tmp2 (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, TipeAset,
                                                  kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
                                                  CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
                                                  NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
                                                  KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                            select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'C',
                                                  a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
                                                  a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
                                                  a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
                                                  a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
                                                  if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis  ,a.TahunPenyusutan
                                            from log_bangunan a
                                            inner join bangunan t on t.Aset_ID=a.Aset_ID
                                            inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                            where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp' "
            . "   order by a.log_id desc";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    $queryLog = "replace into aset_tmp (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
           TglPembukuan, kodeData, kodeKA, TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat,
           Info, AsalUsul, kondisi, CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, 
           Lantai, LangitLangit, Atap, NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, 
           Tmp_Tingkat, Tmp_Beton, Tmp_Luas, KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, 
           AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
        select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, 
           a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
           a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA,'C', a.kodeRuangan,
           a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan,
           a.TglPakai, a.Konstruksi, a.Beton, a.
JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, a.NoSurat, 
a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, 
a.Tmp_Beton, a.Tmp_Luas, a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, 
a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis ,t.TahunPenyusutan
from view_mutasi_bangunan a inner join bangunan t on t.Aset_ID=a.Aset_ID 
inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 
where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$TglPerubahan_temp' AND a.TglPembukuan <='$TglPerubahan_temp' "
            . "AND a.SatkerTujuan like '$kodeSatker%' order by a.TglSKKDH desc";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    $flagKelompok = '03';
    $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
					AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";

    $AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=0 OR kodeKA = '1') 
					AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$TglPerubahan_temp'";
} elseif ($kib == 'D') {
    $queryKib = "create temporary table aset_tmp as
                                           select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData,  'TipeAset',
                                                 a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
                                                 a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
                                                 a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
                                                 a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan  
                                           from jaringan a
                                           where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
    $ExeQuery = $DBVAR->query($queryKib) or die($DBVAR->error());

    $queryAlter = "ALTER table aset_tmp add primary key(Jaringan_ID)";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());

    $queryAlter = "Update aset_tmp set TipeAset='D';";
    $ExeQuery = $DBVAR->query($queryAlter) or die($DBVAR->error());



    $queryLog = "replace into aset_tmp (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, TipeAset,
                                            kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
                                            AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
                                            NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
                                            AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
                                      select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 'D',
                                            a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
                                            a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
                                            a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
                                            if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan
                                      from log_jaringan a
                                      inner join jaringan t on t.Aset_ID=a.Aset_ID
                                      inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
                                      where  (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  and a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp' and a.TglPerubahan>'$TglPerubahan_temp' "
            . "             order by a.log_id desc";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());


    $queryLog = "replace into aset_tmp (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
           TglPembukuan, kodeData, kodeKA, TipeAset,kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
           NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen,
           TglDokumen, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, 
           LuasJaringan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan) 
           select a.Jaringan_ID, a.Aset_ID, 
           a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',
           right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'D',
           a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
           a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, 
           a.TglDokumen, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, 
a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, 
a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan from view_mutasi_jaringan a 
inner join jaringan t on t.Aset_ID=a.Aset_ID 
inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 
where a.TglPerolehan <='$TglPerubahan_temp' AND a.TglSKKDH >'$TglPerubahan_temp' AND "
            . "a.TglPembukuan <='$TglPerubahan_temp' AND a.SatkerTujuan like '$kodeSatker%' order by a.TglSKKDH desc";
    $ExeQuery = $DBVAR->query($queryLog) or die($DBVAR->error());

    $flagKelompok = '04';
    $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3'
							AND a.TglPerolehan <= '$TglPerubahan_temp'";
    $AddCondtn_2 = "";
}


for($i=0;$i<2;$i++){
    switch ($i) {
        case 0:
            //kondisi untuk barang yang belum pernah penyusutan
            $sWhere=" WHERE $status 
                ((a.AkumulasiPenyusutan IS NULL AND a.PenyusutanPerTahun IS NULL) or (a.AkumulasiPenyusutan =0 AND a.PenyusutanPerTahun =0) )

                                      AND a.kodeSatker like '$kodeSatker%' AND a.kodeKelompok like '$flagKelompok%' ";
            break;

        case 1:
            $thn_sblm=$newTahun-1;
            $sWhere=" WHERE $status a.AkumulasiPenyusutan IS NOT NULL AND a.PenyusutanPerTahun IS NOT NULL  
			  AND a.kodeSatker like '$kodeSatker%' AND a.kodeKelompok like '$flagKelompok%' and a.TahunPenyusutan='$thn_sblm' ";
            break;
    }

    if ($kib == 'B' || $kib == 'C') {
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
    } elseif ($kib == 'D') {
        $sQuery = "
                    SELECT $fieldCustom
                            FROM   $sTable 
                            INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
                            $sWhere
                            $AddCondtn_1";
    }
    
    
    $ExeQuery = $DBVAR->query($sQuery) or die($DBVAR->error());
    //echo "$i === $sQuery\n";
    if($i==0){
        echo "Penyusutan tahun berjalan untuk tahun $newTahun $kodeSatker dengan kondisi penyusutan pertama kali \n"
         . "Aset_ID \t kodeKelompok  \t NilaiPerolehan \t Tahun \t masa_manfaat \t AkumulasiPenyusutan \t NilaiBuku  \t penyusutan_per_tahun \n";

        while ($Data = $DBVAR->fetch_array($ExeQuery)) {
            $Aset_ID = $Data['Aset_ID'];

            //proses perhitungan penyusutan
            $kodeKelompok = $Data['kodeKelompok'];
            $tmp_kode = explode(".", $kodeKelompok);
            $NilaiPerolehan = $Data['NilaiPerolehan'];
            $Tahun = $Data['Tahun'];
            $masa_manfaat = cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2], $DBVAR);

            if ($masa_manfaat != "") {
                $penyusutan_per_tahun = round($NilaiPerolehan / $masa_manfaat);
                $Tahun_Aktif = $tahun;
                // $Tahun_Aktif= $tahun - 1;
                $rentang_tahun_penyusutan = ($Tahun_Aktif - $Tahun) + 1;
                if ($rentang_tahun_penyusutan >= $masa_manfaat) {
                    $AkumulasiPenyusutan = $NilaiPerolehan;
                    $NilaiBuku = 0;
                    $UmurEkonomis = 0;
                } else {
                    $AkumulasiPenyusutan = $rentang_tahun_penyusutan * $penyusutan_per_tahun;
                    $NilaiBuku = $NilaiPerolehan - $AkumulasiPenyusutan;
                    $UmurEkonomis = $masa_manfaat - $rentang_tahun_penyusutan;
                }

                //update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat
                $QueryAset = "UPDATE aset SET MasaManfaat = '$masa_manfaat' ,
                                                                                                                 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                                                                                                 PenyusutanPerTaun = '$penyusutan_per_tahun',
                                                                                                                 NilaiBuku = '$NilaiBuku',
                                                                                                                 UmurEkonomis = '$UmurEkonomis',
                                                                                                                                                                                       TahunPenyusutan='$tahun'

                                                                                WHERE Aset_ID = '$Aset_ID'";
                $ExeQueryAset = $DBVAR->query($QueryAset);
                //untuk log txt
                echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $masa_manfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $penyusutan_per_tahun \n";

                //update AkumulasiPenyusutan,penyusutan_per_tahun,MasaManfaat,NilaiBuku
                //select field dan value tabel kib
                if ($Data['TipeAset'] == 'B') {
                    $tableKib = 'mesin';
                    $tableLog = 'log_mesin';
                } elseif ($Data['TipeAset'] == 'C') {
                    $tableKib = 'bangunan';
                    $tableLog = 'log_bangunan';
                } elseif ($Data['TipeAset'] == 'D') {
                    $tableKib = 'jaringan';
                    $tableLog = 'log_jaringan';
                }
                $QueryKibSelect = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
                $exequeryKibSelect = $DBVAR->query($QueryKibSelect);
                $resultqueryKibSelect = $DBVAR->fetch_object($exequeryKibSelect);

                $tmpField = array();
                $tmpVal = array();
                $sign = "'";
                foreach ($resultqueryKibSelect as $key => $val) {
                    $tmpField[] = $key;
                    if ($val == '') {
                        $tmpVal[] = $sign . "NULL" . $sign;
                    } else {
                        $tmpVal[] = $sign . addslashes($val) . $sign;
                    }
                }

                $implodeField__lama = implode(',', $tmpField);
                $implodeVal_lama = implode(',', $tmpVal);


                if ($Data['TipeAset'] == 'B') {
                    $tableKib = 'mesin';
                    $tableLog = 'log_mesin';
                    $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
                                                                                                                 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                                                                                                 PenyusutanPerTahun = '$penyusutan_per_tahun',
                                                                                                                 NilaiBuku = '$NilaiBuku',
                                                                                                                 UmurEkonomis = '$UmurEkonomis',
                                                                                              TahunPenyusutan='$tahun'
                                                                                        WHERE Aset_ID = '$Aset_ID'";
                    $ExeQueryKib = $DBVAR->query($QueryKib);

                    //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                    $QueryKib = "UPDATE $tableLog SET MasaManfaat = '$masa_manfaat' ,
                                                                                                                 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                                                                                                 PenyusutanPerTahun = '$penyusutan_per_tahun',
                                                                                                                 NilaiBuku = '$NilaiBuku',
                                                                                                                 UmurEkonomis = '$UmurEkonomis',
                                                                                              TahunPenyusutan='$tahun'
                                                                                        WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan' ";
                    $ExeQueryKib = $DBVAR->query($QueryKib);
                } elseif ($Data['TipeAset'] == 'C') {
                    $tableKib = 'bangunan';
                    $tableLog = 'log_bangunan';
                    $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
                                                                                                                 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                                                                                                 PenyusutanPerTahun = '$penyusutan_per_tahun',
                                                                                                                 NilaiBuku = '$NilaiBuku',
                                                                                                                 UmurEkonomis = '$UmurEkonomis',
                                                                                              TahunPenyusutan='$tahun'
                                                                                        WHERE Aset_ID = '$Aset_ID'";
                    $ExeQueryKib = $DBVAR->query($QueryKib);

                    //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                    $QueryKib = "UPDATE $tableLog SET MasaManfaat = '$masa_manfaat' ,
                                                                                                                 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                                                                                                 PenyusutanPerTahun = '$penyusutan_per_tahun',
                                                                                                                 NilaiBuku = '$NilaiBuku',
                                                                                                                 UmurEkonomis = '$UmurEkonomis'
                                                                                        WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan' ";
                    $ExeQueryKib = $DBVAR->query($QueryKib);
                } elseif ($Data['TipeAset'] == 'D') {
                    $tableKib = 'jaringan';
                    $tableLog = 'log_jaringan';
                    $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$masa_manfaat' ,
                                                                                                                 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                                                                                                 PenyusutanPerTahun = '$penyusutan_per_tahun',
                                                                                                                 NilaiBuku = '$NilaiBuku',
                                                                                                                 UmurEkonomis = '$UmurEkonomis',
                                                                                              TahunPenyusutan='$tahun'
                                                                                        WHERE Aset_ID = '$Aset_ID'";
                    $ExeQueryKib = $DBVAR->query($QueryKib);

                    //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                    $QueryKib = "UPDATE $tableLog SET MasaManfaat = '$masa_manfaat' ,
                                                                                                                 AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                                                                                                 PenyusutanPerTahun = '$penyusutan_per_tahun',
                                                                                                                 NilaiBuku = '$NilaiBuku',
                                                                                                                 UmurEkonomis = '$UmurEkonomis',
                                                                                              TahunPenyusutan='$tahun'
                                                                                        WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan' ";
                    $ExeQueryKib = $DBVAR->query($QueryKib);
                }


                //select field dan value tabel kib
                $QueryKibSelect = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
                $exequeryKibSelect = $DBVAR->query($QueryKibSelect);
                $resultqueryKibSelect = $DBVAR->fetch_object($exequeryKibSelect);

                $tmpField = array();
                $tmpVal = array();
                $sign = "'";
                foreach ($resultqueryKibSelect as $key => $val) {
                    $tmpField[] = $key;
                    if ($val == '') {
                        $tmpVal[] = $sign . "NULL" . $sign;
                    } else {
                        $tmpVal[] = $sign . addslashes($val) . $sign;
                    }
                }

                $implodeField = implode(',', $tmpField);
                $implodeVal = implode(',', $tmpVal);
                if ($tahun == 2014) {
                    $AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,Kd_Riwayat";
                    $action = "Penyusutan_" . $tahun . "_" . $Data['kodeSatker'];
                    $changeDate = date('Y-m-d');
                    $NilaiPerolehan_Awal = $resultqueryKibSelect->NilaiPerolehan;

                    $Kd_Riwayat = '49';
                    //insert log
                    $QueryLog = "INSERT INTO $tableLog ($implodeField__lama,$AddField) VALUES ($implodeVal_lama,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$Kd_Riwayat')";
                    // pr($QueryLog);
                    // exit;
                    $exeQueryLog = $DBVAR->query($QueryLog);

                    $Kd_Riwayat = '50';
                    //insert log
                    $QueryLog = "INSERT INTO $tableLog ($implodeField,$AddField) VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$Kd_Riwayat')";
                    // pr($QueryLog);
                    // exit;
                    $exeQueryLog = $DBVAR->query($QueryLog);
                } elseif ($tahun >= 2015) {
                    $AddField = "action,changeDate,TglPerubahan,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal,Kd_Riwayat";
                    $action = "Penyusutan_" . $tahun . "_" . $Data['kodeSatker'];
                    $changeDate = date('Y-m-d');

                    $NilaiPerolehan_Awal = $resultqueryKibSelect->NilaiPerolehan;

                    $ceck = $tahun - 2015;
                    if ($ceck < 1) {
                        $QueryLogSelect = "select PenyusutanPerTahun,AkumulasiPenyusutan,NilaiBuku from $tableLog where Aset_ID = {$Aset_ID} order by log_id desc limit 1";
                        $exeQueryLogSelect = $DBVAR->query($QueryLogSelect);
                        $resultQueryLogSelect = $DBVAR->fetch_array($exeQueryLogSelect);

                        $AkumulasiPenyusutan_Awal = $resultQueryLogSelect['AkumulasiPenyusutan'];
                        $NilaiBuku_Awal = $resultQueryLogSelect['NilaiBuku'];
                        $PenyusutanPerTahun_Awal = $resultQueryLogSelect['PenyusutanPerTahun'];
                    } elseif ($ceck == 0 || $ceck > 1) {
                        $QueryLogSelect = "select PenyusutanPerTahun_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal from $tableLog where Aset_ID = {$Aset_ID} order by log_id desc limit 1";
                        $exeQueryLogSelect = $DBVAR->query($QueryLogSelect);
                        $resultQueryLogSelect = $DBVAR->fetch_array($exeQueryLogSelect);

                        $AkumulasiPenyusutan_Awal = $resultQueryLogSelect['AkumulasiPenyusutan_Awal'];
                        $NilaiBuku_Awal = $resultQueryLogSelect['NilaiBuku_Awal'];
                        $PenyusutanPerTahun_Awal = $resultQueryLogSelect['PenyusutanPerTahun_Awal'];
                    }


                    $Kd_Riwayat = '50';
                    //insert log
                    $QueryLog = "INSERT INTO $tableLog ($implodeField,$AddField) VALUES ($implodeVal,'$action','$changeDate','$TglPerubahan','$NilaiPerolehan_Awal','$AkumulasiPenyusutan_Awal','$NilaiBuku_Awal','$PenyusutanPerTahun_Awal','$Kd_Riwayat')";
                    // echo $QueryLog; 
                    // pr($QueryLog);
                    // exit;
                    $exeQueryLog = $DBVAR->query($QueryLog);
                }
            }
        }
     }
     else{
         echo "Penyusutan tahun berjalan untuk tahun $newTahun $kodeSatker dengan kondisi penyusutan kedua kali (log ada di log_penyusutan) \n"
         . "Aset_ID \t kodeKelompok  \t NilaiPerolehan \t Tahun \t masa_manfaat \t AkumulasiPenyusutan \t NilaiBuku  \t penyusutan_per_tahun \n";
      while ($Data = $DBVAR->fetch_array($ExeQuery)){   
          $status_transaksi=0;
         $Aset_ID = $Data['Aset_ID'];
          //$Aset_ID=$DATA->Aset_ID;
          $kodeKelompok = $Data['kodeKelompok'];
          $tmp_kode = explode(".", $kodeKelompok);
          $NilaiPerolehan = $Data['NilaiPerolehan'];
          $kodeSatker= $Data['kodeSatker'];
          $Tahun = $Data['Tahun'];
          $AkumulasiPenyusutan=$Data['AkumulasiPenyusutan'];
          $PenyusutanPerTahun=$Data['PenyusutanPerTahun'];
          $NilaiBuku=$Data['NilaiBuku'];
          $MasaManfaat=$Data['MasaManfaat'];
          $UmurEkonomis=$Data['UmurEkonomis'];
          $masa_manfaat = cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2], $DBVAR);
            
         
          switch ($kib) {
              case 'B':
                  $tableKib="mesin";
                  $tableLog="log_mesin";
                  break;
              case 'C':
                  $tableKib="bangunan";
                  $tableLog="log_bangunan";
                  break;
              case 'D':
                  $tableKib="jaringan";
                  $tableLog="log_jaringan";
                  break;

              default:
                  break;
          }
          
          //query untuk log sblm penyusutan
          $TahunPenyusutan_log=$newTahun-1;
           $query_log_sblm="select log_id,kodeKelompok,kodeSatker,Aset_ID,NilaiPerolehan,NilaiPerolehan_Awal,Tahun,Kd_Riwayat,"
                     . "(NilaiPerolehan-NilaiPerolehan_Awal) as selisih,"
                   . " AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal,MasaManfaat,UmurEkonomis,TahunPenyusutan "
                     . " from $tableLog where TahunPenyusutan='$TahunPenyusutan_log' and kd_riwayat in (50) "
                     . "and Aset_ID='$Aset_ID' order by log_id desc limit 1 ";
            $qlog_sblm=$DBVAR->query($query_log_sblm) or die($DBVAR->error());
            $AkumulasiPenyusutan_Awal=0;
            $NilaiBuku_Awal=0;
            $PenyusutanPerTahun_Awal=0;
            
             while($Data_Log_Sblm=$DBVAR->fetch_array($qlog_sblm)){
                 $AkumulasiPenyusutan_Awal=$Data_Log_Sblm->AkumulasiPenyusutan_Awal;
                 $NilaiBuku_Awal=$Data_Log_Sblm->NilaiBuku_Awal;
                 $PenyusutanPerTahun_Awal=$Data_Log_Sblm->PenyusutanPerTahun_Awal;
                 
                 
             }
             $data_log=array("NilaiPerolehan_Awal"=>$NilaiPerolehan_Awal,
                    "AkumulasiPenyusutan_Awal"=>$AkumulasiPenyusutan_Awal,
                    "PenyusutanPerTahun_Awal"=>$PenyusutanPerTahun_Awal,
                     "kodeSatker"=>$kodeSatker);
             log_penyusutan($Aset_ID, $tableKib, 49,$newTahun, $data_log, $DBVAR);
            //akhir untuk log sblm penyusutan
          
          
        
        //untuk mengecek bila ada trasaksi
             $query_perubahan="select kd_riwayat,log_id,kodeKelompok,kodeSatker,Aset_ID,NilaiPerolehan,NilaiPerolehan_Awal,Tahun,Kd_Riwayat,"
                     . "(NilaiPerolehan-NilaiPerolehan_Awal) as selisih,AkumulasiPenyusutan,NilaiBuku,MasaManfaat,UmurEkonomis,TahunPenyusutan "
                     . " from $tableLog where TglPerubahan>'$TglPerubahan_awal' and kd_riwayat in (2,21,28,7) "
                     . "and Aset_ID='$Aset_ID' order by log_id asc";
             $count=0;
             $qlog=$DBVAR->query($query_perubahan) or die($DBVAR->error());
             while($Data_Log=$DBVAR->fetch_object($qlog)){
                 echo "masuk-logg \n";
                 $status_transaksi=1;
                 $kd_riwayat=$Data_Log->kd_riwayat;
                 $Nilai_Perolehan_log=$Data_Log->NilaiPerolehan;
                 $Nilai_Perolehan_awal_log=$Data_Log->NilaiPerolehan_Awal;
                 $selisih=abs($Data_Log->selisih);
                 $Tahun = $Data['Tahun'];
                 $nb_buku_log=$Data_Log->NilaiBuku;
                 $MasaManfaat=$Data_Log->MasaManfaat;
                 $UmurEkonomis=$Data_Log->UmurEkonomis;
                 $AkumulasiPenyusutan=$Data_Log->AkumulasiPenyusutan;
                 $TahunPenyusutan=$Data_Log->TahunPenyusutan;
                 $kodeKelompok_log = $Data['kodeKelompok'];
                 $tmp_kode_log = explode(".", $kodeKelompok_log);
                // $kd_riwayat=$Data_Log->kd_riwayat;
                 
                 $log_id=$Data_Log->log_id;
                 if($count==0){
                     if($kd_riwayat==28){
                         $NP=$NilaiPerolehan;
                         $selisih=$NP-$Nilai_Perolehan_log;
                         
                     }else{
                         echo "masuk ke count ==$count";
                         $NP=$Nilai_Perolehan_log;                         
                     }
                  }else{
                     if($kd_riwayat==28){
                         $NP=$tmp_nilai;
                         $selisih=$NP-$Nilai_Perolehan_log;
                     }else{
                         $NP=$Nilai_Perolehan_log;
                         
                     }
                     
                     
                 }
                  
                  if($kd_riwayat==2||$kd_riwayat==28){
                        $NilaiYgDisusutkan=$nb_buku_log+$selisih;
                        $penambahan_masa_manfaat=  overhaul($tmp_kode_log[0], $tmp_kode_log[1], $tmp_kode_log[2],$selisih, $DBVAR);
                        $Umur_Ekonomis_Final=$UmurEkonomis+$penambahan_masa_manfaat;
                        
                        if($Umur_Ekonomis_Final>$MasaManfaat){
                            $Umur_Ekonomis_Final=$MasaManfaat;
                        }
                        
                        $PenyusutanPerTahun_hasil=$NilaiYgDisusutkan/$Umur_Ekonomis_Final;
                        $AkumulasiPenyusutan_hasil=$AkumulasiPenyusutan+$PenyusutanPerTahun_hasil;
                        $NilaiBuku_hasil=$NP-$AkumulasiPenyusutan_hasil;
                        $Sisa_Masa_Manfaat=$Umur_Ekonomis_Final-1;
                        
                        if($Sisa_Masa_Manfaat<=0){
                            $NilaiBuku_hasil=0;
                            $AkumulasiPenyusutan_hasil=$NP;
                        }
                        //update aset dan update log untuk kapitalisasi
                            $QueryAset = "UPDATE aset SET MasaManfaat = '$MasaManfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                            PenyusutanPerTaun = '$PenyusutanPerTahun_hasil',
                                            NilaiBuku = '$NilaiBuku_hasil',
                                            UmurEkonomis = '$Sisa_Masa_Manfaat',
                                             TahunPenyusutan='$newTahun'     
                                            WHERE Aset_ID = '$Aset_ID'";
                            $ExeQueryAset = $DBVAR->query($QueryAset) or die($DBVAR->error());;
                             $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$MasaManfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                            PenyusutanPerTahun = '$penyusutan_per_tahun',
                                            NilaiBuku = '$NilaiBuku_hasil',
                                            UmurEkonomis = '$Sisa_Masa_Manfaat',
                                            TahunPenyusutan='$newTahun'
                                            WHERE Aset_ID = '$Aset_ID'";
                            $ExeQueryKib = $DBVAR->query($QueryKib) or die($DBVAR->error());;
                            //akhir update aset dan update log untuk kapitalisasi
                           
                            //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                            $QueryKib = "UPDATE $tableLog set MasaManfaat = '$MasaManfaat' ,
                                            AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                            PenyusutanPerTahun = '$penyusutan_per_tahun',
                                            NilaiBuku = '$NilaiBuku_hasil',
                                            UmurEkonomis = '$Sisa_Masa_Manfaat  ',
                                            TahunPenyusutan='$newTahun',
                                            AkumulasiPenyusutan_Awal='$AkumulasiPenyusutan_Awal',
                                            PenyusutanPerTahun_Awal='$PenyusutanPerTahun_Awal' 
                                            WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan_temp' ";
                            $ExeQueryKib = $DBVAR->query($QueryKib) or die($DBVAR->error());;
                         //update log penyusutan
                         log_penyusutan($Aset_ID, $tableKib, 50,$newTahun, $data_log, $DBVAR);
                         
                         echo "Kapitalisasi\n Aset_ID=$Aset_ID\n"
                                 . "kodeKelompok \t=$kodeKelompok_log \n"
                                 . "NilaiPerolehan \t=$NP\n"
                                 . "TahunPerolehan \t=$Tahun\n"
                                 . "MasaManfaat \t=$MasaManfaat\n"
                                 . "AkumulasiPenyusutan \t=$AkumulasiPenyusutan_hasil\n"
                                 . "AkumulasiPenyusutan_lama=$AkumulasiPenyusutan\n"
                                 . "NilaiBUku \t= $NilaiBuku_hasil\n"
                                 . "NilaiBUku_Sblm \t= $nb_buku_log\n"
                                 . "NilaiYgDisusutkan \t= $NilaiYgDisusutkan\n"
                                 . "PenyusutanPerTahun \t=$PenyusutanPerTahun_hasil \n"
                                 . "KodeRiwayat \t=$Kd_Riwayat\n"
                                 . "selisih \t=$selisih\n"
                                 . "UmurEkonomis_Sblm \t=$UmurEkonomis\n"
                                 . "UmurEkonomis \t=$Sisa_Masa_Manfaat\n"
                                 . "Penambahan \t=$penambahan_masa_manfaat \n\n   ";
                         
                         $perhitungan="  $NilaiYgDisusutkan=$NP+$selisih; \n"
                                 . "$Umur_Ekonomis_Final=$UmurEkonomis+$penambahan_masa_manfaat;\n
                                    $PenyusutanPerTahun_hasil=$NilaiYgDisusutkan/$UmurEkonomis;\n
                                    $AkumulasiPenyusutan_hasil=$PenyusutanPerTahun;\n
                                    $NilaiBuku_hasil=$NilaiYgDisusutkan-$AkumulasiPenyusutan;\n
                                    $Sisa_Masa_Manfaat=$Umur_Ekonomis_Final-1; \n";
                        $data_penyusutan=array('id' => NULL,'Aset_ID' => "$Aset_ID",
                             'kodeKelompok' => "$kodeKelompok",
                             'kodeSatker' => "$kodeSatker",
                             'Tahun' => "$Tahun",
                             'NilaiPerolehan' => "$NilaiPerolehan",
                             'MasaManfaat' => "$MasaManfaat",
                             'NilaiBuku' => "$NilaiBuku_hasil",
                             'info' =>"$kd_riwayat | Kapitalisasi",
                             'log_id' => "$log_id",
                             'perhitungan' => "$perhitungan",
                             'TahunPenyusutan' => "$newTahun",
                             'changeDate' => date('Y-m-d'),'StatusTampil' => '1');
                         
                         catatan_hasil_penyusutan($data_penyusutan, $DBVAR);
                         //akhir update log penyusutan
                         
                     }else if($kd_riwayat==7||$kd_riwayat==21){
                         $PenyusutanPerTahun=$NP/$MasaManfaat;
                         $rentang_tahun_penyusutan = ($newTahun-$Tahun)+1;
                         $AkumulasiPenyusutan=$rentang_tahun_penyusutan*$PenyusutanPerTahun;
                         $NilaiBuku=$NP-$AkumulasiPenyusutan;
                         $Sisa_Masa_Manfaat=$MasaManfaat-$rentang_tahun_penyusutan;
                         if($Sisa_Masa_Manfaat<=0){
                             $AkumulasiPenyusutan=$NP;
                             $NilaiBuku=0;
                         }
                            //update aset dan update log untuk kapitalisasi
                               $QueryAset = "UPDATE aset SET MasaManfaat = '$MasaManfaat' ,
                                               AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                               PenyusutanPerTaun = '$PenyusutanPerTahun_hasil',
                                               NilaiBuku = '$NilaiBuku_hasil',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                                TahunPenyusutan='$newTahun'     
                                               WHERE Aset_ID = '$Aset_ID'";
                               $ExeQueryAset = $DBVAR->query($QueryAset);
                                $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$MasaManfaat' ,
                                               AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                               PenyusutanPerTahun = '$penyusutan_per_tahun',
                                               NilaiBuku = '$NilaiBuku_hasil',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                               TahunPenyusutan='$newTahun'
                                               WHERE Aset_ID = '$Aset_ID'";
                               $ExeQueryKib = $DBVAR->query($QueryKib);
                               //akhir update aset dan update log untuk kapitalisasi

                               //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                               $QueryKib = "UPDATE $tableLog set MasaManfaat = '$MasaManfaat' ,
                                               AkumulasiPenyusutan = '$AkumulasiPenyusutan_hasil',	
                                               PenyusutanPerTahun = '$penyusutan_per_tahun',
                                               NilaiBuku = '$NilaiBuku_hasil',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                               TahunPenyusutan='$newTahun',
                                               AkumulasiPenyusutan_Awal='$AkumulasiPenyusutan_Awal',
                                               PenyusutanPerTahun_Awal='$PenyusutanPerTahun_Awal' 
                                               WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan_temp' ";
                               $ExeQueryKib = $DBVAR->query($QueryKib) or die($DBVAR->error());;
                            //update log penyusutan
                            log_penyusutan($Aset_ID, $tableKib, 50,$newTahun, $data_log, $DBVAR);
                            //akhir update log penyusutan
                              echo "Aset_ID=$Aset_ID\n"
                                      . "kodeKelompok \t=$kodeKelompok_log \n"
                                      . "NilaiPerolehan \t=$NP \n"
                                      . "TahunPerolehan \t=$Tahun\n"
                                      . "MasaManfaat \t=$MasaManfaat\n"
                                      . "AkumulasiPenyusutan \t=$AkumulasiPenyusutan_hasil\n"
                                      . "NilaiBUku \t=$NilaiBuku_hasil\n"
                                      . "PenyusutanPerTahun \t=$penyusutan_per_tahun \n"
                                      . "KodeRiwayat \t=$Kd_Riwayat\n"
                                      . "selisih \t=$selisih\n"
                                      . "UmurEkonomis \t=$Sisa_Masa_Manfaat\n\n 
                              ";
                         //   echo "$Aset_ID \t $kodeKelompok_log \t $NP \t $Tahun \t $MasaManfaat \t $AkumulasiPenyusutan_hasil \t $NilaiBuku_hasil  \t $penyusutan_per_tahun $Kd_Riwayat sisa=$Sisa_Masa_Manfaat penambahan=$penambahan_masa_manfaat \n";
                         
                            
                            $perhitungan="$PenyusutanPerTahun=$NP/$MasaManfaat;\n
                         $rentang_tahun_penyusutan = ($newTahun-$Tahun)+1;\n
                         $AkumulasiPenyusutan=$rentang_tahun_penyusutan*$PenyusutanPerTahun;\n
                         $NilaiBuku=$NP-$AkumulasiPenyusutan;\n
                         $Sisa_Masa_Manfaat=$MasaManfaat-$rentang_tahun_penyusutan;\n";
                            $data_penyusutan=array('id' => NULL,'Aset_ID' => "$Aset_ID",
                             'kodeKelompok' => "$kodeKelompok",
                             'kodeSatker' => "$kodeSatker",
                             'Tahun' => "$Tahun",
                             'NilaiPerolehan' => "$NilaiPerolehan",
                             'MasaManfaat' => "$MasaManfaat",
                             'NilaiBuku' => "$NilaiBuku_hasil",
                             'info' =>"$kd_riwayat | koreksi-penghapusan sebagian",
                             'log_id' => "$log_id",
                             'perhitungan' => "$perhitungan",
                             'TahunPenyusutan' => "$newTahun",
                             'changeDate' => date('Y-m-d'),'StatusTampil' => '1');
                         
                         catatan_hasil_penyusutan($data_penyusutan, $DBVAR);
                         
                     }
                 $tmp_nilai=$Nilai_Perolehan_log;
                 $count++;
                 
             }
             
             if($status_transaksi!=1){
                 echo "tidak masuk log \n";
                 //bila tidak ada transaksi
                 //$PenyusutanPerTahun=$NilaiPerolehan/$MasaManfaat;
                 $rentang_tahun_penyusutan = ($newTahun-$Tahun)+1;
                 //$AkumulasiPenyusutan=$rentang_tahun_penyusutan*$PenyusutanPerTahun;
                 $AkumulasiPenyusutan=$AkumulasiPenyusutan+$PenyusutanPerTahun;
                 $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;
                 $Sisa_Masa_Manfaat=$MasaManfaat-$rentang_tahun_penyusutan;
                 if($Sisa_Masa_Manfaat<=0){
                    $AkumulasiPenyusutan=$NilaiPerolehan;
                    $NilaiBuku=0;
                 }
                         
                 //update aset dan update log untuk kapitalisasi
                               $QueryAset = "UPDATE aset SET MasaManfaat = '$MasaManfaat' ,
                                               AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                               PenyusutanPerTaun = '$PenyusutanPerTahun',
                                               NilaiBuku = '$NilaiBuku',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                                TahunPenyusutan='$newTahun'     
                                               WHERE Aset_ID = '$Aset_ID'";
                               $ExeQueryAset = $DBVAR->query($QueryAset) or die($DBVAR->error());;
                                $QueryKib = "UPDATE $tableKib SET MasaManfaat = '$MasaManfaat' ,
                                               AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                               PenyusutanPerTahun = '$PenyusutanPerTahun',
                                               NilaiBuku = '$NilaiBuku',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                               TahunPenyusutan='$newTahun'
                                               WHERE Aset_ID = '$Aset_ID'";
                               $ExeQueryKib = $DBVAR->query($QueryKib) or die($DBVAR->error());;
                               //akhir update aset dan update log untuk kapitalisasi

                               //update untuk mereset akumulasi penyusutan untuk diatas tanggal penyusutan
                               $QueryKib = "UPDATE $tableLog set MasaManfaat = '$MasaManfaat' ,
                                              AkumulasiPenyusutan = '$AkumulasiPenyusutan',	
                                               PenyusutanPerTahun = '$PenyusutanPerTahun',
                                               NilaiBuku = '$NilaiBuku',
                                               UmurEkonomis = '$Sisa_Masa_Manfaat',
                                               TahunPenyusutan='$newTahun',
                                               AkumulasiPenyusutan_Awal='$AkumulasiPenyusutan_Awal',
                                               PenyusutanPerTahun_Awal='$PenyusutanPerTahun_Awal' 
                                               WHERE Aset_ID = '$Aset_ID' and TglPerubahan > '$TglPerubahan_temp' ";
                               $ExeQueryKib = $DBVAR->query($QueryKib) or die($DBVAR->error());;
                            //update log penyusutan
                            $log_id=log_penyusutan($Aset_ID, $tableKib, 50,$newTahun, $data_log, $DBVAR);
                            //akhir update log penyusutan
                            
                               echo "Aset_ID \t=$Aset_ID\n"
                                       . "kodeKelompok \t=$kodeKelompok \n"
                                       . "NilaiPerolehan \t=$NilaiPerolehan \n"
                                       . "TahunPerolehan \t=$Tahun\n "
                                       . "MasaManfaat \t=$MasaManfaat\n "
                                       . "AkumulasiPenyusutan \t=$AkumulasiPenyusutan\n"
                                       . "NilaiBUku \t= $NilaiBuku\n"
                                       . "PenyusutanPerTahun \t=$PenyusutanPerTahun \n"
                                       . "UmurEkonomis \t=$Sisa_Masa_Manfaat\n\n
                              ";
                            
                                  
                 //echo "$Aset_ID \t $kodeKelompok \t $NilaiPerolehan \t $Tahun \t $MasaManfaat \t $AkumulasiPenyusutan \t $NilaiBuku  \t $PenyusutanPerTahun $Kd_Riwayat \n";
              
                               $perhitungan="  $PenyusutanPerTahun=$NilaiPerolehan/$MasaManfaat;\n
                                            $rentang_tahun_penyusutan = ($newTahun-$Tahun)+1;\n
                                            $AkumulasiPenyusutan=$rentang_tahun_penyusutan*$PenyusutanPerTahun;\n
                                            $NilaiBuku=$NilaiPerolehan-$AkumulasiPenyusutan;\n
                                            $Sisa_Masa_Manfaat=$MasaManfaat-$rentang_tahun_penyusutan;\n";
                               
                            $data_penyusutan=array('id' => NULL,'Aset_ID' => "$Aset_ID",
                             'kodeKelompok' => "$kodeKelompok",
                             'kodeSatker' => "$kodeSatker",
                             'Tahun' => "$Tahun",
                             'NilaiPerolehan' => "$NilaiPerolehan",
                             'MasaManfaat' => "$MasaManfaat",
                             'NilaiBuku' => "$NilaiBuku_hasil",
                             'info' =>"biasa",
                             'log_id' => '0',
                             'perhitungan' => "$perhitungan",
                             'TahunPenyusutan' => "$newTahun",
                             'changeDate' => date('Y-m-d'),'StatusTampil' => '1');
                         
                         catatan_hasil_penyusutan($data_penyusutan, $DBVAR);
             }
         
         
         
      }
      
     }
   
}
 //update table status untuk penyusutan
    $query = "update penyusutan_tahun_berjalan  set StatusRunning=2 where id=$id";
   
    $DBVAR->query($query) or die($DBVAR->error());

function cek_masamanfaat($kd_aset1, $kd_aset2, $kd_aset3, $DBVAR) {
    $query = "select * from ref_masamanfaat where kd_aset1='$kd_aset1' "
            . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    $result = $DBVAR->query($query) or die($DBVAR->error());
    while ($row = $DBVAR->fetch_object($result)) {
        $masa_manfaat = $row->masa_manfaat;
    }
    return $masa_manfaat;
}
function overhaul($kd_aset1, $kd_aset2, $kd_aset3,$persen, $DBVAR) {
    $query = "select * from re_masamanfaat_tahun_berjalan where kd_aset1='$kd_aset1' "
            . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    //echo $query;
    $result = $DBVAR->query($query) or die($query);
    while ($row = $DBVAR->fetch_object($result)) {
        $masa_manfaat = $row->masa_manfaat;
        $prosentase1= $row->prosentase1;
        $penambahan1 = $row->penambahan1;
        $prosentase2= $row->prosentase2;
        $penambahan2 = $row->penambahan2;
        $prosentase3= $row->prosentase3;
        $penambahan3 = $row->penambahan3;
        $prosentase4= $row->prosentase4;
        $penambahan4= $row->penambahan4;
        ;
    }
    //echo "<pre> ";
   // print($prosentase3);
    if($prosentase4!=0){
      //  echo "masuk11";
      if($persen >$prosentase4){
          //echo "0 =4";
          $hasil=$penambahan4;
      }else if($persen>$prosentase2 && $persen <=$prosentase3) {
          //echo "0 =3";
          $hasil=$penambahan3;
      }
      else if($persen>$prosentase1 && $persen <=$prosentase2) {
           //echo "0 =2";
          $hasil=$penambahan2;
      }
      else if($persen<=$prosentase1) {
          // echo "0 =1";
          $hasil=$penambahan1;
      }
    }else{
      //  echo " $prosentase1 $prosentase2 $prosentase3 $prosentase4 ";
         if($persen >$prosentase3){
              //echo "1 =3";
              
          $hasil=$penambahan3;
      }else if($persen>$prosentase1 && $persen <=$prosentase2) {
         // echo "1 =2 ";
          $hasil=$penambahan2;
      }
    else if($persen<=$prosentase1 ) {
          //echo "1 = 5 ";
          $hasil=$penambahan1;
      }
        
    }
    if($hasil=="")
        $hasil=0;
    return $hasil;
}

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}


function log_penyusutan($Aset_ID,$tableKib,$Kd_Riwayat,$tahun,$Data,$DBVAR){
    //select field dan value tabel kib
    
          $QueryKibSelect	  = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
          $exequeryKibSelect = $DBVAR->query($QueryKibSelect);
	$resultqueryKibSelect = $DBVAR->fetch_object($exequeryKibSelect);
					
	$tmpField = array();
	$tmpVal = array();
	$sign = "'"; 
        $AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal";
        $action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
        $changeDate = date('Y-m-d');
        $NilaiPerolehan_Awal = $Data['NilaiPerolehan_Awal'];
        if($NilaiPerolehan_Awal ==""||$NilaiPerolehan_Awal ==0){
            $NilaiPerolehan_Awal ="NULL";
        }
        $AkumulasiPenyusutan_Awal=$Data['AkumulasiPenyusutan_Awal'];
        if($AkumulasiPenyusutan_Awal==""||$AkumulasiPenyusutan_Awal=="0"){
            $AkumulasiPenyusutan_Awal="NULL";
        }
        $NilaiBuku_Awal = $Data['NilaiBuku_Awal'];
        if($NilaiBuku_Awal ==""||$NilaiBuku_Awal =="0"){
            $NilaiBuku_Awal ="NULL";
        }
        $PenyusutanPerTahun_Awal = $Data['PenyusutanPerTahun_Awal'];
        if($PenyusutanPerTahun_Awal ==""||$PenyusutanPerTahun_Awal =="0"){
            $PenyusutanPerTahun_Awal ="NULL";
        }
        foreach ($resultqueryKibSelect as $key => $val) {
            $tmpField[] = $key;
            if ($val ==''){
                $tmpVal[] = $sign."NULL".$sign;
            }else{
                $tmpVal[] = $sign.addslashes($val).$sign;
            }
	}
	$implodeField = implode (',',$tmpField);
	$implodeVal = implode (',',$tmpVal);
        
        $QueryLog ="INSERT INTO log_$tableKib ($implodeField,$AddField) VALUES"
                . "      ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal',$AkumulasiPenyusutan_Awal,"
                . "$NilaiBuku_Awal,$PenyusutanPerTahun_Awal)";
	$exeQueryLog = $DBVAR->query($QueryLog) or die($DBVAR->error());;
        
        
        return $tableLog;
}

function catatan_hasil_penyusutan($data,$DBVAR){
 $Aset_ID=$data['Aset_ID'];
 $kodeKelompok=$data['kodeKelompok'];
 $kodeSatker=$data['kodeSatker'];
 $Tahun=$data['Tahun'];
 $NilaiPerolehan=$data['NilaiPerolehan'];
 $MasaManfaat=$data['MasaManfaat'];
 $NilaiBuku=$data['NilaiBuku'];
 $info=$data['info'];
 $log_id=$data['log_id'];
 $perhitugan=$data['perhitugan'];
 $TahunPenyusutan=$data['TahunPenyusutan'];
 $changeDate=$data['changeDate'];
  
    $query="INSERT INTO log_penyusutan (id, Aset_ID, kodeKelompok, kodeSatker, Tahun, NilaiPerolehan, "
            . "             MasaManfaat, NilaiBuku, info, log_id, perhitungan, TahunPenyusutan, changeDate,StatusTampil)"
            . " VALUES (NULL, '$Aset_ID', '$kodeKelompok', '$kodeSatker', '$Tahun', '$NilaiPerolehan', "
            . "     '$MasaManfaat', '$NilaiBuku', '$info', $log_id, '$perhitugan', '$TahunPenyusutan', '$changeDate',1);";
    $exeQueryLog = $DBVAR->query($query) or die($DBVAR->error());;
}
?>
