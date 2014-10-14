<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_kontrak();
// pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php

		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kontrak</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rincian Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rincian Barang</div>
				<div class="subtitle">Daftar Kontrak</div>
			</div>		

		<section class="formLegend">
			
			
			<div>
			<form action="" method="POST">
				<div class="modal-body">
				 <div class="formKontrak">
						<ul>
							<?php selectSatker(); ?>
							<li id="libidang" style="display:none">
								<span class="labelkontrak"></span>
								<select id="bidang" onchange="autoKelompok('bidang','kelompok')">
									<option></option>
								</select>	
							</li>
							<li id="likelompok" style="display:none">
								<span class="labelkontrak"></span>
								<select id="kelompok" onchange="autoKelompok('kelompok','sub')">
									<option></option>
								</select>	
							</li>
							<li id="lisub" style="display:none">
								<span class="labelkontrak"></span>
								<select id="sub" onchange="autoKelompok('sub','subsub')">
									<option></option>
								</select>	
							</li>
							<li id="lisubsub" style="display:none">
								<span class="labelkontrak"></span>
								<select id="subsub" name="kd_brg">
									<option></option>
								</select>	
							</li>
							<li>
								<span class="labelkontrak">Merk</span>
								<input type="text" name="merk"/>
							</li>
							<li>
								<span class="labelkontrak">Type</span>
								<input type="text" name="type"/>
							</li>
							<li>
								<span class="labelkontrak">Ukuran</span>
								<input type="text" name="ukuran" />
							</li>
							<li>
								<span class="labelkontrak">Panjang</span>
								<input type="text" name="panjang" />
							</li>
					 		<li>
								<span class="labelkontrak">Lebar</span>
								<input type="text" name="lebar" />
							</li>
							<li>
								<span class="labelkontrak">luas</span>
								<input type="text" name="luas" />
							</li>
							<li>
								<span class="labelkontrak">Jumlah</span>
								<input type="text" name="jumlah" id="jumlah" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="labelkontrak">Harga Satuan</span>
								<input type="text" name="hrgSatuan" id="hrgSatuan" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="labelkontrak">Total</span>
								<input type="text" name="total" id="total"/>
							</li>
							<li>
								<span class="labelkontrak">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
						</ul>
							
					</div>
					<!-- hidden -->
					<input type="hidden" name="idKontrak" value="<?=$idKontrak?>">
			</div>
			<div class="modal-footer">
			  <button class="btn" data-dismiss="modal">Kembali</button>
			  <button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>