<?php
include "../../config/config.php";

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;

		 $tgl_awal=$_POST['peman_pengem_filt_tglawal'];
        $tgl_akhir=$_POST['peman_pengem_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_pemanfaatan_pengembalian=$_POST['peman_pengem_filt_nopenet'];
        $lokasibast=$_POST['peman_pengem_filt_lokasi'];
        $submit=$_POST['tampil_filter'];
        
        //open_connection();
        
       
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAST LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAST LIKE '%$tgl_akhir_fix%'";
            }
            if($no_pemanfaatan_pengembalian!=""){
            $query_np="NoBAST LIKE '%$no_pemanfaatan_pengembalian%'";
            }
            if($lokasibast!=""){
            $query_lokasi="LokasiBAST LIKE '%$lokasibast%'";
            }
            

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAST BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_pemanfaatan_pengembalian!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_pemanfaatan_pengembalian!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($lokasibast!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi;
            }
            if ($lokasibast!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi;
            }
            
            echo "$parameter_sql";
            
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_pemanfaatan_pengembalian=="" && $lokasibast==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter.php";
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
	

	$data = $PEMANFAATAN->pemanfaatan_pengembalian_daftar($_GET);
	pr($data);
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemanfaatan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Pengembalian Pemanfaatan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Pengembalian Pemanfaatan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						 <?php
							 /*$query2="SELECT * FROM Menganggur where FixMenganggur=1 limit 10";
                                            $exec = mysql_query($query2) or die(mysql_error());*/
                            
							if($parameter_sql!="" ) {
									if($_SESSION['ses_uaksesadmin'] == 1){
										$query="SELECT * FROM bast_pengembalian WHERE $parameter_sql AND FixPengembalian=1 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record =mysql_num_rows($exec);
									}else{
										$query="SELECT * FROM bast_pengembalian WHERE $parameter_sql AND FixPengembalian=1 AND UserNm = '$_SESSION[ses_uoperatorid]' ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record =mysql_num_rows($exec);
									}
								}

							if($parameter_sql=="" ) {
								if($_SESSION['ses_uaksesadmin'] == 1){
									$query="SELECT * FROM bast_pengembalian WHERE FixPengembalian=1 ";
									$exec = mysql_query($query) or die(mysql_error());
									$total_record =mysql_num_rows($exec);	
								}else{
									$query="SELECT * FROM bast_pengembalian WHERE FixPengembalian=1 ";
									$exec = mysql_query($query) or die(mysql_error());
									$total_record =mysql_num_rows($exec);	
								}
							}
							?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter.php" class="btn">
								Kembali ke Form Filter</a>
								
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter2.php" class="btn">
								Tambah Data</a>
								
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$total_record?>">
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
						<th>Nomor BAST Pengembalian</th>
						<th>Tgl BAST Pengembalian</th>
						<th>Lokasi BAST</th>
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
					while($row=mysql_fetch_array($exec)){
					?>
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td>
							<?php echo "$row[NoBAST]";?>
						</td>
						<td><?php $change=$row[TglBAST]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>	
							<?php echo "$row[LokasiBAST]";?>
						</td>
						<td>
							<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_daftar_edit.php?id=<?php echo "$row[BAST_Pengembalian_ID]";?>">Edit</a>  ||
							<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_daftar_hapus.php?id=<?php echo "$row[BAST_Pengembalian_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a> 
						</td>
					</tr>
					<?php
						$no++;
							}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
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