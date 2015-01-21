<?php
include "../../config/config.php";

$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;

 $menu_id = 34;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $submit=$_POST['tampil_filter_add'];
        $data['kd_idaset']= $_POST['peman_penet_filt_add_idaset'];
		$data['kd_namaaset'] = $_POST['peman_penet_filt_add_nmaset'];
		$data['kd_nokontrak'] = $_POST['peman_usulan_filt_nokontrak'];
		$data['satker'] = $_POST['skpd_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql'] = " Status_Validasi_Barang=1";
		$data['sql_where'] = TRUE;
		$data['modul'] = "";
		// $getFilter = $HELPER_FILTER->filter_module($data);
		
		/*$query_nama_aset="SELECT a.Aset_ID FROM Aset AS a LEFT JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
        
        $query="SELECT Aset_ID FROM UsulanAset $_SESSION[parameter_sql]  StatusPenetapan=0 AND Jenis_Usulan='MNF' ORDER BY Aset_ID asc limit $offset, $jmlperhalaman";
        */
        //open_connection();
        
        if (isset($submit)){
                if ($data['kd_namaaset'] =="" && $data['kd_nokontrak']=="" && $data['satker'] =="" && $data['kd_idaset']==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter2.php";
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
	

	$data = $PEMANFAATAN->pemanfaatan_daftar_penetapan_tambah($_POST);

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
					if (disable){
						button.disabled=true;
					} 
				}
				function enable_submit(){
					var enable = document.getElementById('pilihHalamanIni');
					var disable = document.getElementById('kosongkanHalamanIni');
					var button=document.getElementById('submit');
					if (enable){
						button.disabled=false;
					} 
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
			  <li class="active">Penetapan Pemanfaatan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Pemanfaatan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
			
                            
                           
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?php echo $jml?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter2.php" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
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
			<form name="form" method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_eksekusi_data.php">
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="example">
				<thead>
					<tr>
						<td align=right colspan="5">
							<input type="submit" name="submit" class="btn btn-primary" value="Penetapan Pemanfaatan" id="submit" disabled/>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Kontrak</th>
						<th>Satker</th>
						<th>Aset</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// pr($data);
					$no = 1;
					foreach ($data as $value){
						?>
					<tr>
						<td><?=$no?></td>
						<td class="checkbox-column"><input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="PenetapanPemanfaatan[]" value="<?php echo $value['Usulan_ID'];?>"> </td>
						<td><?=$value['noKontrak']?></td>
						<td><?=$value['NamaSatker']?></td>
						<td><?=$value['Uraian']?></td>
					</tr>
					
						<?php
						$no++;
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