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
						<th>Detail</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>		
					<?php
						$i = 1;
						if($get_data_filter['data'])
						{
							foreach ($get_data_filter['data'] as $key => $value) {
					?>
							<tr class="gradeA">
								<td><?=$i++?></td>
								<td><?=$value['noDokumen']?></td>
								<td><?=$value['toSatker']?></td>
								<td><?=$value['tglDistribusi']?></td>
								<td><?=$value['alasan']?></td>
								<td class="text-center">
									<a href="kontrak_rincianhapus.php?id=<?=$value['Aset_ID']?>&tmpthis=<?=$_GET['id']?>" class="btn btn-warning btn-small"><i class="fa fa-pencil"></i>&nbsp;Edit</a>
									<a href="distribusi_rinc.php?id=<?=$value['id']?>" class="btn btn-success btn-small" ><i class="fa fa-edit"></i>&nbsp;Rincian</a>
									<a href="distribusi_barang_eksekusi_data_tambah_hapus.php?id=<?=$value['id']?>" class="btn btn-danger btn-small" onclick="return confirm('Hapus Aset?')"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
								</td>
							</tr>
					<?php			
							}

							
						}	
					?>		 
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6"></th>
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