<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['tampil']))
{
	unset($_SESSION['parameter_sql']);
	$gdg_disbar_tglawal=$_POST['gdg_disbar_tglawal'];
	$gdg_disbar_tglakhir=$_POST['gdg_disbar_tglakhir'];
	$no_dokumen=$_POST['gdg_disbar_nopengeluaran'];
	$dari=$_POST['skpd_id'];
	$tujuan=$_POST['skpd2_id'];
	$dataPerPage = 10;
	
	
	$arr_dari=explode(',',$dari);
	$jml_dari=count($arr_dari);
	$query_dari="";
	if ($dari!='') {
	for ($i=0;$i<$jml_dari;$i++) {
	$query_dari_tmp[$i]="a.OrigSatker_ID='$arr_dari[$i]'";
	$query_dari=implode(" OR ",$query_dari_tmp);
	}
	}



	$arr_tujuan=explode(',',$tujuan);
	$jml_tujuan=count($arr_tujuan);
	$query_tujuan="";
	if ($tujuan!='') {
	for ($i=0;$i<$jml_tujuan;$i++) {
	$query_tujuan_tmp[$i]="a.OriginDBSatker='$arr_tujuan[$i]'";
	$query_tujuan=implode(" OR ",$query_tujuan_tmp);
	}
	}
	//filter
	list($tanggal, $bulan, $tahun) = explode('/', $gdg_disbar_tglawal);
	list($tgl, $bln, $thn) = explode('/', $gdg_disbar_tglakhir);
	
	if($query_dari!='' && $query_tujuan=='')
	$query_satker_fix="and ($query_dari)";

	if($query_dari!='' && $query_tujuan!='')
	$query_satker_fix="and ($query_dari) and ($query_tujuan)";

	if($query_dari=='' && $query_tujuan!='')
	$query_satker_fix="and ($query_tujuan)";

	if($query_dari=='' && $query_tujuan=='')
	$query_satker_fix="";


	if ($gdg_disbar_tglawal!="")
	{
		$query_tgl_awal="t.TglTransfer='$tahun-$bulan-$tanggal'";
	}

	if($gdg_disbar_tglakhir!="")
	{
		$query_tgl_akhir="t.TglTransfer='$thn-$bln-$tgl'";
	}

	if($no_dokumen!="")
	{
		$query_npp="t.NoDokumen='$gdg_disbar_nopengeluaran'";
	}

	if($satker!="")
	{
		$query_satker="NamaSatker='$satker'";
	}

	$parameter_sql="";
	if($gdg_disbar_tglawal!="")
	{
		$parameter_sql=$query_tgl_awal;
	}

	if($gdg_disbar_tglakhir!="" && $parameter_sql!="")
	{
		$parameter_sql="t.TglTransfer BETWEEN '$tahun-$bulan-$tanggal' AND '$thn-$bln-$tgl'";
	}

	if($gdg_disbar_tglakhir!="" && $parameter_sql=="")
	{
		$parameter_sql=$query_tgl_akhir;
	}

	if($no_dokumen!="" && $parameter_sql!="")
	{
		$parameter_sql=$parameter_sql." AND ".$query_npp;
	}

	if ($no_dokumen!="" && $parameter_sql=="")
	{
		$parameter_sql=$query_npp;
	}

	if($satker!="" && $parameter_sql!="")
	{
		$parameter_sql=$parameter_sql." AND ".$query_satker;
	}

	if ($satker!="" && $parameter_sql=="")
	{
		$parameter_sql=$query_satker;
	}

	//end
	
	$_SESSION['parameter_sql'] = $parameter_sql;
}



// apabila $_GET['page'] sudah didefinisikan, gunakan nomor halaman tersebut, 
// sedangkan apabila belum, nomor halamannya 1.

if(isset($_GET['page']))
{
$noPage = $_GET['page'];
} 
else $noPage = 1;
$i=0;
// perhitungan offset

$offset = ($noPage - 1) * $dataPerPage;





//$tes="select TglTransfer from transfer where TglTransfer between '$tahun-$bulan-$tanggal' and '$thn-$bln-$tgl'";
//$query=mysql_query($tes);
//while($row = mysql_fetch_array($query))
//{
//echo $row['TglTransfer'];
//}






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
?>

<div id="tengah1">
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">
Distribusi Barang
</div>

<script type="text/javascript" src="JS/simbada.js">
</script>

<script type="text/javascript">
function show_confirm()
{
	var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
	if (r==true)
{
	alert("You pressed OK!");
}
	else
{
	alert("You pressed Cancel!");
	document.location="distribusi_barang.php";
}
}
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

<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
<tbody>
<tr style="background-color:#004933; color:white; height:20px;">
<th width="40px" align="center" style="border: 1px solid #004933;">No</th>
<th width="100px" align="center" style="border: 1px solid #004933;">Nomor Pengeluaran</th>
<th width="10px" align="center" style="border: 1px solid #004933;">Tgl Pengeluaran</th>
<th width="150px" align="center" style="border: 1px solid #004933">Detail Pengeluaran</th>
<th width="85px" align="center" style="border: 1px solid #004933;">Tindakan</th>
</tr>

<?php
if($parameter_sql!="" ) 
{
	$queryfix="FROM Aset a, Transfer t WHERE $parameter_sql AND a.Aset_ID=t.Aset_ID and a.OrigSatker_ID!=0 and a.OriginDBSatker!=0 $query_satker_fix";
	//$query2 = "SELECT a.Aset_ID FROM Aset a WHERE $parameter_sql AND a.OrigSatker_ID!=0 and a.OriginDBSatker!=0 $query_satker_fix LIMIT $offset, $dataPerPage";
	
	/*
	$query1="SELECT a.Aset_ID, t.NoDokumen,t.TglTransfer, t.InfoTransfer FROM Aset a, Transfer t WHERE $parameter_sql AND a.Aset_ID=t.Aset_ID 
	and a.OrigSatker_ID!=0 and a.OriginDBSatker!=0 $query_satker_fix LIMIT $offset, $dataPerPage";
	
	*/
	$query = "SELECT t.Transfer_ID FROM Transfer t, Aset a WHERE $parameter_sql AND a.Aset_ID=t.Aset_ID 
	and a.OrigSatker_ID!=0 and a.OriginDBSatker!=0 $query_satker_fix LIMIT $offset, $dataPerPage";
	
	//print_r($query);

	$exec = mysql_query($query) or die(mysql_error());
	while ($data = mysql_fetch_object($exec))
	{
		$dataArr[] = $data->Transfer_ID;
	}
} 


if($parameter_sql=="" ) 
{
	$queryfix="FROM Aset a, Transfer t WHERE a.Aset_ID=t.Aset_ID and a.OrigSatker_ID!=0 and a.OriginDBSatker!=0 $query_satker_fix";
	$query1="SELECT a.Aset_ID, t.NoDokumen,t.TglTransfer, t.InfoTransfer FROM Aset a, Transfer t WHERE a.Aset_ID=t.Aset_ID 
	and a.OrigSatker_ID!=0 and a.OriginDBSatker!=0 $query_satker_fix LIMIT $offset, $dataPerPage";
	
	$query="SELECT t.Transfer_ID FROM Transfer t, Aset a WHERE a.Aset_ID=t.Aset_ID 
	and a.OrigSatker_ID!=0 and a.OriginDBSatker!=0 $query_satker_fix LIMIT $offset, $dataPerPage";
	//print_r($query);
	$exec = mysql_query($query) or die(mysql_error());
	while ($data = mysql_fetch_object($exec))
	{
		$dataArr[] = $data->Transfer_ID;
	}
}


foreach ($dataArr as $value)
{
	$query="SELECT t.Transfer_ID, t.Aset_ID, t.NoDokumen,t.TglTransfer, t.InfoTransfer FROM Transfer t 
			WHERE t.Transfer_ID = $value";
	$result = mysql_query($query) or die (mysql_error());
	if($result)
	{
		$dataArray[] = mysql_fetch_object($result);
	}
	
}
$i=0;



$no = 1;
foreach ($dataArray as $hsl_data)

//while($hsl_data=mysql_fetch_array($exec))
{
	
	list($tahun, $bulan, $tanggal)= explode('-', $hsl_data->TglTransfer);


echo "<tr>
<td align='center' style='border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;'>$no</td>
<td align='center' style='border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;'>".$hsl_data->NoDokumen."</td>
<td align='center' style='border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;'>$tanggal-$bulan-$tahun</td>
<td align='center' style='border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;'>".$hsl_data->InfoTransfer."</td>
<td align='center' style='border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;'>
<a href='$url_rewrite/module/gudang/distribusi_barang_daftar_cetak.php?id=".$hsl_data->Aset_ID."'>Cetak</a>  
|| <a href='$url_rewrite/module/gudang/distribusi_barang_daftar_edit.php?id=".$hsl_data->Aset_ID."'> Edit </a> 
|| <a href='$url_rewrite/module/gudang/distribusi_barang_eksekusi_data_tambah_hapus.php?id=".$hsl_data->Aset_ID."' 
onclick=\"return confirm('Ingin Dihapus?')\"> Hapus </a></td>
</tr>";
$no++;
}
?>

</tbody>
</table>

<center>

<?php

// mencari jumlah semua data dalam tabel guestbook

$querypage   = "SELECT COUNT(*) AS jumData ".$queryfix."";
$hasil   	= mysql_query($querypage);
$data    = mysql_fetch_array($hasil);

$jumData = $data['jumData'];

// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data

$jumPage = ceil($jumData/$dataPerPage);

// menampilkan link previous

if ($noPage > 1) echo  "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage-1)."'>&lt;&lt; Prev</a>";

// memunculkan nomor halaman dan linknya

for($page = 1; $page <= $jumPage; $page++)
{
	if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
	{   
		if (($showPage == 1) && ($page != 2))  echo "..."; 
		if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
		if ($page == $noPage) echo " <b>".$page."</b> ";
		else echo " <a href='".$_SERVER['PHP_SELF']."?page=".$page."'>".$page."</a> ";
		$showPage = $page;          
	}
}

// menampilkan link next

if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage+1)."'>Next &gt;&gt;</a>";
?>

	</center>
	</div>
	</div>
	</div>
	</div>
	</div>
	
<?php
include"$path/footer.php";
?>

	</body>
	</html>