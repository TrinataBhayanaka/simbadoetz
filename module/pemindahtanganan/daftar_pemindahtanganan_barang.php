<?php
ob_start();

include "../../config/config.php";
         
$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$submit = $_POST['tampil'];


	$paging = paging($_GET['pid'], 100);    
 
	if (isset($submit))
	{
		// echo "filter";
		$POST['kd_idaset'] = $_POST['bupt_idaset'];
		$POST['kd_namaaset'] = $_POST['bupt_namaaset'];
		$POST['bupt_nokontrak'] = $_POST['kd_nokontrak'];
		$POST['kd_tahun'] = $_POST['bupt_tahun'];
		$POST['kelompok_id']= $_POST['kelompok_id'];
		$POST['lokasi_id']= $_POST['lokasi_id'];
		$POST['satker']= $_POST['skpd_id'];
		$POST['ngo_id']= $_POST['ngo_id'];
		$POST['modul']= "";
		$POST['paging'] = $_GET['pid'];
		$POST['sql_where'] = TRUE;
		$POST['sql'] = "Status_Validasi_Barang = 1 AND Usulan_Pemindahtanganan_ID IS NULL AND Dihapus != 0 AND 
						Usulan_Pemusnahan_ID IS NULL";
		// pr($POST);
		unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
		$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$POST,'paging'=>$paging);
		$data = $RETRIEVE->retrieve_pemindahtanganan_filter($parameter);
	}else{
		// echo "tanpa filter";
		// $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
		$sessi = 1;
		$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
		$data = $RETRIEVE->retrieve_pemindahtanganan_filter($parameter);
		
	}
	// echo"<pre>";
	// pr($data);
	// echo"</pre>";
	

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>
<script language="Javascript" type="text/javascript">  
		
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
	<script type="text/javascript" charset="utf-8">
	 
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
	</script>       


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemindahtanganan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Buat Usulan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Usulan Pemindahtanganan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $_SESSION['parameter_sql_total']?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite";?>/module/pemindahtanganan/pemindahtanganan.php" class="btn">
								Kembali ke halaman utama: Cari Aset</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/";?>module/pemindahtanganan/pemindahtanganan_daftar_aset_fix.php?pid=1" class="btn">
								Daftar Usulan Barang</a>
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
						<td align="right"><input type="submit" align="right" value="Usulan Pemindahtanganan" name="submit" id="submit" disabled/></td>
					</tr>
					<tr>
						<th>No</th>
						<th>&nbsp;</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
							 
				
                    <?php 
    
					// if ($_GET['pid'] == 1) $no = 1; else $no = $paging;

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
										<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Usulan_Pemindahtanganan[]" value="<?php echo $value->Aset_ID;?>" 
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
										<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Usulan_Pemindahtanganan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($data['asetList']); $i++){if ($data['asetList'][$i]==$value->Aset_ID) echo 'checked';}?>>
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
			</form>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>