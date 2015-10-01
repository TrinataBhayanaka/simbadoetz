<?php
include "../../config/config.php";
require_once "$path/API/retrieve_regrouping.php";

//require_once "$path/function/tanggal/format_tanggal_with_explode.php";
$REGROUPING=new RETRIEVE_REGROUPING();
$menu_id = 64;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
           $data= $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
     //      pr($Session);

$get_data_regrouping= $REGROUPING->getStatusRegrouping();
// pr($_SESSION);

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php

	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pindah Lokasi SKPD</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Status Pindah Lokasi SKPD</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Status Pindah Lokasi SKPD</div>
				<div class="subtitle">Daftar SKPD</div>
			</div>	

			

		<section class="formLegend">
			
			<p><a href="tambah_regrouping.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Regrouping</a>
			&nbsp;
			<!-- <a class="btn btn-danger btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Kontrak Simral</a>
			&nbsp; --></p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Satker Lama</th>
						<th>Nama Satker Lama</th>
						<th>Kode Satker Baru</th>
                                                                                 <th>Nama Satker Baru</th>
                                                                                 <th>Waktu Proses</th>
                                                                                 <th>Informasi</th>
                                                                                 <th>Status Proses</th>

						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					
				<?php
				if($get_data_regrouping){
					$no = 1;
					foreach($get_data_regrouping as $val){
                                                                           $text_status=array("0"=>"Belum regrouping",
                                                                                                              "1"=>"Sedang regrouping",
                                                                                                              "2"=>"Telah regrouping")
                                                                           
                                                                           
                                                                           
				?>
					<tr class="gradeA">
						<td><?=$no?></td>
						<td><?=$val['satker_lama']?></td>
						<td><?=$val['nama_satker_lama']?></td>
						<td><?=$val['satker_baru']?></td>
                                    <td><?=$val['nama_satker_baru']?></td>
                                    <td><?= format_tanggal($val['tgl_proses'])?></td>
                                    <td><?=$val['informasi']?></td>
                                    <td><?=$text_status[$val['status_proses']]?></td>
                                    <td>
                                         <?php
switch ($val['status_proses']) {
    case 0:
        echo "<a href=\"running_regrouping.php?regrouping={$val['id_regrouping']}\" class=\"btn btn-info\">Lakukan Regrouping</a>";
        echo "<a href=\"proses_regrouping.php?hregrouping={$val['id_regrouping']}\" class=\"btn btn-warning\">Hapus Regrouping</a>";
        break;

default:
     echo "-";
     break;
}
                                         ?>
                                                               
                                         </td>
						</td>
						
					</tr>
				<?php
					$no++;
					}
				}
				?>
			
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">&nbsp;</th>
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