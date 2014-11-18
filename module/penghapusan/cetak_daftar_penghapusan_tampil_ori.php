<?php
 include "../../config/config.php";
    include"$path/header.php";
   include"$path/title.php";
   
    $no_penghapusan=$_POST['bup_cdp_pu_noskpenghapusan'];
    $tgl_penghapusan=$_POST['bup_cdp_pu_tglskpenghapusan'];
    $satker=$_POST['skpd_id'];
    $submit=$_POST['tampil'];
    
    $menu_id = 41;
    $SessionUser = $SESSION->get_session_user();
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    if (isset($submit)){
                if ($no_penghapusan=="" && $tgl_penghapusan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite"; ?>/module/penghapusan/cetak_daftar_penghapusan_filter.php";
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
		$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": []
				} );
			} );
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
                                                            Cetak Daftar Penghapusan
                                                    </div>
                                                            <div id="bottomright">
                                                                   
																	<?php
																		$paging = $LOAD_DATA->paging($_GET['pid']);    

                                                                                if (isset($submit))
																				{
																					unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
																					$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
																					$data = $RETRIEVE->retrieve_daftar_cetak_penetapan_penghapusan($parameter);
																				}else{
																					$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
																					$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
																					$data = $RETRIEVE->retrieve_daftar_cetak_penetapan_penghapusan($parameter);
																				}
																	?>
																	<table width='100%' border='0' style="border-collapse:collapse;border: 0px solid #dddddd;">
																		<tr>
																			<td colspan ="3" align="right">
																				<table border="0" width="100%">
																					<tr>
																						<td align=left>
																							<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>cetak_daftar_penghapusan_filter.php"><input type="submit" value="Kembali ke Form Filter"></a>
																						</td>
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
                                                                                <th width="15px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                                                                <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SK Penghapusan</th>
                                                                                <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl Penghapusan</th>
                                                                                <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan</th>
                                                                                <th width="40px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                                                            </tr>
																		</thead>
																		<tbody>				
                                                                            <?php

                                                                                
																			$page = @$_GET['pid'];
																			if ($page > 1){
																				$no = intval($page - 1 .'01');
																			}else{
																				$no = 1;
																			}
																			if (!empty($data['dataArr']))
																			{
																			foreach($data['dataArr'] as $key => $hsl_data)
																			{    
                                                                            ?>
                                                                            <tr>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$no.";?></td>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$hsl_data[NoSKHapus]";?></td>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php $change=$hsl_data[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$hsl_data[AlasanHapus]";?></td>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;">
                                                                                    <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan_validasi.php?menu_id=41&mode=1&id=<?php echo "$hsl_data[Penghapusan_ID]";?>" target="_blank">Cetak</a>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $no++; } }?>
                                                                        </tbody>
																		<tfoot></tfoot>
                                                                    </table>
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
