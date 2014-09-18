<?php 
//session_start();
$id=$_SESSION['$var_session'];
if(!$id) 
{	
     $user_name1= $_SESSION['username'];
    $salt="h3lpd3k_4c3h100";
    $user_pass1=crypt($_SESSION['password'],$salt);

    if (!$user_pass1 || !$user_name1  )
    {
       echo("<script>alert('Maaf anda harus login terlebih dahulu!')</script>");
                            echo("<script language=\"javascript\">
                            window.location.href=\"$url_rewrite\";
                            </script>");   
    }

    else
    {
       
        $qry=mysql_query("select * from user where username='$user_name1'");
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
                            echo("<script language=\"javascript\">
                            window.location.href=\"$url_rewrite\";
                            </script>");
           }
            if ($user_name1 != $nam && $user_pass1==$pass)
                    {
                            echo("<script>alert('User name dan Password tidak terdaftar sebagai Admin!')</script>");
                            echo("<script language=\"javascript\">
                            window.location.href=\"$url_rewrite\";
                            </script>");
                    }
            if ($user_name1 != $nam && $user_pass1!=$pass)
                    {
                            echo("<script>alert('$user_name1 name dan Password tidak terdaftar sebagai Admin!')</script>");
                            echo("<script language=\"javascript\">
                            window.location.href=\"$url_rewrite\";
                            </script>");
                    }

            if ($user_name1 == $nam && $user_pass1 == $pass)
                $_SESSION['p2ka']=$p2ka;
                $_SESSION['id_skpa']=$id_skpa;
                $_SESSION['level']=$level;
            }
}
?>