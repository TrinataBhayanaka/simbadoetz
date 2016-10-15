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

	   $('#NamaJabatan').on('change', function(){
		var NamaJabatan = $('#NamaJabatan').val();
		var tahun = $('#tahun').val();
		var satker = $('#satker').val();
		
		if(NamaJabatan !=''){
		$.post('../../function/api/jbtnExistCheck.php', {NamaJabatan:NamaJabatan,tahun:tahun,satker:satker}, function(result){
		if(result == 1){
			alert('Jabatan telah dibuat');
			$('#simpan').attr('disabled','disabled');
            $('#simpan').css("background","grey");
		}else{
			$('#simpan').removeAttr('disabled');
		    $('#simpan').css("background","#04c");
		}
		})
	 	 }
	});

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
		$tahun = $_GET['tahun'];
		$satker = $_GET['satker'];
		$expld  = explode('.', $satker);
		$count = count($expld);

		if($count > 1){
			//get satker_ID
			$querySatker = "SELECT satker_ID from satker where kode ='{$satker}' 
							and Kd_Ruang is null";
			//pr($querySatker);				
			$exe = $DBVAR->query($querySatker) or fatal_error('MySQL Error: ' . mysql_errno());
			$res = $DBVAR->fetch_array($exe);
			$satker = $res['satker_ID'];
		}else{
			//nothing
		}
		?>
		<section class="formLegend">
		<form name="myform" method="post" action="addpejabat.php">
			<ul>
				<li>
					<span class="span2">Jabatan</span>
					<!--<input name="NamaJabatan" id="NamaJabatan" class="span3"  type="text" value="<?=$res['NamaJabatan']?>">-->
					<select  name="NamaJabatan" class="span3" id="NamaJabatan" required>
					  <option value="" >Pilih Jabatan</option>
					  <option value="Pengguna Barang" >Pengguna Barang</option>
					  <option value="Pengurus Barang" >Pengurus Barang</option>
					  <option value="Atasan Langsung" >Atasan Langsung</option>
					  <option value="Penyimpan Barang">Penyimpan Barang</option>
					</select>
				</li>
				<br>
				<br>
				<li>
					<span class="span2">Nip Pejabat</span>
					<input name="NIPPejabat" id="NIPPejabat" class="span3"  type="text"
					>
				</li>
				<li>
					<span class="span2">Nama Pejabat</span>
					<input name="NamaPejabat" id="NamaPejabat" class="span3"  type="text"
					>
				</li>
				<li>
					<span class="span2">Keterangan</span>
					<input name="GUID" id="GUID" class="span3"  type="text"
					>
				</li>
				<li>
					<span class="span2">&nbsp;</span>
					<input type="submit" class="btn btn-primary" id="simpan" value="simpan" name="submit"/>
					<!--<input type="reset" name="reset" class="btn" value="Bersihkan Data">-->
					<input type="hidden" name="tahun" id="tahun" value="<?=$tahun?>">
					<input type="hidden" name="satker" id="satker" value="<?=$satker?>">
					
				</li>
			</ul>
		</form>

		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>