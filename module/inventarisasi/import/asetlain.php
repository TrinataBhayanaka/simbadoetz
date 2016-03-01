<?php
include "../../../config/config.php";
include "excel_reader.php";

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
$RETRIEVE_INVENTARISASI = new RETRIEVE_INVENTARISASI;
if(isset($_GET['id'])){
	// $dataArr = $RETRIEVE_PEROLEHAN->get_kontrak($_GET['id']);
	// $xlsData = $RETRIEVE_PEROLEHAN->get_tmpData('tmp_asetlain');
	
	$POST['page'] = intval($_GET['pid']);
	$par_data_table="bup_tahun={$POST['bup_tahun']}&bup_nokontrak={$POST['bup_nokontrak']}&jenisaset={$POST['jenisaset'][0]}&kodeSatker={$POST['kodeSatker']}&page={$POST['page']}";

} else{
	$dataArr = $RETRIEVE_INVENTARISASI->importing_xls2html($_FILES,$_POST);

}

?>

	<script>
	$(function(){
		$body = $("body");
		$('#btn-dis').click(function(){
			$body.addClass("loading");
			NProgress.inc();
		});

	});
		$(document).ready(function() {
	        $('#totalxls').autoNumeric('init', {mDec:0});
	        setTimeout(function() {
			    	getTotalValue('XLSIMP');
				}, 500);
          $('#importxls').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aLengthMenu": [[25, 50, 100, 500], [25, 50, 100, 500]],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": false,"sClass": "checkbox-column" },
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_import_xls.php?<?php echo $par_data_table?>"
               }
                  );
	        
	    });

		function getCurrency(item){
	      $('#totalxls').val($(item).autoNumeric('get'));
	    }

	    function getTotalValue(item){
	    	$.post('<?=$url_rewrite?>/function/api/getapplist.php', {UserNm:'<?=$_SESSION['ses_uoperatorid']?>',act:item,sess:'<?=$_SESSION['ses_utoken']?>'}, function(data){
					var tmp;
					var nilai = 0;
					if(data){
						$("#btn-dis").removeAttr("disabled");
						$.each(data, function(index, element) {
				            var raw = element.split(",");
							for(var i=0;i<raw.length;i++){
								tmp = raw[i].split("|");
								nilai = parseInt(nilai) + parseInt(tmp[1]);
							}
				        });
					} else {
						nilai = 0;
						$('#btn-dis').attr("disabled","disabled");
					}
					
				    $("#totalxls").val(nilai);
				     $('#totalxls').autoNumeric('set', nilai);

				     var rule = nilai + parseInt($("#totalRBreal").val());
				     console.log($("#totalRBreal").val());
						if(rule > $("#spkreal").val()){
							$('#info').html('Nilai melebihin total SPK'); 
		                	$('#info').css("color","red");
							$('#btn-dis').attr("disabled","disabled");		
						} else {
							$('#info').html('');
						}
				 }, "JSON")
	    }

		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
			var totalnilai = 0;	
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    
			    updDataCheckbox('XLSIMP');

			    setTimeout(function() {
			    	getTotalValue('XLSIMP');
				}, 500);
			}
			else
			{
			   
			   updDataCheckbox('XLSIMP');
			   setTimeout(function() {
			    	getTotalValue('XLSIMP');
				}, 500);
			}}, 100);
		}
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Inventarisasi</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Import xls</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Import Inventarisasi</div>
				<div class="subtitle">Import Data xls</div>
			</div>		

		<section class="formLegend">
			
			<div class="detailRight">
						
						<ul>
							<li>
								<span  class="labelInfo">Total Nilai Data yang dipilih</span>
								<input type="text" id="totalxls" data-a-sep="," value="<?=number_format(0)?>" disabled/>
							</li>
							<li>
				                <span  class="span2">&nbsp;</span>
				                <div class="checkbox">
				                  <em id="info">
				                  </em>
				                </div>
				            </li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
				<form action="" name="checks" ID="Form2">
					<p><a href="hasil_kibe.php?id=<?=$_GET['id']?>"><button type="button" class="btn btn-success btn-small" id="btn-dis" disabled><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Import</button></a>
							&nbsp;</p>

						<div id="demo">
							
						<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="importxls">
							<thead>
								<tr>
									<th>No</th>
									<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
									<th>Kode Kelompok</th>
									<th>Nama Barang</th>
									<th>Kode Lokasi</th>
									<th>Jumlah</th>
									<th>Nilai</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr>
                                    <td colspan="10">Data Tidak di temukkan</td>
                               </tr>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="8">&nbsp;</th>
									<!-- <th><label id=""><?=number_format($total)?></label></th> -->
								</tr>
							</tfoot>
						</table>
					
						</div>
						<input type="hidden" name="kontrakid" value="<?=$_POST['kontrakid']?>">
						<input type="hidden" name="jenisaset" value="<?=$_POST['jenisaset']?>">
						</form>
			<div class="spacer"></div>
			    <style type="text/css">
					/* Start by setting display:none to make this hidden.
				   Then we position it in relation to the viewport window
				   with position:fixed. Width, height, top and left speak
				   speak for themselves. Background we set to 80% white with
				   our animation centered, and no-repeating */
					.modal {
					    display:    none;
					    position:   fixed;
					    z-index:    1000;
					    top:        0;
					    left:       21.5%;
					    height:     100%;
					    width:      100%;
					    background: rgba( 0, 0, 0, .8 ) 
					                url('<?=$url_rewrite?>/js/url2.gif') 
					                50% 50% 
					                no-repeat;
					}

					/* When the body has the loading class, we turn
					   the scrollbar off with overflow:hidden */
					body.loading {
					    overflow: hidden;   
					}

					/* Anytime the body has the loading class, our
					   modal element will be visible */
					body.loading .modal {
					    display: block;
					}
					</style>
					<div class="modal"></div>
		</section> 
		     
	</section>
	
<?php
	include"$path/footer.php";
?>

