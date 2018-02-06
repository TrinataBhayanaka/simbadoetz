<?php
include "../../config/config.php";

$MUTASI = new RETRIEVE_MUTASI;
$menu_id = 78;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
	
unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);

$tahun= $_GET['tahun'];
if($tahun=="") $tahun=$TAHUN_AKTIF;
$par_data_table="tahun=$tahun";

?>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Transfer SKPD</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Transfer SKPD</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Transfer SKPD</div>
				<div class="subtitle">Daftar Penetapan Transfer SKPD</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/mutasiSkpd/list_usulan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Transfer SKPD</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/mutasiSkpd/list_penetapan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Transfer SKPD</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/mutasiSkpd/list_validasi.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Transfer SKPD</span>
				</a>
			</div>			

		<section class="formLegend">
			<script>
    $(document).ready(function() {
          $('#usulan_pmd_table').dataTable(
                   {
                   	"aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/list_validasi_mutasi.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
    		<?php
				if($_SESSION['ses_ujabatan']==1){
			?>
    		<p><a href="<?=$url_rewrite?>/module/mutasiSkpd/dftr_penetapan_validasi.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Validasi Penetapan</a>
			<?php
				}
			?>
			<p>Tahun Usulan:
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
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="usulan_pmd_table">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor SK Mutasi</th>
						<th>Satker Usul</th>
						<th>Satker Tujuan</th>
						<th>Jumlah Usulan</th>
						<th>Tgl Penetapan</th>
						<th>Keterangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="8">Data Tidak di temukkan</td>
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