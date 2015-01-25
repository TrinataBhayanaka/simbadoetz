<?php
include "../../config/config.php";

$no_penghapusan=$_POST['bup_cdp_pu_noskpenghapusan'];
    $tgl_penghapusan=$_POST['bup_cdp_pu_tglskpenghapusan'];
    $satker=$_POST['skpd_id'];
    $submit=$_POST['tampil'];
    
    $menu_id = 41;
    $SessionUser = $SESSION->get_session_user();
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    if (isset($submit)){
                if ($no_penghapusan=="" && $tgl_penghapusan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite"; ?>/module/penghapusan/cetak_daftar_penghapusan_filter.php";
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
			  <li class="active">Cetak Daftar Penghapusan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Cetak Daftar Penghapusan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php
						$paging = $LOAD_DATA->paging($_GET['pid']);    

								if (isset($submit))
								{
									unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
									$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
									//$data = $RETRIEVE->retrieve_daftar_cetak_penetapan_penghapusan($parameter);
									$data=$RETRIEVE_REPORT->list_daftar_sk_penghapusan();

								}else{
									$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
									$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
									//$data = $RETRIEVE->retrieve_daftar_cetak_penetapan_penghapusan($parameter);
									$data=$RETRIEVE_REPORT->list_daftar_sk_penghapusan();
								}
					?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>cetak_daftar_penghapusan_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$data['count']?>">
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
						<th>Keterangan</th>
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
					if (!empty($data['dataArr']))
					{
					foreach($data['dataArr'] as $key => $hsl_data)
					{    
					?>
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td>
							<?php echo "$hsl_data[NoSKHapus]";?>
						</td>
						<td><?php $change=$hsl_data[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><?php echo "$hsl_data[AlasanHapus]";?></td>
						<td>	
						 <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>cetak_sk_penghapusan.php?sk=<?php echo "$hsl_data[NoSKHapus]";?>&tglHapus=<?php echo "$hsl_data[TglHapus]";?>&menu_id=41&mode=1&id=<?php echo "$hsl_data[Penghapusan_ID]";?>" target="_blank">Cetak PDF</a>
                                                                                 <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>cetak_sk_penghapusan.php?sk=<?php echo "$hsl_data[NoSKHapus]";?>&tglHapus=<?php echo "$hsl_data[TglHapus]";?>&menu_id=41&mode=1&id=<?php echo "$hsl_data[Penghapusan_ID]";?>&tipe_file=2" target="_blank">Cetak Excel</a>
                                         </td>
					</tr>
					<?php $no++; } }?>
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