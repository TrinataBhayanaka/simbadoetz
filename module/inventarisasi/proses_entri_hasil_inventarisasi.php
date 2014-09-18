<?php

include "../../config/config.php";

       
        //ini ke table asset
       $assetID = $_POST['assetID'];
       $inv_noreg = $_POST['inv_ldahi_nmr_register'];
       $inv_noreg1 = $_POST['inv_ldahi_nmr_register_1'];
       $inv_noreg2 = $_POST['inv_ldahi_nmr_register_2'];
       $inv_noreg3 = $_POST['inv_ldahi_nmr_register_3'];
       $inv_noreg4 = $_POST['inv_ldahi_nmr_register_4'];
       $inv_noreg5 = $_POST['inv_ldahi_nmr_register_5'];
       $inv_noreg6 = $_POST['inv_ldahi_nmr_register_6'];
       $inv_noreg7 = $_POST['inv_ldahi_nmr_register_7'];
       $inv_noreg8 = $_POST['inv_ldahi_nmr_register_8'];
       
       $inv_pemilik = $_POST['inv_ldahi_pemilik'];
       $inv_skpd = $_POST['inv_ldahi_skpd'];
       $inv_kd_aset = $_POST['inv_ldahi_kode_aset'];
       $inv_nm_aset = $_POST['inv_ldahi_nama_aset'];
       $inv_nm_skpd_skrg = $_POST['inv_ldahi_skpd_skrg'];
       $inv_nm_skpd_ngo_asal = $_POST['inv_ldahi_skpd_ngo_asal'];
       $inv_ruangan = $_POST['inv_ldahi_ruangan'];
       // end table asset
       
       
       $inv_alamat = $_POST['inv_ldahi_alamat'];
       $inv_rt_rw = $_POST['inv_ldahi_rt_rw'];
       $inv_desa = $_POST['inv_ldahi_desa'];
       $inv_kecamatan = $_POST['inv_ldahi_kecamatan'];
       $inv_kabupaten = $_POST['inv_ldahi_kabupaten'];
       $inv_provinsi = $_POST['inv_ldahi_provinsi'];
       
       //include tabel.php
       //jenis barang (JS)//
       $inv_jenis_barang = $_POST['inv_ldahi_goltanah_jenis_barang'];
       
       $inv_jenis_aset = $_POST['inv_ldahi_jenis_aset'];
       $inv_bersejarah = $_POST['inv_ldahi_bersejarah'];
       
       //gol1.html
       // masuk ke table tanah
       $inv_luas_keseluruhan = $_POST['inv_ldahi_gol1_luas_keseluruhan'];
       $inv_luas_utk_bangunan = $_POST['inv_ldahi_gol1_luas_utk_bangunan'];
       $inv_luas_sarana_lingkungan = $_POST['inv_ldahi__gol1_luas_sarana_lingkungan'];
       $inv_luas_tnh_kosong = $_POST['inv_ldahi_gol1_luas_tnh_kosong'];
       $inv_hak_tanah = $_POST['inv_ldahi_gol1_hak_tanah'];
       $inv_no_sertifikat = $_POST['inv_ldahi_gol1_no_sertifikat'];
       $inv_tgl_sertifikat = $_POST['inv_ldahi_gol1_tgl_sertifikat'];
       $inv_penggunaan = $_POST['inv_ldahi_gol1_penggunaan'];
       $inv_batas_utara = $_POST['inv_ldahi_gol1_batas_utara'];
       $inv_batas_selatan = $_POST['inv_ldahi_gol1_batas_selatan'];
       $inv_batas_barat = $_POST['inv_ldahi_gol1_batas_barat'];
       $inv_batas_timur = $_POST['inv_ldahi_gol1_batas_timur'];
       
       //gol2.html
       //mesin
       $inv_merk_peralatan = $_POST['inv_ldahi_gol2_merk_peralatan'];
       $inv_tipe_model =$_POST['inv_ldahi_gol2_tipe_model'];
       $inv_ukuran =$_POST['inv_ldahi_gol2_ukuran'];
       $inv_silinder =$_POST['inv_ldahi_gol2_silinder'];
       $inv_merk_mesin =$_POST['inv_ldahi_gol2_merk_mesin'];
       $inv_jml_mesin =$_POST['inv_ldahi_gol2_jml_mesin'];
       $inv_bhn_material =$_POST['inv_ldahi_gol2_bahan_material'];
       $inv_no_seri_pabrik =$_POST['inv_ldahi_gol2_no_seri_pabrik'];
       $inv_no_rangka =$_POST['inv_ldahi_gol2_no_rangka'];
       $inv_no_mesin =$_POST['inv_ldahi_gol2_no_mesin'];
       $inv_no_stnk =$_POST['inv_ldahi_gol2_no_stnk'];
       $inv_tgl_stnk =$_POST['inv_ldahi_gol2_tgl_stnk'];
       $inv_no_bpkb =$_POST['inv_ldahi_gol2_no_bpkb'];
       $inv_tgl_bpkb =$_POST['inv_ldahi_gol2_tgl_bpkb'];
       $inv_no_dok_lain =$_POST['inv_ldahi_gol2_no_dok_lain'];
       $inv_tgl_dok_lain =$_POST['inv_ldahi_gol2_tgl_dok_lain'];
       $inv_thn_pembuatan =$_POST['inv_ldahi_gol2_thn_pembuatan'];
       $inv_bhn_bakar =$_POST['inv_ldahi_gol2_bahan_bakar'];
       $inv_pabrik =$_POST['inv_ldahi_gol2_pabrik'];
       $inv_negara_asal =$_POST['inv_ldahi_gol2_negara_asal'];
       $inv_kapasitas_tonase =$_POST['inv_ldahi_gol2_kapasitas_tonase'];
       $inv_bobot_berat =$_POST['inv_ldahi_gol2_bobot_berat'];
       $inv_negara_perakitan =$_POST['inv_ldahi_gol2_negara_perakitan'];
       
       //gol3.php
       //bangunan
       $inv_gol3_konstruksi = $_POST['inv_ldahi_gol3_konstruksi1'];
       $inv_gol3_konstruksi2 = $_POST['inv_ldahi_gol3_konstruksi2'];
       $inv_gol3_jml_lantai = $_POST['inv_ldahi_gol3_jml_lantai'];
       $inv_gol3_luas_lantai = $_POST['inv_ldahi_gol3_luas_lantai'];
       $inv_gol3_spek_dinding = $_POST['inv_ldahi_gol3_spek_dinding'];
       $inv_gol3_spek_lantai = $_POST['inv_ldahi_gol3_spek_lantai'];
       $inv_gol3_spek_plafon = $_POST['inv_ldahi_gol3_spek_plafon'];
       $inv_gol3_spek_atap = $_POST['inv_ldahi_gol3_spek_atap'];
       $inv_gol3_no_dok = $_POST['inv_ldahi_gol3_no_dokumen'];
       $inv_gol3_tgl_dok = $_POST['inv_ldahi_gol3_tgl_dokumen'];
       $inv_gol3_tgl_pemakaian = $_POST['inv_ldahi_gol3_tgl_pemakaian'];
       $inv_gol3_status_tanah = $_POST['inv_ldahi_gol3_status_tanah'];
       $inv_gol3_pilih_aset_tnh = $_POST['inv_ldahi_gol3_pilih_aset_tanah'];
       $inv_gol3_no_kode_tanah = $_POST['inv_ldahi_gol3_no_kode_tanah'];
       $inv_gol3_no_imb = $_POST['inv_ldahi_gol3_no_imb'];
       $inv_gol3_tgl_imb = $_POST['inv_ldahi_gol3_tgl_imb'];
       
       //gol4.html
       //jaringan
       $inv_gol4_konstruksi = $_POST['inv_ldahi_gol4_konstruksi'];
       $inv_gol4_panjang = $_POST['inv_ldahi_gol4_panjang'];
       $inv_gol4_lebar = $_POST['inv_ldahi_gol4_lebar'];
       $inv_gol4_luas = $_POST['inv_ldahi_gol4_luas'];
       $inv_gol4_no_dok = $_POST['inv_ldahi_gol4_no_dokumen'];
       $inv_gol4_tgl_dok = $_POST['inv_ldahi_gol4_tgl_dokumen'];
       $inv_gol4_tgl_pemakaian = $_POST['inv_ldahi_gol4_tgl_pemakain'];
       $inv_gol4_status_tanah = $_POST['inv_ldahi_gol4_status_tanah'];
       $inv_gol4_pilih_aset_tanah = $_POST['inv_ldahi_gol4_pilih_aset_tanah'];
       $inv_gol4_no_kode_tanah = $_POST['inv_ldahi_gol4_no_kode_tanah'];
       
       //gol5.php
       $inv_gol5_jenis_aset_lain = $_POST['inv_ldahi_gol5_jenis_aset_lain'];
       $inv_gol5_judul = $_POST['inv_ldahi_gol5_judul'];
       $inv_gol5_pengarang = $_POST['inv_ldahi_gol5_pengarang'];
       $inv_gol5_penerbit = $_POST['inv_ldahi_gol5_penerbit'];
       $inv_gol5_spesifikasi = $_POST['inv_ldahi_gol_spesifikasi'];
       $inv_gol5_thn_terbit = $_POST['inv_ldahi_gol5_tahun_terbit'];
       $inv_gol5_isbn = $_POST['inv_ldahi_gol5_isbn'];
       $inv_gol5_kuantitas = $_POST['inv_ldahi_gol5_kuantitas'];
       $inv_gol5_satuan = $_POST['inv_ldahi_gol5_satuan'];
       $inv_gol5_spesies = $_POST['inv_ldahi_gol5_jenis_spesies'];
       $inv_gol5_ukuran = $_POST['inv_ldahi_gol5_ukuran'];
       $inv_gol5_kuantitas1 = $_POST['inv_ldahi_gol5_kuantitas1'];
       $inv_gol5_satuan1 = $_POST['inv_ldahi_gol5_satuan1'];
       $inv_gol5_asal_daerah = $_POST['inv_ldahi_gol5_asal_daerah'];
       $inv_gol5_pencipta = $_POST['inv_ldahi_gol5_pencipta'];
       $inv_gol5_bahan_maaterial = $_POST['inv_ldahi_gol5_bahan_material'];
       
       //gol5_buku.php
       $inv_ldahi_gol5buku_judul = $_POST['inv_ldahi_gol5buku_judul'];
       $inv_ldahi_gol5buku_pengarang = $_POST['inv_ldahi_gol5buku_pengarang'];
       $inv_ldahi_gol5buku_penerbit = $_POST['inv_ldahi_gol5buku_penerbit'];
       $inv_ldahi_gol5buku_spesifikasi = $_POST['inv_ldahi_gol5buku_spesifikasi'];
       $inv_ldahi_gol5buku_thn_terbit = $_POST['inv_ldahi_gol5buku_tahun_terbit'];
       $inv_ldahi_gol5buku_isbn = $_POST['inv_ldahi_gol5buku_isbn'];
       $inv_ldahi_gol5buku_kuantitas = $_POST['inv_ldahi_gol5buku_kuantitas'];
       $inv_ldahi_gol5buku_satuan = $_POST['inv_ldahi_gol5buku_satuan'];
       
       //gol5_hewan.html
       $inv_ldahi_gol5hewan_jenis_aset_lain = $_POST['inv_ldahi_gol5hewan_jenis_aset_lain'];
       $inv_ldahi_gol5hewan_jns_spesies = $_POST['inv_ldahi_gol5hewan_jenis_spesies'];
       $inv_ldahi_gol5hewan_ukuran = $_POST['inv_ldahi_gol5hewan_ukuran'];
       $inv_ldahi_gol5hewan_kuantitas = $_POST['inv_ldahi_gol5hewan_kuantitas'];
       $inv_ldahi_gol5hewan_satuan = $_POST['inv_ldahi_gol5hewan_satuan'];
       
       //gol5_kebudayaan.html
       $inv_ldahi_gol5kebud_jns_aset_lain = $_POST['inv_ldahi_gol5kebud_jenis_aset_lain'];
       $inv_ldahi_gol5kebud_judul = $_POST['inv_ldahi_gol5kebud_judul'];
       $inv_ldahi_gol5kebud_asal_daerah = $_POST['inv_ldahi_gol5kebud_asal_daerah'];
       $inv_ldahi_gol5kebud_pencipta = $_POST['inv_ldahi_gol5kebud_pencipta'];
       $inv_ldahi_gol5kebud_bhn_material = $_POST['inv_ldahi_gol5kebud_bahan_material'];
       $inv_ldahi_gol5kebud_kuantitas = $_POST['inv_ldahi_gol5kebud_kuantitas'];
       $inv_ldahi_gol5kebud_satuan = $_POST['inv_ldahi_gol5kebud_satuan'];
       
       //gol6.html
       $inv_ldahi_gol6_konstruksi = $_POST['inv_ldahi_gol6_konstruksi'];
       $inv_ldahi_gol6_jml_lantai = $_POST['inv_ldahi_gol6_jumlah_lantai'];
       $inv_ldahi_gol6_luas_lantai = $_POST['inv_ldahi_gol6_luas_lantai'];
       $inv_ldahi_gol6_tgl_pembangunan = $_POST['inv_ldahi_gol6_tgl_pembangunan'];
       $inv_ldahi_gol6_status_tanah = $_POST['inv_ldahi_gol6_status_tanah'];
       $inv_ldahi_gol6_aset_tanah = $_POST['inv_ldahi_gol6_pilih_aset_tanah'];
       $inv_ldahi_gol6_kode_tanah = $_POST['inv_ldahi_gol6_no_kode_tanah'];
       
       //include tambah.php
       $inv_tbh_thn_aset = $_POST['inv_ldahi_tbh_tahun_aset'];
       $inv_tbh_no_dok = $_POST['inv_ldahi_tbh_no_dokumen'];
       $inv_tbh_baik = $_POST['inv_ldahi_tbh_baik'];
       $inv_tbh_tdk_sempurna = $_POST['inv_ldahi_tbh_tdk_sempurna'];
       $inv_tbh_rusak_ringan = $_POST['inv_ldahi_tbh_rusak_ringan'];
       $inv_tbh_tdk_sesuai_peruntukan = $_POST['inv_ldahi_tbh_tdk_sesuai_peruntukan'];
       $inv_tbh_rusak_berat = $_POST['inv_ldahi_tbh_rusak_berat'];
       $inv_tbh_tdk_sesuai_spek = $_POST['inv_ldahi_tbh_tdk_sesuai_spesifikasi'];
       $inv_tbh_blm_dimanfaatkan = $_POST['inv_ldahi_tbh_blm_dimanfaatkan'];
       $inv_tbh_tdk_dpt_dikunjungi = $_POST['inv_ldahi_tbh_tdk_dpt_dikunjungi'];
       $inv_tbh_blm_selesai = $_POST['inv_ldahi_tbh_blm_selesai'];
       $inv_tbh_almt_tdk_jls = $_POST['inv_ldahi_tbh_almt_tdk_jelas'];
       $inv_tbh_blm_dikerjakan = $_POST['inv_ldahi_tbh_blm_dikerjakan'];
       $inv_tbh_keg_tdk_ditemukan = $_POST['inv_ldahi_tbh_kegiatan_tdk_ditemukan'];
       $inv_tbh_ket_inven = $_POST['inv_ldahi_tbh_ket_inventarisasi'];
       
       
       //print_r('<pre>');
       
       //print_r($_POST);
       
       //UPDATE ke tbl aset
       
       $qAsset = "UPDATE Aset SET 
        NomorReg = '$inv_noreg',
        NamaAset = '$inv_nm_aset',
        Pemilik = '$inv_pemilik',
        Alamat = '$inv_alamat',
        RTRW = '$inv_rt_rw'
        WHERE Aset_ID = {$assetID}
        ";
        //print_r($qAsset);
       open_connection();
       $resAsset = mysql_query($qAsset);
       //UPDATE ke table golong, tanah , api, air, udara
       if($resAsset){ 
       $qtanah = "
        UPDATE Tanah SET 
         LuasTotal = '$inv_luas_keseluruhan',	
         LuasBangunan = '$inv_luas_utk_bangunan',
         LuasSekitar = '$inv_luas_sarana_lingkungan',
         LuasKosong = '$inv_luas_tnh_kosong',
         HakTanah = '$inv_hak_tanah',
         NoSertifikat = '$inv_no_sertifikat',
         TglSertifikat = '$inv_tgl_sertifikat',
         Penggunaan = '$inv_penggunaan',	
         BatasUtara = '$inv_batas_utara',
         BatasSelatan = '$inv_batas_selatan',	
         BatasBarat = '$inv_batas_barat',	
         BatasTimur = '$inv_batas_timur'
         WHERE Aset_ID = {$assetID}
         ";    
        $resTanah = mysql_query($qtanah);
       
        $qMesin = " UPDATE Mesin SET
             Merk = '$inv_merk_peralatan',
             Model = '$inv_tipe_model',	
             Ukuran = '$inv_ukuran',
             Silinder = '$inv_silinder',	
             MerkMesin = '$inv_merk_mesin',
             JumlahMesin = '$inv_jml_mesin',	
             Material = '$inv_bhn_material',
             NoSeri = '$inv_no_seri_pabrik',
             NoRangka = '$inv_no_rangka',
             NoMesin = '$inv_no_mesin',	
             NoSTNK = '$inv_no_stnk',	
             TglSTNK = '$inv_tgl_stnk',
             NoBPKB = '$inv_no_bpkb',	
             TglBPKB = '$inv_tgl_bpkb',	
             NoDokumen = '$inv_no_dok_lain',	
             TglDokumen = '$inv_tgl_dok_lain',
             Pabrik = '$inv_pabrik',
             TahunBuat = '$inv_thn_pembuatan',
             BahanBakar = '$inv_bhn_bakar',
             NegaraAsal = '$inv_negara_asal',
             NegaraRakit = '$inv_negara_perakitan',
             Kapasitas = '$inv_kapasitas_tonase',
             Bobot = '$inv_bobot_berat'
            WHERE Aset_ID = {$assetID}
            ";
            $resMesin = mysql_query($qMesin);
       
        
            $qBangunan = " UPDATE Bangunan SET
             TglPakai = '$inv_gol3_tgl_pemakaian', 	
             Konstruksi = '$inv_gol3_konstruksi'.'$inv_gol3_konstruksi2',
             JumlahLantai = '$inv_gol3_jml_lantai',
             LuasLantai = '$inv_gol3_luas_lantai',
             Dinding = '$inv_gol3_spek_dinding',	
             Lantai = '$inv_gol3_spek_lantai',	
             LangitLangit = '$inv_gol3_spek_plafon',
             Atap = '$inv_gol3_spek_atap',
             NoSurat = '$inv_gol3_no_dok',
             TglSurat = '$inv_gol3_tgl_dok',
             NoIMB = '$inv_gol3_no_imb',
             TglIMB = '$inv_gol3_tgl_imb',
             StatusTanah = '$inv_gol3_status_tanah' 
             WHERE Aset_ID = {$assetID}
            ";
             $resBangunan = mysql_query($qBangunan);
             
             
             $qJaringan = " UPDATE Jaringan SET
             Konstruksi = '$inv_gol4_konstruksi',	
             Panjang = '$inv_gol4_panjang',	
             Lebar = '$inv_gol4_lebar',
             NoDokumen = '$inv_gol4_no_dok',
             TglDokumen = '$inv_gol4_tgl_dok',
             StatusTanah = '$inv_gol4_status_tanah'
             WHERE Aset_ID = {$assetID}
             ";
             $resJaringan = mysql_query($qJaringan);
             
             
            $qAsetLain = " UPDATE AsetLain SET
            Judul = '$inv_ldahi_gol5buku_judul',	
            AsalDaerah = '$inv_gol5_asal_daerah',
            Pengarang = '$inv_ldahi_gol5buku_pengarang',
            Penerbit = '$inv_ldahi_gol5buku_penerbit',
            Spesifikasi = '$inv_ldahi_gol5buku_spesifikasi',
            TahunTerbit = '$inv_ldahi_gol5buku_thn_terbit',
            ISBN = '$inv_ldahi_gol5buku_isbn'
            WHERE Aset_ID = {$assetID}
             ";
            $resAsetLain = mysql_query($qAsetLain);
       
            
            $qKDP = " UPDATE KDP SET
            Konstruksi = '$inv_ldahi_gol6_konstruksi',
            JumlahLantai = '$inv_ldahi_gol6_jml_lantai',
            LuasLantai = '$inv_ldahi_gol6_luas_lantai',
            TglMulai = '$inv_ldahi_gol6_tgl_pembangunan',	
            StatusTanah = '$inv_ldahi_gol6_status_tanah'
            WHERE Aset_ID = {$assetID}
            ";
            $resKDP = mysql_query($qKDP);
            
        echo("<script>alert('Data telah diubah')</script>");
        echo("<script language=\"javascript\">window.location.href=\"$url_rewrite/module/inventarisasi/entri/entri_hasil_inventarisasi.php\";</script>");
        
       }
       
   
        
?>  
<a href="entri_hasil_inventarisasi_lanjut.php">entri inventarisasi</a>
