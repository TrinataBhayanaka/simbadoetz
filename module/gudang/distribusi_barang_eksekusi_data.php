<?php
include "../../config/config.php";
if($_GET['id']){
	$dataArr = $RETRIEVE->retrieve_transferAset($_GET['id']);
}
// pr($dataArr);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";

	 if(isset($_POST['toSatker'])){
	    if($_GET['id'] == "")
	    {
	      // pr($_POST);exit;
	      $dataArr = $STORE->store_transfer($_POST);
	    }  else
	    {
	      $dataArr = $STORE->store_edit_transfer($_POST,$_GET['id']);
	    }
	    	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/gudang/distribusi_barang.php\">";
	    	exit;
	  }

?>
	<script>
	jQuery(function($){
		$("#datepicker").mask("9999-99-99");
	});
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Distribusi Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Distribusi Barang</div>
			<div class="subtitle">Transfer SKPD</div>
		</div>
		<section class="formLegend">
			
			<form action='' method='post' name='formvalid'>
			<ul>
				<?=selectAllSatker('toSatker','205',true,(isset($dataArr) ? $dataArr['toSatker'] : ''),'required',false);?>
			</ul>
			<ul>
							<li>
								<span class="span2">Nomor Dokumen</span>
								<input type="text" name="noDokumen" id="no_dokumen" style="width:205px;" value="<?=(isset($dataArr) ? $dataArr['noDokumen'] : '')?>" required>
							</li>
							<li>
								<span class="span2">Tanggal Proses</span>
								<input type="text" placeholder="yyyy-mm-dd" id="datepicker" name="tglDistribusi" value="<?=(isset($dataArr) ? $dataArr['tglDistribusi'] : '')?>" style="width:205px;" required>
							</li>
							<li>
								<span class="span2">Alasan</span>
								<textarea name="alasan" cols="90" rows="5"><?=(isset($dataArr) ? $dataArr['alasan'] : '')?></textarea>
							</li>
							
						</ul>
						
						<div style="height:5px;width:100%;clear:both"></div>
			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="span2"><strong>Pihak Penyimpan</strong></span><br/><hr/>
							</li>
							<li>
								<span class="span2">Nama</span>
								<input type="text" name="nama_penyimpan" value="<?=(isset($dataArr) ? $dataArr['nama_penyimpan'] : '')?>">
								
							</li>
							<li>
								<span class="span2">Pangkat/Golongan</span>
								<input type="text" name="pangkat_penyimpan" value="<?=(isset($dataArr) ? $dataArr['pangkat_penyimpan'] : '')?>">
							</li>
							<li>
								<span class="span2">NIP</span>
								<input type="text" name="nip_penyimpan" value="<?=(isset($dataArr) ? $dataArr['nip_penyimpan'] : '')?>">
							</li>
							<li>
								<span class="span2">Nama Atasan</span>
								<input type="text" name="nama_atasan" value="<?=(isset($dataArr) ? $dataArr['nama_atasan'] : '')?>">
							</li>
							<li>
								<span class="span2">Pangkat/Golongan</span>
								<input type="text" name="pangkat_atasan" value="<?=(isset($dataArr) ? $dataArr['pangkat_atasan'] : '')?>">
							</li>
							<li>
								<span class="span2">NIP</span>
								<input type="text" name="nip_atasan" value="<?=(isset($dataArr) ? $dataArr['nip_atasan'] : '')?>">
							</li>
							<li>
								<span class="span2">Jabatan</span>
								<input type="text" name="jabatan_penyimpan" value="<?=(isset($dataArr) ? $dataArr['jabatan_penyimpan'] : '')?>">
							</li>
						</ul>
							
					</div>
			<div class="detailLeft">
						
						<ul>
							
							<li>
								<span class="span2"><strong>Pihak Pengurus</strong></span><br/><hr/>
							</li>
							<li>
								<span class="span2">Nama</span>
								<input type="text" name="nama_pengurus" value="<?=(isset($dataArr) ? $dataArr['nama_pengurus'] : '')?>">
							</li>
							<li>
								<span class="span2">Pangkat/Golongan</span>
								<input type="text" name="pangkat_pengurus" value="<?=(isset($dataArr) ? $dataArr['pangkat_pengurus'] : '')?>">
							</li>
							<li>
								<span class="span2">NIP</span>
								<input type="text" name="nip_pengurus" value="<?=(isset($dataArr) ? $dataArr['nip_pengurus'] : '')?>">
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
							<ul>
							<li>
								<span class="span2">&nbsp;</span>

								<input type="hidden" name="fromSatker" value="<?=$_SESSION['ses_satkerkode']?>">

								<input type="submit" class="btn btn-primary" value="Simpan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
							</ul>
			</form>
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>

