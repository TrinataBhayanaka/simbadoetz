<?php
include "../../config/config.php";
		
$menu_id = 64;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
error_reporting(0);
// pr($_SESSION);
if($_SESSION['ses_uaksesadmin'] == 1){
	//akses admin
	$par_data_table="usernm={$_SESSION['ses_uoperatorid']}&akses={$_SESSION['ses_uaksesadmin']}";
}else{
	//akses user biasa
	$par_data_table="usernm={$_SESSION['ses_uoperatorid']}";
}
	?>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penyusutan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Penyusutan</div>
				<div class="subtitle">Filter Aset Data </div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/dftr_usulan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penyusutan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/penyusutan/dftr_penetapan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penyusutan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penyusutan/validasi_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penyusutan</span>
				</a>
			</div>		

		<section class="formLegend">
			<script>
			/*$.fn.dataTableExt.oApi.fnStandingRedraw = function(oSettings) {
					if(oSettings.oFeatures.bServerSide === false){
						var before = oSettings._iDisplayStart;
				 
						oSettings.oApi._fnReDraw(oSettings);
				 
						// iDisplayStart has been reset to zero - so lets change it back
						oSettings._iDisplayStart = before;
						oSettings.oApi._fnCalculateEnd(oSettings);
					}
				 
					// draw the 'current' page
					oSettings.oApi._fnDraw(oSettings);
			};*/	
			jQuery.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
			{
				// DataTables 1.10 compatibility - if 1.10 then `versionCheck` exists.
				// 1.10's API has ajax reloading built in, so we use those abilities
				// directly.
				if ( jQuery.fn.dataTable.versionCheck ) {
					var api = new jQuery.fn.dataTable.Api( oSettings );

					if ( sNewSource ) {
						api.ajax.url( sNewSource ).load( fnCallback, !bStandingRedraw );
					}
					else {
						api.ajax.reload( fnCallback, !bStandingRedraw );
					}
					return;
				}

				if ( sNewSource !== undefined && sNewSource !== null ) {
					oSettings.sAjaxSource = sNewSource;
				}

				// Server-side processing should just call fnDraw
				if ( oSettings.oFeatures.bServerSide ) {
					this.fnDraw();
					return;
				}

				this.oApi._fnProcessingDisplay( oSettings, true );
				var that = this;
				var iStart = oSettings._iDisplayStart;
				var aData = [];

				this.oApi._fnServerParams( oSettings, aData );

				oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
					/* Clear the old information from the table */
					that.oApi._fnClearTable( oSettings );

					/* Got the data - add it to the table */
					var aData =  (oSettings.sAjaxDataProp !== "") ?
						that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;

					for ( var i=0 ; i<aData.length ; i++ )
					{
						that.oApi._fnAddData( oSettings, aData[i] );
					}

					oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

					that.fnDraw();

					if ( bStandingRedraw === true )
					{
						oSettings._iDisplayStart = iStart;
						that.oApi._fnCalculateEnd( oSettings );
						that.fnDraw( false );
					}

					that.oApi._fnProcessingDisplay( oSettings, false );

					/* Callback user function - for event handlers etc */
					if ( typeof fnCallback == 'function' && fnCallback !== null )
					{
						fnCallback( oSettings );
					}
				}, oSettings );
			};
				
	var oTable;
    $(document).ready(function() {
          $('#iman').dataTable({
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": true},
                         // {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false},
                         {"bSortable": false}],
                    "sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_validasi_penetapan_pnyst.php?<?php echo $par_data_table?>"
				   /*"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
							oSettings.jqXHR = $.ajax( {
								"dataType": 'json',
								"type": "POST",
								"url": sSource,
								"data":aoData,
								"success": fnCallback
							});
						}*/
					
			   });
			   // oTable= $('#iman').dataTable();
			   // oTable.fnReloadAjax("<?=$url_rewrite?>/api_list/api_validasi_penetapan_pnyst.php?<?php echo $par_data_table?>");
			   
				/*var auto_refresh = setInterval(
				function ()
				{
				oTable= $('#iman').dataTable();
				oTable.fnStandingRedraw();
				}, 60);*/

			   // var reloadTable;
			   // setTimeout(function() { reloadTable(oTable); },60);
				/*function reloadTable(oTable){
					oTable.fnReloadAjax();
					setTimeout(function() { reloadTable(oTable); },30000);
				}*/
			   // var newtimer = setInterval('oTable.fnStandingRedraw()', 60);	
      });
    </script>
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="iman">
				<thead>
					<tr>
						<th>No</th>
						<th>Nomor Penetapan</th>
						<th>Satker</th>
						<th>Jumlah Aset</th>
						<th>Tgl Penetapan</th>
						<th>Keterangan</th>
						<th>Tahun</th>
						<th>Status</th>
						<th>Tindakan</th>
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
			<div class="spacer"></div>
			    
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>