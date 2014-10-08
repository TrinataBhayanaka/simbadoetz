<?php
        
    include "../../config/config.php";

    
        $menu_id = 38;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $paging = $LOAD_DATA->paging($_GET['pid']);
        
        
        ?>   

<html>
    <?php
        include "$path/header.php";
    ?>
    <body>
        <div id="content">
            <?php
                include "$path/title.php";
                include "$path/menu.php";
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Daftar Usulan Penghapusan Barang
                        </div>
						<script type="text/javascript" charset="utf-8">
								$(document).ready(function() {
									$('#example').dataTable( {
										"aaSorting": []
									} );
								} );
							</script>
                        <div id="bottomright">
							<?php 
								unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
								$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
								$data = $RETRIEVE->retrieve_daftar_usulan_penghapusan($parameter);
								// pr($data);
								$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'HPS'";
								$result  = mysql_query($query) or die (mysql_error());
								while ($dataNew = mysql_fetch_object($result))
								{
									$dataArr[] = $dataNew->Usulan_ID;
								}
							?>
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>daftar_usulan_penghapusan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>daftar_usulan_penghapusan_lanjut.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
							<table border=0 cellspacing="0" width="100%" style="padding:0px; margin-top:0px; border: 0px solid #; border-width: 0px 0px 0px 0px; clear:both;">	
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>	
									<td align="right"><input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
									<input type="hidden" class="hiddenrecord" value="<?php echo @$data[count]?>">
										<input type="button" value="<< Prev" class="buttonprev"/>
											Page
									<input type="button" value="Next >>" class="buttonnext"/></td>	
								</tr>
							</table>
							<br>
                            <div id="demo">
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
									<thead>
										<tr>
											<th width="15px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
											<th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor Usulan</th>
											<th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl Usulan</th>
											<th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
										</tr>
									</thead>
									<tbody>		
                                    <?php
                                        
										// pr($dataArr);
										$no=1;	
										foreach($data['dataArr'] as $key => $hsl_data){
											
											if($dataArr!="")
												{
													(in_array($hsl_data['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
												}
                                    ?>
                                    <tr>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$no";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[Usulan_ID]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;">
                                            <!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_usulan_aset_yang_akan_dihapuskan.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" target="_blank">Cetak</a> || -->
											<?php
											if($dataArr){
												if($_SESSION['ses_uaksesadmin'] == 1){
													
													if(in_array($hsl_data['Usulan_ID'], $dataArr)){
														echo "&nbsp;";
													}else{
													?>
														<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
											
													<?php
													}
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
													if(in_array($hsl_data['Pemanfaatan_ID'], $dataArr)){
														echo "&nbsp;";	
													}else{
													?>	
														<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
													<?php
													}
												}
											}else{
												if($_SESSION['ses_uaksesadmin'] == 1){
												// echo "masukkkkkk";
												?>
													<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
												<?php	
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
												?>
													<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
											
												<?php
												}else{
												echo "&nbsp;";
												}
											}				
											?>
										</td>
                                    </tr>
                                    <?php $no++; }?>
                                </tbody>
							   <tfoot></tfoot>
                               </div>
							</table>	
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
