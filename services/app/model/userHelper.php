<?php
class userHelper extends Database {
	
    var $date;
    var $salt;
    var $token;

    function __construct()
    {
        $session = new Session;
        $getSessi = $session->get_session();
        $this->user = $getSessi['default'];

        $this->prefix = "bpom";
        $this->date = date('Y-m-d H:i:s');
        $this->salt = 'ovancop2014';
        $this->token = substr(str_shuffle('QWERTYUIOPLKJHGFDSAZXCVBNM1234567890qwertyuioplkjhgfdsazxcvbnm'),0,30);
    }
    
    function createAccount($data=false)
    {

        $saveIndustri = $this->saveIndustri($data);
        
        if (!$saveIndustri)return false;


        $field = array('industri_id','name','last_name','description','StreetName','phone_number','email'); 

        foreach ($data as $key => $value) {
            
            if (in_array($key, $field)){
                $tmpF[] = $key;
                $tmpV[] = "'".$value."'";
            }
        }

        // $datalogin['flagFirstLogin']=1;
        // $flagFirstLogin = json_encode(serialize($datalogin));
        $tmpF[] = "industri_id";
        $tmpF[] = "register_date";
        $tmpF[] = "usertype";
        $tmpF[] = "email_token";
        $tmpF[] = "salt";
        $tmpF[] = "password";
        // $tmpF[] = "data";

        $tmpV[] = $saveIndustri;
        $tmpV[] = "'".$this->date."'";
        $tmpV[] = 1;
        $tmpV[] = "'".$this->token."'";
        $tmpV[] = "'".$this->salt."'";
        $tmpV[] = "'YOUR PASSWORD'";
        // $tmpV[] = 1;

        $impField = implode(',', $tmpF);
        $impData = implode(',', $tmpV);

        $sql = "INSERT IGNORE INTO social_member ({$impField}) VALUES ({$impData})";
        // pr($sql);
        $res = $this->query($sql);
        if ($res){
            
            $data['token'] = $this->token;
            return $data;
        } 
        return false;

    }

    function saveIndustri($data=false)
    {
        $field = array('namaIndustri','namaPimpinan','noKTP','jenisKelamin','alamatPimpinan'); 

        foreach ($data as $key => $value) {
            
            if (in_array($key, $field)){
                $tmpF[] = $key;
                $tmpV[] = "'".$value."'";
            }
        }

        
        $tmpF[] = "createDate";
        $tmpF[] = "n_status";
        

        $tmpV[] = "'".$this->date."'";
        $tmpV[] = 1;
        

        $impField = implode(',', $tmpF);
        $impData = implode(',', $tmpV);

        $sql = "INSERT IGNORE INTO {$this->prefix}_industri ({$impField}) VALUES ({$impData})";
        
        $res = $this->query($sql);
        $id = $this->insert_id();
        if ($id) return $id;
        return false;
    }

    
    
    /**
     * @todo get data user/person
     * 
     * @param $data = 
     * @param $field =  field name
     */
    function getUserData($field=false,$data=false){
        if($data==false){
            
            $data = $this->user['id'];
        }
       
        $sql = "SELECT * FROM `social_member` WHERE `id` = '".$data."' ";
        $res = $this->fetch($sql);  
        if(empty($res)){return false;}
        return $res; 
    }
    
    function getCategory()
    {

        $sql = "SELECT *
                FROM {$this->tblprefix}_category
                WHERE n_status =1
                LIMIT 0 , 30";

        $res = $this->fetch($sql,1);  
        if ($res)return $res; 
        return false;
    }
    
    function saveAccount()
    {
        
        $run = $this->save('update', "social_member", $_POST, "id = {$_POST['id']}");
        if ($run) return true;
        return false;
    }

    function forgotPassword($data=false, $debug=false)
    {

        // if reset password update status to -1
        $email = $data['email'];

        $filter = "";
        if ($email) $filter .= " AND email = '{$email}'";

        $sql = array(
                    'table' =>"social_member",
                    'field' => "*",
                    'condition' => "n_status NOT IN (0) {$filter}",
                    'limit' => 1
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result){

            $id = $result[0]['id'];

            $sql = array(
                        'table' =>"social_member",
                        'field' => "n_status = -1",
                        'condition' => "id = {$id}",
                        'limit' => 1
                    );
            $res = $this->lazyQuery($sql,$debug,2);
            if ($res){
                return $result;
            }
        } 
        return false;
    }

    function getNotification($data=false, $debug=false)
    {

        $userid = $data['userid'];

        $filter = "";
        if ($userid) $filter .= " AND userid = '{$userid}'";
        $sql = array(
                    'table' =>"{$this->prefix}_news_content_comment",
                    'field' => "*",
                    'condition' => "n_status NOT IN (-1) {$filter}",
                );
        $result = $this->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
    }
}
?>