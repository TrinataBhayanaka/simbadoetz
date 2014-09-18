<?php
// print_r($_POST['tampil2']);
ob_start();
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        $menu_id = 30;
        $SessionUser = $SESSION->get_session_user();
		// pr($SessionUser);
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        // pr($SESSION);
		$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        // pr($USERAUTH);
        $paging = $LOAD_DATA->paging($_GET['pid']);    
        $ses_uid = $_SESSION['ses_uid'];
		// pr($_SESSION);
		if ($_POST['tampil2']){
            if ($_POST['penggu_penet_filt_add_nmaset'] =="" && $_POST['penggu_penet_filt_add_nokontrak']=="" && $_POST['skpd_id']==""){
		  ?>
        <script>var r=confirm('Tidak ada isian filter');
            if (r==false){
            document.location='penggunaan_penetapan_filter2.php';
            }
        </script>
		<?php
            }
        }
        
        if (isset($_POST['tampil2'])){				
			unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging,'ses_uid'=>$ses_uid);
			// pr($parameter);
			list($data,$dataAsetUser) = $RETRIEVE->retrieve_penetapan_penggunaan($parameter);
			// echo 'sini';
		}
		else {
			$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging,'ses_uid'=>$ses_uid);
			list($data,$dataAsetUser) = $RETRIEVE->retrieve_penetapan_penggunaan($parameter);
			// echo'sana';
		}  
         ?>   
        
  
		<script language="Javascript" type="text/javascript">  
			$(document).ready(function() {
			$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
				
				var tes=document.getElementsByTagName('*');
				var button=document.getElementById('submit');
				var boxeschecked=0;
				for(k=0;k<tes.length;k++)
				{
					if(tes[k].className=='checkbox')
						{
							//
							tes[k].checked == true  ? boxeschecked++: null;
						}
				}
			//alert(boxeschecked);
				if(boxeschecked!=0){
					button.disabled=false;
				}
				else {
					button.disabled=true;
				}
			
			} );
			
			function enable(){  
			var tes=document.getElementsByTagName('*');
			var button=document.getElementById('submit');
			var boxeschecked=0;
			for(k=0;k<tes.length;k++)
			{
				if(tes[k].className=='checkbox')
					{
						//
						tes[k].checked == true  ? boxeschecked++: null;
					}
			}
			//alert(boxeschecked);
			if(boxeschecked!=0)
				button.disabled=false;
			else
				button.disabled=true;
			}
			function disable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				if (disable){
					button.disabled=true;
				} 
			}
			function enable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				if (enable){
					button.disabled=false;
				} 
			}
		</script>
                   
		
		<?php
		// pr($_SESSION['parameter_sql_total']);
		
		?>
       
<html>
        <body onload="enable()">
                        
	<div id="content">
                    <?php
                        
                        include "$path/menu.php";
                    ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Penetapan Penggunaan
                        </div>
                        <div id="bottomright">
                            <table width="100%" height="4%" border="1" style="border-collapse:collapse;">
								<tr>
									<th colspan="2" align="left" style="font-weight:bold;">Filter data : <?php echo $_SESSION['parameter_sql_total']?> Record</u></th>
								</tr>
							</table>
							<br>
							<div align="right">
								<input type="button"
											value="Kembali ke halaman utama : Cari Aset"
											onclick="document.location='penggunaan_penetapan_filter2.php'"
											title="Kembali ke halaman utama : Cari Aset">
								
							</div>
							<div>
								<br>
							</div>
                            <?php
								$offset = @$_POST['record'];
								$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Penggunaan[]'";
										$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
										$data_apl = $DBVAR->fetch_object($result_apl);
										
										$array = explode(',',$data_apl->aset_list);
										
									foreach ($array as $id)
									{
										if ($id !='')
										{
										$dataAsetList[] = $id;
										}
									}
									
									if ($dataAsetList !='')
									{
										$explode = array_unique($dataAsetList);
									}
									
								?>
								
                            
                            <form name="myform" method="POST" action="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_eksekusi_data.php">
							<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
								<tr>

									<td colspan ="3" align="right">
										<table border="0" width="100%">
											<tr>
												<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
												<td  align="left"><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
												<td align="right">
														<input type="submit" name="submit2" value="Penetapan Penggunaan" id="submit" disabled/>
												</td>
												<td align="right" width="200px">
														<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
														<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
														<span><input type="button" value="<< Prev" class="buttonprev"/>
														Page
														<input type="button" value="Next >>" class="buttonnext"/></span>
												</td>
											</tr>
										</table>

									</td>
								</tr>
							</table>
                                    <div id="demo">
									<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
										<thead>
											<tr>
												<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width='20px'>No</th>
												<th style="background-color: #eeeeee; border: 1px solid #dddddd;">&nbsp;</th>
												<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
											</tr>
										</thead>
                                        <?php

                                          if (!empty($data))
											{
											?>
												
											<tbody>
												<?php
												$no = 1;
												$page = @$_GET['pid'];
												if ($page > 1){
													$no = intval($page - 1 .'01');
												}else{
													$no = 1;
												}
												// pr($data);
												foreach ($data as $key => $value)
												{
												?>

                                    <tr>

                                        <td align="center" style="border: 1px solid #dddddd; height:100px; color: black; font-weight: bold;" width="5%"><?php echo "$no.";?></td>
                                        <td align="center" style="border: 1px solid #dddddd; height:100px; color: black; font-weight: bold;" width="5%">
											<!--<input type="checkbox"   class="checkbox" onchange="enable()" name="Penggunaan[]" value="<?php echo $value->Aset_ID;?>" <?php //for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>/>
											-->
											<?php
												// pr($_SESSION['ses_uaksesadmin']);
											if (($_SESSION['ses_uaksesadmin'] == 1)){
												// echo "masukk";
												?>
												<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Penggunaan[]" value="<?php echo $value->Aset_ID;?>" 
												<?php 
													for ($i = 0; $i <= count($explode); $i++){
														if ($explode[$i]==$value->Aset_ID) 
															echo 'checked';
													}?>>
												<?php
											}else{
												if ($dataAsetUser){
												if (in_array($value->Aset_ID, $dataAsetUser)){
												?>
												<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Penggunaan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
												<?php
												}
											}
											}
											
											?>
                                        </td>
                                        <td align="left" style="border: 1px solid #dddddd; height:100px; color: black; font-weight: bold;">
                                           <table width='100%'>
												<tr>
													<td height="10px"></td>
												</tr>

												<tr>
													<td>
														<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
														<span>( Aset ID - System Number )</span>
													</td>
													<!--
													<td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
														
														 <a href='validasi_data_aset.php?id=<?php //echo $value->Aset_ID?>'>Validasi</a></span>
													</td>-->
												</tr>
												<tr>
													<td style="font-weight:bold;"><?php echo $value->NomorReg?></td>
												</tr>
												<tr>
													<td style="font-weight:bold;"><?php echo $value->Kode?></td>
												</tr>
												<tr>
													<td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
												</tr>

											</table>
											<br>
											<hr />
											<table border=0 width="100%">
												<tr>
													<td width="20%">No.Kontrak</td> 
													<td width="2%">&nbsp;</td>
													<td width="78%">&nbsp;<?php echo $value->NoKontrak?></td>
												</tr>
												
												<tr>
													<td>Satker</td> 
													<td>&nbsp;</td>
													<td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
												</tr>
												<tr>
													<td>Lokasi</td> 
													<td>&nbsp;</td>
													<td><?php echo $value->NamaLokasi?></td>
												</tr>
												<tr>
													<td>Status</td> 
													<td>&nbsp;</td>
													<td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
												</tr>

											</table>
                                        </td>
                                    </tr>
                                    <?php 
										$no++; 
										//$pid++; 
										} 
									}
									 else
									{
										$disabled = 'disabled';
									}
									?>
                                   <tfoot>
										<tr>
											<th style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
											<th style="background-color: #eeeeee; border: 1px solid #dddddd;">&nbsp;</th>
											<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
											
										</tr>
									</tfoot>
                                </tbody>
                            </table>
                                
                            </form>
                            </div>
						<div class="spacer"></div>
						<!-- End Frame -->
                                
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	


