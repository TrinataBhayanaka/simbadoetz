<?php
defined('_SIMBADA_V1_') or die ('Forbidden Access');

if (isset($_POST['login']))
{
	

	$dataVar = array (
			'username'=>$_POST['username'],
			'password'=>md5($_POST['password']),
			'token' => 1
			);
	$dataValid = $DBVAR->form_validation($dataVar);
	
	//print_r($dataValid);
	
	if (is_array($dataValid))
	{
		
		$dataLogin = $USERAUTH->check_login_user($dataValid);
		if ($dataLogin == true)
		{
			echo "<script>window.location.href='./';</script>";
		}
		else
		{
			echo "<script>window.location.href='./';</script>";
		}
	}
}

$data_admin = $RETRIEVE_ADMIN->admin_retrieve_app_conf($NAMA_KABUPATEN);
//print_r($data_admin);
?>

<html>
    
        <table style="" align="center" border="0" width="100%">
          
                <tr>
                    <td align="center" width="*">
                        <table class="" cellpadding="0" cellspacing="0" width="100%" border="0">
                            
                                <tr>
                                    <td class="" style="padding: 5px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            
                                                <tr>
                                                    <td class="gambar"><img src="<?php echo "$url_rewrite/page_admin/css/$data_admin->app_admin_logo"?>" /></td>
                                                        <td style="width: 100%;" align="center">
                                                            <div class="titlepage">Sistem Informasi Manajemen Barang Daerah</div>
                                                            <b>Halaman Admin</b>
                                                        </td>
                                                        <td><img src="css/brr.gif" /></td>
                                                        <td><img src="css/logo_aplikasi.jpg" height="75px"/></td>
                                                </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content" align="center" height="" valign="top">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0">
                                            
                                                <tr>
                                                    <td style="padding-top: 50px;">
                                                        <div class="login" style="width:100%;" align="center">
                                                            <form method="post" action="">
                                                                <table class="login" align="center" cellpadding="0" cellspacing="0" width="100%">
                                                                    
                                                                        <tr>
                                                                            <th class="login" align="center">
                                                                                Login Form
                                                                            </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 10px 15px;" align="left">
                                                                                Username
                                                                                <br>
                                                                                <input type="text" style="width: 95%;" name="username" value="" required="required">
                                                                                <br>
                                                                                Password
                                                                                <br>
                                                                                <input type="password" style="width: 95%;" name="password" value="" required="required">
                                                                                <br>
                                                                                <br>
                                                                                <div align="center">
                                                                                    <input type="submit" style="width: 95%;" name="login"  value="login">
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    
                                                                </table>
                                                            </form>
                                                        </div>
                                                        <br>
                                                        <a class="datalist_inlist" href="<?php echo $url_rewrite?>">
                                                            <b>Kembali ke halaman utama...</b>
                                                        </a>
                                                    </td>
                                                </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                //include "footer.php"; 
                                ?>
							                           
                        </table>
                    </td>
                </tr>
            
        </table>
    
</html>

