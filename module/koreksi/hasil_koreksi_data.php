<?php
ob_start();
include "../../config/config.php";


            open_connection();
            //print_r($_POST);
            $data['kd_idaset']= $_POST['kd_idaset'];
			$data['kd_namaaset'] = $_POST['kd_namaaset'];
			$data['kd_nokontrak'] = $_POST['kd_nokontrak'];
			$data['kd_tahun'] = $_POST['kd_tahun'];
			$data['kelompok_id'] = $_POST['kelompok_id5'];
			$data['lokasi_id'] = $_POST['lokasi_id'];
			$data['satker'] = $_POST['skpd_id'];
			$data['ngo'] = $_POST['ngo_id'];
			$data['paging'] = $_GET['pid'];
			$data['sql_where'] = TRUE;
			$data['sql'] = "StatusValidasi = 1";
			$data['modul'] = "pengadaan";
			
            $getFilter = $HELPER_FILTER->filter_module($data);
            
                if (isset($submit))
                    {
                    if($data['kd_idaset']=="" && $data['kd_namaaset']=="" && $data['kd_nokontrak']=="" && $data['kd_tahun']=="" && $data['kelompok_id'] =="" && $data['lokasi_id']=="" && $data['satker'] =="" && $data['ngo'] ==""){
                        ?>
                        <script>var r=confirm('Tidak ada isian filter');
							if (r==false)
							{
									document.location="<?php echo "$url_rewrite/module/koreksi/";?>koreksi_data_aset.php";
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


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Koreksi Data</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Koreksi Data</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Koreksi Data</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $_SESSION['parameter_sql_total']?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/koreksi/koreksi_data_aset.php";?>" class="btn">
								Kembali ke halaman utama : Cari Aset</a>
								
							</li>
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
		if ($result){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		
		if($dataArray!= "") $dataImplode = implode(',',$dataArray); else $dataImplode = "";
		// pr($dataImplode);
		if($dataImplode!=""){
				$paging		= paging($_GET['pid'], 100);
				$viewTable = 'daftar_koreksi_aset'.$_SESSION['ses_uoperatorid'];
				// $table = $this->is_table_exists($viewTable, 1);
				// if (!$table){
					if($_SESSION['ses_uaksesadmin']){
					$query2="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
									a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
									d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
									FROM Aset AS a 
									LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
									LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
									JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
									JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
									JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
									LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
									WHERE a.Aset_ID IN ({$dataImplode})
									ORDER BY a.Aset_ID asc ";
					}else{
					$query2="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
									a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
									d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
									FROM Aset AS a 
									LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
									LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
									JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
									JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
									JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
									LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
									WHERE a.Aset_ID IN ({$dataImplode}) AND a.UserNm = $_SESSION[ses_uoperatorid]
									ORDER BY a.Aset_ID asc ";
					}				
				//pr($query2);
				$exec=mysql_query($query2) or die(mysql_error());
				// }	
				$sqlCount 	= "SELECT * FROM $viewTable";
				$execCount	= mysql_query($sqlCount) or die(mysql_error());
				$count  = mysql_num_rows($execCount);
				
				$sql 	= "SELECT * FROM $viewTable LIMIT $paging, 100 ";
				$exec2	= mysql_query($sql) or die(mysql_error());
				while ($dataAset = mysql_fetch_object($exec2)){
					$row[] = $dataAset;
				}
				/*while ($dataAset = mysql_fetch_object($exec)){
					$row[] = $dataAset;
				}*/
				/*$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
						WHERE b.Aset_ID IN ({$dataImplode})  ";
				//pr($queryKontrak);		
				$result = $DBVAR->query($query) or die($DBVAR->error());
				$resultKontrak = $DBVAR->query($queryKontrak) or die($DBVAR->error());
				
				$check = $DBVAR->num_rows($result);
				
				
				$i=1;
				while ($data = $DBVAR->fetch_object($result))
				{
					$dataArr[] = $data;
				}
				
				while ($dataKontrak = $DBVAR->fetch_object($resultKontrak))
				{
					$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
				}
		
					$i=1;
				while ($data = $DBVAR->fetch_object($result))
				{
					$dataArr[] = $data;
					$paramNilai = true;
				}	*/
	    						
			}
    
    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'koreksi_data'";
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
$dataAsetUser = $HELPER_FILTER->getAsetUser(array('Aset_ID'=>$dataImplode));
	
?>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
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
						<th>No</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
				if (!empty($row))
				{
				
					$page = @$_GET['pid'];
					if ($page > 1){
						$nomor = intval($page - 1 .'01');
					}else{
						$nomor = 1;
					}  

					foreach ($row as $key => $value)
					{
					?>
						  
					<tr class="gradeA">
						<td><?php echo $nomor?></td>
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
								<td align="right">
									<?php
									  if (($_SESSION['ses_uaksesadmin'] == 1)){
										  ?>
										  <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
									<a href='pengadaan.php?id=<?php echo $value->Aset_ID?>'>Edit Data</a></span>
										  <?php
									  }else{
										  if ($dataAsetUser){
										  if (in_array($value->Aset_ID, $dataAsetUser)){
										  ?>
										  <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
									<a href='pengadaan.php?id=<?php echo $value->Aset_ID?>'>Edit Data</a></span>
										  <?php
										  }
									  }
									  }
									  
									  ?>
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
						<table border=0 width="100%">
							<tr>
								<td width="20%">No.Kontrak</td> 
								<td width="2%">&nbsp;</td>
								<td width="78%">&nbsp;<?php echo $value->NoKontrak?></td>
							</tr>
							
							<tr>
								<td>Satker</td> 
								<td>&nbsp;</td>
								<td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
							</tr>
							<tr>
								<td>Lokasi</td> 
								<td>&nbsp;</td>
								<td><?php echo $value->NamaLokasi?></td>
							</tr>
							<tr>
								<td>Status</td> 
								<td>&nbsp;</td>
								<td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
							</tr>

						</table>
						</td>
						
					</tr>
					<?php
							$nomor++;
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