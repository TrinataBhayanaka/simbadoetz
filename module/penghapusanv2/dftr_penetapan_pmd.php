<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 74;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_kontrak();
$tahun= $_GET['tahun'];
if($tahun=="") $tahun=$TAHUN_AKTIF;
$par_data_table="tahun=$tahun";

//pr($par_data_table);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
	
?>
	<!-- End Sql -->
	<script>
    $(document).ready(function() {
          $('#penetapan_pmd_table').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         // {"bSortable": false,"sClass": "checkbox-column" },
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": false}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_penetapan_pmd_rev.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Daftar Penetapan Penghapusan Pemindahtanganan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_usulan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_penetapan_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_validasi_pmd.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			<?php
				if($_SESSION['ses_ujabatan']==1){
			?>
			<p><a href="<?=$url_rewrite?>/module/penghapusanv2/tambah_penetapan_pmd.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Penetapan Penghapusan</a>
			&nbsp;</p>
			<p>Tahun Penetapan:
				<?=$tahun?>
			</p>
			<?php
			$tahun_akhir=date("Y");
			for($tahun=2014;$tahun<=$tahun_akhir;$tahun++){


			?><a href="?tahun=<?=$tahun?>" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;<?=$tahun?></a>
			&nbsp;
			<?php
			}
			?>
			</p>	
			<?php
				}
			?>
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="penetapan_pmd_table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor SK Penghapusan</th>
						<th>Satker</th>
						<th>Jumlah Usulan</th>
						<th>Jumlah Aset</th>
						<th>Tgl Penetapan</th>
						<th>Total Nilai</th>
						<th>Keterangan</th>
						<th>Status</th>
						<th>Tindakan</th>
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