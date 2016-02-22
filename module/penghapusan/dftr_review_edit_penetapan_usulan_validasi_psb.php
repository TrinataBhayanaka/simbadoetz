<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// ////pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	// if($_POST['submit']==''){
	// $dataPost=$_SESSION['dataPost'];
	// }else{
	// $_SESSION['dataPost']=$_POST;
	// $dataPost=$_SESSION['dataPost'];
	// }
	// $data = $PENGHAPUSAN->retrieve_penetapan_penghapusan_eksekusi_psb($_POST);
	$idPenetapan=$_GET['id'];
	$data = $PENGHAPUSAN->retrieve_penetapan_penghapusan_edit_data_psb($_GET);
	
	// ////pr($data);
		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	<script language="Javascript" type="text/javascript">  
			function enable(){  
			var tes=document.getElementsByTagName('*');
			var button=document.getElementById('submit');
			var boxeschecked=0;
			for(k=0;k<tes.length;k++)
			{
				if(tes[k].className=='checkbox')
					{
						//
						tes[k].checked == true  ? boxeschecked++: null;
					}
			}
			//alert(boxeschecked);
			if(boxeschecked!=0)
				button.disabled=false;
			else
				button.disabled=true;
			}
	</script>
	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");

			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			   
			}}, 100);
		}
		</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Aset Usulan Penghapusan Sebagian</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Sebagian</div>
				<div class="subtitle">Review Aset yang akan dibuat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
		<div class="detailLeft">
						
						<ul>
							<li>
								<span  class="labelInfo">No SK Penghapusan</span>
								<input type="text" id="idnoskhapus" name="bup_pp_noskpenghapusan" value="<?=$data['dataRow'][0]['NoSKHapus']?>" <?php echo $disabledForm;?> readonly>
						
							</li>
							<li>
								<span class="labelInfo">Keterangan Penghapusan</span>
								<textarea  id="idinfohapus" name="bup_pp_get_keterangan" <?php echo $disabledForm;?> readonly><?=$data['dataRow'][0]['AlasanHapus']?></textarea>
							</li>
						</ul>
							
					</div>

			<div class="detailRight">
				<ul>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						&nbsp;
					</li>
					<li>
						<span  class="labelInfo">Tanggal SK Penghapusan</span>
						<input name="bup_pp_tanggal" type="text" id="tanggal12" value="<?=$data['dataRow'][0]['TglHapus']?>" readonly/>
					</li>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						&nbsp;
					</li>
					<!-- <li>
						<span  class="labelInfo">Total Nilai Usulan</span>
						<input type="text" value="" disabled/>
					</li> -->
				</ul>
			</div>
	
			<div style="height:5px;width:100%;clear:both"></div>
		
			<div id="demo">
			<?php 
				if($data['dataRow'][0]['Status']==0){
			?>
			<form method="post" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_proses_psb.php">
				<input type="hidden" name="ValidasiPenghapusan[]" value="<?=$data['dataRow'][0]['Penghapusan_ID']?>" >
				<input type="submit" class="btn btn-info" value="Validasi Penetapan Penghapusan">
			</form>
			<?php
				}
			?>
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Merk / Type</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Nilai Baru</th>
					</tr>
				</thead>
				<tbody>		
				<?php
				if (!empty($data['dataRow']))
				{
			   
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}
					$no = 1;
					foreach ($data['dataArr'] as $key => $nilai)
					{
						////pr($nilai);
						?>
						<!-- <input type="hidden" name="UsulanID[]" value="<?php echo $valueUsulan['Usulan_ID'];?>"/> -->
					<?php
					
					// $TglPerolehanTmp=explode("-", $valueUsulan[TglPerolehan]);
					// // ////pr($TglPerolehanTmp);
					// $TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];

					// $dataUsulanAset = $PENGHAPUSAN->retrieve_penetapan_penghapusan_detail_usulan_psb($valueUsulan['Usulan_ID']);
									// ////pr($dataUsulanAset);
									// ////pr($_SESSION);
									// StatusKonfirmasi
									
									// foreach ($dataUsulanAset as $keys => $nilai)
									// {
										if ($nilai[Aset_ID] !='')
										{
										if ($nilai->AsetOpr == 0)
										$select="selected='selected'";
										if ($nilai->AsetOpr ==1)
										$select2="selected='selected'";

										if($nilai->SumberAset =='sp2d')
										$pilih="selected='selected'";
										if($nilai->SumberAset =='hibah')
										$pilih2="selected='selected'";

										if($nilai[StatusKonfirmasi]==1){
											$textLabel="Diterima";
											$labelColor="label label-success";
										}elseif($nilai[StatusKonfirmasi]==2){
											$textLabel="Ditolak";
											$labelColor="label label-danger";
										}else{
											$textLabel="Ditunda";
											$labelColor="label label-warning";
											$disabled="
										<a href='penetapan_asetid_proses_diterima.php?asetid=$nilai[Aset_ID]' class='btn btn-success' >Diterima</a>
										<a href='penetapan_asetid_proses_ditolak.php?asetid=$nilai[Aset_ID]' class='btn btn-danger' >Ditolak</a>";
										}
					if($nilai[kondisi]==2){
						$kondisi="Rusak Ringan";
					}elseif($nilai[kondisi]==3){
						$kondisi="Rusak Berat";
					}elseif($nilai[kondisi]==1){
						$kondisi="Baik";
					}
					// ////pr($value[TglPerolehan]);
					$TglPerolehanTmp=explode("-", $nilai[TglPerolehan]);
					// ////pr($TglPerolehanTmp);
					$TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];

					if($nilai[StatusValidasi]==1){
							$TglPerolehanAwal=$nilai[NilaiPerolehanTmp];
							$TglPerolehanbaru=$nilai[NilaiPerolehan];
						}else{
							$TglPerolehanAwal=$nilai[NilaiPerolehan];
							$TglPerolehanbaru=$nilai[NilaiPerolehanTmp];
						}
					?>
						
					<tr class="gradeA">
						<td><?php echo $no?></td>
					
						<td>
							<?php echo $nilai[noRegister]?>
						</td>
						<td>
							<?php echo $nilai[noKontrak]?>
						</td>
						<td>
							 [<?php echo $nilai[kodeKelompok]?>]<br/> 
							<?php echo $nilai[Uraian]?>
						</td>
						<td>
							<?php echo $nilai[Merk]?> <?php if ($nilai[Model]) echo $nilai[Model];?>
						</td>
						<td>
							<?php echo '['.$nilai[kodeSatker].'] '?><br/>
							<?php echo $nilai[NamaSatker];?>
						</td>
						<td>
							<?php echo $TglPerolehan;?>
						</td>
						<td>
							<?php echo number_format($TglPerolehanAwal,4);?>
						</td>
					<!-- 	<td>
							<?php echo $kondisi. ' - ' .$nilai[AsalUsul]?>
						</td> -->
						<td>
							<?=number_format($TglPerolehanbaru,4)?>
						</td>
							
					</tr>
					
				   <?php 
				   				}
							$no++;
						// }
							
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
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
		<!-- 	<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Satker</th>
						<th>No. Dokumen</th>
						<th>Tanggal</th>
						<th>Jenis Dokumen</th>
						<th>Tipe Aset</th>
						<th>Nilai</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody> -->
					<!-- 
				<?php
						$jmlUsulan=count($data['dataRow']);
						$disabledForm="";
						foreach ($data['dataRow'] as $valueUsulan) {
							
							$dataUsulanAset = $PENGHAPUSAN->retrieve_penetapan_penghapusan_detail_usulan($valueUsulan['Usulan_ID']);
									////pr($dataUsulanAset);
									// ////pr($_SESSION);
									// StatusKonfirmasi
									$no = 1;
									foreach ($dataUsulanAset as $keys => $nilai)
									{
										if ($nilai[Aset_ID] !='')
										{
										if ($nilai->AsetOpr == 0)
										$select="selected='selected'";
										if ($nilai->AsetOpr ==1)
										$select2="selected='selected'";

										if($nilai->SumberAset =='sp2d')
										$pilih="selected='selected'";
										if($nilai->SumberAset =='hibah')
										$pilih2="selected='selected'";

										if($nilai[StatusKonfirmasi]==1){
											$textLabel="Diterima";
											$labelColor="label label-success";
										}elseif($nilai[StatusKonfirmasi]==2){
											$textLabel="Ditolak";
											$labelColor="label label-danger";
										}else{
											$textLabel="Ditunda";
											$labelColor="label label-warning";
											$disabled="
										<a href='penetapan_asetid_proses_diterima.php?asetid=$nilai[Aset_ID]' class='btn btn-success' >Diterima</a>
										<a href='penetapan_asetid_proses_ditolak.php?asetid=$nilai[Aset_ID]' class='btn btn-danger' >Ditolak</a>";
										}
						?>
					<tr class="gradeA">
						<td><?=$no?>|<?php echo $valueUsulan['Usulan_ID'];?></td>
						<td width="20%"><?=$nilai['NamaSatker']?></td>
						<td><?=$nilai['noKontrak']?></td>
						<td><?=$nilai['tglKontrak']?></td>
						<td><?=($nilai['tipe_kontrak'] == 2) ? 'Pembelian Langsung' : 'Kontrak'?></td>
						<td><?=$nilai['tipeAset']?></td>
						<td><?=number_format($nilai['nilai'])?></td>
						<td class="center">
						<?php
						if($nilai['n_status'] != 1){
						?>	
							<a href="<?=($nilai['tipe_kontrak'] == 1) ? 'kontrakedit' : 'pledit'?>.php?id=<?=$nilai['id']?>" class="btn btn-warning btn-small"><i class="icon-edit icon-white"></i>&nbsp;Ubah</a>
							<a href="kontrakhapus.php?id=<?=$val['id']?>" class="btn btn-danger btn-small"><i class="icon-trash icon-white"></i>&nbsp;Hapus</a>
						<?php
						} else {
							echo "<span class='label label-Success'>Sudah di posting</span>";
						}
						?>
						</td>
						
					</tr>
					<?php
					$no++;
										}
									}
							
								}
							?>
			
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div> -->
		</form>
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>