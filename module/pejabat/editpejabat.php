<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 73;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
?>
	<script>
	jQuery(function($){
	   $("#Tahun").mask("9999");
	   $("select").select2();
	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pejabat</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Daftar Pejabat</div>
			<div class="subtitle">Filter Pejabat</div>
		</div>
		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/pejabat/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Daftar Pejabat</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/pejabat/export.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Export Pejabat</span>
				</a>
			</div>
		<?php
		//temp sql
		$Pejabat_ID = $_GET['id'];
		$tahun = $_GET['tahun'];
		$satker = $_GET['satker'];
		
		$query = "SELECT * from pejabat where Pejabat_ID ='{$Pejabat_ID}'";
		//pr($querySatker);				
		$exe = $DBVAR->query($query) or fatal_error('MySQL Error: ' . mysql_errno());
		$res = $DBVAR->fetch_array($exe);
		if($res['NamaJabatan'] =='Pengguna Barang') {
			$a = 'selected';
			$b = '';
			$c = '';
			$d = '';
		}elseif($res['NamaJabatan'] =='Pengurus Barang'){
			$a = '';
			$b = 'selected';
			$c = '';
			$d = '';
		}elseif ($res['NamaJabatan'] =='Atasan Langsung') {
			$a = '';
			$b = '';
			$c = 'selected';
			$d = '';
		}elseif ($res['Penyimpan Barang'] =='Penyimpan Barang') {
			$a = '';
			$b = '';
			$c = '';
			$d = 'selected';
		}
		?>

		<section class="formLegend">
		<form name="myform" method="post" action="updatepejabat.php">
			<ul>
				<li>
					<span class="span2">Jabatan</span>
					<!--<input name="NamaJabatan" id="NamaJabatan" class="span3"  type="text" value="<?=$res['NamaJabatan']?>">-->
					<select  name="NamaJabatan" class="span3" disabled>
					  <option value="Pengguna Barang" <?=$a?>>Pengguna Barang</option>
					  <option value="Pengurus Barang" <?=$b?>>Pengurus Barang</option>
					  <option value="Atasan Langsung" <?=$c?>>Atasan Langsung</option>
					  <option value="Penyimpan Barang" <?=$d?>>Penyimpan Barang</option>
					</select>
				</li>
				<br>
				<br>
				<li>
					<span class="span2">Nip Pejabat</span>
					<input name="NIPPejabat" id="NIPPejabat" class="span3"  type="text"
					value="<?=$res['NIPPejabat']?>">
				</li>
				<li>
					<span class="span2">Nama Pejabat</span>
					<input name="NamaPejabat" id="NamaPejabat" class="span3"  type="text"
					value="<?=$res['NamaPejabat']?>">
				</li>
				<li>
					<span class="span2">Keterangan</span>
					<input name="GUID" id="GUID" class="span3"  type="text"
					value="<?=$res['GUID']?>">
				</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" value="simpan" name="submit"/>
					<!--<input type="reset" name="reset" class="btn" value="Bersihkan Data">-->
					<input type="hidden" name="tahun" value="<?=$tahun?>">
					<input type="hidden" name="satker" value="<?=$satker?>">
					<input type="hidden" name="Pejabat_ID" value="<?=$Pejabat_ID?>">
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>