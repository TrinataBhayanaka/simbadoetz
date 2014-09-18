<?php
        
    include "../../config/config.php";
    
        $menu_id = 46;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $paging = $LOAD_DATA->paging($_GET['pid']);
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
                            Daftar Usulan Pemusnahan Barang
                        </div>
                        <div id="bottomright">
                            <table border="0" width=100%>
                                <td colspan ="2" align="right">
                                    <input type="button" value="Prev" <?php echo $disabled ?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                    <input type="button" value="Next" <?php echo $disabled ?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                                </td>
                            </table>
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_lanjut.php?pid=1"><input type="submit" value="Tambah Data"></a>
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
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                            $data = $RETRIEVE->retrieve_daftar_usulan_pemusnahan($parameter);

                                            //print_r($data['dataArr']);
                                            if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;    
                                    
                                    /*
                                            $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='MSN' limit 10";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                        
                                        
                                        $i=1;
                                        while($hsl_data=mysql_fetch_array($exec2)){
                                     * 
                                     */
                                     
                                     //sementara
											$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'MSN'";
											$result  = mysql_query($query) or die (mysql_error());
											while ($data = mysql_fetch_object($result))
											{
												$dataArr[] = $data->Usulan_ID;
											}
											
                                    foreach($data['dataArr'] as $key => $hsl_data){
										
										if($dataArr!="")
												{
													(in_array($hsl_data['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
												}
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$no.";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[Usulan_ID]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_untuk_dimusnahkan.php?id=$hsl_data[Usulan_ID]&menu_id=46&mode=1";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>pemusnahan_usulan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="<?=$disable?> ">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $no++; $pid++; }}?>
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
