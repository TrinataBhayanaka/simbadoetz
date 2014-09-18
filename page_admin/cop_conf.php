<?php
//defined('_SIMBADA_2012_') or die ('Forbidden Access');

const APPPATH = './';
const APPAUTH = 'SIMBADA TEAM';
const APPEMAIL = '';
const APPVERSION = '1.0';

class SystemConfig
{
	private $db_host = 'localhost';
	private $db_user = 'root';
	private $db_pass = 'master';
	private $db_name = 'db_simbada_rev_1';
	
	/*
	 * Configurasi untuk database Online
	 * 
	private $db_host = 'localhost';
	private $db_user = 'root';
	private $db_pass = 'root';
	private $db_name = 'db_kampus_newsletter';
	*/
	
	private $connect;
	private $database;
	
	public function openConnection()
	{
		$this->connect = $DBVAR->pconnect($this->db_host,$this->db_user,$this->db_pass) or die ($DBVAR->error());
		
		if ($this->connect)
		{
			return $this->connect;
			//return $connection = 1;
		}
		else
		{
			return $this->connect = 0;
		}
	}
	
	public function getDBConn()
	{
		$this->connect = $this->openConnection();
		
		if ($this->connect)
		{
			$this->database = $DBVAR->select_db($this->db_name, $this->connect) or die ($DBVAR->error());
			
			if ($this->database)
			{
				return $this->database; 
			}
			else
			{
				return $this->database = 0;
			}
		}
		
	} 
	
}

?>
