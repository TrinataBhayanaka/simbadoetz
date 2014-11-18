<?php
include "../../config/config.php";

    $menu_id = 48;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        ?>   

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemusnahan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Validasi Barang Pemusnahan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Validasi Barang Pemusnahan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_lanjut.php?pid=1" class="btn">
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
						<th>Nomor BA Pemusnahan</th>
						<th>BA Pemusnahan</th>
						<th>Penandatangan</th>
						<th>Tindakan</th>
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
					<tr class="gradeA">
						<td><?php echo "$nomor";?></td>
						<td><?php echo "$hsl_data[NoBAPemusnahan]";?></td>
						<td>
							<?php $change=$hsl_data[TglBAPemusnahan]; $change2=  format_tanggal_db3($change); echo "$change2";?>
						</td>
						<td><?php echo "$hsl_data[NamaPenandatangan]";?></td>
						<td>	
							<a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_validasi_daftar_valid.php?id=$hsl_data[BAPemusnahan_ID]&mode=1&parameter=$param";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>pemusnahan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[BAPemusnahan_ID]";?>">Hapus</a>
						</td>
					</tr>
					
				     <?php $nomor++;} }?>
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