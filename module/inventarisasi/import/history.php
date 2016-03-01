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

$dataArr = $RETRIEVE_INVENTARISASI->getImportLog($_SESSION['ses_uname']);

?>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#importxls').dataTable();
			$('#livefeed')[0].click();
		});

		function goclicky(meh)
		{
		    var x = screen.width/2 - 700/2;
		    var y = screen.height/2 - 450/2;
		    window.open(meh.href, 'sharegplus','height=285,width=700,left='+x+',top='+y);
		}
	</script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Inventarisasi</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Riwayat Import</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Riwayat Import</div>
				<div class="subtitle">Import Data xls</div>
			</div>		

		<section class="formLegend">
			
			
				<form action="" name="checks" ID="Form2">

						<div id="demo">
							
						<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="importxls">
							<thead>
								<tr>
									<th>No</th>
									<th>No. Kontrak</th>
									<th>Nama File</th>
									<!-- <th>Total Perolehan</th> -->
									<th>Username</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Live Feed</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($dataArr){
								$i=1;
								foreach ($dataArr as $key => $value) {
								?>
								<tr>
									<td><?=$i++?></td>
									<td><?=$value['noKontrak']?></td>
									<td><?=$value['desc']?></td>
									<!-- <td><?=$value['totalPerolehan']?></td> -->
									<td><?=$value['user']?></td>
									<td><?=$value['create_date']?></td>
									<td align="center"><?=($value['status']==0)? "<span class='label label-Warning'>Dalam proses</span>" : "<span class='label label-Success'>Selesai</span>" ?></td>
									<td align="center"><?php if($value['status']==0){?><a id="livefeed" href='livefeed.php' onclick="goclicky(this); return false;"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a><?php } ?></td>
								</tr>
								<?php
								}
								} else {
								?>
								<tr>
                                    <td colspan="10">Data Tidak di temukkan</td>
                               </tr>
                               <?php } ?>
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

