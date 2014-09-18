<?php
include "../../config/config.php";
include "../../function/upload/proses_upload_photo.php";


//echo '<pre>';
//echo 'ada';
//print_r($_POST);
//echo '</pre>';
//exit;
$UserSes = $SESSION->get_session_user();
/*echo"<pre>";
print_r($UserSes);
echo"</pre>";*/
//exit();
// post no register
    
if (isset($_POST['simpan_aset']))
{
    /*echo"<pre>";
    print_r($_POST);
    echo"</pre>";*/
    //echo"ada";
    $user=$_SESSION['ses_uoperatorid'];
    //echo"end";
    $p_noreg_pemilik =$_POST['p_noreg_pemilik'];
    $p_noreg_prov=$_POST['p_noreg_prov'];
    $p_noreg_kab=$_POST['p_noreg_kab'];
    $p_noreg_satker=$_POST['p_noreg_satker'];
    //$p_noreg_tahun=$_POST['p_noreg_tahun'];
    $p_noreg_unit=$_POST['p_noreg_unit'];
   
     $tahun=$_POST['p_perolehan_thnperolehan'];
    $tahun3= substr($tahun,2,2); 
    

     //default $noregnoreg = $p_noreg_pemilik.'.11.02.'.$p_noreg_satker.'.'.$tahun3.'.00';
	 
	 //edit andreas
	// $noregnoreg = $p_noreg_pemilik.'.11.02.'.$p_noreg_satker.'.'.$tahun3;

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
    
      
    if (($p_noreg_noreg2 !='') OR ($p_noreg_noreg2 !=''))
    {
		$p_perolehan_nilai2=$_POST['p_perolehan_nilai'];
		$p_perolehan_nilai = $p_perolehan_nilai2/$p_noreg_noreg2;
	}else{
		$p_perolehan_nilai=$_POST['p_perolehan_nilai'];
		}
    
    $kelompok_id3 = $_POST['kelompok_id3'];
    if (($kelompok_id3 !='') OR ($p_kodeaset !='') OR ($lokasi_id !='') OR ($satker_id !=''))
    {
        
        (($p_noreg_noreg2 == '') or ($p_noreg_noreg2 == 0)) ? $p_noreg_noreg2 = 1 : $p_noreg_noreg2 = $p_noreg_noreg2;
        
        for ($loop = 0; $loop < $p_noreg_noreg2 ; $loop++)
        {
			$reg_manual_simbada=$loop+1;
            $noregnoreg = $p_noreg_pemilik.'.11.02.'.$p_noreg_satker.'.'.$tahun3.'.'.sprintf("%04s", $reg_manual_simbada);;
        //$p_noreg_noreg2
        
            $aset_id=  get_auto_increment("Aset");
            
            
            
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
            
            $bujur = '';
            
            for ($i = 0; $i < $check; $i++)
            {
                $bujur[$i][] =  $p_koordinat_bujur_a[$i].'.'.$p_koordinat_bujur_b[$i].'.'.$p_koordinat_bujur_c[$i].'.'.$p_koordinat_bujur_d[$i].'.'.$p_koordinat_lintang_a[$i].'.'.$p_koordinat_lintang_b[$i].'.'.$p_koordinat_lintang_c[$i].'.'.$p_koordinat_lintang_d[$i];
                
            }
            
            $lokasi_baru_id = get_auto_increment("lokasi_baru");
            //print_r($bujur);
            
            if ($bujur !='')
            {
            foreach ($bujur as $value)
            {
                foreach ($value as $kordinat)
                {
                    $querylokasibaru= "INSERT INTO lokasi_baru (lokasi_baru_ID, Aset_ID,koordinat) VALUES (NULL, '$aset_id','$kordinat')";
                   // print_r($querylokasibaru);
                    //echo '<br>';
                    $resultlokasibaru = mysql_query($querylokasibaru) or die ('eror 19');
                    ($resultlokasibaru) ? $lokasi_baru_id = $lokasi_baru_id : $lokasi_baru_id = 'NULL';
                    
                }
                
            }
            }
         
          
            //pemeriksaan penerimaan
            $p_periksa_no_ba=$_POST['p_periksa_no_ba'];
             $p_keterangantambahan=$_POST['p_keterangantambahan'];
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
            
            $querypenerimaan= "INSERT INTO Penerimaan (Penerimaan_ID,TglPemeriksaan,NoBAPemeriksaan,KetuaPemeriksa,StatusPemeriksaan,NoBAPenerimaan,TglPenerimaan,
                                    NamaPenyedia,NamaPenyimpan,NIPPenyimpan)VALUES(NULL,'$p_periksa_tglpemeriksaan','$p_periksa_no_ba','$p_periksa_ketua_pemeriksa',
                                    '$p_ststus_pemeriksaan','$p_periksa_no_ba_penerimaan','$p_periksa_tglpenerimaan','$p_periksa_namapenyedia','$p_periksa_namapengurus',
                                    '$p_periksa_nippengurus')";
            $resultpenerimaan = mysql_query($querypenerimaan) or die ('eror 7');
            ($resultpenerimaan) ? $id_penerimaan = $id_penerimaan : $id_penerimaan = 'NULL';
            
            
           
            //upload foto
            $folder_upload=$path."/foto/$aset_id/";
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
                            $foto_path = "/foto/$aset_id/$foto";
                            $query_upload_foto= "INSERT INTO Foto(Foto_ID,Aset_ID,UserNm,DataFoto,TglFoto,Foto_Status)values(null,'$aset_id','$UserSes[ses_uname]','$foto_path','$tgl', '$status')";
                            //print_r($query_upload_foto);
                            $result_upload_foto = mysql_query($query_upload_foto) or die (mysql_error());    
                        }
                        
                    }
                }
            }
            
            //exit;
             
            //akhir srcip uploadfoto
            
            //upload Nota aset
            $folder_uploads=$path."/fotonota/$aset_id";
            $radio_nota = $_POST['radio_nota'];
            $no_nota=$_POST['p_no_nota_aset'];
            $p_notaaset =$_FILES['p_notaaset']['name'];
            
            if ($p_notaaset !='')
            {
                  $index_nota=0;
                 foreach ($p_notaaset as $index => $foto)
                {
                   //   echo "Masukk ovannn===$foto";
                    if ($foto !='')
                    {
                        ($index == $radio_nota) ? $status = 1 : $status = 0;
                        $hasil_upload=upload_gambar('p_notaaset',$folder_uploads,1, $index);
                        if ($hasil_upload)
                        {
                            $foto_nota_path = "/fotonota/$aset_id/$foto";
                            $query_upload_fotonota ="INSERT INTO FotoNota(Nota_ID,Aset_ID,UserNm,TglFotoNota, Foto_Path,Foto_Status,No_Nota)values(null,'$aset_id','$UserSes[ses_uname]','$tgl','$foto_nota_path','$status','$no_nota[$index_nota]')";
                            //print_r($query_upload_fotonota);
                            /*echo "masuk;
                            echo "<pre>";
                              //print_r($query_upload_fotonota);
                            echo "</pre>";
                            */
                            $result_upload_fotonota = mysql_query($query_upload_fotonota) or die (mysql_error());    
                            
                        }
                        
                        $index_nota++;
                    }
                }
            }
            //$p_keterangantambahan=$_POST['p_keterangantambahan'];
           // $GET_BASP_ID = get_auto_increment('BASP');
           // $queryBASP = "INSERT INTO BASP (BASP_ID, KeteranganTambahan) VALUES ($GET_BASP_ID, '$p_keterangantambahan')";
            //print_r($queryBASP);
          //  $resultBASP = mysql_query($queryBASP) or die ('error BASP');
         //  ($resultBASP) ? $basp_id = $GET_BASP_ID : $basp_id = 'NULL';
            
            $p_kodeaset = substr($_POST['p_kodeaset'], 0,2);
            
        //echo 'masuk'.$p_kodeaset;
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
                            
                            $querytanah = "INSERT INTO Tanah (Tanah_ID, LuasTotal,Aset_ID,LuasBangunan,LuasSekitar,LuasKosong,HakTanah,
                                            NoSertifikat,TglSertifikat,Penggunaan,BatasUtara,BatasSelatan,BatasBarat,
                                            BatasTimur) VALUES (NULL, '$p_gtanah_luaskeseluruhan','$aset_id','$p_gtanah_luasbangunan',
                                            '$p_gtanah_saranalingkungn','$p_gtanah_tanahkosong','$p_gtanah_hakpakai',
                                            '$p_gtanah_nosertifikat', '$p_gtanah_tglsertifikat','$p_gtanah_penggunaan',
                                            '$p_gtanah_batasutara','$p_gtanah_batasselatan','$p_gtanah_batasbarat',
                                            '$p_gtanah_batastimur')";
                            
                            $resulttanah= mysql_query($querytanah)or die ('eror 6');
							($querytanah) ? $tanah_id = $tanah_id : $tanah_id = 'NULL';
                            $flag = 1;
                            $TipeAset="A";
                            $Kuantitas='1';
                            
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
                            $Kuantitas='1';
                            
                            $mesin_id=  get_auto_increment("Mesin");
                            
                            $querymesin ="insert into Mesin(Mesin_ID, Merk,Aset_ID,Model,Ukuran,Silinder,MerkMesin,JumlahMesin,Material,
                                            NoSeri, NoRangka,NoMesin,NoSTNK,TglSTNK,NoBPKB,TglBPKB,NoDokumen,TglDokumen,
                                            TahunBuat,BahanBakar,Pabrik,NegaraAsal,kapasitas,Bobot,NegaraRakit)
                                            values(NULL, '$p_gmsn_peralatan','$aset_id','$p_gmsn_tipemodel','$p_gmsn_ukuran',
                                            '$p_gmsn_silinder','$p_gmsn_merek','$p_gmsn_jumlahmesin','$p_gmsn_material',
                                            '$p_gmsn_noseripabrik','$p_gmsn_rangka','$p_gmsn_nomesin','$p_gmsn_nopolisi',
                                            '$p_gmsn_tglstnk','$p_gmsn_nobpkb','$p_gmsn_tglbpkb','$p_gmsn_nodokumenlain',
                                            '$p_gmsn_tgldokumenlain','$p_gmsn_tahunpembutan','$p_gmsn_bahanbakar',
                                            '$p_gmsn_pabrik','$p_gmsn_negaraasal','$p_gmsn_kapasitas','$p_gmsn_bobot',
                                            '$p_gmsn_negaraperakitan')";
        
                            $resultmesin=  mysql_query($querymesin)or die('eror 21');
                            ($resultmesin) ? $mesin_id = $mesin_id : $mesin_id = 'NULL';
                            $flag = 2;
                            $TipeAset="B";
                        }
                        break;
                    case '04':
                        {
                            //golongan jalan
                            $p_jaringan_konstruksi=$_POST['p_jaringan_konstruksi'];
                            $p_jaringan_panjang=$_POST['p_jaringan_panjang'];
                            $p_jaringan_lebar=$_POST['p_jaringan_lebar'];
                            $p_jaringan_luas=$_POST['p_jaringan_luas'];
                            $p_jaringan_nodokumen=$_POST['p_jaringan_nodokumen'];
                            $p_jaringan_tgldokume = $_POST['p_jaringan_tgldokumen']; ///bulan/tanggal/tahun 
                            $dateh = explode('/', $p_jaringan_tgldookume); ///
                            $p_jaringan_tgldokumen = $dateh[2].$dateh[1].$dateh[0]; 
                             $p_jaringan_tglpemakaia = $_POST['p_jaringan_tglpemakaian']; ///bulan/tanggal/tahun 
                            $dateh = explode('/', $p_jaringan_tglpemakaia); ///
                            $p_jaringan_tglpemakaian = $dateh[2].$dateh[1].$dateh[0]; 
                            
                            $p_jaringan_statustanah=$_POST['p_jaringan_statustanah'];
                            $p_gjal_pilihaset_tanah=$_POST['p_gjal_pilihaset_tanah'];
                            $p_jaringan_nomorkode_tanah=$_POST['p_jaringan_nomorkode_tanah'];
                            $Kuantitas='1';
                            
                            $jaringan_id=  get_auto_increment("Jaringan");
                            
                            $queryjaringan = "INSERT INTO Jaringan(Jaringan_ID, Konstruksi,LuasJaringan,Aset_ID,Panjang,Lebar,
                                                NoDokumen,TglDokumen,TanggalPemakaian,StatusTanah,KelompokTanah_ID,Tanah_ID)
                                                VALUES(NULL, '$p_jaringan_konstruksi','$p_jaringan_luas','$aset_id',
                                                '$p_jaringan_panjang','$p_jaringan_lebar','$p_jaringan_nodokumen',
                                                '$p_jaringan_tgldokumen','$p_jaringan_tglpemakaian','$p_jaringan_statustanah','$p_gjal_pilihaset_tanah','$p_jaringan_nomorkode_tanah')";
                            $resultjaringan = mysql_query($queryjaringan) or die ('erorr jaringan');
                            ($resultjaringan) ? $jaringan_id = $jaringan_id : $jaringan_id = 'NULL';
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
                            $dateia = explode('/',$p_gdg_tgldokume); ///
                            $p_gdg_tgldokumen = $dateia[2].$dateia[1].$dateia[0];   
                            
                            
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
                            $Kuantitas='1';
                            
                            $query ="insert into Bangunan(Bangunan_ID, Konstruksi,Aset_ID,Beton,JumlahLantai,LuasLantai,
                                            Dinding,Lantai,LangitLangit,Atap,NoSurat,TglSurat,TglPakai,StatusTanah,KelompokTanah_ID,
                                            Tanah_ID,NoIMB,TglIMB) VALUES (NULL, '$p_gdg_konstruksi','$aset_id','$p_gdg_konstruksib',
                                            '$p_gdg_jumlah_lantai','$p_gdg_luaslantai','$p_gdg_dinding','$p_gdg_lantai','$p_gdg_plafon',
                                            '$p_gdg_atap','$p_gdg_nodokumen','$p_gdg_tgldokumen','$p_gdg_tglpemakaian','$p_gdg_ststustanah','$p_gdg_asettanah',
                                            '$p_gdg_kodetanah','$p_gdg_no_imb','$p_gdg_tglimb')";
                         
        
                            $resultbangunan=  mysql_query($query)or die ('eror 23');
                            $flag = 3;
                             $TipeAset="C";
        
                        }
                        break;
                    case '05':
                        {
                       
                            // jika golongan 5 lakukan pengecekan data input sesuai golongan
                            // cek nilai data input
                        $aset_lain_id=  get_auto_increment("Aset_Lain");
                        
                            $jenis_aset_lain = $_POST['jenis_aset_lain'];
                            // echo 'nilai case asetlain= '.$jenis_aset_lain;
                             
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
                                        
                                        $queryasetlain = "insert into AsetLain(AsetLain_ID, Judul,Aset_ID,Pengarang, Penerbit,Spesifikasi, TahunTerbit,ISBN)
                                                            values(NULL, '$p_gol5_judul','$aset_id','$p_gol5_penerbit', '$p_gol5_spesifikasi',
                                                            '$p_gol5_spesifikasi', '$p_gol5_asetlain_tahunterbit', '$p_gol5_isbn')";
                                        
                                        //
                                          $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas3',Satuan= '$p_gol5_satuan3' WHERE Aset_ID = $aset_id";
                                        
                                        //
                                        
                                
                                        
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
                                        
                                        $queryasetlain = "insert into AsetLain(AsetLain_ID, Judul,Aset_ID, AsalDaerah,Pengarang, Material) 
                                                            values (NULL, '$p_gol5_judul1','$aset_id','$p_gol5_asal','$p_gol5_pencipta','$p_gol5_bahan')";
                                         $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas1',Satuan = '$p_gol5_satuan1' WHERE Aset_ID = $aset_id";
                                        echo 'ada';
                                        //$resultaset=  mysql_query($queryaset)or die ('eror asetlain kesenian');
                                    }
                                    break;
                                case '2':
                                    {
                                        //golongan hewan
                                        $p_gol5_jenis=$_POST['p_gol5_jenis'];
                                        $p_gol5_ukuran=$_POST['p_gol5_ukuran'];
                                        $p_gol5_kuantitas2=$_POST['p_gol5_kuantitas2'];
                                        $p_gol5_satuan2=$_POST['p_gol5_satuan2'];
                                        
                                        $queryasetlain="insert into AsetLain(AsetLain_ID, Judul,Aset_ID,Ukuran)
                                                        values(NULL, '$p_gol5_jenis','$aset_id','$p_gol5_ukuran')";
                                          $queryasetlain_update ="UPDATE Aset SET Kuantitas = '$p_gol5_kuantitas2',Satuan = '$p_gol5_satuan2' WHERE Aset_ID = $aset_id";
                           
                                        //$resultaset=  mysql_query($queryaset)or die ('eror 17');
                                    }
                                    break;
                                
                               
                                
                            }
                            $flag = 5;
                            $TipeAset="E";
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
                            $Kuantitas='1';
                            //golongan persediaan
                            
                            $kdp_id=  get_auto_increment("KDP");
                            
                            $querykdp = "INSERT INTO KDP(KDP_ID, Konstruksi,Aset_ID,Beton,JumlahLantai,LuasLantai,TglMulai,StatusTanah,
                                            KelompokTanah_ID,Tanah_ID) VALUES(NULL, '$p_gjal_konstruksi','$aset_id','$p_gjal_konstruksi1','$p_gjal_panjang',
                                            '$p_gol6_luas_lantai','$tanggal_pembangunan','$p_gol6_statustanah','$p_gol6_pilih_asettanah','$p_gol6_nomor_kodetanah')";
                            $resultkdp = mysql_query($querykdp) or die ('eror 9');
                            ($resultkdp) ? $kdp_id = $kdp_id : $kdp_id = 'NULL';
                            $flag = 6;
                             $TipeAset="F";
        
                        }
                        break;
             
                    case '07':
                        {
                            $p_gol7_kuantitas4=$_POST['p_gol7_kuantitas4'];
                            $p_gol7_satuan4=$_POST['p_gol7_satuan4'];
                            
                            $queryasetgol7 ="UPDATE Aset SET Kuantitas = '$p_gol7_kuantitas4',Satuan = '$p_gol7_satuan4' WHERE Aset_ID = $aset_id";
                            //print_r($queryasetgol7);
                            //$resultaset=  mysql_query($queryasetgol7)or die ('eror 17');
                            $flag = 7;
                            
                        }
                        break;
                   

                    
                }
                // query ke tabel kelompok dulu untuk mendapatkan golongan sebelum melakukan insert data
                
               
            // buat kondisi untuk mengecek variabel flag, untuk menentukan nilai getautoincrement sebelum diasukan ke tabel aset
            
            // p_perolehan_caraperolehan
            
            $p_perolehan_caraperolehan = $_POST['p_perolehan_caraperolehan'];
       // echo '  nilai case perolehan = '.$p_perolehan_caraperolehan;
          if ($p_perolehan_caraperolehan !=0)
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
                            $p_pengadaan_tglsp2d_post=$_POST['p_pengadaan_tglsp2d'];
                            //$p_pengadaan_tglsp2d=$_POST['p_pengadaan_tglsp2d'];
                            $p_pengadaan_mataanggaran=$_POST['p_pengadaan_mataanggaran'];
                           
                            $jml_kontrak=count($p_pengadaan_nokontrak);
                             $jml_sp2d=count($p_pengadaan_nosp2d);
                            for($i=0;$i<$jml_kontrak;$i++){
                                
                                $p_pengadaan_tglkontrak[$i] = $RETRIEVE->change_date_to_strip(array('data'=>$p_pengadaan_tglkontrak_post[$i], 'type'=>''));
                                //echo $p_pengadaan_tglkontrak[$i].'<br>';
                                        $kontraktor_id =  get_auto_increment("Kontraktor");

                                        $querykontraktor="insert into Kontraktor(Kontraktor_ID, NamaKontraktor) values(NULL, '$p_pengadaan_kontraktor[$i]')";

                                        $resultkontraktor=  mysql_query($querykontraktor)or die ('eror 1');
                                        ($resultkontraktor) ? $kontraktor_id = $kontraktor_id : $kontraktor_id = 'NULL';

                                        $kontrak_id=  get_auto_increment("Kontrak");

                                        $querykontrak="insert into Kontrak(Kontrak_ID, NoKontrak,Kontraktor_ID,NilaiKontrak,TglKontrak,
                                                       Pekerjaan) values(NULL, '$p_pengadaan_nokontrak[$i]','$kontraktor_id[$i]','$p_pengadaan_nilaikontrak[$i]',
                                                       '$p_pengadaan_tglkontrak[$i]','$p_pengadaan_pekerjaan[$i]')";
                                        //print_r($querykontrak);
                                        $resultkontrak=  mysql_query($querykontrak)or die ('eror 2');
                                        ($resultkontrak) ? $kontrak_id = $kontrak_id : $kontrak_id = 'NULL';
                                        $kontrakaset=get_auto_increment("KontrakAset");
                                        /*
                                        echo "masuk ::<br/>";
                                        echo $querykontrak;
                                        echo "<br/>";*/
                                        $querykontrakaset="insert into KontrakAset (Kontrak_ID, Aset_ID) values ($kontrak_id, '$aset_id')";
                                        //print $querykontrakaset;
                                        $resultkontrakaset=  mysql_query($querykontrakaset)or die('eror 3');
                                        ($resultkontrakaset) ? $kontrakaset = $kontrakaset : $kontrakaset = 'NULL';
                            }
                            for($i=0;$i<$jml_sp2d;$i++){
                                             $sp2d_id=get_auto_increment("SP2D");
                                            $p_pengadaan_tglsp2d[$i] = $RETRIEVE->change_date_to_strip(array('data'=>$p_pengadaan_tglsp2d_post[$i], 'type'=>''));
                                            
                                             $querysp2d= "INSERT INTO SP2D (SP2D_ID, NoSP2D,TglSP2D,MAK,NilaiSP2D) VALUES(NULL, '$p_pengadaan_nosp2d[$i]','$p_pengadaan_tglsp2d[$i]',
                                                            '$p_pengadaan_mataanggaran[$i]','$p_pengadaan_nilaisp2d[$i]')";
                                             $resultsp2d = mysql_query($querysp2d) or die ('eror 15');
                                             ($resultsp2d) ? $sp2d_id = $sp2d_id : $sp2d_id = 'NULL';

                                             $id_kapitalisasi_aset=  get_auto_increment("KapitalisasiAset");

                                             $querykapitalisasiaset= "INSERT INTO KapitalisasiAset (Aset_ID,SP2D_ID) VALUES('$aset_id','$sp2d_id')";
                                             $resultkapitalisasiaset = mysql_query($querykapitalisasiaset) or die ('eror 16');
                                             ($resultkapitalisasiaset) ? $id_kapitalisasi_aset = $id_kapitalisasi_aset : $id_kapitalisasi_aset = 'NULL';
                            }
                        
                        
                        
                             //kontrak
                        /*
                            $p_pengadaan_nokontrak=$_POST['p_pengadaan_nokontrak'];
                            $p_pengadaan_nilaikontrak=$_POST['p_pengadaan_nilaikontrak'];
                            $p_pengadaan_tglkontrak=$_POST['p_pengadaan_tglkontrak'];
                            $p_pengadaan_pekerjaan=$_POST['p_pengadaan_pekerjaan'];
                            $p_pengadaan_kontraktor=$_POST['p_pengadaan_kontraktor'];
                            
                            $p_pengadaan_nosp2d=$_POST['p_pengadaan_nosp2d'];
                            $p_pengadaan_tglsp2d=$_POST['p_pengadaan_tglsp2d'];
                            $p_pengadaan_tglsp2d=$_POST['p_pengadaan_tglsp2d'];
                            $p_pengadaan_mataanggaran=$_POST['p_pengadaan_mataanggaran'];
                            
                            $index_nol = 0;
                            foreach($p_pengadaan_nilaikontrak as $nilai_kontrak)
                            {
                                $kontraktor_id =  get_auto_increment("Kontraktor");
                            
                                $querykontraktor="insert into Kontraktor(Kontraktor_ID, NamaKontraktor) values(NULL, '$p_pengadaan_kontraktor[$index_nol]')";
                                
                                $resultkontraktor=  mysql_query($querykontraktor)or die ('eror 1');
                                ($resultkontraktor) ? $kontraktor_id = $kontraktor_id : $kontraktor_id = 'NULL';
                                
                                $kontrak_id=  get_auto_increment("Kontrak");
                                
                                $querykontrak="insert into Kontrak(Kontrak_ID, NoKontrak,Kontraktor_ID,NilaiKontrak,TglKontrak,
                                                Pekerjaan) values(NULL, '$p_pengadaan_nokontrak','$kontraktor_id','$nilai_kontrak',
                                                '$p_pengadaan_tglkontrak[$index_nol]','$p_pengadaan_pekerjaan[$index_nol]')";
                                $resultkontrak=  mysql_query($querykontrak)or die ('eror 2');
                                ($resultkontrak) ? $kontrak_id = $kontrak_id : $kontrak_id = 'NULL';
                                
                                $kontrakaset=get_auto_increment("KontrakAset");
                                
                                $querykontrakaset="insert into KontrakAset (Kontrak_ID, Aset_ID) values ($kontrak_id, '$aset_id')";
                                //print $querykontrakaset;
                                $resultkontrakaset=  mysql_query($querykontrakaset)or die('eror 3');
                                ($resultkontrakaset) ? $kontrakaset = $kontrakaset : $kontrakaset = 'NULL';
                                
                                $index_nol++;
                            }
                            
                            foreach ($p_pengadaan_tglsp2d as $tgl_sp2d)
                            {
                                $sp2d_id=get_auto_increment("SP2D");
                            
                                $querysp2d= "INSERT INTO SP2D (SP2D_ID, NoSP2D,TglSP2D,MAK,NilaiSP2D) VALUES(NULL, '$p_pengadaan_nosp2d','$tgl_sp2d',
                                                '$p_pengadaan_mataanggaran','$p_pengadaan_nilaisp2d')";
                                $resultsp2d = mysql_query($querysp2d) or die ('eror 15');
                                ($resultsp2d) ? $sp2d_id = $sp2d_id : $sp2d_id = 'NULL';
                                
                                $id_kapitalisasi_aset=  get_auto_increment("KapitalisasiAset");
                                
                                $querykapitalisasiaset= "INSERT INTO KapitalisasiAset (Aset_ID,SP2D_ID) VALUES('$aset_id','$sp2d_id')";
                                $resultkapitalisasiaset = mysql_query($querykapitalisasiaset) or die ('eror 16');
                                ($resultkapitalisasiaset) ? $id_kapitalisasi_aset = $id_kapitalisasi_aset : $id_kapitalisasi_aset = 'NULL';
                            }
                         * 
                         */
                            
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
                            $querybast="insert into BAST(BAST_ID, PemberiHibah,NoBAST,TglBAST,NamaPihak1,JabatanPihak1,NIPPihak1,NamaPihak2,JabatanPihak2,
                                            NIPPihak2) values(NULL, '$p_hibah_pemberi','$p_hibah_nobbast','$p_hibah_tglbast','$p_hibah_namapertama',
                                            '$p_hibah_jabatan_pertama','$p_hibah_nippertama','$p_hibah_namakedua','$p_hibah_jabatan_kedua',
                                            '$p_hibah_nipkedua')";
                            $resultbast=  mysql_query($querybast)or die ('eror 4');
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
                            
                            $keputusanpengadilan_id= get_auto_increment("KeputusanPengadilan");
                            
                            $querypengadilan= "INSERT INTO KeputusanPengadilan(KeputusanPengadilan_ID, NoKeputusan,Aset_ID,JenisAset,AsalAset,Keterangan)
                                                VALUES(NULL, '$p_pengadilan_no_pengadilan','$aset_id','$p_pengadilan_jenisaset','$p_pengadilan_asalaset',
                                                '$p_pengadilan_keterangan')";
                            
                            $resultpengadilan= mysql_query($querypengadilan) or die ('eror 14');
                            ($resultpengadilan) ? $keputusanpengadilan_id = $keputusanpengadilan_id : $keputusanpengadilan_id = 'NULL';
                        
                            
                           
                        }
                        break;
                    case '4':
                        {
                            //keputusan UUD//
                            $p_uud_no_uud=$_POST['p_uud_no_uud'];
                            $p_uud_jenisaset=$_POST['p_uud_jenisaset'];
                            $p_uud_asalaset=$_POST['p_uud_asalaset'];
                            $p_uud_keterangan=$_POST['p_uud_keterangan'];
                            
                           
                             $keputusanundangundang_id= get_auto_increment("KeputusanUndangUndang");
                            
                            $queryundangundang= "INSERT INTO KeputusanUndangUndang(KeputusanUndangUndang_ID, NoKeputusan,Aset_ID,JenisAset,AsalAset,Keterangan) VALUES(NULL, '$p_uud_no_uud',
                                                    '$aset_id','$p_uud_jenisaset','$p_uud_asalaset','$p_uud_keterangan')";
                            $resultpengadilanuud = mysql_query($queryundangundang) or die ('eror 13');
                            ($resultpengadilanuud) ? $keputusanundangundang_id = $keputusanundangundang_id : $keputusanundangundang_id = 'NULL';
                            
                        }
                        break;
                    
                }
                // insert data sesuai pilihan
                
                
            }
            //end p_perolehan_caraperolehan
            
            // p_penghapusan_aset
            
            $p_penghapusan_aset = $_POST['p_penghapusan_aset'];
       // echo '  nilai case lagi ='.$p_penghapusan_aset;
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
                            
                            $querybasp="INSERT INTO BASP (BASP_ID,NoBASP,TglBASP,NamaPihak1,JabatanPihak1,NIPPihak1,
                            LokasiPihak1, NamaPihak2,JabatanPihak2,NIPPihak2,LokasiPihak2,
                            NoSKPenetapan,TglSKPenetapan,NoSKPenghapusan,TglSKPenghapusan) 
                            Values ('$GET_BASP_ID','$p_p_tangan_nobasp','$p_p_tangan_tglbasp','$p_p_tangan_namapertama','$p_p_tangan_jbtnpertama','$p_p_tangan_nippertama',
                                                                            '$p_p_tangan_lokasipertama','$p_p_tangan_namakedua','$p_p_tangan_jbtnkedua','$p_p_tangan_nipkedua', '$p_p_tangan_lokasikedua',
                                                                            '$p_p_tangan_noskpenetapan','$p_p_tangan_tglskpenetapan','$p_p_tangan_noskhapus', '$p_p_tangan_tglskhapus')";
                                       
            
                            //print_r($querybasp);
                            $resultbasp=  mysql_query($querybasp)or die (mysql_error());
                            //($resultbasp) ? $basp_id = $basp_id : $basp_id = 'NULL';
                            
                        }
                        break;
                    case '2':
                        {
                            //pemusnahan
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
                            
                            $querypemusnahan= "INSERT INTO Pemusnahan(Pemusnahan_ID, KetPemusnahan,Aset_ID,NoSKPenetapan,TglSKPenetapan,NoSKPenghapusan,TglSKPenghapusan)
                                                    VALUES(NULL, '$p_pmusnah_keterangan','$aset_id','$p_pmusnah_noskpenetapan','$p_pmusnah_tglskpenetapan',
                                                    '$p_pmusnah_noskhapus','$p_pmusnah_tglskhapus')";
                            $resultpemusnahan = mysql_query($querypemusnahan) or die ('eror 12');
                            ($resultpemusnahan) ? $pemusnahan_id = $pemusnahan_id : $pemusnahan_id = 'NULL';
                        }
                        break;
                    
                }
                // insert data sesuai pilihan
            }
            // end p_penghapusan_aset
          if($p_ruangan=='')
	      $p_ruangan='NULL';
            $queryaset="INSERT INTO Aset (Aset_ID,Kelompok_ID, BAST_ID,BASP_ID,Lokasi_ID,Penerimaan_ID,BAPemusnahan_ID,OrigSatker_ID,
                            CaraPerolehan,PenghapusanAset,NomorReg,Pemilik,NamaAset,Ruangan,Alamat,RTRW,AsalUsul,TglPerolehan,Tahun,
                            NilaiPerolehan,TipeAset,Bersejarah,Peruntukan,SumberDana, AsetLain,JenisAset,Kuantitas,LastSatker_ID,NotUse,Status_Validasi_Barang,OriginDbSatker,UserNm,Info)  VALUES (null,'$kelompok_id3','$bast_id','$basp_id',
                            '$lokasi_id','$id_penerimaan','$pemusnahan_id','$satker_id','$p_perolehan_caraperolehan',         
                            '$p_penghapusan_aset','$noregnoreg','$p_noreg_pemilik','$p_nama_aset','$p_ruangan','$p_alamat','$p_rt',
                            '$p_perolehan_ket_asalusul','$p_perolehan_tglperolehan','$p_perolehan_thnperolehan','$p_perolehan_nilai',
                            '$TipeAset','$p_bersejarah','$p_p_tangan_peruntukan','$p_pengadaan_sumberdana','$jenis_aset_lain','$p_jenisaset','$Kuantitas','0','0','0','0','$user','$p_keterangantambahan')";
           // print_r($queryaset);
            // exit;
            $resultaset = $DBVAR->query($queryaset) or die ($DBVAR->error());
              
            
            
            if ($flag == '7')
            {
                $resultGolongan7 = $DBVAR->query($queryasetgol7) or die ($DBVAR->error());    
            }
            else if ($flag == '5')
            {
                $resultGolongan5 = $DBVAR->query($queryasetlain_update) or die  ('eror AsetLain');
                //$resultasetlaininsert=  mysql_query($queryasetlain)or die ('eror asetlain buku insert');
                 $aset_lain_id=  get_auto_increment("Aset_Lain");
                 //echo $queryasetlain;
                $resultasetlain=  $DBVAR->query($queryasetlain)or die ('eror 5');
                 ($resultasetlain) ? $aset_lain_id = $aset_lain_id : $aset_lain_id = 'NULL';
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
      //    echo '   masuk Aset_ID =';
  //  echo $aset_id;
    }
    else
    {
       echo '<script type=text/javascript>alert("Silahkan masukan data Kelompok, Aset, Golongan, lokasi dan "); history.back(); </script>';
    }
    //exit();
//echo 'data sudah masuk';
echo "<script>alert('Data Sudah Disimpan !!!'); document.location='pengadaan.php';</script>";
}


