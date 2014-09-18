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
 
?>

<div id="frame_header">
	<div id="header"></div>
</div>
<div id="list_header">
        <div id="sebagai">
		
		<form method="POST" action="">
            <?php 
           
            if(isset($_SESSION['ses_utoken'])){ ?>
           Selamat datang <i><?php echo $_SESSION['ses_uname'];?></i> <a href="<?php echo $url_rewrite.'/logout.php?utoken='.str_shuffle('bcsabbjahj131');?>" style="color:white"> [Logout] </a>
                <?php
		}
		else
		{
		?>
		
            User
            <input type="text" name="username" required="required"/>
            Password
            <input type="password" name="password" required="required"/>
            <input type="submit" value="" name="login" id="drop_sebagai" />
	    
                <?php
		}
		?>
		</form>
        </div>

	
   
</div>

