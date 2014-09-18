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
$format = 'A4';
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
$kabupaten              ="";
$tahun                  ="2011";
$skpd                   ="Sekretariat Daerah";
$kab_kota               ="Kabupaten Nias Selatan";
$provinsi               ="Sumatera Utara";
$no                     ="1";
$gol                    ="Peralatan dan Mesin";
$bid                    ="BID 02";
$nama_bidang            ="Bupati";
$awal_jml               ="1";
$awal_harga             ="50.000.000,00";
$berkurang_jml          ="-";
$berkurang_harga        ="-";
$bertambah_jml          ="-";
$bertambah_harga        ="-";
$akhir_jml              ="1";
$akhir_harga            ="50.000.000,00";
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
                <td style="width: 50px; text-align: left;"><br><br><img style="width: 70px; height: 92px;" alt=""
                    src="$gambar"></td>
                <td style="width: 1000px; text-align: center;">
                    <h3>REKAPITULASI DAFTAR MUTASI BARANG</h3>
                    <h3>MILIK PROV / KAB / KOTA $kabupaten</h3>
                    <h3>TAHUN $tahun</h3>
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
          <table style="text-align: left; width: 100%;" border="1"cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="width:30px;text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>No<br></td>
                <td style="width:120px;text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>Gol</td>
                <td style="width:60px;text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>Bid</td>
                <td style="width:100px;text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>Nama Bidang</td>
                <td style="width:150px;text-align: center; font-weight: bold;"colspan="2" rowspan="1">Awal</td>
                <td colspan="2" rowspan="1"style="width: 150px; text-align: center; font-weight: bold;">Berkurang</td>
                <td colspan="2" rowspan="1"style="width: 150px; text-align: center; font-weight: bold;">Bertambah</td>
                <td colspan="2" rowspan="1"style="width: 150px; text-align: center; font-weight: bold;">Akhir</td>
                <td style="text-align: center; font-weight: bold;" colspan="1"rowspan="2"><br><br>Keterangan</td>
            </tr>
            <tr>
                <td style="width: 50px;text-align: center; font-weight: bold;"><br><br>Jml<br></td>
                <td style="width: 100px;text-align: center; font-weight: bold;"><br><br>Harga</td>
                <td style="width: 50px; text-align: center; font-weight: bold;"><br><br>Jml</td>
                <td style="width: 100px; text-align: center; font-weight: bold;"><br><br>Harga</td>
                <td style="width: 50px; text-align: center; font-weight: bold;"><br><br>Jml</td>
                <td style="width: 100px; text-align: center; font-weight: bold;"><br><br>Harga</td>
                <td style="width: 50px; text-align: center; font-weight: bold;"><br><br>Jml</td>
                <td style="width: 100px; text-align: center; font-weight: bold;"><br><br>Harga</td>
            </tr>
            <tr >
                <td style="width: 30px;text-align: center; font-weight: bold;">1</td>
                <td style="width: 120px;text-align: center; font-weight: bold;">2</td>
                <td style="width: 60px;text-align: center; font-weight: bold;">3</td>
                <td style="width: 100px;text-align: center; font-weight: bold;">4</td>
                <td style="width: 50px;text-align: center; font-weight: bold;">5</td>
                <td style="width: 100px;text-align: center; font-weight: bold;">6</td>
                <td style="width: 50px;text-align: center; font-weight: bold;">7</td>
                <td style="width: 100px;text-align: center; font-weight: bold;">8</td>
                <td style="width: 50px;text-align: center; font-weight: bold;">9</td>
                <td style="width: 100px;text-align: center; font-weight: bold;">10</td>
                <td style="width: 50px;text-align: center; font-weight: bold;">11</td>
                <td style="width: 100px;text-align: center; font-weight: bold;">12</td>
                <td style="width: 75px;text-align: center; font-weight: bold;">13</td>
            </tr>
            <tr >
                <td style="width: 30px;text-align: center; ">$no</td>
                <td style="width: 120px;text-align: center; ">$gol</td>
                <td style="width: 60px;text-align: center; ">$bid</td>
                <td style="width: 100px;text-align: center;">$nama_bidang</td>
                <td style="width: 50px;text-align: center; ">$awal_jml</td>
                <td style="width: 100px;text-align: center;">$awal_harga</td>
                <td style="width: 50px;text-align: center; ">$berkurang_jml</td>
                <td style="width: 100px;text-align: center;">$berkurang_harga</td>
                <td style="width: 50px;text-align: center; ">$bertambah_jml</td>
                <td style="width: 100px;text-align: center;">$bertambah_harga</td>
                <td style="width: 50px;text-align: center; ">$akhir_jml</td>
                <td style="width: 100px;text-align: center;">$akhir_harga</td>
                <td style="width: 75px;text-align: center; ">$ket</td>
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
$pdf->Output('rekapitulasidaftarmutasibarang.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


?>
