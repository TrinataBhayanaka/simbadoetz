    <?php
        include "../../config/config.php"; 
        
        $tgl_awal=$_POST['peman_penet_bmd_filt_tglawal'];
        $tgl_akhir=$_POST['peman_penet_bmd_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_idle=$_POST['peman_penet_bmd_filt_nopenet'];
        $alasan=$_POST['peman_penet_bmd_filt_alasan'];
        $submit=$_POST['tampil_idle'];
			
			// pr($_POST);
            //open_connection();
        
       
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan_idle!=""){
            $query_npi="NoSKKDH LIKE '%$no_penetapan_idle%'";
            }
            if($alasan!=""){
            $query_alasan="Keterangan LIKE '%$alasan%'";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="m.TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_idle!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npi;
            }
            if ($no_penetapan_idle!="" && $parameter_sql==""){
            $parameter_sql=$query_npi;
            }
            if($alasan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_alasan;
            }
            if ($alasan!="" && $parameter_sql==""){
            $parameter_sql=$query_alasan;
            }
            
            //echo "$parameter_sql";
            
            
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_idle=="" && $alasan==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter.php";
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
                                Penetapan BMD Menganggur
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
                                    <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter2.php"><input type="submit" value="Tambah Data"></a>
                                </div>
								<?php 
								// pr($_SESSION);
								// pr($parameter_sql);
								if($parameter_sql!="" ) {
									
									if($_SESSION['ses_uaksesadmin'] = 1 ){
										$query2="SELECT * FROM Menganggur WHERE FixMenganggur=1 and $parameter_sql";
										$exec = mysql_query($query2) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE $parameter_sql AND FixMenganggur=1"),0);
									}else{
										$query2="SELECT * FROM Menganggur WHERE UserNm =$_SESSION[ses_uoperatorid] and FixMenganggur=1 and $parameter_sql";
										$exec = mysql_query($query2) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE $parameter_sql AND FixMenganggur=1"),0);
									}
									
								}
								elseif($parameter_sql=="" ){
									if($_SESSION['ses_uaksesadmin'] = 1 ){
										$query2="SELECT * FROM Menganggur WHERE FixMenganggur=1";
										$exec = mysql_query($query2) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE FixMenganggur=1"),0);
									}else{
										$query2="SELECT * FROM Menganggur WHERE UserNm =$_SESSION[ses_uoperatorid] and FixMenganggur=1";
										$exec = mysql_query($query2) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE FixMenganggur=1"),0);
									}
									
								}
								
								?>	
                                <table border=0 cellspacing="0" width="100%" style="padding:0px; margin-top:0px; border: 0px solid #; border-width: 0px 0px 0px 0px; clear:both;">	
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>	
										<td align="right"><input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
										<input type="hidden" class="hiddenrecord" value="<?php echo $total_record?>">
											<input type="button" value="<< Prev" class="buttonprev"/>
												Page
										<input type="button" value="Next >>" class="buttonnext"/></td>	
									</tr>
								</table>
								<br>
                                <div id="demo">
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
									<thead>
                                            <th width="15px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl SKKDH</th>
                                            <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
									 </thead> 
                                        <?php
											
												$page = @$_GET['pid'];
												if ($page > 1){
													$no = intval($page - 1 .'01');
												}else{
													$no = 1;
												}
												//sementara
												// $query = "select distinct Menganggur_ID from MenganggurAset where StatusUsulan = 1";
												// print_r($query);
												$result  = mysql_query($query) or die (mysql_error());
												while ($dataNew = mysql_fetch_object($result))
												{
													$dataArr[] = $dataNew->Menganggur_ID;
												}
												
												//$no = 1;
												while($row=mysql_fetch_array($exec)){
												/*if($dataArr!="")
												{
													(in_array($row['Menganggur_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
												}*/
                                        ?>
                                        <tr>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: "><?php echo "$no";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: ;"><?php echo "$row[NoSKKDH]";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: ;"><?php $change=$row[TglSKKDH]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: ;">
                                                 <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_daftar_edit.php?id=<?php echo "$row[Menganggur_ID]";?>">Edit</a> ||
												 <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_daftar_proses_hapus.php?id=<?php echo "$row[Menganggur_ID]";?>">Hapus</a> 
                                            </td>
                                        </tr>
                                        <?php $no++; } ?>
                                    </tbody>
                                </table>    
                                    &nbsp;
                                    <tfoot></tfoot>
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
