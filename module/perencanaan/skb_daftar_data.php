<?php
include "../../config/config.php";
$menu_id = 4;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
if (isset($_POST['submit']))
{
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	
	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	$get_data_filter = $RETRIEVE->retrieve_skb_filter(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
} else {
		$sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
		$get_data_filter = $RETRIEVE->retrieve_skb_filter(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
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
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Buat Standar Kebutuhan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Standar Kebutuhan Barang</div>
				<div class="subtitle">Daftar data</div>
			</div>		
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb_tambah_data.php" class="btn">
								Tambah Data</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>skb_filter.php" class="btn">
									   Kembali ke halaman utama : Form Filter
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
						<th>Nama/Jenis Barang</th>
						<th>SKPD</th>
						<th>Lokasi</th>
						<th>Tanggal</th>
						<th>Jumlah Barang</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
					
					if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
					if (!empty($get_data_filter))
					{
						$disabled = '';
					//$no = 1;
					$pid = 0;
					$check=0;
					
					foreach ($get_data_filter as $key => $hsl_data)

				//while($hsl_data=mysql_fetch_array($exec))
					{
				?>
						  
					<tr class="gradeA">
						<td><?php echo $no;?></td>
						<td><?php echo show_kelompok($hsl_data->skb_njb);?></td>
						<td><?php echo show_skpd($hsl_data->skb_skpd);?></td>
						<td><?php echo show_lokasi($hsl_data->skb_lokasi);?></td>
						<td>	
							<?php
								$tanggal=explode("-",$hsl_data->skb_tgl);
								$tgl=$tanggal[2]."/".$tanggal[1]."/".$tanggal[0];
								echo $tgl;
							?>
						</td>
						<td><?php echo $hsl_data->skb_jml;?></td>
						<td>	
								<form method="POST" action="skb_edit_data.php" onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->skb_njb);?> ini ingin diedit?'); ">
									<input type="hidden" name="ID" value="<?php echo $hsl_data->skb_id;?>" id="ID_<?php echo $i?>">
									<input type="submit" value="Edit" class="btn btn-primary" name="edit"/>
								</form>
								<form method="POST" action="skb-proses.php" onsubmit="return confirm('Apakah data nama/jenis barang = <?php echo show_kelompok($hsl_data->skb_njb);?> ini ingin dihapus?'); ">
									<input type="hidden" name="ID" value="<?php echo $hsl_data->skb_id;?>" id="ID_<?php echo $i?>">
									<input type="submit" value="Hapus" class="btn btn-danger" name="submit_hapus"/>
								</form>
						</td>
					</tr>
					
				     <?php
						$no++;
						$pid++;
					 }
				}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
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