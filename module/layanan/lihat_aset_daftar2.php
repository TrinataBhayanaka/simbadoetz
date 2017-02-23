<?php
include "../../config/config.php";

//include "/config/config.php";
$menu_id = 1;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
//pr($_POST);
if(isset($_POST)){
	$bup_tahun 		= $_POST['bup_tahun'];
	$statusaset     = $_POST['statusaset'];
	$jenisaset 		= $_POST['jenisaset'];
	$kodeSatker 	= $_POST['kodeSatker'];
	$kodepemilik 	= $_POST['kodepemilik'];
	$kodeKelompok 	= $_POST['kodeKelompok'];
}
//pr($_POST);
//exit;
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

	$par_data_table ="tahun={$bup_tahun}&jenisaset={$jenisaset}&kodeSatker={$kodeSatker}&kodepemilik={$kodepemilik}&kodeKelompok={$kodeKelompok}&statusaset={$statusaset}";
	$param=$par_data_table;

	?>
	<script type="text/javascript">
	$(document).ready(function() {
			
				
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
				// if(boxeschecked!=0){
				// 	button.disabled=false;
				// }
				// else {
				// 	button.disabled=true;
				// }
			
			} );
			
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
			function disable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				if (disable){
					button.disabled=true;
				} 
			}
			function enable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('submit');
				if (enable){
					button.disabled=false;
				} 
			}

	function AreAnyCheckboxesChecked () 
	{
		setTimeout(function() {
	  if ($("#Form2 input:checkbox:checked").length > 0)
		{
		    $("#submit").removeAttr("disabled");
		}
		else
		{
		   $('#submit').attr("disabled","disabled");
		}}, 100);
	}

    $(document).ready(function() {

    	// alert('ada');
    	var param = "api_layanan.php?<?php echo $par_data_table?>";
        dTableParam("layanan_tabel", param, 10);
        // log();
    });

    function checkBefore(){

    	var txt;
		var r = confirm("Hapus Data Aset?");
		if (r == true) {
		    
		} else {
		    return false;
		}
    }

    </script>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Layanan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Log Aset Simbada</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Aset</div>
				<div class="subtitle">Daftar Aset hasil penelusuran</div>
			</div>	

		

		<section class="formLegend">
			
			<script>
    $(document).ready(function() {
          $('#usulan_pmd_table').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    //"sScrollY": "350px",
                    //"sScrollY": "70vh",
                    //"sScrollX": "100%",
    				//"bScrollCollapse": true,
           		//"aLengthMenu": [[50, 100, 500,1000], [50, 100, 500,1000]],
                    "aoColumns":[
                         {"bSortable": true},	
                         {"bSortable": false},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true}],
                    "sPaginationType": "full_numbers",

                    "bprocessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_layanan2.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
    <form name="myform" ID="Form2" method="POST" action="<?php echo "$url_rewrite/module/layanan/"; ?>hapus_aset.php" onsubmit="return checkBefore()">
			<?php 
			// pr($_SESSION);
			if ($_SESSION['ses_ujabatan']==1):
			?>
			<?php if($statusaset=="1"||$statusaset=="0"){ $data=array("Belum Terdistribusi","Terdistribusi");
										echo "<h4> Status Aset = {$data[$statusaset]}</h1>";?>
				<input type="submit" name="submit2" class="btn btn-danger" value="Hapus Aset" id="submit" disabled/>

			<?php } endif;?>
			<a href="<?php echo "$url_rewrite/report/template/PEROLEHAN/liat_dftr_aset.php?$param"; ?>" target="blank">
			   <input type="button" name="cetak" class="btn btn-info" value="Cetak Aset" >
			</a>

			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="usulan_pmd_table">
				<thead>
					<tr>
						<th>No Register</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Satker</th>
						<th>Info</th>
						<th>Tgl Perolehan</th>
						<th >Nilai Perolehan</th>
						<th>Note Sistem</th>
						<th>Detail</th>
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