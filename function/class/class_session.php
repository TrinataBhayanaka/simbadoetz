<?php 

/* Hati-hati dengan kelas ini !!!
 * Untuk menjalankan / memanggil fungsi yang ada di kelas ini,
 * pastikan sesi sudah diaktifkan dengan cara sesion_start()
 *
 * class Name : Session
 * Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/function/class/class_session.php
 * Created By : Ovan Cop
 * Date : 2012-07-31
 */

class Session
{
	protected $session;
	
	public function set_admin_session($data, $dataGroup)
	{
		
		
		$_SESSION['ses_aid'] = session_id();
		$_SESSION['ses_aoperatorid'] = $data['OperatorID'];
		$_SESSION['ses_aname'] = $data['UserNm'];
		$_SESSION['ses_aaksesadmin'] = $data['AksesAdmin'];
		$_SESSION['ses_asatkerid'] = $data['Satker_ID'];
		$_SESSION['ses_anamaoperator'] = $data['NamaOperator'];
		$_SESSION['ses_ajabatan'] = $data['JabatanOperator'];
		$_SESSION['ses_ahakakses'] = $data['Hak_Akses'];
		$_SESSION['ses_ashowmenu'] = $dataGroup['groupShowMenu'];
		$_SESSION['ses_ajabatanaksesmenu'] = $dataGroup['groupAccessMenu'];
		$_SESSION['ses_atoken'] = str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz');
		
		
		return true;
	}
	
	public function set_user_session($data, $dataGroup)
	{
		
		if ($data['ses_uid']){
			$_SESSION['ses_uid'] = $data['ses_uid'];
		}else{
			$_SESSION['ses_uid'] = session_id();
		}
		
		$_SESSION['ses_uoperatorid'] = $data['OperatorID'];
		$_SESSION['ses_uname'] = $data['UserNm'];
		$_SESSION['ses_uaksesadmin'] = $data['AksesAdmin'];
		$_SESSION['ses_unamaoperator'] = $data['NamaOperator'];
		$_SESSION['ses_ujabatan'] = $data['JabatanOperator'];
		$_SESSION['ses_uhakakses'] = $data['Hak_Akses'];
		$_SESSION['ses_ushowmenu'] = $dataGroup['groupShowMenu'];
		$_SESSION['ses_ujabatanaksesmenu'] = $dataGroup['groupAccessMenu'];
		$_SESSION['ses_uCRUD_modul'] = $dataGroup['akses_modul'];
		$_SESSION['ses_utoken'] = str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz');
                        
                         $_SESSION['ses_satkerid'] = $data['Satker_ID']; 
                         $_SESSION['ses_satkerkode'] = $data['kode']; 
		
                        if($data['NamaSatker'])
                              $_SESSION['ses_satkername'] =$data['NamaSatker'] ; 
                        else
                             $_SESSION['ses_satkername'] ="(Semua SKPD)";
		return true;
	}
	
	public function set_session($dataSesion)
	{
		$_SESSION[$dataSesion['ses_name']] = $dataSesion['ses_value'];
		
		return true;
	}
	
	public function get_session($dataSession)
	{
		$session[$dataSession['title']] = $_SESSION[$dataSession['ses_name']];
		
		return $session;
	}
	
	public function get_session_admin()
	{
		
		$sessionAdmin['ses_aid'] = $_SESSION['ses_aid'];
		$sessionAdmin['ses_aoperatorid'] = $_SESSION['ses_aoperatorid'];
		$sessionAdmin['ses_aname'] = $_SESSION['ses_aname'];
		$sessionAdmin['ses_aaksesadmin'] = $_SESSION['ses_aaksesadmin'];
		$sessionAdmin['ses_asatkerid'] = $_SESSION['ses_asatkerid'];
		$sessionAdmin['ses_anamaoperator'] = $_SESSION['ses_anamaoperator'];
		$sessionAdmin['ses_ajabatan'] = $_SESSION['ses_ajabatan'];
		$sessionAdmin['ses_ahakakses'] = $_SESSION['ses_ahakakses'];
		$sessionAdmin['ses_ashowmenu'] = $_SESSION['ses_ashowmenu'];
		$sessionAdmin['ses_ajabatanaksesmenu'] = $_SESSION['ses_ajabatanaksesmenu'];
		$sessionAdmin['ses_atoken'] = $_SESSION['ses_atoken'];
		
		return $sessionAdmin;
	}
	
	function get_session_user()
	{
		
		$sessionUser['ses_uid'] = $_SESSION['ses_uid'];
		$sessionUser['ses_uoperatorid'] = $_SESSION['ses_uoperatorid'];
		$sessionUser['ses_uname'] = $_SESSION['ses_uname'];
		$sessionUser['ses_uaksesadmin'] = $_SESSION['ses_uaksesadmin'];
		
		$sessionUser['ses_unamaoperator'] = $_SESSION['ses_unamaoperator'];
		$sessionUser['ses_ujabatan'] = $_SESSION['ses_ujabatan'];
		$sessionUser['ses_uhakakses'] = $_SESSION['ses_uhakakses'];
		$sessionUser['ses_ushowmenu'] = $_SESSION['ses_ushowmenu'];
		$sessionUser['ses_ujabatanaksesmenu'] = $_SESSION['ses_ujabatanaksesmenu'];
		$sessionUser['ses_uCRUD_modul'] = $_SESSION['ses_uCRUD_modul'];
		
		$sessionUser['ses_satkerid'] = $_SESSION['ses_satkerid'];
                         $sessionUser['ses_satkername'] = $_SESSION['ses_satkername'];
                             $sessionUser['ses_satkerkode'] =  $_SESSION['ses_satkerkode'] ;
		return $sessionUser;
	}
	
	function setCookies($data)
	{
		setcookie("simbada","lifetime", time()+1800);
		
		return TRUE;
		
	}
	
	function clear_session_user()
	{
		unset($_SESSION['ses_uid']);
		unset($_SESSION['ses_uoperatorid']);
		unset($_SESSION['ses_uname']);
		unset($_SESSION['ses_uaksesadmin']);
		unset($_SESSION['ses_usatkerid']);
		unset($_SESSION['ses_unamaoperator']);
		unset($_SESSION['ses_ujabatan']);
		unset($_SESSION['ses_uhakakses']);
		unset($_SESSION['ses_ushowmenu']);
		unset($_SESSION['ses_ujabatanaksesmenu']);
		unset($_SESSION['ses_utoken']);
		  unset($_SESSION['ses_satkerid']);
                         unset($_SESSION['ses_satkername']);
                            unset($_SESSION['ses_satkerkode']);
		echo '<script>window.location.href="./"</script>';
	}

	function smartFilter($sesName=false, $debug=false)
	{

		global $url_rewrite;

		$data = false;
		$prefix = "ses_param_".$sesName;

		if ($_POST){ 
			unset($_SESSION[$prefix]);
			$_SESSION[$prefix] = $_POST;
			// redirect($url_rewrite.'/module/'.$sesName.'/'.$fileName.'.php');
			// exit;
		}

		if ($debug) pr($_SESSION[$prefix]);

		$data = $_SESSION[$prefix];
		if ($data) return $data;
		return false;
	}
}


?>