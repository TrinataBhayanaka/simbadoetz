<?php

$CONFIG['default']['db_host'] = 'localhost';
$CONFIG['default']['db_user'] = 'root';
$CONFIG['default']['db_pass'] = 'new-password';
$CONFIG['default']['db_name'] = 'simbada_2014_full_v1_02des2015';
$link = mysql_connect($CONFIG['default']['db_host'], $CONFIG['default']['db_user'], $CONFIG['default']['db_pass']) or die("Koneksi Database gagal");
$db = mysql_select_db($CONFIG['default']['db_name']);

$tgl_perubahan='2014-12-31';
$kodeSatker='04.02.01.01';

/*$query_4 ="create temporary table mesin_ori as select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from mesin a where a.TglPerolehan <='2014-12-31' AND a.TglPembukuan <='2014-12-31' AND a.kodeSatker = '04.02.01.01' ";

$query_5 ="ALTER table mesin_ori add primary key(Mesin_ID)";

$query_6 ="replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.
TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) from log_mesin a inner join mesin t on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='2014-12-31' AND a.TglPerubahan >'2014-12-31' AND a.TglPembukuan <='2014-12-31' AND a.kodeSatker = '04.02.01.01' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc";

$query_7 ="replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, 
a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from view_mutasi_mesin a inner join mesin t on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='2014-12-31' AND a.TglSKKDH >'2014-12-31' AND a.TglPembukuan <='2014-12-31' AND a.SatkerTujuan = '04.02.01.01' order by a.TglSKKDH desc";

$AllTableTemp = array($query_4,$query_5,$query_6,$query_7);*/

$query_0 ="create temporary table tanahView as select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah, a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.PenyusutanPerTahun from tanah a where a.TglPerolehan <='$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' ";
$query_1 ="ALTER table tanahView add primary key(Tanah_ID)";
$query_2 ="replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah, NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, AkumulasiPenyusutan, PenyusutanPerTahun) select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah, a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.
MasaManfaat, a.AkumulasiPenyusutan, a.PenyusutanPerTahun from log_tanah a inner join tanah t on t.Aset_ID=a.Aset_ID inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglPerubahan >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc";
$query_3 ="replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah, NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, AkumulasiPenyusutan, PenyusutanPerTahun) select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah, a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.
BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.PenyusutanPerTahun from view_mutasi_tanah a inner join tanah t on t.Aset_ID=a.Aset_ID inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.SatkerTujuan = '04.02.01.01' order by a.TglSKKDH desc";
$query_4 ="create temporary table mesin_ori as select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from mesin a where a.TglPerolehan <='$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01'  ";
$query_5 ="ALTER table mesin_ori add primary key(Mesin_ID)";
$query_6 ="replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.
TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) from log_mesin a inner join mesin t on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglPerubahan >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc";
$query_7 ="replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri, NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, 
a.NoSeri, a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from view_mutasi_mesin a inner join mesin t on t.Aset_ID=a.Aset_ID inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.SatkerTujuan = '04.02.01.01' order by a.TglSKKDH desc";
$query_8 ="create temporary table bangunan_ori as select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from bangunan a where a.TglPerolehan <='$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' ";
$query_9 ="ALTER table bangunan_ori add primary key(Bangunan_ID)";
$query_10 ="replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.
LangitLangit, a.Atap, a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) from log_bangunan a inner join bangunan t on t.Aset_ID=a.Aset_ID inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglPerubahan >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc";
$query_11 ="replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.
JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from view_mutasi_bangunan a inner join bangunan t on t.Aset_ID=a.Aset_ID inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.SatkerTujuan = '04.02.01.01' order by a.TglSKKDH desc";
$query_12 ="create temporary table jaringan_ori as select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from jaringan a where a.TglPerolehan <='$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01'  ";
$query_13 ="ALTER table jaringan_ori add primary key(Jaringan_ID)";
$query_14 ="replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan,
 a.MasaManfaat, if(a.AkumulasiPenyusutan_Awal is not null,a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) from log_jaringan a inner join jaringan t on t.Aset_ID=a.Aset_ID inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglPerubahan >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc";
$query_15 ="replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, 
a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from view_mutasi_jaringan a inner join jaringan t on t.Aset_ID=a.Aset_ID inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.SatkerTujuan = '04.02.01.01' order by a.TglSKKDH desc";
$query_16 ="create temporary table asetlain_ori as select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from asetlain a where a.TglPerolehan <='$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' ";
$query_17 ="ALTER table asetlain_ori add primary key(AsetLain_ID)";
$query_18 ="replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from log_asetlain a inner join asetlain t on t.Aset_ID=a.
Aset_ID inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglPerubahan >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc";
$query_19 ="replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun) select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from 
view_mutasi_asetlain a inner join asetlain t on t.Aset_ID=a.Aset_ID inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.SatkerTujuan = '04.02.01.01' order by a.TglSKKDH desc";
$query_20 ="create temporary table kdp_ori as select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID from kdp a where a.TglPerolehan <='$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01'  ";
$query_21 ="ALTER table kdp_ori add primary key(KDP_ID)";
$query_22 ="replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID) select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID from log_kdp a inner join kdp t on t.Aset_ID=a.Aset_ID inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID 
!= 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglPerubahan >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.kodeSatker = '04.02.01.01' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc";
$query_23 ="replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID) select a.KDP_ID, a.Aset_ID, a.kodeKelompok,a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID from view_mutasi_kdp a inner join kdp t on t.Aset_ID=a.Aset_ID inner join kdp t_2 on 
t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0 where a.TglPerolehan <='$tgl_perubahan' AND a.TglSKKDH >'$tgl_perubahan' AND a.TglPembukuan <='$tgl_perubahan' AND a.SatkerTujuan = '04.02.01.01' order by a.TglSKKDH desc";

$AllTableTemp = array($query_0,$query_1,$query_2,$query_3,
					  $query_4,$query_5,$query_6,$query_7,
					  $query_8,$query_9,$query_10,$query_11,
					  $query_12,$query_13,$query_14,$query_15,
					  $query_16,$query_17,$query_18,$query_19,
					  $query_20,$query_21,$query_22,$query_23);
for ($i = 0; $i < count($AllTableTemp); $i++)
{
	/*echo "query_$i =".$AllTableTemp[$i];
	echo "<br>";
	echo "<br>";*/
	// exit;
	$resultQuery = mysql_query($AllTableTemp[$i]) or die (mysql_error());
}

//$data = array('tanah','mesin','bangunan','jaringan','asetlain');
$data = array('tanahView','mesin_ori','bangunan_ori','jaringan_ori','asetlain_ori');
 //$data = array('tanahView');

$i=0;
foreach ($data as $gol) {

if($gol=="mesin_ori")
$query_where="  and StatusTampil=1 and ( (TglPerolehan < '2008-01-01' or kodeKa=1) or 
                                     (TglPerolehan >= '2008-01-01'and NilaiPerolehan >=300000) or kodeKa=1) 
                                     and kondisi != '3' and kodeLokasi like '12%' ";
else if($gol=="bangunan_ori")
$query_where=" and StatusTampil=1 and ( (TglPerolehan < '2008-01-01' or kodeKa=1) or 
                                     (TglPerolehan >= '2008-01-01'and NilaiPerolehan >=10000000) or kodeKa=1) 
                                     and kondisi != '3' and kodeLokasi like '12%' ";
else if($gol=="tanahView")
     $query_where=" and StatusTampil=1 and kodeLokasi like '12%' and TglPerolehan >='0000-00-00' and TglPerolehan <='2014-12-31' and TglPembukuan >='0000-00-00' and TglPembukuan <='2014-12-31' ";

     else
          
$query_where=" and StatusTampil=1 and kondisi != '3' and kodeLokasi like '12%' and TglPerolehan >='0000-00-00' and TglPerolehan <='2014-12-31' and TglPembukuan >='0000-00-00' and TglPembukuan <='2014-12-31' ";

     //untuk golongan
     $sql = "select SUBSTRING_INDEX(kodeKelompok,'.',1) as Golongan,
sum(NilaiPerolehan),count(Aset_ID),
(select Uraian from kelompok 
where Golongan=SUBSTRING_INDEX(kodeKelompok,'.',1) 
and bidang is null and kelompok is null 
and sub is null and 
subsub is null
) as Uraian,
Status_Validasi_barang,kodeSatker from $gol m
 where Status_Validasi_barang=1  $query_where
group by golongan";

     $sql = "select SUBSTRING_INDEX(kodeKelompok,'.',1) as Golongan,
sum(NilaiPerolehan),count(Aset_ID),
(select Uraian from kelompok where kode=SUBSTRING_INDEX(kodeKelompok,'.',1)) as Uraian,
Status_Validasi_barang,kodeSatker from $gol m
 where Status_Validasi_barang=1  $query_where 
group by golongan";
 //echo "<pre>$sql </pre>";
     $resultparentGol = mysql_query($sql);
     
$data=array();
     while ($data_gol = mysql_fetch_array($resultparentGol)) {

          $kode_golongan = $data_gol[Golongan];
         // $data_gol['Bidang']=  bidang($kode_golongan,$gol);
		/* echo "<pre>";
		 print_r($i);
		 echo "</pre>";*/
        $data[$i]=$data_gol;
        $data[$i]['Bidang'] = bidang($kode_golongan,$gol,$query_where);
        /*echo "<pre>";
		 print_r($data);
		 echo "</pre>";*/
		 $head="<table border=1>
		<tr>
			<td colspan='5'>Kode</td>
			<td>Uraian</td>
			<td colspan='5'>Jumlah</td>
			<td colspan='5'>NilaiPerolehan</td>
		</tr>";
foreach($data as $gol)
{	
$body.="<tr>
		<td>{$gol['Golongan']}</td>
                           <td colspan='4'>&nbsp;</td>
		<td>{$gol['Uraian']}</td>
		<td>{$gol['count(Aset_ID)']}</td>
                              <td colspan='4'>&nbsp;</td>
		<td>{$gol['sum(NilaiPerolehan)']}</td>
                         <td colspan='4'>&nbsp;</td>
</tr>";	

	foreach($gol['Bidang'] as $bidang)
	{	
	$body.="<tr>
                                         <td >&nbsp;</td>    
			<td>{$bidang['Bidang']}</td>
                                         <td colspan='3'>&nbsp;</td>
			<td>{$bidang['Uraian']}</td>
                                        <td >&nbsp;</td>
			<td>{$bidang['count(Aset_ID)']}</td>
                                        <td colspan='3'>&nbsp;</td>
                                        <td>&nbsp;</td>
			<td>{$bidang['sum(NilaiPerolehan)']}</td>
                                        <td colspan='3'>&nbsp;</td>
	</tr>";	
		foreach($bidang['Kelompok'] as $Kelompok)
		{	
		$body.="<tr>
                                                       <td colspan='2'>&nbsp;</td>
				<td>{$Kelompok['kelompok']}</td>
                                                       <td colspan='2'>&nbsp;</td>
				<td>{$Kelompok['Uraian']}</td>
                                                       <td colspan='2'>&nbsp;</td>
				<td>{$Kelompok['count(Aset_ID)']}</td>
                                                       <td colspan='2'>&nbsp;</td>
                                                        <td colspan='2'>&nbsp;</td>
				<td>{$Kelompok['sum(NilaiPerolehan)']}</td>
                                                       <td colspan='2'>&nbsp;</td>
		</tr>";
			foreach($Kelompok['Sub'] as $Sub)
			{	
			$body.="<tr>
                                                                    <td colspan='3'>&nbsp;</td>
					<td>{$Sub['sub']}</td>
                                                                      <td >&nbsp;</td>
					<td>{$Sub['Uraian']}</td>
					<td colspan='3'>&nbsp;</td>
                                                                      <td>{$Sub['count(Aset_ID)']}</td>
                                                                           <td>&nbsp;</td>
                                                                           <td colspan='3'>&nbsp;</td>
					<td>{$Sub['sum(NilaiPerolehan)']}</td>
                                                                 <td>&nbsp;</td>
			</tr>";
				foreach($Sub['SubSub'] as $SubSub)
				{	
				$body.="<tr>
                                                                                <td colspan='4'>&nbsp;</td>
						<td>{$SubSub['subsub']}</td>
						<td>{$SubSub['Uraian']}</td>
                                                                                <td colspan='4'>&nbsp;</td>
						<td>{$SubSub['count(Aset_ID)']}</td>
                                         <td colspan='4'>&nbsp;</td>
						<td>{$SubSub['sum(NilaiPerolehan)']}</td>
				</tr>";
				}
			}
		}
	
	}
}	
$foot="</table>";

$html =$head.$body.$foot;

		
     }
	  $i++;
	   // exit;
}


function bidang($kode_golongan,$gol,$query_where) {

      $sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',2) as Bidang,
                                   sum(NilaiPerolehan),count(Aset_ID),
                                   (select Uraian from kelompok 
                                   where kode= SUBSTRING_INDEX(kodeKelompok,'.',2) 
                                   ) as Uraian,
                                   Status_Validasi_barang,kodeSatker from $gol m
                                    where kodeKelompok like '$kode_golongan%' and
                                         Status_Validasi_barang=1  $query_where 
                                
                                    and kodeSatker ='04.02.01.01'
                                   group by bidang ";
         // echo "<pre>$sql </pre>";
$data=array();
$a=0;
          $resultparentBidang = mysql_query($sql) or die(mysql_error());
          while ($data_bidang = mysql_fetch_array($resultparentBidang)) {
               $kode_kelompok = $data_bidang[Bidang];
            
                $data[$a]=$data_bidang;
                    $data[$a]['Kelompok'] =kelompok($kode_kelompok, $gol,$query_where);
                   // $data[$i]['Kelompok'] ="2";
                    // echo "$i $kode_kelompok  <br/>";
                    $a++;
                   
          }
          return $data;
}

function kelompok($kode_bidang,$gol,$query_where) {

     $sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',3) as kelompok,
                                             sum(NilaiPerolehan),count(Aset_ID),
                                             (select Uraian from kelompok 
                                             where kode= SUBSTRING_INDEX(kodeKelompok,'.',3) 
                                             ) as Uraian,
                                             Status_Validasi_barang,kodeSatker from $gol m
                                              where kodeKelompok like '$kode_bidang%' and
                                                   Status_Validasi_barang=1 $query_where
                                              and kodeSatker ='04.02.01.01'
                                             group by kelompok";
           //  echo "<pre>$sql</pre>";
        $data=array();
$b=0;
               $resultparentKelompok = mysql_query($sql) or die(mysql_error());
               while ($data_kelompok = mysql_fetch_array($resultparentKelompok)) {
                  
                    $kode_kelompok = $data_kelompok[kelompok];
                     $data[$b]=$data_kelompok;
                  $data[$b]['Sub'] =sub($kode_kelompok,$gol,$query_where);
                  //    echo "$i $kode_kelompok  <br/>";
                    $b++;
               }
                 return $data;
}

function sub($kodeKelompok,$gol,$query_where) {

     
     $sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',4) as sub,
                                                            sum(NilaiPerolehan),count(Aset_ID),
                                                            (select Uraian from kelompok 
                                                            where kode= SUBSTRING_INDEX(kodeKelompok,'.',4) 
                                                            ) as Uraian,
                                                            Status_Validasi_barang,kodeSatker from $gol m
                                                             where kodeKelompok like '$kodeKelompok%' and
                                                                  Status_Validasi_barang=1  $query_where
                                                             and kodeSatker ='04.02.01.01'
                                                            group by sub";
     // echo "<pre>$sql</pre>";
    $data=array();
$c=0;
     $resultparentSub = mysql_query($sql) or die(mysql_error());
     while ($data_sub = mysql_fetch_array($resultparentSub)) {

          $kode_sub = $data_sub[sub];
            $data[$c]=$data_sub;
             // echo "$i $kode_sub  <br/>";
                    $data[$c]['SubSub'] =subsub($kode_sub,$gol,$query_where);
                    $c++;
     }
       return $data ;
}

function subsub($kode_sub,$gol,$query_where) {

     $sql = "select  SUBSTRING_INDEX(kodeKelompok,'.',5) as subsub,
               sum(NilaiPerolehan),count(Aset_ID),
               (select Uraian from kelompok 
               where kode= SUBSTRING_INDEX(kodeKelompok,'.',5) 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                     Status_Validasi_barang=1  $query_where
                and kodeSatker ='04.02.01.01'
               group by subsub";
     //echo "<pre>$sql </pre>";
     $resultparentSubSub = mysql_query($sql) or die(mysql_error());
     $data = array();
     while ($data_subsub = mysql_fetch_array($resultparentSubSub)) {

          $data[] = $data_subsub;
     }
     return $data;
}

$waktu=date("d-m-y_h:i:s");
	$filename ="Rincian_barang_ke_neraca_$waktu.xls";
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);

echo $html; 
/*echo "<pre>";
print_r($data);
echo "</pre>";*/

/*$head="<table border=1>
		<tr>
			<td>Kode</td>
			<td>Uraian</td>
			<td>Jumlah</td>
			<td>NilaiPerolehan</td>
		</tr>";
foreach($data as $gol)
{	
$body.="<tr>
		<td>{$gol['Golongan']}</td>
		<td>{$gol['Uraian']}</td>
		<td>{$gol['count(Aset_ID)']}</td>
		<td>{$gol['sum(NilaiPerolehan)']}</td>
</tr>";	

	foreach($gol['Bidang'] as $bidang)
	{	
	$body.="<tr>
			<td>{$bidang['Bidang']}</td>
			<td>{$bidang['Uraian']}</td>
			<td>{$bidang['count(Aset_ID)']}</td>
			<td>{$bidang['sum(NilaiPerolehan)']}</td>
	</tr>";	
		foreach($bidang['Kelompok'] as $Kelompok)
		{	
		$body.="<tr>
				<td>{$Kelompok['kelompok']}</td>
				<td>{$Kelompok['Uraian']}</td>
				<td>{$Kelompok['count(Aset_ID)']}</td>
				<td>{$Kelompok['sum(NilaiPerolehan)']}</td>
		</tr>";
			foreach($Kelompok['Sub'] as $Sub)
			{	
			$body.="<tr>
					<td>{$Sub['sub']}</td>
					<td>{$Sub['Uraian']}</td>
					<td>{$Sub['count(Aset_ID)']}</td>
					<td>{$Sub['sum(NilaiPerolehan)']}</td>
			</tr>";
				foreach($Sub['SubSub'] as $SubSub)
				{	
				$body.="<tr>
						<td>{$SubSub['subsub']}</td>
						<td>{$SubSub['Uraian']}</td>
						<td>{$SubSub['count(Aset_ID)']}</td>
						<td>{$SubSub['sum(NilaiPerolehan)']}</td>
				</tr>";
				}
			}
		}
	
	}
}	
$foot="</table>";

$html =$head.$body.$foot;
echo $html; 
exit;*/


?>