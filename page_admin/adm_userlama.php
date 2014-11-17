<?php

/* Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_user.php
 * Created By : Irvan Wibowo(Bolang) & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');

//$getUrl = array('a' => array('t','d','h','1','2','3','4','5','6','7','8'));

if (isset($_POST['k_j_simpan']))
{
	$dataArr = array('menu' =>$_POST['showMenu'], 'userID' => $_POST['userID']);
	
	$showMenu = implode (',', $dataArr['menu']);
	
	//echo '<pre>';
	//print_r($query);
	//echo '</pre>';
	$queryshowMenu = "UPDATE Operator SET Hak_Akses = '".$showMenu. "' WHERE OperatorID = ".$dataArr['userID'] ;
	//print_r($queryshowMenu);
	$resultshowMenu = $DBVAR->query($queryshowMenu);
	if ($resultshowMenu)
	{
		echo '<script type=text/javascript>alert("Sukses");</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}

if (isset($_POST['Simpan']))
{
//echo '<script type=text/javascript>alert("Akun Berhasil Dibuat");</script>';
	
	$UserNm = $_POST['UserNm'];
	$Passwd = md5($_POST['Passwd']);
	$NamaOperator = $_POST['NamaOperator'];
	$NIPOperator = $_POST['NIPOperator'];
	$Satker_ID = $_POST['Satker_ID'];
	$JabatanOperator = $_POST['JabatanOperator'];
	(isset($AksesAdmin)) ? $AksesAdmin = 1 : $AksesAdmin = 0;
	
	$var = $DBVAR->query("SELECT * FROM tbl_user_group WHERE groupID = $JabatanOperator");
	
	

	if ($var)
	{
		$result = $DBVAR->fetch_object($var);
		
		$menuAkese = $result->groupAccessMenu;
	}
	
	$query = "INSERT INTO Operator VALUES (
      		  null, '$UserNm', '$Passwd', '$NamaOperator','$JabatanOperator', '$NIPOperator', '$AksesAdmin', '$Satker_ID', '$menuAkese')";
	
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

if (isset($_POST['Hapus']))
{
//echo '<script type=text/javascript>confirm("Hapus Akun ?");</script>';

	$query = "DELETE FROM Operator WHERE OperatorID =".$_POST['Satker_ID']."";
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

if (isset($_POST['Update']))
{
//echo '<script type=text/javascript>alert("Akun Berhasil Diupdate");</script>';

	
	$query = "UPDATE Operator SET 
				UserNm = '".$_POST['UserNm']."', 
				Passwd = '".md5($_POST['Passwd'])."', 
				NamaOperator= '".$_POST['NamaOperator']."',
				JabatanOperator = '".$_POST['JabatanOperator']."', 
				NIPOperator = '".$_POST['NIPOperator']."', 
				AksesAdmin = '".$_POST['AksesAdmin']."' WHERE 
				OperatorID = '".$_POST['Satker_ID']."'";
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


$shufle = str_shuffle('bhsyd18743');
?>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
    <td>
        <table width="100%" align="center" cellpadding="0" cellspacing="5" border="0">
            <tr>
                <td valign="top" class="datalist" align="left" width="35%">
                    <div class="datalist_head" align="center" style="font-weight:bold; padding:3px 5px 2px 5px;color: #3A574E;">
                        Daftar User 
                    </div>
                    <div align="right" style="padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;">
                        <span class="datalist_inactive">
                            <a href="?page=3&p=d&a=<?php echo $_GET['a'].'&i='.$shufle; ?>"style="color:#3A574E;">Tambah User</a>
                        </span>
                    </div>
                            <?php

                                $query = "SELECT * FROM Operator ORDER BY OperatorID ASC";
                                $result = $DBVAR->query($query) or die ($DBVAR->error());
                                $sumRec = $DBVAR->num_rows($result);
                                if( $sumRec ) {
                                    while( $data = $DBVAR->fetch_array($result) ) {
                            ?>
                    <div class="<?php if (isset($_GET['a'])){if ($_GET['a']== $data['OperatorID']) echo 'datalist_inlist_selected';} ?>">
                        <a class="datalist_inlist" href="?page=3&p=d&a=<?php echo $data['OperatorID']; ?>"><?=$data['NamaOperator'];?></a>
                    </div>
                            <?
                                }

                            } 
                            ?>
                </td>
                <td valign="top" align="left" style="padding:0px;">
                    <span class="data_tab_<?php if ($_GET['p']=='d') echo 'non'?>">
                        <a href="?page=3&p=d&a=<?php echo $_GET['a'];?>"style="color:#3A574E;font-weight:bold;">Detail Operator</a>
                    </span>       
                    <span class="data_tab_<?php if ($_GET['p']=='h') echo 'non'?>">
                        <a href="?page=3&p=h&a=<?php echo $_GET['a'];?>"style="color:#3A574E;font-weight:bold;">Hak Akses</a>
                    </span>   
    <div class="datalist" id="iddatalist_entry">
		
        <form name="form_data_level" method="POST"
              style="margin:10px;"
              action="">
			<?php
			
				
				if (isset($_GET['p']))
				{
					switch ($_GET['p'])
					{
						case 'd':
						
						$query = "SELECT * FROM Operator WHERE OperatorID=".$_GET['a'];
						$result = $DBVAR->query($query) or die ($DBVAR->error());
						if ($DBVAR->num_rows($result))
						{
							$dataVal = $DBVAR->fetch_array($result);
							
							//fetch data dari tabel Operator
							$UserNm = $dataVal['UserNm']; 
							$NamaOperator = $dataVal['NamaOperator']; 
							$NIPOperator = $dataVal['NIPOperator'];
							$JabatanOperator = $dataVal['JabatanOperator'];
							$AksesAdmin = $dataVal['AksesAdmin'];
							$Satker_ID = $dataVal['Satker_ID'];
							
						}else{
							$UserNm = ''; 
							$NamaOperator = '';
							$NIPOperator = '';
							$JabatanOperator = '';
							$AksesAdmin = '';
							$Satker_ID = '';
						}
						
						
						if (isset($_GET['a']))
						{
							if (isset($_GET['i']))
							{
								$UserNm = ''; 
								$NamaOperator = '';
								$NIPOperator = '';
								$JabatanOperator = '';
								$AksesAdmin = '';
								$Satker_ID = '';
								$disabled = '';
								//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
								$buttonNameLeft = 'Simpan';
								$buttonNameRight = 'Batal';
								
								//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
								$linkButtonLeft = "";
								$linkButtonRight = '';
								$buttonLeftdisabled = '';
								$buttonRightdisabled = '';
								$buttonTypeLeft = 'submit';
								$buttonTypeRight = 'reset';
							}
							else if (isset($_GET['e']))
							{
								$query = "SELECT * FROM Operator WHERE OperatorID = $_GET[a]";
								$result = $DBVAR->query($query) or die ($DBVAR->error());
								
								$data = $DBVAR->fetch_object($result);
																
								$UserNm = $dataVal['UserNm']; 
								$NamaOperator = $dataVal['NamaOperator'];
								$NIPOperator = '';
								$JabatanOperator  = $data->JabatanOperator;
								$AksesAdmin = '';
								$Satker_ID = '';
								$disabled = '';
								//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
								$buttonNameLeft = 'Update';
								$buttonNameRight = 'Batal';
								
								//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
								$linkButtonLeft = "";
								$linkButtonRight = "window.location.href='?page=3&p=d&a=$_GET[a]'";
								$buttonLeftdisabled = '';
								$buttonRightdisabled = '';
								$buttonTypeLeft = 'submit';
								$buttonTypeRight = 'button';
								
								if ($JabatanOperator == '1')
								{
								//$blok = 'disabled="disabled"';
								}
							}
						
							else 
							{
								$UserNm = $dataVal['UserNm']; 
								$NamaOperator = $dataVal['NamaOperator'];
								$NIPOperator = $dataVal['NIPOperator'];
								$JabatanOperator = $dataVal['JabatanOperator'];
								$AksesAdmin = $dataVal['AksesAdmin'];
								$Satker_ID = $dataVal['Satker_ID'];
								$disabled = 'disabled';
								$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
								$buttonNameLeft = 'Edit';
								$buttonNameRight = 'Hapus';
																
								//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
								$linkButtonLeft = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
								$linkButtonRight = '';
								$buttonLeftdisabled = '';
								$buttonRightdisabled = '';
								
								$buttonTypeLeft = 'button';
								$buttonTypeRight = 'submit';
								
								if ($UserNm == 'admin')
								{
								$blok = 'disabled="disabled"';
								}
								else if ($UserNm == 'guest')
								{
								$blok = 'disabled="disabled"';
								}	 								
							}
							

						}
												
						?>  	 	 	
						User ID <br><input type='text' name='UserNm' value="<?=$UserNm; ?>" size='50' <?=$disabled; ?> required="required"/><br> 
						Enter New Password<br> <input type= 'password' name='Passwd' value="" <?=$disabled; ?> required="required"><br> 
						Nama Lengkap<br> <input type='text' name= 'NamaOperator' value="<?=$NamaOperator; ?>" <?=$disabled; ?> required="required"><br> 
						NIP Operator (Hanya Jika Memiliki)<br> <input type='text' name='NIPOperator' value="<?=$NIPOperator?>" <?=$disabled; ?>><br> 
						
						<?php include 'js_dropdown_user.php'; ?>
						
						Jabatan Operator<br>
						<select name="JabatanOperator" <?=$blok; ?>>
							<?php
							if (isset($_GET['i']))
							{
								$query = "SELECT groupID, groupDesc FROM tbl_user_group where groupDesc not like 'Administrator' ORDER BY groupID ASC";
							
							}else if (isset($_GET['e'])){
								//$query = "SELECT groupID, groupDesc FROM tbl_user_group ORDER BY groupID ASC";
								$query = "SELECT groupID, groupDesc FROM tbl_user_group where groupDesc not like 'Administrator' ORDER BY groupID ASC";
							
							}
							else
							{
								$query = "SELECT groupID, groupDesc FROM tbl_user_group ORDER BY groupID ASC";
								
							}
							$result = $DBVAR->query($query) or die ($DBVAR->error());
							$sumRec = $DBVAR->num_rows($result);
							if( $sumRec ) {
								while( $data = $DBVAR->fetch_array($result) ) {
									?>
								    <option value="<?=$data['groupID']?>" <?php if ($data['groupID']==$JabatanOperator) echo 'selected'?>><?=$data['groupDesc']?></option>
								  <?
								}

							}
							?>
						</select>
						<br> 
						<input type= 'checkbox' name='AksesAdmin' value='1' <?php if ($AksesAdmin) echo 'checked';?> <?=$blok; ?>/>
						Akses Administrator 
						<?php	
							
						break;	
						
						case 'h':
						{
							
							echo "<table border='0' width='100%'>";
							
								echo "<table border='0' width='100%'>";
							
								$queryOperator = " SELECT * FROM Operator WHERE OperatorID = '$_GET[a]'";
								//print_r($queryGroup);
								$resultOperator = $DBVAR->query($queryOperator) or die ($DBVAR->error());
								
								$sumRec = $DBVAR->num_rows($resultOperator);
								if ($sumRec)
								{  
									$dataOperator = $DBVAR->fetch_object($resultOperator);
									//$dataMenuParentArr = $DBVar->get_menu_admin(array('menuID' => $dataGroup->groupListMenu));
									
									$dataArr['user']['Hak_Akses'] = $dataOperator->Hak_Akses;
									$dataOperatorID = $dataOperator->JabatanOperator;
									
								}
								//print_r($dataArr);
								$accessMenu = explode(',',$dataArr['user']['Hak_Akses']);
								
								$queryDisable = " SELECT groupShowMenu FROM tbl_user_group WHERE groupID = $dataOperatorID";
								//print_r($queryDisable);
								$resultDisable = $DBVAR->query($queryDisable) or die ($DBVAR->error());
								$sumRecDisable = $DBVAR->num_rows($resultDisable);
								if ($sumRecDisable)
								{  
									$dataGroup = $DBVAR->fetch_object($resultDisable);
									//$dataMenuParentArr = $DBVar->get_menu_admin(array('menuID' => $dataGroup->groupListMenu));
									$dataArr['group']['groupShowMenu'] = $dataGroup->groupShowMenu;									
								}
								$showMenu = explode(',',$dataArr['group']['groupShowMenu']);
								
								//print_r($dataArr['group']['groupShowMenu']);
								
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
										
										?>
										<tr>
											<td align="right"><input type="checkbox" name="showMenu[]" value="<?php echo $dataMenu['menuID']?>" <?php if (!in_array($dataMenu['menuID'],$showMenu)) echo 'disabled'; ?> <?php for ($s = 0; $s <= count($accessMenu); $s++){if ($accessMenu[$s] == $dataMenu['menuID']){echo 'checked';}}?>/></td>
											<td><?php echo $dataMenu['menuDesc']?></td>
											<td><input type="hidden" value="<?php echo $dataMenu['menuID']?>" /></td>
											<td><input type="hidden" value="<?php echo $_GET['a']; ?>" name="userID" /><!--<input type="checkbox" name="accessMenu[]" value="<?php //echo $dataMenu['menuID']?>" <?php //for ($a = 0; $a <= count($accessMenu); $a++){ if ($accessMenu[$a] == $dataMenu['menuID']){echo 'checked';}}?>/>--></td>
										</tr>
										<?php
										$no++;
									}
									
								}
								
								
							echo "</table>";
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
										<input type="hidden" name="Satker_ID" value="<?=$_GET['a']?>" <?=$blok; ?>/>
										<input type="<?=$buttonTypeLeft; ?>" name="<?=$buttonNameLeft; ?>" value="<?=$buttonNameLeft; ?>" <?=$blok; ?> onclick="<?=$linkButtonLeft;?>" <?=$buttonLeftdisabled ?>>
										<input type='<?=$buttonTypeRight; ?>' name="<?=$buttonNameRight; ?>" value="<?=$buttonNameRight; ?>" <?=$blok; ?> onclick="<?=$linkButtonRight;?>" <?=$buttonRightdisabled ?>>
										
										<?php
									}
									else if ($_GET['p'] == 'h')
									{
										echo '<input type=submit name=k_j_simpan value=Simpan>';
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

