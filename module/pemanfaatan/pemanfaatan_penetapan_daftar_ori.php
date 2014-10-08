    <?php
        include "../../config/config.php"; 
        
        $menu_id = 34;
        $SessionUser = $SESSION->get_session_user();
        //($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $tgl_awal=$_POST['peman_penet_filt_tglawal'];
        $tgl_akhir=$_POST['peman_penet_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan=$_POST['peman_penet_filt_nopenet'];
        $alasan=$_POST['peman_penet_filt_alasan'];
        $submit=$_POST['tampil_filter'];

        //open_connection();
        
       
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoSKKDH LIKE '%$no_penetapan%'";
            }
            if($alasan!=""){
            $query_alasan="Keterangan LIKE '%$alasan%'";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($alasan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_alasan;
            }
            if ($alasan!="" && $parameter_sql==""){
            $parameter_sql=$query_alasan;
            }
            
            //echo "$parameter_sql";
            
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan=="" && $alasan==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter.php";
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
                            Penetapan Pemanfaatan
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
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter2.php"><input type="submit" value="Tambah Data"></a>
                            </div>
							<?php 
								if($parameter_sql!="" ) {
									if($_SESSION['ses_uaksesadmin'] == 1){
										$query="SELECT * FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0"),0);
									}else{
										$query="SELECT * FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0 AND UserNm = '$_SESSION[ses_uoperatorid]' ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0 AND UserNm = '$_SESSION[ses_uoperatorid]' "),0);
									}
								}

								if($parameter_sql=="" ) {
									if($_SESSION['ses_uaksesadmin'] == 1){
										$query="SELECT * FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0"),0);
									}else{
										$query="SELECT * FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0 AND UserNm = '$_SESSION[ses_uoperatorid]'"),0);
									}
								}
							
							?>
                            <table border=0 cellspacing="0" width="100%" style="padding:0px; margin-top:0px; border: 0px solid #; border-width: 0px 0px 0px 0px; clear:both;">	
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>	
									<td align="right"><input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
									<input type="hidden" class="hiddenrecord" value="<?php echo @$total_record?>">
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
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl SKKDH</th>
                                            <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                        </tr>
									</thead>
                                        <?php
                                            /*$query2="SELECT * FROM Menganggur where FixMenganggur=1 limit 10";
                                            $exec = mysql_query($query2) or die(mysql_error());*/
						
                                            $i=1;
                                            while($row=mysql_fetch_array($exec)){
                                        ?>
                                        <tr>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd;color: #; font-weight: ;"><?php echo "$i";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd;color: #; font-weight: ;"><?php echo "$row[NoSKKDH]";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd;color: #; font-weight: ;"><?php $change=$row[TglSKKDH]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd;color: #; font-weight: ;">
                                                <!--<a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/";?>tes_class_penetapan_aset_yang_dimanfaatkan.php?id=<?php echo "$row[Pemanfaatan_ID]";?>" target="_blank">Cetak</a>-->
												<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_daftar_edit.php?id=<?php echo "$row[Pemanfaatan_ID]";?>">Edit</a>
												|| <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_daftar_hapus.php?id=<?php echo "$row[Pemanfaatan_ID]";?>">Hapus</a>  
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                </table>
                                <tfoot></tfoot>
							</div>
							<div class="spacer"></div>   
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
