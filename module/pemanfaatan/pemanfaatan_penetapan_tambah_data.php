<?php
include "../../config/config.php";
 $menu_id = 34;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $submit=$_POST['tampil_filter_add'];
        $data['kd_idaset']= $_POST['peman_penet_filt_add_idaset'];
		$data['kd_namaaset'] = $_POST['peman_penet_filt_add_nmaset'];
		$data['kd_nokontrak'] = $_POST['peman_usulan_filt_nokontrak'];
		$data['satker'] = $_POST['skpd_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql'] = " Status_Validasi_Barang=1";
		$data['sql_where'] = TRUE;
		$data['modul'] = "";
		$getFilter = $HELPER_FILTER->filter_module($data);
		
		/*$query_nama_aset="SELECT a.Aset_ID FROM Aset AS a LEFT JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
        
        $query="SELECT Aset_ID FROM UsulanAset $_SESSION[parameter_sql]  StatusPenetapan=0 AND Jenis_Usulan='MNF' ORDER BY Aset_ID asc limit $offset, $jmlperhalaman";
        */
        //open_connection();
        
        if (isset($submit)){
                if ($data['kd_namaaset'] =="" && $data['kd_nokontrak']=="" && $data['satker'] =="" && $data['kd_idaset']==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter2.php";
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
			  <li class="active">Penetapan Pemanfaatan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Pemanfaatan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
			
                            <?php
                                $param=  urlencode($_SESSION['parameter_sql_report']);
                                //echo "$param";
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
											//pr($dataArray);
											
											if($dataArray){
											$dataImplode = implode(',',$dataArray);
											$querypenggunaan ="SELECT Aset_ID FROM UsulanAset WHERE Aset_ID IN ({$dataImplode}) AND StatusPenetapan=0 AND Jenis_Usulan='MNF'"; 	
											// pr($querypenggunaan);
											$res1 = mysql_query($querypenggunaan) or die(mysql_error());
											
											if ($res1){
												$rows1 = mysql_num_rows($res1);
												$jml=($rows1);
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
											
											$exec=mysql_query($query) or die(mysql_error());
													while ($dataAset = mysql_fetch_object($exec)){
														$row[] = $dataAset;
														
												}
													
											$result = $DBVAR->query($query) or die($DBVAR->error());
											$check = $DBVAR->num_rows($result);
											$jml = $check;
											$dataAsetUser = $HELPER_FILTER->getAsetUser(array('Aset_ID'=>$dataImplode_1));
			
											}
										}
										}
										$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PenetapanPemanfaatan[]'";
										$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
										$data_apl = $DBVAR->fetch_object($result_apl);
										
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
                            ?>
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $jml?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter2.php" class="btn">
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
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_eksekusi_data.php">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
						<td align=right>
							<input type="submit" name="submit" value="Penetapan Pemanfaatan" id="submit" disabled/>
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
						
						if($row!="")
						{
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
									<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="PenetapanPemanfaatan[]" value="<?php echo $value->Aset_ID;?>" 
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
									<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="PenetapanPemanfaatan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
									<?php
									}
								}
							}
						?>
						</td>
						<td>	
						<table width="100%">
								<tr>
									<td style="font-weight: bold;"><?php echo "$value->Aset_ID";?> ( Aset ID - System Number )</td>
								</tr>
								<tr>
									<td style="font-weight: bold;"><?php echo "$value->NomorReg";?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;"><?php echo "$value->Kode";?></td>
								</tr>
								<tr>
									<td style="font-weight: bold;"><?php echo "$value->NamaAset";?></td>
								</tr>
							</table>	
							<br>
							<hr />
							<table border=0 width="100%"> 
								<tr>
								   <td width="20%">No. Kontrak</td>
									<td width="2%"></td>
									<td width="78%"><?php echo "$value->NoKontrak";?></td>
								</tr>
								<tr >
									<td>Satker</td>
									<td></td>
									<td><?php echo "$value->NamaSatker";?></td>
								</tr>
								<tr >
									<td>Lokasi</td>
									<td></td>
									<td><?php echo "$value->NamaLokasi";?></td>
								</tr>
								<tr >
									<td>Status</td>
									<td></td>
									<td>-</td>
								</tr>
							</table>
						</td>
					</tr>
					  <?php
						$no++; } }
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