<?php


class home extends Controller {
	
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
    if($_GET['page']){
      if($_GET['page']=='1'){

        $data['page']=$this->loadView('module/daftar_aset_tetap/tanah');

      }elseif($_GET['page']=='2'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/peralatandanmesin');

      }else{

       $data['page']=$this->loadView('dashboard');
      }

    }else{

      $data['page']=$this->loadView('dashboard');
    }

    $this->view->assign('page',$data['page']); 

    return $this->loadView('home');
  }

  function ajaxPage(){
    global $CONFIG, $basedomain;
    if($_POST['page']){
      if($_POST['page']=='1'){

        $data['page']=$this->loadView('module/daftar_aset_tetap/tanah');

      }elseif($_POST['page']=='2'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/peralatandanmesin');

      }else{

       $data['page']=$this->loadView('dashboard');
      }

    }else{

      $data['page']=$this->loadView('dashboard');
    }

    // $this->view->assign('page',$data['page']); 
    
    if ($data['page']){
            print json_encode(array('status'=>true, 'data'=>$data['page']));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
    
  }
}

?>
