<?php
class UPDATE extends DB{
    
    public function update_data_pengadaan($parameter)
    {
      
$kontraktor=  get_auto_increment("Kontraktor");
$kontrak=  get_auto_increment("Kontrak");
$aset=  get_auto_increment("Aset");

$kd_ekd_noreg_pemilik=$_POST['kd_ekd_noreg_pemilik'];
$kd_ekd_noreg=$_POST['kd_ekd_noreg'];
$kd_ekd_nama_aset= $_POST['kd_ekd_nama_aset'];
$kd_ekd_ruangan= $_POST['kd_ekd_ruangan'];
$kd_ekd_alamat= $_POST['kd_ekd_alamat'];
$kd_ekd_rt= $_POST['kd_ekd_rt'];
$kd_ekd_perolehan_ket_asalusul= $_POST['kd_ekd_perolehan_ket_asalusul'];
$kd_ekd_gol7_kuantitas=$_POST['kd_ekd_gol7_kuantitas'];
$kd_ekd_gol7_satuan=$_POST['kd_ekd_gol7_satuan'];
$kd_ekd_perolehan_caraperolehan=$_POST['kd_ekd_perolehan_caraperolehan'];
$kd_ekd_penghapusan_aset=$_POST['kd_ekd_penghapusan_aset'];

$kd_ekd_perolehan_tglperoleha = $_POST['kd_ekd_perolehan_tglperolehan']; ///bulan/tanggal/tahun 
            $datesd = explode('/', $kd_ekd_perolehan_tglperoleha); ///
            $kd_ekd_perolehan_tglperolehan = $datesd[2].$datesd[1].$datesd[0];      

$kd_ekd_perolehan_thnperolehan= $_POST['kd_ekd_perolehan_thnperolehan'];
$kd_ekd_perolehan_nilai= $_POST['kd_ekd_perolehan_nilai'];

//golongan tanah
$kd_ekd_gtanah_luaskeseluruhan = $_POST['kd_ekd_gtanah_luaskeseluruhan'];
$kd_ekd_gtanah_luasbangunan = $_POST['kd_ekd_gtanah_luasbangunan'];
$kd_ekd_gtanah_saranalingkungan = $_POST['kd_ekd_gtanah_saranalingkungan'];
$kd_ekd_gtanah_tanahkosong = $_POST['kd_ekd_gtanah_tanahkosong'];
$kd_ekd_gtanah_hakpakai = $_POST['kd_ekd_gtanah_hakpakai'];
$kd_ekd_gtanah_nosertifikat = $_POST['kd_ekd_gtanah_nosertifikat'];
$kd_ekd_gtanah_tglsertifika = $_POST['kd_ekd_gtanah_tglsertifikat']; ///bulan/tanggal/tahun 
$datee = explode('/', $kd_ekd_gtanah_tglsertifika); ///
$kd_ekd_gtanah_tglsertifikat = $datee[2] . $datee[1] . $datee[0];
$kd_ekd_gtanah_penggunaan = $_POST['kd_ekd_gtanah_penggunaan'];
$kd_ekd_gtanah_batasutara = $_POST['kd_ekd_gtanah_batasutara'];
$kd_ekd_gtanah_batasselatan = $_POST['kd_ekd_gtanah_batasselatan'];
$kd_ekd_gtanah_batasbarat = $_POST['kd_ekd_gtanah_batasbarat'];
$kd_ekd_gtanah_batastimur = $_POST['kd_ekd_gtanah_batastimur'];

//golongan mesin
$kd_ekd_gmsn_peralatan = $_POST['kd_ekd_gmsn_peralatan'];
$kd_ekd_gmsn_tipemodel = $_POST['kd_ekd_gmsn_tipemodel'];
$kd_ekd_gmsn_ukuran = $_POST['kd_ekd_gmsn_ukuran'];
$kd_ekd_gmsn_silinder = $_POST['kd_ekd_gmsn_silinder'];
$kd_ekd_gmsn_merek = $_POST['kd_ekd_gmsn_merek'];
$kd_ekd_gmsn_jumlahmesin = $_POST['kd_ekd_gmsn_jumlahmesin'];
$kd_ekd_gmsn_material = $_POST['kd_ekd_gmsn_material'];
$kd_ekd_gmsn_noseripabrik = $_POST['kd_ekd_gmsn_noseripabrik'];
$kd_ekd_gmsn_rangka = $_POST['kd_ekd_gmsn_rangka'];
$kd_ekd_gmsn_nomesin = $_POST['kd_ekd_gmsn_nomesin'];
$kd_ekd_gmsn_nopolisi = $_POST['kd_ekd_gmsn_nopolisi'];
$kd_ekd_gmsn_tglstn = $_POST['kd_ekd_gmsn_tglstnk']; ///bulan/tanggal/tahun 
$datef = explode('/', $kd_ekd_gmsn_tglstn); ///
$kd_ekd_gmsn_tglstnk = $datef[2] . $datef[1] . $datef[0];
$kd_ekd_gmsn_nobpkb = $_POST['kd_ekd_gmsn_nobpkb'];
$kd_ekd_gmsn_tglbpk = $_POST['kd_ekd_gmsn_tglbpkb']; ///bulan/tanggal/tahun 
$dateg = explode('/', $kd_ekd_gmsn_tglbpk); ///
$kd_ekd_gmsn_tglbpkb = $dateg[2] . $dateg[1] . $dateg[0];
$kd_ekd_gmsn_nodokumenlain = $_POST['kd_ekd_gmsn_nodokumenlain'];
$kd_ekd_gmsn_tgldokumenlai = $_POST['kd_ekd_gmsn_tgldokumenlain']; ///bulan/tanggal/tahun 
$dateh = explode('/', $kd_ekd_gmsn_tgldokumenlai ); ///
$kd_ekd_gmsn_tgldokumenlain = $dateh[2] . $dateh[1] . $dateh[0];
$kd_ekd_gmsn_tahunpembutan = $_POST['kd_ekd_gmsn_tahunpembutan'];
$kd_ekd_gmsn_bahanbakar = $_POST['kd_ekd_gmsn_bahanbakar'];
$kd_ekd_gmsn_pabrik = $_POST['kd_ekd_gmsn_pabrik'];
$kd_ekd_gmsn_negaraasal = $_POST['kd_ekd_gmsn_negaraasal'];
$kd_ekd_gmsn_kapasitas= $_POST['kd_ekd_gmsn_kapasitas'];
$kd_ekd_gmsn_bobot = $_POST['kd_ekd_gmsn_bobot'];
$kd_ekd_gmsn_negara_perakitan = $_POST['kd_ekd_gmsn_negara_perakitan'];
//golongan gedung
$kd_ekd_gdg_konstruksi = $_POST['kd_ekd_gdg_konstruksi'];
$kd_ekd_gdg_konstruksi2 = $_POST['kd_ekd_gdg_konstruksi2'];
$kd_ekd_gdg_jumlah_lantai = $_POST['kd_ekd_gdg_jumlah_lantai'];
$kd_ekd_gdg_luaslantai = $_POST['kd_ekd_gdg_luaslantai'];
$kd_ekd_gdg_dinding = $_POST['kd_ekd_gdg_dinding'];
$kd_ekd_gdg_lantai = $_POST['kd_ekd_gdg_lantai'];
$kd_ekd_gdg_plafon = $_POST['kd_ekd_gdg_plafon'];
$kd_ekd_gdg_atap = $_POST['kd_ekd_gdg_atap'];
$kd_ekd_gdg_nodokumen = $_POST['kd_ekd_gdg_nodokumen'];


$kd_ekd_gdg_tgldokume = $_POST['kd_ekd_gdg_tgldokumen']; ///bulan/tanggal/tahun 
$dateas = explode('/', $kd_ekd_gdg_tgldokume); ///
$kd_ekd_gdg_tgldokumen = $dateas[2] . $dateas[1] . $dateas[0];

$kd_ekd_gdg_tglpemakaia = $_POST['kd_ekd_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
$datei = explode('/', $kd_ekd_gdg_tglpemakaia); ///
$kd_ekd_gdg_tglpemakaian = $datei[2] . $datei[1] . $datei[0];
$kd_ekd_gdg_statustanah = $_POST['kd_ekd_gdg_statustanah'];
$kd_ekd_gdg_asettanah = $_POST['kd_ekd_gdg_asettanah'];
$kd_ekd_gdg_kodetanah = $_POST['kd_ekd_gdg_kodetanah'];
$kd_ekd_gdg_no_imb = $_POST['kd_ekd_gdg_no_imb'];
$kd_ekd_gdg_tglim = $_POST['kd_ekd_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
$datej = explode('/', $kd_ekd_gdg_tglim); ///
$kd_ekd_gdg_tglimb = $datej[2] . $datej[1] . $datej[0];
//golongan jalan
$kd_ekd_gjal_konstruksi = $_POST['kd_ekd_gjal_konstruksi'];
$kd_ekd_gjal_panjang = $_POST['kd_ekd_gjal_panjang'];
$kd_ekd_gjal_lebar = $_POST['kd_ekd_gjal_lebar'];
$kd_ekd_gjal_nodokumen = $_POST['kd_ekd_gjal_nodokumen'];
$kd_ekd_gjal_tgldokume = $_POST['kd_ekd_gjal_tgldokumen']; ///bulan/tanggal/tahun 
$dateaa = explode('/', $kd_ekd_gjal_tgldokume); ///
$kd_ekd_gjal_tgldokumen = $dateaa[2] . $dateaa[1] . $dateaa[0];
$kd_ekd_gjal_tglpemakaia=$_POST['kd_ekd_gjal_tglpemakaian'];
$dateab = explode('/', $kd_ekd_gjal_tglpemakaia); ///
$kd_ekd_gjal_tglpemakaian = $dateab[2] . $dateab[1] . $dateab[0];
$kd_ekd_gjal_statustanah = $_POST['kd_ekd_gjal_statustanah'];
$kd_ekd_gjal_pilih_asettanah = $_POST['kd_ekd_gjal_pilih_asettanah'];
$kd_ekd_gjal_no_kode_tanah = $_POST['kd_ekd_gjal_no_kode_tanah'];


//golongan aset tetap lainnya
//golongan buku
$kd_ekd_gol5_judul=$_POST['kd_ekd_gol5_judul'];
$p_gol5_pengarang=$_POST['p_gol5_pengarang'];
$kd_ekd_gol5_penerbit=$_POST['kd_ekd_gol5_penerbit'];
$kd_ekd_gol5_spesifikasi=$_POST['kd_ekd_gol5_spesifikasi'];
$kd_ekd_gol5_tahunterbit=$_POST['kd_ekd_gol5_tahunterbit'];
$kd_ekd_gol5_isbn=$_POST['kd_ekd_gol5_isbn'];
$kd_ekd_gol5_kuantitas3=$_POST['kd_ekd_gol5_kuantitas3'];
$kd_ekd_gol5_satuan3=$_POST['kd_ekd_gol5_satuan3'];
//golongan barang kesenian
$kd_ekd_gol5_judul=$_POST['kd_ekd_gol5_judul'];
$kd_ekd_gol5_asaldaerah=$_POST['kd_ekd_gol5_asaldaerah'];
$kd_ekd_gol5_pencipta=$_POST['kd_ekd_gol5_pencipta'];
$kd_ekd_gol5_bahan=$_POST['kd_ekd_gol5_bahan'];
$kd_ekd_gol5_kuantitas=$_POST['kd_ekd_gol5_kuantitas'];
$kd_ekd_gol5_satuan=$_POST['kd_ekd_gol5_satuan'];
//golongan hewan
$kd_ekd_gol5_jenis=$_POST['kd_ekd_gol5_jenis'];
$kd_ekd_gol5_ukuran=$_POST['kd_ekd_gol5_ukuran'];
$kd_ekd_gol5_kuantitas1=$_POST['kd_ekd_gol5_kuantitas1'];
$kd_ekd_gol5_satuan1=$_POST['kd_ekd_gol5_satuan1'];
//golongan konstruksi
$kd_ekd_gol6_konstruksi=$_POST['kd_ekd_gol6_konstruksi'];
$kd_ekd_gol6_beton=$_POST['kd_ekd_gol6_beton'];
$kd_ekd_gol6_lantai=$_POST['kd_ekd_gol6_lantai'];
$kd_ekd_gol6_luastanah=$_POST['kd_ekd_gol6_luastanah'];
$kd_ekd_gol6_tanggalpembanguna = $_POST['kd_ekd_gol6_tanggalpembangunan']; ///bulan/tanggal/tahun 
            $dateac = explode('/', $kd_ekd_gol6_tanggalpembanguna); ///
           $kd_ekd_gol6_tanggalpembangunan = $dateac[2].$datea[1].$dateac[0];   
$kd_ekd_gol6_gol6_statustanah=$_POST['kd_ekd_gol6_gol6_statustanah'];

$kd_ekd_gol6_nokodetanah=$_POST['kd_ekd_gol6_nokodetanah'];
//golongan persediaan
$p_gol7_kuantitas4=$_POST['p_gol7_kuantitas4'];
$p_gol7_satuan4=$_POST['p_gol7_satuan4'];
//
//koordinat

$kd_ekd_koordinat_bujur_a=$_POST['kd_ekd_koordinat_bujur_a'];
$kd_ekd_koordinat_bujur_b=$_POST['kd_ekd_koordinat_bujur_b'];
$kd_ekd_koordinat_bujur_c=$_POST['kd_ekd_koordinat_bujur_c'];
$kd_ekd_koordinat_bujur_d=$_POST['kd_ekd_koordinat_bujur_d'];
$kd_ekd_koordinat_lintang_a=$_POST['kd_ekd_koordinat_lintang_a'];
$kd_ekd_koordinat_lintang_b=$_POST['kd_ekd_koordinat_lintang_b'];
$kd_ekd_koordinat_lintang_c=$_POST['kd_ekd_koordinat_lintang_c'];
$kd_ekd_koordinat_lintang_d=$_POST['kd_ekd_koordinat_lintang_d'];
$kd_ekd_koordinat = $kd_ekd_koordinat_bujur_a. '.'.$kd_ekd_koordinat_bujur_b.'.'.$kd_ekd_koordinat_bujur_c.'.'.$kd_ekd_koordinat_bujur_d.'.'.$kd_ekd_koordinat_lintang_a.'.'.$kd_ekd_koordinat_lintang_b.'.'.$kd_ekd_koordinat_lintang_c.'.'.$kd_ekd_koordinat_lintang_d ;


//hibah//
$kd_ekd_hibah_pemberi=$_POST['kd_ekd_hibah_pemberi'];
$kd_ekd_hibah_nobbast=$_POST['kd_ekd_hibah_nobbast'];
$kd_ekd_hibah_tglbas= $_POST['kd_ekd_hibah_tglbast']; ///bulan/tanggal/tahun 
            $dateai = explode('/', $kd_ekd_hibah_tglbas); ///
           $kd_ekd_hibah_tglbast = $dateai[2].$dateai[1].$dateai[0];   
$kd_ekd_hibah_namapertama=$_POST['kd_ekd_hibah_namapertama'];
$kd_ekd_hibah_jabatan_pertama=$_POST['kd_ekd_hibah_jabatan_pertama'];
$kd_ekd_hibah_nippertama=$_POST['kd_ekd_hibah_nippertama'];
$kd_ekd_hibah_namakedua=$_POST['kd_ekd_hibah_namakedua'];
$kd_ekd_hibah_jabatan_kedua=$_POST['kd_ekd_hibah_jabatan_kedua'];
$kd_ekd_hibah_nipkedua=$_POST['kd_ekd_hibah_nipkedua'];
//kontrak
$kd_ekd_pengadaan_sumberdana=$_POST['kd_ekd_pengadaan_sumberdana'];
$kd_ekd_pengadaan_nosp2d=$_POST['kd_ekd_pengadaan_nosp2d'];
$kd_ekd_pengadaan_tglsp2= $_POST['kd_ekd_pengadaan_tglsp2d']; ///bulan/tanggal/tahun 
            $dateaic = explode('/', $kd_ekd_pengadaan_tglsp2);
           $kd_ekd_pengadaan_tglsp2d = $dateaic[2].$dateaic[1].$dateaic[0];            
$kd_ekd_pengadaan_mataanggaran=$_POST['kd_ekd_pengadaan_mataanggaran'];
$kd_ekd_pengadaan_kontraktor=$_POST['kd_ekd_pengadaan_kontraktor'];
$kd_ekd_pengadaan_nilaisp2d=$_POST['kd_ekd_pengadaan_nilaisp2d'];
$kd_ekd_pengadaan_nokontrak=$_POST['kd_ekd_pengadaan_nokontrak'];
$kd_ekd_pengadaan_nilaikontrak=$_POST['kd_ekd_pengadaan_nilaikontrak'];
$kd_ekd_pengadaan_tglkontra= $_POST['kd_ekd_pengadaan_tglkontrak']; ///bulan/tanggal/tahun 
            $datezs = explode('/', $kd_ekd_pengadaan_tglkontra); ///
           $kd_ekd_pengadaan_tglkontrak = $datezs[2].$datezs[1].$datezs[0];  
           
$kd_ekd_pengadaan_pekerjaan=$_POST['kd_ekd_pengadaan_pekerjaan'];
//keputusan Pengadilan
$kd_ekd_pengadilan_nokeputusan=$_POST['kd_ekd_pengadilan_nokeputusan'];
$kd_ekd_pengadilan_jenisaset=$_POST['kd_ekd_pengadilan_jenisaset'];
$kd_ekd_pengadilan_asalaset=$_POST['kd_ekd_pengadilan_asalaset'];
$kd_ekd_pengadilan_keterangan=$_POST['kd_ekd_pengadilan_keterangan'];

//keputusan undang-undang
$kd_ekd_undang_nokeputusanuud=$_POST['kd_ekd_undang_nokeputusanuud'];
$kd_ekd_undang_jenisasetuud=$_POST['kd_ekd_undang_jenisasetuud'];
$kd_ekd_undang_asalasetuud=$_POST['kd_ekd_undang_asalasetuud'];
$kd_ekd_undang_keteranganuud=$_POST['kd_ekd_undang_keteranganuud'];
//pemindahtanganan
$kd_ekd_p_tangan_peruntukan=$_POST['kd_ekd_p_tangan_peruntukan'];
$kd_ekd_p_tangan_nobasp=$_POST['kd_ekd_p_tangan_nobasp'];
$kd_ekd_tangan_tglbas = $_POST['kd_ekd_tangan_tglbasp']; ///bulan/tanggal/tahun 
           $datead = explode('/', $kd_ekd_tangan_tglbas); ///
           $kd_ekd_tangan_tglbasp = $datead[2].$datea[1].$datead[0];   
$kd_ekd_p_tangan_namapertama=$_POST['kd_ekd_p_tangan_namapertama'];
$kd_ekd_p_tangan_jbtnpertama=$_POST['kd_ekd_p_tangan_jbtnpertama'];
$kd_ekd_p_tangan_nippertama=$_POST['kd_ekd_p_tangan_nippertama'];
$kd_ekd_p_tangan_lokasipertama=$_POST['kd_ekd_p_tangan_lokasipertama'];
$kd_ekd_p_tangan_namakedua=$_POST['kd_ekd_p_tangan_namakedua'];
$kd_ekd_p_tangan_jbtnkedua=$_POST['kd_ekd_p_tangan_jbtnkedua'];
$kd_ekd_p_tangan_nipkedua=$_POST['kd_ekd_p_tangan_nipkedua'];
$kd_ekd_p_tangan_lokasikedua=$_POST['kd_ekd_p_tangan_lokasikedua'];
$kd_ekd_p_tangan_noskpenetapan=$_POST['kd_ekd_p_tangan_noskpenetapan'];
$kd_ekd_p_tangan_tglskpenetapa = $_POST['kd_ekd_p_tangan_tglskpenetapan']; ///bulan/tanggal/tahun 
            $dateae = explode('/', $kd_ekd_p_tangan_tglskpenetapa); ///
           $kd_ekd_p_tangan_tglskpenetapan = $dateae [2].$dateae [1].$dateae [0];   
$kd_ekd_p_tangan_noskhapus=$_POST['kd_ekd_p_tangan_noskhapus'];
$kd_ekd_p_tangan_tglskhapus=$_POST['kd_ekd_p_tangan_tglskhapus'];
$kd_ekd_p_tangan_tglskhapu = $_POST['kd_ekd_p_tangan_tglskhapus']; ///bulan/tanggal/tahun 
            $dateaf = explode('/', $kd_ekd_p_tangan_tglskhapu); ///
           $kd_ekd_p_tangan_tglskhapus = $dateaf  [2].$dateaf  [1].$dateaf  [0];              
$kd_ekd_keterangantambahan=$_POST['kd_ekd_keterangantambahan'];           
// penghapusan
 $kd_ekd_pmusnah_keterangan=$_POST['kd_ekd_pmusnah_keterangan']; 
 $kd_ekd_pmusnah_noskpenetapan=$_POST['kd_ekd_pmusnah_noskpenetapan'];   
 $kd_ekd_pmusnah_tglskpenetapa = $_POST['kd_ekd_pmusnah_tglskpenetapan']; ///bulan/tanggal/tahun 
            $dateag = explode('/', $kd_ekd_pmusnah_tglskpenetapa); ///
           $kd_ekd_pmusnah_tglskpenetapan = $dateag[2].$dateag  [1].$dateag [0];   
 $kd_ekd_pmusnah_noskhapus=$_POST['kd_ekd_pmusnah_noskhapus'];   
 $kd_ekd_pmusnah_tglskhapus=$_POST['kd_ekd_pmusnah_tglskhapus'];   
 $kd_ekd_pmusnah_tglskhapu = $_POST['kd_ekd_pmusnah_tglskhapus']; ///bulan/tanggal/tahun 
            $dateah = explode('/', $kd_ekd_pmusnah_tglskhapu); ///
           $kd_ekd_pmusnah_tglskhapus = $dateah   [2]. $dateah   [1]. $dateah   [0];   
//pemeriksaan
$aset_id = $_POST['Aset_ID'];
$kd_ekd_periksa_no_ba = $_POST['kd_ekd_periksa_no_ba'];
$kd_ekd_periksa_tglpemeriksaa = $_POST['kd_ekd_periksa_tglpemeriksaan']; ///bulan/tanggal/tahun 
$dateb = explode('/', $kd_ekd_periksa_tglpemeriksaa); ///
$kd_ekd_periksa_tglpemeriksaan = $dateb[2] . $dateb[1] . $dateb[0];
$kd_ekd_ststus_pemeriksaan = $_POST['kd_ekd_ststus_pemeriksaan'];
$kd_ekd_periksa_ketua_pemeriksa = $_POST['kd_ekd_periksa_ketua_pemeriksa'];
$kd_ekd_periksa_no_ba_penerimaan = $_POST['kd_ekd_periksa_no_ba_penerimaan'];
$kd_ekd_periksa_tglpenerimaa = $_POST['kd_ekd_periksa_tglpenerimaan']; ///bulan/tanggal/tahun 
$datec = explode('/', $kd_ekd_periksa_tglpenerimaa); ///
$kd_ekd_periksa_tglpenerimaan = $datec[2] . $datec[1] . $datec[0];
$kd_ekd_periksa_namapenyedia = $_POST['kd_ekd_periksa_namapenyedia'];
$kd_ekd_periksa_namapengurus = $_POST['kd_ekd_periksa_namapengurus'];
$kd_ekd_periksa_nippengurus = $_POST['kd_ekd_periksa_nippengurus'];

$aset_id=$_POST['Aset_ID'];
 $Kontraktor_ID=$_POST['kontraktor_id'];
 $sp2d_ID=$_POST['SP2D_ID'];
  
$Penerimaan_ID=$_POST['Penerimaan_ID'];
$BAST_ID=$_POST['BAST_ID'];
$BASP_ID=$_POST['BASP_ID'];
$Kontrakid=$_POST['Kontrak_ID'];
$sp2did=$_POST['SP2D_ID'];   
        
       
          if ($Penerimaan_ID !='')
    {
    $querypenerimaanupdate = "UPDATE  Penerimaan SET  TglPemeriksaan = '$kd_ekd_periksa_tglpemeriksaan',
                                                                NoBAPemeriksaan='$kd_ekd_periksa_no_ba',
                                                                KetuaPemeriksa='$kd_ekd_periksa_ketua_pemeriksa',
                                                                StatusPemeriksaan= '$kd_ekd_ststus_pemeriksaan',
                                                                NoBAPenerimaan= '$kd_ekd_periksa_no_ba_penerimaan',
                                                                TglPenerimaan= '$kd_ekd_periksa_tglpenerimaan',
                                                                NamaPenyedia= '$kd_ekd_periksa_namapenyedia',
                                                                NamaPenyimpan= '$kd_ekd_periksa_namapengurus',
                                                                NIPPenyimpan= '$kd_ekd_periksa_nippengurus'
    WHERE Penerimaan_ID=$Penerimaan_ID";
    $resultpenerimaan = mysql_query($querypenerimaanupdate) or die ('eror20');
    }
        if ($aset_id !='')
        {
   
            $queryupdatemesin = "UPDATE  Mesin SET   Merk= '$kd_ekd_gmsn_peralatan', Model='$kd_ekd_gmsn_tipemodel',
                                Ukuran='$kd_ekd_gmsn_ukuran', Silinder='$kd_ekd_gmsn_silinder',
                                MerkMesin='$kd_ekd_gmsn_merek', JumlahMesin='$kd_ekd_gmsn_jumlahmesin',
                                Material='$kd_ekd_gmsn_material', NoSeri='$kd_ekd_gmsn_noseripabrik',
                                NoRangka='$kd_ekd_gmsn_rangka', NoMesin='$kd_ekd_gmsn_nomesin',
                                NoSTNK='$kd_ekd_gmsn_nopolisi', TglSTNK='$kd_ekd_gmsn_tglstnk',
                                NoBPKB='$kd_ekd_gmsn_nobpkb', TglBPKB='$kd_ekd_gmsn_tglbpkb',
                                NoDokumen='$kd_ekd_gmsn_nodokumenlain', TglDokumen='$kd_ekd_gmsn_tgldokumenlain',
                                TahunBuat='$kd_ekd_gmsn_tahunpembutan', BahanBakar='$kd_ekd_gmsn_bahanbakar',
                                Pabrik='$kd_ekd_gmsn_pabrik', NegaraAsal='$kd_ekd_gmsn_negaraasal',
                                kapasitas='$kd_ekd_gmsn_kapasitas', Bobot='$kd_ekd_gmsn_bobot',
                                NegaraRakit='$kd_ekd_gmsn_negara_perakitan'
                                WHERE Aset_ID=$aset_id";
            $resultmesin = mysql_query($queryupdatemesin) or die ('eror21');
        
            $queryupdatetanah = "UPDATE  Tanah SET  LuasTotal = '$kd_ekd_gtanah_luaskeseluruhan',
                                LuasBangunan='$kd_ekd_gtanah_luasbangunan', LuasSekitar='$kd_ekd_gtanah_saranalingkungan',
                                LuasKosong= '$kd_ekd_gtanah_tanahkosong', HakTanah= '$kd_ekd_gtanah_hakpakai',
                                NoSertifikat= '$kd_ekd_gtanah_nosertifikat', TglSertifikat= '$kd_ekd_gtanah_tglsertifikat',
                                Penggunaan= '$kd_ekd_gtanah_penggunaan', BatasUtara= '$kd_ekd_gtanah_batasutara',
                                BatasSelatan='$kd_ekd_gtanah_batasselatan', BatasBarat='$kd_ekd_gtanah_batasbarat',
                                BatasTimur='$kd_ekd_gtanah_batastimur'
                                WHERE Aset_ID=$aset_id";
            $resulttanah = mysql_query($queryupdatetanah) or die ('eror22');
            
            $queryupdatebangunan = "UPDATE  Bangunan SET Konstruksi ='$kd_ekd_gdg_konstruksi', Beton='$kd_ekd_gdg_konstruksi2',
                                    JumlahLantai= '$kd_ekd_gdg_jumlah_lantai', LuasLantai= '$kd_ekd_gdg_luaslantai',
                                    Dinding= '$kd_ekd_gdg_dinding', Lantai= '$kd_ekd_gdg_lantai',
                                    LangitLangit= '$kd_ekd_gdg_plafon', NoSurat= '$kd_ekd_gdg_nodokumen',
                                    Atap= '$kd_ekd_gdg_atap', TglSurat= '$kd_ekd_gdg_tgldokumen',
                                    TglPakai= '$kd_ekd_gdg_tglpemakaian', StatusTanah= '$kd_ekd_gdg_statustanah',
                                    Tanah_ID= '$kd_ekd_gdg_asettanah', NoIMB= '$kd_ekd_gdg_no_imb',
                                    TglIMB= '$kd_ekd_gdg_tglimb'
                                    WHERE Aset_ID=$aset_id";
            $resultbangunan = mysql_query($queryupdatebangunan) or die ('eror22');
           
            $queryupdatejaringan = "UPDATE  Jaringan SET   Konstruksi= '$kd_ekd_gjal_konstruksi', Panjang= '$kd_ekd_gjal_panjang',
                                    Lebar= '$kd_ekd_gjal_lebar', NoDokumen= '$kd_ekd_gjal_nodokumen',
                                    TglDokumen= '$kd_ekd_gjal_tgldokumen', TanggalPemakaian='$kd_ekd_gjal_tglpemakaian',
                                    StatusTanah= '$kd_ekd_gjal_statustanah', KelompokTanah_ID= '$kd_ekd_gjal_pilih_asettanah',
                                    Tanah_ID= '$kd_ekd_gjal_no_kode_tanah'       
                                    WHERE Aset_ID=$aset_id";
            $resultjaringan = mysql_query( $queryupdatejaringan ) or die ('eror23');
           
               
            $queryupdateasetlain = "UPDATE  AsetLain SET   Judul='$kd_ekd_gol5_judul', Pengarang='$kd_ekd_gol5_pengarang',
                                    Penerbit='$kd_ekd_gol5_penerbit', Spesifikasi='$kd_ekd_gol5_spesifikasi',
                                    TahunTerbit='$kd_ekd_gol5_tahunterbit', ISBN='$kd_ekd_gol5_isbn',
                                    Judul='$kd_ekd_gol5_jenis', Ukuran='$kd_ekd_gol5_ukuran',
                                    Judul='$kd_ekd_gol5_judul', AsalDaerah='$kd_ekd_gol5_asaldaerah',
                                    Pengarang='$kd_ekd_gol5_pencipta', Material='$kd_ekd_gol5_bahan'
                                    WHERE Aset_ID=$aset_id";
            $resultasetlain = mysql_query( $queryupdateasetlain ) or die ('eror24');
           
            $queryupdatekdp = "UPDATE  KDP SET   Konstruksi='$kd_ekd_gol6_konstruksi', Beton='$kd_ekd_gol6_beton',
                                JumlahLantai='$kd_ekd_gol6_lantai', LuasLantai='$kd_ekd_gol6_luastanah',
                                TglMulai='$kd_ekd_gol6_tanggalpembangunan', StatusTanah='$kd_ekd_gol6_gol6_statustanah',
                                KelompokTanah_ID='$kd_ekd_gol6_pilihasettanah', Tanah_ID='$kd_ekd_gol6_nokodetanah'
                                WHERE Aset_ID=$aset_id";
            $resultkdp = mysql_query( $queryupdatekdp ) or die ('eror25');
           
            $queryupdaset = "UPDATE  Aset SET     Peruntukan='$kd_ekd_p_tangan_peruntukan', NamaAset='$kd_ekd_nama_aset',
                            Ruangan='$kd_ekd_ruangan', Alamat='$kd_ekd_alamat', RTRW='$kd_ekd_rt',
                            AsalUsul='$kd_ekd_perolehan_ket_asalusul', TglPerolehan='$kd_ekd_perolehan_tglperolehan',
                            Tahun='$kd_ekd_perolehan_thnperolehan', NilaiPerolehan='$kd_ekd_perolehan_nilai',
                            Satuan='$kd_ekd_gol7_satuan', Kuantitas='$kd_ekd_gol7_kuantitas',
                            Pemilik='$kd_ekd_noreg_pemilik', NomorReg='$kd_ekd_noreg',
                            CaraPerolehan ='$kd_ekd_perolehan_caraperolehan', PenghapusanAset='$kd_ekd_penghapusan_aset',
                            SumberDana ='$kd_ekd_pengadaan_sumberdana'
                            WHERE Aset_ID=$aset_id";
            $resultaset= mysql_query( $queryupdaset ) or die ('eror26');
           
            $queryupdatekeputusanpengadilan = "UPDATE  KeputusanPengadilan  SET  NoKeputusan='$kd_ekd_pengadilan_nokeputusan',
                                                JenisAset='$kd_ekd_pengadilan_jenisaset', AsalAset='$kd_ekd_pengadilan_asalaset',
                                                Keterangan='$kd_ekd_pengadilan_keterangan'
                                                WHERE Aset_ID=$aset_id";
            $resultkeputusanpengadilan= mysql_query($queryupdatekeputusanpengadilan) or die ('eror28');
               
            $queryupdatekeputusanuud = "UPDATE  KeputusanUndangUndang  SET  NoKeputusan='$kd_ekd_undang_nokeputusanuud',
                                        JenisAset='$kd_ekd_undang_jenisasetuud', AsalAset='$kd_ekd_undang_asalasetuud',
                                        Keterangan='$kd_ekd_undang_keteranganuud'
                                        WHERE Aset_ID=$aset_id";
            $resultkeputusanuud= mysql_query($queryupdatekeputusanuud) or die ('eror29');
           
           
            $queryupdatelokasibaru = "UPDATE  lokasi_baru  SET  koordinat='$kd_ekd_koordinat' WHERE Aset_ID=$aset_id";
            $resultupdatelokasibaru= mysql_query( $queryupdatelokasibaru) or die ('eror34');
               
               
            $queryupdatepemusnahan = "UPDATE  Pemusnahan  SET  KetPemusnahan='$kd_ekd_pmusnah_keterangan',
                                        NoSKPenetapan='$kd_ekd_pmusnah_noskpenetapan', TglSKPenetapan='$kd_ekd_pmusnah_tglskpenetapan',
                                        NoSKPenghapusan='$kd_ekd_pmusnah_noskhapus', TglSKPenghapusan='$kd_ekd_pmusnah_tglskhapus'
                                        WHERE Aset_ID=$aset_id";
            $resultupdatepemusnahan= mysql_query( $queryupdatepemusnahan) or die ('eror31'); 
       
        }
        if ($sp2did !='')
        {
            $queryupdatesp2d= "UPDATE  SP2D  SET  NoSP2D='$kd_ekd_pengadaan_nosp2d', TglSP2D='$kd_ekd_pengadaan_tglsp2d',
                                MAK='$kd_ekd_pengadaan_mataanggaran', NilaiSP2D='$kd_ekd_pengadaan_nilaisp2d'
                                WHERE SP2D_ID= $sp2did";
            $resultupdatesp2d= mysql_query($queryupdatesp2d) or die ('eror35');
        }
        if ($BAST_ID !='')
        {
   
          
            $queryupdatebast = "UPDATE  BAST  SET    NoBAST='$kd_ekd_hibah_nobbast', TglBAST='$kd_ekd_hibah_tglbast',
                                NamaPihak1='$kd_ekd_hibah_namapertama', JabatanPihak1='$kd_ekd_hibah_jabatan_pertama',
                                NIPPihak1='$kd_ekd_hibah_nippertama', NamaPihak2='$kd_ekd_hibah_namakedua',
                                JabatanPihak2='$kd_ekd_hibah_jabatan_kedua', NIPPihak2='$kd_ekd_hibah_nipkedua'
                                WHERE BAST_ID=$BAST_ID";
            $resultbasts= mysql_query(  $queryupdatebast ) or die ('eror27');
        }
        if ($BASP_ID !='')
        {
            $queryupdatepemindahtanganan = "UPDATE  BASP  SET  NoBASP='$kd_ekd_p_tangan_nobasp', TglBASP='$kd_ekd_tangan_tglbasp',
                                            NamaPihak1='$kd_ekd_p_tangan_namapertama', JabatanPihak1='$kd_ekd_p_tangan_jbtnpertama',
                                            NIPPihak1='$kd_ekd_p_tangan_nippertama', LokasiPihak1='$kd_ekd_p_tangan_lokasipertama',
                                            NamaPihak2='$kd_ekd_p_tangan_namakedua', JabatanPihak2='$kd_ekd_p_tangan_jbtnkedua',
                                            NIPPihak2='$kd_ekd_p_tangan_nipkedua', LokasiPihak2='$kd_ekd_p_tangan_lokasikedua',
                                            NoSKPenetapan='$kd_ekd_p_tangan_noskpenetapan', TglSKPenetapan='$kd_ekd_p_tangan_tglskpenetapan',
                                            NoSKPenghapusan='$kd_ekd_p_tangan_noskhapus', TglSKPenghapusan='$kd_ekd_p_tangan_tglskhapus',
                                            KeteranganTambahan='$kd_ekd_keterangantambahan'    
                                            WHERE BASP_ID=$BASP_ID";
            $resultpemindahtanganan= mysql_query( $queryupdatepemindahtanganan) or die ('eror30');
        }
        if ($Kontrakid !='')    //kontrak
        {
            $queryupdatekontraka = "UPDATE  Kontrak  SET  NoKontrak ='$kd_ekd_pengadaan_nokontrak', NilaiKontrak = '$kd_ekd_pengadaan_nilaikontrak',
                                    TglKontrak = '$kd_ekd_pengadaan_tglkontrak', Pekerjaan ='$kd_ekd_pengadaan_pekerjaan'
                                    WHERE Kontrak_ID=$Kontrakid";
            $resultupdatekontrak= mysql_query( $queryupdatekontraka) or die ('eror33');
        }
        else if ($Kontrak_ID=='')    //kalau kontrak kosong
        {
            $querykontrak="insert into Kontrak(Kontrak_ID,NoKontrak,Kontraktor_ID, NilaiKontrak, TglKontrak,
                            Pekerjaan) values($kontrak,'$kd_ekd_pengadaan_nokontrak','$kontraktor',
                            '$kd_ekd_pengadaan_nilaikontrak', '$kd_ekd_pengadaan_tglkontrak',
                            '$kd_ekd_pengadaan_pekerjaan')";
       
            $resultkontrak=  mysql_query($querykontrak)or die('eror37');
           $querykontrakaset1="INSERT INTO KontrakAset (Kontrak_ID,Aset_ID) VALUES ('$kontrak','$aset_id')";
            $resultkontrakaset=  $this->query($querykontrakaset1)or die($this->error());
        }
        
        if ($Kontraktor_ID !='')
        {
            $queryupdatekontraktor = "UPDATE  Kontraktor  SET  NamaKontraktor ='$kd_ekd_pengadaan_kontraktor' WHERE Kontraktor_ID=$Kontraktor_ID";
            $resultupdatekontraktor= mysql_query( $queryupdatekontraktor) or die ('eror34');
        }
        elseif ($Kontraktor_ID=='')        {                
        {
            $querykontraktorr="insert into Kontraktor(Kontraktor_ID,NamaKontraktor) values(NULL,'$kd_ekd_pengadaan_kontraktor')";
            $resultkontraktor=  mysql_query($querykontraktorr)or die (mysql_error());
            
          
       }
        }
   
    }
    
   
	
	//tambahan
	
	//Dari Bayu 
	//PERENCANAAN
	public function update_rtpb_nonvalidasi($parameter)
    {
        $query 	= "UPDATE Perencanaan SET StatusValidasi=11 WHERE Perencanaan_ID= '$parameter' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_rtpb_nonvalidasi');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Berhasil Di Non Validasi")</script>';
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Di Non Validasi")</script>';
            return false;
        }
    }
	
	
	public function update_rtpb_validasi($parameter)
    {
        $query 	= "UPDATE Perencanaan SET StatusValidasi=12 WHERE Perencanaan_ID= '$parameter' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_rtpb_validasi');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Berhasil Di Validasi")</script>';
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Di Validasi")</script>';
            return false;
        }
    }
	
	
	public function update_rtb_nonvalidasi($parameter)
    {
        $query 	= "UPDATE Perencanaan SET StatusValidasi=10 WHERE Perencanaan_ID= '$parameter' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_rtb_nonvalidasi');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Berhasil Di Non Validasi")</script>';
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Di Non Validasi")</script>';
            return false;
        }
    }
	
	public function update_rtb_validasi($parameter)
    {
        $query 	= "UPDATE Perencanaan SET StatusValidasi=11 WHERE Perencanaan_ID= '$parameter' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_rkpb_edit');
        if ($result)
        {
			echo "<script type=text/javascript>alert('Data Berhasil Di Validasi')</script>";
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Di Validasi")</script>';
            return false;
        }
    }
	
	
	public function update_rkpb_edit($parameter)
    {
		$pelihara	= $parameter['param']['rkpb_edit_pem'];
		$id 		= $parameter['param']['ID'];
        $query 	= "UPDATE Perencanaan SET Pemeliharaan ='".$pelihara."' WHERE Perencanaan_ID = '$id' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_rkpb_edit');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Berhasil Diedit")</script>';
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Diedit")</script>';
            return false;
        }
    }
	
	public function update_rkpb_pemeliharaan($parameter)
    {
		$pelihara	= $parameter['param']['rkpb_add_thrg'];
		$id 		= $parameter['param']['ID'];
        $query 	= "UPDATE Perencanaan SET Pemeliharaan ='".$pelihara."', StatusPemeliharaan='1' WHERE Perencanaan_ID = '$id' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_rkpb_pemeliharaan');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Berhasil Diedit")</script>';
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Diedit")</script>';
            return false;
        }
    }
	
	public function update_rkb_edit($parameter)
    {
		$tahun	= $parameter['param']['rkb_edit_tahun'];
		$skpd	= $parameter['param']['skpd_id'];
		$lokasi	= $parameter['param']['lokasi_id'];
		$njb	= $parameter['param']['kelompok_id'];
		//$merk	= $_POST['Merek'];
		$korek	= $parameter['param']['rekening_id'];
		$jml	= $parameter['param']['rkb_edit_jml'];
		$thrg	= $parameter['param']['rkb_edit_thrg'];
		$id		= $parameter['param']['ID'];
		
		$query="select Spesifikasi from StandarHarga where Kelompok_ID='$njb' and TglUpdate like '$tahun%'";
		$result	= mysql_query($query)or die(mysql_error());
		while($row = mysql_fetch_object($result))
		{
			$merk=$row->Spesifikasi;
		}
		
        $query 	= "	UPDATE 
						Perencanaan 
					SET 
						Tahun ='".$tahun."', Satker_ID ='".$skpd."', Lokasi_ID ='".$lokasi."', 
						Kelompok_ID ='".$njb."', Merk ='".$merk."', KodeRekening ='".$korek."', 
						Kuantitas ='".$jml."', NilaiAnggaran ='".$thrg."' WHERE Perencanaan_ID = '$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error update_rkb_edit');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Berhasil Diedit")</script>';
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Diedit")</script>';
            return false;
        }
    }
	
	public function update_skb_edit($parameter)
    {
		$id 	= $parameter['param']['ID'];
		$njb	= $parameter['param']['kelompok_id'];
		$skpd	= $parameter['param']['skpd_id'];
		$lokasi	= $parameter['param']['lokasi_id'];
		
		$tanggal = explode("/",$parameter['param']['skb_add_tgl']);
		$tgl	= $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
		
		$ket	= $parameter['param']['skb_add_ket'];
		$jml	= $parameter['param']['skb_add_jml'];
        $query 	= "	UPDATE 
						StandarKebutuhan 
					SET 
						skb_njb ='".$njb."',skb_skpd='".$skpd."',skb_lokasi='".$lokasi."',skb_tgl='".$tgl."',skb_ket='".$ket."',skb_jml='".$jml."' WHERE skb_id = '$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error update_shpb_edit');
        if ($result)
        {
			echo '<script type=text/javascript>alert("Data Berhasil Diedit")</script>';
            return true;
        }
        else
        {
			echo '<script type=text/javascript>alert("Data Gagal Diedit")</script>';
            return false;
        }
    }
	
	
	public function update_shpb_hapus($parameter)
    {
		$id = $parameter['param']['ID'];
        $query 	= "UPDATE StandarHarga SET StatusPemeliharaan ='0', Pemeliharaan ='' WHERE StandarHarga_ID ='$id' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_shpb_edit');
        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	public function update_shpb_edit($parameter)
    {
		$pelihara	= $parameter['param']['shpb_edit_pem'];
		$id = $parameter['param']['ID'];
        $query 	= "UPDATE StandarHarga SET Pemeliharaan ='".$pelihara."' WHERE StandarHarga_ID = '$id' ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_shpb_edit');
        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	
	public function update_shpb_pemeliharaan_edit($parameter)
    {
		$pelihara	= $parameter['param']['shpb_add_pem'];
		$id = $parameter['param']['ID'];
        $query 	= "UPDATE StandarHarga SET Pemeliharaan ='".$pelihara."', StatusPemeliharaan='1' WHERE StandarHarga_ID = $id ";
		//print_r($query);
        $result = $this->query($query) or die ('error update_shpb_pemeliharaan_edit');
        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	public function update_shb_data($parameter)
    {
		$njb =$parameter['param']['kelompok_id'];
        $mat =$parameter['param']['shb_add_mat'];
        $tanggal =explode("/",$parameter['param']['shb_add_tgl']);
        $tgl =$tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
        $bhn =$parameter['param']['shb_add_bhn'];
		$satuan =$parameter['param']['shb_add_satuan'];
        $ket =$parameter['param']['shb_add_ket'];
        $hrg =$parameter['param']['shb_add_hrg'];
        $query 	= "UPDATE StandarHarga SET Kelompok_ID ='".$njb."', Merk ='".$mat."', Spesifikasi ='".$bhn."', Satuan ='".$satuan."',
                    TglUpdate ='".$tgl."', Keterangan ='".$ket."', NilaiStandar ='".$hrg."' WHERE StandarHarga_ID = ".$parameter['param']['ID'];
		print_r($query);
        $result = $this->query($query) or die ('error update_shb_data');
        if ($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	
	//GUDANG
    public function update_distribusi_barang()
    {
        $query = "update transfer set NoDokumen='$no_dokumen', TglTransfer='$tahun-$bulan-$tanggal', InfoTransfer='$alasan',
                    No_SPBB_distribusi_barang='$no_spbb', Tgl_SPBB_distribusi_barang='$thn-$bln-$tgl',
                    Nama_penyimpan='$nama_penyimpan', Nama_pengurus='$nama_pengurus', Pangkat_penyimpan='$pangkat_penyimpan',
                    Pangkat_pengurus='$pangkat_pengurus', NIP_penyimpan='$nip_penyimpan', NIP_pengurus='$nip_pengurus',
                    Nama_atasan_penyimpan='$nama_atasan', Pangkat_atasan_penyimpan='$pangkat_atasan_penyimpan',
                    NIP_atasan_penyimpan='$nip_atasan_penyimpan', Jabatan_penyimpan='$jabatan_penyimpan' where Aset_ID='$aset'";
        $query_2 = "update aset SET OriginDBSatker = '$transferke', LastSatker_ID='$transferke' where Aset_ID='$aset'";
        $query_3 = "update Aset SET OriginDBSatker = 0, Status_Validasi_Barang=0, LastSatker_ID=0 where Aset_ID='$aset'";
        $query_4 = "update Aset SET OriginDBSatker = '$transferke', LastSatker_ID='$transferke' where Aset_ID='$aset[$i]' and StatusValidasi!=0";
        $query_5 = "update Aset set Status_Validasi_Barang=1 where Aset_ID='$gudang[$i]'";
        
        $result = $this->query($query) or die ($this->error);
        $result_2 = $this->query($query_2) or die ($this->error);
        if ($result_2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function update_distribusi_barang_edit
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
        $query = "	UPDATE
						Transfer 
					SET 
						FromSatker_ID='$fromsatker',ToSatker_ID='$transferke',NoDokumen='$no_dokumen', 
						TglTransfer='$tahun-$bulan-$tanggal', InfoTransfer='$alasan', No_SPBB_distribusi_barang='$no_spbb', 
						Tgl_SPBB_distribusi_barang='$thn-$bln-$tgl', Nama_penyimpan='$nama_penyimpan', Nama_pengurus='$nama_pengurus', Pangkat_penyimpan='$pangkat_penyimpan', 
						Pangkat_pengurus='$pangkat_pengurus', NIP_penyimpan='$nip_penyimpan', NIP_pengurus='$nip_pengurus', Nama_atasan_penyimpan='$nama_atasan', 
						Pangkat_atasan_penyimpan='$pangkat_atasan_penyimpan', NIP_atasan_penyimpan='$nip_atasan_penyimpan', Jabatan_penyimpan='$jabatan_penyimpan' 
					WHERE
						Aset_ID='$aset'";
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
    
	public function update_gudang_validasi($gudang)
	{
		$query = "update Aset set Status_Validasi_Barang=1 where Aset_ID='$gudang'";
		// pr($query);
		// exit;
        $result = $this->query($query) or die ('error update_gudang_validasi');
		if ($result)
        {
            return true;    
        }
        else
        {
            return false;
        }
	}
    
	public function update_pemeriksaan_gudang_edit
	(
		$aset,
		$gudang_id,
		$gdg_dbedb_nobapemeriksa,
		$gdg_dbedb_tglpemeriksa,
		$gdg_dbedb_alasanpemeriksa,
		$gdg_dbedb_nama,
		$gdg_dbedb_pangkat_gol,
		$gdg_dbedb_nip,
		$gdg_dbedb_jabatan,
		$aset_tidak_ditemukan,
		$baik,
		$rusak_ringan,
		$rusak_berat,
		$gdg_dbedb_tindaklanjut,
		$tanggal, $bulan, $tahun
	)
	{
		$query = "	UPDATE
						PemeriksaanGudang 
					SET 
						NoBAPemeriksaanGudang='$gdg_dbedb_nobapemeriksa', TglPemeriksaanGudang='$tahun-$bulan-$tanggal', 
						AlasanPemeriksaanGudang='$gdg_dbedb_alasanpemeriksa', NIPKetuaPanitia='$gdg_dbedb_nip', NamaKetuaPanitia='$gdg_dbedb_nama', 
						GolonganKetuaPanitia='$gdg_dbedb_pangkat_gol', JabatanKetuaPanitia='$gdg_dbedb_jabatan' 
					WHERE 
						Aset_ID=$aset and PemeriksaanGudang_ID=$gudang_id";
		// pr($query);				
        $result = $this->query($query) or die ('error update_pemeriksaan_gudang_edit');
		
		$query2 = "	UPDATE
						Kondisi 
					SET 
						TidakDitemukan='$aset_tidak_ditemukan', Baik='$baik', RusakRingan='$rusak_ringan', 
						RusakBerat='$rusak_berat', InfoKondisi='$gdg_dbedb_tindaklanjut'
					WHERE 
						Aset_ID=$aset and PemeriksaanGudang_ID=$gudang_id";
        $result2 = $this->query($query2) or die ('error update_pemeriksaan_gudang_edit');
		
        if ($result)
        {
            return true;    
        }
        else
        {
            return false;
        }
	}
	
	//Akhir dari Gudang - Bayu
	
	//kerjaan yoda
    public function update_daftar_penetapan_pemindahtanganan
            (
                $UserNm,
                $guid,
                $id,
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
            if(isset($submit)){
            $query="UPDATE BASP SET NoBASP='$no_bast', TglBASP='$olah_tgl_bast', NamaPihak1='$nama1', JabatanPihak1='$jabatan1',
                        NIPPihak1='$nip1', NamaPihak2='$nama2', JabatanPihak2='$jabatan2', NIPPihak2='$nip2', UserNm='$UserNm',
                        LokasiPihak1='$lokasi1', LokasiPihak2='$lokasi2', TglUpdate='$olah_tgl_penetapan', LokasiBASP='$lokasi_basp', TipePemindahtanganan='$tipe_pemindahtanganan',
                        GUID='$guid', TglSKPenetapan='$olah_tgl_penetapan', NoSKPenetapan='$no_penetapan', Peruntukan='$peruntukan', Alamat_Pihak_2='$alamat_pihak_kedua'
                        WHERE BASP_ID='$id'";
        $exec=$this->query($query) or die($this->error());
            }
            if($exec){
                return true;
            }else{
                return false;
            }
        }
        
        public function update_validasi_pemindahtanganan($parameter)
                {
                    $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemindahtanganan' AND UserSes = '$parameter[ses_uid]'";
                    //print_r($query);
                    $result = $this->query($query) or die ($this->error());

                    $numRows = $this->num_rows($result);
                    if ($numRows)
                    {
                        $dataID = $this->fetch_object($result);
                    }

                        $explodeID = explode(',',$dataID->aset_list);


                        $cnt=count($explodeID);
                        //echo "$cnt";

                    for ($i=0; $i<$cnt; $i++){
                        //echo "$i";
                        //echo "$id[$i]";
                        if($explodeID!=""){

                        $query="UPDATE BASP SET Status=1 WHERE BASP_ID='$explodeID[$i]'";
                        $exec=$this->query($query) or die($this->error());

                        $query2="UPDATE BASPAset SET Status=1 WHERE BASP_ID='$explodeID[$i]'";
                        $exec2=$this->query($query2) or die($this->error());
                        }
                    }

                    $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPemindahtanganan' AND UserSes='$parameter[ses_uid]'";
                    $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                    
                    if($exec){
                        return true;
                    }else{
                        return false;
                    }
                }
                
        public function update_daftar_penetapan_penghapusan($id,$no,$tgl,$olah_tgl,$keterangan,$submit)
        {
            if(isset($submit)){
                $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
                // pr($query);
				$exec=$this->query($query) or die($this->error());
            }
            // exit;
            if($exec){
                return true;
            }else{
                return false;
            }
        }
        
        public function update_validasi_penghapusan($parameter)
        {
            if(isset($parameter['submit'])){
                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenghapusan[]' AND UserSes = '$parameter[ses_uid]'";
                //print_r($query);
                $result = $this->query($query) or die ($this->error());


                $numRows = $this->num_rows($result);
                if ($numRows)
                {
                    $dataID = $this->fetch_object($result);
                }

                    $explodeID = explode(',',$dataID->aset_list);


                    $cnt=count($explodeID);
                    //echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
                    //echo "$id[$i]";
                    if($explodeID!=""){

                    $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    $exec=$this->query($query) or die($this->error());

                    $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    $exec2=$this->query($query2) or die($this->error());
                    }
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            
            if($exec){
                return true;
            }elseif($exec2){
                return true;
            }else{
                return false;
            }
        }
        
        //update kerjaan yoda mulai dari sini ..
        
        public function update_daftar_penetapan_pemusnahan
        (
                $id,$no,$tgl,$olah_tgl,$penanda_tangan,$jabatan_penanda_tangan,$nip,$submit
        )
        {
            if(isset($submit)){
                $query="UPDATE BAPemusnahan SET NoBAPemusnahan='$no', TglBAPemusnahan='$olah_tgl', NamaPenandatangan='$penanda_tangan', NIPPenandatangan='$nip', JabatanPenandatangan='$jabatan_penanda_tangan', TglUpdate='$olah_tgl' WHERE BAPemusnahan_ID='$id'";
                $exec=$this->query($query) or die($this->error());
            }
            
            if($exec)
            {
                return true;
            }
            else
            {
                return false;
            }
            
        }
        
        public function update_validasi_pemusnahan($parameter)
        {
            if(isset($parameter['submit'])){
                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemusnahan[]' AND UserSes = '$parameter[ses_uid]'";
                //print_r($query);
                $result = $this->query($query) or die ($this->error());


                $numRows = $this->num_rows($result);
                if ($numRows)
                {
                    $dataID = $this->fetch_object($result);
                }

                    $explodeID = explode(',',$dataID->aset_list);


                    $cnt=count($explodeID);
                    //echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    echo "$i";
                    echo "$id[$i]";
                    if($explodeID!=""){

                    $query="UPDATE BAPemusnahan SET Status=1 WHERE BAPemusnahan_ID='$explodeID[$i]'";
                    $exec=$this->query($query) or die($this->error());

                    $query2="UPDATE BAPemusnahanAset SET Status=1 WHERE BAPemusnahan_ID='$explodeID[$i]'";
                    $exec2=$this->query($query2) or die($this->error());
                    }
                }

                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPemusnahan[]' AND UserSes='$parameter[ses_uid]'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            
            if($exec){
                return true;
            }elseif($exec2){
                return true;
            }else{
                return false;
            }
        }
        
        public function update_daftar_penetapan_penggunaan($id,$tgl_aset,$change_tgl,$noaset,$ket,$submit)
        {
            if(isset($submit)){
                $query="UPDATE Penggunaan SET TglSKKDH='$change_tgl', NoSKKDH='$noaset', Keterangan='$ket', TglUpdate='$change_tgl' WHERE Penggunaan_ID='$id'";
                $exec=$this->query($query) or die($this->error());
            }
            
            if($exec){
                return true;
            }else{
                return false;
            }
        }
        
        public function update_validasi_penggunaan($parameter)
        {
            if(isset($parameter['submit'])){
                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenggunaan[]' AND UserSes = '$parameter[ses_uid]'";
                //print_r($query);
                $result = $this->query($query) or die ($this->error());

                $numRows = $this->num_rows($result);
                if ($numRows)
                {
                    $dataID = $this->fetch_object($result);
                }

                    $explodeID = explode(',',$dataID->aset_list);


                    $cnt=count($explodeID);
                    // echo "$cnt";
                for ($i=0; $i<$cnt; $i++){
                    if($explodeID!=""){
                    $query="UPDATE Penggunaan SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
                    // pr($query);
					$exec=$this->query($query) or die($this->error());

                    $query1="UPDATE PenggunaanAset SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
                    $exec1=$this->query($query1) or die($this->error());
                    // pr($query1);
					}
                }
				// exit;
                $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenggunaan[]' AND UserSes='$parameter[ses_uid]'";
                $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            
            if($exec){
                return true;
            }elseif($exec1){
                return true;
            }else{
                return false;
            }
        }
        
        //kerjaan yoda end
	
	
	//akhir tambahan
	
	
}
?>
