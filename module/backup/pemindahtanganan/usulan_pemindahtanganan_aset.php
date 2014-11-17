<?php
    include "../../config/config.php";
    include"$path/header.php";
    include"$path/title.php";
   
$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

	    
/*
        $UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
        $nmaset=$_POST['pemindahtanganan_usul_nama_aset'];
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
        
        $dataArr = $STORE->store_usulan_pemindahtanganan(
                $UserNm,
                $nmaset,
                $usulan_id,
                $date,
                $ses_uid
                );
 * 
 */
        
        /*
        $asset_id=Array();
        $no_reg=Array();
        $nm_barang=Array();

        $panjang=count($nmaset);
         * 
         */
        
        /*
        $peman_penet_bmd_eks_ket=$_POST['peman_penet_bmd_eks_ket'];	
        $peman_penet_bmd_eks_nopenet=$_POST['peman_penet_bmd_eks_nopenet'];	
        $peman_penet_bmd_eks_tglpenet=$_POST['peman_penet_bmd_eks_tglpenet'];	
        $olah_tgl=  format_tanggal_db2($peman_penet_bmd_eks_tglpenet);
        */
        
        /*
        $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                            Jenis_Usulan, UserNm, TglUpdate, 
                                            GUID, FixUsulan) 
                                        values ('', '', '', 'PDH', '$UserNm', '$date', '$SessionUser[ses_uid]', '1')";

        $result=  mysql_query($query) or die(mysql_error());

        for($i=0;$i<$panjang;$i++){

            $tmp=$nmaset[$i];
            $tmp_olah=explode("<br>",$tmp);
            $asset_id[$i]=$tmp_olah[0];
            $no_reg[$i]=$tmp_olah[1];
            $nm_barang[$i]=$tmp_olah[2];

            $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','PDH','0')";
            $result=  mysql_query($query1) or die(mysql_error());

            $query3="UPDATE Aset SET Usulan_Pemindahtanganan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
            $result3=mysql_query($query3) or die(mysql_error());

            
            //lanjut dari sinii
            $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
            $result2=mysql_query($query2) or die(mysql_error());
        }
        
        $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='Usulan_Pemindahtanganan' AND UserSes='$_SESSION[ses_uid]'";
        $exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
        */
        //echo "<script>alert('Data Sudah Diusulkan.. !!!');</script>";
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
		  document.location="distribusi_barang_filter.php";
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
                                                        Buat Usulan Pemindahtanganan
                                                </div>
                                                        <div id="bottomright">
                                                            <u style="font-weight:bold">Aset yang baru saja diusulkan untuk dipindahtangankan:</u><br><br>
                                                                <?php
                                                                    $usulan_id=$_GET['usulan_id'];
                                                                ?>
                                                                <span style="color:red;">No. Usulan Pemindahtanganan : <?php echo $usulan_id?></span>
                                                                
                                                                        <table width="99%" border='2' style="border-collapse:collapse; border:2px solid #dddddd;">
                                                                           <?php
                                                                                unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                                                                $parameter = array('menuID'=>$menu_id,'usulan_id'=>$usulan_id,'paging'=>$paging);
                                                                                $data = $RETRIEVE->retrieve_usulan_pemindahtanganan_eksekusi($parameter);
                                                                                /*
                                                                                $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$usulan_id'";
                                                                                $exec=  mysql_query($query) or die(mysql_error());
                                                                                $i=1;
                                                                                 * 
                                                                                 */
                                                                            // $row=mysql_fetch_array($exec);
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
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td colspan=2><!--Mobil--></td>
                                                                        </tr>
                                                                        <?php $i++; } ?>
                                                                                
                                                                            <tr>
                                                                            <td colspan=4>
                                                                                <hr>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=4 align=center>
                                                                                <a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/tes_class_usulan_aset_yang_akan_dipindahtangankan.php?menu_id=42&mode=1&id=$usulan_id";?>"  target="_blank"><input type="submit" name="submit1" value="Cetak Daftar Usulan Pemindahtanganan"/></a>
                                                                                <a href="<?php echo "$url_rewrite/module/pemindahtanganan/pemindahtanganan.php";?>"><input type="submit" name="submit2" value="Kembali ke Menu Utama"/></a>
                                                                                <!--<input type="hidden" name="id" value="<?php echo "$usulan_id";?>"/>-->
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=4><hr></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
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
