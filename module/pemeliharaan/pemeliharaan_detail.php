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
	
if(decode($_GET['flag']) == 1){	
//echo decode($_GET['flag']);
//get Aset_ID & tipeAset	
$getUrl = decode($_GET['url']);
// pr($getUrl);
$tempUrl=explode('&',$getUrl);
$getID=explode('=',$tempUrl[0]);
$getTipe=explode('=',$tempUrl[1]);
$Aset_ID =$getID[1];
$TipeAset = $getTipe[1];

//get filter_has_var
$getUrlfilter = decode($_GET['surl']);
// pr($getUrlfilter);

//get Pemeliharaan_ID
$getUrlPmlrn = decode($_GET['turl']);
// pr($getUrlPmlrn);
$getIDPmlrhrn=explode('=',$getUrlPmlrn);
// pr($getIDPmlrhrn);
$PmlhrnID=$getIDPmlrhrn[1];
// pr($PmlhrnID);
$par_data_table = "Aset_ID={$Aset_ID}&PmlhrnID={$PmlhrnID}&";
$add_param_filter = $getUrlfilter;
// echo $par_data_table;

//param back url
$getUrlParamFilter = $_GET['surl'];
$Pemeliharaan_ID = encode($PmlhrnID);
$satker = $_GET['skUrl'];
// pr(decode($satker));

//informasi
$Pemeliharaan_ID_scd = $PmlhrnID;
$query = "select * from pemeliharaan where Pemeliharaan_ID ='$Pemeliharaan_ID_scd'";
// pr($query);
$exequery = $DBVAR->query($query);
$GetData = $DBVAR->fetch_array($exequery);	

}else{

//get Aset_ID & tipeAset	
$getUrl = decode($_GET['url']);
// pr($getUrl);
$tempUrl=explode('&',$getUrl);
$getID=explode('=',$tempUrl[0]);
$getTipe=explode('=',$tempUrl[1]);
$Aset_ID =$getID[1];
$TipeAset = $getTipe[1];

//get filter_has_var
$getUrlfilter = decode($_GET['surl']);
// pr($getUrlfilter);

//param satker
$ex_satker = explode('=',decode($_GET['skUrl']));
$satker = encode($ex_satker[1]);
// pr($satker);
// pr(encode($satker));

//get Pemeliharaan_ID
$getUrlPmlrn = decode($_GET['turl']);
// pr($getUrlPmlrn);
$getIDPmlrhrn=explode('=',$getUrlPmlrn);
// pr($getIDPmlrhrn);
$PmlhrnID=$getIDPmlrhrn[1];

// pr($PmlhrnID);
$par_data_table = "Aset_ID={$Aset_ID}&PmlhrnID={$PmlhrnID}&";
$add_param_filter = $getUrlfilter;
// echo $par_data_table;

//param back url
$getUrlParamFilter = $_GET['surl'];
$Pemeliharaan_ID = encode($PmlhrnID);

//informasi
$Pemeliharaan_ID_scd = $PmlhrnID;
// echo $Pemeliharaan_ID;
$query = "select * from pemeliharaan where Pemeliharaan_ID ='$Pemeliharaan_ID_scd'";
// pr($queryTipe);
$exequery = $DBVAR->query($query);
$GetData = $DBVAR->fetch_array($exequery);	
}
// exit;
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
						 {"bSortable": false}],
					"sPaginationType": "full_numbers",

					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "<?=$url_rewrite?>/api_list/view_pemeliharaan_detail.php?<?=$par_data_table.$add_param_filter?>"
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
				<a id="addruangan" class="btn btn-small" href="<?=$url_rewrite.'/module/pemeliharaan/pemeliharaan_dftr_rincian.php?id='.$Pemeliharaan_ID."&sk=".$satker."&url=".$getUrlParamFilter?>" >
				<i class="" align="center"></i>
				  Kembali ke halaman Daftar Pemeliharaan
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
						<th>Biaya Pemeliharaan</th>
						<th>Jenis Pemeliharaan</th>
						<th>Keterangan</th>
						<th>Aksi</th>

					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="8">Data Tidak di temukan</td>
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