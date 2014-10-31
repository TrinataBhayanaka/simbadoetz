<?php
        
    include "../../config/config.php";
	?>   
	 
<html>
    <?php
        include "$path/header.php";
    ?>
     <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "desc" ]]
				} );
			} );
		</script>
    
    <body>
		<div id="content">
            <?php
                include "$path/title.php";
                include "$path/menu.php";
				// pr($_SESSION);
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Daftar Mutasi Barang
                        </div>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_antar_skpd.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_antar_skpd.php"><input type="submit" value="Tambah Data"></a>
                            </div>
                             <!-- Begin frame -->
                            <table width='100%' border='0' style="border-collapse:collapse;border: 0px solid #;">
								<tr>
									<td colspan ="3" align="right">
										<table border="0" width="100%">
											<tr>
												
												<td align="right" width="200px">
													<?php 
														if($_SESSION['ses_uaksesadmin']){
															$query2="SELECT * FROM Mutasi where FixMutasi=1";
														}else{
															$query2="SELECT * FROM Mutasi where FixMutasi=1 and UserNm='$_SESSION[ses_uoperatorid]'";
														}
														$exec2 = mysql_query($query2) or die(mysql_error());
														$check = mysql_num_rows($exec2);
														// echo "cek =".$check; 
														// pr($check);
													
													?>	
														<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
														<input type="hidden" class="hiddenrecord" value="<?php echo @$check?>">
														<span><input type="button" value="<< Prev" class="buttonprev"/>
														Page
														<input type="button" value="Next >>" class="buttonnext"/></span>
													
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
                            <br>
                            <div id="demo">
							<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
								<thead>
                                        <th width="15px" align="center"  style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl SKKDH</th>
                                        <th width="200px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                    
                                </thead>    
                                    <?php
                                        // $i=1;
                                        $page = @$_GET['pid'];
										if ($page > 1){
											$i = intval($page - 1 .'01');
										}else{
											$i = 1;
										}
										
										while($hsl_data=mysql_fetch_array($exec2)){
										// pr($hsl_data);
                                    ?>
                                    <tr>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: "><?php echo "$i";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$hsl_data[TglSKKDH]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[Keterangan]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;">
                                            <!--<a href="<?php echo "$url_rewrite/report/template/MUTASI/";?>tes_class_mutasi_transfer_antar_skpd.php?menu_id=22&mode=1&id=<?php echo "$hsl_data[Mutasi_ID]";?>" target="_blank">Cetak</a> ||--> 
											<a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_edit.php?id=<?php echo "$hsl_data[Mutasi_ID]";?>">Edit</a> ||
											<a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_proses_hapus.php?id=<?php echo "$hsl_data[Mutasi_ID]";?>" onclick="return confirm('Hapus Data ?');">Hapus</a> 
										</td>
                                    </tr>
                                    <?php $i++; }?>
                                
								</table>	
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
