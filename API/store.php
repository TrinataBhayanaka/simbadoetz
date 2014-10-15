<?php

class STORE extends DB
{
    
    
    public function store_data_aset_pengadaan($parameter)
    {
        
        $satker_id=$parameter['POST']['skpd_id'];
        $lokasi_id=$parameter['POST']['lokasi_id'];
        $kelompok_id=$parameter['POST']['kelompok_id3'];
        
        $p_noreg_pemilik=$parameter['POST']['p_noreg_pemilik'];
        $p_noreg_satker=$parameter['POST']['p_noreg_satker'];
        $p_noreg_unit=$parameter['POST']['p_noreg_unit'];
        $p_tahun=$parameter['POST']['Tahun'];
        $p_noreg_info_kel=$parameter['POST']['p_noreg_info_kel'];
        $p_noreg_noreg = $p_noreg_pemilik. '.'.$KODE_PROVINSI.'.'.$KODE_KABUPATEN.'.'.$p_noreg_satker.'.'.$p_tahun.'.'.'00';
        $p_noreg_noreg2=$parameter['POST']['p_noreg_noreg2'];
        $p_perolehan_caraperolehan=$parameter['POST']['p_perolehan_caraperolehan'];
        $p_penghapusan_aset=$parameter['POST']['p_penghapusan_aset'];
        
        //
        
        $p_skpd=$parameter['POST']['p_skpd'];
        $p_kodeaset=$parameter['POST']['p_kodeaset'];
        $p_nama_aset=$parameter['POST']['p_nama_aset'];
        $p_ruangan=$parameter['POST']['p_ruangan'];
        $p_jenisbarang=$parameter['POST']['p_jenisbarang'];
        $p_jenisaset=$parameter['POST']['p_jenisaset'];
        $p_bersejarah=$parameter['POST']['p_bersejarah'];
        
        //golongan tanah
        $p_gtanah_luaskeseluruhan=$parameter['POST']['p_gtanah_luaskeseluruhan'];
        $p_gtanah_luasbangunan=$parameter['POST']['p_gtanah_luasbangunan'];
        $p_gtanah_saranalingkungn=$parameter['POST']['p_gtanah_saranalingkungn'];
        $p_gtanah_tanahkosong=$parameter['POST']['p_gtanah_tanahkosong'];
        $p_gtanah_hakpakai=$parameter['POST']['p_gtanah_hakpakai'];
        $p_gtanah_nosertifikat=$parameter['POST']['p_gtanah_nosertifikat'];
        $p_gtanah_tglsertifika = $parameter['POST']['p_gtanah_tglsertifikat']; ///bulan/tanggal/tahun 
        $datee = explode('/', $p_gtanah_tglsertifika); ///
        $p_gtanah_tglsertifikat = $datee[2].$datee[1].$datee[0];             
        $p_gtanah_penggunaan=$parameter['POST']['p_gtanah_penggunaan'];           
        $p_gtanah_batasutara=$parameter['POST']['p_gtanah_batasutara'];
        $p_gtanah_batasselatan=$parameter['POST']['p_gtanah_batasselatan'];
        $p_gtanah_batasbarat=$parameter['POST']['p_gtanah_batasbarat'];
        $p_gtanah_batastimur=$parameter['POST']['p_gtanah_batastimur'];
        //golongan mesin
        $p_gmsn_peralatan=$parameter['POST']['p_gmsn_peralatan'];
        $p_gmsn_tipemodel=$parameter['POST']['p_gmsn_tipemodel'];
        $p_gmsn_ukuran=$parameter['POST']['p_gmsn_ukuran'];
        $p_gmsn_silinder=$parameter['POST']['p_gmsn_silinder'];
        $p_gmsn_merek=$parameter['POST']['p_gmsn_merek'];
        $p_gmsn_jumlahmesin=$parameter['POST']['p_gmsn_jumlahmesin'];
        $p_gmsn_material=$parameter['POST']['p_gmsn_material'];
        $p_gmsn_noseripabrik=$parameter['POST']['p_gmsn_noseripabrik'];
        $p_gmsn_rangka=$parameter['POST']['p_gmsn_rangka'];
        $p_gmsn_nomesin=$parameter['POST']['p_gmsn_nomesin'];
        $p_gmsn_nopolisi=$parameter['POST']['p_gmsn_nopolisi'];
        $p_gmsn_tglstn = $parameter['POST']['p_gmsn_tglstnk']; ///bulan/tanggal/tahun 
        $datef = explode('/', $p_gmsn_tglstn); ///
        $p_gmsn_tglstnk = $datef[2].$datef[1].$datef[0]; 
        $p_gmsn_nobpkb=$parameter['POST']['p_gmsn_nobpkb'];
        $p_gmsn_tglbpk = $parameter['POST']['p_gmsn_tglbpkb']; ///bulan/tanggal/tahun 
        $dateg = explode('/', $p_gmsn_tglbpk); ///
        $p_gmsn_tglbpkb = $dateg[2].$dateg[1].$dateg[0]; 
        $p_gmsn_nodokumenlain=$parameter['POST']['p_gmsn_nodokumenlain'];
        $p_gmsn_tgldokumenlai = $parameter['POST']['p_gmsn_tgldokumenlain']; ///bulan/tanggal/tahun 
        $dateh = explode('/', $p_gmsn_tgldokumenlai); ///
        $p_gmsn_tgldokumenlain = $dateh[2].$dateh[1].$dateh[0]; 
        
        $p_gmsn_tahunpembutan=$parameter['POST']['p_gmsn_tahunpembutan'];
        $p_gmsn_bahanbakar=$parameter['POST']['p_gmsn_bahanbakar'];
        $p_gmsn_pabrik=$parameter['POST']['p_gmsn_pabrik'];
        $p_gmsn_negaraasal=$parameter['POST']['p_gmsn_negaraasal'];
        $p_gmsn_kapasitas=$parameter['POST']['p_gmsn_kapasitas'];
        $p_gmsn_bobot=$parameter['POST']['p_gmsn_bobot'];
        $p_gmsn_negaraperakitan=$parameter['POST']['p_gmsn_negaraperakitan'];
        //golongan gedung
        $p_gdg_konstruksi=$parameter['POST']['p_gdg_konstruksi'];
        $p_gdg_konstruksib=$parameter['POST']['p_gdg_konstruksib'];
        $p_gdg_jumlah_lantai=$parameter['POST']['p_gdg_jumlah_lantai'];
        $p_gdg_luaslantai=$parameter['POST']['p_gdg_luaslantai'];
        $p_gdg_dinding=$parameter['POST']['p_gdg_dinding'];
        $p_gdg_lantai=$parameter['POST']['p_gdg_lantai'];
        $p_gdg_plafon=$parameter['POST']['p_gdg_plafon'];
        $p_gdg_atap=$parameter['POST']['p_gdg_atap'];
        $p_gdg_nodokumen=$parameter['POST']['p_gdg_nodokumen'];
        
        $p_gdg_tglpemakaia = $parameter['POST']['p_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
        $datei = explode('/', $p_gdg_tglpemakaia); ///
        $p_gdg_tglpemakaian = $datei[2].$datei[1].$datei[0];   
        $p_gdg_ststustanah=$parameter['POST']['p_gdg_ststustanah'];
        $p_gdg_asettanah=$parameter['POST']['p_gdg_asettanah'];
        $p_gdg_kodetanah=$parameter['POST']['p_gdg_kodetanah'];
        $p_gdg_no_imb=$parameter['POST']['p_gdg_no_imb'];
        $p_gdg_tglim = $parameter['POST']['p_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
        $datej = explode('/', $p_gdg_tglim); ///
        $p_gdg_tglimb = $datej[2].$datej[1].$datej[0];   
        //golongan jalan
        $p_gjal_konstruksi=$parameter['POST']['p_gjal_konstruksi'];
        $p_gjal_panjang=$parameter['POST']['p_gjal_panjang'];
        $p_gjal_lebar=$parameter['POST']['p_gjal_lebar'];
        $p_gjal_luas=$parameter['POST']['p_gjal_luas'];
        $p_gjal_nodokumen=$parameter['POST']['p_gjal_nodokumen'];
        $p_gjal_tgldookumen=$parameter['POST']['p_gjal_tgldookumen'];
        $p_gjal_tglpemakaian=$parameter['POST']['p_gjal_tglpemakaian'];
        $p_statustanah=$parameter['POST']['p_statustanah'];
        $p_gjal_pilihaset_tanah=$parameter['POST']['p_gjal_pilihaset_tanah'];
        $p_gjal_nomorkode_tanah=$parameter['POST']['p_gjal_nomorkode_tanah'];
        //golongan aset tetap lainnya
        //golongan buku
        $p_gol5_judul=$parameter['POST']['p_gol5_judul'];
        $p_gol5_asal=$parameter['POST']['p_gol5_asal'];
        $p_gol5_pencipta=$parameter['POST']['p_gol5_pengarang'];
        $p_gol5_penerbit=$parameter['POST']['p_gol5_penerbit'];
        $p_gol5_spesifikasi=$parameter['POST']['p_gol5_spesifikasi'];
        $p_gol5_asetlain_tahunterbit=$parameter['POST']['p_gol5_asetlain_tahunterbit'];
        $p_gol5_isbn=$parameter['POST']['p_gol5_isbn'];
        $p_gol5_kuantitas1=$parameter['POST']['p_gol5_kuantitas3'];
        $p_gol5_satuan1=$parameter['POST']['p_gol5_satuan3'];
        //golongan barang kesenian
        $p_gol5_judul1=$parameter['POST']['p_gol5_judul1'];
        $p_gol5_asal=$parameter['POST']['p_gol5_asal'];
        $p_gol5_pencipta=$parameter['POST']['p_gol5_pencipta'];
        $p_gol5_bahan=$parameter['POST']['p_gol5_bahan'];
        $p_gol5_kuantitas1=$parameter['POST']['p_gol5_kuantitas1'];
        $p_gol5_satuan1=$parameter['POST']['p_gol5_satuan1'];
        //golongan hewan
        $p_gol5_jenis=$parameter['POST']['p_gol5_jenis'];
        $p_gol5_ukuran=$parameter['POST']['p_gol5_ukuran'];
        $p_gol5_kuantitas1=$parameter['POST']['p_gol5_kuantitas2'];
        $p_gol5_satuan1=$parameter['POST']['p_gol5_satuan2'];
        //golongan konstruksi
        $p_gjal_konstruksi1=$parameter['POST']['p_gjal_konstruksi1'];
        $p_gjal_panjang=$parameter['POST']['p_gjal_panjang'];
        $p_gol6_luas_lantai=$parameter['POST']['p_gol6_luas_lantai'];
        $tanggal_pembanguna = $parameter['POST']['tanggal_pembangunan']; ///bulan/tanggal/tahun 
        $datea = explode('/', $tanggal_pembanguna); ///
        $tanggal_pembangunan = $datea[2].$datea[1].$datea[0];   
        $p_gol6_statustanah=$parameter['POST']['p_gol6_statustanah'];
        $p_gol6_pilih_asettanah=$parameter['POST']['p_gol6_pilih_asettanah'];
        //golongan persediaan
        $p_gol7_kuantitas4=$parameter['POST']['p_gol7_kuantitas4'];
        $p_gol7_satuan4=$parameter['POST']['p_gol7_satuan4'];
        
        //lokasi
        
        $p_alamat=$parameter['POST']['p_alamat'];
        $p_rt=$parameter['POST']['p_rt'];
        $p_desa=$parameter['POST']['p_desa'];
        $p_kecamatan=$parameter['POST']['p_kecamatan'];
        $p_kabupaten=$parameter['POST']['p_kabupaten'];
        $p_provinsi=$parameter['POST']['p_provinsi'];
        $lokasilengkap = $p_alamat. ' Rt '.$p_rt.' Desa '.$p_desa.' Kecamatan '.$p_kecamatan.' Kabupaten '.$p_kabupaten.' Provinsi '.$p_provinsi;
        
        
        $p_koordinat_bujur_a=$parameter['POST']['p_koordinat_bujur_a'];
        $p_koordinat_bujur_b=$parameter['POST']['p_koordinat_bujur_b'];
        $p_koordinat_bujur_c=$parameter['POST']['p_koordinat_bujur_c'];
        $p_koordinat_bujur_d=$parameter['POST']['p_koordinat_bujur_d'];
        $p_koordinat_lintang_a=$parameter['POST']['p_koordinat_lintang_a'];
        $p_koordinat_lintang_b=$parameter['POST']['p_koordinat_lintang_b'];
        $p_koordinat_lintang_c=$parameter['POST']['p_koordinat_lintang_c'];
        $p_koordinat_lintang_d=$parameter['POST']['p_koordinat_lintang_d'];
        $p_koordinat = $p_koordinat_bujur_a. '.'.$p_koordinat_bujur_b.'.'.$p_koordinat_bujur_c.'.'.$p_koordinat_bujur_d.'.'.$p_koordinat_lintang_a.'.'.$p_koordinat_lintang_b.'.'.$p_koordinat_lintang_c.'.'.$p_koordinat_lintang_d;
        
        //perolehan aset
        //off budget
        $p_perolehan_ket_asalusul=$parameter['POST']['p_perolehan_ket_asalusul'];
        $p_perolehan_tglperoleha = $parameter['POST']['p_perolehan_tglperolehan']; ///bulan/tanggal/tahun 
        $datet = explode('/', $p_perolehan_tglperoleha); ///
        $p_perolehan_tglperolehan = $datet[2].$datet[1].$datet[0];   
        
        
        $p_perolehan_thnperolehan=$parameter['POST']['p_perolehan_thnperolehan'];
        $p_perolehan_nilai=$parameter['POST']['p_perolehan_nilai'];
        //budget
        $p_pengadaan_nokontrak=$parameter['POST']['p_pengadaan_nokontrak'];
        $p_pengadaan_nilaikontrak=$parameter['POST']['p_pengadaan_nilaikontrak'];
        $p_pengadaan_tglkontra=$parameter['POST']['p_pengadaan_tglkontrak'];
          $datedz = explode('/',$p_pengadaan_tglkontra); ///
        $p_pengadaan_tglkontrak = $datedz[2].$datedz[1].$datedz[0];   
        $p_pengadaan_pekerjaan=$parameter['POST']['p_pengadaan_pekerjaan'];
        $p_pengadaan_kontraktor=$parameter['POST']['p_pengadaan_kontraktor'];
        $p_pengadaan_sumberdana=$parameter['POST']['p_pengadaan_sumberdana'];
        $p_pengadaan_nosp2d=$parameter['POST']['p_pengadaan_nosp2d'];
        $p_pengadaan_tglsp2d=$parameter['POST']['p_pengadaan_tglsp2d'];
        $p_pengadaan_tglsp2d=$parameter['POST']['p_pengadaan_tglsp2d'];
        $p_pengadaan_mataanggaran=$parameter['POST']['p_pengadaan_mataanggaran'];
        //hibah
        $p_pengadaan_nilaisp2d=$parameter['POST']['p_pengadaan_nilaisp2d'];
        $p_hibah_pemberi=$parameter['POST']['p_hibah_pemberi'];
        $p_hibah_nobbast=$parameter['POST']['p_hibah_nobbast'];
        $p_hibah_tglbas = $parameter['POST']['p_hibah_tglbast']; ///bulan/tanggal/tahun 
        $daten = explode('/', $p_hibah_tglbas); ///
        $p_hibah_tglbas= $daten[2].$daten[1].$daten[0]; 
        $p_hibah_namapertama=$parameter['POST']['p_hibah_namapertama'];
        $p_hibah_jabatan_pertama=$parameter['POST']['p_hibah_jabatan_pertama'];
        $p_hibah_nippertama=$parameter['POST']['p_hibah_nippertama'];
        $p_hibah_namakedua=$parameter['POST']['p_hibah_namakedua'];
        $p_hibah_jabatan_kedua=$parameter['POST']['p_hibah_jabatan_kedua'];
        $p_hibah_nipkedua=$parameter['POST']['p_hibah_nipkedua'];
        //keputusanPengadilan//
        $p_pengadilan_no_pengadilan=$parameter['POST']['p_pengadilan_no_pengadilan'];
        $p_pengadilan_jenisaset=$parameter['POST']['p_pengadilan_jenisaset'];
        $p_pengadilan_asalaset=$parameter['POST']['p_pengadilan_asalaset'];
        $p_pengadilan_keterangan=$parameter['POST']['p_pengadilan_keterangan'];
        
        
        //keputusan UUD//
        $p_uud_no_uud=$parameter['POST']['p_uud_no_uud'];
        $p_uud_jenisaset=$parameter['POST']['p_uud_jenisaset'];
        $p_uud_asalaset=$parameter['POST']['p_uud_asalaset'];
        $p_uud_keterangan=$parameter['POST']['p_uud_keterangan'];
        
        //keterangan tambahan
        $p_keterangantambahan=$parameter['POST']['p_keterangantambahan'];
        
        //penghapusan
        //pemindahtanganan
        $p_p_tangan_peruntukan=$parameter['POST']['p_p_tangan_peruntukan'];
        $p_p_tangan_nobasp=$parameter['POST']['p_p_tangan_nobasp'];
        $p_p_tangan_tglbas = $parameter['POST']['p_p_tangan_tglbasp']; ///bulan/tanggal/tahun 
        $datek = explode('/', $p_p_tangan_tglbas); ///
        $p_p_tangan_tglbasp = $datek[2].$datek[1].$datek[0];   
        $p_p_tangan_namapertama=$parameter['POST']['p_p_tangan_namapertama'];
        $p_p_tangan_jbtnpertama=$parameter['POST']['p_p_tangan_jbtnpertama'];
        $p_p_tangan_nippertama=$parameter['POST']['p_p_tangan_nippertama'];
        $p_p_tangan_lokasipertama=$parameter['POST']['p_p_tangan_lokasipertama'];
        $p_p_tangan_namakedua=$parameter['POST']['p_p_tangan_namakedua'];
        $p_p_tangan_jbtnkedua=$parameter['POST']['p_p_tangan_jbtnkedua'];
        $p_p_tangan_nipkedua=$parameter['POST']['p_p_tangan_nipkedua'];
        $p_p_tangan_lokasikedua=$parameter['POST']['p_p_tangan_lokasikedua'];
        $p_p_tangan_noskpenetapan=$parameter['POST']['p_p_tangan_noskpenetapan'];
        $p_p_tangan_tglskpenetapa = $parameter['POST']['p_p_tangan_tglskpenetapan']; ///bulan/tanggal/tahun 
        $datel = explode('/', $p_p_tangan_tglskpenetapa); ///
        $p_p_tangan_tglskpenetapan = $datel[2].$datel[1].$datel[0];   
        $p_p_tangan_noskhapus=$parameter['POST']['p_p_tangan_noskhapus'];
        $p_p_tangan_tglskhapus=$parameter['POST']['p_p_tangan_tglskhapus'];
        $p_p_tangan_tglskhapu = $parameter['POST']['p_p_tangan_tglskhapus']; ///bulan/tanggal/tahun 
        $datem = explode('/', $p_p_tangan_tglskhapu); ///
        $p_p_tangan_tglskhapus = $datem[2].$datem[1].$datem[0];   
        
        
        //pemusnahan
        $p_keterangantambahan=$parameter['POST']['p_keterangantambahan'];
        $p_pmusnah_keterangan=$parameter['POST']['p_pmusnah_keterangan'];
        $p_pmusnah_noskpenetapan=$parameter['POST']['p_pmusnah_noskpenetapan'];
        $p_pmusnah_tglskpenetapa = $parameter['POST']['p_pmusnah_tglskpenetapan']; ///bulan/tanggal/tahun 
        $datet= explode('/', $p_pmusnah_tglskpenetapa); ///
        $p_pmusnah_tglskpenetapan= $datet[2].$datet[1].$datet[0];   
        
        
        $p_pmusnah_noskhapus=$parameter['POST']['p_pmusnah_noskhapus'];
        $p_pmusnah_tglskhapu= $parameter['POST']['p_pmusnah_tglskhapus']; ///bulan/tanggal/tahun 
        $dateu = explode('/', $p_pmusnah_tglskhapu); ///
        $p_pmusnah_tglskhapus = $dateu[2].$dateu[1].$dateu[0];   
        
        
        $p_keterangantambahan=$parameter['POST']['p_keterangantambahan'];
        //pemeriksaan
        $p_periksa_no_ba=$parameter['POST']['p_periksa_no_ba'];
        $p_periksa_tglpemeriksaa = $parameter['POST']['p_periksa_tglpemeriksaan']; ///bulan/tanggal/tahun 
        $dateb = explode('/', $p_periksa_tglpemeriksaa); ///
        $p_periksa_tglpemeriksaan = $dateb[2].$dateb[1].$dateb[0];   
        $p_ststus_pemeriksaan=$parameter['POST']['p_ststus_pemeriksaan'];
        $p_periksa_ketua_pemeriksa=$parameter['POST']['p_periksa_ketua_pemeriksa'];
        $p_periksa_no_ba_penerimaan=$parameter['POST']['p_periksa_no_ba_penerimaan'];
        $p_periksa_tglpenerimaa = $parameter['POST']['p_periksa_tglpenerimaan']; ///bulan/tanggal/tahun 
        $datec = explode('/', $p_periksa_tglpenerimaa); ///
        $p_periksa_tglpenerimaan = $datec[2].$datec[1].$datec[0];   
        $p_periksa_namapenyedia=$parameter['POST']['p_periksa_namapenyedia'];
        $p_periksa_namapengurus=$parameter['POST']['p_periksa_namapengurus'];
        $p_periksa_nippengurus=$parameter['POST']['p_periksa_nippengurus'];
        $p_pengadaan_nokontrak=$parameter['POST']['p_pengadaan_nokontrak'];
        $p_pengadaan_nilaikontrak=$parameter['POST']['p_pengadaan_nilaikontrak'];
        
        ///query ke tabel aset
//seluruh next id jika data telah di insert
$tanah_id= get_auto_increment("Tanah");
$kontrak_id=  get_auto_increment("Kontrak");
$pemusnahan_id=  get_auto_increment("Pemusnahan");
$bast_id=  get_auto_increment("BAST");
$basp_id=  get_auto_increment("BASP");
$kontraktor_id=  get_auto_increment("Kontraktor");
$sp2d_id=get_auto_increment("SP2D");

$keputusanpengadilan_id= get_auto_increment("KeputusanPengadilan");
$keputusanundangundang_id= get_auto_increment("KeputusanUndangUndang");
$id_tanah=  get_auto_increment("Tanah");
$id_jaringan=  get_auto_increment("Jaringan");
$id_kdp=  get_auto_increment("KDP");
$id_penerimaan=  get_auto_increment("Penerimaan");
$id_mesin=  get_auto_increment("Mesin");
$id_aset_lain=  get_auto_increment("Aset_Lain");
$id_aset=  get_auto_increment("Aset");
$id_kapitalisasi_aset=  get_auto_increment("KapitalisasiAset");

//akhir seluruh next id jika data telah di insert 

        $p_pengadaan_pekerjaan=$parameter['POST']['p_pengadaan_pekerjaan'];
        $p_pengadaan_kontraktor=$parameter['POST']['p_pengadaan_kontraktor'];


        $querykontraktor = "INSERT INTO Kontraktor(Kontraktor_ID,NamaKontraktor) VALUES (NULL,'$p_pengadaan_kontraktor')";
        $resultkontraktor=  $this->query($querykontraktor)or die ($this->error());
        
        $querykontrak = "INSERT INTO Kontrak (Kontrak_ID, NoKontrak,Kontraktor_ID, NilaiKontrak, TglKontrak, Pekerjaan)
                        VALUES (NULL,'$p_pengadaan_nokontrak','$kontraktor_id', '$p_pengadaan_nilaikontrak',
                        '$p_pengadaan_tglkontrak', '$p_pengadaan_pekerjaan')";
        $resultkontrak=  $this->query($querykontrak) or die ($this->error());
        
        $querytanah= "INSERT INTO Tanah (LuasTotal,Aset_ID, LuasBangunan, LuasSekitar, LuasKosong, HakTanah, NoSertifikat,
                        TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur)
                        VALUES
                        ('$p_gtanah_luaskeseluruhan','$id_aset', '$p_gtanah_luasbangunan', '$p_gtanah_saranalingkungn',
                        '$p_gtanah_tanahkosong', '$p_gtanah_hakpakai', '$p_gtanah_nosertifikat', '$p_gtanah_tglsertifikat',
                        '$p_gtanah_penggunaan', '$p_gtanah_batasutara', '$p_gtanah_batasselatan', '$p_gtanah_batasbarat',
                        '$p_gtanah_batastimur')";
        $resulttanah= $this->query($querytanah) or die ($this->error());
        
        $querysp2d= "INSERT INTO SP2D (SP2D_ID, NoSP2D, TglSP2D, MAK, NilaiSP2D)
                        VALUES(NULL,'$p_pengadaan_nosp2d', '$p_pengadaan_tglsp2d', '$p_pengadaan_mataanggaran', '$p_pengadaan_nilaisp2d')";
        $resultsp2d = $this->query($querysp2d) or die ($this->error());
        
        $querykapitalisasiaset= "INSERT INTO KapitalisasiAset (Aset_ID,SP2D_ID) VALUES('$id_aset','$sp2d_id')";
        $resultkapitalisasiaset = $this->query($querykapitalisasiaset) or die ($this->error());
        
        $querypenerimaan= "INSERT INTO Penerimaan (Penerimaan_ID,TglPemeriksaan,Kontrak_ID, NoBAPemeriksaan, KetuaPemeriksa,
                            StatusPemeriksaan, NoBAPenerimaan, TglPenerimaan, NamaPenyedia, NamaPenyimpan, NIPPenyimpan)
                            VALUES
                            (NULL,'$p_periksa_tglpemeriksaan','$kontrak_id', '$p_periksa_no_ba', '$p_periksa_ketua_pemeriksa',
                            '$p_ststus_pemeriksaan', '$p_periksa_no_ba_penerimaan', '$p_periksa_tglpenerimaan', '$p_periksa_namapenyedia',
                            '$p_periksa_namapengurus', '$p_periksa_nippengurus')";
        $resultpenerimaan = $this->query($querypenerimaan) or die ($this->error());
        
        $queryjaringan= "INSERT INTO Jaringan(Konstruksi,Tanah_ID,Aset_ID, Panjang, Lebar, NoDokumen, TglDokumen, TanggalPemakaian,
                            StatusTanah, KelompokTanah_ID)
                            VALUES
                            ('$p_gjal_konstruksi','$tanah_id','$id_aset', '$p_gjal_panjang', '$p_gjal_lebar', '$p_gjal_nodokumen',
                            '$p_gjal_tgldookumen', '$p_gjal_tglpemakaian', '$p_statustanah', '$p_gjal_pilihaset_tanah')";
        $resultjaringan = $this->query($queryjaringan) or die ($this->error());
        
        $querybangunan = "INSERT INTO Bangunan (Konstruksi, Tanah_ID, Aset_ID, Beton, JumlahLantai, LuasLantai, Dinding,
                            Lantai, LangitLangit, Atap, NoSurat, TglSurat, TglPakai, StatusTanah, KelompokTanah_ID, NoIMB,
                            TglIMB)
                            VALUES
                            ('$p_gdg_konstruksi','$tanah_id','$id_aset', '$p_gdg_konstruksib', '$p_gdg_jumlah_lantai',
                            '$p_gdg_luaslantai', '$p_gdg_dinding', '$p_gdg_lantai', '$p_gdg_plafon', '$p_gdg_atap',
                            '$p_gdg_nodokumen', '$p_gdg_tgldokumen', '$p_gdg_tglpemakaian', '$p_gdg_ststustanah',
                            '$p_gdg_kodetanah', '$p_gdg_no_imb', '$p_gdg_tglimb')";
        $resultbangunan=  $this->query($querybangunan)or die ($this->error());
        
        $querykontrakaset="INSERT INTO KontrakAset (Kontrak_ID,Aset_ID) VALUES ('$kontrak_id','$id_aset')";
        $resultkontrakaset=  $this->query($querykontrakaset)or die($this->error());
        
        $querykdp = "INSERT INTO KDP(Konstruksi,Tanah_ID,Aset_ID, Beton, JumlahLantai, LuasLantai, TglMulai, StatusTanah, KelompokTanah_ID)
                        VALUES('$p_gjal_konstruksi','$tanah_id','$id_aset', '$p_gjal_konstruksi1', '$p_gjal_panjang', '$p_gol6_luas_lantai',
                        '$tanggal_pembangunan', '$p_gol6_statustanah', '$p_gol6_pilih_asettanah')";
        $resultkdp = $this->query($querykdp) or die ($this->error());
        
        $querymesin= "INSERT INTO Mesin(Merk,Aset_ID, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri, NoRangka,
                        NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, TahunBuat, BahanBakar, Pabrik, NegaraAsal,
                        kapasitas, Bobot, NegaraRakit)
                        VALUES
                        ('$p_gmsn_peralatan','$id_aset', '$p_gmsn_tipemodel', '$p_gmsn_ukuran', '$p_gmsn_silinder', '$p_gmsn_merek',
                        '$p_gmsn_jumlahmesin', '$p_gmsn_material', '$p_gmsn_noseripabrik', '$p_gmsn_rangka', '$p_gmsn_nomesin',
                        '$p_gmsn_nopolisi', '$p_gmsn_tglstnk', '$p_gmsn_nobpkb', '$p_gmsn_tglbpkb', '$p_gmsn_nodokumenlain',
                        '$p_gmsn_tgldokumenlain', '$p_gmsn_tahunpembutan', '$p_gmsn_bahanbakar', '$p_gmsn_pabrik',
                        '$p_gmsn_negaraasal', '$p_gmsn_kapasitas', '$p_gmsn_bobot', '$p_gmsn_negaraperakitan')";
        $resultmesin=  $this->query($querymesin)or die($this->error());
        
        if($parameter['POST']['select1'] == 1){
            $queryasetlain = "INSERT INTO AsetLain (Judul,Aset_ID, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN)
                                VALUES
                                ('$p_gol5_judul','$id_aset', '$p_gol5_penerbit', '$p_gol5_spesifikasi', '$p_gol5_spesifikasi',
                                '$p_gol5_asetlain_tahunterbit', '$p_gol5_isbn')";
        }else if($parameter['POST']['select1']== 3){
            $queryasetlain = "INSERT INTO AsetLain (Judul,Aset_ID, AsalDaerah, Pengarang, Material) 
                                VALUES
                                ('$p_gol5_judul1','$id_aset', '$p_gol5_asal', '$p_gol5_pencipta', '$p_gol5_bahan')";
        }else if($parameter['POST']['select1']== 2){
            $queryasetlain="INSERT INTO AsetLain(Judul,Aset_ID, Ukuran)
                            values('$p_gol5_jenis','$id_aset', '$p_gol5_ukuran')";
        }
        $resultasetlain=  $this->query($queryasetlain)or die ($this->error());
        
        
        
        // Upload Foto
        $folder_foto=$path."/foto/";   
        $nama_foto=$_FILES['p_foto_aset']['name'];
        $tgl=date("Y-m-d");
        
        $query_upload_foto= "INSERT INTO Foto(Foto_ID,Aset_ID,UserNm,TglFoto) VALUES (null,'$id_aset','$nama_foto','$tgl')";
        $result_upload_foto = $this->query($query_upload_foto) or die ($this->error);
        //$foto_function = upload_gambar('p_foto_aset',$folder_foto,1);
        
        //upload Nota aset
        $folder_fotonota=$path."/fotonota/";   
        $nama_fotos=$_FILES['p_notaaset']['name'];
        
        
        $query_upload_fotonota= "INSERT INTO FotoNota(Nota_ID,Aset_ID,UserNm,TglFotoNota) VALUES (null,'$id_aset','$nama_fotos','$tgl')";
        $result_upload_fotonota = $this->query($query_upload_fotonota) or die ($this->error());
        //$fotonota_function = upload_gambar('p_notaaset',$folder_fotonota,1);
        
        $querypemusnahan= "INSERT INTO Pemusnahan(KetPemusnahan,Aset_ID, NoSKPenetapan, TglSKPenetapan, NoSKPenghapusan,
                            TglSKPenghapusan)
                            VALUES
                            ('$p_pmusnah_keterangan','$id_aset', '$p_pmusnah_noskpenetapan', '$p_pmusnah_tglskpenetapan',
                            '$p_pmusnah_noskhapus', '$p_pmusnah_tglskhapus')";
        $resultpemusnahan = $this->query($querypemusnahan) or die ($this->error());
        
        $querybasp= "INSERT INTO BASP (NoBASP, TglBASP, NamaPihak1, JabatanPihak1, NIPPihak1, LokasiPihak1, NamaPihak2, JabatanPihak2,
                        NIPPihak2, LokasiPihak2, NoSKPenetapan, TglSKPenetapan, NoSKPenghapusan, TglSKPenghapusan, KeteranganTambahan)
                        VALUES
                        ('$p_p_tangan_nobasp', '$p_p_tangan_tglbasp', '$p_p_tangan_namapertama', '$p_p_tangan_jbtnpertama',
                        '$p_p_tangan_nippertama', '$p_p_tangan_lokasipertama', '$p_p_tangan_namakedua', '$p_p_tangan_jbtnkedua',
                        '$p_p_tangan_nipkedua', '$p_p_tangan_lokasikedua', '$p_p_tangan_noskpenetapan', '$p_p_tangan_tglskpenetapan',
                        '$p_p_tangan_noskhapus', '$p_p_tangan_tglskhapus', '$p_keterangantambahan')";
        $resultbasp=  $this->query($querybasp)or die ($this->error());
        
        
        $querybast = "INSERT INTO BAST (UserNm, NoBAST, TglBAST, NamaPihak1, JabatanPihak1, NIPPihak1, NamaPihak2,
                        JabatanPihak2, NIPPihak2)
                        VALUES
                        ('$p_hibah_pemberi', '$p_hibah_nobbast', '$p_hibah_tglbast', '$p_hibah_namapertama',
                        '$p_hibah_jabatan_pertama', '$p_hibah_nippertama',  '$p_hibah_namakedua',
                        '$p_hibah_jabatan_kedua', '$p_hibah_nipkedua')";
        
        $resultbast=  $this->query($querybast)or die ($this->error());
        //exit;
        $queryundangundang= "INSERT INTO KeputusanUndangUndang(NoKeputusan,Aset_ID, JenisAset, AsalAset, Keterangan)
                                VALUES('$p_uud_no_uud','$id_aset', '$p_uud_jenisaset', '$p_uud_asalaset', '$p_uud_keterangan')";
        $resultundangundang= $this->query($queryundangundang) or die ($this->error());
        
        $querypengadilan= "INSERT INTO KeputusanPengadilan(NoKeputusan,Aset_ID, JenisAset, AsalAset, Keterangan)
                            VALUES
                            ('$p_pengadilan_no_pengadilan','$id_aset', '$p_pengadilan_jenisaset', '$p_pengadilan_asalaset',
                            '$p_pengadilan_keterangan')";
        $resultpengadilan = $this->query($querypengadilan) or die ($this->error());
        //pengecualian
        $querysatker= "INSERT INTO Satker(KodeUnit, KodeSatker) VALUES('$p_noreg_unit', '$p_noreg_satker')";
        $resultsatker = $this->query($querysatker) or die ($this->error());
        
        $querylokasibaru= "INSERT INTO lokasi_baru(koordinat,Aset_ID) VALUES('$p_koordinat','$id_aset')";
        $resultlokasibaru = $this->query($querylokasibaru) or die ($this->error());
        
        $queryaset="INSERT INTO Aset (Aset_ID,BAST_ID,BASP_ID,Lokasi_ID,Penerimaan_ID,BAPemusnahan_ID,OrigSatker_ID,Kelompok_ID,
                        CaraPerolehan, PenghapusanAset, NomorReg, Pemilik, NamaAset, Ruangan, Alamat, RTRW, AsalUsul, TglPerolehan,
                        Tahun, NilaiPerolehan, Kuantitas, Satuan, TipeAset, Bersejarah, Peruntukan, SumberDana,LastSatker_ID,NotUse,StatusValidasiBarang,OriginDbSatker)
                        VALUES
                        (null,'$bast_id','$basp_id','$lokasi_id','$id_penerimaan','$pemusnahan_id',$satker_id,'$kelompok_id',
                        '$p_perolehan_caraperolehan', '$p_penghapusan_aset', '$p_noreg_noreg', '$p_noreg_pemilik', '$p_nama_aset',
                        '$p_ruangan', '$p_alamat', '$p_rt', '$p_perolehan_ket_asalusul', '$p_perolehan_tglperolehan',
                        '$p_perolehan_thnperolehan', '$p_perolehan_nilai', '$p_gol5_kuantitas1', '$p_gol5_satuan1',
                        '$p_jenisaset', '$p_bersejarah', '$p_p_tangan_peruntukan', '$p_pengadaan_sumberdana','0','0','0','0')";
        $resultaset=  $this->query($queryaset)or die ($this->error());
        
        return true;
    }
    
    
    
    //tambahan
	
	//Dari Bayu  
	//PERENCANAAN
	public function store_pemeliharaan_data($parameter)
    {
	// pr($parameter);
	// exit;
	$nobapem		= $parameter['param']['idpemeliharaan_nomor'];
	$id				= $parameter['param']['id'];
	$tanggal		= explode("/",$parameter['param']['idpemeliharaan_tanggal']);
	$tglpem			= $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
	
	$jenispem		= $parameter['param']['idpemeliharaan_jenis'];
	$biayapemExpld	= explode(",",$parameter['param']['idpemeliharaan_biaya']);
	$biayapem 		= str_replace(".", "", $biayapemExpld[0]);
	// pr($biayapemExpld);
	// pr($biayapem);
	$ketpem			= $parameter['param']['idpemeliharaan_keterangan'];
	$namapem		= $parameter['param']['idpemeliharaan_nama'];
	$nippem			= $parameter['param']['idpemeliharaan_nip'];
	$jabpem			= $parameter['param']['idpemeliharaan_jabatan'];
	$namajasapem	= $parameter['param']['idpemeliharaan_penyedia'];
	
	$nilai_sebelumExpld	= explode(",",$parameter['param']['idnilai_sebelum']);
	$nilai_sebelum 		= str_replace(".", "", $nilai_sebelumExpld[0]);
	// pr($nilai_sebelumExpld);
	// pr($nilai_sebelum);
	$nilai_setelahExpld	= explode(",",$parameter['param']['idnilai_setelah']);
	$nilai_setelah 		= str_replace(".", "", $nilai_setelahExpld[0]);
	// pr($nilai_setelahExpld);
	// pr($nilai_setelah);
	$nilai_keterangan	= $parameter['param']['idnilai_keterangan'];
	
	$kondisi			= $parameter['param']['kondisi'];
	//echo $id;
	$baik 		= 0;
	$ringan 	= 0;
	$berat 		= 0;
	// exit;
	switch ($kondisi) {
		case "baik" : 
			$baik = 1;

			$ringan = 0;
			$berat = 0;
			break;
		
		case "ringan" : 
			$baik = 0;
			$ringan = 1;
			$berat = 0;
			break;
		
		case "berat" : 
			$baik = 0;
			$ringan = 0;
			$berat = 1;
			break;	
	};
	
	$idkondisi_info		= $parameter['param']['idkondisi_info'];
	
	$pemeliharaan_id=get_auto_increment("Pemeliharaan");

        $query_simpan1		= 	"INSERT INTO  Pemeliharaan
							(Pemeliharaan_ID, Aset_ID, NoBAPemeliharaan, TglPemeliharaan, JenisPemeliharaan, Biaya, KeteranganPemeliharaan,
							NamaPemelihara, NIPPemelihara, JabatanPemelihara, NamaPenyediaJasa, UserNm, TglUpdate,GUID)
							VALUES
							('','".$id."','".$nobapem."','".$tglpem."','".$jenispem."','".$biayapem."','".$ketpem."','".$namapem."','".$nippem."',
							'".$jabpem."','".$namajasapem."','admin','".date('Y-m-d')."','terserah')
							";
	
	$insert1			= 	mysql_query($query_simpan1) or die (mysql_error());
	
	$query_simpan2		= 	"INSERT INTO NilaiAset
							  (NilaiAset_ID, Pemeliharaan_ID, Aset_ID, FromNilai, ToNilai, TglNilai, KeteranganNilai, TglUpdate)
							  VALUES
							  ('','".$pemeliharaan_id."','".$id."','".$nilai_sebelum."','".$nilai_setelah."','".date('Y-m-d')."','".$nilai_keterangan."','".date('Y-m-d')."')
							  ";
							  
	$insert2 = mysql_query($query_simpan2) or die (mysql_error());
	
	$query_simpan3		= 	"INSERT INTO Kondisi
							  (Kondisi_ID, Aset_ID, Pemeliharaan_ID, TglKondisi, InfoKondisi, Baik, RusakRingan, RusakBerat, TglUpdate)
							  VALUES
							  ('','".$id."','".$pemeliharaan_id."','".date('Y-m-d')."','".$idkondisi_info."','".$baik."','".$ringan."','".$berat."','".date('Y-m-d')."')
							  ";
							  
	$insert3 = mysql_query($query_simpan3) or die (mysql_error());
	
	$query_update_status_pemeliharaan = "UPDATE Aset SET Status_Pemeliharaan=1 WHERE Aset_ID=".$id;
	$insert4 = mysql_query($query_update_status_pemeliharaan) or die (mysql_error());
	
	
	}
	
	public function store_rkb_data($parameter)
    {
		$tahun	=$parameter['param']['rkb_add_thn'];
		$skpd	=$parameter['param']['skpd_id'];
		$lokasi	=$parameter['param']['lokasi_id'];
		$njb	=$parameter['param']['kelompok_id'];
		$spesifikasi	=$parameter['param']['Spesifikasi'];
		$korek	=$parameter['param']['rekening_id'];
		$jml	=$parameter['param']['rkb_add_jml'];
		$thrg	=$parameter['param']['rkb_add_thrg'];

        $query 	="	INSERT INTO 
						Perencanaan (Perencanaan_ID,StatusPemeliharaan,StatusValidasi,Tahun,Satker_ID,Lokasi_ID,Kelompok_ID,Merk,KodeRekening,Kuantitas,NilaiAnggaran) 
					VALUES 
						(null,0,10, '".$tahun."' , '".$skpd."' , '".$lokasi."' , '".$njb."' , '".$spesifikasi."' , '".$korek."' , '".$jml."' , '".$thrg."')";
        $result = $this->query($query) or die ('error store_rkb_data');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Sudah Masuk")</script>';
            return true;    
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Masuk")</script>';
            return false;
        }
	}
	
	
	public function store_skb_data($parameter)
    {
        $njb	= $parameter['param']['kelompok_id'];
		$skpd	= $parameter['param']['skpd_id'];
		$lokasi	= $parameter['param']['lokasi_id'];
		$tanggal = explode("/",$parameter['param']['skb_add_tgl']);
		$tgl	= $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
		
		$ket	= $parameter['param']['skb_add_ket'];
		$jml	= $parameter['param']['skb_add_jml'];

        $query 	="	INSERT INTO 
						StandarKebutuhan (skb_id,skb_njb,skb_skpd,skb_lokasi,skb_tgl,skb_ket,skb_jml) 
					VALUES 
						(null,'".$njb."','".$skpd."','".$lokasi."','".$tgl."','".$ket."','".$jml."')";
        $result = $this->query($query) or die ('error store_skb_data');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Sudah Masuk")</script>';
            return true;    
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Masuk")</script>';
            return false;
        }
	}
	
	
	public function store_shb_data($parameter)
    {
        $njb =$parameter['param']['shb_add_njb_id'];
        $mat =$parameter['param']['shb_add_mat'];
        $tanggal =explode("/",$parameter['param']['shb_add_tgl']);
        $tgl =$tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
        $bhn =$parameter['param']['shb_add_bhn'];
		$satuan=$parameter['param']['shb_add_satuan'];
        $ket =$parameter['param']['shb_add_ket'];
        $hrg =$parameter['param']['shb_add_hrg'];
	
        $query 	="INSERT INTO StandarHarga (StandarHarga_ID,StatusPemeliharaan,Kelompok_ID,Merk,TglUpdate,Spesifikasi,Satuan,Keterangan,
                    NilaiStandar) VALUES (null,0,'".$njb."','".$mat."','".$tgl."','".$bhn."','".$satuan."','".$ket."','".$hrg."')";
        $result = $this->query($query) or die ('error store_shb_data');
        if ($result)
        {
            return true;
			header ("location:shb_daftar_data.php");
        }
        else
        {
            return false;
        }
        
        
    }
	
	//GUDANG
	
	public function store_distribusi_barang_tambah
	(
		$no_dokumen,
		$tanggal_proses,
		$alasan,
		$no_spbb,
		$tanggal_spbb,
		$nama_penyimpan,
		$nama_pengurus,
		$pangkat_penyimpan,
		$pangkat_pengurus,
		$nip_penyimpan,
		$nip_pengurus,
		$nama_atasan,
		$pangkat_atasan_penyimpan,
		$nip_atasan_penyimpan,
		$jabatan_penyimpan,
		$transferke,
		$aset,
		$tanggal, $bulan, $tahun,
		$tgl, $bln, $thn,
		$fromsatker
	)
    {
        $query = "insert into Transfer(Transfer_ID, Aset_ID,FromSatker_ID,ToSatker_ID, NoDokumen, TglTransfer, InfoTransfer, No_SPBB_distribusi_barang, 
		Tgl_SPBB_distribusi_barang,Nama_penyimpan, Pangkat_penyimpan, NIP_penyimpan, Nama_atasan_penyimpan, Pangkat_atasan_penyimpan, 
		NIP_atasan_penyimpan, Jabatan_penyimpan, Nama_pengurus, Pangkat_pengurus, NIP_pengurus) values 
		('','$aset','$fromsatker','$transferke', '$no_dokumen', '$tahun-$bulan-$tanggal', '$alasan', '$no_spbb', '$thn-$bln-$tgl','$nama_penyimpan', 
		'$pangkat_penyimpan','$nip_penyimpan', '$nama_atasan', 
		'$pangkat_atasan_penyimpan','$nip_atasan_penyimpan','$jabatan_penyimpan','$nama_pengurus','$pangkat_pengurus','$nip_pengurus')";
		//print_r($query);
        $result = $this->query($query) or die ('error store_distribusi_barang');
		$query2 = "update Aset SET OriginDBSatker = '$transferke', LastSatker_ID='$transferke' where Aset_ID='$aset' and StatusValidasi!=0";
		$result2 = $this->query($query2) or die ('error store_distribusi_barang');
        if ($result)
        {
            return true;    
        }
        else
        {
            return false;
        }
    }
	
	public function store_distribusi_barang_edit
	(
		$no_dokumen,
		$tanggal_proses,
		$alasan,
		$no_spbb,
		$tanggal_spbb,
		$nama_penyimpan,
		$nama_pengurus,
		$pangkat_penyimpan,
		$pangkat_pengurus,
		$nip_penyimpan,
		$nip_pengurus,
		$nama_atasan,
		$pangkat_atasan_penyimpan,
		$nip_atasan_penyimpan,
		$jabatan_penyimpan,
		$transferke,
		$aset,
		$tanggal, $bulan, $tahun,
		$tgl, $bln, $thn,
		$fromsatker
	)
    {
        $query = "update Transfer set FromSatker_ID='$fromsatker',ToSatker_ID='$transferke',NoDokumen='$no_dokumen', TglTransfer='$tahun-$bulan-$tanggal', InfoTransfer='$alasan', No_SPBB_distribusi_barang='$no_spbb', 
		Tgl_SPBB_distribusi_barang='$thn-$bln-$tgl', Nama_penyimpan='$nama_penyimpan', Nama_pengurus='$nama_pengurus', Pangkat_penyimpan='$pangkat_penyimpan', 
		Pangkat_pengurus='$pangkat_pengurus', NIP_penyimpan='$nip_penyimpan', NIP_pengurus='$nip_pengurus', Nama_atasan_penyimpan='$nama_atasan', 
		Pangkat_atasan_penyimpan='$pangkat_atasan_penyimpan', NIP_atasan_penyimpan='$nip_atasan_penyimpan', Jabatan_penyimpan='$jabatan_penyimpan' where Aset_ID='$aset'";
        $result = $this->query($query) or die ('error store_distribusi_barang_edit');
		$query2 = "update Aset SET OriginDBSatker = '$transferke', LastSatker_ID='$transferke' where Aset_ID='$aset'";
		$result2 = $this->query($query2) or die ('error store_distribusi_barang_edit');
        if ($result)
        {
            return true;    
        }
        else
        {
            return false;
        }
    }
	
	public function store_gudang_pemeriksaan_baru
	(
		$aset,
		$gdg_dbedb_nobapemeriksa,
		$gdg_dbedb_tglpemeriksa,
		$gdg_dbedb_alasanpemeriksa,
		$gdg_dbedb_nama,
		$gdg_dbedb_pangkat_gol,
		$gdg_dbedb_nip,
		$gdg_dbedb_jabatan,
		$aset_tidak_ditemukan,
		$gdg_dbedb_kondisi,
		$gdg_dbedb_tindaklanjut,
		$tanggal, $bulan, $tahun,
		$baik,
		$rusak_ringan,$rusak_berat
	)
    {
        $query = "insert into  PemeriksaanGudang (PemeriksaanGudang_ID, NoBAPemeriksaanGudang, TglPemeriksaanGudang,
                AlasanPemeriksaanGudang, UserNm, TglUpdate, NIPKetuaPanitia, NamaKetuaPanitia, GolonganKetuaPanitia,
                JabatanKetuaPanitia,Aset_ID)values ('','$gdg_dbedb_nobapemeriksa','$tahun-$tanggal-$bulan', '$gdg_dbedb_alasanpemeriksa',
                '','',  '$gdg_dbedb_nip', '$gdg_dbedb_nama', '$gdg_dbedb_pangkat_gol', '$gdg_dbedb_jabatan', '$aset')";
		// pr($query);
		// exit;
		$result = $this->query($query) or die ('error store_gudang_pemeriksaan_baru');
		
		$sql="	SELECT 
					* 
				FROM 
					PemeriksaanGudang 
				WHERE 
					Aset_ID='$aset' and NoBAPemeriksaanGudang='$gdg_dbedb_nobapemeriksa' and
					TglPemeriksaanGudang='$tahun-$tanggal-$bulan' and AlasanPemeriksaanGudang='$gdg_dbedb_alasanpemeriksa' and NIPKetuaPanitia='$gdg_dbedb_nip' and
					NamaKetuaPanitia='$gdg_dbedb_nama' and GolonganKetuaPanitia='$gdg_dbedb_pangkat_gol' and JabatanKetuaPanitia='$gdg_dbedb_jabatan'";
		// print_r($sql);
		$hasil = $this->query($sql);
		//echo $this->num_rows($result);
		while($row = $this->fetch_object($hasil))
		  {
		  // pr($row);
		  $gudang_id=$row->PemeriksaanGudang_ID;
		  }
		 
		 // echo "gudang".$gudang_id;
		 // exit; 
		// exit;
        $query2 = "insert into Kondisi(TidakDitemukan, Baik, RusakRingan, RusakBerat, InfoKondisi, PemeriksaanGudang_ID,
                    Aset_ID) values ('$aset_tidak_ditemukan',  '$baik','$rusak_ringan','$rusak_berat', '$gdg_dbedb_tindaklanjut',
                    '$gudang_id', '$aset')";
        // pr();
		$result2 = $this->query($query2) or die ('error store_gudang_pemeriksaan_baru');
        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	//Akhir dari Bayu


	/* Menu Penilaian Syafrizal AS */

    public function store_entri_penilaian_nilai_baru($parameter)
    {
  if (isset($_GET['id']))
            {
                if ($_GET['id'] !== '')
                {
                    $_SESSION['Aset_ID'] = $_GET['id'];
                }
            }
            
           
            $query ="SELECT Penilaian_ID FROM NilaiAset WHERE Aset_ID = $_SESSION[Aset_ID]";
            //print_r($query);
	    $result = mysql_query($query) or die (mysql_error()) ;
            $recNum = mysql_num_rows($result);
            if ($recNum)
            {
                while( $data = mysql_fetch_object($result)){
                    $Penilaian_ID [] =$data;
                }
            }
            else
            {
                $Penilaian_ID = '';
            }
            
	if ($Penilaian_ID !='')
	{
		foreach ($Penilaian_ID as $value)
	    {
		$query = "SELECT Penilaian_ID, NoBAPenilaian, TglPenilaian, KeteranganPenilaian FROM Penilaian WHERE Penilaian_ID = $value->Penilaian_ID";
		//print_r($query);
		$result = mysql_query($query) or die (mysql_error());
		if (mysql_num_rows($result))
		{
		    $dataPenilaian[] = mysql_fetch_object($result);
		}
	    }
	}
	   
	    
	    
	    
	    //print_r($dataPenilaian);
	    
            $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                            c.Kelompok, c.Uraian, c.Kode,
                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                            f.InfoKondisi
                            FROM Aset AS a 
                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                            WHERE a.Aset_ID = '$_SESSION[Aset_ID]' LIMIT 1";
        //print_r($query);
        $result = mysql_query($query) or die(mysql_error());
        //$result1 = mysql_query($query1) or die(mysql_error());
        $check = mysql_num_rows($result);
        $dataArr['aset'] = mysql_fetch_object($result);
        
        $query = "SELECT Kontrak_ID FROM KontrakAset WHERE Aset_ID = '".$dataArr['aset']->Aset_ID."'";
        $result = mysql_query($query) or die (mysql_error());
        
        if (mysql_num_rows($result))
        {
            $data = mysql_fetch_object($result);
            
            $query = "SELECT NoKontrak FROM Kontrak WHERE Kontrak_ID = '$data->Kontrak_ID'";
            $result = mysql_query($query) or die (mysql_error());
            
            if (mysql_num_rows($result))
            {
                $dataArr['kontrak'] = mysql_fetch_object($result);
            }
        }
        
        $noRegistrasi = $dataArr['aset']->Pemilik.'.'.$dataArr['aset']->KodePropPerMen.'.'.
                        $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                        substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $noRegistrasi2 = $dataArr['aset']->KodePropPerMen.'.'.
                         $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                         substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $a = count ($dataArr['aset']->NomorReg);
        for ($i = 0; $i <= 3; $i++)
        {
            if ($i >= $a)
            $b[] = 0;
        }
        
        
        
        $kodeKelompok = $dataArr['aset']->Kode.'.'.$b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        $kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
            
            
            echo '<pre>';
            print_r($row);
            echo '</pre>';
            }
            
/* Menu Penilaian Syafrizal AS */

	
	//kerjaan yoda
    public function store_usulan_pemindahtanganan($UserNm,$nmaset,$usulan_id,$date,$ses_uid)
    {
        $asset_id=Array();
        $no_reg=Array();
        $nm_barang=Array();

        $panjang=count($nmaset);
        
        $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                            Jenis_Usulan, UserNm, TglUpdate, 
                                            GUID, FixUsulan) 
                                        values ('', '', '', 'PDH', '$UserNm', '$date', '$ses_uid', '1')";

        $result=  $this->query($query) or die($this->error());

        for($i=0;$i<$panjang;$i++){

            $tmp=$nmaset[$i];
            $tmp_olah=explode("<br>",$tmp);
            $asset_id[$i]=$tmp_olah[0];
            $no_reg[$i]=$tmp_olah[1];
            $nm_barang[$i]=$tmp_olah[2];

            $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','PDH','0')";
            $result1=  $this->query($query1) or die($this->error());

            $query3="UPDATE Aset SET Usulan_Pemindahtanganan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
            $result3=$this->query($query3) or die($this->error());

            
            //lanjut dari sinii
            // $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
            // $result2=$this->query($query2) or die($this->error());
        }
        $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='Usulan_Pemindahtanganan[]' AND UserSes='$ses_uid'";
        $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
    
        
        if ($result)
        {
            return true;    
        }
        elseif($result1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function store_penetapan_pemindahtanganan
            (
                $pemindahtanganan_id,
                $UserNm,
                $guid,
                $nmaset,
                $no_penetapan,
                $tgl_penetapan,
                $no_bast,
                $tgl_bast,
                $olah_tgl_penetapan,
                $olah_tgl_bast,
                $lokasi_basp,
                $tipe_pemindahtanganan,
                $peruntukan,
                $alamat_pihak_kedua,
                $nama1,
                $jabatan1,
                $nip1,
                $lokasi1,
                $nama2,
                $jabatan2,
                $nip2,
                $lokasi2,
                $submit
            )
            {
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();

                $panjang=count($nmaset);

                if(isset($submit)){
/*
                if($nmaset!="" && $no_penetapan!="" && $tgl_penetapan!="" && $no_bast!="" && $tgl_bast!="" && $lokasi_basp!=""
                        && $tipe_pemindahtanganan!="" && $peruntukan!="" && $alamat_pihak_kedua!="" && $nama1!=""
                        && $jabatan1!="" && $nip1!="" && $lokasi1!="" && $nama2!="" && $jabatan2!="" && $nip2!="" && $lokasi2!=""){

                    echo "<script>var r=confirm('Data Sudah Benar ???');
                                            if(r==false){
                                            document.location='tambah_penetapan_pemindahtanganan.php';
                                            }
                            </script>";
                }
*/

                //$pemindahtanganan_id=get_auto_increment("BASP");
                $query="insert into BASP (BASP_ID, NoBASP, TglBASP, NamaPihak1, JabatanPihak1, NIPPihak1,
                                                                            NamaPihak2, JabatanPihak2, NIPPihak2, UserNm, LokasiPihak1, LokasiPihak2, TglUpdate,
                                                                            LokasiBASP, BASP_Ket, BASP_Tahun, BASP_Nilai, BASP_Instansi, BASP_Kab, X, TipePemindahtanganan, GUID,
                                                                            TglSKPenetapan, NoSKPenetapan, NoSKPenghapusan, TglSKPenghapusan, Peruntukan, Alamat_Pihak_2,
                                                                            FixPemindahtanganan, Status) 
                                                values ('','$no_bast','$olah_tgl_bast','$nama1','$jabatan1','$nip1','$nama2','$jabatan2','$nip2','$UserNm',
                                                    '$lokasi1','$lokasi2','$olah_tgl_penetapan','$lokasi_basp','','','','','','','$tipe_pemindahtanganan','$guid',
                                                        '$olah_tgl_penetapan','$no_penetapan','','','$peruntukan','$alamat_pihak_kedua','1','0')";

                $result= $this->query($query) or die($this->error());



                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    /*echo  "No= $i <br/>
                            Asset ID =$asset_id[$i] <br/>
                            No register=$no_reg[$i] <br/>
                            Nama barang =$nm_barang[$i] <br/>";
                     * 
                     */

                    $query6="insert into BASPAset(BASP_ID,Aset_ID,Status) values('$pemindahtanganan_id','$asset_id[$i]','0')";
                    $result6=  $this->query($query6) or die($this->error());



                    $query2="UPDATE UsulanAset SET StatusPenetapan=1, Penetapan_ID='$pemindahtanganan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='PDH'";
                    $result2=$this->query($query2) or die($this->error());


                    $query3="UPDATE Aset SET BASP_ID='$pemindahtanganan_id' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());

                    $query_tampil="SELECT NomorReg FROM Aset WHERE Aset_ID='$asset_id[$i]'";
                    $result_tampil=$this->query($query_tampil) or die($this->error());
                    $exec_tampil=$this->fetch_array($result_tampil);

                    $param=$exec_tampil['NomorReg'];


                    $pecah=explode(".",$param);
                    $pecah1=$pecah[0];
                    $pecah2=$pecah[1];
                    $pecah3=$pecah[2];
                    $pecah4=$pecah[3];
                    $pecah5=$pecah[4];
                    $pecah6=$pecah[5];
                    $pecah7=$pecah[6];

                    $array=array($peruntukan,$pecah2,$pecah3,$pecah4,$pecah5,$pecah6,$pecah7);
                    $gabung=implode(".",$array);

                    //echo "$gabung";

                    $query5="UPDATE Aset SET NomorReg='$gabung' WHERE Aset_ID='$asset_id[$i]'";
                    $result5=$this->query($query5) or die($this->error());

                    $query_update_baspaset="UPDATE BASPAset SET NomorRegOrigin='$param' WHERE Aset_ID='$asset_id[$i]]'";
                    $result_update_baspaset=$this->query($query_update_baspaset) or die($this->error());
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PemindahtangananPenetapan' AND UserSes='$guid'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }

                if ($result)
                {
                    return true;    
                }
                elseif($result6)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            
            public function store_usulan_penghapusan
            (
                $UserNm,
                $nmaset,
                $usulan_id,
                $date,
                $ses_uid
            )
            {
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();

                $panjang=count($nmaset);
				$aset=implode(',',$nmaset);

                $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                                    Jenis_Usulan, UserNm, TglUpdate, 
                                                    GUID, FixUsulan) 
                                                values ('', '$aset', '', 'HPS', '$UserNm', '$date', '$ses_uid', '1')";

                $result=  $this->query($query) or die($this->error());

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];

                    $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','HPS','0')";
                    $result1=  $this->query($query1) or die($this->error());

                    $query3="UPDATE Aset SET Usulan_Penghapusan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());


                    //lanjut dari sinii
                    // $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
                    // $result2=$this->query($query2) or die($this->error());
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='penghapusanfilter[]' AND UserSes='$ses_uid'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                
                if($result)
                    {
                        return true;
                    }
                elseif($result1)
                    {
                        return true;
                    }
                else
                    {
                        return false;
                    }
            }
            
            public function store_penetapan_penghapusan
            (
                    $no,
                    $tgl,
                    $olah_tgl,
                    $keterangan,
                    $UserNm,
                    $nmaset,
                    $ses_uid,
                    $penghapusan_id
            )
            {
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();

                $panjang=count($nmaset);

                $query="INSERT INTO penghapusan (Penghapusan_ID, NoSKHapus, TglHapus, AlasanHapus, Status, UserNm, FixPenghapusan) 
                                                values ('','$no', '$olah_tgl', '$keterangan', '0','$UserNm', '1')";
                $result=  $this->query($query) or die($this->error());



                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    /*echo  "No= $i <br/>
                            Asset ID =$asset_id[$i] <br/>
                            No register=$no_reg[$i] <br/>
                            Nama barang =$nm_barang[$i] <br/>";
                     * 
                     */

                    $query1="insert into penghapusanaset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());

                    $query2="UPDATE usulanaset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
                    $result2=$this->query($query2) or die($this->error());

                    $query3="UPDATE aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='penetapanpenghapusan[]' AND UserSes='$ses_uid'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                
                if($result)
                {
                    return true;
                }
                elseif($result1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            
            public function store_usulan_pemusnahan
            (
                $UserNm,
                $nmaset,
                $usulan_id,
                $date,
                $ses_uid
            )
            {
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();

                $panjang=count($nmaset);


                $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                                    Jenis_Usulan, UserNm, TglUpdate, 
                                                    GUID, FixUsulan) 
                                                values ('', '', '', 'MSN', '$UserNm', '$date', '$ses_uid', '1')";

                $result=  $this->query($query) or die($this->error());

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];

                    $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','MSN','0')";
                    $result1=  $this->query($query1) or die($this->error());

                    $query3="UPDATE Aset SET Usulan_Pemusnahan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());


                    //lanjut dari sinii
                    $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
                    $result2=$this->query($query2) or die($this->error());
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PemusnahanUsul' AND UserSes='$ses_uid'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                
                if($result)
                {
                    return true;
                }
                elseif($result1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            
            
            //update store yoda dari sini ...
            
            public function store_penetapan_pemusnahan
            (
                $UserNm,
                $nmaset,
                $pemusnahan_id,
                $ses_uid,
                $no,
                $tgl,
                $olah_tgl,
                $penanda_tangan,
                $jabatan_penanda_tangan,
                $nip
            )
            {
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();

                $panjang=count($nmaset);
                $query="insert into BAPemusnahan (BAPemusnahan_ID, NoBAPemusnahan, TglBAPemusnahan, NamaPenandatangan, UserNm, 
                                                    TglUpdate, NIPPenandatangan, JabatanPenandatangan, GUID, FixPemusnahan, Status) 
                                                values ('','$no','$olah_tgl','$penanda_tangan',
                                                    '$UserNm','$olah_tgl','$nip','$jabatan_penanda_tangan','$ses_uid','1','0')";

                $result=  $this->query($query) or die($this->error());



                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];

                    $query1="insert into BAPemusnahanAset(BAPemusnahan_ID,Aset_ID,Status) values('$pemusnahan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());
                    
                    $query2="UPDATE UsulanAset SET StatusPenetapan=1, Penetapan_ID='$pemusnahan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='MSN'";
                    $result2=$this->query($query2) or die($this->error());

                    $query3="UPDATE Aset SET BAPemusnahan_ID='$pemusnahan_id' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PemusnahanPenetapan' AND UserSes='$ses_uid'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            
                if($result)
                {
                    return true;
                }
                elseif($result1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            
            public function store_penetapan_penggunaan
            (
                $submit,
                $UserNm,
                $nmaset,
                $penggunaan_id,
                $ses_uid,
                $penggu_penet_eks_ket,
                $penggu_penet_eks_nopenet,
                $penggu_penet_eks_tglpenet,
                $olah_tgl
            )
            {
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();

                $panjang=count($nmaset);

                if(isset($submit)){


                $query="insert into Penggunaan (Penggunaan_ID, NoSKKDH , TglSKKDH, 
                                                    Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, GUID) 
                                                values (null,'$penggu_penet_eks_nopenet','$olah_tgl', '$penggu_penet_eks_ket','','$olah_tgl','$UserNm','1','$ses_uid')";
                //print_r($query);
                $result=  $this->query($query) or die($this->error());

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];

                    $query1="insert into PenggunaanAset(Penggunaan_ID,Aset_ID) values('$penggunaan_id','$asset_id[$i]')  ";
                    $result1=  $this->query($query1) or die($this->error());

                    $query2="UPDATE Aset SET NotUse=1, LastPenggunaan_ID='$penggunaan_id' WHERE Aset_ID='$asset_id[$i]'";
                    $result2=$this->query($query2) or die($this->error());
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='Penggunaan[]' AND UserSes='$ses_uid'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                }
                if($result)
                {
                    return true;
                }
                elseif($result1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            //kerjaan yoda end
	
	
	//akhir tambahan
	
	
    /* Parameter : data=>2012-10-01, type=>yeartodate */
    public function change_date_to_slash($parameter)
    {
        $date = explode ('-',$parameter['data']);
        
        if ($parameter['type'] == 'datetoyear')
        {
            $new_date = $date[2].'/'.$date[1].'/'.$date[0];
            
            return $new_date;
        }
        else
        {
            $new_date = $date[0].'/'.$date[1].'/'.$date[2];
            return $new_date;
        }
    }
    
    public function change_date_to_strip($parameter)
    {
        $date = explode ('/',$parameter['data']);
        
        if ($parameter['type'] == 'datetoyear')
        {
            $new_date = $date[2].'-'.$date[1].'-'.$date[0];
            
            return $new_date;
        }
        else
        {
            $new_date = $date[0].'-'.$date[1].'-'.$date[2];
            return $new_date;
        }
    }

    public function store_kontrak($data)
    {

        // pr($data);exit; 
        global $url_rewrite;
        unset($data['id']);


        $data['n_status'] = 0; 
            foreach ($data as $key => $val) {
                $tmpfield[] = $key;
                $tmpvalue[] = "'$val'";
            }
            $field = implode(',', $tmpfield);
            $value = implode(',', $tmpvalue);

            $query = "INSERT INTO kontrak ({$field}) VALUES ($value)";
            $result=  $this->query($query) or die($this->error());

        $query_id = mysql_query("SELECT id FROM kontrak ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($query_id)){
             $data['kontrak_id'] = $row['id'];
        }

        $data['action'] = 'insert';
        $data['changeDate'] = date('Y/m/d');
        $data['operator'] = "{$_SESSION['ses_uoperatorid']}";
        // pr($data);exit;
        foreach ($data as $key => $val) {
            $tmplogfield[] = $key;
            $tmplogvalue[] = "'$val'";
        }
        $field = implode(',', $tmplogfield);
        $value = implode(',', $tmplogvalue);

        $query_log = "INSERT INTO log_kontrak ({$field}) VALUES ($value)";

        $result=  $this->query($query_log) or die($this->error());

            echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_simbada.php\">";
    }

    public function store_edit_kontrak($data,$id)
    {

        // pr($data);exit; 
        global $url_rewrite;
        unset($data['id']);

        $data['n_status'] = 0; 
            foreach ($data as $key => $val) {
                $tmpset[] = $key."='".$val."'";
            }
            $set = implode(',', $tmpset);

            $query = "UPDATE kontrak SET {$set} WHERE id='{$id}'";
            // pr($query);exit;
            $result=  $this->query($query) or die($this->error());

        $data['kontrak_id'] = $id;
        $data['action'] = 'update';
        $data['changeDate'] = date('Y/m/d');
        $data['operator'] = "{$_SESSION['ses_uoperatorid']}";
        // pr($data);exit;
        foreach ($data as $key => $val) {
            $tmplogfield[] = $key;
            $tmplogvalue[] = "'$val'";
        }
        $field = implode(',', $tmplogfield);
        $value = implode(',', $tmplogvalue);

        $query_log = "INSERT INTO log_kontrak ({$field}) VALUES ($value)";
        // pr($query_log);exit;
        $result=  $this->query($query_log) or die($this->error());

            echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_simbada.php\">";
    }

    public function store_aset($data)
    {

        // pr($data);exit; 
        global $url_rewrite;
        unset($data['Aset_ID']);

            foreach ($data as $key => $val) {
                $tmpfield[] = $key;
                $tmpvalue[] = "'$val'";
            }
            $field = implode(',', $tmpfield);
            $value = implode(',', $tmpvalue);

            $query = "INSERT INTO kontrak ({$field}) VALUES ($value)";
            $result=  $this->query($query) or die($this->error());

        $query_id = mysql_query("SELECT id FROM kontrak ORDER BY id DESC LIMIT 1");
        while ($row = mysql_fetch_assoc($query_id)){
             $data['kontrak_id'] = $row['id'];
        }

        $data['action'] = 'insert';
        $data['changeDate'] = date('Y/m/d');
        $data['operator'] = "{$_SESSION['ses_uoperatorid']}";
        // pr($data);exit;
        foreach ($data as $key => $val) {
            $tmplogfield[] = $key;
            $tmplogvalue[] = "'$val'";
        }
        $field = implode(',', $tmplogfield);
        $value = implode(',', $tmplogvalue);

        $query_log = "INSERT INTO log_kontrak ({$field}) VALUES ($value)";

        $result=  $this->query($query_log) or die($this->error());

            echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_simbada.php\">";
    }

}

?>
