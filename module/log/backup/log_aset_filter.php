 
<?php
include "../../config/config.php";
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	 $menu_id = 1;
     $SessionUser = $SESSION->get_session_user();
     ($SessionUser['ses_uid'] != '') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title' => 'GuestMenu', 'ses_name' => 'menu_without_login'));
     $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
	 $resetDataView = $DBVAR->is_table_exists('lihat_daftar_aset_'.$SessionUser['ses_uoperatorid'], 0);
	
?>
	

	
     <script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#lda_ia").keypress(function (e)  
               {
                    //if the letter is not digit then display error and don't type anything
                    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                    {
                         //display error message
                         $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                         return false;
                    }	
               });
          });
     </script>
     <script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#lda_nk").keypress(function (e)  
               { 
                    //if the letter is not digit then display error and don't type anything
                    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                    {
                         //display error message
                         $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                         return false;
                    }	
               });
          });
     </script>
     <script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#lda_tp").keypress(function (e)  
               { 
                    //if the letter is not digit then display error and don't type anything
                    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                    {
                         //display error message
                         $("#errmsg3").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                         return false;
                    }	
               });

          });

          	function checkJenisAset()
            {
                var jenisaset1 = $('.jenisaset1').is(":checked")
                var jenisaset2 = $('.jenisaset2').is(":checked")
                var jenisaset3 = $('.jenisaset3').is(":checked")
                var jenisaset4 = $('.jenisaset4').is(":checked")
                var jenisaset5 = $('.jenisaset5').is(":checked")
                var jenisaset6 = $('.jenisaset6').is(":checked")

                if (jenisaset1 == false && jenisaset2 == false && jenisaset3 == false && jenisaset4 == false && jenisaset5 == false && jenisaset6 == false){
                    alert('Pilih Jenis Aset');
                    return false;
                }

                
            }


            $( "#lda_tp" ).mask('9999'); 
     </script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Layanan Umum</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Log Daftar Aset</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Log Daftar Aset</div>
			<div class="subtitle">Filter Daftar Aset</div>
		</div>
		
		
		<section class="formLegend">
			
			<form method="POST" action="<?php echo"$url_rewrite"?>module/log/log_aset_daftar.php" >
				<ul>
					<li>&nbsp;</li>
					<li><i>*) <u>cukup isi field <strong class="blink_text_red" >Tipe Aset</strong> & <strong class="blink_text_red">Kode Satker</strong> untuk menampilkan seluruh data </u></i></li>
					<li>&nbsp;</li>
					<li>
						<span class="span2">Nomor Kontrak</span>
						<input type='text' style="width: 200px;" name="bup_nokontrak" placeholder=""/>
					</li>
					<li>
						<span class="span2">Tahun Perolehan</span>
						<input type='text' id="#lda_tp" maxlength="4" name="bup_tahun" placeholder="" />
					</li>
                    <li>&nbsp;</li>

					<?php selectAset('kodeKelompok','235',true,false); ?>

                    <li>&nbsp;</li>
                  <li><span class="span2">Status Aset</span>
                                    <select name="statusaset">
                                        <option value="1">Terdistribusi</option>
                                        <option value="0">Belum Terdistribusi</option>
                                        <option value="27">Dihapus</option>
                                        <option value="13">Perubahan Status</option>
                                        
                                    </select>
                </li>
					<li>
						<span class="span2">Tipe Aset</span>
						<select name="jenisaset" style="width:170px" id="jenisaset" required>

							<option value="">Pilih Tipe Aset</option>
							<option value="A">Tanah</option>
							<option value="B">Mesin</option>
							<option value="C">Bangunan</option>
							<option value="D">Jaringan</option>
							<option value="E">Aset Tetap Lain</option>
							<option value="F">KDP</option>
						</select><!-- 
                        <span class="span2">Jenis Aset</span>
                        <input type="checkbox" name="jenisaset[]" value="1" class="jenisaset1">Tanah
                        <input type="checkbox" name="jenisaset[]" value="2" class="jenisaset2">Mesin
                        <input type="checkbox" name="jenisaset[]" value="3" class="jenisaset3">Bangunan
                        <input type="checkbox" name="jenisaset[]" value="4" class="jenisaset4">Jaringan
                        <input type="checkbox" name="jenisaset[]" value="5" class="jenisaset5">Aset Lain
                        <input type="checkbox" name="jenisaset[]" value="6" class="jenisaset6">KDP
                        --> <?php
                        	if($id!=""){?>
                        	<input type="hidden" name="usulanID" value="<?=$id?>">
                     
                       <?php 	}
                        ?>
                    </li>  
                    <li>&nbsp;</li>
					<?=selectSatker('kodeSatker',$width='205',$br=true,(isset($kontrak)) ? $kontrak[0]['kodeSatker'] : false);?>
                    <li>&nbsp;</li>
					<li>
						<span class="span2">&nbsp;</span>
						<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
						<input type="hidden" name="filterAsetUsulan" value="1" />
						<input type="reset" name="reset" class="btn" value="Bersihkan Data">
					</li>
				</ul>
			</form>
			    
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>

