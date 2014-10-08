<?php
require_once('../../../function/tcpdf/config/lang/eng.php');
require_once('../../../function/tcpdf/tcpdf.php');

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

include "../../../function/tanggal/tanggal.php";
//variabel
$name_gambar     ="1";
if ($name_gambar=="1")
{
    $gambar="../../../function/tcpdf/gambar/aceh.jpg";
}
else if ($name_gambar=="2")
{
     $gambar="../../../function/tcpdf/gambar/nias.jpg";
}
$kabupaten              ="NIAS";
$tahun_anggaran         ="2011";
$skpd                   ="Sekretariat Daerah";
$kab_kota               ="Kabupaten Nias";
$provinsi               ="Sumatera Utara";
$no                     ="1";
$no_kode_lokasi_barang  ="001";
$no_kode_barang         ="02.02.03.01.02";
$no_register            ="001";
$nama_jenis_barang      ="Mobil";
$dokumen_barang         ="Ada";
$alamat_barang          ="Nias";
$asal_usul_barang       ="Hibah";
$tahun_pembelian_penggadaian="2011";
$konstruksi             ="P";
$kondisi_barang         ="Baik";
$luas                   ="-";
$skkdh                  ="Ada";
$ket                    ="-";
/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style
$html = <<<EOF

<html>
    <body>
        <table style="text-align: left; width: 100%; height: 161px;"border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="width: 150px; text-align: left;"><br><br><img style="width: 60px; height: 79px;" alt=""
                    src="$gambar"></td>
                <td style="width: 900px; text-align: center;">
                    <h3>PEMERINTAH KABUPATEN $kabupaten</h3>
                    <h3>DAFTAR BARANG MILIK DAERAH UNTUK DIMANFATKAN</h3>
                    <h3>TAHUN ANGGARAN $tahun_anggaran</h3>
                    <h3></h3>
                </td>
            </tr>
        </tbody>
        </table>
        <br>
        <table border="0" width="100%">
            <tr>
                <td width="15%">
                    <b>SKPD</b>
                </td>
                <td>
                    :&nbsp;$skpd
                </td>
            </tr>
            <tr>
                <td>
                    <b>KAB/KOTA</b>
                </td>
                <td>
                    :&nbsp;$kab_kota
                </td>
            </tr>
            <tr>
                <td>
                    <b>PROVINSI</b>
                </td>
                <td>
                    :&nbsp;$provinsi
                </td>
            </tr>
        </table>
          <br />
          <br />
        <table style="text-align: left; border-collapse: collapse " border="1">
        <tbody>
            <tr align="center">
                <td width="32px"><br><br><b>No</b> </td>
                <td width="91px"><br><br><b>No Kode<br>Lokasi Barang</b></td>
                <td width="91px"><br><br><b>No. Kode</b><br>
                                          <b>Barang</b>
                </td>
                <td width="91px"><br><br><b>Nomor<br>Register</b>
                </td>
                <td width="120px"><br><br><b>Nama/<br>Jenis Barang</b>
                </td>
                <td width="91px" ><br><br><b>Dokumen</b> <br>
                                  <b>Barang</b>
                </td>
                <td width="90px"><br><br><b>Alamat<br>Barang</b></td>
                <td width="87px"><br><br><b>Asal Usul<br>Barang</b></td>
                <td width="101px"><br><br><b>Tahun<br>Pembelian/<br>Pengadaan</b></td>
                <td width="101px"><br><br><b>Konstruksi<br>(P,SP,D)</b></td>
                <td width="101px"><br><br><b>Kondisi<br>Barang</b></td>
                <td width="50px"><br><br><b>Luas<br>(m2)</b></td>
                <td width="60px"><br><br><b>SKKDH</b></td>
                <td width="90px"><br><br><b>Ket</b></td>
            </tr>
            <tr align="center">
                <td width="32px"><b>1</b></td>
                <td width="91px"><b>2</b></td>
                <td width="91px"><b>3</b></td>
                <td width="91px"><b>4</b></td>
                <td width="120px"><b>5</b></td>
                <td width="91px"><b>6</b></td>
                <td width="90px"><b>7</b></td>
                <td width="87px"><b>8</b></td>
                <td width="101px"><b>9</b></td>
                <td width="101px"><b>10</b></td>
                <td width="101px"><b>11</b></td>
                <td width="50px"><b>12</b></td>
                <td width="60px"><b>13</b></td>
                <td width="90px"><b>14</b></td>
              </tr>
              <tr align="center">
                <td width="32px">$no</td>
                <td width="91px">$no_kode_lokasi_barang</td>
                <td width="91px">$no_kode_barang</td>
                <td width="91px">$no_register</td>
                <td width="120px">$nama_jenis_barang</td>
                <td width="91px">$dokumen_barang</td>
                <td width="90px">$alamat_barang</td>
                <td width="87px">$asal_usul_barang</td>
                <td width="101px">$tahun_pembelian_penggadaian</td>
                <td width="101px">$konstruksi</td>
                <td width="101px">$kondisi_barang</td>
                <td width="50px">$luas</td>
                <td width="60px">$skkdh</td>
                <td width="90px">$ket</td>
              </tr>
            </tbody>
            </table>

            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
        <table style="text-align: left; width: 100%; height: 90px;" border="0" cellpadding="2" cellspacing="2">
        <tbody>
            <tr>
                <td style="text-align: center;" colspan="3" width="300px">Mengetahui</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;" colspan="3" width="300px">$f_tanggal&nbsp;$f_bulan&nbsp;$f_tahun</td>
            </tr>
            <tr>
                <td style="text-align: center;" colspan="3">Pengelola Barang</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;" colspan="3">Kepala SKPD</td>
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
                <td style="text-align: center;" colspan="3">(..............................)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;" colspan="3">(..............................)</td>
            </tr>
            <tr>
                <td style="text-align: center;" colspan="3">NIP: ..............................</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;" colspan="3">NIP : ..............................</td>
            </tr>
           </tbody>
        </table>
     </body>
</html>

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

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
$pdf->Output('daftarbarangmilikdaerahuntukdimanfaatkan.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


?>
