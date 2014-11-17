<?php
    include "../../config/config.php";
    include"$path/header.php";
    include"$path/title.php";
    
    $menu_id = 47;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    
        $tgl_awal=$_POST['buph_pph_tanggalawal'];
        $tgl_akhir=$_POST['buph_pph_tanggalakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan=$_POST['buph_pph_noskpemusnahan'];
        $lokasi=$_POST['lokasi_id'];
        $submit=$_POST['tampil_filter'];

        //open_connection();
        
       /*
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoBAPemusnahan LIKE '%$no_penetapan%'";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
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
        * 
        */
            
            if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan=="" && $lokasi==""){
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
	
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
	<div id="content">
                        <?php
                            include"$path/menu.php";
                          ?>
	</div>
                            <div id="tengah1">	
                                    <div id="frame_tengah1">
                                            <div id="frame_gudang">
                                                    <div id="topright">
                                                            Penetapan Pemusnahan
                                                    </div>
                                                            <div id="bottomright">
                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td width="50%" align="left" style="border:0px;">
                                                                                <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter" onclick="document.location='<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_filter.php'">
                                                                            </td>
                                                                            <td width="50%" align="right" style="border:0px;">
                                                                                <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data" onclick="window.location='<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_tambah_aset.php'">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                
                                                                    <!-- Begin frame -->
														<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
															<tr>
																<td colspan ="3" align="right">
																	<table border="0" width="100%">
																		<tr>
																			<td align="right" width="200px">
																					<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
																					<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
																					<span><input type="button" value="<< Prev" class="buttonprev"/>
																					Page
																					<input type="button" value="Next >>" class="buttonnext"/></span>
																				
																			</td>
																		</tr>
																	</table>
																</td>
															</tr>
														</table>
														<div id="demo">
							
																<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="background-color: #eeeeee; border: 2px solid #dddddd;" width='20px'>No</th>
                                                                                <th width="100px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Nomor Pemusnahan</th>
                                                                                <th width="100px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Tgl Pemusnahan</th>
                                                                                <th width="40px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Tindakan</th>
                                                                            </tr>
																		</thead>
																		<tbody>
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
                                                                            
                                                                                if($parameter_sql!="" ) {
                                                                                $query="SELECT * FROM BAPemusnahan WHERE $parameter_sql AND FixPemusnahan=1 AND Status=0 limit $offset, $jmlperhalaman";
                                                                                $exec = mysql_query($query) or die(mysql_error());
                                                                                
                                                                                $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM BAPemusnahan WHERE $parameter_sql AND FixPemusnahan=1 AND Status=0"),0);
                                                                                }

                                                                                if($parameter_sql=="" ) {
                                                                                $query="SELECT * FROM BAPemusnahan WHERE FixPemusnahan=1 AND Status=0 limit $offset, $jmlperhalaman";
                                                                                $exec = mysql_query($query) or die(mysql_error());
                                                                                
                                                                                $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM BAPemusnahan WHERE FixPemusnahan=1 AND Status=0"),0);
                                                                                }
                                                                                $i=1;
                                                                                while($row=mysql_fetch_array($exec)){
                                                                             * 
                                                                             */
                                                                            
                                                                            $paging = $LOAD_DATA->paging($_GET['pid']);
                                                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
            
                                                                        if (isset($submit))
                                                                                            {
                                                                                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                                                                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
                                                                                                        $data = $RETRIEVE->retrieve_daftar_penetapan_pemusnahan($parameter);
                                                                                            } else {
                                                                        
                                                                        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
                                                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
                                                                        $data = $RETRIEVE->retrieve_daftar_penetapan_pemusnahan($parameter);
																		}
                                                                        echo '<pre>';
                                                                        //print_r($data['dataArr']);
                                                                        echo '</pre>';
                                                                        
                                                                        $nomor = 1;
                                                                        if (!empty($data['dataArr']))
                                                                        {
                                                                            $disabled = '';
                                                                            $pid = 0;
                                                                        foreach($data['dataArr'] as $key => $row)
                                                                            {
                                                                            ?>
                                                                            <tr>
                                                                                <td align="center" style="border: 2px solid #dddddd;"><?php echo "$nomor";?></td>
                                                                                <td align="center" style="border: 2px solid #dddddd;"><?php echo "$row[NoBAPemusnahan]";?></td>
                                                                                <td align="center" style="border: 2px solid #dddddd;"><?php $change=$row['TglBAPemusnahan']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                                                                <td align="center" style="border: 2px solid #dddddd;">
                                                                                    <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_daftar_hapus.php?id=<?php echo "$row[BAPemusnahan_ID]";?>">Hapus</a> || <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_daftar_edit.php?id=<?php echo "$row[BAPemusnahan_ID]";?>">Edit</a>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $nomor++;} }?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
																		<div class="spacer"></div>
															<!-- End Frame -->
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
                    
           <?php
                include"$path/footer.php";
           ?>
    </body>
</html>	
