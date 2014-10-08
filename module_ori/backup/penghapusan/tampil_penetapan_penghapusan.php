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
    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/js/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
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
                                                            Penetapan Penghapusan
                                                    </div>
                                                    <div id="bottomright">
                                                            <form method="POST" action="penetapan_penghapusan_tambah.php" style="padding:0px; width:625px; border: 0px;">
                                                                    <table width="1050px" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td width="50%" align="left" style="border:0px;">
                                                                                <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter"onclick="document.location='penetapan_penghapusan_filter.php'">
                                                                            </td>
                                                                            <td width="50%" align="right" style="border:0px;">
                                                                                <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data">
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                        </form><br>
                                                        <script type="text/javascript" language="JavaScript">
														  <!--
														  function HapusPenghapusan( href_action ) {
															if( window.confirm('Hapus data ini?') ) {
															  document.location = '?' + href_action;
															}
														  }
														  
														  -->
														  </script>
                                                        <table class="listdata" width="100%" border="1"cellpadding="0" cellspacing="0"style="padding:2px; margin-top:0px; border: 1px solid #cccccc; border-width: 1px 1px 1px 1px;">
                                                            <tr>
                                                                <th align="center" width="40px" >No</th>
                                                                <th align="center" width="170px" >Nomor Penghapusan</th>
                                                                <th align="center" width="150px" >Tgl Penghapusan</th>
                                                                <th align="center" width="%" >Detail Penghapusan</th>
                                                                <th align="center" width="85px">Tindakan</th>
                                                            </tr>
                                                            <tr>
                                                                <th align="center" width="40px" >1</th>
                                                                <th align="center" width="170px" >354</th>
                                                                <th align="center" width="150px" >2012-06-12</th>
                                                                <th align="center" width="%" >rtu</th>
                                                                <th align="center" width="85px"><a href="#">Edit</a>&nbsp;|&nbsp;<a href="#">Hapus</a></th>
                                                            </tr>
                                                            <?php
															
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
															  <td class="listdata" align="center" valign="top"><a class="listdata" title="edit data penghapusan barang" href="penetapan_penghapusan_tambah_data.php">Edit</a>
																											   |<a class="listdata" href="javascript:void()" style="cursor: pointer;" title="hapus data penghapusan barang" onclick="HapusPenghapusan( 'menuid=37&amp;iddttrfstart=03/07/2012&amp;iddttrfend=25/07/2012&amp;idgetsatker=&amp;idsatker=(semua SKPD)&amp;idnotrf=666&amp;exec=del&amp;delid=666');">Hapus</a></td>
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
                                                    </table>
                                                    <table width="100%" style="border:0px; padding:0px;" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td width="*" style="border: 1px solid #cccccc; border-width: 1px 0px 0px 0px; padding: 2px 4px 2px 4px;">
                                                                    &nbsp;
                                                                </td>
                                                            </tr>
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
