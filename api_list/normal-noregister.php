<?php

include "../config/config.php";

class noregister extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}

	function getSatkerTujuan()
	{

		$sql = array(
	            'table'=>"mutasiaset AS ma, aset AS a ",
	            'field'=>"ma.SatkerTujuan, ma.Aset_ID, a.kodeKelompok, a.kodeLokasi, a.noRegister",
	            'condition'=>"ma.Status = 1 AND ma.Aset_ID_Tujuan = 0 AND a.kodeLokasi !=''",
	            'joinmethod'=>'LEFT JOIN',
	            'join'=>"ma.Aset_ID = a.Aset_ID",
	            // 'limit'=>10
	            );

	    $res = $this->db->lazyQuery($sql,$debug);
	    if ($res){

	    	foreach ($res as $key => $value) {
	    		
	    		$sql = array(
			            'table'=>"aset AS a ",
			            'field'=>"a.noRegister, a.Aset_ID, a.TipeAset",
			            'condition'=>"a.kodeKelompok LIKE '{$value['kodeKelompok']}' AND kodeLokasi LIKE '{$value['kodeLokasi']}'",
			            );

			    $temp = $this->db->lazyQuery($sql,$debug);
			    if ($temp){
			    	$res[$key]['totalData'] = count($temp);
			    	$res[$key]['jumlahdata'] = $temp;

			    }
	    	}

	    	foreach ($res as $key1 => $value) {
	    		$nilaiTertinggi = array();
	    		foreach ($value['jumlahdata'] as $key => $val) {

	    			
					$nilaiTertinggi[] = $val['noRegister']; 
				}

				$maxReg = intval(max($nilaiTertinggi));
				$res[$key1]['maxReg'] = $maxReg;
	    	}


	    	return $res;	
	    } 
	    return false;
	}

	function filterData($data)
	{
		// update ke aset

		$tabel = array('A'=>'tanah', 'B'=>'mesin', 'C'=>'bangunan', 'D'=>'jaringan', 'E'=>'asetlain','F'=>'kdp', 'H'=>'aset');
		if ($data){

			// set autocommit = 0
			$newData = array();
			foreach ($data as $key => $value) {
				
				$noRegister = 1;
				
				foreach ($value['jumlahdata'] as $key => $val) {
					
					if ($value['totalData']>1){
						// data lebih dari 1 
						if ($val['Aset_ID']==$value['Aset_ID']){
							
							if ($val['noRegister'] <= $value['maxReg']){
								$tmpData['noRegister'] = $value['maxReg']+1;
								$tmpData['Aset_ID'] = $value['Aset_ID'];
								$tmpData['TipeAset'] = $val['TipeAset'];
								$tmpData['currentReg'] = $val['noRegister'];
								$tmpData['maxReg'] = $value['maxReg'];

								$newData[] = $tmpData;
							}
						}

					}else{
						// jumlah data hanya 1
						$tmpData['noRegister'] = 1;
						$tmpData['Aset_ID'] = $value['Aset_ID'];
						$tmpData['TipeAset'] = $val['TipeAset'];
						$tmpData['currentReg'] = $val['noRegister'];
						$tmpData['maxReg'] = $value['maxReg'];

						$newData[] = $tmpData;
					}


					$noRegister++;
				}
			}

			return $newData; 
			// pr($newData);
		}
	}

	function logReg($data, $debug=false)
	{

		$tglUpdate = date('Y-m-d H:i:s');
		$sql = array(
                'table'=>"tmp_register",
                'field'=>"Aset_ID , regLama, regBaru, tglUpdate",
                'value'=>"'$data[Aset_ID]',$data[regLama], $data[regBaru], '{$tglUpdate}'",
                );

        $res = $this->db->lazyQuery($sql,$debug,1);
        if ($res) return true;
        return false;
	}

	function updateAset($data, $debug=false)
	{

		// update ke aset

		$tabel = array('A'=>'tanah', 'B'=>'mesin', 'C'=>'bangunan', 'D'=>'jaringan', 'E'=>'asetlain','F'=>'kdp', 'H'=>'aset');
		if ($data){


			// set autocommit = 0
			$this->begin();
			
			$totaldata = count($data);
			$count = 1;
			$olah_tgl = date('Y-m-d H:i:s');
			foreach ($data as $key => $val) {
				
				// $this->db->logIt($tabel=array('aset'), $Aset_ID=$val['Aset_ID'], $kd_riwayat=40, $noDokumen=false, $tglProses =$olah_tgl, $text="Update no register");

				$dataLog = array('Aset_ID'=>$val['Aset_ID'], 'regLama'=>$val['currentReg'], 'regBaru'=>$val['noRegister']);
				$this->logReg($dataLog, $debug);
				
				$noRegister = $val['noRegister'];
				// aset
				$sql2 = array(
		                'table'=>"aset",
		                'field'=>"noRegister = '{$noRegister}'",
		                'condition'=>"Aset_ID='$val[Aset_ID]'",
		                'limit'=>1
		                );

		        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
		        if (!$res2){
		        	$this->rollback();
		        	return false;
		        }
		        // kib
		        $tabelKib = $tabel[$val['TipeAset']];
		        
		        $sql2 = array(
		                'table'=>"{$tabelKib}",
		                'field'=>"noRegister = '{$noRegister}'",
		                'condition'=>"Aset_ID='$val[Aset_ID]'",
		                'limit'=>1
		                );

		        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
		        if (!$res2){
		        	$this->rollback();
		        	return false;
		        }
		        // log aset
		        $sql2 = array(
		                'table'=>"log_aset",
		                'field'=>"noRegister = '{$noRegister}'",
		                'condition'=>"Aset_ID='$val[Aset_ID]'",
		                );

		        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
		        if (!$res2){
		        	$this->rollback();
		        	return false;
		        }
		        // log kib
		        $sql2 = array(
		                'table'=>"log_{$tabelKib}",
		                'field'=>"noRegister = '{$noRegister}'",
		                'condition'=>"Aset_ID='$val[Aset_ID]'",
		                );

		        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
		        if (!$res2){
		        	$this->rollback();
		        	return false;
		        }
		        // kapitalisasi
		        $sql2 = array(
		                'table'=>"kapitalisasi",
		                'field'=>"noRegister = '{$noRegister}'",
		                'condition'=>"Aset_ID='$val[Aset_ID]'",
		                );

		        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
		        if (!$res2){
		        	$this->rollback();
		        	return false;
		        }
		        // mutasiaset
		        $sql2 = array(
		                'table'=>"mutasiaset",
		                'field'=>"NomorRegBaru = '{$noRegister}'",
		                'condition'=>"Aset_ID='$val[Aset_ID]'",
		                );

		        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
		        if (!$res2){
		        	$this->rollback();
		        	return false;
		        }

		        echo "Upate no register " . $count . " dari " .$totaldata. "\n";
		        // $noRegister++;
		        $count++;
			}
			
			
			$this->commit();

			echo "==== Update berhasil ==== \n";
		}
		
	}

}

$register = new noregister;

$debug = $argv[2];

$getSatker = $register->getSatkerTujuan();
// pr($getSatker);
$filterAset = $register->filterData($getSatker);

echo "Jumlah total data = " . count($filterAset) . "\n";

if ($debug) exit;
// echo 'masuk';
$updateAset = $register->updateAset($filterAset);

?>