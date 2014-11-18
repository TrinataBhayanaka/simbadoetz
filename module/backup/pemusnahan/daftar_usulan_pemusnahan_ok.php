<?php
        include "../../config/config.php";


        $menu_id = 46;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        /*
        $nmaset=$_POST['pemusnahan_usul_nama_aset'];
        $UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
        
        
        $data = $STORE->store_usulan_pemusnahan(
                $UserNm,
                $nmaset,
                $usulan_id,
                $date,
                $ses_uid
                );
        */
        
        /*
        $asset_id=Array();
        $no_reg=Array();
        $nm_barang=Array();

        $panjang=count($nmaset);
        

        $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                            Jenis_Usulan, UserNm, TglUpdate, 
                                            GUID, FixUsulan) 
                                        values ('', '', '', 'MSN', '$UserNm', '$date', '', '1')";

        $result=  mysql_query($query) or die(mysql_error());

        for($i=0;$i<$panjang;$i++){

            $tmp=$nmaset[$i];
            $tmp_olah=explode("<br>",$tmp);
            $asset_id[$i]=$tmp_olah[0];
            $no_reg[$i]=$tmp_olah[1];
            $nm_barang[$i]=$tmp_olah[2];

            $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','MSN','0')";
            $result=  mysql_query($query1) or die(mysql_error());

            $query3="UPDATE Aset SET Usulan_Pemusnahan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
            $result3=mysql_query($query3) or die(mysql_error());

            
            //lanjut dari sinii
            $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
            $result2=mysql_query($query2) or die(mysql_error());
        }
        
        $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='PemusnahanUsul' AND UserSes='$_SESSION[ses_uid]'";
        $exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
         * 
         */
        //echo "<script>alert('Data Sudah Diusulkan.. !!!');</script>";
?>
<html>
    <?php
        include "$path/header.php";
    ?>
                 <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                        <?php
                                include "$path/title.php";
                                include"$path/menu.php";
                        ?>
	</div>
                        <div id="tengah1">
                               <div id="frame_tengah1">
                                    <div id="frame_gudang">
                                            <div id="topright">
                                                    Buat Usulan Pemusnahan
                                            </div>
                                                    <div id="bottomright">
                                                        
                                                        <table width="100%">
                                                            <tr>
                                                                <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Aset yang baru saja diusulkan untuk pemanfaatan:</u></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                                                    <table width="100%">
                                                                        <?php
                                                                            $usulan_id=$_GET['usulan_id'];
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan=4 style="color:red; font-weight:bold;">No. Usulan Pemusnahan : <?php echo "$usulan_id";?></td>
                                                                        </tr>
                                                                        <?php
                                                                        
                                                                        /*
                                                                                $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$usulan_id'";
                                                                                $exec=  mysql_query($query) or die(mysql_error());
                                                                                $i=1;
                                                                            // $row=mysql_fetch_array($exec);

                                                                                while($row=mysql_fetch_array($exec)){
                                                                         * 
                                                                         */
                                                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                                                        $parameter = array('menuID'=>$menu_id,'usulan_id'=>$usulan_id,'paging'=>$paging);
                                                                        $data = $RETRIEVE->retrieve_usulan_pemusnahan_eksekusi_tampil($parameter);
                                                                        
                                                                        $i=1;
                                                                        foreach($data['dataArr'] as $key => $row){ 
                                                                        ?>
                                                                        <tr>
                                                                            <td valign="top"><?php echo "$i.";?></td>
                                                                            <td colspan=3>
                                                                            <?php echo "$row[Aset_ID]";?><br/><?php echo "$row[NomorReg]";?><br/><?php echo "$row[NamaAset]";?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=4><hr/></td>
                                                                        </tr>
                                                                        <?php $i++; } ?>
                                                                        <tr>
                                                                            <td colspan=4>
                                                                                <hr>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=4 align=center>
                                                                                <a href="<?php echo "$url_rewrite/report/template/PEMUSNAHAN/tes_class_barang_untuk_dimusnahkan.php?id=$usulan_id&menu_id=46&mode=1";?>" target="_blank"><input type="submit" name="submit1" value="Cetak Daftar Usulan Pemanfaatan"></a>
                                                                                <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_filter.php"><input type="submit" name="submit2" value="Kembali ke Menu Utama"></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=4><hr></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
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
