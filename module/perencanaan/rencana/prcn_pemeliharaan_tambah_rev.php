<?php
include "../../../config/config.php";
	// $menu_id = 62;
	$menu_id = 61;
	$SessionUser = $SESSION->get_session_user();
	// pr($SessionUser);
	($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
	$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

// pr($_GET['url']);
//get data
$getUrl = decode($_GET['url']);
$tempUrl=explode('&',$getUrl);
$getID=explode('=',$tempUrl[0]);
$getTipe=explode('=',$tempUrl[1]);
$getSatker=explode('=',$tempUrl[3]);
$kodeSatker=$getSatker[1];
$Aset_ID =$getID[1];
$TipeAset = $getTipe[1];
 
if($TipeAset != ''){
	if($TipeAset == 'A'){
		$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian from tanah as a
				  inner join kelompok as k ON k.Kode = a.kodeKelompok
				  where Aset_ID = '$Aset_ID'";
	}elseif($TipeAset == 'B'){
		$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian from mesin as a
				  inner join kelompok as k ON k.Kode = a.kodeKelompok
				  where Aset_ID = '$Aset_ID'";
	}elseif($TipeAset == 'C'){
		$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian from bangunan as a
				  inner join kelompok as k ON k.Kode = a.kodeKelompok
				  where Aset_ID = '$Aset_ID'";
	}elseif($TipeAset == 'D'){
		$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian from jaringan as a
				  inner join kelompok as k ON k.Kode = a.kodeKelompok
				  where Aset_ID = '$Aset_ID'";
	}elseif($TipeAset == 'E'){
		$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian from asetlain as a
				  inner join kelompok as k ON k.Kode = a.kodeKelompok
				  where Aset_ID = '$Aset_ID'";
	}elseif($TipeAset == 'F'){
		$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian from kdp as a
				  inner join kelompok as k ON k.Kode = a.kodeKelompok
				  where Aset_ID = '$Aset_ID'";
	}
	// pr($queryPemeliharaan);
$exequeryTipe = $DBVAR->query($queryPemeliharaan);
$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
$noRegister = $GetDataTipe['noRegister'];
$kodeKelompok = $GetDataTipe['kodeKelompok'];
$Uraian = $GetDataTipe['Uraian'];
}
?>

	<script type="text/javascript">
	$(document).ready(function() {
	   $("select").select2();
	   $('#hargaPemeliharaan').autoNumeric('init');
	   $("#tglPemeliharaan").mask('9999-99-99');
	   $("#tglPemeliharaan" ).datepicker({ dateFormat: 'yy-mm-dd' });
	   /*function getCurrency(item){
	      $('#hargaPemeliharaan').val($(item).autoNumeric('get'));
	    }*/
	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rencana Pemeliharaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rencana Pemeliharaan</div>
				<div class="subtitle">Buat Rencana Pemeliharaan</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_filter_rev.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Rencana Pemeliharaan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_filter_data_rev.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pemeliharaan</span>
				</a>
			</div>		

		<section class="formLegendInve">
			<form name="myform" method="post" action="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pemeliharaan_tambah_proses_rev.php">
			<ul>
				<li>
					<span class="span2">No Register</span>
					<input name="noReg" id="" class=""  type="text" value="<?=sprintf('%04s',$noRegister)?>" readonly>
				</li>
				<li>
					<span class="span2">Kode Barang</span>
					<input type="text" name="kodeKelompok" id="" class=""  value="<?=$kodeKelompok?>" readonly>
				</li>
				<li>
					<span class="span2">Nama Barang</span>
					<input type="text" name="namaBarang" id="" class=""  value="<?=$Uraian?>" readonly>
				</li>
				<li>
					<span class="span2">Tgl Pemeliharaan</span>
					<input type="text" class="" name="tglPemeliharaan" id="tglPemeliharaan" value="" required> 
				</li>
				<li>
					<span class="span2">Uraian Pemeliharaan</span>
					<textarea style="width:; height:;" name="uraian" class="" required></textarea>
				</li>
				<li>
					<span class="span2">Lokasi</span>
					<input type="text" name="lokasi" id="" class=""  value="" >
				</li>
				<li>
					<span class="span2">Harga Pemeliharaan</span>
					<input type="text" name="hargaPemeliharaan" id="hargaPemeliharaan" class=""  value=""  onkeyup="return getCurrency(this);" required>
				</li>
				<?php 
				//selectRekening('kdRekening','205',true,(isset($rinc) ? $rinc['kdRekening'] : false)); 
					selectRekening('kdRekening','205',true,false); 
				?><br />
				<li>
					<span class="span2">Keterangan</span>
					<textarea style="width:; height:;" name="keterangan" class="" ></textarea>
				</li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="Simpan" id="submit" />
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					<input type="hidden" name="Aset_ID" class="" value="<?=$Aset_ID?>">
					<input type="hidden" name="createDate" class="" value="<?=date("Y-m-d")?>">
					<input type="hidden" name="urlParam" class="" value="<?=$_GET['surl']?>">
					<input type="hidden" name="kodeSatker" class="" value="<?=$kodeSatker?>">
					<input type="hidden" name="TipeAset" class="" value="<?=$TipeAset?>">
					<input type="hidden" name="UserNm" class="" value="<?=$SessionUser['ses_uoperatorid']?>">
					
				</li>
			</ul>
		</form> 
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>

