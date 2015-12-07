
<div>
	<div>
	
		<?php include 'menu.php';?>
	</div>



<?php



$get_status_menu = $USERAUTH->admin_set_menu_status($user_ses);
//echo '<pre>';
//$user_ses
//print_r($get_status_menu);
//echo '</pre>';

if (isset($_GET['page'])){
	switch ((int)$_GET['page']){
		case '1':
			include 'adm_menu.php';
		
		break;
		case '2':
			include 'adm_kel_jabatan.php';
		
		break;
		case '3':
			include 'adm_user.php';
		
		break;
		case '4':
			include 'adm_skpd.php';
		
		break;
		case '5':
			include 'adm_ngo.php';
		
		break;
		case '6':
			include 'adm_pejabat_skpd.php';
		
		break;
		case '7':
			include 'adm_kode_barang.php';
		break;
                case '8':
			include 'adm_kode_rekening.php';
		break;
		case '9':
			include 'adm_pejabat_daerah.php';
		
		break;
		case '10':
			include 'adm_change_header.php';
		
		break;
		case '11':
			//include 'adm_change_report.php';
		
		break;
		case '12':
			include 'adm_change_setting.php';
		
		break;
		case '13':
			include 'adm_change_location.php';
		
		break;
		case '14':
			include 'adm_news.php';
		
		break;
		case '15':
			include 'adm_activity.php';
		
		break;
		default:
			echo '<script type=text/javascript>alert("Upss...Sorry, Page Not Found"); window.location.href = "./"</script>';
			//include 'adm_menu.php';
		break;
	}
}
else
{
	include 'adm_menu.php';
}
//include 'adm.php';
?>

</div>

