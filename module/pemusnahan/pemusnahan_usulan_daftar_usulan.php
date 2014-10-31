<?php
include "../../config/config.php";

        $menu_id = 46;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $paging = $LOAD_DATA->paging($_GET['pid']);
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
			  <li class="active">Daftar Usulan Pemusnahan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Usulan Pemusnahan Barang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_lanjut.php?pid=1" class="btn">
								Tambah Data</a>
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
						<td align="right">
							<span><input type="submit" name="submit" value="Usul Pemusnahan" id="submit" disabled/></span>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>Nomor Usulan</th>
						<th>Tgl Usulan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
						unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
						
						$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
						$data = $RETRIEVE->retrieve_daftar_usulan_pemusnahan($parameter);

						//print_r($data['dataArr']);
							$nomor = 1;
							if (!empty($data['dataArr']))
							{
								$disabled = '';
								$pid = 0;    
				
				/*
						$query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='MSN' limit 10";
						$exec2 = mysql_query($query2) or die(mysql_error());
					
					
					$i=1;
					while($hsl_data=mysql_fetch_array($exec2)){
				 * 
				 */
				 
				 //sementara
						$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'MSN'";
						$result  = mysql_query($query) or die (mysql_error());
						while ($dataNew = mysql_fetch_object($result))
						{
							$dataArr[] = $dataNew->Usulan_ID;
						}
						
				foreach($data['dataArr'] as $key => $hsl_data){
					
					if($dataArr!="")
							{
								(in_array($hsl_data['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
							}
				?>
					<tr class="gradeA">
						<td><?php echo "$nomor";?></td>
						<td><?php echo "$hsl_data[Usulan_ID]";?></td>
						<td><?php $change=$hsl_data['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>
							 <a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_untuk_dimusnahkan.php?id=$hsl_data[Usulan_ID]&menu_id=46&mode=1";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>pemusnahan_usulan_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Usulan_ID]";?>" onclick="<?=$disable?> ">Hapus</a>
						</td>
					</tr>
					  <?php $nomor++;}}?>
				</tbody>
				<tfoot>
					<tr>
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