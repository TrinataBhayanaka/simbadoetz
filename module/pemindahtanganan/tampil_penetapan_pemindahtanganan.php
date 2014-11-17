<?php
include "../../config/config.php";

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
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemindahtangan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Pemindahtanganan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>penetapan_pemindahtanganan.php" class="btn">
								Kembali ke form filter</a>
								
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tambah_aset_pemindahtanganan.php" class="btn">
								Tambah Data
								 </a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor Pemindahtanganan</th>
						<th>Tgl Pemindahtanganan</th>
						<th>Lokasi Pemindahtanganan</th>
						<th>Tindakan</th>
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
						  
					<tr class="gradeA">
						<td><?php echo "$nomor.";?></td>
						<td>
							<?php echo $value['NoBASP'];?>
						</td>
						<td><?php $change=$value['TglBASP']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><?php echo $value['LokasiBASP'];?></td>
						<td>	
							<!--<a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/";?>tes_class_penetapan_aset_yang_dipindahkan.php?menu_id=43&mode=1&id=<?php echo $value['BASP_ID'];?>" target="_blank">Cetak</a> || -->
							<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tampil_pemindahtanganan_daftar_edit.php?id=<?php echo $value['BASP_ID'];?>">Edit</a> || 
							<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tampil_pemindahtanganan_daftar_hapus.php?id=<?php echo $value['BASP_ID'];?>">Hapus</a> 
						
						</td>
					</tr>
					<?php $nomor++; } } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>