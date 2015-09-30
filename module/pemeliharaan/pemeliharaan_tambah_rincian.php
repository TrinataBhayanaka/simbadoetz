<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

// $menu_id = 60;
$menu_id = 63;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
// pr($SessionUser);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

//get sk filter
$getskUrl = decode($_GET['skUrl']);
// pr($getskUrl);	
//get Aset_ID & tipeAset	
$getUrl = decode($_GET['url']);
// pr($getUrl);
$tempUrl=explode('&',$getUrl);
$getID=explode('=',$tempUrl[0]);
// $getTipe=explode('=',$tempUrl[1]);
$Aset_ID =$getID[1];
// $TipeAset = $getTipe[1];

//get Pemeliharaan_ID
$getUrlPmlrn = decode($_GET['turl']);
// pr($getUrlPmlrn);
$getIDPmlrhrn=explode('=',$getUrlPmlrn);
// pr($getIDPmlrhrn);
$PmlhrnID=$getIDPmlrhrn[1];
// pr($PmlhrnID);

$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian from aset as a
		  inner join kelompok as k ON k.Kode = a.kodeKelompok
		  where Aset_ID = '$Aset_ID'";
	
// pr($queryPemeliharaan);
$exequeryTipe = $DBVAR->query($queryPemeliharaan);
$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
$noRegister = $GetDataTipe['noRegister'];
$kodeKelompok = $GetDataTipe['kodeKelompok'];
$Uraian = $GetDataTipe['Uraian'];

?>
	<script>
	jQuery(function($){
	   $("#tglsp2d,#tglkontrak,#tglpemeliharaan").mask('9999-99-99');
	   $("#tglsp2d,#tglkontrak,#tglpemeliharaan" ).datepicker({ dateFormat: 'yy-mm-dd' });
	   $("select").select2();
	   $('#Biaya').autoNumeric('init');
	});
	
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemeliharaan</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Pemeliharaan</div>
			<div class="subtitle">Buat Data Pemeliharaan</div>
		</div>
		<!--<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Data Pemeliharaan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/pemeliharaan/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Pemeliharaan</span>
				</a>
			</div>-->	
		<section class="formLegend">
			
		<form name="myform" method="post" action="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_tambah_rincian_proses.php">
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
					<span class="span2">Jenis Pemeliharaan</span>
					<select name="JenisPemeliharaan" id="JenisPemeliharaan" style="width:170px">
						<option value="Pemeliharaan Ringan" >Pemeliharaan Ringan</option>
						<option value="Pemeliharaan Sedang">Pemeliharaan Sedang</option>
					</select>
				</li>
				<li>&nbsp;</li>
				<?php
				//cek biaya dari rencana perncanaan
					$queryCek ="SELECT HargaSatuan from rencana_pemeliharaan WHERE Aset_ID = '$Aset_ID' LIMIT 1";
					$exequery = $DBVAR->query($queryCek);
					$count = $DBVAR->num_rows($exequery);
					$getData = $DBVAR->fetch_array($exequery); 			
					// echo $GetData;
					if($count != 0){
						$harga = $getData['HargaSatuan'];
					}else{
						$harga ="";
					}
					// echo $harga;
				?>
				<li>
					<span class="span2">Biaya</span>
					<input type="text" name="Biaya" id="Biaya" class=""  value="<?=$harga?>" required>
				</li>
				<li>
					<span class="span2">Keterangan</span>
					<textarea style="width:; height:;" name="keterangan" class="" ></textarea>
				</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="Simpan" id="submit" />
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					<input type="hidden" name="urlParam" class="" value="<?=$_GET['surl']?>">
					<input type="hidden" name="createdDate" class="" value="<?=date('Y-m-d')?>">
					<input type="hidden" name="Aset_ID" class="" value="<?=$Aset_ID?>">
					<input type="hidden" name="satker" class="" value="<?=$getskUrl?>">
					<input type="hidden" name="Pemeliharaan_ID" class="" value="<?=$PmlhrnID?>">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>