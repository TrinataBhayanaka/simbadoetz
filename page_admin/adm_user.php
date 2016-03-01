<?php

/* Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_user.php
 * Created By : Irvan Wibowo(Bolang) & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');


if (isset($_POST['k_j_simpan']))
{
	$dataArr = array('menu' =>$_POST['showMenu'], 'userID' => $_POST['userID']);
	
	$showMenu = implode (',', $dataArr['menu']);
	
	$queryshowMenu = "UPDATE Operator SET Hak_Akses = '".$showMenu. "' WHERE OperatorID = ".$dataArr['userID'] ;
	
	$data = "Hak_Akses = '$showMenu'";
	$resultshowMenu = $DBVAR->query($queryshowMenu) or die ($DBVAR->error());
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
	
	$UserNm = $_POST['UserNm'];
	$Passwd = md5($_POST['Passwd']);
	$NamaOperator = $_POST['NamaOperator'];
	$NIPOperator = $_POST['NIPOperator'];
	$Satker_ID = $_POST['Satker_ID'];
    $SKPD_ID=    intval($_POST['skpd_id']);
	$JabatanOperator = $_POST['JabatanOperator'];
	
	if (isset($_POST['AksesAdmin']))
	{
		
		$status = $USERAUTH->admin_check_akses_group_to_admin($JabatanOperator);
		
		if ($status)
		{
			$AksesAdmin = 1;
		}
		else
		{
			$messg = "Maaf, Jabatan tidak diizinkan untuk mengakses halaman admin";
			exit ($USERAUTH->show_warning_html($messg));
		}
	}
	else
	{
		$AksesAdmin = 0;
	}
	$var = $DBVAR->query("SELECT * FROM tbl_user_group WHERE groupID = $JabatanOperator");
	
	if ($var)
	{
		$result = $DBVAR->fetch_object($var);
		
		$menuAkese = $result->groupShowMenu;
	}
	
	$query = "INSERT IGNORE INTO Operator VALUES (
		  null, '$UserNm', '$Passwd', '$NamaOperator','$JabatanOperator', '$NIPOperator', '$AksesAdmin', '$SKPD_ID', '$menuAkese')";
	
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

	$query = "DELETE FROM Operator WHERE OperatorID =".$_POST['Satker_ID']."";
	$result = mysql_query($query) or die (mysql_error());
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

	$JabatanOperator = $_POST['JabatanOperator'];
	if (isset($_POST['AksesAdmin']))
	{
		
		$status = $USERAUTH->admin_check_akses_group_to_admin($JabatanOperator);
		
		if ($status)
		{
			$AksesAdmin = 1;
		}
		else
		{
			$messg = "Maaf, Jabatan tidak diizinkan untuk mengakses halaman admin";
			exit ($USERAUTH->show_warning_html($messg));
		}
	}
	else
	{
		$AksesAdmin = 0;
	}
	
	
	$query = "UPDATE Operator SET 
				UserNm = '".$_POST['UserNm']."', 
				Passwd = '".md5($_POST['Passwd'])."', 
				NamaOperator= '".$_POST['NamaOperator']."',
				JabatanOperator = '$JabatanOperator', 
				NIPOperator = '".$_POST['NIPOperator']."', 
				AksesAdmin = '$AksesAdmin',
                                                 Satker_ID='".$_POST['skpd_id']."'
                             
                                               WHERE 
				OperatorID = '".$_POST['Satker_ID']."'";
	$result = mysql_query($query) or die (mysql_error());
	if ($result)
	{
		echo '<script type=text/javascript>alert("Sukses"); history.back()</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}

if (isset($_POST['resetUser'])){
	$id = $_POST['id_user'];
	if ($id){
		$sql = "UPDATE tbl_is_login SET n_status = 0 WHERE id = {$id}";
		$res = $DBVAR->query($sql);
		if ($res)
		{
			echo '<script type=text/javascript>alert("Sukses"); history.back()</script>';
		}
		else
		{
			echo '<script type=text/javascript>alert("Gagal");</script>';
		}
	}
}

$shufle = str_shuffle('bhsyd18743');

$menu_enable = $RETRIEVE_ADMIN->retrieve_menu_enable('1');

?>

<link rel="stylesheet" href="css/demo_page.css" />
<link rel="stylesheet" href="css/demo_table.css" />

<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

<script type="text/javascript">
	/* Define two custom functions (asc and desc) for string sorting */
	jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
		return ((x < y) ? -1 : ((x > y) ?  1 : 0));
	};
	
	jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
		return ((x < y) ?  1 : ((x > y) ? -1 : 0));
	};
	
	$(document).ready(function() {
		/* Build the DataTable with third column using our custom sort functions */
		$('#example').dataTable( {
			"aaSorting": [ [0,'asc'], [1,'asc'] ],
			"aoColumnDefs": [
				{ "sType": 'string-case', "aTargets": [ 0 ] }
			]
		} );
	} );
</script>

<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
    <td>
        <table width="100%" align="center" cellpadding="0" cellspacing="5" border="1" >
            <tr>
                <td valign="top" class="" align="left" width="52%" style="height: 300px; overflow: auto">
                    <div class="datalist_head" align="center" style="font-weight:bold; padding:3px 5px 2px 5px;color: #3A574E; ">
                        Daftar User 
                    </div>
                    <div align="right" style="padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px; ">
                        <span class="datalist_inactive">
                            <a href="?page=3&p=d&a=<?php echo $_GET['a'].'&i='.$shufle; ?>"style="color:#3A574E;">Tambah User</a>
                        </span>
                    </div>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="1" class="display" id="example" width="100%">
						<thead>
							<tr>
								<th>Satker</th>
								<th>Nama Operator</th>
							</tr>
						</thead>
						<tbody>
							
                    <?php

                        $query = "SELECT if ((o.Satker_ID = 0 OR o.Satker_ID IS NULL) AND o.JabatanOperator = 1, 'ADMINISTRATOR', s.NamaSatker) AS NamaSatker, o.Satker_ID, o.JabatanOperator, o.NamaOperator, o.OperatorID FROM Operator AS o
                        			LEFT JOIN satker AS s ON o.Satker_ID = s.Satker_ID where 1 
                        			ORDER BY o.Satker_ID ASC  ";
                        // pr($query);
                        $result = mysql_query($query) or die (mysql_error());
                        $sumRec = mysql_num_rows($result);
                        if( $sumRec ) {

                        	$dataArr = $DBVAR->fetch($query,1);
                        	// pr($dataArr);
                        	/*foreach ($dataArr as $key => $value) {
                        		$Satker_ID = intval($value['Satker_ID']);
                        		if ($Satker_ID>0){
                        			$sql = "SELECT NamaOperator, OperatorID FROM Operator WHERE Satker_ID = $Satker_ID";
                            		
                        		}else{
                        			$sql = "SELECT NamaOperator, OperatorID FROM Operator WHERE Satker_ID IS NULL";
                            		 
                        		}
                        		$dataArr[$key]['operator'] = $DBVAR->fetch($sql,1);
                            		
                        	}*/
                        }

                        if ($dataArr){
                        	foreach ($dataArr as $key => $value) {
                        		?>

                        			
                        				<?php //foreach ($value['operator'] as $val): ?>
										<tr>
										<td><?= ($value['NamaSatker']=="") ? 'Unknown' : $value['NamaSatker'];?></td>
										<td><a  href="?page=3&p=d&a=<?php echo $value['OperatorID']; ?>"><span><?=$value['NamaOperator']?></span></a></td>
										</tr>
									<?php //endforeach;?>
									

									
                        		<?php
                        	}
                        }
                    ?>
                        </tbody>
                        <tfoot>
							<tr>
								<th>Rendering engine</th>
								<th>Browser</th>
							</tr>
						</tfoot>
					</table>

                </td>
                <td valign="top" align="left" style="padding:0px;">
                    <span class="data_tab_<?php if ($_GET['p']=='d') echo 'non'?>">
                        <a href="?page=3&p=d&a=<?php echo $_GET['a'];?>" style="color:#3A574E;font-weight:bold;">Detail Operator</a>
                    </span>       
                    <span class="data_tab_<?php if ($_GET['p']=='h') echo 'non'?>">
                        <a href="?page=3&p=h&a=<?php echo $_GET['a'];?>"style="color:#3A574E;font-weight:bold;">Hak Akses</a>
                    </span>
					<span class="data_tab_<?php if ($_GET['p']=='h') echo 'non'?>">
                        <a href="?page=3&p=r&a=<?php echo $_GET['a'];?>"style="color:#3A574E;font-weight:bold;">Reset Akun</a>
                    </span>
    <div class="datalist" id="iddatalist_entry">
		
        <form name="form_data_level" method="POST" style="margin:10px;" action="">
			<?php
			
				if (isset($_GET['p']))
				{
					switch ($_GET['p'])
					{
						case 'd':
						
						$query = "SELECT * FROM Operator WHERE OperatorID=".$_GET['a'];
						$result = mysql_query($query) or die (mysql_error());
						if (mysql_num_rows($result))
						{
							$dataVal = mysql_fetch_array($result);
							$UserNm = $dataVal['UserNm']; 
							$NamaOperator = $dataVal['NamaOperator']; 
							$NIPOperator = $dataVal['NIPOperator'];
							$JabatanOperator = $dataVal['JabatanOperator'];
							$AksesAdmin = $dataVal['AksesAdmin'];
							$Satker_ID = $dataVal['Satker_ID'];
                                                                                    
	                         $SKPD_ID = $dataVal['Satker_ID'];
	                         $query_data="select NamaSatker from Satker WHERE Satker_ID='$SKPD_ID'";
	                         $result_data = mysql_query($query_data) or die (mysql_error());
	                         $uraian="";
	                         if (mysql_num_rows($result_data))
	                         {
	                              $dataSatker = mysql_fetch_array($result_data);
	                              $uraian=$dataSatker ['NamaSatker'];
	                         }
                                                                                
							
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
								// insert

								$UserNm = ''; 
								$NamaOperator = '';
								$NIPOperator = '';
								$JabatanOperator = '';
								$AksesAdmin = '';
								$Satker_ID = '';
								$disabled = '';
								$uraian="";
								$buttonNameLeft = 'Simpan';
								$buttonNameRight = 'Batal';
								
								$linkButtonLeft = "";
								$linkButtonRight = '';
								$buttonLeftdisabled = '';
								$buttonRightdisabled = '';
								$buttonTypeLeft = 'submit';
								$buttonTypeRight = 'reset';
							}
							else if (isset($_GET['e']))
							{
								// edit
								$UserNm = $dataVal['UserNm']; 
								$NamaOperator = $dataVal['NamaOperator'];
								$NIPOperator = $NIPOperator;
								$JabatanOperator = $JabatanOperator;
								$Satker_ID = '';
								$disabled = '';
								$buttonNameLeft = 'Update';
								$buttonNameRight = 'Batal';
								
								$linkButtonLeft = "";
								$linkButtonRight = "window.location.href='?page=3&p=d&a=$_GET[a]'";
								$buttonLeftdisabled = '';
								$buttonRightdisabled = '';
								$buttonTypeLeft = 'submit';
								$buttonTypeRight = 'button';
							}
						
							else 
							{
                                               
								// default
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
								
								$linkButtonLeft = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
								$linkButtonRight = "window.confirm('Hapus User ?');";
								
								
								$buttonTypeLeft = 'button';
								$buttonTypeRight = 'submit';
								
								
								if ($user_ses['ses_ajabatan'] == 1)
								{
									
									if ($user_ses['ses_aoperatorid'] == $_GET['a'])
									{
										$buttonLeftdisabled = '';
										$buttonRightdisabled = 'disabled';
										
									}
									else
									{
										$buttonLeftdisabled = '';
										$buttonRightdisabled = '';
									}
								}
								else
								{
									
									if ($user_ses['ses_aoperatorid'] == $_GET['a'])
									{
										$buttonLeftdisabled = '';
										$buttonRightdisabled = 'disabled';
										
									}
									else
									{
										$buttonLeftdisabled = 'disabled';
										$buttonRightdisabled = 'disabled';
									}
									
								}
								
								$combobox_disable = 'disabled';
								$checkbox_disable = 'disabled';
								
							}
							

						}
						?>  	 	 	
						User ID <br><input type='text' name='UserNm' value="<?=$UserNm; ?>" size='50' <?=$disabled; ?> required="required"/><br> 
						Enter New Password<br> <input type= 'password' name='Passwd' value="" <?=$disabled; ?> required="required"><br> 
						Nama Lengkap<br> <input type='text' name= 'NamaOperator' value="<?=$NamaOperator; ?>" <?=$disabled; ?> required="required"><br> 
						NIP Operator <label style="font-size: 10px;">(Hanya Jika Memiliki)</label><br><input type='text' name='NIPOperator' value="<?=$NIPOperator?>" <?=$disabled; ?>><br> 
						Jabatan Operator<br>
						<input style="width: 300px;" name="skb_add_skpd" id="skb_add_skpd" type="text" value="<?php echo $uraian ; ?>"  required="required" readonly="readonly"/>
												<input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
												<div class="inner" style="display:none;">
							<style>
								.tabel th {
									background-color: #eeeeee;
									border: 1px solid #dddddd;
								}
								.tabel td {
									border: 1px solid #dddddd;
								}
							</style>
							<?php
								$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
								$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
								js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"skb_add_skpd","skpd_id",'skpd','skbskpdadd');
								$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
								radioskpd($style2,"skpd_id",'skpd','skbskpdadd|'.$Satker_ID);
							?>
						</div>	
						
						<br>
						<select name="JabatanOperator" <?=$combobox_disable; ?> >
							<?php
							if ($user_ses['ses_ajabatan'] == 1)
							{
								
								$query = "SELECT groupID, groupDesc FROM tbl_user_group ORDER BY groupID ASC";
							}
							else
							{
								$query = "SELECT groupID, groupDesc FROM tbl_user_group WHERE groupID <> 1 ORDER BY groupID ASC";
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
                                 
						<input type= 'checkbox' name='AksesAdmin' value='1' <?php if ($AksesAdmin)  echo 'checked';?> <?=$checkbox_disable; ?>/>
						Akses Administrator <br><p style="font-size:9px;">* Pastikan jabatan mempunyai akses ke halaman admin</p>
						<?php	
							
						break;	
						
						case 'h':
						{
							
							echo "<table border='0' width='100%'>";
							
								$queryOperator = " SELECT * FROM Operator WHERE OperatorID = '$_GET[a]'";
								$resultOperator = $DBVAR->query($queryOperator) or die ($DBVAR->error());
								
								$sumRec = $DBVAR->num_rows($resultOperator);
								if ($sumRec)
								{  
									$dataOperator = $DBVAR->fetch_object($resultOperator);
									
									$dataArr['user']['Hak_Akses'] = $dataOperator->Hak_Akses;
									$dataOperatorID = $dataOperator->JabatanOperator;
									
								}
								print_r($dataMenu);
								$accessMenu = explode(',',$dataArr['user']['Hak_Akses']);
								
								$queryDisable = " SELECT groupShowMenu FROM tbl_user_group WHERE groupID = $dataOperatorID";
								$resultDisable = $DBVAR->query($queryDisable) or die ($DBVAR->error());
								$sumRecDisable = $DBVAR->num_rows($resultDisable);
								if ($sumRecDisable)
								{  
									$dataGroup = $DBVAR->fetch_object($resultDisable);
									$dataArr['group']['groupShowMenu'] = $dataGroup->groupShowMenu;									
								}
								$showMenu = explode(',',$dataArr['group']['groupShowMenu']);
								
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
											<td align="right"><input type="checkbox" name="showMenu[]" value="<?php echo $dataMenu['menuID']?>" 
											<?php 
											if ((!in_array($dataMenu['menuID'],$showMenu)) OR (!in_array($dataMenu['menuID'],$menu_enable))){ echo 'disabled';$bold="";} else {$bold='style="font-weight:bold;"';} 
											?> <?php for ($s = 0; $s <= count($accessMenu); $s++){if ($accessMenu[$s] == $dataMenu['menuID']){echo 'checked' ;} }?> /></td>
											<td <?php echo $bold;?>><?php echo $dataMenu['menuDesc']?></td>
											<td><input type="hidden" value="<?php echo $dataMenu['menuID']?>" /></td>
											<td><input type="hidden" value="<?php echo $_GET['a']; ?>" name="userID" /></td>
										</tr>
										<?php
										$no++;
									}
									
								}
								
								
							echo "</table>";
						}
						
						case 'r':
						{
							
							?>
							<input type="hidden" name="id_user" value="<?php echo $_GET['a']?>">
							<input type="submit" name="resetUser" value="Reset User">
							<?php
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
										<input type="<?=$buttonTypeLeft; ?>" name="<?=$buttonNameLeft; ?>" value="<?=$buttonNameLeft; ?>"  onclick="<?=$linkButtonLeft;?>" <?=$buttonLeftdisabled ?>>
										<input type='<?=$buttonTypeRight; ?>' name="<?=$buttonNameRight; ?>" value="<?=$buttonNameRight; ?>"  onclick="<?=$linkButtonRight;?>" <?=$buttonRightdisabled ?>>
										
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

