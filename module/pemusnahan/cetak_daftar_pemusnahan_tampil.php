<?php
        
    include "../../config/config.php";
    include "$path/header.php";
    
    $no_pemusnahan=$_POST['buph_cdph_noskpemusnahan'];
    $tgl_pemusnahan_awal=$_POST['buph_cdph_tanggalawal'];
    $tgl_pemusnahan_akhir=$_POST['buph_cdph_tanggalakhir'];
    $lokasi=$_POST['lokasi_id'];
    $submit=$_POST['tampil_filter'];
    
    $menu_id = 49;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    if (isset($submit)){
                if ($no_pemusnahan=="" && $tgl_pemusnahan_awal=="" && $tgl_pemusnahan_akhir=="" && $lokasi==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite"; ?>/module/pemusnahan/cetak_daftar_pemusnahan_filter.php";
                            }
                    </script>
    <?php
            }
        }
    
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
                            Cetak Daftar Pemusnahan
                        </div>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>cetak_daftar_pemusnahan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
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
                                        <th width="100px" align="center" style="border: 1px solid black;">Nomor BA Pemusnahan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Tgl BA Pemusnahan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Nama Penandatangan</th>
                                        <th width="40px" align="center" style="border: 1px solid black;">Tindakan</th>
                                    </tr>
                                    <?php
                                        
                                        
                                   
                                        $paging = $LOAD_DATA->paging($_GET['pid']);
                                       unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
                                        $data = $RETRIEVE->retrieve_daftar_cetak_pemusnahan($parameter);
                                        
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
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoBAPemusnahan]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data[TglBAPemusnahan]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NamaPenandatangan]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_validasi_daftar_valid.php?id=$hsl_data[BAPemusnahan_ID]&mode=1";?>" target="_blank">Cetak</a>
                                        </td>
                                    </tr>
                                    <?php $no++; $pid++;} }?>
                                </tbody>
                            </table>	
                            
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
