<?php
include "../../config/config.php";
$MUTASI = new RETRIEVE_MUTASI;
$menu_id = 78;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

$id=$_GET['id'];
//pr($id);
$par_data_table = "id=$id";
if (isset($id)){
	unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
	$parameter = array('id'=>$id);
	$data = $MUTASI->DataUsulan($id);
	$row=$data[0];	
}
//pr($row);
//exit();
?>
	
	<script>
        $(function(){
       		 $('#tanggal1').datepicker();
       		 $("#cekAll").click( function(){
   				if($(this).is(':checked')){
					//alert("checked");
					$("#submit").removeAttr("disabled");
				}else{
					$('#submit').attr('disabled','disabled');
				}   					 
			});
        });
        function confirmValidate(){	
			var r = confirm("Anda Yakin Menghapus Data!");
		    if (r == true) {
		        return true;
		    } else {
		        return false;
		    }		
		}
	</script>
	
	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form3 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('DELUSMTS');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('DELUSMTS');
			}}, 500);
		}
		</script>

		<script>
   		$(document).ready(function() {
          	$('#rvw_aset_usulan_mts').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": false,"sClass": "checkbox-column" },
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": false}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_review_edit_aset_usulan.php?<?php echo $par_data_table?>"
               });
      	});
    </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Transfer SKPD</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Transfer SKPD</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Transfer SKPD</div>
				<div class="subtitle">Input Usulan Transfer SKPD</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
			<a class="shortcut-link active" href="<?=$url_rewrite?>/module/mutasiSkpd/list_usulan.php">
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
			<a class="shortcut-link" href="<?=$url_rewrite?>/module/mutasiSkpd/list_validasi.php">
				<span class="fa-stack fa-lg">
			      <i class="fa fa-circle fa-stack-2x"></i>
			      <i class="fa fa-inverse fa-stack-1x">3</i>
			    </span>
				<span class="text">Validasi Transfer SKPD</span>
			</a>
		</div>		

		<section class="formLegend">
			<form method="POST" action="<?php echo "$url_rewrite/module/mutasiSkpd/"; ?>dftr_asetid_usulan_proses_upd.php"> 
				<div class="detailLeft">
				<div class="row">
					<?php
						if($row['StatusPenetapan']==0){
							$disabled="";
						}elseif($row['StatusPenetapan']==1){
							$disabled="disabled";
						}

						$TglUsulanTmp=explode("-", $row['TglUpdate']);
						$TglUsulan=$TglUsulanTmp[1]."/".$TglUsulanTmp[2]."/".$TglUsulanTmp[0];
					?>
					<ul>
						<?=selectSatker('SatkerUsul','260',true,$row['SatkerUsul'],'required','Kode Satker Asal');?>
						<br/>
						<?=selectAllSatker('SatkerTujuan','260',true,$row['SatkerTujuan'],'required',false,1,'Kode Satker Tujuan');?>
						<br/>
					</ul>
				</div>
				</div>

				<div class="detailRight">
				<div class="row">
					<ul>
						<li>
							<span  class="labelInfo span2">No Usulan</span>
							<input type="text" class="span3" name="NoUsulan" value="<?=$row['NoUsulan']?>" <?=$disabled?> required/>
						</li>
						<li>
							<span  class="labelInfo span2">Tanggal Usulan</span>
								<span class="add-on"></span>
								<input name="tanggalUsulan" class="span3" type="text" id="tanggal1" <?=$disabled?>  value="<?=$row['TglUpdate']?>" required/>
						</li>
						<li>
							<span class="labelInfo span2">Keterangan usulan</span>
							<textarea rows="3" class="span3" cols="100" name="KetUsulan" <?=$disabled?> required ><?=$row['KetUsulan']?></textarea>
						</li>
						<li>
							<span  class="labelInfo span2">&nbsp;</span>
							<input type="hidden" name="usulanID" value="<?=$id?>"/><br/>
						</li>
						<li>
							<span  class="labelInfo span2">&nbsp;</span>
							<input type="submit" <?=$disabled?> value="Update Informasi Usulan" class="btn"/>
						</li>
					</ul>	
				</div>
				</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			</form>

			<form method="POST" ID="Form3" action="<?php echo "$url_rewrite/module/mutasiSkpd/"; ?>dftr_asetid_usulan_proses_hapus.php" onsubmit="return confirmValidate()" > 
			<div id="demo">
			<?php
				if($row['StatusPenetapan']==0){
					$idtable="penghapusan11";
				}else{
					$idtable="penghapusan10";
				}

			?>
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="rvw_aset_usulan_mts">
				<thead>
					<?php
								if($row['StatusPenetapan']==0){
							?>
					<tr> 
						<td colspan="11" align="center">
							<h4>Ceklis dibawah ini untuk menghapus semua aset :</h4>
							 <label><input type="checkbox" value="1" name ="cekAll" id="cekAll"><h4>Select All</h4></label>
						</td>
					</tr>
					<?php
						}
					?>
					<tr>
						<td colspan="7" align="Left">
							<?php
								if($row['StatusPenetapan']==0){
							?>
								<a href="filter_tambah_aset_usulan.php?usulanID=<?=$id?>" class="btn btn-info " /><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;TambahKan Aset Usulan</a>
								<span><button type="submit" name="submit"  class="btn btn-danger " id="submit" disabled/><i class="icon-trash icon-white"></i>&nbsp;&nbsp;Delete</button></span>
								<input type="hidden" name="usulanID" value="<?=$id?>"/>
							<?php
								}
							?>
						</td>
						<?php
								if($row['StatusPenetapan']==0){
							?>
						<td colspan="4" align="right">
							<?php
								}else{
							?>

						<td colspan="10" align="right">
							<?php
								}
							?>
							<a href="list_usulan.php" class="btn btn-success " /><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali Ke Daftar Usulan</a>
								
						</td>
					</tr>
					<tr>
						<th>No</th>
						<?php
								if($row['StatusPenetapan']==0){
							?>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
							<?php
								}else{
									echo"<th>&nbsp;</th>";
								}
							?>
						<th>No Register</th>
						<th>Kode / Uraian</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
						<th>Status Konfirmasi</th>
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
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			</form>
			<div class="spacer"></div>
			    
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>