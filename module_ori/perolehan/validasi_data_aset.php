<?php

include "../../config/config.php";

$menu_id = 11;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

if (isset($_POST['confirm']))
{
    
    $user=$_SESSION['ses_uoperatorid'];
    $crud=$_SESSION['ses_uCRUD_modul'][0];
    $param=$_POST['param'];
    //print_r($_POST['validasi']);
	$explode = $_POST['validasi'];
    switch ($param)
    {
        case 'validasi':
            {
				$uid=$_SESSION['ses_uname'];
				$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi[]' AND UserNm='$uid'";       
				$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
				$data_apl = $DBVAR->fetch_array($result_apl);
				$sql = "SELECT Aset_ID FROM Aset WHERE Aset_ID IN ({$data_apl['aset_list']})";
                $res = mysql_query($sql);
                $dataAsetUser = $HELPER_FILTER->getAsetUser(array('Aset_ID'=>$data_apl['aset_list']));
                // pr($dataAsetUser);exit;
				while ( $dataAset = mysql_fetch_object($res)){
				foreach ($dataAset as $aset_id)
					{
						if (($_SESSION['ses_uaksesadmin'] == 1)){
							$query = "update Aset SET StatusValidasi=1 where Aset_ID=$aset_id";
							$exec = mysql_query($query) or die(mysql_error());
						}else{
							if (in_array($aset_id, $dataAsetUser)){
								$query = "update Aset SET StatusValidasi=1 where Aset_ID=$aset_id";
								$exec = mysql_query($query) or die(mysql_error());
							}else{
								$messg = 'Anda tidak punya akses untuk Aset ini';
						  }	
						}
						
					}
				}	
					$messg = 'Data sudah tervalidasi';
            }
            break;
        
        case 'delete':
            {
				$uid=$_SESSION['ses_uname'];
				$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi' AND UserNm='$uid'";       
				$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
				$data_apl = $DBVAR->fetch_array($result_apl);
				$sql = "SELECT Aset_ID FROM Aset WHERE Aset_ID IN ({$data_apl['aset_list']})";
                $res = mysql_query($sql);
                $dataAsetUser = $HELPER_FILTER->getAsetUser(array('Aset_ID'=>$data_apl['aset_list']));
				while ( $dataAset = mysql_fetch_object($res)){
				foreach ($dataAset as $aset_id)
					{
						if (($_SESSION['ses_uaksesadmin'] == 1)){
							$query = "DELETE FROM Aset WHERE Aset_ID = $aset_id";
							$exec = mysql_query($query) or die(mysql_error());
						}else{
							if (in_array($aset_id, $dataAsetUser)){
							$query = "DELETE FROM Aset WHERE Aset_ID = $aset_id";
							$exec = mysql_query($query) or die(mysql_error());
						
						      }else{
							
							$messg = 'Anda tidak punya akses untuk Aset ini';
						  }	
						}
						
					}
				}
				
                
                $messg = 'Data sudah dihapus';
            }
		break;	
    }
    
    
    $clear_apl_userasetlist = $DELETE->clear_table_apl_userasetlist_by_module('validasi[]', $_SESSION['ses_uid']);
    
    echo "<script>alert('$messg'); document.location='validasi.php?pid=1';</script>";   
    
}


?>

<html>
<?php
        //include "../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
        ?>    
<body>
            <?php
        
            include "$path/menu.php";

 if (isset($_GET['param']))
 {
    if ($_GET['param'] == 'delete')
    {
        $messg = "Penghapusan Data Aset";
        $button_value = 'Hapus Data';
    }
    if ($_GET['param'] == 'validasi')
    {
        $messg = "Validasi Data Aset";
        $button_value = 'Validasi Data';
    }
 }
 
 
?>

<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Validasi Barang Pengadaan</div>
<div id="bottomright">

<!--Begin -->
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
		$('#example').dataTable( {
				"aaSorting": [[ 1, "asc" ]]
			} );
		} );
		
		function validate()
		{
		var chks = document.getElementsByName('validasi[]');
		// alert('c);
		var hasChecked = false;
		for (var i = 0; i < chks.length; i++)
		{
		if (chks[i].checked)
		{
		hasChecked = true;
		break;
		}
		}
		if (hasChecked == false)
		{
		alert("Ceklis Pilihan Terlebih Dahulu !");
		return false;
		}
		return true;
		}
	</script>
<!--End-->	

<form method="POST" action="" onSubmit="return validate()">
	<?php     
        //$validasi_button_disable = 'disabled';                
		//print_r($query);
		$uid=$_SESSION['ses_uname'];
		//pr($uid);
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi[]' AND UserNm='$uid'";       
		$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
        $data_apl = $DBVAR->fetch_object($result_apl);
        $dataImplode = $data_apl->aset_list;
		$paging		= paging($_GET['pid'], 100);
		if($dataImplode !=""){
			// echo "masuk";
			$viewTable = 'validasi_aset'.$_SESSION['ses_uoperatorid'];
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
							WHERE a.Aset_ID IN ({$dataImplode})
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
							WHERE a.Aset_ID IN ({$dataImplode}) AND a.UserNm = $_SESSION[ses_uoperatorid]
							ORDER BY a.Aset_ID asc ";
			}
			// print_r($query2);                
			$exec=mysql_query($query2) or die(mysql_error());
			
			$sqlCount 	= "SELECT * FROM $viewTable";
			$execCount	= mysql_query($sqlCount) or die(mysql_error());
			$count  = mysql_num_rows($execCount);
			// pr($count);
			$sql 	= "SELECT * FROM $viewTable LIMIT $paging, 100 ";
			// pr($sql);
			$exec	= mysql_query($sql) or die(mysql_error());
			
			while ($dataAset = mysql_fetch_object($exec)){
				$row[] = $dataAset;
			}
		}
		$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi[]'";
        $result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
        $data_apl = $DBVAR->fetch_object($result_apl);
        // pr($data_apl);
        $array = explode(',',$data_apl->aset_list);
        
		foreach ($array as $id)
		{
			if ($id !='')
			{
			$dataAsetList[] = $id;
			}
		}
		if ($dataAsetList !='')
		{
			$explode = array_unique($dataAsetList);    
		}
	?>
	<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left" style="font-weight:bold;"><?php echo "Konfirmasi $messg"."&nbsp;".$count."&nbsp;Record"?></th>
    </tr>
	</table>
	<br>
	<table width='100%' border='0' style="">
		<tr>
			<td align="right">
				<span><input type="submit" value="<?php echo $button_value?>" name="confirm" "></span>
				<input type="hidden" name="param" value="<?php echo $_GET['param'];?>">   
			</td>
		</tr>
		<tr>
		<td align="right" width="200px">
			<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
			<input type="hidden" class="hiddenparam" value="<?php echo @$_GET['param']?>">
			<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
			<span><input type="button" value="<< Prev" class="buttonprevValidasi"/>
			Page
			<input type="button" value="Next >>" class="buttonnextValidasi"/></span>
		</td>
		</tr>
	</table>
	<br />
<!--<div style="overflow: scroll; height: 1000px;">-->
    
	<div id="demo">
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
    <thead>
		<tr>
			<td style="background-color: #eeeeee; border: 1px solid #dddddd;font-weight:bold;" width="5%" align="center">No</td>
			<td style="background-color: #eeeeee; border: 1px solid #dddddd;font-weight:bold;" width="5%">&nbsp;</td>
			<td style="background-color: #eeeeee; border: 1px solid #dddddd;font-weight:bold;" align="center"> Informasi Aset</td>
		</tr>
    </thead>
	<tbody> 
	<?php	
    $page = @$_GET['pid'];
	if ($page > 1){
		$no = intval($page - 1 .'01');
	}else{
		$no = 1;
	}  
	if (!empty($row))
    {
        $disabled = '';
    foreach ($row as $key => $value)
    {
        //echo $value->Aset_ID;
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
	
    <tr>
        <td align="center" style="border: 1px solid #dddddd;"><?php echo $no?></td>
        <td width="10px" align="center" style="border: 1px solid #dddddd;">
                <input type="checkbox" id="checkbox" class="checkbox" name="validasi[]" value="<?php 
					echo $value->Aset_ID;?>" <?php 
						for ($i = 0; $i <= count($explode); $i++){
						if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
        </td>
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
                        <td style="font-weight:bold;"><?php echo $noRegOri?></td>
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
						<td width="78%"><?php echo $value->NoKontrak?></td>
                    </tr>
                    <tr>
                        <td>Satker</td> 
						<td width="2%">&nbsp;</td>
						<td><?php 
							if($value->KodeSatker !="") $satker = "[".$value->KodeSatker."]"."&nbsp;".$value->NamaSatker;
							if($value->KodeUnit != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit."]"."&nbsp;".$value->NamaSatker;
							if($value->Gudang != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit.".".$value->Gudang."]"."&nbsp;".$value->NamaSatker;
							// echo '['.$value->KodeSatker.'.'.$value->KodeUnit.'.'.$value->Gudang.']'."&nbsp;".$value->NamaSatker
							echo $satker;?>
						</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td> 
						<td width="2%">&nbsp;</td>
						<td><?php echo $value->NamaLokasi?></td>
                    </tr>
                    <tr>
                        <td>Status</td> 
						<td width="2%">&nbsp;</td>
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
        $no++;
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
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">&nbsp;</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
		</tr>
	</tfoot>              
</table>
</form>
</div>
<!--</div>-->

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
