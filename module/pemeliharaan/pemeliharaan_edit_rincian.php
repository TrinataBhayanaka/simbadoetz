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
	
//get PemeliharaanAset_ID by url
$getUrl = decode($_GET['url']);
// pr($getUrl);
$getID=explode('=',$getUrl);
$PemeliharaanAset_ID =$getID[1];
// echo "PemeliharaanAset_ID =".$PemeliharaanAset_ID;

//get param filter ID by turl
$getUrlParamFilter = decode($_GET['turl']);

//get Aset_ID & Pemeliharaan_ID by surl
$getUrlPmlrn = decode($_GET['surl']);
// pr($getUrlPmlrn);
$tempUrl=explode('&',$getUrlPmlrn);
$getID=explode('=',$tempUrl[0]);
$getTipe=explode('=',$tempUrl[1]);
$Aset_ID =$getID[1];
// echo "Aset_ID =".$Aset_ID;
$Pemeliharaan_ID = $getTipe[1];
// echo "Pemeliharaan_ID =".$Pemeliharaan_ID;

//get noRegister,kodeKelompok,Uraian dari tabel aset
$queryPemeliharaan = "select a.noRegister,a.kodeKelompok,k.Uraian,pr.JenisPemeliharaan,pr.Biaya,pr.keterangan from aset as a
		  inner join kelompok as k ON k.Kode = a.kodeKelompok
		  inner join pemeliharaan_aset as pr ON pr.Aset_ID = a.Aset_ID
		  where a.Aset_ID = '$Aset_ID'";
// pr($queryPemeliharaan);
$exequeryTipe = $DBVAR->query($queryPemeliharaan);
$GetDataTipe = $DBVAR->fetch_array($exequeryTipe);
// pr($GetDataTipe);
$noRegister = $GetDataTipe['noRegister'];
$kodeKelompok = $GetDataTipe['kodeKelompok'];
$Uraian = $GetDataTipe['Uraian'];
$JenisPemeliharaan = $GetDataTipe['JenisPemeliharaan'];
$Biaya = $GetDataTipe['Biaya'];
$keterangan = $GetDataTipe['keterangan'];

$satker =decode($_GET['skUrl']);
// pr($satker);
//param for url
$url = "id={$Aset_ID}";
$surl = $getUrlParamFilter;
$turl = "id={$Pemeliharaan_ID}";
$skurl= "sk={$satker}";
/*echo $url;
echo "<br>";
echo $surl;
echo "<br>";
echo $turl;
echo "<br>";*/
// exit;
?>
	<script>
	jQuery(function($){
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
			
		<form name="myform" method="post" action="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_edit_rincian_proses.php">
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
				<?php
				//cek biaya dari rencana perncanaan
					if($JenisPemeliharaan == 'Pemeliharaan Ringan'){
						$a = "selected";
						$b = "";
					}else{
						$a = "";
						$b = "selected";
					}
				?>
				<li>
					<span class="span2">Jenis Pemeliharaan</span>
					<select name="JenisPemeliharaan" id="JenisPemeliharaan" style="width:170px">
						<option value="Pemeliharaan Ringan" <?=$a?>>Pemeliharaan Ringan</option>
						<option value="Pemeliharaan Sedang" <?=$b?>>Pemeliharaan Sedang</option>
					</select>
				</li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">Biaya</span>
					<input type="text" name="Biaya" id="Biaya" class=""  value="<?=$Biaya?>" required>
				</li>
				<li>
					<span class="span2">Keterangan</span>
					<textarea style="width:; height:;" name="keterangan" class="" ><?=$keterangan?></textarea>
				</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="Simpan" id="submit" />
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					<!--param url-->
					<input type="hidden" name="urlParam" class="" value="<?=$url?>">
					<input type="hidden" name="surlParam" class="" value="<?=$surl?>">
					<input type="hidden" name="turlParam" class="" value="<?=$turl?>">
					<input type="hidden" name="skurlParam" class="" value="<?=$skurl?>">
					
					<input type="hidden" name="createdDate" class="" value="<?=date('Y-m-d')?>">
					<input type="hidden" name="PemeliharaanAset_ID" class="" value="<?=$PemeliharaanAset_ID?>">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>