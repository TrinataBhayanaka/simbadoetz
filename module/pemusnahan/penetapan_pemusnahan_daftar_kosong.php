<?php
include "../../config/config.php";

    $menu_id = 47;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    
        $tgl_awal=$_POST['buph_pph_tanggalawal'];
        $tgl_akhir=$_POST['buph_pph_tanggalakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan=$_POST['buph_pph_noskpemusnahan'];
        $lokasi=$_POST['lokasi_id'];
        $submit=$_POST['tampil_filter'];

        //open_connection();
        
       /*
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoBAPemusnahan LIKE '%$no_penetapan%'";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
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
            
            echo "$parameter_sql";
        * 
        */
            
            if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan=="" && $lokasi==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_filter.php";
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
<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemusnahan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan Pemusnahan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title"> Penetapan Pemusnahan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_filter.php" class="btn">
								Kembali ke form filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_tambah_aset.php" class="btn">
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
						<th>Nomor Pemusnahan</th>
						<th>Tgl Pemusnahan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
				/*
					$hal = $_GET[hal];
					if(!isset($_GET['hal'])){ 
						$page = 1; 
					} else { 
						$page = $_GET['hal']; 
					}
					$jmlperhalaman = 10;  // jumlah record per halaman
					$offset = (($page * $jmlperhalaman) - $jmlperhalaman);
					$i=$page + ($page - 1) * ($jmlperhalaman - 1);
				
					if($parameter_sql!="" ) {
					$query="SELECT * FROM BAPemusnahan WHERE $parameter_sql AND FixPemusnahan=1 AND Status=0 limit $offset, $jmlperhalaman";
					$exec = mysql_query($query) or die(mysql_error());
					
					$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM BAPemusnahan WHERE $parameter_sql AND FixPemusnahan=1 AND Status=0"),0);
					}

					if($parameter_sql=="" ) {
					$query="SELECT * FROM BAPemusnahan WHERE FixPemusnahan=1 AND Status=0 limit $offset, $jmlperhalaman";
					$exec = mysql_query($query) or die(mysql_error());
					
					$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM BAPemusnahan WHERE FixPemusnahan=1 AND Status=0"),0);
					}
					$i=1;
					while($row=mysql_fetch_array($exec)){
				 * 
				 */
				
				$paging = $LOAD_DATA->paging($_GET['pid']);
				unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);

			if (isset($submit))
								{
											unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
											$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
											$data = $RETRIEVE->retrieve_daftar_penetapan_pemusnahan($parameter);
								} else {
			
			$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
			$data = $RETRIEVE->retrieve_daftar_penetapan_pemusnahan($parameter);
			}
			echo '<pre>';
			//print_r($data['dataArr']);
			echo '</pre>';
			
			$nomor = 1;
			if (!empty($data['dataArr']))
			{
				$disabled = '';
				$pid = 0;
			foreach($data['dataArr'] as $key => $row)
				{
				?>	  
					<tr class="gradeA">
						<td><?php echo "$nomor";?></td>
						<td><?php echo "$row[NoBAPemusnahan]";?></td>
						<td><?php $change=$row['TglBAPemusnahan']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>
							<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_daftar_hapus.php?id=<?php echo "$row[BAPemusnahan_ID]";?>">Hapus</a> || <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_daftar_edit.php?id=<?php echo "$row[BAPemusnahan_ID]";?>">Edit</a>
						</td>
						
					</tr>
					 <?php $nomor++;} }?>
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