<?php
        
    include "../../config/config.php";
    
    $menu_id = 40;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

        /*$tgl_awal=$_POST['penggu_penet_filt_tglawal'];
        $tgl_akhir=$_POST['penggu_penet_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$_POST['penggu_penet_filt_nopenet'];
        $satker=$_POST['kelompok'];
        $submit=$_POST['tampil'];
     */   
        
        /*$submit2=$_POST['penggunaan_eks'];*/
        
        //open_connection();
        
       
            /*if ($tgl_awal!=""){
            $query_tgl_awal="Tgl_SKKDH='".$tgl_awal."' ";
            }
            if($tgl_akhir!=""){
            $query_tgl_akhir="Tgl_SKKDH='".$tgl_akhir."' ";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH='".$no_penetapan_penggunaan."' ";
            }
            if($satker!=""){
                $query_satker="NamaSatker='".$satker."' ";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_akhir;
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker;
            }
            
            echo "$parameter_sql";
            
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql ." AND Penggunaan_ID".;
            }*/
            
            
       /* if (isset($submit)){
            if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_penggunaan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php";
                            }
                </script>
        <?php
            }
        }*/
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
                            Daftar Validasi Barang Penghapusan
                        </div>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_lanjut.php?pid=1"><input type="submit" value="Tambah Data"></a>
                            </div>
                            <?php 
								$paging = $LOAD_DATA->paging($_GET['pid']);
								unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
								$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
								$data = $RETRIEVE->retrieve_daftar_validasi_penghapusan($parameter);
                                // pr($data);        
							
							?>
                            <!-- Begin frame -->
								<table width='100%' border='0' style="border-collapse:collapse;border: 0px solid #dddddd;">
									<tr>
										<td colspan ="3" align="right">
											<table border="0" width="100%">
												<tr>
													
													
													<td align="right" width="200px">
															<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
															<input type="hidden" class="hiddenrecord" value="<?php echo @$data['count']?>">
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
                                        <th style="background-color: #eeeeee; border: 1px solid #dddddd;" width='20px'>No</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SK Penghapusan</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl Penghapusan</th>
                                        <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan</th>
                                        <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                    </tr>
								</thead>
								<tbody>
                                    <?php
										
										if (!empty($data['dataArr']))
										{
                                        $page = @$_GET['pid'];
										if ($page > 1){
											$no = intval($page - 1 .'01');
										}else{
											$no = 1;
										}          
                                        foreach($data['dataArr'] as $key => $hsl_data){
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #dddddd;"><?php echo "$no";?></td>
                                        <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$hsl_data[NoSKHapus]";?></td>
                                        <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php $change=$hsl_data[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$hsl_data[AlasanHapus]";?></td>
                                        <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;">
                                            <!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan_validasi.php?menu_id=40&mode=1&id=<?php echo "$hsl_data[Penghapusan_ID]";?>" target="_blank">Cetak</a> ||--> 
											<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Penghapusan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $nomor++; } }?>
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
