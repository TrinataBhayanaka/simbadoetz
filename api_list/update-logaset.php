<?php

include "../config/config.php";


class UpdateLog extends DB{

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

	function insertData($res, $noKontrak)
	{

		$count = 1;
	    	foreach ($res as $key => $value) {
	    		

	    		$sql = array(
			            'table'=>"aset",
			            'field'=>"*",
			            'condition'=>"Aset_ID = {$value['Aset_ID']} AND TipeAset = 'H'",
			            // 'limit'=>1
			            );

		    	$res1 = $this->db->lazyQuery($sql,$debug);
		    	if ($res1){

		    		$date = date('Y-m-d H:i:s');
		    		$actionText = "Mutasi sukses";
		    		$tglProses = "2014-12-31";
		    		$action = 3;

		    		$addField = array(
	    				'changeDate'=>$date,
	    				'action'=>$actionText,
	    				'operator'=>1,
	    				'TglPerubahan'=>$tglProses,
	    				'Kd_Riwayat'=>$action,
	    				'Aset_ID_Penambahan'=>0,
	    				'No_Dokumen'=>$noKontrak);

	    		
		    		// pr($value);
		    		$field = $this->db->getFieldName('aset',$value['Aset_ID']);
					$mergeField = array_merge($field, $addField);
			        
					// pr($mergeField);
			        
			        if ($mergeField){

			        	$ignoreField = array('kodeSatker', 'kodeLokasi');

			        	foreach ($mergeField as $key => $val) {
			        		

			        		if (!in_array($key, $ignoreField)){
			        			
			        			$tmpField[] = $key;
			        			$tmpValue[] = "'".$val."'";
			        		}

			        		if ($key == 'NilaiPerolehan') $NilaiPerolehan_Awal = "'".$val."'";
			        		if ($key == 'kodeSatker') $kodeSatker = "'".$value['SatkerAwal']."'";
			        		if ($key == 'kodeLokasi'){

			        			$tmpSatker = explode('.', $value['SatkerAwal']);
			        			$tmpLokasi = explode('.', $val);

			        			$imp = array($tmpLokasi[0],$tmpLokasi[1],$tmpLokasi[2],$tmpSatker[0],$tmpSatker[1],$tmpLokasi[5],$tmpSatker[2],$tmpSatker[3]);
			        			
			        			$implode = implode('.', $imp); 
			        			$kodeLokasi = "'".$implode."'";	
			        		} 


			        	}
			        	
			        	$tmpField[] = 'NilaiPerolehan_Awal';
			        	$tmpField[] = 'kodeSatker';
			        	$tmpField[] = 'kodeLokasi';
			        	$tmpValue[] = $NilaiPerolehan_Awal;
			        	$tmpValue[] = $kodeSatker;
			        	$tmpValue[] = $kodeLokasi;

			        	$fileldImp = implode(',', $tmpField);
			        	$dataImp = implode(',', $tmpValue);

			        	// pr($fileldImp);
			        	// pr($dataImp);exit;
			        	$sql = "INSERT INTO log_aset ({$fileldImp}) VALUES ({$dataImp})";
			        	logFile($sql);
			        	if ($debug){
			        		pr($sql); exit;
			        	}
			        	$res = $this->query($sql);
			        	if ($res){
			        		
			        		// logFile($res);
			        		logFile('action = '.$action);
			        		usleep(100);
			        		
			        		if ($action==3){
			        			$insert_id = $this->insert_id();

			        			$sqlu = "UPDATE log_aset SET TglPembukuan = '{$tglProses}' WHERE log_id = {$insert_id} LIMIT 1";
			        			logFile($sqlu);
			        			$result = $this->query($sqlu);
			        		}
			        		usleep(100);
			        		if ($action==28){
			        			$insert_id = $this->insert_id();

			        			$sqlu = "UPDATE log_aset SET StatusValidasi = 1, Status_Validasi_Barang = 1, StatusTampil = 1 WHERE log_id = {$insert_id} LIMIT 1";
			        			logFile($sqlu);
			        			$result = $this->query($sqlu);
			        		}
			        			
			        	}
			        }
			        
		    	}

		    	echo "insert data ke -".$count."\n";
		    	$count++;
	    	}
	}

	function getAsetData($mutasiid=false)
	{
		$sql = array(
	            'table'=>"mutasiaset",
	            'field'=>"Aset_ID, SatkerAwal",
	            'condition'=>"Mutasi_ID = {$mutasiid}",
	            // 'limit'=>1
	            );

	    $res = $this->db->lazyQuery($sql,$debug);
	    if ($res){

	    	return $res;
	    	// pr($res);
	    }

	    return false;
	}
}


$update = new UpdateLog;

$mutasiid = $argv[2];
$noKontrak = $argv[3];
$debug = $argv[4];

// $mutasiid = "943";
// $noKontrak = "050/D/0066/DIKPORA/2014";
// pr($argv);
$getKontrak = $update->getAsetData($mutasiid);
// pr($getKontrak);

echo "Jumlah data = ". count($getKontrak)."\n";
if ($debug) exit;

$runLog = $update->insertData($getKontrak, $noKontrak);
echo "=====proses update selesai====";

exit;
$subtituteToAset = $update->subtituteToAset($getKontrak, $kodeSatker);
// pr($subtituteToAset);exit;
echo "Total Aset : " .$subtituteToAset['jlh'];

$updateKontrakAset = $update->updateKontrakAset($subtituteToAset['data'], $subtituteToAset['jlh']);
// pr($subtituteToAset);

echo "=====proses update selesai====";
?>
