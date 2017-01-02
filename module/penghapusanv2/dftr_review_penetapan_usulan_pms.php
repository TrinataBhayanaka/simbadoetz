<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

$menu_id = 74;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<!-- SQL Sementara -->
	<?php
	//pr($_POST);
	$Penghapusan_ID = $_POST['Penghapusan_ID'];
    //pr($Penghapusan_ID);
    $data_post=$PENGHAPUSAN->apl_userasetlistHPS("RVWPTUSPMS");
    $api_list=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
    $param = implode(',', $api_list);
	$par_data_table = "param=$param"; 
	
	?>
	<!-- End Sql -->
	
	<script>
		function confirmValidate(){	
			
			var checkedValue = $('#cekAll:checked').val();
			if(checkedValue){
				//alert("Checked");
				var r = confirm("Anda Yakin Menetapkan Semua Data!");
		    	if (r == true) {
		    	    return true;
		    	} else {
		        	return false;
		    	}	
			}else{
				//alert("Unchecked");				
				var ConfH = $("#countcheckboxH").html();
				var conf = confirm(ConfH);
				if(conf){return true;} else {return false;}	
			}		
		}
		
		function countCheckbox(item,rvwitem){
			setTimeout(function() {
				$.post('<?=$url_rewrite?>/function/api/countapplist.php', { UserNm:'<?=$_SESSION['ses_uoperatorid']?>',act:item,rvwact:rvwitem,sess:'<?=$_SESSION['ses_utoken']?>'}, function(data){
						//console.log(data);
						$("#countcheckbox").html("<h5>Jumlah Data yang akan dibuat usulan <div class='blink_text_blue'>"+data.countAset+" Data Aset</div><div>Total Nilai Rp."+data.totalNilaiAset+",-</div></h5>");
						$("#countcheckboxH").html("Jumlah Data yang akan dibuat usulan "+data.countAset+" Data Aset dengan Total Nilai Rp."+data.totalNilaiAset+",-");
					 },"JSON")
			}, 500);
		}
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('PTUSPMS');
			    countCheckbox('PTUSPMS');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('PTUSPMS');
			    countCheckbox('PTUSPMS');
			}}, 300);
		}

		$(document).ready(function() {
			AreAnyCheckboxesChecked();
			$("#cekAll").click( function(){
   				if($(this).is(':checked')){
					//alert("checked");
					$("#submit").removeAttr("disabled");
				}else{
					$('#submit').attr('disabled','disabled');
				}   					 
			});
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
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false},
                         //{"bSortable": false},
                         {"bSortable": true}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_review_edit_aset_penetapan_pms_rev.php?<?php echo $par_data_table?>"
               });
      	});
		</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Aset Usulan Penghapusan Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Pemindahtanganan</div>
				<div class="subtitle">Review Aset yang akan dibuat Usulan</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_usulan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penghapusan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_penetapan_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penghapusan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penghapusanv2/dftr_validasi_pms.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penghapusan</span>
				</a>
			</div>		

		<section class="formLegend">
			<form name="form" method="POST" ID="Form2" onsubmit="return confirmValidate()" action="<?php echo "$url_rewrite/module/penghapusanv2/"; ?>penetapan_penghapusan_tambah_data_proses_pms.php">
			<input type="hidden" name="Penghapusan_ID" value="<?=$Penghapusan_ID?>">
			<input type="hidden" name="Usulan_ID" value="<?=$param?>">
	
			<div style="height:5px;width:100%;clear:both"></div>
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="rvw_aset_usulan_pmd_table">
				<thead>
					<tr>
						<td colspan="10" align="center">
							<span id="countcheckbox"><h5>Jumlah Data yang akan dibuat usulan <div class="blink_text_blue"><?=$CountData?> Data Aset</div></h5></span>
							<span id="countcheckboxH" class="label label-success" style="display:none">Jumlah Data yang akan dibuat usulan 1 <?=$CountData?> Data Aset</span>
						</td>
						
					</tr>
					<tr> 
						<td colspan="10" align="center">
							<h4>Ceklis dibawah ini untuk penetapan semua aset :</h4>
							 <label><input type="checkbox" value="1" name ="cekAll" id="cekAll"><h4>Select All</h4></label>
						</td>
					</tr>
					<tr>
						<td colspan="10">
							<button type="submit" id="submit" class="btn btn-info" disabled=""><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;TambahKan Aset Penetapan</button>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Register</th>
						<th>Kode / Uraian</th>
						<th>Satker </th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
						<th>Merk / Type</th>
						<!--<th>Jenis Penghapusan</th>-->	
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
						<!--<th>&nbsp;</th>-->
					</tr>
				</tfoot>
			</table>
			</div>
			</form>
			<div class="spacer"></div>
		</form>
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>