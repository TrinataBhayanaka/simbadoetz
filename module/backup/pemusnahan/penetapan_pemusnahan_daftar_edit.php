<?php
    include "../../config/config.php";
    include"$path/header.php";
    include"$path/title.php";
    
    $menu_id = 47;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
   
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                    <script>
                        $(function()
                        {
                        $('#tanggal1').datepicker($.datepicker.regional['id']);
                        $('#tanggal2').datepicker($.datepicker.regional['id']);
                        $('#tanggal3').datepicker($.datepicker.regional['id']);
                        $('#tanggal4').datepicker($.datepicker.regional['id']);
                        $('#tanggal5').datepicker($.datepicker.regional['id']);
                        $('#tanggal6').datepicker($.datepicker.regional['id']);
                        $('#tanggal7').datepicker($.datepicker.regional['id']);
                        $('#tanggal8').datepicker($.datepicker.regional['id']);
                        $('#tanggal9').datepicker($.datepicker.regional['id']);
                        $('#tanggal10').datepicker($.datepicker.regional['id']);
                        $('#tanggal11').datepicker($.datepicker.regional['id']);
                        $('#tanggal12').datepicker($.datepicker.regional['id']);
                        $('#tanggal13').datepicker($.datepicker.regional['id']);
                        $('#tanggal14').datepicker($.datepicker.regional['id']);
                        $('#tanggal15').datepicker($.datepicker.regional['id']);
                        }
                        );
                    </script>   
                    
                    
                    <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
                    
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
                                                            Penetapan Pemusnahan
                                                    </div>
                                                            <div id="bottomright">
                                                                    <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_daftar_edit_proses.php">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dimusnahkan :</u></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                                                                <table width="100%">
                                                                                    <?php 
                                                                                    
                                                                                    $id=$_GET['id'];
                                                                        
                                                                                    if (isset($id))
                                                                                    {
                                                                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                                                                        $parameter = array('id'=>$id);
                                                                                        $data = $RETRIEVE->retrieve_penetapan_pemusnahan_edit_data($parameter);
                                                                                    }
                                                                                    /*
                                                                                        $id=$_GET['id'];
                                                                                        $query="SELECT a.NoBAPemusnahan, a.TglBAPemusnahan, b.Aset_ID, c.NamaAset, c.NomorReg
                                                                                                        FROM BAPemusnahan a, BAPemusnahanAset b, Aset c
                                                                                                        WHERE a.BAPemusnahan_ID ='$id'
                                                                                                        AND a.BAPemusnahan_ID= b.BAPemusnahan_ID
                                                                                                        AND b.Aset_ID = c.Aset_ID ";
                                                                                        $exec=mysql_query($query);
                                                                                        $i=1;
                                                                                        while($row=mysql_fetch_array($exec)){
                                                                                     * 
                                                                                     */
                                                                                    $no=1;
                                                                                    foreach($data['dataArr'] as $key => $nilai){
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td valign="top"><?php echo "$no.";?></td>
                                                                                        <td valign="top">
                                                                                            <b><?php echo "$nilai[Aset_ID]";?><br/><br/><?php echo "$nilai[NomorReg]";?><br/><br/><?php echo "$nilai[NamaAset]"?></b>
                                                                                        </td>
                                                                                        <td align="right">
                                                                                            <input type="submit" value="View Detail" disabled="disabled"/>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3"><hr/></td>
                                                                                    </tr>
                                                                                    <?php $no++; } ?>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                                                        <tr>
                                                                            <td colspan=6><u style="font-weight:bold;">Informasi Surat Penetapan Pemusnahan</u></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <?php 
                                                                        /*
                                                                            $id=$_GET['id'];
                                                                            $query="SELECT * FROM BAPemusnahan where BAPemusnahan_ID='$id'";
                                                                            $exec=mysql_query($query);
                                                                            $row2=mysql_fetch_array($exec);
                                                                         * 
                                                                         */
                                                                        $row2=$data['dataRow'];
                                                                        ?>
                                                                        <tr>
                                                                            <td>Nomor BA Pemusnahan</td>
                                                                            <td>:</td>
                                                                            <td>
                                                                                <input type="text" size="30" name="pemusnahan_penet_eks_nopenet" required="required" value="<?php echo "$row2[NoBAPemusnahan]";?>">
                                                                            </td>
                                                                            <td>Tanggal BA Pemusnahan</td>
                                                                            <td>:</td>
                                                                            <td><input type="text" size="30" name="pemusnahan_penet_eks_tglpenet" required="required" id="tanggal12" value="<?php $change=$row2['TglBAPemusnahan']; $hasil=format_tanggal_db3($change); echo "$hasil";?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Penandatangan BA Pemusnahan</td>
                                                                            <td>:</td>
                                                                            <td colspan=4><input type="text" size="95" name="pemusnahan_penet_eks_penandatangan" required="required" value="<?php echo "$row2[NamaPenandatangan]";?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jabatan Penandatangan BA Pemusnahan</td>
                                                                            <td>:</td>
                                                                            <td colspan=4><input type="text" size="95" name="pemusnahan_penet_eks_jabatan" required="required" value="<?php echo "$row2[JabatanPenandatangan]";?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>NIP Penandatangan BA Pemusnahan</td>
                                                                            <td>:</td>
                                                                            <td colspan=4><input type="text" size="95" name="pemusnahan_penet_eks_nip" required="required" value="<?php echo "$row2[NIPPenandatangan]";?>"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="6" align=center>
                                                                                <input type="submit" name="submit" value="Edit" <!--onclick="show_confirm()"-->
                                                                                <input type="reset" name="#" value="Batal">
                                                                                <input type="hidden" name="id" value="<?php echo $row2['BAPemusnahan_ID'];?>"/>
                                                                            </td>
                                                                        </tr>
                                                                    </table>	
                                                                    </form>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                    
            <?php
                                   include"$path/footer.php";
            ?>
    </body>
</html>	
