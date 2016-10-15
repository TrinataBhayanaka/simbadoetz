<?php
include "../../../config/config.php";

	// $PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

// $get_data_filter = $RETRIEVE->retrieve_kontrak();
// //////pr($get_data_filter);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	// //pr($_SESSION);

		$POST['page'] = intval($_GET['pid']);
	pr($_POST);
	    $par_data_table="kodeKelompok={$POST['kodeKelompok']}&kdRekening={$POST['kdRekening']}";

		// $data = $PENGHAPUSAN->retrieve_daftar_penetapan_penghapusan_pmd($_POST);
		//////pr($data);
		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
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
                         // {"bSortable": false},
                         {"bSortable": false}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_perencanaan_kebutuhan.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rencana Pengadaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Perencanaan</div>
				<div class="subtitle">Rencana Pengadaan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/kebutuhan/butuh_kebutuhan_tambah.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Tambah Rencana Pengadaan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/kebutuhan/butuh_kebutuhan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pengadaan</span>
				</a>
			</div>		

		<section class="formLegend">
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="penetapan_pmd_table">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis Aset</th>
						<th>Rekening</th>
						<th>Kuantitas</th>
						<th>Harga Satuan</th>
						<th>Total</th>
						<th>Info</th>
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