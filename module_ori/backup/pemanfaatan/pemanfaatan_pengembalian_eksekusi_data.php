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
                                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PengembalianPemanfaatan' AND UserSes = '$_SESSION[ses_uid]'";
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
                                                                    c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.NoSKKDH, g.TglSelesai, h.Kode
                                                                    FROM PemanfaatanAset AS b
                                                                    LEFT JOIN Pemanfaatan AS g ON b.Pemanfaatan_ID=g.Pemanfaatan_ID
                                                                    LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                                                    LEFT JOIN KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                                                    LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                                                    LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                                    LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                                    LEFT JOIN Kelompok AS h ON a.Kelompok_ID=h.Kelompok_ID
                                                                WHERE b.Aset_ID = '$value' limit 1";
                                                //print_r($query);
                                                $result = mysql_query($query) or die(mysql_error());
                                                $data[$id] = mysql_fetch_object($result);

                                                $id++;
                                        }
                                ?>
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_eksekusi_data_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan BAST Pengembalian :</u></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                            <table width="100%">
                                                <?php
                                                        $id =0;
                                                        $no = 1;
                                                        foreach ($data as $keys => $nilai)
                                                        {
                                                            
                                                            if ($nilai->Aset_ID !='')
                                                            {
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo "$no.";?></td>
                                                    <td valign="top">
                                                        <b><input type="hidden" name="peman_pengem_eks_aset[]" value="<?php echo "$nilai->Aset_ID";?><br/><?php echo "$nilai->NomorReg";?><br/><?php echo "$nilai->NamaAset";?>"><?php echo "$nilai->Aset_ID";?><br/><br/><?php echo "$nilai->NomorReg";?><br/><br/><?php echo "$nilai->NamaAset";?></b>
                                                    </td>
                                                    <td align="right"><input type="submit" value="View Detail" disabled="disabled"/></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><hr/></td>
                                                </tr>
                                                <?php $no++; } } ?>
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
                                <tr>
                                    <td>Nomor BAST</td>
                                    <td>
                                        <input type="text" name="peman_pengem_eks_nobast" required="required" id="posisiKolom">&nbsp;<span id="errmsg"></span>
                                    </td>
                                    <td>Tanggal BAST</td>
                                    <td><input type="text" name="peman_pengem_eks_tglbast" id="tanggal12" required="required"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top">Lokasi Serah Terima</td>
                                    <td colspan=3><input type="text" name="peman_pengem_eks_lokasi_serah_terima" required="required" size="92"/>
                                        <!--<table>
                                            <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
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
                                    <td><input type="text" name="peman_pengem_eks_nm1" required="required"></td>
                                    <td>Nama</td>
                                    <td><input type="text" name="peman_pengem_eks_nm2" required="required"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td><input type="text" name="peman_pengem_eks_jabatan1" required="required"></td>
                                    <td>Jabatan</td>
                                    <td><input type="text" name="peman_pengem_eks_jabatan2" required="required"></td>
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
                                        <input type="text" name="peman_pengem_eks_nip1" required="required" id="posisiKolom2">&nbsp;<span id="errmsg2"></span>
                                    </td>
                                    <td>NIP</td>
                                    <td>
                                        <input type="text" name="peman_pengem_eks_nip2" required="required" id="posisiKolom3">&nbsp;<span id="errmsg3"></span>
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
                                    <td><input type="text" name="peman_pengem_eks_lokasi1" required="required"></td>
                                    <td>Lokasi</td>
                                    <td><input type="text" name="peman_pengem_eks_lokasi2" required="required"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan=4 align=center><input type="submit" name="submit" value="Pengembalian"/><input type="button" value="Batal" onclick="window.location='pemanfaatan_pengembalian_tambah_data.php'"/></td>
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
	
