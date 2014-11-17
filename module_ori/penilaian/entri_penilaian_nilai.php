<?php ob_start();?>
<html>
	<?php
        include "../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
        ?>
    
	<body>
            <?php
            include "$path/menu.php";
            ?>
	
            <div id="tengah1">	
            <div id="frame_tengah1">
            <div id="frame_gudang">
            <div id="topright">Entri Hasil Penilaian</div>
            <div id="bottomright">
                
<table width="100%" height="4%">

    <tr>
        <td width='5%'></td>
        <td>Aset ID : <span style="font-weight:bold;">48774</span></td>
    </tr>
    <tr>
        <td></td>
        <td width='30%'><span style="font-weight:bold;">99.02.23.1.XX.1 - 02.03.01.02.02.0001</span><br>Mobil</td>
        <td align="right"><input type='button' value='Lihat Info' onclick="window.location='entri_penilaian_info.php'"></td>
    </tr>
</table>
<br>

    <span style="border:1px solid #cccccc; padding-left:5px; padding-right:5px; color: #999999; border-bottom: 1px solid #ffffff;"><b>Daftar Penilaian</b></span>&nbsp;<span class="listdata" style="padding-left:5px; padding-right:5px; cursor:pointer;"><a href="entri_penilaian_nilai_baru.php" style="font-weight:bold;">Data Baru</a></span>&nbsp;  <div id="div_datapenilaian">
<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">

    <tr>
        <td align="center" style="padding:15px; font-size:12pt; color:#003c2a; font-weight: bold;">... tidak ada data ...</td>
    </tr>
</table>

            </div>
        </div>
    </div>
</div>
</div>
            
        <?php
        include "$path/footer.php";
        ?>
	</body>
</html>	
