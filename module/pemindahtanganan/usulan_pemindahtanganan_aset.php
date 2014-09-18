<?php
    include "../../config/config.php";
    include"$path/header.php";
    include"$path/title.php";
   
$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

	    
/*
        $UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
        $nmaset=$_POST['pemindahtanganan_usul_nama_aset'];
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
        
        $dataArr = $STORE->store_usulan_pemindahtanganan(
                $UserNm,
                $nmaset,
                $usulan_id,
                $date,
                $ses_uid
                );
 * 
 */
        
        /*
        $asset_id=Array();
        $no_reg=Array();
        $nm_barang=Array();

        $panjang=count($nmaset);
         * 
         */
        
        /*
        $peman_penet_bmd_eks_ket=$_POST['peman_penet_bmd_eks_ket'];	
        $peman_penet_bmd_eks_nopenet=$_POST['peman_penet_bmd_eks_nopenet'];	
        $peman_penet_bmd_eks_tglpenet=$_POST['peman_penet_bmd_eks_tglpenet'];	
        $olah_tgl=  format_tanggal_db2($peman_penet_bmd_eks_tglpenet);
        */
        
        /*
        $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                            Jenis_Usulan, UserNm, TglUpdate, 
                                            GUID, FixUsulan) 
                                        values ('', '', '', 'PDH', '$UserNm', '$date', '$SessionUser[ses_uid]', '1')";

        $result=  mysql_query($query) or die(mysql_error());

        for($i=0;$i<$panjang;$i++){

            $tmp=$nmaset[$i];
            $tmp_olah=explode("<br>",$tmp);
            $asset_id[$i]=$tmp_olah[0];
            $no_reg[$i]=$tmp_olah[1];
            $nm_barang[$i]=$tmp_olah[2];

            $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','PDH','0')";
            $result=  mysql_query($query1) or die(mysql_error());

            $query3="UPDATE Aset SET Usulan_Pemindahtanganan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
            $result3=mysql_query($query3) or die(mysql_error());

            
            //lanjut dari sinii
            $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
            $result2=mysql_query($query2) or die(mysql_error());
        }
        
        $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='Usulan_Pemindahtanganan' AND UserSes='$_SESSION[ses_uid]'";
        $exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
        */
        //echo "<script>alert('Data Sudah Diusulkan.. !!!');</script>";
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="distribusi_barang_filter.php";
		  }
		}
		function spoiler(obj)
		{
		var inner = obj.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
		//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
		if (inner.style.display =="none") {
		inner.style.display = "";
		document.getElementById(obj.id).value="Tutup Detail";}
		else {
		inner.style.display = "none";
		document.getElementById(obj.id).value="View Detail";}
		}

		function spoilsub(obj)
		{
		var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
		//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
		if (inner.style.display =="none") {
		inner.style.display = "";
		document.getElementById(obj.id).value="Tutup Sub Detail";}
		else {
		inner.style.display = "none";
		document.getElementById(obj.id).value="Sub Detail";}
		}
	</script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                        <?php
                                include"$path/menu.php";
                        ?>
                  </div>
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Buat Usulan Pemindahtanganan
                                                </div>
												<div id="bottomright">
													<u style="font-weight:bold">Aset yang baru saja diusulkan untuk dipindahtangankan:</u><br><br>
														<?php
															$usulan_id=$_GET['usulan_id'];
														?>
														
                                                        <table width="100%" height="3%" border="1" style="border-collapse:collapse;">
															<tr>
																<td>
																	<span style="color:red;">No. Usulan Pemindahtanganan : <?php echo $usulan_id?></span>
																</td>
															</tr>
																<td>
																<table width="100%">
																<?php
																// pr($_SESSION);
																unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
																$parameter = array('menuID'=>$menu_id,'usulan_id'=>$usulan_id,'paging'=>$paging);
																$data = $RETRIEVE->retrieve_usulan_pemindahtanganan_eksekusi($parameter);
																$no = 1;
																// pr($data['dataArr']);
																foreach ($data['dataArr'] as $keys => $nilai)
																{
																	if ($nilai->Aset_ID !='')
																		{
																		if ($nilai->AsetOpr == 0)
																		$select="selected='selected'";
																		if ($nilai->AsetOpr ==1)
																		$select2="selected='selected'";

																		if($nilai->SumberAset =='sp2d')
																		$pilih="selected='selected'";
																		if($nilai->SumberAset =='hibah')
																		$pilih2="selected='selected'";
										
																	echo "<tr>
																		<td style='border: 1px solid #004933; height:50px; padding:2px;'>
																		<table width='100%'>
																		<tr>
																		<td></td>
																		<td>$no.</td>
																		<input type='hidden' name='pemindahtanganan_usul_nama_aset[]' value='$nilai->Aset_ID'>
																		<td>$nilai->NomorReg - $nilai->Kode</td>
																		<td align='right'><input type='button' id ='$nilai->Aset_ID' value='View Detail' onclick='spoiler(this);'></td>
																		</tr>

																		<tr>
																		<td>&nbsp;</td>
																		<td>&nbsp;</td>
																		<td>$nilai->NamaAset</td>
																		</tr>
																		<tfoot style='display:none;'>
																		<tr>
																		<td></td>
																		<td></td>
																		<td colspan=2>
																		<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

																		<table border=0 width=100%>
																		<tr>
																		<td>
																		<input type='text' value='$nilai->Pemilik' size='1px' style='text-align:center' readonly = 'readonly'> - 
																		<input type='text' value='$nilai->KodeSatker' size='10px' style='text-align:center' readonly = 'readonly'> - 
																		<input type='text' value='$nilai->Kode' size='20px' style='text-align:center' readonly = 'readonly'> - 
																		<input type='text' value='$nilai->Ruangan' size='5px' style='text-align:center' readonly = 'readonly'>
																		<input type='hidden' name='fromsatker' value='$nilai->OrigSatker_ID' size='5px' style='text-align:center' readonly = 'readonly'>
																		</td>
																		<td align='right'><input type='button' id ='sub$nilai->Aset_ID' value='Sub Detail' onclick='spoilsub(this);'></td>
																		</tr>
																		</table>

																		<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
																		<table width=100%>
																		<tr>
																		<td valign='top' align='left' width=10%>Nama Aset</td>
																		<td valign='top' align='left' style='font-weight:bold'>
																		$nilai->NamaAset
																		</td>
																		</tr>

																		<tr>
																		<td valign='top' align='left'>Satuan Kerja</td>
																		<td valign='top' align='left' style='font-weight:bold'>
																		$nilai->NamaSatker
																		</td>
																		</tr>

																		<tr>
																		<td valign='top' align='left'>Jenis Barang</td>
																		<td valign='top' align='left' style='font-weight:bold'>
																		$nilai->Uraian
																		</td>
																		</tr>

																		</table>
																		</div>

																		<div style='display:none; padding:5px; border:1px solid #999999;'>
																		<table width=100%>
																		<tr>
																		<td width='*' align='left' style='background-color: #cccccc; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
																		</tr>
																		</table>

																		<table>
																		<tr>
																		<td valign='top' style='width:150px;'>Nomor Kontrak</td>
																		<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='$nilai->NoKontrak'></td>
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
																		<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='$nilai->Kuantitas'>
																		Satuan
																		<input type='text' readonly='readonly' style='width:130px' value='$nilai->Satuan'>
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
																		<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='$nilai->TglPerolehan'></td>
																		</tr>

																		<tr>
																		<td valign='top' style='width:150px;'>Nilai Perolehan</td>
																		<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='$nilai->NilaiPerolehan'></td>
																		</tr>

																		<tr>
																		<td valign='top' style='width:150px;'>Alamat</td>
																		<td valign='top'><textarea style='width:90%' readonly>$nilai->Alamat</textarea><br>
																		RT/RW
																		<input type='text' readonly='readonly' style='width:50px' value='$nilai->RTRW'></td>
																		</tr>

																		<tr>
																		<td valign='top' style='width:150px;'>Lokasi</td>
																		<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='$nilai->NamaLokasi'></td>
																		</tr>

																		
																		</table>

																		</div>

																		</div>
																		</td>
																		</tr>
																		</tfoot>
																		</table>
																		</td>
																		</tr>";
																		$no++;
																		}
																	}
																?>
															</table>	
															</td>	
														</table>
														<br>
															
                                                        <div align="center">
															
															<!--<a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/tes_class_usulan_aset_yang_akan_dipindahtangankan.php?menu_id=42&mode=1&id=$usulan_id";?>"  target="_blank"><input type="submit" name="submit1" value="Cetak Daftar Usulan Pemindahtanganan"/></a>-->
															<a href="<?php echo "$url_rewrite/module/pemindahtanganan/pemindahtanganan.php";?>"><input type="submit" name="submit2" value="Kembali ke Menu Utama"/></a>
                                                                                <!--<input type="hidden" name="id" value="<?php echo "$usulan_id";?>"/>-->
															
														</div>	                
												</div>
										</div>
                                </div>
                        </div>
            <?php
                include"$path/footer.php";
            ?>
</body>
</html>	
