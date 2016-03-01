<?php
session_start();
require_once __DIR__ . '/autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('438789519597080', 'f941affbe699e7311531a0178dd0b640');

// Use one of the helper classes to get a FacebookSession object.
//   FacebookRedirectLoginHelper
//   FacebookCanvasLoginHelper
//   FacebookJavaScriptLoginHelper
// or create a FacebookSession with a valid access token:
$helper = new FacebookRedirectLoginHelper('http://localhost/tester/facebook/facebook/?try=login');
$session = false;
if(isset($_GET['try'])){
		 $session = $helper->getSessionFromRedirect();
}else{
	
	$loginUrl = $helper->getLoginUrl(); 
	echo "<a target='_blank' href='{$loginUrl}' >facebook login</a>";

}

if ($session) {
  // Logged in
  echo '<pre>';
  print_r($session);
  $me = (new FacebookRequest(
	  $session, 'GET', '/me'
	))->execute()->getGraphObject(GraphUser::className());
	
	print_r($me);
}
?>