<?php
include "../../config/config.php";

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;

 $menu_id = 34;
        $SessionUser = $SESSION->get_session_user();
        //($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $tgl_awal=$_POST['peman_penet_filt_tglawal'];
        $tgl_akhir=$_POST['peman_penet_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan=$_POST['peman_penet_filt_nopenet'];
        $alasan=$_POST['peman_penet_filt_alasan'];
        $submit=$_POST['tampil_filter'];

        //open_connection();
        
       
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoSKKDH LIKE '%$no_penetapan%'";
            }
            if($alasan!=""){
            $query_alasan="Keterangan LIKE '%$alasan%'";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($alasan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_alasan;
            }
            if ($alasan!="" && $parameter_sql==""){
            $parameter_sql=$query_alasan;
            }
            
            //echo "$parameter_sql";
            
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan=="" && $alasan==""){
    ?>
                <script>
                // var r=confirm('Tidak ada isian filter');
                //             if (r==false){
                //                 document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter.php";
                //             }
                    </script>
    <?php
            }
        }
    ?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$data = $PEMANFAATAN->pemanfaatan_daftar_penetapan($_POST);
	// pr($data);
			?>


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
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php 
								if($parameter_sql!="" ) {
									if($_SESSION['ses_uaksesadmin'] == 1){
										$query="SELECT * FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0"),0);
									}else{
										$query="SELECT * FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0 AND UserNm = '$_SESSION[ses_uoperatorid]' ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE $parameter_sql AND FixPemanfaatan=1 AND Status=0 AND UserNm = '$_SESSION[ses_uoperatorid]' "),0);
									}
								}

								if($parameter_sql=="" ) {
									if($_SESSION['ses_uaksesadmin'] == 1){
										$query="SELECT * FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0"),0);
									}else{
										$query="SELECT * FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0 ";
										$exec = mysql_query($query) or die(mysql_error());
										$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0 AND UserNm = '$_SESSION[ses_uoperatorid]'"),0);
									}
								}
							
							?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter2.php" class="btn">
								Tambah Data
								 </a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<<?php echo @$total_record?>">
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
						<th>Tipe Pemanfaatan</th>
						<th>No SKKDH</th>
						<th>Nama Partner</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
						/*$query2="SELECT * FROM Menganggur where FixMenganggur=1 limit 10";
						$exec = mysql_query($query2) or die(mysql_error());*/
	
						$i=1;
						foreach($data as $row){
					?>
						  
					<tr class="gradeA">
						<td><?php echo "$i";?></td>
						<td><?php echo "$row[TipePemanfaatan]";?></td>
						<td><?php echo "$row[NoSKKDH]";?></td>
						<td><?php echo "$row[NamaPartner]";?></td>
						<td>	
						 <!--<a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/";?>tes_class_penetapan_aset_yang_dimanfaatkan.php?id=<?php echo "$row[Pemanfaatan_ID]";?>" target="_blank">Cetak</a>-->
						<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_daftar_edit.php?id=<?php echo "$row[Pemanfaatan_ID]";?>">Edit</a>
						|| <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_daftar_hapus.php?id=<?php echo "$row[Pemanfaatan_ID]";?>">Hapus</a> 
						</td>
					</tr>
					<?php $i++; } ?>
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