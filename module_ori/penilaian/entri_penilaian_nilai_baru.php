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
    $status=$_GET['status'];
    $id=$_SESSION['Aset_ID'];
?>
            <?php
        open_connection();
        
        if (isset($_GET['act']))
        {
            if ($_GET['act'] == 'Edit')
            {
                $queryselect = "SELECT a.*, b.* From Penilaian AS a LEFT JOIN NilaiAset AS b ON a.Penilaian_ID = b.Penilaian_ID
                WHERE a.Penilaian_ID = '$_GET[id]'";
                // print_r($queryselect);
                
                $result=mysql_query($queryselect) or die(mysql_error());  
                
				if ($result){
                    //echo mysql_num_rows($result);
                    $row =  mysql_fetch_object($result);
					// pr($row);
                    $NoBAPenilaian=$row->NoBAPenilaian;
                    $TglPenilaian=$row->TglPenilaian;
                    $Keterangan=$row->KeteranganPenilaian;
                    $nip=$row->NIPPenilai;
                    $namaPenilai=$row->NamaPenilai;
                    $jabatanPenilai=$row->JabatanPenilai;
                    $Aset_ID = $row->Aset_ID;
                    $KeteranganNilai = $row->KeteranganNilai;
                    $FromNilai = $row->FromNilai;
                    $ToNilai = $row->ToNilai;
                    
                    $date = explode('-', $TglPenilaian); 
                    $tgl = $date[2].'/'.$date[1].'/'.$date[0];
                }
				
            }
        }
        
        
        //echo $Aset_ID;
        //echo $namaPenilai.$nip.$Keterangan;
        
        
        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,a.Kuantitas,a.AsetOpr,a.SumberAset,
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
        $queryTypeAset="SELECT TipeAset FROM aset where Aset_ID = '".$dataArr['aset']->Aset_ID."'";
		$resultTypeAset = mysql_query($queryTypeAset) or die (mysql_error());
		$rowTypeAset =  mysql_fetch_object($resultTypeAset);
		// pr($rowTypeAset);
		$type = $rowTypeAset->TipeAset;
		if($type == 'A' || $type =='C'){
			$a = "selected";
			$b = "";
		}else{
			// echo "siniii";
			$a = "";
			$b = "selected";
		}
		
        /*$noRegistrasi = $dataArr['aset']->Pemilik.'.'.$dataArr['aset']->KodePropPerMen.'.'.
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
        $kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;*/
        
        // echo '<pre>';
        //print_r($dataArr);
        // echo '</pre>';
    ?>

<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Entri Hasil Penilaian</div>
<div id="bottomright">
<form method="post" action="<?php echo $url_rewrite?>/module/penilaian/proses_penilaian_simpan.php" />

<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/number_only.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/accounting.js""></script>
<script>
    $(function(){
        
        $('#tanggal12').datepicker($.datepicker.regional['id']);
    }
	);
	 function spoiler(obj)
	{
		var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
		//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
		if (inner.style.display =="none") {
		inner.style.display = "";
		document.getElementById('view').value="Tutup Detail";}
		else {
		inner.style.display = "none";
		document.getElementById('view').value="View Detail";}
	}

	function spoilsub(obj)
	{
		var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
		//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
		if (inner.style.display =="none") {
		inner.style.display = "";
		document.getElementById('sub').value="Tutup Sub Detail";}
		else {
		inner.style.display = "none";
		document.getElementById('sub').value="Sub Detail";}
	}
            
	function format_nilai_1(){
	var get_nilai = document.getElementById('pen_iehpdb_nlai_aset_sebelum');
	// alert(get_nilai);
	document.getElementById('pen_iehpdb_nlai_aset_sebelum').value=get_nilai.value;
	nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
	get_nilai.value=nilai;
	
	}
	
	function format_nilai_2(){
	var get_nilai = document.getElementById('pen_iehpdb_nlai_aset_setelah');
	// alert(get_nilai);
	document.getElementById('pen_iehpdb_nlai_aset_setelah').value=get_nilai.value;
	nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
	get_nilai.value=nilai;
	
	}

</script>

<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">

<!--<table width="100%" height="4%">
    <tr>
        <td width='5%'></td>
        <td>Aset ID : <span style="font-weight:bold;"><?php //echo $_SESSION['Aset_ID'];?></span></td>
    </tr>
    <tr>
        <td></td>
        <td width='30%'><span style="font-weight:bold;"><?php //echo $_GET['pmk'];?> <?php //echo $noRegistrasi;?> - <?php //echo $kodeKelompok;?></span><br>
    <?php //echo $_GET['nm'];?> <?php //echo $dataArr['aset']->NamaAset; ?></td>
        <td align="right"><input type='button' value='Lihat Info' onclick="window.location='entri_penilaian_info.php'"></td>
        <td>
    </tr>
</table>-->

            <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
            <!--<tr>
				<td width='30%'><span style="font-weight:bold;"><?php //echo $noRegistrasi;?> - <?php //echo $kodeKelompok;?></span><br>
					<?php //echo $dataArr['aset']->NamaAset; ?></td>
            <td align="right">
                <form method="POST" action="entri_penilaian_info.php">
                    <input type="submit" name="lihat_info" value="Lihat Info"/>
                    <input type="hidden" name="aset_id" value="<?php //echo $_GET['id']?>"/>
                </form>-->
                <!--
                <input type='button' value='Lihat Info' onclick="window.location='entri_penilaian_info.php'">
                -->
            <!--</td><td>
            </tr>-->
			<tr>
				<td width="150px">Nomor Registrasi</td>
				<td>:</td>
				<td>
					<?php echo $dataArr['aset']->NomorReg;?>
					<p style="float:right;">
					<input type="button" onclick="spoiler(this)" id="view" name="#" value="View Detail">
					</p>
				</td>
			</tr>
			<tr>
				<td>Nama Aset</td>
				<td>:</td>
				<td><?php echo $dataArr['aset']->NamaAset;?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php
			echo "
			<tfoot style='display:none;'>
			<tr>
			<td colspan=3>
			<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

			<table border=0 width=100%>
			<tr>
			<td>
			<input type='text' value='".$dataArr['aset']->Pemilik."' size='1px' style='text-align:center' readonly = 'readonly'> - 
			<input type='text' value='".$dataArr['aset']->NomorReg."' size='10px' style='text-align:center' readonly = 'readonly'> - 
			<input type='text' value='".$dataArr['aset']->Kode."' size='20px' style='text-align:center' readonly = 'readonly'> - 
			<input type='text' value='".$dataArr['aset']->kode_ruangan."' size='5px' style='text-align:center' readonly = 'readonly'>
			</td>
			<td align='right'><input type='button' id ='sub' value='Sub Detail' onclick='spoilsub(this);'></td>
			</tr>
			</table>

			<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
			<table width=100%>
			<tr>
			<td valign='top' align='left' width=10%>Nama Aset</td>
			<td valign='top' align='left' style='font-weight:bold'>
			".$dataArr['aset']->NamaAset."
			</td>
			</tr>

			<tr>
			<td valign='top' align='left'>Satuan Kerja</td>
			<td valign='top' align='left' style='font-weight:bold'>
			".$dataArr['aset']->NamaSatker."
			</td>
			</tr>

			<tr>
			<td valign='top' align='left'>Jenis Barang</td>
			<td valign='top' align='left' style='font-weight:bold'>
			".$dataArr['aset']->Uraian."
			</td>
			</tr>

			</table>
			</div>

			<div style='display:none; padding:5px; border:1px solid #999999;'>
			<table width=100%>
			<tr>
			<td width='*' align='left' style='background-color:#004933; color:white; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
			</tr>
			</table>

			<table>
			<tr>
			<td valign='top' style='width:150px;'>Nomor Kontrak</td>
			<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='".$dataArr['kontrak']->NoKontrak."'></td>
			</tr>

			<tr>
			<td valign='top' style='width:150px;'>Operasional/Program</td>
			<td valign='top'>
			<select style='width:130px' readonly>
			<option value=''></option>
			<option value='0' $select>Program</option>
			<option value='1' $select2>Operasional</option>
			</select>
			</td>
			</tr>

			<tr>
			<td valign='top' style='width:150px;'>Kuantitas</td>
			<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='".$dataArr['aset']->Kuantitas."'>
			Satuan
			<input type='text' readonly='readonly' style='width:130px' value='".$dataArr['aset']->Satuan."'>
			</td>
			</tr>

			<tr>
			<td valign='top' style='width:150px;'>Cara Perolehan</td>
			<td valign='top'>
			<select style='width:130px' readonly>
			<option value='-'>-</option>
			<option value='sp2d' $pilih>Pengadaan</option>
			<option value='hibah' $pilih2>Hibah</option>
			</select>
			</td>
			</tr>

			<tr>
			<td valign='top' style='width:150px;'>Tanggal Perolehan</td>
			<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='".$dataArr['aset']->TglPerolehan."'></td>
			</tr>

			<tr>
			<td valign='top' style='width:150px;'>Nilai Perolehan</td>
			<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='".$dataArr['aset']->NilaiPerolehan."'></td>
			</tr>

			<tr>
			<td valign='top' style='width:150px;'>Alamat</td>
			<td valign='top'><textarea style='width:90%' readonly>".$dataArr['aset']->Alamat."</textarea><br>
			RT/RW
			<input type='text' readonly='readonly' style='width:50px' value='".$dataArr['aset']->RTRW."'></td>
			</tr>

			<tr>
			<td valign='top' style='width:150px;'>Lokasi</td>
			<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='".$dataArr['aset']->NamaLokasi."'></td>
			</tr>
			</table>

			</div>

			</div>
			</td>
			</tr>
			</tfoot>";
			?>
		</table>
    
    
<br>

<span class="listdata" style="border-bottom:1px; padding-left:5px; padding-right:5px; color: #999999; cursor: pointer;">
<a href="entri_penilaian_nilai_simpan.php" style="font-weight:bold">Daftar Penilaian</a></span> 
<span style="border:1px solid #cccccc; border-bottom: 1px solid #ffffff; padding-left:5px; padding-right:5px;color:#999999"><b>Data Baru</b></span>   
<div id="div_datapenilaian">

<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
    <!--<tr>
        <td><b>Data Baru</b></td>
    </tr>-->      
    <tr>
        <!--<th class="listdata" colspan="">Dokumen Penilaian</th>-->
		<td class="listdata" style="font-weight: bold; font-style: underline; text-decoration: underline;">Dokumen Penilaian</td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left" width="200px">No BA Penilaian</td>
        
        <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;" name="pen_iehpdb_no_ba_penilaian" id="pen_iehpdb_no_ba_penilaian" 
                   value='<?php echo $NoBAPenilaian; ?>' required="required">
        </td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left">Tanggal Penilaian</td>
        <td class="listdata" valign="top" align="left">
            <input type="text" style="width:100px; text-align: center;"
                   value="<?php echo $tgl; ?>" name="pen_iehpdb_tgl_penilaian" id="tanggal12" datepicker="true" required="required">
        </td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left">Keterangan Penilaian</td>
        <td class="listdata" valign="top" align="left">
            <textarea id="pen_iehpdb_ket_nilai" name="pen_iehpdb_ket_penilaian"
            style="width:180px; height:100px"><?php echo $Keterangan?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border:0px;"></td>
    </tr>
</table>
    
    <br>
    
<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
    <tr>
        <!--<th class="listdata" colspan="2">Petugas Penilaian</th>-->
		<td class="listdata" style="font-weight: bold; font-style: underline; text-decoration: underline;">Petugas Penilaian</td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left" width="200px">No. SK Tim Penilai </td>
        <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px; " value="<?php echo $nip; ?>" name="pen_iehpdb_no_sk_tim_penilai" id="pen_iehpdb_no_sk_tim_penilai" required="required"/>
        </td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left" width="150px">Nama Penilai Independen</td>
        <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;" name="pen_iehpdb_nama_penilai_independen" id="pen_iehpdb_nama_penilai_independen"
                   value='<?php echo $namaPenilai; ?>' required="required">
        </td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left" width="150px">Bidang Penilai Independen</td>
        <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   name="pen_iehpdb_bidang_penilai_independen" id="pen_iehpdb_bidang_penilai_independen"
                   value="<?php echo $jabatanPenilai; ?>">
        </td>
    </tr>
</table>     
    <br>

<table table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
    <tr>
        <!--<th class="listdata" colspan="2">Perubahan Nilai Yang Terjadi</th>-->
		<td class="listdata" style="font-weight: bold; font-style: underline; text-decoration: underline;">Perubahan Nilai Yang Terjadi</td>
	</tr>	
    <tr>
        <td class="listdata" valign="top" align="left" width="200px">Jenis Barang</td>
        <td class="listdata" valign="top" align="left" width="">
            <select style="width:180px;" name="pen_iehpdb_jenis_barang" id="pen_iehpdb_jenis_barang" disabled>
            <option value="1" <?php echo $a;?>>Tanah dan/atau Bangunan</option>
            <option value="2" <?php echo $b;?>>Selain Tanah dan/atau Bangunan</option>
            </select> 
        </td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left" width="200px">Nilai Aset Sebelum Penilaian</td>
        <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;" 
            id="pen_iehpdb_nlai_aset_sebelum" name="pen_iehpdb_nlai_aset_sebelum"
            value="<?php echo number_format($FromNilai,2,',','.')?>" onchange="return format_nilai_1();" >
        </td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left">Nilai Aset Setelah Penilaian</td>
        <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   id="pen_iehpdb_nlai_aset_setelah" name="pen_iehpdb_nlai_aset_setelah"
                   value="<?php echo number_format($ToNilai,2,',','.') ?>" required=" required" onchange="return format_nilai_2();">
        </td>
    </tr>
    <tr>
        <td class="listdata" valign="top" align="left">Keterangan Nilai</td>
        <td class="listdata" valign="top" align="left">
            <textarea id="pen_iehpdb_ket_nilai" name="pen_iehpdb_ket_nilai"
            style="width:180px; height:100px"><?php echo $KeteranganNilai?></textarea>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border:0px;"> </td>
    </tr>
    <tr>
        <td colspan="2" style="border:0px;"> </td>
    </tr>
    <tr>
        <td colspan="2" style="border:1px solid #cccccc; padding:5px; text-align:right;">
            <input type="hidden" name="Penilaian_ID" value="<?php echo $_GET['id']?>">
            <?php
            (isset($_GET['act'])) ? $button = 'Edit' : $button = "Simpan";
            ?>
            <input type="submit" style="width:100px;" value="<?php echo $button?>" name="<?php echo $button?>" />
            <input type="button" style="width:100px;" value="Batal" onclick="history.back();" />
            <input type="hidden" name='Aset_ID' value="<?php echo $_SESSION['Aset_ID']?>">
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

    <?php        
        include "$path/footer.php";
    ?>
        </body>
</html>	
