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
                                $nama=$_POST['mutasi_nama_aset'];
                                $satker1=$_POST['bkbppm'];
                                $satker2=$_POST['bkbppmtu'];
                                $satker3=$_POST['sekretariatdaerah'];
                                $satker4=$_POST['sekretariatdaerahbhh'];
                                $nodok=$_POST['mutasi_trans_eks_nodok'];
                                $tgl=$_POST['mutasi_trans_eks_tglproses'];
                                $alasan=$_POST['mutasi_trans_eks_alasan'];
                            ?>  
                            <div style="color:black; font-size:20px; font-family:arial; margin-bottom:20px;" align="center">
                                Data Aset Sudah Ditransfer.
                            </div>
                            <div style="color:black; font-size:15px; font-family:arial; margin:0px auto;">
                                Daftar aset yang ditransfer :    
                                <br/>
                                <br/>
                                <table  width="100%" style="border:1px solid black; border-width:1px 1px 1px 1px;" cellspacing="0">
                                        <tr style="background-color:#004933; font-family: arial; font-size: 15px; color:white; height:25px;">
                                            <td rowspan="2" valign="top" align="center" style="border:1px solid black; padding-top:4px;" width="60">Nomor</td>
                                            <td colspan="2" align="center" style="border:1px solid black;">Nama Aset</td>
                                        </tr>
                                        <tr style="background-color:#004933; font-family: arial; font-size: 15px; color:white; height:25px;"">
                                            <td align="center" style="border:1px solid black;">Nomor Registrasi Lama</td>
                                            <td align="center" style="border:1px solid black;">Nomor Registrasi Baru</td>
                                        </tr>
                                        <?php
                                        $N = count($nama);
                                        for($i=0; $i < $N; $i++){
                                        $no=$i+1;
                                        ?>
                                        <tr style="font-family: arial; font-size: 15px; color:black; height:25px;"">
                                            <td rowspan="2" valign="top" align="center" style="border:1px solid black; padding-top:4px;" width="60"><?php echo "$no.";?></td>
                                            <td colspan="2" align="center" style="border:1px solid black;"><?php echo "$nama[$i]";?></td>
                                        </tr>
                                        <tr style="font-family: arial; font-size: 15px; color:black; height:25px;">
                                            <td align="center" style="border:1px solid black;">99.02.23.1.XX.00 - 02.02.03.01.02.0001</td>
                                            <td align="center" style="border:1px solid black;">99.02.23.1.XX.00 - 02.02.03.01.02.0001</td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                </table>
                                &nbsp;
                                <table style="margin-left:10px; color:black;">
                                    <tr>
                                        <td>Ke Satker</td>
                                        <td>&nbsp;</td>
                                        <td>:</td>
                                        <td>UPTD</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>No. Dokumen Pendukung</td>
                                        <td>&nbsp;</td>
                                        <td>:</td>
                                        <td><?php echo "$nodok";?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Proses</td>
                                        <td>&nbsp;</td>
                                        <td>:</td>
                                        <td><?php echo "$tgl";?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Alasan</td>
                                        <td>&nbsp;</td>
                                        <td>:</td>
                                        <td><?php echo "$alasan";?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                    </tr>
                                </table>
                                <p align="center"><a href="#">Cetak Dokumen</a>&nbsp;||&nbsp;<a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_antar_skpd.php">Kembali ke menu utama</a></p>
                            </div>
                                
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
