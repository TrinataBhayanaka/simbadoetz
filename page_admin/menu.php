
<?php
// $NAMA_KABUPATEN = $nama_kab;
$data_admin = $RETRIEVE_ADMIN->admin_retrieve_app_conf($NAMA_KABUPATEN);
//print_r($data_admin);
?>
<div>    
<table style="width:100%">                            
                            <tr>
                                <td class="header" style="padding: 5px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td class="gambar"><img src="<?php echo "$url_rewrite/page_admin/css/$data_admin->app_admin_logo"?>" style="padding-right:20px;" /></td>
                                                    <td style="width: 100%;" align="center">
                                                        <div class="titlepage"><?php echo "$data_admin->app_admin_title"?></div>
                                                        <b>Halaman Admin</b>
                                                    </td>
                                                    <td><img src="css/brr.gif" /></td>
                                                    <td><img src="css/logo_aplikasi.png" height="75px"/></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="menubar" style="padding: 3px 0px;" align="left">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td align="left">
<!--
                                                    <a class="menubar" href="<?php echo $url_rewrite;?>">Home</a> -
                                                    <a class="menubar<?php if ($_GET['page']==1) echo '_selected'?>" href="?page=1">Menu Admin</a>
                                                    <a class="menubar<?php if ($_GET['page']==2) echo '_selected'?>" href="?page=2&p=d&a=1">Kelompok Jabatan</a>
                                                    <a class="menubar<?php if ($_GET['page']==3) echo '_selected'?>" href="?page=3&p=d&a=1">Users</a>
                                                    <a class="menubar<?php if ($_GET['page']==4) echo '_selected'?>" href="?page=4">SKPD</a>
                                                    <a class="menubar<?php if ($_GET['page']==5) echo '_selected'?>" href="?page=5">NGO</a>
                                                    <a class="menubar<?php if ($_GET['page']==6) echo '_selected'?>" href="?page=6">Pejabat SKPD</a>
                                                    <a class="menubar<?php if ($_GET['page']==7) echo '_selected'?>" href="?page=7">Kode Barang</a>   
                                                        <a class="menubar<?php if ($_GET['page']==8) echo '_selected'?>" href="?page=8">Kode Rekening</a>   
                                                    <a class="menubar<?php if ($_GET['page']==9) echo '_selected'?>" href="?page=9">Pejabat Daerah</a>
                                                    <a class="menubar<?php if ($_GET['page']==10) echo '_selected'?>" href="?page=10">Setting Tampilan</a>
                                                    <a class="menubar<?php if ($_GET['page']==11) echo '_selected'?>" href="?page=11">Setting Reporting</a>
-->
<div>
 <ul class="menu">
        <li><a href="<?php echo $url_rewrite;?>">Home</a></li>
        <li><a href="?page=1">Menu Admin</a></li>
	<li><a href="#">Akun</a>
            <ul><!--
                <li><a href="#">Movie</a>
                            
                    <ul>
                    <li><a href="#">Animation</a></li>
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Comedy</a></li>
                    </ul>
                </li>-->
                <li><a href="?page=2&p=d&a=1">Kelompok Jabatan</a></li>
                <li><a href="?page=3&p=d&a=1">Users</a></li>
        	</ul>
        </li>
        <li><a href="#">Satker</a>
        	<ul>
                <li><a href="?page=4">SKPD</a></li>
                <li><a href="?page=5">NGO</a></li>
                
        	</ul>
        </li>
        <li><a href="#">Kode</a>
        	<ul>
                <li><a href="?page=7">Kode Barang</a></li>
                <li><a href="?page=8">Kode Rekening</a></li>
                
        	</ul>
        </li>
        <li><a href="#">Pejabat</a>
        	<ul>
                <li><a href="?page=6">Pejabat SKPD</a></li>
                <li><a href="?page=9">Pejabat Daerah</a></li>
                
        	</ul>
        </li>
        <li><a href="#">Pengaturan</a>
        	<ul>
                <li><a href="?page=10">Aplikasi</a></li>
                <!--<li><a href="?page=11">Report</a></li>-->
                <li><a href="?page=12">Halaman Admin</a></li>
                <li><a href="?page=13">Lokasi</a></li>
        	</ul>
        </li>
        <li><a href="?page=14">News Update</a></li>
        <!-- <li><a href="?page=15">Activity User</a></li> -->
</ul>
</div>
                                                </td>
                                                <td style="padding-right: 0px;" align="right">
                                                    <!--<b class="username_label"><?php echo $user_ses['ses_anamaoperator']?></b>-->
                                                    <a href="../logout.php?atoken=<?php echo str_shuffle('abcerjfrj1256')?>" class="menubar" title="Logout">[Logout]</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
</table>
</div>
<div style="border-style:none; padding: 0px 5px 0px 10px;" align="left">
<table border="0" width="100%">
<td>
<?php
$direktory_active = $RETRIEVE_ADMIN->retrieve_admin_get_page_active($_GET['page'], $_GET['p']);


echo "<p style='font-size:12px;'>Direktori Anda ::. $direktory_active</p>";
?>
                            
</td>
<td width="40%" align="right">
    <p style="font-size: 12px;">Selamat Datang : <b class="username_label"><?php echo $user_ses['ses_anamaoperator']?></b></p>                        
</td>
</table>

</div>
