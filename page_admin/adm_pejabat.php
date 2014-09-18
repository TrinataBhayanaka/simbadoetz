<?php

/* class Name : Session
 * Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_pejabat.php
 * Created By : Irvan Wibowo & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');

if (isset($_POST['idbtn']))
{
    
    //echo '<script type=text/javascript>alert("Sukses");</script>';
    //$query = "INSERT INTO Pejabat VALUES (null, )";
    
    $query = "SELECT Pejabat_ID FROM Pejabat WHERE Satker_ID =".$_POST['Satker_ID'];
    $result = $DBVAR->query($query) or die ($DBVAR->error());
    if ($DBVAR->num_rows($result))
    {
        while ($data = $DBVAR->fetch_object($result))
        {
            $valArr[] = $data;
        }
        echo $valArr->Satker_ID;
        for ($i = 0; $i <= 5; $i++) {
        	if ($_POST['idnamapjb'][$i] !=='')
            {
            	$query = "UPDATE Pejabat SET NamaJabatan = '".$_POST['idnamajabatan'][$i]."', 
                          Satker_ID ='".$_POST['Satker_ID']."',NamaPejabat = '".$_POST['idnamapjb'][$i]."', 
                          NIPPejabat = '".$_POST['idnippjb'][$i]."' WHERE Pejabat_ID = ".$valArr[$i]->Pejabat_ID;
                $result = $DBVAR->query($query) or die ($DBVAR->error());
                if ($result)
                {
                        //echo '<script type=text/javascript>alert("Sukses");</script>';
                        
                }
            }
            if ($_POST['idnippjb'][$i] !=='')
            {
             	$query = "UPDATE Pejabat SET NamaJabatan = '".$_POST['idnamajabatan'][$i]."', 
                          Satker_ID ='".$_POST['Satker_ID']."',NamaPejabat = '".$_POST['idnamapjb'][$i]."', 
                          NIPPejabat = '".$_POST['idnippjb'][$i]."' WHERE Satker_ID = ".$valArr[$i]->Pejabat_ID;
                $result = $DBVAR->query($query) or die ($DBVAR->error());
                if ($result)
                {
                                
                                //echo '<script type=text/javascript>alert("Sukses");</script>';
                }
            }
                                
		/*	
		$query = "UPDATE Pejabat SET NamaJabatan = '".$_POST['idnamajabatan'][$i]."', 
					Satker_ID ='".$_POST['Satker_ID']."',NamaPejabat = '".$_POST['idnamapjb'][$i]."', 
					NIPPejabat = '".$_POST['idnippjb'][$i]."' WHERE Satker_ID = ".$_POST['Satker_ID'];
		print_r($query);echo '<br>';
		//$result = $DBVAR->query($query) or die ($DBVAR->error());
		 * 
		 */
     	}
	}
	else
    {
    	for ($i = 0; $i <= 5; $i++) {
        	$query = "INSERT INTO Pejabat VALUES (null, '".$_POST['idnamajabatan'][$i]."',
            		'".$_POST['Satker_ID']."',
            		'".$_POST['idnamapjb'][$i]."',
                    '".$_POST['idnippjb'][$i]."',
                    'NULL')";
            //print_r($query);echo '<br>';
            $result = $DBVAR->query($query) or die ($DBVAR->error());
            if ($result)
            {
            	//echo '<script type=text/javascript>alert("Sukses");</script>';
            }
        }
   	}
}
?>

<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
    <td>
        <form method="post" action=""> 
            <table align="center" width="100%" cellpadding="0" cellspacing="5" border="0">
                
                <!--
                <tr>
                <th class="datalist" align="center" width="50%">Daftar User</td>
                <th class="datalist" align="center" width="50%">Daftar Modul Proses</th></tr>
                -->
                
                <tr>
                    <td class="datalist" valign="top" align="left" width="35%">
                        <div class="datalist_head" align="center" style="font-weight:bold; margin-top:0px; padding:3px 5px 2px 5px;color: #3A574E;">
                            Daftar SKPD
                        </div>
                        <div align="left" style="padding:0px; margin-bottom:5px; margin-top:5px; width:100%;">
						
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
							<div class="<?php if (isset($_GET['pr'])){if ($_GET['pr']==$data['Satker_ID']) echo 'datalist_inlist_selected';} ?>">
							<a class="datalist_inlist" href="?page=6&pr=<?php echo $data['Satker_ID']?>&a=v">BID <?php echo $data['KodeSektor'].' '. $data['NamaSatker']; ?></a></div>
							
							<?php 
							
							if (isset($_GET['pr']))
							{
								if ($_GET['pr'] == $data['Satker_ID'])
								{
									
									$KodeSektor = $data['KodeSektor'];
									$Gudang = $data['Gudang'];
									$BuatKIB = $data['BuatKIB'];
									
									$qSubParent = "SELECT * FROM Satker WHERE NGO IS FALSE AND KodeSektor = '".$data['KodeSektor']."' 
													AND KodeSatker IS NOT NULL AND KodeUnit IS NULL ORDER BY KodeSatker ASC";
									
									$rSubParent = mysql_query($qSubParent) or die (mysql_error());
									while ($dataSubParent = mysql_fetch_array($rSubParent))
									{
										?>
										<div class="<?php if (isset($_GET['sp'])){if ($_GET['sp']==$dataSubParent['Satker_ID']) echo 'datalist_inlist_selected';} ?>" ><a class="datalist_inlist" href="?page=6&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&a=v"><div style="margin-left:15px;">&raquo; <?php echo $dataSubParent['KodeSatker'].'-'.$dataSubParent['NamaSatker']?></div></a></div>
										<?php 
										if (isset($_GET['sp']))
										{
											if ($_GET['sp'] == $dataSubParent['Satker_ID'])
											{
												$KodeSatker = $dataSubParent['KodeSatker'];
												$KotaSatker = $dataSubParent['KotaSatker'];
												$NamaSatker = $data['NamaSatker'];
												$Gudang = $dataSubParent['Gudang'];
												$Gudang = $dataSubParent['Gudang'];
												
												$qSubSubParent = "SELECT *
																	FROM Satker
																	WHERE NGO IS FALSE
																	AND KodeSektor = '".$dataSubParent['KodeSektor']."'
																	AND KodeSatker = '".$dataSubParent['KodeSatker']."'
																	AND KodeUnit IS NOT NULL
																	ORDER BY KodeUnit ASC";
												$rSubSubParent = mysql_query($qSubSubParent) or die (mysql_error());
												while ($dataSubSubParent = mysql_fetch_array($rSubSubParent))
												{
													
													?>
													<div class="<?php if (isset($_GET['ssp'])){if ($_GET['ssp']==$dataSubSubParent['Satker_ID']) echo 'datalist_inlist_selected';} ?>"><a class="datalist_inlist" href="?page=6&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&ssp=<?php echo $dataSubSubParent['Satker_ID']?>&a=v"><div style="margin-left:30px;">&raquo; <?php echo $dataSubSubParent['KodeSatker'].'-'.$dataSubSubParent['NamaSatker']?></div></a></div>
													<?php 
													if (isset($_GET['ssp']))
													{
														if ($_GET['ssp'] == $dataSubSubParent['Satker_ID'])
														{
															$sql = "SELECT * FROM Satker WHERE Satker_ID =".$dataSubSubParent['Satker_ID'];
															$res = mysql_query($sql) or die (msyql_error());

															$dataSSP = mysql_fetch_array($res);
															
															$KodeUnit = $dataSSP['KodeUnit'];
															$NamaSatker = $dataSSP['NamaSatker'];
															$KotaSatker = $dataSSP['KotaSatker'];
															$Gudang = $dataSSP['Gudang'];
															$BuatKIB = $dataSSP['BuatKIB'];
														}
													}
													
												}
											}
										}
									}
								}
							}
							
						}
						
						?>
                                    
      
                        </div>
                    </td>
                    <td class="datalist" valign="top" align="left">
                    	<div class="datalist_head" align="center" style="font-weight:bold; margin-top:0px; padding:3px 5px 2px 5px; color: #3A574E;">
                                Data Pejabat
                        </div>
                            
                        <?php
                        if (isset($_GET['pr']))
						{
                        	if (isset($_GET['sp']))
                            {
								if (isset($_GET['ssp']))
								{
									$query = "SELECT NamaSatker FROM Satker WHERE Satker_ID =".$_GET['ssp'];
									$result = $DBVAR->query($query) or die ($DBVAR->error());
									if ($DBVAR->num_rows($result))
									{
                                	$data = $DBVAR->fetch_object($result);
									}
								}
                                else
                                {
									$query = "SELECT NamaSatker FROM Satker WHERE Satker_ID =".$_GET['sp'];
									$result = $DBVAR->query($query) or die ($DBVAR->error());
									if ($DBVAR->num_rows($result))
								
									{
									$data = $DBVAR->fetch_object($result);
								}	
								}
							} 
                            else
                            {
                            	$query = "SELECT * FROM Satker WHERE Satker_ID =".$_GET['pr'];
                                $result = $DBVAR->query($query) or die ($DBVAR->error());
                                if ($DBVAR->num_rows($result))
                                {
                                	$data = $DBVAR->fetch_object($result);
                                }
                            }
                       	}
                                                      
                        ?>
                            
          
                        <div style="margin:10px;"><?php echo '<b>'.$data->NamaSatker.'</b>'; ?></div>
                            <div align="left" style="width:100%; padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;">
                                <div id="testid">&nbsp;</div>
                                
                                    <?php
                                    if (isset($_GET['pr']))
                                    {
                                    	if (isset($_GET['sp']))
                                    	{
											if (isset($_GET['ssp']))
											{
												$sql = "SELECT * FROM Pejabat WHERE Satker_ID = ".$_GET['ssp'];
											}
											else
											{
												$sql = "SELECT * FROM Pejabat WHERE Satker_ID = ".$_GET['sp'];
                                    		}
                                    		
										}
                                    	else
                                    	{
                                    		 $sql = "SELECT * FROM Pejabat WHERE Satker_ID = ".$_GET['pr'];
                                    	}
                                       
                                        $res = $DBVAR->query($sql) or die ($DBVAR->error());
                                        if ($DBVAR->num_rows($res))
                                    	{
                                            while ($dataObj = $DBVAR->fetch_object($res))
                                        	{
                                                $dat[] = $dataObj;
                                            }
                                             
                                        }
                                    }
                                    
                                    
                                                
                                    ?>
        
        
                                <table height="100%" width="100%" style="padding:10px;">
                                    <tbody>
                                        <tr>
                                            <th align="center" width="150" style="color: #3A574E;">Jabatan</th>
                                            <th align="center" width="*" style="color: #3A574E;">Nama Pejabat</th>
                                            <th align="center" width="50" style="color: #3A574E;">NIP</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><hr size="1"></td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <input type="hidden" value="Kepala Daerah" id="idnamajabatan_0" name="idnamajabatan[0]">Kepala Daerah</td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnamapjb_0" name="xidnamapjb[0]" style="width:90%;">
                                                <input type="text"  value="<?=$dat[0]->NamaPejabat; ?>" id="idnamapjb_0" name="idnamapjb[0]" style="width:90%;" required="required">
                                            </td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnippjb_0" name="xidnippjb[0]">
                                                <input type="text" value="<?=$dat[0]->NIPPejabat; ?>" id="idnippjb_0" name="idnippjb[0]" required="required">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <input type="hidden" value="Pengelola BMD" id="idnamajabatan_1" name="idnamajabatan[1]">Pengelola BMD</td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnamapjb_1" name="xidnamapjb[1]" style="width:90%;">
                                                <input type="text" value="<?=$dat[1]->NamaPejabat; ?>" id="idnamapjb_1" name="idnamapjb[1]" style="width:90%;" required="required">
                                            </td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnippjb_1" name="xidnippjb[1]">
                                                <input type="text" value="<?=$dat[1]->NIPPejabat; ?>" id="idnippjb_1" name="idnippjb[1]" required="required">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <input type="hidden" value="Pengguna Barang" id="idnamajabatan_2" name="idnamajabatan[2]">Pengguna Barang</td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnamapjb_2" name="xidnamapjb[2]" style="width:90%;">
                                                <input type="text" value="<?=$dat[2]->NamaPejabat; ?>" id="idnamapjb_2" name="idnamapjb[2]" style="width:90%;" required="required">
                                            </td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnippjb_2" name="xidnippjb[2]">
                                                <input type="text" value="<?=$dat[2]->NIPPejabat; ?>" id="idnippjb_2" name="idnippjb[2]" required="required">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <input type="hidden" value="Pengurus Barang" id="idnamajabatan_3" name="idnamajabatan[3]">Pengurus Barang</td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnamapjb_3" name="xidnamapjb[3]" style="width:90%;">
                                                <input type="text" value="<?=$dat[3]->NamaPejabat; ?>" id="idnamapjb_3" name="idnamapjb[3]" style="width:90%;" required="required">
                                            </td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnippjb_3" name="xidnippjb[3]">
                                                <input type="text" value="<?=$dat[3]->NIPPejabat; ?>" id="idnippjb_3" name="idnippjb[3]" required="required">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <input type="hidden" value="Atasan Langsung" id="idnamajabatan_4" name="idnamajabatan[4]">Atasan Langsung</td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnamapjb_4" name="xidnamapjb[4]" style="width:90%;">
                                                <input type="text" value="<?=$dat[4]->NamaPejabat; ?>" id="idnamapjb_4" name="idnamapjb[4]" style="width:90%;" required="required">
                                            </td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnippjb_4" name="xidnippjb[4]">
                                                <input type="text" value="<?=$dat[4]->NIPPejabat; ?>" id="idnippjb_4" name="idnippjb[4]" required="required">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <input type="hidden" value="Penyimpan Barang" id="idnamajabatan_5" name="idnamajabatan[5]">Penyimpan Barang</td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnamapjb_5" name="xidnamapjb[5]" style="width:90%;">
                                                <input type="text" value="<?=$dat[5]->NamaPejabat; ?>" id="idnamapjb_5" name="idnamapjb[5]" style="width:90%;" required="required">
                                            </td>
                                            <td align="left">
                                                <input type="hidden" value="" id="xidnippjb_5" name="xidnippjb[5]">
                                                <input type="text" value="<?=$dat[5]->NIPPejabat; ?>" id="idnippjb_5" name="idnippjb[5]" required="required">
                                            </td>
                                        </tr>      
                                        <tr>
                                            <td colspan="3"><hr size="1"></td>
                                        </tr>
                                        <tr>
                                            <td align="right" colspan="3">

                                                <!--
                                                <input type="submit" name="idbtn" id="idbtn_save" value="Simpan" "disabled"                 onclick="javascript: return confirm('Simpan data ini?');">
                								-->

                                                <input type="hidden" name="Satker_ID" value="<?php if (isset($_GET['ssp'])) echo $_GET['ssp']; else if (isset($_GET['sp'])) echo $_GET['sp']; else echo $_GET['pr']; ?>"/>
                                                <input type="submit" onclick="javascript: return confirm('Simpan data ini?');" "disabled"="" value="Simpan" id="idbtn_save" name="idbtn">
                                                <input type="reset" onclick="ResetData();" "disabled"="" value="Batal" id="idbtn_cancel" name="idbtn">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                                <!--<iframe name="iftrg" id="iftrg" src="./adm_pjb_skpdpgw.php"
                                style="border:0px; height: 290px; width:98%;"></iframe>-->

                            </div>
                        </td>
                </tr>
            </table>
        </form> 
    </td>
</table>

