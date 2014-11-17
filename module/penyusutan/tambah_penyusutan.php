<?php
include "../../config/config.php";
$menu_id = 53;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
           $data= $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
     //      pr($Session);

$get_data_penyusutan= $PENYUSUTAN->getStatusPenyusutan();
// pr($_SESSION);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	
	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Tambah Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Status Penyusutan Aset</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Tambah Penyusutan Aset Tahun Pertama</div>
				<div class="subtitle">Daftar Aset</div>
			</div>	

			
                    <?php
                    $KelompokAset=array("0"=>"Peralatan dan Mesin (B)",
                                           "1"=>"Gedung dan Bangunan (C)",
                                             "2"=>"Jalan, Irigrasi, dan Jaringan (D)",
                                             "3"=>"Aset Tetap Lainnya (E)");
                    $query="select KelompokAset from penyusutan_tahun_pertama";
                    $result=$DBVAR ->query($query) or die($DBVAR ->error());
                    while ($data=$DBVAR ->fetch_object($result)){
                         $KelompokAsetPenyusutan[]=$data->KelompokAset;
                    }
                    ?>
		<section class="formLegend">
			
			<p><a href="index.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Daftar Penyusutan</a>
			&nbsp;
			<!-- <a class="btn btn-danger btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Kontrak Simral</a>
			&nbsp; --></p>	
                  <form name="lda_filter" action="<?php echo "$url_rewrite/module/penyusutan/proses_daftar.php"; ?>" method="post">
                       <ul>
                            <li>
								<span>Tipe Aset</span><br/>
                                                <select name="KelompokAset"  required="1">
                                                     <option value=""></option>
                                                     <?php for($i=0;$i<count($KelompokAset); $i++){
                                                          if(!in_array($KelompokAset[$i], $KelompokAsetPenyusutan))
                                                                  echo "<option value='{$KelompokAset[$i]}'>{$KelompokAset[$i]}</option>";
                                                     }
                                                     $tahun=date("Y");
?>
                                                </select>
                                                </li>
                                                <li><span>Tahun Penyusutan Pertama</span><?=$tahun?></li>
                                                <li><input type="submit" name="Simpan" class="btn btn-primary">&nbsp;&nbsp; <input type="reset" name="Reset" class="btn btn-warning"></li>
                       </ul>
                       <input type="hidden" value="1" name="status_daftar">
                  </form>
			<div class="spacer"></div>
			    
		</section> 
		<div id="myModal" class="modal hide fade modalkontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div id="titleForm" class="modal-header" >
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 id="myModalLabel"><i class="fa fa-plus-square"></i>&nbsp;Form Tambah Kontrak</h3>
				</div>
				<form action="" method="POST">
				<div class="modal-body">
				 <div class="formKontrak">
						<h3 class="grs-bottom"><i class="fa fa-file-text"></i>&nbsp;<span>Kontrak</span></h3>
						<ul>
							<li>
								<span class="labelkontrak">No.SPK/Perjanjian Kontrak</span>
								<input type="text" name="noKontrak" required/>
							</li>
							<li>
								<span class="labelkontrak">Tgl.SPK/Perjanjian Kontrak</span>

								<input type="text" name="tglKontrak" id="datepicker" required/>

							</li>
							<li>
								<span class="labelkontrak">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
							<li>
								<span  class="labelkontrak">Jangka Waktu</span>
								<input type="text" name="jangkaWkt"/>
							</li>
							<li>
								<span  class="labelkontrak">Nilai</span>
								<input type="text" name="nilai" required/>
							</li>
							<li>
								<span  class="labelkontrak">Jenis Posting</span>
								<input type="radio" name="tipeAset" value="1"/>&nbsp;Aset Baru
								<input type="radio" name="tipeAset" value="2"/>&nbsp;Kapitalisasi
								<input type="radio" name="tipeAset" value="3"/>&nbsp;Ubah Status
							</li>
						</ul>
							
					</div>
					<div class="formPerusahaan">
						<h3 class="grs-bottom"><i class="fa fa-briefcase"></i>&nbsp;<span>Perusahaan</span></h3>
						<ul>
							<li>
								<span class="labelperusahaan">Nama</span>
								<input type="text" name="nm_p"/>
							</li>
							<li>
								<span class="labelperusahaan">Bentuk</span>
								<input type="text" name="bentuk"/>
							</li>
							<li>
								<span class="labelperusahaan">Alamat</span>
								<input type="text" name="alamat"/>
							</li>
							<li>
								<span class="labelperusahaan">Pimpinan</span>
								<input type="text" name="pimpinan_p"/>
							</li>
							<li>
								<span class="labelperusahaan">NPWP</span>
								<input type="text" name="npwp_p" />
							</li>
							<li>
								<span class="labelperusahaan">Bank</span>
								<input type="text" name="bank_p" />
							</li>
							<li>
								<span class="labelperusahaan">Atas Nama</span>
								<input type="text" name="norek_p" />
							</li> 
							<li>
								<span class="labelperusahaan">No.Rekening</span>
								<input type="text" name="norek_pemilik" />
							</li>
						</ul>
					</div>
					
				</div>
			
			<div class="modal-footer">
			  <button class="btn" data-dismiss="modal">Kembali</button>
			  <button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
		</div>        
	</section>
	
<?php
	include"$path/footer.php";
?>