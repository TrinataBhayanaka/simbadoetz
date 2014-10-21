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
	 var $kb;
	 
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
		  $this->kb=$hasil_data['kb'];
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
          // ;
          //echo 'path = '.$this->path;
		  
          $modul=$this->modul;
          $mode=$this->mode;
          $kib=$this->kib;
          $kb=$this->kb;
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
				$query_tgl_awal = " T.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " T.TglPerolehan <= '$tglakhirperolehan' ";
				$query_satker_fix = " T.kodeSatker LIKE '$skpd_id%'";
			}
			if($kib =='KIB-B')
			{
				$query_tgl_awal = " M.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " M.TglPerolehan <= '$tglakhirperolehan' ";
				$query_satker_fix = " M.kodeSatker LIKE '$skpd_id%'";

			}
			if($kib =='KIB-C')
			{
				$query_tgl_awal = " B.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " B.TglPerolehan <= '$tglakhirperolehan' ";
				$query_satker_fix = " B.kodeSatker LIKE '$skpd_id%'";
			}
			if($kib =='KIB-D')
			{
				$query_tgl_awal = " J.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " J.TglPerolehan <= '$tglakhirperolehan' ";
				$query_satker_fix = " J.kodeSatker LIKE '$skpd_id%'";
			}
			if($kib =='KIB-E')
			{
				$query_tgl_awal = " AL.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " AL.TglPerolehan <= '$tglakhirperolehan' ";
				$query_satker_fix = " AL.kodeSatker LIKE '$skpd_id%'";
			}
			if($kib =='KIB-F')
			{
				$query_tgl_awal = " KDPA.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " KDPA.TglPerolehan <= '$tglakhirperolehan' ";
				$query_satker_fix = " KDPA.kodeSatker LIKE '$skpd_id%'";
			}
			
			//kartu barang
			if($kb != ''){
				
				if($kb == 'KB-A'){
					$param = "T";
				}elseif($kb == 'KB-B'){
					$param = "M";
				}elseif($kb == 'KB-C'){
					$param = "B";
				}elseif($kb == 'KB-D'){
					$param = "J";	
				}elseif($kb == 'KB-E'){
					$param = "AL";	
				}else{
					$param = "KDPA";
				}
				echo "param =".$param;
				// exit;
				
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok == ""){
					// echo "sini";
					$query_tgl_awal = " $param.TglPerubahan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " $param.TglPerubahan <= '$tglakhirperolehan' ";
				}	
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id !="" && $kelompok != ""){
					$query_tgl_awal = " $param.TglPerubahan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " $param.TglPerubahan <= '$tglakhirperolehan' ";
					$query_satker_fix = " $param.kodeSatker LIKE '$skpd_id%'";
					
					$IDkelompok = "$kelompok";
					$query_change_satker="SELECT Kode FROM Kelompok as K
											WHERE Kelompok_ID = $IDkelompok";
					$exec_query_change_satker=$this->query($query_change_satker) or die($this->error());
					while($proses_kode_kel=$this->fetch_array($exec_query_change_satker)){
						$dataRow2Kel[]=$proses_kode_kel['Kode'];
					}
					if($dataRow2Kel!=""){
						$query_kelompok_fix =" $param.kodeKelompok = '".$dataRow2Kel[0]."'";
					}
				}
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok != ""){
					$query_tgl_awal = " $param.TglPerubahan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " $param.TglPerubahan <= '$tglakhirperolehan' ";
					
					// if($kelompok != ""){
					$IDkelompok = "$kelompok";
					$query_change_satker="SELECT Kode FROM Kelompok as K
											WHERE Kelompok_ID = $IDkelompok";
					$exec_query_change_satker=$this->query($query_change_satker) or die($this->error());
					while($proses_kode_kel=$this->fetch_array($exec_query_change_satker)){
						$dataRow2Kel[]=$proses_kode_kel['Kode'];
					}
					if($dataRow2Kel!=""){
						$query_kelompok_fix ="$param.kodeKelompok = '".$dataRow2Kel[0]."'";
					}
			
				}
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id !="" && $kelompok == ""){
					$query_tgl_awal = " $param.TglPerubahan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " $param.TglPerubahan <= '$tglakhirperolehan' ";
					$query_satker_fix = " $param.kodeSatker LIKE '$skpd_id%'";
				}
			}
			/*echo "<br>";
			echo $query_tgl_awal;
			echo "<br>";
			echo $query_tgl_akhir;
			echo "<br>";
			echo $query_kelompok_fix;
			echo "<br>";
			echo $query_satker_fix;
			echo "<br>";*/
			// exit;
			// echo "masuk";
		//this for rekap kib a -kib f
			if($rekap =='RekapKIB-A')
			{
				$query_satker_fix = " T.kodeSatker LIKE '$skpd_id%'";
			}
			if($rekap =='RekapKIB-B')
			{
				$query_satker_fix = " M.kodeSatker LIKE '$skpd_id%'";
			}
			if($rekap =='RekapKIB-C')
			{
				$query_satker_fix = " B.kodeSatker LIKE '$skpd_id%'";
			}
			if($rekap =='RekapKIB-D')
			{
				$query_satker_fix = " J.kodeSatker LIKE '$skpd_id%'";
			}
			if($rekap =='RekapKIB-E')
			{
				$query_satker_fix = " AL.kodeSatker LIKE '$skpd_id%'";
			}
			if($rekap =='RekapKIB-F')
			{
				$query_satker_fix = " KDPA.kodeSatker LIKE '$skpd_id%'";
			}
			// echo "rekap =".$query_satker_fix;
			// exit;
		// this for kir
			if($kir =='kir'){
				// echo "masuk kir";
				$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
				$query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
			}
			
			//this is for buku inventaris
			if($bukuInv =='bukuInv'){
				
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok == ""){
					// echo "sini";
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
				}	
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id!="" && $kelompok != ""){
					
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					$query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					
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
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok != ""){
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					
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
				
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id !="" && $kelompok == ""){
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					$query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
				}
			}		
			
			//this is for buku induk inventaris
			if($bukuIndk =='bukuIndk'){
				
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $kelompok == ""){
					// echo "sini";
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					
				}	
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $kelompok != ""){
					
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					
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
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id == ""){
					// echo "sini";
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
				}elseif($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id != ""){
				
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					$query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
				}	
			}
			
			if($ekstra == 'ekstra'){
				
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id == ""){
					
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
				}elseif($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id != ""){
					// echo "sini";
					// echo "skpd =".$skpd_id;
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					$query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
				}	
			}
			
			if($label == 'label'){
				if($tahun !='' && $skpd_id == ""){
					// echo "sini";
					$query_tahun=" Tahun = '$tahun' ";
				}elseif($tahun !='' && $skpd_id != ""){
				
					$query_tahun=" Tahun = '$tahun' ";
					$query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
				}
			}
			
			// echo $query_tgl_awal;
			// echo "<br>";
			// echo $query_satker_fix;
			// exit;
			//end edit
			//==============================================================
			
			
			
			//==============================================================
            //all parameter into query
			$parameter_sql="";
            if($tglawalperolehan !=""){
				$parameter_sql=$query_tgl_awal;
            }
			if($tglakhirperolehan!="" && $tglawalperolehan !=""){
				$parameter_sql=$parameter_sql." AND ".$query_tgl_akhir;
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
            // $limit="limit 100";
			
			// echo "param =".$parameter_sql;
			
			// exit;
			
			
			//start update query kib a (ok)
			$kb_a_condition = "select 
													T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.TglPerubahan,T.Kd_Riwayat,
													K.Kode, K.Uraian
												from 
													log_tanah as T,kelompok as K
												where
													T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
													and $parameter_sql
												group by T.Aset_ID
												order by 
													T.Aset_ID,T.kodeKelompok,T.kodeSatker,T.TglPerubahan $limit";
			
			$kb_a_default   = "";	
			
			$kb_b_condition = "select 
													M.Aset_ID,M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Kd_Riwayat,
													M.Silinder,M.kodeLokasi,M.noRegister, M.TglPerubahan,K.Kode, K.Uraian
												from 
													log_mesin as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode and 
													M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and $parameter_sql
												order by 
													M.Aset_ID,M.kodeKelompok,M.kodeSatker,M.TglPerubahan $limit";
										
			$kb_b_default = "";								
          
			$kb_c_condition = "select B.Aset_ID, B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
											B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.noRegister,B.Alamat,
											B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
											B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.Kd_Riwayat,
											K.Kode, K.Uraian
											from 
											log_bangunan as B,kelompok as K  
											where
											B.kodeKelompok = K.Kode and 
											B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
											and $parameter_sql
											order by
												B.Aset_ID,B.kodeKelompok,B.kodeSatker,B.TglPerubahan $limit";
			//ok
			$kb_c_default = "";
			$kb_d_condition = "select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi, J.kodeLokasi,J.Kd_Riwayat,
											K.Kode, K.Uraian
											from 
											log_jaringan as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode and 
											J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
											and $parameter_sql
											order by 
												J.Aset_ID,J.kodeKelompok,J.kodeSatker,J.TglPerubahan $limit";
          
		  $kb_d_default = "";
			$kb_e_condition = "select AL.Aset_ID,AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,AL.noRegister,AL.Kd_Riwayat,
											K.Kode, K.Uraian
											from 
											log_asetlain as AL,kelompok as K  
											where
											AL.kodeKelompok = K.Kode and 
											AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
											and $parameter_sql
											order by 
												AL.Aset_ID,AL.kodeKelompok,AL.kodeSatker,AL.TglPerubahan $limit";
											
			$kb_e_default = "";
	     	$kb_f_condition = "select KDPA.Aset_ID, KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
											KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.noRegister,KDPA.Alamat,
											KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
											KDPA.kondisi, KDPA.kodeLokasi,KDP.Kd_Riwayat,
											K.Kode, K.Uraian
											from 
											log_kdp as KDPA,kelompok as K  
											where
											KDPA.kodeKelompok = K.Kode and 
											KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
											and $parameter_sql
											order by 
												KDPA.Aset_ID,KDPA.kodeKelompok,KDPA.kodeSatker,KDPA.TglPerubahan $limit";
          
		  $kb_f_default = "";
			
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
													M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and $parameter_sql
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, K.Kode, K.Uraian 
												order by 
													M.kodeSatker,M.Tahun,M.kodeKelompok $limit";
										
			$Modul_1_Mode_1_Case_b_default = "select 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi, K.Kode, K.Uraian 
												from 
													Mesin as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode and 
													M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1  
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, K.Kode, K.Uraian 
												order by 
													M.kodeSatker,M.Tahun,M.kodeKelompok $limit";								
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
											B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
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
											B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
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
											J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
											and $parameter_sql
											order by J.kodeSatker,J.Tahun,J.kodeKelompok $limit";
          
		  $Modul_1_Mode_1_Case_d_default = "select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi,J.kodeLokasi, 
											K.Kode, K.Uraian
											from 
											Jaringan as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode and 
											J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
											order by J.kodeSatker,J.Tahun,J.kodeKelompok  $limit";
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
											AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
											and $parameter_sql
											group by AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											order by AL.kodeSatker,AL.Tahun,AL.kodeKelompok $limit";
											
			  $Modul_1_Mode_1_Case_e_default = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
												AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
												AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
												AL.kondisi, AL.kodeLokasi,
												K.Kode, K.Uraian
												from 
												AsetLain as AL,kelompok as K  
												where
												AL.kodeKelompok = K.Kode and AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
												group by AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
												AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
												AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
												AL.kondisi, AL.kodeLokasi,
												K.Kode, K.Uraian
												order by AL.kodeSatker,AL.Tahun,AL.kodeKelompok $limit";
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
																		// $query = $query_kir_condition; 
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param_02[]="M.".$pecah[$q];
																			$param_05[]="AL.".$pecah[$q];
																			
																		}
																		
																		$newparameter_sql_02 = implode('AND ', $param_02);
																		$newparameter_sql_05 = implode('AND ', $param_05);
																		// pr($param);
																		$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeRuangan,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						Mesin as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode and 
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and 
																						(M.KodeRuangan is not null AND M.KodeRuangan !=0) 
																						and $newparameter_sql_02
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, M.kodeRuangan,K.Kode, K.Uraian 
																					order by 
																						M.kodeSatker,M.kodeRuangan,M.Tahun,M.kodeKelompok $limit";
																		
																		$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeRuangan,AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					AsetLain as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode and 
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and 
																					(AL.KodeRuangan is not null AND AL.KodeRuangan !=0) 
																					and $newparameter_sql_05
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeRuangan,AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.kodeSatker,AL.kodeRuangan,AL.Tahun,AL.kodeKelompok $limit";
																	
																		$dataQuery = array($query_02,$query_05);
																				// $dataQuery = array($query_01,$query_02,$query_03,$query_04);
																		$query = $dataQuery;
																							 
																	}
														if($parameter_sql=="" ) {
															// $query = $query_kir_default; 
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
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																						and $newparameter_sql
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.kodeSatker,M.Tahun,M.kodeKelompok $limit";	
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
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
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
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.kodeSatker,J.Tahun,J.kodeKelompok $limit";	
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
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.kodeSatker,AL.Tahun,AL.kodeKelompok $limit";	
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
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																						and $newparameter_sql_02
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.kodeSatker,M.Tahun,M.kodeKelompok $limit";
																		
																		$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					Bangunan as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode and 
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
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
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																					and $newparameter_sql_04
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.kodeSatker,J.Tahun,J.kodeKelompok $limit";
																		
																		$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					AsetLain as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode and 
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
																					and $newparameter_sql_05
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.kodeSatker,AL.Tahun,AL.kodeKelompok $limit";
																	
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
																				// pr($query);
																				// exit;
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
                                                      //kartu barang
													if (isset($kb))
													  {
														switch ($kb)
														{
                                                                 case 'KB-A':
                                                                 {
																	if($parameter_sql!="" ) {
                                                                                     $query = $kb_a_condition; 
																					 // echo "masukkk";
																	}
																	if($parameter_sql=="" ) {
                                                                                $query = $kb_a_default; 
																	}
                                                                 }		
                                                                 break;
                                                                 case 'KB-B':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $kb_b_condition;
																								}
                                                                      if($parameter_sql=="" ) {
                                                                                $query = $kb_b_default;
																								}
                                                                 }
                                                                 break;
                                                                 case 'KB-C':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $kb_c_condition;
                                                                      }
                                                                      if($parameter_sql=="" ) {
                                                                                $query = $kb_c_default;
                                                                      }
                                                                 }
                                                                 break;
                                                                 case 'KB-D':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $kb_d_condition;
                                                                      }
                                                                      if($parameter_sql=="" ){
                                                                                $query = $kb_d_default;
                                                                      }
                                                                 }
                                                                 break;
                                                                 
                                                                 case 'KB-E':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $kb_e_condition;
                                                                       }
                                                                      if($parameter_sql=="" ){
                                                                                $query = $kb_e_default;
                                                                      }
                                                                 }
                                                                 break;
														
                                                                 case 'KB-F':
                                                                 {
                                                                      if($parameter_sql!="" ){
                                                                                $query = $kb_f_condition;	
                                                                      }
                                                                      if($parameter_sql=="" ){
                                                                                $query = $kb_f_default;	
                                                                      }
                                                                 }
                                                                 break;
																}
                                                       }  
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
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
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
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
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
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
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
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
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
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
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
																					B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
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
																					J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
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
																					AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
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
												  
												  if($parameter_sql != ''){
														// $Tgl = $tglperolehan;
														$thnIntraDefault ="2008";
														$tglIntraDefault = "2008-01-01";
														
														$tglAwalDefault = $tglawalperolehan;
														$ceckTglAw = explode ('-',$tglAwalDefault);
														$thnceck = $ceckTglAw[0];
																
														$tglAkhirDefault = $tglakhirperolehan;
														$ceckTgl = explode ('-',$tglAkhirDefault);
														$thnFix = $ceckTgl[0];
														
														// echo $thnFix;
														// exit;
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
                                                        
														if(count($param_02) == 3){
															if($param_02[1] != ''){
																$satker_02 = "AND ".$param_02[2];
															}else{
																$satker_02 ="";
															}
														}
														
														if(count($param_03) == 3){
															if($param_03[1] != ''){
																$satker_03 = "AND ".$param_03[2];
															}else{
																$satker_03 ="";
															}
														}
														$KodeKa_mesin = "OR M.kodeKA = 1";
														$KodeKa_bangunan = "OR B.kodeKA = 1";
														$KodeKaCondt1_mesin = "AND M.kodeKA = 1";
														$KodeKaCondt1_bangunan = "AND B.kodeKA = 1";
														if($thnFix < $thnIntraDefault){
															// echo "tahun < 2007";
															$query_01 = "select T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		from 
																			tanah as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1  AND T.kodeLokasi like '12%'
																			and $newparameter_sql_01
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
																			
															$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3 AND M.kodeLokasi like '12%'
																			and $newparameter_sql_02 $KodeKaCondt1_mesin
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.kodeSatker,M.Tahun,M.kodeKelompok $limit";
															
															$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Bangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode and 
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3 AND B.kodeLokasi like '12%'
																		and $newparameter_sql_03 $KodeKaCondt1_bangunan
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
																		J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3 AND J.kodeLokasi like '12%'
																		and $newparameter_sql_04
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	order by J.kodeSatker,J.Tahun,J.kodeKelompok $limit";
															
															$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		AsetLain as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode and 
																		AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3 AND AL.kodeLokasi like '12%'
																		and $newparameter_sql_05
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	order by AL.kodeSatker,AL.Tahun,AL.kodeKelompok $limit";
														
															$query_06 = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		KDP as KDPA,kelompok as K  
																	where
																		KDPA.kodeKelompok = K.Kode and 
																		KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1 AND KDPA.kodeLokasi like '12%'
																		and $newparameter_sql_06
																	group by 
																		KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian	
																	order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																	
															$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
															// pr($dataQuery);
															// exit;
															$query = $dataQuery;
															// echo "kurang dari 2008";
															
														}else{
															// echo "tahun >= 2008";
															//2007-01-01 sampe 2013-01-01
															if($thnceck < $thnIntraDefault){
																// echo "sini kan";
																$extQuery_B_default = "M.TglPerolehan >= '$tglAwalDefault' AND M. TglPerolehan < '$tglIntraDefault' $satker_02";
																$extQuery_B_cndt = "M.TglPerolehan >= '$tglIntraDefault' AND M. TglPerolehan <= '$tglAkhirDefault' $satker_02";
																$extQuery_C_default = "B.TglPerolehan >= '$tglAwalDefault' AND B. TglPerolehan < '$tglIntraDefault' $satker_03";
																$extQuery_C_cndt = "B.TglPerolehan >= '$tglIntraDefault' AND B. TglPerolehan <= '$tglAkhirDefault' $satker_03";
																// echo $extQuery_C; 
															}
															//2008-01-01 sampe 2009-12-01
															elseif($thnceck >= $thnIntraDefault || $thnceck < $thnFix){
																$extQuery_B_cndt = $newparameter_sql_02;
																$extQuery_C_cndt = $newparameter_sql_03;
															}else{
																$extQuery_B_cndt = $newparameter_sql_02;
																$extQuery_C_cndt = $newparameter_sql_03;
															}
															
															
															$query_01 = "select T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		from 
																			tanah as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode and T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 AND T.kodeLokasi like '12%'
																			and $newparameter_sql_01
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
															
															$query_02_default = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.kondisi,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and M.kondisi != 3 AND M.kodeLokasi like '12%'
																			AND $extQuery_B_default $KodeKaCondt1_mesin
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.kodeSatker,M.Tahun,M.kodeKelompok $limit";
																			
															$query_02_condt = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.kondisi,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and (M.NilaiPerolehan >= 300000 $KodeKa_mesin) and M.kondisi != 3 AND M.kodeLokasi like '12%'
																			AND $extQuery_B_cndt 
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.kodeSatker,M.Tahun,M.kodeKelompok $limit";
															
															$query_03_default = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		Bangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode and 
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and B.kondisi != 3 AND B.kodeLokasi like '12%'
																		AND $extQuery_C_default $KodeKaCondt1_bangunan
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
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and (B.NilaiPerolehan >= 10000000 $KodeKa_bangunan) and B.kondisi != 3 AND B.kodeLokasi like '12%'
																		AND $extQuery_C_cndt
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
																		J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 and J.kondisi != 3 AND J.kodeLokasi like '12%'
																		and $newparameter_sql_04
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	order by J.kodeSatker,J.Tahun,J.kodeKelompok $limit";
															
															$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		AsetLain as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode and 
																		AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and AL.kondisi != 3 AND AL.kodeLokasi like '12%'
																		and $newparameter_sql_05
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	order by AL.kodeSatker,AL.Tahun,AL.kodeKelompok $limit";
														
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
																	
															if($thnceck < $thnIntraDefault){
																// echo "sini aja";
																$dataQuery = array($query_01,$query_02_default,$query_02_condt,$query_03_default,$query_03_condt,$query_04,$query_05,$query_06);
																// $dataQuery = array($query_02_default,$query_02_condt);
															}elseif($thnceck >= $thnIntraDefault || $thnceck < $thnFix){
																// echo "tahun awal tidak sama tahun akhir";
																$dataQuery = array($query_01,$query_02_condt,$query_03_condt,$query_04,$query_05,$query_06);
															}else{
																// echo "tahun awal sama tahun akhir";
																$dataQuery = array($query_02_default,$query_02_condt,$query_03_default,$query_03_condt,$query_04,$query_05,$query_06);
															}
															// pr($dataQuery);
															// exit;
															$query = $dataQuery;
															// echo "lebih dari 2008";
															// pr($query);
															// exit;
														}
															
														
													}		
												  }
												  break;
												  case '8':
												  {
													//ekstra non aset
													// exit;
													if($parameter_sql != ''){
														// echo "masukkk";
														// exit;
														$thnExtraDefault ="2008";
														$tglExtraDefault = "2008-01-01";
														$tglAwalDefault = $tglawalperolehan;
														$ceckTglAw = explode ('-',$tglAwalDefault);
														$thnceck = $ceckTglAw[0];
														// echo $thnceck; 
														$tglAkhirDefault = $tglakhirperolehan;
														$ceckTgl = explode ('-',$tglAkhirDefault);
														$thnFix = $ceckTgl[0];
														// echo $thnFix; 
														// exit;
														// $Tgl = $tglperolehan;
														
														$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																// $param_01[]="T.".$pecah[$q];
																$param_02[]="M.".$pecah[$q];
																$param_03[]="B.".$pecah[$q];
																// $param_04[]="J.".$pecah[$q];
																// $param_05[]="AL.".$pecah[$q];
																// $param_06[]="KDPA.".$pecah[$q];
														}
														
														if(count($param_02) == 3){
															if($param_02[1] != ''){
																$satker_02 = "AND ".$param_02[2];
															}else{
																$satker_02 ="";
															}
														}
														
														if(count($param_03) == 3){
															if($param_03[1] != ''){
																$satker_03 = "AND ".$param_03[2];
															}else{
																$satker_03 ="";
															}
														}														
														// $newparameter_sql_01 = implode('AND ', $param_01);
														// $newparameter_sql_02 = implode('AND ', $param_02);
														// $newparameter_sql_03 = implode('AND ', $param_03);
														// $newparameter_sql_04 = implode('AND ', $param_04);
														// $newparameter_sql_05 = implode('AND ', $param_05);
														// $newparameter_sql_06 = implode('AND ', $param_06);
														// pr($param);
														// $KodeKa_mesin = "OR M.kodeKA = 1";
														// $KodeKa_bangunan = "OR B.kodeKA = 1";
														// $KodeKaCondt1_mesin = "AND M.kodeKA = 1";
														// $KodeKaCondt1_bangunan = "AND B.kodeKA = 1";
														if($thnceck >= $thnExtraDefault){
																
															$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and (M.NilaiPerolehan < 300000 $KodeKa_mesin)
																			and M.TglPerolehan >= '$tglawalperolehan' and M.TglPerolehan <= '$tglAkhirDefault' and M.kondisi != 3 $satker_02
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
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and (B.NilaiPerolehan < 10000000 $KodeKa_bangunan)
																		and B.TglPerolehan >= '$tglawalperolehan' and B.TglPerolehan <= '$tglAkhirDefault'  and B.kondisi != 3 $satker_03
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
															$dataQuery = array($query_02,$query_03);
															// pr($dataQuery);
															// exit;
															$query = $dataQuery;		

														}elseif($thnceck < $thnExtraDefault){
														
															// echo "masukk";
															// exit;
															$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			Mesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode and 
																			M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and (M.NilaiPerolehan < 300000 $KodeKa_mesin)
																			and M.TglPerolehan >= '$tglExtraDefault' and M.TglPerolehan <= '$tglAkhirDefault' and M.kondisi != 3 $satker_02
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
																		B.StatusValidasi =1 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and (B.NilaiPerolehan < 10000000 $KodeKa_bangunan)
																		and B.TglPerolehan >= '$tglExtraDefault' and B.TglPerolehan <= '$tglAkhirDefault'  and B.kondisi != 3 $satker_03
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
														
															$dataQuery = array($query_02,$query_03);
															// pr($dataQuery);
															// exit;
															$query = $dataQuery;
														}else{
															// echo "kosong";
															// exit;
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
														
																	if($gol == 01){
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="T.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select T.kodeSatker,T.kodeLokasi,T.kodeKelompok,T.noRegister,T.Tahun,T.kodeRuangan,K.Uraian
																					from 
																						tanah as T JOIN kelompok as K ON K.Kode = T.kodeKelompok
																					where 
																						T.StatusValidasi =1 and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql
																					order by 
																						T.kodeKelompok,T.noRegister";	
																	}
																	elseif($gol == 02){
																		
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select M.kodeSatker,M.kodeLokasi,M.kodeKelompok,M.noRegister,M.Tahun,M.kodeRuangan,K.Uraian
																					from 
																						mesin as M JOIN kelompok as K ON K.Kode = M.kodeKelompok
																					where 
																						M.StatusValidasi =1 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
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
																		$query = "select B.kodeSatker,B.kodeLokasi,B.kodeKelompok,B.noRegister,B.Tahun,B.kodeRuangan,K.Uraian
																					from 
																						bangunan as B JOIN kelompok as K ON K.Kode = B.kodeKelompok
																					where 
																						B.StatusValidasi =1 and B.Status_Validasi_Barang =1 and B.StatusTampil =1 
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
																		$query = "select J.kodeSatker,J.kodeLokasi,J.kodeKelompok,J.noRegister,J.Tahun,J.kodeRuangan,K.Uraian
																					from 
																						jaringan as J JOIN kelompok as K ON K.Kode = J.kodeKelompok
																					where 
																						J.StatusValidasi =1 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
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
																		$query = "select AL.kodeSatker,AL.kodeLokasi,AL.kodeKelompok,AL.noRegister,AL.Tahun,AL.kodeRuangan,K.Uraian
																					from 
																						asetlain as AL JOIN kelompok as K ON K.Kode = AL.kodeKelompok
																					where 
																						AL.StatusValidasi =1 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
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
																		$query = "select KDPA.kodeSatker,KDPA.kodeLokasi,KDPA.kodeKelompok,KDPA.noRegister,KDPA.Tahun,KDPA.kodeRuangan,K.Uraian
																					from 
																						kdp as KDPA JOIN kelompok as K ON K.Kode = KDPA.kodeKelompok
																					where 
																						KDPA.StatusValidasi =1 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1 
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
																
																	// echo "masuk Daftar Aset Tetap - Tanah";
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
			$query ="SELECT kode FROM satker where kode like '$kdSakter%' and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
			// echo "query =".$query; 
			$result = $this->query($query) or die ($this->error());
			while($data = $this->fetch_object($result)){
				if($data != ''){
					$getkodeSatker[] = $data->kode;
				}	
			}
			// pr($getkodeSatker);
			// exit;
			$get_satker = $this->_cek_data_satker_with_id($getkodeSatker, true);
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
    public function get_report_rekap_inv_daerah($tglawalperolehan,$tglakhirperolehan)
    {
		
        $query_get_golongan_1 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(T.Aset_ID)as Jumlah, sum(T.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join tanah T on T.kodeKelompok = x.Kode and 
									T.TglPerolehan >='$tglawalperolehan' and T.TglPerolehan <='$tglakhirperolehan' and T.Status_Validasi_Barang = 1 and T.StatusTampil = 1
								where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(M.Aset_ID)as Jumlah, sum(M.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join mesin M on M.kodeKelompok = x.Kode and 
									M.TglPerolehan >='$tglawalperolehan' and M.TglPerolehan <='$tglakhirperolehan' and M.Status_Validasi_Barang = 1 and M.StatusTampil = 1 
								where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(B.Aset_ID)as Jumlah, sum(B.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join bangunan B on B.kodeKelompok = x.Kode and 
									B.TglPerolehan >='$tglawalperolehan' and B.TglPerolehan <='$tglakhirperolehan' and B.Status_Validasi_Barang = 1 and B.StatusTampil = 1 
								where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(J.Aset_ID)as Jumlah, sum(J.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join jaringan J on J.kodeKelompok = x.Kode and 
									J.TglPerolehan >='$tglawalperolehan' and  J.TglPerolehan <='$tglakhirperolehan' and J.Status_Validasi_Barang = 1 and J.StatusTampil = 1 
								where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(AL.Aset_ID)as Jumlah, sum(AL.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join asetlain AL on AL.kodeKelompok = x.Kode and 
									AL.TglPerolehan >='$tglawalperolehan' and AL.TglPerolehan <='$tglakhirperolehan' and AL.Status_Validasi_Barang = 1 and AL.StatusTampil = 1 
								where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(KDPA.Aset_ID)as Jumlah, sum(KDPA.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join kdp KDPA on KDPA.kodeKelompok = x.Kode and 
									KDPA.TglPerolehan >='$tglawalperolehan' and KDPA.TglPerolehan <='$tglakhirperolehan' and KDPA.Status_Validasi_Barang = 1 and KDPA.StatusTampil = 1
								where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		
		/*echo "query =".$query_get_golongan_1;
		echo "<br>";
		echo "query =".$query_get_golongan_2;
		echo "<br>";
		echo "query =".$query_get_golongan_3;
		echo "<br>";
		echo "query =".$query_get_golongan_4;
		echo "<br>";
		echo "query =".$query_get_golongan_5;
		echo "<br>";
		echo "query =".$query_get_golongan_6;
		echo "<br>";*/
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
		
        // pr($dataArr);
		// exit;
        return $dataArr;
    }
    
    //REVISI REKAP SKPD
    public function get_report_rekap_inv_skpd($parameter,$tglawalperolehan,$tglakhirperolehan)
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
												T.kodeSatker = '$Satker_ID' and T.TglPerolehan >='$tglawalperolehan' and T.TglPerolehan <='$tglakhirperolehan' and T.Status_Validasi_Barang = 1 and T.StatusTampil = 1
											where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(M.Aset_ID)as Jumlah, sum(M.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join mesin M on M.kodeKelompok = x.Kode and 
												M.kodeSatker = '$Satker_ID' and M.TglPerolehan >='$tglawalperolehan' and M.TglPerolehan <='$tglakhirperolehan' and M.Status_Validasi_Barang = 1 and M.StatusTampil = 1 
											where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(B.Aset_ID)as Jumlah, sum(B.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join bangunan B on B.kodeKelompok = x.Kode and 
												B.kodeSatker = '$Satker_ID' and B.TglPerolehan >='$tglawalperolehan' and B.TglPerolehan <='$tglakhirperolehan' and B.Status_Validasi_Barang = 1 and B.StatusTampil = 1 
											where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(J.Aset_ID)as Jumlah, sum(J.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join jaringan J on J.kodeKelompok = x.Kode and 
												J.kodeSatker = '$Satker_ID' and J.TglPerolehan >='$tglawalperolehan' and J.TglPerolehan <='$tglakhirperolehan' and J.Status_Validasi_Barang = 1 and J.StatusTampil = 1 
											where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(AL.Aset_ID)as Jumlah, sum(AL.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join asetlain AL on AL.kodeKelompok = x.Kode and 
												AL.kodeSatker = '$Satker_ID' and AL.TglPerolehan >='$tglawalperolehan' and AL.TglPerolehan <='$tglakhirperolehan' and AL.Status_Validasi_Barang = 1 and AL.StatusTampil = 1 
											where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(KDPA.Aset_ID)as Jumlah, sum(KDPA.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join kdp KDPA on KDPA.kodeKelompok = x.Kode and 
												KDPA.kodeSatker = '$Satker_ID' and KDPA.TglPerolehan >='$tglawalperolehan' and KDPA.TglPerolehan <='$tglakhirperolehan' and KDPA.Status_Validasi_Barang = 1 and KDPA.StatusTampil = 1
											where k.Golongan='06' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					
					/*echo $query_get_golongan_1;
					echo "<br>";
					echo $query_get_golongan_2;
					echo "<br>";
					echo $query_get_golongan_3;
					echo "<br>";
					echo $query_get_golongan_4;
					echo "<br>";
					echo $query_get_golongan_5;
					echo "<br>";
					echo $query_get_golongan_6;
					echo "<br>";*/
					// exit;
					// $dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6', 'query_get_golongan_7');
					$dataGolongan = array('query_get_golongan_1', 'query_get_golongan_2', 'query_get_golongan_3', 'query_get_golongan_4', 'query_get_golongan_5', 'query_get_golongan_6');
					for ($i = 0; $i <6; $i++)
					{
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
        <!-- <div id="list_header"> 
           
        </div>-->
        <div style="border-style:solid; width:40%; margin:20px auto; border-width:1px; box-shadow:5px 5px 5px #ccd" align="center">
            <table border="0">
                <tr>
                    <th height="50px" valign=""><p style="font-size:25px;">Download Laporan tersedia dalam bentuk:</p><hr></th>
                </tr>
				<tr>
                    <td><p style="font-size: 12px; color: blue">1. <a href="<?php echo "$url"."1"?>" target="_blank">PDF</a><br/></p></td>
                </tr>

               <tr>
                    <td><p style="font-size: 12px; color: blue">2. <a href="<?php echo "$url"."2"?>" target="_blank">Micorosoft Excel</a></p></td>
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
							if($i!=$arrlength)$output.=", ";
							$awal=$temp;
							$akhir="";
						}else{
							$awal = sprintf("%04s", $awal);
							
							$output.=$awal;
							if($i!=$arrlength)$output.=", ";
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
			for($m=0;$m<=count($register_no);$m++){
				if($register_no[$m]!="")
					{
					$data[$keys]['noRegister']=$register_no[$m];
					array_push($iman,$data[$keys])  ;
					}
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
			// echo "<br>";
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
		// pr($data);
		/* exit; */
		$ignoreField = array('Kode','Uraian');
		$i=1;
		$x=0;
		$data_reg=1;
		$count_reg=0;
		$iman=array();
		// pr($data);
		// exit;
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
				// pr($sql);
				$res = mysql_query($sql);
				$register=array();

				while($d = @mysql_fetch_assoc($res)){
				  
					$register[]= $d['noRegister'];
				}
				// pr($register);
				sort($register);
				$text_register=implode(",",$register);
				//$data[$keys]['noRegister']=$this->sortirNoReg($text_register);
				$register_no=explode(",",$this->sortirNoReg($text_register));
				// pr($register_no);
				for($m=0;$m<=count($register_no);$m++){
					if($register_no[$m]!="")
					{
						$data[$keys]['noRegister']=$register_no[$m];
						array_push($iman,$data[$keys]);
						}
				}
				$x++;
				$i++;
			}
			// pr($data);
			//exit;
			return $iman;
		}
		else{
			return false;
		}
	
	}

	public function ceckGol ($satker,$tglawalperolehan,$tglakhirperolehan,$paramGol){
			// echo $satker."-".$tglawalperolehan."-".$tglakhirperolehan."-".$paramGol;
			if($paramGol != ''){
				$query ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k 
					where k.Golongan=$paramGol and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null 
					order by k.Kode ";
			}else{
				$query ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where (k.kode not like '01%' and k.kode not like '07%' and k.kode not like '08%') and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null order by k.Kode ";		
			}		
			
			// pr($query);
			// exit;
			$result_golongan = $this->query($query) or die ($this->error('error'));	
			while ($data = $this->fetch_object($result_golongan))
			{
				$datagol[$data->Kode] = $data->Uraian;
			}
			// pr($datagol);
			// exit;
			$tgldefault = "2008-01-01";
			$thnDefault ="2008";
			
			$tglAwalDefault = $tglawalperolehan;
			$ceckTglAw = explode ('-',$tglAwalDefault);
			$thnceck = $ceckTglAw[0];
			
			$tglAkhirDefault = $tglakhirperolehan;
			$ceckTgl = explode ('-',$tglAkhirDefault);
			$thnFix = $ceckTgl[0];
			// $KodeKa_t = "OR t.kodeKA != 0";
			$KodeKa_m = "AND m.kodeKA = 1";
			$KodeKa_m_2 = "OR m.kodeKA = 1";
			
			$KodeKa_b = "AND b.kodeKA = 1";
			$KodeKa_b_2 = "OR b.kodeKA = 1";
			// $KodeKa_j = "OR j.kodeKA != 0";
			// $KodeKa_al = "OR al.kodeKA != 0";
			// $KodeKa_kdp = "OR kdp.kodeKA != 0";
			$KodeKa_lain= "AND a.kodeKA != 0";
			
				foreach ($satker as $Satker_ID)
				{
					foreach ($datagol as $data=>$value)
					{
						// pr($value);
						if($paramGol == 01 ){
							$queryok ="SELECT k.Uraian, t.Alamat, t.LuasTotal, t.NilaiPerolehan 
										FROM tanah as t, kelompok as k 
										WHERE t.kodeKelompok =k.Kode and t.kodeSatker = '$Satker_ID' and t.TglPerolehan >= '$tglAwalDefault' and t.TglPerolehan <= '$tglAkhirDefault' and t.TglPembukuan >= '$tglAwalDefault' and t.TglPembukuan <= '$tglAkhirDefault' and t.Status_Validasi_Barang =1 and t.StatusTampil = 1 and t.kodeLokasi like '12%'
										$KodeKa_t order by t.kodeSatker,t.kodeKelompok";
						}elseif($paramGol == 02){
							
							if($thnFix < $thnDefault){
								$queryok="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai 
									   from mesin as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and M.TglPerolehan >= '$tglAwalDefault' AND M.TglPerolehan <= '$tglAkhirDefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault' and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' group by m.kodeKelompok 
									   $KodeKa_m ORDER BY m.kodeKelompok ";
							}elseif($thnceck >= $thnDefault){
								$queryok ="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai 
								   from mesin as m,kelompok as k where 
								   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and m.TglPerolehan >= '$tglAwalDefault' and m.TglPerolehan <='$tglAkhirDefault' and m.TglPembukuan >= '$tglAwalDefault' and m.TglPembukuan <='$tglAkhirDefault' 
								   and (m.NilaiPerolehan >=300000 $KodeKa_m_2) and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' and m.kodeLokasi like '12%' 
								   group by m.kodeKelompok ";
							}else{
								$queryok ="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai 
									   from mesin as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker ='$Satker_ID' and m.kondisi != '3' and M.TglPerolehan >= '$tglAwalDefault' AND M.TglPerolehan < '$tgldefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault' and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' 
									   $KodeKa_m
									   group by m.kodeKelompok 
									   union all
									   select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai 
									   from mesin as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and m.TglPerolehan >= '$tgldefault' and m.TglPerolehan <='$tglAkhirDefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault'  
									   and (m.NilaiPerolehan >=300000 $KodeKa_m_2) and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' 
									   group by m.kodeKelompok order by kodeKelompok";
							}
							
						}elseif($paramGol == 03){
							if($thnFix < $thnDefault){
								$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan FROM bangunan as b, kelompok as k 
										WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' AND b. TglPembukuan <= '$tglAkhirDefault'  and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'
										$KodeKa_b order by b.kodeKelompok ";
							}elseif($thnceck >= $thnDefault){
								$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan FROM bangunan as b, kelompok as k 
										WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' and b.TglPembukuan <= '$tglAkhirDefault' 
										and (b.NilaiPerolehan >=10000000 $KodeKa_b_2) and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'";
							}else{
								$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan FROM bangunan as b, kelompok as k 
									WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tgldefault' and b.TglPembukuan >= '$tglAwalDefault' AND b.TglPembukuan <= '$tglAkhirDefault' and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%' 
									$KodeKa_b
									union all
									SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan FROM bangunan as b, kelompok as k 
									WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tgldefault' and b.TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' AND b.TglPembukuan <= '$tglAkhirDefault' 
									and (b.NilaiPerolehan >=10000000 $KodeKa_b_2) and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'";
							}
						}elseif($paramGol == 04){
							$queryok ="SELECT k.Uraian, j.Alamat, j.LuasJaringan, j.NilaiPerolehan FROM jaringan as j, kelompok as k 
										WHERE j.kodeKelompok =k.Kode and j.kodeKelompok like '$data%' and j.kodeSatker = '$Satker_ID' and j.TglPerolehan >= '$tglAwalDefault' and j.TglPerolehan <= '$tglAkhirDefault' and j.TglPembukuan >= '$tglAwalDefault' and j.TglPembukuan <= '$tglAkhirDefault'  and j.kondisi != '3' and j.Status_Validasi_Barang =1 and j.StatusTampil = 1 and j.kodeLokasi like '12%'
										$KodeKa_j
										order by j.kodeKelompok ";
						
						}elseif($paramGol == 05){
							
							$queryok ="select al.kodeKelompok,k.Uraian,count(al.AsetLain_ID) as jumlah,sum(al.NilaiPerolehan) as Nilai 
									   from asetlain as al,kelompok as k where 
									   al.kodeKelompok = k.Kode and al.kodeKelompok like '$data%' and al.kodeSatker = '$Satker_ID' and al.TglPerolehan >= '$tglAwalDefault' and al.TglPerolehan <= '$tglAkhirDefault' and al.TglPembukuan >= '$tglAwalDefault' and al.TglPembukuan <= '$tglAkhirDefault' and al.kondisi != '3' and al.Status_Validasi_Barang =1 and al.StatusTampil = 1 and al.kodeLokasi like '12%' 
									   $KodeKa_al
									   group by al.kodeKelompok ORDER BY al.AsetLain_ID ASC";
						}elseif($paramGol == 06){
							$queryok ="SELECT k.Uraian, kdp.Alamat, kdp.LuasLantai, kdp.NilaiPerolehan FROM kdp as kdp, kelompok as k 
										WHERE kdp.kodeKelompok =k.Kode and kdp.kodeKelompok like '$data%' and kdp.kodeSatker = '$Satker_ID' and kdp.TglPerolehan >= '$tglAwalDefault' and kdp.TglPerolehan <= '$tglAkhirDefault' and kdp.TglPembukuan >= '$tglAwalDefault' and kdp.TglPembukuan <= '$tglAkhirDefault' and kdp.Status_Validasi_Barang =1 and kdp.StatusTampil = 1 and kdp.kodeLokasi like '12%'
										$KodeKa_kdp order by kdp.kodeKelompok ";
						}
						else{
							$queryok="SELECT a.kodeKelompok, count(a.Aset_ID) as jml, sum(a.NilaiPerolehan) as Nilai,k.Uraian 
										FROM aset as a, kelompok as k 
										WHERE a.kodeKelompok = k.Kode and a.kodeSatker LIKE '$Satker_ID' 
										AND a.kondisi = 3 AND a.kodeKelompok like '$data%' and a.TglPerolehan >= '$tglAwalDefault' and a.TglPerolehan <= '$tglAkhirDefault' and a.TglPembukuan >= '$tglAwalDefault' and a.TglPembukuan <= '$tglAkhirDefault' and a.StatusValidasi = 1 and a.kodeLokasi like '12%' 
										$KodeKa_lain
										group by a.kodeKelompok";
						}
						// echo $queryok ; 	
						// echo "<br>";
						// echo "<br>";
						// exit;
						$result = $this->query($queryok) or die ($this->error('error'));		
						while ($data = $this->fetch_object($result))
						{
							$getdata[$Satker_ID][$value][]= $data;
						}
					}
				}
				// pr($getdata);
				// exit;
		return 	$getdata;
	}
	
	public function ceckneraca($Satker_ID,$tglawalperolehan,$tglakhirperolehan){
			
			$queryparentGol="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where k.Bidang is null and k.Kelompok is null and k.Sub is null and k.SubSub is null  and Kode != '08' order by k.Kode";
			// echo $queryparentGol;
			$resultparentGol = $this->query($queryparentGol) or die ($this->error('error'));	
			while ($data = $this->fetch_object($resultparentGol))
			{
				$dataparentgol[$data->Kode] = $data->Uraian;
			}
			// pr($dataparentgol);
			// exit;
			// $tglperolehandefault = "2008-01-01";

			$tgldefault = "2008-01-01";
			$thnDefault ="2008";
			
			$tglAwalDefault = $tglawalperolehan;
			$ceckTglAw = explode ('-',$tglAwalDefault);
			$thnceck = $ceckTglAw[0];
			
			$tglAkhirDefault = $tglakhirperolehan;
			$ceckTgl = explode ('-',$tglAkhirDefault);
			$thnFix = $ceckTgl[0];
			$KodeKa = "OR kodeKA = 1";
			$KodeKaCondt1 = "AND kodeKA = 1";
				if($Satker_ID != ''){
				// foreach ($satker as $Satker_ID)
				// {
					foreach ($dataparentgol as $data=>$value)
					{
						$datachildGol =array();
						$querychildGol ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where k.Golongan = '$data' and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null order by k.Kode ";		
						// echo "<br>";
						// echo "child gol =".$querychildGol;
						// echo "<br>";
						$resultchildGol = $this->query($querychildGol) or die ($this->error('error'));	
						while ($data2 = $this->fetch_object($resultchildGol))
						{
							$datachildGol[$data2->Kode] = $data2->Uraian;
						}
						// pr($datachildGol[$data2->Kode]);
						foreach ($datachildGol as $data2=>$value2)
						{	
							$datafix =array();
							if($thnFix  < $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM tanah WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM jaringan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM asetlain WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM kdp WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi =1";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi is null";
								}
							}elseif($thnceck >= $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM tanah WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=300000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=10000000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM jaringan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM asetlain WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM kdp WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi =1 ";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi is null";
								}
							}
							else{
								//add and kodeKA != 0
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM tanah WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker  like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
													$KodeKaCondt1
													UNION ALL
													SELECT sum(NilaiPerolehan) as nilai,count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and (NilaiPerolehan >=300000 $KodeKa) and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";	
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
												$KodeKaCondt1
												UNION ALL
												SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and (NilaiPerolehan >=10000000 $KodeKa)  and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";	
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM jaringan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM asetlain WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM kdp WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 ";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi =1  $KodeKaCondt1";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi is null";
								}
							}
							// echo "<br>";
							// echo $queryresult;
							// echo "<br>";
							$resultfix = $this->query($queryresult) or die ($this->error('error'));	
							if($resultfix){
							while ($data3 = $this->fetch_object($resultfix))
							{
								// $datafix[] = $data3->nilai;
								if($data3->nilai == NULL){
									$nilai = 0;
								}else{
									$nilai = $data3->nilai;
								}
								$datafix[] = $data3->jumlah."_".$nilai;
								
							}
								$getdata[$Satker_ID][$data."_".$value][$data2."_".$value2][]= $datafix;
						}
					 }
					}
				}else{
					$qsat = "SELECT kode,NamaSatker FROM satker where KodeSatker is null and kode is not null and KodeUnit is null and Gudang is null and Kd_Ruang is NULL";
					$rsat = $this->query($qsat) or die ($this->error());
					while($dtrsat = $this->fetch_object($rsat)){
						if($dtrsat != ''){
							$satker[] = $dtrsat->kode;
							// $satker[] = $dtrsat->kode;
						}	
					}
				  // pr($satker);
				  // exit;	
				  foreach ($satker as $Satker_ID)
				  {
					foreach ($dataparentgol as $data=>$value)
					{
						$datachildGol =array();
						$querychildGol ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where k.Golongan = '$data' and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null order by k.Kode ";		
						// echo "<br>";
						// echo "child gol =".$querychildGol;
						// echo "<br>";
						$resultchildGol = $this->query($querychildGol) or die ($this->error('error'));	
						while ($data2 = $this->fetch_object($resultchildGol))
						{
							$datachildGol[$data2->Kode] = $data2->Uraian;
						}
						// pr($datachildGol[$data2->Kode]);
						foreach ($datachildGol as $data2=>$value2)
						{	
							$datafix =array();
							if($thnFix  < $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM tanah WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM jaringan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM asetlain WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM kdp WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi =1";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi is null";
								}
							}elseif($thnceck >= $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM tanah WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=300000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=10000000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM jaringan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM asetlain WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM kdp WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi =1 ";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi is null";
								}
							}
							else{
								//add and kodeKA != 0
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM tanah WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker  like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
													$KodeKaCondt1
													UNION ALL
													SELECT sum(NilaiPerolehan) as nilai,count(Aset_ID) as jumlah FROM mesin WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and (NilaiPerolehan >=300000 $KodeKa) and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";	
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
												$KodeKaCondt1
												UNION ALL
												SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM bangunan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and (NilaiPerolehan >=10000000 $KodeKa)  and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";	
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM jaringan WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM asetlain WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM kdp WHERE kodeKelompok like '$data2%' and kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 ";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi =1  $KodeKaCondt1";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM aset WHERE kodeSatker like '$Satker_ID%' and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and kondisi ='3' and StatusValidasi is null";
								}
							}
							// echo "<br>";
							// echo $queryresult;
							// echo "<br>";
							$resultfix = $this->query($queryresult) or die ($this->error('error'));	
							if($resultfix){
								while ($data3 = $this->fetch_object($resultfix))
								{
									// $datafix[] = $data3->nilai;
									if($data3->nilai == NULL){
										$nilai = 0;
									}else{
										$nilai = $data3->nilai;
									}
									$datafix[] = $data3->jumlah."_".$nilai;
									
								}
									$getdata[$Satker_ID][$data."_".$value][$data2."_".$value2][]= $datafix;
							}
						}
					 }
				  }
				}
				// pr($getdata);
				// exit;
		return 	$getdata;
	}
	
	public function barangskpd($satker_id,$tglawalperolehan,$tglakhirperolehan){
		// echo "satker id =".$satker_id;
		if($satker_id != ''){
			$ceck = explode('.', $satker_id);
			// pr($ceck);
			$count = count($ceck);
			// pr($count);
			if($count == 1){
				$qsat = "SELECT kode,NamaSatker FROM satker WHERE kode LIKE '$satker_id%' and Kd_Ruang is null and Gudang is null and KodeUnit is null and KodeSatker is not null ";
				$rsat = $this->query($qsat) or die ($this->error());
				while($dtrsat = $this->fetch_object($rsat)){
					if($dtrsat != ''){
						// $satker[] = $dtrsat->kode;
						$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
					}	
				}
			}else{
				$qsat = "SELECT kode,NamaSatker FROM satker WHERE kode = '$satker_id' and Kd_Ruang is null ";
				$rsat = $this->query($qsat) or die ($this->error());
				while($dtrsat = $this->fetch_object($rsat)){
					if($dtrsat != ''){
						$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
						// $satker[] = $dtrsat->kode;
					}	
				}
			}
		}else{
			$qsat = "SELECT kode,NamaSatker FROM satker WHERE kode is not null and Kd_Ruang is null and Gudang is null and KodeUnit is null and KodeSatker is not null ";
			$rsat = $this->query($qsat) or die ($this->error());
				while($dtrsat = $this->fetch_object($rsat)){
					if($dtrsat != ''){
						$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
						// $satker[] = $dtrsat->kode;
					}	
				}
		}
		// pr($satker);
		// exit;
		// echo $satker[0];
		$tglDefault = '2008-01-01';
		$thnDefault ="2008";
			
		$tglAwalDefault = $tglawalperolehan;
		$ceckTglAw = explode ('-',$tglAwalDefault);
		$thnceck = $ceckTglAw[0];
		
		$tglAkhirDefault = $tglakhirperolehan;
		$ceckTgl = explode ('-',$tglAkhirDefault);
		$thnFix = $ceckTgl[0];
		
		$KodeKa = "OR kodeKA = 1";
		$KodeKaCondt1 = "AND kodeKA = 1";
		
		// foreach ($satker as $data){
		foreach ($satker as $data=>$satker_id){
		
			$query_01 = "SELECT sum(NilaiPerolehan) as nilai FROM tanah
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							";
			$query_02_default = "SELECT sum(NilaiPerolehan) as nilai FROM mesin
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1";
							
			$query_02_condt_1 = "SELECT sum(NilaiPerolehan) as nilai FROM mesin
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and (NilaiPerolehan >= 300000 $KodeKa)";
							
			$query_02_condt_2 = "SELECT sum(NilaiPerolehan) as nilai FROM mesin
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai FROM mesin
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglakhirperolehan' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 300000 $KodeKa)";
			
			$query_03_default = "SELECT sum(NilaiPerolehan) as nilai FROM bangunan
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1";
							
			$query_03_condt_1 = "SELECT sum(NilaiPerolehan) as nilai FROM bangunan
						WHERE $kodeKelompok kodeSatker like '$satker_id%'  
						and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
						and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
						and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
						and (NilaiPerolehan >= 10000000 $KodeKa)";
							
			$query_03_condt_2 = "SELECT sum(NilaiPerolehan) as nilai  FROM bangunan
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai FROM bangunan
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 10000000 $KodeKa)";	
							
			$query_04 = "SELECT sum(NilaiPerolehan) as nilai FROM jaringan
				WHERE kodeSatker like '$satker_id%'  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'";
				
			$query_05 = "SELECT sum(NilaiPerolehan) as nilai FROM asetlain
				WHERE kodeSatker like '$satker_id%'  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'";	

			$query_06 = "SELECT sum(NilaiPerolehan) as nilai FROM kdp
				WHERE kodeSatker like '$satker_id%' 
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'";
				
			$query_07 = "SELECT sum(NilaiPerolehan) as nilai FROM aset
				WHERE kodeSatker like '$satker_id%' 
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan < '$tglAkhirDefault' 
				and StatusValidasi =1 and kodeLokasi and kondisi = 3 like '12%' $KodeKaCondt1";	
			
			if($thnFix < $thnDefault){
				// echo "tahun kurang dari 2008";
				$queryALL = array($query_01,$query_02_default,$query_03_default,$query_04,$query_05,$query_06,$query_07);
			}elseif($thnceck >= $thnDefault){
				// echo "tahun diatas dari 2008";
				$queryALL = array($query_01,$query_02_condt_1,$query_03_condt_1,$query_04,$query_05,$query_06,$query_07);
			}else{
				// echo "<2008 >2008";
				$queryALL = array($query_01,$query_02_condt_2,$query_03_condt_2,$query_04,$query_05,$query_06,$query_07);
				// $queryALL = array($query_02_condt_2);
			}
		// $hitung  = count($queryALL);
		// echo "hitung".$hitung;
		// pr($queryALL);
		// exit;
			
			for ($i = 0; $i < count($queryALL); $i++)
			{
				
				/*echo "<br>";
				echo "query_$i =".$queryALL[$i];
				echo "<br>";
				echo "<br>";*/
				// exit;
				$result = $this->query($queryALL[$i]) or die ($this->error('error dataQuery'));
				// echo "masukk";
					// exit;
				
				if($result){
					// $i = 0;
					while ($dataAll = $this->fetch_object($result))
					{
						// $datafix[] = $data3->nilai;
						if($dataAll->nilai == NULL){
							$nilai = 0;
						}else{
							$nilai = $dataAll->nilai;
						}
						$getdata[$data][]= $nilai;
					}
					
							
				}
				
			}
			// pr($data);
			
		}
		// pr($getdata);
		
		// exit;
		return $getdata;
			
	}
	
	public function barangupb($satker_id,$tglawalperolehan,$tglakhirperolehan){
		if($satker_id){
			$qsat = "SELECT kode,NamaSatker FROM satker where kode like '$satker_id%' and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					// $satker[] = $dtrsat->kode;
					$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
				}	
			}
		}else{
			$qsat = "SELECT kode,NamaSatker FROM satker where kode is not null and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL ";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					// $satker[] = $dtrsat->kode;
					$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
				}	
			}
		
		}
		// pr($satker);
		// exit;
		$tglDefault = '2008-01-01';
		$thnDefault ="2008";
			
		$tglAwalDefault = $tglawalperolehan;
		$ceckTglAw = explode ('-',$tglAwalDefault);
		$thnceck = $ceckTglAw[0];
		
		$tglAkhirDefault = $tglakhirperolehan;
		$ceckTgl = explode ('-',$tglAkhirDefault);
		$thnFix = $ceckTgl[0];
		
		$KodeKa = "OR kodeKA = 1";
		$KodeKaCondt1 = "AND kodeKA = 1";
		
		foreach ($satker as $data=>$satker_id){
		
			$query_01 = "SELECT sum(NilaiPerolehan) as nilai FROM tanah
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							";
			$query_02_default = "SELECT sum(NilaiPerolehan) as nilai FROM mesin
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1";
							
			$query_02_condt_1 = "SELECT sum(NilaiPerolehan) as nilai FROM mesin
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and (NilaiPerolehan >= 300000 $KodeKa)";
							
			$query_02_condt_2 = "SELECT sum(NilaiPerolehan) as nilai FROM mesin
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai FROM mesin
							WHERE kodeSatker like '$satker_id%'  
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglakhirperolehan' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 300000 $KodeKa)";
			
			$query_03_default = "SELECT sum(NilaiPerolehan) as nilai FROM bangunan
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1";
							
			$query_03_condt_1 = "SELECT sum(NilaiPerolehan) as nilai FROM bangunan
						WHERE $kodeKelompok kodeSatker like '$satker_id%'  
						and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
						and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
						and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
						and (NilaiPerolehan >= 10000000 $KodeKa)";
							
			$query_03_condt_2 = "SELECT sum(NilaiPerolehan) as nilai  FROM bangunan
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai FROM bangunan
							WHERE kodeSatker like '$satker_id%' 
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 10000000 $KodeKa)";	
							
			$query_04 = "SELECT sum(NilaiPerolehan) as nilai FROM jaringan
				WHERE kodeSatker like '$satker_id%'  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'";
				
			$query_05 = "SELECT sum(NilaiPerolehan) as nilai FROM asetlain
				WHERE kodeSatker like '$satker_id%'  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'";	

			$query_06 = "SELECT sum(NilaiPerolehan) as nilai FROM kdp
				WHERE kodeSatker like '$satker_id%' 
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'";
				
			$query_07 = "SELECT sum(NilaiPerolehan) as nilai FROM aset
				WHERE kodeSatker like '$satker_id%' 
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan < '$tglAkhirDefault' 
				and StatusValidasi =1 and kondisi = 3 and kodeLokasi like '12%' $KodeKaCondt1";	
			
			if($thnFix < $thnDefault){
				// echo "tahun kurang dari 2008";
				$queryALL = array($query_01,$query_02_default,$query_03_default,$query_04,$query_05,$query_06,$query_07);
			}elseif($thnceck >= $thnDefault){
				// echo "tahun diatas dari 2008";
				$queryALL = array($query_01,$query_02_condt_1,$query_03_condt_1,$query_04,$query_05,$query_06,$query_07);
			}else{
				// echo "<2008 >2008";
				$queryALL = array($query_01,$query_02_condt_2,$query_03_condt_2,$query_04,$query_05,$query_06,$query_07);
				// $queryALL = array($query_02_condt_2);
			}
		// $hitung  = count($queryALL);
		// echo "hitung".$hitung;
		// pr($queryALL);
		// exit;
			
			for ($i = 0; $i < count($queryALL); $i++)
			{
				
				/*echo "<br>";
				echo "query_$i =".$queryALL[$i];
				echo "<br>";
				echo "<br>";*/
				// exit;
				$result = $this->query($queryALL[$i]) or die ($this->error('error dataQuery'));
				// echo "masukk";
					// exit;
				
				if($result){
					// $i = 0;
					while ($dataAll = $this->fetch_object($result))
					{
						// $datafix[] = $data3->nilai;
						if($dataAll->nilai == NULL){
							$nilai = 0;
						}else{
							$nilai = $dataAll->nilai;
						}
						$getdata[$data][]= $nilai;
					}
					
							
				}
				
			}
			// pr($data);
			
		}
		// pr($getdata);
		// exit;
		return $getdata;
			
	}
	
	public function MutasiBarang($satker_id,$tglAwal,$tglAkhir){
		if($satker_id){
			$qsat = "SELECT kode FROM satker where kode like '$satker_id%' and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					// $satker[] = $dtrsat->kode;
					// $satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
					$satker[] = $dtrsat->kode;
				}	
			}
		}else{
			$qsat = "  SELECT distinct(`kodeSatker`) FROM `aset` where (`NilaiPerolehan` is not null and `NilaiPerolehan` != '') order by kodeSatker asc   ";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					// $satker[] = $dtrsat->kode;
					// $satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
					$satker[] = $dtrsat->kode;
				}	
			}
		}
		// pr($satker);
		// exit;
		// SELECT T.log_id,T.Aset_ID,T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan,T.NilaiPerolehan_Awal,T.AsalUsul,T.noRegister,T.kodeLokasi,T.Kd_Riwayat FROM log_tanah as T where T.Kd_Riwayat in (2,21,7,3) and kodeSatker like '08.01.01.01%' and T.TglPerubahan >= '2013-01-01' AND T.TglPerubahan <= '2013-12-31' group by Aset_ID desc 
		foreach ($satker as $data=>$satker_id){
			// pr($satker_id);
			$query_01 = "SELECT distinct(T.Aset_ID),T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan,T.NilaiPerolehan_Awal,T.AsalUsul,T.noRegister,T.kodeLokasi,T.Kd_Riwayat
						FROM 
							log_tanah as T
						where 
							T.Kd_Riwayat in (2,21,7,3) and kodeSatker like '$satker_id%'  
							and T.TglPerubahan >= '$tglAwal' AND T.TglPerubahan <= '$tglAkhir' group by T.Aset_ID desc";
			$query_02 = "SELECT distinct(M.Aset_ID),
										M.kodeSatker,M.kodeKelompok,M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
										M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
										M.Silinder,M.kodeLokasi,M.NilaiPerolehan,M.NilaiPerolehan_Awal,M.noRegister,M.kondisi,M.Kd_Riwayat
						FROM 
							log_mesin as M
						where 
							M.Kd_Riwayat in (2,21,7,3) and M.kodeSatker like '$satker_id%' 
							and M.TglPerubahan >= '$tglAwal' AND M.TglPerubahan <= '$tglAkhir'
							group by M.Aset_ID desc";
			$query_03 = "SELECT distinct(B.Aset_ID),
										B.kodeSatker,B.kodeKelompok,B.AsalUsul,
										B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
										B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
										B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
										B.NilaiPerolehan,B.NilaiPerolehan_Awal,B.noRegister,B.Kd_Riwayat
						FROM log_bangunan as B
						where 
							B.Kd_Riwayat in (2,21,7,3) and B.kodeSatker like '$satker_id%' 
							and B.TglPerubahan >= '$tglAwal' AND B.TglPerubahan <= '$tglAkhir' 
							group by B.Aset_ID desc";
			$query_04 = "SELECT distinct(J.Aset_ID),
										J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
										J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
										J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
										J.kondisi, J.kodeLokasi,J.NilaiPerolehan,J.NilaiPerolehan_Awal,J.noRegister,J.Kd_Riwayat
						FROM log_jaringan as J
						where 
							J.Kd_Riwayat in (2,21,7,3) and J.kodeSatker like '$satker_id%' 
							and J.TglPerubahan >= '$tglAwal' AND J.TglPerubahan <= '$tglAkhir' 
							group by J.Aset_ID desc";
			$query_05 = "SELECT distinct(AL.Aset_ID),
										AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
										AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
										AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
										AL.kondisi, AL.kodeLokasi,AL.NilaiPerolehan,AL.NilaiPerolehan_Awal,AL.noRegister,AL.Kd_Riwayat
						FROM log_asetlain as AL
						where 
							AL.Kd_Riwayat in (2,21,7,3) and AL.kodeSatker like '$satker_id%' 
							and AL.TglPerubahan >= '$tglAwal' AND AL.TglPerubahan <= '$tglAkhir'
							group by AL.Aset_ID desc";
			$query_06 = "SELECT distinct(KDPA.Aset_ID),
										KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
										KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
										KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
										KDPA.kondisi, KDPA.kodeLokasi,
										KDPA.NilaiPerolehan,KDPA.NilaiPerolehan_Awal,KDPA.noRegister,KDPA.Kd_Riwayat
						FROM log_kdp as KDPA
						where KDPA.Kd_Riwayat in (2,21,7,3) and KDPA.kodeSatker like '$satker_id%' 
							and KDPA.TglPerubahan >= '$tglAwal' AND KDPA.TglPerubahan <= '$tglAkhir' 
						group by KDPA.Aset_ID desc";
			
			
			// $queryALL = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
			$queryALL = array($query_01);
			
			
			for ($i = 0; $i < count($queryALL); $i++)
			{
				
				/*echo "<br>";
				echo "query_$i =".$queryALL[$i];
				echo "<br>";
				echo "<br>";*/
				// exit;
				$result = $this->query($queryALL[$i]) or die ($this->error('error dataQuery'));
				if($result){
					// $i = 0;
					while ($dataAll = $this->fetch_object($result))
					{
						// $getdata[$satker_id][]= $dataAll;
						$getdata[]= $dataAll;
					}
					
							
				}
				
			}
		}
		// pr($getdata);
		// exit;
		return $getdata;
	}
	
	public function MutasiSkpd ($satker,$tglawal,$tglakhir){
		// pr($satker);
		// exit;
		foreach ($satker as $key){
			$queryBerkurang ="select Aset_ID,SatkerAwal,SatkerTujuan from mutasiaset where  SatkerAwal = '$key'";		
			// pr($queryBerkurang);
			// exit;
			$resultBerkurang = $this->query($queryBerkurang) or die ($this->error('error'));	
			if($resultBerkurang !=''){
				while ($data = $this->fetch_object($resultBerkurang))
				{
					$dataBrkrngAset_ID[]= $data->Aset_ID;
					$dataBrkrngSatkerAwal[]= $data->SatkerAwal;
					$dataBrkrngSatkerTujuan[]= "kodeSatker = "."'".$data->SatkerTujuan."'";
				}
			}
		}	
		$dataBrkrngAset_ID = array_unique($dataBrkrngAset_ID);
		$dataBrkrngSatkerAwal = array_unique($dataBrkrngSatkerAwal);
		$dataBrkrngSatkerTujuan = array_unique($dataBrkrngSatkerTujuan);
		
		 if($dataBrkrngAset_ID != '' && $dataBrkrngSatkerTujuan != ''){
			if(count($dataBrkrngAset_ID) > 1 || count($dataBrkrngSatkerAwal) > 1){
				// echo "ga kessini ajaaa";
				$Aset_IDFix = implode(',',$dataBrkrngAset_ID);
				
				$newBrkrngSatkerTujuan =array();
					foreach ($dataBrkrngSatkerTujuan as $dt){
						$newBrkrngSatkerTujuan[] = $dt;
					}
				
					for ($q=0;$q<count($newBrkrngSatkerTujuan);$q++){
						$param_01[]="t.".$newBrkrngSatkerTujuan[$q];
						$param_02[]="m.".$newBrkrngSatkerTujuan[$q];
						$param_03[]="b.".$newBrkrngSatkerTujuan[$q];
						$param_04[]="j.".$newBrkrngSatkerTujuan[$q];
						$param_05[]="at.".$newBrkrngSatkerTujuan[$q];
						$param_06[]="kd.".$newBrkrngSatkerTujuan[$q];
					}
				/*pr($param_01);
				pr($param_02);
				pr($param_03);
				pr($param_04);
				pr($param_05);
				pr($param_06);*/
					$newparameter_sql_01 = implode(' OR ', $param_01);
					$newparameter_sql_02 = implode(' OR ', $param_02);
					$newparameter_sql_03 = implode(' OR ', $param_03);
					$newparameter_sql_04 = implode(' OR ', $param_04);
					$newparameter_sql_05 = implode(' OR ', $param_05);
					$newparameter_sql_06 = implode(' OR ', $param_06);
				
			}else{
				// echo "sini ajaaa";
				$Aset_IDFix = $dataBrkrngAset_ID[0];
				$SatkerAwalFix = $dataBrkrngSatkerTujuan[0];
			}
			
			// echo "newparameter_sql_01 ".$newparameter_sql_01; 
			// exit;
			$query_tanah = "SELECT t.*,k.Uraian,st.kode,st.NamaSatker FROM log_tanah as t, kelompok as k ,satker as st
							WHERE t.kodeKelompok = k.Kode and t.Aset_ID in ($Aset_IDFix) 
							and t.kodeSatker = st.kode and ($newparameter_sql_01) 
							and t.TglPerubahan >= '$tglawal' AND t.TglPerubahan <= '$tglakhir'";	
			
			$query_mesin = "SELECT m.* ,k.Uraian,st.kode,st.NamaSatker FROM log_mesin as m , kelompok as k ,satker as st
							WHERE m.kodeKelompok = k.Kode and m.Aset_ID in ($Aset_IDFix) 
							and m.kodeSatker = st.kode and ($newparameter_sql_02)  
							and m.TglPerubahan >= '$tglawal' AND m.TglPerubahan <= '$tglakhir'";			
			
			$query_bangunan = "SELECT b.*,k.Uraian,st.kode,st.NamaSatker FROM log_bangunan as b, kelompok as k ,satker as st
						    WHERE b.kodeKelompok = k.Kode and b.Aset_ID in ($Aset_IDFix) 
							and b.kodeSatker = st.kode and ($newparameter_sql_03) 
							and b.TglPerubahan >= '$tglawal' AND b.TglPerubahan <= '$tglakhir'";
			
			$query_jaringan = "SELECT j.*,k.Uraian,st.kode,st.NamaSatker FROM log_jaringan as j, kelompok as k ,satker as st
							WHERE j.kodeKelompok = k.Kode and j.Aset_ID in ($Aset_IDFix) 
							and j.kodeSatker = st.kode and ($newparameter_sql_04)  
							and j.TglPerubahan >= '$tglawal' AND j.TglPerubahan <= '$tglakhir'";	
			
			$query_asettetaplainnya = "SELECT at.*,k.Uraian,st.kode,st.NamaSatker FROM log_asetlain as at, kelompok as k ,satker as st
							WHERE at.kodeKelompok = k.Kode and at.Aset_ID in ($Aset_IDFix) 
							and at.kodeSatker = st.kode and ($newparameter_sql_05) 
							and at.TglPerubahan >= '$tglawal' AND at.TglPerubahan <= '$tglakhir'";		
			
			$query_kdp = "SELECT kd.*,k.Uraian,st.kode,st.NamaSatker FROM log_kdp as kd, kelompok as k ,satker as st
							WHERE kd.kodeKelompok = k.Kode and kd.Aset_ID in ($Aset_IDFix) 
							and kd.kodeSatker = st.kode and ($newparameter_sql_06) 
							and kd.TglPerubahan >= '$tglawal' AND kd.TglPerubahan <= '$tglakhir'";	
			
							
			$queryALL = array($query_tanah,$query_mesin,$query_bangunan,$query_jaringan,$query_asettetaplainnya,$query_kdp);
			// $queryALL = array($query_mesin);
			for ($i = 0; $i < count($queryALL); $i++)
			{
				/*echo "<br>";
				echo "query_$i =".$queryALL[$i];
				echo "<br>";
				echo "<br>";*/
				// exit;
				$result = $this->query($queryALL[$i]) or die ($this->error('error dataQuery'));
				
				if($result){
					// $i = 0;
					while ($dataAll = $this->fetch_object($result))
					{
						
						// $getdata[$dataBrkrngSatkerAwal[0]][]= $dataAll;
						$getdata[]= $dataAll;
					}
				}
			}
		}
		// pr($getdata);	
		// exit;	
		// }
		return $getdata;
	}

	public function kartuBarang($query){
		$exe = $this->query($query) or die ($this->error('error'));
		$ceck = mysql_num_rows($exe);
		if($ceck){
			while ($dataAll = $this->fetch_object($exe))
				{
					$getdata[$dataAll->Aset_ID][]= $dataAll;
				}
		}else{
			// $getdata[]= '';
		}
	
	return $getdata;
	
	}
	
}

?>

     
   
     
     

