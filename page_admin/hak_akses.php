<table border='0' width='100%'>
	
<?php

$queryGroup = " SELECT groupShowMenu, groupAccessMenu
					FROM tbl_user_group WHERE groupID = ".$_GET['a'];
	$resultGroup = mysql_query($queryGroup) or die (mysql_error());
	$sumRec = mysql_num_rows($resultGroup);
	if ($sumRec)
	{  
		$dataGroup = mysql_fetch_object($resultGroup);
		//$dataMenuParentArr = $DBVar->get_menu_admin(array('menuID' => $dataGroup->groupListMenu));
		$dataArr['group']['groupShowMenu'] = $dataGroup->groupShowMenu;
		$dataArr['group']['groupAccessMenu'] = $dataGroup->groupAccessMenu;
		
	}
	$showMenu = explode('-',$dataArr['group']['groupShowMenu']);
	$accessMenu = explode('-',$dataArr['group']['groupAccessMenu']);
	
	$queryParent = "SELECT * FROM tbl_user_menu_parent";
	
	$resultParent = mysql_query($queryParent);
	
	
	
	while ($dataParent = mysql_fetch_array($resultParent))
	{
		
		?>
			<tr>
				<td colspan="4" style='border:1px solid #c0c0c0; background-color: #f0f0f0; padding: 3px 5px 2px 5px;'><?php echo $dataParent['menuParentDesc']; ?></td>
			</tr>
		<?php
		$queryMenu = "SELECT * FROM tbl_user_menu WHERE menuParent = ".$dataParent['menuParentID'];
		$resultMenu = mysql_query($queryMenu);
		
		$no = 1;
		while ($dataMenu = mysql_fetch_array($resultMenu))
		{
			
			?>
			<tr>
				<td align="right"><input type="checkbox" name="showMenu[]" value="<?php echo $dataMenu['menuID']?>" <?php for ($s = 0; $s <= count($showMenu); $s++){if ($showMenu[$s] == $dataMenu['menuID']){echo 'checked';}}?>/></td>
				<td><?php echo $dataMenu['menuDesc']?></td>
				<td><input type="hidden" value="<?php echo $dataMenu['menuID']?>" /></td>
				<td><input type="hidden" value="<?php echo $_GET['a']; ?>" name="groupID" /><!--<input type="checkbox" name="accessMenu[]" value="<?php //echo $dataMenu['menuID']?>" <?php //for ($a = 0; $a <= count($accessMenu); $a++){ if ($accessMenu[$a] == $dataMenu['menuID']){echo 'checked';}}?>/>--></td>
			</tr>
			<?php
			$no++;
		}
		
	}
	
	?>
</table>
