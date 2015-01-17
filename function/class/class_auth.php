<?php

/* Class name = UserAuth
 * Variabel Input Type= Array
 * Output = true / false / Array
 *
 * Created by : Ovan Cop
 * Date : 2012-07-31
 */

class UserAuth
{
    protected $connect;
    protected $session;
    protected $DBVAR;
    
    public function __construct()
    {
		$this->DBVAR = new DB;
		$this->session = new Session;
	}
    
    public function check_login_user($dataUser)
	{
            if ($dataUser['is_login']){
				$query = "SELECT O.*,S.NamaSatker,S.KodeSatker, S.kode FROM Operator O left join Satker S on O.Satker_ID=S.Satker_ID WHERE OperatorID = {$dataUser['is_login']} LIMIT 1";
			}else{
				if ($dataUser['token'] == 1){
				
					$query = "SELECT O.*,S.NamaSatker,S.KodeSatker,S.kode FROM Operator O left join Satker S on O.Satker_ID=S.Satker_ID WHERE UserNm ='$dataUser[username]' AND Passwd ='$dataUser[password]' AND AksesAdmin = 1 LIMIT 1";
				}else{
					$query = "SELECT O.*,S.NamaSatker,S.KodeSatker,S.kode FROM Operator O left join Satker S on O.Satker_ID=S.Satker_ID WHERE UserNm ='$dataUser[username]' AND Passwd ='$dataUser[password]' LIMIT 1";
				}
			}
			
			
			
			
			
			// cek login admin
			$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
			$sumRec = $this->DBVAR->num_rows($result);
			
			if ($sumRec){
				$data = $this->DBVAR->fetch_array($result);
				
				$query = "SELECT * FROM tbl_user_group WHERE groupID = $data[JabatanOperator] LIMIT 1";
				if ($this->DBVAR->num_rows($result)){
					
					$dataGroup = $this->DBVAR->fetch_array($result); 
					$group = $this->DBVAR->_fetch_object($query, FALSE);
					if($group){
						$clear_session = new DELETE;
						
						$sql = "SELECT tambah, ubah, hapus, cetak FROM sys_userlevelaccess WHERE userlevelaccess_id = {$group[0]->groupID}";
						$dataGroup['akses_modul'] = $this->DBVAR->_fetch_object($sql, FALSE);
						
						if ($dataUser['token'] == 1){
							
							if ($group[0]->groupAccessAdmin == 1){
								// $this->setSession = new Session;
								$this->session->set_admin_session($data, $dataGroup);
								$clear_session->reset_table_apl_userasetlist(array('user'=>$data['UserNm']));
								$this->write_sys_log_when_login('Admin start login');
								
								$userSession = $this->session->get_session_admin();
								$dataUserLogin = array('id'=>$data['OperatorID'], 'session'=>$userSession);
								
								
							}
							else{
								return false;
							}
						}
						else{
							// $this->setSession = new Session;
							$this->session->set_user_session($data, $dataGroup);
							$clear_session->reset_table_apl_userasetlist(array('user'=>$data['UserNm']));
							$this->write_sys_log_when_login('User start login');
							
							$userSession = $this->session->get_session_user();
							$dataUserLogin = array('id'=>$data['OperatorID'], 'session'=>$userSession);
						}	
					}
					return true;
				}
			
			}else{
				return false;
			}
    }
    
    public function FrontEnd_check_akses_menu($menu_id, $SessionUser)
    {
		global $url_rewrite;

		if ($SessionUser['ses_uid'] == ''){
			$query = "SELECT menuID FROM tbl_user_menu WHERE menuAksesLogin = 1 AND menuStatus = 1 ";
			$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
			while ($data = $this->DBVAR->fetch_object($result))
			{
				$dataArr [] = $data->menuID;
			}
			
			if (in_array($menu_id, $dataArr))
			{
				echo "<script type=text/javascript>alert('Maaf anda harus login dahulu'); window.location.href=$url_rewrite;</script>";
			}
			
			
		}else{
			$query = "SELECT menuID FROM tbl_user_menu WHERE menuStatus = 0";
			$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
			while ($data = $this->DBVAR->fetch_object($result))
			{
				$dataArr [] = $data->menuID;
			}
			
			if (is_array($dataArr)){
				if (in_array($menu_id, $dataArr))
				{
					echo '<script type=text/javascript>alert("Maaf anda harus login dahulu"); history.back();</script>';
				}
			}
		}
	
    }
    
    public function FrontEnd_show_menu($SessionUser)
    {
		$query = "SELECT * FROM tbl_user_menu WHERE menuStatus = 1 ";
		$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
		while ($menu_active = $this->DBVAR->fetch_object($result)){
			$menuArr [] = $menu_active->menuID;
		}
		
		if ($SessionUser['ses_uoperatorid'] !='')
		{
			$query = "SELECT * FROM Operator WHERE OperatorID = '$SessionUser[ses_uoperatorid]'";
		}else{
			$query = "SELECT menuID FROM tbl_user_menu WHERE menuAksesLogin = 0";
			
		}
	
		$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
	
		if ($this->DBVAR->num_rows($result)){
			if($SessionUser['ses_uoperatorid'] !=''){
				$data = $this->DBVAR->fetch_object($result);
				$menu = explode (',',$data->Hak_Akses);
				
				foreach ($menu as $value){
					if (in_array($value, $menuArr)) $show_menu [] = $value;
				}
			}else{
				while ($data = $this->DBVAR->fetch_object($result)){
					$menu[] = $data->menuID;
				}
				
				foreach ($menu as $value){
					if (in_array($value, $menuArr)) $show_menu [] = $value;
				}
			
			}
		
		}
            
		$query = "SELECT * FROM tbl_user_menu_parent WHERE menuOrder != 0 ORDER BY menuOrder ";
		$dataParent = $this->DBVAR->fetch($query,1);

		// pr($dataParent);
		// pr($show_menu);
        // Variabel untuk disable menu berdasarkan ID
        $listMenu = array();
	    
	    
	    // pr($newData);

		foreach ($show_menu as $value){
		    $query = "SELECT a.*, b.* FROM tbl_user_menu AS a LEFT JOIN tbl_user_menu_parent AS b 
					    ON a.menuParent = b.menuParentID WHERE a.menuID = {$value}";
		    // pr($query);
			$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());	
		    
		    if ($this->DBVAR->num_rows($result))
		    {
			    $data = $this->DBVAR->fetch_object($result);
			    
			    $list[$data->menuParentDesc][$data->menuID] = $data->menuDesc;
			    (!in_array($value, $listMenu)) ? $menuPath[$data->menuID] = $data->menuPath : $menuPath[] = '#';
			    
		    }
		    
	    }
	    
	    // pr($list);
	    $newList = array();
	    if ($list){
	    	foreach ($dataParent as $key => $value) {
		    	if ($list[$value['menuParentDesc']]){
		    		$newList[$value['menuParentDesc']] = $list[$value['menuParentDesc']];
		    	}
		    	
		    }	
	    }
	    

	    // pr($newList);
	    return array ($newList, $menuPath);
        
    }
    
    public function check_sys_log ()
    {
	
		$query = "SELECT log_id FROM sys_logs WHERE log_id = '$_SESSION[ses_uid]' and UserNm = '$_SESSION[ses_uname]'";
		$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
		$data = $this->DBVAR->fetch_object($result);
		
		if ($_SESSION['ses_uid'] !== $data->log_id){
			$query_apl_userlist = "DELETE FROM apl_userasetlist WHERE UserNm = '$_SESSION[ses_uname]' AND UserSes = '$data->log_id'";
			$result_apl_userlist = $this->DBVAR->query($query) or die ($this->DBVAR->error());
		}
	
		return true;
    }
    
    public function write_sys_log_when_login ($messg)
    {
		$date = date('Y-m-d H:i:s');
		$query = "INSERT INTO sys_logs VALUES ('$_SESSION[ses_uid]', '$_SESSION[ses_uname]', '$date', '$messg')";
		$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
		
		return true;
	}
		
	public function write_sys_log_to_file ($messg)
	{
		global $CONFIG;
		$path = $CONFIG['default']['app_path'];
		//$path = $CONFIG['default']['log_path'];
		$handle = "$path/log/log_sys.txt";
		$myFile = $handle;
		$fh = fopen($myFile, 'a') or die("can't open file");
		$stringData = "Last activity username $_SESSION[ses_uname] ".$no." ON Date : ".date('Y-m-d h:i:s')." = $messg \n";
		fwrite($fh, $stringData);
		fclose($fh);
    }
    
    
    public function admin_set_menu_status ($sessi)
    {
	if ($sessi['ses_ajabatan'] == '1')
	{
	    // Administrator
	    $status_menu = array('adm_menu'=> true, 'kel_jabatan'=>true, 'user'=>true, 'skpd'=>true, 'ngo'=>true, 'pejabat'=>true,
				 'button_adm'=>true, 'button_kel_pejabat'=>true);
	    
	}
	else
	{
	    // User lain
	    $status_menu = array('adm_menu'=> false, 'kel_jabatan'=>false, 'user'=>false, 'skpd'=>true, 'ngo'=>true, 'pejabat'=>true,
				 'button_adm'=>false, 'button_kel_pejabat'=>false);
	}
	
	//$_SESSION['menu_status'] = $status_menu;
	
	return $status_menu;
    }
    
    /*public function admin_validasi_submit_button ($sessi)
    {
	
    }*/
    
    public function show_warning($data)
    {
	($data !='') ? $msg = $data : $msg = 'Warning not defined';
	
	return $msg;
	
	
    }
	
	function is_user_login()
	{
		$session_id = session_id();
		// $sql = "SELECT DISTINCT (id) FROM tbl_is_login WHERE n_status = 1 AND session = '{$session_id}'";
		$sql = "SELECT DISTINCT (id), session FROM tbl_is_login WHERE n_status = 1";
		// pr($sql);
		$res = $this->DBVAR->_fetch_array($sql,1);
		if ($res){
			foreach ($res as $value){
				$data[$value['id']] = $value['session'];
			}
			// pr($res);
			return $data;
		}
		return FALSE;
		
	}
    
	function set_user_login($data)
	{
		$sess = serialize($data);
		$sql = "INSERT INTO tbl_is_login (id, session, start_login, n_status) VALUES ('{$data['id']}', '{$sess}',
				Now(), 1)";
		$res = $this->DBVAR->query($sql);
		if ($res) return $res;
		return FALSE;
		
	}
	
	function is_user_logout($data)
	{
		
		$sql = "UPDATE tbl_is_login SET end_login = NOW(), n_status = 0 WHERE id = $data AND n_status = 1";
		// pr($sql);
		$res = $this->DBVAR->query($sql);
		if ($res) return TRUE;
		return FALSE;
	}
	
	function activate_user_again($data)
	{
		$session_id = session_id();
		
		// pr($data);
		foreach ($data as $key => $value){
			$user_sess[$key] = unserialize($value);
		}
		
		
		foreach ($user_sess as $keys => $user){
			// echo 'data sessi = '.$user['session']['ses_uid'];
			if ($user['session']['ses_uoperatorid'] == $keys){
				$id = $keys;
				// echo 'ada';
			}
		}
		// pr($id);
		
		
		if ($id){
			$datauser['ses_uid'] = $user_sess[$id]['session']['ses_uid'];
			$datauser['OperatorID'] = $user_sess[$id]['session']['ses_uoperatorid'];
			$datauser['UserNm'] = $user_sess[$id]['session']['ses_uname'];
			$datauser['AksesAdmin'] = $user_sess[$id]['session']['ses_uaksesadmin'];
			$datauser['Satker_ID'] = $user_sess[$id]['session']['ses_usatkerid'];
			$datauser['NamaOperator'] = $user_sess[$id]['session']['ses_unamaoperator'];
			$datauser['JabatanOperator'] = $user_sess[$id]['session']['ses_ujabatan'];
			$datauser['Hak_Akses'] = $user_sess[$id]['session']['ses_uhakakses'];
			$dataGroup['groupShowMenu'] = $user_sess[$id]['session']['ses_ushowmenu'];
			$dataGroup['groupAccessMenu'] = $user_sess[$id]['session']['ses_ujabatanaksesmenu'];
			$dataGroup['akses_modul'] = $user_sess[$id]['session']['ses_uCRUD_modul'];
			
			// echo $datauser['OperatorID'];
			$this->session->set_user_session($datauser, $dataGroup);
			
			return TRUE;
		}else{
			return FALSE;
		}
		
	}
	
	
    public function show_warning_html ($messg)
    {
	?>
	<script type="text/javascript">
	    function back()
	    {
		history.back();
	    }
	</script>
	<div align="center" style="border-style:solid; width:30%; margin:40px auto; border-width:1px; box-shadow:3px 3px 3px #ccd">
	    <table border="0">
		<tr>
		    <th><?php echo $messg; ?> <hr></th>
		</tr>
		<tr>
		    <td><p style="font-size: 12px; color: #666;">Aktifitas <u>tidak</u> diizinkan, silahkan hubungi <i><b>Administrator</b></i></p></td>
		</tr>
		<tr>
		    <td align="right"><p style="font-size:14px;"><span href="#" onclick="back()"><u>Kembali</u></span></p></td>
		</tr>
	    </table>
	</div>
	
	<?php
    }
    
    public function admin_check_akses_group_to_admin($param)
    {
	$query = "SELECT groupID FROM tbl_user_group WHERE groupAccessAdmin = 1 AND groupID = $param";
	//print_r($query);
	$result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
	$count = $this->DBVAR->num_rows($result);
	
	if ($count)
	{
	    return true;
	}
	else
	{
	    return false;
		
	}
    }
    
    public function admin_retrieve_app_conf($NAMA_KABUPATEN)
    {
        
        $query = "SELECT * FROM tbl_app_config WHERE app_location_desc = '".trim($NAMA_KABUPATEN)."'";    
        $result = $this->DBVAR->query($query) or die ($this->DBVAR->error());
        if ($this->DBVAR->num_rows($result))
        {
			$data = $this->DBVAR->fetch_object($result);
            $dataArr = $data;
        }
        
        return $dataArr;
    }
	
	
    
}

?>
