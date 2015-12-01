<?php


class register extends Controller {
	
	var $models = FALSE;
	var $view;

	
	function __construct()
	{
		global $basedomain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$this->view->assign('basedomain',$basedomain);
    $userdata = $this->isUserOnline();
    $this->user = $userdata['default'];
    $browsertype = $this->checkBrowser();
    $this->view->assign('browsertype',$browsertype);
    $this->session = new Session();
    }
	
	function loadmodule()
	{
    $this->loginHelper = $this->loadModel('loginHelper');
    $this->contentHelper = $this->loadModel('contentHelper');
    $this->userHelper = $this->loadModel('userHelper');
	}
	function index(){

		global $CONFIG, $basedomain;

		// $getData = $this->contentHelper->getArticle();
    // pr($getData);

    //require_once('recaptcha/recaptchalib.php');
    require_once(LIBS.'captcha/recaptchalib.php');
  //  $publickey = "your_public_key"; // you got this from the signup page
    $publickey = "6LeTiPASAAAAAFY09-K67Do3LC2AEnjkyFFdxiKO ";
    $captcha = recaptcha_get_html($publickey, $error=0);

    if (isset($_SESSION['tmp'])){
      $this->view->assign('data',$_SESSION['tmp']);  
    }
    $this->view->assign('captcha',$captcha);	

  	return $this->loadView('register');
  }
	
	function save()
  {

    global $basedomain;

    require_once(LIBS.'captcha/recaptchalib.php');
    
    $privatekey = "6LeTiPASAAAAAOFAQGOjgfsTRcb708TzwBaxyC2r";
    $resp = recaptcha_check_answer ($privatekey,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);
    if (!$resp->is_valid) {

      $_SESSION['tmp'] = $_POST;
      // What happens when the CAPTCHA was entered incorrectly
      // die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." . "(reCAPTCHA said: " . $resp->error . ")");
      // echo "gagal";
      echo "<script>alert('CAPTCHA Yang Anda Ketik Salah');</script>";
      redirect($basedomain.'register');
    }


    $token = str_shuffle(qwertyasdfgzxcvb123456789);
    $saveAccount = $this->userHelper->createAccount($_POST);
    if ($saveAccount){
      $data = array('email'=>$saveAccount['email'], 'token'=>$saveAccount['token']);
      $msg = encode(serialize($data));
      logFile(serialize($data));
      
      
      $this->view->assign('encode',$msg); 
      $this->view->assign('email',$data['email']);  
      $this->view->assign('name',$_POST['name']);  
      $this->view->assign('text',"pembuatan akun"); 

      $html = $this->loadView('emailTemplate');
      $send = sendGlobalMail(trim($data['email']),'trinata.webmail@gmail.com',$html);
      logFile($send);

      // pr('send mail '.$send);
      // exit;

      unset($_SESSION['tmp']);

      redirect($basedomain.'register/status/?token='.$token);
    }else{
      redirect($basedomain.'register/status/?token=');
    }
  }

  function status()
  {

    $token = _g('token');
    $this->view->assign('status',true);
    return $this->loadView('register-status');
  }

  function formRegister()
  {
    global $basedomain;
   
   if(!$this->user) {redirect($basedomain."home/connect");exit;} 
    $getUserInfo = $this->loginHelper->getUserInfo();
    if ($getUserInfo['verified']>0){
      redirect($basedomain.'uploadfoto/pilihframe');
    }

    $this->view->assign('user',$this->user);
    return $this->loadView('form');
  }

  function inputForm()
  {

    global $basedomain;

    $inputData=$this->contentHelper->registerUser($_POST); 
    if ($inputData)redirect($basedomain.'uploadfoto/pilihframe');

  }

  

	function validate()
  {

    global $basedomain;
        $data = _g('ref');
        
        // exit;
        logFile($data);
        if ($data){

            // $coba = array('email'=>'o.pulu@yahoo.com', 'token'=>'1234');
            // $enc = encode(serialize($coba));

            // pr($enc);
            
            $decode = unserialize(decode($data));
           
            // check if token is valid
            // pr($decode);

            $getToken = $this->loginHelper->getEmailToken($decode['email']);

            if ($getToken['email_token']==$decode['token']){
              
              redirect($basedomain.'register/accountValid/?ref='.$data);
            }else{
              pr('Token mismatch');
            }

        }
       
    }

    function accountValid()
    {
      
      global $basedomain;
        $token = _p('token');
        if ($token){
            
            $decode = unserialize(decode($token));
            $getToken = $this->loginHelper->getEmailToken($decode['email'],1);
            if ($getToken['email_token']==$decode['token']){


            }else{
              pr('Token Mismatch');
              exit;
            }

            // pr($_POST);
            $data['password'] = _p('password');
            $data['id'] = $getToken['id'];
            $data['email'] = $decode['email'];

            $updateAccount = $this->loginHelper->updateUserAccount($data);
            if ($updateAccount){
               
                logFile('account user '.$data['email']. ' created');

                $this->session->set_session($getToken);

                redirect($basedomain.'account');
                // $this->view->assign('validate','Validate account success');
                
            }else{
                
                logFile('update n_status user '.$data['email'].' failed');
            }
        }


        $ref = _g('ref');
        $decode = unserialize(decode($ref));
        if ($decode){
          $getToken = $this->loginHelper->getEmailToken($decode['email'],1);
          if ($getToken['email_token']==$decode['token']){

            if ($getToken['verified']>0){
              redirect($basedomain);
            }
            $getInd = $this->contentHelper->getIndustri($getToken['industri_id']);
            // pr($getInd);
            $this->view->assign('token',$ref);  
            $this->view->assign('data',$getInd[0]);  
          }
        }
        $this->view->assign('enterAccount',true);  
        return $this->loadView('register-validate');
    }
}

?>
