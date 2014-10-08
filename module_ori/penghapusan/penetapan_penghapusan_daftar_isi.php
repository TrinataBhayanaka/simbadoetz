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
                                                        Penetapan Penghapusan
                                                </div>
                                                    <div id="bottomright">
																	<?php
																		// pr($_SESSION);    
																		$paging = $LOAD_DATA->paging($_GET['pid']);    
            
                                                                        if (isset($submit))
																		{
																			unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
																			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
																			$data = $RETRIEVE->retrieve_daftar_penetapan_penghapusan($parameter);
																		}else{
                                                                        
																			$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
																			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
																			$data = $RETRIEVE->retrieve_daftar_penetapan_penghapusan($parameter);
																		}
																		// pr($data);
																	?>
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
																	<br>
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
                                                                                <th style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SK Penghapusan</th>
                                                                                <th style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl Penghapusan</th>
                                                                                <th style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
                                                                            </tr>
																		</thead>
																		<tbody>
                                                                            <?php
                                                                            
                                                                         '<pre>';
                                                                        //print_r($data['dataArr']);
                                                                        echo '</pre>';
                                                                        
																		$nomor = 1;
                                                                        if (!empty($data['dataArr']))
                                                                        {
                                                                           
                                                                        foreach($data['dataArr'] as $key => $row)
                                                                            {
                                                                            ?>
                                                                            <tr>
                                                                                <td align="center" style="border: 1px solid #dddddd;"><?php echo "$nomor";?></td>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$row[NoSKHapus]";?></td>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php $change=$row[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                                                                <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;">
                                                                                    <!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan.php?menu_id=39&mode=1&id=<?php echo "$row[Penghapusan_ID]";?>" target="_blank">Cetak</a> ||--> 
																					<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_edit.php?id=<?php echo "$row[Penghapusan_ID]";?>">Edit</a> ||
																					<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_hapus.php?id=<?php echo "$row[Penghapusan_ID]";?>">Hapus</a>  
																				</td>
                                                                            </tr>
                                                                            <?php $nomor++;} }?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
																			<div class="spacer"></div>
																<!-- End Frame -->
                                                                
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
