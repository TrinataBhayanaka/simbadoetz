    <?php
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        
        $menu_id = 30;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
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
                                $nama_aset=$_POST['penggu_penet_add'];
                                ?>
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_daftar_edit_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan penetapan penggunaan :</u></td>
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
                                                            $data = $RETRIEVE->retrieve_penetapan_penggunaan_edit_data($parameter);
                                                        }
                                                        
                                                        /*
                                                        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenggunaanAset AS a
                                                                                            INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.Penggunaan_ID='$id'";
                                                        $exec_tampil_query_aset=mysql_query($query_tampil_aset);
                                                        
                                                        $i=1;
                                                        while($value=mysql_fetch_array($exec_tampil_query_aset)){
                                                         * 
                                                         */
                                                        $no=1;
                                                        foreach($data['dataArr'] as $key => $value){
                                            ?>
                                            <tr>
                                                <td valign="top"><?php echo "$no.";?></td>
                                                <td valign="top">
                                                     <b><?php echo "$value[Aset_ID]";?><br/><?php echo "$value[NomorReg]";?><br/><?php echo "$value[NamaAset]";?></b>
                                                </td>
                                                <td align="right">
                                                    <input type="submit" value="View Detail" disabled="disabled">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><hr/></td>
                                            </tr>
                                            <?php  $no++; }?>
                                            
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td><!--Mobil--></td>
                                            </tr>
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
                                        <?php 
                                            /*
                                            $query="SELECT * FROM Penggunaan where Penggunaan_ID='$id'";
                                            $exec=mysql_query($query);
                                            $row=mysql_fetch_array($exec);
                                             * 
                                             */
                                        $row=$data['dataRow'];
                                        ?>
                                    <tr>
                                        <td>Nomor Penetapan</td>
                                        <td><input type="text" name="penggu_penet_eks_nopenet" required="required" id="posisiKolom" value="<?php echo "$row[NoSKKDH]";?>">&nbsp;<span id="errmsg"></span></td>
                                        <td>Tanggal Penetapan</td>
                                        <td><input type="text" name="penggu_penet_eks_tglpenet" required="required" id="tanggal12" value="<?php $change=$row[TglSKKDH]; $hasil=format_tanggal_db3($change); echo "$hasil";?>"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan=3><textarea name="penggu_penet_eks_ket" cols="100" rows="5" required="required"><?php echo "$row[Keterangan]";?></textarea></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr align=center>
                                        <td colspan=4><input type="submit" name="penggunaan_edit_eks" value="Edit"/><input type="reset" value="Batal" onclick="window.location='penggunaan_penetapan_daftar.php?pid=1'"></td>
                                        <input type="hidden" name="id_hidden" value="<?php echo $row['Penggunaan_ID'];?>"/>
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
	
