<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 11;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

?>

<html>
    <?php
        include "$path/header.php";
    ?>
    
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Validasi data ?");
		if (r==true)
		  {
		  alert("Data sudah tervalidasi");
		  document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>gudang_validasi_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>gudang_validasi_daftar.php";
		  }
		}
	</script>
        <body>
            <div id="content">
                    <?php
                        include "$path/title.php";
                        include "$path/menu.php";
                    ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Validasi Barang
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/perolehan/"; ?>validasi.php";><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    List Preview : <a href="#"><input type="submit" value="Cetak Seluruh Data"></a>
                                    <a href="#"><input type="submit" value="Cetak dari Daftar Anda"></a>
                                </div>
                                
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/perolehan/validasi.php"; ?>">
                                <table  width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;" cellspacing="6">
                                    <tbody>
                                        <tr>
                                            <td colspan=3><p style="float:left;"><a href="#"><u>Pilih halaman ini</u></a>&nbsp;&nbsp;<a href="#"><u>Kosongkan Halaman Ini</u></a>&nbsp;&nbsp;<a href="#"><u>Bersihkan semua pilihan</u></a></p>
                                                
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="100px" align="left" style="border: 1px solid #004933;" colspan="2">&nbsp;Informasi Aset</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">1</td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                                                <input type="checkbox" name="penggu_validasi[]" value="48875 <br> 99.02.23.1.XX.00 - 02.02.03.01.02.0001 <br>mobil" required="required">
                                            </td>
                                            <td align="left" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                                                <table width="100%" cellspacing="6">
                                                    <tr>
                                                        <td>48775 ( Aset ID - System NUmber )</td><td><p style="float:right;"><input type="submit" name="submit" value="Validasi Barang" <!--onclick="show_confirm()"--></p></td>
                                                    </tr>
                                                    <tr>
                                                        <td>12.02.23.1.XX.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>02.02.03.01.02.0001</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobil</td>
                                                    </tr>
                                                    <tr>
                                                        <td><hr></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table width="50%" cellspacing="6">
                                                                <tr>
                                                                    <td rowspan=4 style="border:1px solid grey; border-width:1px 1px 1px 1px;">...</td>
                                                                    <td>No. Kontrak</td>
                                                                    <td>-</td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Satker</td>
                                                                    <td>[1] - Sekretariat Daerah</td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Lokasi</td>
                                                                    <td>Tidak ada keterangan lokasi</td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Status</td>
                                                                    <td>BAST</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="100px" align="left" style="border: 1px solid #004933;" colspan="2">&nbsp;Informasi Aset</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td colspan=3><p style="float:left;"><a href="#"><u>Pilih halaman ini</u></a>&nbsp;&nbsp;<a href="#"><u>Kosongkan Halaman Ini</u></a>&nbsp;&nbsp;<a href="#"><u>Bersihkan semua pilihan</u></a></p>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	


