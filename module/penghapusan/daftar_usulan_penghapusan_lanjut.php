<?php
ob_start();
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 38;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
            
            
            $bup_idaset = $_POST['bup_idaset'];
            $bup_namaaset = $_POST['bup_namaaset'];
            $bup_nokontrak = $_POST['bup_nokontrak'];
            $bup_tahun = $_POST['bup_tahun'];
            $kelompok = $_POST['kelompok_id'];
            $lokasi = $_POST['lokasi_id'];
            $satker = $_POST['skpd_id'];
            $ngo = $_POST['ngo_id'];
            $submit = $_POST['tampil'];
            
            $paging = $LOAD_DATA->paging($_GET['pid']);    
            
			if (isset($submit))
			{
				
				unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
				$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
				//list($get_data_filter,$dataAsetUser) = $RETRIEVE->retrieve_usulan_penghapusan($parameter);
			} else {
				
				$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
				$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
				//list($get_data_filter,$dataAsetUser) = $RETRIEVE->retrieve_usulan_penghapusan($parameter);
			}
                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
			// pr($get_data_filter);
			// pr($dataAsetUser);
            // pr($_SESSION);        
                    
            
            
                if(isset($submit)){
                    if($bup_idaset=="" && $bup_namaaset=="" && $bup_nokontrak=="" && $bup_tahun=="" && $kelompok=="" && $lokasi=="" && $satker=="" && $ngo==""){
                        echo "<script>var r=confirm('Tidak Ada Isian Filter'); 
                                    if(r==false){
                                        document.location='$url_rewrite/module/penghapusan/daftar_usulan_penghapusan_filter.php';
                                    }</script>";
                    }
                }
	    
	    
	    
            ?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	pr($_POST);
	$data = $PENGHAPUSAN->retrieve_usulan_penghapusan($_POST);
pr($data);


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
			function enable_submit(){
			var enable = document.getElementById('pilihHalamanIni');
			var button = document.getElementById('submit');
				if(enable){
					button.disabled = false;
				}
			}
			function disable_submit(){
			var disable = document.getElementById('kosongkanHalamanIni');
			var button = document.getElementById('submit');
				if(disable){
					button.disabled = true;
				}
			}
		</script>

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Buat Usulan Penghapusan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Usulan Penghapusan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $_SESSION['parameter_sql_total']?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						 <?php
							// pr($_SESSION);
							$offset = @$_POST['record'];
							$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'penghapusanfilter[]'";
							$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
							$data_apl = $DBVAR->fetch_object($result_apl);
							// pr($data_apl);	
							$array = explode(',',$data_apl->aset_list);
							// pr($array);
							foreach ($array as $id)
							{
								if ($id !='')
								{
								$dataAsetList[] = $id;
								}
							}
							// pr($dataAsetList);
							if ($dataAsetList !='')
							{
								$explode = array_unique($dataAsetList);
							}
							// pr($explode);
					?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite";?>/module/penghapusan/daftar_usulan_penghapusan_filter.php" class="btn">
								Kembali ke halaman utama: Cari Aset</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_usulan.php?pid=1" class="btn">
									   Daftar Barang
								 </a>
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
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
						<td align="right">
								<span><input type="submit" name="submit" class="btn" value="Usulan Penghapusan" id="submit" disabled/></span>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>&nbsp;</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
				<?php
				if (!empty($data))
				{
			   
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}
					foreach ($data as $key => $value)
					{
					// pr($get_data_filter);
					?>
						
					<tr class="gradeA">
						<td><?php echo $no?></td>
						<td>
						<?php
						if (($_SESSION['ses_uaksesadmin'] == 1)){
							?>
							<input type="checkbox" class="checkbox" onchange="enable()" name="penghapusanfilter[]" value="<?php echo $value->Aset_ID;?>" 
								<?php for ($j = 0; $j <= count($dataAsetUser); $j++){
										if ($dataAsetUser[$j]==$value->Aset_ID) echo 'checked';}?>/>
							<?php
						}else{
							if ($dataAsetUser){
							if (in_array($value->Aset_ID, $dataAsetUser)){
							?>
							<input type="checkbox" class="checkbox" onchange="enable()" name="penghapusanfilter[]" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>/>							<?php
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
									<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
									<span>( Aset ID - System Number )</span>
								</td>
								<!--
								<td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
									
									 <a href='validasi_data_aset.php?id=<?php //echo $value->Aset_ID?>'>Validasi</a></span>
								</td>-->
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
								<td width="30%"> No.Kontrak</td> <td><?php echo $value->NoKontrak?></td>
							</tr>
							<tr>
								<td>Satker</td> <td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
							</tr>
							<tr>
								<td>Lokasi</td> <td><?php echo $value->NamaLokasi?></td>
							</tr>
							<tr>
								<td>Status</td> <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
							</tr>

						</table>
						</td>
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