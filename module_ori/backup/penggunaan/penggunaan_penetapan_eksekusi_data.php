    <?php
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        $submit=$_POST['submit2'];
        
        $menu_id = 30;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        if (isset($submit))
                                {
                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            $ses_uid=$_SESSION['ses_uid'];
                                            $parameter=array('ses_uid'=>$ses_uid);
                                            $data = $RETRIEVE->retrieve_penetapan_penggunaan_eksekusi($parameter);
                                }
                                
                                echo '<pre>';
                                //print_r($data['dataArr']);
                                echo '</pre>';
    ?>

<html>
        
                    <!--buat date-->
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
        
                    <!--buat number only-->
                    <style>
                        #errmsg { color:red; }
                    </style>
                    <script src="js/jquery-latest.js"></script>
                    <script src="js/jquery.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function(){

                            //called when key is pressed in textbox
                                $("#posisiKolom").keypress(function (e)  
                                { 
                                //if the letter is not digit then display error and don't type anything
                                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                {
                                        //display error message
                                        $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                    return false;
                            }	
                                });
                        });
                    </script>

                   
        <body>
            <div id="content">
                    <?php
                        
                        include "$path/menu.php";
                    ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Penetapan Penggunaan
                            </div>
                            <div id="bottomright">
                                
                                <?php
                                /*
                                        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Penggunaan' AND UserSes = '$_SESSION[ses_uid]'";
                                        //print_r($query);
                                        $result = mysql_query($query) or die (mysql_error());

                                        $numRows = mysql_num_rows($result);
                                        if ($numRows)
                                        {
                                            $dataID = mysql_fetch_object($result);
                                        }
                                        $explodeID = explode(',',$dataID->aset_list);
                                        
                                        $id=0;
                                        foreach($explodeID as $value)
                                        {
                                            //$$key = $value;
                                            $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                                                    k.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                                                    FROM Aset AS a 
                                                                    INNER JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                                                    INNER JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
                                                                    INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                                    INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                                    INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                                                    WHERE a.Aset_ID = '$value' limit 1";
                                                //print_r($query);
                                                $result = mysql_query($query) or die(mysql_error());
                                                $data[$id] = mysql_fetch_object($result);

                                                $id++;
                                        }
                                 * 
                                 */
                                ?>
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_eksekusi_data_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan penetapan penggunaan :</u></td>
                                </tr>
                                
                                <tr>
                                    <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                        <table width="100%">
                                            
                                            <?php
                                                        $id =0;
                                                        $no = 1;
                                                        foreach ($data['dataArr'] as $keys => $nilai)
                                                        {
                                                            
                                                            if ($nilai->Aset_ID !='')
                                                            {
                                             ?>
                                            <tr>
                                                <td valign="top"><?php echo "$no.";?></td>
                                                <td valign="top">
                                                     <b><input type="hidden" name="penggu_nama_aset[]" value="<?php echo "$nilai->Aset_ID";?><br/><?php echo "$nilai->NomorReg";?><br/><?php echo "$nilai->NamaAset";?>"/><?php echo "$nilai->Aset_ID";?><br/><br/><?php echo "$nilai->NomorReg";?><br/><br/><?php echo "$nilai->NamaAset";?></b>
                                                </td>
                                                <td align="right">
                                                    <input type="submit" name="submit" value="View Detail" id="" onclick="showSpo(this)" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><hr></td>
                                            </tr>
                                            <?php $no++; } } ?>
                                        </table>
                                    </td>
                                </tr>
                                </table>
                                <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                    <tr>
                                        <td colspan=4><u style="font-weight:bold;">Informasi Surat Penetapan Penggunaan</u></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Penetapan</td>
                                        <td><input type="text" name="penggu_penet_eks_nopenet" required="required" id="posisiKolom">&nbsp;<span id="errmsg"></span></td>
                                        <td>Tanggal Penetapan</td>
                                        <td><input type="text" name="penggu_penet_eks_tglpenet" required="required" id="tanggal12"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan=3><textarea name="penggu_penet_eks_ket" cols="100" rows="5" required="required"></textarea></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr align=center>
                                        <td colspan=4><input type="submit" name="penggunaan_eks" value="Penggunaan"><input type="reset" value="Batal"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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
	
