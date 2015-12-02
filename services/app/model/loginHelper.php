<?php

class loginHelper extends Database {
	var $salt;
    function __construct()
    {
        global $basedomain;
        $this->loadmodule();
        $this->salt = 'ovancop2014';
        $this->session = new Session();
        $this->user = $this->session->get_session();
    }
    
    function loadmodule()
    {
        // include APP_MODELS.'activityHelper.php';
        // $this->activityHelper = new helper_model;
       
    }

    function goLogin()
    {
        // pr($_POST);
        $email = _p('email');
        $password = _p('password');
        
        // pr($data);       
        $data['status'] = false;
        $newCred = array();

        $sql = "SELECT * FROM social_member WHERE email = '{$email}' AND usertype IN (1) AND n_status = 1 LIMIT 1";
        // pr($sql);
        $res = $this->fetch($sql);
        // pr($res);
        // exit;
        if ($res){
            
            $salt = sha1($password.$res['salt']);
            
            $isnewuser = $res['verified'];
            $loginCount = intval($res['login_count'] +1);
            $lastLogin = date('Y-m-d H:i:s');
            $flagFirstLogin = intval($res['data'] +1);
            // pr($salt);
            // exit;
            if ($res['password'] == $salt){
                
                // $newCred['flagFirstLogin'] = $res['flagFirstLogin'];
                
                $sql = array(
                            'table' =>'social_member',
                            'field' => "last_login = '{$lastLogin}' ,login_count = {$loginCount}, data = {$flagFirstLogin}",
                            'condition' => "id = {$res['id']}",
                            'limit' => 1
                        );
                // $sqlu = "UPDATE social_member SET last_login = '{$lastLogin}' ,login_count = {$loginCount} WHERE id = {$res['id']} LIMIT 1";
                $result = $this->lazyQuery($sql,false,2);
                
                // $_SESSION['user'] = $res;

                $ignoreFIeld = array('salt','password','email_token','username');

                foreach ($res as $key=> $val){
                    
                    if (!in_array($key, $ignoreFIeld))$newCred[$key] = $val;
                }

                $this->session->set_session($newCred);
                
                if ($isnewuser>0){
                    $newCred['statusAccount'] = 1;
                }else{
                    $newCred['statusAccount'] = 0;
                }

                return $newCred;
            }

        }
        
        return false;
    }

    function updateUserAccount($data=array())
    {

        $date = date('Y-m-d H:i:s');
        $email = $data['email'];
        $id = $data['id'];
        $password = sha1($data['password'].$this->salt);

        
        $sql = array(
                    'table' =>'social_member',
                    'field' => "verified = 1, n_status = 1, salt = '{$this->salt}', password = '{$password}'",
                    'condition' => "id = {$id} AND email = '{$email}'",
                    'limit' => 1
                );
        // $sqlu = "UPDATE social_member SET last_login = '{$lastLogin}' ,login_count = {$loginCount} WHERE id = {$res['id']} LIMIT 1";
        $result = $this->lazyQuery($sql,false,2);
        if ($result) return true;
        
        return false;
    }

    function getEmailToken($username=false, $all=false)
    {

        $filter = "";

        if($username==false) return false;
        
        if($all) $filter = " * ";
        else $filter = " email_token ";

        $sql = "SELECT {$filter} FROM `social_member` WHERE `email` = '".$username."' LIMIT 1";
        // logFile($sql);
        $res = $this->fetch($sql);
        if ($res) return $res;
        return false;
    }

	
    
    function getUserInfo($id=false){

        $userid = false;
        if ($id) $userid = $id;
        else $userid = $this->user['default']['id'];

        if (!$userid) return false;
        $sql1 = "SELECT * FROM social_member WHERE id = {$userid} LIMIT 1";
        // pr($sql1);
        $res1 = $this->fetch($sql1);

        if ($res1) return $res1;
        return false;
    }

   function debuging($email)
   {
        $sql1 = "DELETE FROM social_member WHERE email ='{$email}' LIMIT 1";
        // pr($sql1);
        $res1 = $this->query($sql1);
        if ($res1) return true;
        return false;
   }
}
?>