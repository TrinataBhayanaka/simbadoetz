<?php
        
    include "../../config/config.php";

        /*$tgl_awal=$_POST['penggu_penet_filt_tglawal'];
        $tgl_akhir=$_POST['penggu_penet_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$_POST['penggu_penet_filt_nopenet'];
        $satker=$_POST['kelompok'];
        $submit=$_POST['tampil'];
     */   
        
        /*$submit2=$_POST['penggunaan_eks'];*/
        
        //open_connection();
        
       
            /*if ($tgl_awal!=""){
            $query_tgl_awal="Tgl_SKKDH='".$tgl_awal."' ";
            }
            if($tgl_akhir!=""){
            $query_tgl_akhir="Tgl_SKKDH='".$tgl_akhir."' ";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH='".$no_penetapan_penggunaan."' ";
            }
            if($satker!=""){
                $query_satker="NamaSatker='".$satker."' ";
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_akhir;
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker;
            }
            
            echo "$parameter_sql";
            
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql ." AND Penggunaan_ID".;
            }*/
            
            
       /* if (isset($submit)){
            if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_penggunaan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_filter.php";
                            }
                </script>
        <?php
            }
        }*/
        ?>   

<html>
    <?php
        include "$path/header.php";
    ?>
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
                            Daftar Mutasi Barang
                        </div>
                        <div id="bottomright">
                           
                            <div style="margin-bottom:10px; float:left;">
                                <a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_antar_skpd.php"><input type="submit" value="Kembali ke Form Filter"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right;">
                                <a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_antar_skpd.php"><input type="submit" value="Tambah Data"></a>
                            </div>
                            <table cellspacing="0" cellpadding="0" width="100%" style="margin-top:0px; border: 1px solid black; border-width: 1px 1px 1px 1px;">
                                <tbody>
                                    <tr style="background-color:#004933; color:white; height:20px;">
                                        <th width="15px" align="center" style="border: 1px solid black;">No</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Nomor SKKDH</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Tgl SKKDH</th>
                                        <th width="200px" align="center" style="border: 1px solid black;">Keterangan</th>
                                        <th width="100px" align="center" style="border: 1px solid black;">Tindakan</th>
                                    </tr>
                                    <?php
                                        
                                        //$hsl_data=mysql_fetch_array($exec);
                                        
                                        
                                       /* $query_fix_satker="SELECT * FROM Satker where NamaSatker='$satker'";
                                        $exec_fix_satker=mysql_query($query_fix_satker);
                                        $hsl_data_fix_satker=  mysql_fetch_array($exec_fix_satker);
                                        $id_aset=$hsl_data_fix_satker['Satker_ID'];
                                        
                                        $query_aset="SELECT * FROM Aset where LastSatker_ID='$id_aset'";
                                        $exec_aset=mysql_query($query_aset);
                                        $hsl_data_aset=  mysql_fetch_array($exec_aset);
                                         
                                        $id_penggunaan=$hsl_data_aset['Aset_ID'];
                                        $query_satker="SELECT * FROM PenggunaanAset where Aset_ID='$id_penggunaan'";
                                        $exec_satker=mysql_query($query_satker) or die(mysql_error());
                                        $hsl_data_satker=mysql_fetch_array($exec_satker);
                                        
                                        $fix=$hsl_data_satker['Penggunaan_ID'];
                                        
                                        
                                     if($tgl_akhir!="" || $tgl_awal!="" || $no_penetapan_penggunaan!="" || $satker!=""){
                                        $query="SELECT * FROM Penggunaan where FixPenggunaan=1 and Status=0 and (NoSKKDH='$no_penetapan_penggunaan' OR TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix' OR Penggunaan_ID='$fix') limit 10";
                                        $exec = mysql_query($query) or die(mysql_error());
                                                                                                            
                                        //$exec = mysql_query($query) or die(mysql_error());
                                     }else{
                                         */
                                    
                                         // untuk status idle
                                    
                                            /*
                                            $query3="SELECT * FROM PenggunaanAset where Status=0 limit 10";
                                            $exec = mysql_query($query3) or die(mysql_error());
                                            $hsl=  mysql_fetch_array($exec);
                                            
                                            $id_penggunaan_aset=$hsl['Penggunaan_ID'];
                                            */
                                            $query2="SELECT * FROM Mutasi where FixMutasi=1 limit 10";
                                            $exec2 = mysql_query($query2) or die(mysql_error());
                                        //}
                                        
                                        //$check = mysql_num_rows($exec);
                                        
                                        $i=1;
                                        while($hsl_data=mysql_fetch_array($exec2)){
                                    ?>
                                    <tr>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$i";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[NoSKKDH]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$hsl_data[TglSKKDH]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$hsl_data[Keterangan]";?></td>
                                        <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;">
                                            <a href="<?php echo "$url_rewrite/report/template/MUTASI/";?>tes_class_mutasi_transfer_antar_skpd.php?menu_id=22&mode=1&id=<?php echo "$hsl_data[Mutasi_ID]";?>" target="_blank">Cetak</a> || <a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_proses_hapus.php?id=<?php echo "$hsl_data[Mutasi_ID]";?>">Hapus</a> || <a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_edit.php?id=<?php echo "$hsl_data[Mutasi_ID]";?>">Edit</a>
                                        </td>
                                    </tr>
                                    <?php $i++; }?>
                                </tbody>
                            </table>	
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
