<?php
include "../../config/config.php";
include "../../function/upload/proses_upload_photo.php";


//echo '<pre>';
//echo 'ada';
//print_r($_POST);

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
    $Inventarisasi_ID=$_POST['Inventarisasi_ID'];
    $Kondisi_ID=$_POST['Kondisi_ID'];

   
   
    //ID Golongan
    
    $Tanah_ID = $_POST['Tanah_ID'];
    $Mesin_ID = $_POST['Mesin_ID'];
    $Bangunan_ID=$_POST['Bangunan_ID'];
    $Jaringan_ID=$_POST['Jaringan_ID'];
    $AsetLain_ID = $_POST['AsetLain_ID'];
    $KDP_ID = $_POST['KDP_ID'];
    /// end ID golongan
    
    $BAST_ID = $_POST['BAST_ID'];
    $Penerimaan_ID = $_POST['Penerimaan_ID'];
   
    $lokasi_baru_ID = $_POST['lokasi_baru_ID'];
    
    
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
    $tahun3=  substr($tahun,2,2); 
     $noregnoreg = $p_noreg_pemilik.'.11.02.'.$p_noreg_satker.'.'.$tahun3.'.00';

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
        
        for ($loop = 0; $loop < 1 ; $loop++)
        {
            
        //$p_noreg_noreg2
        
            $Get_Aset_ID=  get_auto_increment('Aset');
            $Get_BAST_ID = get_auto_increment('BAST');
            $Get_BASP_ID = get_auto_increment('BASP');
            $Get_Satker_ID = get_auto_increment('Satker');
            $Get_Lokasi_ID = get_auto_increment('Lokasi');
            $Get_Penerimaan_ID = get_auto_increment('Penerimaan');
            $Get_Pemusnahan_ID = get_auto_increment('Pemusnahan');
            
          
            $queryaset="    UPDATE Aset SET
                            Kelompok_ID = '$kelompok_id3',
                            BAST_ID = '$BAST_ID',
                            BASP_ID = '$BASP_ID',
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
                            TipeAset = '$p_jenisaset',
                            Bersejarah = '$p_bersejarah'
                            WHERE Aset_ID = $Aset_ID";
                 $resulAset = mysql_query($queryaset) or die ('error aset');
             //   print_r($queryaset);
            
            //exit;
          
             

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
                    //    print_r($querylokasibaru);
                        //echo '<br>';
                        $resultlokasibaru = mysql_query($querylokasibaru) or die ('eror 19');
                        //($resultlokasibaru) ? $lokasi_baru_id = $lokasi_baru_id : $lokasi_baru_id = 'NULL';
                    }
                    else
                    {
                        $lokasi_baru_ID = get_auto_increment("lokasi_baru");
                        $querylokasibaru= "INSERT INTO lokasi_baru (lokasi_baru_ID, Aset_ID,koordinat) VALUES ($lokasi_baru_ID, '$Aset_ID','$kordinat')";
                        //echo "$a";
                       // print_r($querylokasibaru);
                        //echo '<br>';
                        $resultlokasibaru = mysql_query($querylokasibaru) or die ('eror insert lokasibaru');
                       // ($resultlokasibaru) ? $lokasi_baru_ID = $lokasi_baru_ID : $lokasi_baru_ID = 'NULL';
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
                $querypenerimaan= "UPDATE Penerimaan SET TglPemeriksaan = '$p_periksa_tglpemeriksaan',NoBAPemeriksaan = '$p_periksa_no_ba',
                                    KetuaPemeriksa = '$p_periksa_ketua_pemeriksa',StatusPemeriksaan = '$p_ststus_pemeriksaan',
                                    NoBAPenerimaan = '$p_periksa_no_ba_penerimaan',TglPenerimaan = '$p_periksa_tglpenerimaan',
                                    NamaPenyimpan = '$p_periksa_namapengurus',
                                    NIPPenyimpan = '$p_periksa_nippengurus', NamaPenyedia= '$p_periksa_namapenyedia'
                WHERE Penerimaan_ID = $Penerimaan_ID";
             //   echo'maraoks';
             //   print_r($querypenerimaan);
                $resultpenerimaan = mysql_query($querypenerimaan) or die ('eror update penerimaan');
                //($resultpenerimaan) ? $id_penerimaan = $id_penerimaan : $id_penerimaan = 'NULL';
            }
          
            else
            {
                $Penerimaan_ID=  get_auto_increment("Penerimaan");
                $querypenerimaan= "INSERT INTO Penerimaan (Penerimaan_ID,TglPemeriksaan,NoBAPemeriksaan,KetuaPemeriksa,StatusPemeriksaan,NoBAPenerimaan,TglPenerimaan,
                                    NamaPenyedia,NamaPenyimpan,NIPPenyimpan)VALUES(NULL,'$p_periksa_tglpemeriksaan','$p_periksa_no_ba','$p_periksa_ketua_pemeriksa',
                                    '$p_ststus_pemeriksaan','$p_periksa_no_ba_penerimaan','$p_periksa_tglpenerimaan','$p_periksa_namapenyedia','$p_periksa_namapengurus',
                                    '$p_periksa_nippengurus')";
                $resultpenerimaan = mysql_query($querypenerimaan) or die ('eror insert penerimaan');
                ($resultpenerimaan) ? $Penerimaan_ID = $Penerimaan_ID : $Penerimaan_ID = 'NULL';
            }

            
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
            
              
            $Get_inventarisasi_ID = get_auto_increment('Inventarisasi');
            $Get_Kondisi_ID = get_auto_increment("Kondisi");
            
            //
    
               
        
         
            
            
            $inv_ldahi_dokinventaris=$_POST['inv_ldahi_dokinventaris'];
             $inv_ldahi_tglinventari = $_POST['inv_ldahi_tglinventaris']; ///bulan/tanggal/tahun 
            $dateee = explode('/', $inv_ldahi_tglinventari); ///
            $inv_ldahi_tglinventaris = $dateee[2].$dateee[1].$dateee[0];      
            
           
 
            
            $inv_ldahi_tbh_tgldokume = $_POST['inv_ldahi_tbh_tgldokumen']; ///bulan/tanggal/tahun 
            $dateeeb = explode('/', $inv_ldahi_tbh_tgldokume); ///
            $inv_ldahi_tbh_tgldokumen= $dateeeb[2].$dateeeb[1].$dateeeb[0];    
            
            $inv_ldahi_tbh_tglkondis = $_POST['inv_ldahi_tbh_tglkondisi']; ///bulan/tanggal/tahun 
            $dateeb = explode('/', $inv_ldahi_tbh_tglkondis); ///
            $inv_ldahi_tbh_tglkondisi = $dateeb[2].$dateeb[1].$dateeb[0];       
             
             
            $inv_ldahi_tbh_no_dokumen=$_POST['inv_ldahi_tbh_no_dokumen'];
            $inv_ldahi_tbh_baik=$_POST['inv_ldahi_tbh_baik'];
            $inv_ldahi_tbh_tdk_sempurna=$_POST['inv_ldahi_tbh_tdk_sempurna'];
            $inv_ldahi_tbh_rusak_ringan=$_POST['inv_ldahi_tbh_rusak_ringan'];
            $inv_ldahi_tbh_tdk_sesuai_peruntukan=$_POST['inv_ldahi_tbh_tdk_sesuai_peruntukan'];
            $inv_ldahi_tbh_rusak_berat=$_POST['inv_ldahi_tbh_rusak_berat'];
            $inv_ldahi_tbh_tdk_sesuai_spesifikasi=$_POST['inv_ldahi_tbh_tdk_sesuai_spesifikasi'];
            $inv_ldahi_tbh_blm_dimanfaatkan=$_POST['inv_ldahi_tbh_blm_dimanfaatkan'];
            $inv_ldahi_tbh_tdk_dpt_dikunjungi=$_POST['inv_ldahi_tbh_tdk_dpt_dikunjungi'];
            $inv_ldahi_tbh_blm_selesai=$_POST['inv_ldahi_tbh_blm_selesai'];
            $inv_ldahi_tbh_almt_tdk_jelas=$_POST['inv_ldahi_tbh_almt_tdk_jelas'];
            $inv_ldahi_tbh_blm_dikerjakan=$_POST['inv_ldahi_tbh_blm_dikerjakan'];
            $inv_ldahi_tbh_kegiatan_tdk_ditemukan=$_POST['inv_ldahi_tbh_kegiatan_tdk_ditemukan'];
            $inv_ldahi_tbh_ket_inventarisasi=$_POST['inv_ldahi_tbh_ket_inventarisasi'];
            $inv_ldahi_infoaset=$_POST['inv_ldahi_infoaset'];
            
            
            $p_kodeaset =$_POST['p_kodeaset'];
            //$Golongan = $_POST['Golongan'];
            //$Golongan = $_POST['Golongan'];
            
           
            
             if ($Inventarisasi_ID !=''){
                 
            $queryupdateinventarisasi= "UPDATE  Inventarisasi SET  NoDokInventarisasi='$inv_ldahi_dokinventaris',TglDokInventarisasi='$inv_ldahi_tglinventaris'
            Where Inventarisasi_ID=$Inventarisasi_ID";
          //  print_r($queryupdateinventarisasi);
            $resultinsertinventarisasi=mysql_query($queryupdateinventarisasi) or die ('error updateinventarisasi');
                $querykondisiupdate= "UPDATE Kondisi SET Inventarisasi_ID='$Inventarisasi_ID'
                Where Aset_ID=$Aset_ID";
            $resultkondisi=  mysql_query($querykondisiupdate)or die ('error update inventaris');
            
            $queryupdateaset="UPDATE Aset SET info='$inv_ldahi_infoaset'
            Where Aset_ID=$Aset_ID";
            $resultaset= mysql_query($queryupdateaset) or die ('error update info');
            /*
            if ($Kondisi_ID !=''){
            $queryupdateaset="UPDATE Kondisi SET Inventarisasi_ID='$Inventarisasi_ID'
            Where Aset_ID=$Aset_ID";
            $resultaset= mysql_query($queryupdateaset) or die ('error update info');
            }
             * 
             */
              
             }else {
            $queryinventarisasi= "INSERT INTO Inventarisasi (Inventarisasi_ID, NoDokInventarisasi,TglDokInventarisasi) VALUES ($Get_inventarisasi_ID, '$inv_ldahi_dokinventaris','$inv_ldahi_tglinventaris')";    
           // print_r($queryinventarisasi);
            $resultinsertinventarisasi=mysql_query($queryinventarisasi) or die ('error insert inventarisasi');
            $querykondisiupdate= "UPDATE Kondisi SET Inventarisasi_ID='$Inventarisasi_ID'
            Where Aset_ID=$Aset_ID";
            $resultkondisi=  mysql_query($querykondisiupdate)or die ('error update inventaris');
            
            $queryupdateaset="UPDATE Aset SET info='$inv_ldahi_infoaset'
            Where Aset_ID=$Aset_ID";
            $resultaset= mysql_query($queryupdateaset) or die ('error update info');
        /*    
             if ($Kondisi_ID !=''){
            $queryupdateaset="UPDATE Kondisi SET Inventarisasi_ID='$Get_inventarisasi_ID'
            Where Aset_ID=$Aset_ID";
            $resultaset= mysql_query($queryupdateaset) or die ('error update info');
            }
         * 
         */
            
            
             }
             
          
              If($Kondisi_ID !=''){
                 $querykondisi= "UPDATE Kondisi SET TglKondisi='$inv_ldahi_tbh_tglkondisi',Baik='$inv_ldahi_tbh_baik',
                                                                    TidakSempurna='$inv_ldahi_tbh_tdk_sempurna',RusakRingan='$inv_ldahi_tbh_rusak_ringan',TidakSesuaiUntuk='$inv_ldahi_tbh_tdk_sesuai_peruntukan',
                                                                    RusakBerat='$inv_ldahi_tbh_rusak_berat',TidakSesuaiSpec='$inv_ldahi_tbh_tdk_sesuai_spesifikasi',BelumManfaat='$inv_ldahi_tbh_blm_dimanfaatkan',TidakDikunjungi='$inv_ldahi_tbh_tdk_dpt_dikunjungi',
                                                                    BelumSelesai='$inv_ldahi_tbh_blm_selesai',TidakJelas='$inv_ldahi_tbh_almt_tdk_jelas',
                                                                    BelumDikerjakan='$inv_ldahi_tbh_blm_dikerjakan',TidakDitemukan='$inv_ldahi_tbh_kegiatan_tdk_ditemukan',
                                                                    NoDokumen='$inv_ldahi_tbh_no_dokumen',TglDokumen='$inv_ldahi_tbh_tgldokumen'
                Where Aset_ID=$Aset_ID";
                // echo 'update inv';
                // print_r($querykondisi); 
                $resultkondisi=  mysql_query($querykondisi)or die ('error update kondisi');
              if($Inventarisasi_ID !=''){
                      $querykondisiupdate= "UPDATE Kondisi SET Inventarisasi_ID='$Inventarisasi_ID'
                Where Aset_ID=$Aset_ID";
                $resultkondisi=  mysql_query($querykondisiupdate)or die ('error update inventaris');
                }else{
                      $querykondisiupdate= "UPDATE Kondisi SET Inventarisasi_ID='$Get_inventarisasi_ID'
                Where Aset_ID=$Aset_ID";
            $resultkondisi=  mysql_query($querykondisiupdate)or die ('error update inventaris');
                }
     
             $queryupdateaset="UPDATE Aset SET info='$inv_ldahi_infoaset'
            Where Aset_ID=$Aset_ID";
            $resultaset= mysql_query($queryupdateaset) or die ('error update info');
           
            }else{
                 $querykondisiinsert= "INSERT INTO Kondisi (Kondisi_ID, Aset_ID,Inventarisasi_ID,TglKondisi,Baik,
                                                                    TidakSempurna,RusakRingan,TidakSesuaiUntuk,
                                                                    RusakBerat,TidakSesuaiSpec,BelumManfaat,TidakDikunjungi,BelumSelesai,TidakJelas,
                                                                    BelumDikerjakan,TidakDitemukan,NoDokumen,TglDokumen) VALUES ($Get_Kondisi_ID, '$Aset_ID','Inventarisasi_ID','$inv_ldahi_tbh_tglkondisi','$inv_ldahi_tbh_baik',
                                                                    '$inv_ldahi_tbh_tdk_sempurna','$inv_ldahi_tbh_rusak_ringan','$inv_ldahi_tbh_tdk_sesuai_peruntukan',
                                                                    '$inv_ldahi_tbh_rusak_berat','$inv_ldahi_tbh_tdk_sesuai_spesifikasi','$inv_ldahi_tbh_blm_dimanfaatkan',
                                                                    '$inv_ldahi_tbh_tdk_dpt_dikunjungi','$inv_ldahi_tbh_blm_selesai','$inv_ldahi_tbh_almt_tdk_jelas',
                                                                    '$inv_ldahi_tbh_blm_dikerjakan','$inv_ldahi_tbh_kegiatan_tdk_ditemukan','$inv_ldahi_tbh_no_dokumen','$inv_ldahi_tbh_tgldokumen')";
           
                // print_r($querykondisiinsert);   
            $resultkondisi=  mysql_query($querykondisiinsert) or die ('error insert kondisi');
             $queryupdateaset="UPDATE Aset SET info='$inv_ldahi_infoaset'
            Where Aset_ID=$Aset_ID";
            $resultaset= mysql_query($queryupdateaset) or die ('error update info');
            
            }   
            $p_kodeaset = substr($_POST['p_kodeaset'], 0,2);
            $GolonganHidden = $_POST['GolonganHidden'];
            //$Golongan = $_POST['Golongan'];
            //$Golongan = $_POST['Golongan'];
            
                switch ($p_kodeaset)
                {
                    case '01':
                        {
                                    if ($Mesin_ID !=''){  
                                    $querydeletemesin = "DELETE from Mesin where Aset_ID=$Aset_ID";
                                    $resultdeletemesin = mysql_query($querydeletemesin ) or die ('eror delete mesin');

                                    }if ($Bangunan_ID !=''){  
                                    $querydeletebangunan = "DELETE from Bangunan where Aset_ID=$Aset_ID";
                                    $resultdeletebangunan = mysql_query($querydeletebangunan) or die ('eror delete bangunan');

                                    }if ($Jaringan_ID !=''){  
                                    $querydeletejaringan= "DELETE from Jaringan where Aset_ID=$Aset_ID";
                                    $resultdeletejaringan = mysql_query($querydeletejaringan) or die ('eror delete jaringan');

                                    }if ($AsetLain_ID !=''){  
                                    $querydeleteasetlain= "DELETE from AsetLain where Aset_ID=$Aset_ID";
                                    $resultdeleteasetlain = mysql_query($querydeleteasetlain) or die ('eror delete asetlain');

                                    }if ($KDP_ID !=''){  
                                    $querydeletekdp= "DELETE from KDP where Aset_ID=$Aset_ID";
                                    $resultdeletekdp = mysql_query($querydeletekdp) or die ('eror delete kdp');

                                    }       
                        
                        
                        
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
                            
                        if($Tanah_ID==''){
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
                        
                               if ($Tanah_ID !=''){  
                                    $querydeletetanah = "DELETE from Tanah where Aset_ID=$Aset_ID";
                                    $resultdeletetanah = mysql_query($querydeletetanah ) or die ('eror delete tanah');

                                    }if ($Bangunan_ID !=''){  
                                    $querydeletebangunan = "DELETE from Bangunan where Aset_ID=$Aset_ID";
                                    $resultdeletebangunan = mysql_query($querydeletebangunan) or die ('eror delete bangunan');

                                    }if ($Jaringan_ID !=''){  
                                    $querydeletejaringan= "DELETE from Jaringan where Aset_ID=$Aset_ID";
                                    $resultdeletejaringan = mysql_query($querydeletejaringan) or die ('eror delete jaringan');

                                    }if ($AsetLain_ID !=''){  
                                    $querydeleteasetlain= "DELETE from AsetLain where Aset_ID=$Aset_ID";
                                    $resultdeleteasetlain = mysql_query($querydeleteasetlain) or die ('eror delete asetlain');

                                    }if ($KDP_ID !=''){  
                                    $querydeletekdp= "DELETE from KDP where Aset_ID=$Aset_ID";
                                    $resultdeletekdp = mysql_query($querydeletekdp) or die ('eror delete kdp');

                                    }       
                        
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
                           if($Mesin_ID ==''){
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
                              //  print_r($querymesin);
                                
                                $resultmesin=  mysql_query($querymesin)or die('eror 21');
                            }
                            
                            
                            $flag = 2;
                            $TipeAset="B";
                        }
                        break;
                    case '04':
                        {
                                    if ($Tanah_ID !=''){  
                                    $querydeletetanah = "DELETE from Tanah where Aset_ID=$Aset_ID";
                                    $resultdeletetanah = mysql_query($querydeletetanah ) or die ('eror delete tanah');

                                    }if ($Mesin_ID !=''){  
                                    $querydeletemesin = "DELETE from Mesin where Aset_ID=$Aset_ID";
                                    $resultdeletemesin = mysql_query($querydeletemesin ) or die ('eror delete mesin');

                                    }if ($Bangunan_ID !=''){  
                                    $querydeletebangunan = "DELETE from Bangunan where Aset_ID=$Aset_ID";
                                    $resultdeletebangunan = mysql_query($querydeletebangunan) or die ('eror delete bangunan');

                                    }if ($AsetLain_ID !=''){  
                                    $querydeleteasetlain= "DELETE from AsetLain where Aset_ID=$Aset_ID";
                                    $resultdeleteasetlain = mysql_query($querydeleteasetlain) or die ('eror delete asetlain');

                                    }if ($KDP_ID !=''){  
                                    $querydeletekdp= "DELETE from KDP where Aset_ID=$Aset_ID";
                                    $resultdeletekdp = mysql_query($querydeletekdp) or die ('eror delete kdp');

                                    }       
                         
                            //golongan jalan
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
                            
                            
                           if ($Jaringan_ID ==''){
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
                             //   print_r($queryjaringan);                    
                                $resultjaringan = mysql_query($queryjaringan) or die ('error Update Jaringan');
                                ($resultjaringan) ? $jaringan_id = $jaringan_id : $jaringan_id = 'NULL';
                            }
                            
                            $flag = 4;
                            $TipeAset="D";
                        }
                        break;
                    case '03':
                        {           if ($Tanah_ID !=''){  
                                    $querydeletetanah = "DELETE from Tanah where Aset_ID=$Aset_ID";
                                    $resultdeletetanah = mysql_query($querydeletetanah ) or die ('eror delete tanah');

                                    }if ($Mesin_ID !=''){  
                                    $querydeletemesin = "DELETE from Mesin where Aset_ID=$Aset_ID";
                                    $resultdeletemesin = mysql_query($querydeletemesin ) or die ('eror delete mesin');

                                    }if ($Jaringan_ID !=''){  
                                    $querydeletejaringan= "DELETE from Jaringan where Aset_ID=$Aset_ID";
                                    $resultdeletejaringan = mysql_query($querydeletejaringan) or die ('eror delete jaringan');

                                    }if ($AsetLain_ID !=''){  
                                    $querydeleteasetlain= "DELETE from AsetLain where Aset_ID=$Aset_ID";
                                    $resultdeleteasetlain = mysql_query($querydeleteasetlain) or die ('eror delete asetlain');

                                    }if ($KDP_ID !=''){  
                                    $querydeletekdp= "DELETE from KDP where Aset_ID=$Aset_ID";
                                    $resultdeletekdp = mysql_query($querydeletekdp) or die ('eror delete kdp');

                                    }       
                        
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
                            $dateasd = explode('/', $p_gdg_tgldokume); ///
                            $p_gdg_tgldokumen = $dateasd[2].$dateasd[1].$dateasd[0];   
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
                            
                            if($Bangunan_ID ==''){
                                
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
                                                KelompokTanah_ID = '$p_gdg_kodetanah',Tanah_ID='$p_gdg_kodetanah', NoIMB = '$p_gdg_no_imb',TglIMB = '$p_gdg_tglimb'
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
                              if ($Tanah_ID !=''){  
                                    $querydeletetanah = "DELETE from Tanah where Aset_ID=$Aset_ID";
                                    $resultdeletetanah = mysql_query($querydeletetanah ) or die ('eror delete tanah');

                                    }if ($Mesin_ID !=''){  
                                    $querydeletemesin = "DELETE from Mesin where Aset_ID=$Aset_ID";
                                    $resultdeletemesin = mysql_query($querydeletemesin ) or die ('eror delete mesin');

                                    }if ($Bangunan_ID !=''){  
                                    $querydeletebangunan = "DELETE from Bangunan where Aset_ID=$Aset_ID";
                                    $resultdeletebangunan = mysql_query($querydeletebangunan) or die ('eror delete bangunan');

                                    }if ($Jaringan_ID !=''){  
                                    $querydeletejaringan= "DELETE from Jaringan where Aset_ID=$Aset_ID";
                                    $resultdeletejaringan = mysql_query($querydeletejaringan) or die ('eror delete jaringan');

                                    }if ($KDP_ID !=''){  
                                    $querydeletekdp= "DELETE from KDP where Aset_ID=$Aset_ID";
                                    $resultdeletekdp = mysql_query($querydeletekdp) or die ('eror delete kdp');

                                    }       
                        
                        
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
                                        
                                        if ($Tanah_ID ==''){
                                            
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
                                        //    print_r($queryasetlainupdate);  
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
                            if ($Tanah_ID !=''){  
                                    $querydeletetanah = "DELETE from Tanah where Aset_ID=$Aset_ID";
                                    $resultdeletetanah= mysql_query($querydeletetanah ) or die ('eror delete tanah');

                                    }if ($Mesin_ID !=''){  
                                    $querydeletemesin = "DELETE from Mesin where Aset_ID=$Aset_ID";
                                    $resultdeletemesin = mysql_query($querydeletemesin ) or die ('eror delete mesin');

                                    }if ($Bangunan_ID !=''){  
                                    $querydeletebangunan = "DELETE from Bangunan where Aset_ID=$Aset_ID";
                                    $resultdeletebangunan = mysql_query($querydeletebangunan) or die ('eror delete bangunan');

                                    }if ($Jaringan_ID !=''){  
                                    $querydeletejaringan= "DELETE from Jaringan where Aset_ID=$Aset_ID";
                                    $resultdeletejaringan = mysql_query($querydeletejaringan) or die ('eror delete jaringan');

                                    }if ($AsetLain_ID !=''){  
                                    $querydeleteasetlain= "DELETE from Jaringan where Aset_ID=$Aset_ID";
                                    $resultdeleteasetlain = mysql_query($querydeleteasetlain) or die ('eror delete asetlain');

                                    }if ($KDP_ID !=''){  
                                    $querykdpid= "DELETE from KDP where Aset_ID=$Aset_ID";
                                    $resultdeletekdp= mysql_query($querykdpid) or die ('eror delete kdp');
                                    }                                                              
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
                            
                            
                            if($KDP_ID ==''){
                                
                                $Get_KDP_ID=  get_auto_increment("KDP");
                                $querykdp =  "INSERT INTO KDP(KDP_ID,Konstruksi,Aset_ID,Beton,JumlahLantai,LuasLantai,TglMulai,StatusTanah,
                                                KelompokTanah_ID,Tanah_ID) VALUES($Get_KDP_ID, '$p_gjal_konstruksi','$Aset_ID','$p_gjal_konstruksi1','$p_gjal_panjang',
                                                '$p_gol6_luas_lantai','$tanggal_pembangunan','$p_gol6_statustanah','$p_gol6_pilih_asettanah','$p_gol6_nomor_kodetanah')";
                              //  print_r($querykdp);
                                $resultkdp = mysql_query($querykdp) or die ('eror insert KDP');
                                ($resultkdp) ? $KDP_ID = $Get_KDP_ID : $KDP_ID = $KDP_ID;
                            }
                            else
                            {
                                $querykdp ="UPDATE KDP SET Konstruksi = '$p_gjal_konstruksi',Beton = '$p_gjal_konstruksi1',
                                                JumlahLantai = '$p_gjal_panjang',LuasLantai = '$p_gol6_luas_lantai',
                                                TglMulai = '$tanggal_pembangunan',StatusTanah = '$p_gol6_statustanah',
                                                KelompokTanah_ID = '$p_gol6_pilih_asettanah', Tanah_ID='$p_gol6_nomor_kodetanah'
                                                WHERE KDP_ID = $KDP_ID AND Aset_ID = $Aset_ID";
                                $resultkdp = mysql_query($querykdp) or die ('eror Update KDP');
                                ($resultkdp) ? $kdp_id = $kdp_id : $kdp_id = 'NULL';
                            }
                            
                            $flag = 6;
                            $TipeAset="F";
        
                        }
                        break;
                    case '07':
                        {       if ($Tanah_ID !=''){  
                                    $querydeletetanah = "DELETE from Tanah where Aset_ID=$Aset_ID";
                                    $resultdeletetanah = mysql_query($querydeletetanah ) or die ('eror delete tanah');

                                    }if ($Mesin_ID !=''){  
                                    $querydeletemesin = "DELETE from Mesin where Aset_ID=$Aset_ID";
                                    $resultdeletemesin = mysql_query($querydeletemesin ) or die ('eror delete mesin');

                                    }if ($Bangunan_ID !=''){  
                                    $querydeletebangunan = "DELETE from Bangunan where Aset_ID=$Aset_ID";
                                    $resultdeletebangunan = mysql_query($querydeletebangunan) or die ('eror delete bangunan');

                                    }if ($Jaringan_ID !=''){  
                                    $querydeletejaringan= "DELETE from Jaringan where Aset_ID=$Aset_ID";
                                    $resultdeletejaringan = mysql_query($querydeletejaringan) or die ('eror delete jaringan');

                                    }if ($AsetLain_ID !=''){  
                                    $querydeleteasetlain= "DELETE from AsetLain where Aset_ID=$Aset_ID";
                                    $resultdeleteasetlain = mysql_query($querydeleteasetlain) or die ('eror delete asetlain');

                                    }if ($KDP_ID !=''){  
                                    $querydeletekdp= "DELETE from KDP where Aset_ID=$Aset_ID";
                                    $resultdeletekdp = mysql_query($querydeletekdp) or die ('eror delete kdp');

                                    }       
                        
                            $p_gol7_kuantitas=$_POST['p_gol7_kuantitas'];
                            $p_gol7_satuan=$_POST['p_gol7_satuan'];
                            
                            $queryaset ="UPDATE Aset SET Kuantitas = '$p_gol7_kuantitas',Satuan = '$p_gol7_satuan' WHERE Aset_ID = $Aset_ID";
                            $resultaset=  mysql_query($queryaset)or die ('eror 17');
                            $flag = 7;
                        }
                        break;
                    
                    
                    
                }
                
                    $Aset_ID=$_POST['Aset_ID'];  
                $queryaset="    UPDATE Aset SET
                                             TipeAset='$TipeAset' where Aset_ID='$Aset_ID'
                                             ";
                  $resulAset = mysql_query($queryaset) or die ('error aset');
                // query ke tabel kelompok dulu untuk mendapatkan golongan sebelum melakukan insert data

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
         echo "<script>alert('Data Sudah Disimpan !!!'); document.location='entri/entri_hasil_inventarisasi.php';</script>"; 
        //echo 'data sudah masuk';
    /*    
    }
    else
    {
       echo '<script type=text/javascript>alert("Silahkan masukan data Kelompok, Aset, Golongan, lokasi dan "); history.back(); </script>';
    }
    */
  
}



