<?php
include "../../config/config.php";

$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;


    $menu_id = 30;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

        $tgl_awal=$_POST['tglawal'];
        $tgl_akhir=$_POST['tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$_POST['nopenet'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['submit'];
        
    	
      if (isset($submit)){
            if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_penggunaan=="" && $satker==""){
            	
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php";
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
	


	$data = $PENGGUNAAN->retrieve_daftar_penetapan_penggunaan($_POST);

?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penggunaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan Penggunaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penggunaan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php
								$offset = @$_POST['record'];
								$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi'";
								// pr($query_apl);
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
									
							$paging = $LOAD_DATA->paging($_GET['pid']);    
							// pr($_SESSION);
							if (isset($_POST['tampil']))
							{
								// echo "masukk";
								// unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
								// $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
								// $data = $RETRIEVE->retrieve_daftar_penetapan_penggunaan($parameter);
							}else{
								// $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
								// $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
								// $data = $RETRIEVE->retrieve_daftar_penetapan_penggunaan($parameter);
							}
							
							
							?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter2.php" class="btn">
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
					if (!empty($data))
					{
						$disabled = '';
						// $pid = 0;
						// $no = 1;
					// pr($data);	
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}


					foreach($data as $key => $hsl_data)
						{
					?>  
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td><?php echo "$hsl_data[NoSKKDH]";?>	</td>
						<td><?php $change=$hsl_data['TglSKKDH']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>	
						
                            <!--<a href="<?php echo "$url_rewrite/report/template/PENGGUNAAN/";?>tes_class_penetapan_aset_yang_digunakan.php?menu_id=30&mode=1&id=<?php echo "$hsl_data[Penggunaan_ID]";?>" target="_blank">Cetak</a> ||--> 
							<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_daftar_edit.php?id=<?php echo "$hsl_data[Penggunaan_ID]";?>">Edit</a> ||
							<a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_daftar_proses_hapus.php?Penggunaan_ID=<?php echo "$hsl_data[Penggunaan_ID]";?>">Hapus</a>  
						</td>
					</tr>
					 <?php 
						$no++; 
						// $pid++; 
						} 
					  }
					?>
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