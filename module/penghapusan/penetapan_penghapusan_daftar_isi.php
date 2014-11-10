<?php
include "../../config/config.php";
	
	$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

	$menu_id = 39;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    
        $tgl_awal=$_POST['bup_pu_tanggalawal'];
        $tgl_akhir=$_POST['bup_pu_tanggalakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan=$_POST['bup_pu_noskpenghapusan'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil_filter'];

        
            if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan=="" && $satker==""){
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
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="distribusi_barang_filter.php";
		  }
		}
	</script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan Penghapusan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penghapusan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php
							// pr($_SESSION);    
							$paging = $LOAD_DATA->paging($_GET['pid']);    

							if (isset($submit))
							{
								unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
								$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
								//$data = $RETRIEVE->retrieve_daftar_penetapan_penghapusan($parameter);
							}else{
							
								$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
								$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
								//$data = $RETRIEVE->retrieve_daftar_penetapan_penghapusan($parameter);
							}
							// pr($data);


						pr($_POST);
						$data = $PENGHAPUSAN->retrieve_daftar_penetapan_penghapusan($_POST,1);
					pr($data);
						?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_filter.php" class="btn">
								Kembali ke form filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_tambah_aset.php" class="btn">
								Tambah Data</a>
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
						<th>Nomor SK Penghapusan</th>
						<th>Tgl Penghapusan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
                                                                            
				 '<pre>';
				//print_r($data['dataArr']);
				echo '</pre>';
				
				$nomor = 1;
				if (!empty($data['dataArr']))
				{
				   
				foreach($data['dataArr'] as $key => $row)
					{
					?>
						  
					<tr class="gradeA">
						<td><?php echo "$nomor";?></td>
						<td>
							<?php echo "$row[NoSKHapus]";?>
						</td>
						<td><?php $change=$row[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>	
						 <!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan.php?menu_id=39&mode=1&id=<?php echo "$row[Penghapusan_ID]";?>" target="_blank">Cetak</a> ||--> 
						<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_edit.php?id=<?php echo "$row[Penghapusan_ID]";?>">Edit</a> ||
						<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_hapus.php?id=<?php echo "$row[Penghapusan_ID]";?>">Hapus</a>  
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