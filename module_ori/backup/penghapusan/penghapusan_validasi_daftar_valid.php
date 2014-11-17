<?php
        
    include "../../config/config.php";
    
    $menu_id = 40;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

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
                            Daftar Validasi Barang Penghapusan
                        </div>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_lanjut.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
                            
                            <table border="0" width=100%>
                            <td colspan ="2" align="right">
                                <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                            </td>
                            </table>
                            
                            <table cellspacing="0" cellpadding="0" width="100%" style="margin-top:0px; border: 1px solid black; border-width: 1px 1px 1px 1px;">
                                <tbody>
                                    <tr style="background-color:#004933; color:white; height:20px;">
                                        <th width="15px" align="center" style="border: 1px solid black;">No</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Nomor SK Penghapusan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Tgl Penghapusan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Keterangan</th>
                                        <th width="40px" align="center" style="border: 1px solid black;">Tindakan</th>
                                    </tr>
                                    <?php
                                        
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
                                                
                                            $query2="SELECT * FROM Penghapusan where FixPenghapusan=1 and Status=1 limit $offset, $jmlperhalaman";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                            
                                            $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Penghapusan where FixPenghapusan=1 and Status=1"),0);
                             
                                        
                                        $i=1;
                                        while($hsl_data=mysql_fetch_array($exec2)){
                                     * 
                                     */
                                        $paging = $LOAD_DATA->paging($_GET['pid']);
                                       unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                        $data = $RETRIEVE->retrieve_daftar_validasi_penghapusan($parameter);
                                        
                                        if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;
                                        $i=1;
                                        foreach($data['dataArr'] as $key => $hsl_data){
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$no.";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoSKHapus]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[AlasanHapus]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan_validasi.php?menu_id=40&mode=1&id=<?php echo "$hsl_data[Penghapusan_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Penghapusan_ID]";?>">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $no++; $pid++; } }?>
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
