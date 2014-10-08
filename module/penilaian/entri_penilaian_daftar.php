<?php ob_start(); ?>
<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$menu_id = 51;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	 if (isset($_POST['submit']))
	{
			if($_POST['pen_ID_aset']=="" && $_POST['pen_nama_aset']=="" && $_POST['pen_nomor_kontrak']=="" && $_POST['pen_tahun_perolehan']=="" && $_POST['kelompok_id']=="" && $_POST['lokasi_id']=="" && $_POST['skpd_id']=="" ){
			?>
			<script>var r=confirm('Tidak ada isian filter');
			if (r==false)
			{
					document.location="<?php echo "$url_rewrite/module/penilaian/";?>entri_penilaian_filter.php";
			}
			</script>
		<?php
		}
		$data['kd_idaset'] = $_POST['pen_ID_aset'];
		$data['kd_namaaset'] = $_POST['pen_nama_aset'];
		$data['kd_nokontrak'] = $_POST['pen_nomor_kontrak'];
		$data['kd_tahun'] = $_POST['pen_tahun_perolehan'];
		$data['kelompok_id'] = $_POST['kelompok_id'];
		$data['lokasi_id'] = $_POST['lokasi_id'];
		$data['satker'] = $_POST['skpd_id'];
		// $data['ngo'] = $_POST['ngo_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql_where'] = TRUE;
		$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
				AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
				(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1 AND CurrentPemanfaatan_ID!=0 AND
				LastPemanfaatan_ID !=0";
		$data['modul'] = "penilaian";
		
		$dataTotal = $HELPER_FILTER->filter_module($data);
		// pr($dataTotal);
	
		
		// }
    	
	}
			?>
<?php
$offset = @$_POST['record'];

	$param = $_SESSION['parameter_sql'];
		
		// pr($_POST);
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC ";
		}else{
			
			$paging = paging($_GET['pid'], 100);
		
			$query="$param ORDER BY Aset_ID ASC ";
		}
		
		
		
        $res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		$paging = paging($_GET['pid'], 100);
		
		
		if($dataArray!= "") $dataImplode = implode(',',$dataArray); else $dataImplode = "";
		// pr($dataImplode);
		if($dataImplode!=""){
			
		$viewTable = 'penilaian_'.$SessionUser['ses_uoperatorid'];
		$table = $DBVAR->is_table_exists($viewTable, 1);
		
		if (!$table){
			$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.Aset_ID IN ({$dataImplode})
					ORDER BY a.Aset_ID asc";
			$exec=mysql_query($sql) or die(mysql_error());
		}
		
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		
		$exec=mysql_query($sql) or die(mysql_error());
		while ($dataAset = mysql_fetch_object($exec)){
			$row[] = $dataAset;
		}		
		// pr($sql);
	$dataAsetUser = $HELPER_FILTER->getAsetUser(array('Aset_ID'=>$dataImplode));
			


		}
    // pr($row); 
        ?>

    
    <?php
    
    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi'";
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

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penilaian</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Entri Hasil Penilaian</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Entri Hasil Penilaian</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data : <?php echo $_SESSION['parameter_sql_total']?> Record</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							
							<li>
								<a href="<?php echo"$url_rewrite/module/penilaian/entri_penilaian_filter.php";?>" class="btn">
									   Kembali ke halaman utama : Cari Aset
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
						<th>No</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
					if (!empty($row))
					{
					
						$nomor = 1;
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
								<td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
                            <a href='entri_penilaian_nilai_simpan.php?id=<?php echo $value->Aset_ID?>'>Penilaian</a></span>
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