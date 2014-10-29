<?php
include "../../config/config.php";

        
     $menu_id = 44;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
			// echo"masukk";
        // exit;
		?>   
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemindahtanganan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Validasi Barang Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Validasi Barang Pemindahtanganan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php
							$paging = $LOAD_DATA->paging($_GET['pid']);
							unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
							$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
							$data = $RETRIEVE->retrieve_daftar_validasi_pemindahtanganan($parameter);
							?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_filter_pemindahtanganan.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan.php?pid=1" class="btn">
								Tambah Data</a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$data['count']?>">
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
                                        
						//$hsl_data=mysql_fetch_array($exec);
						
					   
						
						//$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
						//$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
						//$data = $RETRIEVE->retrieve_daftar_validasi_pemindahtanganan($parameter);

							
							if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
								if (!empty($data['dataArr']))
								{
									$disabled = '';
									$pid = 0;
						$i=1;
						foreach($data['dataArr'] as $key => $hsl_data){
					?>
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td>
							<?php echo "$hsl_data[NoBASP]";?>
						</td>
						<td><?php $change=$hsl_data[TglBASP]; $change2=  format_tanggal_db3($change); echo "$change2";?>
						<td>	
						<?php echo "$hsl_data[LokasiBASP]";?>
						</td>
						<td>
							 <!--<a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/";?>tes_class_penetapan_aset_yang_dipindahkan_validasi.php?menu_id=44&mode=1&id=<?php echo "$hsl_data[BASP_ID]";?>" target="_blank">Cetak</a> ||-->
							<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[BASP_ID]";?>">Hapus</a>
						</td>
					</tr>
					
				     <?php $no++; $pid++; }}?>
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