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
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_cetak_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                                </div>
                                <table cellspacing="0" cellpadding="0" width="100%" style="margin-top:0px; border: 1px solid black; border-width: 1px 1px 1px 1px;">
                                    <tbody>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="15px" align="center" style="border: 1px solid black;">No</th>
                                            <th width="100px" align="center" style="border: 1px solid black;">Nomor SKKDH</th>
                                            <th width="100px" align="center" style="border: 1px solid black;">Tgl SKKDH</th>
                                            <th width="100px" align="center" style="border: 1px solid black;">Keterangan</th>
                                            <th width="40px" align="center" style="border: 1px solid black;">Tindakan</th>
                                        </tr>
                                        <?php



                                                $hal = $_GET[hal];
                                                if(!isset($_GET['hal'])){ 
                                                    $page = 1; 
                                                } else { 
                                                    $page = $_GET['hal']; 
                                                }
                                                $jmlperhalaman = 10;  // jumlah record per halaman
                                                $offset = (($page * $jmlperhalaman) - $jmlperhalaman);
                                                $i=$page + ($page - 1) * ($jmlperhalaman - 1);    

                                                $query2="SELECT * FROM Pemanfaatan $parameter_sql FixPemanfaatan=1 and Status=1 limit $offset, $jmlperhalaman";
                                                $exec2 = mysql_query($query2) or die(mysql_error());

                                                $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan $parameter_sql FixPemanfaatan=1 and Status=1"),0);
                                            //}

                                            //$check = mysql_num_rows($exec);

                                            $i=1;
                                            while($hsl_data=mysql_fetch_array($exec2)){
                                        ?>
                                        <tr>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$i";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[Keterangan]";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                                <a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/";?>tes_class_penetapan_aset_yang_dimanfaatkan_validasi.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>" target="_blank">Cetak</a>
                                            </td>
                                        </tr>
                                        <?php $i++; }?>
                                    </tbody>
                                </table>	
                                    &nbsp;
                                    <?php
                                        $total_halaman = ceil($total_record / $jmlperhalaman);
                                        echo "<center><b style='color:#004933;'>Halaman :</b><br />";
                                    ?>
                                        <div class="paging">
                                    <?php
                                        $perhal=5;
                                        if($hal > 1){ 
                                            $prev = ($page - 1); 
                                            echo "<a href=$_SERVER[PHP_SELF]?hal=1 class='preevnext'> << First </a>  <a href=$_SERVER[PHP_SELF]?hal=$prev class='preevnext'> < Previous </a> "; 
                                            echo "<span class='disabled'>...</span>";
                                        }
                                        if($total_halaman<=10){
                                        $hal1=1;
                                        $hal2=$total_halaman;
                                        }else{
                                        $hal1=$hal-$perhal;
                                        $hal2=$hal+$perhal;
                                        }
                                        if($hal<=5){
                                        $hal1=1;
                                        }
                                        if($hal<$total_halaman){
                                        $hal2=$hal+$perhal;
                                        }else{
                                        $hal2=$hal;
                                        }
                                        for($i = $hal1; $i <= $hal2; $i++){ 
                                            if(($hal) == $i){ 
                                                echo "<span class='current'>$i</span>"; 
                                                } else { 
                                            if($i<=$total_halaman){
                                                    echo "<a href=$_SERVER[PHP_SELF]?hal=$i>$i</a> "; 
                                            }
                                            } 
                                        }
                                        if($hal < $total_halaman){
                                            echo "<span class='disabled'>...</span>";
                                            $next = ($page + 1); 
                                            echo "<a href=$_SERVER[PHP_SELF]?hal=$next class='prevnext'> Next > </a>  <a href=$_SERVER[PHP_SELF]?hal=$total_halaman class='prevnext'> Last >> </a>"; 
                                        } 
                                        ?>
                                        </div>
                                        <?php
                                        echo "</center>"; 
                                        ?>
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

