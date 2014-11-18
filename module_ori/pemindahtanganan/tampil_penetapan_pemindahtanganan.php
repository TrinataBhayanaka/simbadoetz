<?php
include "../../config/config.php";
include "$path/header.php";
include "$path/title.php";

$menu_id = 43;
$SessionUser = $SESSION->get_session_user();
//($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

// pr($_POST);
unset($_SESSION['parameter_sql']);
$bupt_ppt_tanggalawal = $_POST['bupt_ppt_tanggalawal'];
$bupt_ppt_tanggalakhir = $_POST['bupt_ppt_tanggalakhir'];
$tgl_awal_fix=format_tanggal_db2($bupt_ppt_tanggalawal);
$tgl_akhir_fix=format_tanggal_db2($bupt_ppt_tanggalakhir);
$bupt_ppt_noskpemindahtanganan = $_POST['bupt_ppt_noskpemindahtanganan'];
$satker = $_POST['skpd_id'];
$submit = $_POST['tampil_filter'];

$paging = paging($_GET['pid'], 100);    
            
if (isset($submit))
{
	// echo "ada posting";
	unset($_SESSION['parameter_sql']);
	$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
	$data = $RETRIEVE->retrieve_daftar_penetapan_pemindahtanganan($parameter);
}else{
	// echo "ga ada posting";
	// pr($_SESSION['parameter_sql']);
	// $sessi = $_SESSION['parameter_sql'];
	unset($_SESSION['parameter_sql']);
	$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
	$data = $RETRIEVE->retrieve_daftar_penetapan_pemindahtanganan($parameter);
}

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
										Penetapan Pemindahtanganan
								</div>
								<div id="bottomright">
									<script type="text/javascript" charset="utf-8">
									$(document).ready(function() {
										$('#example').dataTable( {
											"aaSorting": []
										} );
									} );
								</script>
									<table width="100%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td width="50%" align="left" style="border:0px;">
												<input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter" onclick="document.location='<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>penetapan_pemindahtanganan.php'">
											</td>
											<td width="50%" align="right" style="border:0px;">
												<input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data" onclick="window.location='<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tambah_aset_pemindahtanganan.php'">
											</td>
										</tr>
									</table>
									<br>
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
												<th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor Pemindahtanganan</th>
												<th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl Pemindahtanganan</th>
												<th width="200px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Lokasi Pemindahtanganan</th>
												<th width="100px" align="center" style=" background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
											</tr>
										</thead>
										<tbody>		
										<?php
											if (!empty($data['dataArr']))
											{
												$nomor = 1;
												$page = @$_GET['pid'];
												if ($page > 1){
													$nomor = intval($page - 1 .'01');
												}else{
													$nomor = 1;
												}
												foreach($data['dataArr'] as $key => $value)
													{
										   
											?>
											<tr>
												<td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$nomor.";?></td>
												<td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo $value['NoBASP'];?></td>
												<td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php $change=$value['TglBASP']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
												<td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo $value['LokasiBASP'];?></td>
												<td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;">
													<!--<a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/";?>tes_class_penetapan_aset_yang_dipindahkan.php?menu_id=43&mode=1&id=<?php echo $value['BASP_ID'];?>" target="_blank">Cetak</a> || -->
													<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tampil_pemindahtanganan_daftar_edit.php?id=<?php echo $value['BASP_ID'];?>">Edit</a> || 
													<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tampil_pemindahtanganan_daftar_hapus.php?id=<?php echo $value['BASP_ID'];?>">Hapus</a> 
													
												</td>
											</tr>
											<?php $nomor++; }} ?>
										</tbody>
										<tfoot></tfoot>
									</table>
									</div>
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
