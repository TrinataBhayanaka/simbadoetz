<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 59;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
	// pr($_POST);
	// $asetList=implode(',',$_POST['id_aset']);
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	

?>
	<script>
	jQuery(function($){
	   $("#Tahun_aw,#Tahun_ak,#register_aw,#register_ak").mask("9999");
	   $("select").select2();
	   $( "#tglPerubahan").mask('9999-99-99');
	 //$( "#tglPerubahan" ).datepicker({ dateFormat: 'yy-mm-dd' });
	  // $( "#tglPerubahan" ).datepicker({ format: 'yyyy-mm-dd',autoclose:true,clearBtn:true,forceParse:true });
			
	});
	function check(){
		var satker = document.getElementById("kodeRuang");
		// alert(satker);
		 if(satker.value == ''){
			alert('Pilih Ruangan');
			return false;
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
			$kodeSatker = $_POST['kodeSatker'];
			$kodeRuangan = $_POST['kodeRuang'];
			$tahunRuangan = $_POST['tahunRuangan'];
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
		
		<form name="myform" method="post" action="<?=$url_rewrite?>/module/kir/proses_pindah_ruangan.php" onsubmit="return check(this)";>
			<?php //$_SESSION['ses_filter_ruangan_kir'] = $_POST;?>
			<input type="hidden" name ="kodeSatker" id="" value="<?=$kodeSatker?>">
			<input type="hidden" name ="tahunRuangan" id="" value="<?=$tahunRuangan?>">
			<!--<input type="hidden" name ="kodeRuangan" id="" value="<?//=$kodeRuangan?>">-->
			<!--<input type="hidden" name ="asetList" id="" value="<?//=$asetList?>">-->
			
			<ul>
				<li>
					<span class="span2">Ruangan Tujuan</span>
					<select name="kodeRuang" id="kodeRuang" style="width:170px">
						<option value="">-</option>
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
					<span class="span2">Tgl Perubahan</span>
					<!--<div class="input-prepend"><span class="add-on"><i class="fa fa-calendar"></i></span>-->
							<!--<input type="text" class="span2 full" name="tglPerubahan" id="tglPerubahan" value="" required/>--> 
							<input type="text" class="span2 full" name="tglPerubahan" id="datepicker2" value="" required> 
						<!--</div>-->
				</li>
				<li>
					*)Tgl Perubahan Disesuaikan Dengan Tahun Berlaku Rekapitulasi
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