<?php
        
    include "../../config/config.php";
    
        $menu_id = 46;
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
	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
        <div id="content">
            <?php
                include "$path/title.php";
                include "$path/menu.php";
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Daftar Usulan Pemusnahan Barang
                        </div>
                        <div id="bottomright">
                            
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_lanjut.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
							
							<!-- Begin frame -->
														<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
															<tr>
																<td colspan ="3" align="right">
																	<table border="0" width="100%">
																		<tr>
																			<td align="right">
																					<span><input type="submit" name="submit" value="Usul Pemusnahan" id="submit" disabled/></span>
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
                                        <th style="background-color: #eeeeee; border: 2px solid #dddddd;" width='20px'>No</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Nomor Usulan</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Tgl Usulan</th>
                                        <th width="40px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Tindakan</th>
                                    </tr>
								</thead>
								<tbody>
                                    <?php
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                            $data = $RETRIEVE->retrieve_daftar_usulan_pemusnahan($parameter);

                                            //print_r($data['dataArr']);
												$nomor = 1;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;    
                                    
                                    /*
                                            $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='MSN' limit 10";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                        
                                        
                                        $i=1;
                                        while($hsl_data=mysql_fetch_array($exec2)){
                                     * 
                                     */
                                     
                                     //sementara
											$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'MSN'";
											$result  = mysql_query($query) or die (mysql_error());
											while ($dataNew = mysql_fetch_object($result))
											{
												$dataArr[] = $dataNew->Usulan_ID;
											}
											
                                    foreach($data['dataArr'] as $key => $hsl_data){
										
										if($dataArr!="")
												{
													(in_array($hsl_data['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
												}
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 2px solid #dddddd;"><?php echo "$nomor";?></td>
                                        <td align="center" style="border: 2px solid #dddddd;"><?php echo "$hsl_data[Usulan_ID]";?></td>
                                        <td align="center" style="border: 2px solid #dddddd;"><?php $change=$hsl_data['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 2px solid #dddddd;">
                                            <a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_untuk_dimusnahkan.php?id=$hsl_data[Usulan_ID]&menu_id=46&mode=1";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>pemusnahan_usulan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="<?=$disable?> ">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $nomor++;}}?>
                                </tbody>
                            </table>
								</div>
								<div class="spacer"></div>
					<!-- End Frame -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                include"$path/footer.php";
           ?>
    </body>
</html>	
