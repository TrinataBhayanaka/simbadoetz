<?php ob_start(); ?>
<html>
<?php
        include "../../config/config.php";
        
        include "$path/header.php";
        include "$path/title.php";
        ?>    
	<body>
            <?php
			$_SESSION['ses_uoperatorid'];
            include "$path/menu.php";
            open_connection();
			?>
             
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function() {
					$('#example').dataTable( {
						"aaSorting": []
					} );
				} );
			</script>
              
            
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Validasi</div>
<div id="bottomright">

<?php
		$paging		= paging($_GET['pid'], 100);
		$viewTable = 'daftar_validasi_aset'.$_SESSION['ses_uoperatorid'];
		if($_SESSION['ses_uaksesadmin']){
			$query2="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.KodeUnit,e.Gudang,e.NamaSatker,  
					f.Baik,f.RusakRingan,f.RusakBerat,f.BelumManfaat,f.BelumSelesai,f.BelumDikerjakan,
					f.TidakSempurna,f.TidakSesuaiUntuk,f.TidakSesuaiSpec,f.TidakDikunjungi,f.TidakJelas,f.TidakDitemukan,	
					KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					INNER JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					INNER JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					INNER JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.StatusValidasi=1
					ORDER BY a.Aset_ID asc ";
		}else{
			$query2="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.KodeUnit,e.Gudang,e.NamaSatker,  
					f.Baik,f.RusakRingan,f.RusakBerat,f.BelumManfaat,f.BelumSelesai,f.BelumDikerjakan,
					f.TidakSempurna,f.TidakSesuaiUntuk,f.TidakSesuaiSpec,f.TidakDikunjungi,f.TidakJelas,f.TidakDitemukan,	
					KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					INNER JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					INNER JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					INNER JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.StatusValidasi=1 AND a.UserNm = $_SESSION[ses_uoperatorid]
					ORDER BY a.Aset_ID asc ";
		}
		$exec = mysql_query($query2) or die(mysql_error());
		$sqlCount 	= "SELECT * FROM $viewTable";
		$execCount	= mysql_query($sqlCount) or die(mysql_error());
		$count  = mysql_num_rows($execCount);
		$sql 	= "SELECT * FROM $viewTable LIMIT $paging, 100";
		$exec	= mysql_query($sql) or die(mysql_error());
		while ($dataAset = mysql_fetch_object($exec)){
			$dataArr[] = $dataAset;
		}	
        
?>

<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <td colspan="2" align="left" style="font-weight:bold;">Jumlah data : <?php echo $count ?> Record</u></td>
    </tr>
</table>
<br>
<div align="right">
<input type="button"
            value="Kembali ke halaman utama : Cari Aset"
            onclick="document.location='validasi.php'"
            title="Kembali ke halaman utama : Cari Aset">
<input type="button"
            value="Tambah Data"
            onclick="document.location='hasil_validasi.php?pid=1'"
            title="Tambah Data"><br>
            
</div>
<table width='100%' border='0'>
    <tr>
        <td colspan ="3" align="right">
			<table border="0" width="100%">
				<tr>
					<td align="right" width="200px">
							<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
							<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
							<span><input type="button" value="<< Prev" class="buttonprev"/>
							Page
							<input type="button" value="Next >>" class="buttonnext"/></span>
					</td>
				</tr>
			</table>
        </td>
    </tr>
</table>

<div>
    <br>
</div>

<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;" width="5%">No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
		</tr>
	</thead>
	<tbody>
    <?php
    if (!empty($dataArr))
    {
        $disabled = '';
    
		$nomor = 1;
		$page = @$_GET['pid'];
		if ($page > 1){
			$nomor = intval($page - 1 .'01');
		}else{
			$nomor = 1;
		}
    foreach ($dataArr as $key => $value)
    {
if($value->Baik != 0){
			$Baik ="Baik";}
		else{
			$Baik ="";
		}	
		if($value->RusakRingan != 0){
			$RusakRingan ="Rusak Ringan";}
		else{
			$RusakRingan ="";
		}
		if($value->RusakBerat != 0){
			$RusakBerat ="Rusak Berat";}
		else{
			$RusakBerat ="";
		}	
		if($value->BelumManfaat != 0){
			$BelumManfaat ="Belum Manfaat";}
		else{
			$BelumManfaat ="";
		}	
		if($value->BelumSelesai != 0){
			$BelumSelesai ="Belum Selesai";}
		else{
			$BelumSelesai ="";
		}	
		if($value->BelumDikerjakan != 0){
			$BelumDikerjakan ="Belum Dikerjakan";}
		else{
			$BelumDikerjakan="";
		}	
		if($value->TidakSempurna != 0){
			$TidakSempurna ="Tidak Sempurna";}
		else{	
			$TidakSempurna ="";
		}
		if($value->TidakSesuaiUntuk != 0){
			$TidakSesuaiUntuk ="Tidak Sesuai Peruntukan";}
		else{
			$TidakSesuaiUntuk="";
		}	
		
		if($value->TidakSesuaiSpec != 0){
			$TidakSesuaiSpec ="Tidak Sesuai Spesifikasi";}
		else{
			$TidakSesuaiSpec ="";
		}	
		if($value->TidakDikunjungi != 0){
			$TidakDikunjungi ="Tidak Dapat Dikunjungi";}
		else{
			$TidakDikunjungi="";
		}	
		if($value->TidakJelas != 0){
			$TidakJelas ="Alamat Tidak Jelas";}
		else{
			$TidakJelas="";
		}	
		if($value->TidakDitemukan != 0){
			$TidakDitemukan ="Aset Tidak Ditemukan";}
		else{
			$TidakDitemukan="";
		}		
    ?>
    <tr class="<?php if($nomor == 1) echo ' '?>">
        <td align="center" style="border: 1px solid #dddddd;"><?php echo $nomor?></td>
        <td style="border: 1px solid #dddddd;">

                <table width='100%'>
                    <tr>
                        <td height="10px"></td>
                    </tr>

                    <tr>
                        <td>
                            <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
                            <span>( Aset ID - System Number )</span>
                        </td>
                    </tr>
                    <?php 
						$tmp = explode('.',$value->NomorReg);
						$slice = array_slice($tmp,0, count($tmp)-1, true);
						$noRegOri = implode('.',$slice);
						$noReg = end($tmp);
						// echo "no reg".$noReg; 
					?>
					<tr>
                        <td style="font-weight:bold;"><?php echo $noRegOri?> </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->Kode.".".$noReg?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
                    </tr>

                </table>
                <br>
                <hr />
                <table border=0 width="100%">
                    <tr>
                        <td width="20%"> No.Kontrak</td> 
                        <td width="2%">&nbsp;</td>
                        <td width="78%"><?php echo $value->Kontrak_ID?></td>
                    </tr>
                    <tr>
                        <td>Satker</td> 
                        <td>&nbsp;</td>
                        <td><?php if($value->KodeSatker !="") $satker = "[".$value->KodeSatker."]"."&nbsp;".$value->NamaSatker;
							if($value->KodeUnit != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit."]"."&nbsp;".$value->NamaSatker;
							if($value->Gudang != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit.".".$value->Gudang."]"."&nbsp;".$value->NamaSatker;
							// echo '['.$value->KodeSatker.'.'.$value->KodeUnit.'.'.$value->Gudang.']'."&nbsp;".$value->NamaSatker
							echo $satker;?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td> 
                        <td>&nbsp;</td>
						<td><?php echo $value->NamaLokasi?></td>
                    </tr>
                    <tr>
                        <td>Status</td> 
                        <td>&nbsp;</td>
						<td><?php 
							echo $Baik;
							echo $RusakRingan;
							echo $RusakBerat;
							echo $BelumManfaat;
							echo $BelumSelesai;
							echo $BelumDikerjakan;
							echo $TidakSempurna;
							echo $TidakSesuaiUntuk;
							echo $TidakSesuaiSpec;
							echo $TidakDikunjungi;
							echo $TidakJelas;
							echo $TidakDitemukan;
						?></td>
                    </tr>
                </table>
         </td>
    </tr>
    <?php
        $nomor++;
    }
    }
    else
    {
        $disabled = 'disabled';
    }
    ?>
	</tbody>
    <tfoot>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
			
		</tr>
	</tfoot>
</table>

</div>

<div class="spacer"></div>
<!-- End Frame -->

</div>
</div>
</div>
</div>
	<?php
        include "$path/footer.php";
        ?>
	</body>
</html>	
