<?php

    include "../../config/config.php";
    
     include"$path/header.php";
    include"$path/title.php";
    
    $menu_id = 39;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    
        $tgl_awal=$_POST['bup_pu_tanggalawal'];
        $tgl_akhir=$_POST['bup_pu_tanggalakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan=$_POST['bup_pu_noskpenghapusan'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil_filter'];

        //open_connection();
        
       /*
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglHapus LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglHapus LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoSKHapus LIKE '%$no_penetapan%'";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglHapus BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            
            echo "$parameter_sql";
            */
            
            if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_filter.php";
                            }
                    </script>
    <?php
            }
        }
    ?>
 
    
    
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="distribusi_barang_filter.php";
		  }
		}
	</script>
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
                                                        Penetapan Penghapusan
                                                </div>
                                                    <div id="bottomright">
                                                                
                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td width="50%" align="left" style="border:0px;">
                                                                                <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter" onclick="document.location='<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_filter.php'">
                                                                            </td>
                                                                            <td width="50%" align="right" style="border:0px;">
                                                                                <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data" onclick="window.location='<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_tambah_aset.php'">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                <table border="0" width=100%>
                                                                    <td colspan ="2" align="right">
                                                                        <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                                                        <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                                                                    </td>
                                                                </table>

                                                                    <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                                                        <tbody>
                                                                            <tr style="background-color:#004933; color:white; height:20px;">
                                                                                <th width="15px" align="center" style="border: 1px solid #004933;">No</th>
                                                                                <th width="100px" align="center" style="border: 1px solid #004933;">Nomor SK Penghapusan</th>
                                                                                <th width="100px" align="center" style="border: 1px solid #004933;">Tgl Penghapusan</th>
                                                                                <th width="40px" align="center" style="border: 1px solid #004933;">Tindakan</th>
                                                                            </tr>
                                                                            <?php
                                                                            
                                                                            
                                                                            $paging = $LOAD_DATA->paging($_GET['pid']);    
            
                                                                        if (isset($submit))
                                                                                            {
                                                                                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                                                                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
                                                                                                        $data = $RETRIEVE->retrieve_daftar_penetapan_penghapusan($parameter);
                                                                                            }
                                                                        
                                                                        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
                                                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
                                                                        $data = $RETRIEVE->retrieve_daftar_penetapan_penghapusan($parameter);
                                
                                                                        echo '<pre>';
                                                                        //print_r($data['dataArr']);
                                                                        echo '</pre>';
                                                                        
                                                                        if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                                        if (!empty($data['dataArr']))
                                                                        {
                                                                            $disabled = '';
                                                                            $pid = 0;
                                                                        foreach($data['dataArr'] as $key => $row)
                                                                            {
                                                                            ?>
                                                                            <tr>
                                                                                <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$no.";?></td>
                                                                                <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$row[NoSKHapus]";?></td>
                                                                                <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$row[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                                                                <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                                                                    <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan.php?menu_id=39&mode=1&id=<?php echo "$row[Penghapusan_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_hapus.php?id=<?php echo "$row[Penghapusan_ID]";?>">Hapus</a> || <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_edit.php?id=<?php echo "$row[Penghapusan_ID]";?>">Edit</a>
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
                                                  </td>
                                                 </tr>
                                               </table>

                                                </div>
                                        </div>
                                </div>
                   
        <?php
            include"$path/footer.php";
        ?>
</body>
</html>	
