<?php 
include 'config/config.php';
$id=$_SESSION['$var_session'];
if(!$id)
{
    $user_name1= $_POST['username'];
	$salt="h3lpd3k_4c3h100";
	$user_pass1=crypt($_POST['password'],$salt);
	$pass=$_POST['password'];

if (!$user_pass1 || !$user_name1  )
{
   echo("<script>alert('Maaf anda harus login terlebih dahulu!')</script>");
			echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite\";
			</script>");
}
else
{
    
    
    $qry=mysql_query("select * from user where username='$user_name1' and status_user='1'") ;
    echo("<script>alert('select * from user where username='$user_name1'')</script>");
    while ($row = mysql_fetch_object ($qry))
        {
            $pass=$row->password;
            $nam=$row->username;
            $user_id=$row->user_id;
            $level=$row->level;
            $p2ka=$row->p2ka;
            $id_skpa=$row->id_skpa;
            
        }


	if (($user_name1 == $nam) && ($user_pass1!=$pass))
		{
			echo("<script>alert('Password Anda Tidak Tepat!')</script>");
			session_destroy();
                        echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite\";
			</script>");
                        
       }
	if ($user_name1 != $nam && $user_pass1==$pass)
		{
			echo("<script>alert('User name dan Password tidak terdaftar!')</script>");
			session_destroy();
                        echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite\";
			</script>");
		}
	if ($user_name1 != $nam && $user_pass1!=$pass)
		{
			echo("<script>alert('User name dan Password tidak terdaftar!')</script>");
			session_destroy();
                        echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite\";
			</script>");
		}

	if ($user_name1 == $nam && $user_pass1 == $pass)
	    
            $_SESSION['p2ka']=$p2ka;
            $_SESSION['id_skpa']=$id_skpa;
            $_SESSION['level']=$level;
            $_SESSION['$var_session']=$user_id;
            
            if($level=="1")
            echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite/beranda\";
			</script>");
            if($level=="2")
                echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite/beranda\";
			</script>");
            if($level=="3")
                echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite/beranda\";
			</script>");
            
             
        }

}
else
{
    $level=$_SESSION['level'];
      if($level=="1")
            echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite/beranda \";
			</script>");
            if($level=="2")
                echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite/beranda\";
			</script>");
              if($level=="3")
                echo("<script language=\"javascript\">
			window.location.href=\"$url_rewrite/beranda\";
			</script>");
          
}
?>