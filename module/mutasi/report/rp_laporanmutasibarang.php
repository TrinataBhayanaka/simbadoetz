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
$kabupaten                      ="";
$tahun_anggaran                 ="2011";
$skpd                           ="Sekretariat daerah";
$kab_kota                       ="Kabupaten Nias Selatan";
$provinsi                       ="Sumatera Utara";
$no_kode_lokasi                 ="1.1";
$no_urut                        ="1";
$kode_barang                    ="02.02.03.01.02";
$register                       ="001";
$nama_jenis_barang              ="Mobil";
$merk_type                      ="Honda";
$no_sertifikat                  ="JSF1001";
$bobot                          ="1500 kg";
$asal_cara_perolehan            ="Hibah";
$tahun_bulan_perolehan          ="2011";
$konstruksi                     ="P";
$satuan                         ="unit";
$kondisi                        ="B";
$awal_barang                    ="1";
$awal_harga                     ="85.000.000,00";
$berkurang_jml_barang           ="0";
$berkurang_jml_harga            ="0,00";
$bertambah_jml_barang           ="0";
$bertambah_jml_harga            ="0,00";
$akhir_barang                   ="1";
$akhir_jml                      ="85.000.000,00";
$ket                            ="-";
$region                         ="Aceh";
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
                <td style="width: 100px; text-align: left;"><br><br><img style="width: 60px; height: 79px;" alt=""
                    src="$gambar"></td>
                <td style="width: 1000px; text-align: center;">
                    <h3>LAPORAN MUTASI BARANG</h3>
                    <h3>PROVINSI / KABUPATEN / KOTA $kabupaten</h3>
                    <h3>TAHUN ANGGARAN $tahun_anggaran</h3>
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
                <td width="65%">
                    <b>:&nbsp;$skpd</b>
                </td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr align="left">
                <td>
                    <b>KABUPATEN/KOTA</b>
                </td>
                <td>
                    <b>:&nbsp;$kab_kota</b>
                </td>
                <td width="20%">&nbsp;</td>
            </tr>
            <tr align="left">
                <td >
                    <b>PROVINSI</b>
                </td>
                <td>
                    <b>:&nbsp;$provinsi</b>
                </td>
                <td width="20%"><b>NO. KODE LOKASI : $no_kode_lokasi</b></td>
            </tr>

        </table>
          <br />
          <br />
           <table style="text-align: left; width: 100%;" border="1"cellpadding="0" cellspacing="0">
           <tbody>
            <tr>
                <td style="width:30px;text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>No<br>Urut</td>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Kode<br>Barang</td>
                <td style="width:50px;text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Register</td>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Nama/<br>Jenis<br>Barang</td>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Merk/<br>Type</td>
                <td style="width:80px; text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>No.Sertifikat<br>No.Pabrik<br>No.Chasis/<br>Mesin</td>
                <td style="width:50px; text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Bobot</td>
                <td style="width:70px;text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Asal Cara<br>Perolehan<br>Barang</td>
                <td style="width:60px;text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Tahun/<br>Bulan<br>Perolehan</td>
                <td style="width:80px;text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Ukuran<br>Barang/<br>Konstruksi<br>(P,SD,D)</td>
                <td style="width:45px;text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Satuan</td>
                <td style="width:60px;text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Kondisi<br>(B,RR,RB)</td>
                <td style="text-align: center; font-weight: bold;"colspan="2" rowspan="1">Jumlah(Awal)</td>
                <td style="text-align: center; font-weight: bold;"colspan="4" rowspan="1">Mutasi / Perubahan</td>
                <td style="text-align: center; font-weight: bold;"colspan="2" rowspan="1">Jumlah(Akhir)</td>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="3"><br><br>Ket</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>Barang</td>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>Harga</td>
                <td style="text-align: center; font-weight: bold;"colspan="2" rowspan="1">Berkurang</td>
                <td style="text-align: center; font-weight: bold;"colspan="2" rowspan="1">Bertambah</td>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>Barang</td>
                <td style="text-align: center; font-weight: bold;"colspan="1" rowspan="2"><br><br>Harga</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;">Jumlah<br>Barang</td>
                <td style="text-align: center; font-weight: bold;">Jumlah<br>Harga</td><td style="text-align: center; font-weight: bold;">Jumlah<br>Barang</td>
                <td style="text-align: center; font-weight: bold;">Jumlah<br>Harga</td>
            </tr>
            <tr>
                <td style="text-align: center; font-weight: bold;">1</td>
                <td style="text-align: center; font-weight: bold;">2</td>
                <td style="text-align: center; font-weight: bold;">3</td>
                <td style="text-align: center; font-weight: bold;">4</td>
                <td style="text-align: center; font-weight: bold;">5</td>
                <td style="text-align: center; font-weight: bold;">6</td>
                <td style="text-align: center; font-weight: bold;">7</td>
                <td style="text-align: center; font-weight: bold;">8</td>
                <td style="text-align: center; font-weight: bold;">9</td>
                <td style="text-align: center; font-weight: bold;">10</td>
                <td style="text-align: center; font-weight: bold;">11</td>
                <td style="text-align: center; font-weight: bold;">12</td>
                <td style="text-align: center; font-weight: bold;">13</td>
                <td style="text-align: center; font-weight: bold;">14</td>
                <td style="text-align: center; font-weight: bold;">15</td>
                <td style="text-align: center; font-weight: bold;">16</td>
                <td style="text-align: center; font-weight: bold;">17</td>
                <td style="text-align: center; font-weight: bold;">18</td>
                <td style="text-align: center; font-weight: bold;">19</td>
                <td style="text-align: center; font-weight: bold;">20</td>
                <td style="text-align: center; font-weight: bold;">21</td>
            </tr>
            <tr>
                <td style="text-align: center;">$no_urut</td>
                <td style="text-align: center;">$kode_barang</td>
                <td style="text-align: center;">$register</td>
                <td style="text-align: center;">$nama_jenis_barang</td>
                <td style="text-align: center;">$merk_type</td>
                <td style="text-align: center;">$no_sertifikat</td>
                <td style="text-align: center;">$bobot</td>
                <td style="text-align: center;">$asal_cara_perolehan</td>
                <td style="text-align: center;">$tahun_bulan_perolehan</td>
                <td style="text-align: center;">$konstruksi</td>
                <td style="text-align: center;">$satuan</td>
                <td style="text-align: center;">$kondisi</td>
                <td style="text-align: center;">$awal_barang</td>
                <td style="text-align: center;">$awal_harga</td>
                <td style="text-align: center;">$berkurang_jml_barang</td>
                <td style="text-align: center;">$berkurang_jml_harga </td>
                <td style="text-align: center;">$bertambah_jml_barang</td>
                <td style="text-align: center;">$bertambah_jml_harga </td>
                <td style="text-align: center;">$akhir_barang</td>
                <td style="text-align: center;">$akhir_jml   </td>
                <td style="text-align: center;">$ket </td>
            </tr>
          </tbody>
        </table>

           <br>
           <br>
           <br>
           <br>
           <table style="text-align: left; width: 1024px; height: 90px;" border="0" cellpadding="2" cellspacing="2">
        <tbody>
            <tr>
                <td style="text-align: center;" colspan="3" width="300px">Mengetahui</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;" colspan="3" width="350px">$region , $f_tanggal&nbsp;$f_bulan&nbsp;$f_tahun</td>
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
            <br>
            <br>
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
$pdf->Output('laporanmutasibarang.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


?>
