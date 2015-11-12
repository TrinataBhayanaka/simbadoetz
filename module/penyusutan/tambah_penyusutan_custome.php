<?php
include "../../config/config.php";
$menu_id = 66;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$data= $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_penyusutan= $PENYUSUTAN->getStatusPenyusutansatker();
// pr($_SESSION);
$tahun = date('Y');
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
<script>

$(document).ready(function() {
	$("#kode").on('change', function(){
	
		var satker = document.getElementById("kodeSatker");
		var tahun = document.getElementById("tahun");
		var kode = document.getElementById("kode");
		//alert(satker.value);
		$.post('../../function/api/asetSusutExistCheck.php', {satker:satker.value, tahun:tahun.value,kode:kode.value}, function(result){
		if(result == 1){
			alert('Tipe Aset Telah Disusutkan');
			$('#simpan').attr('disabled','disabled');
            $('#simpan').css("background","grey");
		}else{
			$('#simpan').removeAttr('disabled');
		    $('#simpan').css("background","#04c");
		}
		
		})
	});	
});			

</script>	
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Tambah Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Status Penyusutan Aset</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Tambah Penyusutan Aset <?=$tahun?></div>
				<div class="subtitle">Daftar Aset</div>
			</div>	
			<?php
				$thnAktif = date('Y');
				if($Session['ses_uaksesadmin'] == 1){
					$par = "";
					$flag = 1;
				}else{
					 $param = $Session['ses_satkerkode'];
					 $count =explode('.',$param);
					 $hit = count($count);
					 if($hit == 4){
						 $par="where kodeSatker='$param' and Tahun='{$thnAktif}'";
						 $flag = 2;
					 }else{
						 // $par = "where kodeSatker like '$param%' and Tahun='{$thnAktif}'";
						 $par = "";
						 $flag = 1;
					 }
				}
				
				$KelompokAset=array("0"=>"Peralatan dan Mesin (B)",
									   "1"=>"Gedung dan Bangunan (C)",
										 "2"=>"Jalan, Irigrasi, dan Jaringan (D)");
									 
				$query="select KelompokAset from penyusutan_tahun $par";
				// pr($query);
				$result=$DBVAR ->query($query) or die($DBVAR ->error());
				while ($data=$DBVAR ->fetch_object($result)){
					 $KelompokAsetPenyusutan[]=$data->KelompokAset;
				}
			?>
		<section class="formLegend">
			<p><a href="penyusutan.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Daftar Penyusutan</a>
			&nbsp;
			<!-- <a class="btn btn-danger btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Kontrak Simral</a>
			&nbsp; --></p>	
                  <form name="lda_filter" action="<?php echo "$url_rewrite/module/penyusutan/proses_daftar_custome.php"; ?>" method="post" >
                       <ul>
					   <?=selectSatker('kodeSatker',$width='205',$br=true,false);?>
						<li>&nbsp;</li>
						<li>
							<span class="span2">Tipe Aset</span>
							<select name="KelompokAset"  required="1" id="kode">
								 <option value=""></option>
								 <?php for($i=0;$i<count($KelompokAset); $i++){
									  if($flag == 1){
										echo "<option value='{$KelompokAset[$i]}'>{$KelompokAset[$i]}
										</option>";
									  }else{
									  if(!in_array($KelompokAset[$i], $KelompokAsetPenyusutan)){
										echo "<option value='{$KelompokAset[$i]}'>{$KelompokAset[$i]}}
										</option>";
									}	
								 }
							}
?>
							</select>
						</li>
						<!--<li>
							<span class="span2">Penyusutan</span>
							<select name="flagPnystn" style="width:260px" id="jenisaset">
								<option value="1" selected>Penyusutan Tahun Pertama (<?=date('Y')?>)</option>
								<option value="2" >Penyusutan Tahun Selanjutnya</option>
							</select>
						</li>--> 
						<li>
							<span class="span2">Tahun Penyusutan</span>
							<input type="text" name="tahun" id = "tahun" readonly value="<?=date('Y')?>">
							<input type="hidden" name="UserNm"  value="<?=$Session['ses_satkerid']?>">
						</li> 		
						<li><input type="submit" value="simpan" id="simpan" name="simpan" class="btn btn-primary"></li>
                       </ul>
                  </form>
			<div class="spacer"></div>
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>