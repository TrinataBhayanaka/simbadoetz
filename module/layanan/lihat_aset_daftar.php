<?php
include "../../config/config.php";

$LAYANAN = new RETRIEVE_LAYANAN;
// pr($_POST);exit;
// $menu_id = 51;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$resetDataView = $DBVAR->is_table_exists('penghapusan_filter_'.$SessionUser['ses_uoperatorid'], 0);
	
	if ($_POST['submit']){
               // pr($_POST);
               // exit;
		
		/*
				if ($_POST['kd_idaset'] == "" && $_POST['kd_namaaset'] == "" && $_POST['kd_nokontrak'] == "" && $_POST['kd_tahun'] == "" && $_POST['skpd_id'] == "" && $_POST['lokasi_id'] == "" && $_POST['kelompok_id5'] == "") {
                    ?>
                    <script>var r=confirm('Tidak ada isian filter');
                         if (r==false)
                         {
                              document.location="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_filter.php";
                         }
                    </script>
				<?php
					}
	*/


	}
	
	
	$dataParam = $SESSION->smartFilter('layanan');

	$par_data_table= "data=".encode($dataParam);//{$dataParam['kd_nokontrak']}&jenisaset={$dataParam['jenisaset']}&kodeSatker={$dataParam['kodeSatker']}&kd_tahun={$dataParam['kd_tahun']}&statusaset={$dataParam['statusaset']}&page={$dataParam['page']}";

	
	?>

	<script type="text/javascript">
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

    $(document).ready(function() {

    	// alert('ada');
    	var param = "api_layanan.php?<?php echo $par_data_table?>";
        dTableParam("layanan_tabel", param, 9);
        // log();
    });

    function checkBefore(){

    	var txt;
		var r = confirm("Hapus Data Aset?");
		if (r == true) {
		    
		} else {
		    return false;
		}
    }

    </script>

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Layanan Umum</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Lihat Daftar Aset</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Lihat Daftar Aset</div>
				<div class="subtitle">Daftar Aset</div>
			</div>
		<section class="formLegend">
			
			<!--
			<div class="detailLeft">
					<span class="label label-success">Filter data : <span class="badge badge-warning"><?php echo $_SESSION['parameter_sql_total'] ?></span> Record</span>
			</div>
			-->
		<?php //$HELPER_FILTER->back($link=$url_rewrite.'/module/layanan/lihat_aset_filter.php',$val='Kembali ke halaman utama : Cari aset',$page=1)?>
			<form name="myform" ID="Form2" method="POST" action="<?php echo "$url_rewrite/module/layanan/"; ?>hapus_aset.php" onsubmit="return checkBefore()">
			<input type="submit" name="submit2" class="btn btn-danger" value="Hapus Aset" id="submit" disabled/>
			<div class="detailRight">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/layanan/lihat_aset_filter.php?pid=1"; ?>">
									   <input type="button" name="Lanjut" class="btn" value="Kembali ke halaman utama : Cari aset" >
								 </a>
							</li><!--
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid'] ?>">
								  <input type="hidden" class="hiddenrecord" value="<?php echo @$count ?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>-->
						</ul>
							
			</div>

			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="layanan_tabel">
				<thead>
					<tr>
						<th>No</th>
						
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Satker</th>
						<th>Info</th>
						<th>Tgl Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Detail</th>
					</tr>
				</thead>
				<tbody>		
							 
				<tr>
                    <td colspan="9">Data Tidak di temukkan</td>
               	</tr>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			</form>
		</section> 
	</section>


<?php
include "$path/footer.php";
?>