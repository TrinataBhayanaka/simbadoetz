<?php
        
    include "../../config/config.php";

        
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
                            Daftar Validasi Barang Pemanfaatan
                        </div>
                        <script type="text/javascript" charset="utf-8">
							$(document).ready(function() {
								$('#example').dataTable( {
									"aaSorting": []
								} );
							} );
						</script>
                        <div id="bottomright">
							<div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                           <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php?"><input type="submit" value="Tambah Data"></a>
                            </div>
                            <?php
							$query2="SELECT * FROM Pemanfaatan where FixPemanfaatan=1 and Status=1";
							$exec2 = mysql_query($query2) or die(mysql_error());
							$count =mysql_num_rows($exec2);	
							//sementara
								$query = "select distinct Pemanfaatan_ID from PemanfaatanAset where StatusPengembalian = 1";
								// print_r($query);
								$result  = mysql_query($query) or die (mysql_error());
								while ($dataNew = mysql_fetch_object($result))
								{
									$dataArr[] = $dataNew->Pemanfaatan_ID;
								}
								// pr($dataArr);
							?>
                            
                            <table border='0' width=100% >
								<tr>
									<td align="right" width="200px">
										<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
										<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
										<span><input type="button" value="<< Prev" class="buttonprev"/>
										Page
										<input type="button" value="Next >>" class="buttonnext"/></span>
									</td>
								</tr>
								</table>
                            <div id="demo">
							<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
								<thead>
                                    <tr>
                                        <th width="15px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl SKKDH</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan</th>
                                        <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                    </tr>
                                </thead>    
                                    <?php
                                        
                                        $page = @$_GET['pid'];
										if ($page > 1){
											$no = intval($page - 1 .'01');
										}else{
											$no = 1;
										}	  
										while($hsl_data=mysql_fetch_array($exec2)){
										// pr($hsl_data);	
                                    ?>
                                    <tr>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$no";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[Keterangan]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;">
                                            <!--<a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/";?>tes_class_penetapan_aset_yang_dimanfaatkan_validasi.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>" target="_blank">Cetak</a> || -->
											<?php
											// pr($_SESSION);
											if($dataArr){
												if($_SESSION['ses_uaksesadmin'] == 1){
													
													if(in_array($hsl_data['Pemanfaatan_ID'], $dataArr)){
														echo "&nbsp;";
													}else{
													?>
														<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
													<?php
													}
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
													if(in_array($hsl_data['Pemanfaatan_ID'], $dataArr)){
														echo "&nbsp;";
													}else{
														?>
														<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
													<?php	
													}
												}
											}else{
												if($_SESSION['ses_uaksesadmin'] == 1){
												// echo "masuk sini ";
												?>
													<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
												<?php
												}elseif($_SESSION['ses_uoperatorid'] == $hsl_data[UserNm]){
												?>
													<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>"  onclick="return confirm('Hapus Data');">Hapus</a>
												<?php
												}else{
													echo "&nbsp;";
												}
											}									
											?>
										</td>
                                    </tr>
                                    <?php $no++; 
									}?>
                            </table>	
                            <tfoot></tfoot>
                            
                                &nbsp;
                         </table>
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
