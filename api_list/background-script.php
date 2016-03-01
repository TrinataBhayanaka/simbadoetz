<?php

include "../config/config.php";


class BackgroundScript extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}


	function getAset($debug=false)
	{

		$sql = array(
	            'table'=>"tmp_penggunaanaset",
	            'field'=>"*",
	            'condition'=>" 1 ",
	            // 'limit'=>10
	            );

	    $res = $this->db->lazyQuery($sql,$debug);
		if ($res){

			echo "====== start update ====== \n";
			$i = 1;
			$count = 1;
			foreach ($res as $key => $value) {

				$sql1 = array(
			            'table'=>"penggunaanaset",
			            'field'=>"*",
			            'condition'=>" Penggunaan_ID = '{$value['Penggunaan_ID']}' AND Aset_ID = '{$value['Aset_ID']}' AND kodeSatker = '{$value['kodeSatker']}' ",
			            );

			    $res1 = $this->db->lazyQuery($sql1,$debug);
			    if ($res1){

			    	foreach ($res1 as $val) {
			    		$sql2 = array(
			                    'table'=>"penggunaanaset",
			                    'field'=>"StatusMutasi = '{$value['StatusMutasi']}', Mutasi_ID = '{$value['Mutasi_ID']}'",
			                    'condition'=>" Penggunaan_ID = '{$value['Penggunaan_ID']}' AND Aset_ID = '{$value['Aset_ID']}' AND kodeSatker = '{$value['kodeSatker']}' ",
			            	);

			            $res2 = $this->db->lazyQuery($sql2,$debug,2); 
			    		
			    		logFile("Update data Penggunaan_ID = {$value['Penggunaan_ID']}, Aset_ID = {$value['Aset_ID']}, kodeSatker = {$value['kodeSatker']}");
			    		echo "insert data ke - $i \n";

			    		$i++;
			    		$count++;

			    		if ($count==200){
			    			sleep(1);
			    			$count = 1;
			    		}
			    		
			    	}
			    }
				
			}
			
			echo "====== finish update ====== \n";
			// return $res;
		}
		
		return false;
	}

	
}


$update = new BackgroundScript;
$data = $update->getAset();
