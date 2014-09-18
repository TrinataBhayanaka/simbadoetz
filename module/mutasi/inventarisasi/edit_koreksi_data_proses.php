<?php
include "../../config/config.php";
include "../../function/upload/proses_upload_photo.php";


echo '<pre>';
print_r($_POST);



// post no register
    
if (isset($_POST['simpan']))
{
    // input type hiden
    $Aset_ID=$_POST['Aset_ID'];
    $BASP_ID=$_POST['BASP_ID'];
    $Satker_ID = $_POST['Satker_ID'];
    $SP2D_ID = $_POST['SP2D_ID'];
    $kontraktor_ID = $_POST['kontraktor_ID'];
    $Kontrak_ID = $_POST['Kontrak_ID'];
    $KDP_ID = $_POST['KDP_ID'];
    $BAST_ID = $_POST['BAST_ID'];
    $Penerimaan_ID = $_POST['Penerimaan_ID'];
    $Tanah_ID = $_POST['Tanah_ID'];
    // end type hidden
    
    $p_noreg_pemilik =$_POST['p_noreg_pemilik'];
    $p_noreg_prov=$_POST['p_noreg_prov'];
    $p_noreg_kab=$_POST['p_noreg_kab'];
    $p_noreg_satker=$_POST['p_noreg_satker'];
    //$p_noreg_tahun=$_POST['p_noreg_tahun'];
    $p_noreg_unit=$_POST['p_noreg_unit'];
    
    $tahun=$dataArr['p_perolehan_thnperolehan'];
    $tahun3=  substr($tahun,2,2); 
    $noregnoreg = $p_noreg_pemilik. '.11.02'.$p_noreg_satker.'.'.$tahun3.'00';

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
    $satker_id =$_POST['skpd_id'];

    $lokasi_id =$_POST['lokasi_id'];
    
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
    
    
    $kelompok_id3 = $_POST['kelompok_id3'];
    
    if (($kelompok_id3 !='') AND ($p_kodeaset !='') AND ($lokasi_id !='') AND ($satker_id !=''))
    {
        
        (($p_noreg_noreg2 == '') or ($p_noreg_noreg2 == 0)) ? $p_noreg_noreg2 = 1 : $p_noreg_noreg2 = $p_noreg_noreg2 ;
        for ($loop = 0; $loop < $p_noreg_noreg2 ; $loop++)
        {
            
        //$p_noreg_noreg2
        
            //$Aset_ID=  get_auto_increment("Aset");
            
            
           
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
            
            for ($i = 0; $i< $check; $i++)
            {
                $bujur[$i][] =  $p_koordinat_bujur_a[$i].'.'.$p_koordinat_bujur_b[$i].'.'.$p_koordinat_bujur_c[$i].'.'.$p_koordinat_bujur_d[$i].'.'.$p_koordinat_lintang_a[$i].'.'.$p_koordinat_lintang_b[$i].'.'.$p_koordinat_lintang_c[$i].'.'.$p_koordinat_lintang_d[$i];
                
            }
            
            //$lokasi_baru_id = get_auto_increment("lokasi_baru");
            var_dump($bujur);
            
            foreach ($bujur as $value)
            {
                foreach ($value as $kordinat)
                {
                    $querylokasibaru= "UPDATE lokasi_baru SET koordinat='$kordinat'
                    WHERE Aset_ID= $Aset_ID";
                    $resultlokasibaru = mysql_query($querylokasibaru) or die ('eror koordinat');
                    print_r($querylokasibaru);
                    //echo '<br>';

                    ($resultlokasibaru) ? $lokasi_baru_id = $lokasi_baru_id : $lokasi_baru_id = 'NULL';
                    
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

            
            $id_penerimaan=  get_auto_increment("Penerimaan");
            
             if ($Penerimaan_ID !=''){                                   //jika penerimaan id ada makaupdate
            
            $querypenerimaan= "UPDATE Penerimaan SET  TglPemeriksaan='$p_periksa_tglpemeriksaan',NoBAPemeriksaan='$p_periksa_no_ba',
                                KetuaPemeriksa='$p_periksa_ketua_pemeriksa',StatusPemeriksaan='$p_ststus_pemeriksaan',
                                NoBAPenerimaan='$p_periksa_no_ba_penerimaan',TglPenerimaan='$p_periksa_tglpenerimaan',
                                NamaPenyedia='$p_periksa_namapenyedia',NamaPenyimpan='$p_periksa_namapengurus',
                                NIPPenyimpan= '$p_periksa_nippengurus'
            
            WHERE Penerimaan_ID=$id_penerimaan";
            echo $querypenerimaan;
            $resultpenerimaan = mysql_query($querypenerimaan) or die ('eror Penerimaan');
            ($resultpenerimaan) ? $id_penerimaan = $id_penerimaan : $id_penerimaan = 'NULL';
             }else {
             $querypenerimaaninsert= "INSERT INTO Penerimaan (Penerimaan_ID,TglPemeriksaan,NoBAPemeriksaan,KetuaPemeriksa,StatusPemeriksaan,NoBAPenerimaan,TglPenerimaan,
                                    NamaPenyedia,NamaPenyimpan,NIPPenyimpan)VALUES(NULL,'$p_periksa_tglpemeriksaan','$p_periksa_no_ba','$p_periksa_ketua_pemeriksa',
                                    '$p_ststus_pemeriksaan','$p_periksa_no_ba_penerimaan','$p_periksa_tglpenerimaan','$p_periksa_namapenyedia','$p_periksa_namapengurus',
                                    '$p_periksa_nippengurus')";
            echo $querypenerimaaninsert;
            $resultpenerimaan = mysql_query($querypenerimaaninsert) or die ('eror 7');
            ($resultpenerimaan) ? $id_penerimaan = $id_penerimaan : $id_penerimaan = 'NULL';
             }
            
            exit;
            //upload foto
            $folder_upload=$path."/foto/$Aset_ID/";
            $radio_foto = $_POST['radio_foto'];
            $nama_foto=$_FILES['p_foto_aset']['name'];
            $tgl= date("Y-m-d");
            //print_r($nama_foto);
            
            //echo $nama_foto[0];
            //echo count($nama_foto);
           
            if ($nama_foto !='')
            {
                foreach ($nama_foto as $index => $foto)
                {
                    
                    if ($foto !='')
                    {
                        $query_upload_foto= "INSERT INTO Foto(Foto_ID,Aset_ID,UserNm,TglFoto)values(null,'$Aset_ID','$data','$tgl')";
                        //print_r($query_upload_foto);
                        $result_upload_foto = mysql_query($query_upload_foto) or die (mysql_error());
                        if ($result_upload_foto)
                        {
                            
                            $hasil_upload=upload_gambar('p_foto_aset',$folder_upload,1, $index);
                        }
                    }
                }
            }
            
            
             
            //akhir srcip uploadfoto
            
            //upload Nota aset
            $folder_uploads=$path."/fotonota/$Aset_ID";
            $radio_nota = $_POST['radio_nota'];
            $p_notaaset =$_FILES['p_notaaset']['name'];
            
            if ($p_notaaset !='')
            {
                foreach ($p_notaaset as $index => $foto)
                {
                    
                    if ($foto !='')
                    {
                        $query_upload_fotonota ="INSERT INTO FotoNota(Nota_ID,Aset_ID,UserNm,TglFotoNota)values(null,'$Aset_ID','$data','$tgl')";
                        //print_r($query_upload_foto);
                        $result_upload_fotonota=mysql_query($query_upload_fotonota) or die (mysql_error());
                        if ($result_upload_fotonota)
                        {
                            
                            $hasil_upload=upload_gambar('p_notaaset',$folder_uploads,1, $index);
                        }
                    }
                }
            }
            
            
            $p_kodeaset = substr($_POST['p_kodeaset'], 0,2);
            
        
            // cek data untuk ke proses selanjutnya
            
            
             
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
                            
                            
                            $tanah_id= get_auto_increment("Tanah");
                             if ($Tanah_ID !=''){           
                            
                            $querytanah = "UPDATE Tanah SET LuasTotal='$p_gtanah_luaskeseluruhan',LuasBangunan='$p_gtanah_luasbangunan',
                                                                                            LuasSekitar= '$p_gtanah_saranalingkungn',LuasKosong='$p_gtanah_tanahkosong',
                                                                                            HakTanah='$p_gtanah_hakpakai',NoSertifikat= '$p_gtanah_nosertifikat',
                                                                                            TglSertifikat='$p_gtanah_tglsertifikat',Penggunaan='$p_gtanah_penggunaan,
                                                                                            BatasUtara=  '$p_gtanah_batasutara',BatasSelatan='$p_gtanah_batasselatan',
                                                                                            BatasBarat='$p_gtanah_batasbarat',BatasTimur= '$p_gtanah_batastimur'
                            WHERE Aset_ID=$Aset_ID";
                            
                            $resulttanah= mysql_query($querytanah)or die ('eror tanah');
                            ($querytanah) ? $tanah_id = $tanah_id : $tanah_id = 'NULL';
                            $flag = 1;
                             }else{
                                  $querytanah = "INSERT INTO Tanah (Tanah_ID, LuasTotal,Aset_ID,LuasBangunan,LuasSekitar,LuasKosong,HakTanah,
                                            NoSertifikat,TglSertifikat,Penggunaan,BatasUtara,BatasSelatan,BatasBarat,
                                            BatasTimur) VALUES (NULL, '$p_gtanah_luaskeseluruhan','$Aset_ID','$p_gtanah_luasbangunan',
                                            '$p_gtanah_saranalingkungn','$p_gtanah_tanahkosong','$p_gtanah_hakpakai',
                                            '$p_gtanah_nosertifikat', '$p_gtanah_tglsertifikat','$p_gtanah_penggunaan',
                                            '$p_gtanah_batasutara','$p_gtanah_batasselatan','$p_gtanah_batasbarat',
                                            '$p_gtanah_batastimur')";
                            
                                    $resulttanah= mysql_query($querytanah)or die ('eror 6');
                                    ($querytanah) ? $tanah_id = $tanah_id : $tanah_id = 'NULL';
                                    $flag = 1;
                                    
                                    
                             }
                            
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
                            
                            
                            $mesin_id=  get_auto_increment("Mesin");
                            
                            if ($Mesin_ID !=''){      
                            $querymesin ="UPDATE  Mesin SET Merk= '$p_gmsn_peralatan',Model= '$p_gmsn_tipemodel',Ukuran='$p_gmsn_ukuran',
                                                                                            Silinder= '$p_gmsn_silinder',MerkMesin='$p_gmsn_merek',JumlahMesin='$p_gmsn_jumlahmesin',
                                                                                            Material='$p_gmsn_material',NoSeri='$p_gmsn_noseripabrik',NoRangka='$p_gmsn_rangka',
                                                                                            NoMesin='$p_gmsn_nomesin',NoSTNK='$p_gmsn_nopolisi',TglSTNK='$p_gmsn_tglstnk',
                                                                                            NoBPKB='$p_gmsn_nobpkb',TglBPKB='$p_gmsn_tglbpkb',NoDokumen='$p_gmsn_nodokumenlain',
                                                                                            TglDokumen='$p_gmsn_tgldokumenlain',TahunBuat='$p_gmsn_tahunpembutan',
                                                                                            BahanBakar='$p_gmsn_bahanbakar',Pabrik='$p_gmsn_pabrik',
                                                                                            NegaraAsal='$p_gmsn_negaraasal',kapasitas='$p_gmsn_kapasitas',
                                                                                            Bobot='$p_gmsn_bobot',NegaraRakit='$p_gmsn_negaraperakitan'
                            WHERE Aset_ID=$Aset_ID";
                         
                            $resultmesin=  mysql_query($querymesin)or die('eror 21');
                            ($resultmesin) ? $mesin_id = $mesin_id : $mesin_id = 'NULL';
                            $flag = 2;
                            }else{
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
        
                                $resultmesin=  mysql_query($querymesin)or die('eror 21');
                                ($resultmesin) ? $mesin_id = $mesin_id : $mesin_id = 'NULL';
                                $flag = 2;
                            }
                        }
                        break;
                    case '03':
                        {
                            //golongan jalan
                            $p_gjal_konstruksi=$_POST['p_gjal_konstruksi'];
                            $p_gjal_panjang=$_POST['p_gjal_panjang'];
                            $p_gjal_lebar=$_POST['p_gjal_lebar'];
                            $p_gjal_luas=$_POST['p_gjal_luas'];
                            $p_gjal_nodokumen=$_POST['p_gjal_nodokumen'];
                            $p_gjal_tgldookumen=$_POST['p_gjal_tgldookumen'];
                            $p_gjal_tglpemakaian=$_POST['p_gjal_tglpemakaian'];
                            $p_statustanah=$_POST['p_statustanah'];
                            $p_gjal_pilihaset_tanah=$_POST['p_gjal_pilihaset_tanah'];
                            $p_gjal_nomorkode_tanah=$_POST['p_gjal_nomorkode_tanah'];
                            
                            $jaringan_id=  get_auto_increment("Jaringan");
                            
                            if ($Jaringan_ID !=''){    
                            $queryjaringan = "UPDATE Jaringan SET Konstruksi='$p_gjal_konstruksi',Panjang='$p_gjal_panjang',Lebar='$p_gjal_lebar',
                                                                                                NoDokumen='$p_gjal_nodokumen',TglDokumen='$p_gjal_tgldookumen',
                                                                                                TanggalPemakaian='$p_gjal_tglpemakaian',StatusTanah='$p_statustanah',
                                                                                                KelompokTanah_ID='$p_gjal_pilihaset_tanah'
                            WHERE Aset_ID=$Aset_ID";

                            $resultjaringan = mysql_query($queryjaringan) or die ('eror Jaringan');
                            ($resultjaringan) ? $jaringan_id = $jaringan_id : $jaringan_id = 'NULL';
                            $flag = 3;
                        }else{
                             $queryjaringan = "INSERT INTO Jaringan(Jaringan_ID, Konstruksi,Aset_ID,Panjang,Lebar,
                                                NoDokumen,TglDokumen,TanggalPemakaian,StatusTanah,KelompokTanah_ID)
                                                VALUES(NULL, '$p_gjal_konstruksi','$Aset_ID',
                                                '$p_gjal_panjang','$p_gjal_lebar','$p_gjal_nodokumen',
                                                '$p_gjal_tgldookumen','$p_gjal_tglpemakaian','$p_statustanah','$p_gjal_pilihaset_tanah')";
                                $resultjaringan = mysql_query($queryjaringan) or die ('eror 8');
                                ($resultjaringan) ? $jaringan_id = $jaringan_id : $jaringan_id = 'NULL';
                                $flag = 3;
                        }
                            
                            
                        }
                        break;
                    case '04':
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
                            $p_gdg_tgldokum=explode("/",$_POST['p_gdg_tgldokumen']);
                            $datebsb = explode('/',$p_gdg_tgldokum); ///
                            $p_gdg_tgldokumen = $datebsb[2].$datebsb[1].$datebsb[0];   
                            $p_gdg_tglpemakaia = $_POST['p_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
                            $datei = explode('/',$p_gdg_tglpemakaia); ///
                            $p_gdg_tglpemakaian = $datei[2].$datei[1].$datei[0];   
                            $p_gdg_ststustanah=$_POST['p_gdg_ststustanah'];
                            $p_gdg_asettanah=$_POST['p_gdg_asettanah'];
                            $p_gdg_kodetanah=$_POST['p_gdg_kodetanah'];
                            $p_gdg_no_imb=$_POST['p_gdg_no_imb'];
                            $p_gdg_tglim = $_POST['p_gdg_tglpemakaian']; ///bulan/tanggal/tahun 
                            $datej = explode('/', $p_gdg_tglim); ///
                            $p_gdg_tglimb = $datej[2].$datej[1].$datej[0];
                            
                            
                             if ($Bangunan_ID !=''){    
                            $query ="UPDATE Bangunan SET  Konstruksi='$p_gdg_konstruksi',Beton='$p_gdg_konstruksib', JumlahLantai='$p_gdg_jumlah_lantai',
                                                                                        LuasLantai='$p_gdg_luaslantai',Dinding='$p_gdg_dinding',Lantai='$p_gdg_lantai',
                                                                                        LangitLangit='$p_gdg_plafon',Atap='$p_gdg_atap',NoSurat='$p_gdg_nodokumen',TglSurat='$p_gdg_tgldokumen',
                                                                                        TglPakai='$p_gdg_tglpemakaian',StatusTanah='$p_gdg_ststustanah',KelompokTanah_ID='$p_gdg_kodetanah',
                                                                                        NoIMB='$p_gdg_no_imb',TglIMB='$p_gdg_tglimb'
                            WHERE Aset_ID=$Aset_ID";
                            //$resultbangunan=  mysql_query($querybangunan)or die ('eror 23');
                            $flag = 4;
                             }else{
                                 $query ="insert into Bangunan(Bangunan_ID, Konstruksi,Aset_ID,Beton,JumlahLantai,LuasLantai,
                                            Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,TglPakai,StatusTanah,KelompokTanah_ID,
                                            NoIMB,TglIMB) VALUES (NULL, '$p_gdg_konstruksi','$Aset_ID','$p_gdg_konstruksib',
                                            '$p_gdg_jumlah_lantai','$p_gdg_luaslantai','$p_gdg_dinding','$p_gdg_lantai','$p_gdg_plafon',
                                            '$p_gdg_atap','$p_gdg_nodokumen','$p_gdg_tgldokumen','$p_gdg_tglpemakaian','$p_gdg_ststustanah',
                                            '$p_gdg_kodetanah','$p_gdg_no_imb','$p_gdg_tglimb')";
        
                                $resultbangunan=  mysql_query($querybangunan)or die ('eror 23');
                                $flag = 4;
                             }
        
                        }
                        break;
                    case '05':
                        {
                            // jika golongan 5 lakukan pengecekan data input sesuai golongan
                            // cek nilai data input
                            $jenis_aset_lain = $_POST['jenis_aset_lain'];
                            
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
                                        $p_gol5_kuantitas1=$_POST['p_gol5_kuantitas3'];
                                        $p_gol5_satuan1=$_POST['p_gol5_satuan3'];
                                        
                                        $queryasetlain = "UPDATE AsetLain SET  Judul= '$p_gol5_judul',Pengarang= '$p_gol5_penerbit',Penerbit= '$p_gol5_spesifikasi',
                                                                                                            Spesifikasi= '$p_gol5_spesifikasi',TahunTerbit= '$p_gol5_asetlain_tahunterbit',
                                                                                                            ISBN='$p_gol5_isbn'
                                        WHERE Aset_ID=$Aset_ID";
                                          
                                        $queryasetlain="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas1', Satuan = '$p_gol5_satuan1' WHERE Aset_ID = $Aset_ID)";
                                        //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                        
                                    }
                                    break;
                                case '3':
                                    {
                                        //golongan barang kesenian
                                        $p_gol5_judul1=$_POST['p_gol5_judul1'];
                                        $p_gol5_asal=$_POST['p_gol5_asal'];
                                        $p_gol5_pencipta=$_POST['p_gol5_pencipta'];
                                        $p_gol5_bahan=$_POST['p_gol5_bahan'];
                                        $p_gol5_kuantitas2=$_POST['p_gol5_kuantitas1'];
                                        $p_gol5_satuan2=$_POST['p_gol5_satuan1'];
                                        
                                        $queryasetlain = "UPDATE  AsetLain SET  Judul='$p_gol5_judul1',AsalDaerah= '$p_gol5_asal',
                                                                                                              Pengarang='$p_gol5_pencipta',Material='$p_gol5_bahan'
                                        WHERE Aset_ID=$Aset_ID";
                                     
                                        $queryasetlain="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas2',Satuan = '$p_gol5_satuan2' WHERE Aset_ID = $Aset_ID";
                                        //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                    }
                                    break;
                                case '2':
                                    {
                                        //golongan hewan
                                        $p_gol5_jenis=$_POST['p_gol5_jenis'];
                                        $p_gol5_ukuran=$_POST['p_gol5_ukuran'];
                                        $p_gol5_kuantitas3=$_POST['p_gol5_kuantitas2'];
                                        $p_gol5_satuan3=$_POST['p_gol5_satuan2'];
                                        
                                        $queryasetlain="UPDATE AsetLain SET  Judul='$p_gol5_jenis',Ukuran='$p_gol5_ukuran'
                                        WHERE Aset_ID=$Aset_ID";       
                                        
                                        $queryasetlain="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas3', Satuan = '$p_gol5_satuan3' WHERE Aset_ID = $Aset_ID";
                                        //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                    }
                                    break;
                                
                                $aset_lain_id=  get_auto_increment("Aset_Lain");
                                $resultasetlain=  mysql_query($queryasetlain)or die ('eror 5');
                                ($resultasetlain) ? $aset_lain_id = $aset_lain_id : $aset_lain_id = 'NULL';
                                
                            }
                            $flag = 5;
                        }
                        break;
                    case '06':
                        {
                            //golongan konstruksi
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
                            
                            $kdp_id=  get_auto_increment("KDP");
                            
                            $querykdp = "UPDATE KDP SET  Konstruksi='$p_gjal_konstruksi',Beton='$p_gjal_konstruksi1',JumlahLantai='$p_gjal_panjang',
                                                                                    LuasLantai='$p_gol6_luas_lantai',TglMulai='$tanggal_pembangunan',StatusTanah='$p_gol6_statustanah',
                                                                                    TglPembangunan='$tanggal_pembangunan',KelompokTanah_ID='$p_gol6_pilih_asettanah'
                            WHERE Aset_ID=$Aset_ID";
        
                            $resultkdp = mysql_query($querykdp) or die ('eror KDP');
                            ($resultkdp) ? $kdp_id = $kdp_id : $kdp_id = 'NULL';
                            $flag = 6;
        
                        }
                        break;
                    case '07':
                        {
                            $p_gol7_kuantitas4=$_POST['p_gol7_kuantitas4'];
                            $p_gol7_satuan4=$_POST['p_gol7_satuan4'];
                            
                            
                            $query ="UPDATE Aset SET Kuantitas = '$p_gol7_kuantitas4',Satuan = '$p_gol7_satuan4' 
                            WHERE Aset_ID = $Aset_ID";
                            //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                            $flag = 7;
                        }
                        break;
                    
                }
                // query ke tabel kelompok dulu untuk mendapatkan golongan sebelum melakukan insert data
                
               
            // buat kondisi untuk mengecek variabel flag, untuk menentukan nilai getautoincrement sebelum diasukan ke tabel aset
            
            // p_perolehan_caraperolehan
            
            $p_perolehan_caraperolehan = $_POST['p_perolehan_caraperolehan'];
        
            if ($p_perolehan_caraperolehan !=0)
            {
                switch ($p_perolehan_caraperolehan)
                {
                    case '1':
                        {
                             //kontrak
                            $p_pengadaan_nokontrak=$_POST['p_pengadaan_nokontrak'];
                            $p_pengadaan_nilaikontrak=$_POST['p_pengadaan_nilaikontrak'];
                            $p_pengadaan_tglkontrak=$_POST['p_pengadaan_tglkontrak'];
                            $p_pengadaan_pekerjaan=$_POST['p_pengadaan_pekerjaan'];
                            $p_pengadaan_kontraktor=$_POST['p_pengadaan_kontraktor'];
                            
                            $p_pengadaan_nosp2d=$_POST['p_pengadaan_nosp2d'];
                            $p_pengadaan_tglsp2d=$_POST['p_pengadaan_tglsp2d'];
                            $p_pengadaan_tglsp2d=$_POST['p_pengadaan_tglsp2d'];
                            $p_pengadaan_mataanggaran=$_POST['p_pengadaan_mataanggaran'];
                            
                            $kontraktor_id=  get_auto_increment("Kontraktor");
                            
                            $querykontraktor="UPDATE  Kontraktor SET NamaKontraktor ='$p_pengadaan_kontraktor'
                            WHERE Kontraktor_ID=$kontraktor_id";
                            $resultkontraktor=  mysql_query($querykontraktor)or die ('eror kontraktor');
                            ($resultkontraktor) ? $kontraktor_id = $kontraktor_id : $kontraktor_id = 'NULL';
                            
                            $kontrak_id=  get_auto_increment("Kontrak");
                            
                            $querykontrak="UPDATE Kontrak SET NoKontrak= '$p_pengadaan_nokontrak',NilaiKontrak='$p_pengadaan_nilaikontrak',
                                                                                                TglKontrak= '$p_pengadaan_tglkontrak',Pekerjaan='$p_pengadaan_pekerjaan'
                            WHERE Kontrak_ID=$kontrak_id";
                        
                            $resultkontrak=  mysql_query($querykontrak)or die ('eror kontrak');
                            ($resultkontrak) ? $kontrak_id = $kontrak_id : $kontrak_id = 'NULL';
                            
                            //$kontrakaset=get_auto_increment("KontrakAset");
                            
                            //$querykontrakaset="insert into KontrakAset (Kontrak_ID, Aset_ID,Kontrak_ID) values (NULL, '$Aset_ID','$kontrak_id')";
                            //$resultkontrakaset=  mysql_query($querykontrakaset)or die('eror 3');
                            //($resultkontrakaset) ? $kontrakaset = $kontrakaset : $kontrakaset = 'NULL';
                            
                            $sp2d_id=get_auto_increment("SP2D");
                            
                            $querysp2d= "UPDATE SP2D SET  NoSP2D= '$p_pengadaan_nosp2d',TglSP2D='$p_pengadaan_tglsp2d',
                                                                                        MAK= '$p_pengadaan_mataanggaran',NilaiSP2D='$p_pengadaan_nilaisp2d'
                            WHERE SP2D_ID= $sp2d_id";
                      
                            $resultsp2d = mysql_query($querysp2d) or die ('eror SP2D');
                            ($resultsp2d) ? $sp2d_id = $sp2d_id : $sp2d_id = 'NULL';
                            
                            $id_kapitalisasi_aset=  get_auto_increment("KapitalisasiAset");
                            
                           // $querykapitalisasiaset= "INSERT INTO KapitalisasiAset (Aset_ID,SP2D_ID) VALUES('$Aset_ID','$sp2d_id')";
                           // $resultkapitalisasiaset = mysql_query($querykapitalisasiaset) or die ('eror 16');
                            //($resultkapitalisasiaset) ? $id_kapitalisasi_aset = $id_kapitalisasi_aset : $id_kapitalisasi_aset = 'NULL';
                            
                            
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
                            $p_hibah_tglbas= $daten[2].$daten[1].$daten[0]; 
                            $p_hibah_namapertama=$_POST['p_hibah_namapertama'];
                            $p_hibah_jabatan_pertama=$_POST['p_hibah_jabatan_pertama'];
                            $p_hibah_nippertama=$_POST['p_hibah_nippertama'];
                            $p_hibah_namakedua=$_POST['p_hibah_namakedua'];
                            $p_hibah_jabatan_kedua=$_POST['p_hibah_jabatan_kedua'];
                            $p_hibah_nipkedua=$_POST['p_hibah_nipkedua'];
                            
                            $bast_id=  get_auto_increment("BAST");
                            
                            $querybast="UPDATE BAST SET  UserNm='$p_hibah_pemberi',NoBAST='$p_hibah_nobbast',
                                                                                        TglBAST='$p_hibah_tglbast',NamaPihak1='$p_hibah_namapertama',JabatanPihak1='$p_hibah_jabatan_pertama',
                                                                                        NIPPihak1='$p_hibah_nippertama',NamaPihak2='$p_hibah_namakedua',
                                                                                        JabatanPihak2='$p_hibah_jabatan_kedua',NIPPihak2= '$p_hibah_nipkedua'
                            WHERE BAST_ID=$bast_id";
                
                            $resultbast=  mysql_query($querybast)or die ('eror BAST');
                            ($resultbast) ? $bast_id = $bast_id : $bast_id = 'NULL';
                        }
                        break;
                    case '3':
                        {
                            //keputusanPengadilan//
                            $p_pengadilan_no_pengadilan=$_POST['p_pengadilan_no_pengadilan'];
                            $p_pengadilan_jenisaset=$_POST['p_pengadilan_jenisaset'];
                            $p_pengadilan_asalaset=$_POST['p_pengadilan_asalaset'];
                            $p_pengadilan_keterangan=$_POST['p_pengadilan_keterangan'];
                           
                            $keputusanundangundang_id= get_auto_increment("KeputusanUndangUndang");
                            
                            $queryundangundang= "UPDATE KeputusanUndangUndang SET NoKeputusan='$p_uud_no_uud',JenisAset='$p_uud_jenisaset',
                                                                                                                                        AsalAset='$p_uud_asalaset',Keterangan='$p_uud_keterangan'
                            WHERE Aset_ID=$Aset_ID";
                            $resultpengadilan = mysql_query($querypengadilan) or die ('eror 13');
                            ($resultpengadilan) ? $keputusanundangundang_id = $keputusanundangundang_id : $keputusanundangundang_id = 'NULL';
                            
                        }
                        break;
                    case '4':
                        {
                            //keputusan UUD//
                            $p_uud_no_uud=$_POST['p_uud_no_uud'];
                            $p_uud_jenisaset=$_POST['p_uud_jenisaset'];
                            $p_uud_asalaset=$_POST['p_uud_asalaset'];
                            $p_uud_keterangan=$_POST['p_uud_keterangan'];
                            
                            $keputusanpengadilan_id= get_auto_increment("KeputusanPengadilan");
                            
                            $querypengadilan= "UPDATE  KeputusanPengadilan SET NoKeputusan='$p_pengadilan_no_pengadilan',JenisAset='$p_pengadilan_jenisaset',
                                                                                                                    AsalAset='$p_pengadilan_asalaset', Keterangan= '$p_pengadilan_keterangan'
                            WHERE Aset_ID=$Aset_ID";
                            
                            $resultundangundang= mysql_query($queryundangundang) or die ('eror 14');
                            ($resultundangundang) ? $keputusanpengadilan_id = $keputusanpengadilan_id : $keputusanpengadilan_id = 'NULL';
                        
                        }
                        break;
                    
                }
                // insert data sesuai pilihan
                
                
            }
            //end p_perolehan_caraperolehan
            
            // p_penghapusan_aset
            
            $p_penghapusan_aset = $_POST['p_penghapusan_aset'];
        
            if ($p_penghapusan_aset !=0)
            {
                switch ($p_penghapusan_aset)
                {
                    case '1':
                        {
                            //pemindahtanganan
                            
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
                            
                            $basp_id=  get_auto_increment("BASP");
                            
                             if ($BASP_ID !=''){     
                            $querybasp="UPDATE BASP SET NoBASP='$p_p_tangan_nobasp',TglBASP='$p_p_tangan_tglbasp',NamaPihak1='$p_p_tangan_namapertama',
                                        JabatanPihak1='$p_p_tangan_jbtnpertama', NIPPihak1= '$p_p_tangan_nippertama',LokasiPihak1='$p_p_tangan;_lokasipertama',
                                        NamaPihak2='$p_p_tangan_namakedua',JabatanPihak2='$p_p_tangan_jbtnkedua',NIPPihak2='$p_p_tangan_nipkedua',
                                        LokasiPihak2='$p_p_tangan_lokasikedua',NoSKPenetapan='$p_p_tangan_noskpenetapan',TglSKPenetapan='$p_p_tangan_tglskpenetapan',
                                        NoSKPenghapusan='$p_p_tangan_noskhapus',TglSKPenghapusan='$p_p_tangan_tglskhapus',KeteranganTambahan='$p_keterangantambahan'
                                        WHERE BASP_ID=BASP_ID";
                            //echo $querybasp;
                            $resultbasp=  mysql_query($querybasp)or die ('eror 22');
                            ($resultbasp) ? $basp_id = $basp_id : $basp_id = 'NULL';
                             }else{
                                   $basp_id=  get_auto_increment("BASP");
                            
                                    $querybasp="insert into BASP(BASP_ID, NoBASP,TglBASP,NamaPihak1,JabatanPihak1,NIPPihak1,LokasiPihak1,NamaPihak2,JabatanPihak2,NIPPihak2,
                                            LokasiPihak2,NoSKPenetapan,TglSKPenetapan,NoSKPenghapusan,TglSKPenghapusan,KeteranganTambahan)
                                            values(NULL, '$p_p_tangan_nobasp','$p_p_tangan_tglbasp','$p_p_tangan_namapertama','$p_p_tangan_jbtnpertama',
                                            '$p_p_tangan_nippertama','$p_p_tangan_lokasipertama','$p_p_tangan_namakedua','$p_p_tangan_jbtnkedua',
                                            '$p_p_tangan_nipkedua','$p_p_tangan_lokasikedua','$p_p_tangan_noskpenetapan','$p_p_tangan_tglskpenetapan',
                                            '$p_p_tangan_noskhapus','$p_p_tangan_tglskhapus','$p_keterangantambahan')";
            
                                    //echo $querybasp;
                                    $resultbasp=  mysql_query($querybasp)or die ('eror 22');
                                    ($resultbasp) ? $basp_id = $basp_id : $basp_id = 'NULL';
                                    $queryupdatebasp="UPDATE Aset SET BASP_ID = '$basp_id'
                                    WHERE Aset_ID = $Aset_ID";
                                     $resultaset=  mysql_query($queryupdatebasp)or die ('eror insertbasp');
                             }
                            
                        }
                        break;
                    case '2':
                        {
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
                            
                            $pemusnahan_id=  get_auto_increment("Pemusnahan");
                            
                            if ($Pemusnahan_ID !=''){    
                            $querypemusnahan= "UPDATE Pemusnahan SET KetPemusnahan='$p_pmusnah_keterangan',Aset_ID,NoSKPenetapan='$p_pmusnah_noskpenetapan',
                                                                                                                TglSKPenetapan='$p_pmusnah_tglskpenetapan',NoSKPenghapusan= '$p_pmusnah_noskhapus',
                                                                                                                TglSKPenghapusan='$p_pmusnah_tglskhapus'
                            WHERE Aset_ID=$Aset_ID";
                            
                                      
                            $resultpemusnahan = mysql_query($querypemusnahan) or die ('eror 12');
                            ($resultpemusnahan) ? $pemusnahan_id = $pemusnahan_id : $pemusnahan_id = 'NULL';
                            }else{
                                  $querypemusnahan= "INSERT INTO Pemusnahan(Pemusnahan_ID, KetPemusnahan,Aset_ID,NoSKPenetapan,TglSKPenetapan,NoSKPenghapusan,TglSKPenghapusan)
                                                    VALUES(NULL, '$p_pmusnah_keterangan','$Aset_ID','$p_pmusnah_noskpenetapan','$p_pmusnah_tglskpenetapan',
                                                    '$p_pmusnah_noskhapus','$p_pmusnah_tglskhapus')";
                                    $resultpemusnahan = mysql_query($querypemusnahan) or die ('eror 12');
                                    ($resultpemusnahan) ? $pemusnahan_id = $pemusnahan_id : $pemusnahan_id = 'NULL';
                          
                                    
                            }
                        }
                        break;
                    
                }
                // insert data sesuai pilihan
            }
            // end p_penghapusan_aset
             $Aset_ID=$_POST['Aset_ID'];
            
            $queryaset="UPDATE Aset SET CaraPerolehan='$p_perolehan_caraperolehan',PenghapusanAset='$p_penghapusan_aset',NomorReg='$noregnoreg',
                                                                    Pemilik='$p_noreg_pemilik',NamaAset='$p_nama_aset',Ruangan='$p_ruangan',Alamat='$p_alamat',RTRW='$p_rt',
                                                                    AsalUsul='$p_perolehan_ket_asalusul',TglPerolehan='$p_perolehan_tglperolehan',Tahun='$p_perolehan_thnperolehan',
                                                                    NilaiPerolehan='$p_perolehan_nilai',TipeAset='$p_jenisaset',Bersejarah='$p_bersejarah',Peruntukan='$p_p_tangan_peruntukan',
                                                                    SumberDana='$p_pengadaan_sumberdana'
            WHERE Aset_id=$Aset_ID";
            $resultaset=  mysql_query($queryaset)or die ('eror aset');
            
            if ($flag == 7)
            {
                $resultGolongan7 = mysql_query($query) or die (mysql_error());    
            }
            else if ($flag == 5)
            {
                $resultGolongan5 = mysql_query($queryasetlain) or die (mysql_error());
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
        }
        //return true;
        
        echo 'Sudah masuk';
    }
    else
    {
       echo '<script type=text/javascript>alert("Silahkan masukan data Kelompok, Aset, Golongan, lokasi dan "); history.back(); </script>';
    }


}


