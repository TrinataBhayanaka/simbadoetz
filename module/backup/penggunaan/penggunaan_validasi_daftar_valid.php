<?php
        
    include "../../config/config.php";
    
    $menu_id = 31;
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
                            Daftar Validasi Barang
                        </div>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar.php?pid=1"><input type="submit" value="Tambah Data"></a>
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
                                        <th width="100px" align="center" style="border: 1px solid black;">Nomor SKKDH</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Tgl SKKDH</th>
                                        <th width="40px" align="center" style="border: 1px solid black;">Tindakan</th>
                                    </tr>
                                    <?php
                                    
                                    //sementara
                                    $query = "select distinct Penggunaan_ID from PenggunaanAset where StatusMenganggur = 1 or StatusMutasi = 1";
                                    $result  = mysql_query($query) or die (mysql_error());
                                    while ($data = mysql_fetch_object($result))
                                    {
                                        $dataArr[] = $data->Penggunaan_ID;
                                    }
                                        
                                        echo '<pre>';
                                        //print_r($dataArr);   
                                        
                                        
                                        $paging = $LOAD_DATA->paging($_GET['pid']);
                                       unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                        $data = $RETRIEVE->retrieve_daftar_validasi_penggunaan($parameter);
                                        
                                        if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;
                                        $i=1;
                                        
                                        
                                        
                                        foreach($data['dataArr'] as $key => $hsl_data){
                                            if($dataArr!="")
                                            {
                                                (in_array($hsl_data['Penggunaan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
                                            }
                                            
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$no.";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PENGGUNAAN/";?>tes_class_penetapan_aset_yang_digunakan_validasi.php?menu_id=31&mode=1&id=<?php echo "$hsl_data[Penggunaan_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Penggunaan_ID]";?>" onclick="<?=$disable?> " >Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $no++; $pid++; } }?>
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
