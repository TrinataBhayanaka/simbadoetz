<?php

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;




class article extends Controller {
	
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

    }
	
	function loadmodule()
	{
    $this->loginHelper = $this->loadModel('loginHelper');
    $this->contentHelper = $this->loadModel('contentHelper');
	}
	
	function index(){

		global $CONFIG, $basedomain;

		$getArticle = $this->contentHelper->getArticle();
    if ($getArticle){
      foreach ($getArticle as $key => $value) {
        $getArticle[$key]['changeDate'] = changeDate($value['posted_date']);
      }
    }
		// pr($getArticle);
    $this->view->assign('article',$getArticle);

  	return $this->loadView('article/index');
  }

  function loginFbValid(){
    global $CONFIG, $basedomain;

    FacebookSession::setDefaultApplication($CONFIG['fb']['appId'], $CONFIG['fb']['secret']);

      $helper = new FacebookRedirectLoginHelper($basedomain.'article/loginFbValid/');
      // $session = false;

        try{
          $session = $helper->getSessionFromRedirect();
          
        }catch(FacebookRequestException $ex){

        }catch(\Exception $ex) {

        }


        if ($session) {
         
          

            $fbsession = new FacebookSession($session->getToken());
            $params = $basedomain.'logout.php';

            $logoutUrl = $helper->getLogoutUrl($fbsession,$params); 


            $_SESSION['fb-logout'] = $logoutUrl;
            // print_r($_SESSION);exit;
            $me = (new FacebookRequest(
                  $session, 'GET', '/me'
                ))->execute()->getGraphObject();
            
            // pr($me);exit;    
            $dataUser = array('id','email','first_name','gender','last_name','link','middle_name','name','quotes');
            foreach ($dataUser as $value) {
                $user[$value] = $me->getProperty($value);
            }
            
            // pr($user);
            $setLoginUser = $this->loginHelper->loginSosmed(1,$user); 
            // pr($setLoginUser);

            $getUserInfo = $this->loginHelper->getUserInfo($setLoginUser['id']);
            
            $this->log('welcome','login success',$getUserInfo['id']);

            if ($getUserInfo['verified']>0){
              redirect($basedomain.'uploadfoto/pilihframe');
            }else{
              redirect($basedomain.'home/formRegister');
            }

            exit;
          }
          
        
  }

	function detail(){

		global $CONFIG, $basedomain;
      // pr($CONFIG);
     
      /* Twitter login */

      if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
        
        $this->view->assign('accessUrlTwitter',$basedomain.'login/twitterRedirect');

      }

      $id = _g('id');
      
		  $getArticle = $this->contentHelper->getArticle($id);
      if ($getArticle){
        foreach ($getArticle as $key => $value) {
          $getArticle[$key]['changeDate'] = changeDate($value['posted_date']);
          $getArticle[$key]['content'] = html_entity_decode($value['content']);
        }
      }

      $getNextArticle = $this->contentHelper->getNextArticle($id);
      $getRandomArticle = $this->contentHelper->getRandomArticle($id);
      if ($getRandomArticle){
        foreach ($getRandomArticle as $key => $value) {
          $getRandomArticle[$key]['changeDate'] = changeDate($value['posted_date']);
          $getRandomArticle[$key]['content'] = html_entity_decode($value['content']);
        }
      }
      // pr($getNextArticle);
      $this->view->assign('article',$getArticle);
      $this->view->assign('prevNextArticle',$getNextArticle);
      $this->view->assign('getRandomArticle',$getRandomArticle);
      $this->view->assign('user',$this->user);
      $this->view->assign('appId',$CONFIG['fb']['appId']);
      
    	return $this->loadView('article/detail');
    }

  function ajax()
  {

    $page = intval(_p('page'));
    $getArticle = $this->contentHelper->getArticle(false,$page);
    if ($getArticle){
      foreach ($getArticle as $key => $value) {
        $getArticle[$key]['changeDate'] = changeDate($value['posted_date']);
      }

      print json_encode(array('status'=>true, 'res'=>$getArticle));
    }else{

      print json_encode(array('status'=>false));
    }
    

    exit;
  }
	
}

?>
