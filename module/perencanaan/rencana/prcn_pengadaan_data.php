<?php
include "../../../config/config.php";

	$PERENCANAAN = new RETRIEVE_PERENCANAAN;
$menu_id = 61;
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

	// 	$POST['page'] = intval($_GET['pid']);
	// pr($_POST);
	//     $par_data_table="kodeKelompok={$POST['kodeKelompok']}&kdRekening={$POST['kdRekening']}";
if($_POST){
$data = $PERENCANAAN->retrieve_daftar_perencanaan_pengadaan($_POST);
}else{

$data = $PERENCANAAN->retrieve_daftar_perencanaan_pengadaan($_GET);
} 
		// $data = $PENGHAPUSAN->retrieve_daftar_penetapan_penghapusan_pmd($_POST);
		//////pr($data);
		 // $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
   //      while ($dataKontrak = mysql_fetch_assoc($sql)){
   //              $kontrak[] = $dataKontrak;
   //          }
	?>
	<!-- End Sql -->
	<script>
    // $(document).ready(function() {
    //       $('#penetapan_pmd_table').dataTable(
    //                {
    //                 "aoColumnDefs": [
    //                      { "aTargets": [2] }
    //                 ],
    //                 "aoColumns":[
    //                      {"bSortable": false},
    //                      // {"bSortable": false,"sClass": "checkbox-column" },
    //                      {"bSortable": true},
    //                      {"bSortable": true},
    //                      {"bSortable": false},
    //                      {"bSortable": false},
    //                      {"bSortable": true},
    //                      {"bSortable": true},
    //                      {"bSortable": false},
    //                      // {"bSortable": false},
    //                      {"bSortable": false}],
    //                 "sPaginationType": "full_numbers",

    //                 "bProcessing": true,
    //                 "bServerSide": true,
    //                 "sAjaxSource": "<?=$url_rewrite?>/api_list/api_perencanaan_pengadaan.php?<?php echo $par_data_table?>"
    //            }
    //               );
    //   });
    </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Rencana Pengadaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Rencana Pengadaan</div>
				<div class="subtitle">Data Rencana Pengadaan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_tambah.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Tambah Rencana Pengadaan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Rencana Pengadaan</span>
				</a>
			</div>		

		<section class="formLegend">
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis Aset</th>
						<th>Rekening</th>
						<th>Kuantitas</th>
						<th>Harga Satuan</th>
						<th>Nilai Perolehan</th>
						<th>Info</th>
						<th>Status Pemeliharaan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>	

				<?php
				$no=1;
					foreach ($data as $key => $value) {
					$total=$value['Harga_Satuan']*$value['Kuantitas'];
					if($value['Status_Pemeliharaan']==0){
						$css="warning";
						$text="Belum";
					}elseif($value['Status_Pemeliharaan']){
						$css="success";
						$text="OK";
					}
						
				?>	
					 <tr>
                        <td><?=$no++?></td>
                        <td>[<?=$value['Kode_Kelompok']?>]<br/>
                        	<strong><?=$value['Uraian']?></strong></td>
                        <td>[<?=$value['Kode_Rekening']?>]<br/>
                        	<strong><?=$value['NamaRekening']?></strong></td>
                        <td><?=$value['Kuantitas']?></td>
                        <td>Rp. <?=number_format($value['Harga_Satuan'])?></td>
                        <td>Rp. <?=number_format($total)?></td>
                        <td><?=$value['Info']?></td>
                        <td align="center">
                        	<span class="label label-<?=$css?>"><?=$text?></span>
                        </td>
                        <td>
                        <?php
                        	if($value['Status_Pemeliharaan']==0){
                        ?>	
                        	<!-- <a href="#" class="btn btn-info btn-small">Edit</a> -->
                        	<a href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_edit.php?id=<?=$value['Rencana_ID']?>&tipe=<?=$value['TipeAset']?>&satker=<?=$value['Kode_Satker']?>" class="btn btn-info btn-small">Edit</a>
                        	<a href="<?=$url_rewrite?>/module/perencanaan/rencana/prcn_pengadaan_delete.php?id=<?=$value['Rencana_ID']?>&tipe=<?=$value['TipeAset']?>&satker=<?=$value['Kode_Satker']?>" class="btn btn-danger btn-small" onClick="return confirm('Anda yakin akan menghapus data ini?');">Hapus</a>
                        <?php
                    	}else{
                    	?>
                    	<a href="#" class="btn btn-success btn-small">Detail</a>
                    	<?php
                    	}
                        ?>
                        </td>
                     </tr>
                <?php
                }

                ?>
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