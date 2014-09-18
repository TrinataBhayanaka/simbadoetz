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
		var r=confirm("Data yang akan ditetapkan pengembalian sudah benar ?");
		if (r==true)
		  {
		  alert("Data sudah dikembalikan");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_eksekusi_data.php";
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
                        #errmsg2 { color:red; }
                        #errmsg3 { color:red; }
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
                    <script type="text/javascript">
                        $(document).ready(function(){

                            //called when key is pressed in textbox
                                $("#posisiKolom2").keypress(function (e)  
                                { 
                                //if the letter is not digit then display error and don't type anything
                                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                {
                                        //display error message
                                        $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                    return false;
                            }	
                                });
                        });
                    </script>
                    <script type="text/javascript">
                        $(document).ready(function(){

                            //called when key is pressed in textbox
                                $("#posisiKolom3").keypress(function (e)  
                                { 
                                //if the letter is not digit then display error and don't type anything
                                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                {
                                        //display error message
                                        $("#errmsg3").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
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
                                Pengembalian Pemanfaatan	
                            </div>
                            <div id="bottomright">
                                
                                <?php
                                $nama_aset=$_POST['peman_pengem_add_aset'];
                                ?>
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_daftar_edit_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan BAST Pengembalian :</u></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                            <table width="100%">
                                                <?php 
                                                    $id=$_GET['id'];
                                                    $query="SELECT a.NoBAST, a.TglBAST, b.Aset_ID, c.NamaAset, c.NomorReg
                                                                    FROM BAST_Pengembalian a, BAST_PengembalianAset b, Aset c
                                                                    WHERE a.BAST_Pengembalian_ID ='$id'
                                                                    AND a.BAST_Pengembalian_ID = b.BAST_Pengembalian_ID
                                                                    AND b.Aset_ID = c.Aset_ID
                                                                    LIMIT 10 ";
                                                    $exec=mysql_query($query);
                                                    $i=1;
                                                    while($row=mysql_fetch_array($exec)){
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo "$i.";?></td>
                                                    <td valign="top">
                                                        <b><input type="hidden" name="peman_pengem_eks_aset[]" value="<?php echo $nama_aset[$i];?>"><?php echo "$row[Aset_ID]";?><br/><?php echo "$row[NomorReg]";?><br/><?php echo "$row[NamaAset]";?></b>
                                                    </td>
                                                    <td align="right"><input type="submit" value="View Detail" disabled="disabled"/></td>
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
                                        <td colspan=4><u style="font-weight:bold;">Berita Acara Serah Terima Pengembalian Pemanfaatan</u></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php 
                                            $id=$_GET['id'];
                                            $query="SELECT * FROM BAST_Pengembalian where BAST_Pengembalian_ID='$id'";
                                            $exec=mysql_query($query);
                                            $row2=mysql_fetch_array($exec);
                                ?>
                                <tr>
                                    <td>Nomor BAST</td>
                                    <td>
                                        <input type="text" name="peman_pengem_eks_nobast" required="required" id="posisiKolom" value="<?php echo "$row2[NoBAST]";?>">&nbsp;<span id="errmsg"></span>
                                    </td>
                                    <td>Tanggal BAST</td>
                                    <td><input type="text" name="peman_pengem_eks_tglbast" id="tanggal12" required="required" value="<?php $change=$row2[TglBAST]; $hasil=format_tanggal_db3($change); echo "$hasil";?>"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">Lokasi Serah Terima</td>
                                    <td colspan=3><input type="text" name="peman_pengem_eks_lokasi_serah_terima" required="required" size="92" value="<?php echo "$row2[LokasiBAST]";?>"/>
                                        <!--<table>
                                            <script type="text/javascript" src="<?php /*echo "$url_rewrite/"; */?>JS/tabel.js"></script>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="idgetkelompok" id="idgetkelompok" value="">
                                                    <input type="text" name="idkelompok" id="idkelompok" style="width:480px;" readonly="readonly" value="(semua Lokasi)">
                                                    <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
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
                                                            <div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
                                                                <table width="100%" align="left" border="0" class="tabel">
                                                                    <tr>
                                                                        <th align="left" border="0" nowrap colspan="3">
                                                                            <input type="text" id="kelompok_search" style="width: 70%;" value="">
                                                                            <input type="button" id="kelompok_btn_search" value="Cari" onclick="search_child( 'kelompok', '&prefix=kelompok&tag=' )">
                                                                        </th>
                                                                    </tr>
                                                                    <tr id="kelompok_row_">
                                                                        <th width="100px">&nbsp;</th>
                                                                        <th width="150px"align="center"><b>Kode</b></th>
                                                                        <th width="500px" align="left"><b>Nama</b></th>
                                                                    </tr>
                                                                    <tr id="zzzzzzzzzz">
                                                                        <td colspan="3" id="kelompok_data"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width=1><input type="checkbox"></td>
                                                                        <td class=Item><a href=./ class=Item onClick="processTree (0); return false;" STYLE="text-decoration: none">12</a></td>
                                                                        <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (0); return false;">SUMATERA UTARA</a></td>
                                                                    </tr>
                                                                    <tr id='sub_1_1' class=SubItemRow>
                                                                        <td width=1>&nbsp;<input type="checkbox"></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (1); return false;">1201</a></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (1); return false;">NIAS</a></td>
                                                                    </tr>
                                                                    <tr id='sub_1_1_1' class=SubItemRow>
                                                                        <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (1); return false;">1201060</a></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (1); return false;">IDANOGAWO</a></td>
                                                                    </tr>
                                                                    <tr id='sub_1_2' class=SubItemRow>
                                                                        <td width=1>&nbsp;<input type="checkbox"></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (2); return false;">1202</a></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (2); return false;">MANDAILING NATAL</a></td>
                                                                    </tr>
                                                                    <tr id='sub_0_2_1' class=SubItemRow>
                                                                        <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (2); return false;">1202010</a></td>
                                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (2); return false;">BATAHAN</a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3"></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                </td>
                                            </tr>
                                        </table>-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan=2 style="font-weight:bold; font-size:18px;">Pihak Pertama</td>
                                    <td colspan=2 style="font-weight:bold; font-size:18px;">Pihak Kedua</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td><input type="text" name="peman_pengem_eks_nm1" required="required" value="<?php echo "$row2[NamaPihak1]";?>"></td>
                                    <td>Nama</td>
                                    <td><input type="text" name="peman_pengem_eks_nm2" required="required" value="<?php echo "$row2[NamaPihak2]";?>"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td><input type="text" name="peman_pengem_eks_jabatan1" required="required" value="<?php echo "$row2[JabatanPihak1]";?>"></td>
                                    <td>Jabatan</td>
                                    <td><input type="text" name="peman_pengem_eks_jabatan2" required="required" value="<?php echo "$row2[JabatanPihak2]";?>"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>
                                        <input type="text" name="peman_pengem_eks_nip1" required="required" id="posisiKolom2" value="<?php echo "$row2[NIPPihak1]";?>">&nbsp;<span id="errmsg2"></span>
                                    </td>
                                    <td>NIP</td>
                                    <td>
                                        <input type="text" name="peman_pengem_eks_nip2" required="required" id="posisiKolom3" value="<?php echo "$row2[NIPPihak2]";?>">&nbsp;<span id="errmsg3"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Lokasi</td>
                                    <td><input type="text" name="peman_pengem_eks_lokasi1" required="required" value="<?php echo "$row2[LokasiPihak1]";?>"></td>
                                    <td>Lokasi</td>
                                    <td><input type="text" name="peman_pengem_eks_lokasi2" required="required" value="<?php echo "$row2[LokasiPihak2]";?>"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan=4 align=center><input type="submit" name="submit" value="Edit"/><input type="button" value="Batal" onclick="window.location='pemanfaatan_pengembalian_daftar.php'"/></td>
                                    <input type="hidden" name="id" value="<?php echo $row2['BAST_Pengembalian_ID'];?>"/>
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
	
