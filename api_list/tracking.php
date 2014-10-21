<?php
ob_start();
include "../config/config.php";

class Tracking{

	function __construct()
	{
		global $DBVAR;
		$this->db = $DBVAR;
	}

	function run($id)
	{
		$data['aset'] = $this->getAset($id);
		$data['penggunaan'] = $this->getPenggunaan($id);
		$data['mutasi'] = $this->getUsulanMutasi($id);

		return $data;
	}

	function getPenggunaan($id)
	{

		$sql = array(
	            'table'=>"penggunaanaset",
	            'field'=>"*",
	            'condition'=>"Aset_ID={$id}",
	            );

	    $result2 = $this->db->lazyQuery($sql,$debug);
	    if ($result2){

	    	foreach ($result2 as $key => $value) {
	    		$sql = array(
			            'table'=>"penggunaan",
			            'field'=>"*",
			            'condition'=>"Penggunaan_ID={$value['Penggunaan_ID']}",
			            );

			    $result2[$key]['penggunaan'] = $this->db->lazyQuery($sql,$debug);
	    	}
	    	
	    	return $result2;
	    } 
	}

	function getAset($id)
	{

		$sql = array(
	            'table'=>"aset",
	            'field'=>"*",
	            'condition'=>"Aset_ID={$id}",
	            );

	    $result2 = $this->db->lazyQuery($sql,$debug);
	    if ($result2) return $result2;
	    return false;
	}

	function getUsulanMutasi($id)
	{

		$sql = array(
	            'table'=>"mutasiaset",
	            'field'=>"*",
	            'condition'=>"Aset_ID={$id}",
	            );

	    $result2 = $this->db->lazyQuery($sql,$debug);
	    if ($result2){

	    	foreach ($result2 as $key => $value) {
	    		$sql = array(
			            'table'=>"mutasi",
			            'field'=>"*",
			            'condition'=>"Mutasi_ID={$value['Mutasi_ID']}",
			            );

			    $result2[$key]['mutasi'] = $this->db->lazyQuery($sql,$debug);
	    	}
	    	
	    	return $result2;
	    } 
	    return false;
	}

}


$TRACKING = new Tracking;

$id = $_GET['id'];
$getData = $TRACKING->run($id);
pr($getData);

?>
