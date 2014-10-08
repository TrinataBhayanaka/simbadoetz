<?php
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);

$get_data_filter = $RETRIEVE->retrieve_shpb_tambah_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>
 <script>
        function konfirmasiEdit(StandarHarga_ID,NamaAset)
	{
                                    var StandarHarga_ID = StandarHarga_ID;
		var NamaAset = NamaAset;
		var jawab;
		                 
		jawab = confirm("Apakah data '"+NamaAset+"' akan di Buat Pemeliharaan?")
		if(jawab)
		{
			window.location = "shpb_edit_data.php?idubah="+StandarHarga_ID;
			return false;
		}else{
			alert("Proses data dibatalkan");
		}
	}
         function konfirmasiHapus(StandarHarga_ID,NamaAset)
	{
                                    var StandarHarga_ID = StandarHarga_ID;
		var NamaAset = NamaAset;
		var jawab;
		                 
		jawab = confirm("Apakah data '"+NamaAset+"' akan di Hapus?")
		if(jawab)
		{
			window.location = "idhapus="+StandarHarga_ID;
			return false;
		}else{
			alert("Penghapusan data dibatalkan");
		}
	}
     </script>

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Buat Standar Harga Pemeliharaan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Standar Harga Pemeliharaan Barang</div>
				<div class="subtitle">Tambah Data </div>
			</div>	
		<section class="formLegend">
		
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_daftar_data.php" class="btn">
									   Kembali ke halaman daftar data
								 </a>
							</li>
							<li>
								   <ul class="pager">
										<li><a href="#" class="buttonprev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">Prev</a></li>
										<li><a href="#" class="buttonnext" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">Next</a></li>
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
						<th>Keterangan Jenis/Nama Barang</th>
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
						<td><?php echo $no;?> </td>
						<td>
							 <table align="center" width="100%">
								<tr>
									<td width="20%">Nama/Jenis Barang</td>
									<td><?php echo show_kelompok($hsl_data->Kelompok_ID);?></td>
								</tr>
								<tr>
									<td>Merk/Tipe</td>
									<td><?php echo $hsl_data->Merk;?></td>
								</tr>
								<tr>
									<td width="20%">Tanggal</td>
									<td>
									<?php 
									$tanggal=explode("-",$hsl_data->TglUpdate);
									$tgl=$tanggal[2]."/".$tanggal[1]."/".$tanggal[0];
									echo $tgl;
									?>		
									</td>
								</tr>
								<tr>
									<td>Spesifikasi</td>
									<td><?php echo $hsl_data->Spesifikasi;?></td>
								</tr>
								<tr>
									<td>Satuan</td>
									<td><?php echo $hsl_data->Satuan;?></td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td><?php echo $hsl_data->Keterangan;?></td>
								</tr>
								<tr>
									<td>Standar Harga</td>
									<td><?php echo number_format($hsl_data->NilaiStandar,2,',','.')?></td>
								</tr>
							</table>
						</td>
						<td>	
							<form method="POST" action="shpb_pemeliharaan.php?pid=1" onsubmit="konfirmasi(this)">
								<input type="hidden" name="ID" value="<?php echo $hsl_data->StandarHarga_ID;?>" id="ID_<?php echo $i?>">
								<input type="submit" value="Tentukan Pemeliharaan" class="btn btn-success" name="pemeliharaan"/>
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
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			<div style="height:5px;width:100%;clear:both"></div>
				<div class="detailRight" align="right">
						
						<ul>
							<li>
								   <ul class="pager">
										<li><a href="#" class="buttonprev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">Prev</a></li>
										<li><a href="#" class="buttonnext" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>