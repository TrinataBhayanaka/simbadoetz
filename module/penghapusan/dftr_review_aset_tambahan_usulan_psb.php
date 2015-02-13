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
	if(isset($_POST['usulanID'])){
		$id=$_POST['usulanID'];
	}else{
		$id="";
		if(isset($_SESSION['usulanIDTmp'])) {
			$id=$_SESSION['usulanIDTmp'];
		}
		
	}
	// if(isset($_POST['reviewAsetUsulan']) && $_POST['reviewAsetUsulan']==1){
	// 	$_SESSION['reviewAsetUsulanAdd']=$_POST;
	// 	$POST=$_SESSION['reviewAsetUsulanAdd'];
	// }else{
	// 	////pr($_POST);
	// 	////pr($_SESSION['reviewAsetUsulanAdd']);
	// 	foreach ($_POST['penghapusanfilter'] as $key => $value) {
	// 		$_SESSION['reviewAsetUsulanAdd']['penghapusanfilter'][]=$value;
	// 	}
	// 	$POST=$_SESSION['reviewAsetUsulanAdd'];
	// 	////pr($POST);
	// }

	// pr($POST);
	$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPSB");
	$POST=$_POST;
	$POST['penghapusanfilter']=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
	
	// pr($POST);
	$data = $PENGHAPUSAN->retrieve_tambahan_usulan_penghapusan_eksekusi_psb($POST);
	// //pr($data);
	$row=$data['dataRow'][0];
		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	<script>
    jQuery(function($) {
        $('.nilaimask').autoNumeric('init');
   });
    function getCurrency(item,dest,nilai,error,idcheck,idaset,kondisi){
    	var old = $("#"+idcheck).val();
    	var idasetID=$("#"+idaset).val();
    	var kondisiOld=$("#"+kondisi).val();
    	if(parseInt($(item).autoNumeric('get')) > parseInt(nilai)){
    		$('#'+error).html('Nilai tidak Boleh Lebih');
    		$('#'+dest).val('0');
    		$("#submit").attr('style','display:none');
    		$('#Form2').attr('action',"#");
    	}else{

    		$('#Form2').attr('action',"<?php echo $url_rewrite;?>/module/penghapusan/daftar_tambahan_usulan_penghapusan_usul_proses_psb.php");
    		 $("#submit").attr('style','');
     		 $('#'+dest).val($(item).autoNumeric('get'));
     		 $('#'+error).html('');
     		 $("#"+idcheck).val(idasetID+"|"+kondisiOld+"|"+$(item).autoNumeric('get'));
    	}
    	if(parseInt($(item).autoNumeric('get')) ==0 || $(item).autoNumeric('get')==""){

			$("#"+idcheck).attr("disabled","disabled");
    	}else{
    		$("#"+idcheck).removeAttr("disabled");
    	}
    }
    </script>
	<script>
		function AreAnyCheckboxesChecked (item,nilaimask) 
		{
			arrunchecked = $(item).map(function() {
						    if(!this.checked){
							    
			   					 $("#"+nilaimask).removeAttr("disabled");	
						    } else {
						    	
			   					 $("#"+nilaimask).attr("disabled","disabled");
						    }
						}).get();
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('USPSB');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('USPSB');
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
			<form method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>daftar_tambahan_usulan_penghapusan_usul_proses_psb.php"> 
			
			<div class="detailLeft">
						
						<ul>
							<li>
								<span  class="labelInfo">No Usulan</span>
								<input type="text" name="noUsulan" disabled value="<?=$row['NoUsulan']?>" />
							</li>
							<li>
								<span class="labelInfo">Keterangan usulan</span>
								<textarea name="ketUsulan" disabled ><?=$row['KetUsulan']?></textarea>
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
						<span  class="labelInfo">&nbsp;</span>
						&nbsp;
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
			
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="penghapusan10">
				<thead>
					<tr>
						<td colspan="10" align="Left">
								<span><button type="submit" name="submit" class="btn btn-info " id="submit" disabled/><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Usulkan Untuk Penghapusan</button></span>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>dftr_aset_tambahan_usulan_psb.php?pid=1&flegAset=0" class="btn"/>Tambahkan Aset</a>
								<input type="hidden" name="usulanID" value="<?=$id?>"/>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();" disabled></th>
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
				if (!empty($data['dataArr']))
				{
			   
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}
					foreach ($data['dataArr'] as $key => $value)
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
						
							
							<input type="checkbox" class="icheck-input checkbox" onchange="return AreAnyCheckboxesChecked(this,'idnilaimask<?=$no?>');" name="penghapusan_nama_aset[]" value="<?php echo $value[Aset_ID];?>|0" id="chebok<?=$no?>" disabled>
							
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
						
								<input type="text" class="span2 nilaimask" id="idnilaimask<?=$no?>" data-a-sign="Rp " data-a-dec="," data-a-sep="."  onkeyup="return getCurrency(this,'nilaiP<?=$no?>','<?=$value[NilaiPerolehan]?>','error<?=$no?>','chebok<?=$no?>','idaset<?=$no?>','kondisi<?=$no?>');"  placeholder="0" /><br/>
								<em id="error<?=$no?>"></em>

								<input type="hidden" id="nilaiP<?=$no?>"  >
								<input type="hidden" id="idaset<?=$no?>"value="<?=$value[Aset_ID];?>"  >
								<input type="hidden" id="kondisi<?=$no?>"value="<?=$value[kondisi];?>"  >
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
			</div>
			</form>
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>