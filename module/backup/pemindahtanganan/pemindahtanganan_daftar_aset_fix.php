<?php
        
    include "../../config/config.php";
    
    $menu_id = 42;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    $paging = $LOAD_DATA->paging($_GET['pid']);
        /*$tgl_awal=$_POST['penggu_penet_filt_tglawal'];
        $tgl_akhir=$_POST['penggu_penet_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$_POST['penggu_penet_filt_nopenet'];
        $satker=$_POST['kelompok'];
        $submit=$_POST['tampil'];
     */   
        
        /*$submit2=$_POST['penggunaan_eks'];*/
        
        //open_connection();
        
       
            /*if ($tgl_awal!=""){
            $query_tgl_awal="Tgl_SKKDH='".$tgl_awal."' ";
            }
            if($tgl_akhir!=""){
            $query_tgl_akhir="Tgl_SKKDH='".$tgl_akhir."' ";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH='".$no_penetapan_penggunaan."' ";
            }
            if($satker!=""){
                $query_satker="NamaSatker='".$satker."' ";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_akhir;
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker;
            }
            
            echo "$parameter_sql";
            
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql ." AND Penggunaan_ID".;
            }*/
            
            
       /* if (isset($submit)){
            if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_penggunaan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php";
                            }
                </script>
        <?php
            }
        }*/
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
                            Daftar Usulan Pemindahtanganan Barang
                        </div>
                        <div id="bottomright">
                            <table border="0" width=100%>
                                <td colspan ="2" align="right">
                                    <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                    <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                                </td>
                            </table> 
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>pemindahtanganan.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>daftar_pemindahtanganan_barang.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
                            <table cellspacing="0" cellpadding="0" width="100%" style="margin-top:0px; border: 1px solid black; border-width: 1px 1px 1px 1px;">
                                <tbody>
                                    <tr style="background-color:#004933; color:white; height:20px;">
                                        <th width="15px" align="center" style="border: 1px solid black;">No</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Nomor Usulan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Tgl Usulan</th>
                                        <th width="40px" align="center" style="border: 1px solid black;">Tindakan</th>
                                    </tr>
                                    <?php
                                        
                                        //$hsl_data=mysql_fetch_array($exec);
                                        
                                        
                                       /* $query_fix_satker="SELECT * FROM Satker where NamaSatker='$satker'";
                                        $exec_fix_satker=mysql_query($query_fix_satker);
                                        $hsl_data_fix_satker=  mysql_fetch_array($exec_fix_satker);
                                        $id_aset=$hsl_data_fix_satker['Satker_ID'];
                                        
                                        $query_aset="SELECT * FROM Aset where LastSatker_ID='$id_aset'";
                                        $exec_aset=mysql_query($query_aset);
                                        $hsl_data_aset=  mysql_fetch_array($exec_aset);
                                         
                                        $id_penggunaan=$hsl_data_aset['Aset_ID'];
                                        $query_satker="SELECT * FROM PenggunaanAset where Aset_ID='$id_penggunaan'";
                                        $exec_satker=mysql_query($query_satker) or die(mysql_error());
                                        $hsl_data_satker=mysql_fetch_array($exec_satker);
                                        
                                        $fix=$hsl_data_satker['Penggunaan_ID'];
                                        
                                        
                                     if($tgl_akhir!="" || $tgl_awal!="" || $no_penetapan_penggunaan!="" || $satker!=""){
                                        $query="SELECT * FROM Penggunaan where FixPenggunaan=1 and Status=0 and (NoSKKDH='$no_penetapan_penggunaan' OR TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix' OR Penggunaan_ID='$fix') limit 10";
                                        $exec = mysql_query($query) or die(mysql_error());
                                                                                                            
                                        //$exec = mysql_query($query) or die(mysql_error());
                                     }else{
                                         */
                                    
                                         // untuk status idle
                                    
                                            /*
                                            $query3="SELECT * FROM PenggunaanAset where Status=0 limit 10";
                                            $exec = mysql_query($query3) or die(mysql_error());
                                            $hsl=  mysql_fetch_array($exec);
                                            
                                            $id_penggunaan_aset=$hsl['Penggunaan_ID'];
                                            */
                                    
                                    /*
                                    $hal = $_GET[hal];
                                                                        if(!isset($_GET['hal'])){ 
                                                                            $page = 1; 
                                                                        } else { 
                                                                            $page = $_GET['hal']; 
                                                                        }
                                                                        $jmlperhalaman = 10;  // jumlah record per halaman
                                                                        $offset = (($page * $jmlperhalaman) - $jmlperhalaman);
                                                                        $i=$page + ($page - 1) * ($jmlperhalaman - 1);
                                            */
                                            
                                            
                                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                            $data = $RETRIEVE->retrieve_daftar_usulan_pemindahtanganan($parameter);

                                            //print_r($data['dataArr']);
                                            if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;
                                                    /*
                                            $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH' limit $offset, $jmlperhalaman";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                        //}
                                            $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH'"),0);
                                            */
                                        //$check = mysql_num_rows($exec);
                                        
											//sementara
											$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'PDH'";
											$result  = mysql_query($query) or die (mysql_error());
											while ($data = mysql_fetch_object($result))
											{
												$dataArr[] = $data->Usulan_ID;
											}
                                        
                                        $i=1;
                                        foreach($data['dataArr'] as $key => $nilai){
											
											if($dataArr!="")
												{
													(in_array($nilai['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
												}
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$no. ";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$nilai[Usulan_ID]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$nilai['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/"; ?>tes_class_usulan_aset_yang_akan_dipindahtangankan.php?menu_id=42&mode=1&id=<?php echo "$nilai[Usulan_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>pemindahtanganan_usulan_daftar_proses_hapus.php?id=<?php echo "$nilai[Usulan_ID]";?>" onclick="<?=$disable?> ">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $no++; $pid++; }}?>
                                </tbody>
                            </table>	
                            &nbsp;
                                <?php
                                /*
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
                                 * 
                                 */
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
