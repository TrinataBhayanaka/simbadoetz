<?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="penetapan_penghapusan_daftar_kosong.php";
		  }
		}
	</script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
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
                                                            Penetapan Penghapusan
                                                    </div>
                                                            <div id="bottomright">
                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                            <tr>
                                                                                <td width="50%" align="left" style="border:0px;">
                                                                                    <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter"onclick="document.location='penetapan_penghapusan_filter.php'">
                                                                                </td>
                                                                                <td width="50%" align="right" style="border:0px;">
                                                                                    <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data" onclick="window.location='penetapan_penghapusan_tambah.php'">
                                                                                </td>
                                                                            </tr>
                                                                    </table>
                                                                    <table class="listdata" width="100%" border="1"cellpadding="0" cellspacing="0"style="padding:2px; margin-top:0px; border: 1px solid #cccccc; border-width: 0px 1px 0px 1px;border-collapse:collapse;">
                                                                            <tr>
                                                                                <th align="center" width="40px" >No</th>
                                                                                <th align="center" width="170px" >Nomor Penghapusan</th>
                                                                                <th align="center" width="150px" >Tgl Penghapusan</th>
                                                                                <th align="center" width="%" >Detail Penghapusan</th>
                                                                                <th align="center" width="85px">Tindakan</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" colspan="5"
                                                                                    style="padding:15px 5px 10px 5px; color: #cc3333; font-weight: bold;">..:: Tidak ada data ::..</td>
                                                                            </tr>
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
