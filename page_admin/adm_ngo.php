<?php

/* Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_ngo.php
 * Created By : Irvan Wibowo & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');

$shufle = str_shuffle('bhsyd18743');
if (isset($_POST['Simpan']))
{
	
	($_POST['NamaSatker'] == '') ? $NamaSatker = 'NULL' : $NamaSatker = "'".$_POST['NamaSatker']."'";
	($_POST['KodeSatker'] == '') ? $KodeSatker = 'NULL' : $KodeSatker = $_POST['KodeSatker'];
	($_POST['KodeSektor'] == '') ? $KodeSektor = 'NULL' : $KodeSektor = "'".$_POST['KodeSektor']."'";
	
	if ($_POST['opt_list'] == 'opt_bidang')
	{
		$query = "INSERT INTO Satker VALUES (NULL, NULL, ".$KodeSektor.", NULL, ".$NamaSatker.", NULL,
				1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0)";
		$result = $DBVAR->query($query) or die ($DBVAR->error());
		if ($result > 0) echo '<script type=text/javascript>alert("Sukses");</script>' ;else echo '<script type=text/javascript>alert("Gagal");</script>';
	}

	if ($_POST['opt_list'] == 'opt_skpd')
	{

		$query = "SELECT KodeSektor FROM Satker WHERE KodeSektor = '$_POST[KodeSektor]'";
		$result = $DBVAR->query($query) or die ($DBVAR->error());
		
		if ($DBVAR->num_rows($result))
		{
			$data = $DBVAR->fetch_object($result);
			$dataSatker = "'".$data->KodeSektor.'.'.$KodeSatker."'";
			$query1 = "INSERT INTO Satker VALUES (NULL, NULL, '$data->KodeSektor', ".$dataSatker.", ".$NamaSatker.", NULL,
					1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0)";
			$result1 = $DBVAR->query($query1) or die ($DBVAR->error());
			if ($result > 0 AND $result1 > 0) echo '<script type=text/javascript>alert("Sukses");</script>' ;else echo '<script type=text/javascript>alert("Gagal");</script>';
			
		}
		else
		{
			echo '<script type=text/javascript>alert("Silahkan Mengisi Form Bidang terlebih dahulu");</script>';
		}
		
	}

}

if (isset($_POST['Hapus']))
{

	if ($_POST['pr']!=='')
	{
		if ($_POST['sp']!=='')
		{
			$Satker_ID = $_POST['sp'];
				
		}
		else
		{
			$Satker_ID = $_POST['pr'];
				
		}
	}
	$query = "DELETE FROM Satker WHERE Satker_ID =".$Satker_ID;
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
	($_POST['NamaSatker'] == '') ? $NamaSatker = 'NULL' : $NamaSatker = "'".$_POST['NamaSatker']."'";
	($_POST['KodeSatker'] == '') ? $KodeSatker = 'NULL' : $KodeSatker = "'".$_POST['KodeSatker']."'";
	($_POST['KodeSektor'] == '') ? $KodeSektor = 'NULL' : $KodeSektor = "'".$_POST['KodeSektor']."'";

	if ($_POST['pr']!=='')
	{
		if ($_POST['sp']!=='')
		{
			$Satker_ID = $_POST['sp'];
			$query = "UPDATE Satker SET
							KodeSektor =".$KodeSektor.", KodeSatker =".$KodeSatker.",
							NamaSatker =".$NamaSatker."
							WHERE Satker_ID =".$Satker_ID;
				
		}
		else
		{
			$Satker_ID = $_POST['pr'];
			$query = "UPDATE Satker SET
							KodeSektor =".$KodeSektor.",
							NamaSatker =".$NamaSatker."
							WHERE Satker_ID =".$Satker_ID;
				
		}
	}
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



?>
<script type="text/javascript">
	
	function lockParam(id)
	{
		
		if (id == 0)
		{	
			
			document.getElementById("sub_ngo_id").readOnly = true;
			
		}

		else if (id == 1)
		{
			document.getElementById("sub_ngo_id").readOnly = false;
			
		}

		
	}

	
</script>

<table align="center" width="100%" border="0" cellpadding="0"
	cellspacing="5"
	style="margin-top: 10px; border: 1px solid #c0c0c0; background-color: white; ">
	<td >
		<iframe src="adm_daftar_ngo.php" width="100%" height="300px" frameborder="0" ></iframe>
		<?php  /*
	<table width="100%" align="center" cellpadding="0" cellspacing="5"
		border="0">
		<tr>
			<td valign="top" class="datalist" align="left" width="40%">
			<div class="datalist_head" align="center"
				style="font-weight: bold; padding: 3px 5px 2px 5px; color: #3A574E;">Daftar
			NGO</div>
			<div align="right"
				style="padding-left: 5px; padding-right: 5px; margin-bottom: 5px; margin-top: 5px;">
			<span class="datalist_inactive"> <a href="?page=5&a=i"
				style="color: #3A574E;">Tambah NGO / Sub NGO</a> </span></div>
			<div class="">
			<div style="border: 1px solid #dddddd; height: 200px; overflow: auto">
				<!-- parent menu -->
			<?php 
			$query = "SELECT * FROM Satker
                      WHERE  NGO IS TRUE
                      AND KodeSektor IS NOT NULL
                      AND KodeSatker IS NULL
                      ORDER BY KodeSektor ASC";

			$result = $DBVAR->query($query) or die ($DBVAR->error());
			while ($data = $DBVAR->fetch_array($result))
			{

				?>

				<div
					class="<?php if (isset($_GET['pr'])){if ($_GET['pr']==$data['Satker_ID']) echo 'datalist_inlist_selected';} ?>">
				<a class="datalist_inlist"
					href="?page=5&pr=<?php echo $data['Satker_ID']?>&a=v">BID <?php echo $data['KodeSektor'].' '. $data['NamaSatker']; ?></a>
				</div>
	
				<?php
				if (isset($_GET['pr']))
				{
					if ($_GET['pr'] == $data['Satker_ID'])
					{
						$NGOID = $data['KodeSektor'];
						//$subNGOID = $data['KodeSatker'];
						$NGOName = $data['NamaSatker'];
						$qSubParent = "SELECT * FROM Satker WHERE NGO IS TRUE AND KodeSektor = '".$data['KodeSektor']."'
	                                  AND KodeSatker IS NOT NULL
	                                  ORDER BY KodeSatker ASC";
						$rSubParent = $DBVAR->query($qSubParent) or die ($DBVAR->error());
						while ($dataSubParent = $DBVAR->fetch_array($rSubParent))
						{
							?>
	
							<div
								class="<?php if (isset($_GET['sp'])){if ($_GET['sp']==$dataSubParent['Satker_ID']) echo 'datalist_inlist_selected';} ?>">
							<a class="datalist_inlist"
								href="?page=5&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&a=v">
							<div style="margin-left: 15px; padding-left: 14px;">&raquo; <?php echo $dataSubParent['KodeSatker'].'-'.$dataSubParent['NamaSatker']?></div>
							</a>
							</div>
	
				<?php
								if (isset($_GET['sp']))
								{
									if ($_GET['sp'] == $dataSubParent['Satker_ID'])
									{
										$NGOID = $dataSubParent['KodeSektor'];
										$subNGOID = $dataSubParent['KodeSatker'];
										//$NGOName = $data['NamaSatker'];
										$qSubSubParent = "SELECT * FROM Satker WHERE NGO IS TRUE
					                                      AND KodeSektor = '".$dataSubParent['KodeSektor']."' 
					                                      AND KodeSatker = '".$dataSubParent['KodeSatker']."'
					                                      
					                                      ORDER BY NamaSatker ASC";
					                    
										$rSubSubParent = $DBVAR->query($qSubSubParent) or die ($DBVAR->error());
										while ($dataSubSubParent = $DBVAR->fetch_array($rSubSubParent))
										{
											$NGOID = $dataSubSubParent['KodeSektor'];
											$subNGOID = $dataSubSubParent['KodeSatker'];
											$NGOName = $dataSubSubParent['NamaSatker'];
										}
										
									}
								}
						}
					}
				}
			}
			?></div>

			<?php //include 'js_dropdown_skpd.php'; ?></div>
			</td>
			<td valign="top" align="left" style="padding: 0px;"><span
				class="data_tab" style="color: #3A574E; font-weight: bold;">Detail
			NGO / Sub NGO</span> <!--<span class="data_tab"><a href="?page=4&a=i">Hak Akses</a></span>-->

			<div class="datalist" id="iddatalist_entry">
			<form name="form_data_level" method="POST" style="margin: 10px;"
				action=""><?php
				if (isset($_GET['a']))
				{
					if ($_GET['a']=='i')
					{
						
						$KodeSektor = '';
						$KodeSatker = '';
						$NamaSatker = '';
						$KodeSektorDisabled = '';
						$KodeSatkerDisabled = '';
						$NamaSatkerDisabled = '';
						$buttonLeftDisabled = '';
						$buttonRightDisabled = '';
						$buttonLeftName = 'Simpan';
						$buttonRightName = 'Batal';
						$buttonLeftType = 'submit';
						$buttonRightType = 'button';
						$linkLeftButton = "";
						$linkRightButton = "";
					}
					else if ($_GET['a']=='e')
					{
						$KodeSektor = $NGOID;
						$KodeSatker = $subNGOID;
						$NamaSatker = $NGOName;
						$KodeSektorDisabled = '';
						$KodeSatkerDisabled = '';
						$NamaSatkerDisabled = '';
						$buttonLeftDisabled = '';
						$buttonRightDisabled = '';
						$buttonLeftName = 'Update';
						$buttonRightName = 'Batal';
						$buttonLeftType = 'submit';
						$buttonRightType = 'button';
						$linkLeftButton = "";
						if (isset($_GET['sp']))
						{
							$linkRightButton = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&a=v'";
						} else
						{
							$linkRightButton = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=v'";
						}
					} else
					{
						$KodeSektor = $NGOID;
						$KodeSatker = $subNGOID;
						$NamaSatker = $NGOName;
						$KodeSektorDisabled = 'disabled';
						$KodeSatkerDisabled = 'disabled';
						$NamaSatkerDisabled = 'disabled';
						$buttonLeftDisabled = '';
						$buttonRightDisabled = '';
						$buttonLeftName = 'Edit';
						$buttonRightName = 'Hapus';
						$buttonLeftType = 'button';
						$buttonRightType = 'submit';
						if (isset($_GET['sp']))
						{
							$linkLeftButton = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&a=e'";
						} else
						{
							$linkLeftButton = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";
						}
						$linkRightButton = '';
					}
				} else
				{
					//echo 'luar';
					$KodeSektor = '';
					$KodeSatker = '';
					$NamaSatker = '';
					$KodeSektorDisabled = 'disabled';
					$KodeSatkerDisabled = 'disabled';
					$NamaSatkerDisabled = 'disabled';
					$buttonLeftDisabled = 'disabled';
					$buttonRightDisabled = 'disabled';
					$buttonLeftName = 'Simpan';
					$buttonRightName = 'Batal';
					$buttonLeftType = 'submit';
					$buttonRightType = 'reset';
					$linkLeftButton = '';
					$linkRightButton = '';
					$link = "window.location.href='?page=2&p=d&a=$_GET[a]&e=$shufle'";
				}
				if (isset($_GET['a']))
				{
					$_GET['a']=='i' ? $display = '' : $display = 'none';
					//$check = 'checked';
					//echo "<script type='text/javascript'>document.getElementById('tes').checked=true;</script>";
				} else
				{
					$display = 'none';
					//$check = '';
				}
				?>



			<div id="list_options" style="display:<?php echo $display; ?>"><label><input
				type="radio" name="opt_list" value="opt_bidang"
				onclick="lockParam(0)" />Bidang</label> <label><input type="radio"
				name="opt_list" value="opt_skpd" onclick="lockParam(1)" />SKPD</label>
			</div>
			NGO ID <br>
			<input type='text' name="KodeSektor" id='ngo_id'
				value="<?=$KodeSektor?>" size='50' <?=$KodeSektorDisabled?>
				required="required" /><br>
			Sub NGO ID<br>
			<input type='text' name="KodeSatker" id='sub_ngo_id'
				value="<?=$KodeSatker;?>" <?=$KodeSatkerDisabled ?>
				required="required"><br>
			Nama NGO/Sub NGO<br>
			<input type='text' name="NamaSatker" id='nama_ngo'
				value="<?=$NamaSatker; ?>" <?=$NamaSatkerDisabled?>
				required="required"><br>
			<div align='right'>
				<input type="hidden" name="pr" value="<?=$_GET['pr']?>" /> 
				<input type="hidden" name="sp" value="<?=$_GET['sp']?>" /> 
				<input type="<?=$buttonLeftType?>" name="<?=$buttonLeftName?>" value="<?=$buttonLeftName?>"
				onclick="<?=$linkLeftButton?>" <?=$buttonLeftDisabled?>> 
				<input type='<?=$buttonRightType?>' name="<?=$buttonRightName?>"
				value="<?=$buttonRightName?>" onclick="<?=$linkRightButton?>"
				<?=$buttonRightDisabled?>>
			</div>
			</form>
			</div>
			</td>
		</tr>
	</table>*/?>
	</td>
</table>

