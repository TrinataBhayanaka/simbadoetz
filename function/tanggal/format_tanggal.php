 <?php
    
    $namaBln="";

    $namahari=$row->hari;
	$tgl=$row->tgl;
    $bln=$row->bln;
	$bln_link=$bln;
	
    $thn=$row->thn;
    $jam=$row->jam;
	 if ($namahari == "Sunday") $namahari = "Minggu";
    else if ($namahari == "Monday") $namahari = "Senin";
    else if ($namahari == "Tuesday") $namahari = "Selasa";
    else if ($namahari == "Wednesday") $namahari = "Rabu";
    else if ($namahari == "Thursday") $namahari = "Kamis";
    else if ($namahari == "Friday") $namahari = "Jumat";
    else if ($namahari == "Saturday") $namahari = "Sabtu";
switch($bln)
{
case "1" : $namaBln = "Januari";
            $bln_link="0".$bln_link;
             break;
case "2" : $namaBln = "Februari";
            $bln_link="0".$bln_link;
             break;
case "3" : $namaBln = "Maret";
           $bln_link="0".$bln_link;
             break;
case "4" : $namaBln = "April";
           $bln_link="0".$bln_link;
             break;
case "5" : $namaBln = "Mei";
           $bln_link="0".$bln_link;
             break;
case "6" : $namaBln = "Juni";
           $bln_link="0".$bln_link;
             break;
case "7" : $namaBln = "Juli";
           $bln_link="0".$bln_link;
             break;
case "8" : $namaBln = "Agustus";
           $bln_link="0".$bln_link;
             break;
case "9" : $namaBln = "September";
           $bln_link="0".$bln_link;
             break;
case "10" : $namaBln = "Oktober";
             break;
case "11" : $namaBln = "Nopember";
             break;
case "12" : $namaBln = "Desember";
             break;
}
if($tgl=="0")
    $tgl="";
if($thn=="0")
    $thn="";

$tgl_full="$namahari, $tgl $namaBln $thn, $jam WIB";

$tgl_biasa="$tgl $namaBln $thn";

$tgl_agenda="$namahari, $tgl $namaBln $thn";
		
$tgl_link="$thn-$bln_link";
?>