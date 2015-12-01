<?php



class Controller extends Application{
	
	
	var $GETDB = null;

	public function __construct(){
		
		parent::__construct();
		
		if (!$GLOBALS['CODEKIR']['LOGS']){
			$this->loadModel('helper_model');
			$GLOBALS['CODEKIR']['LOGS'] = new helper_model;
		}
		

	}
	
	
	
	function index()
	{
		
		global $CONFIG, $LOCALE, $basedomain, $title, $DATA, $app_domain, $CODEKIR, $mobile_domain;
		$filePath = APP_CONTROLLER.$this->page.$this->php_ext;
		
		$this->view = $CODEKIR['smarty'];
		$this->view->assign('basedomain',$basedomain);
		$this->view->assign('app_domain',$app_domain);
		$this->view->assign('mobile_domain',$mobile_domain);
		$this->view->assign('page',$DATA[$this->configkey]);
		$this->view->assign('browsertype',$this->checkBrowser());
		
		if ($this->configkey=='default')$this->view->assign('user',$this->isUserOnline());
		if ($this->configkey=='admin')$this->view->assign('admin',$this->isAdminOnline());
		if ($this->configkey=='mobile')$this->view->assign('user',$this->isUserOnline());
		
		
		if ($this->configkey=='admin'){
			$this->view->assign('menu',$this->menuDinamis());
		}
		
		
		// $this->inject();
		// pr($this->isAdminOnline());

		// detection browser
		// pr($CONFIG);
		if (isset($_SESSION['fb-logout'])){
			$this->view->assign('logoutUrl',@$_SESSION['fb-logout']);
		}else{
			$this->view->assign('logoutUrl',$basedomain.'logout.php');
		}
		
		// exit;
// pr($filePath);exit;
		if (file_exists($filePath)){
			
			if ($DATA[$this->configkey]['page']!=='login'){
				if (array_key_exists('admin',$CONFIG)) {

					if (!$this->isAdminOnline()){
						redirect($basedomain.$CONFIG[$this->configkey]['login']);
						exit;
					}
				}

				// if (array_key_exists('mobile',$CONFIG)) {
					
				// 	if (!$this->isAdminOnline()){
				// 		redirect($basedomain.$CONFIG[$this->configkey]['login']);
				// 		exit;
				// 	}
				// }

			}

			if ($this->configkey == 'default'){

				$ignoreClass = array('login','register');
				
				/*
				if (in_array($DATA[$this->configkey]['page'], $ignoreClass)){

					 // remove session if user exist in same browser 
					$ignoreFunc = array('validate','accountValid','doLogin','doSignup');
					if (in_array($DATA[$this->configkey]['function'], $ignoreFunc)){
						// do nothing
					}else{
						if ($this->isUserOnline()){
						// redirect($CONFIG[$this->configkey]['default_view']);
						redirect($basedomain);
						exit;
						}
						
					}

				}else{


					if (!$this->isUserOnline()){
						redirect($CONFIG[$this->configkey]['login']);
						exit;
					}
					
				}
				*/
				
			}

			// pr($DATA);
			if ($this->configkey == 'admin'){
				if ($DATA[$this->configkey]['page']=='login'){
					if ($this->isAdminOnline()){
					redirect($CONFIG[$this->configkey]['default_view']);
					exit;
					}
				}
			}

			if ($this->configkey == 'mobile'){ 
				if ($DATA[$this->configkey]['page']=='login'){
					if ($this->isUserOnline()){
					redirect($CONFIG[$this->configkey]['default_view']);
					exit;
					}
				}
			}

			
			include $filePath;
			
			$createObj = new $this->page();
			
			$content = null;
			if (method_exists($createObj, $this->func)) {
				
				$function = $this->func;
				
				$content = $createObj->$function();
				$this->view->assign('content',$content);
			} else {
				
				if ($CONFIG['default']['app_debug'] == TRUE) {
					show_error_page($LOCALE[$this->configkey]['error']['debug']); exit;
				} else {
					
					redirect($CONFIG[$this->configkey]['base_url']);
					
				}
				
			}
			
			// $masterTemplate = APP_VIEW.'master_template'.$this->php_ext;
			$masterTemplate = APP_VIEW.'master_template'.$this->html_ext;
			if (file_exists($masterTemplate)){
				
				$title = $this->page;
				// $this->view->display(APP_VIEW.$fileName);
				$this->view->display($masterTemplate);
				// include $masterTemplate;
			
			}else{
				
				show_error_page($LOCALE[$this->configkey]['error']['missingtemplate']); exit;
			}
			
		}
		
	}
	
	function isUserOnline()
	{
		$session = new Session;
		
		// $userOnline = @$_SESSION['user'];
		$userOnline = $session->get_session();
		
		if ($userOnline){
			return $userOnline;
		}else{
			return false;
		}
		
	}
	
	function isAdminOnline()
	{
		global $CONFIG;
		
		if (!$this->configkey) $this->configkey = 'admin';
		$uniqSess = sha1($CONFIG['admin']['root_path'].'codekir-v0.1'.$this->configkey);
		$session = new Session;
		$userOnline = $session->get_session();
		// vd($userOnline);exit;
		if ($userOnline){
			return $userOnline;
		}else{
			return false;
		}
		
	}
	
	function inject()
	{
		$session = new Session;
		
		$data = array('id'=>1,'name'=>'ovancop');
		$session->set_session($data);
	}
	
	function loadLeftView($fileName, $data="")
	{
		global $CONFIG, $basedomain;
		$php_ext = $CONFIG[$this->configkey]['php_ext'];
		
		if ($data !=''){
			/* Ubah subkey menjadi key utama */
			foreach ($data as $key => $value){
				$$key = $value;
			}
		}
		
		
		/* include file view */
		if (is_file(APP_VIEW.$fileName.$php_ext)) {
			if ($fileName !='') $fileName = $fileName.'.php';
			include APP_VIEW.$fileName;
			
			return ob_get_clean();
		
		}else{
			show_error_page('File not exist');
			return FALSE;
		}
		
		//return TRUE;
	}
	
	
	/* under develope */
	// function assign($key, $data)
	// {
		// return array($key => $data);
	// }
	
	function getModelHelper($param=false)
	{
		
		//$getDB = $this->loadModel('helper_model');
		
		$showFunct = $this->GETDB->getData_sel($param);
		
		if ($showFunct) return $showFunct;
		return false;
	}
	
	function validatePage()
	{
		global $basedomain, $CONFIG, $DATA;
		if (!$this->isUserOnline()){
			
			redirect($basedomain.$CONFIG[$this->configkey]['login']);
			exit;
		}else{
		
			if ($DATA[$this->configkey]['page'] == $CONFIG[$this->configkey]['login']){
				
				redirect($basedomain.$CONFIG[$this->configkey]['default_view']);
				exit;
			}
		}
		
		
	}
	
	public function loadMHelper()
	{
		$this->GETDB = $this->loadModel('helper_model');
		return $this->GETDB;
	}
	
	
	function menuDinamis()
	{
		$getHelper = new helper_model;
		
		$adminid = $this->isAdminOnline();
		// pr($adminid);

		if ($adminid){
			$data['userid'] = $adminid['admin']['id'];
			$data = $getHelper->getMenu($data);
			// pr($data);
			$menuAkses = explode(',', $data['akses_user'][0]['menu_akses']);
			foreach ($data['menu'] as $key => $value) {
				
				if ($value){
					foreach ($value as $val) {
						if (in_array($val['menuID'], $menuAkses)){
							$newData[$key][] = $val;
						}
					}
				}
				
			}
			// pr($newData);
			return $newData;
		}
		return false;
		
	}

	function log($action='surf',$comment)
	{
		$getHelper = new helper_model;
		
		$getHelper->logActivity($action,$comment);

	}

	function destroySocmed()
	{	
		global $CONFIG, $basedomain;

		FacebookSession::setDefaultApplication($CONFIG['fb']['appId'], $CONFIG['fb']['secret']);

		$helper = new FacebookRedirectLoginHelper($basedomain.'logout.php?param=true');
		$session = false;
		if(isset($_GET['param'])){
			$session = $helper->getSessionFromRedirect();

			$fbsession = new FacebookSession($session->getToken());
			$params = 'https://localhost/nestle/nestle';

			$logoutUrl = $helper->getLogoutUrl($fbsession,$params); 
			print_r($logoutUrl);
			// $logout = $fbsession->getLogoutUrl($params); 
			echo "<a target='_blank' href='{$logoutUrl}' >facebook logout</a>";

			
		}

	}
	
	function checkBrowser()
	{

		$browser = $_SERVER['HTTP_USER_AGENT'];
		$chrome = '/Chrome/';
		$firefox = '/Firefox/';
		$ie = '/MSIE/';
		if (preg_match($chrome, $browser)) $result = 2;
		if (preg_match($firefox, $browser)) $result = 1;
		if (preg_match($ie, $browser)) $result = 3;

		return $result;
	}
}

?>
