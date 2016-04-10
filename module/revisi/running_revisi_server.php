<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This code provided by:
//Andreas Hadiyono (andre.hadiyono@gmail.com)
//Gunadarma University
error_reporting( 0 );
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
$aColumns = array( 'a.Aset_ID', 'a.kodeKelompok', 'k.Uraian', 'a.Tahun', 'a.Info', 'a.NilaiPerolehan', 'a.noRegister', 'a.PenyusutanPerTahun', 'a.AkumulasiPenyusutan', 'a.TipeAset', 'a.kodeSatker', 'a.Status_Validasi_Barang', 'a.MasaManfaat' );
$fieldCustom = str_replace( " , ", " ", implode( ", ", $aColumns ) );
$sTable = "aset_tmp as a";
$sTable2 = "aset_tmp2 as a";
$sTable_inner_join_kelompok = "kelompok as k";
$cond_kelompok = "k.Kode = a.kodeKelompok ";
$status = "a.Status_Validasi_Barang = 1 AND";


$TglPerubahan_awal = $tahun . "-01" . "-01";
$TglPerubahan_temp = $tahun . "-12" . "-31";
$TglPerubahan_Awal_Tahun=$tahun . "-01" . "-01";


/*untuk mengukur mengetahui aset yang harus di koreksi*/
if ( $kib == 'B' ) {
  $queryKib = "create temporary table aset_tmp as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info,
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar,
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan
                                            from mesin a where a.TglPerolehan <= '$TglPerubahan_temp'  and a.kodeSatker like '$kodeSatker%'";
  $ExeQuery = $DBVAR->query( $queryKib ) or die( $DBVAR->error() );

  $queryAlter = "ALTER table aset_tmp add primary key(Mesin_ID)";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );

  $queryAlter = "Update aset_tmp set TipeAset='B';";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );

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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

  //untuk table selanjutnya
  $queryKib = "create temporary table aset_tmp2 as
                                      select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                  a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info,
                                                  a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
                                                  a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar,
                                                  a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis ,a.TahunPenyusutan
                                            from mesin a where  a.kodeSatker like '$kodeSatker%' and  a.TglPerolehan <= '$TglPerubahan_temp' ";
  $ExeQuery = $DBVAR->query( $queryKib ) or die( $DBVAR->error() );

  $queryAlter = "ALTER table aset_tmp2 add primary key(Mesin_ID)";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );

  $queryAlter = "Update aset_tmp2 set TipeAset='B';";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );

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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

  $flagKelompok = '02';
  $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
          AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";

  $AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=0 OR kodeKA = '1')
          AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$TglPerubahan_temp'";
} elseif ( $kib == 'C' ) {
  $queryKib = "create temporary table aset_tmp  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi,
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap,
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas,
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan
                                                 from bangunan a
                                                 where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
  $ExeQuery = $DBVAR->query( $queryKib ) or die( $DBVAR->error() );

  $queryAlter = "ALTER table aset_tmp add primary key(Bangunan_ID)";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );

  $queryAlter = "Update aset_tmp set TipeAset='C';";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );


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

  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );
  //untuk tabel temp selanjutnya

  $queryKib = "create temporary table aset_tmp2  as
                                                 select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 'TipeAset',
                                                       a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi,
                                                       a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap,
                                                       a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas,
                                                       a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis  ,a.TahunPenyusutan
                                                 from bangunan a
                                                 where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
  $ExeQuery = $DBVAR->query( $queryKib ) or die( $DBVAR->error() );

  $queryAlter = "ALTER table aset_tmp2 add primary key(Bangunan_ID)";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );

  $queryAlter = "Update aset_tmp2 set TipeAset='C';";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );


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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

  $flagKelompok = '03';
  $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND a.kodeKA = '1'
          AND a.TglPerolehan >='0000-00-00' AND a.TglPerolehan <= '2008-01-01'";

  $AddCondtn_2 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3' AND (a.NilaiPerolehan >=0 OR kodeKA = '1')
          AND a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <= '$TglPerubahan_temp'";
} elseif ( $kib == 'D' ) {
  $queryKib = "create temporary table aset_tmp as
                                           select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData,  'TipeAset',
                                                 a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info,
                                                 a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah,
                                                 a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat,
                                                 a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan
                                           from jaringan a
                                           where  a.kodeSatker like '$kodeSatker%' and a.TglPerolehan <= '$TglPerubahan_temp'";
  $ExeQuery = $DBVAR->query( $queryKib ) or die( $DBVAR->error() );

  $queryAlter = "ALTER table aset_tmp add primary key(Jaringan_ID)";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );

  $queryAlter = "Update aset_tmp set TipeAset='D';";
  $ExeQuery = $DBVAR->query( $queryAlter ) or die( $DBVAR->error() );



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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );


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
  $ExeQuery = $DBVAR->query( $queryLog ) or die( $DBVAR->error() );

  $flagKelompok = '04';
  $AddCondtn_1 = "AND a.kodeLokasi like '12%' AND a.kondisi !='3'
              AND a.TglPerolehan <= '$TglPerubahan_temp'";
  $AddCondtn_2 = "";
}

/*akhir untuk mengetahui aset yang di koreksi*/
for ( $i=0;$i<2;$i++ ) {
  switch ( $i ) {
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

  if ( $kib == 'B' || $kib == 'C' ) {
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
  } elseif ( $kib == 'D' ) {
    $sQuery = "
                    SELECT $fieldCustom
                            FROM   $sTable
                            INNER JOIN $sTable_inner_join_kelompok ON $cond_kelompok
                            $sWhere
                            $AddCondtn_1";
  }


  $ExeQuery = $DBVAR->query( $sQuery ) or die( $DBVAR->error() );
  //echo "$i === $sQuery\n";
  if ( $i==0 ) {
    echo "Tidak di revisi karena aset baru \n";
  }
  else {
    echo "Revisi log $newTahun $kodeSatker dengan kondisi penyusutan kedua kali \n";
    
      echo "log_id | Aset_ID_log |kodeKelompok|kodeSatker|noRegister|Tahun| kd_riwayat| NILAI_PEROLEHAN_AKHIR | NILAI_PEROLEHAN_AWAL | "
    . "AKUMULASI_PENYUSUTAN_AKHIR | AKUMULASI_PENYUSUTAN_AWAL | NILAI_BUKU_AKHIR | "
              . "NILAI_BUKU_AWAL |aksi | selisih"
              . "|masa_manfaat |mutasi_beban_penyusutan |rentang_penyusutan| mutasi_akumulasi |"
               . " akumulasi_penyusutan_akhir\n";

    while ( $Data = $DBVAR->fetch_array( $ExeQuery ) ) {
      $status_transaksi=0;
      $Aset_ID = $Data['Aset_ID'];
      //$Aset_ID=$DATA->Aset_ID;
      $kodeKelompok = $Data['kodeKelompok'];
      $tmp_kode = explode( ".", $kodeKelompok );
      $NilaiPerolehan = $Data['NilaiPerolehan'];
      $kodeSatker= $Data['kodeSatker'];
      $Tahun = $Data['Tahun'];
      $AkumulasiPenyusutan=$Data['AkumulasiPenyusutan'];
      $PenyusutanPerTahun=$Data['PenyusutanPerTahun'];
      $NilaiBuku=$Data['NilaiBuku'];
      $MasaManfaat=$Data['MasaManfaat'];
      $UmurEkonomis=$Data['UmurEkonomis'];
      
      


      switch ( $kib ) {
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
      $qlog_sblm=$DBVAR->query( $query_log_sblm ) or die( $DBVAR->error() );
      $AkumulasiPenyusutan_Awal=0;
      $NilaiBuku_Awal=0;
      $PenyusutanPerTahun_Awal=0;

      while ( $Data_Log_Sblm=$DBVAR->fetch_array( $qlog_sblm ) ) {
        $AkumulasiPenyusutan_Awal=$Data_Log_Sblm->AkumulasiPenyusutan_Awal;
        $NilaiBuku_Awal=$Data_Log_Sblm->NilaiBuku_Awal;
        $PenyusutanPerTahun_Awal=$Data_Log_Sblm->PenyusutanPerTahun_Awal;
        $NilaiPerolehan_restatement=$Data_Log_Sblm->NilaiPerolehan;
      }


      //untuk mengecek bila ada trasaksi
      $query_perubahan="select Aset_ID_Penambahan,`action`,
                      Aset_ID,`noRegister`,
                      kd_riwayat,log_id,kodeKelompok,kodeSatker,
                      Aset_ID,NilaiPerolehan,NilaiPerolehan_Awal,
                      Tahun,Kd_Riwayat,
                      (NilaiPerolehan-NilaiPerolehan_Awal) as selisih,
                      AkumulasiPenyusutan,PenyusutanPerTahun,NilaiBuku,
                      MasaManfaat,UmurEkonomis,TahunPenyusutan
                      from $tableLog where TglPerubahan>'$TglPerubahan_awal'
                       and kd_riwayat in (2,21,28,7)
                    and Aset_ID='$Aset_ID' order by log_id asc";
      //2 kapitalisasi
      //7 penghapusan sebagian
      //21 koreksi nilai
      //28 transfer kapitalisasi

      $count=0;
      $qlog=$DBVAR->query( $query_perubahan ) or die( $DBVAR->error() );
      $kapitalisasi=0;
      $tmp_nilai_perolehan=0;
      while ( $Data_Log=$DBVAR->fetch_object( $qlog ) ) {
        
        $log_id                 =$Data_Log->log_id;
        $Aset_ID_log            =$Data_Log->Aset_ID;
        $Data_Revisi=$Data_Log;
        
        $log_id                 =$Data_Revisi->log_id;
        $Aset_ID_log            =$Data_Revisi->Aset_ID;
        $status_transaksi        =1;
        $Tahun              =$Data_Revisi->Tahun;
        $kodeKelompok           =$Data_Revisi->kodeKelompok;
        $kd_riwayat              =$Data_Revisi->kd_riwayat;
        $Nilai_Perolehan_log     =$Data_Revisi->NilaiPerolehan;
        $Nilai_Perolehan_awal_log     =$Data_Revisi->NilaiPerolehan_Awal;
        
       list ( $AkumulasiPenyusutan_log, $UmurEkonomis2, $MasaManfaat2,$nb_buku_log )=get_data_akumulasi_from_eksisting( $Aset_ID_log, $DBVAR );
                
        //$nb_buku_log=$Data_Revisi->NilaiBuku;
        $selisih                 =$Data_Revisi->selisih;
        //$AkumulasiPenyusutan_log    =$Data_Revisi->AkumulasiPenyusutan;
        $AkumulasiPenyusutan_awal_log    =$Data_Revisi->AkumulasiPenyusutan_Awal;
        $PenyusutanPerTahun_log     =$Data_Revisi->PenyusutanPerTahun;
        $NilaiBuku_awal_log          =$Data_Revisi->NilaiBuku_Awal;
        $aksi                   =$Data_Revisi->action;
        
        $kodeSatker_log=$Data_Revisi->kodeSatker;
        $noRegister_log=$Data_Revisi->noRegister;
        $Aset_ID_Penambahan     =$Data_Revisi->Aset_ID_Penambahan;
        $status_update=0;
          $masa_manfaat=  $Data_Revisi->MasaManfaat;
              $beban_penyusutan_berkurang=0;
              $rentang_penyusutan=0;
              $akumulasi_penyusutan_berkurang=0;
              $akumulasi_penyusutan_akhir=0;
        
        $kapitalisasi_via_transfer=0;
        if ( $kd_riwayat==28 && $Aset_ID_Penambahan==0 ) {
         
          list($selisih,$TahunAset)=get_NP_Aset_ID_Penambahan($Aset_ID_log,$log_id,$DBVAR);
          
          if($TahunAset==2015){
              //kapitalisasi
              $kapitalisasi_via_transfer=1;
              $nb_akhir=$nb_buku_log+$selisih;
                $kd_riwayat='29';
                $NILAI_PEROLEHAN_AKHIR=$Nilai_Perolehan_log+$selisih;
                $NILAI_PEROLEHAN_AWAL=$Nilai_Perolehan_log;
                $AKUMULASI_PENYUSUTAN_AKHIR=$AkumulasiPenyusutan_log;
                $AKUMULASI_PENYUSUTAN_AWAL=$AkumulasiPenyusutan_awal_log;
                $NILAI_BUKU_AKHIR=$nb_akhir;
                $NILAI_BUKU_AWAL=$nb_buku_log;
          }else{
              $tmp_kode= explode(".", $kodeKelompok);
              $masa_manfaat=  cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2], $DBVAR);
              $beban_penyusutan_berkurang=$selisih/$masa_manfaat;
              $rentang_penyusutan=2014-$Tahun+1;
              if($rentang_penyusutan>$masa_manfaat){
                  $rentang_penyusutan=$masa_manfaat;
              }
              
              $akumulasi_penyusutan_berkurang=$rentang_penyusutan*$beban_penyusutan_berkurang;
              $akumulasi_penyusutan_akhir=$AkumulasiPenyusutan_log+$akumulasi_penyusutan_berkurang;
              
              $NILAI_PEROLEHAN_AKHIR=$Nilai_Perolehan_log+$selisih;
              $NILAI_PEROLEHAN_AWAL=$Nilai_Perolehan_log;
              $AKUMULASI_PENYUSUTAN_AKHIR=$akumulasi_penyusutan_akhir;
              $AKUMULASI_PENYUSUTAN_AWAL=$AkumulasiPenyusutan_log;
              $NILAI_BUKU_AKHIR=$NILAI_PEROLEHAN_AKHIR-$AKUMULASI_PENYUSUTAN_AKHIR;
              $NILAI_BUKU_AWAL=$nb_buku_log;
              
          }
          
          
          
          
          echo "masuk kapitalisasi==$TahunAset , status_kap=$kapitalisasi\n ";
         


        }else        if($kd_riwayat==7 || $kd_riwayat==21){
           $tmp_kode= explode(".", $kodeKelompok);
           $masa_manfaat=  cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2], $DBVAR);
           $beban_penyusutan_berkurang=($selisih/$masa_manfaat);
           $rentang_penyusutan=2014-$Tahun+1;
              if($rentang_penyusutan>$masa_manfaat){
                  $rentang_penyusutan=$masa_manfaat;
              }
           $akumulasi_penyusutan_berkurang=$rentang_penyusutan*$beban_penyusutan_berkurang;
           $akumulasi_penyusutan_akhir=$AkumulasiPenyusutan_log+$akumulasi_penyusutan_berkurang;

          $NILAI_PEROLEHAN_AKHIR=$Nilai_Perolehan_log;
          $NILAI_PEROLEHAN_AWAL=$Nilai_Perolehan_awal_log;
          $AKUMULASI_PENYUSUTAN_AKHIR=$akumulasi_penyusutan_akhir;
          $AKUMULASI_PENYUSUTAN_AWAL=$AkumulasiPenyusutan_log;
          $NILAI_BUKU_AKHIR=$NILAI_PEROLEHAN_AKHIR-$AKUMULASI_PENYUSUTAN_AKHIR;
          $NILAI_BUKU_AWAL=$nb_buku_log;

        }else if($kd_riwayat==2){
          $nb_akhir=$nb_buku_log+$selisih;

           $NILAI_PEROLEHAN_AKHIR=$Nilai_Perolehan_log;
          $NILAI_PEROLEHAN_AWAL=$Nilai_Perolehan_awal_log;
          $AKUMULASI_PENYUSUTAN_AKHIR=$AkumulasiPenyusutan_log;
          $AKUMULASI_PENYUSUTAN_AWAL=$AkumulasiPenyusutan_log;
          $NILAI_BUKU_AKHIR=$nb_akhir;
          $NILAI_BUKU_AWAL=$nb_buku_log;
        }
            
       

        $query="update $tableLog set 
                kd_riwayat='$kd_riwayat',
                NilaiPerolehan='$NILAI_PEROLEHAN_AKHIR', 
                NilaiPerolehan_Awal='$NILAI_PEROLEHAN_AWAL',
                AkumulasiPenyusutan='$AKUMULASI_PENYUSUTAN_AKHIR',
                AkumulasiPenyusutan_Awal='$AKUMULASI_PENYUSUTAN_AWAL',
                NilaiBuku='$NILAI_BUKU_AKHIR',
                NilaiBuku_Awal='$NILAI_BUKU_AWAL' 
                where log_id='$log_id' and aset_id='$Aset_ID_log' ";
        $result=$DBVAR->query( $query ) or die( $DBVAR->error() );
        
        
        
        $query="update aset set NilaiBuku='$NILAI_BUKU_AKHIR',AkumulasiPenyusutan='$AKUMULASI_PENYUSUTAN_AKHIR'"
                . " where aset_id='$Aset_ID_log'";
        $result=$DBVAR->query( $query ) or die( $DBVAR->error() );
        
        $query="update $tableKib set NilaiBuku='$NILAI_BUKU_AKHIR',AkumulasiPenyusutan='$AKUMULASI_PENYUSUTAN_AKHIR'"
                . " where aset_id='$Aset_ID_log'";
        $result=$DBVAR->query( $query ) or die( $DBVAR->error() );
        
       echo "$log_id | $Aset_ID_log |$kodeKelompok|$kodeSatker_log| $noRegister_log | $Tahun "
               . "|$kd_riwayat| $NILAI_PEROLEHAN_AKHIR | $NILAI_PEROLEHAN_AWAL | $AKUMULASI_PENYUSUTAN_AKHIR | $AKUMULASI_PENYUSUTAN_AWAL |$NILAI_BUKU_AKHIR | $NILAI_BUKU_AWAL |$aksi"
               . " | $selisih |$masa_manfaat |$beban_penyusutan_berkurang |$rentang_penyusutan| $akumulasi_penyusutan_berkurang |"
               . " $akumulasi_penyusutan_akhir\n";
                        

       
       $count++;

      }

      if ( $status_transaksi!=1 ) {
        //tidak masuk transaksi
       // echo "tidak masuk log \n";
      }



    }

  }

}
//update table status untuk penyusutan
$query = "update penyusutan_tahun_berjalan  set status_revisi=2 where id=$id";

$DBVAR->query( $query ) or die( $DBVAR->error() );

function cek_nilai( $aset_id, $DBVAR ) {
  $query = "select NilaiPerolehan from aset where aset_id='$aset_id' ";
  $result = $DBVAR->query( $query ) or die( $DBVAR->error() );
  while ( $row = $DBVAR->fetch_object( $result ) ) {
    $NilaiPerolehan = $row->NilaiPerolehan;
  }
  return $NilaiPerolehan;
}

function cek_masamanfaat( $kd_aset1, $kd_aset2, $kd_aset3, $DBVAR ) {
  $query = "select * from ref_masamanfaat where kd_aset1='$kd_aset1' "
    . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
  $result = $DBVAR->query( $query ) or die( $DBVAR->error() );
  while ( $row = $DBVAR->fetch_object( $result ) ) {
    $masa_manfaat = $row->masa_manfaat;
  }
  return $masa_manfaat;
}
function overhaul( $kd_aset1, $kd_aset2, $kd_aset3, $persen, $DBVAR ) {
  $kd_aset1=intval( $kd_aset1 );
  $kd_aset2=intval( $kd_aset2 );
  $kd_aset3=intval( $kd_aset3 );
  $query = "select * from re_masamanfaat_tahun_berjalan where kd_aset1='$kd_aset1' "
    . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
  echo "$query\n\n";
  $result = $DBVAR->query( $query ) or die( $query );
  while ( $row = $DBVAR->fetch_object( $result ) ) {
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
  if ( $prosentase4!=0 ) {
    echo " masuk 11 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";
    if ( $persen >$prosentase4 ) {
      echo "0 =4";
      $hasil=$penambahan4;
    }else if ( $persen>$prosentase2 && $persen <=$prosentase3 ) {
        echo "0 =3";
        $hasil=$penambahan3;
      }
    else if ( $persen>$prosentase1 && $persen <=$prosentase2 ) {
        echo "0 =2";
        $hasil=$penambahan2;
      }
    else if ( $persen<=$prosentase1 ) {
        echo "0 =1";
        $hasil=$penambahan1;
      }
  }else {
    echo " masuk 22 $persen====$prosentase1 $prosentase2 $prosentase3 $prosentase4 \n";
    if ( $persen >$prosentase3 ) {
      echo "1 =3";

      $hasil=$penambahan3;
    }else if ( $persen>$prosentase1 && $persen <=$prosentase2 ) {
        echo "1 =2 ";
        $hasil=$penambahan2;
      }
    else if ( $persen<=$prosentase1 ) {
        echo "1 = 5 ";
        $hasil=$penambahan1;
      }

  }
  if ( $hasil=="" )
    $hasil=0;
  return $hasil;
}

function microtime_float() {
  list( $usec, $sec ) = explode( " ", microtime() );
  return (float) $usec + (float) $sec;
}


function log_penyusutan( $Aset_ID, $tableKib, $Kd_Riwayat, $tahun, $Data, $DBVAR ) {
  //select field dan value tabel kib

  $QueryKibSelect   = "SELECT * FROM $tableKib WHERE Aset_ID = '$Aset_ID'";
  $exequeryKibSelect = $DBVAR->query( $QueryKibSelect );
  $resultqueryKibSelect = $DBVAR->fetch_object( $exequeryKibSelect );

  $tmpField = array();
  $tmpVal = array();
  $sign = "'";
  $AddField = "action,changeDate,TglPerubahan,Kd_Riwayat,NilaiPerolehan_Awal,AkumulasiPenyusutan_Awal,NilaiBuku_Awal,PenyusutanPerTahun_Awal";
  $action = "Penyusutan_".$tahun."_".$Data['kodeSatker'];
  $TglPerubahan="$tahun-12-31";
  $changeDate = date( 'Y-m-d' );
  $NilaiPerolehan_Awal=0;
  /* $NilaiPerolehan_Awal = $Data['NilaiPerolehan_Awal'];
        if($NilaiPerolehan_Awal ==""||$NilaiPerolehan_Awal ==0){
            $NilaiPerolehan_Awal ="NULL";
        }*/
  $AkumulasiPenyusutan_Awal=$Data['AkumulasiPenyusutan_Awal'];
  if ( $AkumulasiPenyusutan_Awal==""||$AkumulasiPenyusutan_Awal=="0" ) {
    $AkumulasiPenyusutan_Awal="NULL";
  }
  $NilaiBuku_Awal = $Data['NilaiBuku_Awal'];
  if ( $NilaiBuku_Awal ==""||$NilaiBuku_Awal =="0" ) {
    $NilaiBuku_Awal ="NULL";
  }
  $PenyusutanPerTahun_Awal = $Data['PenyusutanPerTahun_Awal'];
  if ( $PenyusutanPerTahun_Awal ==""||$PenyusutanPerTahun_Awal =="0" ) {
    $PenyusutanPerTahun_Awal ="NULL";
  }
  foreach ( $resultqueryKibSelect as $key => $val ) {
    $tmpField[] = $key;
    if ( $val =='' ) {
      $tmpVal[] = $sign."NULL".$sign;
    }else {
      $tmpVal[] = $sign.addslashes( $val ).$sign;
    }
  }
  $implodeField = implode( ',', $tmpField );
  $implodeVal = implode( ',', $tmpVal );

  $QueryLog ="INSERT INTO log_$tableKib ($implodeField,$AddField) VALUES"
    . "      ($implodeVal,'$action','$changeDate','$TglPerubahan','$Kd_Riwayat','$NilaiPerolehan_Awal',$AkumulasiPenyusutan_Awal,"
    . "$NilaiBuku_Awal,$PenyusutanPerTahun_Awal)";
  $exeQueryLog = $DBVAR->query( $QueryLog ) or die( $DBVAR->error() );;


  return $tableLog;
}

function catatan_hasil_penyusutan( $data, $DBVAR ) {
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
  $exeQueryLog = $DBVAR->query( $query ) or die( $DBVAR->error() );;
}

function get_data_akumulasi_from_eksisting( $Aset_ID, $DBVAR ) {
  $query= "SELECT NilaiBuku,AkumulasiPenyusutan,UmurEkonomis,MasaManfaat FROM aset WHERE Aset_ID = '$Aset_ID' limit 1";
  $hasil= $DBVAR->query( $query );
  $data= $DBVAR->fetch_array( $hasil );
  $Akumulasi=$data['AkumulasiPenyusutan'];
  $UmurEkonomis=$data['UmurEkonomis'];
  $MasaManfaat=$data['MasaManfaat'];
  $NilaiBuku=$data['NilaiBuku'];
  return array( $Akumulasi, $UmurEkonomis, $MasaManfaat,$NilaiBuku );
}

function get_data_np_transfer( $Aset_ID, $log_id, $table_log, $DBVAR ) {
  $query_1="select NilaiPerolehan from $table_log where Aset_ID='$Aset_ID' and log_id > $log_id limit 1";
  $hasil= $DBVAR->query( $query );
  $data= $DBVAR->fetch_array( $hasil );
  $NP=0;
  $NP=$data['NilaiPerolehan'];
  if ( $NP==""||$NP=="0" ) {
    $query_1="select NilaiPerolehan from aset where Aset_ID='$Aset_ID'  limit 1";
    $hasil= $DBVAR->query( $query_1 );
    $data= $DBVAR->fetch_array( $hasil );
    $NP=$data['NilaiPerolehan'];
  }
  return $NP;
}

function get_NP_Aset_ID_Penambahan($Aset_ID_Penambahan,$log_id,$DBVAR){
		
		$queryceckTipe = "select TipeAset from aset where Aset_ID = '{$Aset_ID_Penambahan}'";
		 $hasil= $DBVAR->query( $queryceckTipe );
                 $resulTipe= $DBVAR->fetch_array( $hasil );
                  
                 $TipeAset=$resulTipe[TipeAset];
		
          	if($TipeAset == 'A'){
			$tabel = 'log_tanah';
		}elseif($TipeAset == 'B'){
			$tabel = 'log_mesin';
		}elseif($TipeAset == 'C'){
			$tabel = 'log_bangunan';
		}elseif($TipeAset == 'D'){
			$tabel = 'log_jaringan';
		}elseif($TipeAset == 'E'){
			$tabel = 'log_asetlain';
		}elseif($TipeAset == 'F'){
			$tabel = 'log_kdp';
		}
		
		$queryNpKp = "select NilaiPerolehan,Tahun from {$tabel} where Aset_ID_Penambahan ='$Aset_ID_Penambahan' and Kd_Riwayat = '28' 
					  and action like 'Sukses kapitalisasi Mutasi%' 
					  and log_id > {$log_id} order by log_id asc limit 1";
		 //pr($queryNpKp);
                $hasil= $DBVAR->query( $queryNpKp );
                while( $valueNpKp= $DBVAR->fetch_array( $hasil )){
		
				$NPKptls=$valueNpKp[NilaiPerolehan];
                                $Tahun=$valueNpKp[Tahun];
			}
		
	return array($NPKptls,$Tahun);
	}
        
 function get_log($tableLog,$TglPerubahan_awal,$Aset_ID,$log_id,$DBVAR){
      $query_perubahan="select Aset_ID_Penambahan,`action`,
                      Aset_ID,`noRegister`,
                      kd_riwayat,log_id,kodeKelompok,kodeSatker,
                      Aset_ID,NilaiPerolehan,NilaiPerolehan_Awal,
                      Tahun,Kd_Riwayat,
                      (NilaiPerolehan-NilaiPerolehan_Awal) as selisih,
                      AkumulasiPenyusutan,PenyusutanPerTahun,NilaiBuku,
                      MasaManfaat,UmurEkonomis,TahunPenyusutan
                      from $tableLog where TglPerubahan>'$TglPerubahan_awal'
                       and kd_riwayat in (2,21,28,7)
                    and Aset_ID='$Aset_ID' and log_id='$log_id' limit 1";
      $count=0;
      $qlog=$DBVAR->query( $query_perubahan ) or die( $DBVAR->error() );
      $kapitalisasi=0;
      $tmp_nilai_perolehan=0;
      $Data_Log=$DBVAR->fetch_object( $qlog );
               
      return $Data_Log;
 }
 ?>
