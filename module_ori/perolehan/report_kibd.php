<?php
require_once('../../config/config.php');
require_once('../report_func.php');
require_once('../../function/tcpdf/config/lang/ind.php');
require_once('../../function/tcpdf/tcpdf.php');
include ('../../function/tanggal/tanggal.php');


function get_status_tanah($status_tanah){
	if($status_tanah == 10)
		$status = "Tanah Pemda";
	else if(status_tanah == 20)
		$status = "Tanah Negara";
	else if(status_tanah == 30)
		$status = "Tanah Ulayat/Adat";
	else if(status_tanah == 41)
		$status = "Tanah Hak Guna Bangunan";
	else if(status_tanah == 42)
		$status = "Tanah Hak Pakai";
	return $status;
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


$gambar = getLogo('bireun',$path);
//variabel
/*$name_gambar     ="1";
if ($name_gambar=="1")
{
    $gambar="../../../function/tcpdf/gambar/aceh.jpg";
}
else if ($name_gambar=="2")
{
    $gambar="../../../function/tcpdf/gambar/nias.jpg";
}*/
// define some HTML content with style


/*
select A.Aset_ID, A.LastSatker_ID, A.NamaAset, D.Kode, A.NomorReg, B.Konstruksi, B.Panjang, B.Lebar, E.LuasTotal, A.Alamat,
B.TglDokumen, B.NoDokumen, B.StatusTanah, A.AsalUsul,A.NilaiPerolehan, A.Info, 
C.KodeSatker,  C.Satker_ID, C.KodeUnit,C.NamaSatker,
D.Kode, D.Uraian, D.Satuan from  
Aset as A, Jaringan as B,Kelompok as D,Satker as C, Tanah as E where  A.Aset_ID=B.Aset_ID and A.Kelompok_ID=D.Kelompok_ID and A.LastSatker_ID=C.Satker_ID and A.Aset_ID=E.Aset_ID and  A.TipeAset='D'
order by C.KodeSatker, C.KodeUnit, D.Kode, A.NomorReg
 */
$sql ="
select A.Aset_ID, A.LastSatker_ID,A.Lokasi_ID, A.NamaAset,A.NomorReg,A.AsalUsul,A.NilaiPerolehan, A.Info,A.Alamat, 
B.Konstruksi, B.Panjang, B.Lebar, B.TglDokumen, B.NoDokumen, B.StatusTanah,  
C.KodeSatker,  C.Satker_ID, C.KodeUnit,C.NamaSatker,
D.Kode, D.Uraian, D.Satuan,
E.LuasTotal
from  Aset as A  
left outer join Jaringan B on A.Aset_ID=B.Aset_ID
left outer join Satker C on A.LastSatker_ID=C.Satker_ID
left outer join Kelompok D on A.Kelompok_ID=D.Kelompok_ID
left outer join Tanah E on A.Aset_ID=E.Aset_ID
where A.TipeAset='D'order by C.KodeSatker, C.KodeUnit, D.Kode, A.NomorReg limit 10";

//$result = mysql_query($sql) or die(mysql_error());

$head = "
<html>
    <body>
        <table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
        
            <tr>
                <td style=\"width: 150px;\"><img style=\"width: 60px; height: 79px;\" alt=\"\"src=\"$gambar\"></td>
                <td style=\"width: 902px; text-align: center;\">
                    <h3>KARTU INVENTARIS BARANG (KIB) D</h3>
                    <h3>JALAN IRIGASI DAN JARINGAN</h3>
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
				<td style=\"width: 30px;text-align: center; font-weight: bold;\"colspan=\"1\" rowspan=\"2\"><br><br>No<br>Urut<br></td>
                <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold; width: 106px;\"><br><br>Nama
                                                                                                        Barang /<br>
                                                                                                        Jenis Barang</td>
                <td colspan=\"2\" rowspan=\"1\"style=\" text-align: center; font-weight: bold; width: 130px;\">Nomor</td>
                <td style=\"text-align: center; font-weight: bold;\"colspan=\"1\" rowspan=\"2\"><br><br>Konstruksi</td>
                <td colspan=\"1\" rowspan=\"2\"style=\"width: 50px; text-align: center; font-weight: bold;\"><br><br>Panjang<br>
                                                                                                      (km)</td>
                <td colspan=\"1\" rowspan=\"2\"style=\"width: 50px; text-align: center; font-weight: bold;\"><br><br>Lebar<br>
                                                                                                       (m2)</td>
                <td colspan=\"1\" rowspan=\"2\"style=\"width: 50px; text-align: center; font-weight: bold;\"><br><br>Luas<br>
                                                                                                       (m2)</td>
                <td colspan=\"1\" rowspan=\"2\"style=\"width: 90px; text-align: center; font-weight: bold;\"><br><br>
                                                                                                       Letak/Lokasi<br>
                </td>
                <td colspan=\"2\" rowspan=\"1\"style=\"width: 140px; text-align: center; font-weight: bold;\">Dokumen
                                                                                                       </td>
                <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;\"><br><br>Status <br>
                                                                                          Tanah</td>
                <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;\"><br><br>Nomer<br>
                                                                                          Kode<br>
                                                                                          Tanah</td>
                 <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;\"><br><br>Asal Usul</td>
                 <td colspan=\"1\" rowspan=\"2\"style=\"width:80px;text-align: center; font-weight: bold;\"><br><br>Nilai Perolehan
                                                                                          (Ribuan Rp)</td>
                <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold; width: 80px;\"><br><br>Nilai <br>Hasil<br>
                                                                                          Penilaian</td>

                <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold; width: 80px;\"><br><br>Kondisi<br>
                                                                                          (B,KB,RB)</td>
                <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;width: 60px;\"><br><br>Ket</td>
            </tr>
            <tr>
                <td style=\"text-align: center; font-weight: bold; width: 80px;\"><br><br>Kode Barang</td>
                <td style=\"text-align: center; font-weight: bold; width: 50px;\"><br><br>Register</td>
                <td style=\"width: 60px; text-align: center; font-weight: bold;\"><br><br>Tanggal</td>
                <td style=\"width: 80px; text-align: center; font-weight: bold;\"><br><br>Nomor</td>
            </tr>
            <tr>
                <td style=\"text-align: center; font-weight: bold;\">1</td>
                <td style=\"text-align: center; font-weight: bold; width: 106px;\">2</td>
                <td style=\"text-align: center; font-weight: bold; width: 80px;\">3</td>
                <td style=\"text-align: center; font-weight: bold;\">4</td>
                <td style=\"text-align: center; font-weight: bold;\">5</td>
                <td style=\"width: 50px; text-align: center; font-weight: bold;\">6</td>
                <td style=\"width: 40px; text-align: center; font-weight: bold; width: 50px;\">7</td>
                <td style=\"width: 40px; text-align: center; font-weight: bold; width: 50px;\">8</td>
                <td style=\"width: 90px;  text-align: center; font-weight: bold;\">9</td>
                <td style=\"width: 60px; text-align: center; font-weight: bold;width: 60px;\">10</td>
                <td style=\"width: 60px; text-align: center; font-weight: bold;width: 80px;\">11</td>
                <td style=\"text-align: center; font-weight: bold;\">12</td>
                <td style=\"text-align: center; font-weight: bold;\">13</td>
                <td style=\"text-align: center; font-weight: bold;\">14</td>
                <td style=\"text-align: center; font-weight: bold;\">15</td>
                <td style=\"text-align: center; font-weight: bold;\">16</td>
                <td style=\"text-align: center; font-weight: bold;\">17</td>
                <td style=\"text-align: center; font-weight: bold;\">18</td>
             </tr>
           </thead>

            ";
            
            
 $footer = "</tbody>
          </table>
           <br />
           <br />
           <br />
           <br />
        <table style=\"text-align: left; border-collapse: collapse; width: 1024px; height: 90px;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
        <tbody>
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
           </tbody>
        </table>
     </body>
</html>";           
            
            $no=1;
            $skpdeh="";
            $status_print=0;
            $luasTotal=0;
            $panjangTotal=0;
            $perolehanTotal=0;
	    
	    foreach ($dataArr as $row)
            //while($row=mysql_fetch_object($result))
			{
			/*foreach ($dataArr as $row)
				{*/	
				if ($skpdeh == ""){
					//$header="";
					//echo "<br /><br />";
					//$body.="";
					//echo "<br /><br />";
					//$skpdeh = $row->NamaSatker;
					$body.="";
					$skpdeh = $row->NamaSatker;
						
				}
                        
				if ($skpdeh != $row->NamaSatker){
					
                    $printluas=  number_format($luasTotal);
                    $printpanjang= number_format($panjangTotal);
                    $printperolehanTotal=  number_format($perolehanTotal);
                    $tabletotal="
                    <tr align=\"center\">
							<td colspan=\"5\">Total</td>
							<td>$printpanjang</td>
							<td colspan=\"1\"></td>
							<td>$printluas</td>
							<td colspan=\"6\"></td>
							<td>$printperolehanTotal</td>
						</tr></table>
					";
					
                     $luasTotal=0;
                     $panjangTotal=0;
					 $perolehanTotal=0;
					 $no=1;
                     if($status_print==0)
                     $html=$head.$body.$tabletotal.$footer;
                     else
                     $html=$body.$tabletotal.$footer;
                                                        //   echo "Masukkk $status_print<br/>$html";
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
											<h3>KARTU INVENTARIS BARANG (KIB) D</h3>
											<h3>JALAN IRIGASI DAN JARINGAN</h3>
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
										<td style=\"width: 30px;text-align: center; font-weight: bold;\"colspan=\"1\" rowspan=\"2\"><br><br>No<br>Urut<br></td>
										<td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold; width: 106px;\"><br><br>Nama
																																Barang /<br>
																																Jenis Barang</td>
										<td colspan=\"2\" rowspan=\"1\"style=\" text-align: center; font-weight: bold; width: 130px;\">Nomor</td>
										<td style=\"text-align: center; font-weight: bold;\"colspan=\"1\" rowspan=\"2\"><br><br>Konstruksi</td>
										<td colspan=\"1\" rowspan=\"2\"style=\"width: 50px; text-align: center; font-weight: bold;\"><br><br>Panjang<br>
																															  (km)</td>
										<td colspan=\"1\" rowspan=\"2\"style=\"width: 50px; text-align: center; font-weight: bold;\"><br><br>Lebar<br>
																															   (m2)</td>
										<td colspan=\"1\" rowspan=\"2\"style=\"width: 50px; text-align: center; font-weight: bold;\"><br><br>Luas<br>
																															   (m2)</td>
										<td colspan=\"1\" rowspan=\"2\"style=\"width: 90px; text-align: center; font-weight: bold;\"><br><br>
																															   Letak/Lokasi<br>
										</td>
										<td colspan=\"2\" rowspan=\"1\"style=\"width: 140px; text-align: center; font-weight: bold;\">Dokumen
																															   </td>
										<td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;\"><br><br>Status <br>
																												  Tanah</td>
										<td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;\"><br><br>Nomer<br>
																												  Kode<br>
																												  Tanah</td>
										 <td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;\"><br><br>Asal Usul</td>
										 <td colspan=\"1\" rowspan=\"2\"style=\"width:80px;text-align: center; font-weight: bold;\"><br><br>Nilai Perolehan
																												  (Ribuan Rp)</td>
										<td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold; width: 80px;\"><br><br>Nilai <br>Hasil<br>
																												  Penilaian</td>

										<td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold; width: 80px;\"><br><br>Kondisi<br>
																												  (B,KB,RB)</td>
										<td colspan=\"1\" rowspan=\"2\"style=\"text-align: center; font-weight: bold;width: 60px;\"><br><br>Ket</td>
									</tr>
									<tr>
										<td style=\"text-align: center; font-weight: bold; width: 80px;\"><br><br>Kode Barang</td>
										<td style=\"text-align: center; font-weight: bold; width: 50px;\"><br><br>Register</td>
										<td style=\"width: 60px; text-align: center; font-weight: bold;\"><br><br>Tanggal</td>
										<td style=\"width: 80px; text-align: center; font-weight: bold;\"><br><br>Nomor</td>
									</tr>
									<tr>
										<td style=\"text-align: center; font-weight: bold;\">1</td>
										<td style=\"text-align: center; font-weight: bold; width: 106px;\">2</td>
										<td style=\"text-align: center; font-weight: bold; width: 80px;\">3</td>
										<td style=\"text-align: center; font-weight: bold;\">4</td>
										<td style=\"text-align: center; font-weight: bold;\">5</td>
										<td style=\"width: 50px; text-align: center; font-weight: bold;\">6</td>
										<td style=\"width: 40px; text-align: center; font-weight: bold; width: 50px;\">7</td>
										<td style=\"width: 40px; text-align: center; font-weight: bold; width: 50px;\">8</td>
										<td style=\"width: 90px;  text-align: center; font-weight: bold;\">9</td>
										<td style=\"width: 60px; text-align: center; font-weight: bold;width: 60px;\">10</td>
										<td style=\"width: 60px; text-align: center; font-weight: bold;width: 80px;\">11</td>
										<td style=\"text-align: center; font-weight: bold;\">12</td>
										<td style=\"text-align: center; font-weight: bold;\">13</td>
										<td style=\"text-align: center; font-weight: bold;\">14</td>
										<td style=\"text-align: center; font-weight: bold;\">15</td>
										<td style=\"text-align: center; font-weight: bold;\">16</td>
										<td style=\"text-align: center; font-weight: bold;\">17</td>
										<td style=\"text-align: center; font-weight: bold;\">18</td>
									 </tr>
                              </thead>
							";
					$skpdeh = $row->NamaSatker;
                    $status_print++;
                                                    
				}
					$luasTotal = $luasTotal + $row->LuasTotal;
					$panjangTotal = $panjangTotal + $row->Panjang;
					$perolehanTotal = $perolehanTotal + $row->NilaiPerolehan;
					$status_tanah = get_status_tanah($row->StatusTanah);
					$perolehan = number_format($row->NilaiPerolehan);
					$panjang = number_format($row->Panjang);
					$lebar = number_format($row->Lebar);
					$luas = number_format($row->LuasTotal);
					
						$body.="
						<tr align=\"center\">
							<td style=\"width: 30px;font-weight: \">$no</td>
							<td style=\"width: 106px;font-weight: \">$row->NamaAset</td>
							<td style=\"width: 80px;font-weight: \">$row->Kode</td>
							<td style=\"width: 50px;font-weight: \">$row->NomorReg</td>
							<td style=\"width: 66px; font-weight: \">$row->Konstruksi</td>
							<td style=\"width: 50px; font-weight: \">$panjang</td>
							<td style=\"width: 50px; font-weight: \">$lebar</td>
							<td style=\"width: 50px; font-weight: \">$luas</td>
							<td style=\"width: 90px;font-weight: \">$row->Alamat</td>
							<td style=\"width: 61px; font-weight: \">$row->TglDokumen</td>
							<td style=\"width: 79px;font-weight: \">$row->NoDokumen</td>
							<td style=\"width: 66px; font-weight: \">$status_tanah</td>
							<td style=\"width: 66px;font-weight: \"></td>
							<td style=\"width: 67px;font-weight: \">$row->AsalUsul</td>
							<td style=\"width: 80px;font-weight: \">$perolehan</td>
							<td style=\"width: 79px;font-weight: \"></td>
							<td style=\"width: 80px;font-weight: \"></td>
							<td style=\"width: 60px;font-weight: \">$row->Info</td>
						</tr>
						";
						$no++;
			}
                    $printluas=  number_format($luasTotal);
                    $printpanjang= number_format($panjangTotal);
                    $printperolehanTotal=  number_format($perolehanTotal);
                    $tabletotal="
						<tr align=\"center\">
							<td colspan=\"5\">Total</td>
							<td>$printpanjang</td>
							<td colspan=\"1\"></td>
							<td>$printluas</td>
							<td colspan=\"6\"></td>
							<td>$printperolehanTotal</td>
						</tr></table>
					";
		

            
if($status_print==0)
$html=$head.$body.$tabletotal.$footer;
else
     $html=$body.$tabletotal.$footer;
 //echo "woiii $status_print<br/>$html";
$tbl = <<<EOD
$html
EOD;
// output the HTML content
$pdf->writeHTML($tbl, true, false, true, false, '');

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

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

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
//
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

//Close and output PDF document
$pdf->Output('kib_d.pdf'.date('d-m-Y'), 'I');

//============================================================+
// END OF FILE
//============================================================+


?>
