<?php


class informasi extends Controller {
	
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

    }
	
	function loadmodule()
	{
    $this->loginHelper = $this->loadModel('loginHelper');
    $this->contentHelper = $this->loadModel('contentHelper');
	}
	function index(){

		global $CONFIG, $basedomain;

		// $getData = $this->contentHelper->getArticle();
    // pr($getData);
    $this->view->assign('data',$getData);	

  	return $this->loadView('publikasi');
  }
	
	function prosedur()
  {
    $getData = $this->contentHelper->getArticle(false,0,9,1);
    if ($getData){
      foreach ($getData as $key => $value) {
        if ($value['posted_date']){
          $getData[$key]['changeDate'] = changeDate($value['posted_date']);
        }
        if ($value['content']){
          $getData[$key]['content'] = html_entity_decode($value['content']);
        }
        
      }

      
    }

    $this->view->assign('data',$getData);
    return $this->loadView('informasi/prosedur');
  }

  function pengaduan()
  {
    $getData = $this->contentHelper->getArticle(false,0,8,1);
    // pr($getData);
    if ($getData){
      foreach ($getData as $key => $value) {
        if ($value['posted_date']){
          $getData[$key]['changeDate'] = changeDate($value['posted_date']);
        }
        if ($value['content']){
          $getData[$key]['content'] = html_entity_decode($value['content']);
        }
        
      }

      
    }

    $this->view->assign('data',$getData);
    return $this->loadView('informasi/pengaduan');
  }

  function petunjuk()
  {
    $getData = $this->contentHelper->getArticle(false,0,10,1);
    if ($getData){
      foreach ($getData as $key => $value) {
        if ($value['posted_date']){
          $getData[$key]['changeDate'] = changeDate($value['posted_date']);
        }
        if ($value['content']){
          $getData[$key]['content'] = html_entity_decode($value['content']);
        }
        
      }

      
    }

    $this->view->assign('data',$getData);
    return $this->loadView('informasi/petunjuk');
  }

  function faq()
  {
    $getData = $this->contentHelper->getArticle(false,0,7,1);
    if ($getData){
      foreach ($getData as $key => $value) {
        if ($value['posted_date']){
          $getData[$key]['changeDate'] = changeDate($value['posted_date']);
        }
        if ($value['content']){
          $getData[$key]['content'] = html_entity_decode($value['content']);
        }
        
      }

      
    }
    $this->view->assign('data',$getData);
    return $this->loadView('informasi/faq');
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

  

	function loginSocmed()
  {

    global $CONFIG, $basedomain;

    
  }
  function thanks(){
    return $this->loadView('thanks');

  }

  function privacy(){
     return $this->loadView('privacy');

  }

  function debuging()
  {
    $email = _g('email');
    if ($email==""){print(json_encode(false));exit;}
    $debug = $this->loginHelper->debuging($email);
    if($debug){
      print(json_encode(true));
    }else{
      print(json_encode(false));
    }

    exit;
  }
}

?>
