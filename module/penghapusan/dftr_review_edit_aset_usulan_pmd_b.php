<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN_B;
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// //////pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php

	$id=$_GET['id'];
				// //////pr($id);
				if (isset($id))
				{
					unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
					$parameter = array('id'=>$id);
					// $data = $RETRIEVE->retrieve_penetapan_penghapusan_edit_data($parameter);
					
						// //////pr($_POST);
						$data = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_edit_data_pmd($_GET);
						//////pr($data);
						
				}

				$row=$data['dataRow'][0];		
				//////pr($row);
		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	
	<script>
        $(function()
        {
       		 $('#tanggal1').datepicker($.datepicker.regional['id']);

        }
		);
	</script>
	
	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('DELUSPMD');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('DELUSPMD');
			}}, 100);
		}
		</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Aset Usulan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Review Aset yang akan dibuat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			<form method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_asetid_usulan_proses_upd_pmd.php"> 
			
			<div class="detailLeft">
				<?php
					if($row['StatusPenetapan']==0){
						$disabled="";
					}elseif($row['StatusPenetapan']==1){
						$disabled="disabled";
					}

				?>
						
						<ul>
							<li>
								<span  class="labelInfo">No Usulan</span>
								<input type="text" name="noUsulan" value="<?=$row['NoUsulan']?>" <?=$disabled?> required/>
							</li>
							<li>
								<span class="labelInfo">Keterangan usulan</span>
								<textarea name="ketUsulan" <?=$disabled?> required><?=$row['KetUsulan']?></textarea>
							</li>
							<li>
								<span  class="labelInfo">&nbsp;</span>
								<input type="submit" <?=$disabled?> value="Upadte Informasi Usulan" class="btn"/>
							</li>
						</ul>
							
					</div>

			<div class="detailRight">
				<ul>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						&nbsp;
					</li>
						<?php
							
							$TglUsulanTmp=explode("-", $row['TglUpdate']);
							// //pr($TglSKHapusTmp);
							$TglUsulan=$TglUsulanTmp[1]."/".$TglUsulanTmp[2]."/".$TglUsulanTmp[0];

						?>
					<li>
						<span  class="labelInfo">Tanggal Usulan</span>
							<div class="input-prepend">
								<span class="add-on"><i class="fa fa-calendar"></i></span>
								<input name="tanggalUsulan" type="text" id="tanggal1" <?=$disabled?>  value="<?=$TglUsulan?>" required/>
							</div>
						
					</li>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						<input type="hidden" name="usulanID" value="<?=$id?>"/><br/>
					</li>
				</ul>
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			</form>
			<form method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_asetid_usulan_proses_hapus_pmd.php"> 
			<div id="demo">
			<?php
				if($row['StatusPenetapan']==0){
					$idtable="penghapusan11";
				}else{
					$idtable="penghapusan10";
				}

			// pr($idtable);
			?>
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="<?=$idtable?>">
				<thead>
					<tr>
						<td colspan="10" align="Left">
							<?php
								if($row['StatusPenetapan']==0){
							?>
								<a href="filter_tambah_aset_usulan_pmd.php?usulanID=<?=$id?>" class="btn btn-info " /><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;TambahKan Aset Usulan</a>
								<span><button type="submit" name="submit"  class="btn btn-danger " id="submit" disabled/><i class="icon-trash icon-white"></i>&nbsp;&nbsp;Delete</button></span>
								<input type="hidden" name="usulanID" value="<?=$id?>"/>
							<?php
								}
							?>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<?php
								if($row['StatusPenetapan']==0){
							?>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
							<?php
								}
							?>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Merk / Type</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
						<th>Status Konfirmasi</th>
					</tr>
				</thead>
				<tbody>		
				<?php
				$no = 1;
				// //////pr($data);
				$coo=count($data['dataArr']);
				// //////pr($coo);
				foreach ($data['dataArr'] as $keys => $nilai)
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
					if($coo==1){
					$delete="";
					}else{
					$delete="<a href='$url_rewrite/module/penghapusan/usulan_asetid_proses_hapus_pmd.php?id=$id&asetid=$nilai[Aset_ID]' class='btn btn-danger'><i class='fa fa-trash'></i>
					 Delete</a>";
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

					?>
						
					<tr class="gradeA">
						<td><?php echo $no?></td>
						<?php
								if($row['StatusPenetapan']==0){
							?>
						<td class="checkbox-column">
						
							<input type="checkbox" class="icheck-input checkbox" onchange="return AreAnyCheckboxesChecked();" name="penghapusan_nama_aset[]" value="<?php echo $nilai[Aset_ID];?>" >
							
						</td>
						<?php
								}
							?>
						<td>
							<?php echo "ASET_ID [ ".$nilai[Aset_ID]." ]".$nilai[noRegister]?>
						</td>
						<td>
							<?php echo $nilai[noKontrak]?>
						</td>
						<td>
							 [<?php echo $nilai[kodeKelompok]?>]<br/> 
							<?php echo $nilai[Uraian]?>
						</td>
						<td>
							<?php echo $nilai[Merk]?> <?php if ($value[Model]) echo $nilai[Model];?>
						</td>
						<td>
							<?php echo '['.$nilai[kodeSatker].'] '?><br/>
							<?php echo $nilai[NamaSatker];?>
						</td>
						<td>
							<?php echo $TglPerolehan;?>
						</td>
						<td>
							<?php echo number_format($nilai[NilaiPerolehan],4);?>
						</td>
						<td>
							<a target="_blank" href="<?php echo $url_rewrite;?>/module/penghapusan/datacekpenghapusan.php?fleg=<?php echo $nilai[Aset_ID]?>" class="btn btn-warning">cek data</a>
						</td>
						<td>
							<?php
								if($nilai['StatusKonfirmasi']==0){
									$label="warning";
									$text="proses";
								}elseif($nilai['StatusKonfirmasi']==1){
									$label="success";
									$text="Diterima";
								}elseif($nilai['StatusKonfirmasi']==2){
									$label="danger";
									$text="Ditolak";
								}
							?>
							<span class="label label-<?=$label?>" ><?=$text?></span>
						</td>
							
					</tr>
					<?php
				  $no++;
								}
							}
			?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<?php
								if($row['StatusPenetapan']==0){
							?>
						<th>&nbsp;</th>
						<?php
								}
							?>
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
			</form>
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>