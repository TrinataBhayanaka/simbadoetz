    <?php
        include "../../config/config.php"; 
    ?>

<html>
    <?php
        include "$path/header.php";
    ?>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Data yang akan ditetapkan menganggur sudah benar ?");
		if (r==true)
		  {
		  alert("Data akan masuk ke usulan pemanfaatan");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_eksekusi_data.php";
		  }
		}
	</script>
                    
                    <!--Buat Date-->
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
                    <!--
                    <script src="../../JS/jquery-latest.js"></script>
                    <script src="../../JS/jquery.js"></script>
                    -->
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
                        include "$path/title.php";
                        include "$path/menu.php";
                    ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Penetapan BMD Menganggur
                            </div>
                            <div id="bottomright">
                                
                                 
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_daftar_edit_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan penetapan BMD Menganggur :</u></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                            <table width="100%">
                                                <?php 
                                                    $id=$_GET['id'];
                                                    $query="SELECT a.NoSKKDH, a.TglSKKDH, a.Keterangan, b.Aset_ID, c.NamaAset, c.NomorReg
                                                                    FROM Menganggur a, MenganggurAset b, Aset c
                                                                    WHERE a.Menganggur_ID ='$id'
                                                                    AND a.Menganggur_ID = b.Menganggur_ID
                                                                    AND b.Aset_ID = c.Aset_ID
                                                                    LIMIT 10 ";
                                                    $exec=mysql_query($query);
                                                    $i=1;
                                                    while($row=mysql_fetch_array($exec)){
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo "$i.";?></td>
                                                    <td valign="top">
                                                     <b><input type="hidden" name="peman_idle_nama_aset[]" value="<?php echo $nama_aset[$i];?>"><?php echo "$row[Aset_ID]";?><br/><br/><?php echo "$row[NomorReg]";?><br/><br/><?php echo "$row[NamaAset]";?></b>
                                                    </td>
                                                    <td align="right">
                                                        <input type="submit" value="View Detail" disabled="disabled">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><hr/></td>
                                                </tr>
                                                <?php $i++; } ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                    <tr>
                                        <td colspan=4><u style="font-weight:bold;">Informasi Surat Penetapan BMD Menganggur</u></td>
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
                                            $id=$_GET['id'];
                                            $query="SELECT * FROM Menganggur where Menganggur_ID='$id'";
                                            $exec=mysql_query($query);
                                            $row2=mysql_fetch_array($exec);
                                        ?>
                                    <tr>
                                        <td>Nomor Penetapan</td>
                                        <td>
                                            <input type="text" name="peman_penet_bmd_eks_nopenet" required="required" id="posisiKolom" value="<?php echo "$row2[NoSKKDH]";?>">&nbsp;<span id="errmsg"></span>
                                        </td>
                                        <td>Tanggal Penetapan</td>
                                        <td><input type="text" name="peman_penet_bmd_eks_tglpenet" required="required" id="tanggal12" value="<?php $change=$row2[TglSKKDH]; $hasil=format_tanggal_db3($change); echo "$hasil";?>"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan=3><textarea name="peman_penet_bmd_eks_ket" cols="100" rows="5" required="required"><?php echo "$row2[Keterangan]";?></textarea></td>
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
                                        <td colspan=4>
                                            <input type="submit" name="submit" value="Edit"/>
                                            <input type="reset" value="Batal" onclick="window.location='pemanfaatan_penetapan_idle_daftar.php'"/>
                                            <input type="hidden" name="id" value="<?php echo $row2['Menganggur_ID'];?>"/>
                                        </td>
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
	
