<?php

$DBVAR = new DB();



/* Deklarasi class UserAuth
 * Class Name : UserAuth
 * Location :root_path/function/userAuth/user_func.php
 * Warning !!! Jangan buat nama variabel sama dengan nama variabel ini
 */

$USERAUTH = new UserAuth();


$SESSION = new Session();

/* Ambil session user */
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
			//header ("location:$url_rewrite");
			echo "<script>window.location.href='$url_rewrite';</script>script>";
		}
		else
		{
			echo "<script>window.location.href='$url_rewrite';</script>script>";
		}
	}
}


if (isset($UserSession['ses_utoken']) && ($UserSession['ses_uid']))
{
	$menuID = $UserSession['ses_uhakakses'];
	
}
else
{
	
	$query = "SELECT menuID FROM tbl_user_menu WHERE menuAksesLogin = 0 AND menuStatus = 1";
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	
	while ($data = $DBVAR->fetch_object($result))
	{
		$menuID[] = $data->menuID;
	}
	
	if (count($menuID) > 0)
	{
		$implode = implode(',',$menuID);
		$defaultSes = $SESSION->set_session(array('ses_name' => 'menu_without_login', 'ses_value' => $implode));	
	}
	else
	{
		$USERAUTH->show_warning('Sesi user gagal di set');
	}
	
}

// pr($_SESSION);

 function SignInOut(){
	global $url_rewrite;
 ?>
	 <li style="margin-right:0px;float:right">
						<?php 
           
							if(isset($_SESSION['ses_utoken'])){ ?>
							   
							   <a href="<?php echo $url_rewrite.'/logout.php?utoken='.str_shuffle('bcsabbjahj131');?>"><i class="fa fa-sign-out"></i> Logout </a>
									<?php
							}
							else
							{
							?>
									<a data-toggle="modal" href="#myModal3" class=""> <i class="fa fa-sign-in fa-2x"></i>&nbsp;&nbsp;Login</a>
							
							<?php
							}
							?>
					  </li>
					  <?php
 } 
?>
<div id="containerSimda">
	<!--<div id="ContainerloginSimda">&nbsp;
		<div class="loginSimda">
			// <?php 
           
            // if(isset($_SESSION['ses_utoken'])){ ?>
           // Selamat datang <?php echo $_SESSION['ses_uname'];?>
		   // <i class="icon-user icon-white"></i>
		   // <a href="<?php echo $url_rewrite.'/logout.php?utoken='.str_shuffle('bcsabbjahj131');?>"> [Logout] </a>
                // <?php
		// }
		// else
		// {
		// ?>
				// <a data-toggle="modal" href="#myModal3" class=""><i class="icon-user icon-white"></i>&nbsp;&nbsp;Login</a>
		
        // <?php
		// }
		// ?>
			
		<!--Selamat Datang Admin | Logout-->
	<!--	</div>
	</div>-->
	<div id="myModal3" class="modal hide fade  login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div id="titleForm" class="modal-header" >
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 id="myModalLabel">Form Login</h3>
				</div>
				<form method="POST" action="">
				<div class="modal-body">
				
				 <div class="formLogin">
						
						<ul>
							<li>
								<span class="labellogin">Username</span>
								 <input type="text" name="username" required="required"/>
							</li>
							<li>
								<span class="labellogin">Password</span>
								<input type="password" name="password" required="required"/>
							</li>
						</ul>
					</div>
					
			</div>
			<div class="modal-footer">
			  <button class="btn" type="button" data-dismiss="modal">Kembali</button>
			  <input type="submit" value="Login" name="login" class="btn btn-success" id="drop_sebagai" />
			</div>
			</form>
		</div>  
	<header>
		<img src="<?php echo "$url_rewrite/"; ?>img/header2.jpg" width="100%"/>
	</header>
	<!--<div id="pembatasHeader">&nbsp;</div>-->