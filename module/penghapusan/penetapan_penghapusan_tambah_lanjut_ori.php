    <?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
    
        $menu_id = 39;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
		$aset_id=$_POST['bup_pp_sp_asetid'];
        $nama_aset=$_POST['bup_pp_sp_namaaset'];
        $no_kontrak=$_POST['bup_pp_sp_nokontrak'];
        $kd_tahun=$_POST['bup_pp_sp_tahun'];
        $kelompok=$_POST['kelompok_id'];
        $lokasi=$_POST['lokasi_id'];
        $satker=$_POST['skpd_id'];
       
        $submit=$_POST['submit'];
        
        
        $paging = $LOAD_DATA->paging($_GET['pid']);    
            
        if (isset($submit))
        {
            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
            $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
            $get_data_filter = $RETRIEVE->retrieve_penetapan_penghapusan_filter($parameter);
        }else{

        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
        $get_data_filter = $RETRIEVE->retrieve_penetapan_penghapusan_filter($parameter);

       }
	   // pr($get_data_filter);
		// $countdata = array_keys($get_data_filter['dataArr']);
		// $totaldata = end($countdata) + 1;
		
        
	   if (isset($submit)){
            if ($aset_id=="" && $nama_aset=="" && $no_kontrak=="" && $kd_tahun=="" && $kelompok=="" && $lokasi=="" && $satker==""){
    ?>
        <script>var r=confirm('Tidak ada isian filter');
            if (r==false){
            document.location='penetapan_penghapusan_tambah_aset.php';
            }
        </script>
     <?php
            }
        }
    
        
?>
<html>
	</script>
		
	<body onload="enable()">
	<form name="myform" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_tambah_data.php">
                                                        
	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
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
							function enable_submit(){
							var enable = document.getElementById('pilihHalamanIni');
							var button = document.getElementById('submit');
								if(enable){
									button.disabled = false;
								}
							}
							function disable_submit(){
							var disable = document.getElementById('kosongkanHalamanIni');
							var button = document.getElementById('submit');
								if(disable){
									button.disabled = true;
								}
							}
                        </script>
	<div id="content">
                        <?php
                            include"$path/menu.php";
                        ?>
                  </div>
			
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Penetapan Penghapusan
                                                </div>
                                                    <div id="bottomright">
                                                        <table width="100%" height="4%" border="1" style="border-collapse:collapse;">
                                                            <tr>
                                                                    <th colspan="2" align="left" style="font-weight:bold">Filter data : <?=$get_data_filter[count]?> record</th>
                                                            </tr>
                                                        </table><br>
                                                            <div align="right">
                                                                
                                                                    <input type="button" name="aset_act_btn"value="Kembali ke halaman utama: Cari Aset" onclick="window.location='penetapan_penghapusan_tambah_aset.php'">
                                                                   
                                                                    
                                                            </div>
															<br>
                                                        

<!-- Begin frame -->
<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    <tr>
        <td colspan ="3" align="right">
			<table border="0" width="100%">
				<tr>
					<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
					<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
					<td align="right">
							<span><input type="submit" name="submit" value="Penetapan Penghapusan" id="submit" disabled/></span>
					</td>
					<td align="right" width="200px">
							<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
							<input type="hidden" class="hiddenrecord" value="<?php echo @$get_data_filter[count]?>">
							<span><input type="button" value="<< Prev" class="buttonprev"/>
							Page
							<input type="button" value="Next >>" class="buttonnext"/></span>
						
					</td>
				</tr>
			</table>
        </td>
    </tr>
</table>
<br>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width='20px'>No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">&nbsp;</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
		</tr>
	</thead>
	<?php
	if (!empty($get_data_filter['dataArr']))
    {
    ?>
		
	<tbody>
		<?php
		$nomor = 1;
		foreach ($get_data_filter['dataArr'] as $key => $value)
		{
		?>
			<tr class="<?php if($nomor == 1) echo ' '?>">
				<td align="center" style="border: 1px solid #dddddd;"><?php echo $nomor?></td>
				<td width="10px" align="center" style="border: 1px solid #dddddd;">
				<?php
						if (($_SESSION['ses_uaksesadmin'] == 1)){
							?>
							<input type="checkbox" class="checkbox" onchange="enable()" name="penetapanpenghapusan[]" value="<?php echo $value->Aset_ID;?>" 
							<?php for ($j = 0; $j <= count($get_data_filter['asetuser']); $j++){
								if ($get_data_filter['asetuser'][$j]==$value->Aset_ID) echo 'checked';}
							?>/>
							<?php
						}else{
							if ($get_data_filter['asetuser']){
							if (in_array($value->Aset_ID, $get_data_filter['asetuser'])){
							?>
							<input type="checkbox" class="checkbox" onchange="enable()" name="penetapanpenghapusan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>/>							<?php
							}
						}
						}
						
						?>
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
								<!--
								<td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
									
									 <a href='validasi_data_aset.php?id=<?php //echo $value->Aset_ID?>'>Validasi</a></span>
								</td>-->
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
								<td width="30%"> No.Kontrak</td> <td><?php echo $value->NoKontrak?></td>
							</tr>
							<tr>
								<td>Satker</td> <td><?php echo $value->NamaSatker?></td>
							</tr>
							<tr>
								<td>Lokasi</td> <td><?php echo $value->NamaLokasi?></td>
							</tr>
							<tr>
								<td>Status</td> <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
							</tr>

						</table>
				 </td>
			</tr>
		<?php
			$nomor++;
		}
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
			</div>
			<div class="spacer"></div>
<!-- End Frame -->

</div>
</div>
</div>
</div>
        
	
<?php
include"$path/footer.php";
?>
</body>
</html>	
