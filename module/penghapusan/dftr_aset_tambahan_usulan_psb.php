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
	////pr($_POST);

	////pr($_SESSION['usulanIDTmp']);

	if(isset($_POST['usulanID'])){
		$id=$_POST['usulanID'];
	}else{
		$id="";
		if(isset($_SESSION['usulanIDTmp'])) {
			$id=$_SESSION['usulanIDTmp'];
		}
		
	}
	if(isset($_POST['filterAsetUsulan']) && $_POST['filterAsetUsulan']==1){
		$data = $PENGHAPUSAN->retrieve_usulan_penghapusan_psb($_POST);
		$_SESSION['filterAsetUsulanAdd']=$data;
		$data=$_SESSION['filterAsetUsulanAdd'];
		// ////pr($_SESSION['reviewAsetUsulan']);
		$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPSB");

		if($data_post){
		$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWUSPSB");
		}
	}else{
		$dataSESSION=$_SESSION['filterAsetUsulanAdd'];
		$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPSB");
		
		$POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);

		$POST['penghapusanfilter']=$POST;
		if($POST){
			// ////pr($_SESSION['reviewAsetUsulan']['penghapusanfilter']);
			foreach ($dataSESSION as $keySESSION => $valueSESSION) {
				// ////pr($valueSESSION['Aset_ID']);
				if(!in_array($valueSESSION['Aset_ID'], $POST['penghapusanfilter'])){
					// echo "stringnot";
					$data[]=$valueSESSION;
				}
			}
		
		}
		// ////pr($data);

	}
	// $data = $PENGHAPUSAN->retrieve_usulan_penghapusan_psb($_POST);
	if(isset($_GET['flegAset'])){
		$flegAset=$_GET['flegAset'];
	}else{
		$flegAset=1;
	}
		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	 
	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('RVWUSPSB');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('RVWUSPSB');
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
				<div class="subtitle">Daftar Aset yang akan dibuat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_psb.php">
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
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_psb.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			
			
			<div id="demo">
			<form method="POST" ID="Form2" action="<?php echo"$url_rewrite"?>/module/penghapusan/dftr_review_aset_tambahan_usulan_psb.php"> 
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="penghapusan10">
				<thead>
					<tr>
						<td colspan="7" align="left">
								<span><button type="submit" name="submit" class="btn btn-info " id="submit" disabled/><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Buat Usulan Penghapusan</button></span>
								<input type="hidden" name="usulanID" value="<?=$id?>"/>
								<input type="hidden" name="reviewAsetUsulan" value="<?=$flegAset?>" />
						<?php
							if($flegAset==0){
						?>
							<a href="<?php echo"$url_rewrite"?>/module/penghapusan/dftr_review_aset_tambahan_usulan_psb.php" class="btn">Kembali ke Aset Usulan</a>
						<?php

							}
						?>
						</td>

						<td colspan="3" align="right">
							<a href="<?php echo"$url_rewrite"?>/module/penghapusan/filter_tambah_aset_usulan_psb.php?usulanID=<?=$id?>" class="btn">Kembali Ke Pencarian</a>
			
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Merk / Type</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>		
				<?php
				if (!empty($data))
				{
			   
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}
					foreach ($data as $key => $value)
					{
					// ////pr($get_data_filter);
					if($value[kondisi]==2){
						$kondisi="Rusak Ringan";
					}elseif($value[kondisi]==3){
						$kondisi="Rusak Berat";
					}elseif($value[kondisi]==1){
						$kondisi="Baik";
					}
					// ////pr($value[TglPerolehan]);
					$TglPerolehanTmp=explode("-", $value[TglPerolehan]);
					// ////pr($TglPerolehanTmp);
					$TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];


					?>
						
					<tr class="gradeA">
						<td><?php echo $no?></td>
						<td class="checkbox-column">
						
							<input type="checkbox" class="icheck-input checkbox" onchange="return AreAnyCheckboxesChecked();" name="penghapusanfilter[]" value="<?php echo $value[Aset_ID];?>" >
							
						</td>
						<td>
							<?php echo $value[noRegister]?>
						</td>
						<td>
							<?php echo $value[noKontrak]?>
						</td>
						<td>
							 [<?php echo $value[kodeKelompok]?>]<br/> 
							<?php echo $value[Uraian]?>
						</td>
						<td>
							<?php echo $value[Merk]?> <?php if ($value[Model]) echo $value[Model];?>
						</td>
						<td>
							<?php echo '['.$value[kodeSatker].'] '?><br/>
							<?php echo $value[NamaSatker];?>
						</td>
						<td>
							<?php echo $TglPerolehan;?>
						</td>
						<td>
							<?php echo number_format($value[NilaiPerolehan]);?>
						</td>
						<td>
							<?php echo $kondisi. ' - ' .$value[AsalUsul]?>
						</td>
							
					</tr>
					
				   <?php
							$no++;
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
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</form>
			</div>
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>