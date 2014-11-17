<?php
        
    include "../../config/config.php";

        
     $menu_id = 44;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
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
                            Daftar Validasi Barang Pemindahtanganan
                        </div>
                        <div id="bottomright">
                           <table border="0" width=100%>
                            <td colspan ="2" align="right">
                                <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                            </td>
                            </table> 
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_filter_pemindahtanganan.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
                            <table cellspacing="0" cellpadding="0" width="100%" style="margin-top:0px; border: 1px solid black; border-width: 1px 1px 1px 1px;">
                                <tbody>
                                    <tr style="background-color:#004933; color:white; height:20px;">
                                        <th width="15px" align="center" style="border: 1px solid black;">No</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Nomor Pemindahtanganan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Tgl Pemindahtanganan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Lokasi Pemindahtanganan</th>
                                        <th width="40px" align="center" style="border: 1px solid black;">Tindakan</th>
                                    </tr>
                                    <?php
                                        
                                        //$hsl_data=mysql_fetch_array($exec);
                                        
                                       $paging = $LOAD_DATA->paging($_GET['pid']);
                                       unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                        $data = $RETRIEVE->retrieve_daftar_validasi_pemindahtanganan($parameter);
                                        
                                        //$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
                                        //$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
                                        //$data = $RETRIEVE->retrieve_daftar_validasi_pemindahtanganan($parameter);

                                            
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
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoBASP]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data[TglBASP]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[LokasiBASP]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/";?>tes_class_penetapan_aset_yang_dipindahkan_validasi.php?menu_id=44&mode=1&id=<?php echo "$hsl_data[BASP_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[BASP_ID]";?>">Hapus</a>
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
