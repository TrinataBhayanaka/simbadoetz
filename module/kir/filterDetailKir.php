<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 59;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
// pr($SessionUser);
	// pr($_GET);
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	

?>
	<script>
	jQuery(function($){
	   $("#Tahun_aw,#Tahun_ak,#register_aw,#register_ak").mask("9999");
	   $("select").select2();
	});
	
	function check(){
		var satker = document.getElementById("satker");
		// alert(satker);
		var satkerfilter = document.getElementById("kodeSatker");
		 if(satker.value != satkerfilter.value){
			alert('KodeSatker Harus Sama\n Dengan Filter KodeSatker KIR');
			return false;
		}
	}
	
	function check_tahun(){
		var tahun_aw = document.getElementById("Tahun_aw");
		var tahun_ak = document.getElementById("Tahun_ak");
		if (tahun_ak.value < tahun_aw.value)
		{
			alert('Tahun Awal Tidak Boleh Lebih Kecil \n Dari Tahun Akhir');
			$('#submit').attr('disabled','disabled');
            $(submit).css("background","grey");
			// return false;
		}else{
			$('#submit').removeAttr('disabled');
		    $('#submit').css("background","#04c");
		}
	}
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">KIR</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Daftar Ruangan UPB</div>
			<div class="subtitle">Filter Ruangan</div>
		</div>
		<div class="grey-container shortcut-wrapper">
			<a class="shortcut-link " href="<?=$url_rewrite?>/module/kir/filter_ruangan.php">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-inverse fa-stack-1x">1</i>
				</span>
				<span class="text">Daftar Ruangan UPB</span>
			</a>
			<a class="shortcut-link" href="<?=$url_rewrite?>/module/kir/filter_ruangan_export.php">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-inverse fa-stack-1x">2</i>
				</span>
				<span class="text">Export Ruangan</span>
			</a>
			<a class="shortcut-link active" href="<?=$url_rewrite?>/module/kir/filter_ruangan_kir.php">
				<span class="fa-stack fa-lg">
				  <i class="fa fa-circle fa-stack-2x"></i>
				  <i class="fa fa-inverse fa-stack-1x">3</i>
				</span>
				<span class="text">KIR</span>
			</a>
		</div>
		<?php
			$kodeSatker = $_GET['kdS'];
			$kodeRuangan = $_GET['kdR'];
			$tahunRuangan = $_GET['thn'];
			//get nama ruangan
			$queryRuangan =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker' and Kd_Ruang = '$kodeRuangan'
								and Tahun = '$tahunRuangan'");
			$resultRuangan = $DBVAR->fetch_array($queryRuangan);	
			//get nama satker
			$querySatker =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker'");
			$resultSatker = $DBVAR->fetch_array($querySatker);	
		?>
			
		<section class="formLegend">
		<div class="grey-container">
			<table>
			<tr>
				<td><span class="labelInfo">Satker</span>
				<input type="text" style="width:300px"  value="<?=$kodeSatker." / ".$resultSatker['NamaSatker']?>" disabled/></td>
				<td>
				<span class="labelInfo">Nama Ruangan</span>
				<input type="text" style="width:300px" value="<?=$resultRuangan['NamaSatker']?>" disabled/></td>
				<td>
				<span class="labelInfo">Tahun Ruangan</span>
				<input type="text" style="width:300px" value="<?=$tahunRuangan?>" disabled/></td>
			</tr>
			</table>
		</div>
		<div style="height:5px;width:100%;clear:both"></div>
		<br>
		<!--<form name="myform" method="post" action="<?=$url_rewrite?>/module/kir/dftr_aset.php?kdS=<?//=$_GET[kdS]?>&kdR=<?//=$_GET[kdR]?>&thn=<?//=$_GET[thn]?>" onsubmit="return check(this)";>-->
		
		<form name="myform" method="post" action="<?=$url_rewrite?>/module/kir/dftr_aset.php?kdS=<?=$_GET[kdS]?>&kdR=<?=$_GET[kdR]?>&thn=<?=$_GET[thn]?>">
			<?php //$_SESSION['ses_filter_ruangan_kir'] = $_POST;?>
			<input type="hidden" name ="kodeSatker" id="satker" value="<?=$kodeSatker?>">
			<input type="hidden" name ="tahunRuangan" id="satker" value="<?=$tahunRuangan?>">
			<input type="hidden" name ="kodeRuangan" id="satker" value="<?=$kodeRuangan?>">
			
			<ul>
				<li>
					<span class="span2">Tahun Perolehan</span>
					<input name="Tahun_aw" id="Tahun_aw" class="span1"  type="text" required>
					s/d
					<input name="Tahun_ak" id="Tahun_ak" class="span1"  type="text" onblur="return check_tahun(this);"  required>
				</li>
				<? //=selectSatker('kodeSatker','235',true,false,'required');?>
				<!--<li>&nbsp;</li>-->
				<?php selectAset('kodeKelompok','235',true,false); ?>
				<li>&nbsp;</li>
				<li>
					<span class="span2">Kode Register</span>
					<input type="number" name="register_aw" id="" class="span1"  type="text" value="1">
					s/d
					<input type="number" name="register_ak" id="" class="span1"  type="text" value="1">
				</li>
				<li>
					<span class="span2">Kode Pemilik</span>
					<select name="kodeLokasi" id="kodeLokasi" style="width:200px">
						<option value="12" selected="">12 - Pemerintah Kota</option>
						<option value="11">11 - Pemerintah Provinsi</option>
						<option value="00">00 - Kementrian Lembaga</option>
					</select>
				</li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">Tipe Aset</span>
					<select name="tipeAset" id="tipeAset" style="width:170px">
						<option value="tanah">Tanah</option>
						<option value="mesin">Mesin</option>
						<option value="bangunan">Bangunan</option>
						<option value="jaringan">Jaringan</option>
						<option value="asetlain">Aset Lain</option>
						<option value="kdp">KDP</option>
					</select>
				</li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">Ruangan</span>
					<select name="ruangan" id="ruangan" style="width:170px">
						<option value="">-</option>
						<option value="all">All</option>
						<?php 
							$queryRuangan = "select NamaSatker,Kd_Ruang from satker where kode ='$kodeSatker' and Tahun = '$tahunRuangan' and Kd_Ruang != '$kodeRuangan'";
							$exequeryRuangan = $DBVAR->query($queryRuangan);	
							
						while($data=$DBVAR->fetch_array($exequeryRuangan))
						{
						// pr($data);
						?>
							<option value="<?=$data['Kd_Ruang']?>"><?= $data['NamaSatker']?></option>
						<?php
						}?>
					</select>
				</li>
				<li>&nbsp;</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="Tampilkan Data" id="submit" />
					<input type="reset" name="reset" class="btn" value="Bersihkan Data">
				</li>
			</ul>
		</form>
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>