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
            
            //echo "$parameter_sql";
            
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
                        <div id="bottomright">
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter2.php"><input type="submit" value="Tambah Data"></a>
                            </div>
                            
                            <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                <tbody>
                                    <tr style="background-color:#004933; color:white; height:20px;">
                                        <th width="15px" align="center" style="border: 1px solid #004933;">No</th>
                                        <th width="100px" align="center" style="border: 1px solid #004933;">Nomor BAST Pengembalian</th>
                                        <th width="100px" align="center" style="border: 1px solid #004933;">Tgl BAST Pengembalian</th>
                                        <th width="80px" align="center" style="border: 1px solid #004933;">Lokasi BAST</th>
                                        <th width="40px" align="center" style="border: 1px solid #004933;">Tindakan</th>
                                    </tr>
                                    <?php
                                            /*$query2="SELECT * FROM Menganggur where FixMenganggur=1 limit 10";
                                            $exec = mysql_query($query2) or die(mysql_error());*/
                                    
                                            $hal = $_GET[hal];
                                            if(!isset($_GET['hal'])){ 
                                                $page = 1; 
                                            } else { 
                                                $page = $_GET['hal']; 
                                            }
                                            $jmlperhalaman = 10;  // jumlah record per halaman
                                            $offset = (($page * $jmlperhalaman) - $jmlperhalaman);
                                            $i=$page + ($page - 1) * ($jmlperhalaman - 1);
                                    
                                            if($parameter_sql!="" ) {
                                            $query="SELECT * FROM BAST_Pengembalian WHERE $parameter_sql AND FixPengembalian=1 limit $offset, $jmlperhalaman";
                                            $exec = mysql_query($query) or die(mysql_error());
                                            
                                            $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM BAST_Pengembalian WHERE $parameter_sql AND FixPengembalian=1"),0);
                                            }

                                            if($parameter_sql=="" ) {
                                            $query="SELECT * FROM BAST_Pengembalian WHERE FixPengembalian=1 limit $offset, $jmlperhalaman";
                                            $exec = mysql_query($query) or die(mysql_error());
                                            
                                            $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM BAST_Pengembalian WHERE FixPengembalian=1"),0);
                                            }
                                            $i=1;
                                            while($row=mysql_fetch_array($exec)){
                                        ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$i.";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$row[NoBAST]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$row[TglBAST]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$row[LokasiBAST]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_daftar_hapus.php?id=<?php echo "$row[BAST_Pengembalian_ID]";?>">Hapus</a> || <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_daftar_edit.php?id=<?php echo "$row[BAST_Pengembalian_ID]";?>">Edit</a>
                                        </td>
                                    </tr>
                                    <?php
                                        $i++;
                                            }
                                    ?>
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

