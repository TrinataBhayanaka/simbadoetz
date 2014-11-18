
<body onload="document.table.reset()">

<table>
<tr>
	<td>Jenis Barang<br>
		
        <input type="hidden" name="inv_ldahi_goltanah_jenis_barang" id="inv_ldahi_goltanah_jenis_barang" value="">
        <input type="text" name="inv_ldahi_goltanah_jenis_barang_1" id="inv_ldahi_goltanah_jenis_barang_1"
        style="width:480px;"
        readonly="readonly"
        value="">
        <input type="button" name="inv_ldahi_goltanah_jenis_barang_2" id="inv_ldahi_goltanah_jenis_barang_2"
        value="Pilih"
        onclick = "showSpoiler(this);">
        <div class="inner" style="display:none;">
        
        
        <style>
        .tabel th {
        background-color: #eeeeee;
        border: 1px solid #dddddd;
        }
        .tabel td {
        border: 1px solid #dddddd;
        }
        </style>

        
        
<div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
<table width="100%" align="left" border="0" class="tabel">
        
        <tr>
        <th align="left" border="0" nowrap colspan="3">
        <input type="text" id="kelompok_search" style="width: 70%;" value="">
        <input type="button" id="kelompok_btn_search" value="Cari" onclick="search_child( 'kelompok', '&prefix=kelompok&tag=' )">
        </th>
        </tr>
        <tr id="kelompok_row_">

        <th width="100px">&nbsp;</th>
        <th width="150px"align="center"><b>Kode</b></th>
        <th width="500px" align="left"><b>Nama</b></th>
        </tr>
        <tr id="zzzzzzzzzz">
        <td colspan="3" id="kelompok_data"></td>
        </tr>
</div>
</div>

<tr> 
    <td width=1>[ + ]</td>
    <td class=Item><a href=./ class=Item onClick="processTree (12); return false;" STYLE="text-decoration: none">01</a></td>
    <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (12); return false;">GOLONGAN TANAH</a></td>
  </tr>
<tr id='sub_0_1' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (13); return false;">01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (13); return false;">TANAH</a></td>
  </tr>

<tr id='sub_0_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (14); return false;">01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (14); return false;">PERKAMPUNGAN</a></td>
  </tr>
<tr id='sub_0_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (15); return false;">01.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (15); return false;">Kampung</a></td>
  </tr>

<tr id='sub_0_1_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age1" value="No" class="aboveage1"></td>
<td width=149 height=20 class=SubItem>01.01.01.01.01</td>
    <td width=149 height=20 class=SubItem>Kampung</td>
  </tr>

<tr id='sub_0_1_1_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age1" value="No" class="aboveage1"></td>
<td width=149 height=20 class=SubItem>01.01.01.01.02</td>
    <td width=149 height=20 class=SubItem>Lain Lain</td>
  </tr>  
  
<tr id='sub_0_1_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem>01.01.01.02</td>
    <td width=149 height=20 class=SubItem>Emplasmen</td>
  </tr>

<tr id='sub_0_1_1_3' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem>01.01.01.03</td>
    <td width=149 height=20 class=SubItem>Kuburan</td>
  </tr>

<tr id='sub_0_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (16); return false;">01.01.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (16); return false;">TANAH PERTANIAN</a></td>
  </tr>

<tr id='sub_0_1_2_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem>01.01.02.01</td>
    <td width=149 height=20 class=SubItem>Sawah Satu Tahun Di Tanami</td>
  </tr>

<tr id='sub_0_1_2_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem>01.01.02.02</td>
    <td width=149 height=20 class=SubItem>Tegalan</td>
  </tr>

<tr id='sub_0_1_2_3' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem>01.01.02.03</td>
    <td width=149 height=20 class=SubItem>Ladang</td>
  </tr>

<tr> 
    <td width=1>[ + ]</td>
    <td class=Item><a href=./ class=Item onClick="processTree (17); return false;" STYLE="text-decoration: none">02</a></td>
    <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (17); return false;">GOLONGAN PERALATAN DAN MESIN</a></td>
  </tr>
  
<tr id='sub_2_1' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (18); return false;">02.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (18); return false;">ALAT-ALAT BESAR</a></td>
  </tr>

<tr id='sub_2_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (19); return false;">02.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (19); return false;">ALAT-ALAT BESAR DARAT</a></td>
  </tr>

<tr id='sub_2_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (20); return false;">02.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (20); return false;">Tractor</a></td>
  </tr>

<tr id='sub_2_1_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age2" value="No" class="aboveage2"></td>
<td width=149 height=20 class=SubItem>02.01.01.01.01</td>
    <td width=149 height=20 class=SubItem>Crawler Tractor</td>
  </tr>

<tr id='sub_2_1_1_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age2" value="No" class="aboveage2"></td>
<td width=149 height=20 class=SubItem>02.01.01.01.02</td>
    <td width=149 height=20 class=SubItem>Wheel Tractor</td>
  </tr>    

<tr id='sub_2_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (18); return false;">02.01.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (18); return false;">ALAT-ALAT BESAR APUNG</a></td>
  </tr>    

<tr id='sub_2_2' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (17); return false;">02.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (17); return false;">ALAT-ALAT ANGKUTAN</a></td>
  </tr>

<tr> 
    <td width=1>[ + ]</td>
    <td class=Item><a href=./ class=Item onClick="processTree (21); return false;" STYLE="text-decoration: none">03</a></td>
    <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (21); return false;">GOLONGAN GEDUNG DAN BANGUNAN</a></td>
  </tr>  

<tr id='sub3_1' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (22); return false;">03.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (22); return false;">BANGUNAN GEDUNG</a></td>
  </tr>

<tr id='sub3_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (23); return false;">03.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (23); return false;">BANGUNAN GEDUNG TEMPAT KERJA</a></td>
  </tr>

<tr id='sub3_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (24); return false;">03.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (24); return false;">Bangunan Gedung Kantor</a></td>
  </tr>

<tr id='sub3_1_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age3" value="No" class="aboveage3"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (24); return false;">03.01.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (24); return false;">Bangunan Gedung Kantor Permanen</a></td>
  </tr>  

<tr id='sub3_1_1_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age3" value="No" class="aboveage3"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (24); return false;">03.01.01.01.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (24); return false;">Bangunan Gedung Kantor Semi Permanen</a></td>
  </tr>  
  
<tr id='sub3_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (22); return false;">03.01.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (22); return false;">BANGUNAN GEDUNG TEMPAT TINGGAL</a></td>
  </tr>  
  
<tr id='sub3_2' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (22); return false;">03.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (22); return false;">BANGUNAN MONUMEN</a></td>
  </tr>  

<tr> 
    <td width=1>[ + ]</td>
    <td class=Item><a href=./ class=Item onClick="processTree (25); return false;" STYLE="text-decoration: none">04</a></td>
    <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (25); return false;">GOLONGAN JALAN, IRIGASI DAN JARINGAN</a></td>
  </tr>   

<tr id='sub4_1' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (26); return false;">04.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (26); return false;">JALAN DAN JEMBATAN</a></td>
  </tr>

<tr id='sub4_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (27); return false;">04.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (27); return false;">JALAN</a></td>
  </tr>  
  
<tr id='sub4_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (28); return false;">04.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (28); return false;">Jalan Negara / Nasional</a></td>
  </tr>
  
<tr id='sub4_1_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age4" value="No" class="aboveage4"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (28); return false;">04.01.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (28); return false;">Jalan Negara / Nasional Kelas I</a></td>
  </tr>

<tr id='sub4_1_1_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age4" value="No" class="aboveage4"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (28); return false;">04.01.01.01.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (28); return false;">Jalan Negara / Nasional Kelas II</a></td>
  </tr>

<tr> 
    <td width=1>[ + ]</td>
    <td class=Item><a href=./ class=Item onClick="processTree (29); return false;" STYLE="text-decoration: none">05</a></td>
    <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (29); return false;">GOLONGAN ASSET TETAP LAINNYA</a></td>
  </tr> 

<tr id='sub5_1' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (30); return false;">05.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (30); return false;">BUKU PERPUSTAKAAN</a></td>
  </tr>
  
<tr id='sub5_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (31); return false;">05.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (31); return false;">BUKU</a></td>
  </tr>

<tr id='sub5_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (32); return false;">05.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (32); return false;">Umum</a></td>
  </tr>

<tr id='sub5_1_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age5" value="No" class="aboveage5"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (32); return false;">05.01.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (32); return false;">Ilmu Pengetahuan Umum</a></td>
  </tr>

<tr id='sub5_1_1_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age5" value="No" class="aboveage5"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (32); return false;">05.01.01.01.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (32); return false;">Bibliografi, Katalog</a></td>
  </tr> 

<tr> 
    <td width=1>[ + ]</td>
    <td class=Item><a href=./ class=Item onClick="processTree (33); return false;" STYLE="text-decoration: none">06</a></td>
    <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (33); return false;">GOLONGAN KONSTRUKSI DALAM PENGERJAAN</a></td>
  </tr> 

<tr id='sub6_1' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (34); return false;">06.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (34); return false;">Konstruksi Dalam Pengerjaan</a></td>
  </tr>
  
<tr id='sub6_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (35); return false;">06.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (35); return false;">Konstruksi Dalam Pengerjaan</a></td>
  </tr>

<tr id='sub6_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (36); return false;">06.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (36); return false;">Konstruksi Dalam Pengerjaan</a></td>
  </tr>

<tr id='sub6_1_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age6" value="No" class="aboveage6"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (36); return false;">06.01.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (36); return false;">Konstruksi Dalam Pengerjaan</a></td>
  </tr>
 
<tr> 
    <td width=1>[ + ]</td>
    <td class=Item><a href=./ class=Item onClick="processTree (37); return false;" STYLE="text-decoration: none">07</a></td>
    <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (37); return false;">GOLONGAN PERSEDIAAN</a></td>
  </tr> 

<tr id='sub7_1' class=SubItemRow> 
    <td width=1>&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (38); return false;">07.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (38); return false;">PERSEDIAAN</a></td>
  </tr>
  
<tr id='sub7_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (39); return false;">07.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (39); return false;">Alat Tulis Kantor</a></td>
  </tr>

<tr id='sub7_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;[ + ]</td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (40); return false;">07.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (40); return false;">Alat Tulis Kantor</a></td>
  </tr>

<tr id='sub7_1_1_1_1' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age7" value="No" class="aboveage7"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (40); return false;">07.01.01.01.01</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (40); return false;">Amplop</a></td>
  </tr>
  
<tr id='sub7_1_1_1_2' class=SubItemRow> 
    <td width=1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="age7" value="No" class="aboveage7"></td>
<td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (40); return false;">07.01.01.01.02</a></td>
    <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (40); return false;">Buku</a></td>
  </tr>  

 
<tr><td colspan="3"></td></tr>

	
        </table>
	
        </td>
        </tr>
</table>

<table border=0>	
                <tr>
                        <td>Jenis Aset</td>
                        <td>Bersejarah</td>
                </tr>
                <tr>
                        <td>
                                <select id="inv_ldahi_jenis_aset" name="inv_ldahi_jenis_aset" readonly="readonly">
                                        <option value="" readonly="readonly">Operasional</option>
                                <option value="" readonly="readonly">Program</option>
                                <option value="" readonly="readonly">-</option>
                </select>

                            </td> 
                        <td>
                <select id="inv_ldahi_bersejarah" name="inv_ldahi_bersejarah" readonly="readonly">
                <option value="" readonly="readonly">Tidak Bersejarah</option>
                <option value="" readonly="readonly">Bernilai Sejarah</option>    
                </select>
                        </td>
                </tr>
        </table>


<ol id="parent1" class="formset">
<?php
include "gol1.php";
?>
</ol>

<ol id="parent2" class="formset">
<?php
include "gol2.php";
?>
</ol>

<ol id="parent3" class="formset">
<?php
include "gol3.php";
?>
</ol>

<ol id="parent4" class="formset">
<?php
include "gol4.php";
?>
</ol>

<ol id="parent5" class="formset">

<?php
include "gol5_buku.php";
?>
</ol>

<ol id="parent6" class="formset">
<?php
include "gol6.php";
?>
</ol>

<ol id="parent7" class="formset">
<?php
include "gol7.php";
?>
</ol>

</body>
