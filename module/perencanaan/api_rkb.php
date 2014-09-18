<?php
  include "../../config/database.php";  
  open_connection();  

$skpd		= $_GET['skpd'];
$lokasi		= $_GET['lokasi'];
$kelompok	= $_GET['kelompok'];
$tahun		= $_GET['tahun'];

$query		= "SELECT skb_jml FROM StandarKebutuhan WHERE skb_njb='$kelompok' AND skb_skpd='$skpd' AND skb_lokasi='$lokasi' AND skb_tgl like '$tahun%'";
$result		= mysql_query($query);
if ($result)
{
	$hsl_jml	= mysql_fetch_array($result);
	$jml		= $hsl_jml['skb_jml'];

}

$query1		= "select A.Kuantitas
			from 
			Aset A left join Satker CC on A.LastSatker_ID=CC.Satker_ID 
			left join Mesin MS on A.Aset_ID=MS.Aset_ID 
			left outer join Bangunan B on A.Aset_ID=B.Aset_ID 
			left outer join Kondisi E on E.Kondisi_ID=A.LastKondisi_ID 
			left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID 
			where 1=1 AND A.Kelompok_ID=".$kelompok." AND A.Lokasi_ID=".$lokasi." order by A.LastSatker_ID, D.Kode";
$result1	= mysql_query($query1);
if ($result1)
{
	$hsl_jml1	= mysql_fetch_array($result1);
$jml1		= $hsl_jml['Kuantitas'];

}

$jml2 = $jml-$jml1;

echo "$jml|$jml1|$jml2";
?>
