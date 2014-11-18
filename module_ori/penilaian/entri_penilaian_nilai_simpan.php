<?php 
ob_start();
//echo 'test';?>
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
            $id_aset=$_POST['pen_id_aset_post'];
            $namaaset=$_POST['pen_id_namaaset_post'];
            $pemilik=$_POST['pen_id_pemilik_post'];
            //$lastID = $_GET['lastID'];
            
            if (isset($_GET['id']))
            {
                if ($_GET['id'] !== '')
                {
                    $_SESSION['Aset_ID'] = $_GET['id'];
                }
            }
            
         // echo $_SESSION['Aset_ID'];  
        $query ="SELECT Penilaian_ID FROM NilaiAset WHERE Aset_ID = $_SESSION[Aset_ID]";
        // pr($query); 
   
	 //print_r($query);
	    $result = mysql_query($query) or die (mysql_error()) ;
            $recNum = mysql_num_rows($result);
            if ($recNum)
            {
                while( $data = mysql_fetch_object($result)){
					// pr($data);
                    $Penilaian_ID [] =$data;
                }
            }
            else
            {
                $Penilaian_ID = '';
            }

		// pr($Penilaian_ID );
	if ($Penilaian_ID !='')
	{
		foreach ($Penilaian_ID as $value)
	    {
		$query = "SELECT Penilaian_ID, NoBAPenilaian, TglPenilaian, KeteranganPenilaian FROM Penilaian WHERE Penilaian_ID ='$value->Penilaian_ID'";
		//echo $query;
		// print_r($query);
		$result = mysql_query($query) or die (mysql_error());
		

			if (mysql_num_rows($result))
		{
		    $dataPenilaian[] = mysql_fetch_object($result);
		}
	    }
	}
	   
	    
	    
	    
	    //print_r($dataPenilaian);
	    
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
		$check = mysql_num_rows($result);
        $dataArr['aset'] = mysql_fetch_object($result);
        // pr($dataArr['aset']);
        $query = "SELECT Kontrak_ID FROM KontrakAset WHERE Aset_ID = '".$dataArr['aset']->Aset_ID."'";
        // pr($query);
		$result = mysql_query($query) or die (mysql_error());
        
        if (mysql_num_rows($result))
        {
            $data = mysql_fetch_object($result);
            // pr($data);
            $query = "SELECT NoKontrak FROM Kontrak WHERE Kontrak_ID = '$data->Kontrak_ID'";
            $result = mysql_query($query) or die (mysql_error());
            
            if (mysql_num_rows($result))
            {
                $dataArr['kontrak'] = mysql_fetch_object($result);
            }
        }
		if ($dataArr['aset']->AsetOpr==0)
			$select="selected='selected'";
		if ($dataArr['aset']->AsetOpr==1)
			$select2="selected='selected'";

		if($dataArr['aset']->SumberAset=='sp2d')
			$pilih="selected='selected'";
		if($dataArr['aset']->SumberAset=='hibah')
			$pilih2="selected='selected'";
        // pr($dataArr);
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
            
            ?>
            
            <script language="javascript">
                $(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "desc" ]]
				} );
				});
				
				function confirm_delete(go_url)
                {
                var answer = confirm("Hapus Data");
                if (answer)
                {

                location=go_url;
                }
               }
			   
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
            
            </script>
            
    <div id="tengah1">	
    <div id="frame_tengah1">
    <div id="frame_gudang">
    <div id="topright">
            Entri Hasil Penilaian
    </div>
    <div id="bottomright">
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
    <!--</div>-->
    <br>
    <span style="border:1px solid #cccccc; padding-left:5px; padding-right:5px; border-bottom: 1px solid #ffffff;color: #999999"><b>Daftar Penilaian</b></span>&nbsp;
    <span class="listdata" style="padding-left:5px; padding-right:5px; cursor:pointer;"><a href="entri_penilaian_nilai_baru.php" style="font-weight:bold;">Data Baru</a></span>&nbsp;  
    <!--<div id="div_datapenilaian">-->
    <!--<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">-->
	<div id="demo">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">	
    <thead>
	<tr>
        <th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
        <th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">No BA Penilaian</th>
        <th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl Penilaian</th>
        <th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan Penilaian</th>
        <th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tindakan</th>
	</tr>
	</thead>
	<tbody>
             
          <?php  
          $no = 1; 
          
          if ($dataPenilaian !='')
          {
		  // pr($dataPenilaian);
          foreach($dataPenilaian as $key => $val){ 
              $tanggal=$val->TglPenilaian;
              $date = explode('-', $tanggal); 
              $tgl = $date[2].'/'.$date[1].'/'.$date[0];
              ?>
			<tr>
                <td class="listdata" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $no?></td>
                <td class="listdata" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $val->NoBAPenilaian; ?></td>
                <td class="listdata" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $tgl ?></td>
                <td class="listdata" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $val->KeteranganPenilaian;  ?></td>
                <td class="listdata" valign="top" align="center" style="border: 1px solid #dddddd;" width="100" >
                    <?php //echo"<a href=\"#\" class=\"listdata\" onClick=\"confirm_delete('proses_penilaian_simpan.php?id=$val->Penilaian_ID&status=Delete') \"title=\"Hapus\">Hapus</a>";?>
                    <?php echo"<a class=\"listdata\" href=\"entri_penilaian_nilai_baru.php?id=$val->Penilaian_ID&act=Edit\">Edit</a>&nbsp;|";?> 
                    <?php echo"<a href=\"#\" class=\"listdata\" onClick=\"confirm_delete('proses_penilaian_simpan.php?id=$val->Penilaian_ID&act=Delete') \"title=\"Hapus\">Hapus</a>";?>
                </td>
		   </tr>  
			<?php  
				$no++;
				}
			}
			else
			{
              ?>
               <!--<tr>
                   <td colspan="10" align='center'>Tidak ada data</td>
               </tr>-->
               <?php
            }
          ?>
		</tbody>
	<tfoot>
		<tr>
			<td colspan="5"></td>
		</tr>
	</tfoot>
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
