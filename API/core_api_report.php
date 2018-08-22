
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
session_write_close();
class stdObject {
	public function __construct(array $arguments = array()) {
        if (!empty($arguments)) {
            foreach ($arguments as $property => $argument) {
                $this->{$property} = $argument;
            }
        }
    }

    public function __call($method, $arguments) {
        $arguments = array_merge(array("stdObject" => $this), $arguments); // Note: method argument 0 will always referred to the main class ($this).
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            return call_user_func_array($this->{$method}, $arguments);
        } else {
            throw new Exception("Fatal error: Call to undefined method stdObject::{$method}()");
        }
    }						
}
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
     var $rekap_barang;
     var $rekap_barang_sensus;
     var $label;
     var $gol;
     var $aset;
	 var $kb;
	 var $bukuInvGab;
	 var $pemilik;
	 var $noregAwal;
	 var $noregAkhir;
	 var $kodeRuangan;
	 
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
		  //pr($hasil_data);
		  //revisi TAHUN_AKTIF
		  $this->TAHUN_AKTIF=$hasil_data['TAHUN_AKTIF'];
		  $this->FlagAset=$hasil_data['FlagAset'];
		  $this->modul=$hasil_data['modul'];
		  $this->mode=$hasil_data['mode'];
		  $this->kib=$hasil_data['kib'];
		  $this->kb=$hasil_data['kb'];
		  $this->rekap=$hasil_data['rekap'];
		  $this->rekap_barang=$hasil_data['rekap_barang'];
		  $this->rekap_barang_sensus=$hasil_data['rekap_barang_sensus'];
		  $this->label=$hasil_data['label'];
		  $this->gol=$hasil_data['gol'];
		  $this->aset=$hasil_data['aset'];
		  
		  $this->kir=$hasil_data['kir'];
		  $this->bukuInv=$hasil_data['bukuInv'];
		  $this->bukuInvGab=$hasil_data['bukuInvGab'];
		  $this->bukuIndk=$hasil_data['bukuIndk'];
		  $this->intra=$hasil_data['intra'];
		  $this->ekstra=$hasil_data['ekstra'];
		  $this->pemilik=$hasil_data['pemilik'];
		  $this->noregAwal=$hasil_data['noregAwal'];
		  $this->noregAkhir=$hasil_data['noregAkhir'];
		  $this->kodeRuangan=$hasil_data['kodeRuangan'];
		  
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
		  
          $TAHUN_AKTIF=$this->TAHUN_AKTIF;
          $FlagAset=$this->FlagAset;
          $modul=$this->modul;
          $mode=$this->mode;
          $kib=$this->kib;
          $kb=$this->kb;
          $rekap=$this->rekap;
          $rekap_barang=$this->rekap_barang;
          $rekap_barang_sensus=$this->rekap_barang_sensus;
          $label=$this->label;
          $gol=$this->gol;
          $aset=$this->aset;
		  
          $kir=$this->kir;
          $bukuInv=$this->bukuInv;
          $bukuInvGab=$this->bukuInvGab;
          $bukuIndk=$this->bukuIndk;
          $intra=$this->intra;
          $ekstra=$this->ekstra;
          $pemilik=$this->pemilik;
          $noregAwal=$this->noregAwal;
          $noregAkhir=$this->noregAkhir;
          $kodeRuangan=$this->kodeRuangan;
          
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
				// $query_satker_fix = " T.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "T.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "T.kodeSatker like '$skpd_id%'";
						}
				$queryPemilik = "T.kodeLokasi like '$pemilik%'";
				$query_satker_fix = $paramSatker;
				
			}
			if($kib =='KIB-B')
			{
				$query_tgl_awal = " M.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " M.TglPerolehan <= '$tglakhirperolehan' ";
				// $query_satker_fix = " M.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "M.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "M.kodeSatker like '$skpd_id%'";
						}
				$queryPemilik = "M.kodeLokasi like '$pemilik%'";
				$query_satker_fix = $paramSatker;
			}
			if($kib =='KIB-C')
			{
				$query_tgl_awal = " B.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " B.TglPerolehan <= '$tglakhirperolehan' ";
				// $query_satker_fix = " B.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "B.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "B.kodeSatker like '$skpd_id%'";
						}
				$queryPemilik = "B.kodeLokasi like '$pemilik%'";
				$query_satker_fix = $paramSatker;
			}
			if($kib =='KIB-D')
			{
				$query_tgl_awal = " J.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " J.TglPerolehan <= '$tglakhirperolehan' ";
				// $query_satker_fix = " J.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "J.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "J.kodeSatker like '$skpd_id%'";
						}
					$queryPemilik = "J.kodeLokasi like '$pemilik%'";
					$query_satker_fix = $paramSatker;
			}
			if($kib =='KIB-E')
			{
				$query_tgl_awal = " AL.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " AL.TglPerolehan <= '$tglakhirperolehan' ";
				// $query_satker_fix = " AL.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "AL.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "AL.kodeSatker like '$skpd_id%'";
						}
					$queryPemilik = "AL.kodeLokasi like '$pemilik%'";
					$query_satker_fix = $paramSatker;
			}
			if($kib =='KIB-F')
			{
				$query_tgl_awal = " KDPA.TglPerolehan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " KDPA.TglPerolehan <= '$tglakhirperolehan' ";
				// $query_satker_fix = " KDPA.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "KDPA.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "KDPA.kodeSatker like '$skpd_id%'";
						}
					$queryPemilik = "KDPA.kodeLokasi like '$pemilik%'";
					$query_satker_fix = $paramSatker;
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
				// echo "param =".$param;
				// exit;
				// pr($tahun);
				// exit;
				// if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok == ""){
				if($tahun !='' && $skpd_id =="" && $kelompok == ""){
					// echo "sini";
					// $query_tgl_awal = " $param.TglPerolehan = '$tglawalperolehan' ";
					$query_tahun = " $param.Tahun = '$tahun' ";
					// $query_tgl_akhir = " $param.TglPerolehan <= '$tglakhirperolehan' ";
					$query_no_reg = "$param.noRegister BETWEEN '$noregAwal' AND '$noregAkhir' ";
			
				}	
				// if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id !="" && $kelompok != ""){
				if($tahun !='' && $skpd_id !="" && $kelompok != ""){
					// $query_tgl_awal = " $param.TglPerolehan = '$tglawalperolehan' ";
					// $query_tgl_akhir = " $param.TglPerolehan <= '$tglakhirperolehan' ";
					// $query_satker_fix = " $param.kodeSatker LIKE '$skpd_id%'";
					$query_tahun = " $param.Tahun = '$tahun' ";
					
					$splitKodeSatker = explode ('.',$skpd_id);
					if(count($splitKodeSatker) == 4){	
						$paramSatker = " $param.kodeSatker = '$skpd_id'";
					}else{
						$paramSatker = " $param.kodeSatker like '$skpd_id%'";
					}
	
					$query_satker_fix = $paramSatker;
					$query_kelompok_fix =" $param.kodeKelompok like '".$kelompok."%'";
					
					$query_no_reg = "$param.noRegister BETWEEN '$noregAwal' AND '$noregAkhir' ";
			
				}
				// if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok != ""){
				if($tahun !='' && $skpd_id =="" && $kelompok != ""){
					// $query_tgl_awal = " $param.TglPerolehan = '$tglawalperolehan' ";
					// $query_tgl_akhir = " $param.TglPerolehan <= '$tglakhirperolehan' ";
					$query_tahun = " $param.Tahun = '$tahun' ";
					
					$query_kelompok_fix =" $param.kodeKelompok like '".$kelompok."%'";
					$query_no_reg = "$param.noRegister BETWEEN '$noregAwal' AND '$noregAkhir' ";
			
				}
				// if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id !="" && $kelompok == ""){
				if($tahun !='' && $skpd_id !="" && $kelompok == ""){
					// $query_tgl_awal = " $param.TglPerolehan = '$tglawalperolehan' ";
					// $query_tgl_akhir = " $param.TglPerolehan <= '$tglakhirperolehan' ";
					// $query_satker_fix = " $param.kodeSatker LIKE '$skpd_id%'";
					$query_tahun = " $param.Tahun = '$tahun' ";
					$splitKodeSatker = explode ('.',$skpd_id);
					if(count($splitKodeSatker) == 4){	
						$paramSatker = " $param.kodeSatker = '$skpd_id'";
					}else{
						$paramSatker = " $param.kodeSatker like '$skpd_id%'";
					}
	
					$query_satker_fix = $paramSatker;
					$query_no_reg = "$param.noRegister BETWEEN '$noregAwal' AND '$noregAkhir' ";
			
				}
			}
			
		//this for rekap kib a -kib f
			if($rekap =='RekapKIB-A')
			{
				// $query_satker_fix = " T.kodeSatker LIKE '$skpd_id%'";
				
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "T.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "T.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "T.Tahun <= '$tahun'";
					$queryPemilik = "T.kodeLokasi like '$pemilik%'";
			}
			if($rekap =='RekapKIB-B')
			{
				// $query_satker_fix = " M.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "M.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "M.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "M.Tahun <= '$tahun'";
					$queryPemilik = "M.kodeLokasi like '$pemilik%'";
			}
			if($rekap =='RekapKIB-C')
			{
				// $query_satker_fix = " B.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "B.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "B.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "B.Tahun <= '$tahun'";
					$queryPemilik = "B.kodeLokasi like '$pemilik%'";
			}
			if($rekap =='RekapKIB-D')
			{
				// $query_satker_fix = " J.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "J.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "J.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "J.Tahun <= '$tahun'";
					$queryPemilik = "J.kodeLokasi like '$pemilik%'";
			}
			if($rekap =='RekapKIB-E')
			{
				// $query_satker_fix = " AL.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "AL.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "AL.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "AL.Tahun <= '$tahun'";
					$queryPemilik = "AL.kodeLokasi like '$pemilik%'";
			}
			if($rekap =='RekapKIB-F')
			{
				// $query_satker_fix = " KDPA.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "KDPA.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "KDPA.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "KDPA.Tahun <= '$tahun'";
					$queryPemilik = "KDPA.kodeLokasi like '$pemilik%'";
			}
		
		//rekap sensus
			if($rekap_barang_sensus =='RekapBarangSensusKIB-A')
			{
				// $query_satker_fix = " T.kodeSatker LIKE '$skpd_id%'";
				
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "T.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "T.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "T.Tahun <= '$tahun'";
					$queryPemilik = "T.kodeLokasi like '$pemilik%'";
			}
			if($rekap_barang_sensus =='RekapBarangSensusKIB-B')
			{
				// $query_satker_fix = " M.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "M.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "M.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "M.Tahun <= '$tahun'";
					$queryPemilik = "M.kodeLokasi like '$pemilik%'";
			}
			if($rekap_barang_sensus =='RekapBarangSensusKIB-C')
			{
				// $query_satker_fix = " B.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "B.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "B.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "B.Tahun <= '$tahun'";
					$queryPemilik = "B.kodeLokasi like '$pemilik%'";
			}
			if($rekap_barang_sensus =='RekapBarangSensusKIB-D')
			{
				// $query_satker_fix = " J.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "J.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "J.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "J.Tahun <= '$tahun'";
					$queryPemilik = "J.kodeLokasi like '$pemilik%'";
			}
			if($rekap_barang_sensus =='RekapBarangSensusKIB-E')
			{
				// $query_satker_fix = " AL.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "AL.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "AL.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "AL.Tahun <= '$tahun'";
					$queryPemilik = "AL.kodeLokasi like '$pemilik%'";
			}
			if($rekap_barang_sensus =='RekapBarangSensusKIB-F')
			{
				// $query_satker_fix = " KDPA.kodeSatker LIKE '$skpd_id%'";
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "KDPA.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "KDPA.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					$query_tahun = "KDPA.Tahun <= '$tahun'";
					$queryPemilik = "KDPA.kodeLokasi like '$pemilik%'";
			}
		
		
		//rekap barang
		//this for rekap kib a -kib f
			if($rekap_barang =='RekapBarangKIB-A')
			{	
				// $query_satker_fix = " T.kodeSatker LIKE '$skpd_id%'";
				if($skpd_id != ''){
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "T.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "T.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
				}	
					$query_tahun = "T.Tahun <= '$tahun'";
					$queryPemilik = "T.kodeLokasi like '$pemilik%'";					
			}
			if($rekap_barang =='RekapBarangKIB-B')
			{
				
				if($TAHUN_AKTIF == $tahun){
					$paramTable = "mesin";
				}else{
					$paramTable = "mesin_ori";
				}
				// $query_satker_fix = " M.kodeSatker LIKE '$skpd_id%'";
				if($skpd_id != ''){
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "M.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "M.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
				}	
					$query_tahun = "M.Tahun <= '$tahun'";
					$queryPemilik = "M.kodeLokasi like '$pemilik%'";					
			}
			if($rekap_barang =='RekapBarangKIB-C')
			{
				// $query_satker_fix = " B.kodeSatker LIKE '$skpd_id%'";
				if($skpd_id != ''){
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "B.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "B.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
				}	
					$query_tahun = "B.Tahun <= '$tahun'";
					$queryPemilik = "B.kodeLokasi like '$pemilik%'";		
			}
			if($rekap_barang =='RekapBarangKIB-D')
			{
				// $query_satker_fix = " J.kodeSatker LIKE '$skpd_id%'";
				if($skpd_id != ''){
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "J.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "J.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
				}	
					$query_tahun = "J.Tahun <= '$tahun'";
					$queryPemilik = "J.kodeLokasi like '$pemilik%'";		
			}
			if($rekap_barang =='RekapBarangKIB-E')
			{
				if($TAHUN_AKTIF == $tahun){
					$paramTable = "asetlain";
				}else{
					$paramTable = "asetlain_ori";
				}	
				// $query_satker_fix = " AL.kodeSatker LIKE '$skpd_id%'";
				if($skpd_id != ''){
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "AL.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "AL.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
				}	
					$query_tahun = "AL.Tahun <= '$tahun'";	
					$queryPemilik = "AL.kodeLokasi like '$pemilik%'";
			}
			if($rekap_barang =='RekapBarangKIB-F')
			{
				// $query_satker_fix = " KDPA.kodeSatker LIKE '$skpd_id%'";
				if($skpd_id != ''){
				$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "KDPA.kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "KDPA.kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
				}	
					$query_tahun = "KDPA.Tahun <= '$tahun'";
					$queryPemilik = "KDPA.kodeLokasi like '$pemilik%'";					
			}	
			
			
			
			
		// this for kir
			if($kir =='kir'){
				// echo "masuk kir";
				$query_tgl_awal = " TglPembukuan >= '$tglawalperolehan' ";
				$query_tgl_akhir = " TglPembukuan <= '$tglakhirperolehan' ";
				$query_kodeRuangan ="kodeRuangan ='$kodeRuangan'";
				// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
				$queryPemilik = "kodeLokasi like '$pemilik%'";
				$splitKodeSatker = explode ('.',$skpd_id);
					if(count($splitKodeSatker) == 4){	
						$paramSatker = "kodeSatker = '$skpd_id'";
					}else{
						$paramSatker = "kodeSatker like '$skpd_id%'";
					}
	
				$query_satker_fix = $paramSatker;
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
					
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					
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
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
				}
			}	
			
			//this is for buku inventaris gabungan
			if($bukuInvGab =='bukuInvGab'){
				// echo "masuk sini aja dulu";
				// exit;
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok == ""){
					// echo "sini";
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					$queryPemilik = "kodeLokasi like '$pemilik%'";
				}	
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id!="" && $kelompok != ""){
					
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					
					$query_kelompok_fix =" kodeKelompok like '".$kelompok."%'";
					$queryPemilik = "kodeLokasi like '$pemilik%'";
				}
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id =="" && $kelompok != ""){
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					$query_kelompok_fix =" kodeKelompok like '".$kelompok."%'";
					$queryPemilik = "kodeLokasi like '$pemilik%'";
				}
				
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id !="" && $kelompok == ""){
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
	
					$query_satker_fix = $paramSatker;
					
					$queryPemilik = "kodeLokasi like '$pemilik%'";
					
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
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
					$query_satker_fix = $paramSatker;
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
				}	
			}
			
			if($ekstra == 'ekstra'){
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id == ""){
					
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
				}elseif($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id != ""){
					
					$query_tgl_awal = " TglPerolehan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPerolehan <= '$tglakhirperolehan' ";
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
						
					$query_satker_fix = $paramSatker;
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
				}	
			}
			//$query_tahun = " $param.Tahun = '$tahun' ";
			if($label == 'label'){
				// if($tahun !='' && $skpd_id == ""){
				if($tglawalperolehan !='' && $tglakhirperolehan !='' && $skpd_id == "" && $kodeRuangan == ""){
					
					// $query_tahun=" Tahun = '$tahun' ";
					
					$query_tgl_awal = " TglPembukuan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPembukuan <= '$tglakhirperolehan' ";
					
				// }elseif($tahun !='' && $skpd_id != ""){
				
				}elseif($tglawalperolehan !='' && $tglakhirperolehan !=''&& $skpd_id != "" && $kodeRuangan != "" && $tahun !=''){
				
					$query_tahun=" Tahun = '$tahun' ";
					
					$query_tgl_awal = " TglPembukuan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPembukuan <= '$tglakhirperolehan' ";
					$query_kodeRuangan ="kodeRuangan ='$kodeRuangan'";
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
						
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					
					$query_satker_fix = $paramSatker;
				}elseif($tglawalperolehan !='' && $tglakhirperolehan !=''&& $skpd_id != "" && $kodeRuangan == "" && $tahun ==''){
				
					//$query_tahun=" Tahun = '$tahun' ";
					
					$query_tgl_awal = " TglPembukuan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPembukuan <= '$tglakhirperolehan' ";
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
						
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					
					$query_satker_fix = $paramSatker;
				}elseif($tglawalperolehan !='' && $tglakhirperolehan !=''&& $skpd_id != "" && $kodeRuangan == "" && $tahun !=''){
				
					$query_tahun=" Tahun = '$tahun' ";
					
					$query_tgl_awal = " TglPembukuan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPembukuan <= '$tglakhirperolehan' ";
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
						
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					
					$query_satker_fix = $paramSatker;
				}elseif($tglawalperolehan !='' && $tglakhirperolehan !=''&& $skpd_id != "" && $kodeRuangan != "" && $tahun ==''){
				
					//$query_tahun=" Tahun = '$tahun' ";
					
					$query_tgl_awal = " TglPembukuan >= '$tglawalperolehan' ";
					$query_tgl_akhir = " TglPembukuan <= '$tglakhirperolehan' ";
					$query_kodeRuangan ="kodeRuangan ='$kodeRuangan'";
					
					$splitKodeSatker = explode ('.',$skpd_id);
						if(count($splitKodeSatker) == 4){	
							$paramSatker = "kodeSatker = '$skpd_id'";
						}else{
							$paramSatker = "kodeSatker like '$skpd_id%'";
						}
						
					// $query_satker_fix = " kodeSatker LIKE '$skpd_id%'";
					
					$query_satker_fix = $paramSatker;
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
			
			if($kb != ''){
				if($noregAkhir!="" && $noregAwal !=""){
					$parameter_sql=$query_no_reg;
				}
			}else{
				if($noregAkhir!="" && $noregAwal !=""){
					$parameter_sql=$parameter_sql." AND ".$query_no_reg;
				}
			}
			if($skpd_id!="" && $parameter_sql!=""){
				$parameter_sql=$parameter_sql." AND ".$query_satker_fix;
            }
			if($skpd_id!="" && $parameter_sql==""){
				$parameter_sql=$query_satker_fix;
            }
            if($pemilik!="" && $parameter_sql!=""){
				$parameter_sql=$parameter_sql." AND ".$queryPemilik;
            }
			if($pemilik!="" && $parameter_sql==""){
				$parameter_sql=$queryPemilik;
            }
			
            if($kelompok!="" && $parameter_sql!=""){
				$parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
            }
            if ($kelompok!="" && $parameter_sql==""){
				$parameter_sql=$query_kelompok_fix;
            } 
			
			if($tahun!="" && $parameter_sql!=""){
				$parameter_sql=$parameter_sql." AND ".$query_tahun;
            }
            if($tahun != "" && $parameter_sql==""){
				$parameter_sql=$query_tahun;
            }
			//add
			if($kodeRuangan!="" && $parameter_sql!=""){
				$parameter_sql=$parameter_sql." AND ".$query_kodeRuangan;
            }
            if($kodeRuangan != "" && $parameter_sql==""){
				$parameter_sql=$query_kodeRuangan;
            }
			
			
            // $limit="limit 50";
			/*echo "TAHUN_AKTIF = ".$TAHUN_AKTIF;
			echo "<br/>";*/
			//echo "param =".$parameter_sql;
			
			// exit;
			$rekap_barang_a_condition = "select 
												T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
													K.Kode, K.Uraian
												from 
													tanahView as T,kelompok as K
												where
													T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
													and $parameter_sql
												order by 
													T.kodeSatker,T.kodeKelompok $limit";
			
			$rekap_barang_b_condition ="select SUM(M.NilaiPerolehan) as Nilai, 
													GROUP_CONCAT(M.noRegister) as noReg,
													M.kodeSatker,M.kodeKelompok,M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
												from 
													mesin_ori as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode  
													 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and $parameter_sql
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
												order by 
													M.kodeSatker,M.kodeKelompok $limit";

			$rekap_barang_b_condition_rev ="select SUM(M.NilaiPerolehan) as Nilai, 
													GROUP_CONCAT(M.noRegister) as noReg,
													M.kodeSatker,M.kodeKelompok,M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
												from 
													$paramTable as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode  
													 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and $parameter_sql
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
												order by 
													M.kodeSatker,M.kodeKelompok $limit";																			
													
			$rekap_barang_b_condition_sensus ="select M.kodeSatker,M.noRegister,
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi,M.kodeRuangan, 
													K.Kode, K.Uraian
												from 
													mesin_ori as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode  
													 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and $parameter_sql
												order by 
													M.kodeSatker,M.kodeKelompok $limit";										
			
			$rekap_barang_c_condition="select B.Aset_ID, B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
											B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.noRegister,B.Alamat,
											B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
											B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
											K.Kode, K.Uraian
											from 
											bangunan_ori as B,kelompok as K  
											where
											B.kodeKelompok = K.Kode 
											 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
											and $parameter_sql
											order by B.kodeSatker,B.kodeKelompok $limit";
			
			$rekap_barang_d_condition="select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi, J.kodeLokasi,
											K.Kode, K.Uraian
											from 
											jaringan_ori as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode 
											 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
											and $parameter_sql
											order by J.kodeSatker,J.kodeKelompok $limit";
			
				
			
			$rekap_barang_e_condition="select SUM(AL.NilaiPerolehan) as Nilai, 
											GROUP_CONCAT(AL.noRegister) as noReg,
											AL.kodeSatker,											
											AL.kodeKelompok,AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											from 
											asetlain_ori as AL,kelompok as K  
											where
											AL.kodeKelompok = K.Kode 
											 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
											and $parameter_sql
											group by AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											order by AL.kodeSatker,AL.kodeKelompok $limit";

			$rekap_barang_e_condition_rev ="select SUM(AL.NilaiPerolehan) as Nilai, 
											GROUP_CONCAT(AL.noRegister) as noReg,
											AL.kodeSatker,											
											AL.kodeKelompok,AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											from 
											$paramTable as AL,kelompok as K  
											where
											AL.kodeKelompok = K.Kode 
											 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
											and $parameter_sql
											group by AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											order by AL.kodeSatker,AL.kodeKelompok $limit";								
											
			$rekap_barang_e_condition_sensus="select AL.kodeSatker, AL.noRegister,
											AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,AL.kodeRuangan,
											K.Kode, K.Uraian
											from 
											asetlain_ori as AL,kelompok as K  
											where
											AL.kodeKelompok = K.Kode 
											 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
											and $parameter_sql
											order by AL.kodeSatker,AL.kodeKelompok $limit";								
			
			$rekap_barang_f_condition="select KDPA.Aset_ID, KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
											KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.noRegister,KDPA.Alamat,
											KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
											KDPA.kondisi, KDPA.kodeLokasi,
											K.Kode, K.Uraian
											from 
											kdp_ori as KDPA,kelompok as K  
											where
											KDPA.kodeKelompok = K.Kode  
											 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
											and $parameter_sql
											order by KDPA.kodeSatker,KDPA.kodeKelompok $limit";
			
			//start update query kib a (ok)
			$kb_a_condition = "select 
													T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
													K.Kode, K.Uraian
												from 
													tanahView as T,kelompok as K
												where
													T.kodeKelompok=K.Kode  
													and $parameter_sql and T.Status_Validasi_Barang=1 and T.StatusTampil=1 
												group by T.Aset_ID
												order by 
													T.Aset_ID,T.kodeKelompok,T.kodeSatker ";
			
			$kb_a_default   = "";	
			
			$kb_b_condition = "select 
													M.Aset_ID,M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.kodeRuangan,M.kondisi,
													M.Silinder,M.kodeLokasi,M.noRegister,K.Kode, K.Uraian
												from 
													mesin_ori as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode  and M.Status_Validasi_Barang=1 and M.StatusTampil=1 
													and $parameter_sql
												order by 
													M.Aset_ID,M.kodeKelompok,M.kodeSatker $limit";
										
			$kb_b_default = "";								
          
			$kb_c_condition = "select B.Aset_ID, B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
											B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.noRegister,B.Alamat,
											B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
											B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
											K.Kode, K.Uraian
											from 
											bangunan_ori as B,kelompok as K  
											where
											B.kodeKelompok = K.Kode 
											 
											and $parameter_sql and B.Status_Validasi_Barang=1 and B.StatusTampil=1 
											order by
												B.Aset_ID,B.kodeKelompok,B.kodeSatker $limit";
			//ok
			$kb_c_default = "";
			$kb_d_condition = "select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi, J.kodeLokasi,
											K.Kode, K.Uraian
											from 
											jaringan_ori as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode 
											 
											and $parameter_sql and J.Status_Validasi_Barang=1 and J.StatusTampil=1 
											order by 
												J.Aset_ID,J.kodeKelompok,J.kodeSatker $limit";
          
		  $kb_d_default = "";
			$kb_e_condition = "select AL.Aset_ID,AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,AL.noRegister,
											K.Kode, K.Uraian
											from 
											asetlain_ori as AL,kelompok as K  
											where
											AL.kodeKelompok = K.Kode 
											 
											and $parameter_sql and AL.Status_Validasi_Barang=1 and AL.StatusTampil=1 
											order by 
												AL.Aset_ID,AL.kodeKelompok,AL.kodeSatker $limit";
											
			$kb_e_default = "";
	     	$kb_f_condition = "select KDPA.Aset_ID, KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
											KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.noRegister,KDPA.Alamat,
											KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
											KDPA.kondisi, KDPA.kodeLokasi,
											K.Kode, K.Uraian
											from 
											kdp_ori as KDPA,kelompok as K  
											where
											KDPA.kodeKelompok = K.Kode  
											 
											and $parameter_sql and KDPA.Status_Validasi_Barang=1 and KDPA.StatusTampil=1 
											order by 
												KDPA.Aset_ID,KDPA.kodeKelompok,KDPA.kodeSatker $limit";
          
		  $kb_f_default = "";
			
			//==============================================================
			//start update query kib a (ok)
			$Modul_1_Mode_1_Case_a_condition = "select 
													T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
													K.Kode, K.Uraian
												from 
													tanahView as T,kelompok as K
												where
													T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
													and $parameter_sql
												order by 
													T.kodeSatker,T.Tahun,T.kodeKelompok $limit";
			
			$Modul_1_Mode_1_Case_a_default   = "select 
													T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
													K.Kode, K.Uraian
												from 
													tanahView as T,kelompok as K
												where
													T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
												order by 
													T.kodeSatker,T.Tahun,T.kodeKelompok $limit";	
			//end update query kib a								
           
		   //start update query kib b (ok)
			$Modul_1_Mode_1_Case_b_condition = "select SUM(M.NilaiPerolehan) as Nilai, 
													GROUP_CONCAT(M.noRegister) as noReg,
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
												from 
													mesin_ori as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode  
													 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and $parameter_sql
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
												order by 
													M.kodeSatker,M.Tahun,M.kodeKelompok $limit";
										
			$Modul_1_Mode_1_Case_b_default = "select SUM(M.NilaiPerolehan) as Nilai, 
													GROUP_CONCAT(M.noRegister) as noReg,
													M.kodeSatker,
													M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
													M.Silinder,M.kodeLokasi, K.Kode, K.Uraian 
												from 
													mesin_ori as M,kelompok as K 
												where 
													M.kodeKelompok=K.Kode  
													 and M.Status_Validasi_Barang =1 and M.StatusTampil =1  
												group by 
													M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
													M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
													M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
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
											bangunan_ori as B,kelompok as K  
											where
											B.kodeKelompok = K.Kode 
											 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
											and $parameter_sql
											order by B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
          //ok
          $Modul_1_Mode_1_Case_c_default = "select B.Aset_ID, B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
											B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.noRegister,B.Alamat,
											B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
											B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan, B.kodeLokasi,
											K.Kode, K.Uraian
											from 
											bangunan_ori as B,kelompok as K  
											where
											B.kodeKelompok = K.Kode 
											 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
											order by  B.kodeSatker,B.Tahun,B.kodeKelompok $limit";
          //end update query kib c (ok)
		  
		 //start update query kib d (ok)
          $Modul_1_Mode_1_Case_d_condition = "select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi, J.kodeLokasi,
											K.Kode, K.Uraian
											from 
											jaringan_ori as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode 
											 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
											and $parameter_sql
											order by J.kodeSatker,J.Tahun,J.kodeKelompok $limit";
          
		  $Modul_1_Mode_1_Case_d_default = "select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi,J.kodeLokasi, 
											K.Kode, K.Uraian
											from 
											jaringan_ori as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode 
											 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
											order by J.kodeSatker,J.Tahun,J.kodeKelompok  $limit";
		 //end update query kib d (ok)


		 //start update query kib e (ok)
          
			$Modul_1_Mode_1_Case_e_condition = "select SUM(AL.NilaiPerolehan) as Nilai, 
													GROUP_CONCAT(AL.noRegister) as noReg,
													AL.kodeSatker, 
											AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											from 
											asetlain_ori as AL,kelompok as K  
											where
											AL.kodeKelompok = K.Kode 
											 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
											and $parameter_sql
											group by AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
											AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
											AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
											AL.kondisi, AL.kodeLokasi,
											K.Kode, K.Uraian
											order by AL.kodeSatker,AL.Tahun,AL.kodeKelompok $limit";
											
			  $Modul_1_Mode_1_Case_e_default = "select SUM(AL.NilaiPerolehan) as Nilai, 
													GROUP_CONCAT(AL.noRegister) as noReg,
													AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
												AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
												AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
												AL.kondisi, AL.kodeLokasi,
												K.Kode, K.Uraian
												from 
												asetlain_ori as AL,kelompok as K  
												where
												AL.kodeKelompok = K.Kode  and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
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
											kdp_ori as KDPA,kelompok as K  
											where
											KDPA.kodeKelompok = K.Kode  
											 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
											and $parameter_sql
											order by KDPA.kodeSatker,KDPA.Tahun,KDPA.kodeKelompok $limit";
          
		  $Modul_1_Mode_1_Case_f_default = "select KDPA.Aset_ID, KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
											KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.noRegister,KDPA.Alamat,
											KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
											KDPA.kondisi, KDPA.kodeLokasi,
											K.Kode, K.Uraian
											from 
											kdp_ori as KDPA,kelompok as K  
											where
											KDPA.kodeKelompok = K.Kode  
											 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
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
											/*$query_02 = "select SUM(M.NilaiPerolehan) as Nilai,GROUP_CONCAT(M.noRegister) as noReg,M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
															M.Tahun, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
															M.Silinder,M.kodeRuangan,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian
														from 
															mesin_ori as M,kelompok as K 
														where 
															M.kodeKelompok=K.Kode  
															 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and 
															(M.KodeRuangan is not null AND M.KodeRuangan !=0) 
															and $newparameter_sql_02
														group by 
															M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
															M.Tahun,M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
															M.kodeLokasi, M.kodeRuangan,M.kondisi,K.Kode, K.Uraian 
														order by 
															M.kodeSatker,M.kodeRuangan,M.Tahun,M.kodeKelompok $limit";
											
											$query_05 = "select SUM(AL.NilaiPerolehan) as Nilai,GROUP_CONCAT(AL.noRegister) as noReg,AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
														AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,
														AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
														AL.kondisi, AL.kodeRuangan,AL.kodeLokasi,
														K.Kode, K.Uraian
													from 
														asetlain_ori as AL,kelompok as K  
													where
														AL.kodeKelompok = K.Kode 
														 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 and 
														(AL.KodeRuangan is not null AND AL.KodeRuangan !=0) 
														and $newparameter_sql_05
													group by 
														AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
														AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,
														AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
														AL.kondisi, AL.kodeRuangan,AL.kodeLokasi,AL.kondisi,
														K.Kode, K.Uraian
													order by AL.kodeSatker,AL.kodeRuangan,AL.Tahun,AL.kodeKelompok $limit";*/
											$query_02 = "select SUM(M.NilaiPerolehan) as Nilai,GROUP_CONCAT(M.noRegister) as noReg,M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
															M.Tahun, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
															M.Silinder,M.kodeRuangan,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian
														from 
															mesin_ori as M,kelompok as K 
														where 
															M.kodeKelompok=K.Kode  
															 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
															and $newparameter_sql_02
														group by 
															M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
															M.Tahun,M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
															M.kodeLokasi, M.kodeRuangan,M.kondisi,K.Kode, K.Uraian 
														order by 
															M.kodeSatker,M.kodeRuangan,M.Tahun,M.kodeKelompok $limit";
											
											$query_05 = "select SUM(AL.NilaiPerolehan) as Nilai,GROUP_CONCAT(AL.noRegister) as noReg,AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
														AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,
														AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
														AL.kondisi, AL.kodeRuangan,AL.kodeLokasi,
														K.Kode, K.Uraian
													from 
														asetlain_ori as AL,kelompok as K  
													where
														AL.kodeKelompok = K.Kode 
														and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
														and $newparameter_sql_05
													group by 
														AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
														AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,
														AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
														AL.kondisi, AL.kodeRuangan,AL.kodeLokasi,AL.kondisi,
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
																		$query = "select distinct(T.kodeSatker),T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					from 
																						tanahView as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.kodeLokasi,T.Tahun,T.kodeKelompok $limit";
																	}
																	elseif($kel_prs[1] == '02'){
																		// echo "gol 2";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select distinct(M.kodeSatker),M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						mesin_ori as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode  
																						 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																						and $newparameter_sql
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
																					order by 
																						M.kodeSatker,M.kodeLokasi,M.Tahun,M.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '03'){
																		// echo "gol 3";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="B.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select distinct(B.kodeSatker),B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					bangunan_ori as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode 
																					 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.kodeLokasi,B.Tahun,B.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '04'){
																		// echo "gol 4";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="J.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select distinct(J.kodeSatker),J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					jaringan_ori as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode 
																					 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.kodeSatker,J.kodeLokasi,J.Tahun,J.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '05'){
																		// echo "gol 5";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="AL.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select distinct(AL.kodeSatker),AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					asetlain_ori as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode 
																					 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.kodeSatker, AL.kodeLokasi,AL.Tahun,AL.kodeKelompok $limit";	
																	}
																	elseif($kel_prs[1] == '06'){
																		// echo "gol 6";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="KDPA.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select distinct(KDPA.kodeSatker),KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					kdp_ori as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode  
																					 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $parameter_sql
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.kodeLokasi,KDPA.Tahun,KDPA.kodeKelompok $limit";	
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
																		$query_01 = "select distinct(T.kodeSatker),T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					from 
																						tanahView as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql_01
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.kodeLokasi,T.Tahun,T.kodeKelompok $limit";
																						
																		$query_02 = "select distinct(M.kodeSatker),M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						mesin_ori as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode  
																						 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																						and $newparameter_sql_02
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
																					order by 
																						M.kodeSatker,M.kodeLokasi,M.Tahun,M.kodeKelompok $limit";
																		
																		$query_03 = "select distinct(B.kodeSatker),B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					bangunan_ori as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode 
																					 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
																					and $newparameter_sql_03
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.kodeLokasi,B.Tahun,B.kodeKelompok $limit";

																		$query_04 = "select distinct(J.kodeSatker),J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					jaringan_ori as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode 
																					 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																					and $newparameter_sql_04
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.kodeSatker,J.kodeLokasi,J.Tahun,J.kodeKelompok $limit";
																		
																		$query_05 = "select distinct(AL.kodeSatker),AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					asetlain_ori as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode 
																					 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1  
																					and $newparameter_sql_05
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.kodeSatker,AL.kodeLokasi,AL.Tahun,AL.kodeKelompok $limit";
																	
																		$query_06 = "select distinct(KDPA.kodeSatker),KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					kdp_ori as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode  
																					 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $newparameter_sql_06
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.kodeLokasi,KDPA.Tahun,KDPA.kodeKelompok $limit";	
																				$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
																				// $dataQuery = array($query_05);
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
																	$temp_kel = str_replace("'", "", $kel);
																	$kel_prs = explode('.',$temp_kel[1]);
																    
																	if($kel_prs[0] == '01'){
																		// echo "gol 1";
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="T.".$pecah[$q];
																		}
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					from 
																						tanahView as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.kodeKelompok,T.Tahun $limit";
																	}
																	elseif($kel_prs[0] == '02'){
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
																						mesin_ori as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode  
																						 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																						and $newparameter_sql
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.kodeSatker,M.kodeKelompok,M.Tahun $limit";	
																	}
																	elseif($kel_prs[0] == '03'){
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
																					bangunan_ori as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode 
																					 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.kodeKelompok,B.Tahun $limit";	
																	}
																	elseif($kel_prs[0] == '04'){
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
																					jaringan_ori as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode 
																					 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.kodeSatker,J.kodeKelompok,J.Tahun $limit";	
																	}
																	elseif($kel_prs[0] == '05'){
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
																					asetlain_ori as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode 
																					 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
																					and $newparameter_sql
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.kodeSatker,AL.kodeKelompok,AL.Tahun $limit";	
																	}
																	elseif($kel_prs[0] == '06'){
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
																					kdp_ori as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode  
																					 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $parameter_sql
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.Tahun $limit";	
																	}
																	elseif($kel_prs[0] == '07'){
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
																						tanahView as T,kelompok as K
																					where
																						T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql_01
																					group by 
																						T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																						K.Kode, K.Uraian
																					order by 
																						T.kodeSatker,T.kodeKelompok,T.Tahun $limit";
																						
																		$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																						M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																					from 
																						mesin_ori as M,kelompok as K 
																					where 
																						M.kodeKelompok=K.Kode  
																						 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																						and $newparameter_sql_02
																					group by 
																						M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																						M.kodeLokasi, K.Kode, K.Uraian 
																					order by 
																						M.kodeSatker,M.kodeKelompok,M.Tahun $limit";
																		
																		$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					bangunan_ori as B,kelompok as K  
																				where
																					B.kodeKelompok = K.Kode 
																					 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
																					and $newparameter_sql_03
																				group by 
																					B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																					K.Kode, K.Uraian
																				order by B.kodeSatker,B.kodeKelompok,B.Tahun $limit";

																		$query_04 = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					jaringan_ori as J,kelompok as K  
																				where
																					J.kodeKelompok = K.Kode 
																					 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																					and $newparameter_sql_04
																				group by 
																					J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																					J.kondisi, J.kodeLokasi,
																					K.Kode, K.Uraian
																				order by J.kodeSatker,J.kodeKelompok,J.Tahun $limit";
																		
																		$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					asetlain_ori as AL,kelompok as K  
																				where
																					AL.kodeKelompok = K.Kode 
																					 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
																					and $newparameter_sql_05
																				group by 
																					AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																					AL.kondisi, AL.kodeLokasi,
																					K.Kode, K.Uraian
																				order by AL.kodeSatker,AL.kodeKelompok,AL.Tahun $limit";
																	
																		$query_06 = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian
																				from 
																					kdp_ori as KDPA,kelompok as K  
																				where
																					KDPA.kodeKelompok = K.Kode  
																					 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																					and $newparameter_sql_06
																				group by 
																					KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																					KDPA.kondisi, KDPA.kodeLokasi,
																					K.Kode, K.Uraian	
																				order by KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.Tahun $limit";	
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
                                                    // echo "cek posisi sini";
													// exit;
													//Buku Inventaris Gabungan SKPD
													
													if($parameter_sql!="" ){
														// pr($parameter_sql);
														$kel = explode('like ',$query_kelompok_fix);
														$temp_kel = str_replace("'", "", $kel[1]);
														$temp_kel = str_replace("%", "", $temp_kel);
														$kel_prs = explode('.',$temp_kel);
														$kel_prs =trim($kel_prs[0]);
														// exit;
														if($kel_prs == '01'){
															// echo "gol 1";
															$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																$param[]="T.".$pecah[$q];
															}
															$newparameter_sql = implode('AND ', $param);
															$query = "select SUM(T.NilaiPerolehan) as Nilai, GROUP_CONCAT(T.noRegister) as noReg,T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
																			K.Kode, K.Uraian
																		from 
																			tanahView as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																			and $newparameter_sql
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeSatker,T.kodeKelompok,T.Tahun $limit";
														}
														elseif($kel_prs == '02'){
															// echo "gol 2";
															// exit;
															$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																$param[]="M.".$pecah[$q];
															}
															$newparameter_sql = implode('AND ', $param);
															$query = "select SUM(M.NilaiPerolehan) as Nilai, GROUP_CONCAT(M.noRegister) as noReg,M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, M.kondisi,K.Kode, K.Uraian
																		from 
																			mesin_ori as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode  
																			 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																			and $newparameter_sql
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
																		order by 
																			M.kodeSatker,M.kodeKelompok,M.Tahun $limit";	
														}
														elseif($kel_prs == '03'){
															// echo "gol 3";
															$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																$param[]="B.".$pecah[$q];
															}
															$newparameter_sql = implode('AND ', $param);
															$query = "select SUM(B.NilaiPerolehan) as Nilai, GROUP_CONCAT(B.noRegister) as noReg,B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		bangunan_ori as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode 
																		 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
																		and $newparameter_sql
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.kodeKelompok,B.Tahun $limit";	
														}
														elseif($kel_prs == '04'){
															// echo "gol 4";
															$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																$param[]="J.".$pecah[$q];
															}
															$newparameter_sql = implode('AND ', $param);
															$query = "select SUM(J.NilaiPerolehan) as Nilai, GROUP_CONCAT(J.noRegister) as noReg,J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		jaringan_ori as J,kelompok as K  
																	where
																		J.kodeKelompok = K.Kode 
																		 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																		and $newparameter_sql
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	order by J.kodeSatker,J.kodeKelompok,J.Tahun $limit";	
														}
														elseif($kel_prs == '05'){
															// echo "gol 5";
															$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																$param[]="AL.".$pecah[$q];
															}
															$newparameter_sql = implode('AND ', $param);
															$query = "select SUM(AL.NilaiPerolehan) as Nilai, GROUP_CONCAT(AL.noRegister) as noReg,AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		asetlain_ori as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode 
																		 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
																		and $newparameter_sql
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	order by AL.kodeSatker, AL.kodeKelompok,AL.Tahun $limit";	
														}
														elseif($kel_prs == '06'){
															// echo "gol 6";
															$pecah = explode("AND ",$parameter_sql);
															for ($q=0;$q<count($pecah);$q++){
																$param[]="KDPA.".$pecah[$q];
															}
															$newparameter_sql = implode('AND ', $param);
															$query = "select SUM(KDPA.NilaiPerolehan) as Nilai, GROUP_CONCAT(KDPA.noRegister) as noReg,KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		kdp_ori as KDPA,kelompok as K  
																	where
																		KDPA.kodeKelompok = K.Kode  
																		 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																		and $parameter_sql
																	group by 
																		KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian	
																	order by KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.Tahun $limit";	
														}
														elseif($kel_prs == '07'){
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
															$query_01 = "select SUM(T.NilaiPerolehan) as Nilai, GROUP_CONCAT(T.noRegister) as noReg,T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		from 
																			tanahView as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																			and $newparameter_sql_01
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeSatker,T.kodeKelompok,T.Tahun $limit";
																			
															$query_02 = "select SUM(M.NilaiPerolehan) as Nilai, GROUP_CONCAT(M.noRegister) as noReg,M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			mesin_ori as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode  
																			 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 
																			and $newparameter_sql_02
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi, M.kondisi,K.Kode, K.Uraian 
																		order by 
																			M.kodeSatker,M.kodeKelompok,M.Tahun $limit";
															
															$query_03 = "select SUM(B.NilaiPerolehan) as Nilai, GROUP_CONCAT(B.noRegister) as noReg,B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		bangunan_ori as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode 
																		 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
																		and $newparameter_sql_03
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.kodeKelompok,B.Tahun $limit";

															$query_04 = "select SUM(J.NilaiPerolehan) as Nilai, GROUP_CONCAT(J.noRegister) as noReg,J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		jaringan_ori as J,kelompok as K  
																	where
																		J.kodeKelompok = K.Kode 
																		 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
																		and $newparameter_sql_04
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian
																	order by J.kodeSatker,J.kodeKelompok,J.Tahun $limit";
															
															$query_05 = "select SUM(AL.NilaiPerolehan) as Nilai, GROUP_CONCAT(AL.noRegister) as noReg,AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		asetlain_ori as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode 
																		 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
																		and $newparameter_sql_05
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	order by AL.kodeSatker, AL.kodeKelompok,AL.Tahun $limit";
														
															$query_06 = "select SUM(KDPA.NilaiPerolehan) as Nilai, GROUP_CONCAT(KDPA.noRegister) as noReg,KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		kdp_ori as KDPA,kelompok as K  
																	where
																		KDPA.kodeKelompok = K.Kode  
																		 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																		and $newparameter_sql_06
																	group by 
																		KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian	
																	order by KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.Tahun $limit";	
																	$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
																	// $dataQuery = array($query_01);
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
                                                  }
                                                  break;
												  case '7':
												  {
												  //intra
												  //pr($FlagAset);
												  //pr($parameter_sql);
												  //exit();
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
														
														/*add*/
														if($FlagAset == 1){
															$kondisiMesin = " AND M.kondisi != 3 AND M.kondisi != 4 ";
															$kondisiBangunan = " AND B.kondisi != 3 AND B.kondisi != 4 ";
															$kondisiJaringan = " AND J.kondisi != 3 AND J.kondisi != 4 ";
															$kondisiAsetLain = " AND AL.kondisi != 3 AND AL.kondisi != 4 ";
															$tglCmpr = $TAHUN_AKTIF."-"."12-31";
															$expld = explode('-', $tglakhirperolehan);
															if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
																$tahun = $TAHUN_AKTIF;
																$tableNeracaTanah 		= "neraca_tanah".$tahun;
																$tableNeracaMesin 		= "neraca_mesin".$tahun;
																$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
																$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
																$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
																$tableNeracaKdp 		= "neraca_kdp".$tahun;
															}else{
																$tableNeracaTanah 		= "tanahView";
																$tableNeracaMesin 		= 'mesin_ori';
																$tableNeracaBangunan 	= 'bangunan_ori';
																$tableNeracaJaringan 	= "jaringan_ori";
																$tableNeracaAsetLain	= "asetlain_ori";
																$tableNeracaKdp 		= "kdp_ori";
															}	
														}else{

															$kondisiTanah = " AND T.kondisi = 3 ";
															$kondisiMesin = " AND M.kondisi = 3 ";
															$kondisiBangunan = " AND B.kondisi = 3 ";
															$kondisiJaringan = " AND J.kondisi = 3 ";
															$kondisiAsetLain = " AND AL.kondisi = 3 ";
															$kondisiKDP = " AND KDPA.kondisi = 3 ";

															$tableNeracaTanah 		= "tanahView";
															$tableNeracaMesin 		= 'mesin_ori';
															$tableNeracaBangunan 	= 'bangunan_ori';
															$tableNeracaJaringan 	= "jaringan_ori";
															$tableNeracaAsetLain	= "asetlain_ori";
															$tableNeracaKdp 		= "kdp_ori"; 
														}
														
														/*end*/

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
															$query_01 = "select SUM(T.NilaiPerolehan) as Nilai, 
																			GROUP_CONCAT(T.noRegister) as noReg,T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		from 
																			tanahView as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1  AND T.kodeLokasi like '12%'
																			and $newparameter_sql_01
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeKelompok";
																			
															$query_02 = "select SUM(M.NilaiPerolehan) as Nilai,SUM(M.PenyusutanPerTahun) as Ppt,
																			SUM(M.AkumulasiPenyusutan) as Ap,SUM(M.NilaiBuku) as Nb,
																			GROUP_CONCAT(M.noRegister) as noReg, 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian,M.PenyusutanPerTahun,M.AkumulasiPenyusutan,M.NilaiBuku
																		from 
																			mesin_ori as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode  
																			 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 AND M.kodeLokasi like '12%'
																			and $newparameter_sql_02 $KodeKaCondt1_mesin
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,M.kondisi,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.kodeKelompok";
																			
															
															$query_03 = "select SUM(B.NilaiPerolehan) as Nilai,SUM(B.PenyusutanPerTahun) as Ppt,
																		SUM(B.AkumulasiPenyusutan) as Ap,SUM(B.NilaiBuku) as Nb,
																		GROUP_CONCAT(B.noRegister) as noReg, 
																		B.kodeSatker,
																		B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian,B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku
																	from 
																		bangunan_ori as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode 
																		 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 AND B.kodeLokasi like '12%'
																		and $newparameter_sql_03 $KodeKaCondt1_bangunan
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.kondisi,
																		K.Kode, K.Uraian
																	order by B.kodeKelompok";
	

															$query_04 = "select SUM(J.NilaiPerolehan) as Nilai,SUM(J.PenyusutanPerTahun) as Ppt,
																			SUM(J.AkumulasiPenyusutan) as Ap,SUM(J.NilaiBuku) as Nb,
																		GROUP_CONCAT(J.noRegister) as noReg,
																		J.kodeSatker,
																		J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian,J.PenyusutanPerTahun,J.AkumulasiPenyusutan,J.NilaiBuku
																	from 
																		jaringan_ori as J,kelompok as K  
																	where
																		J.kodeKelompok = K.Kode 
																		 and J.Status_Validasi_Barang =1 and J.StatusTampil =1 AND J.kodeLokasi like '12%'
																		and $newparameter_sql_04
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,J.kondisi,
																		K.Kode, K.Uraian
																	order by J.kodeKelompok";

															$query_05 = "select SUM(AL.NilaiPerolehan) as Nilai,
																		GROUP_CONCAT(AL.noRegister) as noReg,
																		AL.kodeSatker,
																		AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		asetlain_ori as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode 
																		 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 AND AL.kodeLokasi like '12%'
																		and $newparameter_sql_05
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,AL.kondisi,
																		K.Kode, K.Uraian
																	order by AL.kodeKelompok";
														
															$query_06 = "select SUM(KDPA.NilaiPerolehan) as Nilai,
																		GROUP_CONCAT(KDPA.noRegister) as noReg,
																		KDPA.kodeSatker,
															            KDPA.kodeKelompok,KDPA.KodeRuangan,
															            KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		kdp_ori as KDPA,kelompok as K  
																	where
																		KDPA.kodeKelompok = K.Kode  
																		 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1 AND KDPA.kodeLokasi like '12%'
																		and $newparameter_sql_06
																	group by 
																		KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,KDPA.kondisi,
																		K.Kode, K.Uraian	
																	order by KDPA.kodeKelompok";	
																	
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
																$extQuery_A_default = "AND T.TglPembukuan >='$tglAwalDefault' AND T.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_B_default = "M.TglPerolehan >= '$tglAwalDefault' AND M. TglPerolehan < '$tglIntraDefault' 
																					   AND M.TglPembukuan >='$tglAwalDefault' AND M.TglPembukuan <='$tglAkhirDefault' $satker_02";
																$extQuery_B_cndt = "M.TglPerolehan >= '$tglIntraDefault' AND M. TglPerolehan <= '$tglAkhirDefault' 
																					 AND M.TglPembukuan >='$tglAwalDefault' AND M.TglPembukuan <='$tglAkhirDefault' $satker_02";
																$extQuery_C_default = "B.TglPerolehan >= '$tglAwalDefault' AND B. TglPerolehan < '$tglIntraDefault' 
																                    AND B.TglPembukuan >='$tglAwalDefault' AND B.TglPembukuan <='$tglAkhirDefault' $satker_03";
																$extQuery_C_cndt = "B.TglPerolehan >= '$tglIntraDefault' AND B. TglPerolehan <= '$tglAkhirDefault' $satker_03
																                    AND B.TglPembukuan >='$tglAwalDefault' AND B.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_D_default = "AND J.TglPembukuan >='$tglAwalDefault' AND J.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_E_default = "AND AL.TglPembukuan >='$tglAwalDefault' AND AL.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_F_default = "AND KDPA.TglPembukuan >='$tglAwalDefault' AND KDPA.TglPembukuan <='$tglAkhirDefault'";
																
																// echo $extQuery_C; 
															}
															//2008-01-01 sampe 2009-12-01
															elseif($thnceck >= $thnIntraDefault || $thnceck < $thnFix){
																$extQuery_A_default = "AND T.TglPembukuan >='$tglAwalDefault' AND T.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_B_cndt = $newparameter_sql_02;
																$extQuery_C_cndt = $newparameter_sql_03;
																$extQuery_D_default = "AND J.TglPembukuan >='$tglAwalDefault' AND J.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_E_default = "AND AL.TglPembukuan >='$tglAwalDefault' AND AL.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_F_default = "AND KDPA.TglPembukuan >='$tglAwalDefault' AND KDPA.TglPembukuan <='$tglAkhirDefault'";
																
															}else{
																$extQuery_A_default = "AND T.TglPembukuan >='$tglAwalDefault' AND T.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_B_cndt = $newparameter_sql_02;
																$extQuery_C_cndt = $newparameter_sql_03;
																$extQuery_D_default = "AND J.TglPembukuan >='$tglAwalDefault' AND J.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_E_default = "AND AL.TglPembukuan >='$tglAwalDefault' AND AL.TglPembukuan <='$tglAkhirDefault'";
																$extQuery_F_default = "AND KDPA.TglPembukuan >='$tglAwalDefault' AND KDPA.TglPembukuan <='$tglAkhirDefault'";
																
															}
															
															
															$query_01 = "select SUM(T.NilaiPerolehan) as Nilai,
																			GROUP_CONCAT(T.noRegister) as noReg,
																			T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
																			K.Kode, K.Uraian
																		from 
																			$tableNeracaTanah as T,kelompok as K
																		where
																			T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 AND T.kodeLokasi like '12%'
																			and $newparameter_sql_01 $extQuery_A_default $kondisiTanah
																		group by 
																			T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
																			K.Kode, K.Uraian
																		order by 
																			T.kodeSatker,T.kodeKelompok";
															
															$query_02_default = "select SUM(M.NilaiPerolehan) as Nilai,
																			SUM(M.PenyusutanPerTahun) as Ppt,
																			SUM(M.AkumulasiPenyusutan) as Ap,SUM(M.NilaiBuku) as Nb,
																			GROUP_CONCAT(M.noRegister) as noReg,
																			M.kodeSatker,
																			M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.kondisi,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian,M.PenyusutanPerTahun,M.AkumulasiPenyusutan,M.NilaiBuku
																		from 
																			$tableNeracaMesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode  
																			 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 AND M.kodeLokasi like '12%'
																			AND $extQuery_B_default $KodeKaCondt1_mesin $kondisiMesin
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi,M.kondisi, K.Kode, K.Uraian 
																		order by 
																			M.kodeSatker,M.kodeKelompok";


															$query_02_condt = "select  SUM(M.NilaiPerolehan) as Nilai,
																			SUM(M.PenyusutanPerTahun) as Ppt,
																			SUM(M.AkumulasiPenyusutan) as Ap,SUM(M.NilaiBuku) as Nb,
																			GROUP_CONCAT(M.noRegister) as noReg,
																			M.kodeSatker,
																			M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.kondisi,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian,M.PenyusutanPerTahun,M.AkumulasiPenyusutan,M.NilaiBuku
																		from 
																			$tableNeracaMesin as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode  
																			 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and (M.NilaiPerolehan >= 300000 $KodeKa_mesin) AND M.kodeLokasi like '12%'
																			AND $extQuery_B_cndt $kondisiMesin
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
																			M.kodeLokasi,M.kondisi, K.Kode, K.Uraian 
																		order by 
																			M.kodeSatker,M.kodeKelompok";				
															
															$query_03_default = "select SUM(B.NilaiPerolehan) as Nilai,
																		SUM(B.PenyusutanPerTahun) as Ppt,
																		SUM(B.AkumulasiPenyusutan) as Ap,SUM(B.NilaiBuku) as Nb,
																		GROUP_CONCAT(B.noRegister) as noReg, 
																		B.kodeSatker,
																		B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian,B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku
																	from 
																		$tableNeracaBangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode 
																		 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 AND B.kodeLokasi like '12%'
																		AND $extQuery_C_default $KodeKaCondt1_bangunan $kondisiBangunan
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.kondisi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.kodeKelompok";
															
															$query_03_condt = "select SUM(B.NilaiPerolehan) as Nilai,
																		SUM(B.PenyusutanPerTahun) as Ppt,
																		SUM(B.AkumulasiPenyusutan) as Ap,SUM(B.NilaiBuku) as Nb,
																		GROUP_CONCAT(B.noRegister) as noReg, 
																		B.kodeSatker,
																		B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.kondisi,
																		K.Kode, K.Uraian,B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku
																	from 
																		$tableNeracaBangunan as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode 
																		 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and (B.NilaiPerolehan >= 10000000 $KodeKa_bangunan) AND B.kodeLokasi like '12%'
																		AND $extQuery_C_cndt $kondisiBangunan
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	order by B.kodeSatker,B.kodeKelompok";	
															
															$query_04 = "select SUM(J.NilaiPerolehan) as Nilai,
																		SUM(J.PenyusutanPerTahun) as Ppt,
																		SUM(J.AkumulasiPenyusutan) as Ap,SUM(J.NilaiBuku) as Nb,
																		GROUP_CONCAT(J.noRegister) as noReg,
																		J.kodeSatker,
																		J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,
																		K.Kode, K.Uraian,J.PenyusutanPerTahun,J.AkumulasiPenyusutan,J.NilaiBuku
																	from 
																		$tableNeracaJaringan as J,kelompok as K  
																	where
																		J.kodeKelompok = K.Kode 
																		 and J.Status_Validasi_Barang =1 and J.StatusTampil =1  AND J.kodeLokasi like '12%'
																		and $newparameter_sql_04 $extQuery_D_default $kondisiJaringan
																	group by 
																		J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
																		J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
																		J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
																		J.kondisi, J.kodeLokasi,J.kondisi,
																		K.Kode, K.Uraian
																	order by J.kodeSatker,J.kodeKelompok";	
															
															$query_05 = "select SUM(AL.NilaiPerolehan) as Nilai,
																		GROUP_CONCAT(AL.noRegister) as noReg,
																		AL.kodeSatker,
																		AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		$tableNeracaAsetLain as AL,kelompok as K  
																	where
																		AL.kodeKelompok = K.Kode 
																		 and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 AND AL.kodeLokasi like '12%'
																		and $newparameter_sql_05 $extQuery_E_default $kondisiAsetLain
																	group by 
																		AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
																		AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
																		AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
																		AL.kondisi, AL.kodeLokasi,AL.kondisi,
																		K.Kode, K.Uraian
																	order by AL.kodeSatker,AL.kodeKelompok";
														
															$query_06 = "select SUM(KDPA.NilaiPerolehan) as Nilai,
																		GROUP_CONCAT(KDPA.noRegister) as noReg,
																		KDPA.kodeSatker,
																		KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		$tableNeracaKdp as KDPA,kelompok as K  
																	where
																		KDPA.kodeKelompok = K.Kode  
																		 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
																		and $newparameter_sql_06 $extQuery_F_default $kondisiKDP
																	group by 
																		KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
																		KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
																		KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
																		KDPA.kondisi, KDPA.kodeLokasi,KDPA.kondisi,
																		K.Kode, K.Uraian	
																	order by KDPA.kodeSatker,KDPA.kodeKelompok";	
																	
															if($thnceck < $thnIntraDefault){
																// echo "sini aja";
																$dataQuery = array($query_01,$query_02_default,$query_02_condt,$query_03_default,$query_03_condt,$query_04,$query_05,$query_06);
																// $dataQuery = array($query_02_default,$query_02_condt);
															}elseif($thnceck >= $thnIntraDefault || $thnceck < $thnFix){
																// echo "tahun awal tidak sama tahun akhir";
																$dataQuery = array($query_01,$query_02_condt,$query_03_condt,$query_04,$query_05,$query_06);
															}else{
																// echo "tahun awal sama tahun akhir";
																$dataQuery = array($query_01,$query_02_default,$query_02_condt,$query_03_default,$query_03_condt,$query_04,$query_05,$query_06);
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
													// echo "masukkkk";
													// exit;
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
															//$tahunPerolehan  >= 2008	
															$query_02 = "select SUM(M.NilaiPerolehan) as Nilai,GROUP_CONCAT(M.noRegister) as noReg,
																			M.kodeSatker,
																			M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			mesin_ori as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode  
																			 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and (M.NilaiPerolehan < 300000 $KodeKa_mesin)
																			and M.TglPerolehan >= '$tglawalperolehan' and M.TglPerolehan <= '$tglAkhirDefault' 
																			AND M.TglPembukuan >='$tglawalperolehan' AND M.TglPembukuan <='$tglAkhirDefault'
																			$satker_02 AND M.kodeLokasi like '12%'
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,M.kondisi,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.kodeKelompok";
															
															$query_03 = "select SUM(B.NilaiPerolehan) as Nilai,GROUP_CONCAT(B.noRegister) as noReg, 
																		B.kodeSatker,
																		B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		bangunan_ori as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode 
																		 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and (B.NilaiPerolehan < 10000000 $KodeKa_bangunan)
																		and B.TglPerolehan >= '$tglawalperolehan' and B.TglPerolehan <= '$tglAkhirDefault' 
																		AND B.TglPembukuan >='$tglawalperolehan' AND B.TglPembukuan <='$tglAkhirDefault'
																		$satker_03 AND B.kodeLokasi like '12%'
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.kondisi,
																		K.Kode, K.Uraian
																	order by B.kodeKelompok";
															$dataQuery = array($query_02,$query_03);
															// pr($dataQuery);
															// exit;
															$query = $dataQuery;		

														}elseif($thnceck < $thnExtraDefault){
															/*echo "tahun cek=".$thnceck;
															echo "masukk";
															echo "sini aja";
															exit;*/
															$query_02 = "select SUM(M.NilaiPerolehan) as Nilai,GROUP_CONCAT(M.noRegister) as noReg, 
																			M.kodeSatker,
																			M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
																			M.Silinder,M.kodeLokasi, K.Kode, K.Uraian
																		from 
																			mesin_ori as M,kelompok as K 
																		where 
																			M.kodeKelompok=K.Kode  
																			 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and (M.NilaiPerolehan < 300000 $KodeKa_mesin)
																			and M.TglPerolehan >= '$tglExtraDefault' and M.TglPerolehan <= '$tglAkhirDefault'
																			AND M.TglPembukuan <='$tglAkhirDefault'	
																			$satker_02 AND M.kodeLokasi like '12%' 
																		group by 
																			M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
																			M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,M.kondisi,
																			M.kodeLokasi, K.Kode, K.Uraian 
																		order by 
																			M.kodeKelompok";
															
															$query_03 = "select SUM(B.NilaiPerolehan) as Nilai,GROUP_CONCAT(B.noRegister) as noReg,  
																		B.kodeSatker,
																		B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
																		K.Kode, K.Uraian
																	from 
																		bangunan_ori as B,kelompok as K  
																	where
																		B.kodeKelompok = K.Kode 
																		 and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and (B.NilaiPerolehan < 10000000 $KodeKa_bangunan)
																		and B.TglPerolehan >= '$tglExtraDefault' and B.TglPerolehan <= '$tglAkhirDefault'
																		AND B.TglPembukuan <='$tglAkhirDefault'
																		$satker_03 AND B.kodeLokasi like '12%'
																	group by 
																		B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
																		B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
																		B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
																		B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.kondisi,
																		K.Kode, K.Uraian
																	order by B.kodeKelompok";
														
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
																			 $query = $rekap_barang_a_condition; 
																			 // echo "masukkk";
															}
															if($parameter_sql=="" ) {
																		$query = ""; 
															}
														 }		
														 break;
														 case 'RekapKIB-B':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_b_condition;
																						}
															  if($parameter_sql=="" ) {
																		$query = "";
																						}
														 }
														 break;
														 case 'RekapKIB-C':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_c_condition;
															  }
															  if($parameter_sql=="" ) {
																		$query = "";
															  }
														 }
														 break;
														 case 'RekapKIB-D':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_d_condition;
															  }
															  if($parameter_sql=="" ){
																		$query = "";
															  }
														 }
														 break;
														 
														 case 'RekapKIB-E':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_e_condition;
															   }
															  if($parameter_sql=="" ){
																		$query = "";
															  }
														 }
														 break;
												
														 case 'RekapKIB-F':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_f_condition;	
															  }
															  if($parameter_sql=="" ){
																		$query = "";	
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
																						tanahView as T JOIN kelompok as K ON K.Kode = T.kodeKelompok
																					where 
																						T.Status_Validasi_Barang =1 and T.StatusTampil =1 
																						and $newparameter_sql
																					order by 
																						T.kodeKelompok,T.noRegister";	
																	}
																	elseif($gol == 02){
																		// echo "parameter sql =".$parameter_sql;
																		$pecah = explode("AND ",$parameter_sql);
																		for ($q=0;$q<count($pecah);$q++){
																			$param[]="M.".$pecah[$q];
																		}
																		
																		$newparameter_sql = implode('AND ', $param);
																		$query = "select M.kodeSatker,M.kodeLokasi,M.kodeKelompok,M.noRegister,M.Tahun,M.kodeRuangan,K.Uraian
																					from 
																						mesin_ori as M JOIN kelompok as K ON K.Kode = M.kodeKelompok
																					where 
																						 M.Status_Validasi_Barang =1 and M.StatusTampil =1 
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
																						bangunan_ori as B JOIN kelompok as K ON K.Kode = B.kodeKelompok
																					where 
																						B.Status_Validasi_Barang =1 and B.StatusTampil =1 
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
																						jaringan_ori as J JOIN kelompok as K ON K.Kode = J.kodeKelompok
																					where 
																						 J.Status_Validasi_Barang =1 and J.StatusTampil =1 
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
																						asetlain_ori as AL JOIN kelompok as K ON K.Kode = AL.kodeKelompok
																					where 
																						AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 
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
																						kdp_ori as KDPA JOIN kelompok as K ON K.Kode = KDPA.kodeKelompok
																					where 
																						KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1 
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
												   case '11':
												  {
													if (isset($rekap_barang))
													  {
														switch ($rekap_barang)
														{
														 case 'RekapBarangKIB-A':
														 {
															// echo "masukkk";
															// exit;
															if($parameter_sql!="" ) {
																			 $query = $rekap_barang_a_condition; 
																			 // echo "masukkk";
															}
															if($parameter_sql=="" ) {
																		$query = $rekap_barang_a_default; 
															}
														 }		
														 break;
														 case 'RekapBarangKIB-B':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_b_condition_rev;
																						}
															  if($parameter_sql=="" ) {
																		$query = $rekap_barang_b_default;
																						}
														 }
														 break;
														 case 'RekapBarangKIB-C':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_c_condition;
															  }
															  if($parameter_sql=="" ) {
																		$query = $rekap_barang_c_default;
															  }
														 }
														 break;
														 case 'RekapBarangKIB-D':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_d_condition;
															  }
															  if($parameter_sql=="" ){
																		$query = $rekap_barang_d_default;
															  }
														 }
														 break;
														 
														 case 'RekapBarangKIB-E':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_e_condition_rev;
															   }
															  if($parameter_sql=="" ){
																		$query = $rekap_barang_e_default;
															  }
														 }
														 break;
												
														 case 'RekapBarangKIB-F':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_f_condition;	
															  }
															  if($parameter_sql=="" ){
																		$query = $rekap_barang_f_default;	
															  }
														 }
														 break;
														}
                                                       }
												  }
												  break;
												  case '12':
												  {
													if (isset($rekap_barang_sensus))
													  {
														switch ($rekap_barang_sensus)
														{
														 case 'RekapBarangSensusKIB-A':
														 {
															// echo "masukkk";
															// exit;
															if($parameter_sql!="" ) {
																			 $query = $rekap_barang_a_condition; 
																			 // echo "masukkk";
															}
															if($parameter_sql=="" ) {
																		$query = $rekap_barang_a_default; 
															}
														 }		
														 break;
														 case 'RekapBarangSensusKIB-B':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_b_condition_sensus;
																						}
															  if($parameter_sql=="" ) {
																		$query = "";
																						}
														 }
														 break;
														 case 'RekapBarangSensusKIB-C':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_c_condition;
															  }
															  if($parameter_sql=="" ) {
																		$query = "";
															  }
														 }
														 break;
														 case 'RekapBarangSensusKIB-D':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_d_condition;
															  }
															  if($parameter_sql=="" ){
																		$query = $rekap_barang_d_default;
															  }
														 }
														 break;
														 
														 case 'RekapBarangSensusKIB-E':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_e_condition_sensus;
															   }
															  if($parameter_sql=="" ){
																		$query = $rekap_barang_e_default;
															  }
														 }
														 break;
												
														 case 'RekapBarangSensusKIB-F':
														 {
															  if($parameter_sql!="" ){
																		$query = $rekap_barang_f_condition;	
															  }
															  if($parameter_sql=="" ){
																		$query = $rekap_barang_f_default;	
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
			$splitKodeSatker = explode ('.',$kdSakter);
			
			if(count($splitKodeSatker) == 4){			
				$query ="SELECT kode FROM satker where kode = '$kdSakter' and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
			}else{
				$query ="SELECT kode FROM satker where kode like '$kdSakter%' and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
			}
			$result = $this->query($query) or die ($this->error());
			while($data = $this->fetch_object($result)){
				if($data != ''){
					$getkodeSatker[] = $data->kode;
				}	
			}
			$get_satker = $this->_cek_data_satker_with_id($getkodeSatker, true);
		}
		else
		{
			$kdSakter = "$satker";
			$get_satker = $this->_cek_data_satker_with_id($get_satker, false);
		}
		
		return $get_satker;
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
    public function  retrieve_query_try($query){
		$result= $this->query($query);
          
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
									left join tanahView T on T.kodeKelompok = x.Kode and 
									T.TglPerolehan >='$tglawalperolehan' and T.TglPerolehan <='$tglakhirperolehan' and T.Status_Validasi_Barang = 1 and T.StatusTampil = 1
								where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(M.Aset_ID)as Jumlah, sum(M.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join mesin_ori M on M.kodeKelompok = x.Kode and 
									M.TglPerolehan >='$tglawalperolehan' and M.TglPerolehan <='$tglakhirperolehan' and M.Status_Validasi_Barang = 1 and M.StatusTampil = 1 
								where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(B.Aset_ID)as Jumlah, sum(B.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join bangunan_ori B on B.kodeKelompok = x.Kode and 
									B.TglPerolehan >='$tglawalperolehan' and B.TglPerolehan <='$tglakhirperolehan' and B.Status_Validasi_Barang = 1 and B.StatusTampil = 1 
								where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(J.Aset_ID)as Jumlah, sum(J.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join jaringan_ori J on J.kodeKelompok = x.Kode and 
									J.TglPerolehan >='$tglawalperolehan' and  J.TglPerolehan <='$tglakhirperolehan' and J.Status_Validasi_Barang = 1 and J.StatusTampil = 1 
								where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(AL.Aset_ID)as Jumlah, sum(AL.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join asetlain_ori AL on AL.kodeKelompok = x.Kode and 
									AL.TglPerolehan >='$tglawalperolehan' and AL.TglPerolehan <='$tglakhirperolehan' and AL.Status_Validasi_Barang = 1 and AL.StatusTampil = 1 
								where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
		$query_get_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(KDPA.Aset_ID)as Jumlah, sum(KDPA.NilaiPerolehan) as NilaiPerolehan 
								from kelompok k 
									left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
									left join kdp_ori KDPA on KDPA.kodeKelompok = x.Kode and 
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
												left join tanahView T on T.kodeKelompok = x.Kode and 
												T.kodeSatker = '$Satker_ID' and T.TglPerolehan >='$tglawalperolehan' and T.TglPerolehan <='$tglakhirperolehan' and T.Status_Validasi_Barang = 1 and T.StatusTampil = 1
											where k.Golongan='01' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_2 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(M.Aset_ID)as Jumlah, sum(M.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join mesin_ori M on M.kodeKelompok = x.Kode and 
												M.kodeSatker = '$Satker_ID' and M.TglPerolehan >='$tglawalperolehan' and M.TglPerolehan <='$tglakhirperolehan' and M.Status_Validasi_Barang = 1 and M.StatusTampil = 1 
											where k.Golongan='02' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_3 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(B.Aset_ID)as Jumlah, sum(B.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join bangunan_ori B on B.kodeKelompok = x.Kode and 
												B.kodeSatker = '$Satker_ID' and B.TglPerolehan >='$tglawalperolehan' and B.TglPerolehan <='$tglakhirperolehan' and B.Status_Validasi_Barang = 1 and B.StatusTampil = 1 
											where k.Golongan='03' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_4 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(J.Aset_ID)as Jumlah, sum(J.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join jaringan_ori J on J.kodeKelompok = x.Kode and 
												J.kodeSatker = '$Satker_ID' and J.TglPerolehan >='$tglawalperolehan' and J.TglPerolehan <='$tglakhirperolehan' and J.Status_Validasi_Barang = 1 and J.StatusTampil = 1 
											where k.Golongan='04' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_5 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(AL.Aset_ID)as Jumlah, sum(AL.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join asetlain_ori AL on AL.kodeKelompok = x.Kode and 
												AL.kodeSatker = '$Satker_ID' and AL.TglPerolehan >='$tglawalperolehan' and AL.TglPerolehan <='$tglakhirperolehan' and AL.Status_Validasi_Barang = 1 and AL.StatusTampil = 1 
											where k.Golongan='05' and k.Kelompok is null and k.Sub is null and k.SubSub is null  group by k.Kode, k.Golongan, k.Bidang, k.Uraian order by k.Kode";
					$query_get_golongan_6 = "select k.Kode, k.Golongan, k.Bidang, k.Uraian,count(KDPA.Aset_ID)as Jumlah, sum(KDPA.NilaiPerolehan) as NilaiPerolehan 
											from kelompok k 
												left join kelompok x on x.Golongan = k.Golongan and x.Bidang = k.Bidang 
												left join kdp_ori KDPA on KDPA.kodeKelompok = x.Kode and 
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
     public function show_pilih_download_detail($url)
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
                    <td><p style="font-size: 12px; color: blue">2. <a href="<?php echo "$url"."4"?>" target="_blank">CSV <i><b>(Bila File Berukuran Besar)</b></i></a></p></td>
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
    
	//pilih download 
    public function show_pilih_download_cstm($url)
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
		//pr($query);
		if (!$query) return false;
	
		$result=mysql_query($query);
		$i = 0;
		while ($row=mysql_fetch_assoc($result)){
		  $data[] = $row;
		  $register = $row['noReg'];
		  // echo "noreg =".$register;
		  // echo"<br>";
		  // exit;
		  sort($register);
		  $urut = $this->sortirNoReg($register);
		  // pr($urut);
		  $data[$i]['noRegister'] = $urut;
			$i++;
		 // pr($data);
		}
		// pr($data); 
		// exit;
		
		
		if (!$data) {
			return '';
		}
		return $data;
		
	}

	public function QueryBinv($dataQuery){
		//pr($dataQuery);
		if(is_array($dataQuery)){
			$hit = count($dataQuery);
			if($hit == 0){
				$data ='';
			}else{
			// echo "array query";
			// echo "<br>";
				$x = 0;
				for ($i = 0; $i < count($dataQuery); $i++)
					{
						/*echo "query_$i =".$dataQuery[$i];
						echo "<br>";
						echo "<br>";*/
						// exit;
						$result_golongan = $this->query($dataQuery[$i]) or die ($this->error('error dataQuery'));
						if ($result_golongan)
						{
						  
						   while ($dataArr = mysql_fetch_assoc($result_golongan))
							{
								$data[] = $dataArr;
								$register = $dataArr['noReg'];
								sort($register);
								$urut = $this->sortirNoReg($register);
								$data[$x]['noRegister'] = $urut;
								$x++;
							}
						}
						$result_golongan = '';

					}
			}	
		}else{
				//echo "single query";
				$result_golongan = $this->query($dataQuery) or die ($this->error('error dataQuery'));
				if ($result_golongan)
				{
					$i = 0;
					while ($dataArr = mysql_fetch_assoc($result_golongan))
					{
						$data[] = $dataArr;
						$register = $dataArr['noReg'];
						sort($register);
						$urut = $this->sortirNoReg($register);
						$data[$i]['noRegister'] = $urut;
						$i++;
					}
				}
		}
		// pr($data);
		// exit;
		
		if (!$data) {
			return '';
		}
		return $data;	
	}

	//public function IntraRev($satker_id,$tglawalperolehan,$tglakhirperolehan,$FlagAset,$TAHUN_AKTIF){
	public function IntraRev($satker_id,$tglawalperolehan,$tglakhirperolehan,$FlagAset,$tahunNeraca,$status){
		
		//sorting function
		function sort_subnets ($a, $b) {
		    $a_arr = explode('.', $a);
		    $b_arr = explode('.', $b);
		    foreach (range(0,4) as $i) {
		        if ( $a_arr[$i] < $b_arr[$i] ) {
		            return -1;
		        }
		        elseif ( $a_arr[$i] > $b_arr[$i] ) {
		            return 1;
		        }
		    }
		    return -1;
		}
		$data = array();
		$satker = array();
		$satker2 = array();
		if($satker_id){
			$splitKodeSatker = explode ('.',$satker_id);
				if(count($splitKodeSatker) == 4){	
					$paramSatker = "kode = '$satker_id'";
					$paramSatker_rev = "kodeSatker = '$satker_id'";
				}else{
					$paramSatker = "kode like '$satker_id%'";
					$paramSatker_rev = "kodeSatker like '$satker_id%'";
				}
			
			//list satker
			$qsat = "SELECT kode,NamaSatker FROM satker where $paramSatker and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					$satker[] = $dtrsat->kode;
					//$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
				}	
			}

			//list satker yg ada datanya
			$qsatcmpr = "SELECT kodeSatker FROM aset where $paramSatker_rev and Status_Validasi_Barang = 1 
						GROUP BY kodeSatker";
			$rsatcmpr = $this->query($qsatcmpr) or die ($this->error());
			while($dtrsatcmpr = $this->fetch_object($rsatcmpr)){
				if($dtrsatcmpr != ''){
					$satkercmpr[] = $dtrsatcmpr->kodeSatker;
				}	
			}

			//list array skpd fix
			$result=array_intersect($satkercmpr,$satker);
			
			//sortir
			usort($result, 'sort_subnets');
			
			foreach ($result as $key => $value) {
				$qrstker = "SELECT kode,NamaSatker FROM satker where kode = '{$value}' and KodeUnit is not null 
							and Gudang is not null and Kd_Ruang is NULL";
				$exeqrstker = $this->query($qrstker) or die ($this->error());
				$dtrsat = $this->fetch_object($exeqrstker);
				$satker2[] = $dtrsat->kode;
			}

		}else{
			//list all satker
			$qsat = "SELECT kode,NamaSatker FROM satker where kode is not null and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL ";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					$satker[] = $dtrsat->kode;
					//$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
				}	
			}
			
			//list satker yg ada datanya
			$qsatcmpr = "SELECT kodeSatker FROM aset where Status_Validasi_Barang = 1 GROUP BY kodeSatker";
			$rsatcmpr = $this->query($qsatcmpr) or die ($this->error());
			while($dtrsatcmpr = $this->fetch_object($rsatcmpr)){
				if($dtrsatcmpr != ''){
					$satkercmpr[] = $dtrsatcmpr->kodeSatker;
				}	
			}
			
			//list array skpd fix
			$result=array_intersect($satkercmpr,$satker);
			
			//sortir
			usort($result, 'sort_subnets');
			foreach ($result as $key => $value) {
				$qrstker = "SELECT kode,NamaSatker FROM satker where kode = '{$value}' and KodeUnit is not null 
							and Gudang is not null and Kd_Ruang is NULL";
				$exeqrstker = $this->query($qrstker) or die ($this->error());
				$dtrsat = $this->fetch_object($exeqrstker);
				$satker2[] = $dtrsat->kode;
			}
		
		}
		
		$thnIntraDefault ="2008";
		$tglIntraDefault = "2008-01-01";

		$tglAwalDefault = $tglawalperolehan;
		$ceckTglAw = explode ('-',$tglAwalDefault);
		$thnceck = $ceckTglAw[0];
				
		$tglAkhirDefault = $tglakhirperolehan;
		$ceckTgl = explode ('-',$tglAkhirDefault);
		$thnFix = $ceckTgl[0];
		
		/*echo "tahun ceck =".$thnceck; echo "<br/>";
		echo "tahun Intra Default =".$thnIntraDefault;echo "<br/>";
		echo "tahun Fix =".$thnFix; echo "<br/>";*/

		if($thnceck < $thnIntraDefault){
			
			$extQuery_A_default = "AND T.TglPerolehan >= '$tglAwalDefault' AND T.TglPerolehan <= '$tglAkhirDefault' 
								   AND T.TglPembukuan >='$tglAwalDefault' AND T.TglPembukuan <='$tglAkhirDefault' ";
			$extQuery_B_default = "AND M.TglPerolehan >= '$tglAwalDefault' AND M. TglPerolehan < '$tglIntraDefault' 
								   AND M.TglPembukuan >='$tglAwalDefault' AND M.TglPembukuan <='$tglAkhirDefault' ";
			$extQuery_B_cndt = "AND M.TglPerolehan >= '$tglIntraDefault' AND M. TglPerolehan <= '$tglAkhirDefault' 
								 AND M.TglPembukuan >='$tglAwalDefault' AND M.TglPembukuan <='$tglAkhirDefault' ";
			$extQuery_C_default = "AND B.TglPerolehan >= '$tglAwalDefault' AND B. TglPerolehan < '$tglIntraDefault' 
			                    AND B.TglPembukuan >='$tglAwalDefault' AND B.TglPembukuan <='$tglAkhirDefault' ";
			$extQuery_C_cndt = "AND B.TglPerolehan >= '$tglIntraDefault' AND B. TglPerolehan <= '$tglAkhirDefault' 
			                    AND B.TglPembukuan >='$tglAwalDefault' AND B.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_D_default = "AND J.TglPerolehan >= '$tglAwalDefault' AND J.TglPerolehan <= '$tglAkhirDefault' 
								   AND J.TglPembukuan >='$tglAwalDefault' AND J.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_E_default = "AND AL.TglPerolehan >= '$tglAwalDefault' AND AL. TglPerolehan <= '$tglAkhirDefault'
								   AND AL.TglPembukuan >='$tglAwalDefault' AND AL.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_F_default = "AND KDPA.TglPerolehan >= '$tglAwalDefault' AND KDPA. TglPerolehan <= '$tglAkhirDefault'
								   AND KDPA.TglPembukuan >='$tglAwalDefault' AND KDPA.TglPembukuan <='$tglAkhirDefault'";
			
		}elseif($thnceck >= $thnIntraDefault || $thnceck < $thnFix){
			//2008-01-01 sampe 2009-12-01
			$extQuery_A_default = "AND T.TglPerolehan >= '$tglAwalDefault' AND T.TglPerolehan <= '$tglAkhirDefault' 
									AND T.TglPembukuan >='$tglAwalDefault' AND T.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_B_cndt = "AND M.TglPerolehan >= '$tglAwalDefault' AND M. TglPerolehan <='$tglIntraDefault' ";
			$extQuery_C_cndt = "AND B.TglPerolehan >= '$tglAwalDefault' AND B. TglPerolehan <='$tglIntraDefault' ";
			$extQuery_D_default = "AND J.TglPerolehan >= '$tglAwalDefault' AND J.TglPerolehan <= '$tglAkhirDefault'
								   AND J.TglPembukuan >='$tglAwalDefault' AND J.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_E_default = "AND AL.TglPerolehan >= '$tglAwalDefault' AND AL. TglPerolehan <= '$tglAkhirDefault'
									AND AL.TglPembukuan >='$tglAwalDefault' AND AL.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_F_default = "AND KDPA.TglPerolehan >= '$tglAwalDefault' AND KDPA. TglPerolehan <= '$tglAkhirDefault'
									AND KDPA.TglPembukuan >='$tglAwalDefault' AND KDPA.TglPembukuan <='$tglAkhirDefault'";
			
		}else{
			$extQuery_A_default = "AND T.TglPerolehan >= '$tglAwalDefault' AND T.TglPerolehan <= '$tglAkhirDefault'
								   AND T.TglPembukuan >='$tglAwalDefault' AND T.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_B_cndt = "AND M.TglPerolehan >= '$tglAwalDefault' AND M. TglPerolehan <='$tglIntraDefault' ";
			$extQuery_C_cndt = "AND B.TglPerolehan >= '$tglAwalDefault' AND B. TglPerolehan <='$tglIntraDefault' ";
			$extQuery_D_default = "AND J.TglPerolehan >= '$tglAwalDefault' AND J.TglPerolehan <= '$tglAkhirDefault'
									AND J.TglPembukuan >='$tglAwalDefault' AND J.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_E_default = "AND AL.TglPerolehan >= '$tglAwalDefault' AND AL. TglPerolehan <= '$tglAkhirDefault' 
									AND AL.TglPembukuan >='$tglAwalDefault' AND AL.TglPembukuan <='$tglAkhirDefault'";
			$extQuery_F_default = "AND KDPA.TglPerolehan >= '$tglAwalDefault' AND KDPA. TglPerolehan <= '$tglAkhirDefault'
									AND KDPA.TglPembukuan >='$tglAwalDefault' AND KDPA.TglPembukuan <='$tglAkhirDefault'";
			
		}
		if($FlagAset == 1){
			$kondisiTanah = " AND T.kondisi != 3 AND T.kondisi != 4 AND T.kondisi != 5";
			$kondisiMesin = " AND M.kondisi != 3 AND M.kondisi != 4 AND M.kondisi != 5";
			$kondisiBangunan = " AND B.kondisi != 3 AND B.kondisi != 4 AND B.kondisi != 5";
			$kondisiJaringan = " AND J.kondisi != 3 AND J.kondisi != 4 AND J.kondisi != 5";
			$kondisiAsetLain = " AND AL.kondisi != 3 AND AL.kondisi != 4 AND AL.kondisi != 5 ";
			$kondisiKDP = "";
			/*$tglCmpr = $TAHUN_AKTIF."-"."12-31";
			$expld = explode('-', $tglakhirperolehan);
			if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
				$tahun = $TAHUN_AKTIF;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				$tableNeracaTanah 		= "tanahView";
				$tableNeracaMesin 		= 'mesin_ori';
				$tableNeracaBangunan 	= 'bangunan_ori';
				$tableNeracaJaringan 	= "jaringan_ori";
				$tableNeracaAsetLain	= "asetlain_ori";
				$tableNeracaKdp 		= "kdp_ori";
			}*/
			if($status == 1){
				$tahun = $tahunNeraca;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				$tableNeracaTanah 		= "tanahView";
				$tableNeracaMesin 		= 'mesin_ori';
				$tableNeracaBangunan 	= 'bangunan_ori';
				$tableNeracaJaringan 	= "jaringan_ori";
				$tableNeracaAsetLain	= "asetlain_ori";
				$tableNeracaKdp 		= "kdp_ori";
			}

		}else{
			$tahun = $tahunNeraca;

			$kondisiTanah = " AND (T.kondisi = 3 OR T.kondisi = 4 OR T.kondisi = 5) ";
			$kondisiMesin = " AND (M.kondisi = 3 OR M.kondisi = 4 OR M.kondisi = 5) ";
			$kondisiBangunan = " AND (B.kondisi = 3 OR B.kondisi = 4 OR B.kondisi = 5) ";
			$kondisiJaringan = " AND (J.kondisi = 3 OR J.kondisi = 4 OR J.kondisi = 5)";
			$kondisiAsetLain = " AND (AL.kondisi = 3 OR AL.kondisi = 4 OR AL.kondisi = 5)";
			$kondisiKDP = " AND (KDPA.kondisi = 3 OR KDPA.kondisi = 4 OR KDPA.kondisi = 5)";

			/*$tableNeracaTanah 		= "tanahView";
			$tableNeracaMesin 		= 'mesin_ori';
			$tableNeracaBangunan 	= 'bangunan_ori';
			$tableNeracaJaringan 	= "jaringan_ori";
			$tableNeracaAsetLain	= "asetlain_ori";
			$tableNeracaKdp 		= "kdp_ori";*/ 

			$tableNeracaTanah 		= "nasetlainnya_tanah".$tahun;
			$tableNeracaMesin 		= "nasetlainnya_mesin".$tahun;
			$tableNeracaBangunan 	= "nasetlainnya_bangunan".$tahun;
			$tableNeracaJaringan 	= "nasetlainnya_jaringan".$tahun;
			$tableNeracaAsetLain	= "nasetlainnya_asetlain".$tahun;
			$tableNeracaKdp 		= "nasetlainnya_kdp".$tahun;
		}
		$KodeKa_mesin = "OR M.kodeKA = 1";
		$KodeKa_bangunan = "OR B.kodeKA = 1";
		$KodeKaCondt1_mesin = "AND M.kodeKA = 1";
		$KodeKaCondt1_bangunan = "AND B.kodeKA = 1";
		
		foreach ($satker2 as $key => $skpdId) {
			# code...
			$query_01 = "select SUM(T.NilaiPerolehan) as Nilai,
					GROUP_CONCAT(T.noRegister) as noReg,
					T.kodeSatker,T.kodeKelompok, T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
					K.Kode, K.Uraian
				from 
					$tableNeracaTanah as T,kelompok as K
				where
					T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 AND T.kodeLokasi like '12%'
					$extQuery_A_default $kondisiTanah AND T.kodeSatker = '$skpdId'
				group by 
					T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,T.kondisi,
					K.Kode, K.Uraian
				order by 
					T.kodeKelompok";

			$query_02_default = "select SUM(M.NilaiPerolehan) as Nilai,
					SUM(M.PenyusutanPerTahun) as Ppt,
					SUM(M.AkumulasiPenyusutan) as Ap,SUM(M.NilaiBuku) as Nb,
					GROUP_CONCAT(M.noRegister) as noReg,
					M.kodeSatker,
					M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
					M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.kondisi,
					M.Silinder,M.kodeLokasi, K.Kode, K.Uraian,M.PenyusutanPerTahun,M.AkumulasiPenyusutan,M.NilaiBuku
				from 
					$tableNeracaMesin as M,kelompok as K 
				where 
					M.kodeKelompok=K.Kode  
					 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 AND M.kodeLokasi like '12%'
					 $extQuery_B_default $KodeKaCondt1_mesin $kondisiMesin AND M.kodeSatker = '$skpdId'
				group by 
					M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
					M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
					M.kodeLokasi,M.kondisi, K.Kode, K.Uraian 
				order by 
					M.kodeKelompok";	

			$query_02_condt = "select  SUM(M.NilaiPerolehan) as Nilai,
					SUM(M.PenyusutanPerTahun) as Ppt,
					SUM(M.AkumulasiPenyusutan) as Ap,SUM(M.NilaiBuku) as Nb,
					GROUP_CONCAT(M.noRegister) as noReg,
					M.kodeSatker,
					M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
					M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.kondisi,
					M.Silinder,M.kodeLokasi, K.Kode, K.Uraian,M.PenyusutanPerTahun,M.AkumulasiPenyusutan,M.NilaiBuku
				from 
					$tableNeracaMesin as M,kelompok as K 
				where 
					M.kodeKelompok=K.Kode  
					 and M.Status_Validasi_Barang =1 and M.StatusTampil =1 and (M.NilaiPerolehan >= 300000 $KodeKa_mesin) AND M.kodeLokasi like '12%'
				 	$extQuery_B_cndt $kondisiMesin AND M.kodeSatker = '$skpdId'
				group by 
					M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
					M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,M.Silinder,
					M.kodeLokasi,M.kondisi, K.Kode, K.Uraian 
				order by 
					M.kodeKelompok";	

			$query_03_default = "select SUM(B.NilaiPerolehan) as Nilai,
				SUM(B.PenyusutanPerTahun) as Ppt,
				SUM(B.AkumulasiPenyusutan) as Ap,SUM(B.NilaiBuku) as Nb,
				GROUP_CONCAT(B.noRegister) as noReg, 
				B.kodeSatker,
				B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
				B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
				B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
				B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
				K.Kode, K.Uraian,B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku
			from 
				$tableNeracaBangunan as B,kelompok as K  
			where
				B.kodeKelompok = K.Kode 
				and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 AND B.kodeLokasi like '12%'
				$extQuery_C_default $KodeKaCondt1_bangunan $kondisiBangunan AND B.kodeSatker = '$skpdId'
			group by 
				B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
				B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
				B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
				B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.kondisi,
				K.Kode, K.Uraian
			order by B.kodeKelompok";				

			$query_03_condt = "select SUM(B.NilaiPerolehan) as Nilai,
				SUM(B.PenyusutanPerTahun) as Ppt,
				SUM(B.AkumulasiPenyusutan) as Ap,SUM(B.NilaiBuku) as Nb,
				GROUP_CONCAT(B.noRegister) as noReg, 
				B.kodeSatker,
				B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
				B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
				B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
				B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.kondisi,
				K.Kode, K.Uraian,B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku
			from 
				$tableNeracaBangunan as B,kelompok as K  
			where
				B.kodeKelompok = K.Kode 
				and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 and (B.NilaiPerolehan >= 10000000 $KodeKa_bangunan) AND B.kodeLokasi like '12%'
				$extQuery_C_cndt $kondisiBangunan AND B.kodeSatker = '$skpdId'
			group by 
				B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
				B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
				B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
				B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
				K.Kode, K.Uraian
			order by B.kodeKelompok";

			$query_04 = "select SUM(J.NilaiPerolehan) as Nilai,
				SUM(J.PenyusutanPerTahun) as Ppt,
				SUM(J.AkumulasiPenyusutan) as Ap,SUM(J.NilaiBuku) as Nb,
				GROUP_CONCAT(J.noRegister) as noReg,
				J.kodeSatker,
				J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
				J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
				J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
				J.kondisi, J.kodeLokasi,
				K.Kode, K.Uraian,J.PenyusutanPerTahun,J.AkumulasiPenyusutan,J.NilaiBuku
			from 
				$tableNeracaJaringan as J,kelompok as K  
			where
				J.kodeKelompok = K.Kode 
				 and J.Status_Validasi_Barang =1 and J.StatusTampil =1  AND J.kodeLokasi like '12%'
				$extQuery_D_default $kondisiJaringan AND J.kodeSatker = '$skpdId'
			group by 
				J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
				J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
				J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
				J.kondisi, J.kodeLokasi,J.kondisi,
				K.Kode, K.Uraian
			order by J.kodeKelompok";	

			$query_05 = "select SUM(AL.NilaiPerolehan) as Nilai,
				GROUP_CONCAT(AL.noRegister) as noReg,
				AL.kodeSatker,
				AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
				AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
				AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
				AL.kondisi, AL.kodeLokasi,
				K.Kode, K.Uraian
			from 
				$tableNeracaAsetLain as AL,kelompok as K  
			where
				AL.kodeKelompok = K.Kode 
				and AL.Status_Validasi_Barang =1 and AL.StatusTampil =1 AND AL.kodeLokasi like '12%'
				$extQuery_E_default $kondisiAsetLain AND AL.kodeSatker = '$skpdId'
			group by 
				AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
				AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
				AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
				AL.kondisi, AL.kodeLokasi,AL.kondisi,
				K.Kode, K.Uraian
			order by AL.kodeKelompok";

			$query_06 = "select SUM(KDPA.NilaiPerolehan) as Nilai,
				GROUP_CONCAT(KDPA.noRegister) as noReg,
				KDPA.kodeSatker,
				KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
				KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
				KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
				KDPA.kondisi, KDPA.kodeLokasi,
				K.Kode, K.Uraian
			from 
				$tableNeracaKdp as KDPA,kelompok as K  
			where
				KDPA.kodeKelompok = K.Kode  
				 and KDPA.Status_Validasi_Barang =1 and KDPA.StatusTampil =1
				 $extQuery_F_default $kondisiKDP AND KDPA.kodeSatker = '$skpdId'
			group by 
				KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
				KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
				KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
				KDPA.kondisi, KDPA.kodeLokasi,KDPA.kondisi,
				K.Kode, K.Uraian	
			order by KDPA.kodeKelompok";

			if($thnceck < $thnIntraDefault){
				// echo "sini aja";
				$dataQuery = array($query_01,$query_02_default,$query_02_condt,$query_03_default,$query_03_condt,$query_04,$query_05,$query_06);
			}elseif($thnceck >= $thnIntraDefault || $thnceck < $thnFix){
				// echo "tahun awal tidak sama tahun akhir";
				$dataQuery = array($query_01,$query_02_condt,$query_03_condt,$query_04,$query_05,$query_06);
			}else{
				// echo "tahun awal sama tahun akhir";
				$dataQuery = array($query_01,$query_02_default,$query_02_condt,$query_03_default,$query_03_condt,$query_04,$query_05,$query_06);
			}

			if(is_array($dataQuery)){
				$hit = count($dataQuery);
				if($hit == 0){
					$data ='';
				}else{
				// echo "array query";
				// echo "<br>";
					$x = 0;
					for ($i = 0; $i < count($dataQuery); $i++)
						{
							/*echo "query_$i =".$dataQuery[$i];
							echo "<br>";
							echo "<br>";*/
							// exit;
							$result_golongan = $this->query($dataQuery[$i]) or die ($this->error('error dataQuery'));
							if ($result_golongan)
							{
							  
							   while ($dataArr = mysql_fetch_assoc($result_golongan))
								{
									$data[] = $dataArr;
									$register = $dataArr['noReg'];
									sort($register);
									$urut = $this->sortirNoReg($register);
									$data[$x]['noRegister'] = $urut;
									$x++;
								}
							}
							$result_golongan = '';

						}
				}	
			}
		}
		if (!$data) {
			return '';
		}
		return $data;
	}

	//laporan tambahan
	public function ceckKib ($satker,$tahun,$paramKib,$flag){
		foreach ($satker as $Satker_ID)
			{
					// pr($value);
					if($paramKib == 01){
						//KIB-A
						if($flag == 0){
							$table = "tanah";
						}else{
							$table = "tanahView";
						}
						$queryok ="select 
										T.Aset_ID,T.kodeKelompok, T.kodeSatker,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.noRegister,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
											K.Kode, K.Uraian
										from 
											$table as T,kelompok as K
										where
											T.kodeKelompok=K.Kode  and T.Status_Validasi_Barang =1 and T.StatusTampil =1 
											and T.kodeSatker = '$Satker_ID' and T.Tahun <= '$tahun'
										order by 
											T.kodeSatker,T.kodeKelompok";
					}elseif($paramKib == 03){
						//KIB-B
						if($flag == 0){
							$table = "bangunan";
						}else{
							$table = "bangunan_ori";
						}
						$queryok ="select B.Aset_ID, B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
											B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.noRegister,B.Alamat,
											B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
											B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
											K.Kode, K.Uraian
										from 
											$table as B,kelompok as K  
										where
											B.kodeKelompok = K.Kode 
											and B.Status_Validasi_Barang = 1 and B.StatusTampil =1 
											and B.kodeSatker = '$Satker_ID' and B.Tahun <= '$tahun'
										order by B.kodeSatker,B.kodeKelompok";
					}elseif($paramKib == 04){
						//KIB-D
						if($flag == 0){
							$table = "jaringan";
						}else{
							$table = "jaringan_ori";
						}
						$queryok ="select J.Aset_ID, J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.noRegister,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
											J.kondisi, J.kodeLokasi,
											K.Kode, K.Uraian
										from 
											$table as J,kelompok as K  
											where
											J.kodeKelompok = K.Kode 
											and J.Status_Validasi_Barang =1 and J.StatusTampil =1 
											and J.kodeSatker = '$Satker_ID' and J.Tahun <= '$tahun'
											order by J.kodeSatker,J.kodeLokasi,J.Tahun,J.kodeKelompok";
					}
					/*echo $queryok ; 	
					echo "<br>";
					echo "<br>";*/
					// exit;
					$result = $this->query($queryok) or die ($this->error('error'));		
					while ($data = $this->fetch_object($result))
					{
						$getdata[$Satker_ID][]= $data;
					}
					
			}
				
				// pr($getdata);
				// exit;
		return 	$getdata;
	}
	
	public function perencanaan ($satker_id,$tahun){
	if($satker_id){
			$splitKodeSatker = explode ('.',$satker_id);
				if(count($splitKodeSatker) == 4){	
					$paramSatker = "kode = '$satker_id'";
				}else{
					$paramSatker = "kode like '$satker_id%'";
				}
			$qsat = "SELECT kode,NamaSatker FROM satker where $paramSatker and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
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
		foreach ($satker as $data=>$satker_id){
		
			$query_01 = "select k.Uraian,
								rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info
						from rencana as rn
						inner join prcn_tanah as pr ON pr.Rencana_ID = rn.Rencana_ID
						inner join kelompok as k ON k.Kode = rn.Kode_Kelompok
						where 
							rn.Tahun = '$tahun' and rn.Kode_Satker = '$satker_id' and rn.Status_Pemeliharaan = 0  and rn.n_status=1
						group by  
						rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info";
			
			$query_02 = "select pr.merk,k.Uraian,
								rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info
						from rencana as rn
						inner join prcn_mesin as pr ON pr.Rencana_ID = rn.Rencana_ID
						inner join kelompok as k ON k.Kode = rn.Kode_Kelompok
						where 
							rn.Tahun = '$tahun' and rn.Kode_Satker = '$satker_id' and rn.Status_Pemeliharaan = 0  and rn.n_status=1 
						group by  
						pr.merk,
						rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info";
			
			$query_03 = "select k.Uraian,
								rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info
						from rencana as rn
						inner join 	prcn_bangunan as pr ON pr.Rencana_ID = rn.Rencana_ID
						inner join kelompok as k ON k.Kode = rn.Kode_Kelompok
						where 
							rn.Tahun = '$tahun' and rn.Kode_Satker = '$satker_id' and rn.Status_Pemeliharaan = 0   and rn.n_status=1
						group by  
						rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info";			
			
			$query_04 = "select k.Uraian,
								rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info
						from rencana as rn
						inner join 	prcn_jaringan as pr ON pr.Rencana_ID = rn.Rencana_ID
						inner join kelompok as k ON k.Kode = rn.Kode_Kelompok
						where 
							rn.Tahun = '$tahun' and rn.Kode_Satker = '$satker_id' and rn.Status_Pemeliharaan = 0  and rn.n_status=1 
						group by  
						rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info";	
			
			$query_05 = "select k.Uraian,
								rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info
						from rencana as rn
						inner join 	prcn_asettetaplain as pr ON pr.Rencana_ID = rn.Rencana_ID
						inner join kelompok as k ON k.Kode = rn.Kode_Kelompok
						where 
							rn.Tahun = '$tahun' and rn.Kode_Satker = '$satker_id' and rn.Status_Pemeliharaan = 0  and rn.n_status=1 
						group by  
						rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info";
			
			$query_06 = "select k.Uraian,
								rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info
						from rencana as rn
						inner join 	prcn_kdp as pr ON pr.Rencana_ID = rn.Rencana_ID
						inner join kelompok as k ON k.Kode = rn.Kode_Kelompok
						where 
							rn.Tahun = '$tahun' and rn.Kode_Satker = '$satker_id' and rn.Status_Pemeliharaan = 0  and rn.n_status=1 
						group by  
						rn.Kode_Kelompok,rn.Kuantitas,rn.Harga_Satuan,rn.Kode_Rekening,rn.Info";			
			
			$queryALLPrncn = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
			for ($i = 0; $i < count($queryALLPrncn); $i++)
			{
				
				/*echo "<br>";
				echo "query_$i =".$queryALLPrncn[$i];
				echo "<br>";
				echo "<br>";*/
				// exit;
				$resultPrcn = $this->query($queryALLPrncn[$i]) or die ($this->error('error dataQuery'));
				// echo "masukk";
					// exit;
				
				if($resultPrcn){
					// $i = 0;
					while ($dataAllPrcn = $this->fetch_object($resultPrcn))
					{
						$dataPr[$data][]= $dataAllPrcn;
					}
				}
			}
		}
		// pr($dataPr);
		// exit;
		if($dataPr) return $dataPr;
	
	}
	
	public function pemeliharaan ($satker_id,$tanggalAwal,$tanggalAkhir){
	if($satker_id){
			$splitKodeSatker = explode ('.',$satker_id);
				if(count($splitKodeSatker) == 4){	
					$paramSatker = "kode = '$satker_id'";
				}else{
					$paramSatker = "kode like '$satker_id%'";
				}
			$qsat = "SELECT kode,NamaSatker FROM satker where $paramSatker and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
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
		foreach ($satker as $data=>$satker_id){
		
			$queryALLPemlhrn = "SELECT a.noRegister, a.kodeKelompok, a.NilaiPerolehan,k.Uraian,
							 pr.RencanaPemeliharaan_ID,pr.kodeRekening, pr.HargaSatuan, pr.UraianPemeliharaan, 
							 pr.keterangan, pr.Lokasi,pr.TglPemeliharaan
					  FROM   aset as a 
					  INNER JOIN kelompok as k ON k.Kode = a.kodeKelompok 
					  INNER JOIN rencana_pemeliharaan as pr ON pr.Aset_ID = a.Aset_ID
					  WHERE pr.kodeSatker = '$satker_id' AND pr.TglPemeliharaan >= '$tanggalAwal' AND pr.TglPemeliharaan <= '$tanggalAkhir'";
			// pr($queryALLPemlhrn);
			
				$resultPmlhrn = $this->query($queryALLPemlhrn) or die ($this->error('error dataQuery'));
				if($resultPmlhrn){
					while ($dataAllPmlhrn = $this->fetch_object($resultPmlhrn))
					{
						$dataPmlhrn[$data][]= $dataAllPmlhrn;
					}
				}
		}
		// pr($dataPmlhrn);
		// exit;
		if($dataPmlhrn) return $dataPmlhrn;
	
	}
	//revisi laporan penyusutan persatuan
	//public function ceckRekap ($satker,$tglawalperolehan,$tglakhirperolehan,$paramGol,$TAHUN_AKTIF){
	public function ceckRekap ($satker,$tglawalperolehan,$tglakhirperolehan,$paramGol,$tahunNeraca,$status){
			// echo $satker."-".$tglawalperolehan."-".$tglakhirperolehan."-".$paramGol;
			// exit;
			$tgldefault = "2008-01-01";
			$thnDefault ="2008";
			
			$tglAwalDefault = $tglawalperolehan;
			$ceckTglAw = explode ('-',$tglAwalDefault);
			$thnceck = $ceckTglAw[0];
			
			$tglAkhirDefault = $tglakhirperolehan;
			$ceckTgl = explode ('-',$tglAkhirDefault);
			$thnFix = $ceckTgl[0];
			
			$tglCmpr = $TAHUN_AKTIF."-"."12-31";
			$expld = explode('-', $tglakhirperolehan);

			/*if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
			}else{
				if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
					$tahun = $TAHUN_AKTIF;
					$tableNeracaMesin 		= "neraca_mesin".$tahun;
					$tableNeracaMesin2 		= "neraca_mesin".$tahun;
					$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
					$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
					$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				}else{
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
				}	
			}*/

			if($status == 1){
				$tahun = $tahunNeraca;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaMesin2 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
			}else{
				if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
				}else{
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
				}	
			}
		
			$KodeKa_m = "AND M.kodeKA = 1";
			$KodeKa_m_2 = "OR M.kodeKA = 1";
			
			$KodeKa_b = "AND B.kodeKA = 1";
			$KodeKa_b_2 = "OR B.kodeKA = 1";
			

				foreach ($satker as $Satker_ID){
					if($paramGol == '02'){
							
							if($thnFix < $thnDefault){
								$queryok="select M.PenyusutanPerTahun,AkumulasiPenyusutan,M.NilaiBuku,M.MasaManfaat,
											M.UmurEkonomis,M.TahunPenyusutan,
											M.Aset_ID,M.noRegister,M.NilaiPerolehan, 
											M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, 
											M.Info, M.TglPerolehan,M.TglPembukuan,
											M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, 
											M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
											M.Silinder,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian  
									   from $tableNeracaMesin as M,kelompok as k where 
									  	 	M.kodeKelompok = k.Kode 
									  	 	and M.kodeSatker = '$Satker_ID' 
									  	 	and M.kondisi != '3' and M.kondisi != '4' and M.kondisi != '5' 
									  	 	and M.TglPerolehan >= '$tglAwalDefault' 
									  	 	and M.TglPerolehan <= '$tglAkhirDefault' 
									  	 	and M.TglPembukuan >= '$tglAwalDefault' 
									  	 	and M.TglPembukuan <= '$tglAkhirDefault' 
									  	 	and M.Status_Validasi_Barang =1 and M.StatusTampil = 1 
									  	 	and M.kodeLokasi like '12%'  
									   $KodeKa_m ORDER BY M.kodeKelompok ";   
							}elseif($thnceck >= $thnDefault){
								$queryok ="select M.PenyusutanPerTahun,AkumulasiPenyusutan,M.NilaiBuku,M.MasaManfaat,
											M.UmurEkonomis,M.TahunPenyusutan,
											M.Aset_ID,M.noRegister,M.NilaiPerolehan, 
											M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, 
											M.Info, M.TglPerolehan,M.TglPembukuan,
											M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, 
											M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
											M.Silinder,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian 						
									   from $tableNeracaMesin as M,kelompok as k where 
										   M.kodeKelompok = k.Kode 
										   and M.kodeSatker = '$Satker_ID' 
										   and M.kondisi != '3' and M.kondisi != '4' and M.kondisi != '5'
										   and M.TglPerolehan >= '$tglAwalDefault' 
										   and M.TglPerolehan <='$tglAkhirDefault' 
										   and M.TglPembukuan >= '$tglAwalDefault' 
										   and M.TglPembukuan <='$tglAkhirDefault' 
										   and (M.NilaiPerolehan >=300000 $KodeKa_m_2) 
										   and M.Status_Validasi_Barang =1 and M.StatusTampil = 1 
										   and M.kodeLokasi like '12%'
										   ORDER BY M.kodeKelompok ";
							}else{
									$queryok ="select M.PenyusutanPerTahun,AkumulasiPenyusutan,M.NilaiBuku,M.MasaManfaat,
											M.UmurEkonomis,M.TahunPenyusutan,
											M.Aset_ID,M.noRegister,M.NilaiPerolehan, 
											M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, 
											M.Info, M.TglPerolehan,M.TglPembukuan,
											M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, 
											M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
											M.Silinder,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian  			
									   from $tableNeracaMesin as M,kelompok as k where 
										   M.kodeKelompok = k.Kode 
										   and M.kodeSatker ='$Satker_ID' 
										   and M.kondisi != '3' and M.kondisi != '4' and M.kondisi != '5'
										   and M.TglPerolehan >= '$tglAwalDefault' 
										   and M.TglPerolehan < '$tgldefault' 
										   and M.TglPembukuan >= '$tglAwalDefault' 
										   and M.TglPembukuan <= '$tglAkhirDefault' 
										   and M.Status_Validasi_Barang =1 and M.StatusTampil = 1 
										   and M.kodeLokasi like '12%' 
										   $KodeKa_m
									   union all
										   select M.PenyusutanPerTahun,AkumulasiPenyusutan,M.NilaiBuku,M.MasaManfaat,
												M.UmurEkonomis,M.TahunPenyusutan,
												M.Aset_ID,M.noRegister,M.NilaiPerolehan, 
												M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, 
												M.Info, M.TglPerolehan,M.TglPembukuan,
												M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, 
												M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
												M.Silinder,M.kodeLokasi,M.kondisi, K.Kode, K.Uraian		
										   from $tableNeracaMesin2 as M,kelompok as k where 
											   M.kodeKelompok = k.Kode 
											   and M.kodeSatker = '$Satker_ID' 
											   and M.kondisi != '3' and M.kondisi != '4' and M.kondisi != '5'
											   and M.TglPerolehan >= '$tgldefault' 
											   and M.TglPerolehan <='$tglAkhirDefault' 
											   and M.TglPembukuan >= '$tglAwalDefault' 
											   and M.TglPembukuan <= '$tglAkhirDefault'  
											   and (M.NilaiPerolehan >=300000 $KodeKa_m_2) 
											   and M.Status_Validasi_Barang =1 and M.StatusTampil = 1 
											   and M.kodeLokasi like '12%' 
										   order by kodeKelompok";		   

							}
							
					}elseif($paramGol == '03'){
						if($thnFix < $thnDefault){
							$queryok ="SELECT B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku,
										B.MasaManfaat,B.UmurEkonomis,B.TahunPenyusutan,
										B.Aset_ID,B.noRegister,B.NilaiPerolehan, 
										B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
										B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
										B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
										B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
										K.Kode, K.Uraian
									FROM $tableNeracaBangunan as B, kelompok as k 
									WHERE B.kodeKelompok = k.Kode 
										 and B.kodeSatker = '$Satker_ID' 
										 and B.kondisi != '3' and B.kondisi != '4' and B.kondisi != '5' 
										 and B.TglPerolehan >= '$tglAwalDefault' 
										 and B.TglPerolehan <= '$tglAkhirDefault' 
										 and B.TglPembukuan >= '$tglAwalDefault' 
										 and B.TglPembukuan <= '$tglAkhirDefault'  
										 and B.Status_Validasi_Barang = 1 and B.StatusTampil = 1 
										 and B.kodeLokasi like '12%'
										 $KodeKa_b 
									order by B.kodeKelompok ";
						}elseif($thnceck >= $thnDefault){
							$queryok ="SELECT B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku,
										B.MasaManfaat,B.UmurEkonomis,B.TahunPenyusutan,
										B.Aset_ID,B.noRegister,B.NilaiPerolehan, 
										B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
										B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
										B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
										B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
										K.Kode, K.Uraian
									FROM $tableNeracaBangunan as B, kelompok as k 
									WHERE B.kodeKelompok = k.Kode 
										and B.kodeSatker = '$Satker_ID' 
										and B.kondisi != '3' and B.kondisi != '4' and B.kondisi != '5'
										and B.TglPerolehan >= '$tglAwalDefault' 
										and B.TglPerolehan <= '$tglAkhirDefault' 
										and B.TglPembukuan >= '$tglAwalDefault' 
										and B.TglPembukuan <= '$tglAkhirDefault' 
										and (B.NilaiPerolehan >=10000000 $KodeKa_b_2) 
										and B.Status_Validasi_Barang =1 and B.StatusTampil = 1 
										and B.kodeLokasi like '12%' 
									order by B.kodeKelompok";
						}else{
							$queryok ="SELECT B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku,
										B.MasaManfaat,B.UmurEkonomis,B.TahunPenyusutan,
										B.Aset_ID,B.noRegister,B.NilaiPerolehan, 
										B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
										B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
										B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
										B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
										K.Kode, K.Uraian
									FROM $tableNeracaBangunan as B, kelompok as k 
									WHERE B.kodeKelompok = k.Kode 
										and B.kodeSatker = '$Satker_ID' 
										and B.kondisi != '3' and B.kondisi != '4' and B.kondisi != '5'  
										and B.TglPerolehan >= '$tglAwalDefault' 
										and B.TglPerolehan <= '$tgldefault' 
										and B.TglPembukuan >= '$tglAwalDefault' 
										and B.TglPembukuan <= '$tglAkhirDefault' 
										and B.Status_Validasi_Barang =1 and B.StatusTampil = 1 
										and B.kodeLokasi like '12%' $KodeKa_b
								union all
									SELECT B.PenyusutanPerTahun,B.AkumulasiPenyusutan,B.NilaiBuku,
										B.MasaManfaat,B.UmurEkonomis,B.TahunPenyusutan,
										B.Aset_ID,B.noRegister,B.NilaiPerolehan, 
										B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
										B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
										B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
										B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,
										K.Kode, K.Uraian
									FROM $tableNeracaBangunan2 as B, kelompok as k 
									WHERE B.kodeKelompok = k.Kode 
										and B.kodeSatker = '$Satker_ID' 
										and B.kondisi != '3' and B.kondisi != '4' and B.kondisi != '5'
										and B.TglPerolehan >= '$tgldefault' 
										and B.TglPerolehan <= '$tglAkhirDefault' 
										and B.TglPembukuan >= '$tglAwalDefault' 
										and B.TglPembukuan <= '$tglAkhirDefault' 
										and (B.NilaiPerolehan >=10000000 $KodeKa_b_2) 
										and B.Status_Validasi_Barang =1 and B.StatusTampil = 1 
										and B.kodeLokasi like '12%'
									order by kodeKelompok";
						}	
					}elseif ($paramGol == '04') {
							$queryok ="SELECT J.PenyusutanPerTahun,J.AkumulasiPenyusutan,J.NilaiBuku,
											J.MasaManfaat,J.UmurEkonomis,J.TahunPenyusutan, 
											J.Aset_ID,J.noRegister,J.NilaiPerolehan,
											J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,
											J.kodeRuangan,
											J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
											J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, 
											J.StatusTanah,J.LuasJaringan,
											J.kondisi, J.kodeLokasi,
											K.Kode, K.Uraian
										FROM $tableNeracaJaringan as J, kelompok as k 
										WHERE J.kodeKelompok = k.Kode 
											and J.kodeSatker = '$Satker_ID' 
											and J.kondisi != '3' and J.kondisi != '4' and J.kondisi != '5' 
											and J.TglPerolehan >= '$tglAwalDefault' 
											and J.TglPerolehan <= '$tglAkhirDefault' 
											and J.TglPembukuan >= '$tglAwalDefault' 
											and J.TglPembukuan <= '$tglAkhirDefault'  
											and J.Status_Validasi_Barang =1 and J.StatusTampil = 1 
											and J.kodeLokasi like '12%'
										order by J.kodeKelompok ";
					}
					//pr($queryok);
					//exit;
					$result = $this->query($queryok) or die ($this->error('error'));
					$cek = mysql_num_rows($result);
					if($cek > 0){								
						while ($data = $this->fetch_object($result)){		
							$getdata[$Satker_ID][]= $data;
						}
					}else{
						//do nothing
					}			
				}
				// pr($getdata);
				// exit;
		if($getdata){
			return 	$getdata;
		}else{
			return false;
		}	
	}


	//public function ceckGol ($satker,$tglawalperolehan,$tglakhirperolehan,$paramGol,$TAHUN_AKTIF){
	public function ceckGol ($satker,$tglawalperolehan,$tglakhirperolehan,$paramGol,$tahunNeraca,$status){
			// echo $satker."-".$tglawalperolehan."-".$tglakhirperolehan."-".$paramGol;
			// exit;
			if($paramGol != '' && $paramGol != 'Lain' && $paramGol != 'NonAset'){
				// echo "bukan Lain";
				$query ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k 
					where k.Golongan=$paramGol and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null 
					order by k.Kode ";
			}elseif($paramGol == 'Lain'){
				// echo "Lain";
				/*$query ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where (k.kode not like '01%' and k.kode not like '07.21%' and k.kode not like '07.22%' and k.kode not like '07.23%' and k.kode not like '08%') and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null order by k.Kode ";*/

				$query ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where (k.kode not like '07.21%' and k.kode not like '07.22%' and k.kode not like '07.23%' and k.kode not like '08%') and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null order by k.Kode ";		
			}elseif($paramGol == 'NonAset'){
				$query ="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where (k.kode like '02%' or k.kode like '03%') and k.Bidang is not null and k.Kelompok is null and k.Sub is null and k.SubSub is null order by k.Kode ";		
			}	
			//Lain
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
			
			$tglCmpr = $TAHUN_AKTIF."-"."12-31";
			$expld = explode('-', $tglakhirperolehan);
			/*if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
			}else{
				if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
					$tahun = $TAHUN_AKTIF;
					$tableNeracaTanah 		= "neraca_tanah".$tahun;
					$tableNeracaMesin 		= "neraca_mesin".$tahun;
					$tableNeracaMesin2 		= "neraca_mesin".$tahun;
					$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
					$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
					$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
					$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
					$tableNeracaKdp 		= "neraca_kdp".$tahun;
				}else{
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}	
			}*/

			if($status == 1){
				$tahun = $tahunNeraca;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaMesin2 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				//$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaAsetLain	= "asetlain_ori";
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}else{
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}	
			}

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
							/*$queryok ="SELECT k.Uraian, t.Alamat, t.LuasTotal, t.NilaiPerolehan 
										FROM tanahView as t, kelompok as k 
										WHERE t.kodeKelompok =k.Kode and t.kodeSatker = '$Satker_ID' and t.TglPerolehan >= '$tglAwalDefault' and t.TglPerolehan <= '$tglAkhirDefault' and t.TglPembukuan >= '$tglAwalDefault' and t.TglPembukuan <= '$tglAkhirDefault' and t.Status_Validasi_Barang =1 and t.StatusTampil = 1 and t.kodeLokasi like '12%'
										$KodeKa_t order by t.kodeSatker,t.kodeKelompok";*/

							$queryok ="SELECT k.Uraian, t.Alamat, t.LuasTotal, t.NilaiPerolehan 
										FROM $tableNeracaTanah as t, kelompok as k 
										WHERE t.kodeKelompok =k.Kode and t.kodeSatker = '$Satker_ID' and t.TglPerolehan >= '$tglAwalDefault' and t.TglPerolehan <= '$tglAkhirDefault' and t.TglPembukuan >= '$tglAwalDefault' and t.TglPembukuan <= '$tglAkhirDefault' and t.Status_Validasi_Barang =1 and t.StatusTampil = 1 and t.kodeLokasi like '12%' and t.kondisi !='3' and t.kondisi != '4' and t.kondisi != '5'
										$KodeKa_t order by t.kodeSatker,t.kodeKelompok";			
						}elseif($paramGol == 02){
							
							if($thnFix < $thnDefault){
								/*$queryok="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
										  sum(m.PenyusutanPerTahun) as NilaiPP,sum(m.AkumulasiPenyusutan) as NilaiAP,sum(m.NilaiBuku) as NilaiBuku  
									   from mesin_ori as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and M.TglPerolehan >= '$tglAwalDefault' AND M.TglPerolehan <= '$tglAkhirDefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault' and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' group by m.kodeKelompok 
									   $KodeKa_m ORDER BY m.kodeKelompok ";*/

								$queryok="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
										  sum(m.PenyusutanPerTahun) as NilaiPP,sum(m.AkumulasiPenyusutan) as NilaiAP,sum(m.NilaiBuku) as NilaiBuku  
									   from $tableNeracaMesin as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and m.kondisi != '4' and m.kondisi != '5' and M.TglPerolehan >= '$tglAwalDefault' AND M.TglPerolehan <= '$tglAkhirDefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault' and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' group by m.kodeKelompok 
									   $KodeKa_m ORDER BY m.kodeKelompok ";  
							}elseif($thnceck >= $thnDefault){
								/*$queryok ="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
                                   sum(m.PenyusutanPerTahun) as NilaiPP,sum(m.AkumulasiPenyusutan) as NilaiAP,sum(m.NilaiBuku) as NilaiBuku 								
								   from mesin_ori as m,kelompok as k where 
								   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and m.TglPerolehan >= '$tglAwalDefault' and m.TglPerolehan <='$tglAkhirDefault' and m.TglPembukuan >= '$tglAwalDefault' and m.TglPembukuan <='$tglAkhirDefault' 
								   and (m.NilaiPerolehan >=300000 $KodeKa_m_2) and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' and m.kodeLokasi like '12%' 
								   group by m.kodeKelompok ";*/

								$queryok ="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
                                   sum(m.PenyusutanPerTahun) as NilaiPP,sum(m.AkumulasiPenyusutan) as NilaiAP,sum(m.NilaiBuku) as NilaiBuku from $tableNeracaMesin as m,kelompok as k where 
								   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and m.kondisi != '4' and m.kondisi != '5' and m.TglPerolehan >= '$tglAwalDefault' and m.TglPerolehan <='$tglAkhirDefault' and m.TglPembukuan >= '$tglAwalDefault' and m.TglPembukuan <='$tglAkhirDefault' 
								   and (m.NilaiPerolehan >=300000 $KodeKa_m_2) and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' and m.kodeLokasi like '12%' 
								   group by m.kodeKelompok "; 
							}else{
								/*$queryok ="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
									   sum(m.PenyusutanPerTahun) as NilaiPP,sum(m.AkumulasiPenyusutan) as NilaiAP,sum(m.NilaiBuku) as NilaiBuku 								
									   from mesin_ori as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker ='$Satker_ID' and m.kondisi != '3' and M.TglPerolehan >= '$tglAwalDefault' AND M.TglPerolehan < '$tgldefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault' and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' 
									   $KodeKa_m
									   group by m.kodeKelompok 
									   union all
									   select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
									   sum(m.PenyusutanPerTahun) as NilaiPP,sum(m.AkumulasiPenyusutan) as NilaiAP,sum(m.NilaiBuku) as NilaiBuku 		
									   from mesin_Rplctn as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and m.TglPerolehan >= '$tgldefault' and m.TglPerolehan <='$tglAkhirDefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault'  
									   and (m.NilaiPerolehan >=300000 $KodeKa_m_2) and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' 
									   group by m.kodeKelompok order by kodeKelompok";*/

									   //testing
									   $queryok ="select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
									   sum(m.PenyusutanPerTahun) as NilaiPP,sum(m.AkumulasiPenyusutan) as NilaiAP,
									   sum(m.NilaiBuku) as NilaiBuku 								
									   from $tableNeracaMesin as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker ='$Satker_ID' and m.kondisi != '3' and m.kondisi != '4' and m.kondisi != '5' and M.TglPerolehan >= '$tglAwalDefault' AND M.TglPerolehan < '$tgldefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault' and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' 
									   $KodeKa_m
									   group by m.kodeKelompok 
									   union all
									   select m.kodeKelompok,k.Uraian,count(m.Aset_ID) as jumlah,sum(m.NilaiPerolehan) as Nilai,
									   sum(m.PenyusutanPerTahun) as NilaiPP,
									   sum(m.AkumulasiPenyusutan) as NilaiAP,sum(m.NilaiBuku) as NilaiBuku 		
									   from $tableNeracaMesin2 as m,kelompok as k where 
									   m.kodeKelompok = k.Kode and m.kodeKelompok like '$data%' and m.kodeSatker = '$Satker_ID' and m.kondisi != '3' and m.kondisi != '4' and m.kondisi != '5' and m.TglPerolehan >= '$tgldefault' and m.TglPerolehan <='$tglAkhirDefault' and M.TglPembukuan >= '$tglAwalDefault' AND M.TglPembukuan <= '$tglAkhirDefault'  
									   and (m.NilaiPerolehan >=300000 $KodeKa_m_2) and m.Status_Validasi_Barang =1 and m.StatusTampil = 1 and m.kodeLokasi like '12%' 
									   group by m.kodeKelompok order by kodeKelompok";	   
							}
							
						}elseif($paramGol == 03){
							if($thnFix < $thnDefault){
								/*$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
										FROM bangunan_ori as b, kelompok as k 
										WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' AND b. TglPembukuan <= '$tglAkhirDefault'  and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'
										$KodeKa_b order by b.kodeKelompok ";*/

								$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
										FROM $tableNeracaBangunan as b, kelompok as k 
										WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' AND b. TglPembukuan <= '$tglAkhirDefault'  and b.kondisi != '3' and b.kondisi != '4' and b.kondisi != '5' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'
										$KodeKa_b order by b.kodeKelompok ";	
							}elseif($thnceck >= $thnDefault){
								/*$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
										FROM bangunan_ori as b, kelompok as k 
										WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' and b.TglPembukuan <= '$tglAkhirDefault' 
										and (b.NilaiPerolehan >=10000000 $KodeKa_b_2) and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'";*/

								$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
										FROM $tableNeracaBangunan as b, kelompok as k 
										WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' and b.TglPembukuan <= '$tglAkhirDefault' 
										and (b.NilaiPerolehan >=10000000 $KodeKa_b_2) and b.kondisi != '3' and b.kondisi != '4' and b.kondisi != '5' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'";		
							}else{
								/*$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
									FROM bangunan_ori as b, kelompok as k 
									WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tgldefault' and b.TglPembukuan >= '$tglAwalDefault' AND b.TglPembukuan <= '$tglAkhirDefault' and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%' 
									$KodeKa_b
									union all
									SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
									FROM bangunan_Rplctn as b, kelompok as k 
									WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tgldefault' and b.TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' AND b.TglPembukuan <= '$tglAkhirDefault' 
									and (b.NilaiPerolehan >=10000000 $KodeKa_b_2) and b.kondisi != '3' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'";*/	

								$queryok ="SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
									FROM $tableNeracaBangunan as b, kelompok as k 
									WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tglAwalDefault' AND b. TglPerolehan <= '$tgldefault' and b.TglPembukuan >= '$tglAwalDefault' AND b.TglPembukuan <= '$tglAkhirDefault' and b.kondisi != '3' and b.kondisi != '4' and b.kondisi != '5' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%' 
									$KodeKa_b
									union all
									SELECT k.Uraian, b.Alamat, b.LuasLantai, b.NilaiPerolehan,b.PenyusutanPerTahun,b.AkumulasiPenyusutan,b.NilaiBuku
									FROM $tableNeracaBangunan2 as b, kelompok as k 
									WHERE b.kodeKelompok =k.Kode and b.kodeKelompok like '$data%' and b.kodeSatker = '$Satker_ID' and b.TglPerolehan >= '$tgldefault' and b.TglPerolehan <= '$tglAkhirDefault' and b.TglPembukuan >= '$tglAwalDefault' AND b.TglPembukuan <= '$tglAkhirDefault' 
									and (b.NilaiPerolehan >=10000000 $KodeKa_b_2) and b.kondisi != '3' and b.kondisi != '4' and b.kondisi != '5' and b.Status_Validasi_Barang =1 and b.StatusTampil = 1 and b.kodeLokasi like '12%'";
							}
						}elseif($paramGol == 04){
							/*$queryok ="SELECT k.Uraian, j.Alamat, j.LuasJaringan, j.NilaiPerolehan,j.PenyusutanPerTahun,j.AkumulasiPenyusutan,j.NilaiBuku 
										FROM jaringan_ori as j, kelompok as k 
										WHERE j.kodeKelompok =k.Kode and j.kodeKelompok like '$data%' and j.kodeSatker = '$Satker_ID' and j.TglPerolehan >= '$tglAwalDefault' and j.TglPerolehan <= '$tglAkhirDefault' and j.TglPembukuan >= '$tglAwalDefault' and j.TglPembukuan <= '$tglAkhirDefault'  and j.kondisi != '3' and j.Status_Validasi_Barang =1 and j.StatusTampil = 1 and j.kodeLokasi like '12%'
										$KodeKa_j
										order by j.kodeKelompok ";*/
							$queryok ="SELECT k.Uraian, j.Alamat, j.LuasJaringan, j.NilaiPerolehan,j.PenyusutanPerTahun,j.AkumulasiPenyusutan,j.NilaiBuku 
										FROM $tableNeracaJaringan as j, kelompok as k 
										WHERE j.kodeKelompok =k.Kode and j.kodeKelompok like '$data%' and j.kodeSatker = '$Satker_ID' and j.TglPerolehan >= '$tglAwalDefault' and j.TglPerolehan <= '$tglAkhirDefault' and j.TglPembukuan >= '$tglAwalDefault' and j.TglPembukuan <= '$tglAkhirDefault'  and j.kondisi != '3' and j.kondisi != '4' and j.kondisi != '5' and j.Status_Validasi_Barang =1 and j.StatusTampil = 1 and j.kodeLokasi like '12%'
										$KodeKa_j
										order by j.kodeKelompok ";		
						
						}elseif($paramGol == 05){
							
							/*$queryok ="select al.kodeKelompok,k.Uraian,count(al.AsetLain_ID) as jumlah,sum(al.NilaiPerolehan) as Nilai 
									   from asetlain_ori as al,kelompok as k where 
									   al.kodeKelompok = k.Kode and al.kodeKelompok like '$data%' and al.kodeSatker = '$Satker_ID' and al.TglPerolehan >= '$tglAwalDefault' and al.TglPerolehan <= '$tglAkhirDefault' and al.TglPembukuan >= '$tglAwalDefault' and al.TglPembukuan <= '$tglAkhirDefault' and al.kondisi != '3' and al.Status_Validasi_Barang =1 and al.StatusTampil = 1 and al.kodeLokasi like '12%' 
									   $KodeKa_al
									   group by al.kodeKelompok ORDER BY al.AsetLain_ID ASC";*/
							$queryok ="select al.kodeKelompok,k.Uraian,count(al.Aset_ID) as jumlah,sum(al.NilaiPerolehan) as Nilai 
									   from $tableNeracaAsetLain as al,kelompok as k where 
									   al.kodeKelompok = k.Kode and al.kodeKelompok like '$data%' and al.kodeSatker = '$Satker_ID' and al.TglPerolehan >= '$tglAwalDefault' and al.TglPerolehan <= '$tglAkhirDefault' and al.TglPembukuan >= '$tglAwalDefault' and al.TglPembukuan <= '$tglAkhirDefault' and al.kondisi != '3' and al.kondisi != '4' and al.kondisi != '5' and al.Status_Validasi_Barang =1 and al.StatusTampil = 1 and al.kodeLokasi like '12%' 
									   $KodeKa_al
									   group by al.kodeKelompok ORDER BY al.Aset_ID ASC";		   
						}elseif($paramGol == 06){
							/*$queryok ="SELECT k.Uraian, kdp.Alamat, kdp.LuasLantai, kdp.NilaiPerolehan FROM kdp_ori as kdp, kelompok as k 
										WHERE kdp.kodeKelompok =k.Kode and kdp.kodeKelompok like '$data%' and kdp.kodeSatker = '$Satker_ID' and kdp.TglPerolehan >= '$tglAwalDefault' and kdp.TglPerolehan <= '$tglAkhirDefault' and kdp.TglPembukuan >= '$tglAwalDefault' and kdp.TglPembukuan <= '$tglAkhirDefault' and kdp.Status_Validasi_Barang =1 and kdp.StatusTampil = 1 and kdp.kodeLokasi like '12%'
										$KodeKa_kdp order by kdp.kodeKelompok ";*/
							$queryok ="SELECT k.Uraian, kdp.Alamat, kdp.LuasLantai, kdp.NilaiPerolehan FROM $tableNeracaKdp as kdp, kelompok as k 
										WHERE kdp.kodeKelompok =k.Kode and kdp.kodeKelompok like '$data%' and kdp.kodeSatker = '$Satker_ID' and kdp.TglPerolehan >= '$tglAwalDefault' and kdp.TglPerolehan <= '$tglAkhirDefault' and kdp.TglPembukuan >= '$tglAwalDefault' and kdp.TglPembukuan <= '$tglAkhirDefault' and kdp.Status_Validasi_Barang =1 and kdp.StatusTampil = 1 and kdp.kodeLokasi like '12%' and kdp.kondisi != '3' and kdp.kondisi != '4' and kdp.kondisi != '5'
										$KodeKa_kdp order by kdp.kodeKelompok ";			
						}elseif($paramGol == 'Lain'){

							$queryok="SELECT a.kodeKelompok, count(a.Aset_ID) as jml, sum(a.NilaiPerolehan) as Nilai,k.Uraian,
									  sum(a.PenyusutanPerTaun) as PP,sum(a.AkumulasiPenyusutan) as AP,sum(a.NilaiBuku) as NB  
										FROM aset_lain_3 as a, kelompok as k 
										WHERE a.kodeKelompok = k.Kode and a.kodeSatker LIKE '$Satker_ID' 
										AND (a.kondisi = 3 OR a.kondisi = 4 OR a.kondisi = 5)  AND a.kodeKelompok like '$data%' and a.TglPerolehan >= '$tglAwalDefault' and a.TglPerolehan <= '$tglAkhirDefault' and a.TglPembukuan >= '$tglAwalDefault' and a.TglPembukuan <= '$tglAkhirDefault' and a.	Status_Validasi_Barang = 1 and a.kodeLokasi like '12%' 
										$KodeKa_lain
										group by a.kodeKelompok";	

							//	Status_Validasi_Barang = 1		
						}elseif($paramGol == 'NonAset'){
							$queryok_non_1="SELECT a.kodeKelompok, count(a.Aset_ID) as jml, sum(a.NilaiPerolehan) as Nilai,k.Uraian 
										FROM mesin_ori as a, kelompok as k 
										WHERE a.kodeKelompok = k.Kode and a.kodeSatker LIKE '$Satker_ID' 
										AND a.kodeKelompok like '$data%' and a.TglPerolehan >= '$tgldefault' and a.TglPerolehan <= '$tglAkhirDefault' and a.TglPembukuan >= '$tglAwalDefault' and a.TglPembukuan <= '$tglAkhirDefault' and a.	Status_Validasi_Barang = 1 and a.kodeLokasi like '12%' 
										and a.StatusTampil=1  
										and (a.NilaiPerolehan < 300000)
										group by a.kodeKelompok";
										
							$queryok_non_2="SELECT a.kodeKelompok, count(a.Aset_ID) as jml, sum(a.NilaiPerolehan) as Nilai,k.Uraian 
										FROM bangunan_ori as a, kelompok as k 
										WHERE a.kodeKelompok = k.Kode and a.kodeSatker LIKE '$Satker_ID' 
										AND a.kodeKelompok like '$data%' and a.TglPerolehan >= '$tgldefault' and a.TglPerolehan <= '$tglAkhirDefault' and a.TglPembukuan >= '$tglAwalDefault' and a.TglPembukuan <= '$tglAkhirDefault' and a.	Status_Validasi_Barang = 1 and a.kodeLokasi like '12%' 
										and (a.NilaiPerolehan < 10000000) 
										 and a.StatusTampil=1 
										group by a.kodeKelompok";
						}
						/*echo "<br>";
						echo $queryok; 	
						echo "<br>";*/
						//exit;
						
						
						if($paramGol != 'NonAset'){
							$result = $this->query($queryok) or die ($this->error('error'));
							$temp = array();
							$getdatacstm = array();
							$cek = mysql_num_rows($result);
							if($cek > 0){								
								while ($data = $this->fetch_object($result))
								{	
									if($paramGol == 02 || $paramGol == 05){
									//extra edit start
									$temp[] = $data;
									$countTemp = count($temp);
									if($countTemp == 1){
										$getdatacstm[]= $data;
									}else{
										$getValueBeforeLast = $temp[$countTemp-2];
										$lastValueArrayKel=end($temp);
										
										if($lastValueArrayKel->kodeKelompok == $getValueBeforeLast->kodeKelompok)
										{
											$NewJumlah= $lastValueArrayKel->jumlah + $getValueBeforeLast->jumlah;
											$NewNilai = $lastValueArrayKel->Nilai + $getValueBeforeLast->Nilai;
											$NewNilaiPP = $lastValueArrayKel->NilaiPP + $getValueBeforeLast->NilaiPP;
											$NewNilaiAP = $lastValueArrayKel->NilaiAP + $getValueBeforeLast->NilaiAP;
											$NewNilaiNB = $lastValueArrayKel->NilaiBuku + $getValueBeforeLast->NilaiBuku;
											
											$obj = new stdObject();
											$obj->kodeKelompok = $getValueBeforeLast->kodeKelompok;
											$obj->Uraian = $getValueBeforeLast->Uraian;
											$obj->jumlah = $NewJumlah;
											$obj->Nilai = $NewNilai;
											$obj->NilaiPP = $NewNilaiPP;
											$obj->NilaiAP = $NewNilaiAP;
											$obj->NilaiBuku = $NewNilaiNB;
											
											array_pop($getdatacstm);
											$getdatacstm[] = $obj;
										}else{
											$getdatacstm[]= $lastValueArrayKel;
										}
											//no action
										} 
									}else{
										// $getdatacstm[]= $data;
										$getdata[$Satker_ID][$value][]= $data;
									}
								}
								
								if($paramGol == 02 || $paramGol == 05){
									$getdata[$Satker_ID][$value][]= $getdatacstm;
								}
								
							}
						}else{
							$ExeTable = array($queryok_non_1,$queryok_non_2);
							for ($i = 0; $i < count($ExeTable); $i++)
							{
									/*echo "query_$i =".$ExeTable[$i];
									echo "<br>";
									echo "<br><br/>";*/
									// exit;
									$result = $this->query($ExeTable[$i]) or die ($this->error('error dataQuery'));
									while ($data = $this->fetch_object($result))
									{
										$getdata[$Satker_ID][$value][]= $data;
									}
							}	
						}
						// pr($getdata);
						// exit;
					}
				}
				//pr($getdata);
				// exit;
		return 	$getdata;
	}
	
	//public function ceckneraca($Satker_ID,$tglawalperolehan,$tglakhirperolehan,$TAHUN_AKTIF){
	public function ceckneraca($Satker_ID,$tglawalperolehan,$tglakhirperolehan,$tahunNeraca,$status){
			
			$queryparentGol="select k.Kode, k.Golongan, k.Bidang, k.Uraian from kelompok k where k.Bidang is null and k.Kelompok is null and k.Sub is null and k.SubSub is null  and Kode != '08' order by k.Kode";
			// echo $queryparentGol;
			$resultparentGol = $this->query($queryparentGol) or die ($this->error('error'));	
			// $resultparentGol = $this->query($queryparentGol) or die ();	
			while ($data = $this->fetch_object($resultparentGol))
			{
				$dataparentgol[$data->Kode] = $data->Uraian;
			}
			
			$tgldefault = "2008-01-01";
			$thnDefault ="2008";
			
			$tglAwalDefault = $tglawalperolehan;
			$ceckTglAw = explode ('-',$tglAwalDefault);
			$thnceck = $ceckTglAw[0];
			
			$tglAkhirDefault = $tglakhirperolehan;
			$ceckTgl = explode ('-',$tglAkhirDefault);
			$thnFix = $ceckTgl[0];

			$tglCmpr = $TAHUN_AKTIF."-"."12-31";
			$expld = explode('-', $tglakhirperolehan);
			/*if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
			}else{
				if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
					$tahun = $TAHUN_AKTIF;
					$tableNeracaTanah 		= "neraca_tanah".$tahun;
					$tableNeracaMesin 		= "neraca_mesin".$tahun;
					$tableNeracaMesin2 		= "neraca_mesin".$tahun;
					$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
					$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
					$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
					$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
					$tableNeracaKdp 		= "neraca_kdp".$tahun;
				}else{
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}	
			}*/

			if($status == 1){
				$tahun = $tahunNeraca;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaMesin2 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}else{
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}	
			}
			//exit;
			// $KodeKa = "AND kodeKA = 1";
			$KodeKa = "OR kodeKA = 1";
			$KodeKaCondt1 = "AND kodeKA = 1";
				if($Satker_ID != ''){
				// foreach ($satker as $Satker_ID)
				// {
					//cek satker
					$splitKodeSatker = explode ('.',$Satker_ID);
					if(count($splitKodeSatker) == 4){	
						$paramSatker = "kodeSatker = '$Satker_ID'";
					}else{
						$paramSatker = "kodeSatker like '$Satker_ID%'";
					}
			
				
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
						// pr($datachildGol);
						// exit;
						foreach ($datachildGol as $data2=>$value2)
						{	
							$datafix =array();
							if($thnFix  < $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaTanah WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 
										and kondisi !='3' and kondisi != '4' and kondisi != '5'";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												   sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												   FROM mesin_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												   sum(PenyusutanPerTahun) as NilaiPP,
												   sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												   FROM $tableNeracaMesin WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												   	and kondisi !='3' and kondisi != '4' and kondisi != '5' 
												   	and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";			   
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													jumlah FROM bangunan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													jumlah FROM $tableNeracaBangunan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";				
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM jaringan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaJaringan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1";				
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaAsetLain WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5' 
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaKdp WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglProlehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1";
								}elseif($data2 == '07.22'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglProlehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='4' and Status_Validasi_Barang =1";
								}elseif($data2 == '07.24'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE kodeKelompok like '$data2%'  and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.25'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglProlehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='5' and Status_Validasi_Barang =1";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang is null";
								}
							}elseif($thnceck >= $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaTanah WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM mesin_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=300000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaMesin WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=300000 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";				
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM bangunan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=10000000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaBangunan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=10000000 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";				
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM jaringan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";*/
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaJaringan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1";				

								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaAsetLain WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5' 
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaKdp WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
										and kondisi ='3' and Status_Validasi_Barang =1 ";
								}elseif($data2 == '07.22'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='4' and Status_Validasi_Barang =1 ";
								}elseif($data2 == '07.24'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE kodeKelompok like '$data2%'  and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.25'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='5' and Status_Validasi_Barang =1 ";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang is null";
								}
							}
							else{
								//add and kodeKA != 0
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaTanah WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM mesin_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
													$KodeKaCondt1
													UNION ALL
													SELECT sum(NilaiPerolehan) as nilai,count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM mesin_Rplctn WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and (NilaiPerolehan >=300000 $KodeKa) and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";*/
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaMesin WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 
													$KodeKaCondt1
													UNION ALL
													SELECT sum(NilaiPerolehan) as nilai,count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaMesin2 WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and (NilaiPerolehan >=300000 $KodeKa) 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 ";				
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM bangunan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
												$KodeKaCondt1
												UNION ALL
												SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM bangunan_Rplctn WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and (NilaiPerolehan >=10000000 $KodeKa)  and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,
												sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM $tableNeracaBangunan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and kondisi !='3' and kondisi != '4' and kondisi != '5' 
												and Status_Validasi_Barang =1 and StatusTampil = 1 
												$KodeKaCondt1
												UNION ALL
												SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM $tableNeracaBangunan2 WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and (NilaiPerolehan >=10000000 $KodeKa)  
												and kondisi !='3' and kondisi != '4' and kondisi != '5' 
												and Status_Validasi_Barang =1 and StatusTampil = 1";				
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM jaringan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaJaringan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 ";				

								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaAsetLain WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5' 
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaKdp WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1 ";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.22'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='4' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.24'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE kodeKelompok like '$data2%'  and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.25'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='5' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang is null";
								}
								
							}
							/*echo "<br>";
							echo $queryresult;
							echo "<br>";*/
							$resultfix = $this->query($queryresult) or die ($this->error('error'));	
							if($resultfix){
							while ($data3 = $this->fetch_object($resultfix))
							{
								// $datafix[] = $data3->nilai;
								//total nilai perolehan 
								if($data3->nilai == NULL){
									$nilaiPrlhn = 0;
								}else{
									$nilaiPrlhn = $data3->nilai;
								}
								if($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11' || $data2 == '03.11' || $data2 == '03.12' || $data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									//total nilai penyusutan pertahun
									if($data3->NilaiPP == NULL){
										$nilaiPP = 0;
									}else{
										$nilaiPP = $data3->NilaiPP;
									}
									//total nilai akumulasi penyusutan
									if($data3->NilaiAP == NULL){
										$nilaiAP = 0;
									}else{
										$nilaiAP = $data3->NilaiAP;
									}
									//total nilai buku
									if($data3->NB == NULL){
										$nilaiBK = 0;
									}else{
										$nilaiBK = $data3->NB;
									}
								}else{
									/*$nilaiPP = 0;
									$nilaiAP = 0;
									$nilaiBK = 0;*/
                                                                        //total nilai penyusutan pertahun
									if($data3->NilaiPP == NULL ||$data3->NilaiPP == 0){
										$nilaiPP = 0;
									}else{
										$nilaiPP = $data3->NilaiPP;
									}
									//total nilai akumulasi penyusutan
									if($data3->NilaiAP == NULL ||$data3->NilaiAP==0){
										$nilaiAP = 0;
									}else{
										$nilaiAP = $data3->NilaiAP;
									}
									//total nilai buku
									if($data3->NB == NULL ||$data3->NB==0){
										$nilaiBK = 0;
									}else{
										$nilaiBK = $data3->NB;
									}
								}
								$datafix[] = $data3->jumlah."_".$nilaiPrlhn."_".$nilaiPP."_".$nilaiAP."_".$nilaiBK;
								// $datafix[] = $data3->jumlah."_".$nilaiPrlhn;
								// pr($datafix);
							}
								$getdata[$Satker_ID][$data."_".$value][$data2."_".$value2][]= $datafix;
								
						}
					 }
					}
				}else{
					$paramSatker = "kodeSatker like '$Satker_ID%'";	
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
						// pr($datachildGol);
						// exit;
						foreach ($datachildGol as $data2=>$value2)
						{	
							$datafix =array();
							if($thnFix  < $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaTanah WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												   sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												   FROM mesin_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												   sum(PenyusutanPerTahun) as NilaiPP,
												   sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												   FROM $tableNeracaMesin WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												   and kondisi !='3' and kondisi != '4' and kondisi != '5' 
												   and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1 ";			   
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													jumlah FROM bangunan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													jumlah FROM $tableNeracaBangunan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";				
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM jaringan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaJaringan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5'
													and Status_Validasi_Barang =1 and StatusTampil = 1";				
								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaAsetLain WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaKdp WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglProlehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1";
								}elseif($data2 == '07.22'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglProlehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='4' and Status_Validasi_Barang =1";
								}elseif($data2 == '07.24'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE kodeKelompok like '$data2%'  and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.25'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglProlehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='5' and Status_Validasi_Barang =1";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang is null";
								}
							}elseif($thnceck >= $thnDefault){
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaTanah WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM mesin_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=300000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaMesin WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=300000 
													and kondisi !='3' and kondisi != '4' and kondisi != '5'
													and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";				
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM bangunan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=10000000 and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";*/
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaBangunan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and NilaiPerolehan >=10000000 
													and kondisi !='3' and kondisi != '4' and kondisi != '5'
													and Status_Validasi_Barang =1 and StatusTampil = 1 $KodeKaCondt1";				
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM jaringan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";*/
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaJaringan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5'
													and Status_Validasi_Barang =1 and StatusTampil = 1";				

								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaAsetLain WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaKdp WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1 ";
								}elseif($data2 == '07.22'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='4' and Status_Validasi_Barang =1 ";
								}elseif($data2 == '07.24'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE kodeKelompok like '$data2%'  and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.25'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='5' and Status_Validasi_Barang =1 ";
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang is null";
								}
							}
							else{
								//add and kodeKA != 0
								if($data2 == '01.01'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaTanah WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and Status_Validasi_Barang =1 and StatusTampil = 1 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'";
								}elseif($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM mesin_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
													$KodeKaCondt1
													UNION ALL
													SELECT sum(NilaiPerolehan) as nilai,count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM mesin_Rplctn WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and (NilaiPerolehan >=300000 $KodeKa) and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";*/
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaMesin WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5' 
													and Status_Validasi_Barang =1 and StatusTampil = 1 
													$KodeKaCondt1
													UNION ALL
													SELECT sum(NilaiPerolehan) as nilai,count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaMesin2 WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and (NilaiPerolehan >=300000 $KodeKa) 
													and kondisi !='3' and kondisi != '4' and kondisi != '5'
													and Status_Validasi_Barang =1 and StatusTampil = 1 ";				
								}elseif($data2 == '03.11' || $data2 == '03.12'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM bangunan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 
												$KodeKaCondt1
												UNION ALL
												SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM bangunan_Rplctn WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and (NilaiPerolehan >=10000000 $KodeKa)  and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,
												sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM $tableNeracaBangunan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <'$tgldefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and kondisi !='3' and kondisi != '4' and kondisi != '5'
												and Status_Validasi_Barang =1 and StatusTampil = 1 
												$KodeKaCondt1
												UNION ALL
												SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
												sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
												FROM $tableNeracaBangunan2 WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tgldefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
												and (NilaiPerolehan >=10000000 $KodeKa)  
												and kondisi !='3' and kondisi != '4' and kondisi != '5'
												and Status_Validasi_Barang =1 and StatusTampil = 1";				
								}elseif($data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									/*$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM jaringan_ori WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi !='3' and Status_Validasi_Barang =1 and StatusTampil = 1 ";*/

									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,
													sum(PenyusutanPerTahun) as NilaiPP,
													sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
													FROM $tableNeracaJaringan WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
													and kondisi !='3' and kondisi != '4' and kondisi != '5'
													and Status_Validasi_Barang =1 and StatusTampil = 1 ";				

								}elseif($data2 == '05.17' || $data2 == '05.18' || $data2 == '05.19'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaAsetLain WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1";
								}elseif($data2 == '06.01' || $data2 == '06.20'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah FROM 
									$tableNeracaKdp WHERE kodeKelompok like '$data2%' and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' 
									and kondisi !='3' and kondisi != '4' and kondisi != '5'
									and Status_Validasi_Barang =1 and StatusTampil = 1 ";
								}elseif($data2 == '07.21'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.22'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='4' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.24'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE kodeKelompok like '$data2%'  and $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}elseif($data2 == '07.25'){
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and TglPembukuan >='$tglAwalDefault' and TglPembukuan <='$tglAkhirDefault' and kondisi ='5' and Status_Validasi_Barang =1  $KodeKaCondt1";
									//	Status_Validasi_Barang = 1
								}else{
									//kondisi tidak diketahui 
									$queryresult ="SELECT sum(NilaiPerolehan) as nilai, count(Aset_ID) as jumlah,sum(PenyusutanPerTaun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB  FROM aset_lain_3 WHERE $paramSatker and kodeLokasi like '12%' and TglPerolehan >='$tglAwalDefault' and TglPerolehan <='$tglAkhirDefault' and kondisi ='3' and Status_Validasi_Barang is null";
								}	
						}
							//echo "<br>";
							 //echo $queryresult;
							// echo "<br>";
							$resultfix = $this->query($queryresult) or die ($this->error('error'));	
							if($resultfix){
							while ($data3 = $this->fetch_object($resultfix))
							{
								// $datafix[] = $data3->nilai;
								//total nilai perolehan 
								if($data3->nilai == NULL){
									$nilaiPrlhn = 0;
								}else{
									$nilaiPrlhn = $data3->nilai;
								}
								if($data2 == '02.02' || $data2 == '02.03' || $data2 == '02.04' || $data2 == '02.05' || $data2 == '02.06' || $data2 == '02.07' || $data2 == '02.08' || $data2 == '02.09' || $data2 == '02.10' || $data2 == '02.11' || $data2 == '03.11' || $data2 == '03.12' || $data2 == '04.13' || $data2 == '04.14' || $data2 == '04.15' || $data2 == '04.16'){
									//total nilai penyusutan pertahun
									if($data3->NilaiPP == NULL){
										$nilaiPP = 0;
									}else{
										$nilaiPP = $data3->NilaiPP;
									}
									//total nilai akumulasi penyusutan
									if($data3->NilaiAP == NULL){
										$nilaiAP = 0;
									}else{
										$nilaiAP = $data3->NilaiAP;
									}
									//total nilai buku
									if($data3->NB == NULL){
										$nilaiBK = 0;
									}else{
										$nilaiBK = $data3->NB;
									}
								}else{
									/*$nilaiPP = 0;
									$nilaiAP = 0;
									$nilaiBK = 0;*/
                                                                        //total nilai penyusutan pertahun
									if($data3->NilaiPP == NULL ||$data3->NilaiPP == 0){
										$nilaiPP = 0;
									}else{
										$nilaiPP = $data3->NilaiPP;
									}
									//total nilai akumulasi penyusutan
									if($data3->NilaiAP == NULL ||$data3->NilaiAP==0){
										$nilaiAP = 0;
									}else{
										$nilaiAP = $data3->NilaiAP;
									}
									//total nilai buku
									if($data3->NB == NULL ||$data3->NB==0){
										$nilaiBK = 0;
									}else{
										$nilaiBK = $data3->NB;
									}
								}
								$datafix[] = $data3->jumlah."_".$nilaiPrlhn."_".$nilaiPP."_".$nilaiAP."_".$nilaiBK;
								// $datafix[] = $data3->jumlah."_".$nilaiPrlhn;
								// pr($datafix);
							}
								$getdata[$Satker_ID][$data."_".$value][$data2."_".$value2][]= $datafix;
								
						}
					 }
					}

				}
				// pr($getdata);
				// exit;
		return 	$getdata;
	}
	
	//public function barangskpd($satker_id,$tglawalperolehan,$tglakhirperolehan,$TAHUN_AKTIF){
	public function barangskpd($satker_id,$tglawalperolehan,$tglakhirperolehan,$tahunNeraca,$status){
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
				
				$paramSatker = "kode = '$satker_id'";
				$qsat = "SELECT kode,NamaSatker FROM satker WHERE $paramSatker and Kd_Ruang is null ";
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
		$tglDefault_Extra = '2008-01-01';
		$tglDefault = '2008-01-01';
		$thnDefault ="2008";
			
		$tglAwalDefault = $tglawalperolehan;
		$ceckTglAw = explode ('-',$tglAwalDefault);
		$thnceck = $ceckTglAw[0];
		
		$tglAkhirDefault = $tglakhirperolehan;
		$ceckTgl = explode ('-',$tglAkhirDefault);
		$thnFix = $ceckTgl[0];

		/*$tglCmpr = $TAHUN_AKTIF."-"."12-31";
		$expld = explode('-', $tglakhirperolehan);
		if($thnFix < $thnDefault || $thnceck >= $thnDefault){
				$tableNeracaTanah 		= "tanahView";
				$tableNeracaMesin 		= 'mesin_ori';
				$tableNeracaBangunan 	= 'bangunan_ori';
				$tableNeracaJaringan 	= "jaringan_ori";
				$tableNeracaAsetLain	= "asetlain_ori";
				$tableNeracaKdp 		= "kdp_ori";
		}else{
			if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
				$tahun = $TAHUN_AKTIF;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaMesin2 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				$tableNeracaTanah 		= "tanahView";
				$tableNeracaMesin 		= 'mesin_ori';
				$tableNeracaMesin2 		= 'mesin_Rplctn';
				$tableNeracaBangunan 	= 'bangunan_ori';
				$tableNeracaBangunan2 	= 'bangunan_Rplctn';
				$tableNeracaJaringan 	= "jaringan_ori";
				$tableNeracaAsetLain	= "asetlain_ori";
				$tableNeracaKdp 		= "kdp_ori";
			}	
		}*/
		
		if($status == 1){
				$tahun = $tahunNeraca;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaMesin2 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}else{
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}	
			}

		$KodeKa = "OR kodeKA = 1";
		$KodeKaCondt1 = "AND kodeKA = 1";
		
		// foreach ($satker as $data){
		foreach ($satker as $data=>$satker_id){
			//========add
			$splitSatker = explode ('.',$satker_id);
			if(count($splitSatker) == 4){	
				$paramSatkr = "kodeSatker = '$satker_id'";
			}else{
				$paramSatkr = "kodeSatker like '$satker_id%'";
			}
			//=========
			$query_01 = "SELECT sum(NilaiPerolehan) as nilai FROM $tableNeracaTanah
							WHERE $paramSatkr  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%' 
							and kondisi != '3' and kondisi != '4' and kondisi != '5' 
							";
			$query_02_default = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
							FROM $tableNeracaMesin
							WHERE $paramSatkr  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and kondisi != '3' and kondisi != '4'  and kondisi != '5'
							$KodeKaCondt1";


			$query_02_condt_1 = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
							FROM $tableNeracaMesin
							WHERE $paramSatkr  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and (NilaiPerolehan >= 300000 $KodeKa) 
							and kondisi != '3' and kondisi != '4' and kondisi != '5'";

						
			//modif				
			$query_02_condt_2 = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
							FROM $tableNeracaMesin
							WHERE $paramSatkr 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and kondisi != '3' and kondisi != '4' and kondisi != '5'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
							FROM $tableNeracaMesin2
							WHERE $paramSatkr 
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglakhirperolehan' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 300000 $KodeKa) 
							and kondisi != '3' and kondisi != '4' and kondisi != '5'";

							
			$query_03_default = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
							FROM $tableNeracaBangunan
							WHERE $paramSatkr
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and kondisi != '3' and kondisi != '4' and kondisi != '5' 
							$KodeKaCondt1";

			$query_03_condt_1 = "SELECT sum(NilaiPerolehan) as nilai,
						sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
						FROM $tableNeracaBangunan
						WHERE $paramSatkr 
						and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
						and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
						and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
						and (NilaiPerolehan >= 10000000 $KodeKa) 
						and kondisi != '3' and kondisi != '4' and kondisi != '5'";

			//modif			
			$query_03_condt_2 = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
							FROM $tableNeracaBangunan
							WHERE $paramSatkr
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and kondisi != '3' and kondisi != '4' and kondisi != '5'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
							FROM $tableNeracaBangunan2
							WHERE $paramSatkr 
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' 
							AND TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 10000000 $KodeKa) 
							and kondisi != '3' and kondisi != '4' and kondisi != '5'";					
							
			$query_04 = "SELECT sum(NilaiPerolehan) as nilai,
				sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NilaiBuku 
				FROM $tableNeracaJaringan
				WHERE $paramSatkr  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
				and kondisi != '3' and kondisi != '4' and kondisi != '5'";	
				
			$query_05 = "SELECT sum(NilaiPerolehan) as nilai FROM $tableNeracaAsetLain
				WHERE $paramSatkr  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
				and kondisi != '3' and kondisi != '4' and kondisi != '5'";	

			$query_06 = "SELECT sum(NilaiPerolehan) as nilai FROM $tableNeracaKdp
				WHERE $paramSatkr 
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
				and kondisi != '3' and kondisi != '4' and kondisi != '5'";
				
			$query_07 = "SELECT sum(NilaiPerolehan) as nilai FROM aset_lain_3
				WHERE $paramSatkr
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan < '$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and kodeLokasi like '12%' and (kondisi = '3' or kondisi = '4' or kondisi = '5')  $KodeKaCondt1 ";

			$query_extra_02= "SELECT sum(NilaiPerolehan) as nilai FROM mesin_extra
							WHERE $paramSatkr 
							and TglPerolehan >= '$tglDefault_Extra' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan < 300000) ";
							
			$query_extra_03= "SELECT sum(NilaiPerolehan) as nilai FROM bangunan_extra
							WHERE $paramSatkr
							and TglPerolehan >= '$tglDefault_Extra' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan < 10000000) ";			
			
			if($thnFix < $thnDefault){
				// echo "tahun kurang dari 2008";
				$queryALL = array($query_01,$query_02_default,$query_03_default,$query_04,$query_05,$query_06,$query_07);
			}elseif($thnceck >= $thnDefault){
				// echo "tahun diatas dari 2008";
				$queryALL = array($query_01,$query_02_condt_1,$query_03_condt_1,$query_04,$query_05,$query_06,$query_07,
									$query_extra_02,$query_extra_03);
			}else{
				// echo "<2008 >2008";
				$queryALL = array($query_01,$query_02_condt_2,$query_03_condt_2,$query_04,$query_05,$query_06,$query_07,
								 $query_extra_02,$query_extra_03);
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
						
						//tambah penyusutan
						if($dataAll->NilaiPP == NULL || $dataAll->NilaiPP == ''){
							$nilaiPP = 0;
						}else{
							$nilaiPP = $dataAll->NilaiPP;
						}
						
						if($dataAll->NilaiAP == NULL || $dataAll->NilaiAP == ''){
							$nilaiAP = 0;
						}else{
							$nilaiAP = $dataAll->NilaiAP;
						}
						
						if($dataAll->NilaiBuku == NULL || $dataAll->NilaiBuku == ''){
							$nilaiBK = 0;
						}else{
							$nilaiBK = $dataAll->NilaiBuku;
						}
						
						$getdata[$data][]= $nilai."_".$nilaiPP."_".$nilaiAP."_".$nilaiBK;
						// $getdata[$data][]= $nilai;
					}
					
				}
				
			}
		}
		return $getdata;
			
	}
	

	//public function barangupb($satker_id,$tglawalperolehan,$tglakhirperolehan,$TAHUN_AKTIF){
	public function barangupb($satker_id,$tglawalperolehan,$tglakhirperolehan,$tahunNeraca,$status){
		
		//sorting function
		function sort_subnets ($a, $b) {
		    $a_arr = explode('.', $a);
		    $b_arr = explode('.', $b);
		    foreach (range(0,4) as $i) {
		        if ( $a_arr[$i] < $b_arr[$i] ) {
		            return -1;
		        }
		        elseif ( $a_arr[$i] > $b_arr[$i] ) {
		            return 1;
		        }
		    }
		    return -1;
		}

		if($satker_id){
			$splitKodeSatker = explode ('.',$satker_id);
				if(count($splitKodeSatker) == 4){	
					$paramSatker = "kode = '$satker_id'";
					$paramSatker_rev = "kodeSatker = '$satker_id'";
				}else{
					$paramSatker = "kode like '$satker_id%'";
					$paramSatker_rev = "kodeSatker like '$satker_id%'";
				}
			
			//list satker
			$qsat = "SELECT kode,NamaSatker FROM satker where $paramSatker and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					$satker[] = $dtrsat->kode;
					//$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
				}	
			}

			//list satker yg ada datanya
			$qsatcmpr = "SELECT kodeSatker FROM aset where $paramSatker_rev and Status_Validasi_Barang = 1 
						GROUP BY kodeSatker";
			$rsatcmpr = $this->query($qsatcmpr) or die ($this->error());
			while($dtrsatcmpr = $this->fetch_object($rsatcmpr)){
				if($dtrsatcmpr != ''){
					$satkercmpr[] = $dtrsatcmpr->kodeSatker;
				}	
			}

			//list array skpd fix
			$result=array_intersect($satkercmpr,$satker);
			
			//sortir
			usort($result, 'sort_subnets');
			
			foreach ($result as $key => $value) {
				$qrstker = "SELECT kode,NamaSatker FROM satker where kode = '{$value}' and KodeUnit is not null 
							and Gudang is not null and Kd_Ruang is NULL";
				$exeqrstker = $this->query($qrstker) or die ($this->error());
				$dtrsat = $this->fetch_object($exeqrstker);
				$satker2[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
			}

		}else{
			//list all satker
			$qsat = "SELECT kode,NamaSatker FROM satker where kode is not null and KodeUnit is not null and Gudang is not null and Kd_Ruang is NULL ";
			$rsat = $this->query($qsat) or die ($this->error());
			while($dtrsat = $this->fetch_object($rsat)){
				if($dtrsat != ''){
					$satker[] = $dtrsat->kode;
					//$satker[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
				}	
			}
			
			//list satker yg ada datanya
			$qsatcmpr = "SELECT kodeSatker FROM aset where Status_Validasi_Barang = 1 GROUP BY kodeSatker";
			$rsatcmpr = $this->query($qsatcmpr) or die ($this->error());
			while($dtrsatcmpr = $this->fetch_object($rsatcmpr)){
				if($dtrsatcmpr != ''){
					$satkercmpr[] = $dtrsatcmpr->kodeSatker;
				}	
			}
			
			//list array skpd fix
			$result=array_intersect($satkercmpr,$satker);
			
			//sortir
			usort($result, 'sort_subnets');
			foreach ($result as $key => $value) {
				$qrstker = "SELECT kode,NamaSatker FROM satker where kode = '{$value}' and KodeUnit is not null 
							and Gudang is not null and Kd_Ruang is NULL";
				$exeqrstker = $this->query($qrstker) or die ($this->error());
				$dtrsat = $this->fetch_object($exeqrstker);
				$satker2[$dtrsat->kode."_".$dtrsat->NamaSatker] = $dtrsat->kode;
			}
		
		}
		//pr($satker2);
		//exit;
		$tglDefault_Extra = '2008-01-01';
		$tglDefault = '2008-01-01';
		$thnDefault ="2008";
			
		$tglAwalDefault = $tglawalperolehan;
		$ceckTglAw = explode ('-',$tglAwalDefault);
		$thnceck = $ceckTglAw[0];
		
		$tglAkhirDefault = $tglakhirperolehan;
		$ceckTgl = explode ('-',$tglAkhirDefault);
		$thnFix = $ceckTgl[0];
		
		/*$tglCmpr = $TAHUN_AKTIF."-"."12-31";
		$expld = explode('-', $tglakhirperolehan);
		if($thnFix < $thnDefault || $thnceck >= $thnDefault){
				$tableNeracaTanah 		= "tanahView";
				$tableNeracaMesin 		= 'mesin_ori';
				$tableNeracaBangunan 	= 'bangunan_ori';
				$tableNeracaJaringan 	= "jaringan_ori";
				$tableNeracaAsetLain	= "asetlain_ori";
				$tableNeracaKdp 		= "kdp_ori";
		}else{
			if($TAHUN_AKTIF == $expld[0] && $tglCmpr == $tglakhirperolehan){
				$tahun = $TAHUN_AKTIF;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaMesin2 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				$tableNeracaTanah 		= "tanahView";
				$tableNeracaMesin 		= 'mesin_ori';
				$tableNeracaMesin2 		= 'mesin_Rplctn';
				$tableNeracaBangunan 	= 'bangunan_ori';
				$tableNeracaBangunan2 	= 'bangunan_Rplctn';
				$tableNeracaJaringan 	= "jaringan_ori";
				$tableNeracaAsetLain	= "asetlain_ori";
				$tableNeracaKdp 		= "kdp_ori";
			}	
		}*/
		if($status == 1){
				$tahun = $tahunNeraca;
				$tableNeracaTanah 		= "neraca_tanah".$tahun;
				$tableNeracaMesin 		= "neraca_mesin".$tahun;
				$tableNeracaMesin2 		= "neraca_mesin".$tahun;
				$tableNeracaBangunan 	= "neraca_bangunan".$tahun;
				$tableNeracaBangunan2 	= "neraca_bangunan".$tahun;
				$tableNeracaJaringan 	= "neraca_jaringan".$tahun;
				$tableNeracaAsetLain 	= "neraca_asetlain".$tahun;
				$tableNeracaKdp 		= "neraca_kdp".$tahun;
			}else{
				if($thnFix < $thnDefault || $thnceck >= $thnDefault){
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}else{
					$tableNeracaTanah 		= "tanahView";
					$tableNeracaMesin 		= 'mesin_ori';
					$tableNeracaMesin2 		= 'mesin_Rplctn';
					$tableNeracaBangunan 	= 'bangunan_ori';
					$tableNeracaBangunan2 	= 'bangunan_Rplctn';	
					$tableNeracaJaringan 	= "jaringan_ori";
					$tableNeracaAsetLain	= "asetlain_ori";
					$tableNeracaKdp 		= "kdp_ori";
				}	
			}
		$KodeKa = "OR kodeKA = 1";
		$KodeKaCondt1 = "AND kodeKA = 1";
		
		foreach ($satker2 as $data=>$satker_id){
		
			$query_01 = "SELECT sum(NilaiPerolehan) as nilai FROM $tableNeracaTanah
							WHERE kodeSatker = '$satker_id'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%' 
							and kondisi != '3' and kondisi != '4' and kondisi != '5' 
							";
			$query_02_default = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
							FROM $tableNeracaMesin
							WHERE kodeSatker = '$satker_id'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and kondisi != '3' and kondisi != '4' and kondisi != '5'
							$KodeKaCondt1";			
							
			$query_02_condt_1 = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
							FROM $tableNeracaMesin
							WHERE kodeSatker = '$satker_id'  
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and (NilaiPerolehan >= 300000 $KodeKa) 
							and kondisi != '3' and kondisi != '4' and kondisi != '5'";			
			
			//modif			
			$query_02_condt_2 = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
							FROM $tableNeracaMesin
							WHERE kodeSatker = '$satker_id' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and kondisi != '3' and kondisi != '4' and kondisi != '5'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
							FROM $tableNeracaMesin2
							WHERE kodeSatker = '$satker_id'  
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglakhirperolehan' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 300000 $KodeKa) 
							and kondisi != '3' and kondisi != '4' and kondisi != '5'";			
			
			$query_03_default = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
							FROM $tableNeracaBangunan
							WHERE kodeSatker = '$satker_id' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							$KodeKaCondt1 
							and kondisi != '3' and kondisi != '4' and kondisi != '5'";
							
			$query_03_condt_1 = "SELECT sum(NilaiPerolehan) as nilai,
						sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
						FROM $tableNeracaBangunan
						WHERE $kodeKelompok kodeSatker = '$satker_id'  
						and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault' 
						and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
						and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
						and (NilaiPerolehan >= 10000000 $KodeKa) 
						and kondisi != '3' and kondisi != '4' and kondisi != '5'";		
			//modif				
			$query_03_condt_2 = "SELECT sum(NilaiPerolehan) as nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
							FROM $tableNeracaBangunan
							WHERE kodeSatker = '$satker_id' 
							and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan < '$tglDefault' 
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 
							and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
							and kondisi != '3' and kondisi != '4' and kondisi != '5'
							$KodeKaCondt1
							union all 
							SELECT sum(NilaiPerolehan) as Nilai,
							sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
							FROM $tableNeracaBangunan2
							WHERE kodeSatker = '$satker_id' 
							and TglPerolehan >= '$tglDefault' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan >= 10000000 $KodeKa) 
							and kondisi != '3' and kondisi != '4' and kondisi != '5'";				
							
			$query_04 = "SELECT sum(NilaiPerolehan) as nilai,
				sum(PenyusutanPerTahun) as NilaiPP,sum(AkumulasiPenyusutan) as NilaiAP,sum(NilaiBuku) as NB 
				FROM $tableNeracaJaringan
				WHERE kodeSatker = '$satker_id'  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%' 
				and kondisi != '3' and kondisi != '4' and kondisi != '5'";
				
			$query_05 = "SELECT sum(NilaiPerolehan) as nilai FROM $tableNeracaAsetLain
				WHERE kodeSatker = '$satker_id'  
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
				and kondisi != '3' and kondisi != '4' and kondisi != '5' ";	

			$query_06 = "SELECT sum(NilaiPerolehan) as nilai FROM $tableNeracaKdp
				WHERE kodeSatker = '$satker_id' 
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <='$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and StatusTampil = 1 and kodeLokasi like '12%'
				and kondisi != '3' and kondisi != '4' and kondisi != '5'";
				
			$query_07 = "SELECT sum(NilaiPerolehan) as nilai FROM aset_lain_3
				WHERE kodeSatker = '$satker_id' 
				and TglPerolehan >= '$tglAwalDefault' AND TglPerolehan <= '$tglAkhirDefault'
				and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan < '$tglAkhirDefault' 
				and Status_Validasi_Barang =1 and (kondisi = '3' or kondisi = '4' or kondisi = '5') and kodeLokasi like '12%' $KodeKaCondt1";	
			
			//edit upb untuk extra
			$query_extra_02= "SELECT sum(NilaiPerolehan) as nilai FROM mesin_extra
							WHERE kodeSatker = '$satker_id' 
							and TglPerolehan >= '$tglDefault_Extra' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' AND 
							TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan < 300000) ";
							
			$query_extra_03= "SELECT sum(NilaiPerolehan) as nilai FROM bangunan_extra
							WHERE kodeSatker ='$satker_id' 
							and TglPerolehan >= '$tglDefault_Extra' AND TglPerolehan <='$tglAkhirDefault'
							and TglPembukuan >= '$tglAwalDefault' AND TglPembukuan <= '$tglAkhirDefault' 						
							and Status_Validasi_Barang =1 and StatusTampil = 1 
							and kodeLokasi like '12%' 
							and (NilaiPerolehan < 10000000) ";

			
			if($thnFix < $thnDefault){
				// echo "tahun kurang dari 2008";
				$queryALL = array($query_01,$query_02_default,$query_03_default,$query_04,$query_05,$query_06,$query_07);
			}elseif($thnceck >= $thnDefault){
				// echo "tahun diatas dari 2008";
				$queryALL = array($query_01,$query_02_condt_1,$query_03_condt_1,$query_04,$query_05,$query_06,$query_07,
								  $query_extra_02,$query_extra_03);
			}else{
				// echo "<2008 >2008";
				$queryALL = array($query_01,$query_02_condt_2,$query_03_condt_2,$query_04,$query_05,$query_06,$query_07,
								 $query_extra_02,$query_extra_03);
			}
		/*$hitung  = count($queryALL);
		echo "hitung".$hitung;
		pr($queryALL);*/
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
						if($dataAll->nilai == NULL || $dataAll->nilai == ''){
							// echo "klo null";
							// echo "<br/>";
							$nilai = 0;
						}else{
							// echo "klo isi";
							// echo "<br/>";
							$nilai = $dataAll->nilai;
						}
						//tambah penyusutan
						if($dataAll->NilaiPP == NULL || $dataAll->NilaiPP == ''){
							$nilaiPP = 0;
						}else{
							$nilaiPP = $dataAll->NilaiPP;
						}
						
						if($dataAll->NilaiAP == NULL || $dataAll->NilaiAP == ''){
							$nilaiAP = 0;
						}else{
							$nilaiAP = $dataAll->NilaiAP;
						}
						
						if($dataAll->NB == NULL || $dataAll->NB == ''){
							$nilaiBK = 0;
						}else{
							$nilaiBK = $dataAll->NB;
						}
						
						
						$getdata[$data][]= $nilai."_".$nilaiPP."_".$nilaiAP."_".$nilaiBK;
					}
					
				}
			}
			// pr($data);
		}
		// pr($getdata);
		// exit;
		return $getdata;
			
	}
	public function HistoryAset(){
	
	}
	
	//revisi
	public function MutasiBarangSmplCustome($skpd_id,$tglawalperolehan,$tglakhirperolehan,$param_Filter,$param_Filter_detail){
		
		/*pr($skpd_id);
		pr($tglawalperolehan);
		pr($tglakhirperolehan);
		pr($param_Filter);
		pr($param_Filter_detail);*/
		//exit;
		//cek kodesatker
		$splitKodeSatker = explode ('.',$skpd_id);
		if(count($splitKodeSatker) == 4){	
			$paramSatker = "kodeSatker = '$skpd_id'";
			$paramSatker_mts_tr = "SatkerAwal = '$skpd_id'";
			$paramSatker_mts_rc = "SatkerTujuan = '$skpd_id'";
			
		}else{
			$paramSatker = "kodeSatker like '$skpd_id%'";
			$paramSatker_mts_tr = "SatkerAwal like '$skpd_id%'";
			$paramSatker_mts_rc = "SatkerTujuan like '$skpd_id%'";
			
		}	
		
		//param filter 
		//1 : belanja modal aset baru
		//2 : belanja jasa aset baru
		//3 : hibah
		//4 : inventarisasi
		//5 : belanja modal kapitalisasi
		//6 : belanja jasa kapitalisasi
		//7 : koreksi
		//8 : penghapusan sebagian
		//9 : Penghapusan Pemindahtanganan
		//10 : Penghapusan Pemusnahan
		//11 : Mutasi Bertambah
		//12 : Mutasi Berkurang
		//13 : Transfer Kapitalisasi Bertambah 
		//14 : Transfer Kapitalisasi Berkurang 
		//15 : Belanja Modal Reklas Bertambah 
		//16 : Belanja Modal Reklas Berkurang 

		//$param_Filter =  '5';
		/*echo "paramater = ".$param_Filter;
		echo "<br>";
		echo "paramater detail = ".$param_Filter_detail;
		echo "<br>";*/
		if($param_Filter == 1){
			//1 : belanja modal aset baru
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 0 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND t.jenis_belanja = 0
						    AND ast.noKontrak is not null						   	
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif($param_Filter == 2){
			//2 : belanja jasa aset baru
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 0 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND t.jenis_belanja = 1
						    AND ast.noKontrak is not null						   	
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif($param_Filter == 3){
			//3 : hibah
			if($param_Filter_detail == 1){
				//Hibah BOS
				$param_ext = " AND t.AsalUsul = 'Hibah BOS' "; 
			}elseif ($param_Filter_detail == 2) {
				//Hibah Komite
				$param_ext = " AND t.AsalUsul = 'Hibah Komite' ";
			}elseif ($param_Filter_detail == 3) {
				//Hibah Pusat
				$param_ext = " AND t.AsalUsul = 'Hibah Pusat' ";
			}elseif ($param_Filter_detail == 4) {
				//Hibah Provinsi 
				$param_ext = " AND t.AsalUsul = 'Hibah Provinsi' ";
			}elseif ($param_Filter_detail == 5) {
				//Hibah Pihak ke-3
				$param_ext = " AND t.AsalUsul = 'Hibah Pihak ke-3' "; 
			}elseif ($param_Filter_detail == 6) {
				//Sitaan / Rampasan
				$param_ext = " AND t.AsalUsul = 'Sitaan/ Rampasan' "; 
			}else{
				$param_ext = "";
			}
			/*$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 0 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND ast.noKontrak is null 
						    AND	t.AsalUsul != 'Inventarisasi' AND t.AsalUsul != 'Pembelian'  AND t.AsalUsul != 'perolehan sah lainnya'		   	
						    order by l.Aset_ID ASC";*/
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 0 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND ast.noKontrak is null 
						    $param_ext
						    order by l.kodeSatker,l.kodeKelompok ASC";			    
		}elseif($param_Filter == 4){
			//4 : inventarisasi
			if($param_Filter_detail == 1){
				//Inventarisasi
				$param_ext = "AND (t.AsalUsul = 'Pembelian' OR t.AsalUsul = 'Inventarisasi')"; 
			}elseif ($param_Filter_detail == 2) {
				//perolehan sah lainnya
				$param_ext = "AND t.AsalUsul = 'perolehan sah lainnya' ";
			}else{
				$param_ext = "";
			}
			/*$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 0 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND ast.noKontrak is null 
						    AND	(t.AsalUsul = 'Inventarisasi' OR t.AsalUsul = 'Pembelian'  OR t.AsalUsul = 'perolehan sah lainnya')		   	
						    order by l.Aset_ID ASC";*/

			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 0 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND ast.noKontrak is null  $param_ext		   	
						    order by l.kodeSatker,l.kodeKelompok ASC";			    
		}elseif($param_Filter == 5){
			//5 : belanja modal kapitalisasi
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 2 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND (l.GUID = '' OR l.GUID = 'Modal')   
						    order by l.kodeSatker,l.Aset_ID,l.kodeKelompok ASC";
		}elseif($param_Filter == 6){
			//6 : belanja jasa kapitalisasi
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 2 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND l.GUID = 'Jasa'   
						    order by l.kodeSatker,l.Aset_ID,kodeKelompok ASC";
		}elseif($param_Filter == 7){
			//7 : koreksi
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 21 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif($param_Filter == 8){
			//8: penghapusan sebagian
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 7 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif($param_Filter == 9){
			//9: Penghapusan Pemindahtanganan
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 26 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 0 AND t.StatusTampil = 0 
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif($param_Filter == 10){
			//10: Penghapusan Pemusnahan
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 27 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 0 AND t.StatusTampil = 0 
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif ($param_Filter == 11) {
			/*
			11 : Mutasi Bertambah
			Kode Riwayat
			3 = Pindah SKPD (+) SatkerTujuan = KodeSatker
			parameter dengan SatkerTujuan(view mutasi) untuk barang bertambah
			*/
			$paramLog_mts_rc =  "l.TglPerubahan >'$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = 3 and l.Kd_Riwayat != 77 and mt.$paramSatker_mts_rc
						   order by l.kodeSatker,l.kodeKelompok ASC";
		
		}elseif ($param_Filter == 12) {
			/*
			12 : Mutasi Berkurang
			Kode Riwayat
			3 = Pindah SKPD (-) SatkerAwal != KodeSatker
			parameter dengan SatkerAwal(view mutasi) untuk barang berkurang
			*/
			$paramLog_mts_tr = "l.TglPerubahan >'$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = 3 and l.Kd_Riwayat != 77 and mt.$paramSatker_mts_tr
						   order by l.kodeSatker,l.kodeKelompok ASC";
		
		}elseif ($param_Filter == 13) {
			/*
			13 : Transfer Kapitalisasi Bertambah
			Kode Riwayat
			28 = Transfer Kapitalisasi (+) jika Aset_ID_Penambahan ==0
			*/
			$paramLogTransferKapitalisasiTambah =  "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = '28' and l.$paramSatker 
						   and l.Aset_ID_Penambahan = '0' and action like 'Aset Penambahan kapitalisasi Mutasi%' order by 
						   l.kodeSatker,l.kodeKelompok ASC";
		}elseif ($param_Filter == 14) {
			/*
			14 : Transfer Kapitalisasi Berkurang
			Kode Riwayat
			28 = Transfer Kapitalisasi (-) jika Aset_ID_Penambahan !=0
			*/
			$paramLogTransferKapitalisasiKurang =  "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = '28' and l.$paramSatker 
						   and l.Aset_ID_Penambahan != '0' and action like 'Sukses kapitalisasi Mutasi%'
						   order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif ($param_Filter == 15) {
			//15 : belanja modal reklas tambah
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 35 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 1 AND t.StatusTampil = 1 
						    AND t.jenis_belanja = 0
						    AND ast.noKontrak is not null						   	
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}elseif ($param_Filter == 16) {
			//16 : belanja modal reklas kurang
			$paramLog = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						    AND l.Kd_Riwayat = 36 AND l.Kd_Riwayat != 77 AND l.$paramSatker 
						    AND t.Status_Validasi_Barang = 0 AND t.StatusTampil = 0 
						    AND t.jenis_belanja = 0
						    AND ast.noKontrak is not null						   	
						    order by l.kodeSatker,l.kodeKelompok ASC";
		}

		/*
		Kode Riwayat
		0 = Data Baru
		*/ 
		$log_tanah = "select l.*,ast.noKontrak from log_tanah as l 
							inner join tanah as t on l.Aset_ID = t.Aset_ID 
							inner join aset as ast on ast.Aset_ID = l.Aset_ID
							where $paramLog";

		$log_mesin = "select l.*,ast.noKontrak from log_mesin as l
						inner join mesin as t on l.Aset_ID = t.Aset_ID 
						inner join aset as ast on ast.Aset_ID = l.Aset_ID
						where $paramLog";			    

		$log_bangunan = "select l.*,ast.noKontrak from log_bangunan as l 
						inner join bangunan as t on l.Aset_ID = t.Aset_ID 
						inner join aset as ast on ast.Aset_ID = l.Aset_ID
						where $paramLog ";
						
		$log_jaringan = "select l.*,ast.noKontrak from log_jaringan as l 
						inner join jaringan as t on l.Aset_ID = t.Aset_ID 
						inner join aset as ast on ast.Aset_ID = l.Aset_ID
						where $paramLog ";
						
		$log_asetlain = "select l.*,ast.noKontrak from log_asetlain as l 
						inner join asetlain as t on l.Aset_ID = t.Aset_ID 
						inner join aset as ast on ast.Aset_ID = l.Aset_ID
						where $paramLog";
						
		$log_kdp = "select l.*,ast.noKontrak from log_kdp as l 
						inner join kdp as t on l.Aset_ID = t.Aset_ID 
						inner join aset as ast on ast.Aset_ID = l.Aset_ID
						where $paramLog";			
		//====================================================================
							
		/*
		Kode Riwayat
		2  = kapitalisasi
		7  = Penghapusan Sebagian
		21 = Koreksi Nilai
		26 = Penghapusan Pemindahtanganan
		27 = Penghapusan Pemusnahan
		*/
		$log_tanah_kp = "select l.* from log_tanah as l 
							inner join tanah as t on l.Aset_ID = t.Aset_ID 
							where $paramLog";

		$log_mesin_kp = "select l.* from log_mesin as l
						inner join mesin as t on l.Aset_ID = t.Aset_ID 
						where $paramLog";			    

		$log_bangunan_kp = "select l.* from log_bangunan as l 
						inner join bangunan as t on l.Aset_ID = t.Aset_ID 
						where $paramLog ";
						
		$log_jaringan_kp = "select l.* from log_jaringan as l 
						inner join jaringan as t on l.Aset_ID = t.Aset_ID 
						where $paramLog ";
						
		$log_asetlain_kp = "select l.* from log_asetlain as l 
						inner join asetlain as t on l.Aset_ID = t.Aset_ID 
						where $paramLog";
						
		$log_kdp_kp = "select l.* from log_kdp as l 
						inner join kdp as t on l.Aset_ID = t.Aset_ID 
						where $paramLog";					
		//====================================================================				
		
		/*
		Kode Riwayat
		3 = Pindah SKPD (+) SatkerTujuan = KodeSatker
		*/
		$log_tanah_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_tanah as l 
					inner join view_mutasi_tanah as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_mesin_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_mesin as l 
					inner join view_mutasi_mesin as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_bangunan_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_bangunan as l 
					inner join view_mutasi_bangunan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_jaringan_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_jaringan as l 
					inner join view_mutasi_jaringan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";	
			
		$log_asetlain_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_asetlain as l 
					inner join view_mutasi_asetlain as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_kdp_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_kdp as l 
					inner join view_mutasi_kdp as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";	
		//====================================================================
		
		/*
		Kode Riwayat
		3 = Pindah SKPD (-) SatkerAwal != KodeSatker
		*/
		$log_tanah_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_tanah as l 
					inner join view_mutasi_tanah as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_mesin_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_mesin as l 
					inner join view_mutasi_mesin as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_bangunan_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_bangunan as l 
					inner join view_mutasi_bangunan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_jaringan_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_jaringan as l 
					inner join view_mutasi_jaringan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";	
			
		$log_asetlain_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_asetlain as l 
					inner join view_mutasi_asetlain as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_kdp_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_kdp as l 
					inner join view_mutasi_kdp as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";	
		//====================================================================
		
		/*
		Kode Riwayat
		28 = Transfer Kapitalisasi (+) jika Aset_ID_Penambahan ==0
		*/
		$log_tanah_tr_kp="select l.* from log_tanah as l 
					where $paramLogTransferKapitalisasiTambah ";
		
		$log_mesin_tr_kp="select l.* from log_mesin as l 
					where $paramLogTransferKapitalisasiTambah ";
		
		$log_bangunan_tr_kp="select l.*  from log_bangunan as l 
					where $paramLogTransferKapitalisasiTambah";
		
		$log_jaringan_tr_kp="select l.* from log_jaringan as l 
					where $paramLogTransferKapitalisasiTambah";	
			
		$log_asetlain_tr_kp="select l.* from log_asetlain as l 
					where $paramLogTransferKapitalisasiTambah";
		
		$log_kdp_tr_kp="select l.* from log_kdp as l 
					where $paramLogTransferKapitalisasiTambah";			
		//====================================================================
		
		/*
		Kode Riwayat
		28 = Transfer Kapitalisasi (-) jika Aset_ID_Penambahan !=0
		*/
		
		$log_tanah_rc_kp="select l.* from log_tanah as l 
					where $paramLogTransferKapitalisasiKurang ";
		
		$log_mesin_rc_kp="select l.* from log_mesin as l 
					where $paramLogTransferKapitalisasiKurang ";
		
		$log_bangunan_rc_kp="select l.*  from log_bangunan as l 
					where $paramLogTransferKapitalisasiKurang";
		
		$log_jaringan_rc_kp="select l.* from log_jaringan as l 
					where $paramLogTransferKapitalisasiKurang";	
			
		$log_asetlain_rc_kp="select l.* from log_asetlain as l 
					where $paramLogTransferKapitalisasiKurang";
		
		$log_kdp_rc_kp="select l.* from log_kdp as l 
					where $paramLogTransferKapitalisasiKurang";	

					
					
		if($param_Filter == 1 || $param_Filter == 2 || $param_Filter == 3 || $param_Filter == 4 || $param_Filter == 15 || $param_Filter == 16){
			//1 : belanja modal aset baru
			//2 : belanja jasa aset baru
			//3 : hibah
			//4 : inventarisasi
			//15 : belanja modal reklas tambah
			//16 : belanja modal reklas kurang

			$queryALL = array($log_tanah,$log_mesin,$log_bangunan,$log_jaringan,$log_asetlain,$log_kdp);
		
		}elseif ($param_Filter == 5 || $param_Filter == 6 || $param_Filter == 7 || $param_Filter == 8 || $param_Filter == 9 || $param_Filter == 10) {
			
			//5 : belanja modal kapitalisasi
			//6 : belanja jasa kapitalisasi
			//7 : koreksi
			//8 : penghapusan sebagian
			//9 : Penghapusan Pemindahtanganan
			//10 : Penghapusan Pemusnahan

			$queryALL = array($log_tanah_kp,$log_mesin_kp,$log_bangunan_kp,$log_jaringan_kp,$log_asetlain_kp,$log_kdp_kp);

		}elseif ($param_Filter == 11) {
			//11 : Mutasi Bertambah
		
			$queryALL = array($log_tanah_rc,$log_mesin_rc,$log_bangunan_rc,$log_jaringan_rc,$log_asetlain_rc,$log_kdp_rc);

		}elseif ($param_Filter == 12) {
			//12 : Mutasi Berkurang
		
			$queryALL = array($log_tanah_tr,$log_mesin_tr,$log_bangunan_tr,$log_jaringan_tr,$log_asetlain_tr,$log_kdp_tr);

		}elseif ($param_Filter == 13) {
			//13 : Transfer Kapitalisasi Bertambah
		
			$queryALL = array($log_tanah_tr_kp,$log_mesin_tr_kp,$log_bangunan_tr_kp,$log_jaringan_tr_kp,$log_asetlain_tr_kp,$log_kdp_tr_kp);

		}elseif ($param_Filter == 14) {
			//14 : Transfer Kapitalisasi Berkurang
		
			$queryALL = array($log_tanah_rc_kp,$log_mesin_rc_kp,$log_bangunan_rc_kp,$log_jaringan_rc_kp,$log_asetlain_rc_kp,$log_kdp_rc_kp);

		}			
					
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
		
		//pr($getdata);
		//exit;
		//if($getdata){ 
			return $getdata;
		//}		

		//exit();
	}


	//cara sederhana mutasi barang dari ka andreas
	public function MutasiBarangSmpl($skpd_id,$tglawalperolehan,$tglakhirperolehan){
		//new code
		//set parameter
		//parameter dengan kodeSatker(semua log)
		$splitKodeSatker = explode ('.',$skpd_id);
		if(count($splitKodeSatker) == 4){	
			$paramSatker = "kodeSatker = '$skpd_id'";
			$paramSatker_mts_tr = "SatkerAwal = '$skpd_id'";
			$paramSatker_mts_rc = "SatkerTujuan = '$skpd_id'";
			
		}else{
			$paramSatker = "kodeSatker like '$skpd_id%'";
			$paramSatker_mts_tr = "SatkerAwal like '$skpd_id%'";
			$paramSatker_mts_rc = "SatkerTujuan like '$skpd_id%'";
			
		}	
		//tabel log inner join tabel kib dengan status validasi barang = 1
		/*
		Kode Riwayat
		0 = Data baru
		2 = Ubah Kapitalisasi
		7 = Penghapusan Sebagian
		21 = Koreksi Nilai
		26 = Penghapusan Pemindahtanganan
		27 = Penghapusan Pemusnahan
		*/
		//l.TglPembukuan >='$tglawalperolehan' AND l.TglPembukuan <='$tglakhirperolehan' AND
		$paramLog 		= "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat in (0,2,7,21,26,27) and l.Kd_Riwayat != 77 and l.$paramSatker order by l.Aset_ID ASC";
						   
				   
		//l.Kd_Riwayat in (0,2,7,21,26,27)
		/*
		Kode Riwayat
		3 = Pindah SKPD (-) SatkerAwal != KodeSatker
		*/
		//tabel log inner join tabel viewmutasi
		//parameter dengan SatkerAwal(view mutasi) untuk barang berkurang
		// l.TglPembukuan >='$tglawalperolehan' AND l.TglPembukuan <='$tglakhirperolehan' AND
		$paramLog_mts_tr = "l.TglPerubahan >'$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat in (3) and l.Kd_Riwayat != 77 and mt.$paramSatker_mts_tr ";
		
		/*
		Kode Riwayat
		3 = Pindah SKPD (+) SatkerTujuan = KodeSatker
		*/
		//tabel log inner join tabel viewmutasi
		//parameter dengan SatkerTujuan(view mutasi) untuk barang bertambah
		//l.TglPembukuan >='$tglawalperolehan' AND l.TglPembukuan <='$tglakhirperolehan'  AND 
		$paramLog_mts_rc =  "l.TglPerubahan >'$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat in (3) and l.Kd_Riwayat != 77 and mt.$paramSatker_mts_rc";
		
		//begin
		/*
		Kode Riwayat
		0 = Data baru
		2 = Ubah Kapitalisasi
		7 = Penghapusan Sebagian
		21 = Koreksi Nilai
		26 = Penghapusan Pemindahtanganan
		27 = Penghapusan Pemusnahan
		*/
		// 0 = Data baru
		 
		$log_tanah = "select l.* from log_tanah as l 
					inner join tanah as t on l.Aset_ID = t.Aset_ID 
					where $paramLog";
					
		$log_mesin = "select l.* from log_mesin as l
					inner join mesin as t on l.Aset_ID = t.Aset_ID 
					where $paramLog";
					
		$log_bangunan = "select l.* from log_bangunan as l 
					inner join bangunan as t on l.Aset_ID = t.Aset_ID 
					where $paramLog ";
					
		$log_jaringan = "select l.* from log_jaringan as l 
					inner join jaringan as t on l.Aset_ID = t.Aset_ID 
					where $paramLog ";
					
		$log_asetlain = "select l.* from log_asetlain as l 
					inner join asetlain as t on l.Aset_ID = t.Aset_ID 
					where $paramLog";
					
		$log_kdp = "select l.* from log_kdp as l 
					inner join kdp as t on l.Aset_ID = t.Aset_ID 
					where $paramLog";
		
				
		//======================================================================================
		/*
		Kode Riwayat
		3 = Pindah SKPD (-) SatkerAwal != KodeSatker
		*/
		$log_tanah_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_tanah as l 
					inner join view_mutasi_tanah as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_mesin_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_mesin as l 
					inner join view_mutasi_mesin as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_bangunan_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_bangunan as l 
					inner join view_mutasi_bangunan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_jaringan_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_jaringan as l 
					inner join view_mutasi_jaringan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";	
			
		$log_asetlain_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_asetlain as l 
					inner join view_mutasi_asetlain as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_kdp_tr="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_kdp as l 
					inner join view_mutasi_kdp as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_tr group by l.Aset_ID order by l.Aset_ID ASC";			
		//======================================================================================
		/*
		Kode Riwayat
		3 = Pindah SKPD (+) SatkerTujuan = KodeSatker
		*/
		$log_tanah_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_tanah as l 
					inner join view_mutasi_tanah as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_mesin_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_mesin as l 
					inner join view_mutasi_mesin as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_bangunan_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_bangunan as l 
					inner join view_mutasi_bangunan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_jaringan_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_jaringan as l 
					inner join view_mutasi_jaringan as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";	
			
		$log_asetlain_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_asetlain as l 
					inner join view_mutasi_asetlain as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";
		
		$log_kdp_rc="select l.*,mt.SatkerAwal,mt.SatkerTujuan from log_kdp as l 
					inner join view_mutasi_kdp as mt on l.Aset_ID = mt.Aset_ID 
					where $paramLog_mts_rc group by l.Aset_ID order by l.Aset_ID ASC";	
		
		/*
		Kode Riwayat
		28 = Transfer Kapitalisasi (+) jika Aset_ID_Penambahan ==0
		*/
		$paramLogTransferKapitalisasiTambah =  "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = '28' and l.$paramSatker 
						   and l.Aset_ID_Penambahan = '0' and action like 'Aset Penambahan kapitalisasi Mutasi%' order by l.Aset_ID ASC";
						   
		$log_tanah_tr_kp="select l.* from log_tanah as l 
					where $paramLogTransferKapitalisasiTambah ";
		
		$log_mesin_tr_kp="select l.* from log_mesin as l 
					where $paramLogTransferKapitalisasiTambah ";
		
		$log_bangunan_tr_kp="select l.*  from log_bangunan as l 
					where $paramLogTransferKapitalisasiTambah";
		
		$log_jaringan_tr_kp="select l.* from log_jaringan as l 
					where $paramLogTransferKapitalisasiTambah";	
			
		$log_asetlain_tr_kp="select l.* from log_asetlain as l 
					where $paramLogTransferKapitalisasiTambah";
		
		$log_kdp_tr_kp="select l.* from log_kdp as l 
					where $paramLogTransferKapitalisasiTambah";
		
		/*
		Kode Riwayat
		28 = Transfer Kapitalisasi (-) jika Aset_ID_Penambahan !=0
		*/
		$paramLogTransferKapitalisasiKurang =  "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = '28' and l.$paramSatker 
						   and l.Aset_ID_Penambahan != '0' and action like 'Sukses kapitalisasi Mutasi%'
						   order by l.Aset_ID ASC";
		
		
		$log_tanah_rc_kp="select l.* from log_tanah as l 
					where $paramLogTransferKapitalisasiKurang ";
		
		$log_mesin_rc_kp="select l.* from log_mesin as l 
					where $paramLogTransferKapitalisasiKurang ";
		
		$log_bangunan_rc_kp="select l.*  from log_bangunan as l 
					where $paramLogTransferKapitalisasiKurang";
		
		$log_jaringan_rc_kp="select l.* from log_jaringan as l 
					where $paramLogTransferKapitalisasiKurang";	
			
		$log_asetlain_rc_kp="select l.* from log_asetlain as l 
					where $paramLogTransferKapitalisasiKurang";
		
		$log_kdp_rc_kp="select l.* from log_kdp as l 
					where $paramLogTransferKapitalisasiKurang";	
		
		
		
		
		//reklas (berkurang)
		$paramlogReklasKurang = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = '30'  and l.$paramSatker 
						   and t.StatusValidasi = 1 and t.Status_Validasi_Barang = 1 and t.StatusTampil = 1
						   and l.kodeData = '30'
						   order by l.Aset_ID ASC";
		
		$log_tanah_reklas_kurang ="select l.* from log_tanah as l 
							inner join tanah as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasKurang ";		
		
		$log_mesin_reklas_kurang ="select l.* from log_mesin as l 
							inner join mesin as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasKurang ";
		
		$log_bangunan_reklas_kurang ="select l.*  from log_bangunan as l 
							inner join bangunan as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasKurang";
					
		$log_jaringan_reklas_kurang ="select l.* from log_jaringan as l 
							inner join jaringan as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasKurang";	
					
		$log_asetlain_reklas_kurang ="select l.* from log_asetlain as l 
							inner join asetlain as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasKurang";			
		
		$log_kdp_reklas_kurang ="select l.* from log_kdp as l 
						inner join kdp as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasKurang";	
					
		//reklas (bertambah)			
		$paramlogReklasTambah = "l.TglPerubahan >='$tglawalperolehan' AND l.TglPerubahan <='$tglakhirperolehan' 
						   AND l.Kd_Riwayat = '30'  and l.$paramSatker 
						   and t.StatusValidasi = 0 and t.Status_Validasi_Barang = 0 and t.StatusTampil = 0
						   and l.kodeData = '30'
						  order by l.Aset_ID ASC";
		
		$log_tanah_reklas_tambah ="select l.* from log_tanah as l 
							inner join tanah as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasTambah ";		
		
		$log_mesin_reklas_tambah ="select l.* from log_mesin as l 
							inner join mesin as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasTambah ";
		
		$log_bangunan_reklas_tambah ="select l.*  from log_bangunan as l 
							inner join bangunan as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasTambah";
					
		$log_jaringan_reklas_tambah ="select l.* from log_jaringan as l 
							inner join jaringan as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasTambah";	
					
		$log_asetlain_reklas_tambah ="select l.* from log_asetlain as l 
							inner join asetlain as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasTambah";			
		
		$log_kdp_reklas_tambah ="select l.* from log_kdp as l 
						inner join kdp as t on t.Aset_ID = l.Aset_ID
					where $paramlogReklasTambah";	
					
					
	
		$queryALL = array($log_tanah,$log_mesin,$log_bangunan,$log_jaringan,$log_asetlain,$log_kdp,
						  $log_tanah_tr,$log_mesin_tr,$log_bangunan_tr,$log_jaringan_tr,$log_asetlain_tr,$log_kdp_tr,
						  $log_tanah_rc,$log_mesin_rc,$log_bangunan_rc,$log_jaringan_rc,$log_asetlain_rc,$log_kdp_rc,
						  $log_tanah_rc_kp,$log_mesin_rc_kp,$log_bangunan_rc_kp,$log_jaringan_rc_kp,$log_asetlain_rc_kp,$log_kdp_rc_kp,
						  $log_tanah_tr_kp,$log_mesin_tr_kp,$log_bangunan_tr_kp,$log_jaringan_tr_kp,$log_asetlain_tr_kp,$log_kdp_tr_kp,
						  $log_tanah_reklas_kurang,$log_mesin_reklas_kurang,$log_bangunan_reklas_kurang,$log_jaringan_reklas_kurang,$log_asetlain_reklas_kurang,$log_kdp_reklas_kurang,
						  $log_tanah_reklas_tambah,$log_mesin_reklas_tambah,$log_bangunan_reklas_tambah,$log_jaringan_reklas_tambah,$log_asetlain_reklas_tambah,$log_kdp_reklas_tambah
						  );
		/*$queryALL = array($log_tanah_tr_kp,$log_mesin_tr_kp,$log_bangunan_tr_kp,$log_jaringan_tr_kp,$log_asetlain_tr_kp,$log_kdp_tr_kp, 
							$log_tanah_rc_kp,$log_mesin_rc_kp,$log_bangunan_rc_kp,$log_jaringan_rc_kp,$log_asetlain_rc_kp,$log_kdp_rc_kp
						  );*/			
							  
		
		for ($i = 0; $i < count($queryALL); $i++)
			{
				echo "<br>";
				echo "query_$i =".$queryALL[$i];
				echo "<br>";
				echo "<br>";
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
		
		// pr($getdata);
		// exit;
		if($getdata){ 
			return $getdata;
		}		
	}
	
	public function MutasiSkpd ($satker,$tglawal,$tglakhir){
		
		foreach ($satker as $key){
		
			//MUTASI BERTAMBAH
			$query_tanah_rc = "SELECT * FROM view_mutasi_tanah WHERE SatkerTujuan ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";	
			
			$query_mesin_rc = "SELECT * FROM view_mutasi_mesin WHERE SatkerTujuan ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";			
			
			$query_bangunan_rc = "SELECT * FROM view_mutasi_bangunan WHERE SatkerTujuan ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";
			
			$query_jaringan_rc = "SELECT * FROM view_mutasi_jaringan WHERE SatkerTujuan ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";	
			
			$query_asettetaplainnya_rc = "SELECT * FROM view_mutasi_asetlain WHERE SatkerTujuan ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";		
			
			$query_kdp_rc = "SELECT * FROM view_mutasi_kdp WHERE SatkerTujuan ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";
			
			//MUTASI BERKURANG
			$query_tanah_tr = "SELECT * FROM view_mutasi_tanah WHERE SatkerAwal ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";	
			
			$query_mesin_tr = "SELECT * FROM view_mutasi_mesin WHERE SatkerAwal ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";			
			
			$query_bangunan_tr = "SELECT * FROM view_mutasi_bangunan WHERE SatkerAwal ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";
			
			$query_jaringan_tr = "SELECT * FROM view_mutasi_jaringan WHERE SatkerAwal ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";	
			
			$query_asettetaplainnya_tr = "SELECT * FROM view_mutasi_asetlain WHERE SatkerAwal ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";		
			
			$query_kdp_tr = "SELECT * FROM view_mutasi_kdp WHERE SatkerAwal ='$key' AND TglSKKDH >='$tglawal' AND TglSKKDH <='$tglakhir' group by Aset_ID";
			
			$queryALL = array($query_tanah_rc,$query_mesin_rc,$query_bangunan_rc,$query_jaringan_rc,$query_asettetaplainnya_rc,$query_kdp_rc,
							$query_tanah_tr,$query_mesin_tr,$query_bangunan_tr,$query_jaringan_tr,$query_asettetaplainnya_tr,$query_kdp_tr);
			
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
		if($getdata) return $getdata;
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
	
	public function TempTable($hit,$flag,$TypeRprtr,$Info,$tglawalperolehan,$tglakhirperolehan,$skpd_id){
		// ECHO "FLAG =".$flag;
		// exit;
		$tgldefault = "2008-01-01";
		$thnDefault ="2008";

		$tglAwalDefault = $tglawalperolehan;
		$ceckTglAw = explode ('-',$tglAwalDefault);
		$thnceck = $ceckTglAw[0];

		$tglAkhirDefault = $tglakhirperolehan;
		$ceckTgl = explode ('-',$tglAkhirDefault);
		$thnFix = $ceckTgl[0];
		
		$splitKodeSatker = explode ('.',$skpd_id);
		if(count($splitKodeSatker) == 4){	
			$paramSatker = "kodeSatker = '$skpd_id'";
			// $paramSatker_mts_tr = "SatkerAwal = '$skpd_id'";
			$paramSatker_mts_tr = "SatkerTujuan = '$skpd_id'";
			$paramSatker_mts_rc = "SatkerTujuan = '$skpd_id'";
			
		}else{
			$paramSatker = "kodeSatker like '$skpd_id%'";
			// $paramSatker_mts_tr = "SatkerAwal like '$skpd_id%'";
			$paramSatker_mts_tr = "SatkerTujuan like '$skpd_id%'";
			$paramSatker_mts_rc = "SatkerTujuan like '$skpd_id%'";
			
		}
	
		
		if($Info != ''){
			//untuk mutasi
			if($Info == 'mutasi'){
				/*
				$paramLog 		= "m.TglPembukuan >='$tglawalperolehan' AND m.TglPembukuan <='$tglakhirperolehan' 
								   AND m.TglPerubahan >'$tglawalperolehan' AND m.TglPerubahan <='$tglakhirperolehan' 
								   AND m.Kd_Riwayat in (0,2,7,21,3,28) and  (mt.SatkerAwal LIKE '$skpd_id%' OR m.kodeSatker LIKE '$skpd_id%') AND m.kondisi != 3  order by m.log_id ASC";*/
					
				//============STATUS PENDING==========================
				$paramKib 		= "a.TglPembukuan >='$tglawalperolehan' AND a.TglPembukuan <='$tglakhirperolehan' 
								   AND a.$paramSatker AND a.StatusTampil = 1  
								   AND a.kondisi != 3";
								   
				//parameter dengan kodeSatker(semua log)				   
				$paramLog 		= "m.TglPembukuan >='$tglawalperolehan' AND m.TglPembukuan <='$tglakhirperolehan' 
								   AND m.TglPerubahan >'$tglawalperolehan' AND m.TglPerubahan <='$tglakhirperolehan' 
								   AND m.Kd_Riwayat in (0,2,7,21) and (m.$paramSatker) AND m.kondisi != 3  order by m.log_id ASC";
				
				//parameter dengan SatkerAwal(view mutasi) untuk barang berkurang
				$paramLog_mts_tr = "m.TglPembukuan >='$tglawalperolehan' AND m.TglPembukuan <='$tglakhirperolehan' 
								   AND m.TglPerubahan >'$tglawalperolehan' AND m.TglPerubahan <='$tglakhirperolehan' 
								   AND m.Kd_Riwayat in (3,28) and (mt.$paramSatker_mts_tr) order by m.log_id ASC";
				
				//parameter dengan SatkerTujuan(view mutasi) untuk barang bertambah
				$paramLog_mts_rc = "m.TglPembukuan >='$tglawalperolehan' AND m.TglPembukuan <='$tglakhirperolehan' 
								   AND m.TglPerubahan >'$tglawalperolehan' AND m.TglPerubahan <='$tglakhirperolehan' 
								   AND m.Kd_Riwayat in (3,28) and (mt.$paramSatker_mts_rc) order by m.log_id ASC";
				
				//============STATUS PENDING==========================
				
			}elseif($Info == 'BISI' || $Info =='RBISI'){
				
				$paramKib 		= "a.TglPerolehan <='$tglakhirperolehan' ";
				$paramMutasi 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' order by a.TglSKKDH desc";
				$paramPnghpsn 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' order by a.TglHapus desc"; 
				$paramLog 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc,a.TglPerubahan desc";
		
			}else{
				$paramKib 		= "";
				$paramMutasi 	= "order by TglSKKDH desc";
				$paramPnghpsn 	= "order by TglHapus desc"; 
				$paramLog 		= "order by log_id desc";
			}
		}else{
			if($TypeRprtr == 'ATM' || $TypeRprtr == 'ATB' ){
				//siap edit
					if($thnFix < $thnDefault){
						// echo "tahun <2008";
						$paramKib 		= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker ";
						$paramMutasi 	= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr order by a.TglSKKDH desc";
						$paramPnghpsn 	= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker  order by a.TglHapus desc"; 
						$paramLog 		= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker  AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc,a.TglPerubahan desc";
					}elseif($thnceck >= $thnDefault){
						// echo "tahun > 2008";
						$paramKib 		= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker ";
						$paramMutasi 	= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr order by a.TglSKKDH desc";
						$paramPnghpsn 	= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker  order by a.TglHapus desc"; 
						$paramLog 		= "a.TglPerolehan >='$tglawalperolehan' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc,a.TglPerubahan desc";
					
					}else{
						// echo "tahun <2008 >2008";
						$paramKib 		= "a.TglPerolehan <'2008-01-01' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker ";
						$paramMutasi 	= "a.TglPerolehan <'2008-01-01' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr order by a.TglSKKDH desc";
						$paramPnghpsn 	= "a.TglPerolehan <'2008-01-01' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker order by a.TglHapus desc"; 
						$paramLog 		= "a.TglPerolehan <'2008-01-01' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND a.Kd_Riwayat != '77' order by a.log_id desc,a.TglPerubahan desc";
			
						$paramKib_2 		= "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker ";
						$paramMutasi_2 	    = "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr order by a.TglSKKDH desc";
						$paramPnghpsn_2 	= "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker order by a.TglHapus desc"; 
						$paramLog_2 		= "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  order by a.log_id desc,a.TglPerubahan desc";
				
					}
					
			}
			elseif($TypeRprtr == 'neraca' || $TypeRprtr == 'upb' || $TypeRprtr == 'skpd'){
				/*echo "<br/>";
				echo "temp table neraca atau upb atau skpd";
				echo "<br/>";*/
				$paramKib 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker ";
				$paramMutasi 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr  order by a.TglSKKDH desc";
				$paramPnghpsn 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker order by a.TglHapus desc"; 
				$paramLog 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') order by a.log_id desc,a.TglPerubahan desc";
				
				$paramKib_bc 		= "a.TglPerolehan <'2008-01-01' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker";
				$paramMutasi_bc 	= "a.TglPerolehan <'2008-01-01' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr order by a.TglSKKDH desc";
				$paramPnghpsn_bc 	= "a.TglPerolehan <'2008-01-01' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker order by a.TglHapus desc"; 
				$paramLog_bc 		= "a.TglPerolehan <'2008-01-01' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  order by a.log_id desc,a.TglPerubahan desc";
		
				$paramKib_2 		= "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker";
				$paramMutasi_2 	    = "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr order by a.TglSKKDH desc";
				$paramPnghpsn_2 	= "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker order by a.TglHapus desc"; 
				$paramLog_2 		= "a.TglPerolehan >='2008-01-01' AND a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  order by a.log_id desc,a.TglPerubahan desc";
			
			}elseif($TypeRprtr == 'KIB' || $TypeRprtr == 'kir' || $TypeRprtr == 'BIS' || $TypeRprtr == 'BISG' || $TypeRprtr == 'RBIS'){
				/*$paramKib 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.$paramSatker ";
				$paramMutasi 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan'  AND a.$paramSatker_mts_tr order by a.TglSKKDH desc";
				$paramPnghpsn 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.$paramSatker  order by a.TglHapus desc"; 
				$paramLog 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.$paramSatker  AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  order by a.log_id desc,a.TglPerubahan desc";*/
				
				$paramKib 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker ";
				$paramMutasi 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr  order by a.TglSKKDH desc";
				$paramPnghpsn 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker order by a.TglHapus desc"; 
				$paramLog 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  order by a.log_id desc,a.TglPerubahan desc";
				
			}else{
				/*echo "<br/>";
				echo "non deklarasi";
				echo "<br/>";*/
				// exit;
				$paramKib 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker ";
				$paramMutasi 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglSKKDH >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker_mts_tr  order by a.TglSKKDH desc";
				$paramPnghpsn 	= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglHapus >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan'  AND a.$paramSatker order by a.TglHapus desc"; 
				$paramLog 		= "a.TglPerolehan <='$tglakhirperolehan' AND a.TglPerubahan >'$tglakhirperolehan' AND a.TglPembukuan <='$tglakhirperolehan' AND a.$paramSatker AND (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0')  order by a.log_id desc,a.TglPerubahan desc";
			}
		}
		// echo "hit =".$hit;
		// exit;
		if($hit == 1){
		//single query
			if($flag == 'A'){
			//KIB A
				// echo "KIB A";
				// EXIT;
				$queryKib 		= "create temporary table tanahView as
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from tanah a
								
								where $paramKib";
				$queryMutasi 	= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun 
								from view_mutasi_tanah a
								inner join tanah t on t.Aset_ID=a.Aset_ID 
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramMutasi";
//				$queryPnghpsn	= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
//									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
//									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
//									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
//									AkumulasiPenyusutan, PenyusutanPerTahun)
//								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
//									a.kodeKA, a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, 
//									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
//									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
//									a.AkumulasiPenyusutan, a.PenyusutanPerTahun 
//								from view_hapus_tanah a 
//								inner join tanah t on t.Aset_ID=a.Aset_ID
//								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								where $paramPnghpsn";
				$queryLog 		= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from log_tanah  a
								inner join tanah t on t.Aset_ID=a.Aset_ID
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramLog";
								
				$queryAlter = "ALTER table tanahView add primary key(Tanah_ID)";	
			}elseif($flag == 'B'){
			//KIB B
				if($TypeRprtr == 'ATM'){
					// exit;
					$queryKib 		= "create temporary table mesin_ori as
								select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan 
									from mesin a
								where $paramKib";
					$queryMutasi 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,
									UmurEkonomis,TahunPenyusutan)
									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
										a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,
											t.UmurEkonomis,t.TahunPenyusutan 
									from view_mutasi_mesin a
									inner join mesin t on t.Aset_ID=a.Aset_ID
									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramMutasi";
//					$queryPnghpsn	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
//									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
//									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
//									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//										a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
//										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
//										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
//										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
//									from view_hapus_mesin a
//									inner join mesin t on t.Aset_ID=a.Aset_ID
//									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//									where $paramPnghpsn";
					$queryLog 		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
										if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.UmurEkonomis,a.TahunPenyusutan 
									from log_mesin a
									inner join mesin t on t.Aset_ID=a.Aset_ID
									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramLog";
					
					$queryAlter = "ALTER table mesin_ori add primary key(Mesin_ID)";	
									
					$queryKib_Rplctn 	= "create temporary table mesin_Rplctn
										select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan 
									from mesin a
									where $paramKib_2";
									
					$queryMutasi_Rplctn 	= "replace into mesin_Rplctn (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun
									,UmurEkonomis,TahunPenyusutan)
									
									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
										a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan 
									from view_mutasi_mesin a
									inner join mesin t on t.Aset_ID=a.Aset_ID 
									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramMutasi_2";
									
//					$queryPnghpsn_Rplctn	= "replace into mesin_Rplctn (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
//									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
//									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
//									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//									
//									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//										a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
//										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran,a. Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
//										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
//										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
//									from view_hapus_mesin a
//									inner join mesin t on t.Aset_ID=a.Aset_ID
//									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//									where $paramPnghpsn_2";
									
					$queryLog_Rplctn 		= "replace into mesin_Rplctn (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
											kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
											AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
											NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
											NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran,a. Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
										if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
										,a.UmurEkonomis,a.TahunPenyusutan	
									from log_mesin a
									inner join mesin t on t.Aset_ID=a.Aset_ID 
									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramLog_2";
					$queryAlter_Rplctn= "ALTER table mesin_Rplctn add primary key(Mesin_ID)";	
				}else{
				
					$queryKib 		= "create temporary table mesin_ori as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from mesin a
								where $paramKib";
					$queryMutasi 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
										a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
									from view_mutasi_mesin a
									inner join mesin t on t.Aset_ID=a.Aset_ID
									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramMutasi";
//					$queryPnghpsn	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
//									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
//									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
//									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//										a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
//										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
//										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
//										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
//									from view_hapus_mesin a
//									inner join mesin t on t.Aset_ID=a.Aset_ID 
//									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//									where $paramPnghpsn";
					$queryLog 		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
									NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
									NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
									select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
									from log_mesin a
									inner join mesin t on t.Aset_ID=a.Aset_ID 
									inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramLog";
					
					$queryAlter = "ALTER table mesin_ori add primary key(Mesin_ID)";
				
				}
							
			}elseif($flag == 'C'){
			//KIB C
				if($TypeRprtr == 'ATB' ){
					// echo "atb";
					$queryKib 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan  
									from bangunan a
									where $paramKib";
					$queryMutasi 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
										CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
										NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
										KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
										a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan from 
									view_mutasi_bangunan a
									inner join bangunan t on t.Aset_ID=a.Aset_ID
									inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramMutasi";
					$queryLog 		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
										CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
										NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
										KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
										if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun)
										,a.UmurEkonomis,a.TahunPenyusutan  
									from log_bangunan a
									inner join bangunan t on t.Aset_ID=a.Aset_ID
									inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramLog";
					
					$queryAlter = "ALTER table bangunan_ori add primary key(Bangunan_ID)";	
					
					$queryKib_Rplctn 		= "create temporary table bangunan_Rplctn as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun ,a.UmurEkonomis,a.TahunPenyusutan 
									from bangunan a
									where $paramKib_2";
									
					$queryMutasi_Rplctn 	= "replace into bangunan_Rplctn (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
										CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
										NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
										KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
										a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun
										,t.UmurEkonomis,t.TahunPenyusutan 
										from 
									view_mutasi_bangunan a
									inner join bangunan t on t.Aset_ID=a.Aset_ID
									inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramMutasi_2";
									
					$queryLog_Rplctn 		= "replace into bangunan_Rplctn (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
										CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
										NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
										KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan,a.Status_Validasi_Barang,a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
										if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun)
										,a.UmurEkonomis,a.TahunPenyusutan  
									from log_bangunan a
									inner join bangunan t on t.Aset_ID=a.Aset_ID
									inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramLog_2";	
									
					$queryAlter_Rplctn = "ALTER table bangunan_Rplctn add primary key(Bangunan_ID)";					
				}else{
					$queryKib 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
									from bangunan a
									where $paramKib";
					$queryMutasi 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
										CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
										NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
										KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
										a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from 
									view_mutasi_bangunan a
									inner join bangunan t on t.Aset_ID=a.Aset_ID
									inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramMutasi";
					$queryLog 		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
										CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
										NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
										KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
									from log_bangunan a
									inner join bangunan t on t.Aset_ID=a.Aset_ID
									inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
									where $paramLog";
					
					$queryAlter = "ALTER table bangunan_ori add primary key(Bangunan_ID)";
					
				}				
			}elseif($flag == 'D'){
			//KIB D
				$queryKib 		= "create temporary table jaringan_ori as
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, 
									a.PenyusutanPerTahun,a.UmurEkonomis,a.TahunPenyusutan

								from jaringan a
								where $paramKib";
				$queryMutasi 	= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.UmurEkonomis,t.TahunPenyusutan 
								from view_mutasi_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramMutasi";
				$queryLog 		= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun)
									,a.UmurEkonomis,a.TahunPenyusutan  
								from log_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramLog";
				$queryAlter = "ALTER table jaringan_ori add primary key(Jaringan_ID)";				
			}elseif($flag == 'E'){
			//KIB E
				$queryKib 		= "create temporary table asetlain_ori as
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from asetlain a
								where $paramKib";
				$queryMutasi 	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select  a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramMutasi";
//				$queryPnghpsn	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
//									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
//									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
//									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
//									a.kodeData, a.kodeKA, a.kodeRuangan,1, 1,a.Tahun, a.NilaiPerolehan, a.Alamat, 
//									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
//									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
//								from view_hapus_asetlain a
//								inner join asetlain t on t.Aset_ID=a.Aset_ID
//								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								where $paramPnghpsn";
				$queryLog 		= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramLog";
				$queryAlter = "ALTER table asetlain_ori add primary key(AsetLain_ID)";						
			}elseif($flag == 'F'){
			//KIB F
				$queryKib 		= "create temporary table kdp_ori as
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from kdp a
								where $paramKib";
				$queryMutasi 	= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok,a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from view_mutasi_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramMutasi";
//				$queryPnghpsn	= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
//									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
//									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
//									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
//								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
//									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, 1, 1, a.Tahun, 
//									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
//									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
//								from view_hapus_kdp a
//								inner join kdp t on t.Aset_ID=a.Aset_ID
//								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								where $paramPnghpsn";
				$queryLog 		= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from log_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramLog";
				$queryAlter = "ALTER table kdp_ori add primary key(KDP_ID)";						
			}elseif($flag=="Lain"){
				$query_asetlain_3="create temporary table aset_lain_3 as
						  SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,a.AkumulasiPenyusutan,a.NilaiBuku,a.PenyusutanPerTaun
						  FROM aset as a, kelompok as k 
						  WHERE a.kodeKelompok = k.Kode  AND (a.kondisi = 3 OR a.kondisi = 4) and a.Status_Validasi_Barang = 1 AND a.Aset_ID is not null And a.Aset_ID!=0
						  and $paramKib";
			      
				$query_alter_asetlain_3="alter table aset_lain_3 add primary key(Aset_ID)";
				$query_asetlain_3_tanah="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0 
						      FROM log_tanah as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_mesin="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_mesin as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_bangunan="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_bangunan as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_jaringan="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_jaringan as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_asettetaplain="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0
						      FROM log_asetlain as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_kdp="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0 
						      FROM log_kdp as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";

				$query_mutasi_asetlain_3="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
							  SELECT a.kodeKA,a.kodeKelompok,a.SatkerAwal,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,a.AkumulasiPenyusutan, a.NilaiPerolehan,a.PenyusutanPerTaun
							  FROM view_mutasi_aset_full as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
							  WHERE a.Aset_ID is not null And a.Aset_ID!=0
							  and $paramMutasi";
//			        $query_hapus_asetlain_3="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan  )
//							SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,1,a.TglPerolehan,a.TglPembukuan
//							FROM view_hapus_aset as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
//							inner join aset ast on ast.Aset_ID= a.Aset_ID
//							WHERE a.Aset_ID is not null And a.Aset_ID!=0 
//							and $paramPnghpsn;";
			
			}elseif($flag == 'NonAset'){
				//daftar nonaset
				// echo "Non Aset";
				$queryKibB 		= "create temporary table mesin_ori as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
																
								where $paramMutasi";
//				$queryPnghpsnB	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
//								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
//								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
//								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//									a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
//									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
//									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
//									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
//								from view_hapus_mesin a
//								inner join mesin t on t.Aset_ID=a.Aset_ID
//								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//										
//								where $paramPnghpsn";
				$queryLogB 		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID 
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_ori add primary key(Mesin_ID)";
				
				$queryKibC 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
									from bangunan a
									where $paramKib";
				$queryMutasiC 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
//				$queryPnghpsnC	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//									kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
//									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
//									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
//									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//									a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
//									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
//									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
//									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
//								from view_hapus_bangunan a
//								inner join bangunan t on t.Aset_ID=a.Aset_ID
//								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogC 		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC = "ALTER table bangunan_ori add primary key(Bangunan_ID)";	
					
			}
			
			
			if($TypeRprtr == 'ATM' ){
				if($thnFix < $thnDefault){
					$AllTableTemp = array($queryKib,$queryAlter,$queryLog,$queryMutasi);
				}elseif($thnceck >= $thnDefault){
					$AllTableTemp = array($queryKib,$queryAlter,$queryLog,$queryMutasi);
				}else{
					$AllTableTemp = array($queryKib,$queryAlter,$queryLog,$queryMutasi,
									$queryKib_Rplctn,$queryAlter_Rplctn,$queryLog_Rplctn,$queryMutasi_Rplctn);
				}
				
			}elseif($TypeRprtr == 'ATB'){
				if($thnFix < $thnDefault){
					$AllTableTemp = array($queryKib,$queryAlter,$queryLog,$queryMutasi);
				}elseif($thnceck >= $thnDefault){
					$AllTableTemp = array($queryKib,$queryAlter,$queryLog,$queryMutasi);
				}else{
					$AllTableTemp = array($queryKib,$queryAlter,$queryLog,$queryMutasi,
									$queryKib_Rplctn,$queryAlter_Rplctn,$queryLog_Rplctn,$queryMutasi_Rplctn);
				}
			}
			elseif($TypeRprtr == 'Lain'){
				$AllTableTemp = array($query_asetlain_3,$query_alter_asetlain_3,$query_asetlain_3_tanah,$query_asetlain_3_mesin,$query_asetlain_3_bangunan,
						      $query_asetlain_3_jaringan,$query_asetlain_3_asettetaplain,$query_asetlain_3_kdp,$query_mutasi_asetlain_3);
			}elseif($TypeRprtr == 'NonAset'){
				//NonAset
				// echo "Non Aset";
				$AllTableTemp = array($queryKibB,$queryAlterB,$queryLogB,$queryMutasiB,
						      $queryKibC,$queryAlterC,$queryLogC,$queryMutasiC);
			}
			else{
				// echo "masukkkkkkkk sini kocak";
				$AllTableTemp = array($queryKib,$queryAlter,$queryLog,$queryMutasi);
			}
			
				for ($i = 0; $i < count($AllTableTemp); $i++)
				{

					/*echo "query_$i =".$AllTableTemp[$i];
					echo "<br>";
					echo "<br><br/>";*/
					//exit;
					$resultQuery = $this->query($AllTableTemp[$i]) or die ($this->error('error dataQuery'));
					
				}	
		}else{
		//array query
		// echo "array query";
		// echo "<br>";
			if($TypeRprtr == 'kir'){
				$queryKibB 		= "create temporary table mesin_ori as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramMutasi";
//				$queryPnghpsnB	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
//								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
//								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
//								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//									a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
//									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
//									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
//									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
//								from view_hapus_mesin a
//								inner join mesin t on t.Aset_ID=a.Aset_ID
//								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								where $paramPnghpsn";
				$queryLogB 		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_ori add primary key(Mesin_ID)";
				
				
				$queryKibE 		= "create temporary table asetlain_ori as
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from asetlain a
								where $paramKib";
				$queryMutasiE 	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select  a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
//				$queryPnghpsnE	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
//									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
//									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
//									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
//									a.kodeData, a.kodeKA, a.kodeRuangan,1, 1,a.Tahun, a.NilaiPerolehan, a.Alamat, 
//									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
//									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
//								from view_hapus_asetlain a
//								inner join asetlain t on t.Aset_ID=a.Aset_ID
//								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogE 		= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramLog";
				$queryAlterE = "ALTER table asetlain_ori add primary key(AsetLain_ID)";	
				
			}elseif($TypeRprtr == 'ekstra'){
				$queryKibB 		= "create temporary table mesin_ori as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
																
								where $paramMutasi";

				$queryLogB 		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID 
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_ori add primary key(Mesin_ID)";
				
				$queryKibC 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
									from bangunan a
									where $paramKib";
				$queryMutasiC 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogC 		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC = "ALTER table bangunan_ori add primary key(Bangunan_ID)";	
					
			}elseif($TypeRprtr == 'ekstraRev'){
				$queryKibB 		= "create temporary table mesin_extra as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_extra (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
																
								where $paramMutasi";

				$queryLogB 		= "replace into mesin_extra (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID 
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_extra add primary key(Mesin_ID)";
				
				$queryKibC 		= "create temporary table bangunan_extra as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
									from bangunan a
									where $paramKib";
				$queryMutasiC 	= "replace into bangunan_extra (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogC 		= "replace into bangunan_extra (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC = "ALTER table bangunan_extra add primary key(Bangunan_ID)";	
					
			}elseif($TypeRprtr == 'BIS' || $TypeRprtr == 'BISG' || $TypeRprtr == 'RBIS' || $TypeRprtr =='BISI' || $TypeRprtr =='RBISI' || $Info == 'BISI' || $Info =='RBISI'){
				$queryKibA 		= "create temporary table tanahView as
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from tanah a
								
								where $paramKib";
				$queryMutasiA 	= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun 
								from view_mutasi_tanah a
								inner join tanah t on t.Aset_ID=a.Aset_ID
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
										
								where $paramMutasi";
//				$queryPnghpsnA	= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
//									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
//									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
//									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
//									AkumulasiPenyusutan, PenyusutanPerTahun)
//								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
//									a.kodeKA, a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, 
//									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
//									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
//									a.AkumulasiPenyusutan, a.PenyusutanPerTahun 
//								from view_hapus_tanah a 
//								inner join tanah t on t.Aset_ID=a.Aset_ID 
//								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogA 		= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from log_tanah  a
								inner join tanah t on t.Aset_ID=a.Aset_ID
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
								
				$queryAlterA = "ALTER table tanahView add primary key(Tanah_ID)";	
				
				$queryKibB 		= "create temporary table mesin_ori as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
//				$queryPnghpsnB	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
//								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
//								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
//								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//									a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
//									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
//									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
//									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
//								from view_hapus_mesin a
//								inner join mesin t on t.Aset_ID=a.Aset_ID
//								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogB 		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_ori add primary key(Mesin_ID)";
				
				$queryKibC 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
									from bangunan a
									where $paramKib";
				$queryMutasiC 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
//				$queryPnghpsnC	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
//									kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
//									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
//									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
//									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
//									a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
//									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
//									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
//									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
//								from view_hapus_bangunan a
//								inner join bangunan t on t.Aset_ID=a.Aset_ID
//								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogC 		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC = "ALTER table bangunan_ori add primary key(Bangunan_ID)";	
				
				$queryKibD 		= "create temporary table jaringan_ori as
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from jaringan a
								where $paramKib";
				$queryMutasiD 	= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
//				$queryPnghpsnD	= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
//									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
//									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
//									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
//									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
//									a.kodeKA, a.kodeRuangan, 1, 1, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
//									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
//									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
//									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
//								from view_hapus_jaringan a
//								inner join jaringan t on t.Aset_ID=a.Aset_ID
//								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogD 		= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterD = "ALTER table jaringan_ori add primary key(Jaringan_ID)";
				
				$queryKibE 		= "create temporary table asetlain_ori as
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from asetlain a
								where $paramKib";
				$queryMutasiE 	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select  a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
//				$queryPnghpsnE	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
//									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
//									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
//									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
//								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
//									a.kodeData, a.kodeKA, a.kodeRuangan,1, 1,a.Tahun, a.NilaiPerolehan, a.Alamat, 
//									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
//									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
//								from view_hapus_asetlain a
//								inner join asetlain t on t.Aset_ID=a.Aset_ID
//								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogE 		= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterE = "ALTER table asetlain_ori add primary key(AsetLain_ID)";	
				
				$queryKibF 		= "create temporary table kdp_ori as
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from kdp a
								where $paramKib";
				$queryMutasiF 	= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok,a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from view_mutasi_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
//				$queryPnghpsnF	= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
//									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
//									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
//									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
//								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
//									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, 1, 1, a.Tahun, 
//									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
//									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
//								from view_hapus_kdp a
//								inner join kdp t on t.Aset_ID=a.Aset_ID
//								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
//								
//								where $paramPnghpsn";
				$queryLogF 		= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from log_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterF = "ALTER table kdp_ori add primary key(KDP_ID)";
			}elseif($TypeRprtr == 'intra'){
				// echo "masukk";
				// exit;
				$queryKibA 		= "create temporary table tanahView as
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from tanah a
								
								where $paramKib";
				$queryMutasiA 	= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun 
								from view_mutasi_tanah a
								inner join tanah t on t.Aset_ID=a.Aset_ID
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogA 		= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from log_tanah  a
								inner join tanah t on t.Aset_ID=a.Aset_ID
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
								
				$queryAlterA = "ALTER table tanahView add primary key(Tanah_ID)";	
				
				$queryKibB 		= "create temporary table mesin_ori as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan 
								from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun, TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogB 		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281,55),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		  
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID 
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_ori add primary key(Mesin_ID)";
				
				$queryKibC 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
									from bangunan a
									where $paramKib";
				$queryMutasiC 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogC 		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,55,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC = "ALTER table bangunan_ori add primary key(Bangunan_ID)";	
				
				$queryKibD 		= "create temporary table jaringan_ori as
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
								from jaringan a
								where $paramKib";
				$queryMutasiD 	= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun ,t.TahunPenyusutan
								from view_mutasi_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogD 		= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,55,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterD = "ALTER table jaringan_ori add primary key(Jaringan_ID)";
				
				$queryKibE 		= "create temporary table asetlain_ori as
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from asetlain a
								where $paramKib";
				$queryMutasiE 	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select  a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogE 		= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterE = "ALTER table asetlain_ori add primary key(AsetLain_ID)";	
				
				$queryKibF 		= "create temporary table kdp_ori as
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from kdp a
								where $paramKib";
				$queryMutasiF 	= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok,a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from view_mutasi_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogF 		= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from log_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterF = "ALTER table kdp_ori add primary key(KDP_ID)";
				
			}elseif($Info == 'mutasi'){
				//edit laporan mutasi coba2
				
				//ni buat mutasi berkurang
				//tanah
				$queryMutasiAset_tr = "create temporary table mutasi_aset as
									select m.Aset_ID,m.kodeKelompok,m.kodeSatker,m.kodeLokasi,m.noRegister,m.TglPerolehan,m.TglPembukuan, 
									m.BatasUtara as Merk,m.	BatasSelatan as Sertifikat,m.BatasBarat as Bahan, m.CaraPerolehan, 
									m.Tahun,m.BatasTimur as Ukuran,m.kondisi,m.NilaiPerolehan, m.NilaiPerolehan_Awal, 
									m.AsalUsul,m.Info,m.Kd_Riwayat,m.LuasKosong as Konstruksi,mt.SatkerAwal
									from log_tanah as m 
									inner join view_mutasi_aset mt on mt.Aset_ID=m.Aset_ID
									WHERE $paramLog_mts_tr";
									
				$queryAlterLogTanah_tr = "ALTER table mutasi_aset add primary key(Aset_ID)";
				
				//mesin
				$queryLogMesin_tr = "replace into mutasi_aset(Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan, 
									Merk,Sertifikat,Bahan, CaraPerolehan, 
									Tahun,Ukuran,kondisi,NilaiPerolehan,NilaiPerolehan_Awal, 
									AsalUsul,Info,Kd_Riwayat,Konstruksi,SatkerAwal) 

									select m.Aset_ID,m.kodeKelompok,m.kodeSatker,m.kodeLokasi,m.noRegister,m.TglPerolehan,m.TglPembukuan, 
									concat(m.Merk,'/',m.Model),concat(m.NoSeri,'/',NoRangka,'/',NoMesin),m.Material as Bahan, m.CaraPerolehan, 
									m.Tahun,m.Ukuran,m.kondisi,m.NilaiPerolehan, m.NilaiPerolehan_Awal, 
									m.AsalUsul,m.Info,m.Kd_Riwayat,m.NegaraRakit,mt.SatkerAwal
									from log_mesin as m 
									inner join view_mutasi_aset mt on mt.Aset_ID=m.Aset_ID
									where m.Aset_ID!=0 and m.Aset_ID is not NUll AND $paramLog_mts_tr";
				
				//bangunan
				$queryLogBangunan_tr = "replace into mutasi_aset(Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan, 
									Merk,Sertifikat,Bahan, CaraPerolehan, 
									Tahun,Ukuran,kondisi,NilaiPerolehan,NilaiPerolehan_Awal, 
									AsalUsul,Info,Kd_Riwayat,Konstruksi,SatkerAwal) 

									select m.Aset_ID,m.kodeKelompok,m.kodeSatker,m.kodeLokasi,m.noRegister,m.TglPerolehan,m.TglPembukuan, 
									NULL,NoSertifikat,NULL, m.CaraPerolehan, 
									m.Tahun,NULL,m.kondisi,m.NilaiPerolehan, m.NilaiPerolehan_Awal, 
									m.AsalUsul,m.Info,m.Kd_Riwayat,m.Konstruksi,mt.SatkerAwal
									from log_bangunan as m 
									inner join view_mutasi_aset mt on mt.Aset_ID=m.Aset_ID
									where m.Aset_ID!=0 and m.Aset_ID is not NUll AND $paramLog_mts_tr";
									
				//jaringan
				$queryLogJaringan_tr = "replace into mutasi_aset(Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan, 
									Merk,Sertifikat,Bahan, CaraPerolehan, 
									Tahun,Ukuran,kondisi,NilaiPerolehan,NilaiPerolehan_Awal, 
									AsalUsul,Info,Kd_Riwayat,Konstruksi,SatkerAwal) 

									select m.Aset_ID,m.kodeKelompok,m.kodeSatker,m.kodeLokasi,m.noRegister,m.TglPerolehan,m.TglPembukuan, 
									NULL,NoSertifikat,NULL, m.CaraPerolehan, 
									m.Tahun,NULL,m.kondisi,m.NilaiPerolehan, m.NilaiPerolehan_Awal, 
									m.AsalUsul,m.Info,m.Kd_Riwayat,m.Konstruksi,mt.SatkerAwal
									from log_jaringan as m 
									inner join view_mutasi_aset mt on mt.Aset_ID=m.Aset_ID
									where m.Aset_ID!=0 and m.Aset_ID is not NUll AND $paramLog_mts_tr";
									
				//asetlain
				$queryLogasetlain_tr = "replace into mutasi_aset(Aset_ID,kodeKelompok,kodeSatker,kodeLokasi,noRegister,TglPerolehan,TglPembukuan, 
									Merk,Sertifikat,Bahan, CaraPerolehan, 
									Tahun,Ukuran,kondisi,NilaiPerolehan,NilaiPerolehan_Awal, 
									AsalUsul,Info,Kd_Riwayat,Konstruksi,SatkerAwal)  

									select m.Aset_ID,m.kodeKelompok,m.kodeSatker,m.kodeLokasi,m.noRegister,m.TglPerolehan,m.TglPembukuan, 
									NULL,NULL,m.Material, m.CaraPerolehan, 
									m.Tahun,m.Ukuran,m.kondisi,m.NilaiPerolehan, m.NilaiPerolehan_Awal, 
									m.AsalUsul,m.Info,m.Kd_Riwayat,NULL,mt.SatkerAwal
									from log_asetlain as m 
									inner join view_mutasi_aset mt on mt.Aset_ID=m.Aset_ID
									where m.Aset_ID!=0 and m.Aset_ID is not NUll AND $paramLog_mts_tr";
														
									
			}elseif($TypeRprtr == 'neraca'){
				/*echo "<br/>";
				echo "eksekusi untuk neraca";
				echo "<br/>";*/
			//start kiba
				$queryKibA 		= "create temporary table tanahView as
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from tanah a
								
								where $paramKib";
				$queryMutasiA 	= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun 
								from view_mutasi_tanah a
								inner join tanah t on t.Aset_ID=a.Aset_ID
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramMutasi";

				$queryLogA 		= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from log_tanah  a
								inner join tanah t on t.Aset_ID=a.Aset_ID 
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
								
				$queryAlterA = "ALTER table tanahView add primary key(Tanah_ID)";
				
				$queryKibB 		= "create temporary table mesin_ori as
								select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan
									from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogB		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan		   
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_ori add primary key(Mesin_ID)";	
								
				$queryKibB_Rplctn 	= "create temporary table mesin_Rplctn
									select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan 
								from mesin a
								where $paramKib_2";
								
				$queryMutasiB_Rplctn 	= "replace into mesin_Rplctn (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi_2";
								
				$queryLogB_Rplctn 		= "replace into mesin_Rplctn (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
										AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
										NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
										NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran,a. Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		   
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID 
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog_2";
				$queryAlterB_Rplctn= "ALTER table mesin_Rplctn add primary key(Mesin_ID)";	
				
				
				$queryKibC 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
									from bangunan a
									where $paramKib";
				$queryMutasiC 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogC		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC = "ALTER table bangunan_ori add primary key(Bangunan_ID)";	
				
				$queryKibC_Rplctn 		= "create temporary table bangunan_Rplctn as
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
								from bangunan a
								where $paramKib_2";
								
				$queryMutasiC_Rplctn 	= "replace into bangunan_Rplctn (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi_2";
								
				$queryLogC_Rplctn 		= "replace into bangunan_Rplctn (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang,a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog_2";	
								
				$queryAlterC_Rplctn = "ALTER table bangunan_Rplctn add primary key(Bangunan_ID)";

				$queryKibD 		= "create temporary table jaringan_ori as
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
								from jaringan a
								where $paramKib";
				$queryMutasiD 	= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan 
								from view_mutasi_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogD 		= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterD = "ALTER table jaringan_ori add primary key(Jaringan_ID)";
				
				$queryKibE 		= "create temporary table asetlain_ori as
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from asetlain a
								where $paramKib";
				$queryMutasiE 	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select  a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogE 		= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterE = "ALTER table asetlain_ori add primary key(AsetLain_ID)";	
				
				$queryKibF 		= "create temporary table kdp_ori as
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from kdp a
								where $paramKib";
				$queryMutasiF 	= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok,a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from view_mutasi_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogF 		= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from log_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterF = "ALTER table kdp_ori add primary key(KDP_ID)";
				

				$query_asetlain_3="create temporary table aset_lain_3 as
						  SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,a.AkumulasiPenyusutan,a.NilaiBuku,a.PenyusutanPerTaun
						  FROM aset as a, kelompok as k 
						  WHERE a.kodeKelompok = k.Kode  AND (a.kondisi = 3 or a.kondisi = 4) and a.Status_Validasi_Barang = 1 AND a.Aset_ID is not null And a.Aset_ID!=0
						  and $paramKib";
			      
				$query_alter_asetlain_3="alter table aset_lain_3 add primary key(Aset_ID)";
				$query_asetlain_3_tanah="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0 
						      FROM log_tanah as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_mesin="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_mesin as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_bangunan="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_bangunan as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_jaringan="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_jaringan as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_asettetaplain="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0
						      FROM log_asetlain as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_kdp="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0 
						      FROM log_kdp as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";

				$query_mutasi_asetlain_3="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
							  SELECT a.kodeKA,a.kodeKelompok,a.SatkerAwal,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,a.AkumulasiPenyusutan, a.NilaiPerolehan,a.PenyusutanPerTaun
							  FROM view_mutasi_aset_full as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
							  WHERE a.Aset_ID is not null And a.Aset_ID!=0
							  and $paramMutasi";
//				$query_hapus_asetlain_3="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan  )
//						SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,1,a.TglPerolehan,a.TglPembukuan
//						FROM view_hapus_aset as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
//						inner join aset ast on ast.Aset_ID= a.Aset_ID
//						WHERE a.Aset_ID is not null And a.Aset_ID!=0 
//						and $paramPnghpsn";

					
			}else{
			//untuk rekap skpd dan upb
			/*echo "<br/>";
			echo "eksekusi untuk skpd dan neraca";
			echo "<br/>";*/
			$queryKibA 		= "create temporary table tanahView as
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from tanah a
								
								where $paramKib";
				$queryMutasiA 	= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, 
									a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun 
								from view_mutasi_tanah a
								inner join tanah t on t.Aset_ID=a.Aset_ID
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								where $paramMutasi";
				$queryLogA 		= "replace into tanahView (Tanah_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, 
									Alamat, Info, AsalUsul, kondisi, CaraPerolehan, LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah,
									NoSertifikat, TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur, Tmp_Hak, GUID, MasaManfaat, 
									AkumulasiPenyusutan, PenyusutanPerTahun)
								select a.Tanah_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), 
									a.Alamat, a.Info,a. AsalUsul, a.kondisi, a.CaraPerolehan, a.LuasTotal, a.LuasBangunan, a.LuasSekitar, a.LuasKosong, a.HakTanah,
									a.NoSertifikat, a.TglSertifikat, a.Penggunaan, a.BatasUtara, a.BatasSelatan, a.BatasBarat, a.BatasTimur, a.Tmp_Hak, a.GUID, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.PenyusutanPerTahun  
								from log_tanah  a
								inner join tanah t on t.Aset_ID=a.Aset_ID 
								inner join tanah t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
								
				$queryAlterA = "ALTER table tanahView add primary key(Tanah_ID)";
				
				$queryKibB 		= "create temporary table mesin_ori as
								select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan 
									from mesin a
								where $paramKib";
				$queryMutasiB 	= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogB		= "replace into mesin_ori (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		   
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB = "ALTER table mesin_ori add primary key(Mesin_ID)";	
								
				$queryKibB_Rplctn 	= "create temporary table mesin_Rplctn
									select a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, Status_Validasi_Barang, StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan 
								from mesin a
								where $paramKib_2";
								
				$queryMutasiB_Rplctn 	= "replace into mesin_Rplctn (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi_2";
								
				$queryLogB_Rplctn 		= "replace into mesin_Rplctn (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
										kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
										AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
										NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
										NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran,a. Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		   
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID 
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog_2";
				$queryAlterB_Rplctn= "ALTER table mesin_Rplctn add primary key(Mesin_ID)";	
				
				
				$queryKibC 		= "create temporary table bangunan_ori as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
									from bangunan a
									where $paramKib";
				$queryMutasiC 	= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogC		= "replace into bangunan_ori (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC = "ALTER table bangunan_ori add primary key(Bangunan_ID)";	
				
				$queryKibC_Rplctn 		= "create temporary table bangunan_Rplctn as
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
								from bangunan a
								where $paramKib_2";
								
				$queryMutasiC_Rplctn 	= "replace into bangunan_Rplctn (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi_2";
								
				$queryLogC_Rplctn 		= "replace into bangunan_Rplctn (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang,a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog_2";	
								
				$queryAlterC_Rplctn = "ALTER table bangunan_Rplctn add primary key(Bangunan_ID)";

				$queryKibD 		= "create temporary table jaringan_ori as
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,a.TahunPenyusutan  
								from jaringan a
								where $paramKib";
				$queryMutasiD 	= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun,t.TahunPenyusutan 
								from view_mutasi_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogD 		= "replace into jaringan_ori (Jaringan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, 
									kodeKA, kodeRuangan,Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
									AsalUsul, kondisi, CaraPerolehan, Konstruksi, Panjang, Lebar, NoDokumen, TglDokumen, StatusTanah, 
									NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID, TanggalPemakaian, LuasJaringan, MasaManfaat, 
									AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun,TahunPenyusutan)
								select a.Jaringan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, 
									a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Panjang, a.Lebar, a.NoDokumen, a.TglDokumen, a.StatusTanah, 
									a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID, a.TanggalPemakaian, a.LuasJaringan, a.MasaManfaat, 
									if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun),a.TahunPenyusutan 		    
								from log_jaringan a
								inner join jaringan t on t.Aset_ID=a.Aset_ID
								inner join jaringan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterD = "ALTER table jaringan_ori add primary key(Jaringan_ID)";
				
				$queryKibE 		= "create temporary table asetlain_ori as
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from asetlain a
								where $paramKib";
				$queryMutasiE 	= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select  a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, a.NilaiPerolehan, a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogE 		= "replace into asetlain_ori (AsetLain_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, 
									kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, 
									Info, AsalUsul, kondisi, CaraPerolehan, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi, TahunTerbit, ISBN, Material, 
									Ukuran, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.AsetLain_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, 
									a.kodeData, a.kodeKA, a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil,a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, 
									a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Judul, a.AsalDaerah, a.Pengarang, a.Penerbit, a.Spesifikasi, a.TahunTerbit, a.ISBN, a.Material, 
									a.Ukuran, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_asetlain a
								inner join asetlain t on t.Aset_ID=a.Aset_ID
								inner join asetlain t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterE = "ALTER table asetlain_ori add primary key(AsetLain_ID)";	
				
				$queryKibF 		= "create temporary table kdp_ori as
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from kdp a
								where $paramKib";
				$queryMutasiF 	= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok,a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from view_mutasi_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";
				$queryLogF 		= "replace into kdp_ori (KDP_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, 
									TglPembukuan, kodeData, kodeKA, kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, 
									NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, CaraPerolehan, Konstruksi, Beton, JumlahLantai, LuasLantai, 
									TglMulai, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, KelompokTanah_ID, GUID)
								select a.KDP_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, 
									a.TglPembukuan, a.kodeData, a.kodeKA, a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, 
									if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, 
									a.TglMulai, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.KelompokTanah_ID, a.GUID  
								from log_kdp a
								inner join kdp t on t.Aset_ID=a.Aset_ID
								inner join kdp t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				$queryAlterF = "ALTER table kdp_ori add primary key(KDP_ID)";
				

				$query_asetlain_3="create temporary table aset_lain_3 as
						  SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,a.AkumulasiPenyusutan,a.NilaiBuku,a.PenyusutanPerTaun
						  FROM aset as a, kelompok as k 
						  WHERE a.kodeKelompok = k.Kode  AND (a.kondisi = 3 or a.kondisi = 4)  and a.Status_Validasi_Barang = 1 AND a.Aset_ID is not null And a.Aset_ID!=0
						  and $paramKib";
			      
				$query_alter_asetlain_3="alter table aset_lain_3 add primary key(Aset_ID)";
				$query_asetlain_3_tanah="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0 
						      FROM log_tanah as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_mesin="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_mesin as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_bangunan="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_bangunan as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_jaringan="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,if(a.AkumulasiPenyusutan_Awal is not null and a.AkumulasiPenyusutan_Awal !=0 and a.Kd_Riwayat in(7,21,281),a.AkumulasiPenyusutan_Awal,a.AkumulasiPenyusutan), if(a.NilaiBuku_Awal is not null and (a.NilaiPerolehan_Awal=a.AkumulasiPenyusutan_Awal or a.NilaiBuku_Awal!=0 or a.Kd_Riwayat in(2)) ,a.NilaiBuku_Awal,a.NilaiBuku), if(a.PenyusutanPerTahun_Awal is not null and a.PenyusutanPerTahun_Awal !=0,a.PenyusutanPerTahun_Awal,a.PenyusutanPerTahun) 
						      FROM log_jaringan as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_asettetaplain="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0
						      FROM log_asetlain as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";
				$query_asetlain_3_kdp="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
						      SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,0, a.NilaiPerolehan,0 
						      FROM log_kdp as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
						      inner join aset ast on ast.Aset_ID= a.Aset_ID
						      WHERE a.Aset_ID is not null And a.Aset_ID!=0
						      and (a.Kd_Riwayat != '77' AND a.Kd_Riwayat != '0') and $paramLog";

				$query_mutasi_asetlain_3="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan,AkumulasiPenyusutan,NilaiBuku,PenyusutanPerTaun )
							  SELECT a.kodeKA,a.kodeKelompok,a.SatkerAwal,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,a.Status_Validasi_Barang,a.TglPerolehan,a.TglPembukuan,a.AkumulasiPenyusutan, a.NilaiPerolehan,a.PenyusutanPerTaun
							  FROM view_mutasi_aset_full as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
							  WHERE a.Aset_ID is not null And a.Aset_ID!=0
							  and $paramMutasi";
//				$query_hapus_asetlain_3="replace into aset_lain_3(kodeKA,kodeKelompok,kodeSatker,kodeLokasi,noRegister, Aset_ID, NilaiPerolehan ,Uraian,Kondisi,Status_Validasi_Barang,TglPerolehan,TglPembukuan  )
//						SELECT a.kodeKA,a.kodeKelompok,a.kodeSatker,a.kodeLokasi,a.noRegister, a.Aset_ID, a.NilaiPerolehan ,k.Uraian ,a.Kondisi,1,a.TglPerolehan,a.TglPembukuan
//						FROM view_hapus_aset as a inner join kelompok as k  on a.kodeKelompok = k.Kode 
//						inner join aset ast on ast.Aset_ID= a.Aset_ID
//						WHERE a.Aset_ID is not null And a.Aset_ID!=0 
//						and $paramPnghpsn";
				
				//tambahan untk ekstra	
				$queryKibB_extra 		= "create temporary table mesin_extra as
								select  a.Mesin_ID,a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
										a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
										a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
										a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from mesin a
								where $paramKib";
				$queryMutasiB_extra 	= "replace into mesin_extra (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal, concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin, a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from view_mutasi_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
																
								where $paramMutasi";

				$queryLogB_extra 		= "replace into mesin_extra (Mesin_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
								kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, 
								AsalUsul, kondisi, CaraPerolehan, Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Material, NoSeri,
								NoRangka, NoMesin, NoSTNK, TglSTNK, NoBPKB, TglBPKB, NoDokumen, TglDokumen, Pabrik, TahunBuat, BahanBakar, 
								NegaraAsal, NegaraRakit, Kapasitas, Bobot, GUID, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Mesin_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, 
									a.AsalUsul, a.kondisi, a.CaraPerolehan, a.Merk, a.Model, a.Ukuran, a.Silinder, a.MerkMesin, a.JumlahMesin,a.Material, a.NoSeri,
									a.NoRangka, a.NoMesin, a.NoSTNK, a.TglSTNK, a.NoBPKB, a.TglBPKB, a.NoDokumen, a.TglDokumen, a.Pabrik, a.TahunBuat, a.BahanBakar, 
									a.NegaraAsal, a.NegaraRakit, a.Kapasitas, a.Bobot, a.GUID, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun 
								from log_mesin a
								inner join mesin t on t.Aset_ID=a.Aset_ID 
								inner join mesin t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterB_extra = "ALTER table mesin_extra add primary key(Mesin_ID)";
				
				$queryKibC_extra 		= "create temporary table bangunan_extra as
									select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
										a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
										a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
										a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
										a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
									from bangunan a
									where $paramKib";
				$queryMutasiC_extra 	= "replace into bangunan_extra (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.SatkerAwal,concat(left(a.kodeLokasi,9),left(a.SatkerAwal,6),lpad(right(a.Tahun,2),2,'0'),'.',right(a.SatkerAwal,5)), 
									a.NomorRegAwal, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan,a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, a.NilaiPerolehan, a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun from 
								view_mutasi_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramMutasi";

				$queryLogC_extra 		= "replace into bangunan_extra (Bangunan_ID, Aset_ID, kodeKelompok, kodeSatker, kodeLokasi, noRegister, TglPerolehan, TglPembukuan, kodeData, kodeKA, 
									kodeRuangan, Status_Validasi_Barang, StatusTampil, Tahun, NilaiPerolehan, Alamat, Info, AsalUsul, kondisi, 
									CaraPerolehan, TglPakai, Konstruksi, Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap, 
									NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat, Tanah_ID, Tmp_Tingkat, Tmp_Beton, Tmp_Luas, 
									KelompokTanah_ID, GUID, TglPembangunan, MasaManfaat, AkumulasiPenyusutan, NilaiBuku, PenyusutanPerTahun)
								select a.Bangunan_ID, a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TglPerolehan, a.TglPembukuan, a.kodeData, a.kodeKA, 
									a.kodeRuangan, a.Status_Validasi_Barang, a.StatusTampil, a.Tahun, if(a.NilaiPerolehan_Awal!=0,a.NilaiPerolehan_Awal,a.NilaiPerolehan), a.Alamat, a.Info, a.AsalUsul, a.kondisi, 
									a.CaraPerolehan, a.TglPakai, a.Konstruksi, a.Beton, a.JumlahLantai, a.LuasLantai, a.Dinding, a.Lantai, a.LangitLangit, a.Atap, 
									a.NoSurat, a.TglSurat, a.NoIMB, a.TglIMB, a.StatusTanah, a.NoSertifikat, a.TglSertifikat, a.Tanah_ID, a.Tmp_Tingkat, a.Tmp_Beton, a.Tmp_Luas, 
									a.KelompokTanah_ID, a.GUID, a.TglPembangunan, a.MasaManfaat, a.AkumulasiPenyusutan, a.NilaiBuku, a.PenyusutanPerTahun  
								from log_bangunan a
								inner join bangunan t on t.Aset_ID=a.Aset_ID
								inner join bangunan t_2 on t_2.Aset_ID=t.Aset_ID and t.Aset_ID is not null and t.Aset_ID != 0
								
								where $paramLog";
				
				$queryAlterC_extra = "ALTER table bangunan_extra add primary key(Bangunan_ID)";	
			}
			if($TypeRprtr == 'kir'){
				// echo "kir";
				$AllTableTemp = array($queryKibB,$queryAlterB,$queryLogB,$queryMutasiB,
								$queryKibE,$queryAlterE,$queryLogE,$queryMutasiE);
			}elseif($TypeRprtr == 'ekstra' || $TypeRprtr == 'ekstraRev'){
				// echo "ekstra";
				$AllTableTemp = array($queryKibB,$queryAlterB,$queryLogB,$queryMutasiB,
								$queryKibC,$queryAlterC,$queryLogC,$queryMutasiC);
			}elseif($TypeRprtr == 'intra'){
                            
                               switch ($flag) {
                                 case "tanah":
                                     $AllTableTemp = array($queryKibA,$queryAlterA,$queryLogA,$queryMutasiA);
                                     break;
                                 case "mesin":
                                     $AllTableTemp = array($queryKibB,$queryAlterB,$queryLogB,$queryMutasiB);
                                     break;
                                 case "bangunan":
                                      $AllTableTemp = array($queryKibC,$queryAlterC,$queryLogC,$queryMutasiC);
                                     break;
                                 case "jaringan":
                                      $AllTableTemp = array($queryKibD,$queryAlterD,$queryLogD,$queryMutasiD);
                                     break;
                                  case "asetlain":
                                      $AllTableTemp = array($queryKibE,$queryAlterE,$queryLogE,$queryMutasiE);
                                     break;
                                 case "kdp":
                                      $AllTableTemp = array($queryKibF,$queryAlterF,$queryLogF,$queryMutasiF);
                                     break;
                                

                                 default:
                                     $AllTableTemp = array($queryKibA,$queryAlterA,$queryLogA,$queryMutasiA,
									$queryKibB,$queryAlterB,$queryLogB,$queryMutasiB,
									$queryKibC,$queryAlterC,$queryLogC,$queryMutasiC,
									$queryKibD,$queryAlterD,$queryLogD,$queryMutasiD,
									$queryKibE,$queryAlterE,$queryLogE,$queryMutasiE,
									$queryKibF,$queryAlterF,$queryLogF,$queryMutasiF);
                                     break;
                             }
                          
				
			
			}elseif($TypeRprtr == 'BIS' || $TypeRprtr == 'BISG' || $TypeRprtr == 'RBIS' || $TypeRprtr =='BISI' || $TypeRprtr =='RBISI'){
				// echo "all ORI";
				// echo "<br>";
				$AllTableTemp = array($queryKibA,$queryAlterA,$queryLogA,$queryMutasiA,
									$queryKibB,$queryAlterB,$queryLogB,$queryMutasiB,
									$queryKibC,$queryAlterC,$queryLogC,$queryMutasiC,
									$queryKibD,$queryAlterD,$queryLogD,$queryMutasiD,
									$queryKibE,$queryAlterE,$queryLogE,$queryMutasiE,
									$queryKibF,$queryAlterF,$queryLogF,$queryMutasiF);
			}elseif($TypeRprtr == 'mutasi' ){
				/*$AllTableTemp = array($queryMutasiAset,
									$queryAlterLogTanah,
									$queryLogMesin,
									$queryLogBangunan,
									$queryLogJaringan,
									$queryLogasetlain);*/
				$AllTableTemp = array($queryMutasiAset_tr,
									$queryAlterLogTanah_tr,
									$queryLogMesin_tr,
									$queryLogBangunan_tr,
									$queryLogJaringan_tr,
									$queryLogasetlain_tr);			
			}elseif($TypeRprtr == 'neraca'){
				/*echo "<br/>";
				echo "array neraca";
				echo "<br/>";*/
				$AllTableTemp = array($queryKibA,$queryAlterA,$queryLogA,$queryMutasiA,
									$queryKibB,$queryAlterB,$queryLogB,$queryMutasiB,
									$queryKibB_Rplctn,$queryAlterB_Rplctn,$queryLogB_Rplctn,$queryMutasiB_Rplctn,
									$queryKibC,$queryAlterC,$queryLogC,$queryMutasiC,
									$queryKibC_Rplctn,$queryAlterC_Rplctn,$queryLogC_Rplctn,$queryMutasiC_Rplctn,
									$queryKibD,$queryAlterD,$queryLogD,$queryMutasiD,
									$queryKibE,$queryAlterE,$queryLogE,$queryMutasiE,
									$queryKibF,$queryAlterF,$queryLogF,$queryMutasiF,
						      $query_asetlain_3,$query_alter_asetlain_3,$query_asetlain_3_tanah,$query_asetlain_3_mesin,$query_asetlain_3_bangunan,
						      $query_asetlain_3_jaringan,$query_asetlain_3_asettetaplain,$query_asetlain_3_kdp,$query_mutasi_asetlain_3);						
				
			}else{
				/*echo "<br/>";
				echo "array rekap upb dan skpd";
				echo "<br/>";*/
				//untuk rekap upb dan skpd
				$AllTableTemp = array($queryKibA,$queryAlterA,$queryLogA,$queryMutasiA,
									$queryKibB,$queryAlterB,$queryLogB,$queryMutasiB,
									$queryKibB_Rplctn,$queryAlterB_Rplctn,$queryLogB_Rplctn,$queryMutasiB_Rplctn,
									$queryKibC,$queryAlterC,$queryLogC,$queryMutasiC,
									$queryKibC_Rplctn,$queryAlterC_Rplctn,$queryLogC_Rplctn,$queryMutasiC_Rplctn,
									$queryKibD,$queryAlterD,$queryLogD,$queryMutasiD,
									$queryKibE,$queryAlterE,$queryLogE,$queryMutasiE,
									$queryKibF,$queryAlterF,$queryLogF,$queryMutasiF,
									$query_asetlain_3,$query_alter_asetlain_3,$query_asetlain_3_tanah,$query_asetlain_3_mesin,$query_asetlain_3_bangunan,
									$query_asetlain_3_jaringan,$query_asetlain_3_asettetaplain,$query_asetlain_3_kdp,$query_mutasi_asetlain_3,
									$queryKibB_extra,$queryAlterB_extra,$queryLogB_extra,$queryMutasiB_extra,
									$queryKibC_extra,$queryAlterC_extra,$queryLogC_extra,$queryMutasiC_extra);						
			}
			
				for ($i = 0; $i < count($AllTableTemp); $i++)
				{
					/*echo "query_$i =".$AllTableTemp[$i];
					echo "<br>";
					echo "<br>";*/
					// exit;
					$resultQuery = $this->query($AllTableTemp[$i]) or die ($this->error('error dataQuery'));
				}
		}
		
	
	}

	public function LaporanInventaris($skpd_id,$kelompok,$tglpembukuanAwl,$tglpembukuanAkhr){
	//echo "masuk";
	//echo $skpd_id.'-'.$kelompok.'-'.$tglpembukuanAwl.'-'.$tglpembukuanAkhr;
	/*pr($skpd_id);
	pr($kelompok);
	pr($tglpembukuanAwl);
	pr($tglpembukuanAkhr);*/
		//exit;
	//$query_tgl_Prlhn = "TglPerolehan <= '$tglperolehan'";
	$query_tgl_Pembukuan_awal = "TglPembukuan >= '$tglpembukuanAwl'";
	$query_tgl_Pembukuan_akhir = "TglPembukuan <= '$tglpembukuanAkhr'";
	$query_satker_fix = "kodeSatker like '$skpd_id%'";
	$query_kelompok_fix = "kodeKelompok like '$kelompok%'";
	
	$parameter_sql="";
	if($tglpembukuanAwl !=""){
		$parameter_sql=$query_tgl_Pembukuan_awal;
	}
	if($tglpembukuanAkhr!="" && $parameter_sql !=""){
		$parameter_sql=$parameter_sql." AND ".$query_tgl_Pembukuan_akhir;
	}
	
	if($skpd_id!="" && $parameter_sql!=""){
		$parameter_sql=$parameter_sql." AND ".$query_satker_fix;
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
	//echo $parameter_sql;
	//exit();
	$exe = explode('.',$kelompok);
	if($exe){
		$JenisAset = $exe[0];
	}else{
		$JenisAset = $kelompok; 
	}
	if($JenisAset == '01'){
		// echo "gol 1";
		$pecah = explode("AND ",$parameter_sql);
		for ($q=0;$q<count($pecah);$q++){
			$param[]="T.".$pecah[$q];
		}
		$newparameter_sql = implode('AND ', $param);
		$query = "select T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
						T.Kd_Riwayat,T.noRegister,T.kondisi,K.Kode, K.Uraian
					from 
						log_tanah as T
						inner join kelompok as K on T.kodeKelompok=K.Kode 
						inner join aset as a on a.Aset_ID=T.Aset_ID 
					where
						T.StatusTampil =1 and T.Kd_Riwayat = 0
						and a.noKontrak is null and a.Status_Validasi_Barang = 1  
						and $newparameter_sql
					order by 
					T.kodeSatker,T.kodeKelompok,T.Tahun ";
	}
	elseif($JenisAset[1] == '02'){
		// echo "gol 2";
		$pecah = explode("AND ",$parameter_sql);
		for ($q=0;$q<count($pecah);$q++){
			$param[]="M.".$pecah[$q];
		}
		$newparameter_sql = implode('AND ', $param);
		$query = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
						M.Silinder,M.kodeLokasi, M.Kd_Riwayat,M.noRegister,M.kondisi,K.Kode, K.Uraian
					from 
						log_mesin as M 
						inner join kelompok as K on M.kodeKelompok=K.Kode 
						inner join aset as a on a.Aset_ID=M.Aset_ID 
					where 
						M.StatusTampil =1 and M.Kd_Riwayat = 0 
						and a.noKontrak is null and a.Status_Validasi_Barang = 1
						and $newparameter_sql
					order by 
						M.kodeSatker,M.kodeKelompok,M.Tahun ";	
	}
	elseif($JenisAset[1] == '03'){
		// echo "gol 3";
		$pecah = explode("AND ",$parameter_sql);
		for ($q=0;$q<count($pecah);$q++){
			$param[]="B.".$pecah[$q];
		}
		$newparameter_sql = implode('AND ', $param);
		$query = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.Kd_Riwayat,B.noRegister,
					K.Kode, K.Uraian
				from 
					log_bangunan as B
					inner join kelompok as K on B.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=B.Aset_ID 
				where
					B.StatusTampil = 1 and B.Kd_Riwayat = 0 
					and a.noKontrak is null and a.Status_Validasi_Barang = 1
					and $newparameter_sql
				order by B.kodeSatker,B.kodeKelompok,B.Tahun ";	
	}
	elseif($JenisAset[1] == '04'){
		// echo "gol 4";
		$pecah = explode("AND ",$parameter_sql);
		for ($q=0;$q<count($pecah);$q++){
			$param[]="J.".$pecah[$q];
		}
		$newparameter_sql = implode('AND ', $param);
		$query = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
					J.kondisi, J.kodeLokasi,J.Kd_Riwayat,J.noRegister,
					K.Kode, K.Uraian
				from 
					log_jaringan as J
					inner join kelompok as K on J.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=J.Aset_ID 
				where
					J.StatusTampil =1 and J.Kd_Riwayat = 0 
					and a.noKontrak is null and a.Status_Validasi_Barang = 1
					and $newparameter_sql
				order by J.kodeSatker,J.kodeKelompok,J.Tahun ";	
	}
	elseif($JenisAset[1] == '05'){
		// echo "gol 5";
		$pecah = explode("AND ",$parameter_sql);
		for ($q=0;$q<count($pecah);$q++){
			$param[]="AL.".$pecah[$q];
		}
		$newparameter_sql = implode('AND ', $param);
		$query = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
					AL.kondisi, AL.kodeLokasi,AL.noRegister,
					K.Kode, K.Uraian
				from 
					log_asetlain as AL
					inner join kelompok as K on AL.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=AL.Aset_ID 
				where
					AL.StatusTampil =1 and AL.Kd_Riwayat = 0 
					and a.noKontrak is null and a.Status_Validasi_Barang = 1
					and $newparameter_sql
				order by AL.kodeSatker,AL.kodeKelompok,AL.Tahun";	
	}
	elseif($JenisAset[1] == '06'){
		// echo "gol 6";
		$pecah = explode("AND ",$parameter_sql);
		for ($q=0;$q<count($pecah);$q++){
			$param[]="KDPA.".$pecah[$q];
		}
		$newparameter_sql = implode('AND ', $param);
		$query = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
					KDPA.kondisi, KDPA.kodeLokasi,KDPA.noRegister,
					K.Kode, K.Uraian
				from 
					log_kdp as KDPA
					inner join kelompok as K on KDPA.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=KDPA.Aset_ID 			
				where
					KDPA.StatusTampil =1 and KDPA.Kd_Riwayat = 0 
					and a.noKontrak is null	and a.Status_Validasi_Barang = 1	 
					and $newparameter_sql
				order by KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.Tahun";	
	}
	elseif($kel_prs[1] == '07'){
		
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
	
	$query_01 = "select T.kodeSatker,T.kodeKelompok,T.Tahun,T.NilaiPerolehan, T.AsalUsul,T.Info, T.TglPerolehan,T.TglPembukuan,T.Alamat,T.LuasTotal,T.HakTanah, T.NoSertifikat, T.TglSertifikat, T.Penggunaan,T.kodeRuangan,T.kodeLokasi,
						T.Kd_Riwayat,T.noRegister,T.kondisi,K.Kode, K.Uraian
					from 
						log_tanah as T
						inner join kelompok as K on T.kodeKelompok=K.Kode 
						inner join aset as a on a.Aset_ID=T.Aset_ID 
					where
						T.StatusTampil =1 and T.Kd_Riwayat = 0 
						and a.noKontrak is null and a.Status_Validasi_Barang = 1
						and $newparameter_sql_01
					order by 
					T.kodeSatker,T.kodeKelompok,T.Tahun";
					
	$query_02 = "select M.kodeSatker,M.kodeKelompok,M.NilaiPerolehan, M.AsalUsul, M.Info, M.TglPerolehan,M.TglPembukuan,
						M.Tahun,M.Alamat, M.Merk,M.Ukuran,M.Material,M.NoSeri, M.NoRangka,M.NoMesin,M.NoSTNK,M.NoBPKB,
						M.Silinder,M.kodeLokasi,M.noRegister, M.Kd_Riwayat,M.kondisi,K.Kode, K.Uraian
					from 
						log_mesin as M 
						inner join kelompok as K on M.kodeKelompok=K.Kode 
						inner join aset as a on a.Aset_ID=M.Aset_ID 
					where 
						M.StatusTampil = 1 and M.Kd_Riwayat = 0
						and a.noKontrak is null and a.Status_Validasi_Barang = 1
						and $newparameter_sql_02
					order by 
						M.kodeSatker,M.kodeKelompok,M.Tahun";
						
	$query_03 = "select B.kodeSatker,B.kodeKelompok,B.NilaiPerolehan, B.AsalUsul,
					B.Info, B.TglPerolehan,B.TglPembukuan,B.Tahun,B.Alamat,
					B.JumlahLantai, B.Beton, B.LuasLantai,B.NoSurat,
					B.TglSurat,B.StatusTanah,B.kondisi,B.kodeRuangan,B.kodeLokasi,B.Kd_Riwayat,B.noRegister,
					K.Kode, K.Uraian
				from 
					log_bangunan as B
					inner join kelompok as K on B.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=B.Aset_ID 
				where
					B.StatusTampil = 1 and B.Kd_Riwayat = 0
					and a.noKontrak is null and a.Status_Validasi_Barang = 1
					and $newparameter_sql_03
				order by B.kodeSatker,B.kodeKelompok,B.Tahun";	
				
	$query_04 = "select J.kodeSatker,J.kodeKelompok,J.NilaiPerolehan, J.AsalUsul,J.kodeRuangan,
					J.Info, J.TglPerolehan,J.TglPembukuan,J.Tahun,J.Alamat,
					J.Konstruksi, J.Panjang, J.Lebar, J.TglDokumen, J.NoDokumen, J.StatusTanah,J.LuasJaringan,
					J.kondisi, J.kodeLokasi,J.Kd_Riwayat,J.noRegister,
					K.Kode, K.Uraian
				from 
					log_jaringan as J
					inner join kelompok as K on J.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=J.Aset_ID 
				where
					J.StatusTampil =1 and J.Kd_Riwayat = 0 
					and a.noKontrak is null and a.Status_Validasi_Barang = 1
					and $newparameter_sql_04
				order by J.kodeSatker,J.kodeKelompok,J.Tahun ";			
	
	$query_05 = "select AL.kodeSatker,AL.kodeKelompok,AL.NilaiPerolehan, AL.AsalUsul,
					AL.Info, AL.TglPerolehan,AL.TglPembukuan,AL.Tahun,AL.Alamat,
					AL.Judul, AL.Spesifikasi, AL.AsalDaerah, AL.Pengarang, AL.Material, AL.Ukuran, AL.TahunTerbit, 
					AL.kondisi, AL.kodeLokasi,AL.noRegister,
					K.Kode, K.Uraian
				from 
					log_asetlain as AL
					inner join kelompok as K on AL.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=AL.Aset_ID
				where
					AL.StatusTampil =1 and AL.Kd_Riwayat = 0 
					and a.noKontrak is null and a.Status_Validasi_Barang = 1
					and $newparameter_sql_05
				order by AL.kodeSatker,AL.kodeKelompok,AL.Tahun ";		
				
	$query_06 = "select KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.KodeRuangan,KDPA.NilaiPerolehan, KDPA.AsalUsul,
					KDPA.Info, KDPA.TglPerolehan,KDPA.TglPembukuan,KDPA.Tahun,KDPA.Alamat,
					KDPA.Konstruksi, KDPA.JumlahLantai, KDPA.Beton, KDPA.LuasLantai, KDPA.NoSertifikat, KDPA.TglSertifikat,
					KDPA.kondisi, KDPA.kodeLokasi,KDPA.noRegister,
					K.Kode, K.Uraian
				from 
					log_kdp as KDPA 
					inner join kelompok as K on KDPA.kodeKelompok=K.Kode 
					inner join aset as a on a.Aset_ID=KDPA.Aset_ID 		
				where
					KDPA.StatusTampil =1 and KDPA.Kd_Riwayat = 0
					and a.noKontrak is null and a.Status_Validasi_Barang = 1			 
					and $newparameter_sql_06
				order by KDPA.kodeSatker,KDPA.kodeKelompok,KDPA.Tahun ";	
				
			$dataQuery = array($query_01,$query_02,$query_03,$query_04,$query_05,$query_06);
			// $dataQuery = array($query_05);
			$query = $dataQuery;
			
	}
	//echo $query;
	//echo "<br>";
	if(count($query) == 1){
		//echo "single query";
		pr($query);
		$result = $this->query($query) or die ($this->error('error dataQuery'));
		if ($result)
		{
		   while ($dataArr = mysql_fetch_object($result))
			{
				$data[] = $dataArr;
			}
		}
	}else{
		// echo "array query";
		// exit;
		// pr($query);
		for ($i = 0; $i < count($query); $i++)
		{
			echo "query_$i =".$dataQuery[$i];
			echo "<br>";
			echo "<br>";
			// exit;
			$result = $this->query($query[$i]) or die ($this->error('error dataQuery'));
			if ($result)
			{
			   while ($dataArr = mysql_fetch_object($result))
				{
					$data[] = $dataArr;
				}
			}
		}
	}
	// pr($data);
	// exit;
	return $data;
	}
	
	public function status($flag,$golongan,$tahun){
		if($flag == 1){
			$query = "SELECT status FROM status_laporan_neraca WHERE golongan = '$golongan' AND tahun = '$tahun'";	
			$result = $this->query($query) or die ($this->error('error dataQuery'));
			if ($result)
			{
				$dataArr = mysql_fetch_assoc($result);	
				if($dataArr['status'] == 1){
			   		$data = 1;
			   	}else{
			   		$data = 0;
			   	}
			}
		}else{
			//pr($golongan);
			//exit();
			$queryA = "SELECT status FROM status_laporan_neraca WHERE golongan = '{$golongan[0]}' AND tahun = '$tahun'";	
			$queryB = "SELECT status FROM status_laporan_neraca WHERE golongan = '{$golongan[1]}' AND tahun = '$tahun'";	
			$queryC = "SELECT status FROM status_laporan_neraca WHERE golongan = '{$golongan[2]}' AND tahun = '$tahun'";	
			$queryD = "SELECT status FROM status_laporan_neraca WHERE golongan = '{$golongan[3]}' AND tahun = '$tahun'";	
			$queryE = "SELECT status FROM status_laporan_neraca WHERE golongan = '{$golongan[4]}' AND tahun = '$tahun'";	
			$queryF = "SELECT status FROM status_laporan_neraca WHERE golongan = '{$golongan[5]}' AND tahun = '$tahun'";	
			
			$dataQuery = array($queryA,$queryB,$queryC,$queryD,$queryE,$queryF);
			//$query = $dataQuery;
			
			for ($i = 0; $i < count($dataQuery); $i++)
			{
				$result = $this->query($dataQuery[$i]) or die ($this->error('error dataQuery'));
				if ($result)
				{
				    
					$dataArr = mysql_fetch_assoc($result);
					$data[] = $dataArr['status'];

				}
			}
			//pr($data);
			//pr($dataQuery);
			if (in_array("1", $data)){
			  	$data = 1;
			}else{
			    $data = 0;
			}
		}
		return $data;
	}
}

?>
