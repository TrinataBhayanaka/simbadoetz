<?php
include "../config/config.php";
$flag = 'C';
include "dialog.php";
?>
<html>
    <head>
		<link rel="stylesheet" href="function/css/simbada.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="function/tablecloth/tablecloth.css" type="text/css" media="screen" />
		<script type="text/javascript" src="function/sorter/js/jquery-latest.js"></script> 
		<script type="text/javascript" src="function/sorter/js/jquery.tablesorter.js"></script> 
		<style type="text/css">
		thead th, thead td {
		  text-align: center;
		}
		</style>
		

		<script>
		function select(a) {
			var theForm = document.sheet;
			for (i=0; i<theForm.elements.length; i++) {
				if (theForm.elements[i].name=='formDoor[]')
					theForm.elements[i].checked = a;
			}
		}
		</script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Import Pengadaan Aset / Barang</title>
    </head>
    <body>
        <div id="content">
            <?php
                include "$path/header.php";
                include "$path/title.php";
                include "$path/menu_import.php"
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Kartu Inventaris Barang C
                        </div>
                        <!--==================-->
                        <div id="bottomright">
                            <div style='padding:10px; width:98%; height:70%; overflow:auto; border: 1px solid #dddddd;'>
						<!--proses di sini-->
						
						
<?php
//POST 
$p_noreg_pemilik=$_POST['p_noreg_pemilik'];
$p_noreg_prov=$_POST['p_noreg_prov'];
$p_noreg_kab=$_POST['p_noreg_kab'];
$p_noreg_satker=$_POST['p_noreg_satker'];
$skpd_id=$_POST['skpd_id'];
$lokasi_id=$_POST['lokasi_id'];
$user = $_SESSION['ses_uoperatorid'];
//$p_noreg_tahun=$_POST['p_noreg_tahun'];
//$p_noreg_unit=$_POST['p_noreg_unit'];



// menggunakan class phpExcelReader
include "excel_reader.php";

// membaca file excel yang diupload
//$new_data = new Spreadsheet_Excel_Reader();

$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

echo   "<br>&nbsp&nbsp&nbsp<a href='javascript:select(1)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspPilih Semua&nbsp</a> |
       <a href='javascript:select(0)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspHapus Semua Pilihan&nbsp</a>&nbsp&nbsp";

echo "<form action='proses_kibc_hasil.php' method='post' name='sheet'>";
// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)

echo "
<table cellspacing='0'>
<thead>
<tr>
<th rowspan='3'>SELEKSI</th>
<th rowspan='3'>NAMA BARANG</th>
<th colspan='2'>NOMOR</th>
<th rowspan='3'>KODE LOKASI</th>
<th rowspan='3'>KONDISI <br>BANGUNAN <br>(B,KB,RB)</th>
<th rowspan='3'>TAHUN PENGADAAN</th>
<th colspan='2'>KONSTRUKSI BANGUNAN</th>
<th rowspan='3'>LUAS<br>LANTAI<br>(M2)</th>
<th rowspan='3'>LETAK/LOKASI <br>ALAMAT</th>
<th rowspan='3'>RT/RW</th>
<th colspan='2'>DOKUMEN GEDUNG</th>
<th rowspan='3'>LUAS<br>(M2)</th>
<th rowspan='3'>STATUS<br>TANAH</th>
<th rowspan='3'>NOMOR<br>KODE<br>TANAH</th>
<th rowspan='3'>ASAL USUL<br>PEROLEHAN</th>
<th rowspan='3'>HARGA<br>(Rp)</th>
<th rowspan='3'>KETERANGAN</th>
</tr>
<tr>
<th rowspan='2'>KODE BARANG</th>
<th rowspan='2'>REGISTER</th>
<th rowspan='2'>JUMLAH<br>TINGKAT</th>
<th rowspan='2'>BETON<br>/TIDAK</th>
<th rowspan='2'>TANGGAL</th>
<th rowspan='2'>NOMOR</th>
</tr>
</thead>";
for ($i=13; $i<=$baris; $i++)
{
  // membaca data tahun (kolom ke-1)
  $nm_brg = $data->val($i, 2);
  // membaca data tahun (kolom ke-1)
  $kd_brg = $data->val($i, 3);
  // membaca data skpd (kolom ke-2)
  $p_noreg_unit = $data->val($i, 4);
  // membaca data skpd (kolom ke-2)
  $kondisi = $data->val($i, 5);
  // membaca data skpd (kolom ke-2)
  $tahun_pengadaan = $data->val($i, 6);
  // membaca data lokasi (kolom ke-3)
  $tingkat = $data->val($i, 7);
  // membaca data nama jenis barang (kolom ke-4)
  $beton = $data->val($i, 8);
  // membaca data merk tipe (kolom ke-5)
  $luas_lantai = $data->val($i, 9);
  // membaca data kode rek (kolom ke-6)
  $alamat = $data->val($i, 10);
  // membaca data kode rek (kolom ke-6)
  $rtrw = $data->val($i, 11);
  // membaca data jumlah barang (kolom ke-7)
  $tgl_dokumen = $data->val($i, 12);
  // membaca data harga (kolom ke-8)
  $no_dokumen = $data->val($i, 13);
  // membaca data total harga (kolom ke-9)
  $luas = $data->val($i, 14);
  // membaca data total harga (kolom ke-9)
  $status_tanah = $data->val($i, 15);
  $no_kode = $data->val($i, 16);
  $asalusul = $data->val($i, 17);
  $harga = $data->val($i, 18);
  $ket = $data->val($i, 19);

  $harga=str_replace('*','',$harga);
  $nm_brg=str_replace('\'','',$nm_brg);
  $nm_brg=htmlentities($nm_brg);
$p_noreg_tahun=substr($tahun_pengadaan,-2);  
$noreg=$p_noreg_pemilik.".".$p_noreg_prov.".".$p_noreg_kab.".".$p_noreg_satker.".".$p_noreg_tahun.".".$p_noreg_unit; 

$cek_unit = strpos($p_noreg_unit,"-");
if($cek_unit == true){
$jml_unit = explode("-",$p_noreg_unit);
$jml_fix = $jml_unit[1]-$jml_unit[0]+1;
$harga=str_replace(",",'',$harga);
$harga_unit = $harga/$jml_fix;
$harga_unit = number_format($harga_unit,0,"",",");
$ket = $ket.". Merupakan breakdown dari Aset ".$nm_brg.".";
for($k=1 ; $k <= $jml_fix ; $k++){
//check require
include "check_require.php";
//akhir tes
$total_str=strlen($jml_unit[0]);
$nomor=$k+$jml_unit[0]+1-1;
$nomor2=$nomor-1;
$nomor=strval($nomor2);
$jumdigit=strlen($nomor2);
$no_step=str_repeat("0",$total_str-$jumdigit).$nomor2;


$noreg=$p_noreg_pemilik.".".$p_noreg_prov.".".$p_noreg_kab.".".$p_noreg_satker.".".$p_noreg_tahun.".".$no_step;  
switch ($nm_brg)
{
case null:
	break;
default:  
  
echo "
		<tr id>
		<td width='50' style='text-align:center'>
		<input type='checkbox' $require value='$nm_brg|$kd_brg|$noreg|$lokasi_id|$kondisi|$tahun_pengadaan|$tingkat|$beton|$luas_lantai|
		$alamat|$rtrw|$tgl_dokumen|$no_dokumen|$luas|$status_tanah|$no_kode|$asalusul|$harga_unit|$skpd_id|$ket|$user' />
		</td><td>$nm_brg</td><td $require_brg>$kd_brg</td><td>$noreg</td><td>$lokasi_id</td><td>$kondisi</td><td $require_thn>$tahun_pengadaan</td>
		<td>$tingkat</td><td>$beton</td><td>$luas_lantai</td><td>$alamat</td><td>$rtrw</td><td>$tgl_dokumen</td><td>$no_dokumen</td><td>$luas</td>
		<td>$status_tanah</td><td>$no_kode</td><td>$asalusul</td><td $require_harga>$harga_unit</td><td>$ket</td>
		</tr>		
	";
	
  }
}

} else{

//check require
include "check_require.php";
//akhir tes
 
switch ($nm_brg)
{
case null:
	break;
case 'Mengetahui':
	break;
default:  
  
echo "
		<tr id>
		<td width='50' style='text-align:center'>
		<input type='checkbox' $require value='$nm_brg|$kd_brg|$noreg|$lokasi_id|$kondisi|$tahun_pengadaan|$tingkat|$beton|$luas_lantai|
		$alamat|$rtrw|$tgl_dokumen|$no_dokumen|$luas|$status_tanah|$no_kode|$asalusul|$harga|$skpd_id|$ket|$user' />
		</td><td>$nm_brg</td><td $require_brg>$kd_brg</td><td>$noreg</td><td>$lokasi_id</td><td>$kondisi</td><td $require_thn>$tahun_pengadaan</td>
		<td>$tingkat</td><td>$beton</td><td>$luas_lantai</td><td>$alamat</td><td>$rtrw</td><td>$tgl_dokumen</td><td>$no_dokumen</td><td>$luas</td>
		<td>$status_tanah</td><td>$no_kode</td><td>$asalusul</td><td $require_harga>$harga</td><td>$ket</td>
		</tr>		
	";
	}
  }
}
echo "</table>";
?>
</div>
<br>
<?php
echo   "&nbsp&nbsp&nbsp<a href='javascript:select(1)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspPilih Semua&nbsp</a> |
       <a href='javascript:select(0)' style='font:12px Arial;color:#0066FF;text-decoration:underline;'>
       &nbspHapus Semua Pilihan&nbsp</a>&nbsp&nbsp";
echo "<div align='center'><input type='submit' name='formSubmit' value='Submit' style='width:100px'/>
&nbsp<a href='kibc.php'><input type='button' value='Cancel' style='width:100px'/></a></div>
</form>";


?>

						
						<!--akhir proses-->
                                                
                                            </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
        include "$path/footer.php"
    ?>
</html>
