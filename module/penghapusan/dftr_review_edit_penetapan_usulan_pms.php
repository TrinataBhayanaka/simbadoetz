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
	// if($_POST['submit']==''){
	// $dataPost=$_SESSION['dataPost'];
	// }else{
	// $_SESSION['dataPost']=$_POST;
	// $dataPost=$_SESSION['dataPost'];
	// }
	// $data = $PENGHAPUSAN->retrieve_penetapan_penghapusan_eksekusi_pms($_POST);
	$idPenetapan=$_GET['id'];
	////pr($idPenetapan);
	// $data = $PENGHAPUSAN->retrieve_penetapan_penghapusan_edit_data_pms($_GET);

						$data = $PENGHAPUSAN->DataPenetapan($idPenetapan);
	// pr($data);
	// pr($_GET);
	// pr($data);
	// //pr($data);

		$POST['page'] = intval($_GET['pid']);
	// pr($POST);
	    $par_data_table="id={$_GET['id']}&page={$POST['page']}";

		 $sql = mysql_query("SELECT * FROM kontrak ORDER BY id ");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                $kontrak[] = $dataKontrak;
            }
	?>
	<!-- End Sql -->

	<script>
        $(function()
        {
       		 $('#tanggal1').datepicker();

        }
		);
	</script>
	<script language="Javascript" type="text/javascript">  
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
	</script>
	<script>
	jQuery(function($) {
	        $('#TotalNilai').autoNumeric('init', {mDec:0});
	        
	    });
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {

			var totalnilai = 0;	
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    var checkedValues = $('input:checkbox:checked').map(function() {
			    	// alert('love');
				    var data = this.value.split("|");
				    var nilai = data[1];
				    if(nilai){
				    	totalnilai = parseInt(totalnilai) + parseInt(nilai);	
				    }
				    $("#TotalNilai").val(totalnilai);
				     $('#TotalNilai').autoNumeric('set', totalnilai);
				    // console.log(totalnilai);
				}).get();
				// var rule = totalnilai + parseInt($("#totalRBreal").val());
				// if(rule > $("#spkreal").val()){
				// 	$('#info').html('Nilai melebihin total SPK'); 
    //             	$('#info').css("color","red");
				// 	$('#btn-dis').attr("disabled","disabled");		
				// } else {
				// 	$('#info').html('');
				// }
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    $("#TotalNilai").val(0);
			}}, 100);
		}
		</script>

		<script>
    $(document).ready(function() {
          $('#rvw_penetapan_usulan_pms_table').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         // {"bSortable": false,"sClass": "checkbox-column" },
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": false},
                         // {"bSortable": false},
                         {"bSortable": false}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_review_edit_penetapan_usulan_pms.php?<?php echo $par_data_table?>"
               }
                  );
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
				<div class="subtitle">Review Aset yang akan dibuat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusan/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusan/dftr_penetapan_pms.php">
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
			<form name="form" method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_edit_proses_pms.php">
					<?php
							if($_SESSION['ses_uaksesadmin']!=1){
								$disabledForm="disabled";
							}
						?>
			<div class="detailLeft">
						
						<ul>
							<li>
								<span  class="labelInfo">No SK Penghapusan</span>
								<input type="text" id="idnoskhapus" name="bup_pp_noskpenghapusan" value="<?=$data[0]['NoSKHapus']?>" <?php echo $disabledForm;?> required>
						
							</li>
							<li>
								<span class="labelInfo">Keterangan Penghapusan</span>
								<textarea  id="idinfohapus" name="bup_pp_get_keterangan" <?php echo $disabledForm;?> required><?=$data[0]['AlasanHapus']?></textarea>
							</li>
						</ul>
							
					</div>

			<div class="detailRight">
				<ul>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						&nbsp;
					</li>
					<li>
						<?php
							
							$TglSKHapusTmp=explode("-", $data['dataRow'][0]['TglHapus']);
							// //pr($TglSKHapusTmp);
							$TglSKHapus=$TglSKHapusTmp[1]."/".$TglSKHapusTmp[2]."/".$TglSKHapusTmp[0];

						?>
						<span  class="labelInfo">Tanggal SK Penghapusan</span>
						<input name="bup_pp_tanggal" type="text" id="tanggal1" value="<?=$data[0]['TglHapus']?>" <?php echo $disabledForm;?> required/>
					</li>
					<?php
							if($_SESSION['ses_uaksesadmin']==1){
						?>
					<!-- <li>
						<span  class="labelInfo">Total Nilai</span>
						<input name="bup_pp_nilaiPerolehan" type="text" id="TotalNilai" value=""required/>
					</li> -->
					<?php
						}
					?>
					<!-- <li>
						<span  class="labelInfo">Total Nilai Usulan</span>
						<input type="text" value="" disabled/>
					</li> -->
				</ul>
			</div>
	
			<div style="height:5px;width:100%;clear:both"></div>
		
			<div id="demo">
			
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="rvw_penetapan_usulan_pms_table">
				<thead>
					<?php
							if($_SESSION['ses_uaksesadmin']==1){

								if($data['dataRow'][0]['Status']=0){
						?>
					<tr>
						<td colspan="10" align="Left">
								<!-- <span><button type="submit" name="submit"  value="tetapkan" class="btn btn-info " id="submit" /><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Usulkan Untuk Penghapusan</button></span> -->
								<span><button type="submit" name="submit"  value="tetapkan" class="btn btn-info " id="submit" /><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Update Informasi Penetapan</button></span>
								<input type="hidden" name="id" value="<?=$idPenetapan?>"/>
						</td>
					</tr>
					<?php
							}
						}
					?>
					<tr>
						<th>No</th>
						<?php
							if($_SESSION['ses_uaksesadmin']==1){
						?>
						<!-- <th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th> -->
						<?php } ?>
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
                        <td colspan="9">Data Tidak di temukkan</td>
                     </tr>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<?php
							if($_SESSION['ses_uaksesadmin']==1){
						?>
						<!-- <th>&nbsp;</th> -->
						<?php } ?>
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
			</form>
			<div class="spacer"></div>
		<!-- 	<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Satker</th>
						<th>No. Dokumen</th>
						<th>Tanggal</th>
						<th>Jenis Dokumen</th>
						<th>Tipe Aset</th>
						<th>Nilai</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody> -->
					<!-- 
				<?php
						$jmlUsulan=count($data['dataRow']);
						$disabledForm="";
						foreach ($data['dataRow'] as $valueUsulan) {
							
							$dataUsulanAset = $PENGHAPUSAN->retrieve_penetapan_penghapusan_detail_usulan($valueUsulan['Usulan_ID']);
									////pr($dataUsulanAset);
									// ////pr($_SESSION);
									// StatusKonfirmasi
									$no = 1;
									foreach ($dataUsulanAset as $keys => $nilai)
									{
										if ($nilai[Aset_ID] !='')
										{
										if ($nilai->AsetOpr == 0)
										$select="selected='selected'";
										if ($nilai->AsetOpr ==1)
										$select2="selected='selected'";

										if($nilai->SumberAset =='sp2d')
										$pilih="selected='selected'";
										if($nilai->SumberAset =='hibah')
										$pilih2="selected='selected'";

										if($nilai[StatusKonfirmasi]==1){
											$textLabel="Diterima";
											$labelColor="label label-success";
										}elseif($nilai[StatusKonfirmasi]==2){
											$textLabel="Ditolak";
											$labelColor="label label-danger";
										}else{
											$textLabel="Ditunda";
											$labelColor="label label-warning";
											$disabled="
										<a href='penetapan_asetid_proses_diterima.php?asetid=$nilai[Aset_ID]' class='btn btn-success' >Diterima</a>
										<a href='penetapan_asetid_proses_ditolak.php?asetid=$nilai[Aset_ID]' class='btn btn-danger' >Ditolak</a>";
										}
						?>
					<tr class="gradeA">
						<td><?=$no?>|<?php echo $valueUsulan['Usulan_ID'];?></td>
						<td width="20%"><?=$nilai['NamaSatker']?></td>
						<td><?=$nilai['noKontrak']?></td>
						<td><?=$nilai['tglKontrak']?></td>
						<td><?=($nilai['tipe_kontrak'] == 2) ? 'Pembelian Langsung' : 'Kontrak'?></td>
						<td><?=$nilai['tipeAset']?></td>
						<td><?=number_format($nilai['nilai'])?></td>
						<td class="center">
						<?php
						if($nilai['n_status'] != 1){
						?>	
							<a href="<?=($nilai['tipe_kontrak'] == 1) ? 'kontrakedit' : 'pledit'?>.php?id=<?=$nilai['id']?>" class="btn btn-warning btn-small"><i class="icon-edit icon-white"></i>&nbsp;Ubah</a>
							<a href="kontrakhapus.php?id=<?=$val['id']?>" class="btn btn-danger btn-small"><i class="icon-trash icon-white"></i>&nbsp;Hapus</a>
						<?php
						} else {
							echo "<span class='label label-Success'>Sudah di posting</span>";
						}
						?>
						</td>
						
					</tr>
					<?php
					$no++;
										}
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
			<div class="spacer"></div> -->
		</form>
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>