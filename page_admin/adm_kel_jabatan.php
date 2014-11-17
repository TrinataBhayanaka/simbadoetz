<?php

/* class Name : Session
 * Variable Input Type: Array 
 * Location : root_path/page_admin/adm_kel_jabatan.php
 * Created By : Irvan Wibowo & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');

$shufle = str_shuffle('bhsyd18743');



//print_r($_POST);
if (isset($_POST['k_j_simpan']))
{
	//if ($submit_status == 0) echo "<script type='text/javascript'>alert('Akses ditolak'); window.location.href='$url_rewrite/page_admin/?page=$_GET[page]'</script>";
	
	//print_r($_POST);
	
	//exit;
	//if ($user_ses['ses_ajabatan'] !== $_POST['groupID']) exit ($USERAUTH->show_warning_html('Akses Ditolak'));
		
	
	$dataArr = array('menu' =>$_POST['showMenu'], 'groupID' => $_POST['groupID']);
	
	$showMenu = implode (',', $dataArr['menu']);
	
	
	$queryshowMenu = "UPDATE tbl_user_group SET groupShowMenu = '".$showMenu. "' WHERE groupID = ".$dataArr['groupID'] ;
	//print_r($queryshowMenu);
	//exit;
	$resultshowMenu = $DBVAR->query($queryshowMenu);
	if ($resultshowMenu)
	{
		$query_jabatan = "SELECT groupShowMenu FROM tbl_user_group WHERE groupID = $dataArr[groupID]";
		$result_jabatan = $DBVAR->query($query_jabatan) or die ($DBVAR->error());
		if ($DBVAR->num_rows($result_jabatan))
		{
			$data_jabatan = $DBVAR->fetch_object($result_jabatan);
			
			$jabatan_menu = $data_jabatan->groupShowMenu;
			$menu_explode_jabatan = explode (',',$jabatan_menu);
		}
		
		//print_r($jabatan_menu);
		$query = "SELECT OperatorID, Hak_Akses FROM Operator WHERE JabatanOperator = $dataArr[groupID]";
		$result = $DBVAR->query($query) or die ($DBVAR->error());
		while ($data = $DBVAR->fetch_object($result))
		{
			$dataMenu[$data->OperatorID] [] =  $data->Hak_Akses;
			
			
		}
		
		if (is_array($dataMenu)){
			foreach ($dataMenu as $index => $value)
			{
				//echo $index.'<br><br>';
				//echo ($value[0]);
				
				if ($value[0] !='')
				{
					$menu_explode[$index] = explode (',',$value[0]);
					
				}
				
			}
		}
		
		if (is_array($menu_explode)){
			foreach ($menu_explode as $index => $menu)
			{
				
				foreach ($menu as $value)
				{
					//echo $value.'<br>';
					
					if (in_array($value, $menu_explode_jabatan))
					{
						$menu_fix[$index][] = $value;
					}
				}
			}
		}
		
		
		if (is_array($menu_fix)){
			foreach($menu_fix as $index => $menu)
			{
				if ($menu !='')
				{
					$data = implode(',',$menu);
					$query = "UPDATE Operator SET Hak_Akses = '$data' WHERE OperatorID = $index";
					//print_r($query);
					$result = $DBVAR->query($query) or die ($DBVAR->error());
				}
				
				
			}
		}
		
		//$arr_menu =
		//print_r($menu_fix);
		echo '<script type=text/javascript>alert("Sukses");</script>';
		//echo '<pre>';
		//print_r($data);
		//exit;
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}


if (isset($_POST['Simpan']))
{

	if ($user_ses['ses_ajabatan'] !== $_POST['groupID']) exit ($USERAUTH->show_warning_html('Akses Ditolak'));
	
	$groupDesc = $_POST['groupDesc'];
	
	(isset($_POST['akses_admin'])) ? $akses_admin = '1' : $akses_admin = '0';
	
	$query = "INSERT INTO tbl_user_group VALUES (null, '$groupDesc', null, null, '$akses_admin')";
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	if ($result)
	{
		echo '<script type=text/javascript>alert("Sukses");</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}

if (isset($_POST['submit_modul'])){
	// pr($_POST);
	// pr($sessionAdmin);
	$tambah = @implode('-',$_POST['tambah']);
	$edit = @implode('-',$_POST['edit']);
	$hapus = @implode('-',$_POST['hapus']);
	$cetak = @implode('-',$_POST['cetak']);
	$jabatan_id = trim(strip_tags($_POST['jabatan_id']));
	
	$sql = "SELECT groupDesc FROM tbl_user_group WHERE groupID = {$jabatan_id} LIMIT 1";
	$jabatan = $DBVAR->_fetch_object($query,0);
	
	$query = "SELECT userlevelaccess_id FROM sys_userlevelaccess";
	$result = $DBVAR->_fetch_object($query,1);
	// pr($result);
	foreach ($result as $value){
		$data[] = $value->userlevelaccess_id;
	}
	
	$dataJabatanID = array_unique($data);
	if (in_array($jabatan_id, $dataJabatanID)){
		//update
		$sql = "UPDATE sys_userlevelaccess SET tambah = '{$tambah}', ubah = '{$edit}', hapus = '{$hapus}', cetak = '{$cetak}'
				WHERE userlevelaccess_id = {$jabatan_id}";
			
	}else{
		//insert
		$sql = "INSERT INTO sys_userlevelaccess (userlevelaccess_id, levelname, tambah, ubah, hapus, cetak)
			VALUES ({$jabatan_id}, '{$jabatan[0]->groupDesc}', '{$tambah}',
			'{$edit}', '{$hapus}', '{$cetak}')";
	}
	
	
	// pr($sql);
	$res = $DBVAR->query($sql);
	if ($res){
		//echo '<script type=text/javascript>alert("Sukses");</script>';
	}else{
		//echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}

if (isset($_POST['Hapus']))
{
	
	//exit;
	//if ($user_ses['ses_ajabatan'] !== $_POST['groupID']) exit ($USERAUTH->show_warning_html('Akses Ditolak'));
	
	$query = "DELETE FROM tbl_user_group WHERE groupID ='$_POST[groupID]'";
	//print_r($query);
	//$result = 1;
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	if ($result)
	{
		echo '<script type=text/javascript>alert("Jabatan Sudah Dihapus");</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Jabatan Gagal Dihapus");</script>';
	}
	
}

if (isset($_POST['Update']))
{
	
	//if ($user_ses['ses_ajabatan'] !== $_POST['groupID']) exit ($USERAUTH->show_warning_html('Akses Ditolak'));
	
	(isset($_POST['akses_admin'])) ? $akses_admin = '1' : $akses_admin = '0';
	$query = "UPDATE tbl_user_group SET groupDesc ='$_POST[groupDesc]', groupAccessAdmin = '$akses_admin' WHERE groupID ='$_POST[groupID]'";
	//print_r($query);
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	if ($result)
	{
		echo '<script type=text/javascript>alert("Sukses");</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}


if (isset($_GET['e']) and ($_GET['p']=='d'))
{
	$onsubmit = "if(!confirm('Update Jabatan ?')){return false;}";
}
else if ($_GET['p']=='d' and $_GET['i']!=='')
{
	$onsubmit = "if(!confirm('Simpan Data ?')){return false;}";
}
else if ($_GET['p']=='h')
{
	$onsubmit = "if(!confirm('Simpan Data ?')){return false;}";
}
else if ($_GET['p']=='m')
{
	$onsubmit = "if(!confirm('Simpan Data ?')){return false;}";
}
else
{
	$onsubmit = "if(!confirm('Hapus Jabatan ?')){return false;}";
}

?>


<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background:white;">
    <td>
        <table width="100%" align="center" cellpadding="0" cellspacing="5" border="0">
            <tr>
                <td valign="top" class="datalist" align="left" width="35%">
                    <div class="datalist_head" align="center" style="font-weight:bold; padding:3px 5px 2px 5px;color: #3A574E;">
                        Daftar&nbsp;Jabatan
                    </div>
                    <div align="right" style="padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;">
                        <span class="datalist_inactive">
                            <a href="?page=2&p=d&a=<?php echo $_GET['a'].'&i='.$shufle; ?>" style="color:#3A574E;">Tambah Jabatan</a>
                        </span>
                    </div>
<?

$query = "SELECT groupID, groupDesc FROM tbl_user_group ORDER BY groupDesc ASC";
$result = $DBVAR->query($query) or die ($DBVAR->error());
$sumRec = $DBVAR->num_rows($result);

  if( $sumRec ) {
    while( $data = $DBVAR->fetch_array($result) )
        {
      
      
?>
        
	<div class="<?php if (isset($_GET['a'])){if ($_GET['a']==$data['groupID']) echo 'datalist_inlist_selected';} ?>">
	    <a class="datalist_inlist" href="?page=2&p=d&a=<?php echo $data['groupID']; ?>"><?=$data['groupDesc'];?></a>
	</div>

        
<?
	//$dataArrGroup [] = $data;
}
} else {

    ?>
                    <div align="center" style="padding:10px;">Tidak ada data...</div><?

  }
?>
    
                </td>
                <td valign="top" align="left" style="padding:0px;">
                    <span class="data_tab_<?php if ($_GET['p']=='d') echo 'non'?>" >
                        <a href="?page=2&p=d&a=<?php echo $_GET['a'];?>" style="color:gray;font-weight:bold;">Detail Jabatan</a>
                    </span>   
                    <span class="data_tab_<?php if ($_GET['p']=='h') echo 'non'?>">
                        <a href="?page=2&p=h&a=<?php echo $_GET['a'];?>" style="color:#3A574E;font-weight:bold;">Hak Akses Menu</a>
                    </span>
					<!--
					<span class="data_tab_<?php if ($_GET['p']=='c') echo 'non'?>">
                        <a href="?page=2&p=m&a=<?php echo $_GET['a'];?>" style="color:#3A574E;font-weight:bold;">Akses Modul</a>
                    </span>-->
                    <div class="datalist" id="iddatalist_entry">
                        <form name="form_data_level" method="POST" style="margin:10px;" action="" onsubmit="<?php echo $onsubmit; ?>">
                                                        
                            <?php
			
				
				if (isset($_GET['p']))
				{
					switch ($_GET['p'])
					{
						case 'd':
						
						$query = "SELECT groupID, groupDesc, groupAccessAdmin FROM tbl_user_group WHERE groupID=".$_GET['a'];
						$result = $DBVAR->query($query) or die ($DBVAR->error());
						if ($DBVAR->num_rows($result))
						{ 
							$dataVal = $DBVAR->fetch_array($result);
							
							$groupDesc = $dataVal['groupDesc'];
							if ($dataVal['groupAccessAdmin'] == '1') $check_admin = 'checked';
						}else{
							$groupDesc = '';
							$check_admin = '';
						}
						
						
						if (isset($_GET['a']))
						{
							if (isset($_GET['i']))
							{
								$groupDesc = '';
								$text = '';
								$groupDescDisabled = '';
								$buttonLeftName = 'Simpan';
								$buttonRightName = 'Batal';
								$linkLeftButton = "";
								$linkRightButton = "";
								$buttonTypeLeft = 'submit';
								$buttonTypeRight = 'reset';
							}
							else if (isset($_GET['e']))
							{
								$groupDesc = $dataVal['groupDesc'];
								$text = '';
								$groupDescDisabled = '';
								$buttonLeftName = 'Update';
								$buttonRightName = 'Batal';
								$linkLeftButton = "";
								$linkRightButton = "window.location.href='./?page=2&p=d&a=$_GET[a]'";
								$buttonTypeLeft = 'submit';
								$buttonTypeRight = 'button';
							}
							else
							{
								
								if ($user_ses['ses_ajabatan'] == 1)
								{
									if ($_GET['a'] == 1)
									{
										$button_edit_disable = "";
										$button_hapus_disable = "disabled";
									}
									else
									{
										$button_edit_disable = "";
										$button_hapus_disable = "";
									}
								}
								else
								{
									if ($user_ses['ses_ajabatan'] == $_GET['a'])
									{
										$button_edit_disable = "";
										$button_hapus_disable = "disabled";
									}
									else
									{
										$button_edit_disable = "disabled";
										$button_hapus_disable = "disabled";
									}
								}
								
								
								
								$groupDesc = $dataVal['groupDesc']; 
								$groupDescDisabled = 'disabled';
								
								$text = 'Read Only: <u><i>Jabatan sudah digunakan pada tabel Operator.</i></u><br><br>';
								$buttonLeftName = 'Edit';
								$buttonRightName = 'Hapus';
								$buttonTypeLeft = 'button';
								$buttonTypeRight = 'submit';
								//$link = "window.location.href='./?page=2&p=d&a=$_GET[a]&e=$shufle'";
								$linkLeftButton = "window.location.href='./?page=2&p=d&a=$_GET[a]&e=$shufle'";
								$linkRightButton = "confirmasi()";
								
							}
						}
						
						
						?>
								Nama Jabatan <br><input type='text' name='groupDesc' value="<?php echo $groupDesc; ?>" size='50' <?php echo $groupDescDisabled; ?>/><br>
								
								<?php echo $text; ?>
								Default Akses<br>
								<input type='checkbox' name='akses_admin' value='1' <?=$groupDescDisabled?> <?php echo $check_admin; ?>/>Akses ke halaman Admin
								<input type='hidden' name='groupID' value='<?php echo $_GET['a']; ?>'/>
						<?php	
							
						break;	
						case 'h':
						{
							?>
							<table border='0' width='100%'>
	
							<?php
							
							//($user_ses['ses_ajabatan'] == $_GET['a']) ? $submitDisabled = '' : $submitDisabled = 'disabled';
							if ($user_ses['ses_ajabatan'] == 1)
							{
								$submitDisabled = '';
							}else if ($user_ses['ses_ajabatan'] == $_GET['a'])
							{
								$submitDisabled = '';
							}
							else
							{
								$submitDisabled = 'disabled';
							}
							$query = "SELECT menuID FROM tbl_user_menu WHERE menuStatus = 0";
							$result = $DBVAR->query($query) or die (mysql_error);
							if ($DBVAR->num_rows($result))
							{
								while ($data = $DBVAR->fetch_array($result))
								{
									$menuID[] = $data['menuID'];
								}
							}
							
							$queryGroup = " SELECT groupShowMenu, groupAccessMenu
												FROM tbl_user_group WHERE groupID = ".$_GET['a'];
								$resultGroup = $DBVAR->query($queryGroup) or die ($DBVAR->error());
								$sumRec = $DBVAR->num_rows($resultGroup);
								if ($sumRec)
								{  
									$dataGroup = $DBVAR->fetch_object($resultGroup);
									//$dataMenuParentArr = $DBVar->get_menu_admin(array('menuID' => $dataGroup->groupListMenu));
									$dataArr['group']['groupShowMenu'] = $dataGroup->groupShowMenu;
									$dataArr['group']['groupAccessMenu'] = $dataGroup->groupAccessMenu;
									
								}
								$showMenu = explode(',',$dataArr['group']['groupShowMenu']);
								$accessMenu = explode(',',$dataArr['group']['groupAccessMenu']);

								$queryParent = "SELECT * FROM tbl_user_menu_parent";
								
								$resultParent = $DBVAR->query($queryParent);
								
								
								
								while ($dataParent = $DBVAR->fetch_array($resultParent))
								{
									
									?>
										<tr>
											<td colspan="4" style='border:1px solid #c0c0c0; background-color: #f0f0f0; padding: 3px 5px 2px 5px;'><?php echo $dataParent['menuParentDesc']; ?></td>
										</tr>
									<?php
									$queryMenu = "SELECT * FROM tbl_user_menu WHERE menuParent = ".$dataParent['menuParentID'];
									$resultMenu = $DBVAR->query($queryMenu);
									
									$no = 1;
									
									while ($dataMenu = $DBVAR->fetch_array($resultMenu))
									{
										//$dataMenuHakAkses[] = $dataMenu->menuID;
									
										?>
										<tr>
											<td align="right">
												<input type="checkbox" name="showMenu[]" value="<?php echo $dataMenu['menuID']?>"
												<?php if ($menuID !=''){ if (in_array($dataMenu['menuID'], $menuID)) echo 'disabled';} ?>
												<?php for ($s = 0; $s <= count($showMenu); $s++){if ($showMenu[$s] == $dataMenu['menuID']){echo 'checked';}} ?>/>
											</td>
											<td><?php echo $dataMenu['menuDesc']?> </td>
											<td><input type="hidden" value="<?php echo $dataMenu['menuID']?>" /></td>
											<td><input type="hidden" value="<?php echo $_GET['a']; ?>" name="groupID" /> </td>
										</tr>
										<?php
										$no++;
										
									}
									
								}
								
								?>
							</table>
							<?php
						}
						break;
						
						case 'm':
						{
							
							$jabatan_id = @trim($_GET['a']);
							$query = "SELECT * FROM sys_userlevelaccess WHERE userlevelaccess_id = {$jabatan_id} LIMIT 1";
							$dataJabatan = $DBVAR->_fetch_object($query,0);
	
							$sql = "SELECT * FROM tbl_user_menu_parent";
							$res = $DBVAR->_fetch_object($sql,1);
							
							
							$selectTambah = explode('-', $dataJabatan[0]->tambah);
							$selectEdit = explode('-', $dataJabatan[0]->ubah);
							$selectHapus = explode('-', $dataJabatan[0]->hapus);
							$selectCetak = explode('-', $dataJabatan[0]->cetak);
							// pr($selectTambah);
							?>
							<form method="post" action="">
							<table border="1" style="border-collapse:collapse">
								<tr height="50px">
									<td align="center" style="padding:5px;">Nama Modul</td>
									<td align="center" style="padding:5px;">Aksi Tambah</td>
									<td align="center" style="padding:5px;">Aksi Edit</td>
									<td align="center" style="padding:5px;">Aksi Hapus</td>
									<td align="center" style="padding:5px;">Aksi Cetak</td>
								</tr>
								<?php
									foreach ($res as $data){
									?>
										<tr>
										<td style="padding:5px;"><?php echo $data->menuParentDesc?></td>
										<td align="center" ><input type="checkbox" name="tambah[]" value="<?php echo $data->menuParentID?>" <?php if (in_array($data->menuParentID ,$selectTambah)) echo "checked=\"checked\""; ?>></td>
										<td align="center" ><input type="checkbox" name="edit[]" value="<?php echo $data->menuParentID?>" <?php if (in_array($data->menuParentID ,$selectEdit)) echo "checked=\"checked\""; ?>></td>
										<td align="center" ><input type="checkbox" name="hapus[]" value="<?php echo $data->menuParentID?>" <?php if (in_array($data->menuParentID ,$selectHapus)) echo "checked=\"checked\""; ?>></td>
										<td align="center" ><input type="checkbox" name="cetak[]" value="<?php echo $data->menuParentID?>" <?php if (in_array($data->menuParentID ,$selectCetak)) echo "checked=\"checked\""; ?>></td>
										</tr>
									<?php
									}
									
								?>
								<tr>
									<td colspan="5" align="right">
										<input type="hidden" name="jabatan_id" value="<?php echo trim(strip_tags($_GET['a']))?>">
										<input type="submit" name="submit_modul" value="Simpan">
									</td>
								</tr>
							</table>
							
							</form>
							<?php
						}
						break;
						default :
							{
								echo "<script type='text/javascript'>window.location.href='$url_rewrite/page_admin?page=2&p=d&a=1'</script>";
							}
					}
					?>
						<div align='right'>
								<?php
								if (isset($_GET['p']))
								{
									if ($_GET['p'] == 'd')
									{
										?>
										<input type="hidden" name="groupAccessMenu" value=""/>
										<input type="<?=$buttonTypeLeft; ?>" name="<?=$buttonLeftName?>" value="<?=$buttonLeftName?>" onclick="<?=$linkLeftButton?>" <?=$button_edit_disable?>>
										<input type='<?=$buttonTypeRight; ?>' name="<?=$buttonRightName?>" value="<?=$buttonRightName?>" onclick="<?=$linkRightButton?>" <?=$button_hapus_disable?>>
										
										<?php
									}
									else if ($_GET['p'] == 'h')
									{
										echo "<input type='submit' name='k_j_simpan' value='Simpan' $submitDisabled>";
									}
								}
								?>
							</div>
					<?php
				}
			
			
			?>
        
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </td>
</table>

