<?php
include "../../config/config.php";


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

   $menu_id = 40;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
		
		if($_POST['jenis_hapus']){
			$_SESSION['jenis_hapus']=$_POST['jenis_hapus'];
		}
		
        $tgl_awal=$_POST['bup_val_tglskpenghapusan'];
        $tgl_akhir=$_POST['bup_val_tglskpenghapusan'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_sk=$_POST['bup_val_noskpenghapusan'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil_valid_filter'];
        
        
            $paging = $LOAD_DATA->paging($_GET['pid']);    
            
            if (isset($submit))
			{
				unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
				$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
				// $data = $RETRIEVE->retrieve_validasi_penghapusan($parameter);
			} else{

				$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
				$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
				// $data = $RETRIEVE->retrieve_validasi_penghapusan($parameter);
			}
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
                
          
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_sk=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite"; ?>/module/penghapusan/validasi_filter.php";
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
	
	
	pr($_POST);
	$data = $PENGHAPUSAN->retrieve_validasi_penghapusan($_POST);
	pr($data);
	
			?>

	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Validasi data ?");
		if (r==true)
		  {
		  alert("Data sudah tervalidasi");
                                        
		  //document.location="<?php// echo "$url_rewrite"; ?>/module/penghapusan/validasi_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  //document.location="<?php //echo "$url_rewrite"; ?>/module/penghapusan/validasi  _lanjut.php";
		  }
		}
	</script>
	
		<script language="Javascript" type="text/javascript">  
				function enable(){  
				var tes=document.getElementsByTagName('*');
				var button=document.getElementById('submit');
				var boxeschecked=0;
				for(k=0;k<tes.length;k++)
				{
					if(tes[k].className=='checkbox')
						{
							//
							tes[k].checked == true  ? boxeschecked++: null;
						}
				}
				//alert(boxeschecked);
				if(boxeschecked!=0)
					button.disabled=false;
				else
					button.disabled=true;
				}
				function enable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var button = document.getElementById('submit');
					if(enable){
						button.disabled = false;
					}
				}
				function disable_submit(){
				var disable = document.getElementById('kosongkanHalamanIni');
				var button = document.getElementById('submit');
					if(disable){
						button.disabled = true;
					}
				}
			</script>
          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Validasi Penghapusan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Validasi Penghapusan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_filter.php" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_validasi_daftar_valid.php?pid=1" class="btn">
								Daftar Barang
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
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_proses.php">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
						<td align="right" colspan="3">
						<span><input type="submit" name="submit" class="btn" value="Validasi Barang" id="submit" disabled/></span>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>Pilihan</th>
						<th>Nomor SK Penghapusan</th>
						<th>Tanggal Penghapusan</th>
						<th>Keterangan</th>
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
					if (!empty($data))
					{
						
					foreach($data as $key => $value)
					{    
							?>
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td>
							 <?php
								if (($_SESSION['ses_uaksesadmin'] == 1)){
								?>
								<input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPenghapusan[]" value="<?php echo $value['Penghapusan_ID'];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value['Penghapusan_ID']) echo 'checked';}?>/>

								<?php
							}else{
								if ($data['asetList']){
								if (in_array($value['Aset_ID'], $data['asetList'])){
								?>
								<input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPenghapusan[]" value="<?php echo $value['Penghapusan_ID'];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value['Penghapusan_ID']) echo 'checked';}?>/>
								<?php
									}	
								}
							}
						
						?>                                         
						</td>
						<td><?php echo "$value[NoSKHapus]";?></td>
						<td><?php $change=$value['TglHapus']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>	
							<?php echo "$value[AlasanHapus]";?>
						</td>
					</tr>
					    <?php $no++; }} ?>
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
			</form>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>