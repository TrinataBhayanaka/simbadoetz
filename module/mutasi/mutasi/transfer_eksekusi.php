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
                                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Mutasi' AND UserSes = '$_SESSION[ses_uid]'";
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
                                            $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                                                    c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                                                    FROM PenggunaanAset AS b INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                                                    INNER JOIN KontrakAset AS d ON b.Aset_ID=d.Aset_ID
                                                                    INNER JOIN Kontrak AS c ON d.Kontrak_ID=c.Kontrak_ID
                                                                    INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                                    INNER JOIN Lokasi AS f ON a.Lokasi_ID=f.Lokasi_ID
                                                                    INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                                                    WHERE b.Aset_ID = '$value' limit 1";
                                                //print_r($query);
                                                $result = mysql_query($query) or die(mysql_error());
                                                $data[$id] = mysql_fetch_object($result);

                                                $id++;
                                        }
                            ?>
                            <form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_eksekusi_proses.php">
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
                                                        $id =0;
                                                        $no = 1;
                                                        foreach ($data as $keys => $nilai)
                                                        {
                                                            
                                                            if ($nilai->Aset_ID !='')
                                                            {
                                                        ?>
                                                        <tr>
                                                            <td valign="top" width="30"><?php echo "$no.";?></td>
                                                            <td valign="top">
                                                                <b><input type="hidden" name="mutasi_nama_aset[]" value="<?php echo "$nilai->Aset_ID";?><br/><?php echo "$nilai->NomorReg";?><br/><?php echo "$nilai->NamaAset";?>"/> <?php echo "$nilai->Aset_ID";?><br/><br/><?php echo "$nilai->NomorReg";?><br/><br/><?php echo "$nilai->NamaAset";?></b>
                                                            </td>
                                                            <td width="10px" valign="top" align="right">
                                                                <input type="button" value="View Detail" disabled="disabled"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"><hr/></td>
                                                        </tr>
                                                        <?php $no++; } }  ?>
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
                                                    <tr>
                                                        <td>
                                                            Transfer ke Satker
                                                            <input type="text" name="lda_skpd" readonly="readonly" id="lda_skpd" style="width:300px;" placeholder="(Semua SKPD)">
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
                                                                    radioskpd($style2,"skpd_id",'skpd','yuda');
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
                                                        <td><input type="text" width="150px" name="mutasi_trans_eks_nodok" required="required" id="posisiKolom">&nbsp;<span id="errmsg"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr> 
                                                    <tr>
                                                        <td valign="top" align="left">Tgl. Proses</td>
                                                        <td valign="top" align="left"><input type="text" width="200px" name="mutasi_trans_eks_tglproses" required="required" id="tanggal12"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr> 	
                                                    <tr>
                                                        <td valign="top" align="left">Pemakai</td>
                                                        <td valign="top" align="left"><input type="text" width="200px" name="mutasi_trans_eks_pemakai" required="required"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" align="left">Alasan</td>
                                                        <td valign="top" align="left" ><textarea name="mutasi_trans_eks_alasan" cols="50" rows="5" required="required"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr> 					
                                                    <tr>
                                                        <td valign="top" align="left"></td>
                                                        <td valign="top" align="left"><input type="submit" name="submit" value="Transfer" <!--onclick="sendit_1()"-->><input type="button" value="Batal" onclick="sendit_2()"></td>
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
