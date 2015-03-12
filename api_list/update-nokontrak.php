<?php

include "../config/config.php";


class UpdateKontrak extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}

	function getKontrak($kodeSatker)
	{
		$sql = array(
	            'table'=>"kontrak",
	            'field'=>"noKontrak, keterangan",
	            'condition'=>"kodeSatker LIKE '{$kodeSatker}'",
	            // 'limit'=>10
	            );

	    $res = $this->db->lazyQuery($sql,$debug);
	    if ($res){
	    	foreach ($res as $key => $value) {
	    		$newData[$value['noKontrak']] = $value['keterangan'];
	    	}
	    	return $newData;
	    } 
	    return false;
	}

	function subtituteToAset($data=array(), $kodeSatker=false, $debug=false)
	{

		if ($data){
			$jumlah = 0;
			foreach ($data as $key => $value) {

				$sql = array(
			            'table'=>"aset",
			            'field'=>"Aset_ID, CONCAT('{$value}') AS Info, noKontrak, kodeSatker, TipeAset",
			            'condition'=>"noKontrak LIKE '{$key}%' AND kodeSatker LIKE '{$kodeSatker}'",
			            // 'limit'=>10
			            );

			    $res = $this->db->lazyQuery($sql,$debug);
			    if ($res){

			    	$newData[$key] = $res;
			    	$jumlah += intval(count($res));
			    }
			}

			return array('data'=>$newData, 'jlh'=>$jumlah);
		}
		

		
		return false;
		

		// pr($data);exit;
	}

	function updateKontrakAset($data=array(), $jlh=false, $debug=false)
	{

		if ($data){

			$tabel = array('A'=>'tanah','B'=>'mesin','C'=>'bangunan','D'=>'jaringan', 'E'=>'asetlain','F'=>'kdp');
		

			// pr($data);exit;
			$count = 1;
			foreach ($data as $key => $value) {
				
				foreach ($value as $key => $val) {
					// echo $val['Info'];exit;

					$sql2 = array(
		                    'table'=>"Aset",
		                    'field'=>"Info = '{$val['Info']}'",
		                    'condition'=>"Aset_ID='$val[Aset_ID]' AND kodeSatker LIKE '{$val['kodeSatker']}'",
		                    'limit'=>1
		                    );

		            $res2 = $this->db->lazyQuery($sql2,$debug,2); 

		            $tabelKib = $tabel[$val['TipeAset']];

		            $sql2 = array(
		                    'table'=>"{$tabelKib}",
		                    'field'=>"Info = '{$val['Info']}'",
		                    'condition'=>"Aset_ID='$val[Aset_ID]' AND kodeSatker LIKE '{$val['kodeSatker']}'",
		                    'limit'=>1
		                    );

		            $res2 = $this->db->lazyQuery($sql2,$debug,2); 

		            $sql2 = array(
		                    'table'=>"log_{$tabelKib}",
		                    'field'=>"Info = '{$val['Info']}'",
		                    'condition'=>"Aset_ID='$val[Aset_ID]' AND kodeSatker LIKE '{$val['kodeSatker']}'",
		                    );

		            $res2 = $this->db->lazyQuery($sql2,$debug,2); 

		            echo 'updated Info Aset_ID : '.$val['Aset_ID']. " ke : ".$count. " dari ".$jlh." \n";

		            $count++;
				}
				
				
	            
			}
		}
	}
}


$update = new UpdateKontrak;

$debug = $argv[2];

$kodeSatker = "05.01.01.01";

$getKontrak = $update->getKontrak($kodeSatker);
// pr($getKontrak);
$subtituteToAset = $update->subtituteToAset($getKontrak, $kodeSatker);
// pr($subtituteToAset);exit;
echo "Total Aset : " .$subtituteToAset['jlh'];
if ($debug) exit;
$updateKontrakAset = $update->updateKontrakAset($subtituteToAset['data'], $subtituteToAset['jlh']);
// pr($subtituteToAset);

echo "=====proses update selesai====";
?>
