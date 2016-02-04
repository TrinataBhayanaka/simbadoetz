<?php 

/* Class Name = DB
 * Variabel Input : query, result, connect, numRec
 * Variabel Input Type : Protected
 * Created By : Ovan Cop
 * Class Desc : Kumpulan fungsi database (db helper)
 */

class DB
{
	protected $query;
	protected $result;
	protected $connect;
	protected $numRec;
   	protected $url_rewrite;
   	protected $path;
	
	public function __construct()
	{
		$this->connect = open_connection();
	  	$this->path = $GLOBALS['path'];
	  	$this->url_rewrite = $GLOBALS['url_rewrite'];
	  	$this->url_rewrite_report = $GLOBALS['url_rewrite_report'];
	  //echo $this->path;
	}
	
	
	
	public function query($data)
	{
		
		$this->query = mysql_query($data);// or die (mysql_error());
		logFile($data,'Log-query-'.date('Y-m-d'));
		return $this->query;
	}
	
	public function fetch_object($data)
	{
		$this->result = $data;
		return mysql_fetch_object($this->result);
		
	}
	
	public function _fetch_object($data, $param)
	{
		$this->result = $this->query($data);// or die ($this->error);
		if ($this->num_rows($this->result))
		{
			if ($param == true)
			{
				while ($data = $this->fetch_object($this->result))
				{
					$dataArray[] = $data;
				}
			}
			else
			{
				$data = $this->fetch_object($this->result);
				$dataArray[] = $data;
			}
			
			
			return $dataArray;
		}
	}
	
	public function _fetch_array($data, $param)
	{
		$this->result = $this->query($data);// or die ($this->error);
		$row = $this->num_rows($this->result);
		
		if ($row)
		{
			
			if ($param == true)
			{
				while ($data = $this->fetch_array($this->result))
				{
					$dataArray[] = $data;
				}
			}
			else
			{
				$data = $this->fetch_array($this->result);
				$dataArray = $data;
			}
			
			
			return $dataArray;
		}
		
	}
	
	public function fetch_array($data)
	{
		$this->result = $data;
		if ($this->result)return mysql_fetch_array($this->result);
		else return false;
		
	}
	
	public function fetch_field($data)
	{
		$this->result = $data;
		
		return mysql_fetch_field($this->result);
	}
	
	public function num_rows($data)
	{
		// pr($data);
		// exit;
		if ($data !='')
		{
			$this->numRec = mysql_num_rows($data);
			if ($this->numRec) return $this->numRec;
			else return false;
		}
		
	}
	
	public function insert_id($data=false)
	{
		return mysql_insert_id();
	}
	
	public function close_connection()
	{
		return mysql_close();
	}
	
	public function error()
	{

		$message = 'Your query error, please check again';
		return $message;
	}
	
	public function clear_var($data)
	{
		return $$data = '';
	}

	function autocommit($val=0,$dbuse=0)
	{
		$command = "SET autocommit={$val};";
		$result = $this->query($command) or die ($this->error('autocommit failed'));
		// if (!$this->link){
			// $this->link = $this->open_connection(0);
		// }
		
		// return mysql_autocommit($this->link, false);
		
	}
	
	function commit($dbuse=0)
	{
		$command = "COMMIT;";
		$result = $this->query($command) or die ($this->error('commit failed'));
		// mysql_commit();
	}
	
	function rollback($dbuse=0)
	{
		$command = "ROLLBACK;";
		$result = $this->query($command) or die ($this->error('rollback failed'));
		// if (!$this->link){
			// $this->link = $this->open_connection(0);
		// }
		
		// pr($this->link);
		// mysql_rollback($this->link);
		
	}
	
	function begin($dbuse=0)
	{
		
		$this->autocommit();
		$command = "START TRANSACTION;";
		$result = $this->query($command) or die ($this->error('commit failed'));
		// if (!$this->link){
			// $this->link = $this->open_connection(0);
			
		// }
		// mysql_
		// $res = mysql_begin_transaction($this->link);
		if ($result) return true;
		return false;
	}
	
	
	public function is_table_exists($data, $status)
	{
		global $CONFIG;
		
		if ($data){
			$sql = "SELECT COUNT(*) AS tabel FROM information_schema.tables WHERE table_schema = '{$CONFIG['default']['db_name']}' AND table_name = '{$data}'";
			// pr($sql);
			// exit;
			
			$res = $this->_fetch_array($sql,0);
			// pr($sql);
			if ($res['tabel']){

				if ($status){
					return TRUE;
				}else{
					$sql = "DROP VIEW {$data}";
					$res = $this->query($sql);
					
					if ($res) return TRUE;
					return FALSE;
				}
				
			}
			return FALSE;
		}else{
			return FALSE;
			
		}
		
	}
	public function ceck_table($data, $status)
	{
		global $CONFIG;
		
		if ($data){
			$sql = "SELECT COUNT(*) AS tabel FROM information_schema.tables WHERE table_schema = '{$CONFIG['default']['db_name']}' AND table_name = '{$data}'";
			// pr($sql);
			// exit;
			$res = $this->_fetch_array($sql,0);
			return $res; 
			
		}
		
	}
	
	
	public function form_validation($data)
	{
		$valid_post_vars = $data;
							
		$dataArr = array ();			
		foreach ($valid_post_vars as $key => $value) {
			//echo $key;
			//echo $value;
			//$prefix_post_vars = "p_";
			//$valid_post_var_name = $prefix_post_vars . $i_vpv;
			
			$valid_post_var_value = trim(htmlspecialchars($value));
			
			//$$valid_post_var_name = $valid_post_var_value;

			$dataArr[$key] = $valid_post_var_value;
			
		}
		
		return $dataArr;
		//print_r($dataArr);
	}
	
	
	
	
	
//-------- library function report -----------------------------------------------
	
	
	public function __get_all_table($query)
	{
	    $this->result = $this->query($query['query']);
	    
	    if ($this->num_rows($this->result))
	    { 
		while ($data = $this->fetch_object($this->result))
		{
		    $dataObject[$query['table']][] = $data; 
		}
		
		return $dataObject[$query['table']];
	    }
	    
	}


	function getFieldName($table=false,$Aset_ID=false)
	{

		if (!$table) return false;
		if (!$Aset_ID) return false;

		$sql = "SELECT * FROM {$table} WHERE Aset_ID = {$Aset_ID}";
    	logFile($sql);
    	$res = $this->query($sql);

        $result = mysql_fetch_assoc($res);

        // while ($data = mysql_fetch_array($res)){
        // 	pr($data);
        // }
  //       $numfields = mysql_num_fields($res);
  //       for ($i=0; $i < $numfields; $i++) // Header
		// { 
		// 	$field[] = mysql_field_name($res,$i);
		// }

		// pr($result);
		return $result;
	}

	function logIt($table=array(),$Aset_ID=false,$action=1, $No_Dokumen=false, $tgl=false, $text= false, $tmpAsetID=false, $debug=false)
	{

	    if (empty($table)) return false;
	    if (empty($Aset_ID)) return false;
	    
	    if ($text) $actionText = $text;
	    else $actionText = $action;

	    $date = date('Y-m-d H:i:s');
	    if ($tgl) $tglProses = $tgl;
	    else $tglProses = '0000-00-00';

	    if ($No_Dokumen) $noDok = $No_Dokumen;
	    else $noDok = '-';

	    if ($tmpAsetID) $tmpAsetIDTujuan = $tmpAsetID;
	    else $tmpAsetIDTujuan = '-';
	    
	    $actionList = array(1=>'insert',2=>'update');
	    $addField = array(
	    				'changeDate'=>$date,
	    				'action'=>$actionText,
	    				'operator'=>$_SESSION['ses_uoperatorid'],
	    				'TglPerubahan'=>$tglProses,
	    				'Kd_Riwayat'=>$action,
	    				'Aset_ID_Penambahan'=>$tmpAsetIDTujuan,
	    				'No_Dokumen'=>$noDok);


	    foreach ($table as $value) {
	    	
	    	// $field['log_id'] = get_auto_increment($value);
			$field = $this->getFieldName($value,$Aset_ID);
			$mergeField = array_merge($field, $addField);
	        
	        if ($mergeField){
	        	foreach ($mergeField as $key => $val) {
	        		$tmpField[] = $key;
	        		$tmpValue[] = "'".$val."'";

	        		if ($key == 'NilaiPerolehan') $NilaiPerolehan_Awal = "'".$val."'";
	        	}
	        	
	        	$tmpField[] = 'NilaiPerolehan_Awal';
	        	$tmpValue[] = $NilaiPerolehan_Awal;

	        	$fileldImp = implode(',', $tmpField);
	        	$dataImp = implode(',', $tmpValue);

	        	$sql = "INSERT INTO log_{$value} ({$fileldImp}) VALUES ({$dataImp})";
	        	logFile($sql);
	        	if ($debug){
	        		pr($sql); exit;
	        	}
	        	$res = $this->query($sql);
	        	if ($res){
	        		
	        		logFile($res);
	        		logFile('action = '.$action);
	        		usleep(100);
	        		
	        		if ($action==3){
	        			$insert_id = $this->insert_id();

	        			$sqlu = "UPDATE log_{$value} SET TglPembukuan = '{$tglProses}' WHERE log_id = {$insert_id} LIMIT 1";
	        			//logFile($sqlu);
	        			//$result = $this->query($sqlu);
	        		}
	        		usleep(100);
	        		if ($action==28){
	        			$insert_id = $this->insert_id();

	        			$sqlu = "UPDATE log_{$value} SET StatusValidasi = 1, Status_Validasi_Barang = 1, StatusTampil = 1 WHERE log_id = {$insert_id} LIMIT 1";
	        			logFile($sqlu);
	        			$result = $this->query($sqlu);
	        		}
	        			
	        	}
	        }

	        
	    }
	    logFile('class_db :: insert log sukses');
	    return true;
	}
	function logItHPS($table=array(),$Aset_ID=false,$action=1, $No_Dokumen=false, $tgl=false,$Nilai_awal=false, $debug=false)
	{

	    if (empty($table)) return false;
	    if (empty($Aset_ID)) return false;
	    
	    $date = date('Y-m-d H:i:s');
	    if ($tgl) $tglProses = $tgl;
	    else $tglProses = '0000-00-00';

	    if ($No_Dokumen) $noDok = $No_Dokumen;
	    else $noDok = '-';

	    $actionList = array(1=>'insert',2=>'update');
	    $addField = array(
	    				'changeDate'=>$date,
	    				'action'=>$action,
	    				'operator'=>$_SESSION['ses_uoperatorid'],
	    				'TglPerubahan'=>$tglProses,
	    				'Kd_Riwayat'=>$action,
	    				'No_Dokumen'=>$noDok,
	    				'NilaiPerolehan_Awal'=>$Nilai_awal);


	    foreach ($table as $value) {
	    	
	    	// $field['log_id'] = get_auto_increment($value);
			$field = $this->getFieldName($value,$Aset_ID);
			$mergeField = array_merge($field, $addField);
	        
	        if ($mergeField){
	        	foreach ($mergeField as $key => $val) {
	        		$tmpField[] = $key;
                                if($key=="StatusValidasi")
                                    $val="1";
                                elseif($key=="Status_Validasi_Barang")
                                    $val="1";
                                elseif($key=="StatusTampil")
                                    $val="1";
	        		$tmpValue[] = "'".$val."'";

	        		// if ($key == 'NilaiPerolehan') $NilaiPerolehan_Awal = "'".$val."'";
	        	}
	        	
	        	// $tmpField[] = 'NilaiPerolehan_Awal';
	        	// $tmpValue[] = $NilaiPerolehan_Awal;

	        	$fileldImp = implode(',', $tmpField);
	        	$dataImp = implode(',', $tmpValue);

	        	$sql = "INSERT INTO log_{$value} ({$fileldImp}) VALUES ({$dataImp})";
	        	logFile($sql);
	        	if ($debug){
	        		pr($sql); exit;
	        	}
	        	$res = $this->query($sql);
	        	if ($res)return true;	
	        	
	        }

	        
	    }
	    logFile('class_db :: Gagal insert log');
	    return false;
	}
	public function fetch($data=false, $loop=false, $dbuse=0)
	{
		/* $dbuse [0] = config default database */
		// pr($dbuse);
		
		if (!$data) return false;
		
		$dataArray = array();
		
		$var_result = $this->query($data) or die (mysql_error());
		if ($loop){
			if ($this->num_rows($var_result)){

				while ($data = mysql_fetch_assoc($var_result)){
						$dataArray[] = $data;
				}
				
				return $dataArray;
			}else{
				return false;
			}
		}else{
			
			$dataArray = mysql_fetch_assoc($var_result);
			
			return $dataArray;
		}
		
	}

	function lazyQuery($data=array(), $debug=false, $method=0)
	{


		/*
		How to use lazyQuery !!!

		$sql1 = array(
                'table'=>'satker AS s, aset AS a, log_aset l',
                'field'=>'s.Satker_ID, s.KodeSektor, a.Aset_ID, l.last_aset_id',
                'condition'=>'s.Satker_ID IN(1,2)',
                'limit' => 5,
                'joinmethod' => 'LEFT JOIN',
                'join' => 's.Satker_ID = a.Aset_ID, a.Aset_ID = l.Aset_ID' 
                );
		*/

		$table = $data['table'];
		$field = $data['field'];

		switch ($method) {
			case '0':
				
				$condition = $data['condition'];
				$limit = $data['limit'];
				
				if ($limit) $limit = " LIMIT {$limit}";
				else $limit = "";
				$where = "";
				if ($condition) $whereCondition = " {$condition} ";
				else $whereCondition = " 1 ";

				$jointmp = $data['join'];
				$join = explode(',', $jointmp);

				$joinmethod = $data['joinmethod'];
				if ($joinmethod){
					$tmpTable = explode(',', $table);
					$length = count($tmpTable);

					$joinIndex = 0;
					for ($i=1; $i<$length; $i++){
						$tatement[] = $joinmethod . $tmpTable[$i] . ' ON ' . $join[$joinIndex];
						$joinIndex++;
					}

					$tmpStatement = implode(' ',$tatement);

					$primaryTable = $tmpTable[0];

					$sql = "SELECT {$field} FROM {$primaryTable} {$tmpStatement} WHERE {$whereCondition} {$limit}";
				}else{
					$sql = "SELECT {$field} FROM {$table} WHERE {$whereCondition} {$limit}";
				}

				logFile($sql,'Log-lazyquery '.date('Y-m-d'));
				

				if ($debug){
					if ($debug>1){
						pr($sql);
					}else{
						pr($sql);
						exit;	
					} 
					
				}
				if (!$debug) $res = $this->fetch($sql,1);
				if ($res) return $res;

			break;
			
			case '1':
				/*
				$sql = array(
                'table'=>'aset',
                'field'=>'Aset_ID, KodeSetkor',
                'value'=>'111,1010',
                );
				*/
				$value = $data['value'];

				$sql = "INSERT INTO {$table} ({$field}) VALUES ({$value})";
				if ($debug){
					if ($debug>1){
						pr($sql);
					}else{
						pr($sql);
						exit;	
					} 
					
				}
				logFile($sql,'Log-lazyquery '.date('Y-m-d'));
				if (!$debug) $res = $this->query($sql);
				if ($res) return true;

			break;

			case '2':
				/*
				$sql = array(
                'table'=>'aset',
                'field'=>'Aset_ID = 1, KodeSatker = 1010',
                'condition'=>'Status_Validasi_Barang = 1',
                );
				*/
				$condition = $data['condition'];
				$limit = intval($data['limit']);
				if ($limit>0) $limit = " LIMIT {$limit}";
				else $limit = "";

				$sql = "UPDATE {$table} SET {$field} WHERE {$condition} {$limit}";
				if ($debug){
					if ($debug>1){
						pr($sql);
					}else{
						pr($sql);
						exit;	
					} 
					
				}
				logFile($sql,'Log-lazyquery '.date('Y-m-d'));
				if (!$debug)$res = $this->query($sql);
				if ($res) return true;

			break;

			case '3':
				/*
				$sql = array(
                'table'=>'aset',
                'field'=>'Aset_ID = 1, KodeSatker = 1010',
                'condition'=>'Status_Validasi_Barang = 1',
                );
				*/
				$condition = $data['condition'];
				$limit = intval($data['limit']);
				if ($limit>0) $limit = " LIMIT {$limit}";
				else $limit = "";

				$sql = "DELETE FROM {$table} WHERE {$condition} {$limit}";
				if ($debug){
					if ($debug>1){
						pr($sql);
					}else{
						pr($sql);
						exit;	
					} 
					
				}
				if (!$debug)$res = $this->query($sql);
				if ($res) return true;

			break;

			default:
				pr('Method no defined');
				exit;
				break;
		}

		
		return false;
	}
	
	function countData($sql=false,$debug=false)
	{

		if (array_key_exists('limit', $sql)){
			unset($sql['limit']);
		}

		$sql['field'] = "COUNT(1) AS total";		
		$res = $this->lazyQuery($sql,$debug);
		return $res;
	}

	function log($activity_id=1, $desc=array(), $debug=false)
	{	
		$activity_desc = "";
		if ($desc) $activity_desc = serialize($desc);
		$user_id = $_SESSION['ses_uoperatorid'];
		$datetimes = date('Y-m-d H:i:s'); 
        $source = $_SERVER['REMOTE_ADDR'];

		$sql = array(
	            'table'=>'activity_log',
	            'field'=>"user_id, activity_id, activity_desc, source, datetimes",
	            'value' => "{$user_id}, '{$activity_id}','{$activity_desc}', '{$source}', '{$datetimes}'",
	            );
        $res = $this->lazyQuery($sql,$debug,1);
	}
}
?>
