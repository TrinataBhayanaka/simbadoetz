<?php
include "../../config/config.php";
 $menu_id = 42;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    $paging = $LOAD_DATA->paging($_GET['pid']);
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
			  <li class="active">Daftar Usulan Pemindahtanganan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Usulan Pemindahtanganan Barang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>pemindahtanganan.php" class="btn">
								Kembali ke Form Filter</a>
								
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>daftar_pemindahtanganan_barang.php?pid=1" class="btn">
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
						<th>Nomor Usulan</th>
						<th>Tgl Usulan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
				<?php
                                        
                                        //$hsl_data=mysql_fetch_array($exec);
                                        
                                        
                                       /* $query_fix_satker="SELECT * FROM Satker where NamaSatker='$satker'";
                                        $exec_fix_satker=mysql_query($query_fix_satker);
                                        $hsl_data_fix_satker=  mysql_fetch_array($exec_fix_satker);
                                        $id_aset=$hsl_data_fix_satker['Satker_ID'];
                                        
                                        $query_aset="SELECT * FROM Aset where LastSatker_ID='$id_aset'";
                                        $exec_aset=mysql_query($query_aset);
                                        $hsl_data_aset=  mysql_fetch_array($exec_aset);
                                         
                                        $id_penggunaan=$hsl_data_aset['Aset_ID'];
                                        $query_satker="SELECT * FROM PenggunaanAset where Aset_ID='$id_penggunaan'";
                                        $exec_satker=mysql_query($query_satker) or die(mysql_error());
                                        $hsl_data_satker=mysql_fetch_array($exec_satker);
                                        
                                        $fix=$hsl_data_satker['Penggunaan_ID'];
                                        
                                        
                                     if($tgl_akhir!="" || $tgl_awal!="" || $no_penetapan_penggunaan!="" || $satker!=""){
                                        $query="SELECT * FROM Penggunaan where FixPenggunaan=1 and Status=0 and (NoSKKDH='$no_penetapan_penggunaan' OR TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix' OR Penggunaan_ID='$fix') limit 10";
                                        $exec = mysql_query($query) or die(mysql_error());
                                                                                                            
                                        //$exec = mysql_query($query) or die(mysql_error());
                                     }else{
                                         */
                                    
                                         // untuk status idle
                                    
                                            /*
                                            $query3="SELECT * FROM PenggunaanAset where Status=0 limit 10";
                                            $exec = mysql_query($query3) or die(mysql_error());
                                            $hsl=  mysql_fetch_array($exec);
                                            
                                            $id_penggunaan_aset=$hsl['Penggunaan_ID'];
                                            */
                                    
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
                                            */
                                            
                                            
                                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            $parameter = array('menuID'=>$menu_id,'type'=>'','paging'=>$paging);
                                            $data = $RETRIEVE->retrieve_daftar_usulan_pemindahtanganan($parameter);

                                            //print_r($data['dataArr']);
                                            if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                if (!empty($data['dataArr']))
                                                {
                                                    $disabled = '';
                                                    $pid = 0;
                                                    /*
                                            $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH' limit $offset, $jmlperhalaman";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                        //}
                                            $total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH'"),0);
                                            */
                                        //$check = mysql_num_rows($exec);
                                        
											//sementara
											$query = "select distinct Usulan_ID from UsulanAset where StatusPenetapan = 1 AND Jenis_Usulan = 'PDH'";
											$result  = mysql_query($query) or die (mysql_error());
											while ($dataNew = mysql_fetch_object($result))
											{
												$dataArr[] = $dataNew->Usulan_ID;
											}
                                        
                                        $i=1;
                                        foreach($data['dataArr'] as $key => $nilai){
											
											if($dataArr!="")
												{
													(in_array($nilai['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
												}
                                    ?>
						  
					<tr class="gradeA">
						<td><?php echo "$no. ";?></td>
						<td>
							<?php echo "$nilai[Usulan_ID]";?>
						</td>
						<td><?php $change=$nilai['TglUpdate']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>	
						 <a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/"; ?>tes_class_usulan_aset_yang_akan_dipindahtangankan.php?menu_id=42&mode=1&id=<?php echo "$nilai[Usulan_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>pemindahtanganan_usulan_daftar_proses_hapus.php?id=<?php echo "$nilai[Usulan_ID]";?>" onclick="<?=$disable?> ">Hapus</a>
						</td>
					</tr>
					<?php $no++; $pid++; }}?>
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