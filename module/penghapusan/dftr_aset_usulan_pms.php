<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// ////pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	// if($_SESSION['filterAsetUsulan'])
	// ////pr($_SESSION['filterAsetUsulan']);
	////pr($_SESSION);
	if ($_POST['submit']){
		// unset($_SESSION['ses_mutasi_filter']);
		// pr($_POST);
		$_SESSION['filterAsetUsulan'] = $_POST;
		
	}
	$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPMD");

	if($data_post){
		
	}else{
		
	}
	// if(isset($_POST['filterAsetUsulan']) && $_POST['filterAsetUsulan']==1){
	// 	$data = $PENGHAPUSAN->retrieve_usulan_penghapusan_pms($_POST);
	// 	$_SESSION['filterAsetUsulan']=$data;
	// 	$data=$_SESSION['filterAsetUsulan'];
	// 	// ////pr($_SESSION['reviewAsetUsulan']);
	// 	// unset($_SESSION['reviewAsetUsulan']);
	// 	$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPMS");

	// 	if($data_post){
	// 	$data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWUSPMS");
	// 	}

	// }else{
		
	// 	$dataSESSION=$_SESSION['filterAsetUsulan'];
	// 	$data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPMS");
		
	// 	$POST=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);

	// 	$POST['penghapusanfilter']=$POST;
	// 	if($POST){
	// 		// ////pr($_SESSION['reviewAsetUsulan']['penghapusanfilter']);
	// 		foreach ($dataSESSION as $keySESSION => $valueSESSION) {
	// 			// ////pr($valueSESSION['Aset_ID']);
	// 			if(!in_array($valueSESSION['Aset_ID'], $POST['penghapusanfilter'])){
	// 				// echo "stringnot";
	// 				$data[]=$valueSESSION;
	// 			}
	// 		}
		
	// 	}
	// 	// ////pr($data);

	// }
	// //pr($data);
	$POST = $_SESSION['filterAsetUsulan'];
	
	$POST['page'] = intval($_GET['pid']);
	// pr($POST);
	  $par_data_table="bup_tahun={$POST['bup_tahun']}&bup_nokontrak={$POST['bup_nokontrak']}&jenisaset={$POST['jenisaset'][0]}&kodeSatker={$POST['kodeSatker']}&page={$POST['page']}";

	if($_POST['kodeSatker']){
		$_SESSION['kdSatkerFilterPMD']=$_POST['kodeSatker'];
		$kdSatkerFilter=$_SESSION['kdSatkerFilterPMD'];
	}else{
		$kdSatkerFilter=$_SESSION['kdSatkerFilterPMD'];
	}
	if(isset($_GET['flegAset'])){
		$flegAset=$_GET['flegAset'];
	}else{
		$flegAset=1;
	}

		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->
	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('RVWUSPMS');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('RVWUSPMS');
			}}, 100);
		}
		jQuery(function($) {
      		AreAnyCheckboxesChecked();	
      	});
		</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Aset Usulan Penghapusan Pemusnahan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Pemusnahan</div>
				<div class="subtitle">Daftar Aset yang akan dibuat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_validasi_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			<script>
    $(document).ready(function() {
          $('#usulan_pms_table').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": false,"sClass": "checkbox-column" },
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_aset_usulan_pms.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
			<div id="demo">
			<form method="POST" ID="Form2" action="<?php echo"$url_rewrite"?>/module/penghapusan/dftr_review_aset_usulan_pms.php"> 
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="usulan_pms_table">
				<thead>
					<tr>
						<td colspan="7" align="left">
								<span><button type="submit" name="submit" class="btn btn-info " id="submit" disabled/><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Buat Usulan Penghapusan</button></span>
								<input type="hidden" name="reviewAsetUsulan" value="<?=$flegAset?>" />
						<input type="hidden" name="kdSatkerFilter" value="<?=$kdSatkerFilter?>" />
					
						<?php
							if($flegAset==0){
						?>
							<a href="<?php echo"$url_rewrite"?>/module/penghapusan/dftr_review_aset_usulan_pms.php" class="btn">Kembali ke Aset Usulan</a>
						<?php

							}
						?>
						</td>
						<td colspan="3" align="right">
							<a href="<?php echo"$url_rewrite"?>/module/penghapusan/filter_aset_usulan_pms.php" class="btn">Kembali Ke Pencarian</a>
			
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
						<th>Merk / Type</th>
					</tr>
				</thead>
				<tbody>		
				<tr>
                                        <td colspan="10">Data Tidak di temukkan</td>
                                   </tr>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
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
	include"$path/footer.php";
?>