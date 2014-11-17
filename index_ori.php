<?php
/*
 * ----Require semua configurasi APP yang digunakan----
 * 
 */

//error_reporting(0);
function curPageURL() {
     $pageURL = 'http';
     if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
          $pageURL .= "s";
     }
     $pageURL .= "://";
     if ($_SERVER["SERVER_PORT"] != "80") {
          $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
     } else {
          $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
     }
     return $pageURL;
}

$url = curPageURL();


if (file_exists(dirname(__FILE__) . '/install')) {
     header("Location: " . $url . "install");
     exit;
} else {
     $command = 'rm -f proses.php';
     $hasil = shell_exec($command);
}


require "config/config.php";


$USERAUTH->check_sys_log();

// $is_login = $USERAUTH->is_user_login();

/*
  if ($is_login){

  $USERAUTH->activate_user_again($is_login);
  }else{
  $token = str_shuffle('1234567cdsvsrbdfb');
  // pr($_SESSION);
  //$SESSION->clear_session_user();
  }
 */
?>

<html>
     <?php
     // pr($_SESSION);
     include "$path/header.php";
     ?>
     <body>
          <div id="content">

               <?php
               include "$path/title.php";
               include "$path/menu.php";
               ?>	

               <div id="tengah">	
                    <div id="frame_tengah">
                         <div id="frame_peta"></div>
                    </div>
               </div>

          </div>
          <?php include "$path/footer.php";
          ?>
     </body>
</html>	

