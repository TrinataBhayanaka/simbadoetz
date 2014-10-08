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
		var r=confirm("Data yang akan ditetapkan pemanfaatan sudah benar ?");
		if (r==true)
		  {
		  alert("Data akan masuk ke form validasi pemanfaatan");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_eksekusi_data.php";
		  }
		}
	</script>
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
                        $('#id_tgl_start').datepicker($.datepicker.regional['id']);
                        $('#id_tgl_end').datepicker($.datepicker.regional['id']);
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
                    
                     <!--buat jangka waktu-->
                        <script>
                                        function toggle_data_valid() {
                                        // IDs untuk header BASP
                                        var id_no_tap    = document.getElementById( 'id_no_tap'   );
                                        var id_tgl_tap   = document.getElementById( 'id_tgl_tap'  );   
                                        var id_dtl_manfaat = document.getElementById( 'id_dtl_manfaat' );   	
                                        var id_manfaat = document.getElementById( 'id_manfaat' );  
                                        var id_jangka_waktu = document.getElementById( 'id_jangka_waktu' );  
                                        var id_nama_partner = document.getElementById( 'id_nama_partner' );  
                                        var id_alamat_partner = document.getElementById( 'id_alamat_partner' );  
                                        var id_tgl_start = document.getElementById( 'id_tgl_start' );  
                                        var id_tgl_end = document.getElementById( 'id_tgl_end' );  

                                        // ID untuk action button
                                        var id_btnact   = document.getElementById( 'btn_action' );
                                        var id_jml_aset = document.getElementById( 'jmlaset' ); 
                                        //
                                        var b_aset = false;        
                                        var b_for  = false;
                                        var bdone = false;

                                        if( id_jml_aset.value != 0 ) {
                                        b_aset = true;
                                        }
                                        id_no_tap.disabled  = !b_aset;
                                        id_tgl_tap.disabled     = !b_aset;
                                        id_dtl_manfaat.disabled = !b_aset;
                                        id_manfaat.disabled = !b_aset;

                                        if( b_aset  && id_no_tap.value != '' && id_tgl_tap.value != '' && id_manfaat.value != ''  ) {
                                        b_for = true;
                                        }

                                        id_nama_partner.disabled = !b_for;
                                        id_alamat_partner.disabled = !b_for;
                                        id_tgl_start.disabled = !b_for;
                                        id_tgl_end.disabled = !b_for;


                                        if( b_aset && b_for 
                                            && id_nama_partner.value != '' && id_tgl_start.value != '' && id_tgl_end.value != '' ) {
                                            bdone = true;
                                        }
                                        id_btnact.disabled  = !bdone;
                                    }

                                    function setjangkawaktu() {
                                        var id_jangka_waktu = document.getElementById( 'id_jangka_waktu' ); 
                                        var id_tgl_start = document.getElementById( 'id_tgl_start' );  
                                        var id_tgl_end = document.getElementById( 'id_tgl_end' );  
                                        var tglstart = id_tgl_start.value;
                                        var tglend = id_tgl_end.value;

                                        var date1 = tglstart;
                                                var date2 = tglend;

                                laterdate = date1.split('/');
                                laterY=laterdate[2];
                                laterM=laterdate[1];
                                laterD=laterdate[0];

                                earlierdate = date2.split('/');
                                earlierY=earlierdate[2];
                                earlierM=earlierdate[1];
                                earlierD=earlierdate[0];
                                //
                                //
                                //     var dif = 0;
                                //     dif += (earlierM - laterM);
                                //     dif += ((earlierY - laterY) * 12);
                                //     dif += (earlierD - laterD < 0) ? ((dif > 0) ? -1 : 0) : 0;
                                //

                                yeardiff = earlierY - laterY;
                                monthdiff = earlierM - laterM;
                                daydiff = earlierD - laterD;

                                difference = '';
                                differenceyear = '';
                                differencemonth = '';
                                differencehari = '';

                                if (yeardiff > 0 ) 
                                {
                                        if (monthdiff > 0)	
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari='';
                                                }
                                                else
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        if (monthdiff != 1)
                                                        {differencemonth=monthdiff-1 + ' bulan ';}
                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }
                                        }
                                        else if (monthdiff == 0)
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth='';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        differenceyear=yeardiff + ' tahun '; 
                                                        differencemonth='';
                                                        differencehari='';
                                                }
                                                else  if (daydiff < 0)
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12-monthdiff-1 + ' bulan ';
                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }

                                        }
                                        else
                                        {
                                                if (daydiff > 0)
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12+monthdiff + ' bulan ';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12+monthdiff + ' bulan ';
                                                        differencehari='';
                                                }
                                                else
                                                {
                                                        if (yeardiff != 1)
                                                        {differenceyear=yeardiff-1 + ' tahun '; }
                                                        differencemonth=12+monthdiff-1 + ' bulan ';
                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }
                                        }
                                }
                                else if (yeardiff == 0)
                                {
                                        if (monthdiff > 0)	
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {

                                                        differencemonth=monthdiff + ' bulan ';
                                                        differencehari='';
                                                }
                                                else
                                                {	if (monthdiff != 1)
                                                        {differencemonth=monthdiff-1 + ' bulan ';}

                                                        laterM1 = (laterM*1) + (monthdiff*1) -1;
                                                        laterY1 = (laterY*1) + (yeardiff*1);
                                                        tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                                        tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;

                                                        var tglakhirr = new Date(tlgakhir).getTime() ;
                                                        var tglawall = new Date(tlgawal).getTime() ;
                                                        var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                                        differencehari=daysDifference + ' hari ';
                                                }
                                        }
                                        else if (monthdiff == 0)
                                        {
                                                if (daydiff > 0)
                                                {
                                                        differencemonth='';
                                                        differencehari=daydiff + ' hari ';
                                                }
                                                else if (daydiff == 0)
                                                {
                                                        differencemonth='';
                                                        differencehari='';
                                                }
                                //		else  if (daydiff < 0)
                                //		{
                                //			differencemonth=12-monthdiff-1 + ' bulan ';
                                //			laterM1 = (laterM*1) + (monthdiff*1) -1;
                                //			laterY1 = (laterY*1) + (yeardiff*1);
                                //			tlgawal=laterM1+'/'+laterD+'/'+laterY1 ;
                                //			tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;
                                //			
                                //			var tglakhirr = new Date(tlgakhir).getTime() ;
                                //			var tglawall = new Date(tlgawal).getTime() ;
                                //			var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);
                                //			differencehari=daysDifference + ' hari ';
                                //		}	
                                        }
                                }


                                //tlgawal=laterM+'/'+laterD+'/'+laterY ;
                                //tlgakhir=earlierM+'/'+earlierD+'/'+earlierY ;
                                //
                                //var tglakhirr = new Date(tlgakhir).getTime() ;
                                //var tglawall = new Date(tlgawal).getTime() ;
                                //var daysDifference = Math.floor((tglakhirr-tglawall)/1000/60/60/24);

                                                if ( tglstart == tglend)
                                                {
                                                id_jangka_waktu.value  = 0;	
                                                }
                                                else
                                                {
                                        id_jangka_waktu.value  = differenceyear+differencemonth+differencehari;
                                                }
                                    }
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
                                Penetapan Pemanfaatan	
                            </div>
                            <div id="bottomright">
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_daftar_edit_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang dibuatkan penetapan pemanfaatan :</u></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                            <table width="100%">
                                                <?php 
                                                    $id=$_GET['id'];
                                                    $query="SELECT a.NoSKKDH, a.TglSKKDH, a.Keterangan, b.Aset_ID, c.NamaAset, c.NomorReg
                                                                    FROM Pemanfaatan a, PemanfaatanAset b, Aset c
                                                                    WHERE a.Pemanfaatan_ID ='$id'
                                                                    AND a.Pemanfaatan_ID= b.Pemanfaatan_ID
                                                                    AND b.Aset_ID = c.Aset_ID
                                                                    LIMIT 10 ";
                                                    $exec=mysql_query($query);
                                                    $i=1;
                                                    while($row=mysql_fetch_array($exec)){
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo "$i.";?></td>
                                                    <td valign="top">
                                                        <b><?php echo "$row[Aset_ID]";?><br/><?php echo "$row[NomorReg]";?><br/><?php echo "$row[NamaAset]";?></b>
                                                    </td>
                                                    <td align="right">
                                                        <input type="submit" value="View Detail" disabled="disabled"/>
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
                                        <td colspan=4><u style="font-weight:bold;">Informasi Surat Penetapan Pemanfaatan</u></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php 
                                            $id=$_GET['id'];
                                            $query="SELECT * FROM Pemanfaatan where Pemanfaatan_ID='$id'";
                                            $exec=mysql_query($query);
                                            $row2=mysql_fetch_array($exec);
                                        ?>
                                    <tr>
                                        <td>Nomor Penetapan</td>
                                        <td>
                                            <input type="text" name="peman_penet_eks_nopenet" required="required" id="posisiKolom" value="<?php echo "$row2[NoSKKDH]";?>">&nbsp;<span id="errmsg"></span>
                                        </td>
                                        <td>Tanggal Penetapan</td>
                                        <td><input type="text" name="peman_penet_eks_tglpenet" required="required" id="tanggal11" value="<?php $change=$row2[TglSKKDH]; $hasil=format_tanggal_db3($change); echo "$hasil";?>"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Tipe Pemanfaatan</td>
                                        <td colspan=3>
                                            <select name="peman_penet_eks_tipe" required="required" selected="<?php echo "$row2[TipePemanfaatan]";?>">
                                                <option value="">-</option>
                                                <option value="Pinjam Pakai" <?php if($row2['TipePemanfaatan']=='Pinjam Pakai'){?>selected="selected"<?php }?>>Pinjam Pakai</option>
                                                <option value="Penyewaan" <?php if($row2['TipePemanfaatan']=='Penyewaan'){?>selected="selected"<?php }?>>Penyewaan</option>
                                                <option value="Kerjasama Pemanfaatan" <?php if($row2['TipePemanfaatan']=='Kerjasama Pemanfaatan'){?>selected="selected"<?php }?>>Kerjasama Pemanfaatan</option>
                                                <option value="Bangun Serah Guna" <?php if($row2['TipePemanfaatan']=='Bangun Serah Guna'){?>selected="selected"<?php }?>>Bangun Serah Guna</option>
                                                <option value="Bangun Guna Serah" <?php if($row2['TipePemanfaatan']=='Bangun Guna Serah'){?>selected="selected"<?php }?>>Bangun Guna Serah</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan=3><textarea name="peman_penet_eks_ket" rows="5" cols="95" required="required"><?php echo "$row2[Keterangan]";?></textarea></td>
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
                                        <td>Nama Partner</td>
                                        <td colspan=3><input type="text" size="95" name="peman_penet_eks_nmpartner" required="required" value="<?php echo "$row2[NamaPartner]";?>"></td>
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
                                        <td>Alamat Partner</td>
                                        <td colspan=3><textarea name="peman_penet_eks_alamatpartner" rows="5" cols="95" required="required"><?php echo "$row2[AlamatPartner]";?></textarea></td>
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
                                        <td>Tanggal Mulai</td>
                                        <td><input type="text" name="peman_penet_eks_tglmulai" required="required" id="id_tgl_start" value="<?php $change=$row2[TglMulai]; $hasil=format_tanggal_db3($change); echo "$hasil";?>" onchange="setjangkawaktu();"></td>
                                        <td>Tanggal Selesai</td>
                                        <td><input type="text" name="peman_penet_eks_tglselesai" required="required" id="id_tgl_end" value="<?php $change=$row2[TglSelesai]; $hasil=format_tanggal_db3($change); echo "$hasil";?>" onchange="setjangkawaktu();"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Jangka Waktu</td>
                                        <td colspan=3><input type="text" size="95" readonly="readonly" name="peman_penet_eks_jangkawaktu" required="required" value="<?php echo "$row2[JangkaWaktu]";?>" id="id_jangka_waktu"></td>
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
                                        <td colspan=4 align=center>
                                            <input type="submit" name="submit" value="Edit"/>
                                            <input type="button" value="Batal" onclick="window.location='pemanfaatan_penetapan_daftar.php'"/>
                                             <input type="hidden" name="id" value="<?php echo $row2['Pemanfaatan_ID'];?>"/>
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
	
