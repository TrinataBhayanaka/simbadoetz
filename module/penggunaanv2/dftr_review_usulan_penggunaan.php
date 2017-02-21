<?php
include "../../config/config.php";
$PENGGUNAAN = new RETRIEVE_PENGGUNAAN;
$menu_id = 76;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

$id=$_GET['id'];
$par_data_table = "id=$id";
if (isset($id)){
	unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
	$parameter = array('id'=>$id);
	$data = $PENGGUNAAN->DataUsulan($id);
	$row=$data[0];	
}
//pr($row);
//exit;
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
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('DELUSPNG');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('DELUSPNG');
			}}, 500);
		}
		</script>

		<script>
   		$(document).ready(function() {
          	$('#rvw_aset_usulan_pmd_table').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": false,"sClass": "checkbox-column" },
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
                "sAjaxSource": "<?=$url_rewrite?>/api_list/api_review_usulan_penggunaan.php?<?php echo $par_data_table?>"
               });
      	});
    </script>
	<section id="main">
		<ul class="breadcrumb">
			 <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penggunaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Penetapan Penggunaan</li>
			  <?php SignInOut();?>
		</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penggunaan</div>
				<div class="subtitle">Daftar Penetapan Penggunaan</div>
			</div>	
		<div class="grey-container shortcut-wrapper">
			<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penggunaanv2/dftr_usulan_penggunaan.php">
				<span class="fa-stack fa-lg">
			      <i class="fa fa-circle fa-stack-2x"></i>
			      <i class="fa fa-inverse fa-stack-1x">1</i>
			    </span>
				<span class="text">Penetapan Penggunaan</span>
			</a>
			<a class="shortcut-link" href="<?=$url_rewrite?>/module/penggunaanv2/dftr_validasi_penggunaan.php">
				<span class="fa-stack fa-lg">
			      <i class="fa fa-circle fa-stack-2x"></i>
			      <i class="fa fa-inverse fa-stack-1x">2</i>
			    </span>
				<span class="text">Validasi Penggunaan</span>
			</a>
		</div>			

		<section class="formLegend">
			<form method="POST" action="<?php echo "$url_rewrite/module/penggunaanv2/"; ?>dftr_asetid_usulan_proses_upd_penggunaan.php"> 
			
			<div class="detailLeft">
				<?php
					if($row['Status']==0){
						$disabled="";
					}elseif($row['Status']==1){
						$disabled="disabled";
					}

				?>
						
			<ul>
				<li>
					<span  class="labelInfo">No Penetapan</span>
					<input type="text" name="NoSKKDH" value="<?=$row['NoSKKDH']?>" <?=$disabled?> required/>
				</li>
				<li>
					<span class="labelInfo">Keterangan Penetapan</span>
					<textarea name="ketUsulan" <?=$disabled?> required><?=$row['Keterangan']?></textarea>
				</li>
				<li>
					<span  class="labelInfo">&nbsp;</span>
					<input type="submit" <?=$disabled?> value="Update Informasi" class="btn"/>
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
						<span  class="labelInfo">Tanggal Penetapan</span>
							<div class="input-prepend">
								<span class="add-on"><i class="fa fa-calendar"></i></span>
								<input name="TglSKKDH" type="text" id="tanggal1" <?=$disabled?>  value="<?=$row['TglSKKDH']?>" required/>
							</div>
						
					</li>
					<li>
						<span  class="labelInfo">&nbsp;</span>
						<input type="hidden" name="Penggunaan_ID" value="<?=$id?>"/><br/>
					</li>
				</ul>
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			</form>
			<form method="POST" ID="Form2" action="<?php echo "$url_rewrite/module/penggunaanv2/"; ?>dftr_asetid_usulan_proses_hapus_penggunaan.php" onsubmit="return confirmValidate()" > 
			<div id="demo">
			<?php
				if($row['Status']==0){
					$idtable="penghapusan11";
				}else{
					$idtable="penghapusan10";
				}

			?>
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="rvw_aset_usulan_pmd_table">
				<thead>
					<?php
								if($row['Status']==0){
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
								if($row['Status']==0){
							?>
								<a href="filter_tambah_aset_usulan_penggunaan.php?Penggunaan_ID=<?=$id?>" class="btn btn-info " /><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;TambahKan Aset Usulan</a>
								<span><button type="submit" name="submit"  class="btn btn-danger " id="submit" disabled/><i class="icon-trash icon-white"></i>&nbsp;&nbsp;Delete</button></span>
								<input type="hidden" name="usulanID" value="<?=$id?>"/>
							<?php
								}
							?>
						</td>
						<?php
								if($row['Status']==0){
							?>
						<td colspan="4" align="right">
							<?php
								}else{
							?>

						<td colspan="10" align="right">
							<?php
								}
							?>
							<a href="dftr_usulan_penggunaan.php" class="btn btn-success " /><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali Ke Daftar Usulan</a>
								
						</td>
					</tr>
					<tr>
						<th>No</th>
						<?php
								if($row['Status']==0){
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
						<th>Kondisi / Asal Usul</th>
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