<?php
include "../../config/config.php";

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;

        $menu_id = 33;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        // pr($_POST);
        $data['kd_idaset']= $_POST['peman_usulan_filt_asetid'];
		$data['kd_namaaset'] = $_POST['peman_usulan_filt_nmaset'];
		$data['kd_nokontrak'] = $_POST['peman_usulan_filt_nokontrak'];
		$data['kd_tahun'] = $_POST['peman_usulan_filt_tahun'];
		$data['lokasi_id'] = $_POST['lokasi_id'];
		$data['kelompok_id'] = $_POST['kelompok_id'];
		$data['satker'] = $_POST['skpd_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql'] = " Status_Validasi_Barang=1";
		//$data['sql'] = " StatusMenganggur=0 AND StatusMutasi=0";
		$data['sql_where'] = TRUE;
		$data['modul'] = "";
		// $getFilter = $HELPER_FILTER->filter_module($data);
        $submit=$_POST['tampil_usul_filter'];
        
        //$query = "select distinct Menganggur_ID from MenganggurAset where StatusUsulan = 1"
        /*$query_nama_aset="SELECT a.Aset_ID FROM Aset AS a LEFT JOIN MenganggurAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nama_aset%'";*/
        //open_connection();
            
        if (isset($submit)){
                if ($data['kd_idaset']=="" && $data['kd_namaaset']=="" && $data['kd_nokontrak']=="" && $data['satker']==""){
			?>
                <script>
                // var r=confirm('Tidak ada isian filter');
                //             if (r==false){
                //                 document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_usulan_filter.php";
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

// pr($_POST);

if ($_POST['submit']){
	// unset($_SESSION['ses_mutasi_filter']);

	$_SESSION['ses_pemanfaatan_filter'] = $_POST;
	
}

$dataParam = $_SESSION['ses_pemanfaatan_filter'];
$dataParam['page'] = intval($_GET['pid']);


$data = $PEMANFAATAN->retrieve_usulan_pemanfaatan($dataParam);
// pr($data);


			?>
		<script language="Javascript" type="text/javascript">  
			$(document).ready(function() {
				
				
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
				if(boxeschecked!=0){
					button.disabled=false;
				}
				else {
					button.disabled=true;
				}
				
			} );
			

			$(function(){
				$("#selectall").click(function () {
					
					// console.log('cek');
					var get = $("#selectall:checked").length;
					console.log(get);
					if (get>0){
						enable_submit();
						$('.checkbox1').attr('checked', this.checked);
					}else{
						disable_submit();
						$('.checkbox1').removeAttr('checked');
					}
					
		          	

			    });
				
			});

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
			function disable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				// if (disable){
					button.disabled=true;
				// } 
			}
			function enable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				// if (enable){
					button.disabled=false;
				// } 
			}

			
		      	
		    
			</script>
			<script>
				function AreAnyCheckboxesChecked () 
				{
					setTimeout(function() {
				  if ($("#Form2 input:checkbox:checked").length > 0)
					{
					    $("#submit").removeAttr("disabled");
					}
					else
					{
					   $('#submit').attr("disabled","disabled");
					}}, 100);
				}
				</script>	

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemanfaatan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active"> Daftar Usulan Pemanfaatan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title"> Daftar Usulan Pemanfaatan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			 <?php
                    $param=  urlencode($_SESSION['parameter_sql_report']);
                    //echo "$param";
                ?>
                
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $jml?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_usulan_filter.php" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
							</li>
							<!--
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_usulan_daftar_usulan.php?pid=1" class="btn">
								Daftar Barang
								 </a>
							</li>-->
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo $jml?>">
								   <ul class="pager">
								   	<?php 
								   		$prev = intval($_GET['pid']-1);
								   		$next = intval($_GET['pid']+1);
								   		?>
										<li><a href="<?php echo"$url_rewrite/module/pemanfaatan/pemanfaatan_usulan_daftar.php?pid=$prev"?>" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="<?php echo"$url_rewrite/module/pemanfaatan/pemanfaatan_usulan_daftar.php?pid=$next"?>" class="buttonnext1">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<form name="form" method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_usulan_eksekusi_data.php?pid=1">
				<input type="hidden" name="jenisaset" value="<?php echo implode(',', $_POST['jenisaset'])?>">
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="example">
				<thead>
					<tr>
						<td align=right colspan="6">
							<input type="submit" name="submit" class="btn btn-primary" value="Usulan Pemanfaatan" id="submit" disabled/></p>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Uraian</th>
						<th>No Kontrak</th>
						<th>Satker</th>
						<th>Lokasi</th>
						
					</tr>
				</thead>
				<tbody>		
				  
				<?php
				if($data!=""){
					$page = @$_GET['pid'];
					if ($page > 1){
						$no = intval($page - 1 .'01');
					}else{
						$no = 1;
					}	
					foreach ($data as $value){
				?>
						  
					<tr class="gradeA">
						<td><?php echo $no.".";?></td>
						<td align="center" class="checkbox-column">
							<input type="checkbox" id="checkbox" class="checkbox" onchange="enable_submit()" name="Pemanfaatan[]" value="<?php echo $value['Aset_ID'];?>" ></td>
						<td><?php echo $value['Uraian'];?></td>
						<td><?php echo $value['noKontrak'];?></td>
						<td><?php echo $value['kodeSatker'];?></td>
						<td><?php echo $value['kodeLokasi'];?></td>
						
					</tr>
					
				     <?php
							$no++; } }
						else
						{
							$disabled = 'disabled';
						}    
						?>
				</tbody>
				<tfoot>
					<tr>
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