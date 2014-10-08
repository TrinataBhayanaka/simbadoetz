<?php
include "../../config/config.php";
$menu_id = 6;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
$get_data_filter = $RETRIEVE->retrieve_rkpb_tambah_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));	
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
		  <li class="active">Buat Rencana Kebutuhan Pemeliharaan Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat RKPB</div>
			<div class="subtitle">Tambah Data </div>
		</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>rkpb_daftar_data.php" class="btn">
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
							<table border=0 width=100%>
								<tr>
									<td width="20%">Tahun</td>
									<td><?php echo $hsl_data->Tahun;?></td>
								</tr>
								<tr>
									<td width="20%">SKPD</td>
									<td><?php echo show_skpd($hsl_data->Satker_ID);?></td>
								</tr>
								<tr>
									<td width="20%">Lokasi</td>
									<td><?php echo show_lokasi($hsl_data->Lokasi_ID);?></td>
								</tr>
								<tr>
									<td width="20%">Nama/Jenis Barang</td>
									<td><?php echo show_kelompok($hsl_data->Kelompok_ID);?></td>
								</tr>
								<tr>
									<td width="20%">Spesifikasi</td>
									<td><?php echo $hsl_data->Merk;?></td>
								</tr>
								<tr>
									<td>Kode Rekening</td>
									<td>[<?php echo show_koderekening($hsl_data->KodeRekening);?>]-<?php echo show_namarekening($hsl_data->KodeRekening);?></td>
								</tr>
								<tr>
									<td>Jumlah Barang Berdasarkan RKB</td>
									<td><?php echo $hsl_data->Kuantitas;?></td>
								</tr>
								<tr>
									<td>Harga Pemeliharaan</td>
									<td>
										<?php
										$query_shpb = "SELECT Pemeliharaan FROM StandarHarga WHERE Kelompok_ID=".$hsl_data->Kelompok_ID." AND Spesifikasi='".$hsl_data->Merk."' ";
										$result		= mysql_query($query_shpb);
										if($result){
											$hasil		= mysql_fetch_array($result);
											echo $hasil['Pemeliharaan'];
										}
										?>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<form method="POST" action="rkpb_pemeliharaan.php" onsubmit="konfirmasi(this)">
								<input type="hidden" name="ID" value="<?php echo $hsl_data->Perencanaan_ID;?>" id="ID_<?php echo $i?>">
								<input type="submit" value="Tentukan Pemeliharaan" name="pemeliharaan"/>
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