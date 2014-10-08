<?php
include "../../config/config.php";


$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
// echo "Pagin $paging";
// pr($_POST);
/*if ($_POST['tampil']){
	//if ($_POST['gdg_disbar_tglawal'] =="" && $_POST['gdg_disbar_tglakhir']=="" && $_POST['gdg_disbar_nopengeluaran']=="" && $_POST['skpd_id']=="" && $_POST['skpd_id2']==""){
	if ($_POST['gdg_disbar_tglawal'] =="" && $_POST['gdg_disbar_tglakhir'] =="" && $_POST['gdg_disbar_nopengeluaran']=="" && $_POST['skpd_id2']==""){
	?>
	 <script>var r=confirm('Tidak ada isian filter');
		if (r==false){
			document.location='distribusi_barang.php';
		}
	</script>
	 <?php
            }
        }*/
// pr($_POST);
// exit;
if (isset($_POST['tampil']))
{
	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	list($get_data_filter,$count) = $RETRIEVE->retrieve_distribusi_barang(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));	
	
}else
{
	$sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
	list($get_data_filter,$count) = $RETRIEVE->retrieve_distribusi_barang(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
}
// pr($get_data_filter);
// pr($count);

?>

<html>

<?php
include"$path/header.php";
?>

<body>
<div id="content">

<?php
include"$path/title.php";
include"$path/menu.php";

//pr($_SESSION);
?>

<div id="tengah1">
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">
Distribusi Barang
</div>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": []
				} );
			} );
		</script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="ie_office.css" />
<![endif]-->

<div id="bottomright">
<div style="margin-bottom:10px; float:left;">
<a href="distribusi_barang.php"><input type="submit" value="Kembali ke Form Filter"></a>
</div>

<div style="margin-bottom:10px; float:right;">
<a href="distribusi_barang_filter_tambahdata.php"><input type="submit" value="Tambah Data"></a>
</div>
<!-- Begin frame -->
<table width='100%' border='0' style="border-collapse:collapse;border: 0px solid #dddddd;">
    <tr>
        <td colspan ="3" align="right">
			<table border="0" width="100%">
				<tr>
					<td align="right" width="200px">
							<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
							<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
							<span><input type="button" value="<< Prev" class="buttonprev"/>
							Page
							<input type="button" value="Next >>" class="buttonnext"/></span>
						
					</td>
				</tr>
			</table>
        </td>
    </tr>
</table>
<br>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width='20px'>No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor Dokumen</th>
			<!--<th style="background-color: #eeeeee; border: 2px solid #dddddd;">Satker Asal</th>-->
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">Transfer ke SKPD</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">Tanggal Distribusi</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">Detail Distribusi Barang</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">Aksi</th>
		</tr>
	</thead>

<?php
	if (!empty($get_data_filter))
    {
    ?>
    <tbody>
    <?php
		$nomor = 1;
		// pr($get_data_filter);
		foreach ($get_data_filter as $key => $hsl_data)
		{
			list($tahun, $bulan, $tanggal)= explode('-', $hsl_data->TglTransfer);
		
		$queryFromSatker = "SELECT NamaSatker FROM satker WHERE Satker_ID = '{$hsl_data->ToSatker_ID}'";
		$resultFromSatker = $DBVAR->query($queryFromSatker) or die ($DBVAR->error());
		$dataFromSatker = $DBVAR->fetch_array($resultFromSatker);
		?>


	<tr class="<?php if($nomor == 1) echo ' '?>">
	<td align="center" style="border: 1px solid #dddddd;"><?php echo $nomor?></td>
	<td align='center' style='border: 1px solid #dddddd; height:100px; color: #; font-weight: ;'><?=$hsl_data->NoDokumen?></td>
	<!--<td align='center' style='border: 2px solid #dddddd; height:100px; color: #; font-weight: bold;'><?=$hsl_data->FromSatker_ID?></td>-->
	<td align='center' style='border: 1px solid #dddddd; height:100px; width: 200px; color: #; font-weight: ;'><?=$dataFromSatker[NamaSatker]?></td>
	<td align='center' style='border: 1px solid #dddddd; height:100px; color: #; font-weight: ;'><?=$tanggal."/".$bulan."/".$tahun?></td>
	<td align='center' style='border: 1px solid #dddddd; height:100px; width: 200px; color: #; font-weight: ;'><?=$hsl_data->InfoTransfer?></td>
	<td align='center' style='border: 1px solid #dddddd; height:100px; color: #; font-weight: ;'>
	<a href='<?=$url_rewrite."/module/gudang/distribusi_barang_daftar_edit.php?id=".$hsl_data->NoDokumen?>&pid=1'> Edit </a> 
	|| <a href="<?=$url_rewrite."/module/gudang/distribusi_barang_eksekusi_data_tambah_hapus.php?id=".$hsl_data->NoDokumen?>&pid=1" onclick="return confirm('Hapus Data ?');"> Hapus </a></td>
	</tr>
	<?php
			$nomor++;
		}
    }
    else
    {
        $disabled = 'disabled';
    }
    ?>



</tbody>
<tfoot>
		
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>
<!-- End Frame -->

</div>
</div>
</div>
</div>
	
<?php
include"$path/footer.php";
?>

	</body>
	</html>