<?php
session_start(); 

include 'config/config.php';

if (isset($_GET['atoken']))
{
	
	$logout = $USERAUTH->is_user_logout($_SESSION['ses_aoperatorid']);
	if ($logout){
		unset($_SESSION['ses_aid']);
		unset($_SESSION['ses_aoperatorid']);
		unset($_SESSION['ses_aname']);
		unset($_SESSION['ses_aaksesadmin']);
		unset($_SESSION['ses_asatkerid']);
		unset($_SESSION['ses_anamaoperator']);
		unset($_SESSION['ses_ajabatan']);
		unset($_SESSION['ses_ahakakses']);
		unset($_SESSION['ses_ashowmenu']);
		unset($_SESSION['ses_ajabatanaksesmenu']);
		unset($_SESSION['ses_atoken']);
                         unset($_SESSION['ses_satkerid']);
                         unset($_SESSION['ses_satkername']);
		   unset($_SESSION['ses_satkerkode']);
		header('location:./page_admin');
	}
	
	
	
	
}
else if (isset($_GET['utoken']))
{
	
	$clear_apl_userasetlist = $DELETE->clear_table_apl_userasetlist($_SESSION['ses_uname']);
	$logout = $USERAUTH->is_user_logout($_SESSION['ses_uoperatorid']);
	
	
	if ($logout){
		unset($_SESSION['ses_uid']);
		unset($_SESSION['ses_uoperatorid']);
		unset($_SESSION['ses_uname']);
		unset($_SESSION['ses_uaksesadmin']);
		unset($_SESSION['ses_usatkerid']);
		unset($_SESSION['ses_unamaoperator']);
		unset($_SESSION['ses_ujabatan']);
		unset($_SESSION['ses_uhakakses']);
		unset($_SESSION['ses_ushowmenu']);
		unset($_SESSION['ses_ujabatanaksesmenu']);
		unset($_SESSION['ses_utoken']);
		  unset($_SESSION['ses_satkerid']);
                         unset($_SESSION['ses_satkername']);
                          unset($_SESSION['ses_satkerkode']);
		header('location:./');
	}
	
	
	
}
else{
	
	echo '<script type=text/javascript>alert("Ngapain Bos ?"); history.back(); </script>';
}

?>
	
	