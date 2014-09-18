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
                          <script type="text/javascript" charset="utf-8">
							$(document).ready(function() {
								$('#example').dataTable( {
									"aaSorting": [[ 1, "asc" ]]
								} );
							} );
						</script>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_filter.php"><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
                            <!-- Begin frame -->
								<table width='100%' border='0' style="border-collapse:collapse;border: 0px solid #dddddd;">
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
								<br>	
                            <div id="demo">
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
									<thead>
									<tr>
                                        <th width="15px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl SKKDH</th>
                                        <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                    </tr>
								</thead>     
                                    <?php
                                    
                                    //sementara
                                    $query = "select distinct Penggunaan_ID from PenggunaanAset where StatusMenganggur = 1 or StatusMutasi = 1";
                                    //pr($query);
                                    $result  = mysql_query($query) or die (mysql_error());
                                    while ($dataNew = mysql_fetch_object($result))
                                    {
                                        $dataArr[] = $dataNew->Penggunaan_ID;
                                    }
                                        
                                        //echo '<pre>';
                                        //print_r($dataArr);   
                                        
                                        
                                        $paging = $LOAD_DATA->paging($_GET['pid']);
                                       unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                        $data = $RETRIEVE->retrieve_daftar_validasi_penggunaan($parameter);
                                        
                                        //if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;
                                        $no=1;
                                        
                                        
                                        
                                        foreach($data['dataArr'] as $key => $hsl_data){
                                            if($dataArr!="")
                                            {
                                                (in_array($hsl_data['Penggunaan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
                                            }
                                            
                                    ?>
                                    <tr>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: ;"><?php echo "$no.";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$hsl_data['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;">
                                            <!--<a href="<?php echo "$url_rewrite/report/template/PENGGUNAAN/";?>tes_class_penetapan_aset_yang_digunakan_validasi.php?menu_id=31&mode=1&id=<?php echo "$hsl_data[Penggunaan_ID]";?>" target="_blank">Cetak</a> ||-->
											<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Penggunaan_ID]";?>" onclick="<?=$disable?> " >Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $no++; 
                                    //$pid++; 
                                    } }?>
                            </table>
                            </div>
                            <tfoot></tfoot>
							<div class="spacer"></div>
							<!-- End Frame -->	
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
