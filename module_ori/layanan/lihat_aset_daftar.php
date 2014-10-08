<?php
//ob_start();
include "../../config/config.php";

$menu_id = 51;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>

<html>  
     <?php
     include "$path/header.php";
     include "$path/title.php";
	 $resetDataView = $DBVAR->is_table_exists('penghapusan_filter_'.$SessionUser['ses_uoperatorid'], 0);
        
     ?>

     <body>

          <?php
          include "$path/menu.php";
          // pr(paging(false));
          //open_connection();

          if ($_POST['submit']){
               // pr($_POST);
               // exit;
			   // unset($_SESSION['parameter_sql']);
				if ($_POST['kd_idaset'] == "" && $_POST['kd_namaaset'] == "" && $_POST['kd_nokontrak'] == "" && $_POST['kd_tahun'] == "" && $_POST['skpd_id'] == "" && $_POST['lokasi_id'] == "" && $_POST['kelompok_id5'] == "") {
                    ?>
                    <script>var r=confirm('Tidak ada isian filter');
                         if (r==false)
                         {
                              document.location="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_filter.php";
                         }
                    </script>
				<?php
					}
				}
				
               $data['kd_idaset'] = $_POST['kd_idaset'];
               $data['kd_namaaset'] = $_POST['kd_namaaset'];
               $data['kd_nokontrak'] = $_POST['kd_nokontrak'];
               $data['kd_tahun'] = $_POST['kd_tahun'];
               $data['lokasi_id'] = $_POST['lokasi_id'];
               $data['kelompok_id'] = $_POST['kelompok_id5'];
               $data['satker'] = $_POST['skpd_id'];
               // $data['ngo'] = $_POST['ngo_id'];
               $data['paging'] = $_GET['pid'];
               $data['sql'] = " Status_Validasi_Barang = 1";
               $data['sql_where'] = TRUE;
               $data['modul'] = "layanan";
			   $getFilter = $HELPER_FILTER->filter_module($data);
			   // pr($getFilter);
			
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
                         <div id="topright">Lihat Daftar Aset</div>
                         <div id="bottomright">

                              <div>
                                   <table width="100%" height="4%" border="1" style="border-collapse:collapse;">
                                        <tr>
                                             <th colspan="2" align="left" style="font-weight:bold;">Filter data : <?php echo $_SESSION['parameter_sql_total'] ?> Record</th>
                                        </tr>
                                   </table>
                              </div>

<?php
// $offset = @$_POST['record'];

$param = $_SESSION['parameter_sql'];
$query = "$param ORDER BY Aset_ID ASC ";
// pr($query);
$res = mysql_query($query) or die(mysql_error());
if ($res) {
     $rows = mysql_num_rows($res);

     while ($data = mysql_fetch_array($res)) {

          $dataArray[] = $data['Aset_ID'];
     }
}
$paging		= paging($_GET['pid'], 100);
if($dataArray!= "") $dataImplode = implode(',',$dataArray); else $dataImplode = "";
// pr($dataImplode);
if ($dataImplode != "") {
	$viewTable = 'lihat_daftar_aset_'.$_SESSION['ses_uoperatorid'];
	$table = $DBVAR->ceck_table($viewTable, 1);
    if($table['tabel'] == 0){ 
		// echo "buat view table";
		$query = "CREATE OR REPLACE VIEW $viewTable AS  
				SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
				a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
				a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
				a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,a.Info,
				c.Kelompok, c.Uraian, c.Kode,
				d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
				e.KodeSatker, e.NamaSatker, e.KodeUnit,
				f.InfoKondisi,
				KTR.NoKontrak
				FROM Aset AS a 
				LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
				LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
				JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
				LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
				JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
				LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
				WHERE a.Aset_ID IN ({$dataImplode}) ORDER BY a.Aset_ID asc";
		// pr($query);
		$exec = mysql_query($query) or die(mysql_error());
	}

	// echo "select view table";
	$sqlCount 	= "SELECT * FROM $viewTable";
	$execCount	= mysql_query($sqlCount) or die(mysql_error());
	$count  = mysql_num_rows($execCount);
	$sql 	= "SELECT * FROM $viewTable LIMIT $paging, 100 ";
	// pr($sql);
	$exec	= mysql_query($sql) or die(mysql_error());
	while ($dataAset = mysql_fetch_object($exec)) {
	  $row[] = $dataAset;
	 }
	}
?>
  <div>
	   <table border='0' width=100% >
			<tr>    
				 <td colspan="2"  align=right>
					  <a href="<?php echo "$url_rewrite/module/layanan/lihat_aset_filter.php?pid=1"; ?>">
						   <input type="submit" name="Lanjut" value="Kembali ke halaman utama : Cari aset" >
					  </a>
				 </td>                
			</tr>
			<tr>
				 <td align="right" width="200px">
					  <input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid'] ?>">
					  <input type="hidden" class="hiddenrecord" value="<?php echo @$count ?>">
					  <span><input type="button" value="<< Prev" class="buttonprev"/>
						   Page
						   <input type="button" value="Next >>" class="buttonnext"/></span>
				 </td>
			</tr>
	   </table>
  </div> 

  <!-- Begin frame -->
  <div id="demo">
	   <table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
			<thead>
				 <tr>
					  <th style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
					  <th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
				 </tr>
			</thead>
<?php
if (!empty($row)) {
     ?>
	<tbody>
     <?php
    $nomor = 1;
	$page = @$_GET['pid'];
	if ($page > 1){
		$nomor = intval($page - 1 .'01');
	}else{
		$nomor = 1;
	}
     foreach ($row as $key => $value) {
          echo"<pre>";
		  print_r($value);
          ?>
		   <tr class="<?php //if ($nomor == 1) echo ' ' ?>">
				<td align="center" style="border: 1px solid #dddddd;" width="20px"><?php echo $nomor ?></td>

				<td style="border: 1px solid #dddddd;">

					 <table width='100%' border=0>
						  <tr>
							   <td height="10px"></td>
						  </tr>

						  <tr>
							   <td>
									<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID ?></span>
									<span>( Aset ID - System Number )</span>
							   </td>
							   <td align="right">
									<!--<form method="POST" action="<?php echo "$url_rewrite/module/layanan/lihat_aset_view.php" ?>">
										 <input type="hidden" name="Aset_ID" value="<?php echo $value->Aset_ID ?>"/>	
										 <input type="submit" name="view" value="View"/>
									</form>-->
									
									<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
										<a href="<?php echo "$url_rewrite/module/layanan/lihat_aset_view.php"; ?>?id=<?php echo $value->Aset_ID ?>">View Detail</a>
									</span>
											
							   </td>
						  </tr>
						  <tr>
							   <td style="font-weight:bold;"><?php echo $value->NomorReg ?></td>
						  </tr>
						  <tr>
							   <td style="font-weight:bold;"><?php echo $value->Kode ?></td>
						  </tr>
						  <tr>
							   <td style="font-weight:bold;"><?php echo $value->Uraian?></td>
						  </tr>

					 </table>

					 <br>
					 <hr />
					 <table border=0 width="100%">
						  <tr>
							   <td width="20%">No.Kontrak</td> 
							   <td width="2%">&nbsp;</td>
							   <td width="78%">&nbsp;<?php echo $value->NoKontrak ?></td>
						  </tr>

						  <tr>
							   <td>Satker</td> 
							   <td>&nbsp;</td>
							   <td><?php echo '[' . $value->KodeSatker . '] ' . $value->NamaSatker ?></td>
						  </tr>
						  <tr>
							   <td>Lokasi</td> 
							   <td>&nbsp;</td>
							   <td><?php echo $value->NamaLokasi ?></td>
						  </tr>
						  <tr>
							   <td>Info</td> 
							   <td>&nbsp;</td>
							   <td><?php echo $value->Uraian ?></td>
						  </tr>
						  <tr>
							   <td>Status</td> 
							   <td>&nbsp;</td>
							   <td><?php echo $value->Kondisi_ID . '-' . $value->InfoKondisi ?></td>
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
