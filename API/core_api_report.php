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
     var $kir;
     var $intra;
     var $ekstra;
     var $rekap;
     var $label;
     var $gol;
     var $aset;
	 
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
		  $this->rekap=$hasil_data['rekap'];
		  $this->label=$hasil_data['label'];
		  $this->gol=$hasil_data['gol'];
		  $this->aset=$hasil_data['aset'];
		  
		  $this->kir=$hasil_data['kir'];
		  $this->bukuInv=$hasil_data['bukuInv'];
		  $this->bukuIndk=$hasil_data['bukuIndk'];
		  $this->intra=$hasil_data['intra'];
		  $this->ekstra=$hasil_data['ekstra'];
		  
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
          ;
          //echo 'path = '.$this->path;
		  
          $modul=$this->modul;
          $mode=$this->mode;
          $kib=$this->kib;
          $rekap=$this->rekap;
          $label=$this->label;
          $gol=$this->gol;
          $aset=$this->aset;
		  
          $kir=$this->kir;
          $bukuInv=$this->bukuInv;
          $bukuIndk=$this->bukuIndk;
          $intra=$this->intra;
          $ekstra=$this->ekstra;
          
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
		//all parameter is here
		//start edit	
		//this for kib a -kib f
			if($kib =='KIB-A')
			{
				$query_tahun = " T.Tahun <= '$tahun' ";
				$query_satker_fix = " T.kodeSatker='$skpd_id'";
			}
			if($kib =='KIB-B')
			{
				$query_tahun=" M.Tahun <= '$tahun' ";
				$query_satker_fix = " M.kodeSatker='$skpd_id'";

			}
			if($kib =='KIB-C')
			{
				$query_tahun=" B.Tahun <= '$tahun' ";
				$query_satker_fix = " B.kodeSatker='$skpd_id'";
			}
			if($kib =='KIB-D')
			{
				$query_tahun=" J.Tahun <= '$tahun' ";
				$query_satker_fix = " J.kodeSatker='$skpd_id'";
			}
			if($kib =='KIB-E')
			{
				$query_tahun=" AL.Tahun <= '$tahun' ";
				$query_satker_fix = " AL.kodeSatker='$skpd_id'";
			}
			if($kib =='KIB-F')
			{
				$query_tahun=" KDPA.Tahun <= '$tahun' ";
				$query_satker_fix = " KDPA.kodeSatker='$skpd_id'";
			}
			
			// echo "masuk";
		//this for rekap kib a -kib f
			if($rekap =='RekapKIB-A')
			{
				$query_satker_fix = " T.kodeSatker='$skpd_id'";
			}
			if($rekap =='RekapKIB-B')
			{
				$query_satker_fix = " M.kodeSatker='$skpd_id'";
			}
			if($rekap =='RekapKIB-C')
			{
				$query_satker_fix = " B.kodeSatker='$skpd_id'";
			}
			if($rekap =='RekapKIB-D')
			{
				$query_satker_fix = " J.kodeSatker='$skpd_id'";
			}
			if($rekap =='RekapKIB-E')
			{
				$query_satker_fix = " AL.kodeSatker='$skpd_id'";
			}
			if($rekap =='RekapKIB-F')
			{
				$query_satker_fix = " KDPA.kodeSatker='$skpd_id'";
			}
			// echo "rekap =".$query_satker_fix;
			// exit;
		// this for kir
			if($kir =='kir'){
				// echo "masuk kir";
				$query_tahun=" M.Tahun <= '$tahun' ";
				$query_satker_fix = " M.kodeSatker='$skpd_id'";
			}
			
			//this is for buku inventaris
			if($bukuInv =='bukuInv'){
				
				if($tahun !='' && $skpd_id =="" && $kelompok == ""){
					// echo "sini";
					$query_tahun=" Tahun <= '$tahun' ";
					
				}	
				if($tahun !='' && $skpd_id!="" && $kelompok != ""){
					
					$query_tahun=" Tahun <= '$tahun' ";
					$query_satker_fix = " kodeSatker='$skpd_id'";
					
					$IDkelompok = "$kelompok";
					$query_change_satker="SELECT Kode FROM Kelompok as K
											WHERE Kelompok_ID = $IDkelompok";
					$exec_query_change_satker=$this->query($query_change_satker) or die($this->error());
					while($proses_kode_kel=$this->fetch_array($exec_query_change_satker)){
						$dataRow2Kel[]=$proses_kode_kel['Kode'];
					}
					if($dataRow2Kel!=""){
						$query_kelompok_fix =" kodeKelompok = '".$dataRow2Kel[0]."'";
					}
				}
				if($tahun !='' && $skpd_id =="" && $kelompok != ""){
					$query_tahun=" Tahun <= '$tahun' ";
					
					// if($kelompok != ""){
					$IDkelompok = "$kelompok";
					$query_change_satker="SELECT Kode FROM Kelompok as K
											WHERE Kelompok_ID = $IDkelompok";
					$exec_query_change_satker=$this->query($query_change_satker) or die($this->error());
					while($proses_kode_kel=$this->fetch_array($exec_query_change_satker)){
						$dataRow2Kel[]=$proses_kode_kel['Kode'];
					}
					if($dataRow2Kel!=""){
						$query_kelompok_fix ="kodeKelompok = '".$dataRow2Kel[0]."'";
					}
			
				}
				
				if($tahun !='' && $skpd_id !="" && $kelompok == ""){
					$query_tahun=" Tahun <= '$tahun' ";
					$query_satker_fix = " kodeSatker='$skpd_id'";
				}
			}		
			
			//this is for buku induk inventaris
			if($bukuIndk =='bukuIndk'){
				
				if($tahun !='' && $kelompok == ""){
					// echo "sini";
					$query_tahun=" Tahun <= '$tahun' ";
					
				}	
				if($tahun !='' && $kelompok != ""){
					
					$query_tahun=" Tahun <= '$tahun' ";
					
					$IDkelompok = "$kelompok";
					$query_change_satker="SELECT Kode FROM Kelompok as K
											WHERE Kelompok_ID = $IDkelompok";
					$exec_query_change_satker=$this->query($query_change_satker) or die($this->error());
					while($proses_kode_kel=$this->fetch_array($exec_query_change_satker)){
						$dataRow2Kel[]=$proses_kode_kel['Kode'];
					}
					if($dataRow2Kel!=""){
						$query_kelompok_fix =" kodeKelompok like '".$dataRow2Kel[0]."%'";
					}
				}
				
			}	
			
			if($intra == 'intra'){
				if($tahun !='' && $skpd_id == ""){
					// echo "sini";
					$query_tahun=" Tahun <= '$tahun' ";
				}elseif($tahun !='' && $skpd_id != ""){
				
					$query_tahun=" Tahun <= '$tahun' ";
					$query_satker_fix = " kodeSatker='$skpd_id'";
				}	
			}
			
			if($ekstra == 'ekstra'){
				if($tahun !='' && $skpd_id == ""){
					// echo "sini";
					$query_tahun=" Tahun <= '$tahun' ";
				}elseif($tahun !='' && $skpd_id != ""){
				
					$query_tahun=" Tahun <= '$tahun' ";
					$query_satker_fix = " kodeSatker='$skpd_id'";
				}	
			}
			
			if($label == 'label'){
				if($tahun !='' && $skpd_id == ""){
					// echo "sini";
					$query_tahun=" Tahun = '$tahun' ";
				}elseif($tahun !='' && $skpd_id != ""){
				
					$query_tahun=" Tahun = '$tahun' ";
					$query_satker_fix = " kodeSatker='$skpd_id'";
				}
			}
			
			if($aset == 'A'){
				
				if($tahun !='' && $skpd_id == ""){
					// echo "sini";
					$query_tahun=" T.Tahun <= '$tahun' ";
				}elseif($tahun !='' && $skpd_id != ""){
				
					$query_tahun=" T.Tahun <= '$tahun' ";
					$query_satker_fix = " T.kodeSatker='$skpd_id'";
				}
			}
			// echo $query_tahun;
			// echo "<br>";
			// echo $query_satker_fix;
			//end edit
			//==============================================================
			
			
			
			//==============================================================
            //all parameter into query
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
			
            if($skpd_id!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix;
            }
            if($kelompok!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
            }
            if ($kelompok!="" && $parameter_sql==""){
            $parameter_sql=$query_kelompok_fix;
            } 
            //$limit="limit 20";
			//echo $parameter_sql;
			
			// exit;
			
			//==============================================================
			//start update query kib a (ok)
			$Modul_1_Mode_1_Case_a_condition = "select 
													T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
													K.Kode, K.Uraian
												from 
													tanah as T,kelompok as K
												where
													T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
													and $parameter_sql
												order by 
													T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
			
			$Modul_1_Mode_1_Case_a_default   = "select 
													T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
													K.Kode, K.Uraian
												from 
													tanah as T,kelompok as K
												where
													T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
												order by 
													T.kodeSatker,T.Tahun,T.kodeKelompok $limit";	
			//end update query kib a								
           
		   //start update query kib b (ok)
			$Modul_1_Mode_1_Case_b_condition = "select 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
												from 
													Mesin as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode and 
													M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3 and $parameter_sql
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, K.Kode, K.Uraian 
												order by 
													M.Tahun,M.kodeSatker,M.kodeKelompok $limit";
										
			$Modul_1_Mode_1_Case_b_default = "select 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi, K.Kode, K.Uraian 
												from 
													Mesin as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode and 
													M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3 
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, K.Kode, K.Uraian 
												order by 
													M.Tahun,M.kodeSatker,M.kodeKelompok $limit";								
          //end update query kib b (ok)
		  
		  //start update query kib c (ok)
          $Modul_1_Mode_1_Case_c_condition = "select B.Aset_ID, B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
											B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.noRegister,B.Alamat,
											B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
											B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
											K.Kode, K.Uraian
											from 
											Bangunan as B,kelompok as K  
											where
											B.kodeKelompok = K.Kode and 
											B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
											and $parameter_sql
											order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
          //ok
          $Modul_1_Mode_1_Case_c_default = "select B.Aset_ID, B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
											B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.noRegister,B.Alamat,
											B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
											B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan, B.kodeLokasi,
											K.Kode, K.Uraian
											from 
											Bangunan as B,kelompok as K  
											where
											B.kodeKelompok = K.Kode and 
											B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
											order by  B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
          //end update query kib c (ok)
		  
		 //start update query kib d (ok)
          $Modul_1_Mode_1_Case_d_condition = "select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi, J.kodeLokasi,
											K.Kode, K.Uraian
											from 
											Jaringan as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode and 
											J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
											and $parameter_sql
											order by J.Tahun,J.Tahun,J.kodeKelompok $limit";
          
		  $Modul_1_Mode_1_Case_d_default = "select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi,J.kodeLokasi, 
											K.Kode, K.Uraian
											from 
											Jaringan as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode and 
											J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
											order by J.Tahun,J.Tahun,J.kodeKelompok  $limit";
		 //end update query kib d (ok)


		 //start update query kib e (ok)
          
			$Modul_1_Mode_1_Case_e_condition = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											from 
											AsetLain as AL,kelompok as K  
											where
											AL.kodeKelompok = K.Kode and 
											AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
											and $parameter_sql
											group by AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";
											
			  $Modul_1_Mode_1_Case_e_default = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
												AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
												AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
												AL.kondisi, AL.kodeLokasi,
												K.Kode, K.Uraian
												from 
												AsetLain as AL,kelompok as K  
												where
												AL.kodeKelompok = K.Kode and AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
												group by AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
												AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
												AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
												AL.kondisi, AL.kodeLokasi,
												K.Kode, K.Uraian
												order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";
	     //end update query kib d (ok)
		 
         //start update query kib f (ok)
          $Modul_1_Mode_1_Case_f_condition = "select KDPA.Aset_ID, KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
											KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.noRegister,KDPA.Alamat,
											KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
											KDPA.kondisi, KDPA.kodeLokasi,
											K.Kode, K.Uraian
											from 
											KDP as KDPA,kelompok as K  
											where
											KDPA.kodeKelompok = K.Kode and 
											KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
											and $parameter_sql
											order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";
          
		  $Modul_1_Mode_1_Case_f_default = "select KDPA.Aset_ID, KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
											KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.noRegister,KDPA.Alamat,
											KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
											KDPA.kondisi, KDPA.kodeLokasi,
											K.Kode, K.Uraian
											from 
											KDP as KDPA,kelompok as K  
											where
											KDPA.kodeKelompok = K.Kode and 
											KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
											order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";
		//end update query kib f (ok)
			//Cetak Dokumen Inventaris-KIR
		  $query_kir_condition = "select M.Aset_ID, M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul,
								M.Info, M.TglPerolehan,M.TglPembukuan,M.Tahun,M.noRegister,M.Alamat,
								M.Merk,M.Ukuran,M.Material,M.NoSeri,M.kondisi,
								M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,M.kodeRuangan,M.kodeLokasi, 
								K.Kode, K.Uraian
								from 
								Mesin as M,kelompok as K  
								where
								M.kodeKelompok=K.Kode and 
								M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and  
								M.KodeRuangan is not null  and M.kondisi != 3 and $parameter_sql
								order by M.kodeSatker,M.Tahun $limit";



		 $query_kir_default = "select M.Aset_ID, M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul,
								M.Info, M.TglPerolehan,M.TglPembukuan,M.Tahun,M.noRegister,M.Alamat,
								M.Merk,M.Ukuran,M.Material,M.NoSeri,M.kondisi,
								M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,M.kodeRuangan,M.kodeLokasi, 
								K.Kode, K.Uraian
								from 
								Mesin as M,kelompok as K  
								where
								M.kodeKelompok=K.Kode and 
								M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and 
								M.KodeRuangan is not null and M.kondisi != 3
								order by M.kodeSatker,M.Tahun $limit";
		
		
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
                                                  //kir
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
																	$kel = explode('=',$query_kelompok_fix);
																	$kel_prs = explode('.',$kel[1]);
																	
																	if($kel_prs[1] == '01'){
																		// echo "gol 1";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="T.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					from 
																						tanah as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
																	}
																	elseif($kel_prs[1] == '02'){
																		// echo "gol 2";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						Mesin as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode and 
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3
																						and $newparameter_sql
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.Tahun,M.kodeSatker,M.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '03'){
																		// echo "gol 3";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="B.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Bangunan as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode and 
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
																					and $newparameter_sql
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '04'){
																		// echo "gol 4";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="J.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Jaringan as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode and 
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
																					and $newparameter_sql
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.Tahun,J.Tahun,J.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '05'){
																		// echo "gol 5";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="AL.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					AsetLain as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode and 
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
																					and $newparameter_sql
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '06'){
																		// echo "gol 6";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="KDPA.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					KDP as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode and 
																					KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $parameter_sql
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '07'){
																		// echo "gol 7";
																		/*$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}*/
																		$query = "";	
																	}else{
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param_01[]="T.".$pecah[$q];
																			$param_02[]="M.".$pecah[$q];
																			$param_03[]="B.".$pecah[$q];
																			$param_04[]="J.".$pecah[$q];
																			$param_05[]="AL.".$pecah[$q];
																			$param_06[]="KDPA.".$pecah[$q];
																		}
																		$newparameter_sql_01 = implode('AND ', $param_01);
																		$newparameter_sql_02 = implode('AND ', $param_02);
																		$newparameter_sql_03 = implode('AND ', $param_03);
																		$newparameter_sql_04 = implode('AND ', $param_04);
																		$newparameter_sql_05 = implode('AND ', $param_05);
																		$newparameter_sql_06 = implode('AND ', $param_06);
																		// pr($param);
																		$query_01 = "select T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					from 
																						tanah as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql_01
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
																						
																		$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						Mesin as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode and 
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3
																						and $newparameter_sql_02
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.Tahun,M.kodeSatker,M.kodeKelompok $limit";
																		
																		$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Bangunan as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode and 
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
																					and $newparameter_sql_03
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";

																		$query_04 = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Jaringan as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode and 
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
																					and $newparameter_sql_04
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.Tahun,J.Tahun,J.kodeKelompok $limit";
																		
																		$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					AsetLain as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode and 
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
																					and $newparameter_sql_05
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";
																	
																		$query_06 = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					KDP as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode and 
																					KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $newparameter_sql_06
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																				$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
																				// $dataQuery = array($query_01,$query_02,$query_03,$query_04);
																				$query = $dataQuery;
																				// for($i=0;$i<count($dataQuery);$i++){
																					// $data[]=$dataQuery[$i];
																				// }
																				// echo "<pre>";
																				// print_r($data);
																				// exit;
																	
																		
																	}
																	
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
															
                                                        //Buku induk Inventaris SKPD
                                                            if($parameter_sql!="" ){
																	$kel = explode('=',$query_kelompok_fix);
																	$kel_prs = explode('.',$kel[1]);
																	
																	if($kel_prs[1] == '01'){
																		// echo "gol 1";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="T.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					from 
																						tanah as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
																	}
																	elseif($kel_prs[1] == '02'){
																		// echo "gol 2";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						Mesin as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode and 
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3
																						and $newparameter_sql
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.Tahun,M.kodeSatker,M.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '03'){
																		// echo "gol 3";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="B.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Bangunan as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode and 
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
																					and $newparameter_sql
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '04'){
																		// echo "gol 4";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="J.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Jaringan as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode and 
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
																					and $newparameter_sql
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.Tahun,J.Tahun,J.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '05'){
																		// echo "gol 5";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="AL.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					AsetLain as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode and 
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
																					and $newparameter_sql
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '06'){
																		// echo "gol 6";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="KDPA.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					KDP as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode and 
																					KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $parameter_sql
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '07'){
																		// echo "gol 7";
																		/*$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}*/
																		$query = "";	
																	}else{
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param_01[]="T.".$pecah[$q];
																			$param_02[]="M.".$pecah[$q];
																			$param_03[]="B.".$pecah[$q];
																			$param_04[]="J.".$pecah[$q];
																			$param_05[]="AL.".$pecah[$q];
																			$param_06[]="KDPA.".$pecah[$q];
																		}
																		$newparameter_sql_01 = implode('AND ', $param_01);
																		$newparameter_sql_02 = implode('AND ', $param_02);
																		$newparameter_sql_03 = implode('AND ', $param_03);
																		$newparameter_sql_04 = implode('AND ', $param_04);
																		$newparameter_sql_05 = implode('AND ', $param_05);
																		$newparameter_sql_06 = implode('AND ', $param_06);
																		// pr($param);
																		$query_01 = "select T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					from 
																						tanah as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql_01
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
																						
																		$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						Mesin as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode and 
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3
																						and $newparameter_sql_02
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.Tahun,M.kodeSatker,M.kodeKelompok $limit";
																		
																		$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Bangunan as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode and 
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
																					and $newparameter_sql_03
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";

																		$query_04 = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Jaringan as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode and 
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
																					and $newparameter_sql_04
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.Tahun,J.Tahun,J.kodeKelompok $limit";
																		
																		$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					AsetLain as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode and 
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
																					and $newparameter_sql_05
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";
																	
																		$query_06 = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					KDP as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode and 
																					KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $newparameter_sql_06
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																				$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
																				// $dataQuery = array($query_01,$query_02,$query_03,$query_04);
																				$query = $dataQuery;
																				// for($i=0;$i<count($dataQuery);$i++){
																					// $data[]=$dataQuery[$i];
																				// }
																				// echo "<pre>";
																				// print_r($data);
																				// exit;
																	
																		
																	}
																	
															}
                                                            if($parameter_sql=="" ){
                                                                      $query = "";	
                                                            }
												
												  }
												  break;
												  case '6':
                                                  {
                                                       //Rekapitulasi Buku Induk Inventaris SKPD
                                                  }
                                                  break;
												  case '7':
												  {
												  // echo "intra masuk";
												  // exit;
												  if($parameter_sql != ''){
														$Thn = $tahun;
														$tahunIntraDefault = 2008;
														$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																$param_01[]="T.".$pecah[$q];
																$param_02[]="M.".$pecah[$q];
																$param_03[]="B.".$pecah[$q];
																$param_04[]="J.".$pecah[$q];
																$param_05[]="AL.".$pecah[$q];
																$param_06[]="KDPA.".$pecah[$q];
														}
														
														$newparameter_sql_01 = implode('AND ', $param_01);
														$newparameter_sql_02 = implode('AND ', $param_02);
														$newparameter_sql_03 = implode('AND ', $param_03);
														$newparameter_sql_04 = implode('AND ', $param_04);
														$newparameter_sql_05 = implode('AND ', $param_05);
														$newparameter_sql_06 = implode('AND ', $param_06);
														
														if(count($param_02) == 2){
															if($param_02[1] != ''){
																$satker_02 = "AND ".$param_02[1];
															}else{
																$satker_02 ="";
															}
														}
														
														if(count($param_03) == 2){
															if($param_03[1] != ''){
																$satker_03 = "AND ".$param_03[1];
															}else{
																$satker_03 ="";
															}
														}
														
														if($tahun < $tahunIntraDefault){
															$query_01 = "select T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		from 
																			tanah as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																			and $newparameter_sql_01
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
																			
															$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3
																			and $newparameter_sql_02
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.Tahun,M.kodeSatker,M.kodeKelompok $limit";
															
															$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Bangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode and 
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
																		and $newparameter_sql_03
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";

															$query_04 = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Jaringan as J,kelompok as K  
																	where
																		J.kodeKelompok = K.Kode and 
																		J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
																		and $newparameter_sql_04
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	order by J.Tahun,J.Tahun,J.kodeKelompok $limit";
															
															$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		AsetLain as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode and 
																		AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
																		and $newparameter_sql_05
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";
														
															$query_06 = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		KDP as KDPA,kelompok as K  
																	where
																		KDPA.kodeKelompok = K.Kode and 
																		KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																		and $newparameter_sql_06
																	group by 
																		KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian	
																	order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																	
															$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
															$query = $dataQuery;
														}else{
															// echo "tahun > tahun intra";
															$query_01 = "select T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		from 
																			tanah as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																			and $newparameter_sql_01
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
															
															$query_02_default = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3
																			and M.Tahun < '2008' 
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.Tahun,M.kodeSatker,M.kodeKelompok $limit";
																			
															$query_02_condt = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.NilaiPerolehan >= 300000 and M.kondisi != 3
																			and M.Tahun >= '2008' and $newparameter_sql_02
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.Tahun,M.kodeSatker,M.kodeKelompok $limit";
															
															$query_03_default = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Bangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode and 
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3
																		and B.Tahun < '2008' 
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
															
															$query_03_condt = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Bangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode and 
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.NilaiPerolehan >= 10000000 and B.kondisi != 3
																		and B.Tahun >= '2008' and $satker_03
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
															
															$query_04 = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Jaringan as J,kelompok as K  
																	where
																		J.kodeKelompok = K.Kode and 
																		J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
																		and $newparameter_sql_04
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	order by J.Tahun,J.Tahun,J.kodeKelompok $limit";
															
															$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		AsetLain as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode and 
																		AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
																		and $newparameter_sql_05
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	order by AL.Tahun,AL.kodeSatker,AL.kodeKelompok $limit";
														
															$query_06 = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		KDP as KDPA,kelompok as K  
																	where
																		KDPA.kodeKelompok = K.Kode and 
																		KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																		and $newparameter_sql_06
																	group by 
																		KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian	
																	order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																	
															$dataQuery = array($query_01,$query_02_default,$query_02_condt,$query_03_default,$query_03_condt,$query_04,$query_05,$query_06);
															$query = $dataQuery;
														}
															
														
													}		
												  }
												  break;
												  case '8':
												  {
												   // echo "extra masuk";
												  // exit;
												  if($parameter_sql != ''){
														$Thn = $tahun;
														$tahunIntraDefault = 2008;
														$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																// $param_01[]="T.".$pecah[$q];
																$param_02[]="M.".$pecah[$q];
																$param_03[]="B.".$pecah[$q];
																// $param_04[]="J.".$pecah[$q];
																// $param_05[]="AL.".$pecah[$q];
																// $param_06[]="KDPA.".$pecah[$q];
														}
															
														// $newparameter_sql_01 = implode('AND ', $param_01);
														$newparameter_sql_02 = implode('AND ', $param_02);
														$newparameter_sql_03 = implode('AND ', $param_03);
														// $newparameter_sql_04 = implode('AND ', $param_04);
														// $newparameter_sql_05 = implode('AND ', $param_05);
														// $newparameter_sql_06 = implode('AND ', $param_06);
													// pr($param);
														if($tahun > $tahunIntraDefault){
																
															$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.NilaiPerolehan <= 300000
																			and M.Tahun > '2008' and M.kondisi != 3 and $newparameter_sql_02
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.Tahun,M.kodeSatker,M.kodeKelompok $limit";
															
															$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Bangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode and 
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.NilaiPerolehan <= 10000000
																		and B.Tahun > '2008' and B.kondisi != 3 and $newparameter_sql_03
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";

															$dataQuery = array($query_02,$query_03);
															$query = $dataQuery;
														}else{
															
															// $query_02 = "";
															
															// $query_03 = "";

															// $dataQuery = array($query_02,$query_03);
															$dataQuery = array();
															$query = $dataQuery;
														}
															
														
													}
												  
												  }
												  break;
												  case '9':
												  {
													if (isset($rekap))
													  {
														switch ($rekap)
														{
														 case 'RekapKIB-A':
														 {
															// echo "masukkk";
															// exit;
															if($parameter_sql!="" ) {
																			 $query = $Modul_1_Mode_1_Case_a_condition; 
																			 // echo "masukkk";
															}
															if($parameter_sql=="" ) {
																		$query = $Modul_1_Mode_1_Case_a_default; 
															}
														 }		
														 break;
														 case 'RekapKIB-B':
														 {
															  if($parameter_sql!="" ){
																		$query = $Modul_1_Mode_1_Case_b_condition;
																						}
															  if($parameter_sql=="" ) {
																		$query = $Modul_1_Mode_1_Case_b_default;
																						}
														 }
														 break;
														 case 'RekapKIB-C':
														 {
															  if($parameter_sql!="" ){
																		$query = $Modul_1_Mode_1_Case_c_condition;
															  }
															  if($parameter_sql=="" ) {
																		$query = $Modul_1_Mode_1_Case_c_default;
															  }
														 }
														 break;
														 case 'RekapKIB-D':
														 {
															  if($parameter_sql!="" ){
																		$query = $Modul_1_Mode_1_Case_d_condition;
															  }
															  if($parameter_sql=="" ){
																		$query = $Modul_1_Mode_1_Case_d_default;
															  }
														 }
														 break;
														 
														 case 'RekapKIB-E':
														 {
															  if($parameter_sql!="" ){
																		$query = $Modul_1_Mode_1_Case_e_condition;
															   }
															  if($parameter_sql=="" ){
																		$query = $Modul_1_Mode_1_Case_e_default;
															  }
														 }
														 break;
												
														 case 'RekapKIB-F':
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
												  case '10':
												  {
													//cetak label edit
													 if($parameter_sql!="" ){
														// echo "param =".$parameter_sql;
														// exit;
																	if($gol == 01){
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="T.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select T.kodeSatker,T.kodeLokasi,T.kodeKelompok,T.noRegister
																					from 
																						tanah as T
																					where 
																						T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql
																					order by 
																						T.kodeKelompok,T.noRegister";	
																	}
																	elseif($gol == 02){
																		// echo "gol 2";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select M.kodeSatker,M.kodeLokasi,M.kodeKelompok,M.noRegister
																					from 
																						mesin as M
																					where 
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3
																						and $newparameter_sql
																					order by 
																						M.kodeKelompok,M.noRegister";	
																	}
																	elseif($gol == 03){
																		// echo "gol 3";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="B.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select B.kodeSatker,B.kodeLokasi,B.kodeKelompok,B.noRegister
																					from 
																						bangunan as B
																					where 
																						B.StatusValidasi =1 and B.Status_Validasi_Barang =1 and B.StatusTampil =1 and B.kondisi != 3
																						and $newparameter_sql
																					order by 
																						B.kodeKelompok,B.noRegister	";	
																	}
																	elseif($gol == 04){
																		// echo "gol 4";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="J.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select J.kodeSatker,J.kodeLokasi,J.kodeKelompok,J.noRegister
																					from 
																						jaringan as J
																					where 
																						J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3
																						and $newparameter_sql
																					order by 
																						J.kodeKelompok,J.noRegister	";	
																	}
																	elseif($gol == 05){
																		// echo "gol 5";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="AL.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select AL.kodeSatker,AL.kodeLokasi,AL.kodeKelompok,AL.noRegister
																					from 
																						asetlain as AL
																					where 
																						AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3
																						and $newparameter_sql
																					order by 
																						AL.kodeKelompok,AL.noRegister";	
																	}
																	elseif($gol == 06){
																		// echo "gol 6";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="KDPA.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select KDPA.kodeSatker,KDPA.kodeLokasi,KDPA.kodeKelompok,KDPA.noRegister
																					from 
																						kdp as KDPA
																					where 
																						KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1 and KDPA.kondisi != 3
																						and $newparameter_sql
																					order by 
																						KDPA.kodeKelompok,KDPA.noRegister";	
																	}
																	elseif($kel_prs[1] == '07'){
																		// echo "gol 7";
																		/*$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}*/
																		$query = "";	
																	}else{
																		/*$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param_01[]="T.".$pecah[$q];
																			$param_02[]="M.".$pecah[$q];
																			$param_03[]="B.".$pecah[$q];
																			$param_04[]="J.".$pecah[$q];
																			$param_05[]="AL.".$pecah[$q];
																			$param_06[]="KDPA.".$pecah[$q];
																		}
																		$newparameter_sql_01 = implode('AND ', $param_01);
																		$newparameter_sql_02 = implode('AND ', $param_02);
																		$newparameter_sql_03 = implode('AND ', $param_03);
																		$newparameter_sql_04 = implode('AND ', $param_04);
																		$newparameter_sql_05 = implode('AND ', $param_05);
																		$newparameter_sql_06 = implode('AND ', $param_06);
																		// pr($param);
																		$query_01 = "select T.kodeSatker,T.kodeLokasi,T.kodeKelompok,T.noRegister
																						from 
																							tanah as T
																						where 
																							T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 and T.kondisi != 3
																							and $newparameter_sql_01
																						order by 
																							T.kodeKelompok,T.noRegister";
																		
																		$query_02 = "";
																		
																		$query_03 = "";

																		$query_04 = "";
																		
																		$query_05 = "";
																	
																		$query_06 = "";	
																				$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
																				// $dataQuery = array($query_01,$query_02,$query_03,$query_04);
																				$query = $dataQuery;
																				// for($i=0;$i<count($dataQuery);$i++){
																					// $data[]=$dataQuery[$i];
																				// }
																				// echo "<pre>";
																				// print_r($data);
																				// exit;
																		*/
																		
																	}
												  }
                                             }
												  break;
												}
										}
                                   
									}
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
																//Daftar Aset Tetap - Tanah
																if($parameter_sql!="" ){
																
																	echo "masuk Daftar Aset Tetap - Tanah";
																	if($query_satker_fix != ""){
																		$query ="SELECT T.kodeSatker,s.NamaSatker,k.Uraian, T.Alamat, T.LuasTotal, T.NilaiPerolehan FROM tanah as T, kelompok as k,satker as s WHERE k.Kode = T.kodeKelompok and s.kode = T.kodeSatker  and $parameter_sql order by T.kodeSatker, T.kodeKelompok " ;	
																	}else{
																		$query ="SELECT T.kodeSatker,s.NamaSatker,k.Uraian, T.Alamat, T.LuasTotal, T.NilaiPerolehan FROM tanah as T, kelompok as k,satker as s WHERE k.Kode = T.kodeKelompok and s.kode = T.kodeSatker and $parameter_sql order by T.kodeSatker, T.kodeKelompok " ;	
																	}
																	// exit;
                                                                }
																if($parameter_sql=="" ){
                                                                      // $query = $query_pengadaan_bmd_default;
                                                                      
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
			if(is_array($param)){
				// $impl = implode(' AND ',$param);
				$getSatkerRekap = $param;
			}
			
		}
		else
		{
			$query = "  SELECT distinct(`kodeSatker`) FROM `aset` where (`NilaiPerolehan` is not null and `NilaiPerolehan` != '') order by kodeSatker asc   ";
			//print_r($query);
			$result = $this->query($query) or die ($this->error());
			
			while($data = $this->fetch_object($result)){
				if($data != ''){
					$getSatkerRekap[] = $data->kodeSatker;
				}	
			}
			$getSatkerRekap = array_filter($getSatkerRekap, 'strlen');
		}
        return $getSatkerRekap;
    }
    
    public function validasi_data_satker_id ($satker)
    {
		if($satker!=""){
			$kdSakter = "$satker";
			$get_satker = array($kdSakter);
			$get_satker = $this->_cek_data_satker_with_id($get_satker, true);
		}
		else
		{
			$kdSakter = "$satker";
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
		
        $query_get_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(T.Aset_ID)as Jumlah, sum(T.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join tanah T on T.kodeKelompok = x.Kode and 
									T.Tahun <='$tahun' and T.Status_Validasi_Barang = 1 and T.StatusTampil = 1
								where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(M.Aset_ID)as Jumlah, sum(M.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join mesin M on M.kodeKelompok = x.Kode and 
									M.Tahun <='$tahun' and M.Status_Validasi_Barang = 1 and M.StatusTampil = 1 and M.kondisi != 3
								where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(B.Aset_ID)as Jumlah, sum(B.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join bangunan B on B.kodeKelompok = x.Kode and 
									B.Tahun <='$tahun' and B.Status_Validasi_Barang = 1 and B.StatusTampil = 1 and B.kondisi != 3
								where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(J.Aset_ID)as Jumlah, sum(J.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join jaringan J on J.kodeKelompok = x.Kode and 
									J.Tahun <='$tahun' and J.Status_Validasi_Barang = 1 and J.StatusTampil = 1 and J.kondisi != 3
								where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(AL.Aset_ID)as Jumlah, sum(AL.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join asetlain AL on AL.kodeKelompok = x.Kode and 
									AL.Tahun <='$tahun' and AL.Status_Validasi_Barang = 1 and AL.StatusTampil = 1 and AL.kondisi != 3
								where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(KDPA.Aset_ID)as Jumlah, sum(KDPA.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join kdp KDPA on KDPA.kodeKelompok = x.Kode and 
									KDPA.Tahun <='$tahun' and KDPA.Status_Validasi_Barang = 1 and KDPA.StatusTampil = 1
								where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		
        // $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
        $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6');
        //pr($query_get_golongan_2);
        // for ($i = 0; $i <=6; $i++)
        for ($i = 0; $i <6; $i++)
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
		// exit;
        //pr($dataArr);
        return $dataArr;
    }
    
    
    
    
    //REVISI REKAP SKPD
    public function get_report_rekap_inv_skpd($parameter,$tahun)
    {
		// echo "masuk execute query";
		// pr($parameter);
		// pr($tahun);
			foreach ($parameter as $Satker_ID)
			{
				if($Satker_ID != ''){
				// echo "satker".$Satker_ID;
				// echo "<br>";
				// exit;
					$query_get_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(T.Aset_ID)as Jumlah, sum(T.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join tanah T on T.kodeKelompok = x.Kode and 
												T.kodeSatker = '$Satker_ID' and T.Tahun <='$tahun' and T.Status_Validasi_Barang = 1 and T.StatusTampil = 1
											where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(M.Aset_ID)as Jumlah, sum(M.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join mesin M on M.kodeKelompok = x.Kode and 
												M.kodeSatker = '$Satker_ID' and M.Tahun <='$tahun' and M.Status_Validasi_Barang = 1 and M.StatusTampil = 1 and M.kondisi != 3
											where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(B.Aset_ID)as Jumlah, sum(B.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join bangunan B on B.kodeKelompok = x.Kode and 
												B.kodeSatker = '$Satker_ID' and B.Tahun <='$tahun' and B.Status_Validasi_Barang = 1 and B.StatusTampil = 1 and B.kondisi != 3
											where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(J.Aset_ID)as Jumlah, sum(J.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join jaringan J on J.kodeKelompok = x.Kode and 
												J.kodeSatker = '$Satker_ID' and J.Tahun <='$tahun' and J.Status_Validasi_Barang = 1 and J.StatusTampil = 1 and J.kondisi != 3
											where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(AL.Aset_ID)as Jumlah, sum(AL.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join asetlain AL on AL.kodeKelompok = x.Kode and 
												AL.kodeSatker = '$Satker_ID' and AL.Tahun <='$tahun' and AL.Status_Validasi_Barang = 1 and AL.StatusTampil = 1 and AL.kondisi != 3
											where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(KDPA.Aset_ID)as Jumlah, sum(KDPA.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join kdp KDPA on KDPA.kodeKelompok = x.Kode and 
												KDPA.kodeSatker = '$Satker_ID' and KDPA.Tahun <='$tahun' and KDPA.Status_Validasi_Barang = 1 and KDPA.StatusTampil = 1
											where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					// $query_get_golongan_7 = "  ";
					
					// $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
					$dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6');
					for ($i = 0; $i <6; $i++)
					{
						// echo "dataGolongan =".$dataGolongan."$i";
						// echo "<br>";
						$result_golongan = $this->query($$dataGolongan[$i]) or die ($this->error('error golongan'));
						
						if ($result_golongan)
						{
						   
							while ($data = $this->fetch_object($result_golongan))
							{
								// pr($data);
								// $dataArr[$Satker_ID][$value[0]]['Golongan_'.($i+1)][] = $data;
								$dataArr[$Satker_ID]['Golongan_'.($i+1)][] = $data;
								
							}
						}
						
						//$result_golongan = '';
					}
			  }
				
			}
			// pr($dataArr);
			// exit;
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
    
	public function sortirNoReg($noReg){
	$ex = explode(',',$noReg);
	$sorting =sort($ex);
	$arrlength=count($ex);
	for($x=0;$x<$arrlength;$x++)
	{
		$numSort[] = $ex[$x];
	}
	$temp ='';
	$awal= '';
	$akhir = '';
	$selisih = '';
	// $noRegSort= array();
	// unset($noRegSort);
	$output="";
	for($i=0;$i<=$arrlength;$i++)
	{
		if($i == 0){
			$temp = $ex[0];
			$awal = $temp;	
		}
	   else{
			$temp = $ex[$i];
			if($akhir == ""){
				$selisih = $temp - $awal;
			}else{
				$selisih = $temp - $akhir;
			}
				if($i!=0){
					if($selisih == 1  ){
						$akhir = $temp;
					}else{
						if ($awal != "" && $akhir !=""){
								
							$awal = sprintf("%04s", $awal);
							$akhir = sprintf("%04s", $akhir);
							$output.=$awal.""."-"."".$akhir;
							$output.=", ";
							$awal=$temp;
							$akhir="";
						}else{
							$awal = sprintf("%04s", $awal);
							
							$output.=$awal;
							$output.=", ";
							$awal = $temp;
						}
					}
				}
			}
	}  
	return $output;

}
	
	
    public function QueryKib($query,$tableName){
		
		if (!$query) return false;
	
		$result=mysql_query($query);
		
		while ($row=mysql_fetch_assoc($result)){
		  $data[] = $row;
		}
		if (!$data) {
			return '';
		}
		//untuk mendapatkan field
		foreach ($data[0] as $key => $val){
		  
		  $field [] = $key;

		}
		$ignoreField = array('Kode','Uraian');
		$i=1;
		$data_reg=1;
		$count_reg=0;
		$iman=array();
		foreach ($data as $keys => $value){
		  
			$tmp = array();
			$imp = "";

			foreach ($field as $val){
				
				if (!in_array($val, $ignoreField)){
					if ($value[$val]==''){
						$tmp[] = "(".$val ." IS NULL or $val='' )";
			   
					}else{
						$tmp[] = $val ." = '$value[$val]'";
					}
				  
				}
				
			}
			  
			$imp = implode(' and ', $tmp);
			
			$sql = "SELECT noRegister FROM $tableName WHERE {$imp} order by noRegister desc";
			// echo $sql; 
			$res = mysql_query($sql);
			$register=array();

			while($d = mysql_fetch_assoc($res)){
			  
				$register[]= $d['noRegister'];
			}
			sort($register);
			$text_register=implode(",",$register);
	        //$data[$keys]['noRegister']=$this->sortirNoReg($text_register);
			$register_no=explode(",",$this->sortirNoReg($text_register));
			for($m=0;$m<count($register_no)-1;$m++){
				$data[$keys]['noRegister']=$register_no[$m];
				array_push($iman,$data[$keys])  ;
			}
			$i++;
		}
			
		return $iman;
	}

	public function QueryBinv($dataQuery){
		// pr($dataQuery);
		// exit;
		if(is_array($dataQuery)){
			$hit = count($dataQuery);
			if($hit == 0){
				$data ='';
			}else{
			// echo "array query";
				for ($i = 0; $i < count($dataQuery); $i++)
					{
						// echo "query_$i =".$dataQuery[$i];
						// echo "<br>";
						// echo "<br>";
						// exit;
						$result_golongan = $this->query($dataQuery[$i]) or die ($this->error('error dataQuery'));
						if ($result_golongan)
						{
						   while ($dataArr = mysql_fetch_assoc($result_golongan))
							{
								$data[] = $dataArr;
							}
						}
						$result_golongan = '';
					}
			}	
		}else{
				// echo "single query";
				$result_golongan = $this->query($dataQuery) or die ($this->error('error dataQuery'));
				if ($result_golongan)
				{
				   while ($dataArr = mysql_fetch_assoc($result_golongan))
					{
						$data[] = $dataArr;
					}
				}
		}
		$ignoreField = array('Kode','Uraian');
		$i=1;
		$x=0;
		$data_reg=1;
		$count_reg=0;
		$iman=array();
		if($data){
			foreach ($data as $keys => $value){
				
				$tmp = array();
				$tmp1 = array();
				$getField =array();
				$imp = "";
				
				foreach ($data[$x] as $key => $val){
					$getField[]  = $key;
				}
					foreach ($getField as $val){
						
						if (!in_array($val, $ignoreField)){
							if ($value[$val]==''){
								$tmp[] = "(".$val ." IS NULL or $val='' )";
								$tmp1[] = "(".$val ." IS NULL or $val= )";
					   
							}else{
								$tmp[] = $val ." = '$value[$val]'";
								$tmp1[] = $val ." = $value[$val]";
							}
						  
						}
						
					}
					
				$kel = explode(" = ",$tmp1[1]);
				$kel_prs = explode('.',$kel[1]);
				
				if($kel_prs[0] == 01){
					$tableName = "tanah";
				}elseif($kel_prs[0] == 02){
					$tableName = "mesin";
				}elseif($kel_prs[0] == 03){
					$tableName = "bangunan";
				}elseif($kel_prs[0] == 04){
					$tableName = "jaringan";
				}elseif($kel_prs[0] == 05){
					$tableName = "asetlain";
				}elseif($kel_prs[0] == 06){
					$tableName = "kdp";
				}
				
				$imp = implode(' and ', $tmp);
				$sql = "SELECT noRegister FROM $tableName WHERE {$imp} order by noRegister desc";
				$res = mysql_query($sql);
				$register=array();

				while($d = @mysql_fetch_assoc($res)){
				  
					$register[]= $d['noRegister'];
				}
				sort($register);
				$text_register=implode(",",$register);
				//$data[$keys]['noRegister']=$this->sortirNoReg($text_register);
				$register_no=explode(",",$this->sortirNoReg($text_register));
				for($m=0;$m<count($register_no)-1;$m++){
					$data[$keys]['noRegister']=$register_no[$m];
					array_push($iman,$data[$keys])  ;
				}
				$x++;
				$i++;
			}
			return $iman;
		}
		else{
			return false;
		}
	
	}	
}

?>

     
   
     
     

