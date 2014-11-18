<?php
/*
 * ----Require semua configurasi APP yang digunakan----
 * 
 */
require "../../config/config.php";

$DBVAR = new DB();



/* Deklarasi class UserAuth
 * Class Name : UserAuth
 * Location :root_path/function/userAuth/user_func.php
 * Warning !!! Jangan buat nama variabel sama dengan nama variabel ini
 */

$USERAUTH = new UserAuth();


$SESSION = new Session();

/* Ambil session admin */
$UserSession = $SESSION->get_session_user();


if (isset($_POST['login']))
{
	$dataVar = array ('username'=>$_POST['username'], 'password'=>md5($_POST['password']), 'token' => 0);
					
	$dataValid = $DBVAR->form_validation($dataVar);
	if (is_array($dataValid))
	{
		$dataLogin = $USERAUTH->check_login_user($dataValid);
		if ($dataLogin == true)
		{
			header ('location:./');
		}
		else
		{
			header ('location:./');
		}
	}
}


if (isset($UserSession['ses_utoken']) && ($UserSession['ses_uid']))
{
	$menuID = $UserSession['ses_uhakakses'];
	
}
else
{
	
	$query = "SELECT Hak_Akses FROM Operator WHERE JabatanOperator = 8";
	$result = mysql_query($query) or die (mysql_error());
	$data1 = mysql_fetch_object($result);
	
	$_SESSION['akses_menu'] = $data1->Hak_Akses;
	
	
}



?>

<html>
     <?php
         include "$path/header.php";
     ?>
     <body>
	<div id="content">
	<form method="post" action="">
	<?php
	
                    include "$path/title.php";
                    include "$path/menu.php";
            ?>	
     </form>
			<div id="tengah">	
				<div id="frame_tengah">
					<div id="frame_peta"></div>
				</div>
			</div>
			<div id="kanan">
				<div id="frame_kanan">
				<div id="container">
					<ul class="menu">
						<li id="news" class="active">Pencarian</li>
						<li id="tutorials" class="round3px">Rekapitulasi</li>
						<li id="links" class="round3px">Legenda</li>
					</ul>
					<span class="clear"></span>
					<div class="content news">
			<h1>Pencarian</h1>
			<ul>
				<br>
				<br>
				<br>
				<br>
				<br>
				<center>Isi Menu Pencarian di sini</center>
				<br>
				<br>
				<br>
				<br>
				<br>
			<ul>
		</div>
		<div class="content tutorials">
			<h1>Rekapitulasi</h1>
			<ul>
				<br>
				<br>
				<br>
				<br>
				<br>
				<center>Isi Menu Rekapitulasi di sini</center>
				<br>
				<br>
				<br>
				<br>
				<br>
			<ul>
		</div>
		<div class="content links">
			<h1>Legenda</h1>
			<ul>
				<br>
				<br>
				<br>
				<br>
				<br>
				<center>Isi Menu Legenda di sini</center>
				<br>
				<br>
				<br>
				<br>
				<br>
			<ul>
		</div>
				</div>
				</div>
	
			</div>
			</div>
		<?php include "$path/footer.php"; 
                         ?>
	</body>
</html>	

