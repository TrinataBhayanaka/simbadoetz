<?php
include "../../config/config.php";


?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	

	$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;

	// pr($_GET);
    $data = $PENGGUNAAN->daftarPenggunaanValid_detail($_GET);
    if ($data){
    	$disableButton = false;
    	if ($data[0]['FixMutasi']>0) $disableButton = true;
    }

    // pr($data);	
?>
  <!-- buat alert-->

        <script type="text/javascript">
            
            <!--
            function sendit(){
                alert("OK");
                document.location="transfer_antar_skpd.php";
            }
            -->
            <!--
            function sendit_1(){
                alert("SUCCESS");
                document.location="transfer_hasil_filter.php";
            }
            -->
            <!--
            function sendit_2(){
                document.location="transfer_hasil_filter.php?pid=1";
            }
            -->
            <!--
            function sendit_3(){
                alert("OK")
                document.location="hasil_transfer_1.php";
            }
            -->
        </script>
        
        
        <script type="text/javascript">

        	$(document).ready(function() {
				
				var tes=document.getElementsByTagName('*');
				var button=document.getElementById('submit');
				var boxeschecked=0;
				for(k=0;k<tes.length;k++)
				{
					if(tes[k].className=='checkbox')
						{
							//
							tes[k].checked == true  ? boxeschecked++: null;
						}
				}
			//alert(boxeschecked);
				if(boxeschecked!=0){
					button.disabled=false;
				}
				else {
					button.disabled=true;
				}
				
			} );

            
			function AreAnyCheckboxesChecked () 
			{
				setTimeout(function() {
			  if ($("#Form2 input:checkbox:checked").length > 0)
				{
				    $("#submit").removeAttr("disabled");
				}
				else
				{
				   $('#submit').attr("disabled","disabled");
				}}, 100);
			}

			$(document).on('click','.hapus_aset', function(){

				var idaset = $(this).attr('asetid');
				var mutasiid = $(this).attr('mutasiid');

				// setTimeout(function(){

					$.post(basedomain+'/function/phpajax/ajax.php',{hapusAset:true, idaset:idaset, mutasiid:mutasiid}, function(data){

			            var html = "";

			            if (data.status==true){
			                
			            	location.reload();
			               
			            } else {
			              	$('.formData').html('Load data gagal');
			            }
			            
			            

			        }, "JSON")

				// }, 2000);
				 
				
			})

			function konfirmasiHapus()
			{
				var r = confirm("Hapus rincian mutasi ?");
	            if (r == true) {

	            }else{
	            	return false;
	            }
			}

			function enable(){
				var tes=document.getElementsByTagName('*');
				var button=document.getElementById('submit');
				var boxeschecked=0;
				for(k=0;k<tes.length;k++)
				{
					if(tes[k].className=='checkbox')
						{
							//
							tes[k].checked == true  ? boxeschecked++: null;
						}
				}
					//alert(boxeschecked);
				if(boxeschecked!=0)
					button.disabled=false;
				else
					button.disabled=true;
			}

			function disable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				if (disable){
					button.disabled=true;
				} 
			}
			function enable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				if (enable){
					button.disabled=false;
				} 
			}

		</script>
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Penggunaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Penggunaan Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Penggunaan Barang</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
                            
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $jml?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/penggunaan/penggunaan_validasi_daftar_valid.php?pid=1";?>" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
								
							</li>
							<!--
							<li>
								<a href="<?php echo "$url_rewrite/module/mutasi/"; ?>validasi_transfer_hasil_daftar.php?pid=1" class="btn">
									   Daftar Barang Mutasi
								 </a>
							</li>-->
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
								   <ul class="pager">
										
										<?php 
								   		$prev = intval($_GET['pid']-1);
								   		$next = intval($_GET['pid']+1);
								   		?>
								   		<li><a href="<?php echo"$url_rewrite/module/penggunaan/detail_usulan_penggunaan.php?pid=$prev&id=$_GET[id]";?>" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="<?php echo"$url_rewrite/module/penggunaan/detail_usulan_penggunaan.php?pid=$next&id=$_GET[id]";?>" class="buttonnext1">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<form name="form" id="Form2" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>hapus_usulan_mutasi.php" onsubmit="return konfirmasiHapus()">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="example">
				<thead>
					<?php if (!$disableButton):?>
					<tr>
						<!--
						<td  align="left" colspan="9">   
							<input type="submit" name="submit" value="Hapus rincian dari usulan" class="btn btn-danger" id="submit" disabled/>
						</td>-->
					</tr>
					<?php endif;?>
					<tr>
						<!--<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						-->
						<th>Kode Barang</th>
						<th>No Register</th>
						<th>No Polisi</th>
						<th>Nilai Perolehan</th>
						<th>Tahun</th>
						<th>Uraian</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
					if (!empty($data))
					{
					
					
						// $no = 1;
						$no = 1;
						$page = @$_GET['pid'];
						if ($page > 1){
							$no = intval($page - 1 .'01');
						}else{
							$no = 1;
						}
						foreach ($data as $key => $value)
						{
				?>
				
					<tr class="gradeA">
						<!--
						<td class="checkbox-column">
							<?php if ($value['Status']==0): ?>
							<input type="checkbox"  class="checkbox" onchange="enable()" name="aset_id[]" value="<?php echo $value['Aset_ID'];?>" >
							<?php endif;?>
													
						</td>-->
						<td><?php echo $value['kodeKelompok']?></td>
						<td><?php echo $value['noRegister']?></td>
						<td><?php echo @$value['aset'][0]['NoSTNK']?></td>
						<td style="font-weight: bold;"> <?php echo number_format($value['NilaiPerolehan']);?> </td>
						<td style="font-weight: bold;"><?php echo $value['Tahun'];?></td>	
						<td>
							<?php echo "$value[Uraian]";?>
							<input type="hidden" name="Mutasi_ID" value="<?php echo $data[0]['Mutasi_ID']?>">
							<input type="hidden" name="aset_id_count[]" value="<?php echo $value['Aset_ID']?>">
							<input type="hidden" name="noDokumen" value="<?php echo $data[0]['NoSKKDH']?>">
							<input type="hidden" name="TglSKKDH" value="<?php echo $data[0]['TglSKKDH']?>">
							

						
						</td>	
						<?php 
						$status = $value['Status'];
						if ($status == 0) {$statusMutasi = "Pending Validasi"; $label = "label-warning";}
						if ($status == 1) {$statusMutasi = "Sudah di Validasi"; $label = "label-success";}
						if ($status == 3) {$statusMutasi = "Usulan dihapuskan"; $label = "label-danger";}
						?>
						<td><span class="label <?=$label?>"><?=$statusMutasi?></span></td>
						
					</tr>
					 <?php 
						$no++; 
							} 
						}
						  else
						{
							$disabled = 'disabled';
						}
						?>
				</tbody>
				
			</table>
			</form>
			</div>
			<div class="spacer"></div>
			

			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>
