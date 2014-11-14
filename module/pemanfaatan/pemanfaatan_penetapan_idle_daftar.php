<?php
include "../../config/config.php";

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;

        $tgl_awal=$_POST['peman_penet_bmd_filt_tglawal'];
        $tgl_akhir=$_POST['peman_penet_bmd_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_idle=$_POST['peman_penet_bmd_filt_nopenet'];
        $alasan=$_POST['peman_penet_bmd_filt_alasan'];
        $submit=$_POST['tampil_idle'];
			
		
            
            //echo "$parameter_sql";
            
            
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_idle=="" && $alasan==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter.php";
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
	

	$data = $PEMANFAATAN->getPemanfaatan($_POST);
	// pr($data);
			?>


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
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php 
								// pr($_SESSION);
								// pr($parameter_sql);
								// if($parameter_sql!="" ) {
									
								// 	if($_SESSION['ses_uaksesadmin'] = 1 ){
								// 		$query2="SELECT * FROM Menganggur WHERE FixMenganggur=1 and $parameter_sql";
								// 		$exec = mysql_query($query2) or die(mysql_error());
								// 		$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE $parameter_sql AND FixMenganggur=1"),0);
								// 	}else{
								// 		$query2="SELECT * FROM Menganggur WHERE UserNm =$_SESSION[ses_uoperatorid] and FixMenganggur=1 and $parameter_sql";
								// 		$exec = mysql_query($query2) or die(mysql_error());
								// 		$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE $parameter_sql AND FixMenganggur=1"),0);
								// 	}
									
								// }
								// elseif($parameter_sql=="" ){
								// 	if($_SESSION['ses_uaksesadmin'] = 1 ){
								// 		$query2="SELECT * FROM Menganggur WHERE FixMenganggur=1";
								// 		$exec = mysql_query($query2) or die(mysql_error());
								// 		$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE FixMenganggur=1"),0);
								// 	}else{
								// 		$query2="SELECT * FROM Menganggur WHERE UserNm =$_SESSION[ses_uoperatorid] and FixMenganggur=1";
								// 		$exec = mysql_query($query2) or die(mysql_error());
								// 		$total_record = mysql_result(mysql_query("SELECT COUNT(Menganggur_ID) as Num FROM Menganggur WHERE FixMenganggur=1"),0);
								// 	}
									
								// }
								
								?>	
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter2.php" class="btn">
									   Tambah Data
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
						<th>Nomor SKKDH</th>
						<th>Tgl SKKDH</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
						
							$page = @$_GET['pid'];
							if ($page > 1){
								$no = intval($page - 1 .'01');
							}else{
								$no = 1;
							}
							//sementara
							// $query = "select distinct Menganggur_ID from MenganggurAset where StatusUsulan = 1";
							// print_r($query);
							// $result  = mysql_query($query) or die (mysql_error());
							// while ($dataNew = mysql_fetch_object($result))
							// {
							// 	$dataArr[] = $dataNew->Menganggur_ID;
							// }
							
							//$no = 1;
							foreach($data as $row){
							/*if($dataArr!="")
							{
								(in_array($row['Menganggur_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
							}*/
					?>
						  
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td><?php echo "$row[NoSKKDH]";?></td>
						<td><?php $change=$row[TglSKKDH]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>
							<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_daftar_edit.php?id=<?php echo "$row[Menganggur_ID]";?>">Edit</a> ||
							 <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_daftar_proses_hapus.php?id=<?php echo "$row[Menganggur_ID]";?>">Hapus</a>
						</td>
					</tr>
					 <?php $no++; } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
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