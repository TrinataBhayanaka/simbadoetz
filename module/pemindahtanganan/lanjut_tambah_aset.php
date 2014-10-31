<?php
include "../../config/config.php";

$menu_id = 43;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
        $kd_idaset = $_POST['idgetasetid'];
		$kd_namaaset = $_POST['idgetnamaaset'];
		$kd_nokontrak = $_POST['idgetnokontrak'];
		$kd_tahun = $_POST['idgettahun'];
		$kelompok = $_POST['kelompok_id'];
		$lokasi = $_POST['lokasi_id'];
		$satker = $_POST['skpd_id'];
		$submit=$_POST['submit_aset'];
        
		$paging = $LOAD_DATA->paging($_GET['pid']);    
		if (isset($_POST['submit'])){
				if ($kd_idaset=="" && $kd_namaaset=="" && $kd_nokontrak=="" && $kd_tahun=="" && $kelompok=="" && $lokasi=="" && $satker==""){
		?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>tambah_aset_pemindahtanganan.php";
                            }
                    </script>
			<?php
				}
        }
  
        if (isset($_POST['submit']))
		{
			unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
			$data = $RETRIEVE->retrieve_penetapan_pemindahtanganan($parameter);
		}else{
			$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
			$data = $RETRIEVE->retrieve_penetapan_pemindahtanganan($parameter);
		}
	// pr($data);
	?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>
<script language="Javascript" type="text/javascript">  
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
			  <li><a href="#">Pemindahtanganan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Pemindahtanganan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $data['count'] ?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite";?>/module/pemindahtanganan/tambah_aset_pemindahtanganan.php" class="btn">
								Kembali ke halaman utama: Cari Aset</a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/pemindahtanganan/usulan_pemindahtanganan.php" name="form">  
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align="left"><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
						<td align="right"><input type="submit" align="right" value="Penetapan Pemindahtanganan" name="submit" id="submit" disabled/></td>
					</tr>
					<tr>
						<th>No</th>
						<th>&nbsp;</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
							 
			<?php 
				if (!empty($data['dataArr']))
				{
					$nomor = 1;
					$page = @$_GET['pid'];
					if ($page > 1){
						$nomor = intval($page - 1 .'01');
					}else{
						$nomor = 1;
					}


					foreach ($data['dataArr'] as $key => $value)
					{
					   
					
					?>
						  
					<tr class="gradeA">
						<td><?php echo "$nomor";?></td>
						<td>
							<?php 
								if (($_SESSION['ses_uaksesadmin'] == 1)){
										?>
										<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="PemindahtangananPenetapan[]" value="<?php echo $value->Aset_ID;?>" 
										<?php 
											for ($i = 0; $i <= count($data['asetList']); $i++){
												if ($data['asetList'][$i]==$value->Aset_ID) 
													echo 'checked';
											}?>>
										<?php
									}else{
										if ($asetList){
										if (in_array($value->Aset_ID, $asetList)){
										?>
										<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="PemindahtangananPenetapan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($data['asetList']); $i++){if ($data['asetList'][$i]==$value->Aset_ID) echo 'checked';}?>>
										<?php
										}
									}
								}
									
							?>	
						</td>
						<td>
								
							<table width='100%'>
								<tr>
									<td height="10px"></td>
								</tr>

								<tr>
									<td>
										<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo $value->Aset_ID?></span>
										<span>( Aset ID - System Number )</span>
									</td>
								</tr>
								<tr>
									<td style="font-weight:bold;"><?php echo $value->NomorReg?></td>
								</tr>
								<tr>
									<td style="font-weight:bold;"><?php echo $value->Kode?></td>
								</tr>
								<tr>
									<td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
								</tr>

							</table>

							<br>
							<hr />
							<table>
								<tr>
									<td width="20%"> No.Kontrak</td> 
									<td width="2%">&nbsp;</td>
									<td width="78%"><?php echo $value->NoKontrak?></td>
								</tr>
								<tr>
									<td>Satker</td> <td>&nbsp;</td><td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
								</tr>
								<tr>
									<td>Lokasi</td> <td>&nbsp;</td><td><?php echo $value->NamaLokasi?></td>
								</tr>
								<tr>
									<td>Status</td><td>&nbsp;</td> <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
								</tr>

							</table>
						</td>
					</tr>
					
				     <?php
						$nomor++;
						}}
					?> 
					
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>