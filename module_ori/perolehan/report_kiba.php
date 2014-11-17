<?php

require_once('../../config/config.php');
require_once('../report_func.php');
require_once('../../function/tcpdf/config/lang/ind.php');
require_once('../../function/tcpdf/tcpdf.php');
include ('../../function/tanggal/tanggal.php');


function get_hak_pakai($hak_tanah){
	if($hak_tanah == 01)
		$hak = "Hak Pakai";
	else if($hak_tanah == 02)
		$hak = "Hak Pengelolaan";
	return $hak;
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 061', PDF_HEADER_STRING);

// remove default header/footer
$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('Times', '', 10);

// add a page
$orientation = 'L';
$format = 'Legal';
$keepmargins = false;
$tocpage = false;
$pdf->AddPage($orientation, $format, $keepmargins, $tocpage);

//variabel
$gambar = getLogo('bireun',$path);

/*
$name_gambar="1";
if ($name_gambar=="1")
{
    $gambar="../images/aceh.jpg";
}
else if ($name_gambar=="2")
{
    $gambar="./images/nias.jpg";
}
*/
// define some HTML content with style
//mysql_connect('localhost','root','ilmawan');
//mysql_select_db('simbada_migrasi_andreas');

/*
 select A.Aset_ID, A.LastSatker_ID,  A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Alamat, A.Info, A.TglPerolehan,A.Tahun,A.AsalUsul, 
B.LuasTotal,  B.HakTanah, B.NoSertifikat, B.TglSertifikat, B.Penggunaan,  
C.KodeSatker,  C.Satker_ID, C.KodeUnit,C.NamaSatker,
D.Kode, D.Uraian, D.Satuan from  
Aset as A, Tanah as B,Kelompok as D,Satker as C 
where A.Aset_ID=B.Aset_ID and A.Kelompok_ID=D.Kelompok_ID and 
A.LastSatker_ID=C.Satker_ID and  A.TipeAset='A'
order by C.KodeSatker, C.KodeUnit, D.Kode, A.NomorReg limit 250
*/

$sql ="select A.Aset_ID, A.Lokasi_ID,A.LastSatker_ID,  A.NomorReg, A.NamaAset,A.NilaiPerolehan, A.Alamat, A.Info, A.TglPerolehan,A.Tahun,A.AsalUsul, 
B.LuasTotal,B.HakTanah, B.NoSertifikat, B.TglSertifikat, B.Penggunaan,  
C.KodeSatker,C.Satker_ID, C.KodeUnit,C.NamaSatker,
D.Kode, D.Uraian, D.Satuan   
from Aset A 
left outer join Tanah B on A.Aset_ID=B.Aset_ID 
left outer join Satker C on A.LastSatker_ID=C.Satker_ID  
left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID where A.TipeAset = 'A' order by C.KodeSatker, C.KodeUnit, D.Kode, A.NomorReg limit 10";

//$result = mysql_query($sql) or die(mysql_error());

$head = "
<html>
    <body>
        <table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
        
            <tr>
                <td style=\"width: 150px;\"><img style=\"width: 60px; height: 79px;\" alt=\"\"src=\"$gambar\"></td>
                <td style=\"width: 902px; text-align: center;\">
                    <h3>KARTU INVENTARIS BARANG (KIB) A</h3>
                    <h3>TANAH</h3>
               </td>
          </tr>
        
        </table>
        <br />
        <br />
        <table border=\"0\" width=\"100%\">
            <tr>
                <td width=\"15%\">
                    <b>KABUPATEN/KOTA</b>
                </td>
                <td width=\"65%\">

                    <b>:&nbsp;$KAB</b>
                </td>
                <td width=\"20%\">&nbsp;</td>
            </tr>
            <tr align=\"left\">
                <td >
                    <b>PROVINSI</b>
                </td>
                <td width=\"65%\">
                    <b>:&nbsp;$PROVINSI</b>
                </td>
                <td width=\"20%\"><b>NO. KODE LOKASI : $no_kode_lokasi</b></td>
            </tr>
          </table>
          <br />
          <br />";
          
$body="<table style=\"text-align: left; border-collapse: collapse; margin-left: auto; margin-right: auto; width: 100%;\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
         
          <thead> 
          
            <tr style=\"font-weight: bold;\">
                <td style=\"width: 30px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>No<br>Urut<br></td>
                <td style=\"width: 160px; text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Jenis Barang /<br>
                                                                                      Nama Barang</td>
                <td style=\"text-align: center;\" colspan=\"2\" rowspan=\"1\">Nomor</td>
                <td colspan=\"1\" rowspan=\"3\" style=\"width: 50px; text-align: center;\"><br><br>Luas<br>
                                                                                     (m2)</td>
                <td colspan=\"1\" rowspan=\"3\" style=\"width: 75px; text-align: center;\"><br><br>Tahun<br>
                                                                                     Pengadaan<br>/ Perolehan</td>
                <td colspan=\"1\" rowspan=\"3\" style=\"width: 110px; text-align: center;\"><br><br>Letak / Alamat <br>
                                                                                   </td>
                <td colspan=\"3\" rowspan=\"1\" style=\"width: 220px; text-align: center;\">Status Tanah</td>
                <td style=\"text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Penggunaan</td>
                <td style=\" width: 70px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Asal Usul</td>
                <td style=\"width: 80px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Nilai Perolehan<br>(ribuan Rp)</td>
                <td style=\"width: 80px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Nilai<br> Hasil<br>Penilaian</td>
                <td style=\"text-align: center; width: 80px;\" colspan=\"1\" rowspan=\"3\"><br><br>Ket</td>
            </tr>
            <tr style=\"font-weight: bold;\">
                <td style=\"text-align: center;\" colspan=\"1\" rowspan=\"2\"><br><br>Kode Barang</td>
                <td style=\"text-align: center;\" colspan=\"1\" rowspan=\"2\"><br><br>Register</td>
                <td colspan=\"1\" rowspan=\"2\" style=\"width: 85px; text-align: center;\"><br><br>Hak</td>
                <td colspan=\"2\" rowspan=\"1\" style=\"width: 135px; text-align: center;\">Sertifikat</td>
            </tr>
            <tr style=\"font-weight: bold;\">
                <td style=\"width: 75px; text-align: center;\">Tanggal</td>
                <td style=\"width: 60px;text-align: center;\">Nomor</td>
            </tr>
            <tr align=\"center\">
                <td style=\"font-weight: bold;\">1</td>
                <td style=\"font-weight: bold;\">2</td>
                <td style=\"font-weight: bold;\">3</td>
                <td style=\"font-weight: bold;\">4</td>
                <td style=\"width: 50px; font-weight: bold;\">5</td>
                <td style=\"width: 75px; font-weight: bold;\">6</td>
                <td style=\"width: 110px; font-weight: bold;\">7</td>
                <td style=\"width: 85px; font-weight: bold;\">8</td>
                <td style=\"width: 75px; font-weight: bold;\">9</td>
                <td style=\"font-weight: bold;\">10</td>
                <td style=\"font-weight: bold;\">11</td>
                <td style=\"font-weight: bold;\">12</td>
                <td style=\"font-weight: bold;\">13</td>
                <td style=\"font-weight: bold;\">14</td>
                <td><span style=\"font-weight: bold;\">15</span></td>
            </tr>
          </thead>
            ";
            
$footer.="	     
        <br />
        <br />
        <table style=\"text-align: left; border-collapse: collapse; width: 1024px; height: 90px;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
        
            <tr>
                <td style=\"text-align: center;\" colspan=\"3\" width=\"400px\">Mengetahui</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style=\"text-align: center;\" colspan=\"3\" width=\"200px\">$f_tanggal&nbsp;$f_bulan&nbsp;$f_tahun</td>
            </tr>
            <tr>
                <td style=\"text-align: center;\" colspan=\"3\">..............................</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style=\"text-align: center;\" colspan=\"3\">..............................</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style=\"text-align: center;\" colspan=\"3\">..............................</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style=\"text-align: center;\" colspan=\"3\">..............................</td>
            </tr>
                <tr>
                <td style=\"text-align: center;\" colspan=\"3\">______________________________</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style=\"text-align: center;\" colspan=\"3\">______________________________</td>
            </tr>
            <tr>
                <td style=\"text-align: center;\" colspan=\"3\">NIP: ..............................</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style=\"text-align: center;\" colspan=\"3\">NIP : ..............................</td>
            </tr>
           
        </table>
     </body>
</html>";


            $no=1;
            $skpdeh="";
            $status_print=0;
            $luasTotal=0;
            $perolehanTotal=0;
            foreach ($dataArr as $row)
          	{
                    if ($skpdeh == ""){
		$body.="";
					$skpdeh = $row->NamaSatker;
						
				}
                        
				if ($skpdeh != $row->NamaSatker){
					
                    $printluas=  number_format($luasTotal);
                    $printperolehanTotal=  number_format($perolehanTotal);
                    $tabletotal="
						<tr align=\"center\">
							<td colspan=\"4\">Total</td>
							<td align=\"right\">$printluas</td>
							<td colspan=\"7\"></td>
							<td align=\"right\">$printperolehanTotal</td>
							<td colspan=\"2\"></td>
						</tr>
						</table>
					";
                    $luasTotal=0;
					$perolehanTotal=0;
					$no=1;
					
						if($status_print==0)
                           $html=$head.$body.$tabletotal.$footer;
                        else
                           $html=$body.$tabletotal.$footer;
                    //echo "Masukkk $status_print<br/>$html";
$tbl = <<<EOD
$html
EOD;
// output the HTML content
$pdf->writeHTML($tbl, true, false, true, false, '');
$pdf->AddPage($orientation, $format, $keepmargins, $tocpage);

                    $body="";     
					$body.="<table>
                                    <tr>
										<td style=\"width: 150px;\"><img style=\"width: 60px; height: 79px;\" alt=\"\"src=\"$gambar\"></td>
										<td style=\"width: 902px; text-align: center;\">
											<h3>KARTU INVENTARIS BARANG (KIB) A</h3>
											<h3>TANAH</h3>
										</td>
									</tr>
									<tr>
										<td width=\"15%\">
											<b>KABUPATEN/KOTA</b>
										</td>
										<td width=\"65%\">
											<b>:&nbsp;$kab_kota</b>
										</td>
										<td width=\"20%\">&nbsp;</td>
									</tr>
									<tr align=\"left\">
										<td >
											<b>PROVINSI</b>
										</td>
										<td width=\"65%\">
											<b>:&nbsp;$provinsi</b>
										</td>
										<td width=\"20%\"><b>NO. KODE LOKASI : $no_kode_lokasi</b></td>
									</tr>
							</table>
							<br />
							<br />
							<table style=\"text-align: left; border-collapse: collapse; margin-left: auto; margin-right: auto; width: 100%;\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
                                <thead> 	
									<tr style=\"font-weight: bold;\">
										<td style=\"width: 30px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>No<br>Urut<br></td>
										<td style=\"width: 160px; text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Jenis Barang /<br>
																										  Nama Barang</td>
										<td style=\"text-align: center;\" colspan=\"2\" rowspan=\"1\">Nomor</td>
										<td colspan=\"1\" rowspan=\"3\" style=\"width: 50px; text-align: center;\"><br><br>Luas<br>
																										 (m2)</td>
										<td colspan=\"1\" rowspan=\"3\" style=\"width: 75px; text-align: center;\"><br><br>Tahun<br>
																											 Pengadaan<br>/ Perolehan</td>
										<td colspan=\"1\" rowspan=\"3\" style=\"width: 110px; text-align: center;\"><br><br>Letak / Alamat <br>
																										   </td>
										<td colspan=\"3\" rowspan=\"1\" style=\"width: 220px; text-align: center;\">Status Tanah</td>
										<td style=\"text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Penggunaan</td>
										<td style=\" width: 70px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Asal Usul</td>
										<td style=\"width: 80px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Nilai Perolehan<br>(ribuan Rp)</td>
										<td style=\"width: 80px;text-align: center;\" colspan=\"1\" rowspan=\"3\"><br><br>Nilai<br> Hasil<br>Penilaian</td>
										<td style=\"text-align: center; width: 80px;\" colspan=\"1\" rowspan=\"3\"><br><br>Ket</td>
									</tr>
									<tr style=\"font-weight: bold;\">
										<td style=\"text-align: center;\" colspan=\"1\" rowspan=\"2\"><br><br>Kode Barang</td>
										<td style=\"text-align: center;\" colspan=\"1\" rowspan=\"2\"><br><br>Register</td>
										<td colspan=\"1\" rowspan=\"2\" style=\"width: 85px; text-align: center;\"><br><br>Hak</td>
										<td colspan=\"2\" rowspan=\"1\" style=\"width: 135px; text-align: center;\">Sertifikat</td>
									</tr>
									<tr style=\"font-weight: bold;\">
										<td style=\"width: 75px; text-align: center;\">Tanggal</td>
										<td style=\"width: 60px;text-align: center;\">Nomor</td>
									</tr>
									<tr align=\"center\">
										<td style=\"font-weight: bold;\">1</td>
										<td style=\"font-weight: bold;\">2</td>
										<td style=\"font-weight: bold;\">3</td>
										<td style=\"font-weight: bold;\">4</td>
										<td style=\"width: 50px; font-weight: bold;\">5</td>
										<td style=\"width: 75px; font-weight: bold;\">6</td>
										<td style=\"width: 110px; font-weight: bold;\">7</td>
										<td style=\"width: 85px; font-weight: bold;\">8</td>
										<td style=\"width: 75px; font-weight: bold;\">9</td>
										<td style=\"font-weight: bold;\">10</td>
										<td style=\"font-weight: bold;\">11</td>
										<td style=\"font-weight: bold;\">12</td>
										<td style=\"font-weight: bold;\">13</td>
										<td style=\"font-weight: bold;\">14</td>
										<td><span style=\"font-weight: bold;\">15</span></td>
									</tr>
                              </thead>
							";
					$skpdeh = $row->NamaSatker;
                    $status_print++;
                                                    
				}
					$hak_tanah = get_hak_pakai($row->HakTanah);
					$perolehan = number_format($row->NilaiPerolehan);
					$luas = number_format($row->LuasTotal);
					$luasTotal = $luasTotal + $row->LuasTotal;
					$perolehanTotal = $perolehanTotal + $row->NilaiPerolehan;
						$body.="
						<tr align=\"center\">
							<td style=\"width: 30px;font-weight: \">$no</td>
							<td style=\"width: 160px;font-weight: \" align=\"left\">$row->NamaAset</td>
							<td style=\"font-weight: \">$row->Kode</td>
							<td style=\"font-weight: \">$row->NomorReg</td>
							<td style=\"width: 50px; font-weight: \" align=\"right\">$luas</td>
							<td style=\"width: 75px; font-weight: \">$row->Tahun</td>
							<td style=\"width: 110px; font-weight: \">$row->Alamat</td>
							<td style=\"width: 85px; font-weight: \">$hak_tanah</td>
							<td style=\"width: 75px; font-weight: \">$row->TglSertifikat</td>
							<td style=\"width: 60px;font-weight: \">$row->NoSertifikat</td>
							<td style=\"font-weight: \">$row->Penggunaan</td>
							<td style=\"width: 70px;font-weight: \">$row->AsalUsul</td>
							<td style=\"width: 80px;font-weight: \" align=\"right\">$perolehan</td>
							<td style=\"width: 80px;font-weight: \"></td>
							<td style=\"width: 80px;font-weight: \">$row->Info</td>
						</tr>
						";
						$no++;
			
				}
                    $printluas=  number_format($luasTotal);
                    $printperolehanTotal=  number_format($perolehanTotal);
                    $tabletotal="
                   
						<tr align=\"center\">
							<td colspan=\"4\">Total</td>
							<td align=\"right\">$printluas</td>
							<td colspan=\"7\"></td>
							<td align=\"right\">$printperolehanTotal</td>
							<td colspan=\"2\"></td>
						</tr></table>
					";
		
            
if($status_print==0){
$html=$head.$body.$tabletotal.$footer;
//$pdf->AddPage($orientation, $format, $keepmargins, $tocpage);
}else{
     $html=$body.$tabletotal.$footer;
     //$pdf->AddPage($orientation, $format, $keepmargins, $tocpage);
     
     }
 //echo "woiii $status_print<br/>$html";
$tbl = <<<EOD
$html
EOD;
// output the HTML content
$pdf->writeHTML($tbl, true, false, true, false, '');
//$pdf->AddPage($orientation, $format, $keepmargins, $tocpage);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// *******************************************************************
// HTML TIPS & TRICKS
// *******************************************************************

// REMOVE CELL PADDING
//
// $pdf->SetCellPadding(0);
//
// This is used to remove any additional vertical space inside a
// single cell of text.

// - - - - - - -  echo "Masukkk $status_print<br/>$html";- - - - - - - - - - - - - - - - - - - - - - - - - - -

// REMOVE TAG TOP AND BOTTOM MARGINS
//
// $tagvs = array('p' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n' => 0)));
// $pdf->setHtmlVSpace($tagvs);
//
// Since the CSS margin command is not yet implemented on TCPDF, you
// need to set the spacing of block tags using the following method.

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// SET LINE HEIGHT
//
// $pdf->setCellHeightRatio(1.25);
//
// You can use the following method to fine tune the line height
// (the number is a percentage relative to font height).

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// CHANGE THE PIXEL CONVERSION RATIO
//
// $pdf->setImageScale(0.47);
// echo "Masukkk $status_print<br/>$html";
// This is used to adjust the conversion ratio between pixels and
// document units. Increase the value to get smaller objects.
// Since you are using pixel unit, this method is important to set the
// right zoom factor.
//
// Suppose that you want to print a web page larger 1024 pixels to
// fill all the available page width.
// An A4 page is larger 210mm equivalent to 8.268 inches, if you
// subtract 13mm (0.512") of margins for each side, the remaining
// space is 184mm (7.244 inches).
// The default resolution for a PDF document is 300 DPI (dots per
// inch), so you have 7.244 * 300 = 2173.2 dots (this is the maximum
// number of points you can print at 300 DPI for the given width).
// The conversion ratio is approximatively 1024 / 2173.2 = 0.47 px/dots
// If the web page is larger 1280 pixels, on the same A4 page the
// conversion ratio to use is 1280 / 2173.2 = 0.59 pixels/dots

// *******************************************************************

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//echo $tbl;
//Close and output PDF document
$pdf->Output('kib_a.pdf'.date('d-m-Y'), 'I');	

//============================================================+
// END OF FILE
//============================================================+


?>
