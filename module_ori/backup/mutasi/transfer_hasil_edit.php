    <?php
        include "../../config/config.php";
    ?>

    <html>
        
    <?php
        include "$path/header.php";
    ?>
        <!-- buat alert-->
        <script type="text/javascript">
            <!--
            function sendit(){
                alert("OK");
                document.location="transfer_antar_skpd.php";
            }
            -->
            <!--
            function sendit_1(){
                alert("SUCCESS");
                document.location="transfer_hasil_filter.php";
            }
            -->
            <!--
            function sendit_2(){
                document.location="hasil_transfer.php";
            }
            -->
            <!--
            function sendit_3(){
                alert("OK")
                document.location="hasil_transfer_1.php";
            }
            -->
        </script>
        
        <!--buat date-->
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_radio.js"></script>
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
                            Transfer Antar SKPD
                        </div>
                        <div id="bottomright">
                            
                            <?php
                                $nama_aset=$_POST['mutasi_transfer_cek'];
                            ?>
                            <form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_edit_proses.php">
                            <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
                            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top:2px;">
                                <tbody>
                                    <tr>
                                        <td style="padding:0px;" colspan="2">
                                            <div style="margin-top:10px;">
                                                <div style="padding:5px; font-weight:bold; border:1px solid #004933;" >
                                                    <u style="font-weight:bold;">Daftar Aset yang akan di transfer :</u>
                                                </div>
                                                &nbsp;
                                                
                                                <table width="100%" style="padding:10px; border:1px solid #004933;">
                                                        <?php
                                                        $id=$_GET['id'];
                                                        
                                                        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM MutasiAset AS a
                                                                                            INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE Mutasi_ID='$id'";
                                                        $exec_query_tampil_aset=mysql_query($query_tampil_aset);
                                                        
                                                        $i=1;
                                                        while($value=  mysql_fetch_array($exec_query_tampil_aset)){
                                                        ?>
                                                        <tr>
                                                            <td valign="top" width="30"><?php echo "$i.";?></td>
                                                            <td valign="top">
                                                                <b><?php echo "$value[Aset_ID]";?><br/><?php echo "$value[NomorReg]";?><br/><?php echo "$value[NamaAset]";?><br/></b>
                                                            </td>
                                                            <td width="10px" valign="top" align="right">
                                                                <input type="button" value="View Detail" disabled="disabled"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><hr/></td>
                                                        </tr>
                                                        <?php $i++; } ?>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                            <td><!--Mobil--></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                </table>
                                                &nbsp;
                                                <hr>
                                                &nbsp;
                                                <table width="100%">
                                                    <?php 
                                                        
                                                        $query="SELECT * FROM Mutasi where Mutasi_ID='$id'";
                                                        $exec=mysql_query($query);
                                                        $row2=mysql_fetch_array($exec);
                                                        
                                                        $ST=$row2['SatkerTujuan'];   
                                                                                                            ?>
                                                    <tr>
                                                        <td>
                                                            Transfer ke Satker
                                                            <input type="text" name="lda_skpd" id="lda_skpd" style="width:300px;" value="<?php echo show_skpd($ST);?>" readonly="readonly">
                                                            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);"><br>
                                                            <div class="inner" style="display:none;">
                                                                <style>
                                                                    .tabel th {
                                                                        background-color: #eeeeee;
                                                                        border: 1px solid #dddddd;
                                                                    }
                                                                    .tabel td {
                                                                        border: 1px solid #dddddd;
                                                                    }
                                                                </style>
                                                                <?php
                                                                    $alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
                                                                    $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
                                                                    js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                                    $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                    radioskpd($style2,"skpd_id",'skpd',"yuda|$ST");
                                                                    ?>
                                                            </div>
                                                        </td>
                                                    </tr>   
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>                      
                                                </table> 
                                                <table height="100px" width="318px">	
                                                    <tr>
                                                        <td>No. Dokumen</td>
                                                        <td><input type="text" width="150px" name="mutasi_trans_eks_nodok" required="required" id="posisiKolom" value="<?php echo "$row2[NoSKKDH]";?>">&nbsp;<span id="errmsg"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr> 
                                                    <tr>
                                                        <td valign="top" align="left">Tgl. Proses</td>
                                                        <td valign="top" align="left"><input type="text" width="200px" name="mutasi_trans_eks_tglproses" required="required" id="tanggal12" value="<?php $change=$row2[TglSKKDH]; $change2=  format_tanggal_db3($change); echo "$change2";?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr> 					
                                                    <tr>
                                                        <td valign="top" align="left">Alasan</td>
                                                        <td valign="top" align="left" ><textarea name="mutasi_trans_eks_alasan" cols="50" rows="5" required="required"><?php echo "$row2[Keterangan]";?></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr> 					
                                                    <tr>
                                                        <td valign="top" align="left"></td>
                                                        <td valign="top" align="left"><input type="submit" name="submit" value="Transfer" <!--onclick="sendit_1()"-->><input type="button" value="Batal" onclick="document.location.href='transfer_hasil_daftar.php'"></td>
                                                        <input type="hidden" name="id" value="<?php echo $row2['Mutasi_ID'];?>"/>
                                                    </tr>
                                                </table>			                           
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
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
