<?php

require_once(LIBS.'twitteroauth/tmhOAuth-master/tmhOAuth.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

class uploadfoto extends Controller {

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
    $helper = new FacebookRedirectLoginHelper($basedomain.'uploadfoto/index/?get=true');
    $session = false;
    if(isset($_GET['get'])){
      $session = $helper->getSessionFromRedirect();

      /* Buat posting message */

      // $post = (new FacebookRequest(
     //      $session, 'POST', '/me/feed',array ('message' => 'This is a test message from bot',)
     //    ))->execute()->getGraphObject();


      $album = (new FacebookRequest(
                  $session,'GET','/me/photos/uploaded'
                ))->execute()->getGraphObject();
      /*
      $album = (new FacebookRequest(
                  $session,'GET','/me/albums'
                ))->execute()->getGraphObject();*/

      logFile(serialize($album));
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
      logFile('====user photo ====');
      logFile(serialize($data));
      // pr($data);
      $this->view->assign('albumfb',$data);

    }else{
      $loginUrl = $helper->getLoginUrl(array('scope' => 'user_photos',));
      $this->view->assign('accessUrlFb',$loginUrl);
    }


    $browser = $this->checkBrowser();

    if ($browser > 2){
      $this->view->assign('iebrowser',true);
    }

		if (isset($_SESSION['fb-logout'])){
      $this->view->assign('fbalbum',true);
    }else{
      $this->view->assign('fbalbum',false);
    }

  	return $this->loadView('upload/upload');
  }
  function chooseframe(){

    /* old flow */

    global $basedomain;
    if (!$this->user){redirect($basedomain); exit;}

    if ($this->user['id'])$this->log('surf','choose frame');

		$getMyPhoto = $this->contentHelper->getMyPhoto();
    if ($getMyPhoto){
      // pr($getMyPhoto);

      $this->view->assign('myfoto',$getMyPhoto);
    }

    $getFrame = $this->contentHelper->getFrame();
    // pr($getFrame);
    $this->view->assign('frame',$getFrame);


  	return $this->loadView('upload/chooseframe');
  }

  function pilihframe(){

    global $basedomain;
    if (!$this->user){redirect($basedomain); exit;}

    if ($this->user['id'])$this->log('surf','pilih frame');

    $getMyPhoto = $this->contentHelper->getMyPhoto();
    if ($getMyPhoto){
      // pr($getMyPhoto);

      $this->view->assign('myfoto',$getMyPhoto);
    }

    if (isset($_SESSION['fb-logout'])){
      $this->view->assign('coverfb',1);
      $flag = 4;
    }else{
      $this->view->assign('coverfb',0);
      $flag = 5;
    }

    $getFrame = $this->contentHelper->getFrame($flag);
    // pr($getFrame);
    foreach ($getFrame as $key => $value) {

      if ($value['cover']){

        $imgFrame[] = $value;
      }
    }
    // pr($imgFrame);
    $this->view->assign('frame',$imgFrame);



    return $this->loadView('upload/chooseframe');
  }

  function uploadprofile(){

    global $basedomain;
    if (!$this->user){redirect($basedomain); exit;}

    $getMyPhoto = $this->contentHelper->getMyPhoto();
    if ($getMyPhoto){
      // pr($getMyPhoto);

      $this->view->assign('myfoto',$getMyPhoto);
    }

    $getCover = $this->contentHelper->getCreateImage();
    // pr($getCover);

    $getFrame = $this->contentHelper->getFrame();
    // pr($getFrame);
    $this->view->assign('frame',$getFrame);
    $this->view->assign('cover',$getCover);

    $sessionFlag = intval(@$_SESSION['flag']);
    if ($sessionFlag<1){

      $_SESSION['flag'] = 1;
      // redirect($basedomain.'uploadfoto/uploadprofile');
    }

    if (isset($_SESSION['fb-logout'])){
      $this->view->assign('coverfb',1);
    }else{
      $this->view->assign('coverfb',0);
    }

  $browser = $this->checkBrowser();

  if ($browser > 2){

    $tmpimage = $basedomain.'public_assets/'.$getMyPhoto['files'];

  }else{
    
    if ($browser == 2){
      $image_data=file_get_contents($basedomain.'public_assets/'.$getMyPhoto['files']);
      $encoded_image=base64_encode($image_data);
      $tmpimage = 'data:image/png;base64,'.$encoded_image;
    }else{
      $tmpimage = $_SESSION['tmpimage'];
    }
    
    
  }


  $this->view->assign('browser',$browser);
	$this->view->assign('tmpimage',$tmpimage);
    return $this->loadView('upload/uploadProfile');
  }

  function thanks(){

    global $CONFIG, $basedomain, $IMAGE, $LOCALE;

    // pr($_SESSION);
    if (!$this->user){redirect($basedomain); exit;}

    $file_path = "";
    $getMyPhoto = $this->contentHelper->getCreateImage();
    if ($getMyPhoto){
      // pr($getMyPhoto);
      $file_path = $IMAGE[0]['imageframed'].$getMyPhoto['profil'];

      $this->view->assign('myfoto',$getMyPhoto);
    }


    if (isset($_SESSION['fb-logout'])){

      FacebookSession::setDefaultApplication($CONFIG['fb']['appId'], $CONFIG['fb']['secret']);
      $helper = new FacebookRedirectLoginHelper($basedomain.'uploadfoto/share/?share=true');
      $session = false;
      if(isset($_GET['share'])){
        $session = $helper->getSessionFromRedirect();

        /* Buat posting message */

        // $post = (new FacebookRequest(
       //      $session, 'POST', '/me/feed',array ('message' => 'This is a test message from bot',)
       //    ))->execute()->getGraphObject();

        $arr['link'] = $basedomain;
        $arr["source"] = '@' . realpath($file_path);
        $arr["message"] = $LOCALE['fb']['status-message'];

        /*
        $post = (new FacebookRequest(
                $session, 'POST', '/me/photos',$arr
              ))->execute()->getGraphObject();
        */
        $post = (new FacebookRequest(
                $session, 'POST', '/me/feed',$arr
              ))->execute()->getGraphObject();

        /*
        $album = (new FacebookRequest(
                    $session,'GET','/me/albums'
                  ))->execute()->getGraphObject();
        */

          // pr($album);

        $updateStatus = $this->contentHelper->updateCreateImageStatus();

        redirect($basedomain.'uploadfoto/changephoto');

      }else{
        $loginUrl = $helper->getLoginUrl(array('scope' => 'publish_actions',));
        // $loginUrl = $helper->getLoginUrl(array('scope' => 'email,public_profile,user_friends',));
        $this->view->assign('accessUrl',false);
      }

    }else{


        if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {

          $this->view->assign('accessUrl',$basedomain.'uploadfoto/twitterRedirectShare');
        }


    }

    $getFrame = $this->contentHelper->getCreateImage();
    // pr($getFrame);
    $this->view->assign('frame',$getFrame);

    if (isset($_SESSION['fb-logout'])){
      $this->view->assign('appId',$CONFIG['fb']['appId']);
      $this->view->assign('coverfb',1);
    }else{
      $this->view->assign('coverfb',0);
    }



    // return $this->loadView('upload/share');
    return $this->loadView('thanks');
  }


	 function share(){

		global $CONFIG, $basedomain, $IMAGE, $LOCALE;

		// pr($_SESSION);
		if (!$this->user){redirect($basedomain); exit;}

    $file_path = "";
    $getMyPhoto = $this->contentHelper->getCreateImage();
    if ($getMyPhoto){
      // pr($getMyPhoto);
      $file_path = $IMAGE[0]['imageframed'].$getMyPhoto['profil'];

      $this->view->assign('myfoto',$getMyPhoto);
    }


    if (isset($_SESSION['fb-logout'])){

      FacebookSession::setDefaultApplication($CONFIG['fb']['appId'], $CONFIG['fb']['secret']);
      $helper = new FacebookRedirectLoginHelper($basedomain.'uploadfoto/share/?share=true');
      $session = false;
      if(isset($_GET['share'])){
        $session = $helper->getSessionFromRedirect();

        /* Buat posting message */

        // $post = (new FacebookRequest(
       //      $session, 'POST', '/me/feed',array ('message' => 'This is a test message from bot',)
       //    ))->execute()->getGraphObject();

				$arr['link'] = $basedomain;
        $arr["source"] = '@' . realpath($file_path);
        $arr["message"] = $LOCALE['fb']['status-message'];

        /*
        $post = (new FacebookRequest(
                $session, 'POST', '/me/photos',$arr
              ))->execute()->getGraphObject();
        */
        $post = (new FacebookRequest(
                $session, 'POST', '/me/feed',$arr
              ))->execute()->getGraphObject();

        /*
        $album = (new FacebookRequest(
                    $session,'GET','/me/albums'
                  ))->execute()->getGraphObject();
        */

          // pr($album);

				$updateStatus = $this->contentHelper->updateCreateImageStatus();

        redirect($basedomain.'uploadfoto/changephoto');

      }else{
        $loginUrl = $helper->getLoginUrl(array('scope' => 'publish_actions',));
        // $loginUrl = $helper->getLoginUrl(array('scope' => 'email,public_profile,user_friends',));
        $this->view->assign('accessUrl',false);
      }

    }else{


        if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {

          $this->view->assign('accessUrl',$basedomain.'uploadfoto/twitterRedirectShare');
        }


    }

    $getFrame = $this->contentHelper->getCreateImage();
    // pr($getFrame);
    $this->view->assign('frame',$getFrame);

    if (isset($_SESSION['fb-logout'])){
      $this->view->assign('appId',$CONFIG['fb']['appId']);
      $this->view->assign('coverfb',1);
    }else{
      $this->view->assign('coverfb',0);
    }



  	// return $this->loadView('upload/share');
    return $this->loadView('upload/previewProfile');
  }

  function twitterCallBackShare()
    {

        global $CONFIG, $basedomain, $IMAGE;
        // require_once(LIBS.'twitteroauth/twitteroauth/twitteroauth.php');

        /* If the oauth_token is old redirect to the connect page. */
        if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
          $_SESSION['oauth_status'] = 'oldtoken';
          // header('Location: ./clearsessions.php');
          redirect($basedomain.'uploadfoto');
        }

        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $connection = new TwitterOAuth($CONFIG['twitter']['CONSUMER_KEY'], $CONFIG['twitter']['CONSUMER_SECRET'], $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

        /* Request access tokens from twitter */
        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

        /* Save the access tokens. Normally these would be saved in a database for future use. */
        $_SESSION['access_token'] = $access_token;

        /* Remove no longer needed request tokens */
        unset($_SESSION['oauth_token']);
        unset($_SESSION['oauth_token_secret']);

        /* If HTTP response is 200 continue otherwise send to connect page to retry */
        if (200 == $connection->http_code) {
          /* The user has been verified and the access tokens can be saved for future use */
            $_SESSION['status'] = 'verified';
          // header('Location: ./index.php');
            // pr('berhasil login');

            /* Get user access tokens out of the session. */
            $access_token_tw = $_SESSION['access_token'];

            /* Create a TwitterOauth object with consumer/user tokens. */
            // $connection = new TwitterOAuth($CONFIG['twitter']['CONSUMER_KEY'], $CONFIG['twitter']['CONSUMER_SECRET'], $access_token_tw['oauth_token'], $access_token_tw['oauth_token_secret']);

            /* If method is set change API call made. Test is called by default. */
            $content = $connection->get('account/verify_credentials');
            // pr($content);


            $getMyPhoto = $this->contentHelper->getCreateImage();
            // pr($getMyPhoto);
            if ($getMyPhoto){
              // pr($getMyPhoto);
              $file_path = $IMAGE[0]['imageframed'].$getMyPhoto['profil'];

            }

            $params = array();
            $params['media[]'] = "@{$file_path}";
            $params['status'] = 'Senangnya melihat foto Si Kecil ceria! Yuk tunjukkan foto buah hati Anda di bit.ly/GowithActivGro #GowithActivGro';

            // pr($params);

            // $access_token = $_SESSION['access_token'];
            // pr($access_token_tw);
            $tmhOAuth = new \tmhOAuth(array(
                        'consumer_key' => $CONFIG['twitter']['CONSUMER_KEY'],
                        'consumer_secret' => $CONFIG['twitter']['CONSUMER_SECRET'],
                        'token' => $access_token_tw['oauth_token'],
                        'secret' => $access_token_tw['oauth_token_secret'],
                        ));

            $response = $tmhOAuth->user_request(array(
                        'method' => 'POST',
                        'url' => $tmhOAuth->url("1.1/statuses/update_with_media"),
                        'params' => $params,
                        'multipart' => true
                        ));
             /*
            $response = $tmhOAuth->user_request(array(
                        'method' => 'POST',
                        'url' => $tmhOAuth->url("1.1/statuses/update"),
                        'params' => $params,
                        'multipart' => true
                        ));*/

            // pr($response);
            $updateStatus = $this->contentHelper->updateCreateImageStatus();
            // usleep(500);
            redirect($basedomain.'uploadfoto/thanks');
        } else {
          /* Save HTTP status for error dialog on connnect page.*/
          // header('Location: ./clearsessions.php');
          redirect($basedomain.'login/index');
        }
    }


    function twitterRedirectShare()
    {

        global $CONFIG,$basedomain;

        // require_once(LIBS.'twitteroauth/twitteroauth/twitteroauth.php');

        $twitterRedirectShare = $basedomain.'uploadfoto/twitterCallBackShare/';

        /* Build TwitterOAuth object with client credentials. */
        $connection = new TwitterOAuth($CONFIG['twitter']['CONSUMER_KEY'], $CONFIG['twitter']['CONSUMER_SECRET']);

        /* Get temporary credentials. */
        $request_token = $connection->getRequestToken($twitterRedirectShare);

        /* Save temporary credentials to session. */
        $_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

        /* If last connection failed don't display authorization link. */
        switch ($connection->http_code) {
          case 200:
            /* Build authorize URL and redirect user to Twitter. */
            $url = $connection->getAuthorizeURL($token);
            // header('Location: ' . $url);
            redirect($url);
            break;
          default:
            /* Show notification if something went wrong. */
            echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }
    }

   function changephoto(){

		global $CONFIG, $basedomain;

		// pr($this->user);
		if (!$this->user){redirect($basedomain); exit;}

		$getMyPhoto = $this->contentHelper->getCreateImage();
    if ($getMyPhoto){
      // pr($getMyPhoto);
      $file_path = $getMyPhoto['profil'];

      $getMyPhoto['userName'] = $this->user['name'];

      $this->view->assign('myfoto',$getMyPhoto);

    }

    $getFrame = $this->contentHelper->getCreateImage();
    // pr($getFrame);
    $this->view->assign('frame',$getFrame);

    if (isset($_SESSION['fb-logout'])){
      $this->view->assign('coverfb',1);
    }else{
      $this->view->assign('coverfb',0);
    }
  	return $this->loadView('upload/changephoto');
    // return $this->loadView('upload/gantiProfile');
  }

  	function imageShared ()
  	{
  		if ($this->user) {
			$image_id = filter_input(INPUT_GET, 'image_id', FILTER_SANITIZE_NUMBER_INT);
			if (empty($image_id)) {
				$image_id = filter_input(INPUT_POST, 'image_id', FILTER_SANITIZE_NUMBER_INT);
			}
			if ($image_id) {
				$image = $this->contentHelper->getCreateImageObject($this->user, $image_id);
				if ($image && $image['n_status'] == 2) {
					$this->contentHelper->setCreateImageStatus($image, 3);
				}
			}
		}
  	}

	function imageDownloaded ()
	{
		if ($this->user) {
			$image_id = filter_input(INPUT_GET, 'image_id', FILTER_SANITIZE_NUMBER_INT);
			if (empty($image_id)) {
				$image_id = filter_input(INPUT_POST, 'image_id', FILTER_SANITIZE_NUMBER_INT);
			}
			if ($image_id) {
				$image = $this->contentHelper->getCreateImageObject($this->user, $image_id);
				if ($image && $image['n_status'] == 1) {
					$this->contentHelper->setCreateImageStatus($image, 2);
				}
			}
		}
	}

	function ajaxUpload()
  {

	//pr($_POST);exit;

	$_SESSION['tmpimage'] = $_POST['tmpimage'];
    if (isset($_FILES['fotoupload'])){

      $file = uploadFile('fotoupload',null,'image');

      // pr($file);

      if ($file['status'] > 0){
        $saveUserFoto = $this->contentHelper->saveUserFoto($file);

        if ($saveUserFoto){
          print json_encode(array('status'=>true));
          logFile('User success upload image');
        }else{
          logFile('User failed upload image');
          print json_encode(array('status'=>false));
        }
      }else{
        logFile('File type not allowed');
        print json_encode(array('status'=>false,'message'=>'File tidak didukung'));
      }
    }else{
      logFile('No file exist');
      print json_encode(array('status'=>false,'message'=>'Tidak ada file'));
    }

    exit;
  }

  function ajaxUploadIE()
  {

  global $basedomain;

  $_SESSION['tmpimage'] = $_POST['tmpimage'];
    if (isset($_FILES['fotoupload'])){

      $file = uploadFile('fotoupload',null,'image');

      // pr($file);

      if ($file['status'] > 0){
        $saveUserFoto = $this->contentHelper->saveUserFoto($file);

        if ($saveUserFoto){
          redirect($basedomain.'uploadfoto');
        }else{
          redirect($basedomain.'uploadfoto');
        }
      }else{
        redirect($basedomain.'uploadfoto');
      }
    }else{
      redirect($basedomain.'uploadfoto');
    }

    exit;
  }

  function generateImage($fileid, $frameName, $fileName, $ie=false)
  {

    global $basedomain;
    // pr($_POST);
    $fileid = _p('fileid');
    $frameName = _p('frameName');
    $fileName = _p('fileName');

      $file = imageFrame($fileName,$frameName);

      // pr($file);

      if ($file){
        $saveUserFoto = $this->contentHelper->updateUserFoto($fileid, $fileName);

        if ($saveUserFoto){

          if ($ie){
          // redirect($basedomain.'uploadfoto/cropedProfile');
	          redirect($basedomain.'uploadfoto/changephoto');
            exit;
          }else{
            print json_encode(array('status'=>true));
          }

        }else{
          print json_encode(array('status'=>false));
        }
      }else{
        print json_encode(array('status'=>false));
      }


    exit;
  }

  function getFromFb()
  {
    global $IMAGE,$basedomain;

    $fileName = _p('fileName');
    $idPhoto = sha1($fileName).'.jpg';

      $url = $fileName;
      $img = $IMAGE[0]['pathfile'].$idPhoto;

      $ch = curl_init($url);
      $fp = fopen($img, 'wb');
      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_exec($ch);
      curl_close($ch);
      fclose($fp);

      $_SESSION['tmpimage'] = $basedomain.'public_assets/'.$idPhoto;

      // $download = file_put_contents($img, file_get_contents($url));
      $download = 1;

      if ($download>0){

        $saveUserFoto = $this->contentHelper->updateUserFoto(false,$idPhoto,true);

        if ($saveUserFoto){
          print json_encode(array('status'=>true));
        }else{
          print json_encode(array('status'=>false,'msg'=>'1'));
        }
      }else{
        print json_encode(array('status'=>false,'msg'=>'2'));
      }



    exit;
  }

  function saveFrame()
  {

    $data['cover'] = _p('cover');
    $data['frame'] = _p('frame');


      $saveUserFoto = $this->contentHelper->updateUserFrame($data);

      if ($saveUserFoto){
        print json_encode(array('status'=>true));
      }else{
        print json_encode(array('status'=>false,'msg'=>'1'));
      }

    exit;
  }

  function cropImage()
  {
    global $basedomain;

    $targ_w = $targ_h = 150;
   //  $targ_w = 120;
   // $targ_h = 120;
    $jpeg_quality = 90;


    $src = $basedomain.'public_assets/'.$_GET['file'];

    $img_r = imagecreatefromjpeg($src);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

    imagecopyresampled($dst_r,$img_r,0,0,$_GET['x'],$_GET['y'],
    $targ_w,$targ_h,$_GET['w'],$_GET['h']);

    header('Content-type: image/jpeg');
    imagejpeg($dst_r,null,$jpeg_quality);


    exit;

  }

  function getCropImage()
  {


    global $CONFIG, $basedomain;

    $x = _p('x');
    $y = _p('y');
    $w = _p('w');
    $h = _p('h');
    // echo $w.$h;exit;
    $getMyPhoto = $this->contentHelper->getMyPhoto();
    $getFrame = $this->contentHelper->getCreateImage();

      if ($getMyPhoto){
        $src = $getMyPhoto['files'];
      }

      //crop photo
      $file = $src;
      $cropped = "cropped_" . $file;
      $image = new Imagick($CONFIG['default']['upload_path'].$file);
      $image->cropImage($w, $h, $x, $y);
      $image->writeImage($CONFIG['default']['upload_path'].$cropped);
      // smart_resize_image($CONFIG['default']['upload_path'].$cropped,180,181);

      //overlaying
      $framename = $getFrame['frame'];

      $_POST['fileid'] = $getFrame['id'];
      $_POST['frameName'] = $framename;
      $_POST['fileName'] = $cropped;

      // pr($_POST);exit;
      $ifIE = _p('iepost');
      $iebrowser = false;
      if ($ifIE){
        $iebrowser = true;
      }

      $this->generateImage($getFrame['id'], $framename, $cropped, $iebrowser);



      exit;
  }

  function cropedProfile(){

    global $basedomain;
    if (!$this->user){redirect($basedomain); exit;}

    $getMyPhoto = $this->contentHelper->getCreateImage();
    if ($getMyPhoto){
      // pr($getMyPhoto);

      $this->view->assign('myfoto',$getMyPhoto);
    }

    $getFrame = $this->contentHelper->getCreateImage();
    // pr($getFrame);
    $this->view->assign('frame',$getFrame);

    if (isset($_SESSION['fb-logout'])){
      $this->view->assign('coverfb',1);
    }else{
      $this->view->assign('coverfb',0);
    }

    return $this->loadView('upload/cropedProfile');
  }

  function shareTemplate(){

    global $basedomain;

     $myfoto = $_GET['ft'];

    if(count($_GET) == 2){

      $this->view->assign('myfoto',$myfoto);

      return $this->loadView('upload/shareTemplate');

    } else {

      redirect($basedomain."public_assets/imageFramed/".$myfoto);

    }

    exit;
  }
}

?>
