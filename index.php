<?php
/*
 * ----Require semua configurasi APP yang digunakan----
 * 
 */

//error_reporting(0);
ini_set("session.cookie_lifetime", "3600");
session_cache_expire(60);

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

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";


	// $DBVAR->logIt(array('bangunan'),51);
?>
	
	<section id="main">
		<ul class="breadcrumb">
					  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
					  <!-- <li><a href="#">Electronics</a><span class="divider"><b>&raquo;</b></span></li>
					  <li class="active">Flat Screens</li> -->
					  <?php SignInOut();?>
					  
					</ul>
					
					<?php
					$news = $RETRIEVE->getNews();
					// pr($news);
					if ($news){
						foreach ($news as $key => $value) {
							?>
							<div class="title"><?=$value['title']?></div>
							<div class="breadcrumb"><?=$value['content']?></div>
							<?php
						}
					}
					?>
					
		<section class="logo_konten">
			<img src="img/logo_konten.jpg" />
			
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>
