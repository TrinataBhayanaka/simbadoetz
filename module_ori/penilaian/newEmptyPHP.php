<?php ob_start();?>
<html>
	<?php
        include "../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
        ?>
    
	<body>
            <?php
            include "$path/menu.php";
            $status=$_GET['Edit'];
            $id=$_GET['id'];
            ?>
            
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Entri Hasil Penilaian</div>
<div id="bottomright">
    <form method="post" action="<?php "$url_rewrite"?>/simbada_v1/module/penilaian/proses_penilaian_simpan.php">
        
        
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/number_only.js"></script>
        
        <script>
            $(function()
            {
            
            $('#tanggal12').datepicker($.datepicker.regional['id']);
           

            }

            );
        </script>   
        <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
    
                <table width="100%" height="4%">
                <div style="padding:5px;">



        <tr>
            <td width='5%'></td>
            <td>Aset ID : <span style="font-weight:bold;">48774</span></td>
        </tr>
        <tr>
            <td></td>
            <td width='30%'><span style="font-weight:bold;">99.02.23.1.XX.1 - 02.03.01.02.02.0001</span><br>
            Mobil</td>
            <td align="right"><input type='button' value='Lihat Info' onclick="window.location='entri_penilaian_info.php'"></td>
            <td>
        </tr>


        </table>
        <?php
        open_connection();
        $queryselect = "SELECT * From Penilaian WHERE Penilaian_ID = '$id'";
        $result=mysql_query($queryselect) or die(mysql_error());
        $recNum = mysql_num_rows($result);
        if ($recNum)
        {
            while( $data = mysql_fetch_object($result)){
                $row[]=$data;
            }
        }
        else
        {
            $row = '';
        }

        ?>
        <br>

        <span class="listdata" style="border-bottom:1px; padding-left:5px; padding-right:5px; color: #999999; cursor: pointer;">
            <a href="entri_penilaian_nilai_simpan.php" style="font-weight:bold">Daftar Penilaian</a></span> 
        <span style="border:1px solid #cccccc; border-bottom: 1px solid #ffffff; padding-left:5px; padding-right:5px;color:#999999"><b>Data Baru</b></span>   
        <div id="div_datapenilaian">
    
	<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
        <tr>
          <td>
            <b>Data Baru</b>            
          </td>
          </tr>      
        <tr>

          <th class="listdata" colspan="2">Dokumen Penilaian</th>
            </tr>
         <tr>
          <td class="listdata" valign="top" align="left" width="200px">No BA Penilaian</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   name="pen_iehpdb_no_ba_penilaian" id="pen_iehpdb_no_ba_penilaian"
                   value="" required="required" onchange="toggle_data_valid()"
                           onkeydown="toggle_data_valid()"
                           
                           onkeyup="toggle_data_valid()"
                           onkeypress="return numbersonly(event);" />

          </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Tanggal Penilaian</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:100px; text-align: center;"
                   name="pen_iehpdb_tgl_penilaian" id="tanggal12"
                   datepicker="true"
                   value="" onchange="toggle_data_valid()"
                           onkeydown="toggle_data_valid()"
                           onkeypress="toggle_data_valid()"
                           onkeyup="toggle_data_valid()" />
           

          </td>
        </tr>

        <tr>
          <td class="listdata" valign="top" align="left">Keterangan Penilaian</td>
          <td class="listdata" valign="top" align="left">
            <textarea style="width:180px; height:100px ;"
                   name="pen_iehpdb_ket_penilaian" id="pen_iehpdb_ket_penilaian" onchange="toggle_data_valid()" value=""
                           onkeydown="toggle_data_valid()"
                           onkeypress="toggle_data_valid()"
                           onkeyup="toggle_data_valid()"></textarea>
              </td>
        </tr>
       
        <tr>

          <td colspan="2" style="border:0px;"></td>
            </tr>
      </table>
     
      
      
      <br>

      <table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">

      
      <tr>
          <th class="listdata" colspan="2">Petugas Penilaian</th>

            </tr>
      <tr>
          <td class="listdata" valign="top" align="left" width="200px">No. SK Tim Penilai </td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px; "
                   name="pen_iehpdb_no_sk_tim_penilai" id="pen_iehpdb_no_sk_tim_penilai"
                   value="" required="required" onchange="toggle_data_valid()"
                           onkeydown="toggle_data_valid()"
                           onkeypress="toggle_data_valid()"
                           onkeyup="toggle_data_valid()">
              </td>
        </tr>
        
        <tr>

          <td class="listdata" valign="top" align="left" width="150px">Nama Penilai Independen</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   name="pen_iehpdb_nama_penilai_independen" id="pen_iehpdb_nama_penilai_independen"
                   value="" required="required" onchange="toggle_data_valid()"
                           onkeydown="toggle_data_valid()"
                           onkeypress="toggle_data_valid()"
                           onkeyup="toggle_data_valid()">
              </td>
        </tr>
        
        <tr>
          <td class="listdata" valign="top" align="left" width="150px">Bidang Penilai Independen</td>
          <td class="listdata" valign="top" align="left">

            <input type="text" style="width:180px;"
                   name="pen_iehpdb_bidang_penilai_independen" id="pen_iehpdb_bidang_penilai_independen"
                   value="" onchange="toggle_data_valid()"
                           onkeydown="toggle_data_valid()"
                           onkeypress="toggle_data_valid()"
                           onkeyup="toggle_data_valid()">
              </td>
        </tr>      
       
        </table>     
        <br>
   
      <table table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
        <tr>
          <th class="listdata" colspan="2">Perubahan Nilai Yang Terjadi</th>

            </tr>
              
            <tr>
          <td class="listdata" valign="top" align="left" width="200px">Jenis Barang</td>
          <td class="listdata" valign="top" align="left" width="">
            <select style="width:180px;" name="pen_iehpdb_jenis_barang" id="pen_iehpdb_jenis_barang">
  <option value="volvo">Tanah dan/atau Bangunan</option>
  <option value="saab">Selain Tanah dan/atau Bangunan</option>
</select> 
              </td>
        </tr>
        
        
        <tr>
          <td class="listdata" valign="top" align="left" width="200px">Nilai Aset Sebelum Penilaian</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;" 
                   id="pen_iehpdb_nlai_aset_sebelum" name="pen_iehpdb_nlai_aset_sebelum"
                   currencyedit="true"
                   value="">
              </td>
        </tr>
       
        <tr>
          <td class="listdata" valign="top" align="left">Nilai Aset Setelah Penilaian</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   id="pen_iehpdb_nlai_aset_setelah" name="pen_iehpdb_nlai_aset_setelah"
                   currencyedit="true"
                   value="">
              </td>
        </tr>
        <tr>

          <td class="listdata" valign="top" align="left">Keterangan Nilai</td>
          <td class="listdata" valign="top" align="left">
            <textarea id="pen_iehpdb_ket_nilai" name="pen_iehpdb_ket_nilai"
                      style="width:180px; height:100px"></textarea>
              </td>
            </tr>
        <tr>
          <td colspan="2" style="border:0px;"> </td>

            </tr>
            
       <tr>
          <td colspan="2" style="border:0px;"> </td>
            </tr>
        <tr>
          <td colspan="2" 
              style="border:1px solid #cccccc; padding:5px; text-align:right;">
           <input type="submit" style="width:100px;" value="Simpan">
            <a href="entri_penilaian_nilai.php">
            <input type="button" style="width:100px;" value="Batal"></a>
              </td>

            </tr>
            
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
      
      </table>
       
     
        

                                </div>
                        </form>
                        </div>
                </div>
        </div>
</div>
    
    <!--
	/*	<?php
                include "$path/footer.php"
                ?>
	</body>
</html>


<?php ob_start(); ?>
<html>
<?php
        include "../../config/config.php";
        
        include "$path/header.php";
        include "$path/title.php";
        ?>    
<body>
            <?php
        
            include "$path/menu.php";
        
            
            open_connection();
            echo '<pre>';
            //print_r($_POST);
            echo '</pre>';
            
            if ($_GET['pid']==0)
            {
                
                echo '<script type=text/javascript>alert("Page Not Found"); window.location.href="?pid=1";</script>';
            }
            $paging = ((($_GET['pid'] - 1) * 10) + 1);
            $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, 
                            d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi
                            FROM Aset AS a 
                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                            WHERE a.Aset_ID = '$_POST[pen_ID_aset]' LIMIT $paging, 10";
            
            $result = mysql_query($query) or die (mysql_error());
            
            if(mysql_num_rows($result))
            { 
                while ($data = mysql_fetch_object($result))
                {
                    $dataArr[] = $data;
                    
                }
                
                
            }
            else
            {
                $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, 
                            d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi
                            FROM Aset AS a 
                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                            LIMIT $paging, 10";
                //print_r($query);
                $result = mysql_query($query) or die (mysql_error());
                if (mysql_num_rows($result))
                {
                    while ($data = mysql_fetch_object($result))
                    {
                        $dataArr[] = $data;
                    }
                }
            }
            
            echo '<pre>';
            //print_r($dataArr);
            echo '</pre>';
            
            
            /*
            $pen_ID_aset = $_POST['pen_ID_aset'];
            $pen_nama_aset = $_POST['pen_nama_aset'];
            $pen_nomor_kontrak = $_POST['pen_nomor_kontrak'];
            $pen_tahun_perolehan = $_POST['pen_tahun_perolehan'];
            $pen_kelompok = $_POST['pen_kelompok'];
            $pen_lokasi = $_POST['pen_lokasi'];
            $pen_skpd = $_POST['pen_skpd'];
            $pen_ngo = $_POST['pen_ngo'];
            $submit = $_POST ['submit'];

            if ($pen_ID_aset!=""){
                $query_pen_ID_aset="Aset_ID='".$pen_ID_aset."' ";
            }
            if($pen_nama_aset!=""){
                $query_pen_nama_aset ="NamaAset LIKE '%".$pen_nama_aset."%' ";
            }
            if($pen_tahun_perolehan!=""){
                $query_pen_tahun_perolehan ="Tahun='".$pen_tahun_perolehan."' ";
            }

            $parameter_sql="";
            
            if($pen_ID_aset!=""){
                $parameter_sql=$query_pen_ID_aset;
            }
            if($pen_nomor_aset!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_pen_nomor_aset;
            }
            if($pen_nomor_aset!="" && $parameter_sql==""){
                $parameter_sql=$query_pen_nomor_aset;
            }
            if($pen_tahun_perolehan!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_pen_tahun_perolehan;
            }
            if ($pen_tahun_perolehan!="" && $parameter_sql==""){
                $parameter_sql=$query_pen_tahun_perolehan;
            }
            
            echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE".$parameter_sql;
            }
                if (isset($submit))
                    {
                    if($pen_ID_aset==""&&$pen_nama_aset==""&&$pen_nomor_kontrak==""&&$pen_tahun_perolehan==""&&$pen_kelompok==""&&$pen_lokasi==""&&$pen_skpd==""&&$pen_ngo==""){
                        ?>
                        <script>var r=confirm('Tidak ada isian filter');
                        if (r==false)
                        {
                                document.location="<?php echo "$url_rewrite/module/penilaian/";?>entri_penilaian_filter.php";
                        }
                        </script>
	<?php
                    }
                    }
                    */
                    ?>
            
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Entri Hasil Penilaian</div>
<div id="bottomright">

<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left">Filter data : <u>Tidak ada filter (View seluruh data)</u></th>
    </tr>
</table>
<br>
<div align="right">
<input type="button"
            value="Kembali ke halaman utama : Cari Aset"
            onclick="document.location='entri_penilaian_filter.php'"
            title="Kembali ke halaman utama : Cari Aset">
<input type="button"
            value="Cetak daftar aset (PDF)"
            onclick=""
            title="Cetak daftar aset (PDF)"><br>
            Waktu proses: 0.0061 detik. Jumlah 1 aset dalam 1 halaman.
</div>


<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    <tr>
        <td colspan ="2" align="right">
            <input type="button" value="Prev" onclick="window.location.href='?pid=<?=$_GET[pid] - 1; ?>'">
            <input type="button" value="Next" onclick="window.location.href='?pid=<?=$_GET[pid] + 1; ?>'">
        </td>
    </tr>
    <tr>
        <td width='5%' style="background-color: #eeeeee; border: 2px solid #dddddd;"></td>
        <td colspan='2' style="background-color: #eeeeee; border: 2px solid #dddddd;font-weight:bold;"> Informasi Aset</td>
    </tr>
    <?php 
    
    if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
    
    foreach ($dataArr as $key => $value)
    {
        //echo $value->Aset_ID;
    
    ?>
    <tr>
        <td align="center" style="border: 2px solid #dddddd;"><?=$no?></td>

        <td style="border: 2px solid #dddddd;">

                <table width='100%'>
                    <tr>
                        <td height="10px"></td>
                    </tr>

                    <tr>
                        <td>
                            <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?=$value->Aset_ID?></span>
                            <span>( Aset ID - System Number )</span>
                        </td>
                        <td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
                            <a href='entri_penilaian_nilai_simpan.php'>Penilaian</a></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?=$value->Pemilik?>.02.23.1.XX.1 </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?=$value->Kode?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?=$value->NamaAset?></td>
                    </tr>

                </table>

                <br>
                <hr />
                <table>
                    <tr>
                        <td width="30%"> No.Kontrak</td> <td><?=$value->Kontrak_ID?></td>
                    </tr>
                    <tr>
                        <td>Satker</td> <td><?='['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td> <td><?=$value->NamaLokasi?></td>
                    </tr>
                    <tr>
                        <td>Status</td> <td><?=$value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
                    </tr>

                </table>
         </td>
    </tr>
    <?
        $no++;
    }
    ?>
    <tr>
        <td width='5%' style="background-color: #eeeeee; border: 2px solid #dddddd;"></td>
        <td colspan='2' style="background-color: #eeeeee; border: 2px solid #dddddd;font-weight:bold;">&nbspInformasi Aset</td>
    </tr>
    <tr>
        <td colspan ="2" align="right">
            <input type="button" value="Prev" onclick="window.location.href='?pid=<?=$_GET[pid] - 1; ?>'">
            <input type="button" value="Next" onclick="window.location.href='?pid=<?=$_GET[pid] + 1; ?>'">
        </td>
    </tr>
</table>

</div>
</div>
</div>
</div>
	<?php
        include "$path/footer.php";
        ?>*/
	</body>
</html>	
-->