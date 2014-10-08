    <?php
        include "../../config/config.php"; 
        
        $tgl_awal=$_POST['peman_pengem_filt_tglawal'];
        $tgl_akhir=$_POST['peman_pengem_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_pemanfaatan_pengembalian=$_POST['peman_pengem_filt_nopenet'];
        $lokasibast=$_POST['peman_pengem_filt_lokasi'];
        $submit=$_POST['tampil_filter'];
        
        //open_connection();
        
       
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAST LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAST LIKE '%$tgl_akhir_fix%'";
            }
            if($no_pemanfaatan_pengembalian!=""){
            $query_np="NoBAST LIKE '%$no_pemanfaatan_pengembalian%'";
            }
            if($lokasibast!=""){
            $query_lokasi="LokasiBAST LIKE '%$lokasibast%'";
            }
            

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAST BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_pemanfaatan_pengembalian!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_pemanfaatan_pengembalian!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($lokasibast!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi;
            }
            if ($lokasibast!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi;
            }
            
            echo "$parameter_sql";
            
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_pemanfaatan_pengembalian=="" && $lokasibast==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter.php";
                            }
                    </script>
    <?php
            }
        }
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
                            Pengembalian Pemanfaatan
                        </div>
                        <script type="text/javascript" charset="utf-8">
							$(document).ready(function() {
								$('#example').dataTable( {
									"aaSorting": [[ 1, "asc" ]]
								} );
							} );
						</script>	
                        <div id="bottomright">
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter2.php"><input type="submit" value="Tambah Data"></a>
                            </div>
							<?php
							 /*$query2="SELECT * FROM Menganggur where FixMenganggur=1 limit 10";
                                            $exec = mysql_query($query2) or die(mysql_error());*/
                            
							if($parameter_sql!="" ) {
									if($_SESSION['ses_uaksesadmin'] == 1){
										$query="SELECT * FROM bast_pengembalian WHERE $parameter_sql AND FixPengembalian=1 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record =mysql_num_rows($exec);
									}else{
										$query="SELECT * FROM bast_pengembalian WHERE $parameter_sql AND FixPengembalian=1 AND UserNm = '$_SESSION[ses_uoperatorid]' ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record =mysql_num_rows($exec);
									}
								}

							if($parameter_sql=="" ) {
								if($_SESSION['ses_uaksesadmin'] == 1){
									$query="SELECT * FROM bast_pengembalian WHERE FixPengembalian=1 ";
									$exec = mysql_query($query) or die(mysql_error());
									$total_record =mysql_num_rows($exec);	
								}else{
									$query="SELECT * FROM bast_pengembalian WHERE FixPengembalian=1 ";
									$exec = mysql_query($query) or die(mysql_error());
									$total_record =mysql_num_rows($exec);	
								}
							}
							?>
                            <table border='0' width='100%' >
								<tr>
									<td align="right" width="200px">
										<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
										<input type="hidden" class="hiddenrecord" value="<?php echo @$total_record?>">
										<span><input type="button" value="<< Prev" class="buttonprev"/>
										Page
										<input type="button" value="Next >>" class="buttonnext"/></span>
									</td>
								</tr>
							</table>
							<br>
                           <div id="demo">
							<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
								<thead>       
									
                                        <th width="15px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor BAST Pengembalian</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl BAST Pengembalian</th>
                                        <th width="80px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Lokasi BAST</th>
                                        <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                    
								 </thead> 
                                    <?php
									   $page = @$_GET['pid'];
										if ($page > 1){
											$no = intval($page - 1 .'01');
										}else{
											$no = 1;
										}
										while($row=mysql_fetch_array($exec)){
                                        ?>
                                    <tr>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$no.";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$row[NoBAST]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$row[TglBAST]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$row[LokasiBAST]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;">
                                            <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_daftar_edit.php?id=<?php echo "$row[BAST_Pengembalian_ID]";?>">Edit</a>  ||
											<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_daftar_hapus.php?id=<?php echo "$row[BAST_Pengembalian_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a> 
                                        </td>
                                    </tr>
                                    <?php
                                        $no++;
                                            }
                                    ?>
                              </table>	
                            <tfoot></tfoot>
                            
                                &nbsp;
                         </table>
							</div>
							<div class="spacer"></div>
				<!-- End Frame -->    
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

