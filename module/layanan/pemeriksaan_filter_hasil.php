<?php
include "../../config/config.php";

$LAYANAN = new RETRIEVE_LAYANAN;
// $kd_tahun = $_POST['kd_tahun']; 
// $kodeSatker = $_POST['kodeSatker']; 
// $statusaset = $_POST['statusaset']; 
// $jenisaset = $_POST['jenisaset'];

// $param = "modul=pemeriksaan&tahun={$kd_tahun}&Satker_ID={$kodeSatker}&status={$statusaset}&jns_aset={$jenisaset}";

$menu_id = 61;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);


include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

$resetDataView = $DBVAR->is_table_exists('penghapusan_filter_'.$SessionUser['ses_uoperatorid'], 0);
$dataParam = $SESSION->smartFilter('pemeriksaan');
$par_data_table= "data=".encode($dataParam);

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
					tes[k].checked == true  ? boxeschecked++: null;
				}
		}
			
			
	} );
			
	function enable(){  
		var tes=document.getElementsByTagName('*');
		var button=document.getElementById('submit');
		var boxeschecked=0;
		for(k=0;k<tes.length;k++)
		{
			if(tes[k].className=='checkbox')
				{
					tes[k].checked == true  ? boxeschecked++: null;
				}
		}
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
			else{
			   $('#submit').attr("disabled","disabled");
			}
		}, 100);
	}

    $(document).ready(function() {

    	var param = "api_layanan.php?<?php echo $par_data_table?>";
        dTableParam("layanan_tabel", param, 9);
        
    });

    function checkBefore(){

    	var txt;
		var r = confirm("Hapus Data Aset?");
		if (r == true){} else return false;
		
    }

</script>

<section id="main">
	<ul class="breadcrumb">
	  	<li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
	  	<li><a href="#">Layanan Umum</a><span class="divider"><b>&raquo;</b></span></li>
	  	<li class="active">Pemeriksaan Aset</li>
	  	<?php SignInOut();?>
	</ul>
	<div class="breadcrumb">
		<div class="title">Pemeriksaan Aset</div>
		<div class="subtitle">Daftar Aset</div>
	</div>
	<section class="formLegend">
		<form name="myform" ID="Form2" method="POST" action="<?php echo "$url_rewrite/module/layanan/"; ?>hapus_aset.php" onsubmit="return checkBefore()">
			
			<div class="detailRight">
				<ul>
					<li>
						<a href="<?php echo "$url_rewrite/module/layanan/pemeriksaan_filter.php"; ?>">
						   <input type="button" name="Lanjut" class="btn" value="Kembali ke halaman utama : Cari aset" >
						</a>
					</li>
				</ul>
			</div>
			<div style="height:5px;width:100%;clear:both"></div>
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="layanan_tabel">
				<thead>
					<tr>
						<th>No</th>
						<!-- <th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th> -->
						<th>No Register</th>
						<th>Tahun</th>
						<th>Kode / Uraian</th>
						<th>Satker</th>
						<th>Info</th>
						<th>Tgl Perolehan</th>
						<th>Nilai Perolehan</th>
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
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
		</form>
	</section> 
</section>
<?php
include "$path/footer.php";
?>