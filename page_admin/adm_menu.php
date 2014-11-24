<?php

/* class Name : Session
 * Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_menu.php
 * Created By : Irvan Wibowo(Bolang) & Ovan Cop
 * Date : 2012-08-01
 */



defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');


$get_status_menu['button_adm'] !='' ? $submit_status = 1 : $submit_status = 0;
$get_status_menu['adm_menu'] !='' ? $disable_menu = '' : $disable_menu = 'disabled';



if(isset($_POST['simpan']))
{
	
	if ($submit_status == 0) exit ($USERAUTH->show_warning_html('Akses Ditolak'));
	
	$arrMenu = $_POST['allMenuID'];
	$showMenu = $_POST['showMenu'];
	$accessMenu = $_POST['accessMenu'];
	
	$update_menu = $UPDATE_ADMIN->admin_update_menu(array('allMenuID'=>$arrMenu, 'showMenu'=>$showMenu, 'accessMenu'=>$accessMenu));
	
	/*
	$query = "UPDATE tbl_user_menu SET menuStatus = 0 , menuAksesLogin = 0 ";
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	
	if ($result)
	{
		if ($_POST['showMenu'] !='')
		{
			foreach ($_POST['showMenu'] as $value)
			{
				//echo 'ada';
				
				$query = "UPDATE tbl_user_menu SET menuStatus = 1 WHERE menuID = $value";
				//print_r($query);
				$result = $DBVAR->query($query) or die ($DBVAR->error());
			}
		}
		
		
		if ($_POST['accessMenu'] !='')
		{
			foreach ($_POST['accessMenu'] as $val)
			{
				//echo 'ada';
				$query = "UPDATE tbl_user_menu SET menuAksesLogin = 1 WHERE menuID = $val";
				//print_r($query);
				$result = $DBVAR->query($query) or die ($DBVAR->error());
			}
		}
		
		
	}
	
	*/
	
	
}

?>
<form method="POST">
    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color: white;">
        <tr>
            <?
                $title_style='border:1px solid #b7c6c2; background-color: #cfe9e1; padding: 3px 5px 2px 5px; color:#3a574e;';
            ?>
            <th width="70" style="<?php echo $title_style;?>" align="center" >No Urut</th>
            <th width="*" style="<?php echo $title_style;?>">Nama Menu</th>
            <th width="80" style="<?php echo $title_style;?>" align="center">Tampilkan</th>
            <th width="80" style="<?php echo $title_style;?>" align="center">Harus Login</th>
        </tr>
        <?
        /*
        $queryGroup = " SELECT menuID, menuStatus, menuAksesLogin
			FROM tbl_user_menu";
		
	
	$resultGroup = $DBVAR->query($queryGroup) or die (mysql_error());
	$sumRec = $DBVAR->num_rows($resultGroup);
	if ($sumRec)
	{
	    
		while ($dataGroup = $DBVAR->fetch_object($resultGroup))
		{
			$dataArr['menuStatus'][] = $dataGroup->menuStatus;
			$dataArr['menuAksesLogin'][] = $dataGroup->menuAksesLogin;
			$dataArr['menuID'][] = $dataGroup->menuID;
		}
		
		
	}
	$showMenu = explode(',',$dataArr['group']['menuStatus']);
	$accessMenu = explode(',',$dataArr['group']['menuAksesLogin']);
	
	$queryParent = "SELECT * FROM tbl_user_menu_parent";
	
	$resultParent = $DBVAR->query($queryParent);
	*/
	
	list ($dataArr, $dataParentArr) = $RETRIEVE_ADMIN->admin_retrieve_adm_menu_1();
	
	foreach ($dataParentArr as $resultParent)
	{
	
	
		
		?>
        <tr>
            <td colspan="4" style='border:1px solid #b7c6c2; background-color: #cfe9e1; padding: 3px 5px 2px 5px;'><?php echo $resultParent['menuParentDesc']; ?></td>
        </tr>
		<?php
		
		$get_menu_child = $RETRIEVE_ADMIN->admin_retrieve_adm_menu_2(array ('menuParentID'=>$resultParent['menuParentID']));
		
		/*
		$queryMenu = "SELECT * FROM tbl_user_menu WHERE menuParent = ".$resultParent['menuParentID'];
		$resultMenu = mysql_query($queryMenu);
		
		
		*/

		// pr($get_menu_child);
		$no = 1;
		if ($get_menu_child){

			foreach($get_menu_child as $dataMenu)
			{
			// echo $dataMenu['menuID'];
	                        if($dataMenu['menuID'] !=='Array') $dataArray[] = $dataMenu['menuID'];
				// pr($dataMenu);  
				?>
				
	        <tr>
	            <td align="right"><?php echo $no.'.'; ?></td>
	            <td><?php echo $dataMenu['menuDesc']?></td>
	            <td align="center"><input type="hidden" value="<?php echo $dataMenu['menuID']?>" /><? $active = $dataMenu['menuID']; //echo $active;?>
	                <input type="checkbox" <?php echo $disable_menu; ?> name="showMenu[]" value="<?php echo $dataMenu['menuID']?>" <?php if ($dataMenu['menuStatus'] > 0){echo 'checked'; }  ?> />
	                
	                
	            </td>
	            <td align="center"><input type="hidden" value="<?php echo $dataMenu['menuID']?>" />
	                <input type="checkbox" <?php echo $disable_menu; ?> name="accessMenu[]" value="<?php echo $dataMenu['menuID']?>" <?php if ($dataMenu['menuAksesLogin'] > 0){echo 'checked'; }?> />
	            </td>
	        </tr>
				<?php
				$no++;
			}
		}
		
                
                
	}
	//$allMenuID = implode(',',$dataArray);
	echo '<pre>';
	//print_r($dataArr) ;
	echo '</pre>';
	
	
	//echo ($dataArr['menuID'][0]);
	
	foreach ($dataArr['menuID'] as $id)
	{
	?>
	<input type="hidden" name="allMenuID[]" value="<?php echo $id ?>"/>
    <?php
	
	}
    ?> 
        <tr>
            <td colspan="4"><hr></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2" align="center">
                <input type="submit" value="Simpan" name="simpan" style="width: 100%;" <?php echo $disable_menu; ?>>
            </td>
        </tr>
    </table>
</form>
