<?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
    open_connection();
    $tgl_awl = format_tanggal_db2($_POST['bup_pu_tanggalawal']);
	$tgl_ahr = format_tanggal_db2($_POST['bup_pu_tanggalakhir']);
	if ($tgl_awl=='--' || $tgl_ahr=='--'){
		$tgl_awl="";
		$tgl_ahr="";
	}
	$no_sk_hps = $_POST['bup_pu_noskpenghapusan'];
	$nm_satker = $_POST['kelompok'];
	
	
	/*if($tgl_awl !=''){
		$qry_tglawl = " TglHapus = '".$tgl_awl."' ";
	}
	if($tgl_ahr !=''){
		$qry_tglahr = "TglHapus = '".$tgl_ahr."' ";
	}
	*/
	if($tgl_awl !='' && $tgl_ahr !=''){
		$qry_tglawlahr = " TglHapus between '".$tgl_awl."' and '".$tgl_ahr."' ";
	}
	if($no_sk_hps !=''){
		$qry_so_skhps = "NoSKHapus = '".$no_sk_hps."' ";
	}
	if($nm_satker !=''){
		$qry_nmsatker = "NamaSatker = '".$nm_satker."' ";
	}
	
	
	/*if($tgl_awl !=''){
		$prm_qry = $qry_tglawl;
	}
	if($tgl_ahr !='' && $query !=''){
		$prm_qry = $prm_qry." BETWEEN ".$qry_tglahr;
	}*/
	$prm_qry="";
	if($tgl_awl !='' && $tgl_ahr !=''){
		$prm_qry = $qry_tglawlahr;
	}
	if($no_sk_hps !='' && $prm_qry !=''){
		$prm_qry = $prm_qry." AND ".$qry_so_skhps;
	}
	if($no_sk_hps !='' && $prm_qry ==''){
		$prm_qry = $qry_so_skhps;
	}
	if($nm_satker !='' && $prm_qry !=''){
		$prm_qry = $prm_qry." AND ".$qry_nmsatker;
	}
	if($nm_satker !='' && $prm_qry ==''){
		$prm_qry = $nm_satker;
	}
	if($prm_qry !=''){
		$prm_qry = "WHERE Dihapus ='1' AND ".$prm_qry;
	}else if($prm_qry ==''){
		$prm_qry="WHERE Dihapus ='1'";
	}
	//echo $no_sk_hps;
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
                                                        Penetapan Penghapusan<?php echo $prm_qry;?>
                                                </div>
                                                    <div id="bottomright">
                                                        <table width="100%" height="4%" border="0" style="border-collapse:collapse;">
                                                            <tr>
                                                                    <th colspan="3" align="left">Filter data : <u>Tidak ada filter (View seluruh data)</u></th>
																	<tr>
																		<td valign="top" width="120px">Tanggal Awal</td>
																		<td width="10px">:</td>
																		<td valign="top"><?php echo $tgl_awl; ?></td>
																	</tr>
																		<td valign="top" width="120px">Tanggal Akhir</td>
																		<td width="10px">:</td>
																		<td valign="top"><?php echo $tgl_ahr;?></td>
																	</tr>
																		<td valign="top" width="120px">No Penghapusan</td>
																		<td width="10px">:</td>
																		<td valign="top"><?php echo $no_sk_hps; ?></td>
																	</tr>
																		<td valign="top" width="120px">Satker</td>
																		<td width="10px">:</td>
																		<td valign="top"><?php echo $nm_satker; ?></td>
																	</tr>
                                                            </tr>
                                                        </table><br>
														 <table style="border: 0px none; padding: 0px;" cellpadding="0" cellspacing="0" width="100%">
															<tbody><tr>
															  <td style="border-style: solid; border-color: rgb(204, 204, 204); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-image: none; border-width: 0px 0px 1px; padding: 2px 4px;" width="*">Total halaman: 1</td>
														      <td class="paging_top" style="font-weight: bold; color: red; padding: 0px 2px; border-width: 1px 1px 0px; border-style: solid solid none; border-color: rgb(204, 204, 238) rgb(204, 204, 238) -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-image: none;" align="center">1</td>    </tr>
														    </tbody>
														  </table>
														<script type="text/javascript" language="JavaScript">
														  <!--
														  function HapusPenghapusan( href_action ) {
															if( window.confirm('Hapus data ini?') ) {
															  document.location = '?' + href_action;
															}
														  }
														  
														  -->
														</script>
														  <table class="listdata" style="padding: 2px; margin-top: 0px; border-style: solid; border-color: rgb(204, 204, 204); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-image: none; border-width: 0px 1px;" border="0" cellpadding="0" cellspacing="0" width="100%">
															<tbody><tr>
															  <th align="center" width="40px">No</th>
															  <th align="center" width="170px">Nomor Penghapusan</th>
															  <th align="center" width="150px">Tgl Penghapusan</th>
															  <th align="center" width="%">Detail Penghapusan</th>
															  <th align="center" width="85px">Tindakan</th>
															</tr>
															<?php
															//echo $tgl_awl;
															//echo $tgl_ahr;
															//echo $prm_qry;
															if(($tgl_awl =='') || ($tgl_ahr =='') || ($no_sk_hps =='') || ($nm_satket =='')){
															?>
															
															<?php										
															$query = mysql_query("select * from Aset $prm_qry limit 10");
															if (!$query) {
																die('Gagal query: ' . mysql_error());
															  }
															$total = mysql_num_rows($query);
															$i =1;
															if($total > 0){
															while($row = mysql_fetch_array($query)){
																$no_skh = $row['NoSKHapus'];
																$tglhps = $row['TglHapus'];
																$alasan = $row['AlasanHapus'];
															
															?>
															<tr id="row_666">
															  <td class="listdata" align="center" valign="top"><?php echo $i; ?></td>
															  <td class="listdata" align="left" valign="top"><?php echo $no_skh; ?></td>
															  <td class="listdata" align="right" valign="top"><?php echo format_tanggal_db3($tglhps);?></td>
															   <td class="listdata" align="left" valign="top"><?php echo $alasan; ?></td>
															  <td class="listdata" align="center" valign="top"><a class="listdata" title="edit data penghapusan barang" href="?menuid=37&amp;iddttrfstart=03/07/2012&amp;iddttrfend=25/07/2012&amp;idgetsatker=&amp;idsatker=%28semua%20SKPD%29&amp;idnotrf=666&amp;exec=edit&amp;delid=666#row_666">Edit</a>
																											   |<a class="listdata" href="javascript:void()" style="cursor: pointer;" title="hapus data penghapusan barang" onclick="HapusPenghapusan( 'menuid=37&amp;iddttrfstart=03/07/2012&amp;iddttrfend=25/07/2012&amp;idgetsatker=&amp;idsatker=(semua SKPD)&amp;idnotrf=666&amp;exec=del&amp;delid=666');">Hapus</a></td>
															</tr>
															<tr>
																<td colspan="4" style="height: 0px; border: 0px none;"></td>
															</tr>  
															<?php
															$i++;
																}												
															}
															?>
															<?php 
															  }
															  else
															  {
																  echo '<tr>';
																  echo '<td colspan=3 align=center style="color:red;">..:: Tidak ada data ::..</td>';
																  echo '</tr>';
															  }
															?>
															</tbody>
														  </table>
														  <table style="border: 0px none; padding: 0px;" cellpadding="0" cellspacing="0" width="100%">
															<tbody><tr>
															  <td style="border-style: solid; border-color: rgb(204, 204, 204); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-image: none; border-width: 1px 0px 0px; padding: 2px 4px;" width="*">Total halaman: 1</td>
															  <td class="paging_bot" style="font-weight: bold; color: red; padding: 0px 2px; border-right: 1px solid rgb(204, 204, 238); border-width: 0px 1px 1px; border-style: none solid solid; border-color: -moz-use-text-color rgb(204, 204, 238) rgb(204, 204, 238); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-image: none;" align="center">1</td>    </tr>
														    </tbody>
														  </table>
                                                      </div>    
                                        </div>
                                </div>
                        </div>
                
        <?php
            include"$path/footer.php";
        ?>
</body>
</html>	
