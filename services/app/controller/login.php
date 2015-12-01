<?php


class login extends Controller {
	
	var $models = FALSE;
	var $view;

	
	function __construct()
	{
		global $basedomain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
		$this->view->assign('basedomain',$basedomain);
    }
	
	function loadmodule()
	{
        $this->userHelper = $this->loadModel('userHelper');
        $this->loginHelper = $this->loadModel('loginHelper');
        $this->activityHelper = $this->loadModel('activityHelper');
        // $this->helper_model = $this->loadModel('helper_model');

	}
	
	function index(){

        global $CONFIG, $basedomain;

        // $datalogin['flagFirstLogin']=1;

        // $tes = json_encode(serialize($datalogin));
        
        // echo $tes;
            
        return $this->loadView('login');
    }
	
    
    /**
     * @todo enter the site as user
     */        
    function doLogin(){

        global $basedomain;
        //query data
        
        $getUserappData = $this->loginHelper->goLogin();
        // pr($getUserappData);
        if ($getUserappData){
            
            if ($getUserappData['verified']>0){
                
                if ($getUserappData['data']>0) $flag = true;
                else $flag = false;

                print json_encode(array('status'=>true, 'flag'=>$flag));
            }
            
        }else{
            print json_encode(array('status'=>false));
        }

        exit;
    }
    
    function forgot()
    {
        global $basedomain;

        if (isset($_POST['submit'])){

            $dataform['email'] = _p('email');
            $datareset = $this->userHelper->forgotPassword($dataform);
            // $datareset = 1;
            if ($datareset){

                $data = array('email'=>$datareset['email'], 'token'=>$datareset['token']);
                $msg = encode(serialize($data));
                logFile(serialize($data));
              
              
                $this->view->assign('encode',$msg); 
                $this->view->assign('email',$datareset['email']);  
                $this->view->assign('name',$datareset['name']);  
                $this->view->assign('text',"reset akun"); 

                $html = $this->loadView('emailTemplate');
                $send = sendGlobalMail(trim($data['email']),'trinata.webmail@gmail.com',$html);
                logFile($send);

                print json_encode(array('status'=>true));
            }else{
                print json_encode(array('status'=>false));  
            }

            exit;
        }
        return $this->loadView('forgot-password');
    }

}

?>
