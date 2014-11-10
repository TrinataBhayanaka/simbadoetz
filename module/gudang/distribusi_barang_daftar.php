<?php
include "../../config/config.php";
$menu_id = 15;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
$get_data_filter = $RETRIEVE->retrieve_distribusiBarang($_POST);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Distribusi Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Distribusi Barang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Jumlah Data: <?=$get_data_filter['total']?></span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/gudang/distribusi_barang.php";?>" class="btn btn-small">
									   Kembali ke halaman utama : Form Filter
								 </a>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			<p><a href="distribusi_barang_eksekusi_data.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Data</a>
				&nbsp;</p>
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor Dokumen</th>
						<th>Transfer ke SKPD</th>
						<th>Tanggal Distribusi</th>
						<th>Detail Distribusi Barang</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>		
							 
						
			<?php
				if (!empty($get_data_filter['data']))
				{
				
					$nomor = 1;
					// pr($get_data_filter);
					foreach ($get_data_filter['data'] as $key => $hsl_data)
					{
						list($tahun, $bulan, $tanggal)= explode('-', $hsl_data->TglTransfer);
					
					$queryFromSatker = "SELECT NamaSatker FROM satker WHERE Satker_ID = '{$hsl_data->ToSatker_ID}'";
					$resultFromSatker = $DBVAR->query($queryFromSatker) or die ($DBVAR->error());
					$dataFromSatker = $DBVAR->fetch_array($resultFromSatker);
					?>

						  
					<tr class="gradeA">
						<td><?php echo $nomor?></td>
						<td>
							<?=$hsl_data->NoDokumen?>
						</td>
						<td>
							<?=$dataFromSatker[NamaSatker]?>
						</td>
						<td>
							<?=$tanggal."/".$bulan."/".$tahun?>
						</td>
						<td>
							<?=$hsl_data->InfoTransfer?>
						</td>
						<td>	
						<a href='<?=$url_rewrite."/module/gudang/distribusi_barang_daftar_edit.php?id=".$hsl_data->NoDokumen?>&pid=1'> Edit </a> 
						|| <a href="<?=$url_rewrite."/module/gudang/distribusi_barang_eksekusi_data_tambah_hapus.php?id=".$hsl_data->NoDokumen?>&pid=1" onclick="return confirm('Hapus Data ?');"> Hapus </a>
						</td>
					</tr>
					<?php
							$nomor++;
						}
					}
					else
					{
						$disabled = 'disabled';
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