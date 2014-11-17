<?php
        
    include "../../config/config.php";
    
    $menu_id = 48;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        ?>   

<html>
    <?php
        include "$path/header.php";
    ?>
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
                include "$path/title.php";
                include "$path/menu.php";
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Daftar Validasi Barang Pemusnahan
                        </div>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_lanjut.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
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
                                        <th style="background-color: #eeeeee; border: 2px solid #dddddd;">Nomor BA Pemusnahan</th>
                                        <th style="background-color: #eeeeee; border: 2px solid #dddddd;">Tgl BA Pemusnahan</th>
                                        <th style="background-color: #eeeeee; border: 2px solid #dddddd;">Nama Penandatangan</th>
                                        <th style="background-color: #eeeeee; border: 2px solid #dddddd;">Tindakan</th>
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
                                                
                                            $query2="SELECT * FROM BAPemusnahan where FixPemusnahan=1 and Status=1 limit $offset, $jmlperhalaman";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                            
                                            $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM BAPemusnahan where FixPemusnahan=1 and Status=1"),0);
                                        //}
                                        
                                        //$check = mysql_num_rows($exec);
                                        
                                        $i=1;
                                        while($hsl_data=mysql_fetch_array($exec2)){
                                     * 
                                     */
                                    $paging = $LOAD_DATA->paging($_GET['pid']);
                                       unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                        $data = $RETRIEVE->retrieve_daftar_validasi_pemusnahan($parameter);
                                        
												$nomor = 1;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;
                                        $i=1;
                                        foreach($data['dataArr'] as $key => $hsl_data){
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 2px solid #dddddd;"><?php echo "$nomor";?></td>
                                        <td align="center" style="border: 2px solid #dddddd; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoBAPemusnahan]";?></td>
                                        <td align="center" style="border: 2px solid #dddddd; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data[TglBAPemusnahan]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 2px solid #dddddd; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NamaPenandatangan]";?></td>
                                        <td align="center" style="border: 2px solid #dddddd; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_validasi_daftar_valid.php?id=$hsl_data[BAPemusnahan_ID]&mode=1&parameter=$param";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>pemusnahan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[BAPemusnahan_ID]";?>">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $nomor++;} }?>
                                </tbody>
                            </table>	
							
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
        </div>
        <?php
include"$path/footer.php";
?>
    </body>
</html>	
