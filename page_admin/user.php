<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <?php
        include "header.php";
     ?>   
    <script type="text/javascript" src="../JS/tabber.js"></script>
    <link rel="stylesheet" href="../css/tabber.css" TYPE="text/css" MEDIA="screen"/>
    <body>
        <table id="tabel">
             <tbody>
                 <tr>
                 <td align="center">
                    <table class="mainpage">
                         <tbody>
                            <?php
                                include "menu.php";
                            ?>
                            <tr>
                                <td class="content" align="center" height="300px" valign="top">
                                    <b><u>Users</u></b>
                                    <table align="center" border="0" cellpadding="0" cellspacing="5" width="85%">
                                        <tbody>
                                            <tr>
                                                <td class="datalist" align="left" valign="top" width="35%">
                                                    <div class="datalist_head" style="font-weight:bold; margin-top:0px; padding:3px 5px 2px 5px;" align="center">
                                                        Daftar User
                                                    </div>
                                                    <div style="padding:5px;" align="right">
                                                        <a href="http://localhost/simbada_v2/admin_ivan/operator.php" class="datalist" onmouseover="document.statusbar='';" onmouseout="">Tambah User</a>
                                                    </div>
                                                    <div style="padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;" align="left">
                                                        <a class="datalist_inlist">Administrator</a>
                                                        <a class="datalist_inlist">Tamu</a>
                                                    </div>
                                                </td>
                                                <td align="left" valign="top">
                                                    
                                                    <div class="tabber">
                                                        <div class="tabbertab">
                                                            <h2>Detail Operator</h2>
                                                            <div>
                                                                <form name="Detail_Operator" action="" method="post">
                                                                    <?php
                                                                    include '../admin_ivan/operator.php';
                                                                    ?>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="tabbertab">
                                                            <h2>Hak Akses</h2>
                                                            <div>
                                                                <form name="Hak_Akses" action="" method="post">
                                                                    <?php
                                                                    include '../admin_ivan/hak_akses.php';
                                                                    ?>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                             <?php
                             include 'footer.php';
                             ?>
                         </tbody>
                    </table>
                 </td>
                 </tr>
             </tbody>
        </table>
    </body>
</html>