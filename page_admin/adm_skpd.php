<?php

/* Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_skpd.php
 * Created By : Irvan Wibowo & Ovan Cop
 * Date : 2012-08-01
 */
 
defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');

?>
<script type="text/javascript">
	
	function lockParam(id)
	{
		
		if (id == 0)
		{	
			//document.getElementById("tes").checked = true;
			document.getElementById("skpd_id").readOnly = true;
			document.getElementById("unit_id").readOnly = true;
			document.getElementById("nama_daerah").readOnly = true;
			document.getElementById("buat_report").readOnly = false;
		}

		else if (id == 1)
		{
			document.getElementById("skpd_id").readOnly = false;
			document.getElementById("unit_id").readOnly = true;
			document.getElementById("nama_daerah").readOnly = false;
			document.getElementById("buat_report").readOnly = true;
		}

		if (id == 2)
		{
			document.getElementById("skpd_id").readOnly = false;
			document.getElementById("unit_id").readOnly = false;
			document.getElementById("nama_daerah").readOnly = false;
			document.getElementById("buat_report").readOnly = false;
		}
	}

	
</script>

<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
	<td>
		<iframe src="adm_daftar_skpd.php" width="100%" height="390px" frameborder="0">
			<?php /* 
		<table width="100%" align="center" cellpadding="0" cellspacing="5" border="0">
			<tr>
				<td valign="top" class="datalist" align="left" width="35%">
					<div class="datalist_head" align="center" style="font-weight:bold; padding:3px 5px 2px 5px;color: #3A574E;">Daftar SKPD</div>
					<div align="right" style="padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;">
		       		
						<span class="datalist_inactive"><a href="?page=4&a=i" style="color:#3A574E;">Tambah Bidang/SKPD/Unit</a></span>
					</div>
		
				
			        <div class="">
						<div style=" border: 1px solid #dddddd; height: 300px; overflow: auto">
						<!-- parent menu -->
						<?php 
						$query = "SELECT * FROM Satker WHERE NGO IS FALSE 
									AND KodeSektor IS NOT NULL
									AND KodeSatker IS NULL
									AND KodeUnit IS NULL
									ORDER BY KodeSektor ASC";
						$result = mysql_query($query) or die (mysql_error());
						while ($data = mysql_fetch_array($result))
						{
							
							?>
							<div class="<?php if (isset($_GET['pr'])){if (($_GET['pr']==$data['Satker_ID']) and !isset($_GET['sp'])) echo 'datalist_inlist_selected';} ?>">
							<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&a=v"><?php echo "<span style='font-size:12px'>BID $data[KodeSektor] $data[NamaSatker]</span>"; ?></a></div>
							
							<?php 
							
							if (isset($_GET['pr']))
							{
								if ($_GET['pr'] == $data['Satker_ID'])
								{
									
									
									
									$qSubParent = "SELECT * FROM Satker WHERE NGO IS FALSE AND KodeSektor = '".$data['KodeSektor']."' 
													AND KodeSatker IS NOT NULL AND KodeUnit IS NULL ORDER BY KodeSatker ASC";
									
									$rSubParent = mysql_query($qSubParent) or die (mysql_error());
									while ($dataSubParent = mysql_fetch_array($rSubParent))
									{
										?>
										<div class="<?php if (isset($_GET['sp'])){if (($_GET['sp']==$dataSubParent['Satker_ID']) and !isset($_GET['ssp'])) echo 'datalist_inlist_selected';} ?>" >
										<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&a=v">
										<div style="margin-left:15px;">&raquo; <?php echo "<span style='font-size:12px'>$dataSubParent[KodeSatker]-$dataSubParent[NamaSatker]</span>";?></div>
										</a>
										</div>
										<?php 
										if (isset($_GET['sp']))
										{
											if ($_GET['sp'] == $dataSubParent['Satker_ID'])
											{
												
												
														
												$qSubSubParent = "SELECT *
															FROM Satker
															WHERE NGO IS FALSE
															AND KodeSektor = '".$dataSubParent['KodeSektor']."'
															AND KodeSatker = '".$dataSubParent['KodeSatker']."'
															AND KodeUnit IS NOT NULL
															ORDER BY KodeUnit ASC";
												$rSubSubParent = mysql_query($qSubSubParent) or die (mysql_error());
												if (mysql_num_rows($rSubSubParent)){
													while ($dataSubSubParent = mysql_fetch_array($rSubSubParent))
													{
														
														?>
														<div class="<?php if (isset($_GET['ssp'])){if ($_GET['ssp']==$dataSubSubParent['Satker_ID']) echo 'datalist_inlist_selected';} ?>">
															<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&ssp=<?php echo $dataSubSubParent['Satker_ID']?>&a=v">
																<div style="margin-left:30px;">&raquo; <?php echo "<span style='font-size:12px;'>$dataSubSubParent[KodeSatker].$dataSubSubParent[KodeUnit]-$dataSubSubParent[NamaSatker]</span>"?></div>
															</a>
														</div>
														
														<?php 
														if (isset($_GET['ssp']))
														{
															if ($_GET['ssp'] == $dataSubSubParent['Satker_ID'])
															{
																$sql = "SELECT * FROM Satker WHERE Satker_ID =".$dataSubSubParent['Satker_ID'];
																$res = mysql_query($sql) or die (msyql_error());
	
																$dataSSP = mysql_fetch_array($res);
																
																$KodeSektor = $data['KodeSektor'];
																$KodeSatker = $dataSubParent['KodeSatker'];
																$KodeUnit = $dataSSP['KodeUnit'];
																$NamaSatker = $dataSSP['NamaSatker'];
																$KotaSatker = $dataSSP['KotaSatker'];
																$Gudang = $dataSSP['Gudang'];
																$BuatKIB = $dataSSP['BuatKIB'];
															}
														}
														else
														{
															$KodeSektor = $data['KodeSektor'];
															$KodeSatker = $dataSubParent['KodeSatker'];
															$KotaSatker = $dataSubParent['KotaSatker'];
															$NamaSatker = $dataSubParent['NamaSatker'];
															$Gudang = $dataSubParent['Gudang'];
														}
														
														
														
													}
												}
												else
												{
													$KodeSektor = $data['KodeSektor'];
													$KodeSatker = $dataSubParent['KodeSatker'];
													$KotaSatker = $dataSubParent['KotaSatker'];
													$NamaSatker = $dataSubParent['NamaSatker'];
													$Gudang = $dataSubParent['Gudang'];
												}
												
												
												
											}
										}
										else
										{
											$NamaSatker = $data['NamaSatker'];
											$KodeSektor = $data['KodeSektor'];
											$Gudang = $data['Gudang'];
											$BuatKIB = $data['BuatKIB'];
										}
										
									}
									
								}
							}
							
						}
						
						?>
						
						
					</div>
						<?php //include 'js_dropdown_skpd.php'; ?>
			        
			        </div>
		    	</td>
			    <td valign="top" align="left" style="padding:0px;">
			
			     	<span class="data_tab" style="color:#3A574E;font-weight:bold;">Detail Bidang/SKPD/Unit</span>       
			
			    	<!--<span class="data_tab"><a href="?page=4&a=i">Hak Akses</a></span>-->
			      
				    <div class="datalist" id="iddatalist_entry">
						<form name="form_data_level" method="POST" style="margin:10px;" action="">
							<?php
							if (isset($_GET['a']))
							{
								if ($_GET['a']=='i')
								{
									$KodeSektorDisabled = '';
									$KodeSatkerDisabled = '';
									$KodeUnitDisabled = '';
									$NamaSatkerDisabled = '';
									$KotaSatkerDisabled = '';
									$GudangDisabled = '';
									$BuatKIBDisabled = '';
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
								
								else if ($_GET['a']=='e')
								{
									
									
									//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
									$buttonNameLeft = 'Update';
									$buttonNameRight = 'Batal';
									if (isset($_GET['pr']))
										{ 
											if (isset($_GET['sp']))
											{ 
												if (isset($_GET['ssp']))
												{ 
													$KodeSektorDisabled = '';
													$KodeSatkerDisabled = '';
													$KodeUnitDisabled = '';
													$NamaSatkerDisabled = '';
													$KotaSatkerDisabled = '';
													//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&ssp=$_GET[ssp]&a=e'";	
												}else{ 
													$KodeSektorDisabled = '';
													$KodeSatkerDisabled = '';
													$KodeUnitDisabled = 'disabled';
													$NamaSatkerDisabled = '';
													$KotaSatkerDisabled = '';
													//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&a=e'";
												}
												
												
											}else{
												$KodeSektorDisabled = '';
												$KodeSatkerDisabled = 'disabled';
												$KodeUnitDisabled = 'disabled';
												$NamaSatkerDisabled = '';
												$KotaSatkerDisabled = 'disabled';
												//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";
											}
											
											
										}
										else
										{
											
											$KodeSektorDisabled = 'disabled';
											$KodeSatkerDisabled = 'disabled';
											$KodeUnitDisabled = 'disabled';
											$NamaSatkerDisabled = 'disabled';
											$KotaSatkerDisabled = 'disabled';
											$linkButtonLeft = "";	
										}
									//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
									$linkButtonLeft = "";
									$linkButtonRight = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=v'";
									$buttonLeftdisabled = '';
									$buttonRightdisabled = '';
									$buttonTypeLeft = 'submit';
									$buttonTypeRight = 'button';
								}
								else
								{
									
									//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
									$buttonNameLeft = 'Edit';
									$buttonNameRight = 'Hapus';
									
									//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
									if (isset($_GET['pr']))
											{ 
												if (isset($_GET['sp']))
												{ 
													if (isset($_GET['ssp']))
													{ 
														
														$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&ssp=$_GET[ssp]&a=e'";	
													}else{ 
														
														$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&a=e'";
													}
													
													
												}else{
													
													$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";
												}
												
												
											}
											else
											{
												
												
												$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";	
											}
									
									$KodeSektorDisabled = 'disabled';
									$KodeSatkerDisabled = 'disabled';
									$KodeUnitDisabled = 'disabled';
									$NamaSatkerDisabled = 'disabled';
									$KotaSatkerDisabled = 'disabled';
									$GudangDisabled = 'disabled';
									$BuatKIBDisabled = 'disabled';
									//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";
									$linkButtonRight = '';
									$buttonLeftdisabled = '';
									$buttonRightdisabled = '';
									$buttonTypeLeft = 'button';
									$buttonTypeRight = 'submit';
								}
							}
							else
							{
								
								$KodeSektorDisabled = 'disabled';
								$KodeSatkerDisabled = 'disabled';
								$KodeUnitDisabled = 'disabled';
								$NamaSatkerDisabled = 'disabled';
								$KotaSatkerDisabled = 'disabled';
								$GudangDisabled = 'disabled';
								$BuatKIBDisabled = 'disabled';
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
										
							if (isset($_GET['a']))
							{
								$_GET['a']=='i' ? $display = '' : $display = 'none';
								//$check = 'checked';
								//echo "<script type='text/javascript'>document.getElementById('tes').checked=true;</script>";
								
							}
							else
							{
								$display = 'none';
								//$check = '';
							}		
							?> 
							<div id="list_options" style="display:<?php echo $display; ?>">
								<label><input type="radio" name="opt_list" value="opt_bidang" onclick="lockParam(0)"/>Bidang</label>
								<label><input type="radio" name="opt_list" value="opt_skpd" onclick="lockParam(1)"/>SKPD</label>
								<label><input type="radio" name="opt_list" value="opt_unit" onclick="lockParam(2)"/>Unit</label> 
							</div>
							Bidang ID <br><input type='text' name="KodeSektor" id='bidang_id' value="<?php echo $KodeSektor ?>" size='50' <?=$KodeSektorDisabled?> required="required" /><br> 
							SKPD ID<br> <input type= 'text' name="KodeSatker" id='skpd_id' value="<?php echo $KodeSatker;?>" <?=$KodeSatkerDisabled?> required="required"><br> 
							Unit ID<br> <input type='text' name="KodeUnit" id= 'unit_id' value="<?php echo $KodeUnit ; ?>" <?=$KodeUnitDisabled?> required="required" ><br> 
							Nama Bidang/SKPD/Unit<br> 
							<input type='text' name='NamaSatker' value="<?php echo $NamaSatker; ?>" id="nama_bidang" size="50" <?=$NamaSatkerDisabled?> required="required"><br> 
							Nama Daerah SKPD/Unit Berada <br> <input type='text' id="nama_daerah" name='KotaSatker' value="<?php echo $KotaSatker; ?>" <?=$KotaSatkerDisabled?> ><br> 
							<label><input type='checkbox' name='Gudang' value='1' <?php echo $GudangDisabled.' '; if ($gudang > 0) echo 'checked'; ?>/> Gudang ?</label>
							<br> 
							<label><input type= 'checkbox' name='BuatKIB' value='1' <?php echo $BuatKIBDisabled; ?> id="buat_report"/> Buat Report Tersendiri ?</label>
							<div align='right'>
								<input type="hidden" name="pr" value="<?=$_GET['pr']?>"/>
								<input type="hidden" name="sp" value="<?=$_GET['sp']?>"/>
								<input type="hidden" name="ssp" value="<?=$_GET['ssp']?>"/>
								<input type="<?=$buttonTypeLeft?>" name="<?=$buttonNameLeft?>" value="<?=$buttonNameLeft?>" onclick="<?=$linkButtonLeft?>" <?=$buttonLeftdisabled?>>
								<input type='<?=$buttonTypeRight?>' name="<?=$buttonNameRight?>" value="<?=$buttonNameRight?>" onclick="<?=$linkButtonRight?>" <?=$buttonRightdisabled?>>
												
							</div>
									
				        </form>
				       
				    </div>
			
			    </td>
			</tr>
		</table>
		<?php */ ?>
		</iframe>
	</td>
</table>
