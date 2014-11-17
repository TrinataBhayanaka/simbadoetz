
<?php
        
    include "../../config/config.php";
    include "$path/header.php";
    include "$path/title.php";
    
    $menu_id = 30;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

        $tgl_awal=$_POST['tglawal'];
        $tgl_akhir=$_POST['tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$_POST['nopenet'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil'];
            
            
      if (isset($submit)){
            if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_penggunaan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php";
                            }
                </script>
        <?php
            }
        }
        ?>
          

<html>
    <body>
        <div id="content">
            <?php
                include "$path/menu.php";
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Penetapan Penggunaan
                        </div>
							<script type="text/javascript" charset="utf-8">
								$(document).ready(function() {
									$('#example').dataTable( {
										"aaSorting": []
									} );
								} );
								/*$('#example').dataTable( {
								  "aoColumnDefs": [
									  { 'bSortable': false, 'aTargets': [ 1 ] }
								   ]
							});*/
							</script> 
                        
                        
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter2.php"><input type="submit" value="Tambah Data"></a>
                            </div>
                            <?php
								$offset = @$_POST['record'];
								$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi'";
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
									
							$paging = $LOAD_DATA->paging($_GET['pid']);    
							// pr($_SESSION);
							if (isset($_POST['tampil']))
							{
								// echo "masukk";
								unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
								$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
								$data = $RETRIEVE->retrieve_daftar_penetapan_penggunaan($parameter);
							}else{
								$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
								$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
								$data = $RETRIEVE->retrieve_daftar_penetapan_penggunaan($parameter);
							}
							
							
							?>
							
							<!-- Begin frame -->
							<table width='100%' border='0' style="border-collapse:collapse;border: 0px solid #;">
								<tr>
									<td colspan ="3" align="right">
										<table border="0" width="100%">
											<tr>
												
												<td align="right" width="200px">
														<div align="right">
														<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
														<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
														<span><input type="button" value="<< Prev" class="buttonprev"/>
														Page
														<input type="button" value="Next >>" class="buttonnext"/></span>
														</div>
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
                                    <tr style="">
                                        <th width="5px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl SKKDH</th>
                                        <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    if (!empty($data['dataArr']))
                                    {
                                        $disabled = '';
                                        // $pid = 0;
                                        // $no = 1;
									// pr($data);	
									$page = @$_GET['pid'];
									if ($page > 1){
										$no = intval($page - 1 .'01');
									}else{
										$no = 1;
									}
                                    foreach($data['dataArr'] as $key => $hsl_data)
                                        {
                                    ?>
                                    <tr>

                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$no.";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$hsl_data['TglSKKDH']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;">

                                            <!--<a href="<?php echo "$url_rewrite/report/template/PENGGUNAAN/";?>tes_class_penetapan_aset_yang_digunakan.php?menu_id=30&mode=1&id=<?php echo "$hsl_data[Penggunaan_ID]";?>" target="_blank">Cetak</a> ||--> 
											<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_daftar_edit.php?id=<?php echo "$hsl_data[Penggunaan_ID]";?>">Edit</a> ||
											<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Penggunaan_ID]";?>">Hapus</a>  
											
									   </td>
                                    </tr>
                                    <?php 
										$no++; 
										// $pid++; 
										} 
									  }
									?>
									
								</table>
								
								<tfoot>
								</tfoot>
                            </div>
							<div class="spacer"></div>
							<!-- End Frame -->
	
                            &nbsp; 
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
