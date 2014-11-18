<?php
include "../../config/config.php";

?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
    $no_pemusnahan=$_POST['buph_cdph_noskpemusnahan'];
    $tgl_pemusnahan_awal=$_POST['buph_cdph_tanggalawal'];
    $tgl_pemusnahan_akhir=$_POST['buph_cdph_tanggalakhir'];
    $lokasi=$_POST['lokasi_id'];
    $submit=$_POST['tampil_filter'];
    
    $menu_id = 49;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    if (isset($submit)){
                if ($no_pemusnahan=="" && $tgl_pemusnahan_awal=="" && $tgl_pemusnahan_akhir=="" && $lokasi==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite"; ?>/module/pemusnahan/cetak_daftar_pemusnahan_filter.php";
                            }
                    </script>
    <?php
            }
        }
    
        ?>   
		


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemusnahan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Cetak Daftar Pemusnahan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Cetak Daftar Pemusnahan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>cetak_daftar_pemusnahan_filter.php" class="btn">
									   Kembali ke halaman utama : Form Filter
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
						<th>Nomor BA Pemusnahan</th>
						<th>Tgl BA Pemusnahan</th>
						<th>Nama Penandatangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
		   
				$paging = $LOAD_DATA->paging($_GET['pid']);
			   unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
				$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
				$data = $RETRIEVE->retrieve_daftar_cetak_pemusnahan($parameter);
				
				if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
						if (!empty($data['dataArr']))
						{
							$disabled = '';
							$pid = 0;
				$i=1;
				foreach($data['dataArr'] as $key => $hsl_data){
				?>
						  
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td>
							<?php echo "$hsl_data[NoBAPemusnahan]";?>
						</td>
						<td>
							<?php $change=$hsl_data[TglBAPemusnahan]; $change2=  format_tanggal_db3($change); echo "$change2";?>
						</td>
						<td><?php echo "$hsl_data[NamaPenandatangan]";?></td>
						<td>	
						  <a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_validasi_daftar_valid.php?id=$hsl_data[BAPemusnahan_ID]&mode=1";?>" target="_blank">Cetak</a>
						</td>
					</tr>
					  <?php $no++; $pid++;} }?>
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