<?php
include "../../config/config.php";
include "../../function/upload/proses_upload_photo.php";


echo '<pre>';
//echo 'ada';
// print_r($_POST);
echo '</pre>';
//exit;

$UserSes = $SESSION->get_session_user();


// post no register

if (isset($_POST['simpan']))
{
    
    // input type hiden
    $Aset_ID=$_POST['Aset_ID'];
    $BASP_ID=$_POST['BASP_ID'];
    $Satker_ID = $_POST['Satker_ID'];
    $SP2D_ID = $_POST['SP2D_ID'];
    $Kontraktor_ID = $_POST['kontraktor_ID'];
    $Kontrak_ID = $_POST['Kontrak_ID'];
    $KDP_ID = $_POST['KDP_ID'];
    $BAST_ID = $_POST['BAST_ID'];
    $Penerimaan_ID = $_POST['Penerimaan_ID'];
    $Tanah_ID = $_POST['Tanah_ID'];
    $lokasi_baru_ID = $_POST['lokasi_baru_ID'];
    $AsetLain_ID = $_POST['AsetLain_ID'];
    $Mesin_ID = $_POST['Mesin_ID'];
    $KeputusanPengadilan_ID = $_POST['KeputusanPengadilan_ID'];
    $KeputusanUndangUndang_ID = $_POST['KeputusanUndangUndang_ID'];
    $Pemusnahan_ID=$_POST['Pemusnahan_ID'];
    $Bangunan_ID=$_POST['Bangunan_ID'];
    // end type hidden
    
    $p_noreg_pemilik =$_POST['p_noreg_pemilik'];
	
    $p_noreg_prov=$_POST['p_noreg_prov'];
    $p_noreg_kab=$_POST['p_noreg_kab'];
    $p_noreg_satker=$_POST['p_noreg_satker'];
    //$p_noreg_tahun=$_POST['p_noreg_tahun'];
    $p_noreg_unit=$_POST['p_noreg_unit'];
    
    $tahun=$_POST['p_perolehan_thnperolehan'];
    $tahun3= substr($tahun,2,2); 
    
     $noregnoreg = $p_noreg_pemilik.'.'.$KODE_PROVINSI.'.'.$KODE_KABUPATEN.'.'.$p_noreg_satker.'.'.$tahun3.'.00';

    $p_kodeaset =$_POST['p_kodeaset'];
    $p_skpd =$_POST['p_skpd'];
    
    $p_nama_aset =$_POST['p_nama_aset'];
    $p_ruangan =$_POST['p_ruangan'];
    $p_jenisbarang =$_POST['p_jenisbarang'];
    $p_jenisaset =$_POST['p_jenisaset'];
    $p_bersejarah =$_POST['p_bersejarah'];
    
    $p_alamat =$_POST['p_alamat'];
    $p_rt =$_POST['p_rt'];
    $p_desa =$_POST['p_desa'];
    $p_kecamatan =$_POST['p_kecamatan'];
    $p_kabupaten =$_POST['p_kabupaten'];
    $p_provinsi =$_POST['p_provinsi'];
    $p_p_tangan_peruntukan =$_POST['p_p_tangan_peruntukan'];
    $p_pengadaan_sumberdana=$_POST['p_pengadaan_sumberdana'];
    
    $Satker_ID =$_POST['skpd_id'];
    ($Satker_ID !='') ? $Satker_ID = $Satker_ID : $Satker_ID = $_POST['Satker_ID'];
    
    $Lokasi_ID =$_POST['lokasi_id'];
    
    $p_noreg_info_kel =$_POST['p_noreg_info_kel'];
    $p_noreg_noreg =$_POST['p_noreg_noreg'];
    $p_noreg_noreg2 =$_POST['p_noreg_noreg2'];
    $p_perolehan_caraperolehan =$_POST['p_perolehan_caraperolehan'];
    $p_penghapusan_aset =$_POST['p_penghapusan_aset'];
    //
    $p_perolehan_ket_asalusul=$_POST['p_perolehan_ket_asalusul'];
    $date_explode = explode('/', $_POST['p_perolehan_tglperolehan']); 
    $p_perolehan_tglperolehan = $date_explode[2].$date_explode[1].$date_explode[0];   
    $p_perolehan_thnperolehan=$_POST['p_perolehan_thnperolehan'];
    $p_perolehan_nilai=$_POST['p_perolehan_nilai'];
    $p_keterangantambahan = $_POST['p_keterangantambahan'];
    
    $kelompok_id3 = $_POST['kelompok_id3'];
    
    
    
    //if (($kelompok_id3 !='') AND ($p_kodeaset !='') AND ($lokasi_id !='') AND ($satker_id !=''))
    //{
        
        (($p_noreg_noreg2 == '') or ($p_noreg_noreg2 == 0)) ? $p_noreg_noreg2 = 1 : $p_noreg_noreg2 = $p_noreg_noreg2;
        
        //for ($loop = 0; $loop < $p_noreg_noreg2 ; $loop++) 
        //{
            
        //$p_noreg_noreg2
        
            $Get_Aset_ID=  get_auto_increment("Aset");
            $Get_BAST_ID = get_auto_increment('BAST');
            //$Get_BASP_ID = get_auto_increment('BASP');
            $Get_Satker_ID = get_auto_increment('Satker');
            $Get_Lokasi_ID = get_auto_increment('Lokasi');
            $Get_Penerimaan_ID = get_auto_increment('Penerimaan');
            $Get_Pemusnahan_ID = get_auto_increment('Pemusnahan');
            
            // update aset terlebih dahulu
            /*
            $queryaset="    INSERT INTO Aset (Aset_ID, BAST_ID, BASP_ID, Lokasi_ID, Penerimaan_ID, BAPemusnahan_ID,OrigSatker_ID
                            CaraPerolehan,PenghapusanAset, NomorReg,Pemilik, NamaAset, Ruangan, Alamat,
                            RTRW, AsalUsul, TglPerolehan,Tahun, NilaiPerolehan, JenisAset, Bersejarah)
                            VALUES
                            (NULL, '$Get_BAST_ID', '$Get_BASP_ID', '$Get_Lokasi_ID', '$Get_Penerimaan_ID', '$Get_Pemusnahan_ID',
                            '$Get_Satker_ID', '$p_perolehan_caraperolehan', '$p_penghapusan_aset', '$noregnoreg',
                            '$p_noreg_pemilik', '$p_nama_aset', '$p_ruangan', '$p_alamat', '$p_rt',
                            '$p_perolehan_ket_asalusul', '$p_perolehan_tglperolehan', '$p_perolehan_thnperolehan',
                            '$p_perolehan_nilai', '$p_jenisaset', '$p_bersejarah')";
            */
			
	    if($p_ruangan=='')
	      $p_ruangan='NULL';
            $queryaset="    UPDATE Aset SET
                            Kelompok_ID = '$kelompok_id3',
                            BAST_ID = '$BAST_ID',
                            Lokasi_ID = '$Lokasi_ID',
                            Penerimaan_ID = '$Penerimaan_ID',
                            BAPemusnahan_ID = '$Pemusnahan_ID',
                            OrigSatker_ID = '$Satker_ID',
                            CaraPerolehan = '$p_perolehan_caraperolehan',
                            PenghapusanAset = '$p_penghapusan_aset',
                            AsetLain='$jenis_aset_lain',
                            NomorReg = '$noregnoreg',
                            Pemilik = '$p_noreg_pemilik',
                            NamaAset = '$p_nama_aset',
                            Ruangan = '$p_ruangan',
                            Alamat = '$p_alamat',
                            RTRW = '$p_rt',
                            AsalUsul = '$p_perolehan_ket_asalusul',
                            TglPerolehan = '$p_perolehan_tglperolehan',
                            Tahun = '$p_perolehan_thnperolehan',
                            NilaiPerolehan = '$p_perolehan_nilai',
                            Bersejarah = '$p_bersejarah',
                            JenisAset='$p_jenisaset'
                            
                            WHERE Aset_ID = $Aset_ID";
           // print_r($queryaset);
            
            $resulAset = mysql_query($queryaset) or die ('error aset');
           
            
            // kordinat
            $p_koordinat_bujur_a=$_POST['p_koordinat_bujur_a'];
            $p_koordinat_bujur_b=$_POST['p_koordinat_bujur_b'];
            $p_koordinat_bujur_c=$_POST['p_koordinat_bujur_c'];
            $p_koordinat_bujur_d=$_POST['p_koordinat_bujur_d'];
            $p_koordinat_lintang_a=$_POST['p_koordinat_lintang_a'];
            $p_koordinat_lintang_b=$_POST['p_koordinat_lintang_b'];
            $p_koordinat_lintang_c=$_POST['p_koordinat_lintang_c'];
            $p_koordinat_lintang_d=$_POST['p_koordinat_lintang_d'];
            
            $check = count($_POST['p_koordinat_bujur_a']);
        
            //echo $check;
            if ($check > 0)
            {
                for ($i = 0; $i< $check; $i++)
                {
                    $bujur[$i] =  $p_koordinat_bujur_a[$i].'.'.$p_koordinat_bujur_b[$i].'.'.$p_koordinat_bujur_c[$i].'.'.$p_koordinat_bujur_d[$i].'.'.$p_koordinat_lintang_a[$i].'.'.$p_koordinat_lintang_b[$i].'.'.$p_koordinat_lintang_c[$i].'.'.$p_koordinat_lintang_d[$i];
                    
                }
                
                $a = 0;
                
                foreach ($bujur as $kordinat)
                {
                        
                    if ($lokasi_baru_ID[$a] !='')
                    {
                        $querylokasibaru= "UPDATE lokasi_baru SET koordinat = '$kordinat' WHERE lokasi_baru_ID = $lokasi_baru_ID[$a]";
                        //echo "$a";
                   //     print_r($querylokasibaru);
                        //echo '<br>';
                        $resultlokasibaru = mysql_query($querylokasibaru) or die ('eror 19');
                        //($resultlokasibaru) ? $lokasi_baru_id = $lokasi_baru_id : $lokasi_baru_id = 'NULL';
                    }
                    else
                    {
                        $lokasi_baru_ID = get_auto_increment("lokasi_baru");
                        $querylokasibaru= "INSERT INTO lokasi_baru (lokasi_baru_ID, Aset_ID,koordinat) VALUES (NULL, '$Aset_ID','$kordinat')";
                        //echo "$a";
                 //       print_r($querylokasibaru);
                        //echo '<br>';
                        $resultlokasibaru = mysql_query($querylokasibaru) or die ('eror 19');
                        ($resultlokasibaru) ? $lokasi_baru_ID = $lokasi_baru_ID : $lokasi_baru_ID = 'NULL';
                    }
                    
                    $a++;
                    
                }
            }
            
            //pemeriksaan penerimaan
            $p_periksa_no_ba=$_POST['p_periksa_no_ba'];
            
            $dateb = explode('/', $_POST['p_periksa_tglpemeriksaan']); ///
            $p_periksa_tglpemeriksaan = $dateb[2].$dateb[1].$dateb[0];   
            $p_ststus_pemeriksaan=$_POST['p_ststus_pemeriksaan'];
            $p_periksa_ketua_pemeriksa=$_POST['p_periksa_ketua_pemeriksa'];
            $p_periksa_no_ba_penerimaan=$_POST['p_periksa_no_ba_penerimaan'];
            $datec = explode('/', $_POST['p_periksa_tglpenerimaan']); ///
            $p_periksa_tglpenerimaan = $datec[2].$datec[1].$datec[0];   
            $p_periksa_namapenyedia=$_POST['p_periksa_namapenyedia'];
            $p_periksa_namapengurus=$_POST['p_periksa_namapengurus'];
            $p_periksa_nippengurus=$_POST['p_periksa_nippengurus'];
           
            
            if ($Penerimaan_ID !='')
            {
                $querypenerimaan= "UPDATE Penerimaan SET KeteranganPenerimaan ='$p_keterangantambahan', TglPemeriksaan = '$p_periksa_tglpemeriksaan',NoBAPemeriksaan = '$p_periksa_no_ba',
                                    KetuaPemeriksa = '$p_periksa_ketua_pemeriksa',StatusPemeriksaan = '$p_ststus_pemeriksaan',
                                    NoBAPenerimaan = '$p_periksa_no_ba_penerimaan',TglPenerimaan = '$p_periksa_tglpenerimaan',
                                    NamaPenyedia = '$p_periksa_namapenyedia',NamaPenyimpan = '$p_periksa_namapengurus',
                                    NIPPenyimpan = '$p_periksa_nippengurus' WHERE Penerimaan_ID = $Penerimaan_ID";
                $resultpenerimaan = mysql_query($querypenerimaan) or die ('eror 7');
                //($resultpenerimaan) ? $id_penerimaan = $id_penerimaan : $id_penerimaan = 'NULL';
            }
			
            /*
            else
            {
                $Penerimaan_ID=  get_auto_increment("Penerimaan");
                $querypenerimaan= "INSERT INTO Penerimaan (Penerimaan_ID,TglPemeriksaan,NoBAPemeriksaan,KetuaPemeriksa,StatusPemeriksaan,NoBAPenerimaan,TglPenerimaan,
                                    NamaPenyedia,NamaPenyimpan,NIPPenyimpan)VALUES(NULL,'$p_periksa_tglpemeriksaan','$p_periksa_no_ba','$p_periksa_ketua_pemeriksa',
                                    '$p_ststus_pemeriksaan','$p_periksa_no_ba_penerimaan','$p_periksa_tglpenerimaan','$p_periksa_namapenyedia','$p_periksa_namapengurus',
                                    '$p_periksa_nippengurus')";
                $resultpenerimaan = mysql_query($querypenerimaan) or die ('eror 7');
                ($resultpenerimaan) ? $Penerimaan_ID = $Penerimaan_ID : $Penerimaan_ID = 'NULL';
            }
            */
            
            //print_r($querypenerimaan);
            
           //upload foto
            $folder_upload=$path."/foto/$Aset_ID/";
            $radio_foto = $_POST['radio_foto'];
            $nama_foto=$_FILES['p_foto_aset']['name'];
            $tgl= date("Y-m-d");
            
            if ($nama_foto !='')
            {
                foreach ($nama_foto as $index => $foto)
                {
                    
                    if ($foto !='')
                    {
                        ($index == $radio_foto) ? $status = 1 : $status = 0; 
                        $hasil_upload=upload_gambar('p_foto_aset',$folder_upload,1, $index);
                        if ($hasil_upload)
                        {
                            $foto_path = "/foto/$Aset_ID/$foto";
                            $query_upload_foto= "INSERT INTO Foto(Foto_ID,Aset_ID,UserNm,DataFoto,TglFoto,Foto_Status)values(null,'$Aset_ID','$UserSes[ses_uname]','$foto_path','$tgl', '$status')";
                            //print_r($query_upload_foto);
                            $result_upload_foto = mysql_query($query_upload_foto) or die (mysql_error());    
                        }
                        
                    }
                }
            }
           
            //exit;
           
            //akhir srcip uploadfoto
            
            //upload Nota aset
            $folder_uploads=$path."/fotonota/$Aset_ID";
            $radio_nota = $_POST['radio_nota'];
            $no_nota=$_POST['p_no_nota_aset'];
            $p_notaaset =$_FILES['p_notaaset']['name'];
            
            if ($p_notaaset !='')
            {
                 $index_nota=0;
                foreach ($p_notaaset as $index => $foto)
                {
                    
                    if ($foto !='')
                    {
                        ($index == $radio_nota) ? $status = 1 : $status = 0;
                        $hasil_upload=upload_gambar('p_notaaset',$folder_uploads,1, $index);
                        if ($hasil_upload)
                        {
                            $foto_nota_path = "/fotonota/$Aset_ID/$foto";
                            $query_upload_fotonota ="INSERT INTO FotoNota(Nota_ID,Aset_ID,UserNm,TglFotoNota, Foto_Path,Foto_Status,No_Nota)values(null,'$Aset_ID','$UserSes[ses_uname]','$tgl','$foto_nota_path','$status','$no_nota[$index]')";
                            //print_r($query_upload_foto);
                            $result_upload_fotonota=mysql_query($query_upload_fotonota) or die (mysql_error());    
                            
                        }
                        
                        $index_nota++;
                    }
                }
            }
			 
            /*
            if ($BASP_ID !=='')
            {
                $query = "UPDATE BASP SET KeteranganTambahan = '$p_keterangantambahan' WHERE BASP_ID = $BASP_ID";
                print_r($query);
                //$result = mysql_query($query) or die (mysql_error());
            }
            /*
            else
            {
                
                $query = "INSERT INTO BASP (BASP_ID, KeteranganTambahan) VALUES ($BASP_ID, '$p_keterangantambahan')";
            }
            */
            
            
            
            
            $p_kodeaset = substr($_POST['p_kodeaset'], 0,2);
            $GolonganHidden = $_POST['GolonganHidden'];
            //$Golongan = $_POST['Golongan'];
            //$Golongan = $_POST['Golongan'];
            
                switch ($p_kodeaset)
                {
                    case '01':
                        {
                        
                            //golongan tanah
                            $p_gtanah_luaskeseluruhan=$_POST['p_gtanah_luaskeseluruhan'];
                            $p_gtanah_luasbangunan=$_POST['p_gtanah_luasbangunan'];
                            $p_gtanah_saranalingkungn=$_POST['p_gtanah_saranalingkungn'];
                            $p_gtanah_tanahkosong=$_POST['p_gtanah_tanahkosong'];
                            $p_gtanah_hakpakai=$_POST['p_gtanah_hakpakai'];
                            $p_gtanah_nosertifikat=$_POST['p_gtanah_nosertifikat'];
                            $p_gtanah_tglsertifika = $_POST['p_gtanah_tglsertifikat']; ///bulan/tanggal/tahun 
                            $datee = explode('/', $p_gtanah_tglsertifika); ///
                            $p_gtanah_tglsertifikat = $datee[2].$datee[1].$datee[0];             
                            $p_gtanah_penggunaan=$_POST['p_gtanah_penggunaan'];           
                            $p_gtanah_batasutara=$_POST['p_gtanah_batasutara'];
                            $p_gtanah_batasselatan=$_POST['p_gtanah_batasselatan'];
                            $p_gtanah_batasbarat=$_POST['p_gtanah_batasbarat'];
                            $p_gtanah_batastimur=$_POST['p_gtanah_batastimur'];
                            
                            
                            //$golongan = '01';
                            
                            if ($p_kodeaset !== $GolonganHidden)
                            {
                                // delete dulu
                                
                                $getGolongan = get_golongan($GolonganHidden);
                                //print_r($getGolongan);
                                $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                // insert data baru ke golongan baru
                                $Get_Tanah_ID= get_auto_increment("Tanah");
                                $querytanah = "INSERT INTO Tanah (Tanah_ID, Aset_ID, LuasTotal,LuasBangunan,LuasSekitar,LuasKosong,HakTanah,
                                                NoSertifikat,TglSertifikat,Penggunaan,BatasUtara,BatasSelatan,BatasBarat,
                                                BatasTimur) VALUES (NULL, '$Aset_ID','$p_gtanah_luaskeseluruhan', '$p_gtanah_luasbangunan',
                                                '$p_gtanah_saranalingkungn','$p_gtanah_tanahkosong','$p_gtanah_hakpakai',
                                                '$p_gtanah_nosertifikat', '$p_gtanah_tglsertifikat','$p_gtanah_penggunaan',
                                                '$p_gtanah_batasutara','$p_gtanah_batasselatan','$p_gtanah_batasbarat',
                                                '$p_gtanah_batastimur')";
                                //print_r($querytanah);
                                $resulttanah= mysql_query($querytanah) or die ('eror 6');
                                ($querytanah) ? $Tanah_ID = $Get_Tanah_ID : $Tanah_ID = $Tanah_ID;
                                
                            }
                            else 
                            {
                                // update
								$querytanah = "UPDATE Tanah SET LuasTotal = '$p_gtanah_luaskeseluruhan', LuasBangunan = '$p_gtanah_luasbangunan',
                                                LuasSekitar = '$p_gtanah_saranalingkungn',LuasKosong = '$p_gtanah_tanahkosong',
                                                HakTanah = '$p_gtanah_hakpakai', NoSertifikat = '$p_gtanah_nosertifikat',
                                                TglSertifikat = '$p_gtanah_tglsertifikat',Penggunaan = '$p_gtanah_penggunaan',
                                                BatasUtara = '$p_gtanah_batasutara',BatasSelatan = '$p_gtanah_batasselatan',
                                                BatasBarat = '$p_gtanah_batasbarat',BatasTimur = '$p_gtanah_batastimur'
                                                WHERE Tanah_ID = $Tanah_ID AND Aset_ID = $Aset_ID";
                                
                                $resulttanah= mysql_query($querytanah)or die ('eror 6');
                                //($querytanah) ? $tanah_id = $tanah_id : $tanah_id = 'NULL';
                            }
                            
                            $flag = 1;
                            $TipeAset="A";
                            
                        }
                        break;
                    case '02':
                        {
                            
                            //golongan mesin
                            $p_gmsn_peralatan=$_POST['p_gmsn_peralatan'];
                            $p_gmsn_tipemodel=$_POST['p_gmsn_tipemodel'];
                            $p_gmsn_ukuran=$_POST['p_gmsn_ukuran'];
                            $p_gmsn_silinder=$_POST['p_gmsn_silinder'];
                            $p_gmsn_merek=$_POST['p_gmsn_merek'];
                            $p_gmsn_jumlahmesin=$_POST['p_gmsn_jumlahmesin'];
                            $p_gmsn_material=$_POST['p_gmsn_material'];
                            $p_gmsn_noseripabrik=$_POST['p_gmsn_noseripabrik'];
                            $p_gmsn_rangka=$_POST['p_gmsn_rangka'];
                            $p_gmsn_nomesin=$_POST['p_gmsn_nomesin'];
                            $p_gmsn_nopolisi=$_POST['p_gmsn_nopolisi'];
                            $p_gmsn_tglstn = $_POST['p_gmsn_tglstnk']; ///bulan/tanggal/tahun 
                            $datef = explode('/', $p_gmsn_tglstn); ///
                            $p_gmsn_tglstnk = $datef[2].$datef[1].$datef[0]; 
                            $p_gmsn_nobpkb=$_POST['p_gmsn_nobpkb'];
                            $p_gmsn_tglbpk = $_POST['p_gmsn_tglbpkb']; ///bulan/tanggal/tahun 
                            $dateg = explode('/', $p_gmsn_tglbpk); ///
                            $p_gmsn_tglbpkb = $dateg[2].$dateg[1].$dateg[0]; 
                            $p_gmsn_nodokumenlain=$_POST['p_gmsn_nodokumenlain'];
                            $p_gmsn_tgldokumenlai = $_POST['p_gmsn_tgldokumenlain']; ///bulan/tanggal/tahun 
                            $dateh = explode('/', $p_gmsn_tgldokumenlai); ///
                            $p_gmsn_tgldokumenlain = $dateh[2].$dateh[1].$dateh[0]; 
                            
                            $p_gmsn_tahunpembutan=$_POST['p_gmsn_tahunpembutan'];
                            $p_gmsn_bahanbakar=$_POST['p_gmsn_bahanbakar'];
                            $p_gmsn_pabrik=$_POST['p_gmsn_pabrik'];
                            $p_gmsn_negaraasal=$_POST['p_gmsn_negaraasal'];
                            $p_gmsn_kapasitas=$_POST['p_gmsn_kapasitas'];
                            $p_gmsn_bobot=$_POST['p_gmsn_bobot'];
                            $p_gmsn_negaraperakitan=$_POST['p_gmsn_negaraperakitan'];
                            
                            
                            //echo $Golongan;
                            if ($p_kodeaset !== $GolonganHidden)
                            {
                                $getGolongan = get_golongan($GolonganHidden);
                                //echo 'masuk';
                                $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                
                                $Get_Mesin_ID=  get_auto_increment("Mesin");
                                $querymesin ="insert into Mesin(Mesin_ID, Merk,Aset_ID,Model,Ukuran,Silinder,MerkMesin,JumlahMesin,Material,
                                                NoSeri, NoRangka,NoMesin,NoSTNK,TglSTNK,NoBPKB,TglBPKB,NoDokumen,TglDokumen,
                                                TahunBuat,BahanBakar,Pabrik,NegaraAsal,kapasitas,Bobot,NegaraRakit)
                                                values(NULL, '$p_gmsn_peralatan','$Aset_ID','$p_gmsn_tipemodel','$p_gmsn_ukuran',
                                                '$p_gmsn_silinder','$p_gmsn_merek','$p_gmsn_jumlahmesin','$p_gmsn_material',
                                                '$p_gmsn_noseripabrik','$p_gmsn_rangka','$p_gmsn_nomesin','$p_gmsn_nopolisi',
                                                '$p_gmsn_tglstnk','$p_gmsn_nobpkb','$p_gmsn_tglbpkb','$p_gmsn_nodokumenlain',
                                                '$p_gmsn_tgldokumenlain','$p_gmsn_tahunpembutan','$p_gmsn_bahanbakar',
                                                '$p_gmsn_pabrik','$p_gmsn_negaraasal','$p_gmsn_kapasitas','$p_gmsn_bobot',
                                                '$p_gmsn_negaraperakitan')";
                          //      print_r($querymesin);
                                
                                $resultmesin=  mysql_query($querymesin)or die('eror 21');
                                
                                ($resultmesin) ? $Mesin_ID = $Get_Mesin_ID : $Mesin_ID = $Mesin_ID;
                            }
                            else
                            {
                                
                                $querymesin ="UPDATE Mesin SET Merk = '$p_gmsn_peralatan', Model ='$p_gmsn_tipemodel',
                                                Ukuran = '$p_gmsn_ukuran',Silinder = '$p_gmsn_silinder',MerkMesin = '$p_gmsn_merek',
                                                JumlahMesin = '$p_gmsn_jumlahmesin',Material = '$p_gmsn_material',
                                                NoSeri = '$p_gmsn_noseripabrik', NoRangka = '$p_gmsn_rangka',NoMesin = '$p_gmsn_nomesin',
                                                NoSTNK = '$p_gmsn_nopolisi',TglSTNK = '$p_gmsn_tglstnk',NoBPKB = '$p_gmsn_nobpkb',
                                                TglBPKB = '$p_gmsn_tglbpkb',NoDokumen = '$p_gmsn_nodokumenlain',TglDokumen = '$p_gmsn_tgldokumenlain',
                                                TahunBuat = '$p_gmsn_tahunpembutan',BahanBakar = '$p_gmsn_bahanbakar',
                                                Pabrik = '$p_gmsn_pabrik',NegaraAsal = '$p_gmsn_negaraasal',
                                                kapasitas = '$p_gmsn_kapasitas',Bobot = '$p_gmsn_bobot' ,NegaraRakit = '$p_gmsn_negaraperakitan'
                                                WHERE Mesin_ID = $Mesin_ID AND Aset_ID = $Aset_ID;
                                                ";
                               // print_r($querymesin);
                                
                                $resultmesin=  mysql_query($querymesin)or die('eror 21');
                            }
                            
                            
                            $flag = 2;
                            $TipeAset="B";
                        }
                        break;
                    case '04':
                        {
                            //golongan jalan
                        //
                     
                        
                            $Jaringan_ID=$_POST['Jaringan_ID'];
                            $p_jaringan_konstruksi=$_POST['p_jaringan_konstruksi'];
                            $p_jaringan_panjang=$_POST['p_jaringan_panjang'];
                            $p_jaringan_lebar=$_POST['p_jaringan_lebar'];
                            $p_jaringan_luas=$_POST['p_jaringan_luas'];
                            $p_jaringan_nodokumen=$_POST['p_jaringan_nodokumen'];
                            $p_jaringan_tgldookume = $_POST['p_jaringan_tgldookumen']; ///bulan/tanggal/tahun 
                            $dateha = explode('/', $p_jaringan_tgldookume); ///
                            $p_jaringan_tgldookumen = $dateha[2].$dateha[1].$dateha[0];
                             $p_jaringan_tglpemakaia = $_POST['p_jaringan_tglpemakaian']; ///bulan/tanggal/tahun 
                            $dateha = explode('/', $p_jaringan_tglpemakaia); ///
                            $p_jaringan_tglpemakaian = $dateha[2].$dateha[1].$dateha[0]; 
                            $p_jaringan_statustanah=$_POST['p_jaringan_statustanah'];
                            $p_gjal_pilihaset_tanah=$_POST['p_gjal_pilihaset_tanah'];
                            $p_jaringan_nomorkode_tanah=$_POST['p_jaringan_nomorkode_tanah'];
                            
                     
                            if ($p_kodeaset !== $GolonganHidden)
                            {
                                
                                $getGolongan = get_golongan($GolonganHidden);
                                $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                
                                $Get_Jaringan_ID=  get_auto_increment("Jaringan");
                                $queryjaringan = "INSERT INTO Jaringan(Jaringan_ID, Konstruksi,Aset_ID,Panjang,Lebar,LuasJaringan,
                                                    NoDokumen,TglDokumen,TanggalPemakaian,StatusTanah,KelompokTanah_ID,Tanah_ID)
                                                    VALUES(NULL, '$p_jaringan_konstruksi','$Aset_ID',
                                                    '$p_jaringan_panjang','$p_jaringan_lebar','$p_jaringan_luas','$p_jaringan_nodokumen',
                                                    '$p_jaringan_tgldookumen','$p_jaringan_tglpemakaian','$p_jaringan_statustanah','$p_gjal_pilihaset_tanah','$p_jaringan_nomorkode_tanah')";
                                $resultjaringan = mysql_query($queryjaringan) or die ('error insert jaringan');
                                ($resultjaringan) ? $Jaringan_ID = $Get_Jaringan_ID : $Jaringan_ID = $Jaringan_ID;
                            }
                            else
                            {
                                
                                $queryjaringan = "UPDATE Jaringan SET Konstruksi = '$p_jaringan_konstruksi', LuasJaringan='$p_jaringan_luas',Panjang = '$p_jaringan_panjang',
                                                    Lebar = '$p_jaringan_lebar',NoDokumen = '$p_jaringan_nodokumen',TglDokumen = '$p_jaringan_tgldookumen',
                                                    TanggalPemakaian = '$p_jaringan_tglpemakaian', StatusTanah = '$p_jaringan_statustanah',
                                                  KelompokTanah_ID = '$p_gjal_pilihaset_tanah',Tanah_ID='$p_jaringan_nomorkode_tanah'
                                                    WHERE Jaringan_ID = $Jaringan_ID AND Aset_ID = $Aset_ID";
                           //print_r($queryjaringan);                    
                                $resultjaringan = mysql_query($queryjaringan) or die ('error Update Jaringan');
                                ($resultjaringan) ? $jaringan_id = $jaringan_id : $jaringan_id = 'NULL';
                            }
                            
                            $flag = 4;
                            $TipeAset="D";
                        }
                        break;
                    case '03':
                        {
                            //golongan gedung
                            $p_gdg_konstruksi=$_POST['p_gdg_konstruksi'];
                            $p_gdg_konstruksib=$_POST['p_gdg_konstruksib'];
                            $p_gdg_jumlah_lantai=$_POST['p_gdg_jumlah_lantai'];
                            $p_gdg_luaslantai=$_POST['p_gdg_luaslantai'];
                            $p_gdg_dinding=$_POST['p_gdg_dinding'];
                            $p_gdg_lantai=$_POST['p_gdg_lantai'];
                            $p_gdg_plafon=$_POST['p_gdg_plafon'];
                            $p_gdg_atap=$_POST['p_gdg_atap'];
                            $p_gdg_nodokumen=$_POST['p_gdg_nodokumen'];
                             $p_gdg_tgldokume = $_POST['p_gdg_tgldokumen']; ///bulan/tanggal/tahun 
                            $datehaa = explode('/', $p_gdg_tgldokume); ///
                            $p_gdg_tgldokumen = $datehaa[2].$datehaa[1].$datehaa[0];
                            $p_gdg_tglpemakaia = $_POST['p_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
                            $datei = explode('/',$p_gdg_tglpemakaia); ///
                            $p_gdg_tglpemakaian = $datei[2].$datei[1].$datei[0];   
                            $p_gdg_ststustanah=$_POST['p_gdg_ststustanah'];
                            
                            $p_gdg_asettanah=$_POST['p_gdg_asettanah']; //kelompok tanah
                            
                            $p_gdg_kodetanah=$_POST['p_gdg_kodetanah'];// tanah id
                            
                            $p_gdg_no_imb=$_POST['p_gdg_no_imb'];
                            $p_gdg_tglim = $_POST['p_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
                            $datej = explode('/', $p_gdg_tglim); ///
                            $p_gdg_tglimb = $datej[2].$datej[1].$datej[0];
                            
                            
                            if ($p_kodeaset !== $GolonganHidden)
                            {
                                $getGolongan = get_golongan($GolonganHidden);
                                $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                
                                $Get_Bangunan_ID=  get_auto_increment("Bangunan");
                                $query ="insert into Bangunan(Bangunan_ID, Konstruksi,Aset_ID,Beton,JumlahLantai,
                                                LuasLantai,Dinding,Lantai,LangitLangit,Atap,
                                                NoSurat,TglSurat,TglPakai,StatusTanah,KelompokTanah_ID,
                                                Tanah_ID,NoIMB,TglIMB) VALUES (NULL, '$p_gdg_konstruksi','$Aset_ID','$p_gdg_konstruksib','$p_gdg_jumlah_lantai',
                                                '$p_gdg_luaslantai','$p_gdg_dinding','$p_gdg_lantai','$p_gdg_plafon','$p_gdg_atap',
                                                '$p_gdg_nodokumen','$p_gdg_tgldokumen','$p_gdg_tglpemakaian','$p_gdg_ststustanah','$p_gdg_asettanah',
                                                '$p_gdg_kodetanah','$p_gdg_no_imb','$p_gdg_tglimb')";
            
                                $resultbangunan=  mysql_query($query)or die ('eror insert bangunan');
                                ($resultbangunan) ? $Bangunan_ID= $Get_Bangunan_ID : $Bangunan_ID = $Bangunan_ID;
                            }
                            else
                            {
                                
                                $querybangunan ="UPDATE Bangunan SET Konstruksi = '$p_gdg_konstruksi',Beton = '$p_gdg_konstruksib',
                                                JumlahLantai = '$p_gdg_jumlah_lantai',LuasLantai = '$p_gdg_luaslantai',
                                                Dinding = '$p_gdg_dinding',Lantai = '$p_gdg_lantai',LangitLangit = '$p_gdg_plafon',
                                                Atap = '$p_gdg_atap',NoSurat = '$p_gdg_nodokumen',TglSurat = '$p_gdg_tgldokumen',
                                                TglPakai = '$p_gdg_tglpemakaian',StatusTanah = '$p_gdg_ststustanah',
                                                KelompokTanah_ID = '$p_gdg_kodetanah',Tanah_ID='$p_gdg_kodetanah', NoIMB = '$p_gdg_no_imb',
                                                TglIMB = '$p_gdg_tglimb'
                                                WHERE Bangunan_ID = $Bangunan_ID AND Aset_ID = $Aset_ID";
                              //  print_r($querybangunan);
                                $resultbangunan=  mysql_query($querybangunan)or die ('eror update bangunan');
                            }
                            
                            $flag = 3;
                            $TipeAset="C";
        
                        }
                        break;
                    case '05':
                        {
                            // jika golongan 5 lakukan pengecekan data input sesuai golongan
                            // cek nilai data input
                            $Get_Aset_Lain_ID = get_auto_increment('AsetLain');
                            $jenis_aset_lain = $_POST['jenis_aset_lain'];
                            $hidden_jenis_aset_lain = $_POST['hidden_jenis_aset_lain'];
                            switch ($jenis_aset_lain)
                            {
                                case '1':
                                    {
                                        //golongan buku
                                        $p_gol5_judul=$_POST['p_gol5_judul'];
                                        $p_gol5_asal=$_POST['p_gol5_asal'];
                                        $p_gol5_pencipta=$_POST['p_gol5_pengarang'];
                                        $p_gol5_penerbit=$_POST['p_gol5_penerbit'];
                                        $p_gol5_spesifikasi=$_POST['p_gol5_spesifikasi'];
                                        $p_gol5_asetlain_tahunterbit=$_POST['p_gol5_asetlain_tahunterbit'];
                                        $p_gol5_isbn=$_POST['p_gol5_isbn'];
                                        $p_gol5_kuantitas3=$_POST['p_gol5_kuantitas3'];
                                        $p_gol5_satuan3=$_POST['p_gol5_satuan3'];
                                        
                                        if ($jenis_aset_lain !== $hidden_jenis_aset_lain)
                                        {
                                            $getGolongan = get_golongan($GolonganHidden);
                                            $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                            
                                            
                                            $queryasetlain = "insert into AsetLain(AsetLain_ID, Judul,Aset_ID,Pengarang, Penerbit,Spesifikasi, TahunTerbit,ISBN)
                                                                values($Get_Aset_Lain_ID, '$p_gol5_judul','$Aset_ID','$p_gol5_pencipta', '$p_gol5_penerbit',
                                                                '$p_gol5_spesifikasi', '$p_gol5_asetlain_tahunterbit', '$p_gol5_isbn')";
                                            $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas3',Satuan= '$p_gol5_satuan3' WHERE Aset_ID = $Aset_ID";
                                            //print_r($queryasetlain_update);  
                                            //print_r($queryasetlain);  
                                            //$resultaset=  mysql_query($queryasetlain)or die ('eror 17');
                                            
                                        }
                                        else
                                        {
                                            $queryasetlainupdate = "UPDATE AsetLain SET Judul = '$p_gol5_judul',Pengarang = '$p_gol5_pencipta',
                                                                Penerbit = $p_gol5_penerbit,Spesifikasi = '$p_gol5_spesifikasi',
                                                                TahunTerbit = '$p_gol5_asetlain_tahunterbit', ISBN = '$p_gol5_isbn'
                                                                WHERE AsetLain_ID = $AsetLain_ID AND Aset_ID = $Aset_ID";
                                      //      print_r($queryasetlainupdate);  
                                           $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas3',Satuan= '$p_gol5_satuan3' WHERE Aset_ID = $Aset_ID";
                                            //$resultaset=  mysql_query($queryasetlain)or die ('eror 17');
                                            $resultasetlain=  mysql_query($queryasetlainupdate)or die ('eror update asetlain');
                                        }
                                        
                                        
                                    }
                                    break;
                                case '3':
                                    {
                                        //golongan barang kesenian
                                        $p_gol5_judul1=$_POST['p_gol5_judul1'];
                                        $p_gol5_asal=$_POST['p_gol5_asal'];
                                        $p_gol5_pencipta=$_POST['p_gol5_pencipta'];
                                        $p_gol5_bahan=$_POST['p_gol5_bahan'];
                                        $p_gol5_kuantitas1=$_POST['p_gol5_kuantitas1'];
                                        $p_gol5_satuan1=$_POST['p_gol5_satuan1'];
                                        
                                        if ($jenis_aset_lain !== $hidden_jenis_aset_lain)
                                        {
                                            $getGolongan = get_golongan($GolonganHidden);
                                            $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                            
                                            
                                            $queryasetlain = "insert into AsetLain(AsetLain_ID, Judul,Aset_ID, AsalDaerah,Pengarang, Material) 
                                                                values ($Get_Aset_Lain_ID, '$p_gol5_judul1','$Aset_ID','$p_gol5_asal','$p_gol5_pencipta','$p_gol5_bahan')";
                                          $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas1',Satuan= '$p_gol5_satuan1' WHERE Aset_ID = $Aset_ID";
                                            //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                        }
                                        else
                                        {
                                            $queryasetlainupdate = "UPDATE AsetLain SET Judul = '$p_gol5_judul1',AsalDaerah = '$p_gol5_asal',
                                                                Pengarang = '$p_gol5_pencipta', Material = '$p_gol5_bahan'
                                                                WHERE AsetLain_ID = $AsetLain_ID AND Aset_ID = $Aset_ID";
                                          $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas3',Satuan= '$p_gol5_satuan3' WHERE Aset_ID = $Aset_ID";
                                            //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                        }
                                        
                                    }
                                    break;
                                case '2':
                                    {
                                        //golongan hewan
                                        $p_gol5_jenis=$_POST['p_gol5_jenis'];
                                        $p_gol5_ukuran=$_POST['p_gol5_ukuran'];
                                        $p_gol5_kuantitas3=$_POST['p_gol5_kuantitas2'];
                                        $p_gol5_satuan3=$_POST['p_gol5_satuan2'];
                                        
                                        if ($jenis_aset_lain !== $hidden_jenis_aset_lain)
                                        {
                                            $getGolongan = get_golongan($GolonganHidden);
                                            $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                            
                                            
                                            $queryasetlain="insert into AsetLain(AsetLain_ID, Judul,Aset_ID,Ukuran)
                                                            values(NULL, '$p_gol5_jenis','$Aset_ID','$p_gol5_ukuran')";
                                            $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas3',Satuan= '$p_gol5_satuan3' WHERE Aset_ID = $Aset_ID";
                                            //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                        }
                                        else
                                        {
                                            $queryasetlainupdate="UPDATE AsetLain SET Judul = '$p_gol5_jenis',Ukuran = '$p_gol5_ukuran'
                                                            WHERE AsetLain_ID = $AsetLain_ID AND Aset_ID = $Aset_ID";
                                          $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas3',Satuan= '$p_gol5_satuan3' WHERE Aset_ID = $Aset_ID";
                                            //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                        }
                                        
                                    }
                                    break;
                                
                                $Get_Aset_Lain_ID = get_autoincrement('AsetLain');
                                
                              
                                
                            }
                               
                                $resultasetlain=  mysql_query($queryasetlain)or die ('eror insert asetlain');
                                // $resultasetlain=  mysql_query($queryasetlainupdate)or die ('eror update asetlain');
                                
                                $result_aset_lain_update = mysql_query($queryasetlain_update) or die ('error aset lain update');
                                
                                ($resultasetlain) ? $AsetLain_ID = $Get_Aset_Lain_ID : $AsetLain_ID = $AsetLain_ID;
                            $flag = 5;
                            $TipeAset="E";
                        }
                        break;
                    case '06':
                        {
                            //golongan konstruksi
                            $p_gjal_konstruksi=$_POST['p_gjal_konstruksi'];
                            $p_gjal_konstruksi1=$_POST['p_gjal_konstruksi1'];
                            $p_gjal_panjang=$_POST['p_gjal_panjang'];
                            $p_gol6_luas_lantai=$_POST['p_gol6_luas_lantai'];
                            $tanggal_pembanguna = $_POST['tanggal_pembangunan']; ///bulan/tanggal/tahun 
                            $datea = explode('/', $tanggal_pembanguna); ///
                            $tanggal_pembangunan = $datea[2].$datea[1].$datea[0];   
                            $p_gol6_statustanah=$_POST['p_gol6_statustanah'];
                            $p_gol6_pilih_asettanah=$_POST['p_gol6_pilih_asettanah'];
                            $p_gol6_nomor_kodetanah=$_POST['p_gol6_nomor_kodetanah'];
                            //golongan persediaan
                            
                            
                            if ($p_kodeaset !== $GolonganHidden)
                            {
                                $getGolongan = get_golongan($GolonganHidden);
                                $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                                
                                $Get_KDP_ID=  get_auto_increment("KDP");
                                $querykdp = "INSERT INTO KDP(KDP_ID,Konstruksi,Aset_ID,Beton,JumlahLantai,LuasLantai,TglMulai,StatusTanah,
                                                KelompokTanah_ID,Tanah_ID) VALUES($Get_KDP_ID, '$p_gjal_konstruksi','$Aset_ID','$p_gjal_konstruksi1','$p_gjal_panjang',
                                                '$p_gol6_luas_lantai','$tanggal_pembangunan','$p_gol6_statustanah','$p_gol6_pilih_asettanah','$p_gol6_nomor_kodetanah')";
                           //     print_r($querykdp);
                                $resultkdp = mysql_query($querykdp) or die ('eror insert KDP');
                                ($resultkdp) ? $KDP_ID = $Get_KDP_ID : $KDP_ID = $KDP_ID;
                            }
                            else
                            {
                                $querykdp = "UPDATE KDP SET Konstruksi = '$p_gjal_konstruksi',Beton = '$p_gjal_konstruksi1',
                                                JumlahLantai = '$p_gjal_panjang',LuasLantai = '$p_gol6_luas_lantai',
                                                TglMulai = '$tanggal_pembangunan',StatusTanah = '$p_gol6_statustanah',
                                                KelompokTanah_ID = '$p_gol6_pilih_asettanah', Tanah_ID='$p_gol6_nomor_kodetanah'
                                                WHERE KDP_ID = $KDP_ID AND Aset_ID = $Aset_ID";
                         //       print_r($querykdp);
                                $resultkdp = mysql_query($querykdp) or die ('eror Update KDP');
                                ($resultkdp) ? $kdp_id = $kdp_id : $kdp_id = 'NULL';
                            }
                            
                            $flag = 6;
                             $TipeAset="F";
        
                        }
                        break;
                    case '07':
                        {
                            $p_gol7_kuantitas=$_POST['p_gol7_kuantitas'];
                            $p_gol7_satuan=$_POST['p_gol7_satuan'];
                            
                            //$kdp_id=  get_auto_increment("KDP");
                            $getGolongan = get_golongan($GolonganHidden);
                            $delete = delete_table($getGolongan[0], $$getGolongan[1]);
                            
                            $queryaset ="UPDATE Aset SET Kuantitas = '$p_gol7_kuantitas' ,Satuan = '$p_gol7_satuan' WHERE Aset_ID = $Aset_ID";
                            $resultaset=  mysql_query($queryaset)or die ('eror update gol 7');
                            $flag = 7;
                        }
                        break;
                    
                    
                    
                }
                
                 //UPDATE ASET UNTUK TIPE ASET
                  // input type hidden
                $Aset_ID=$_POST['Aset_ID'];  
                $queryaset="    UPDATE Aset SET
                                             TipeAset='$TipeAset' where Aset_ID='$Aset_ID'
                                             ";
                  $resulAset = mysql_query($queryaset) or die ('error aset');
                // query ke tabel kelompok dulu untuk mendapatkan golongan sebelum melakukan insert data
                
               
            // buat kondisi untuk mengecek variabel flag, untuk menentukan nilai getautoincrement sebelum diasukan ke tabel aset
            
            // p_perolehan_caraperolehan
            
            $p_perolehan_caraperolehan = $_POST['p_perolehan_caraperolehan'];
            
           // echo 'perolehan ID = '.$p_perolehan_caraperolehan;
            $hidden_perolehan = $_POST['hidden_perolehan'];
			// echo 'hidden erolehan ='.$hidden_perolehan;
            if ($p_perolehan_caraperolehan !='')
            {
                switch ($p_perolehan_caraperolehan)
                {
                    case '1':
                        {
                             //kontrak
                            $p_pengadaan_nokontrak=$_POST['p_pengadaan_nokontrak'];
                            $p_pengadaan_nilaikontrak=$_POST['p_pengadaan_nilaikontrak'];
                            
                            
                            $p_pengadaan_tglkontrak_post=$_POST['p_pengadaan_tglkontrak'];
                            $p_pengadaan_pekerjaan=$_POST['p_pengadaan_pekerjaan'];
                            $p_pengadaan_kontraktor=$_POST['p_pengadaan_kontraktor'];
                            
                            $p_pengadaan_nosp2d=$_POST['p_pengadaan_nosp2d'];
                            $p_pengadaan_tglsp2d=$_POST['p_pengadaan_tglsp2d'];
                            $p_pengadaan_tglsp2d=$_POST['p_pengadaan_tglsp2d'];
                            $p_pengadaan_mataanggaran=$_POST['p_pengadaan_mataanggaran'];
                            $p_pengadaan_nosp2d1 = $_POST['p_pengadaan_nosp2d1'];
                            
                            
                            if ($hidden_perolehan !== $p_perolehan_caraperolehan)
                            {
                                //delete
                                $index = 0;
                                
                                foreach ($Kontrak_ID as $kontrak_id)
                                {
                                    if ($kontrak_id !='')
                                    {
                                        $parameter = array('perolehan'=>$hidden_perolehan,
                                                            'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID[$index],'Kontrak_ID'=>$kontrak_id,
                                                            'SP2D_ID'=>$SP2D_ID[$index],'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID,
                                                            'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID);
                                        $delete = delete_perolehan($parameter);
                                        
                                        $index++;    
                                    }
                                    
                                }
                                
                                //insert
                                $index = 0;
                                foreach ($p_pengadaan_nilaikontrak as $nilai_kontrak)
                                {
                                    
                                    $p_pengadaan_tglkontrak[$index] = $RETRIEVE->change_date_to_strip(array('data'=>$p_pengadaan_tglkontrak_post[$index], 'type'=>''));
                                    
                                    if ($nilai_kontrak !='')
                                    {
                                        
                                    }
                                    $Get_Kontraktor_ID=  get_auto_increment("Kontraktor");
                                    
                                    $Get_Kontrak_ID=  get_auto_increment("Kontrak");
                                    
                                    $querykontrakaset="INSERT INTO KontrakAset (Kontrak_ID, Aset_ID) values ($Get_Kontrak_ID, '$Aset_ID')";
                                    $resultkontrakaset=  mysql_query($querykontrakaset)or die('eror 3');
                                    //($resultkontrakaset) ? $KontrakAset = $KontrakAset : $KontrakAset = 'NULL';
                                    
                                    $querykontrak="INSERT INTO Kontrak(Kontrak_ID, NoKontrak,Kontraktor_ID,NilaiKontrak,TglKontrak,
                                                    Pekerjaan) VALUES ($Get_Kontrak_ID, '$p_pengadaan_nokontrak[$index]','$Get_Kontraktor_ID','$nilai_kontrak',
                                                    '$p_pengadaan_tglkontrak[$index]','$p_pengadaan_pekerjaan[$index]')";
                                    $resultkontrak=  mysql_query($querykontrak)or die ('eror insertkontrak');
                                    ($resultkontrak) ? $Kontrak_ID = $Get_Kontrak_ID : $Kontrak_ID = $Kontrak_ID;
                                    
                                  
                                    $querykontraktor="INSERT INTO Kontraktor(Kontraktor_ID, NamaKontraktor) values($Get_Kontraktor_ID, '$p_pengadaan_kontraktor[$index]')";
                                    $resultkontraktor=  mysql_query($querykontraktor)or die ('eror 1');
                                    ($resultkontraktor) ? $Kontraktor_ID = $Get_Kontraktor_ID : $Kontraktor_ID = $Kontraktor_ID;
                                    
                                    $index++;
                                }
                                
                                
                                $index = 0;
                                foreach ($p_pengadaan_tglsp2d as $tgl_sp2d)
                                {
                                    $Get_SP2D_ID =get_auto_increment("SP2D");
                                
                                    $querysp2d= "INSERT INTO SP2D (SP2D_ID, NoSP2D,TglSP2D,MAK,NilaiSP2D) VALUES($Get_SP2D_ID, '$p_pengadaan_nosp2d[$index]','$tgl_sp2d',
                                                    '$p_pengadaan_mataanggaran','$p_pengadaan_nilaisp2d[$index]')";
                                    $resultsp2d = mysql_query($querysp2d) or die ('eror 15');
                                    ($resultsp2d) ? $SP2D_ID = $Get_SP2D_ID : $SP2D_ID = $SP2D_ID;
                                    
                                    $Get_Kapitalisasi_Aset=  get_auto_increment("KapitalisasiAset");
                                    
                                    $querykapitalisasiaset= "INSERT INTO KapitalisasiAset (Aset_ID,SP2D_ID) VALUES('$Aset_ID','$Get_SP2D_ID')";
                                    $resultkapitalisasiaset = mysql_query($querykapitalisasiaset) or die ('eror 16');
                                    ($resultkapitalisasiaset) ? $id_kapitalisasi_aset = $Get_Kapitalisasi_Aset : $id_kapitalisasi_aset = $id_kapitalisasi_aset;
                                
                                    $index++;
                                }
                                
                                $query = "UPDATE Aset SET SumberDana = '$p_pengadaan_sumberdana' WHERE Aset_ID = $Aset_ID";
                                $result = mysql_query($query) or die (mysql_error());
                            }
                            else
                            {
                                // update
                                
                               
                                $index=0;
                                foreach ($Kontraktor_ID as $kontraktor_id_array)
                                {
                                    //list ($tanggal, $bulan, $tahun) = explode('/',$p_pengadaan_tglkontrak[$index]);
                                    //$tgl_kontrak = "$tahun-$bulan-$tanggal";
                                    //echo $p_pengadaan_tglkontrak_post[$index];
                                    $tgl_kontrak[$index] = $RETRIEVE->change_date_to_strip(array('data'=>$p_pengadaan_tglkontrak_post[$index], 'type'=>''));
                                    
                                    $querykontrak="UPDATE Kontrak SET NoKontrak = '$p_pengadaan_nokontrak[$index]',Kontraktor_ID = '$kontraktor_id_array',
                                                    NilaiKontrak = '$p_pengadaan_nilaikontrak[$index]',TglKontrak = '$tgl_kontrak[$index]',
                                                    Pekerjaan = '$p_pengadaan_pekerjaan[$index]' WHERE Kontrak_ID = $Kontrak_ID[$index]";
                                    //print_r($querykontrak);
                                    
                                    $resultkontrak=  mysql_query($querykontrak)or die ('eror 2');
                                    
                                    
                                    $querykontraktor="UPDATE Kontraktor SET NamaKontraktor = '$p_pengadaan_kontraktor[$index]' WHERE Kontraktor_ID = $Kontraktor_ID[$index]";
                              //      print_r($querykontraktor);
                                    $resultkontraktor=  mysql_query($querykontraktor)or die ('eror 1');
                                    //($resultkontraktor) ? $kontraktor_id = $kontraktor_id : $kontraktor_id = 'NULL';
                                    
                                    //$kontrak_id=  get_auto_increment("Kontrak");
                                    
                                    
                                    //($resultkontrak) ? $kontrak_id = $kontrak_id : $kontrak_id = 'NULL';
                                    
                                    //$kontrakaset=get_auto_increment("KontrakAset");
                                    /*
                                    $querykontrakaset="UPDATE KontrakAset SET Aset_ID = $Aset_ID WHERE Kontrak_ID= $Kontrak_ID";
                                    $resultkontrakaset=  mysql_query($querykontrakaset)or die('eror 3');
                                    ($resultkontrakaset) ? $kontrakaset = $kontrakaset : $kontrakaset = 'NULL';
                                    */
                                    //$sp2d_id=get_auto_increment("SP2D");
                                    
                                    $index++;
                                }
                                
                                $index = 0;
                                foreach ($SP2D_ID as $sp2d_id_array)
                                {
                                    $tgl_sp2d[$index] = $RETRIEVE->change_date_to_strip(array('data'=>$p_pengadaan_tglsp2d[$index], 'type'=>''));
                                    
                                    list ($tanggal, $bulan, $tahun) = explode ('/',$p_pengadaan_tglsp2d[$index]);
                                    if ($tanggal !='' and $bulan !='' and $tahun !='')
                                    {
                                        //$tgl_sp2d = "$tahun-$bulan-$tanggal";
                                        $querysp2d= "UPDATE SP2D SET NoSP2D = '$p_pengadaan_nosp2d[$index]',TglSP2D = '$tgl_sp2d[$index]',
                                                    MAK = '$p_pengadaan_mataanggaran',NilaiSP2D = '$p_pengadaan_nilaisp2d[$index]'
                                                    WHERE SP2D_ID = $sp2d_id_array";
                                 //       print_r($querysp2d);
                                        $resultsp2d = mysql_query($querysp2d) or die ('eror 15');
                                        //($resultsp2d) ? $sp2d_id = $sp2d_id : $sp2d_id = 'NULL';
                                        
                                        //$id_kapitalisasi_aset=  get_auto_increment("KapitalisasiAset");
                                        /*
                                        $querykapitalisasiaset= "INSERT INTO KapitalisasiAset (Aset_ID,SP2D_ID) VALUES('$aset_id','$sp2d_id')";
                                        $resultkapitalisasiaset = mysql_query($querykapitalisasiaset) or die ('eror 16');
                                        //($resultkapitalisasiaset) ? $id_kapitalisasi_aset = $id_kapitalisasi_aset : $id_kapitalisasi_aset = 'NULL';
                                        */
                                        $index++;
                                    }
                                    
                                }
                                
                                $query = "UPDATE Aset SET SumberDana = '$p_pengadaan_sumberdana' WHERE Aset_ID = $Aset_ID";
                                $result = mysql_query($query) or die (mysql_error());
                            }
                            
                            
                            
                        }
                        break;
                    case '2':
                        {
                         
                            //hibah
                            $p_pengadaan_nilaisp2d=$_POST['p_pengadaan_nilaisp2d'];
                            $p_hibah_pemberi=$_POST['p_hibah_pemberi'];
                            $p_hibah_nobbast=$_POST['p_hibah_nobbast'];
                            $p_hibah_tglbas = $_POST['p_hibah_tglbast']; ///bulan/tanggal/tahun 
                            $daten = explode('/', $p_hibah_tglbas); ///
                            $p_hibah_tglbast= $daten[2].$daten[1].$daten[0]; 
                            $p_hibah_namapertama=$_POST['p_hibah_namapertama'];
                            $p_hibah_jabatan_pertama=$_POST['p_hibah_jabatan_pertama'];
                            $p_hibah_nippertama=$_POST['p_hibah_nippertama'];
                            $p_hibah_namakedua=$_POST['p_hibah_namakedua'];
                            $p_hibah_jabatan_kedua=$_POST['p_hibah_jabatan_kedua'];
                            $p_hibah_nipkedua=$_POST['p_hibah_nipkedua'];
                            
                            
                            if ($hidden_perolehan !== $p_perolehan_caraperolehan)
                            {
                                //delete
                                $index = 0;
                                
                                foreach ($Kontrak_ID as $kontrak_id)
                                {
                                    $parameter = array('perolehan'=>$hidden_perolehan,
                                                        'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID[$index],'Kontrak_ID'=>$kontrak_id,
                                                        'SP2D_ID'=>$SP2D_ID[$index],'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID,
                                                        'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID);
                                    $delete = delete_perolehan($parameter);
                                    
                                    $index++;
                                }
                                /*
                                $parameter = array('perolehan'=>$hidden_perolehan,
                                                   'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID,'Kontrak_ID'=>$Kontrak_ID,
                                                   'SP2D_ID'=>$SP2D_ID,'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID,
                                                   'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID);
                                $delete = delete_perolehan($parameter);
                                */
                                //insert
                                $Get_BAST_ID=  get_auto_increment("BAST");
                                $querybast="insert into BAST(BAST_ID, PemberiHibah,NoBAST,TglBAST,NamaPihak1,JabatanPihak1,NIPPihak1,NamaPihak2,JabatanPihak2,
                                                NIPPihak2) values($Get_BAST_ID, '$p_hibah_pemberi','$p_hibah_nobbast','$p_hibah_tglbast','$p_hibah_namapertama',
                                                '$p_hibah_jabatan_pertama','$p_hibah_nippertama','$p_hibah_namakedua','$p_hibah_jabatan_kedua',
                                                '$p_hibah_nipkedua')";
                                $resultbast=  mysql_query($querybast)or die ('eror insert into BAST');
                                ($resultbast) ? $BAST_ID = $Get_BAST_ID : $BAST_ID = $BAST_ID;
                                
                                $queryaset="UPDATE Aset SET  BAST_ID = '$BAST_ID' WHERE Aset_ID = $Aset_ID";
                           // print_r($queryaset);
                            $resultaset=  mysql_query($queryaset)or die ('eror update aset bast'); 
                                
                            }
                            else
                            {
								if($BAST_ID != ''){
                                $querybast="UPDATE BAST SET PemberiHibah = '$p_hibah_pemberi',NoBAST = '$p_hibah_nobbast',TglBAST = '$p_hibah_tglbast',
                                            NamaPihak1 = '$p_hibah_namapertama',JabatanPihak1 = '$p_hibah_jabatan_pertama',NIPPihak1 = '$p_hibah_nippertama',
                                            NamaPihak2 = '$p_hibah_namakedua',JabatanPihak2 ='$p_hibah_jabatan_kedua',NIPPihak2 ='$p_hibah_nipkedua'
                                            WHERE BAST_ID = $BAST_ID";
                               // print_r($querybast);
                                $resultbast=  mysql_query($querybast)or die ('eror UPDATE BAST');
                                //($resultbast) ? $bast_id = $bast_id : $bast_id = 'NULL';
								}
							}
                            
                        }
                        break;
                    case '4':
                        {
                            //keputusanundang-undang//
                        
                            $p_uud_no_uud=$_POST['p_uud_no_uud'];
                            $p_uud_jenisaset=$_POST['p_uud_jenisaset'];
                            $p_uud_asalaset=$_POST['p_uud_asalaset'];
                            $p_uud_keterangan=$_POST['p_uud_keterangan'];
                            
                            
                            
                            if ($hidden_perolehan !== $p_perolehan_caraperolehan)
                            {
                                
                                //delete
                                $index = 0;
                                
                                foreach ($Kontrak_ID as $kontrak_id)
                                {
                                    $parameter = array('perolehan'=>$hidden_perolehan,
                                                        'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID[$index],'Kontrak_ID'=>$kontrak_id,
                                                        'SP2D_ID'=>$SP2D_ID[$index],'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID,
                                                        'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID);
                                    $delete = delete_perolehan($parameter);
                                    
                                    $index++;
                                }
                                //$BAST_ID=  get_auto_increment("BAST");
                                /*
                                $keputusanundangundang_id= get_auto_increment("KeputusanUndangUndang");
                                $parameter = array('perolehan'=>$hidden_perolehan,
                                                   'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID,'Kontrak_ID'=>$Kontrak_ID,
                                                   'SP2D_ID'=>$SP2D_ID,'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID,
                                                   'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID);
                                $delete = delete_perolehan($parameter);
                                */
                                //insert
                                
                                $Get_KeputusanUndangUndang_ID = get_auto_increment('KeputusanUndangUndang');
                                $queryundangundang= "INSERT INTO KeputusanUndangUndang(KeputusanUndangUndang_ID, NoKeputusan,Aset_ID,JenisAset,AsalAset,Keterangan)
                                                    VALUES($Get_KeputusanUndangUndang_ID, '$p_uud_no_uud','$Aset_ID','$p_uud_jenisaset','$p_uud_asalaset','$p_uud_keterangan')";
                              //  print_r($queryundangundang);
                                $resultundangundang = mysql_query($queryundangundang) or die ('eror insert uud');
                                ($keputusanundangundang) ? $keputusanundangundang_id = $Get_KeputusanUndangUndang_ID : $keputusanundangundang_id = $keputusanundangundang_id;
                            }
                            else
                            {
                              //  echo 'aada';
                                
                                
                                        $queryundangundang= "UPDATE KeputusanUndangUndang SET NoKeputusan = '$p_uud_no_uud',
                                                            JenisAset = '$p_uud_jenisaset',AsalAset = '$p_uud_asalaset',Keterangan = '$p_uud_keterangan'
                                                            WHERE KeputusanUndangUndang_ID = $KeputusanUndangUndang_ID";
                                   //     print_r($queryundangundang);
                                        $resultpengadilan = mysql_query($queryundangundang) or die ('eror uppdate uud');
                                        
                                        //($resultpengadilan) ? $keputusanundangundang_id = $keputusanundangundang_id : $keputusanundangundang_id = 'NULL';
                                
                               
                            }
                            
                            
                        }
                        break;
                    case '3':
                        {
                            //keputusan pengadilan//
                            $p_pengadilan_no_pengadilan=$_POST['p_pengadilan_no_pengadilan'];
                            $p_pengadilan_jenisaset=$_POST['p_pengadilan_jenisaset'];
                            $p_pengadilan_asalaset=$_POST['p_pengadilan_asalaset'];
                            $p_pengadilan_keterangan=$_POST['p_pengadilan_keterangan'];
                           
                           // echo 'hidden perolehan'.$hidden_perolehan.'<br>';
                         //   echo 'hidden cara perolehan'.$p_perolehan_caraperolehan.'<br>';
                            
                            if ($hidden_perolehan !== $p_perolehan_caraperolehan)
                            {
                                $index = 0;
                            //    echo 'masuk coy';
                                foreach ($Kontrak_ID as $kontrak_id)
                                {
                                    $parameter = array('perolehan'=>$hidden_perolehan,
                                                        'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID[$index],'Kontrak_ID'=>$kontrak_id,
                                                        'SP2D_ID'=>$SP2D_ID[$index],'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID,
                                                        'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID);
                                    $delete = delete_perolehan($parameter);
                                    
                                    $index++;
                                }
                                //delete
                                /*
                                $parameter = array('perolehan'=>$hidden_perolehan,
                                                   'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID,'Kontrak_ID'=>$Kontrak_ID,
                                                   'SP2D_ID'=>$SP2D_ID,'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID,
                                                   'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID);
                                $delete = delete_perolehan($parameter);
                                */
                                //insert
                                
                                $Get_KeputusanPengadilan_ID= get_auto_increment("KeputusanPengadilan");
                                $querypengadilan= "INSERT INTO KeputusanPengadilan (KeputusanPengadilan_ID, NoKeputusan,Aset_ID,JenisAset,AsalAset,Keterangan)
                                                    VALUES(NULL, '$p_pengadilan_no_pengadilan','$Aset_ID','$p_pengadilan_jenisaset','$p_pengadilan_asalaset',
                                                    '$p_pengadilan_keterangan')";
                            //    print_r($querypengadilan);
                                $resultundangundang= mysql_query($querypengadilan) or die ('eror insert keputusan pengadilan');
                                ($resultundangundang) ? $keputusanpengadilan_id = $Get_KeputusanPengadilan_ID : $keputusanpengadilan_id = $keputusanpengadilan_id;
                                
                            }
                            else
                            {
                                
                                if ($KeputusanPengadilan_ID !='')
                                {
                                    $querypengadilan= "UPDATE KeputusanPengadilan SET NoKeputusan = '$p_pengadilan_no_pengadilan', JenisAset = '$p_pengadilan_jenisaset',
                                                        AsalAset = '$p_pengadilan_asalaset',Keterangan ='$p_pengadilan_keterangan'
                                                        WHERE KeputusanPengadilan_ID = $KeputusanPengadilan_ID ";
                               //     print_r($querypengadilan);
                                    $resultundangundang= mysql_query($querypengadilan) or die ('eror update keputusan pengadilan');
                                    //($resultundangundang) ? $keputusanpengadilan_id = $keputusanpengadilan_id : $keputusanpengadilan_id = 'NULL';
                                }
                                
                            }
                            
                        
                        }
                        break;
                    
                    default:
                        {
                            //echo 'masuk bro';
                            
                            //exit;
                            foreach ($Kontrak_ID as $kontrak_id)
                                {
                                    $parameter = array('perolehan'=>$hidden_perolehan,
                                                        'Aset_ID' =>$Aset_ID,'Kontraktor_ID'=>$Kontraktor_ID[$index],'Kontrak_ID'=>$kontrak_id,
                                                        'SP2D_ID'=>$SP2D_ID[$index],'BAST_ID'=>$BAST_ID,'KeputusanUndangUndang_ID'=>$KeputusanUndangUndang_ID[$index],
                                                        'KeputusanPengadilan_ID'=>$KeputusanPengadilan_ID[$index]);
                                    $delete = delete_perolehan($parameter);
                                    
                                    $index++;
                                }
                        }
                    
                }
                // insert data sesuai pilihan
                
                
            }
            //end p_perolehan_caraperolehan
            
            // p_penghapusan_aset
            
            $p_penghapusan_aset = $_POST['p_penghapusan_aset'];
            $hidden_penghapusan = $_POST['hidden_penghapusan'];
            
            if ($p_penghapusan_aset !=0)
            {
                switch ($p_penghapusan_aset)
                {
                    case '1':
                        {
                            //pemindahtanganan
                            if ($Pemusnahan_ID !='')
                                {
                                    $query1 = "DELETE FROM Pemusnahan WHERE Pemusnahan_ID = $Pemusnahan_ID";
                                    
                            //        print_r($query1);
                                    $result13 = mysql_query($query1) or die  ('eror delete penghapusan');
                                       $queryasetnullpemusnahan="    UPDATE Aset SET
                            BAPemusnahan_ID =NULL
                            WHERE Aset_ID = $Aset_ID";
                        //    print_r($queryasetnullpemusnahan);
                            $resultaset=  mysql_query($queryasetnullpemusnahan)or die ('eror update bap'); 
                                }
                            $p_p_tangan_nobasp=$_POST['p_p_tangan_nobasp'];
                            $p_p_tangan_tglbas = $_POST['p_p_tangan_tglbasp']; ///bulan/tanggal/tahun 
                            $datek = explode('/', $p_p_tangan_tglbas); ///
                            $p_p_tangan_tglbasp = $datek[2].$datek[1].$datek[0];   
                            $p_p_tangan_namapertama=$_POST['p_p_tangan_namapertama'];
                            $p_p_tangan_jbtnpertama=$_POST['p_p_tangan_jbtnpertama'];
                            $p_p_tangan_nippertama=$_POST['p_p_tangan_nippertama'];
                            $p_p_tangan_lokasipertama=$_POST['p_p_tangan_lokasipertama'];
                            $p_p_tangan_namakedua=$_POST['p_p_tangan_namakedua'];
                            $p_p_tangan_jbtnkedua=$_POST['p_p_tangan_jbtnkedua'];
                            $p_p_tangan_nipkedua=$_POST['p_p_tangan_nipkedua'];
                            $p_p_tangan_lokasikedua=$_POST['p_p_tangan_lokasikedua'];
                            $p_p_tangan_noskpenetapan=$_POST['p_p_tangan_noskpenetapan'];
                            $p_p_tangan_tglskpenetapa = $_POST['p_p_tangan_tglskpenetapan']; ///bulan/tanggal/tahun 
                            $datel = explode('/', $p_p_tangan_tglskpenetapa); ///
                            $p_p_tangan_tglskpenetapan = $datel[2].$datel[1].$datel[0];   
                            $p_p_tangan_noskhapus=$_POST['p_p_tangan_noskhapus'];
                            $p_p_tangan_tglskhapus=$_POST['p_p_tangan_tglskhapus'];
                            $p_p_tangan_tglskhapu = $_POST['p_p_tangan_tglskhapus']; ///bulan/tanggal/tahun 
                            $datem = explode('/', $p_p_tangan_tglskhapu); ///
                            $p_p_tangan_tglskhapus = $datem[2].$datem[1].$datem[0];
                            $p_keterangantambahan=$_POST['p_keterangantambahan'];
                            
                            
                           
                                //delete
                                if ($BASP_ID == ''){
                                $Get_BASP_ID=  get_auto_increment("BASP");
                                $querybaspinsert="insert into BASP(BASP_ID, NoBASP,TglBASP,NamaPihak1,JabatanPihak1,NIPPihak1,LokasiPihak1,NamaPihak2,JabatanPihak2,NIPPihak2,
                                                LokasiPihak2,NoSKPenetapan,TglSKPenetapan,NoSKPenghapusan,TglSKPenghapusan)
                                                VALUES ($Get_BASP_ID, '$p_p_tangan_nobasp','$p_p_tangan_tglbasp','$p_p_tangan_namapertama','$p_p_tangan_jbtnpertama',
                                                '$p_p_tangan_nippertama','$p_p_tangan_lokasipertama','$p_p_tangan_namakedua','$p_p_tangan_jbtnkedua',
                                                '$p_p_tangan_nipkedua','$p_p_tangan_lokasikedua','$p_p_tangan_noskpenetapan','$p_p_tangan_tglskpenetapan',
                                                '$p_p_tangan_noskhapus','$p_p_tangan_tglskhapus')";
                
                                echo $querybaspinsert;
                                $resultbasp=  mysql_query($querybaspinsert)or die ('eror basp insert');
                                ($resultbasp) ? $BASP_ID = $Get_BASP_ID : $BASP_ID = $BASP_ID;
                                
                                  $queryaset="    UPDATE Aset SET
                          
                            BASP_ID = '$BASP_ID'
                            WHERE Aset_ID = $Aset_ID";
                       //     print_r($queryaset);
                            $resultaset=  mysql_query($queryaset)or die ('eror update basp'); 
                          
                            }
                            else
                            {
                                //update
                          
                                $querybaspupdate="UPDATE BASP SET NoBASP = '$p_p_tangan_nobasp',
                                            TglBASP = '$p_p_tangan_tglbasp',
                                            NamaPihak1 = '$p_p_tangan_namapertama',
                                            JabatanPihak1 = '$p_p_tangan_jbtnpertama',
                                            NIPPihak1 = '$p_p_tangan_nippertama',
                                            LokasiPihak1 = '$p_p_tangan_lokasipertama',
                                            NamaPihak2 = '$p_p_tangan_namakedua',
                                            JabatanPihak2 = '$p_p_tangan_jbtnkedua',
                                            NIPPihak2 = '$p_p_tangan_nipkedua',
                                            LokasiPihak2 = '$p_p_tangan_lokasikedua',
                                            NoSKPenetapan = '$p_p_tangan_noskpenetapan',
                                            TglSKPenetapan = '$p_p_tangan_tglskpenetapan',
                                            NoSKPenghapusan = '$p_p_tangan_noskhapus',
                                            TglSKPenghapusan = '$p_p_tangan_tglskhapus'
                                            WHERE BASP_ID = $BASP_ID";
                
                          //      print_r($querybaspupdate);
                                $resultbasp=  mysql_query($querybaspupdate)or die ('eror basp update');
                                //($resultbasp) ? $BASP_ID = $BASP_ID : $BASP_ID = 'NULL';
                                  $queryaset="    UPDATE Aset SET
                
                            BAST_ID = '$BAST_ID',
                            BAPemusnahan_ID = '$Pemusnahan_ID'
                            WHERE Aset_ID = $Aset_ID";
                     //       print_r($queryaset);
                            $resultaset=  mysql_query($queryaset)or die ('eror basp bast'); 
                             
                            }
                            
                            
                        }
                        break;
                    case '2':
                        {
                        
                         if ($BASP_ID !='')
                                {
                                    $query1 = "DELETE FROM BASP WHERE $BASP_ID = $BASP_ID";   
                             //       print_r($query1);
                                    $result13 = mysql_query($query1) or die  ('eror delete penghapusan');
                            $queryasetnullbasp="    UPDATE Aset SET
                            BASP_ID =NULL
                            WHERE Aset_ID = $Aset_ID";
                          //  prin_r($queryasetnullbasp);
                            $resultaset=  mysql_query($queryasetnullbasp)or die ('eror 17'); 
                                }
                            //pemusnahan
                            $p_keterangantambahan=$_POST['p_keterangantambahan'];
                            $p_pmusnah_keterangan=$_POST['p_pmusnah_keterangan'];
                            $p_pmusnah_noskpenetapan=$_POST['p_pmusnah_noskpenetapan'];
                            $p_pmusnah_tglskpenetapa = $_POST['p_pmusnah_tglskpenetapan']; ///bulan/tanggal/tahun 
                            $datet= explode('/', $p_pmusnah_tglskpenetapa); ///
                            $p_pmusnah_tglskpenetapan= $datet[2].$datet[1].$datet[0];
                            $p_pmusnah_noskhapus=$_POST['p_pmusnah_noskhapus'];
                            $p_pmusnah_tglskhapu= $_POST['p_pmusnah_tglskhapus']; ///bulan/tanggal/tahun 
                            $dateu = explode('/', $p_pmusnah_tglskhapu); ///
                            $p_pmusnah_tglskhapus = $dateu[2].$dateu[1].$dateu[0];
                            
                            
                            if (Pemusnahan_ID !='')
                            {
                                //delete
                              
                                $Get_Pemusnahan_ID=  get_auto_increment("Pemusnahan");
                                $querypemusnahan= "INSERT INTO Pemusnahan(Pemusnahan_ID, KetPemusnahan,Aset_ID,NoSKPenetapan,TglSKPenetapan,NoSKPenghapusan,TglSKPenghapusan)
                                                        VALUES($Get_Pemusnahan_ID, '$p_pmusnah_keterangan','$Aset_ID','$p_pmusnah_noskpenetapan','$p_pmusnah_tglskpenetapan',
                                                        '$p_pmusnah_noskhapus','$p_pmusnah_tglskhapus')";
                                
                                $resultpemusnahan = mysql_query($querypemusnahan) or die ('eror pemusnahan insert');
                                ($resultpemusnahan) ? $Pemusnahan_ID = $Get_Pemusnahan_ID : $Pemusnahan_ID = $Pemusnahan_ID;
                           
                            $queryaset="    UPDATE Aset SET
                
                          
                            BAPemusnahan_ID = '$Pemusnahan_ID'
                            WHERE Aset_ID = $Aset_ID";
                        //    print_r($queryaset);
                            $resultaset=  mysql_query($queryaset)or die ('eror update bap'); 
                                
                                }
                            else
                            {
                                
                                $querypemusnahan= "UPDATE Pemusnahan SET KetPemusnahan = '$p_pmusnah_keterangan',
                                                    NoSKPenetapan = '$p_pmusnah_noskpenetapan',
                                                    TglSKPenetapan = '$p_pmusnah_tglskpenetapan',
                                                    NoSKPenghapusan = '$p_pmusnah_noskhapus',
                                                    TglSKPenghapusan = '$p_pmusnah_tglskhapus'
                                                    WHERE Pemusnahan_ID = '$Pemusnahan_ID'";
                                $resultpemusnahan = mysql_query($querypemusnahan) or die ('eror pemusnahan update');
                                //($resultpemusnahan) ? $pemusnahan_id = $pemusnahan_id : $pemusnahan_id = 'NULL';
                                
                                $queryaset="    UPDATE Aset SET
                
                          
                            BAPemusnahan_ID = '$Pemusnahan_ID'
                            WHERE Aset_ID = $Aset_ID";
                       //     print_r($queryaset);
                            $resultaset=  mysql_query($queryaset)or die ('eror update aset'); 
                                
                            }
                            
                        }
                        break;
                    default :
                       
                   
                }
                // insert data sesuai pilihan
            }
            // end p_penghapusan_aset
              else if($p_penghapusan_aset ==0){
                   $queryupdateaset = "UPDATE Aset SET BAPemusnahan_ID=NULL, BASP_ID=NULL WHERE Aset_ID =$Aset_ID";
                              //   print_r($queryupdateaset);
                                $result24 = mysql_query($queryupdateaset) or die  ('eror update penghapusan1');
                     if ($Pemusnahan_ID !='')
                                {
                                    $query1 = "DELETE FROM Pemusnahan WHERE Pemusnahan_ID = $Pemusnahan_ID";
                                //    echo'gdds';
                              //      print_r($query1);
                                    $result13 = mysql_query($query1) or die  ('eror delete penghapusan');
                                }
                                
                                   if ($BASP_ID !='')
                                {
                                    $query1 = "DELETE FROM BASP WHERE $BASP_ID = $BASP_ID";
                                //    echo'gdds';
                                //    print_r($query1);
                                    $result13 = mysql_query($query1) or die  ('eror delete penghapusan');
                                }
                                
                  
              }
            
            
            
            

            
            
            
            // debuging variable
            /*
            print_r($queryaset);
            echo '<br>';
            print_r($query);
            echo '<br>';
            print_r($queryasetlain);
            // end golongan
            exit;
            */
        //}
        //return true;
      echo "<script>alert('Data Sudah Dirubah !!!'); document.location='hasil_koreksi_data.php?pid=1';</script>";
        //echo 'data sudah masuk';
    /*    
    }
    else
    {
       echo '<script type=text/javascript>alert("Silahkan masukan data Kelompok, Aset, Golongan, lokasi dan "); history.back(); </script>';
    }
    */

}


function delete_table($golongan, $id)
{
    switch ($golongan)
    {
        case '01':
            {
                if ($id !=''){
                    $query = "DELETE FROM Tanah WHERE Tanah_ID = $id";
                   // print_r($query);
                    $result = mysql_query($query) or die (mysql_error('error delete table'));
                }
                
            }
            break;
        case '02':
            {
                if ($id !='')
                {
                    $query = "DELETE FROM Mesin WHERE Mesin_ID = $id";
                    $result = mysql_query($query) or die (mysql_error('error delete table'));
                }
                 
            }
            break;
        case '04':
            {
                if ($id !='')
                {
                    $query = "DELETE FROM Jaringan WHERE Jaringan_ID = $id";
                    $result = mysql_query($query) or die (mysql_error('error delete table'));
                }
            }
            break;
        case '03':
            {
                if ($id !='')
                {
                    $query = "DELETE FROM Bangunan WHERE Bangunan_ID = $id";
                    $result = mysql_query($query) or die (mysql_error('error delete table'));
                }
            }
            break;
        case '05':
            {
                if ($id !='')
                {
                    $query = "DELETE FROM AsetLain WHERE AsetLain_ID = $id";
                    $result = mysql_query($query) or die (mysql_error('error delete table'));
                }
            }
            break;
        case '06':
            {
                if ($id !='')
                {
                    $query = "DELETE FROM KDP WHERE KDP_ID = $id";
                    $result = mysql_query($query) or die (mysql_error('error delete table'));
                }
            }
            break;
        case '07':
            {
                if ($id !='')
                {
                    $query = "Update Aset SET Kuantitas = null, Satuan = null WHERE Aset_ID = $id";
                    $result = mysql_query($query) or die (mysql_error('error delete table'));
                }
            }
            break;
    }
   // print_r($query);
    //exit;
    return true;
}

function get_golongan($parameter)
{
   
    switch ($parameter)
    {
        case '01':
            {
                $gol = '01';
                $field = "Tanah_ID";    
            }
            break;
        case '02':
            {
                $gol = '02';
                $field = "Mesin_ID";    
            }
            break;
        case '04':
            {
                $gol = '04';
                $field = "Jaringan_ID";    
            }
            break;
        case '03':
            {
                $gol = '03';
                $field = "Bangunan_ID";    
            }
            break;
        case '05':
            {
                $gol = '05';
                $field= "AsetLain_ID";    
            }
            break;
        case '06':
            {
                $gol = '06';
                $field = "KDP_ID";    
            }
            break;
        case '07':
            {
                $gol = '07';
                $field = "Aset_ID";    
            }
            break;
    }
    return array ($gol, $field);
}

function delete_perolehan($parameter)
{
    switch ($parameter['perolehan'])
    {
        case '1':
            {
                if ($parameter[Kontrak_ID] !='')
                {
                    $query1 = "DELETE FROM KontrakAset WHERE Kontrak_ID = $parameter[Kontrak_ID]";
                  //  print_r($query1);
                    $result1 = mysql_query($query1) or die (mysql_error('error KontrakAset'));
                    
                }
                if ($parameter[Kontrak_ID] !='')
                {
                    $query2 = "DELETE FROM Kontrak WHERE Kontrak_ID = $parameter[Kontrak_ID]";
                    $result2 = mysql_query($query2) or die (mysql_error('error kontrak'));
                }
                if ($parameter[Kontraktor_ID] !='')
                {
                    $query3 = "DELETE FROM Kontraktor WHERE Kontraktor_ID = $parameter[Kontraktor_ID]";
                    $result3 = mysql_query($query3) or die (mysql_error('error Kontraktor'));
                }
                if ($parameter[Aset_ID] !='')
                {
                    $query4 = "DELETE FROM KapitalisasiAset WHERE Aset_ID = $parameter[Aset_ID]";
                    $result4 = mysql_query($query4) or die (mysql_error('error KapitalisasiAset'));
                }
                if ($parameter[SP2D_ID] !='')
                {
                    $query5 = "DELETE FROM SP2D WHERE SP2D_ID = $parameter[SP2D_ID]";
                    $result5 = mysql_query($query5) or die (mysql_error('error SP2D'));
                }
                
                
                return true;
            }
            break;
        case '2':
            {
                    
          
                if ($parameter[BAST_ID] !='')
                {
                    $query1 = "DELETE FROM BAST WHERE BAST_ID = $parameter[BAST_ID]";
                    $result1 = mysql_query($query1) or die ('error BAST');
                }
                if ($parameter[Aset_ID] !='')
                {
                    $query2 = "UPDATE Aset SET BAST_ID = null WHERE Aset_ID = $parameter[Aset_ID]";
                    $result1 = mysql_query($query2) or die ('error BAST');
                }
                
                return true;
            }
            break;
        case '4':
            {
                if ($parameter[KeputusanUndangUndang_ID] !='')
                {
                    
                    $query = "DELETE FROM KeputusanUndangUndang WHERE KeputusanUndangUndang_ID = $parameter[KeputusanUndangUndang_ID]";
                  //  print_r($query);
                    $result1 = mysql_query($query) or die (mysql_error('error KeputusanUndangUndang'));

                    
                }
                    return true;
                
            }
            break;
        case '3':
            {
                if ($parameter[KeputusanPengadilan_ID] !='')
                {
                    $query = "DELETE FROM KeputusanPengadilan WHERE KeputusanPengadilan_ID = $parameter[KeputusanPengadilan_ID]";
                    $result1 = mysql_query($query) or die (mysql_error('error KeputusanPengadilan'));
                }
                return true;
            }
            break;
        
        default:
            {
                
                if ($parameter[Kontrak_ID] !='')
                {
                    $query1 = "DELETE FROM KontrakAset WHERE Kontrak_ID = $parameter[Kontrak_ID]";
                  //  print_r($query1);
                    $result1 = mysql_query($query1) or die (mysql_error('error KontrakAset'));
                }
                if ($parameter[Kontrak_ID] !='')
                {
                    $query2 = "DELETE FROM Kontrak WHERE Kontrak_ID = $parameter[Kontrak_ID]";
                    $result2 = mysql_query($query2) or die (mysql_error('error kontrak'));
                }
                if ($parameter[Kontraktor_ID] !='')
                {
                    $query3 = "DELETE FROM Kontraktor WHERE Kontraktor_ID = $parameter[Kontraktor_ID]";
                    $result3 = mysql_query($query3) or die (mysql_error('error Kontraktor'));
                }
                if ($parameter[Aset_ID] !='')
                {
                    $query4 = "DELETE FROM KapitalisasiAset WHERE Aset_ID = $parameter[Aset_ID]";
                    $result4 = mysql_query($query4) or die (mysql_error('error KapitalisasiAset'));
                }
                if ($parameter[SP2D_ID] !='')
                {
                    $query5 = "DELETE FROM SP2D WHERE SP2D_ID = $parameter[SP2D_ID]";
                    $result5 = mysql_query($query5) or die (mysql_error('error SP2D'));
                }
                if ($parameter[BAST_ID] !='')
                {
                    $query1 = "DELETE FROM BAST WHERE BAST_ID = $parameter[BAST_ID]";
                  //  print_r($query1);
                    $result1 = mysql_query($query1) or die ('error BAST');
                }
                if ($parameter[Aset_ID] !='')
                {
                    $query2 = "UPDATE Aset SET BAST_ID = null WHERE Aset_ID = $parameter[Aset_ID]";
                    $result1 = mysql_query($query2) or die ('error BAST');
                }
                if ($parameter[KeputusanUndangUndang_ID] !='')
                {
                    $query = "DELETE FROM KeputusanUndangUndang WHERE KeputusanUndangUndang_ID = $parameter[KeputusanUndangUndang_ID]";
                    //print_r($query);
                    $result1 = mysql_query($query) or die (mysql_error('error KeputusanUndangUndang'));
                }
                if ($parameter[KeputusanPengadilan_ID] !='')
                {
                    $query = "DELETE FROM KeputusanPengadilan WHERE KeputusanPengadilan_ID = $parameter[KeputusanPengadilan_ID]";
                    $result1 = mysql_query($query) or die (mysql_error('error KeputusanPengadilan'));
                }
                
                return true;
            }
    }
}

/*
function delete_penghapusan($parameter)
{
    $ASET_ID=$parameter['Aset_ID'];
    $basp_id=$parameter['BASP_ID'];
    $pemusnahan_id=$parameter['Pemusnahan_ID'];
    switch ($parameter['penghapusan'])
    {
        case '1':
            {
            //
             if ($pemusnahan_id !='')
                {
                    $query1 = "DELETE FROM Pemusnahan WHERE Pemusnahan_ID = $pemusnahan_id";
                    echo'gdds';
                    print_r($query1);
                    $result13 = mysql_query($query1) or die  ('eror delete penghapusan');
                }
                
                if ($ASET_ID !='')
                {
                    $query2 = "UPDATE Aset SET BAPemusnahan_ID='' WHERE Aset_ID =$ASET_ID";
                    $result24 = mysql_query($query2) or die  ('eror update penghapusan');
                }
         
            }
            break;
        case '2':
            {
                if ($basp_id !='')
                {
                    $query1 = "DELETE FROM BASP WHERE BASP_ID = $basp_id";
                    $result13 = mysql_query($query1) or die  ('eror delete penghapusan');
                }
                
                if ($ASET_ID !='')
                {
                    $query2 = "UPDATE Aset SET BASP_ID=NULL WHERE Aset_ID =$ASET_ID";
                    $result24 = mysql_query($query2) or die  ('eror update penghapusan');
                }
                
            }   
            break;
        default :
            {
                echo 'masuk';
                /*
                $query1 = "DELETE FROM BASP WHERE BASP_ID = $basp_id";
                $result1 = mysql_query($query1) or die  ('eror delete penghapusan1');
                $query2 = "UPDATE Aset SET BASP_ID = NULL WHERE Aset_ID =$ASET_ID";
                print_r($query2);
                $result2 = mysql_query($query2) or die  ('eror update penghapusan1');
                
                $query3 = "DELETE FROM Pemusnahan WHERE Pemusnahan_ID = $pemusnahan_id";
                $result3 = mysql_query($query3) or die  ('eror delete penghapusan2');
                $query4 = "UPDATE Aset SET BAPemusnahan_ID = null WHERE Aset_ID =$ASET_ID";
                $result4 = mysql_query($query4) or die  ('eror update penghapusan3');
              
            }
    }
    

    
   return true;
}
 * 
 */

 
$aset_id=$_POST['Aset_ID'];
        $Kontraktor_ID=$_POST['kontraktor_id'];
        $sp2d_ID=$_POST['SP2D_ID'];
        $Penerimaan_ID=$_POST['Penerimaan_ID'];
        $BAST_ID=$_POST['BAST_ID'];
        $BASP_ID=$_POST['BASP_ID'];
        $Kontrakid=$_POST['Kontrak_ID'];
        $sp2did=$_POST['SP2D_ID'];
        
        if ($_POST['hapus']) {
    
            if ($aset_id !='')
            {
            $querydeleteaset = "DELETE from Aset where Aset_ID=$aset_id";
            $resultdeleteaset = mysql_query($querydeleteaset) or die ('eror2');
            $querydeletetanah = "DELETE from Tanah where Aset_ID=$aset_id";
            $resultdeletedeletetanah = mysql_query($querydeletetanah) or die ('eror3');
            $querydeletemesin = "DELETE from Mesin where Aset_ID=$aset_id";
            $resultdeletemesin = mysql_query($querydeletemesin) or die ('eror4');
            $querydeletebangunan = "DELETE from Bangunan where Aset_ID=$aset_id";
            $resultdeletebangunan = mysql_query($querydeletebangunan) or die ('eror5');
            $querydeletejaringan = "DELETE from Jaringan where Aset_ID=$aset_id";
            $resultdeletejaringan = mysql_query($querydeletejaringan) or die ('eror6');
            $querydeleteasetlain = "DELETE from AsetLain where Aset_ID=$aset_id";
            $resultdeleteasetlain = mysql_query($querydeleteasetlain) or die ('eror7');
            $querydeleteasetkdp = "DELETE from KDP where Aset_ID=$aset_id";
            $resultdeleteasetkdp = mysql_query($querydeleteasetkdp) or die ('eror8');
            $querydeletekeputusanundangundang = "DELETE from KeputusanUndangUndang where Aset_ID=$aset_id";
            $resultdeletekeputusanundangundang = mysql_query($querydeletekeputusanundangundang) or die ('eror9');
            $querydeletekeputusanpengadilan = "DELETE from KeputusanPengadilan where Aset_ID=$aset_id";
            $resultdeletekeputusanpengadilan = mysql_query($querydeletekeputusanpengadilan) or die ('eror10');
            $querydeletefoto = "DELETE from Foto where Aset_ID=$aset_id";
            $resultdeletefoto = mysql_query($querydeletefoto) or die ('eror11');
            $querydeletefotonota = "DELETE from FotoNota where Aset_ID=$aset_id";
            $resultdeletefotonota = mysql_query($querydeletefotonota) or die ('eror12');
            $querydeletekapitalisasiaset = "DELETE from KapitalisasiAset where Aset_ID=$aset_id";
            $resultdeletekapitalisasiaset= mysql_query($querydeletekapitalisasiaset) or die ('eror16');
            $querydeletepemusnahan = "DELETE from Pemusnahan where Aset_ID=$aset_id";
            $resultdeletepemusnahan= mysql_query($querydeletepemusnahan) or die ('eror17');
            }
            
            if ($BASP_ID !='')
            {
          
            $querydeletebasp = "DELETE from BASP where BASP_ID=$BASP_ID";
            $resultdeletebasp = mysql_query($querydeletebasp) or die ('eror13');
            
            }
            if ($BAST_ID !='')
            {
            $querydeletebast = "DELETE from BAST where BAST_ID=$BAST_ID";
            $resultdeletebast = mysql_query($querydeletebast) or die ('eror14');
            }if($Penerimaan_ID !='')
            {
        
                $querydeletepenerimaan = "DELETE from Penerimaan where Penerimaan_ID=$Penerimaan_ID";
                $resultdeletepenerimaan = mysql_query($querydeletepenerimaan) or die ('error1'); 
            }
            if($Kontrak_ID !='')
            {
            
            $querydeletekontrak = "DELETE from Kontrak where Kontrak_ID=$Kontrak_ID";
            $resultdeletekontrak= mysql_query($querydeletekontrak) or die ('eror15');
            }
            if($SP2D_ID !='')
            {
            $querydeletesp2d = "DELETE from SP2D where SP2D_ID=$SP2D_ID";
            $resultdeletesp2d= mysql_query($querydeletesp2d) or die ('eror18');
            }
            if($Kontraktor_ID !='')
            {
            
            $querydeletekontraktor = "DELETE from Kontraktor where Kontraktor_ID=$Kontraktor_ID"; 
            $resultkontraktor= mysql_query($querydeletekontraktor ) or die ('eror19');
            
            }
            
            $status = 1;
            echo "<script>alert('Data Sudah di hapus !!!'); document.location='koreksi_data_aset.php';</script>";
        }
     
