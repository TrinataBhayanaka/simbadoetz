<?php
                     include "../../config/config.php";
                   include"$path/header.php";
                   include"$path/title.php";
                   
                    $menu_id = 45;
                    $SessionUser = $SESSION->get_session_user();
                    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
                    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
                    
                    $bupt_ppt_tanggalawal = $_POST['bupt_cdpt_tanggalawal'];
                    $bupt_ppt_tanggalakhir = $_POST['bupt_cdpt_tanggalakhir'];
                    $tgl_awal_fix=format_tanggal_db2($bupt_ppt_tanggalawal);
                    $tgl_akhir_fix=format_tanggal_db2($bupt_ppt_tanggalakhir);
                    $bupt_ppt_noskpemindahtanganan = $_POST['bupt_cdpt_noskpemindahtanganan'];
                    $satker = $_POST['skpd_id'];
                    $submit = $_POST['tampil_filter'];
                    
                    if (isset($submit)){
                if ($bupt_ppt_tanggalawal=="" && $bupt_ppt_tanggalakhir=="" && $bupt_ppt_noskpemindahtanganan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>penetapan_pemindahtanganan.php";
                            }
                    </script>
    <?php
            }
        }

?>
<html>
	  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/js/tabel.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                        <?php
                            include"$path/menu.php";
                         ?>	
	</div>
	<div id="tengah1">	
                            <div id="frame_tengah1">
                                    <div id="frame_gudang">
                                            <div id="topright">
                                                    Cetak Pemindahtanganan
                                            </div>
                                            <div id="bottomright">
                                                    <table border="0" width=100%>
                                                                <td colspan ="2" align="right">
                                                                    <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                                                    <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                                                                </td>
                                                    </table> 
                                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                            <tr>
                                                                <td width="50%" align="left" style="border:0px;">
                                                                    <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter" onclick="document.location='<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>cetak_daftar_pemindahtanganan.php'">
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                                            <tbody>
                                                                <tr style="background-color:#004933; color:white; height:20px;">
                                                                    <th width="15px" align="center" style="border: 1px solid #004933;">No</th>
                                                                    <th width="100px" align="center" style="border: 1px solid #004933;">Nomor Pemindahtanganan</th>
                                                                    <th width="100px" align="center" style="border: 1px solid #004933;">Tgl Pemindahtanganan</th>
                                                                    <th width="200px" align="center" style="border: 1px solid #004933;">Lokasi Pemindahtanganan</th>
                                                                    <th width="100px" align="center" style="border: 1px solid #004933;">Tindakan</th>
                                                                </tr>
                                                                <?php
                                                                    
                                                                    $paging = $LOAD_DATA->paging($_GET['pid']);    
            
                                                                        if (isset($submit))
                                                                                            {
                                                                                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                                                                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
                                                                                                        $data = $RETRIEVE->retrieve_daftar_cetak_penetapan_pemindahtanganan($parameter);
                                                                                            }
                                                                        
                                                                        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
                                                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
                                                                        $data = $RETRIEVE->retrieve_daftar_cetak_penetapan_pemindahtanganan($parameter);
                                
                                                                        echo '<pre>';
                                                                        //print_r($data['dataArr']);
                                                                        echo '</pre>';
                                                                        
                                                                        if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                                        if (!empty($data['dataArr']))
                                                                        {
                                                                            $disabled = '';
                                                                            $pid = 0;
                                                                    foreach($data['dataArr'] as $key => $value)
                                                                        {
                                                               
                                                                ?>
                                                                <tr>
                                                                    <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$no.";?></td>
                                                                    <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo $value['NoBASP'];?></td>
                                                                    <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$value['TglBASP']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                                                    <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo $value['LokasiBASP'];?></td>
                                                                    <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                                                        <a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/";?>tes_class_penetapan_aset_yang_dipindahkan_validasi.php?menu_id=45&mode=1&id=<?php echo $value['BASP_ID'];?>" target="_blank">Cetak</a>
                                                                    </td>
                                                                </tr>
                                                                <?php $no++; $pid++; }} ?>
                                                            </tbody>
                                                        </table>
                                              </div>
                                        </div>
                                    </div>
                              </div>
                                <?php
                                        include"$path/footer.php";
                                ?>
    </body>
</html>	
