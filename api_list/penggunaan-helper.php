<?php

include "../config/config.php";


class PENGGUNAAN extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}

	function usulan($guid, $kontrak, $debug=false)
	{

		$getAset = $this->getAset($guid, $kontrak);
		$noKontrak = array_keys($getAset['fullData']);
		// pr($getAset);
		// exit;
		$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $nmaset= explode(',', $getAset['asetid']);
        $nmasetsatker=$guid;
        $penggunaan_id=get_auto_increment("penggunaan");
        $ses_uid=$_SESSION['ses_uid'];

        $penggu_penet_eks_ket="migrasi penggunaan";   
        $penggu_penet_eks_nopenet=$noKontrak[0];   
        $penggu_penet_eks_tglpenet=$data['penggu_penet_eks_tglpenet']; 
        $olah_tgl=  date('Y-m-d H:i:s');
        $TglSKKDH = "2014-12-31";
        $panjang=count($nmaset);

        
        $sql = array(
                'table'=>'Penggunaan',
                'field'=>'NoSKKDH , TglSKKDH, Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, GUID',
                'value' => "'{$penggu_penet_eks_nopenet}','{$TglSKKDH}', '{$penggu_penet_eks_ket}','0','{$olah_tgl}','{$UserNm}','0','{$ses_uid}'",
                );
        $res = $this->db->lazyQuery($sql,$debug,1);
        $insertid = $this->db->insert_id();

        $sleep = 1;
        for($i=0;$i<$panjang;$i++){

            $sql1 = array(
                'table'=>'Penggunaanaset',
                'field'=>"Penggunaan_ID,Aset_ID, kodeSatker",
                'value' => "'{$penggunaan_id}','{$nmaset[$i]}', '{$nmasetsatker}'",
                );
            $res = $this->db->lazyQuery($sql1,$debug,1);

            
            
            $sql2 = array(
                'table'=>'Aset',
                'field'=>"NotUse=1",
                'condition' => "Aset_ID='{$nmaset[$i]}'",
                'limit' => '1',
                );
            $res = $this->db->lazyQuery($sql2,$debug,2);
           	
           	$sleep++;
           	if ($sleep == 200){
           		sleep(1);
           		$sleep = 1;	
           	} 
        }

        
        if ($res) return $insertid;
        return false;
	}

	function getSatker($kode, $debug=false)
	{
		$sql = array(
                'table'=>"satker",
                'field'=>"Aset_ID",
                'condition' => "GUID = 1 ",
                );

        $res = $this->db->lazyQuery($sql,$debug);
	}

	function getKontrak($kontrak=false, $debug=false)
	{
		$listTable2 = array(
                        // 1=>'tanah',
                        // 2=>'mesin',
                        // 3=>'bangunan',
                        // 4=>'jaringan',
                        5=>'asetlain',
                        // 6=>'kdp'
                        );
		foreach ($listTable2 as $key => $value) {
			$sql = array(
	                'table'=>"{$value}",
	                'field'=>"Aset_ID",
	                'condition' => "GUID = '212' ",
	                );

	        $res = $this->db->lazyQuery($sql,$debug);
	        if ($res) $data[$key] = $res;
		}

		
		if ($data){

			foreach ($data as $key => $value) {
				
				foreach ($value as $key => $val) {
					$asetid_tmp[] = $val['Aset_ID'];
				}
			}

			// pr($asetid_tmp);
			logFile('jumlah aset : '. count($asetid_tmp));
			$implode = implode(',', $asetid_tmp);
			$sql = array(
	                'table'=>"aset",
	                'field'=>"noKontrak",
	                'condition' => "Aset_ID IN ({$implode}) GROUP BY noKontrak",
	                );

	        $res = $this->db->lazyQuery($sql,$debug);
	        if ($res){

	        	foreach ($res as $key => $value) {

                    if ($value['noKontrak'] == $kontrak){
                        $dataKontrak[] = $value['noKontrak'];    
                    }
	        		
	        	}
	        	
	        	if ($dataKontrak) return array('kontrak'=>$dataKontrak, 'listaset'=>$implode);
	        }
	        // pr($dataKontrak);exit;

	        
	        
		}
		
		return false;
	}

	function getAset($unique, $namaKontrak=false)
	{

		
		$listTable2 = array(
                        // 1=>'tanah',
                        // 2=>'mesin',
                        // 3=>'bangunan',
                        // 4=>'jaringan',
                        5=>'asetlain',
                        // 6=>'kdp'
                        );

		$dataKontrak = $this->getKontrak($namaKontrak);
        // pr($dataKontrak);
        // exit;
		$dataAset = array();
        $tipeAset = array('A','B','C','D','E','F');
        if ($dataKontrak['kontrak']){
        	foreach ($dataKontrak['kontrak'] as $key => $value) {
        		
        		foreach ($tipeAset as $val) {

        			$sql = array(
			                'table'=>"aset",
			                'field'=>"Aset_ID",
			                'condition' => "noKontrak = '{$value}' AND TipeAset = '{$val}' AND Aset_ID IN ({$dataKontrak['listaset']})",
			                );

			        $res = $this->db->lazyQuery($sql,$debug);
			        if ($res) $dataAset[$value]['aset'][$val] = $res;
        		}
        		sleep(1);
        		// $dataKontrak[$key] = $dataAset;
        	}
        }

        if ($dataAset) return array('fullData'=>$dataAset, 'asetid'=>$dataKontrak['listaset']);
		
		return false;
	}

	function validasi($usulanid, $debug=false)
	{


		// $tabeltmp = $_SESSION['penggunaan_validasi']['jenisaset'];
  //       $getTable = $this->getTableKibAlias($tabeltmp);
  //       $tabel = $getTable['listTableReal'];


        $explodeID = $usulanid;
        
        
        if($explodeID!=""){
            $sql2 = array(
                'table'=>'Penggunaan',
                'field'=>"Status=1, FixPenggunaan = 1",
                'condition' => "Penggunaan_ID='{$explodeID}'",
                );
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

            $sql3 = array(
                'table'=>'PenggunaanAset',
                'field'=>"Status=1",
                'condition' => "Penggunaan_ID='{$explodeID}'",
                );
            $res3 = $this->db->lazyQuery($sql3,$debug,2);
        }
    

        /* Log It */

        

        $sql = array(
            'table'=>'PenggunaanAset',
            'field'=>"Aset_ID",
            'condition' => "Penggunaan_ID='{$explodeID}'",
            );
        $res = $this->db->lazyQuery($sql,$debug);
        
        
        // pr($res);

        $listTable = array(
                        'A'=>'tanah',
                        'B'=>'mesin',
                        'C'=>'bangunan',
                        'D'=>'jaringan',
                        'E'=>'asetlain',
                        'F'=>'kdp');

        if ($res){
        	$sleep = 1;
            $count = 1;
            foreach ($res as $key => $val) {


                $sql = array(
                        'table'=>'aset',
                        'field'=>"TipeAset",
                        'condition' => "Aset_ID={$val['Aset_ID']}",
                        );
                $result = $this->db->lazyQuery($sql,$debug);
                $asetid[$val['Aset_ID']] = $listTable[implode(',', $result[0])];

                $sql3 = array(
                    'table'=>'aset',
                    'field'=>"fixPenggunaan=1",
                    'condition' => "Aset_ID='{$val['Aset_ID']}'",
                    );
                $res3 = $this->db->lazyQuery($sql3,$debug,2);

                logFile('Data count : '.$count);
                $count++;
                
                $sleep++;


	           	if ($sleep == 200){
	           		sleep(1);
	           		$sleep = 1;	
	           	} 
            }

            /*
            $sleep = 1;
            
            foreach ($asetid as $key => $value) {
                logFile('log data penggunaan, Aset_ID ='.$key);
                $this->db->logIt($tabel=array($value), $Aset_ID=$key, 22);

                $sleep++;
	           	if ($sleep == 200){
	           		sleep(1);
	           		$sleep = 1;	
	           	} 
            }
            */
        }else{
            logFile('gagal log penggunaan');
        }

        if ($res2 && $res3) return true;
        return false;
	}

	function getGUID()
	{	
		$listTable = array(
                        // 'A'=>'tanah',
                        // 'B'=>'mesin',
                        // 'C'=>'bangunan',
                        // 'D'=>'jaringan',
                        'E'=>'asetlain',
                        // 'F'=>'kdp'
                        );

		foreach ($listTable as $key => $value) {

			$sql = array(
	            'table'=>"{$value}",
	            'field'=>"GUID",
	            'condition' => "GUID !=''",
	            );
	        $res = $this->db->lazyQuery($sql,$debug);
	        if ($res){
	        	foreach ($res as $key => $value) {
	        		$newData[] = $value['GUID'];
	        	}

	        	
	        }

	        
		}
		return $newData;
	}
}


$run = new PENGGUNAAN;
$getGUID = $run->getGUID();
$kontrak = "importing-ug/2";


if ($getGUID){
	
	$unique = array_unique($getGUID);
	// pr($unique);
	foreach ($unique as $key => $value) {
		// echo $value;
		$usulan = $run->usulan($value, $kontrak);
		// $usulan = 4;
		echo 'sukses usulan';
        logFile('==================== Usulan Penggunaan DONE =====================');
		if ($usulan){
			$validasi = $run->validasi($usulan);
            echo 'sukses validasi';
			logFile('==================== Validasi Penggunaan DONE =====================');
		}
	}
}


?>