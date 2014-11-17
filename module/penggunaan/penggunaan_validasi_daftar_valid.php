<?php
include "../../config/config.php";

     $menu_id = 31;
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
			  <li><a href="#">Penggunaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active"> Daftar Validasi Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Validasi Barang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_filter.php" class="btn">
									   Kembali ke halaman utama : Form Filter
								 </a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar.php?pid=1" class="btn">
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
						<th>No</th>
						<th>Nomor SKKDH</th>
						<th>Tgl SKKDH</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
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
						  
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td><?php echo "$hsl_data[NoSKKDH]";?>	</td>
						<td><?php $change=$hsl_data['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Penggunaan_ID]";?>" onclick="<?=$disable?> " >Hapus</a></td>
					</tr>
					 <?php $no++; 
					//$pid++; 
					} }?>
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