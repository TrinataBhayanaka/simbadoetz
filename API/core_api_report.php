<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of core_report
 *
 * @author andreas
 */
class core_api_report extends DB {
     //put your code here
     var $kategori_report=0;
     //1 == Create report on the fly
     //2 == Create cache report and save to destination directory
     //3 == Create report with crontab
     var $query_report;
      
     //paramater query
     var $modul;
     var $mode;
     var $kib;
     var $tab;
     var $tahun;
     var $skpd_id;
     var $tglperolehan;
	 var $tgltransfer;
	 var $tglpemeliharaan;
     //var $kelompok = array();
	 var $lokasi;
     var $tglawalperolehan;
     var $tglakhirperolehan;		   
	 var $tglawaltransfer;
     var $tglakhirtransfer;
	 var $tglawalpemeliharaan;
     var $tglakhirpemeliharaan;
	 var $tahun_prc;
	 var $tgl_update;
	 var $status_prc;
	 var $nama_satker;
	 var $aset_id;
	 var $ngo_id;
	 var $no_kontrak;
	 var $penanda;
     
	 
	 
     
     
     //akhir paramater query
     
     // add by ovan 
     
     
     protected $KODE_KABUPATEN;
	 protected $KODE_PROVINSI;
	 protected $NAMA_KABUPATEN;
	 protected $NAMA_PROVINSI;
	 protected $ASALUSUL;
	 protected $FILE_GAMBAR_HEADER;
	 protected $path;
     protected $url_rewrite;
     var $config;
	 
     public function __construct()
     {
		 global $NAMA_KABUPATEN;
		 global $NAMA_PROVINSI;
		 global $KODE_KABUPATEN;
		 global $KODE_PROVINSI;
		 global $path;
		 global $url_rewrite;
		 global $CONFIG;
		 
		 $this->NAMA_KABUPATEN = $NAMA_KABUPATEN;
		 $this->NAMA_PROVINSI = $NAMA_PROVINSI;
		 $this->KODE_KABUPATEN = $KODE_KABUPATEN;
		 $this->KODE_PROVINSI = $KODE_PROVINSI;
		 $this->path = $path;
		 $this->url_rewrite = $url_rewrite_report;
		 $this->config = $CONFIG['default']['config'];
		
	 }
   
     //set akses via http
     public function set_data($data){
          //function untuk set dataa
          $hasil_data=$data;//nanti diganti
		  
		  
		  $this->modul=$hasil_data['modul'];
		  $this->mode=$hasil_data['mode'];
		  $this->kib=$hasil_data['kib'];
		  $this->tahun=$hasil_data['tahun'];
		  $this->skpd_id =$hasil_data['skpd_id'];
		  $this->kelompok=$hasil_data['kelompok'];
		  $this->lokasi=$hasil_data['lokasi'];
		  $this->tahun_prc=$hasil_data['tahun_prc'];
		  $this->tgl_update=$hasil_data['tgl_update'];
		  $this->tab=$hasil_data['tab'];
		  
		  $this->tglperolehan =$hasil_data['tglperolehan'];
		  $this->tgltransfer=$hasil_data['tgltransfer'];
		  $this->tglpemeliharaan=$hasil_data['tglpemeliharaan'];
	  
		   $this->tglawalperolehan=$hasil_data['tglawalperolehan'];
		   $this->tglakhirperolehan=$hasil_data['tglakhirperolehan'];
		   
		   $this->tglawaltransfer=$hasil_data['tglawaltransfer'];
		   $this->tglakhirtransfer=$hasil_data['tglakhirtransfer'];
		   
		   $this->tglawalpemeliharaan=$hasil_data['tglawalpemeliharaan'];
		   $this->tglakhirpemeliharaan=$hasil_data['tglakhirpemeliharaan'];
		   $this->status_prc=$hasil_data['status_prc'];
          $this->aset_id = $hasil_data['aset_id'];
		  $this->ngo_id = $hasil_data['ngo_id'];
		  $this->nama_aset = $hasil_data['nama_aset'];
		  $this->no_kontrak = $hasil_data['no_kontrak'];
		  $this->penanda=$hasil_data['penanda'];
         
          
          
     }
 
	 //===============================
     public function list_query(){
          
          //echo 'path = '.$this->path;
		  
          $modul=$this->modul;
          $mode=$this->mode;
          $kib=$this->kib;
          $tahun=$this->tahun;
          $skpd_id=$this->skpd_id;
          $kelompok=$this->kelompok;
		  $lokasi=$this->lokasi;
		  $tahun_prc=$this->tahun_prc;
		  $tgl_update=$this->tgl_update;
          $tab=$this->tab;
          $penanda=$this->penanda;
          $tglperolehan=$this->tglperolehan;
		  $tgltransfer=$this->tgltransfer;
		  $tglpemeliharaan=$this->tglpemeliharaan;
               $tglawalperolehan=$this->tglawalperolehan;
               $tglakhirperolehan=$this->tglakhirperolehan;
			   $tglawaltransfer=$this->tglawaltransfer;
			   $tglakhirtransfer=$this->tglakhirtransfer;
			   $tglawalpemeliharaan=$this->tglawalpemeliharaan;
			   $tglakhirpemeliharaan=$this->tglakhirpemeliharaan;
			   
			   $aset_id=$this->aset_id;
			   $ngo_id=$this->ngo_id;
			   $nama_aset=$this->nama_aset;
			   $no_kontrak=$this->no_kontrak;
		  
          
			
		//==============================================================	
		  if ($tahun!=""){
				$query_tahun=" A.Tahun='$tahun' ";
            }
			if ($tahun_prc!=""){
				$query_tahun_prc=" PRC.Tahun='$tahun_prc' ";
			}
			 /* if($skpd_id!=""){
				$query_skpd=" A.LastSatker_ID='$skpd_id!' ";
            }
			*/
			//buat tgl update
         if($tgl_update!=""){
				$query_tgl_update=" STD.TglUpdate like '$tgl_update%' ";
            }
			
			
			
						
			if($skpd_id!=""){
				// echo "skpd masukk";
				$status_prc=$this->status_prc;
                    $temp=explode(",",$skpd_id);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="S.Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or S.Satker_ID ='$temp[$i]'";
                        }


                $query_change_satker="SELECT KodeSektor,KodeSatker,KodeUnit,Gudang,NamaSatker FROM Satker as S 
                                                    WHERE $query_satker";
                // print_r($query_change_satker);
                $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    // pr($proses_kode);
					// $dataRow[]=$proses_kode;

                    /*if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                    $query_return_kode="SELECT Satker_ID FROM Satker as S WHERE (KodeSatker='".$proses_kode['KodeSektor']."' OR KodeSatker='$proses_kode[KodeSatker]')";
                    }
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                        $query_return_kode="SELECT Satker_ID FROM Satker as S WHERE KodeSektor='".$proses_kode['KodeSektor']."'";
                    }*/
					if($proses_kode['KodeSektor'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != "" && $proses_kode['Gudang'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "' AND
													Gudang='" . $proses_kode['Gudang'] . "'";
					}
					
					// pr($query_return_kode);
                    //ini dari ka andreas
                    $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Satker_ID'];
                    }

                    if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    $query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                {
									if($status_prc==1)
									{
										$query_satker_fix.="PRC.Satker_ID = '".$dataRow2[$i]."'";
										//echo $query_satker_fix;
										//echo "tes1";
									}
									else 
									{
										$query_satker_fix.="A.LastSatker_ID= '".$dataRow2[$i]."'";
										//echo $query_satker_fix;
										//echo "tes";
									}
                                // $query_satker_fix.="A.LastSatker_ID = '".$dataRow2[$i]."'";
								}
                                else
                                {
									if($status_prc==1)
									{
										$query_satker_fix.=" or PRC.Satker_ID = '".$dataRow2[$i]."'";
										//echo $query_satker_fix;
									}
									else 
									{
										$query_satker_fix.="or A.LastSatker_ID = '".$dataRow2[$i]."'";
										//echo "ada";//echo $query_satker_fix;
									}
                                // $query_satker_fix.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
								}
						}
                        if ($cek==1){
							
                            $query_satker_fix.=")";
							$data_satker = $dataRow2;
                        }
                        else{
                            $query_satker_fix="";
							$data_satker = $dataRow2;
                        }
                    }
                }
            }
			
			//echo '<br>'.$query_satker_fix;
          /*if($kelompok!=""){
                $query_kelompok=" K.Kelompok_ID='$kelompok' ";
            }
			*/
			
			
			//echo '</pre>';
			if($kelompok!=""){
                    $temp=explode(",",$kelompok);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_kelompok.="K.Kelompok_ID ='$temp[$i]'";
                                else
                                $query_kelompok.=" or K.Kelompok_ID ='$temp[$i]'";
                        }
                $query_change_satker="SELECT Kode FROM Kelompok as K
                                                    WHERE $query_kelompok";
                $exec_query_change_satker=$this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){

                    
                    if($proses_kode['Kode']!=""){
		        $query_return_kode="SELECT Kelompok_ID FROM Kelompok as K
			WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                    }
                    //echo "<pre>";
                    //print_r($query_return_kode);
                    //echo "</pre>";

                    
                    $exec_query_return_kode=$this->query($query_return_kode);
                    
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Kelompok_ID'];
                }

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    $query_kelompok_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_kelompok_fix.="K.Kelompok_ID = '".$dataRow2[$i]."'";
                                else
                                $query_kelompok_fix.=" or K.Kelompok_ID = '".$dataRow2[$i]."'";
                        }
                        if ($cek==1){
                            $query_kelompok_fix.=")";}
                        else{
                            $query_kelompok_fix="";}
                    }
                }
            }
            //===========================================
			
          if ($aset_id!=""){
				$query_aset_id=" A.Aset_ID='$aset_id' ";
            }
		  if ($nama_aset!=""){
				$query_nama_aset=" A.NamaAset='$nama_aset' ";
            }
			/*
		 if ($no_kontrak!=""){
				$query_no_kontrak=" KTR.NoKontrak='$no_kontrak' ";
            }
		  */
		  if($no_kontrak!=""){
		    $query = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE NoKontrak LIKE '%$ka_no_kontrak%'";
		    //print_r($query);
		    $result = $DBVAR->query($query) or die ($DBVAR->error());
		    if ($DBVAR->num_rows($result))
		    { 
			while ($data = $DBVAR->fetch_object($result))
			{
			    $dataAsetID[] = $data->Aset_ID;
			}
			
			$dataImplode = implode(',',$dataAsetID);
		    }
		    
		    $query_ka_no_kontrak ="Aset_ID IN ($dataImplode)";
			}
		
		  if($lokasi!=""){
                    $temp=explode(",",$lokasi);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_lokasi.="L.Lokasi_ID ='$temp[$i]'";
                                else
                                $query_lokasi.=" or L.Lokasi_ID ='$temp[$i]'";
                        }


                $query_change_satker="SELECT KodeLokasi FROM Lokasi as L
                                                    WHERE $query_lokasi";
                $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){

                    
                    if($proses_kode['KodeLokasi']!=""){
                    $query_return_kode="SELECT Lokasi_ID FROM Lokasi as L WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }
                    //echo "<pre>";
                    //print_r($query_return_kode);
                    //echo "</pre>";
                    
                    $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                    
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Lokasi_ID'];
                    }

                    if($dataRow2!=""){
                        $panjang=count($dataRow2);
                        $query_lokasi_fix="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_lokasi_fix.="L.Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_lokasi_fix.=" or L.Lokasi_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_lokasi_fix.=")";}
                            else{
                                $query_lokasi_fix="";}
                        }
                    }
                }
				
		  /*
		  if ($lokasi!=""){
				$query_lokasi=" L.Lokasi_ID='$lokasi' ";
            }
			*/
			
          if ($ngo_id!=""){
		  
				$query_ngo=" S.LastSatker_ID IN ('$ngo_id') ";
            }
          if ($tglperolehan!=""){
				$query_tglperolehan=" A.TglPerolehan='$tglperolehan' ";
            }
			if ($tglawalperolehan !=""){
				 $p_awal ="A.TglPerolehan >= '$tglawalperolehan'";
			 }
			 if ($tglakhirperolehan !=""){
				 $p_akhir ="A.TglPerolehan <= '$tglakhirperolehan'";
			 }
			 
          if ($tgltransfer!=""){
				$query_tgltransfer=" TR.TglTransfer='$tgltransfer' ";
            }
            
               if ($tglawaltransfer !=""){
				 $q_awal ="TR.TglTransfer >= '$tglawaltransfer'";
			 }
			 if ($tglakhirtransfer !=""){
				 $q_akhir ="TR.TglTransfer <= '$tglakhirtransfer'";
			 }
			 
			 if ($tglpemeliharaan!=""){
				$query_tgltransfer=" PML.TglPemeliharaan='$tglpemeliharaan' ";
            }
            
               if ($tglawalpemeliharaan !=""){
				 $r_awal ="PML.TglPemeliharaan >= '$tglawalpemeliharaan'";
			 }
			 if ($tglakhirpemeliharaan !=""){
				 $r_akhir ="PML.TglPemeliharaan <= '$tglakhirpemeliharaan'";
			 }
			 
			//==============================================================
            $parameter_sql="";
            if($tahun!=""){
            $parameter_sql=$query_tahun;
            }
            if($skpd_id!="" && $parameter_sql!=""){
			$parameter_sql=$parameter_sql." AND ".$query_satker_fix;
            }
			if($skpd_id!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix;
            }
			if($tahun_prc!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tahun_prc;
            }
            
            if($tahun_prc!="" && $parameter_sql==""){
            $parameter_sql=$query_tahun_prc;
			}
			
			if($tgl_update!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_update;
            }
            
            if($tgl_update!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_update;
			}
			
			
            if($skpd_id!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix;
            }
            if($kelompok!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
            }
            if ($kelompok!="" && $parameter_sql==""){
            $parameter_sql=$query_kelompok_fix;
            } 
            if($aset_id!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_aset_id;
            }
            if($aset_id!="" && $parameter_sql==""){
            $parameter_sql=$query_aset_id;
            }
            if($nama_aset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nama_aset;
            }
            if ($nama_aset!="" && $parameter_sql==""){
            $parameter_sql=$query_nama_aset;
            } 
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
            }
            if($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix;
            }
            if($ngo!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ngo;
            }
            if($ngo!="" && $parameter_sql==""){
            $parameter_sql=$query_ngo;
            }
            if($tglperolehan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tglperolehan;
            }
            if($tglperolehan!="" && $parameter_sql==""){
            $parameter_sql=$query_tglperolehan;
            }
			
			 if($tglawalperolehan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$p_awal;
            }
            if($tglakhirperolehan!="" && $parameter_sql==""){
            $parameter_sql=$p_awal;
            }
            
            if($tglakhirperolehan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$p_akhir;
            }
            if($tglakhirperolehan!="" && $parameter_sql==""){
            $parameter_sql=$p_akhir;
            }
			
			
            if($tgltransfer!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgltransfer;
            }
            if($tgltransfer!="" && $parameter_sql==""){
            $parameter_sql=$query_tgltransfer;
            }
            
             if($tglawaltransfer!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$q_awal;
            }
            if($tglakhirtransfer!="" && $parameter_sql==""){
            $parameter_sql=$q_awal;
            }
            
            if($tglakhirtransfer!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$q_akhir;
            }
            if($tglakhirtransfer!="" && $parameter_sql==""){
            $parameter_sql=$q_akhir;
            }
			
			if($tglpemeliharaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tglpemeliharaan;
            }
            if($tglpemeliharaan!="" && $parameter_sql==""){
            $parameter_sql=$query_tglpemeliharaan;
            }
            
             if($tglawalpemeliharaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$r_awal;
            }
            if($tglakhirpemeliharaan!="" && $parameter_sql==""){
            $parameter_sql=$r_awal;
            }
            
            if($tglakhirpemeliharaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$r_akhir;
            }
            if($tglakhirpemeliharaan!="" && $parameter_sql==""){
            $parameter_sql=$r_akhir;
            }
            $limit="";
			$TAMBAHAN_QUERY_KIB="  A.Status_Validasi_Barang=1 ";
            // echo $parameter_sql;
            //==============================================================
			//==============================================================
     
            //ok
           $Modul_1_Mode_1_Case_a_condition = "select A.Aset_ID, A.Lokasi_ID,A.LastSatker_ID,  A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Alamat, A.Info, A.TglPerolehan,A.Tahun,A.AsalUsul, 
									T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,  
									S.KodeSatker,S.Satker_ID, S.KodeUnit,S.NamaSatker,
									K.Kode, K.Uraian, K.Satuan   
									from Aset A 
									LEFT JOIN Tanah T on A.Aset_ID=T.Aset_ID 
									JOIN Satker S on A.LastSatker_ID=S.Satker_ID 
									JOIN Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
									where A.TipeAset = 'A' and $TAMBAHAN_QUERY_KIB AND $parameter_sql 
									ORDER BY S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
                                    //echo"<pre>";
                                    //echo"$Modul_1_Mode_1_Case_a_condition";
                                    //echo"</pre>";
          //ok
           $Modul_1_Mode_1_Case_a_default = "select A.Aset_ID, A.Lokasi_ID,A.LastSatker_ID,  A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Alamat, A.Info, A.TglPerolehan,A.Tahun,A.AsalUsul, 
									T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,  
									S.KodeSatker,S.Satker_ID, S.KodeUnit,S.NamaSatker,
									K.Kode, K.Uraian, K.Satuan   
									from Aset A 
									LEFT JOIN Tanah T on A.Aset_ID=T.Aset_ID 
									JOIN Satker S on A.LastSatker_ID=S.Satker_ID 
									JOIN Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
									where A.TipeAset = 'A' AND $TAMBAHAN_QUERY_KIB
                                    ORDER BY S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg  $limit";
           //ok
          $Modul_1_Mode_1_Case_b_condition = "select A.Aset_ID,A.LastSatker_ID,A.Lokasi_ID,A.NomorReg,A.NamaAset,A.NilaiPerolehan,A.Info,A.Tahun,A.AsalUsul, 
											M.Merk,M.Ukuran,M.Material,M.NoSeri,M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,  
											S.KodeSatker,S.Satker_ID,S.KodeUnit,S.NamaSatker,
											K.Kode,K.Uraian,K.Satuan
											from Aset A 
											left join Mesin M on A.Aset_ID=M.Aset_ID
											inner join Satker S on A.LastSatker_ID=S.Satker_ID 
											inner join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
											where A.TipeAset='B' AND $TAMBAHAN_QUERY_KIB  AND $parameter_sql order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_b_default = "select A.Aset_ID,A.LastSatker_ID,A.Lokasi_ID,A.NomorReg,A.NamaAset,A.NilaiPerolehan,A.Info,A.Tahun,A.AsalUsul, 
											M.Merk,M.Ukuran,M.Material,M.NoSeri,M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,  
											S.KodeSatker,S.Satker_ID,S.KodeUnit,S.NamaSatker,
											K.Kode,K.Uraian,K.Satuan
											from Aset A 
											left join Mesin M on A.Aset_ID=M.Aset_ID
											inner join Satker S on A.LastSatker_ID=S.Satker_ID 
											inner join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
											where A.TipeAset='B' AND $TAMBAHAN_QUERY_KIB order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_c_condition = "select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID,A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Info, A.Tahun,A.AsalUsul, A.Alamat, 
                                            B.JumlahLantai, B.Beton, B.LuasLantai,B.NoIMB,B.TglIMB,B.StatusTanah,  
                                            S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker, 
                                            K.Kode, K.Uraian, K.Satuan, 
                                            KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, 
                                            T.LuasTotal 
                                            from Aset A 
                                            left join Bangunan B on A.Aset_ID=B.Aset_ID
                                            join Satker S on A.LastSatker_ID=S.Satker_ID
                                            join Satker C on C.KodeSektor=S.KodeSektor and C.KodeSatker=S.KodeSatker and C.KodeUnit is null
                                            join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
                                            left join Kondisi KDS on A.Aset_ID=KDS.Aset_ID
                                            left join Tanah T on A.Aset_ID=T.Aset_ID
                                            left join Tanah Z on B.Aset_ID=Z.Aset_ID 
                                            where  A.TipeAset='C' AND $TAMBAHAN_QUERY_KIB AND $parameter_sql  order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_c_default = "select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID,A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Info, A.Tahun,A.AsalUsul, A.Alamat, 
                                            B.JumlahLantai, B.Beton, B.LuasLantai,B.NoIMB,B.TglIMB,B.StatusTanah,  
                                            S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker, 
                                            K.Kode, K.Uraian, K.Satuan, 
                                            KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, 
                                            T.LuasTotal 
                                            from Aset A 
                                            left join Bangunan B on A.Aset_ID=B.Aset_ID
                                            join Satker S on A.LastSatker_ID=S.Satker_ID
                                            join Satker C on C.KodeSektor=S.KodeSektor and C.KodeSatker=S.KodeSatker and C.KodeUnit is null
                                            join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
                                            left join Kondisi KDS on A.Aset_ID=KDS.Aset_ID
                                            left join Tanah T on A.Aset_ID=T.Aset_ID
                                            left join Tanah Z on B.Aset_ID=Z.Aset_ID
                                            where  A.TipeAset='C' AND $TAMBAHAN_QUERY_KIB order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_d_condition = "select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID, A.NamaAset,A.NomorReg,A.AsalUsul,A.NilaiPerolehan, A.Info,A.Alamat, 
                                            J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,  
                                            S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
                                            K.Kode, K.Uraian, K.Satuan,
                                            KDS.Baik, KDS.RusakRingan, KDS.RusakBerat,
                                            T.LuasTotal
                                            from  Aset as A  
                                            left join Jaringan J on A.Aset_ID=J.Aset_ID
                                            join Satker S on A.LastSatker_ID=S.Satker_ID
                                            join Satker C on C.KodeSektor=S.KodeSektor and C.KodeSatker=S.KodeSatker and C.KodeUnit is null
				            left join Kondisi KDS on A.Aset_ID=KDS.Aset_ID
                                            join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
                                            left join Tanah T on A.Aset_ID=T.Aset_ID 
                                            where A.TipeAset='D' AND $TAMBAHAN_QUERY_KIB AND $parameter_sql order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_d_default = "select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID, A.NamaAset,A.NomorReg,A.AsalUsul,A.NilaiPerolehan, A.Info,A.Alamat, 
                                            J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,  
                                            S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
                                            K.Kode, K.Uraian, K.Satuan,
                                            KDS.Baik, KDS.RusakRingan, KDS.RusakBerat,
                                            T.LuasTotal
                                            from  Aset as A  
                                            left join Jaringan J on A.Aset_ID=J.Aset_ID
                                            join Satker S on A.LastSatker_ID=S.Satker_ID
                                            join Satker C on C.KodeSektor=S.KodeSektor and C.KodeSatker=S.KodeSatker and C.KodeUnit is null
					    left join Kondisi KDS on A.Aset_ID=KDS.Aset_ID
                                            join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
                                            left join Tanah T on A.Aset_ID=T.Aset_ID
                                            where A.TipeAset='D' order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_e_condition = "select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID, A.NamaAset, A.AsalUsul, A.NilaiPerolehan,A.Tahun, A.Info,A.NomorReg,A.TglPerolehan,A.Kuantitas,   
                                              AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
                                              S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
                                              K.Kode, K.Uraian, K.Satuan 
                                              from  Aset A
                                              left join AsetLain AL on A.Aset_ID=AL.Aset_ID
                                              join Satker S on A.LastSatker_ID=S.Satker_ID
                                              join Satker C on C.KodeSektor=S.KodeSektor and C.KodeSatker=S.KodeSatker and C.KodeUnit is null
                                              join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
                                              where A.TipeAset='E' AND $TAMBAHAN_QUERY_KIB AND $parameter_sql 
                                             ORDER BY S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_e_default = "select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID, A.NamaAset, A.AsalUsul, A.NilaiPerolehan,A.Tahun, A.Info,A.NomorReg,A.TglPerolehan,A.Kuantitas,   
                                              AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
                                              S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
                                              K.Kode, K.Uraian, K.Satuan 
                                              from  Aset A
                                              left join AsetLain AL on A.Aset_ID=AL.Aset_ID
                                              join Satker S on A.LastSatker_ID=S.Satker_ID
                                              join Satker C on C.KodeSektor=S.KodeSektor and C.KodeSatker=S.KodeSatker and C.KodeUnit is null
                                              join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
                                              where A.TipeAset='E' AND $TAMBAHAN_QUERY_KIB
                                             ORDER BY S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";

          //ok
          $Modul_1_Mode_1_Case_f_condition = "select A.Aset_ID,A.LastSatker_ID,A.Lokasi_ID,A.NamaAset,A.Alamat,A.SumberDana,A.NilaiPerolehan,A.Info,A.Tahun,RTRW,A.NomorReg,
                                              KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
                                              S.KodeSatker,S.Satker_ID,S.KodeUnit,S.NamaSatker,
                                              K.Kode,K.Uraian,K.Satuan,
                                              KTRA.Kontrak_ID,
                                              KTR.NilaiKontrak 
                                              from Aset A
                                              left join KDP KDPA on A.Aset_ID=KDPA.Aset_ID
                                              join Satker S on A.LastSatker_ID=S.Satker_ID 
                                              join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
                                              left join KontrakAset KTRA on A.Aset_ID=KTRA.Aset_ID
                                              left join Kontrak KTR on KTR.Kontrak_ID=KTRA.Kontrak_ID 
                                              where A.TipeAset = 'F' AND $TAMBAHAN_QUERY_KIB AND $parameter_sql 
                                              ORDER BY S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
          //ok
          $Modul_1_Mode_1_Case_f_default = "select A.Aset_ID,A.LastSatker_ID,A.Lokasi_ID,A.NamaAset,A.Alamat,A.SumberDana,A.NilaiPerolehan,A.Info,A.Tahun,RTRW,A.NomorReg,
                                              KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
                                              S.KodeSatker,S.Satker_ID,S.KodeUnit,S.NamaSatker,
                                              K.Kode,K.Uraian,K.Satuan,
                                              KTRA.Kontrak_ID,
                                              KTR.NilaiKontrak 
                                              from Aset A
                                              left join KDP KDPA on A.Aset_ID=KDPA.Aset_ID
                                              join Satker S on A.LastSatker_ID=S.Satker_ID 
                                              join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
                                              left join KontrakAset KTRA on A.Aset_ID=KTRA.Aset_ID
                                              left join Kontrak KTR on KTR.Kontrak_ID=KTRA.Kontrak_ID 
                                              where A.TipeAset = 'F' AND $TAMBAHAN_QUERY_KIB
                                              ORDER BY S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
											  
			
			//Cetak Dokumen Inventaris-KIR
		  $query_kir_condition = "select A.Aset_ID,A.LastSatker_ID, A.Ruangan, A.NamaAset,A.Tahun,M.Merk, M.NoSeri, M.Ukuran, M.Material, M.TahunBuat, A.Kuantitas, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, A.NilaiPerolehan, A.Info, A.Ruangan,
								S.KodeSatker, S.Satker_ID, S.KodeUnit, S.NamaSatker,
								K.Kode, K.Uraian, K.Satuan
								from Aset A
								left join Mesin M on A.Aset_ID=M.Aset_ID
								join Satker S on A.LastSatker_ID=S.Satker_ID
								join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
								left join Kondisi KDS on A.Aset_ID=KDS.Aset_ID
								where (A.Ruangan IS NOT NULL OR A.Ruangan!='') AND K.Golongan ='02' AND $TAMBAHAN_QUERY_KIB AND $parameter_sql group by A.NamaAset
								order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";



		 $query_kir_default = "select A.Aset_ID,A.LastSatker_ID, A.Ruangan, A.NamaAset,A.Tahun, M.Merk, M.NoSeri, M.Ukuran, M.Material, M.TahunBuat, A.Kuantitas, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, A.NilaiPerolehan, A.Info, A.Ruangan,
							S.KodeSatker, S.Satker_ID, S.KodeUnit, S.NamaSatker,
							K.Kode, K.Uraian, K.Satuan
							from Aset A
							left join Mesin M on A.Aset_ID=M.Aset_ID
							join Satker S on A.LastSatker_ID=S.Satker_ID
							join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
							left join Kondisi KDS on A.Aset_ID=KDS.Aset_ID
							where (A.Ruangan IS NOT NULL OR A.Ruangan!='') AND K.Golongan ='02' AND  $TAMBAHAN_QUERY_KIB group by A.NamaAset
							order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";

          
		  //Buku Inventaris
          $query_buku_inventaris_condition =  "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan,A.AsalUsul, 
									A.Alamat, A.Kuantitas, A.TipeAset, A.Tahun, S.KodeSatker, S.NamaSatker, S.Satker_ID, S.KodeUnit,
									K.Kode, K.Uraian, K.Satuan, B.Konstruksi, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk, M.Model, 
									M.NoRangka, M.NoMesin, M.NoBPKB, M.Material from Aset A 
									left join Mesin M on A.Aset_ID=M.Aset_ID 
									left join Bangunan B on A.Aset_ID=B.Aset_ID
									left join Tanah T on A.Aset_ID=T.Aset_ID
									left join Jaringan J on A.Aset_ID=J.Aset_ID
									left join AsetLain AL on A.Aset_ID=AL.Aset_ID
									left join KDP KDP on A.Aset_ID=KDP.Aset_ID
									join Satker S on A.LastSatker_ID=S.Satker_ID 
									left join Kondisi KDS on KDS.Kondisi_ID=A.LastKondisi_ID 
									join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
									where $TAMBAHAN_QUERY_KIB AND $parameter_sql order by A.LastSatker_ID, K.Kode $limit";

          $query_buku_inventaris_default = "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan,A.AsalUsul, 
											A.Alamat, A.Kuantitas, A.TipeAset, A.Tahun, S.KodeSatker, S.NamaSatker, S.Satker_ID, S.KodeUnit,
											K.Kode, K.Uraian, K.Satuan, B.Konstruksi, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk, M.Model, 
											M.NoRangka, M.NoMesin, M.NoBPKB, M.Material from Aset A 
											left join Mesin M on A.Aset_ID=M.Aset_ID 
											left join Bangunan B on A.Aset_ID=B.Aset_ID
											left join Tanah T on A.Aset_ID=T.Aset_ID
											left join Jaringan J on A.Aset_ID=J.Aset_ID
											left join AsetLain AL on A.Aset_ID=AL.Aset_ID
											left join KDP KDP on A.Aset_ID=KDP.Aset_ID
											join Satker S on A.LastSatker_ID=S.Satker_ID 
											left join Kondisi KDS on KDS.Kondisi_ID=A.LastKondisi_ID 
											join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
											where $TAMBAHAN_QUERY_KIB order by A.LastSatker_ID, K.Kode $limit";
		  
		  //Buku Induk Inventaris Daerah
          $query_buku_induk_inventaris_daerah_condition = "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, 
												A.Alamat, A.Kuantitas, A.TipeAset, A.Tahun, S.KodeSatker, S.NamaSatker, S.Satker_ID, S.KodeUnit,
												K.Kode, K.Uraian, K.Satuan, B.Konstruksi, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk, M.Model, 
												M.NoRangka, M.NoMesin, M.NoBPKB, M.Material from Aset A 
												join Satker S on A.LastSatker_ID=S.Satker_ID 
												left join Mesin M on A.Aset_ID=M.Aset_ID 
												left join Bangunan B on A.Aset_ID=B.Aset_ID
												left join Tanah T on A.Aset_ID=T.Aset_ID
												left join Jaringan J on A.Aset_ID=J.Aset_ID
												left join AsetLain AL on A.Aset_ID=AL.Aset_ID
												left join KDP KDP on A.Aset_ID=KDP.Aset_ID
												left join Kondisi KDS on KDS.Kondisi_ID=A.LastKondisi_ID 
												join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
												where $TAMBAHAN_QUERY_KIB AND $parameter_sql order by A.LastSatker_ID, K.Kode $limit";
          
          $query_buku_induk_inventaris_daerah_default = "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, 
												A.Alamat, A.Kuantitas, A.TipeAset, A.Tahun, S.KodeSatker, S.NamaSatker, S.Satker_ID, S.KodeUnit,
												K.Kode, K.Uraian, K.Satuan, B.Konstruksi, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk, M.Model, 
												M.NoRangka, M.NoMesin, M.NoBPKB, M.Material from Aset A 
												join Satker S on A.LastSatker_ID=S.Satker_ID 
												left join Mesin M on A.Aset_ID=M.Aset_ID 
												left join Bangunan B on A.Aset_ID=B.Aset_ID
												left join Tanah T on A.Aset_ID=T.Aset_ID
												left join Jaringan J on A.Aset_ID=J.Aset_ID
												left join AsetLain AL on A.Aset_ID=AL.Aset_ID
												left join KDP KDP on A.Aset_ID=KDP.Aset_ID
												left join Kondisi KDS on KDS.Kondisi_ID=A.LastKondisi_ID 
												join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
												where $TAMBAHAN_QUERY_KIB order by A.LastSatker_ID, K.Kode $limit";
          
		  //Pengadaaan BMD
		  //REVISI PENGADAAN
          $query_pengadaan_bmd_condition = "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.Kuantitas, A.TglPerolehan,
											A.NilaiPerolehan,A.CaraPerolehan,A.Alamat, A.Info, A.Tahun, CC.KodeSatker, CC.NamaSatker, CC.Satker_ID, CC.KodeUnit,
											D.Kode, D.Uraian, D.Satuan, K.NoKontrak,K.TglKontrak from Aset A
											left join Mesin M on A.Aset_ID=M.Aset_ID 
											left join Bangunan B on A.Aset_ID=B.Aset_ID
											left join Tanah T on A.Aset_ID=T.Aset_ID
											left join Jaringan J on A.Aset_ID=J.Aset_ID
											left join AsetLain AL on A.Aset_ID=AL.Aset_ID
											left join KDP KDP on A.Aset_ID=KDP.Aset_ID 
											join Satker CC on A.LastSatker_ID=CC.Satker_ID 
											join Kelompok D on A.Kelompok_ID=D.Kelompok_ID 
											left join KontrakAset KA on KA.Aset_ID= A.Aset_ID 
											left join Kontrak K on K.Kontrak_ID= KA.Kontrak_ID 
											where A.CaraPerolehan !=2 AND $TAMBAHAN_QUERY_KIB and $parameter_sql
											order by A.LastSatker_ID $limit"; 
          //print_r($query_pengadaan_bmd_condition);
          $query_pengadaan_bmd_default =   "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.Kuantitas, A.TglPerolehan,
											A.NilaiPerolehan, A.Alamat, A.Info, A.Tahun, CC.KodeSatker, CC.NamaSatker, CC.Satker_ID, CC.KodeUnit,
											D.Kode, D.Uraian, D.Satuan, K.NoKontrak,K.TglKontrak from Aset A
											left join Mesin M on A.Aset_ID=M.Aset_ID 
											left join Bangunan B on A.Aset_ID=B.Aset_ID
											left join Tanah T on A.Aset_ID=T.Aset_ID
											left join Jaringan J on A.Aset_ID=J.Aset_ID
											left join AsetLain AL on A.Aset_ID=AL.Aset_ID
											left join KDP KDP on A.Aset_ID=KDP.Aset_ID 
											join Satker CC on A.LastSatker_ID=CC.Satker_ID 
											join Kelompok D on A.Kelompok_ID=D.Kelompok_ID 
											left join KontrakAset KA on KA.Aset_ID= A.Aset_ID 
											left join Kontrak K on K.Kontrak_ID= KA.Kontrak_ID  
											where A.CaraPerolehan !=2 AND $TAMBAHAN_QUERY_KIB order by A.LastSatker_ID $limit";
											
											
			//Pemeliharaan BMD								
			$query_pemeliharaan_bmd_condition=	"select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, A.Alamat, A.Info, 
												PML.JenisPemeliharaan, PML.NamaPenyediaJasa, PML.TglPemeliharaan, PML.Biaya, PML.NoBAPemeliharaan, PML.KeteranganPemeliharaan,
												A.TglPerolehan as Tahun, CC.KodeSatker, 
												CC.NamaSatker, CC.Satker_ID, CC.KodeUnit, D.Kode, D.Uraian, D.Satuan 
												from Aset A 
												join Pemeliharaan PML on A.Aset_ID=PML.Aset_ID 
												join Satker CC on A.LastSatker_ID=CC.Satker_ID 
												join Kelompok D on A.Kelompok_ID=D.Kelompok_ID 
												where $TAMBAHAN_QUERY_KIB and $parameter_sql order by A.LastSatker_ID, D.Kode, PML.TglPemeliharaan $limit";
											
			$query_pemeliharaan_bmd_default=		"select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, A.Alamat, A.Info, 
												PML.JenisPemeliharaan, PML.NamaPenyediaJasa, PML.TglPemeliharaan, PML.Biaya, PML.NoBAPemeliharaan, PML.KeteranganPemeliharaan,
												A.TglPerolehan as Tahun, CC.KodeSatker, 
												CC.NamaSatker, CC.Satker_ID, CC.KodeUnit, D.Kode, D.Uraian, D.Satuan 
												from Aset A 
												join Pemeliharaan PML on A.Aset_ID=PML.Aset_ID 
												join Satker CC on A.LastSatker_ID=CC.Satker_ID 
												join Kelompok D on A.Kelompok_ID=D.Kelompok_ID 
												where $TAMBAHAN_QUERY_KIB order by A.LastSatker_ID, D.Kode, PML.TglPemeliharaan $limit";
		
		
		//Penerimaan Barang dari Pihak Ketiga
		//REVISI BARANG KETIGA
		 $query_penerimaan_barang_pihak_ketiga_condition = "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, A.Alamat, A.Kuantitas,A.Tahun,S.Satker_ID, S.KodeSatker, S.NamaSatker as NamaDonor,S.KodeUnit, K.Kode, K.Uraian, K.Satuan, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk, M.Model, M.NoRangka, M.NoMesin, M.NoBPKB, M.Material from Aset A 
														left join Mesin M on A.Aset_ID=M.Aset_ID 
														left join Tanah T on A.Aset_ID=T.Aset_ID
														left join Jaringan J on A.Aset_ID=J.Aset_ID
														left join AsetLain AL on A.Aset_ID=AL.Aset_ID
														left join KDP KDP on A.Aset_ID=KDP.Aset_ID 
														join Satker S on A.LastSatker_ID=S.Satker_ID 
														join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
														left join Kondisi KDS on KDS.Kondisi_ID=A.LastKondisi_ID
														where A.CaraPerolehan =2 AND $TAMBAHAN_QUERY_KIB AND $parameter_sql order by A.LastSatker_ID $limit";									
         
         $query_penerimaan_barang_pihak_ketiga_default = "select A.LastSatker_ID, A.NomorReg, A.NamaAset, A.Pemilik, A.SumberAset, A.NilaiPerolehan, A.Alamat,A.Kuantitas,A.Tahun,S.Satker_ID, S.KodeSatker, S.NamaSatker as NamaDonor,S.KodeUnit, K.Kode, K.Uraian, K.Satuan, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk, M.Model, M.NoRangka, M.NoMesin, M.NoBPKB, M.Material from Aset A 
														left join Mesin M on A.Aset_ID=M.Aset_ID 
														left join Tanah T on A.Aset_ID=T.Aset_ID
														left join Jaringan J on A.Aset_ID=J.Aset_ID
														left join AsetLain AL on A.Aset_ID=AL.Aset_ID
														left join KDP KDP on A.Aset_ID=KDP.Aset_ID 
														join Satker S on A.LastSatker_ID=S.Satker_ID 
														join Kelompok K on A.Kelompok_ID=K.Kelompok_ID 
														left join Kondisi KDS on KDS.Kondisi_ID=A.LastKondisi_ID
														where A.CaraPerolehan =2 AND $TAMBAHAN_QUERY_KIB order by A.LastSatker_ID $limit";
           


			//===========================================================
		 //Kartu Barang Inventaris
         $query_kartu_barang_inventaris_condition ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, A. Kuantitas, TR.InfoTransfer, A.NamaAset, A.Satuan, A.TipeAset, STD.Spesifikasi,
													S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
													K.Kode, K.Uraian, K.Satuan from  
													Aset A
													join Satker S on A.LastSatker_ID=S.Satker_ID
													left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
													left outer join Transfer TR on A.Aset_ID=TR.Aset_ID 
													left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
													where K.Golongan !='07'
													and A.StatusValidasi='1' and A.Status_Validasi_Barang='1' AND $parameter_sql order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";     
             
         $query_kartu_barang_inventaris_default ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, A. Kuantitas, TR.InfoTransfer, A.NamaAset, A.Satuan, A.TipeAset, STD.Spesifikasi,
												  S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
												  K.Kode, K.Uraian, K.Satuan from  
												  Aset A
												  join Satker S on A.LastSatker_ID=S.Satker_ID
												  left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
												  left outer join Transfer TR on A.Aset_ID=TR.Aset_ID 
												  left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
												  where K.Golongan !='07'
												  and StatusValidasi='1' and Status_Validasi_Barang='1' order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
		
		 //Kartu Barang Pakai Habis
         $query_kartu_barang_pakai_habis_condition ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, A. Kuantitas, TR.InfoTransfer, A.NamaAset, A.Satuan, A.TipeAset, STD.Spesifikasi,
													 S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
													 K.Kode, K.Uraian, K.Satuan from  
													 Aset A
													 left outer join Satker S on A.LastSatker_ID=S.Satker_ID
													 left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
													 left outer join Transfer TR on A.Aset_ID=TR.Aset_ID 
													 left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
													 where K.Golongan='07' and StatusValidasi='1' and Status_Validasi_Barang='1'
													 AND $parameter_sql order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
         $query_kartu_barang_pakai_habis_default ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, A. Kuantitas, TR.InfoTransfer, A.NamaAset, A.Satuan, A.TipeAset, STD.Spesifikasi,
												   S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
												   K.Kode, K.Uraian, K.Satuan from  
												   Aset A
												   left outer join Satker S on A.LastSatker_ID=S.Satker_ID
												   left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
												   left outer join Transfer TR on A.Aset_ID=TR.Aset_ID 
												   left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
												   where K.Golongan='07' and StatusValidasi='1' and Status_Validasi_Barang='1'
												   order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
		 //Buku Persediaan Barang Inventaris
         $query_buku_persediaan_barang_inventaris_condition ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, A. Kuantitas, TR.InfoTransfer, A.NamaAset, A.Satuan, A.TipeAset, STD.Spesifikasi,
															   S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
															   K.Kode, K.Uraian, K.Satuan from  
															   Aset A
															   left outer join Satker S on A.LastSatker_ID=S.Satker_ID
															   left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
															   left outer join Transfer TR on A.Aset_ID=TR.Aset_ID 
															   left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
															   where K.Golongan !='07'
															   and StatusValidasi='1' and Status_Validasi_Barang='1'
															   AND $parameter_sql order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
         $query_buku_persediaan_barang_inventaris_default ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, A. Kuantitas, TR.InfoTransfer, A.NamaAset, A.Satuan, A.TipeAset, STD.Spesifikasi,
															   S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
															   K.Kode, K.Uraian, K.Satuan from  
															   Aset A
															   left outer join Satker S on A.LastSatker_ID=S.Satker_ID
															   left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
															   left outer join Transfer TR on A.Aset_ID=TR.Aset_ID 
															   left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
															   where K.Golongan !='07'
															   and StatusValidasi='1' and Status_Validasi_Barang='1'
															   order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
		 
		 //Buku Persediaan Barang Pakai Habis
         $query_buku_persediaan_barang_pakai_habis_condition ="select A.Aset_ID, A.LastSatker_ID, TR.TglTransfer, PNR.TglPenerimaan, PNR.NoBAPenerimaan, A.Kuantitas, A.NilaiPerolehan, TR.InfoTransfer, A.NamaAset, A.Satuan, A.Tahun, A.TipeAset, STD.Spesifikasi, A.TglPerolehan,
																S.KodeSatker, S.Satker_ID, S.KodeUnit,S.NamaSatker,
																K.Kode, K.Uraian, K.Satuan from  
																Aset A
																left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
																left outer join Satker S on A.LastSatker_ID=S.Satker_ID
																left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
																left outer join Transfer TR on A.Aset_ID=TR.Aset_ID
																left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
																where K.Golongan='07' and StatusValidasi='1' and Status_Validasi_Barang='1'AND $parameter_sql 
																order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
         $query_buku_persediaan_barang_pakai_habis_default ="select A.Aset_ID, A.LastSatker_ID, TR.TglTransfer, PNR.TglPenerimaan, PNR.NoBAPenerimaan, A.Kuantitas, A.NilaiPerolehan, TR.InfoTransfer, A.NamaAset, A.Satuan, A.Tahun, A.TipeAset, STD.Spesifikasi, A.TglPerolehan,
																S.KodeSatker, S.Satker_ID, S.KodeUnit,S.NamaSatker,
																K.Kode, K.Uraian, K.Satuan from  
																Aset A
																left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
																left outer join Satker S on A.LastSatker_ID=S.Satker_ID
																left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
																left outer join Transfer TR on A.Aset_ID=TR.Aset_ID
																left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
																where K.Golongan='07' and StatusValidasi='1' and Status_Validasi_Barang='1'
																order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
		 
		 //Buku Penerimaan Barang Inventaris
		 $query_buku_penerimaan_barang_inventaris_condition =  "select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, PNR.NamaPenyedia, PNR.TglPenerimaan, PNR.NoBAPenerimaan, A.NamaAset, A.Kuantitas, A.NilaiPerolehan, TR.InfoTransfer, A.TipeAset,
																S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
																K.Kode, K.Uraian, K.Satuan from  
																Aset A
																left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
																left outer join Satker S on A.LastSatker_ID=S.Satker_ID
																left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
																left outer join Transfer TR on A.Aset_ID=TR.Aset_ID
																where K.Golongan !='07' 
																and StatusValidasi='1' and Status_Validasi_Barang='1'AND $parameter_sql
																
																order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
         $query_buku_penerimaan_barang_inventaris_default =    "select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, PNR.NamaPenyedia, PNR.TglPenerimaan, PNR.NoBAPenerimaan, A.NamaAset, A.Kuantitas, A.NilaiPerolehan, TR.InfoTransfer, A.TipeAset,
																S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
																K.Kode, K.Uraian, K.Satuan from  
																Aset A
																left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
																left outer join Satker S on A.LastSatker_ID=S.Satker_ID
																left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
																left outer join Transfer TR on A.Aset_ID=TR.Aset_ID
																where K.Golongan !='07'
																order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
		 
		 
		 //Buku Penerimaan Barang Pakai Habis
         $query_buku_penerimaan_barang_pakai_habis_condition ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, PNR.NamaPenyedia, PNR.TglPenerimaan, PNR.NoBAPenerimaan, A.NamaAset, A.Kuantitas, A.NilaiPerolehan, TR.InfoTransfer, A.TipeAset,
																S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
																K.Kode, K.Uraian, K.Satuan from  
																Aset A
																left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
																left outer join Satker S on A.LastSatker_ID=S.Satker_ID
																left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
																left outer join Transfer TR on A.Aset_ID=TR.Aset_ID
																where K.Golongan='07' and StatusValidasi='1' and Status_Validasi_Barang='1' AND $parameter_sql
																order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
         $query_buku_penerimaan_barang_pakai_habis_default ="select A.Aset_ID, A.LastSatker_ID, A.TglPerolehan, TR.TglTransfer, PNR.NamaPenyedia, PNR.TglPenerimaan, PNR.NoBAPenerimaan, A.NamaAset, A.Kuantitas, A.NilaiPerolehan, TR.InfoTransfer, A.TipeAset,
																S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
																K.Kode, K.Uraian, K.Satuan from  
																Aset A
																left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
																left outer join Satker S on A.LastSatker_ID=S.Satker_ID
																left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
																left outer join Transfer TR on A.Aset_ID=TR.Aset_ID
																where K.Golongan='07' and StatusValidasi='1' and Status_Validasi_Barang='1'
																order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
																
		//buku barang inventaris										
		$query_buku_barang_inventaris_condition = "	select A.Aset_ID, A.LastSatker_ID, PNR.TglPenerimaan, A.NamaAset, STD.Merk, A.Tahun, A.Kuantitas, KTR.NoKontrak, PNR.TglPemeriksaan, PNR.NoBAPemeriksaan, TR.TglTransfer, PNR.KeteranganPenerimaan, TR.Nama_Penyimpan,
													S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,K.Kode, K.Uraian, K.Satuan 
													from Aset A
													left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
													left outer join Satker S on A.LastSatker_ID=S.Satker_ID
													left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
													left outer join KontrakAset KTRA on KTRA.Aset_ID=A.Aset_ID
													left outer join Kontrak KTR on KTR.Kontrak_ID=KTRA.Kontrak_ID
													left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
													left outer join Transfer TR on TR.Aset_ID=A.Aset_ID
													where K.Golongan !='07' 
													and StatusValidasi='1' and Status_Validasi_Barang='1' AND $parameter_sql
													order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
		  
		  
		 $query_buku_barang_inventaris_default = " 	select A.Aset_ID, A.LastSatker_ID, PNR.TglPenerimaan, A.NamaAset, STD.Merk, A.Tahun, A.Kuantitas, KTR.NoKontrak, PNR.TglPemeriksaan, PNR.NoBAPemeriksaan, TR.TglTransfer, PNR.KeteranganPenerimaan, TR.Nama_Penyimpan,
													S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,K.Kode, K.Uraian, K.Satuan 
													from Aset A
													left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
													left outer join Satker S on A.LastSatker_ID=S.Satker_ID
													left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
													left outer join KontrakAset KTRA on KTRA.Aset_ID=A.Aset_ID
													left outer join Kontrak KTR on KTR.Kontrak_ID=KTRA.Kontrak_ID
													left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
													left outer join Transfer TR on TR.Aset_ID=A.Aset_ID
													where K.Golongan !='07'
													and StatusValidasi='1' and Status_Validasi_Barang='1'
													order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
													
		//buku barang pakai habis										
		$query_buku_barang_pakai_habis_condition = "	select A.Aset_ID, A.LastSatker_ID, PNR.TglPenerimaan, A.NamaAset, STD.Merk, A.Tahun, A.Kuantitas, KTR.NoKontrak, PNR.TglPemeriksaan, PNR.NoBAPemeriksaan, TR.TglTransfer, PNR.KeteranganPenerimaan, TR.Nama_Penyimpan,
														S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
														K.Kode, K.Uraian, K.Satuan 
														from Aset A
														left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
														left outer join Satker S on A.LastSatker_ID=S.Satker_ID
														left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
														left outer join KontrakAset KTRA on KTRA.Aset_ID=A.Aset_ID
														left outer join Kontrak KTR on KTR.Kontrak_ID=KTRA.Kontrak_ID
														left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
														left outer join Transfer TR on TR.Aset_ID=A.Aset_ID
														where K.Golongan='07' 
														and StatusValidasi='1' and Status_Validasi_Barang='1' AND $parameter_sql
														order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";

		  
		 $query_buku_barang_pakai_habis_default = " 	select A.Aset_ID, A.LastSatker_ID, PNR.TglPenerimaan, A.NamaAset, STD.Merk, A.Tahun, A.Kuantitas, KTR.NoKontrak, PNR.TglPemeriksaan, PNR.NoBAPemeriksaan, TR.TglTransfer, PNR.KeteranganPenerimaan, TR.Nama_Penyimpan,
														S.KodeSatker,  S.Satker_ID, S.KodeUnit,S.NamaSatker,
														K.Kode, K.Uraian, K.Satuan 
														from Aset A
														left outer join Penerimaan PNR on A.Penerimaan_ID=PNR.Penerimaan_ID
														left outer join Satker S on A.LastSatker_ID=S.Satker_ID
														left outer join Kelompok K on A.Kelompok_ID=K.Kelompok_ID
														left outer join KontrakAset KTRA on KTRA.Aset_ID=A.Aset_ID
														left outer join Kontrak KTR on KTR.Kontrak_ID=KTRA.Kontrak_ID
														left outer join StandarHarga STD on STD.Kelompok_ID=K.Kelompok_ID
														left outer join Transfer TR on TR.Aset_ID=A.Aset_ID
														where K.Golongan='07'
														and StatusValidasi='1' and Status_Validasi_Barang='1'
														order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
         //nanti diganti where 1=1 
         $query_laporan_pemeriksaan_barang_atau_gudang_condition = "select A.Aset_ID, A.LastSatker_ID, A.NamaAset, A.Kuantitas, A.Satuan, A.NilaiPerolehan, PMRG.NoBAPemeriksaanGudang, PMRG.AlasanPemeriksaanGudang, A.TipeAset, TR.TglTransfer, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, KDS.TidakDitemukan,
																	S.KodeSatker, S.Satker_ID, S.KodeUnit, S.NamaSatker,
																	K.Kode, K.Uraian, K.Satuan
																	from Aset A
																	left outer join Kondisi KDS on A.Aset_ID = KDS.Aset_ID
																	left outer join PemeriksaanGudang PMRG on PMRG.PemeriksaanGudang_ID = KDS.PemeriksaanGudang_ID
																	left outer join Satker S on A.LastSatker_ID = S.Satker_ID
																	left outer join Kelompok K on A.Kelompok_ID = K.Kelompok_ID
																	left outer join Transfer TR on A.Aset_ID = TR.Aset_ID
																	where StatusValidasi='1' and Status_Validasi_Barang='1' AND $parameter_sql order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
         
         $query_laporan_pemeriksaan_barang_atau_gudang_default = "select A.Aset_ID, A.LastSatker_ID, A.NamaAset, A.Kuantitas, A.Satuan, A.NilaiPerolehan, PMRG.NoBAPemeriksaanGudang, PMRG.AlasanPemeriksaanGudang, A.TipeAset, TR.TglTransfer, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, KDS.TidakDitemukan,
																	S.KodeSatker, S.Satker_ID, S.KodeUnit, S.NamaSatker,
																	K.Kode, K.Uraian, K.Satuan
																	from Aset A
																	left outer join Kondisi KDS on A.Aset_ID = KDS.Aset_ID
																	left outer join PemeriksaanGudang PMRG on PMRG.PemeriksaanGudang_ID = KDS.PemeriksaanGudang_ID
																	left outer join Satker S on A.LastSatker_ID = S.Satker_ID
																	left outer join Kelompok K on A.Kelompok_ID = K.Kelompok_ID
																	left outer join Transfer TR on A.Aset_ID = TR.Aset_ID
																	where StatusValidasi='1' and Status_Validasi_Barang='1' order by S.KodeSatker, S.KodeUnit, K.Kode, A.NomorReg $limit";
		
		//Standar Harga Barang
		$query_standarhargabarang_default=  "
		select STD.Spesifikasi,STD.NilaiStandar,STD.Keterangan,STD.TglUpdate,STD.Satuan,
											K.Kelompok_ID,K.Uraian from StandarHarga as STD 
											left outer join Kelompok as K on STD.Kelompok_ID=K.Kelompok_ID  
											where STD.StatusPemeliharaan is not null $limit";	
	
																																														
		
		$query_standarhargabarang_condition= 	"select STD.Spesifikasi,STD.NilaiStandar,STD.Keterangan,STD.TglUpdate,STD.Satuan,
												K.Kelompok_ID,K.Uraian from StandarHarga as STD 
												left outer join Kelompok as K on STD.Kelompok_ID=K.Kelompok_ID  
												where STD.StatusPemeliharaan is not null AND $parameter_sql $limit";
												
												
			
		//Standar Harga Pemeliharaan(status pemeliharaan harusnya =1)		
		$query_standarhargapemeliharaan_default=	"select PRC.NamaAset,PRC.UraianPemeliharaan,PRC.Merk,PRC.Lokasi_ID,PRC.Kelompok_ID,
													PRC.Kuantitas,STD.Pemeliharaan,PRC.KodeRekening,L.Lokasi_ID,L.NamaLokasi,
													PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian 
													from Perencanaan PRC
													left outer join Satker S on PRC.Satker_ID=S.Satker_ID
													left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
													join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
													left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
													where PRC.StatusPemeliharaan is not null $limit";	
										
		$query_standarhargapemeliharaan_condition=	"select PRC.NamaAset,PRC.UraianPemeliharaan,PRC.Merk,PRC.Lokasi_ID,PRC.Kelompok_ID,
													PRC.Kuantitas,STD.Pemeliharaan,PRC.KodeRekening,L.Lokasi_ID,L.NamaLokasi,
													PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian 
													from Perencanaan PRC
													left outer join Satker S on PRC.Satker_ID=S.Satker_ID
													left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
													join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
													left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
													where PRC.StatusPemeliharaan is not null AND $parameter_sql $limit";														

													
													
		//Standar Kebutuhan Barang
		$query_standarkebutuhanbarang_default= "SELECT STDK.skb_njb AS skb_njb, STDK.skb_skpd AS skb_skpd, STDK.skb_lokasi AS skb_lokasi, STDK.skb_tgl AS skb_tgl, STDK.skb_jml AS skb_jml, STDK.skb_ket AS skb_ket, K.Kelompok_ID AS Kelompok_ID, L.Lokasi_ID AS Lokasi_ID, S.Satker_ID AS Satker_ID
												FROM StandarKebutuhan STDK
												LEFT OUTER JOIN Satker S ON STDK.skb_skpd = S.Satker_ID
												LEFT OUTER JOIN Kelompok K ON STDK.skb_njb = K.Kelompok_ID
												LEFT OUTER JOIN Lokasi L ON STDK.skb_lokasi = L.Lokasi_ID
												WHERE K.Kelompok_ID = '$Kelompok_ID' AND L.Lokasi_ID = '$Lokasi_ID' AND S.Satker_ID = '$Satker_ID'
												ORDER BY S.Satker_ID ASC $limit";
													
													
													
		$query_standarkebutuhanbarang_condition=   "SELECT STDK.skb_njb AS skb_njb, STDK.skb_skpd AS skb_skpd, STDK.skb_lokasi AS skb_lokasi, STDK.skb_tgl AS skb_tgl, STDK.skb_jml AS skb_jml, STDK.skb_ket AS skb_ket, K.Kelompok_ID AS Kelompok_ID, L.Lokasi_ID AS Lokasi_ID, S.Satker_ID AS Satker_ID
													FROM StandarKebutuhan STDK
													LEFT OUTER JOIN Satker S ON STDK.skb_skpd = S.Satker_ID
													LEFT OUTER JOIN Kelompok K ON STDK.skb_njb = K.Kelompok_ID
													LEFT OUTER JOIN Lokasi L ON STDK.skb_lokasi = L.Lokasi_ID
													WHERE K.Kelompok_ID = '$Kelompok_ID' AND L.Lokasi_ID = '$Lokasi_ID' AND S.Satker_ID = '$Satker_ID' AND $parameter_sql
													ORDER BY S.Satker_ID ASC $limit";
													
													
													
		//DKBMD  status pemeliharaan nut noll dan status validasi=0
        $query_dkbmd_default = 		"select PRC.NamaAset,PRC.Merk,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
									PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Uraian,L.Lokasi_ID,L.NamaLokasi, K.Kode,
									STD.NilaiStandar
									from Perencanaan PRC
									left outer join Satker S on PRC.Satker_ID=S.Satker_ID
									left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
									join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
									left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
									where PRC.StatusPemeliharaan is not null
									$limit";
																									
												
		$query_dkbmd_condition= "select PRC.NamaAset,PRC.Merk,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
								PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Uraian,L.Lokasi_ID,L.NamaLokasi, K.Kode,
								STD.NilaiStandar
								from Perencanaan PRC
								left outer join Satker S on PRC.Satker_ID=S.Satker_ID
								left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
								join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
								left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
								where PRC.StatusPemeliharaan is not null
								AND $parameter_sql $limit";
		
									
		//DKPBMD status pemeliharaan 1 dan status validasi=0	 								
         $query_dkpbmd_default = 	"select PRC.NamaAset,PRC.Merk,PRC.UraianPemeliharaan,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
									 PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
									 STD.Pemeliharaan
									 from Perencanaan PRC
									 left outer join Satker S on PRC.Satker_ID=S.Satker_ID
									 left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
									 join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
									 left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
									 where PRC.StatusPemeliharaan is not null
									 $limit";

												
		$query_dkpbmd_condition= 	"select PRC.NamaAset,PRC.Merk,PRC.UraianPemeliharaan,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
									PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
									STD.Pemeliharaan
									from Perencanaan PRC
									left outer join Satker S on PRC.Satker_ID=S.Satker_ID
									left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
									join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
									left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
									where PRC.StatusPemeliharaan is not null
									AND $parameter_sql $limit";
							 
		//RKB status pemeliharaan nut noll dan status validasi=0					 
        $query_rkbu_default =		"select PRC.NamaAset,PRC.Merk,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
									PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
									STD.NilaiStandar
									from Perencanaan PRC
									left outer join Satker S on PRC.Satker_ID=S.Satker_ID
									left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
									join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
									left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
									where PRC.StatusPemeliharaan is not null $limit";
		
		//RKB status pemeliharaan nut noll dan status validasi=0					 												
		$query_rkbu_condition = 	"select PRC.NamaAset,PRC.Merk,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
									PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
									STD.NilaiStandar
									from Perencanaan PRC
									left outer join Satker S on PRC.Satker_ID=S.Satker_ID
									left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
									join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
									left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
									where PRC.StatusPemeliharaan is not null 
									AND $parameter_sql $limit";
		
		//echo $query_rkbu_condition;
		//echo '<br>'.$parameter_sql.'<pre>';
		
		//RKPB status pemeliharaan 1 dan status validasi=0
		$query_rkpbu_default = 		"select PRC.NamaAset,PRC.Merk,PRC.UraianPemeliharaan,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
									PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
									STD.Pemeliharaan
									from Perencanaan PRC
									left outer join Satker S on PRC.Satker_ID=S.Satker_ID
									left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
									join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
									left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
									where PRC.StatusPemeliharaan is not null
									$limit";
		
		//RKPB status pemeliharaan 1 dan status validasi=0
		$query_rkpbu_condition	= 	"select PRC.NamaAset,PRC.Merk,PRC.UraianPemeliharaan,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
									PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
									STD.Pemeliharaan
									from Perencanaan PRC
									join Satker S on PRC.Satker_ID=S.Satker_ID
									left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
									join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
									left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
									where PRC.StatusPemeliharaan is not null
									AND $parameter_sql $limit";
															
         
		//RTB status pemeliharaan 1 dan status validasi=1
         $query_rtb_default = 	"select PRC.NamaAset,PRC.Merk,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
								 PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
								 STD.NilaiStandar
								 from Perencanaan PRC
								 left outer join Satker S on PRC.Satker_ID=S.Satker_ID
								 left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
								 join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
								 left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
								 where PRC.StatusPemeliharaan is not null
								 $limit";																																		
												
		$query_rtb_condition = 	"select PRC.NamaAset,PRC.Merk,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
								PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
								STD.NilaiStandar
								from Perencanaan PRC
								left outer join Satker S on PRC.Satker_ID=S.Satker_ID
								left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
								join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
								left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
								where PRC.StatusPemeliharaan is not null
								AND $parameter_sql $limit";		
								
		//RTPB status pemeliharaan 1 dan status validasi 1				
        $query_rtpb_default = 	"select PRC.NamaAset,PRC.Merk,PRC.UraianPemeliharaan,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
								PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
								STD.Pemeliharaan
								from Perencanaan PRC
								left outer join Satker S on PRC.Satker_ID=S.Satker_ID
								left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
								join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
								left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
								where PRC.StatusPemeliharaan is not null
								$limit";				
												
	   $query_rtpb_condition = "select PRC.NamaAset,PRC.Merk,PRC.UraianPemeliharaan,PRC.Kuantitas,PRC.Lokasi_ID,PRC.KodeRekening,PRC.Tahun,PRC.KeteranganPerencanaan,
								PRC.Satker_ID,PRC.Kelompok_ID,S.Satker_ID,S.NamaSatker,K.Kelompok_ID,K.Kode,K.Uraian,L.Lokasi_ID,L.NamaLokasi,
								STD.Pemeliharaan
								from Perencanaan PRC
								left outer join Satker S on PRC.Satker_ID=S.Satker_ID
								left outer join Kelompok K on PRC.Kelompok_ID=K.Kelompok_ID
								join StandarHarga STD on PRC.Kelompok_ID=STD.Kelompok_ID
								left outer join Lokasi L on PRC.Lokasi_ID=L.Lokasi_ID
								where PRC.StatusPemeliharaan is not null
								AND $parameter_sql $limit";	
								
		//Cetak Label
		//REVISI LABEL
		$query_cetaklabel_default = "select A.NamaAset,A.NomorReg,S.KodeSatker, S.KodeUnit, S.NamaSatker,S.Satker_ID, K.kode
									from Aset A									
									join Kelompok K on A.Kelompok_ID = K.Kelompok_ID
									join Satker S on A.LastSatker_ID = S.Satker_ID WHERE $TAMBAHAN_QUERY_KIB
									order by S.KodeSatker, S.KodeUnit, K.Kelompok_ID $limit";
									
		$query_cetaklabel_condition = 	"select A.NamaAset,A.NomorReg, S.KodeSatker, S.KodeUnit, S.NamaSatker,S.Satker_ID, K.kode
										from Aset A
										join Kelompok K on A.Kelompok_ID = K.Kelompok_ID
										join Satker S on A.LastSatker_ID = S.Satker_ID WHERE $TAMBAHAN_QUERY_KIB AND $parameter_sql
										order by S.KodeSatker, S.KodeUnit, K.Kelompok_ID $limit";
		//echo '<br>'.$query_cetaklabel_condition.'<br>';										
        
		$query_katalog_aset_default = "SELECT a.Aset_ID, a.Pemilik, a.Tahun, a.NomorReg, a.NamaAset, 
                    a.Ruangan, a.NomorReg, a.Bersejarah, a.Kelompok_ID, a.OrigSatker_ID, 
                    a.Lokasi_ID, a.LastKondisi_ID, a.BASP_ID, a.Kuantitas, a.satuan, a.Alamat, 
                    a.RTRW, a.AsalUsul, a.TglPerolehan, a.NilaiPerolehan, a.SumberDana, a.TipeAset,
                    a.CaraPerolehan, a.PenghapusanAset, b.NoBASP, b.TglBASP, b.NamaPihak1 AS Nama1BASP,
                    b.NamaPihak2 AS Nama2BASP,  b.JabatanPihak1 AS Jabatan1BASP, b.NIPPihak1 AS NIP1BASP,
                    b.NamaPihak2 AS Nama2BASP, b.JabatanPihak2 AS Jabatan2BASP,
                    b.NIPPihak2 AS NIP2BASP, b.LokasiPihak1 AS Lokasi1BASP, b.LokasiPihak2 AS Lokasi2BASP,
                    b.NoSKPenetapan AS NoSKPenetapanBASP, b.TglSKPenetapan AS TglSKPenetapanBASP,
                    b.NoSKPenghapusan AS NoSKPenghapusanBASP, b.TglSKPenghapusan AS TglSKPenghapusanBASP,
                    b.KeteranganTambahan, 
                    c.Kelompok, c.Kelompok_ID, c.Kode, c.Uraian, c.Golongan, d.NamaLokasi, d.KodeLokasi, 
                    e.KodeSatker, e.Satker_ID, e.NamaSatker, e.KodeSatker, f.Tanah_ID, f.LuasTotal,f.LuasBangunan, 
                    f.LuasSekitar, f.LuasKosong, f.HakTanah, f.NoSertifikat AS no_sertifikat_tanah, f.TglSertifikat AS tgl_sertifikat_tanah, f.Penggunaan, 
                    f.BatasUtara, f.BatasSelatan, f.BatasBarat, f.BatasTimur, g.Mesin_ID, g.Merk, g.Model, g.Ukuran,
                    g.Silinder, g.MerkMesin, g.JumlahMesin, g.Material, g.NoSeri, g.NoRangka, g.NoMesin,
                    g.NoSTNK, g.TglSTNK, g.NoBPKB, g.TglBPKB, g.NoDokumen AS NoDokumenMesin, g.TglDokumen AS TglDokumenMesin, 
                    g.Pabrik, g.TahunBuat, g.BahanBakar, g.NegaraAsal, g.NegaraRakit, g.Kapasitas,
                    g.Bobot, h.Bangunan_ID, h.Konstruksi, h.Beton, h.JumlahLantai, h.LuasLantai, h.Dinding, 
                    h.Lantai, h.LangitLangit, h.Atap, h.NoSurat, h.TglSurat, h.NoIMB, h.TglIMB, 
                    h.StatusTanah, h.NoSertifikat, h.TglSertifikat , h.TglPakai, i.Jaringan_ID, i.Konstruksi, 
                    i.Panjang, i.Lebar,i.NoDokumen AS NoDokumenJaringan, i.TglDokumen AS TglDokumenJaringan, i.StatusTanah AS StatusTanahJaringan, i.NoSertifikat AS NoSertifikatJaringan,
                    i.TglSertifikat AS TglSertifikatJaringan ,i.TanggalPemakaian, j.KDP_ID, j.Konstruksi, j.Beton, j.JumlahLantai, 
                    j.LuasLantai, j.TglMulai, j.StatusTanah, k.Penerimaan_ID, k.NoBAPemeriksaan, 
                    k.KetuaPemeriksa, k.TglPemeriksaan, k.StatusPemeriksaan, k.NoBAPenerimaan,
                    k.TglPenerimaan, k.NamaPenyedia, k.NamaPenyimpan, k.NIPPenyimpan,
                    r.TglBAST, r.BAST_ID , r.NamaPihak1,
                    r.NoBAST, r.JabatanPihak1, r.NIPPihak1, r.NamaPihak2, r.JabatanPihak2,
                    r.NIPPihak2, s.KetPemusnahan, s.NoSKPenetapan, s.TglSKPenetapan,
                    s.NoSKPenghapusan, s.TglSKPenghapusan, t.AsetLain_ID
                    FROM Aset AS a 
                    LEFT JOIN BASP AS b ON a.BASP_ID = b.BASP_ID 
                    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID 
                    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                    LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID 
                    LEFT JOIN Tanah AS f ON a.Aset_ID = f.Aset_ID 
                    LEFT JOIN Mesin AS g ON a.Aset_ID = g.Aset_ID 
                    LEFT JOIN Bangunan AS h ON a.Aset_ID = h.Aset_ID 
                    LEFT JOIN Jaringan AS i ON a.Aset_ID = i.Aset_ID 
                    LEFT JOIN KDP AS j ON a.Aset_ID = j.Aset_ID 
                    LEFT JOIN Penerimaan AS k ON a.Penerimaan_ID = k.Penerimaan_ID 
                    LEFT JOIN lokasi_baru AS l ON a.Aset_ID = l.Aset_ID
                    LEFT JOIN KapitalisasiAset AS o ON a.Aset_ID = o.Aset_ID
                    LEFT JOIN BAST AS r ON a.BAST_ID = r.BAST_ID 
                    LEFT JOIN Pemusnahan AS s ON a.Aset_ID = s.Aset_ID
                    LEFT JOIN AsetLain AS t ON a.Aset_ID = t.Aset_ID
                    where A.Status_Validasi_Barang='1' ";
					
		$query_katalog_aset_condition = "SELECT a.Aset_ID, a.Pemilik, a.Tahun, a.NomorReg, a.NamaAset, 
                    a.Ruangan, a.NomorReg, a.Bersejarah, a.Kelompok_ID, a.OrigSatker_ID, 
                    a.Lokasi_ID, a.LastKondisi_ID, a.BASP_ID, a.Kuantitas, a.satuan, a.Alamat, 
                    a.RTRW, a.AsalUsul, a.TglPerolehan, a.NilaiPerolehan, a.SumberDana, a.TipeAset,
                    a.CaraPerolehan, a.PenghapusanAset, b.NoBASP, b.TglBASP, b.NamaPihak1 AS Nama1BASP,
                    b.NamaPihak2 AS Nama2BASP,  b.JabatanPihak1 AS Jabatan1BASP, b.NIPPihak1 AS NIP1BASP,
                    b.NamaPihak2 AS Nama2BASP, b.JabatanPihak2 AS Jabatan2BASP,
                    b.NIPPihak2 AS NIP2BASP, b.LokasiPihak1 AS Lokasi1BASP, b.LokasiPihak2 AS Lokasi2BASP,
                    b.NoSKPenetapan AS NoSKPenetapanBASP, b.TglSKPenetapan AS TglSKPenetapanBASP,
                    b.NoSKPenghapusan AS NoSKPenghapusanBASP, b.TglSKPenghapusan AS TglSKPenghapusanBASP,
                    b.KeteranganTambahan, 
                    c.Kelompok, c.Kelompok_ID, c.Kode, c.Uraian, c.Golongan, d.NamaLokasi, d.KodeLokasi, 
                    e.KodeSatker, e.Satker_ID, e.NamaSatker, e.KodeSatker, f.Tanah_ID, f.LuasTotal,f.LuasBangunan, 
                    f.LuasSekitar, f.LuasKosong, f.HakTanah, f.NoSertifikat AS no_sertifikat_tanah, f.TglSertifikat AS tgl_sertifikat_tanah, f.Penggunaan, 
                    f.BatasUtara, f.BatasSelatan, f.BatasBarat, f.BatasTimur, g.Mesin_ID, g.Merk, g.Model, g.Ukuran,
                    g.Silinder, g.MerkMesin, g.JumlahMesin, g.Material, g.NoSeri, g.NoRangka, g.NoMesin,
                    g.NoSTNK, g.TglSTNK, g.NoBPKB, g.TglBPKB, g.NoDokumen AS NoDokumenMesin, g.TglDokumen AS TglDokumenMesin, 
                    g.Pabrik, g.TahunBuat, g.BahanBakar, g.NegaraAsal, g.NegaraRakit, g.Kapasitas,
                    g.Bobot, h.Bangunan_ID, h.Konstruksi, h.Beton, h.JumlahLantai, h.LuasLantai, h.Dinding, 
                    h.Lantai, h.LangitLangit, h.Atap, h.NoSurat, h.TglSurat, h.NoIMB, h.TglIMB, 
                    h.StatusTanah, h.NoSertifikat, h.TglSertifikat , h.TglPakai, i.Jaringan_ID, i.Konstruksi, 
                    i.Panjang, i.Lebar,i.NoDokumen AS NoDokumenJaringan, i.TglDokumen AS TglDokumenJaringan, i.StatusTanah AS StatusTanahJaringan, i.NoSertifikat AS NoSertifikatJaringan,
                    i.TglSertifikat AS TglSertifikatJaringan ,i.TanggalPemakaian, j.KDP_ID, j.Konstruksi, j.Beton, j.JumlahLantai, 
                    j.LuasLantai, j.TglMulai, j.StatusTanah, k.Penerimaan_ID, k.NoBAPemeriksaan, 
                    k.KetuaPemeriksa, k.TglPemeriksaan, k.StatusPemeriksaan, k.NoBAPenerimaan,
                    k.TglPenerimaan, k.NamaPenyedia, k.NamaPenyimpan, k.NIPPenyimpan,
                    r.TglBAST, r.BAST_ID , r.NamaPihak1,
                    r.NoBAST, r.JabatanPihak1, r.NIPPihak1, r.NamaPihak2, r.JabatanPihak2,
                    r.NIPPihak2, s.KetPemusnahan, s.NoSKPenetapan, s.TglSKPenetapan,
                    s.NoSKPenghapusan, s.TglSKPenghapusan, t.AsetLain_ID
                    FROM Aset AS a 
                    LEFT JOIN BASP AS b ON a.BASP_ID = b.BASP_ID 
                    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID 
                    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                    LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID 
                    LEFT JOIN Tanah AS f ON a.Aset_ID = f.Aset_ID 
                    LEFT JOIN Mesin AS g ON a.Aset_ID = g.Aset_ID 
                    LEFT JOIN Bangunan AS h ON a.Aset_ID = h.Aset_ID 
                    LEFT JOIN Jaringan AS i ON a.Aset_ID = i.Aset_ID 
                    LEFT JOIN KDP AS j ON a.Aset_ID = j.Aset_ID 
                    LEFT JOIN Penerimaan AS k ON a.Penerimaan_ID = k.Penerimaan_ID 
                    LEFT JOIN lokasi_baru AS l ON a.Aset_ID = l.Aset_ID
                    LEFT JOIN KapitalisasiAset AS o ON a.Aset_ID = o.Aset_ID
                    LEFT JOIN BAST AS r ON a.BAST_ID = r.BAST_ID 
                    LEFT JOIN Pemusnahan AS s ON a.Aset_ID = s.Aset_ID
                    LEFT JOIN AsetLain AS t ON a.Aset_ID = t.Aset_ID and
                    A.Status_Validasi_Barang='1' and $parameter_sql";
             
              if (isset($modul))
          {
               switch ($modul)
               {	//cetak dokumen inventaris
                    case '14':
                    {
		
                         if (isset($mode))
                         {
                              switch ($mode)
                              {
                                   case '1':
                                   {
                                        if (isset($tab))
                                        {
                                             switch($tab){
                                                  case '1':
                                                  {
                                                       //KIB
											   if (isset($kib))
													  {
														switch ($kib)
														{
                                                                 case 'KIB-A':
                                                                 {
																	if($parameter_sql!="" ) {
                                                                                     $query = $Modul_1_Mode_1_Case_a_condition; 
																					 // echo "masukkk";
																	}
																	if($parameter_sql=="" ) {
                                                                                $query = $Modul_1_Mode_1_Case_a_default; 
																	}
                                                                 }		
                                                                 break;
                                                                 case 'KIB-B':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $Modul_1_Mode_1_Case_b_condition;
																								}
                                                                      if($parameter_sql=="" ) {
                                                                                $query = $Modul_1_Mode_1_Case_b_default;
																								}
                                                                 }
                                                                 break;
                                                                 case 'KIB-C':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $Modul_1_Mode_1_Case_c_condition;
                                                                      }
                                                                      if($parameter_sql=="" ) {
                                                                                $query = $Modul_1_Mode_1_Case_c_default;
                                                                      }
                                                                 }
                                                                 break;
                                                                 case 'KIB-D':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $Modul_1_Mode_1_Case_d_condition;
                                                                      }
                                                                      if($parameter_sql=="" ){
                                                                                $query = $Modul_1_Mode_1_Case_d_default;
                                                                      }
                                                                 }
                                                                 break;
                                                                 
                                                                 case 'KIB-E':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $Modul_1_Mode_1_Case_e_condition;
                                                                       }
                                                                      if($parameter_sql=="" ){
                                                                                $query = $Modul_1_Mode_1_Case_e_default;
                                                                      }
                                                                 }
                                                                 break;
														
                                                                 case 'KIB-F':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $Modul_1_Mode_1_Case_f_condition;	
                                                                      }
                                                                      if($parameter_sql=="" ){
                                                                                $query = $Modul_1_Mode_1_Case_f_default;	
                                                                      }
                                                                 }
                                                                 break;
																}
                                                       }
                                                  }
                                                  break;
                                                  
                                                  case '2':
                                                  { 
														if($parameter_sql!="" ) {
                                                                                     $query = $query_kir_condition; 
																	}
																	if($parameter_sql=="" ) {
                                                                                $query = $query_kir_default; 
																	}
                                                  }		
                                                   break;
                                                  
                                                  case '3':
                                                  {
                                                            //Buku Inventaris SKPD
                                                            if($parameter_sql!="" ){
                                                                      $query = $query_buku_inventaris_condition;	
                                                            }
                                                            if($parameter_sql=="" ){
                                                                      $query = $query_buku_inventaris_default;	
                                                            }
                                                  }
                                                  break;
                                                  case '4':
                                                  {
                                                       //Rekapitulasi Buku Inventaris SKPD
													   $status = true;
                                                  }
                                                  break;
                                                  case '5':
                                                  {
                                                            //Buku Inventaris Daerah
														if($parameter_sql!="" ){
                                                                      $query = $query_buku_induk_inventaris_daerah_condition;	
																				}
														if($parameter_sql=="" ){
                                                                      $query =  $query_buku_induk_inventaris_daerah_default;	
															}
												
												  }
												  break;
												  case '6':
                                                  {
                                                       //Rekapitulasi Buku Induk Inventaris SKPD
                                                  }
                                                  break;
									
                                             }
                                        }
                                   }
                                   break;
                                   
                               }
                            }
                         }
                         break;
					//cetak dokumen pengadaan
                    case '13':
                         {
							if (isset($mode))
								{
									switch ($mode)
										{
										case '1':
											{
												 if (isset($tab))
													{
														switch($tab){
															case '1':
																{
																//Daftar Pengadaan BMD
																if($parameter_sql!="" ){
                                                                      $query = $query_pengadaan_bmd_condition;	
																				}
																if($parameter_sql=="" ){
                                                                      $query = $query_pengadaan_bmd_default;
                                                                      
																				}
															   }
															break;
															case '2':
																{
																//echo 'ada';
																//Rekapitulasi Daftar Pengadaan BMD
																$tanggal_awal = $_REQUEST['cdp_rekap_bmdperiode1'];
																$tanggal_akhir = $_REQUEST['cdp_rekap_bmdperiode2'];
																$satker_id = $_REQUEST['satker_id'];
																//echo 'masuk';
																$status = true;
															   }
															break;
															case '3':
																{
																//Daftar Pemeliharaan BMD
																if($parameter_sql!="" ){
                                                                      $query = $query_pemeliharaan_bmd_condition;	
																				}
																if($parameter_sql=="" ){
                                                                      $query = $query_pemeliharaan_bmd_default;	
																				}
															   }
															break;
															case '4':
																{
																//Rekapitulasi Daftar Pemeliharaan BMD
																$status = true;
															   }
															break;
															case '5':
																{
																//Daftar Penerimaan Barang Dari Pihak Ketiga (Hibah)
																if($parameter_sql!="" ){
                                                                      $query = $query_penerimaan_barang_pihak_ketiga_condition;	
																				}
																if($parameter_sql=="" ){
                                                                      $query = $query_penerimaan_barang_pihak_ketiga_default;	
																				}
															   }
															break;
															case '6':
																{
																//Rekapitulasi Daftar Penerimaan Barang Dari Pihak Ketiga (Hibah)
																$status = true;
															   }
															break;
													}
												}
											}
										break;	
										}
								}	        
                         }
						break;
						//Cetak Label
						case '12':
						{
						
							if (isset($mode))
							{ 
								switch($mode)
								{
									case '1':
									{ 
										if($parameter_sql!="")
										{
											
											$query = $query_cetaklabel_condition;
											
										}
										
										if($parameter_sql=="")
										{
											$query = $query_cetaklabel_default;
										}
										break;
									}
								}
								break;
							}
						}
						
					//cetak dokumen gudang	
					case '18':
						{
						if (isset($mode))
								{
									switch ($mode)
										{
										case '1':
											{
												 if (isset($tab))
													{
														switch($tab){
															case '1':
																{
																//Kartu Barang Inventaris
																if($parameter_sql!="" ) {
                                                                                $query = $query_kartu_barang_inventaris_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_kartu_barang_inventaris_default; 
																		}
																}	
																
															break;
															case '2':
																{
																//Kartu Barang Pakai Habis
																if($parameter_sql!="" ) {
                                                                                $query = $query_kartu_barang_pakai_habis_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_kartu_barang_pakai_habis_default; 
																		}
																}
																
															break;
															case '3':
																{
																//Kartu Persediaan Barang Inventaris
																if($parameter_sql!="" ) {
                                                                                $query = $query_buku_persediaan_barang_inventaris_condition ; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_buku_persediaan_barang_inventaris_default ; 
																		}
																}
																
															break;
															case '4':
																{
																//Kartu Persediaan Barang Pakai Habis
																if($parameter_sql!="" ) {
                                                                                $query = $query_buku_persediaan_barang_pakai_habis_condition ; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_buku_persediaan_barang_pakai_habis_default; 
																		}
																}
																
															break;
															case '5':
																{
																//Buku Penerimaan Barang Inventaris
																if($parameter_sql!="" ) {
                                                                                $query =$query_buku_penerimaan_barang_inventaris_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query =$query_buku_penerimaan_barang_inventaris_default; 
																		}
																}
																
															break;
															case '6':
																{
																//Buku Penerimaan Barang Pakai Habis
																if($parameter_sql!="" ) {
                                                                                $query = $query_buku_penerimaan_barang_pakai_habis_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_buku_penerimaan_barang_pakai_habis_default; 
																		}
																}
																
															break;
															case '7':
																{
																//Buku Pengeluaran Barang Inventaris
																if($parameter_sql!="" ) {
                                                                                $query =" "; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query =" "; 
																		}
																}
																
															break;
															case '8':
																{
																//Buku Pengeluaran Barang Pakai Habis
																if($parameter_sql!="" ) {
                                                                                $query =" "; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query =" "; 
																		}
																}
																
															break;
															case '9':
															{
																	if($parameter_sql!="" ) {
                                                                                     $query = $query_buku_barang_inventaris_condition; 
																	}
																	if($parameter_sql=="" ) {
                                                                                $query = $query_buku_barang_inventaris_default; 
																	}
															}		
															break;
                                                   
															case '10':
															{
																	if($parameter_sql!="" ) {
                                                                                     $query = $query_buku_barang_pakai_habis_condition; 
																	}
																	if($parameter_sql=="" ) {
                                                                                $query = $query_buku_barang_pakai_habis_default; 
																	}
															}		
															break;
																
															case '11':
																{
																//Laporan Pemeriksaan barang Gudang
																if($parameter_sql!="" ) {
                                                                                $query = $query_laporan_pemeriksaan_barang_atau_gudang_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_laporan_pemeriksaan_barang_atau_gudang_default ; 
																		}
																}
																
															break;
																
														}
													}
												}
											  break;	
											}
										}
						
                    }
                    break;
                    //cetak dokumen perencanaan	
					case '9':
						{
							
						if (isset($mode))
								{
									switch ($mode)
										{
										case '1':
											{
												 if (isset($tab))
													{
														switch($tab){
															case '1':
																{
																//Standar Harga	Barang
																if($parameter_sql!="" ) {
                                                                                $query =$query_standarhargabarang_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query =$query_standarhargabarang_default; 
																		}
																}
															break;
															case '2':
																{
																//Standar Harga Pemeliharaan
                                                                                $query = $query_standarhargapemeliharaan_condition; 
																if($parameter_sql!="" ) {
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_standarhargapemeliharaan_default; 
																		}
																}
															break;
															case '3':
																{
																//Standar Kebutuhan Barang
																if($parameter_sql!="" ) {
                                                                                $query = $query_standarkebutuhanbarang_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_standarkebutuhanbarang_default;  
																		}
																}
															break;
															case '4':
																{
																//Rencana Kebutuhan Barang
																
																if($parameter_sql!="" ) {
                                                                                $query = $query_rkbu_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_rkbu_default; 
																		}
																}
															break;
															case '5':
																{
																//Rencana Kebutuhan Pemeliharaan Barang
																if($parameter_sql!="" ) {
                                                                                $query =$query_rkpbu_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query =$query_rkpbu_default; 
																		}
																}
															break;
															case '6':
																{
																//Rencana Tahunan Barang
																if($parameter_sql!="" ) {
                                                                                $query = $query_rtb_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_rtb_default; 
																		}
																}
															break;
															case '7':
																{
																//Rencana Tahunan Pemeliharaan Barang
																if($parameter_sql!="" ) {
                                                                                $query = $query_rtpb_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_rtpb_default; 
																		}
																}
															break;
															case '8':
																{
																//Daftar Kebutuhan Barang Milik Daerah
																if($parameter_sql!="" ) {
                                                                                $query = $query_dkbmd_condition;  
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_dkbmd_default; 
																		}
																}
															break;
															case '9':
																{
																//Daftar Kebutuhan Pemeliharaan Barang Milik Daerah
																if($parameter_sql!="" ) {
                                                                                $query = $query_dkpbmd_condition; 
																		}
																if($parameter_sql=="" ) {
                                                                                $query = $query_dkpbmd_default; 
																		}
																}
															break;
															
																
														}
													}
												}
											  break;	
											}
										}
						
							}
                    break;
					
					case '51':
						{
						
							if (isset($mode))
							{ 
								switch($mode)
								{
									case '1':
									{ 
										//echo 'ada';
										// jalankan query berdasarkan kondisi yang ada
										if($parameter_sql!="")
										{
											
											//print_r($parameter_sql);
											echo 'mode 1';
											exit;
											$query = $query_katalog_aset_condition;
											
										}
										
										if($parameter_sql == "")
										{
										//echo 'mode 1 masuk';
										
										var_dump($parameter_sql);
										exit;
											$query = $query_katalog_aset_default;
										}
										
									}
									break;
									case '2':
									{
										if($parameter_sql!="")
										{
											
											//print_r($parameter_sql);
											//echo 'ada';
											//exit;
											$query = $query_katalog_aset_condition;
											
										}
										
										if($parameter_sql=="")
										{
										//echo 'masuk';
										
										//print_r($parameter_sql);
										//exit;
											$query = $query_katalog_aset_default;
										}
									}
									break;
									case '2':
									{	
										// cek query ke tabel apl_userasetlist dulu
										// baru lakukan query ke tbl aset 
									}
								}
								break;
							}
						}
					//cetak 
               }
               $this->query_report=$query;
               return $query;
     }
     }
	 
    
    
    public function _cek_data_satker_($tahun){
		
		//print_r($parameter);
		//$tahun = $parameter['tahun'];
		//echo 'ada'.$tahun;
        $query = "  select a.LastSatker_ID, b.NamaSatker from Aset as a left outer join Satker as b 
					on a.LastSatker_ID = b.Satker_ID
                    where a.NIlaiPerolehan is not null group by a.LastSatker_ID ";
        //print_r($query);
		$result = $this->query($query) or die ($this->error());
        
        while($data = $this->fetch_object($result)){
            if ($data->NamaSatker !='')
            {
                
                $rekap[$data->LastSatker_ID][] = $data->NamaSatker;
                
            }
            
			
        }
        
        return $rekap;
    }
    
    public function _cek_data_satker_with_id($param, $bool){
		
		if ($bool == TRUE)
		{
			foreach ($param as $satker_id):
		
			$query = "  select a.LastSatker_ID, b.NamaSatker from Aset as a 
						left outer join Satker as b on a.LastSatker_ID = b.Satker_ID
						where a.LastSatker_ID = $satker_id group by a.LastSatker_ID ";
			//print_r($query);
			$result = $this->query($query) or die ($this->error());
			
			while($data = $this->fetch_object($result)){
				if ($data->NamaSatker !='')
				{
					
					$rekap[$data->LastSatker_ID][] = $data->NamaSatker;
					
				}
				
				
			}
			
			endforeach;
		}
		else
		{
			$query = "  select a.LastSatker_ID, b.NamaSatker from Aset as a left outer join Satker as b 
						on a.LastSatker_ID = b.Satker_ID
						where a.NIlaiPerolehan is not null group by a.LastSatker_ID ";
			//print_r($query);
			$result = $this->query($query) or die ($this->error());
			
			while($data = $this->fetch_object($result)){
				if ($data->NamaSatker !='')
				{
					
					$rekap[$data->LastSatker_ID][] = $data->NamaSatker;
					
				}
				
				
			}
		}
		
        
        return $rekap;
    }
    
    public function validasi_data_satker_id ($satker)
    {
		if($satker!=""){
		
		$temp=explode(",",$satker);
		$panjang=count($temp);
		
		$cek=0;
		for($i=0;$i<$panjang;$i++)
			{
				$cek=1;
					if($i==0)
					$query_satker.="Satker_ID ='$temp[$i]'";
					else
					$query_satker.=" or Satker_ID ='$temp[$i]'";
			}
						
			/*$query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
													WHERE $query_satker";*/
			$query_change_satker="SELECT KodeSektor,KodeSatker,KodeUnit,Gudang,NamaSatker FROM Satker  
                                                    WHERE $query_satker";
					
					
			$exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
			while($proses_kode=$this->fetch_array($exec_query_change_satker)){
				   
					/*if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
					$query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
					}
					if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
						$query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
					}*/
					if($proses_kode['KodeSektor'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != "" && $proses_kode['Gudang'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "' AND
													Gudang='" . $proses_kode['Gudang'] . "'";
					}								
					//ini dari ka andreas
					$exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
					while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
						$dataRow2[]=$proses_kode2['Satker_ID'];
					}
					if($dataRow2!=""){
						$panjang=count($dataRow2);
						$query_satker_fix="(";
						$cek=0;
						for($i=0;$i<$panjang;$i++)
							{
								$cek=1;

									if($i==0)
									{
									$get_satker[] = $dataRow2[$i];
									//$query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
									}
									else
									{
									$get_satker[] = $dataRow2[$i];
									//$query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
								}
							}
							
						}
					}
						
						$get_satker = $this->_cek_data_satker_with_id($get_satker, true);
				}
			
			
		
		else
		{
			$get_satker = $this->_cek_data_satker_with_id($get_satker, false);
		}
		
		return $get_satker;
	}
    
    public function _cek_data_satker_mutasi($parameter){
        
        $tgl_awal = $parameter['tgl_awal'];
        $tgl_akhir = $parameter['tgl_akhir'];
        
        $query = "  select distinct a.LastSatker_ID, s.NamaSatker from Aset AS a  LEFT JOIN Satker AS s ON
                    a.LastSatker_ID = s.Satker_ID where a.Aset_ID
                    in (SELECT ka.Aset_ID FROM KuantitasAset AS ka where ka.TglKuantitas >='$tgl_awal'
                    and ka.TglKuantitas <='$tgl_akhir' UNION SELECT na.Aset_ID FROM NilaiAset AS na
                    where na.TglNilai >='$tgl_awal' and na.TglNilai <='$tgl_akhir' UNION SELECT b.Aset_ID
                    FROM Aset AS b where b.TglPerolehan >='$tgl_awal' and b.TglPerolehan <='$tgl_akhir' UNION SELECT c.Aset_ID
                    FROM Aset AS c where c.TglHapus >='$tgl_awal' and c.TglHapus <='$tgl_akhir' ) order by a.LastSatker_ID ";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());
        
        while($data = $this->fetch_object($result)){
            if ($data->NamaSatker !='')
            {
               // echo 'ada';
                $rekap[$data->LastSatker_ID][] = $data->NamaSatker;
                
            }
            
        }
        
        return $rekap;
    }
    
    
    public function getLogo($dataLogo,$url_rewrite)
    {
	if ($dataLogo !='')
	{
		switch ($dataLogo)
		{
			case 'bireun':
			{
				$path = "$this->url_rewrite/report/images/bireun.gif";
				
				return $path;
			}
			break;
			
			case 'aceh':
			{
				$path = "$this->url_rewrite/report/images/aceh.jpg";
				
				return $path;
			}
			break;
			
		}
	}
}
     
    public function retrieve_query($query){
          $result= $this->query($query);
          $rows = $this->num_rows($result);
	if ($rows)
	{
		    while ($data = $this->fetch_object($result))
		    {
			    $data_reporting[] = $data;
		    }
                return $data_reporting; //Get Data
	}
	else
	{
                return 0; //NULL data
		//echo '<script type=text/javascript>alert("Tidak ada data yang tersedia"); history.back();</script>';
	}
     }
	 
     //REVISI REKAP INDUK
    public function get_report_rekap_inv_daerah($tahun)
    {
		$TAMBAHAN_QUERY_KIB = 'a.Status_Validasi_Barang=1';//and a.Tahun = '$tahun' 
        
        $query_get_golongan_1 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                    left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                    left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.Tahun = '$tahun' AND $TAMBAHAN_QUERY_KIB where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
        $query_get_golongan_2 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                    left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                    left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.Tahun = '$tahun' AND $TAMBAHAN_QUERY_KIB where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
        $query_get_golongan_3 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                    left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                    left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.Tahun = '$tahun' AND $TAMBAHAN_QUERY_KIB where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
        $query_get_golongan_4 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                    left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                    left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.Tahun = '$tahun' AND $TAMBAHAN_QUERY_KIB where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_5 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                    left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                    left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.Tahun = '$tahun' AND $TAMBAHAN_QUERY_KIB where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_6 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                    left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                    left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.Tahun = '$tahun' AND $TAMBAHAN_QUERY_KIB where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_7 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                    left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                    left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.Tahun = '$tahun' AND $TAMBAHAN_QUERY_KIB where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        
        $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
        //pr($query_get_golongan_2);
        for ($i = 0; $i <=6; $i++)
        {
            $result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
            if ($result_golongan)
            {
               
                while ($data = $this->fetch_object($result_golongan))
                {
                    $dataArr['Golongan_'.($i+1)] [] = $data;
                    //echo "ada";
                    //print_r($dataArr);
                }
            }
            
            $result_golongan = '';
        }
        //pr($dataArr);
        return $dataArr;
    }
    
    
    
    
    //REVISI REKAP SKPD
    public function get_report_rekap_inv_skpd($parameter,$tahun)
    {
         $TAMBAHAN_QUERY='a.Status_Validasi_Barang=1';
        foreach ($parameter as $Satker_ID => $value)
        {
            
            $query_get_golongan_1 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(a.Aset_ID)as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                        left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                        left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID = '$Satker_ID' and a.Tahun = '$tahun' and $TAMBAHAN_QUERY where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
            $query_get_golongan_2 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(a.Aset_ID)as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                        left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                        left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID = '$Satker_ID' and a.Tahun = '$tahun' and $TAMBAHAN_QUERY where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
            $query_get_golongan_3 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(a.Aset_ID)as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                        left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                        left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID = '$Satker_ID' and a.Tahun = '$tahun' and $TAMBAHAN_QUERY where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode  ";
            $query_get_golongan_4 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(a.Aset_ID)as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                        left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                        left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID = '$Satker_ID' and a.Tahun = '$tahun' and $TAMBAHAN_QUERY  where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
            $query_get_golongan_5 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(a.Aset_ID)as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                        left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                        left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID = '$Satker_ID' and a.Tahun = '$tahun' and $TAMBAHAN_QUERY where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
            $query_get_golongan_6 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(a.Aset_ID)as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                        left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                        left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID = '$Satker_ID' and a.Tahun = '$tahun' and $TAMBAHAN_QUERY where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
            $query_get_golongan_7 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(a.Aset_ID)as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k 
                                        left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
                                        left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID = '$Satker_ID' and a.Tahun = '$tahun' where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
            
            $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
            // pr($query_get_golongan_1);
            for ($i = 0; $i <=6; $i++)
            {
                $result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
                if ($result_golongan)
                {
                   
                    while ($data = $this->fetch_object($result_golongan))
                    {
                        $dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)][] = $data;
                        //echo "ada";
                        //echo"<pre>";
                        //print_r($dataArr);
                        //echo"</pre>";
                    }
                }
                
                //$result_golongan = '';
            }
        }
        
        return $dataArr;
    }
    
    //Rekapitulasi Pengadaan BMD	
    //REVISI REKAP PENGADAAN
    //Rekapitulasi Pengadaan BMD	
    public function get_report_rekap_pengadaan_BMD($param)
		
		{
		/*echo"<pre>";
        print_r($param);
        echo"</pre>";*/
         
        if ($param['tanggal_awal'] !='')
        {
			$tanggal_awal = " and a.TglPerolehan >= '$param[tanggal_awal]' ";
			
		}
		if ($param['tanggal_akhir'] !='')
        {
			$tanggal_akhir = " and a.TglPerolehan <= '$param[tanggal_akhir]' ";
			
		}
		
		$TAMBAHAN_QUERY='a.Status_Validasi_Barang=1';
		foreach ($param['Satker_ID'] as $Satker_ID => $value)
		{
			
			$query_get_golongan_1 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan !=2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker CC on a.LastSatker_ID=CC.Satker_ID left join KontrakAset KA on KA.Aset_ID= a.Aset_ID left join Kontrak KO on KO.Kontrak_ID= KA.Kontrak_ID left join KontrakSP2D KS on KS.Kontrak_ID= KO.Kontrak_ID left join SP2D S on S.SP2D_ID= KS.SP2D_ID where  k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
			$query_get_golongan_2 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan !=2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker CC on a.LastSatker_ID=CC.Satker_ID left join KontrakAset KA on KA.Aset_ID= a.Aset_ID left join Kontrak KO on KO.Kontrak_ID= KA.Kontrak_ID left join KontrakSP2D KS on KS.Kontrak_ID= KO.Kontrak_ID left join SP2D S on S.SP2D_ID= KS.SP2D_ID where  k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
			$query_get_golongan_3 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan !=2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker CC on a.LastSatker_ID=CC.Satker_ID left join KontrakAset KA on KA.Aset_ID= a.Aset_ID left join Kontrak KO on KO.Kontrak_ID= KA.Kontrak_ID left join KontrakSP2D KS on KS.Kontrak_ID= KO.Kontrak_ID left join SP2D S on S.SP2D_ID= KS.SP2D_ID where  k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
			$query_get_golongan_4 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan !=2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker CC on a.LastSatker_ID=CC.Satker_ID left join KontrakAset KA on KA.Aset_ID= a.Aset_ID left join Kontrak KO on KO.Kontrak_ID= KA.Kontrak_ID left join KontrakSP2D KS on KS.Kontrak_ID= KO.Kontrak_ID left join SP2D S on S.SP2D_ID= KS.SP2D_ID where  k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
			$query_get_golongan_5 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan !=2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker CC on a.LastSatker_ID=CC.Satker_ID left join KontrakAset KA on KA.Aset_ID= a.Aset_ID left join Kontrak KO on KO.Kontrak_ID= KA.Kontrak_ID left join KontrakSP2D KS on KS.Kontrak_ID= KO.Kontrak_ID left join SP2D S on S.SP2D_ID= KS.SP2D_ID where  k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
			$query_get_golongan_6 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan !=2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker CC on a.LastSatker_ID=CC.Satker_ID left join KontrakAset KA on KA.Aset_ID= a.Aset_ID left join Kontrak KO on KO.Kontrak_ID= KA.Kontrak_ID left join KontrakSP2D KS on KS.Kontrak_ID= KO.Kontrak_ID left join SP2D S on S.SP2D_ID= KS.SP2D_ID where  k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
			$query_get_golongan_7 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan !=2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker CC on a.LastSatker_ID=CC.Satker_ID left join KontrakAset KA on KA.Aset_ID= a.Aset_ID left join Kontrak KO on KO.Kontrak_ID= KA.Kontrak_ID left join KontrakSP2D KS on KS.Kontrak_ID= KO.Kontrak_ID left join SP2D S on S.SP2D_ID= KS.SP2D_ID where  k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
			
			$dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
			// pr($query_get_golongan_1);
			//echo"<br>";
			//print_r($query_get_golongan_1);
			
			//exit;
			for ($i = 0; $i <=6; $i++)
			{
				$result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
				
				if ($result_golongan)
				{
				   //echo 'ada';
					while ($data = $this->fetch_object($result_golongan))
					{
						$dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)][] = $data;
					}
				}
				
				//$result_golongan = '';
			}
        }
        return $dataArr;
    }
    
    
    
	//REVISI REKAP PEMELIHARAAN 
 //Rekapitulasi Pemeliharaan BMD
    public function get_report_rekap_pemeliharaan_BMD($param)
    {
		/*echo"<pre>";
        print_r($param);
        echo"</pre>";*/
        
        if ($param['tanggal_awal'] !='')
        {
			$tanggal_awal = " and p.TglPemeliharaan >= '$param[tanggal_awal]' ";
			
		}
		if ($param['tanggal_akhir'] !='')
        {
			$tanggal_akhir = " and p.TglPemeliharaan <= '$param[tanggal_akhir]' ";
			
		}
		$TAMBAHAN_QUERY='a.Status_Validasi_Barang=1';
		foreach ($param['Satker_ID'] as $Satker_ID => $value)
		{
        $query_get_golongan_1 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(p.Biaya) as Biaya from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join (Aset a join Pemeliharaan p on p.Aset_ID=a.Aset_ID) on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='$Satker_ID' and $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_2 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(p.Biaya) as Biaya from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join (Aset a join Pemeliharaan p on p.Aset_ID=a.Aset_ID) on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='$Satker_ID' and $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_3 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(p.Biaya) as Biaya from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join (Aset a join Pemeliharaan p on p.Aset_ID=a.Aset_ID) on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='$Satker_ID' and $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_4 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(p.Biaya) as Biaya from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join (Aset a join Pemeliharaan p on p.Aset_ID=a.Aset_ID) on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='$Satker_ID' and $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_5 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(p.Biaya) as Biaya from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join (Aset a join Pemeliharaan p on p.Aset_ID=a.Aset_ID) on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='$Satker_ID' and $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_6 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(p.Biaya) as Biaya from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join (Aset a join Pemeliharaan p on p.Aset_ID=a.Aset_ID) on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='$Satker_ID' and $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_7 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(p.Biaya) as Biaya from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join (Aset a join Pemeliharaan p on p.Aset_ID=a.Aset_ID) on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='$Satker_ID' and $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        
        $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
        
        pr($query_get_golongan_2);	
		//exit;
			
        for ($i = 0; $i <=6; $i++)
        {
            $result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
            if ($result_golongan)
            {
               
                while ($data = $this->fetch_object($result_golongan))
					{
						$dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)][] = $data;
					}
            }
            
            //$result_golongan = '';
        }
        }
        return $dataArr;
    }
   
	//REVISI REKAP HIBAH
 //Rekapitulasi Penerimaan Barang Dari Pihak III
    public function get_report_rekap_penerimaan_pihak_ketiga($param)
    {
        /*echo"<pre>";
        print_r($param);
        echo"</pre>";*/
        
        if ($param['tanggal_awal'] !='')
        {
			$tanggal_awal = " and a.TglPerolehan >= '$param[tanggal_awal]' ";
			
		}
		if ($param['tanggal_akhir'] !='')
        {
			$tanggal_akhir = " and a.TglPerolehan <= '$param[tanggal_akhir]' ";
			
		}
		$TAMBAHAN_QUERY='a.Status_Validasi_Barang=1';
		foreach ($param['Satker_ID'] as $Satker_ID => $value)
		{
			$query_get_golongan_1 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan, o.NamaSatker from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan =2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker o on a.OrigSatker_ID=o.Satker_ID left join Satker cc on a.LastSatker_ID=cc.Satker_ID left join Satker c on c.KodeSektor=cc.KodeSektor and c.KodeSatker=cc.KodeSatker and c.KodeUnit is null left join Kelompok d on a.Kelompok_ID=d.Kelompok_ID left join Kondisi e on e.Kondisi_ID=a.LastKondisi_ID where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
			$query_get_golongan_2 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan, o.NamaSatker from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan =2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker o on a.OrigSatker_ID=o.Satker_ID left join Satker cc on a.LastSatker_ID=cc.Satker_ID left join Satker c on c.KodeSektor=cc.KodeSektor and c.KodeSatker=cc.KodeSatker and c.KodeUnit is null left join Kelompok d on a.Kelompok_ID=d.Kelompok_ID left join Kondisi e on e.Kondisi_ID=a.LastKondisi_ID where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
			$query_get_golongan_3 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan, o.NamaSatker from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan =2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker o on a.OrigSatker_ID=o.Satker_ID left join Satker cc on a.LastSatker_ID=cc.Satker_ID left join Satker c on c.KodeSektor=cc.KodeSektor and c.KodeSatker=cc.KodeSatker and c.KodeUnit is null left join Kelompok d on a.Kelompok_ID=d.Kelompok_ID left join Kondisi e on e.Kondisi_ID=a.LastKondisi_ID where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
			$query_get_golongan_4 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan, o.NamaSatker from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan =2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker o on a.OrigSatker_ID=o.Satker_ID left join Satker cc on a.LastSatker_ID=cc.Satker_ID left join Satker c on c.KodeSektor=cc.KodeSektor and c.KodeSatker=cc.KodeSatker and c.KodeUnit is null left join Kelompok d on a.Kelompok_ID=d.Kelompok_ID left join Kondisi e on e.Kondisi_ID=a.LastKondisi_ID where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
			$query_get_golongan_5 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan, o.NamaSatker from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan =2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker o on a.OrigSatker_ID=o.Satker_ID left join Satker cc on a.LastSatker_ID=cc.Satker_ID left join Satker c on c.KodeSektor=cc.KodeSektor and c.KodeSatker=cc.KodeSatker and c.KodeUnit is null left join Kelompok d on a.Kelompok_ID=d.Kelompok_ID left join Kondisi e on e.Kondisi_ID=a.LastKondisi_ID where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
			$query_get_golongan_6 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan, o.NamaSatker from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan =2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker o on a.OrigSatker_ID=o.Satker_ID left join Satker cc on a.LastSatker_ID=cc.Satker_ID left join Satker c on c.KodeSektor=cc.KodeSektor and c.KodeSatker=cc.KodeSatker and c.KodeUnit is null left join Kelompok d on a.Kelompok_ID=d.Kelompok_ID left join Kondisi e on e.Kondisi_ID=a.LastKondisi_ID where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
			$query_get_golongan_7 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, sum(a.Kuantitas) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan, o.NamaSatker from Kelompok k left join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.CaraPerolehan =2 and a.LastSatker_ID='$Satker_ID' AND $TAMBAHAN_QUERY $tanggal_awal $tanggal_akhir left join Satker o on a.OrigSatker_ID=o.Satker_ID left join Satker cc on a.LastSatker_ID=cc.Satker_ID left join Satker c on c.KodeSektor=cc.KodeSektor and c.KodeSatker=cc.KodeSatker and c.KodeUnit is null left join Kelompok d on a.Kelompok_ID=d.Kelompok_ID left join Kondisi e on e.Kondisi_ID=a.LastKondisi_ID where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
			
			$dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
			
			// print_r($query_get_golongan_1);	
			//exit;
        for ($i = 0; $i <=6; $i++)
        {
            $result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
            if ($result_golongan)
            {
               
                while ($data = $this->fetch_object($result_golongan))
					{
						$dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)][] = $data;
					}
            }
            
            //$result_golongan = '';
        }
		
        }
        return $dataArr;
    }
    
    
    public function get_report_rekap_LMB_daerah_semester($parameter)
    {
        //$Satker_ID = $parameter['Satker_ID'];
        $Satker_ID = '11077, 10257';
        $query_get_golongan_1 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='10416' and a.Aset_ID in (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_2 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='10416' and a.Aset_ID in (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_3 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='10416' and a.Aset_ID in (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_4 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='10416' and a.Aset_ID in (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_5 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='10416' and a.Aset_ID in (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_6 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='10416' and a.Aset_ID in (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        $query_get_golongan_7 = "   select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID='10416' and a.Aset_ID in (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31' UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode ";
        
        $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
        
        for ($i = 0; $i <=6; $i++)
        {
            $result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
            if ($result_golongan)
            {
               
                while ($data = $this->fetch_object($result_golongan))
                {
                    $dataArr['Golongan_'.($i+1)] [] = $data;
                }
            }
            
            $result_golongan = '';
        }
        
        return $dataArr;
    }
    

    
    public function get_rekap_awal($parameter)
    {
        /*
        $golongan = $parameter['golongan'];
        $tanggal_awal = $parameter['tanggal_awal'];
        $Satker_ID = $parameter['Satker_ID'];
        */
        $golongan = '01';
        $tanggal_awal = '2011-12-31';
        //$parameter = array('10252');
        
        foreach ($parameter as $Satker_ID => $value)
        {
            $query_get_awal_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                    where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_awal_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                    where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_awal_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                    where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_awal_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                    where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_awal_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                    where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_awal_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                    where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_awal_golongan_7 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                    UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                    where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            
            $query_get_mutasi_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_mutasi_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_mutasi_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_mutasi_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_mutasi_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_mutasi_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_mutasi_golongan_7 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
                                    
            $query_get_akhir_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                            (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                            UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                            where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                            k.Bidang, k.Uraian order by k.Kode ";
            $query_get_akhir_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                            (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                            UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                            where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                            k.Bidang, k.Uraian order by k.Kode ";
            $query_get_akhir_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                            (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                            UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                            where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                            k.Bidang, k.Uraian order by k.Kode ";
            $query_get_akhir_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                            (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                            UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                            where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                            k.Bidang, k.Uraian order by k.Kode ";
            $query_get_akhir_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                            (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                            UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                            where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                            k.Bidang, k.Uraian order by k.Kode ";
            $query_get_akhir_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                            (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                            UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                            where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                            k.Bidang, k.Uraian order by k.Kode ";
            $query_get_akhir_golongan_7 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                            (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                            UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                            UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                            where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                            k.Bidang, k.Uraian order by k.Kode ";
                                            
            
            $data_awal_Golongan = array('query_get_awal_golongan_1', 'query_get_awal_golongan_2', 'query_get_awal_golongan_3', 'query_get_awal_golongan_4', 'query_get_awal_golongan_5', 'query_get_awal_golongan_6', 'query_get_awal_golongan_7');
            
            $data_mutasi_golongan = array('query_get_mutasi_golongan_1', 'query_get_mutasi_golongan_2', 'query_get_mutasi_golongan_3', 'query_get_mutasi_golongan_4', 'query_get_mutasi_golongan_5', 'query_get_mutasi_golongan_6', 'query_get_mutasi_golongan_7');
            
            $data_akhir_golongan = array('query_get_akhir_golongan_1', 'query_get_akhir_golongan_2', 'query_get_akhir_golongan_3', 'query_get_akhir_golongan_4', 'query_get_akhir_golongan_5', 'query_get_akhir_golongan_6', 'query_get_akhir_golongan_7');
            
            for ($i = 0; $i <=6; $i++)
            {
                $result_golongan = $this->query($$data_awal_Golongan[$i]) or die ($this->error('error golongan'));
                if ($result_golongan)
                {
                   
                    while ($data = $this->fetch_object($result_golongan))
                    {
                        $dataArr[$Satker_ID][$value[0]]['Awal']['Golongan_'.($i+1)][] = $data;
                        
                    }
                }
                
                //$result_golongan = '';
            }
            for ($i = 0; $i <=6; $i++)
            {
                $result_golongan = $this->query($$data_mutasi_golongan[$i]) or die ($this->error('error golongan'));
                if ($result_golongan)
                {
                   
                    while ($data = $this->fetch_object($result_golongan))
                    {
                        $dataArr[$Satker_ID][$value[0]]['Mutasi']['Golongan_'.($i+1)][] = $data;
                        
                    }
                }
                
                //$result_golongan = '';
            }
            for ($i = 0; $i <=6; $i++)
            {
                $result_golongan = $this->query($$data_akhir_golongan[$i]) or die ($this->error('error golongan'));
                if ($result_golongan)
                {
                   
                    while ($data = $this->fetch_object($result_golongan))
                    {
                        $dataArr[$Satker_ID][$value[0]]['Akhir']['Golongan_'.($i+1)][] = $data;
                        
                    }
                }
                
                //$result_golongan = '';
            }
            
            return $dataArr;
        }
    }
    
    public function get_rekap_mutasi($parameter)
    {
        /*
        $golongan = $parameter['golongan'];
        $tanggal_awal = $parameter['tanggal_awal'];
        $tanggal_akhir = $parameter['tanggal_akhir'];
        $Satker_ID = $parameter['Satker_ID'];
        */
        $golongan = '01';
        $tanggal_awal = '2012-01-01';
        $tanggal_akhir = '2012-12-31';
        
        foreach ($parameter as $Satker_ID => $value)
        {
            $query_get_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $query_get_golongan_7 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                    (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                    UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                    UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                    where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                    ";
            $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
            
            
            for ($i = 0; $i <=6; $i++)
            {
                $result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
                if ($result_golongan)
                {
                   
                    while ($data = $this->fetch_object($result_golongan))
                    {
                        $dataArr[$Satker_ID][$value[0]]['Mutasi']['Golongan_'.($i+1)][] = $data;
                        
                    }
                }
                
                //$result_golongan = '';
            }
            
            return $dataArr;
        }
        
        /*
        $Satker_ID = '10252';
        
        $query = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                        where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                        ";
        $result = $this->query($query) or die ($this->error('error 1'));
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[$Satker_ID]['Mutasi'][] = $data;
            }
            return $dataArr;
        }
        else
        {
            return false;
        }
        */
    }
    
    public function get_rekap_akhir($parameter)
    {
        /*
        $golongan = $parameter['golongan'];
        $tanggal_akhir = $parameter['tanggal_akhir'];
        $Satker_ID = $parameter['Satker_ID'];
        */
        $golongan = '01';
        $tanggal_akhir = '2012-12-31';
        $Satker_ID = '10252';
        
        $query = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                        UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                        UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                        where k.Golongan='$golongan' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                        k.Bidang, k.Uraian order by k.Kode ";
        $result = $this->query($query) or die ($this->error('error 1'));
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[$Satker_ID]['Akhir'][] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        } 
    }
    
    
    public function get_rekap_mutasi_barang_skpd_semesteran($parameter)
    {
        $query_awal = "select AZ.NomorReg,AZ.NamaAset,AZ.Kuantitas,AZ.NilaiPerolehan,AZ.AsalUsul,AZ.Tahun,
                        BG.Konstruksi, BG.StatusTanah,
                        SA.KodeSektor, SA.KodeSatker, SA.NamaSatker, 
                        KL.Kode,
                        KI.InfoKondisi, KI.Baik, KI.RusakRingan, KI.RusakBerat, 
                        TN.NoSertifikat, TN.TglSertifikat, 
                        MS.Merk, MS.Pabrik,MS.NoRangka, MS.NoMesin, MS.Bobot from Aset AZ 
                        left outer join Satker SA on AZ.LastSatker_ID=SA.Satker_ID 
                        left outer join Kelompok KL on AZ.Kelompok_ID=KL.Kelompok_ID 
                        left outer join Kondisi KI on AZ.LastKondisi_ID=KI.Kondisi_ID 
                        left outer join Tanah TN on AZ.Aset_ID=TN.Aset_ID 
                        left outer join Mesin MS on AZ.Aset_ID=MS.Aset_ID 
                        left outer join Bangunan BG on AZ.Aset_ID=BG.Aset_ID 
                        left outer join Jaringan JR on AZ.Aset_ID=JR.Aset_ID 
                        left outer join AsetLain AL on AZ.Aset_ID=AL.Aset_ID 
                        left outer join KDP P on AZ.Aset_ID=P.Aset_ID 
                        left outer join KontrakAset KA on AZ.Aset_ID=KA.Aset_ID
                        left outer join Kontrak KO on KA.Kontrak_ID=KO.Kontrak_ID where AZ.Aset_ID in 
                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='2011-12-31' 
                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='2011-12-31'  
                        UNION SELECT Aset_ID FROM Aset where TglPerolehan <='2011-12-31' 
                        UNION SELECT Aset_ID FROM Aset where TglHapus <='2011-12-31' ) 
                        order by LastSatker_ID ";
        $query_mutasi = "select AZ.NomorReg,AZ.NamaAset,AZ.Kuantitas,AZ.NilaiPerolehan,AZ.AsalUsul,AZ.Tahun,
                        BG.Konstruksi, BG.StatusTanah,
                        SA.KodeSektor, SA.KodeSatker, SA.NamaSatker, 
                        KL.Kode,
                        KI.InfoKondisi, KI.Baik, KI.RusakRingan, KI.RusakBerat, 
                        TN.NoSertifikat, TN.TglSertifikat, 
                        MS.Merk, MS.Pabrik,MS.NoRangka, MS.NoMesin, MS.Bobot from Aset AZ 
                        left outer join Satker SA on AZ.LastSatker_ID=SA.Satker_ID 
                        left outer join Kelompok KL on AZ.Kelompok_ID=KL.Kelompok_ID 
                        left outer join Kondisi KI on AZ.LastKondisi_ID=KI.Kondisi_ID 
                        left outer join Tanah TN on AZ.Aset_ID=TN.Aset_ID 
                        left outer join Mesin MS on AZ.Aset_ID=MS.Aset_ID 
                        left outer join Bangunan BG on AZ.Aset_ID=BG.Aset_ID 
                        left outer join Jaringan JR on AZ.Aset_ID=JR.Aset_ID 
                        left outer join AsetLain AL on AZ.Aset_ID=AL.Aset_ID 
                        left outer join KDP P on AZ.Aset_ID=P.Aset_ID 
                        left outer join KontrakAset KA on AZ.Aset_ID=KA.Aset_ID
                        left outer join Kontrak KO on KA.Kontrak_ID=KO.Kontrak_ID where AZ.Aset_ID in 
                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='2012-01-01' and TglKuantitas <='2012-12-31' 
                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='2012-01-01' and TglNilai <='2012-12-31' 
                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='2012-01-01' and TglPerolehan <='2012-12-31'
                        UNION SELECT Aset_ID FROM Aset where TglHapus >='2012-01-01' and TglHapus <='2012-12-31' ) 
                        order by LastSatker_ID ";
        $query_akhir = "select AZ.NomorReg,AZ.NamaAset,AZ.Kuantitas,AZ.NilaiPerolehan,AZ.AsalUsul,AZ.Tahun,
                        BG.Konstruksi, BG.StatusTanah,
                        SA.KodeSektor, SA.KodeSatker, SA.NamaSatker, 
                        KL.Kode,
                        KI.InfoKondisi, KI.Baik, KI.RusakRingan, KI.RusakBerat, 
                        TN.NoSertifikat, TN.TglSertifikat, 
                        MS.Merk, MS.Pabrik,MS.NoRangka, MS.NoMesin, MS.Bobot from Aset AZ 
                        left outer join Satker SA on AZ.LastSatker_ID=SA.Satker_ID 
                        left outer join Kelompok KL on AZ.Kelompok_ID=KL.Kelompok_ID 
                        left outer join Kondisi KI on AZ.LastKondisi_ID=KI.Kondisi_ID 
                        left outer join Tanah TN on AZ.Aset_ID=TN.Aset_ID 
                        left outer join Mesin MS on AZ.Aset_ID=MS.Aset_ID 
                        left outer join Bangunan BG on AZ.Aset_ID=BG.Aset_ID 
                        left outer join Jaringan JR on AZ.Aset_ID=JR.Aset_ID 
                        left outer join AsetLain AL on AZ.Aset_ID=AL.Aset_ID 
                        left outer join KDP P on AZ.Aset_ID=P.Aset_ID 
                        left outer join KontrakAset KA on AZ.Aset_ID=KA.Aset_ID
                        left outer join Kontrak KO on KA.Kontrak_ID=KO.Kontrak_ID where AZ.Aset_ID in 
                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='2012-12-31' 
                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='2012-12-31'  
                        UNION SELECT Aset_ID FROM Aset where TglPerolehan <='2012-12-31' 
                        UNION SELECT Aset_ID FROM Aset where TglHapus <='2012-12-31' ) 
                        order by LastSatker_ID ";
                        
        $array_var = array('query_awal','query_mutasi','query_akhir');
        
        $result_awal = $this->query($query_awal) or die ($this->error());
        $result_mutasi = $this->query($query_mutasi) or die ($this->error());
        $result_akhir = $this->query($query_akhir) or die ($this->error());
        
        while ($data_awal = $this->fetch_object($result_awal))
        {
            
            $dataArr['awal'] [] = $data_awal;
        }
        
        while ($data_mutasi = $this->fetch_object($result_mutasi))
        {
            
            $dataArr['mutasi'] [] = $data_mutasi;
        }
        while ($data_akhir = $this->fetch_object($result_akhir))
        {
            
            $dataArr['akhir'] [] = $data_akhir;
        }
        
        return $dataArr;
    }
    
    
    public function get_rekap_laporan_mutasi($parameter, $tanggal_awal, $tanggal_akhir)
    {
        
        
        
        if ($parameter !='')
        {
            foreach ($parameter as $Satker_ID => $value)
            {
                
                //echo $Satker_ID.'<br>>';
                $query_get_awal_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                        where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_awal_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                        where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_awal_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                        where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_awal_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                        where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_awal_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                        where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_awal_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                        where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_awal_golongan_7 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM NilaiAset where  TglNilai < '$tanggal_awal'  
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan < '$tanggal_awal' 
                                        UNION SELECT Aset_ID FROM Aset where TglHapus < '$tanggal_awal' ) 
                                        where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                
                $query_get_mutasi_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                        where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_mutasi_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                        where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_mutasi_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                        where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_mutasi_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                        where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_mutasi_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                        where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_mutasi_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                        where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                $query_get_mutasi_golongan_7 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                        (SELECT Aset_ID FROM KuantitasAset where TglKuantitas >='$tanggal_awal' and TglKuantitas <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM NilaiAset where TglNilai >='$tanggal_awal' and TglNilai <='$tanggal_akhir' 
                                        UNION SELECT Aset_ID FROM Aset where TglPerolehan >='$tanggal_awal' and TglPerolehan <='$tanggal_akhir'
                                        UNION SELECT Aset_ID FROM Aset where TglHapus >='$tanggal_awal' and TglHapus <='$tanggal_akhir' ) 
                                        where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode 
                                        ";
                                        
                $query_get_akhir_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                                (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                                UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                                where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                                k.Bidang, k.Uraian order by k.Kode ";
                $query_get_akhir_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                                (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                                UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                                where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                                k.Bidang, k.Uraian order by k.Kode ";
                $query_get_akhir_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                                (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                                UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                                where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                                k.Bidang, k.Uraian order by k.Kode ";
                $query_get_akhir_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                                (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                                UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                                where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                                k.Bidang, k.Uraian order by k.Kode ";
                $query_get_akhir_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                                (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                                UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                                where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                                k.Bidang, k.Uraian order by k.Kode ";
                $query_get_akhir_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                                (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                                UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                                where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                                k.Bidang, k.Uraian order by k.Kode ";
                $query_get_akhir_golongan_7 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian, count(a.Aset_ID) as Jumlah, sum(a.NilaiPerolehan) as NilaiPerolehan from Kelompok k left outer join Kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang left outer join Aset a on a.Kelompok_ID = x.Kelompok_ID and a.LastSatker_ID IN ($Satker_ID) and a.Aset_ID in 
                                                (SELECT Aset_ID FROM KuantitasAset where  TglKuantitas <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM NilaiAset where  TglNilai <='$tanggal_akhir'  
                                                UNION SELECT Aset_ID FROM Aset where TglPerolehan <='$tanggal_akhir' 
                                                UNION SELECT Aset_ID FROM Aset where TglHapus <='$tanggal_akhir' ) 
                                                where k.Golongan='07' and k.Kelompok is null and k.Sub is null and k.SubSub is null group by k.Kode, k.Golongan,
                                                k.Bidang, k.Uraian order by k.Kode ";
                                                
                
                $data_awal_Golongan = array('query_get_awal_golongan_1', 'query_get_awal_golongan_2', 'query_get_awal_golongan_3', 'query_get_awal_golongan_4', 'query_get_awal_golongan_5', 'query_get_awal_golongan_6', 'query_get_awal_golongan_7');
                
                $data_mutasi_golongan = array('query_get_mutasi_golongan_1', 'query_get_mutasi_golongan_2', 'query_get_mutasi_golongan_3', 'query_get_mutasi_golongan_4', 'query_get_mutasi_golongan_5', 'query_get_mutasi_golongan_6', 'query_get_mutasi_golongan_7');
                
                $data_akhir_golongan = array('query_get_akhir_golongan_1', 'query_get_akhir_golongan_2', 'query_get_akhir_golongan_3', 'query_get_akhir_golongan_4', 'query_get_akhir_golongan_5', 'query_get_akhir_golongan_6', 'query_get_akhir_golongan_7');
                
                //print_r($$data_awal_Golongan[0]);
                //echo $query_get_akhir_golongan_2;
                //$content="";
                $hargaawal="";
                $hargaakhir="";
                $hargamutasi="";
                for ($i = 0; $i <=6; $i++)
                {
                    $result_awal= $this->query($$data_awal_Golongan[$i]) or die ($this->error('error golongan'));
                    $result_mutasi = $this->query($$data_mutasi_golongan[$i]) or die ($this->error('error golongan'));
                    $result_akhir = $this->query($$data_akhir_golongan[$i]) or die ($this->error('error golongan'));
                    
                    while ($data_awal = $this->fetch_object($result_awal))
                    {
                        //$dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)]['Awal'][] = $data_awal;
                        $kode=($i+1);
                        
                        
                        //$content[$Satker_ID]['NamaSatker'] =$value;
                        $content[$Satker_ID]['Golongan_'.$kode]['Gol'] =$data_awal->Golongan;
                        $content[$Satker_ID]['Golongan_'.$kode]['NamaSatker'] =$value[0];
                        $content[$Satker_ID]['Golongan_'.$kode]['Bidang'][]=$data_awal->Bidang;
                        $content[$Satker_ID]['Golongan_'.$kode]['NamaBidang'][]=$data_awal->Uraian;
                        $content[$Satker_ID]['Golongan_'.$kode]['Jml_Awal'][]=$data_awal->Jumlah;
                        $content[$Satker_ID]['Golongan_'.$kode]['Harga_Awal'][]=$data_awal->NilaiPerolehan;
                   //   $hargaawal[$Satker_ID]['Golongan_'.$kode]['Jml'][]=$data_awal->Jumlah;
                     // $hargaawal[$Satker_ID]['Golongan_'.$kode]['Harga'][]=$data_awal->NilaiPerolehan;
                    //$test_data_arr1[$Satker_ID]['Golongan_'.$kode]['oke']  = $data_awal->Uraian;
                    //$test_data_arr1[$Satker_ID]['Golongan_'.$kode]['oke1'] [] = $data_awal->Uraian;
                        //echo $data_awal->Uraian.'<br>';
                        //$data_content[] = $content;
                    
                    }
                    while ($data_mutasi = $this->fetch_object($result_mutasi))
                    {
                        //$dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)]['Mutasi'][] = $data_mutasi;
                        $kode=($i+1);
                        $content[$Satker_ID]['Golongan_'.$kode]['Jml_Mutasi'][]=$data_mutasi->Jumlah;
                        $content[$Satker_ID]['Golongan_'.$kode]['Harga_Mutasi'][]=$data_mutasi->NilaiPerolehan;
                        //  
                        //$hargamutasi[$Satker_ID]['Golongan_'+$kode]['Jml'][]=$data_awal->Jumlah;
                        //$hargamutasi[$Satker_ID]['Golongan_'+$kode]['Harga'][]=$data_awal->NilaiPerolehan;
                        
                    }
                    while ($data_akhir = $this->fetch_object($result_akhir))
                    {
                        //$dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)]['Akhir'][] = $data_akhir;
                        $kode=($i+1);
                        $content[$Satker_ID]['Golongan_'.$kode]['Jml_Akhir'][]=$data_akhir->Jumlah;
                        $content[$Satker_ID]['Golongan_'.$kode]['Harga_Akhir'][]=$data_akhir->NilaiPerolehan;
                   //  
                       //$hargaakhir[$Satker_ID]['Golongan_'+$kode]['Jml'][]=$data_awal->Jumlah;
                       //$hargaakhir[$Satker_ID]['Golongan_'+$kode]['Harga'][]=$data_awal->NilaiPerolehan;
                        
                    }
                  //  $dataArr[$Satker_ID][$value[0]]['nama_satker']['Akhir'][]=$value[0];
                    
                    //$result_golongan = '';
                }
                
                
                
            }
            return $content;    
        }
        else
        {
            return false;
        }
        
        //return $test_data_arr1;
    }
    
    
    public function set_output_name_pdf($parameter)
    {
        $date = date('d-m-Y H:i:s');
        $file_name = "$parameter[path]/report/output/$parameter[nama]$date";
        
        return $file_name;
    }
	
    public function change_date($date, $type, $order)
    {
            //$date = change_date('2001-01-10', '-', 'year');
            
            if ($type == '-')
            {
                    switch ($order)
                    {
                            case 'year':
                            {
                                    list ($tanggal, $bulan, $tahun) = explode ('/',$date);
                                    $new_date = "$tahun-$bulan-$tanggal";
                            }
                            break;
                            case 'date':
                            {
                                    list ($tahun, $bulan, $tanggal) = explode ('/',$date);
                                    $new_date = "$tanggal-$bulan-$tahun";
                            }
                            break;
                    }
                    
            }
            else if ($type='/')
            {
                    switch ($order)
                    {
                            case 'year':
                            {
                                    list ($tanggal, $bulan, $tahun) = explode ('-',$date);
                                    $new_date = "$tahun/$bulan/$tanggal";
                            }
                            break;
                            case 'date':
                            {
                                    list ($tahun, $bulan, $tanggal) = explode ('-',$date);
                                    $new_date = "$tanggal/$bulan/$tahun";
                            }
                            break;
                    }
            }
            
            return $new_date;
                    
            
    }
    
    //status download 
    public function show_status_download()
    {
        ?>
        <html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php echo $this->config->app_title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/example.css" TYPE="text/css" MEDIA="screen">
        
        </head>
        <body>
        <div id="frame_header">
                <div id="header"></div>
        </div>
        <div id="list_header">
           
        </div>
        <div style="border-style:solid; width:40%; margin:20px auto; border-width:1px; box-shadow:5px 5px 5px #ccd" align="center">
            <table border="0">
                <tr>
                    <th height="50px" valign=""><p style="font-size:25px;">Terimakasih sudah mendownload laporan</p><hr></th>
                </tr>
                <tr>
                    <td><p style="font-size: 12px; color: red">Cat : Bila file tidak bisa di download, kemungkinan data tidak ditemukan</p></td>
                </tr>
                <tr>
                    <td align="center" height="50px"><input type="button" value="Kembali ke halaman sebelumnya" onclick="history.back(-1);"></td>
                </tr>
                
            </table>
        
        </body>
        </html>
        <?php
    }
    
    
    
    //status download 
    public function show_status_download_kib()
    {
        ?>
        <html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php echo $this->config->app_title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/example.css" TYPE="text/css" MEDIA="screen">
        
        </head>
        <body>
        <div id="frame_header">
                <div id="header"></div>
        </div>
        <div id="list_header">
           
        </div>
        <div style="border-style:solid; width:40%; margin:20px auto; border-width:1px; box-shadow:5px 5px 5px #ccd" align="center">
            <table border="0">
                <tr>
                    <th height="50px" valign=""><p style="font-size:25px;">Terimakasih sudah mendownload laporan</p><hr></th>
                </tr>
                <tr>
                    <td><p style="font-size: 12px; color: red">Cat : Bila file tidak bisa di download, kemungkinan data tidak ditemukan</p></td>
                </tr>
                
            </table>
        
        </body>
        </html>
        <?php
    }
    
    //pilih download 
    public function show_pilih_download($url)
    {
		$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&tahun=$tahun&kib=$kib&tipe_file=";

        ?>
        <html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php echo $this->config->app_title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="<?php echo $this->url_rewrite?>/css/example.css" TYPE="text/css" MEDIA="screen">
        
        </head>
        <body>
        <div id="frame_header">
                <div id="header"></div>
        </div>
        <div id="list_header">
           
        </div>
        <div style="border-style:solid; width:40%; margin:20px auto; border-width:1px; box-shadow:5px 5px 5px #ccd" align="center">
            <table border="0">
                <tr>
                    <th height="50px" valign=""><p style="font-size:25px;">Download Laporan tersedia dalam bentuk:</p><hr></th>
                </tr>
				<tr>
                    <td><p style="font-size: 12px; color: blue">1. <a href="<?php echo "$url"."1"?>" target="_blank">PDF</a><br/></p></td>
                </tr>
                <tr>
                    <!--<td><p style="font-size: 12px; color: blue">2. <a href="<?php echo "$url"."2"?>" target="_blank">Micorosoft Excel</a></p></td>-->
                </tr>
                
                <tr>
                    <td><p style="font-size: 12px; color: red">Cat : Bila file tidak bisa di download, kemungkinan data tidak ditemukan</p></td>
                </tr>
                <tr>
                    <td align="center" height="50px"><input type="button" value="Kembali ke halaman sebelumnya" onclick="history.back(-1);"></td>
                </tr>
            </table>
        
        </body>
        </html>
        <?php
    }
    
    
}

?>

     
   
     
     

