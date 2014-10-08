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
            
            open_connection();
            
            //print_r($_POST);
            
            $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                            c.Kelompok, c.Uraian, c.Kode,
                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                            f.InfoKondisi
                            FROM Aset AS a 
                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                            WHERE a.Aset_ID = '$_SESSION[Aset_ID]' LIMIT 1";
        //print_r($query);
        $result = mysql_query($query) or die(mysql_error());
        //$result1 = mysql_query($query1) or die(mysql_error());
        $check = mysql_num_rows($result);
        $dataArr['aset'] = mysql_fetch_object($result);
        
        $query = "SELECT Kontrak_ID FROM KontrakAset WHERE Aset_ID = '".$dataArr['aset']->Aset_ID."'";
        $result = mysql_query($query) or die (mysql_error());
        
        if (mysql_num_rows($result))
        {
            $data = mysql_fetch_object($result);
            
            $query = "SELECT NoKontrak FROM Kontrak WHERE Kontrak_ID = '$data->Kontrak_ID'";
            $result = mysql_query($query) or die (mysql_error());
            
            if (mysql_num_rows($result))
            {
                $dataArr['kontrak'] = mysql_fetch_object($result);
            }
        }
        
        $noRegistrasi = $dataArr['aset']->Pemilik.'.'.$dataArr['aset']->KodePropPerMen.'.'.
                        $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                        substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $noRegistrasi2 = $dataArr['aset']->KodePropPerMen.'.'.
                         $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                         substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $a = count ($dataArr['aset']->NomorReg);
        for ($i = 0; $i <= 3; $i++)
        {
            if ($i >= $a)
            $b[] = 0;
        }
        
        
        
        $kodeKelompok = $dataArr['aset']->Kode.'.'.$b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        $kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
            ?>
        
        <div id="tengah1">	
        <div id="frame_tengah1">
        <div id="frame_gudang">
        <div id="topright">Entri Hasil Penilaian</div>
        <div id="bottomright">
            
<table width="100%" height="4%">
    <tr>
        <td width='5%'></td>
        <td>Aset ID : <span style="font-weight:bold;"><?php echo $dataArr['aset']->Aset_ID?></span></td>
    </tr>
    <tr>
        <td></td>
        <td width='30%'>
            <span style="font-weight:bold;"><?php echo $noRegistrasi;?> - <?php echo $kodeKelompok;?></span>
        </td>
        <td align="right">
            <input type='button' value='Tutup Info' onclick="window.location='entri_penilaian_nilai_simpan.php'">
        </td>
    </tr>
    <tr>
        <td></td>
        <td><span style="font-weight:strong;"><?php echo $dataArr['aset']->NamaAset; ?></span></td>
    </tr>
    
</table>
            
<br>
<div style="width:'100%'; height:200px; overflow:auto; border: 1px solid #dddddd;">
    
<table width='100%' border="0">
    <tr>
        <td width='45px'><input type="text" value='<?php echo $dataArr['aset']->Pemilik?>' readonly="readonly"  size='1%' style="text-align:center;font-weight:bold;" />&nbsp;-</td>
        <td width='200px'><input type="text" value='<?php echo $noRegistrasi2 ?>' readonly="readonly" size='25' style="text-align:center;font-weight:bold;" />&nbsp;-</td>
        <td width='160px'><input type="text" value='<?php echo $kodeKelompok;?>' readonly="readonly" size="18%" style="text-align:center;font-weight:bold;" />&nbsp;-</td>
        <td><input type="text" value='<?php echo $kodeKelompok2;?>'  size='5%' readonly="readonly" style="text-align:center;font-weight:bold;" /></td>
    </tr>
</table>
    
<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <td>

    <table width='100%'>
        <tr>
            <td width='15%'>Nama Aset</td>
            <td style="font-weight:bold;""><?php echo $dataArr['aset']->NamaAset ?></td>
        </tr>
        <tr>
            <td>Satuan Kerja</td>
            <td style="font-weight:bold;"><?php echo $dataArr['aset']->NamaSatker ?></td>
        </tr>
        <tr>
            <td>Jenis Barang</td>
            <td style="font-weight:bold;"><?php echo $dataArr['aset']->Uraian ?></td>
        </tr>
        <tr>
            <td colspan='2'><hr /></td>
        </tr>
        <tr>
            <td colspan='2' style="background-color: #eeeeee;">Informasi Tambahan</td>
        </tr>
        <tr>
            <td>Nomor Kontrak</td>
            <td><input type='text' name="pen_iehpt_no_kontrak" value="<?php echo $dataArr['kontrak']->NoKontrak ?>" readonly="readonly" /></td>
        </tr>
        <tr>
            <td></td><td>Tidak ada informasi</td>
        </tr>
        <tr>
            <td>Operasional/Program</td>
            <td>
                <select>
                    <option selected="selected">Program</option>
                    <option>Operasional</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Kuantitas</td>
            <td><input type='text' name="pen_iehpt_kuantitas" value='<?php echo $dataArr['aset']->Uraian ?>' size="30" readonly="readonly"> Satuan : <input type='text' value='<?php echo $dataArr['aset']->Satuan ?>' size="2" readonly="readonly"></td>
        </tr>
        <tr>
            <td>Cara Perolehan</td>
            <td>
                <select>
                    <option>-</option>
                    <option>Pengadaan</option>
                    <option>Hibah</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal Perolehan</td>
            <td><input type='text' name="pen_iehpt_tgl_perolehan" readonly="readonly" value="<?php echo $dataArr['aset']->TglPerolehan ?>"></td>
        </tr>
        <tr>
            <td>Nilai Perolehan</td>
            <td><input type='text' name="pen_iehpt_nilai_perolehan" value="<?php echo $dataArr['aset']->NilaiPerolehan ?>" readonly="readonly" ></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" name="pen_iehptl_penilaian_alamat" value="<?php echo $dataArr['aset']->Alamat ?>" readonly="readonly"></td>
        </tr>
        <tr>
            <td></td>
            <td>RT/RW <input type='text' name="pen_iehpt_penilaian_rt_rw" value="<?php echo $dataArr['aset']->RTRW ?>" readonly="readonly" size='3'></td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td><input type='text' name="pen_iehpt_penilaian_lokasi" value="" size='100'> <input type='button' value='Cari' disabled='disabled'></td>
        </tr>
        <tr>
            <td align="center" height="0px">Koordinat :</td>
        </tr>
        <tr>
            <td>Bujur</td>
            <td><input type="text" name="" readonly="readonly" value=""></td>
            
        </tr>
        <tr>
            <td>Lintang</td>
            <td><input type="text" name="" readonly="readonly" value=""></td>
            
        </tr>
    </table>


        </td>		
    </tr>
</table>
    
</div>
<br>

    <span style="border:1px solid #cccccc; padding-left:5px; padding-right:5px; color: #999999; border-bottom: 1px solid #ffffff;"><b>Daftar Penilaian</b></span>&nbsp;
    <span class="listdata" style="padding-left:5px; padding-right:5px; cursor:pointer;">
        <a href="entri_penilaian_nilai_baru.php" style="font-weight:bold;">Data Baru</a></span>&nbsp;  <div id="div_datapenilaian">
        
<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
    <tr>
        <td align="center" style="padding:15px; font-size:12pt; color:#003c2a; font-weight: bold;">... tidak ada data ...</td>
    </tr>
</table>
								
    </div>
    </div>
    </div>
</div>
</div>
    
    <?php
        include "$path/footer.php";
    ?>
            
	</body>
</html>	
