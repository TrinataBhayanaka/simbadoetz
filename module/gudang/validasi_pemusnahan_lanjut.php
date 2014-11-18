    <?php
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        $menu_id = 48;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $no_penetapan=$_POST['buph_val_noskpemusnahan'];
        $tgl_penetapan_awal=$_POST['buph_val_tgl_awal'];
        $tgl_awal_fix=format_tanggal_db2($tgl_penetapan_awal);
        $tgl_penetapan_akhir=$_POST['buph_val_tgl_akhir'];
        $tgl_akhir_fix=format_tanggal_db2($tgl_penetapan_akhir);
        $lokasi=$_POST['lokasi_id'];
        $submit=$_POST['tampil_filter'];
        
        
        $paging = $LOAD_DATA->paging($_GET['pid']);    
        $ses_uid=$_SESSION['ses_uid'];

        if (isset($submit))
                            {
                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging,'ses_uid'=>$ses_uid);
                                        $data = $RETRIEVE->retrieve_validasi_pemusnahan($parameter);
                            }

        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging,'ses_uid'=>$ses_uid);
        $data = $RETRIEVE->retrieve_validasi_pemusnahan($parameter);

        echo '<pre>';
        print_r($data);
        echo '</pre>';
        
        
         
        
        if (isset($submit)){
                if ($no_penetapan=="" && $tgl_penetapan_awal=="" && $tgl_penetapan_akhir=="" && $lokasi==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_filter.php";
                            }
                    </script>
    <?php
            }
        }
    ?>

<html>
        <body onload="enable()">
		<form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_proses.php">
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
		
                        <script language="Javascript" type="text/javascript">  
                            function enable(){  
                            var tes=document.getElementsByTagName('*');
                            var button=document.getElementById('submit');
                            var boxeschecked=0;
                            for(k=0;k<tes.length;k++)
                            {
                                if(tes[k].className=='checkbox')
                                    {
                                        //
                                        tes[k].checked == true  ? boxeschecked++: null;
                                    }
                            }
                            //alert(boxeschecked);
                            if(boxeschecked!=0)
                                button.disabled=false;
                            else
                                button.disabled=true;
                            }
							function enable_submit(){
							var enable = document.getElementById('pilihHalamanIni');
							var button = document.getElementById('submit');
								if(enable){
									button.disabled = false;
								}
							}
							function disable_submit(){
							var disable = document.getElementById('kosongkanHalamanIni');
							var button = document.getElementById('submit');
								if(disable){
									button.disabled = true;
								}
							}
                        </script>
            <div id="content">
                <?php
                    
                    include "$path/menu.php";
                ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Validasi Pemusnahan
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_filter.php"><input type="button" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>pemusnahan_validasi_daftar_valid.php?pid=1"><input type="button" value="Daftar Barang"></a>
                                </div>
                                <?php
								$offset = @$_POST['record'];
								$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemusnahan[]'";
										$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
										$data_apl = $DBVAR->fetch_object($result_apl);
										
										$array = explode(',',$data_apl->aset_list);
										
									foreach ($array as $id)
									{
										if ($id !='')
										{
										$dataAsetList[] = $id;
										}
									}
									
									if ($dataAsetList !='')
									{
										$explode = array_unique($dataAsetList);
									}
									
								?>
                                
                                <!-- Begin frame -->
								<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
									<tr>
										<td colspan ="3" align="right">
											<table border="0" width="100%">
												<tr>
													<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
													<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
													<td align="right">
													<span><input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/></span>
													</td>
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
                                            <th width="50px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Pilihan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Nomor BA Pemusnahan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Tanggal BA Pemusnahan</th>
                                            <th width="80px" align="center" style="background-color: #eeeeee; border: 2px solid #dddddd;">Nama Penandatangan</th>
                                        </tr>
                                </thead> 
								<tbody>
                                            <?php
                                        
                                                    $nomor = 1;
                                                    if (!empty($data['dataArr']))
                                                    {
                                                        $disabled = '';
                                                        $pid = 0;
                                                foreach($data['dataArr'] as $key => $value)
                                                    {    
                                            ?>
                                        <tr>
                                            <td align="center" style="border: 2px solid #dddddd;"><?php echo "$nomor";?></td>
                                            <td align="center" style="border: 2px solid #dddddd; height:100px; color: black; font-weight: bold;">
                                                <?php
												if (($_SESSION['ses_uaksesadmin'] == 1)){
													?>
													<input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPemusnahan[]" value="<?php echo $value['BAPemusnahan_ID'];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value['BAPemusnahan_ID']) echo 'checked';}?>/>
													<?php
												}else{
													if ($data['asetuser']){
													if (in_array($value->Aset_ID, $data['asetuser'])){
													?>
													<input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPemusnahan[]" value="<?php echo $value['BAPemusnahan_ID'];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value['BAPemusnahan_ID']) echo 'checked';}?>/>
													<?php
													}
												}
												}
												
												?>
                                            </td>
                                            <td align="center" style="border: 2px solid #dddddd; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$value[NoBAPemusnahan]";?></td>
                                            <td align="center" style="border: 2px solid #dddddd; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$value['TglBAPemusnahan']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="border: 2px solid #dddddd; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$value[NamaPenandatangan]";?></td>
                                        </tr>
                                        </tr>
                                                <?php $no++;}} ?>
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
                                </form>
                                    
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



