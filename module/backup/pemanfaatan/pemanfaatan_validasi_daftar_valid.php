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
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php"><input type="submit" value="Tambah Data"></a>
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
                                    
                                            $query2="SELECT * FROM Pemanfaatan where FixPemanfaatan=1 and Status=1 limit $offset, $jmlperhalaman";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                            
                                            $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan where FixPemanfaatan=1 and Status=1"),0);
                                       
												//sementara
												$query = "select distinct Pemanfaatan_ID from PemanfaatanAset where StatusPengembalian = 1";
												$result  = mysql_query($query) or die (mysql_error());
												while ($data = mysql_fetch_object($result))
												{
													$dataArr[] = $data->Pemanfaatan_ID;
												}
                                        
                                        $i=1;
                                        while($hsl_data=mysql_fetch_array($exec2)){
											
											if($dataArr!="")
												{
													(in_array($hsl_data['Pemanfaatan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
												}
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$i";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[Keterangan]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/";?>tes_class_penetapan_aset_yang_dimanfaatkan_validasi.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Pemanfaatan_ID]";?>" onclick="<?=$disable?> ">Hapus</a>
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
