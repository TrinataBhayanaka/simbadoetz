<?php

require_once(LIBS.'twitteroauth/tmhOAuth-master/tmhOAuth.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class getphoto extends Controller {
	
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

    // pr($_SESSION);
		global $CONFIG, $basedomain;
    if (!$this->user){redirect($basedomain); exit;}

    if ($this->user['id'])$this->log('surf','upload foto');

    $_SESSION['flag'] = 0;

    
    FacebookSession::setDefaultApplication($CONFIG['fb']['appId'], $CONFIG['fb']['secret']);
    $helper = new FacebookRedirectLoginHelper($basedomain.'getphoto/index/?get=true');
    $session = false;
    if(isset($_GET['get'])){
      $session = $helper->getSessionFromRedirect();
      
      
      $album = (new FacebookRequest(
                  $session,'GET','/me/photos'
                ))->execute()->getGraphObject();
     
      $userAlbum = $album->getPropertyAsArray('data');

     
      foreach ($userAlbum as $key => $value) {
       
        $data[$key]['id'] = $value->getProperty('id');
        $data[$key]['from'] = $value->getProperty('from');
        $data[$key]['name'] = $value->getProperty('name');
        $data[$key]['picture'] = $value->getProperty('picture');
        $data[$key]['source'] = $value->getProperty('source');
        $data[$key]['height'] = $value->getProperty('height');
        $data[$key]['width'] = $value->getProperty('width');
        // $data[$key]['images'] = $value->getProperty('images');

      }
      // pr($data);
      $this->view->assign('albumfb',$data);

    }else{
      $loginUrl = $helper->getLoginUrl(array('scope' => 'user_photos',)); 
      $this->view->assign('accessUrlFb',$loginUrl);
    }
    
    


		if (isset($_SESSION['fb-logout'])){
      $this->view->assign('fbalbum',true);
    }else{
      $this->view->assign('fbalbum',false);
    }

  	return $this->loadView('upload/uploadFromFB');
  }

}

?>
