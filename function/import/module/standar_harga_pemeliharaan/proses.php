<link rel="stylesheet" href="../../function/css/simbada.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../function/sorter/css/style.css" type="text/css" media="screen" />
<script type="text/javascript" src="../../function/sorter/js/jquery-latest.js"></script> 
<script type="text/javascript" src="../../function/sorter/js/jquery.tablesorter.js"></script>

<div align="center" style="padding:5px;background-color:#004933"><span style="font:14px Arial;font-weight:bold;color:whitesmoke;">IMPORT DATA XLS</span></div>

<script>
function select(a) {
    var theForm = document.sheet;
    for (i=0; i<theForm.elements.length; i++) {
        if (theForm.elements[i].name=='formDoor[]')
            theForm.elements[i].checked = a;
    }
}

</script>
<script type="text/javascript">
		$(function() {
			$("table").tablesorter({debug: true});
		});
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
echo "<table id='myTable' class='tablesorter'>
<thead>
<tr>
<th>SELEKSI</th>
<th>NAMA BARANG</th>
<th>KODE BARANG</th>
<th>TANGGAL</th>
<th>MERK</th>
<th>BAHAN</th>
<th>KETERANGAN</th>
<th>HARGA PEMELIHARAAN</th>
<th>HARGA</th>
</tr>
</thead><tbody>";
for ($i=9; $i<=$baris; $i++)
{
 // membaca data nim (kolom ke-1)
  $nama = $data->val($i, 1);
  $kd_brg = $data->val($i, 2);
  // membaca data nama (kolom ke-2)
  $tanggal = $data->val($i, 3);
  // membaca data alamat (kolom ke-3)
  $merk = $data->val($i, 4);
  // membaca data alamat (kolom ke-4)
  $bahan = $data->val($i, 5);
  // membaca data alamat (kolom ke-5)
  $ket = $data->val($i, 6);
  $pemeliharaan = $data->val($i, 7);
  // membaca data alamat (kolom ke-6)
  $harga = $data->val($i, 8);
switch ($nama)
{
case null:
	break;
default:

list($tgl,$bln,$thn)=explode("/",$tanggal);
$tgl_fix=$thn."-".$bln."-".$tgl;

echo "
		<tr id>
		<td width='50' style='text-align:center'><input type='checkbox' name='formDoor[]' value='$nama|$kd_brg|$merk|$tgl_fix|$bahan|$ket|$pemeliharaan|$harga|$thn' />
		</td><td>$nama</td><td>$kd_brg</td>
		<td>$tanggal</td><td>$merk</td><td>$bahan</td><td>$ket</td><td>$pemeliharaan</td><td>$harga</td>
		</tr>		
	";

  }
}
echo "</tbody></table>";
echo   "&nbsp&nbsp&nbsp<a href='javascript:select(1)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspPilih Semua&nbsp</a> |
       <a href='javascript:select(0)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspHapus Semua Pilihan&nbsp</a>&nbsp&nbsp";
echo "<div align='center'><input type='submit' name='formSubmit' value='Submit' style='width:100px'/>
&nbsp<a href='javascript:window.close()'><input type='button' value='Cancel' style='width:100px'/></a><br><br>
$tes</div>
</form>";


?>
