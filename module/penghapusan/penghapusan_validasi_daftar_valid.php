<?php
include "../../config/config.php";


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

 $menu_id = 40;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

        /*$tgl_awal=$_POST['penggu_penet_filt_tglawal'];
        $tgl_akhir=$_POST['penggu_penet_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$_POST['penggu_penet_filt_nopenet'];
        $satker=$_POST['kelompok'];
        $submit=$_POST['tampil'];
     */   
        
        /*$submit2=$_POST['penggunaan_eks'];*/
        
        //open_connection();
        
       
            /*if ($tgl_awal!=""){
            $query_tgl_awal="Tgl_SKKDH='".$tgl_awal."' ";
            }
            if($tgl_akhir!=""){
            $query_tgl_akhir="Tgl_SKKDH='".$tgl_akhir."' ";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH='".$no_penetapan_penggunaan."' ";
            }
            if($satker!=""){
                $query_satker="NamaSatker='".$satker."' ";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_akhir;
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker;
            }
            
            echo "$parameter_sql";
            
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql ." AND Penggunaan_ID".;
            }*/
            
            
       /* if (isset($submit)){
            if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_penggunaan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php";
                            }
                </script>
        <?php
            }
        }*/
        ?>   
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Validasi Barang Penghapusan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Validasi Barang Penghapusan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						<?php 
								$paging = $LOAD_DATA->paging($_GET['pid']);
								unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
								$parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
								// $data = $RETRIEVE->retrieve_daftar_validasi_penghapusan($parameter);
                                // pr($data);        
							// pr($_POST);
							$data = $PENGHAPUSAN->retrieve_daftar_validasi_penghapusan($_POST);
							// pr($data);
							?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_filter.php" class="btn">
								Kembali ke Form Filter</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_lanjut.php?pid=1" class="btn">
								Tambah Data</a>
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
										
					if (!empty($data))
					{
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}          
					foreach($data as $key => $hsl_data){
				?>
						  
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td>
							<?php echo "$hsl_data[NoSKHapus]";?>
						</td>
						<td><?php $change=$hsl_data[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td><?php echo "$hsl_data[AlasanHapus]";?></td>
						<td>	
						<!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/";?>tes_class_penetapan_aset_yang_dihapuskan_validasi.php?menu_id=40&mode=1&id=<?php echo "$hsl_data[Penghapusan_ID]";?>" target="_blank">Cetak</a> ||--> 
						<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_validasi_daftar_proses_hapus.php?id=<?php echo "$hsl_data[Penghapusan_ID]";?>" onclick="return confirm('Hapus Data');">Hapus</a>
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