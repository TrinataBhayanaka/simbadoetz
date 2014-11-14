<?php
include "../../config/config.php";

        $menu_id = 32;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $submit=$_POST['tampil_idle_add'];
        $data['kd_namaaset'] = $_POST['peman_penet_bmd_filt_add_nmaset'];
		$data['kd_nokontrak'] = $_POST['peman_penet_bmd_filt_add_nokontrak'];
		$data['satker'] = $_POST['skpd_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql'] = " Status_Validasi_Barang=1";
		$data['sql_where'] = TRUE;
		$data['modul'] = "";
        $getFilter = $HELPER_FILTER->filter_module($data);
            
        if (isset($submit)){
                if ($data['kd_namaaset']=="" && $data['kd_nokontrak']=="" && $data['satker']==""){
			?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter2.php";
                            }
                    </script>
        <?php
            }
        }
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
			  <li><a href="#">Pemanfaatan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan BMD Menganggur</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan BMD Menganggur</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
			<?php
                                    $param=  urlencode($_SESSION['parameter_sql_report']);
                                    //echo "$param";
                                ?>
								
                                <!--<div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/tes_class_penetapan_bmd_menganggur_cetak_seluruh.php?menu_id=32&mode=1&parameter=$param";?>" target="_blank"><input type="button" value="Cetak Daftar Aset (PDF)"></a>
                                </div>-->
								
									<?php
                                                
											$offset = @$_POST['record'];

											$param = $_SESSION['parameter_sql'];
											
											// pr($param);
											if (isset($_POST['search'])){
												
												$query="$param ORDER BY Aset_ID ASC ";
											}else{
												$paging = paging($_GET['pid']);
											
												$query="$param ORDER BY Aset_ID ASC ";
											}
											//pr($query);
											
											
											$res = mysql_query($query) or die(mysql_error());
											if ($res){
												$rows = mysql_num_rows($res);
												
												while ($data = mysql_fetch_array($res))
												{
													
													$dataArray[] = $data['Aset_ID'];
												}
											}
											// pr($dataArray);
											if($dataArray){
											
											$dataImplode = implode(',',$dataArray);
											/*
											status mutasi !=2 (data di transfer mutasi biar masuk) buat flag aja, 
											karena status cuma 1/0
											*/
											$querypenggunaan ="SELECT Aset_ID FROM PenggunaanAset WHERE Aset_ID IN ({$dataImplode}) AND StatusMenganggur=0 AND StatusMutasi != 2"; 	
											// pr($querypenggunaan);
											$res1 = mysql_query($querypenggunaan) or die(mysql_error());
											
											if ($res1){
												$rows1 = mysql_num_rows($res1);
												$jml=($rows1);
												//pr($jml);
												while ($data1 = mysql_fetch_array($res1))
												{
													
													$dataArray1[] = $data1['Aset_ID'];
												}
											}
											if($dataArray1){
											$dataImplode_1 = implode(',',$dataArray1);
											
											if($dataImplode_1!=""){
											
											$query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg,c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode FROM Aset AS a 
													 LEFT JOIN KontrakAset AS d ON a.Aset_ID=d.Aset_ID 
													 LEFT JOIN Kontrak AS c ON d.Kontrak_ID=c.Kontrak_ID 
													 INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID 
													 INNER JOIN Lokasi AS f ON a.Lokasi_ID=f.Lokasi_ID 
													 INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
													 WHERE a.Aset_ID IN ({$dataImplode_1}) ORDER BY a.Aset_ID asc";
											//pr($query);
											//exit($query);
											$exec=mysql_query($query) or die(mysql_error());
													while ($dataAset = mysql_fetch_object($exec)){
														$row[] = $dataAset;
												}
											$check = $DBVAR->num_rows($exec);
											$i=1;
											while ($data = $DBVAR->fetch_object($exec))
											{
												$dataArr[] = $data;
											}
											}
											$dataAsetUser = $HELPER_FILTER->getAsetUser(array('Aset_ID'=>$dataImplode_1));
											
										}
											// echo"implode =".$dataImplode_1;
											// pr($dataAsetUser);
											$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'pemanfaatan[]'";
											$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
											$data_apl = $DBVAR->fetch_object($result_apl);
											if($data_apl){
											$array = explode(',',$data_apl->aset_list);
											
											foreach ($array as $id)
											{
												if ($id !='')
												{
												$dataAsetList[] = $id;
												}
											}
											
											if ($dataAsetList !='')
											{
												$explode = array_unique($dataAsetList);
											}
										}
									}	
											
                                               
									?>
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $jml?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter2.php" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
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
			 <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_eksekusi_data.php?pid=1">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
						<td style="width:200px" align="right"><input type="submit" name="idle_penet" value="Penetapan BMD" id="submit" disabled/></td>
					</tr>
					<tr>
						<th>No</th>
						<th>&nbsp;</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
					 <?php
						// pr($_SESSION);
									   
						if($row!=""){
							$page = @$_GET['pid'];
							if ($page > 1){
								$no = intval($page - 1 .'01');
							}else{
								$no = 1;
							}
							foreach ($row as $value){
						?>
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td>
		
							<?php
								if (($_SESSION['ses_uaksesadmin'] == 1)){
									?>
									<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="pemanfaatan[]" value="<?php echo $value->Aset_ID;?>" 
									<?php 
										for ($i = 0; $i <= count($explode); $i++){
											if ($explode[$i]==$value->Aset_ID) 
												echo 'checked';
										}?>>
									<?php
								}else{
									if ($dataAsetUser){
									if (in_array($value->Aset_ID, $dataAsetUser)){
									?>
									<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="pemanfaatan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
									<?php
									}
								}
								}
								
								?>
						</td>
						
					</tr>
					
					<?php $no++; 
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
			</form>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>