<link rel="stylesheet" href="../../function/css/simbada.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../function/sorter/css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="../../function/sorter/js/jquery-latest.js"></script> 
<script type="text/javascript" src="../../function/sorter/js/jquery.tablesorter.js"></script> 

<div align="center" style="padding:5px;background-color:#004933"><span style="font:14px Arial;font-weight:bold;color:whitesmoke;">IMPORT DATA XLS</span></div>

<script type="text/javascript">
$(function() {
			$("table").tablesorter();
		});
</script>

<script>
function select(a) {
    var theForm = document.sheet;
    for (i=0; i<theForm.elements.length; i++) {
        if (theForm.elements[i].name=='formDoor[]')
            theForm.elements[i].checked = a;
    }
}
</script>



<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";

// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

echo   "<br>&nbsp&nbsp&nbsp<a href='javascript:select(1)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspPilih Semua&nbsp</a> |
       <a href='javascript:select(0)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspHapus Semua Pilihan&nbsp</a>&nbsp&nbsp";

echo "<form action='checkbox-form.php' method='post' name='sheet'>";
// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)

echo "
<table id='table' cellspacing='0' class='tablesorter'>
<thead>
<tr>
<th>SELEKSI</th>
<th>TAHUN</th>
<th>S K P D</th>
<th>LOKASI</th>
<th>NAMA / JENIS BARANG</th>
<th>KODE BARANG</th>
<th>MERK / TIPE</th>
<th>KODE REKENING</th>
<th>JUMLAH BARANG</th>
<th>HARGA</th>
<th>TOTAL HARGA</th>
</tr>
</thead>";
for ($i=9; $i<=$baris; $i++)
{
  // membaca data tahun (kolom ke-1)
  $tahun = $data->val($i, 1);
  // membaca data skpd (kolom ke-2)
  $SKPD = $data->val($i, 2);
  // membaca data lokasi (kolom ke-3)
  $Lokasi = $data->val($i, 3);
  // membaca data nama jenis barang (kolom ke-4)
  $nm_jns_brg = $data->val($i, 4);
  $kd_brg = $data->val($i, 5);
  // membaca data merk tipe (kolom ke-5)
  $merk_tipe = $data->val($i, 6);
  // membaca data kode rek (kolom ke-6)
  $kode_rek = $data->val($i, 7);
  // membaca data jumlah barang (kolom ke-7)
  $jml_brg = $data->val($i, 8);
  // membaca data harga (kolom ke-8)
  $harga = $data->val($i, 9);
  // membaca data total harga (kolom ke-9)
  $ttl_harga = $data->val($i, 10);

switch ($nm_jns_brg)
{
case null:
	break;
default:  
  
echo "
		<tr id>
		<td width='50' style='text-align:center'>
		<input type='checkbox' name='formDoor[]' value='$tahun|$SKPD|$Lokasi|$nm_jns_brg|$kd_brg|$merk_tipe|$kode_rek|$jml_brg|$harga|$ttl_harga' />
		</td><td>$tahun</td><td>$SKPD</td><td>$Lokasi</td><td>$nm_jns_brg</td><td>$kd_brg</td>
		<td>$merk_tipe</td><td>$kode_rek</td><td>$jml_brg</td><td>$harga</td><td>$ttl_harga</td>
		</tr>		
	";

  }
}
echo "</table>";
echo   "&nbsp&nbsp&nbsp<a href='javascript:select(1)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspPilih Semua&nbsp</a> |
       <a href='javascript:select(0)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspHapus Semua Pilihan&nbsp</a>&nbsp&nbsp";
echo "<div align='center'><input type='submit' name='formSubmit' value='Submit' style='width:100px'/>
&nbsp<a href='javascript:window.close()'><input type='button' value='Cancel' style='width:100px'/></a></div>
</form>";


?>
