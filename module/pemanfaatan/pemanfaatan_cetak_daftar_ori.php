    <?php
        include "../../config/config.php"; 
        
        $tgl_awal=$_POST['peman_pengem_filt_add_tglawal'];
        $tgl_akhir=$_POST['peman_pengem_filt_add_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_pemanfaatan_pemanfaatan=$_POST['peman_pengem_filt_add_nopenet'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil_filter'];
        
        if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_pemanfaatan_pemanfaatan!=""){
            $query_np="NoSKKDH LIKE '%$no_pemanfaatan_pemanfaatan%'";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                $panjang=count($temp);
                //$query_satker="(";
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;
                            if($i==0)
                            $query_satker.="Satker_ID ='$temp[$i]'";
                            else
                            $query_satker.=" or Satker_ID ='$temp[$i]'";
                    }


                $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                        WHERE $query_satker";
                //print_r($query_change_satker);
                $exec_query_change_satker=  mysql_query($query_change_satker) or die(mysql_error());
                while($proses_kode=mysql_fetch_array($exec_query_change_satker)){
                    
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                        }
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                            $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                        }
                        echo "<pre>";
                        //print_r($query_return_kode);
                        echo "</pre>";

                    }
                        $exec_query_return_kode=mysql_query($query_return_kode) or die(mysql_error());
                        while($proses_kode2=mysql_fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Satker_ID'];
                        }

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_satker_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                                }
                                
                        }
                        $query_change_satker_fix="SELECT a.Pemanfaatan_ID FROM Pemanfaatan AS a INNER JOIN PemanfaatanAset AS b ON a.Pemanfaatan_ID=b.Pemanfaatan_ID
                                                                        INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                        $exec_query_change_satker_fix=  mysql_query($query_change_satker_fix) or die(mysql_error());
                        if(mysql_num_rows($exec_query_change_satker_fix)){
                            while($proses_kode_fix=mysql_fetch_array($exec_query_change_satker_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Pemanfaatan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);
                        }
                        if($gabung!=""){
                        $query_satker_fix2="Pemanfaatan_ID IN ($gabung)";
                        }else{
                            $query_satker_fix2="Pemanfaatan_ID IN (NULL)";
                        }
            //$query_alasan="Keterangan LIKE '%$alasan%'";
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
            if($no_pemanfaatan_pemanfaatan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_pemanfaatan_pemanfaatan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
            //echo "$parameter_sql";

        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_pemanfaatan_pemanfaatan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_cetak_filter.php";
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
                                Cetak Daftar Pemanfaatan
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
									<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_cetak_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                                </div>
                                <?php
									if($_SESSION['ses_uaksesadmin'] == 1){
										$query2="SELECT * FROM Pemanfaatan $parameter_sql FixPemanfaatan=1 and Status=1 ";
										$exec2 = mysql_query($query2) or die(mysql_error());
										$total = mysql_num_rows($exec2);
                                    }else{
										$query2="SELECT * FROM Pemanfaatan $parameter_sql FixPemanfaatan=1 and Status=1 where UserNm = UserNm = '$_SESSION[ses_uoperatorid]'";
										$exec2 = mysql_query($query2) or die(mysql_error());
										$total = mysql_num_rows($exec2);
									}
									// pr($query2);
								?>
								<table border='0' width=100% >
								<tr>
									<td align="right" width="200px">
										<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
										<input type="hidden" class="hiddenrecord" value="<?php echo @$total?>">
										<span><input type="button" value="<< Prev" class="buttonprev"/>
										Page
										<input type="button" value="Next >>" class="buttonnext"/></span>
									</td>
								</tr>
								</table>
                                <div id="demo">
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
									<thead>
                                        
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
                                        ?>
                                        <tr>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$no";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[Keterangan]";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;">
                                                <a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/";?>tes_class_penetapan_aset_yang_dimanfaatkan_validasi.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>" target="_blank">Cetak</a>
                                            </td>
                                        </tr>
                                        <?php $i++; }?>
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

