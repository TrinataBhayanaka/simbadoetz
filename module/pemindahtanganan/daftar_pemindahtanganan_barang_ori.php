<?php
ob_start();

include "../../config/config.php";
include "$path/header.php";
include "$path/title.php";
include "$path/menu.php";

            // 
            
$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$submit = $_POST['tampil'];


	$paging = paging($_GET['pid'], 100);    
 
	if (isset($submit))
	{
		// echo "filter";
		$POST['kd_idaset'] = $_POST['bupt_idaset'];
		$POST['kd_namaaset'] = $_POST['bupt_namaaset'];
		$POST['bupt_nokontrak'] = $_POST['kd_nokontrak'];
		$POST['kd_tahun'] = $_POST['bupt_tahun'];
		$POST['kelompok_id']= $_POST['kelompok_id'];
		$POST['lokasi_id']= $_POST['lokasi_id'];
		$POST['satker']= $_POST['skpd_id'];
		$POST['ngo_id']= $_POST['ngo_id'];
		$POST['modul']= "";
		$POST['paging'] = $_GET['pid'];
		$POST['sql_where'] = TRUE;
		$POST['sql'] = "Status_Validasi_Barang = 1 AND Usulan_Pemindahtanganan_ID IS NULL AND Dihapus != 0 AND 
						Usulan_Pemusnahan_ID IS NULL";
		// pr($POST);
		unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
		$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$POST,'paging'=>$paging);
		$data = $RETRIEVE->retrieve_pemindahtanganan_filter($parameter);
	}else{
		// echo "tanpa filter";
		// $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
		$sessi = 1;
		$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
		$data = $RETRIEVE->retrieve_pemindahtanganan_filter($parameter);
		
	}
	// echo"<pre>";
	// pr($data);
	// echo"</pre>";
	

?>



<html>
<body>
	<script language="Javascript" type="text/javascript">  
		
		function enable(){  
		var tes=document.getElementsByTagName('*');
		var button=document.getElementById('submit');
		var boxeschecked=0;
		for(k=0;k<tes.length;k++)
		{
			if(tes[k].className=='checkbox')
				{
					//
					tes[k].checked == true  ? boxeschecked++: null;
				}
		}
	   //alert(boxeschecked);
	   if(boxeschecked!=0)
		   button.disabled=false;
	   else
		   button.disabled=true;
	}
	function disable_submit(){
		var enable = document.getElementById('pilihHalamanIni');
		var disable = document.getElementById('kosongkanHalamanIni');
		var button=document.getElementById('submit');
		if (disable){
			button.disabled=true;
		} 
	}
	
	function enable_submit(){
		var enable = document.getElementById('pilihHalamanIni');
		var disable = document.getElementById('kosongkanHalamanIni');
		var button=document.getElementById('submit');
		if (enable){
			button.disabled=false;
		} 
	}
	</script>
	<script type="text/javascript" charset="utf-8">
	  $(document).ready(function() {
				$('#example').dataTable( {
						"aaSorting": [[ 1, "asc" ]]
				} );
		var tes=document.getElementsByTagName('*');
		var button=document.getElementById('submit');
		var boxeschecked=0;
		for(k=0;k<tes.length;k++)
		{
			if(tes[k].className=='checkbox')
				{
					//
					tes[k].checked == true  ? boxeschecked++: null;
				}
		}
	//alert(boxeschecked);
		if(boxeschecked!=0){
			button.disabled=false;
		}
		else {
			button.disabled=true;
		}		
		} );
	</script>       

    <div id="tengah1">	
    <div id="frame_tengah1">
    <div id="frame_gudang">
    <div id="topright">Buat Usulan Pemindahtanganan</div>
    <div id="bottomright">
        <table width="100%" height="4%" border="1" style="border-collapse:collapse;">
			<tr>
				<th colspan="2" align="left" style="font-weight:bold;">Filter data : <?php echo $_SESSION['parameter_sql_total']?> Record</u></th>
			</tr>
		</table>
		<br>
		<div>
			<table border=0 width=100%>
				<tr>
					<td width=50%></td>
					<td colspan="2" width=25% align=right>
                        <input type="button" name="aset_act_btn" value="Kembali ke halaman utama: Cari Aset" onclick="window.location='<?php echo "$url_rewrite";?>/module/pemindahtanganan/pemindahtanganan.php';"></td>
				</tr>
        </table>
        
		<table border=0 width=100%>
			<tr>
				<td colspan="3" align="right"><input type="submit" onclick="window.location='<?php echo "$url_rewrite/";?>module/pemindahtanganan/pemindahtanganan_daftar_aset_fix.php?pid=1';" value="Daftar Usulan Barang" /></td>
			</tr>
        </table>
		
    </div>         
     <br>   
	<div>  
        <form method="POST" action="<?php echo"$url_rewrite"?>/module/pemindahtanganan/usulan_pemindahtanganan.php" name="form">   
			<table width='100%' border='0' style="border-collapse:collapse;border: 1px solid #dddddd;">
				<tr>
					<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
					<td  align="left"><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
					<td align="right"><input type="submit" align="right" value="Usulan Pemindahtanganan" name="submit" id="submit" disabled/></td>
					<td align="right" width="200px">
						<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
						<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
						<span><input type="button" value="<< Prev" class="buttonprev"/>
							Page
						<input type="button" value="Next >>" class="buttonnext"/></span>
					</td>
				</tr>
			</table>          
	<br>
    <div id="demo">       
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
        <thead>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width="5%">No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width="5%">&nbsp;</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
		</tr>
		</thead>
		<tbody>
        
                    <?php 
    
    // if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
	
    if (!empty($data['dataArr']))
    {
		$nomor = 1;
		$page = @$_GET['pid'];
		if ($page > 1){
			$nomor = intval($page - 1 .'01');
		}else{
			$nomor = 1;
		}
			
 
    foreach ($data['dataArr'] as $key => $value)
    {
       
	
    ?>
        <tr>
            
        <td align="center" style="border: 1px solid #eeeeee; height:100px; color: black; font-weight: ;"><?php echo "$nomor";?></td>
        <td align="center" style="border: 1px solid #eeeeee; height:100px; color: black; font-weight: bold;">
            <?php 
					if (($_SESSION['ses_uaksesadmin'] == 1)){
							?>
							<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Usulan_Pemindahtanganan[]" value="<?php echo $value->Aset_ID;?>" 
							<?php 
								for ($i = 0; $i <= count($data['asetList']); $i++){
									if ($data['asetList'][$i]==$value->Aset_ID) 
										echo 'checked';
								}?>>
							<?php
						}else{
							if ($asetList){
							if (in_array($value->Aset_ID, $asetList)){
							?>
							<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Usulan_Pemindahtanganan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($data['asetList']); $i++){if ($data['asetList'][$i]==$value->Aset_ID) echo 'checked';}?>>
							<?php
							}
						}
					}
						
				?>	
					
					</td>
         <td align="left" style="border: 1px solid #eeeeee; height:100px; color: black; font-weight: bold;">
            

                <table width='100%'>
                    <tr>
                        <td height="10px"></td>
                    </tr>

                    <tr>
                        <td>
                            <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo $value->Aset_ID?></span>
                            <span>( Aset ID - System Number )</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NomorReg?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->Kode?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
                    </tr>

                </table>

                <br>
                <hr />
                <table>
                    <tr>
                        <td width="20%"> No.Kontrak</td> 
						<td width="2%">&nbsp;</td>
						<td width="78%"><?php echo $value->NoKontrak?></td>
                    </tr>
                    <tr>
                        <td>Satker</td> <td>&nbsp;</td><td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td> <td>&nbsp;</td><td><?php echo $value->NamaLokasi?></td>
                    </tr>
                    <tr>
                        <td>Status</td><td>&nbsp;</td> <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
                    </tr>

                </table>
         </td>
    </tr>
	
<?php
        $nomor++;
        }}
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
	</div>
	</form>
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
