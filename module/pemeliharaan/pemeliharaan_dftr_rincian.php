<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

// $menu_id = 60;
$menu_id = 63;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
// pr($SessionUser);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
// pr($_POST);
// exit;

// pr(decode($_GET['url']));
// pr(decode($_GET['id']));

if(count($_POST) != 0){
$SessionUser['tahun'] = $_POST['Tahun'];
$SessionUser['register_aw'] = $_POST['register_aw'];
$SessionUser['register_ak'] = $_POST['register_ak'];
$SessionUser['satker'] = $_POST['kodeSatker'];
$SessionUser['kodeKelompok'] = $_POST['kodeKelompok'];
$SessionUser['tipeAset'] = $_POST['tipeAset'];
//buat link kembali ke filter
$par_pmlhrn = "id=".decode($_GET['id']);
$par_pmlhrn_scd = "sk=".decode($_GET['sk']);

$tmpUrl =encode($par_pmlhrn."&".$par_pmlhrn_scd);
// pr(decode($tmpUrl));

$par_data_table="tahun=$SessionUser[tahun]&satker=$SessionUser[satker]&kodeKelompok=$SessionUser[kodeKelompok]&tipeAset=$SessionUser[tipeAset]&Reg_aw=$SessionUser[register_aw]&Reg_ak=$SessionUser[register_ak]";

//informasi
$Pemeliharaan_ID = decode($_GET['id']);
$query = "select * from pemeliharaan where Pemeliharaan_ID ='$Pemeliharaan_ID'";
// pr($queryTipe);
$exequery = $DBVAR->query($query);
$GetData = $DBVAR->fetch_array($exequery);	
}else{
//buat link kembali ke filter
$tmpIdPmlrhn = decode($_GET['id']);
$tmpIdPmlrhn_scd = decode($_GET['sk']);

$par_pmlhrn = "id=".$tmpIdPmlrhn;
$par_pmlhrn_scd = "sk=".$tmpIdPmlrhn_scd;

$tmpUrl =encode($par_pmlhrn."&".$par_pmlhrn_scd);
// echo  decode($tmpUrl);
//buat dapetin parameter filter awal
$getUrl = decode($_GET['url']);
// pr($getUrl);
$par_data_table="$getUrl";

//informasi
$Pemeliharaan_ID = decode($_GET['id']);
$query = "select * from pemeliharaan where Pemeliharaan_ID ='$Pemeliharaan_ID'";
// pr($queryTipe);
$exequery = $DBVAR->query($query);
$GetData = $DBVAR->fetch_array($exequery);	
}
?>
	<script>
	$(document).ready(function() {
		  $('#rencana_pemeliharaan').dataTable(
				   {
					"aoColumnDefs": [
						 { "aTargets": [2] }
					],
					"aoColumns":[
						 {"bSortable": false},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": false},
						 {"bSortable": false}],
					"sPaginationType": "full_numbers",

					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "<?=$url_rewrite?>/api_list/view_pemeliharaan.php?<?php echo $par_pmlhrn."&".$par_data_table?>"
			   }
				  );
	  });
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemeliharaan</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Pemeliharaan</div>
			<div class="subtitle">Buat Data Pemeliharaan</div>
		</div>
		<!--<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Data Pemeliharaan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/pemeliharaan/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Pemeliharaan</span>
				</a>
			</div>-->	
		
		<section class="formLegend">
				<div class="detailLeft">
								
								<ul>
									<li>
										<span class="labelInfo">No.SP2D</span>
										<input type="text" value="<?=$GetData['nosp2d']?>" disabled/>
									</li>
									<li>
										<span class="labelInfo">Tgl.SP2D</span>
										<input type="text" value="<?=$GetData['tglsp2d']?>" disabled/>
									</li>
								</ul>
									
							</div>
					<div class="detailRight">
								
								<ul>
									<li>
										<span class="labelInfo">Nama Penyedia Jasa</span>
										<input type="text" value="<?=$GetData['NamaPenyediaJasa']?>" disabled/>
									</li>
									<li>
										<span  class="labelInfo">Tgl.Pemeliharaan</span>
										<input type="text" value="<?=$GetData['tglPemeliharaan']?>" disabled/>
									</li>
								</ul>
									
							</div>
						
				<div style="height:5px;width:100%;clear:both"></div>
				
			<div class="detailRight">
				<a id="addruangan" class="btn btn-small" href="<?=$url_rewrite.'/module/pemeliharaan/pemeliharaan_rincian.php?url='.$tmpUrl?>" >
				<i class="" align="center"></i>
				  Kembali ke halaman : Form Filter
				</a>
			</div>
			<br />
			<br />
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="rencana_pemeliharaan">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode / <br>Nama Barang</th>
						<th>Merk</th>
						<th>NoRegister</th>
						<th>Nilai Perolehan</th>
						<th>Tahun</th>
						<th>Keterangan</th>
						<th>Status<br>Pemeliharaan</th>
						<th>Rincian</th>
						<th>Aksi</th>

					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="10">Data Tidak di temukan</td>
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
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table> 
		</div>
		<div class="spacer"></div>
		
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>