<?php

define ('APP_CONTROLLER', APPPATH.'controller/');
define ('APP_VIEW', APPPATH.'view/');
define ('APP_MODELS', APPPATH.'model/');

/* Konfigurasi APP */

$CONFIG['default']['app_server'] = TRUE;
$CONFIG['default']['app_status'] = 'Development';
$CONFIG['default']['app_debug'] = TRUE;
$CONFIG['default']['app_underdevelopment'] = FAlSE;
$CONFIG['default']['php_ext'] = '.php';
$CONFIG['default']['html_ext'] = '.html';
$CONFIG['default']['default_view'] = 'home';
$CONFIG['default']['login'] = 'login';
$CONFIG['default']['admin'] = false;
$CONFIG['default']['salt'] = "12345678PnD";
$CONFIG['default']['hostname'] = "10.10.200.115";

$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,4))=='https'?'https':'http';
// $protocol = isset($_SERVER["https"]) ? 'https' : 'http';

$CONFIG['default']['base_url'] = $protocol.'://simbada.pekalongankota.go.id/simbada/services/';
$CONFIG['default']['root_path'] = $_SERVER['DOCUMENT_ROOT'].'/services';

$CONFIG['default']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/services/public_assets/';
$CONFIG['default']['max_filesize'] = 2097152;
$CONFIG['default']['upload_path_temporary'] = "/home/";
$CONFIG['default']['zip_foldername'] = "PUT_YOUR_ZIP_HERE";

$CONFIG['default']['css'] = APPPATH.'css/';
$CONFIG['default']['images'] = APPPATH.'images/';
$CONFIG['default']['js'] = APPPATH.'js/';

$CONFIG['default']['zip_ext'] = array('application/zip', 'application/x-zip', 'application/x-zip-compressed',  'application/octet-stream', 'application/x-compress', 'application/x-compressed', 'multipart/x-zip');
$CONFIG['default']['image'] = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/bmp','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/msword','application/pdf');
$CONFIG['default']['document'] = array('application/pdf');
$CONFIG['default']['unzip'] = 'zipArchive'; //s_linux or zipArchive

$basedomain = $CONFIG['default']['base_url'];
$base_application = $protocol.'://simbada.pekalongankota.go.id/simbada/';
$CONFIG['uri']['short'] = false;
$CONFIG['uri']['friendly'] = true;
$CONFIG['uri']['extension'] = ".html";

$CONFIG['email']['EMAIL_FROM_DEFAULT'] = "trinata.webmail@gmail.com";
$CONFIG['email']['EMAIL_SMTP_HOST'] = "mail.gmail.com";
$CONFIG['email']['EMAIL_SMTP_USER'] = "trinata.webmail@gmail.com";
$CONFIG['email']['EMAIL_SMTP_PASSWORD'] = "testermail";
$CONFIG['email']['EMAIL_SUBJECT'] = "[ NOTIFICATION ] E-Tobacco Control";

/* Twitter key */

$CONFIG['twitter']['CONSUMER_KEY'] = "qsKni0xEwX6FUaMYEWze5RDy3";
$CONFIG['twitter']['CONSUMER_SECRET'] = "YRHRt0HtrVc64YxLjXwdkIt3m8q1b2cXpwsCynW0zmAaeRNuOp";
$CONFIG['twitter']['OAUTH_CALLBACK'] = $basedomain.'login/twitterCallBack/';

/* FB Key */

$CONFIG['fb']['appId'] = "438789519597080";
$CONFIG['fb']['secret'] = "f941affbe699e7311531a0178dd0b640";

?>
