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

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
?>
	
	<section id="main">
		<ul class="breadcrumb">
					  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
					  <!-- <li><a href="#">Electronics</a><span class="divider"><b>&raquo;</b></span></li>
					  <li class="active">Flat Screens</li> -->
					  <?php SignInOut();?>
					</ul>
					<div class="title">Headline News</div>
					<div class="breadcrumb">
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
 
					</div>
		<section class="logo_konten">
			<img src="img/logo_konten.png" />
			
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>