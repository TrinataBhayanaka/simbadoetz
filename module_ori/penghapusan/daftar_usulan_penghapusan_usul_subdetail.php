<?php
 include "../../config/config.php";
    include"$path/header.php";
   include"$path/title.php";
?>
<html>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  document.location="daftar_usulan_penghapusan_ok.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="daftar_usulan_penghapusan_usul.php";
		  }
		}
	</script>
	
	<body>
	<div id="content">
		<?php
                                        include"$path/menu.php";
                                    ?>
                  </div>
			
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Buat Usulan Penghapusan
                                                </div>
                                                        <div id="bottomright">
                                                                <table width="100%" height="3%" border="1" style="border-collapse:collapse;">
                                                                        <div style="padding:5px;">
                                                                            <tr>
                                                                                    <td colspan="2" style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;text-decoration:underline;">Daftar Aset yang di usulkan untuk di hapus:</td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;">
                                                                                            <table width="100%">
                                                                                                <tr>
                                                                                                    <td width='10%'>1.</td>
                                                                                                    <td width='30%'><span style="font-weight:bold;">99.02.23.1.XX.1 - 02.03.01.02.02.0001</span><br> Mobil</td>
                                                                                                    <td align="right" style="border-style:none;"> <input type="button" value="Tutup Detail" onclick="window.location='daftar_usulan_penghapusan_usul.php'">		
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <div style="width:100%; height:200px; overflow:auto; border:1px solid #dddddd;">
                                                                                            <table width="100%">
                                                                                                <tr>
                                                                                                    <td width="45px"><input type="text" value="99" readonly="readonly" size="1%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                    <td width="7%"><input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                    <td width="160px"><input type="text" value="02.03.01.02.02" readonly="readonly" style="text-align:center; font-weight:bold;">-</td>
                                                                                                    <td><input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;"></td>
                                                                                                    <td align="right"><input type="button" value="Tutup Sub Detail" onclick="window.location='<?php echo "$url_rewrite";?>/module/penghapusan/daftar_usulan_penghapusan_usul_detail.php'"></td>
                                                                                                </tr>
                                                                                            </table>
                                                                                            <table width="100%" height="3%" border="1" style="border-collapse:collapse;">
                                                                                                    <tr>
                                                                                                            <td>
                                                                                                                    <table width="100%">
                                                                                                                        <tr>
                                                                                                                            <td width="15%">Nama Aset</td>
                                                                                                                            <td style="font-weight:bold;">Mobil</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Satuan Kerja</td>
                                                                                                                            <td style="font-weight:bold;">Biro Hukum dan Humas</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Jenis Barang</td>
                                                                                                                            <td style="font-weight:bold;">Bicro Bus (Penumpang 15 - 30 orang)</td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td colspan="2"><hr /></td></tr>
                                                                                                                        <tr><td colspan="2" style="background-color:#eeeeee;">Informasi Tambahan</td></tr>
                                                                                                                        <tr>
                                                                                                                            <td>Nomor Kontrak</td>
                                                                                                                            <td><input type="text" value="-" readonly="readonly" name="bup_it_get_nokontrak"></td>
                                                                                                                        <tr>
                                                                                                                            <td><td>Tidak ada informasi</td></td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Operasional/Program</td>
                                                                                                                            <td>
                                                                                                                                 <select name="bup_it_get_asetOpr">
                                                                                                                                    <option></option>
                                                                                                                                    <option selected="selected">Program</option>
                                                                                                                                    <option>Operasional</option>
                                                                                                                                </select>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Kuantitas</td>
                                                                                                                            <td><input type="text" name="bup_it_get_kuantitas" value="1" size="2"> Satuan <input type="text" name="bup_it_get_satuan" value="unit"></td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Cara Perolehan</td>
                                                                                                                            <td>
                                                                                                                                <select name="bup_it_get_perolehan">
                                                                                                                                    <option>-</option>
                                                                                                                                    <option>Pengadaan</option>
                                                                                                                                    <option>Hibah</option>
                                                                                                                                </select>
                                                                                                                            </td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Tanggal Perolehan</td>
                                                                                                                            <td><input type="text" name="bup_it_get_tanggal" readonly="readonly"></td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Nilai Perolehan</td>
                                                                                                                            <td><input type="text" value="0" style="text-align:right" name="bup_it_get_nilai" readonly="readonly"></td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Alamat</td>
                                                                                                                            <td><textarea cols="130" name ="bup_it_get_alamat"rows="2"></textarea></td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td></td>
                                                                                                                            <td>RT/RW <input type="text" name="bup_it_get_rtrw " readonly="readonly" size="3"></td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Lokasi</td>
                                                                                                                            <td><input type="text" readonly="readonly" name="bup_it_get_lokasi" size="100"> <input type="button" value="Cari Lokasi" disabled="disabled"></td>
                                                                                                                        </tr>
                                                                                                                        <tr>
                                                                                                                            <td>Koordinat</td>
                                                                                                                            <td>Bujur Lintang</td>
                                                                                                                        </tr>
                                                                                                                        </tr>
                                                                                                                    </table>
                                                                                                            </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                        </div>
                                                                                    </td>
                                                                            </tr>
                                                                    </div>
                                                                </table>
                                                                <br>
                                                                <table width="100%" height="3%" border="1" style="border-collapse:collapse;">
                                                                    <div style="padding:5px;">
                                                                        <tr>
                                                                                <td colspan="2" style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;text-decoration:underline;">Usulan Penghapusan Aset</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;"> <input type='button' value='Usulan Penghapusan' onclick="show_confirm()"> 
                                                                                <input type='button' value='Batal' onclick="window.location='<?php echo "$url_rewrite";?>/module/penghapusan/daftar_usulan_penghapusan_lanjut.php'"style="width:100px";></th>
                                                                        </tr>
                                                                     </div> 
                                                                </table>
                                             </div>
                                        </div>
                                </div>
                        </div>
                
        <?php
            include"$path/footer.php";
        ?>
</body>
</html>	
