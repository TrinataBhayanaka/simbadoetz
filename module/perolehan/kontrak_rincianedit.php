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
				 <div class="formKontrak">
						<ul>
							<?php selectAset(); ?>
							<li>&nbsp;
							</li>
							<li>
								<span class="span2">Merk</span>
								<input type="text" name="merk"/>
							</li>
							<li>
								<span class="span2">Tipe</span>
								<input type="text" name="type"/>
							</li>
							<li>
								<span class="span2">Ukuran</span>
								<input type="text" name="ukuran" />
							</li>
							<li>
								<span class="span2">Panjang</span>
								<input type="text" name="panjang" />
							</li>
					 		<li>
								<span class="span2">Lebar</span>
								<input type="text" name="lebar" />
							</li>
							<li>
								<span class="span2">luas</span>
								<input type="text" name="luas" />
							</li>
							<li>
								<span class="span2">Jumlah</span>
								<input type="text" name="jumlah" id="jumlah" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="span2">Harga Satuan</span>
								<input type="text" name="hrgSatuan" id="hrgSatuan" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="span2">Total</span>
								<input type="text" name="total" id="total"/>
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
							<li>
								<span class="span2">
								  <button class="btn" type="reset">Reset</button>
								  <button type="submit" class="btn btn-primary">Simpan</button></span>
							</li>
						</ul>
							
					</div>
					<!-- hidden -->
					<input type="hidden" name="idKontrak" value="<?=$idKontrak?>">
			
			
		</form>
		</div>  
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>