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
	
	public function insert_id($data)
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
    	pr($sql);
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

	function logIt($table=array(),$Aset_ID=false,$action=1)
	{

	    if (empty($table)) return false;
	    if (empty($Aset_ID)) return false;
	    
	    $date = date('Y-m-d H:i:s');
	    $actionList = array(1=>'insert',2=>'update');
	    $addField = array('changeDate'=>$date,'action'=>$actionList[$action],'operator'=>$_SESSION['ses_uoperatorid']);


	    foreach ($table as $value) {
	    	
	    	// $field['log_id'] = get_auto_increment($value);
			$field = $this->getFieldName($value,$Aset_ID);
			$mergeField = array_merge($field, $addField);
	        
	        if ($mergeField){
	        	foreach ($mergeField as $key => $val) {
	        		$tmpField[] = $key;
	        		$tmpValue[] = "'".$val."'";
	        	}
	        	 
	        	$fileldImp = implode(',', $tmpField);
	        	$dataImp = implode(',', $tmpValue);

	        	$sql = "INSERT INTO log_{$value} ({$fileldImp}) VALUES ({$dataImp})";
	        	// pr($sql); 
	        	$res = $this->query($sql);
	        	if ($res)return true;	
	        	
	        }

	        
	    }

	    return false;
	}
	
}
?>
