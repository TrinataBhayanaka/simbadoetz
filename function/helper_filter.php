<?php

class helper_filter {

     protected $UserSes;
     protected $sql;

     public function __construct() {

          global $DBVAR, $SESSION;
          $this->sql = $DBVAR;
          $this->UserSes = $SESSION->get_session_user();
     }

     public function filter_module($data) {
         
		  // echo "masukkk";
		   // pr($data);
		  // exit;
		  $POST = $data;
		  // echo"<pre>";
		  // print_r($POST);
          // echo"</pre>";
			// exit;
		  $kd_idaset = $POST['kd_idaset'];
          $kd_namaaset = $POST['kd_namaaset'];
          $kd_nokontrak = $POST['kd_nokontrak'];
          $kd_tahun = $POST['kd_tahun'];
          $kelompok = $POST['kelompok_id'];
          $lokasi = $POST['lokasi_id'];
          $satker = $POST['satker'];
          $ngo = $POST['ngo_id'];
          $parameterModul = $POST['modul'];
          // pr($_POST);
		  // EXIT;
		  
		  //echo "Paramater Modulll $parameterModul";
          ($POST['sql_where'] == TRUE ) ? $sql_where = " WHERE " : $sql_where = "";
		  
          $sql_param_request = $POST['sql'];
          //==================================
          if ($kd_idaset != "") {
               $query_kd_idaset = " Aset_ID = $kd_idaset";
				// echo "kode aset";
		  }
		  // echo $query_kd_idaset;
		  // exit;
          //=================================
          if ($kd_namaaset != "") {
               $query_kd_namaaset = " NamaAset LIKE '%" . $kd_namaaset . "%' ";
			  // echo "nama aset";
          }
		  // exit;
          //====================================
          if ($kd_nokontrak) {
               $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$kd_nokontrak%'";
               // pr($query_ka_no_kontrak);
			   // print_r($query_ka_no_kontrak);
               // exit;
			   $result = $this->sql->query($query_ka_no_kontrak) or die($this->sql->error());
               // pr($result);
			   if ($this->sql->num_rows($result)) {
			   
                    while ($data = $this->sql->fetch_array($result)) {
                         // pr($data);
						 $dataAsetID[] = $data['Aset_ID'];
                    }
					// pr($dataAsetID);
                    $dataImplode = implode(',', $dataAsetID);
					// echo $dataImplode;
               }else{
					$dataImplode = "";
               }
			   
               if ($dataImplode != "") {
                    $query_no_kontrak = " Aset_ID IN ($dataImplode) ";
               } else {
                    $query_no_kontrak = " Aset_ID IN (NULL) ";
               }
			   
          }
		  // echo $query_no_kontrak;
		  // exit;
          //========================================
          if ($kd_tahun != "") {
               $query_kd_tahun = " Tahun LIKE '%" . $kd_tahun . "%' ";
          }
          //=========================================
          if ($kelompok != "") {
               $temp = explode(",", $kelompok);
               $panjang = count($temp);
               $cek = 0;
               for ($i = 0; $i < $panjang; $i++) {
                    $cek = 1;

                    if ($i == 0)
                         $query_kelompok.="Kelompok_ID ='$temp[$i]'";
                    else
                         $query_kelompok.=" or Kelompok_ID ='$temp[$i]'";
               }
               $query_change_satker = "SELECT Kode FROM Kelompok 
												WHERE $query_kelompok";
               $exec_query_change_satker = $this->sql->query($query_change_satker) or die($this->sql->error());
               while ($proses_kode = $this->sql->fetch_array($exec_query_change_satker)) {


                    if ($proses_kode['Kode'] != "") {
                         $query_return_kode = "SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '" . $proses_kode['Kode'] . "%'";
                    }



                    $exec_query_return_kode = $this->sql->query($query_return_kode);

                    while ($proses_kode2 = $this->sql->fetch_array($exec_query_return_kode)) {
                         $dataRowKelompok[] = $proses_kode2['Kelompok_ID'];
                    }

                    if ($dataRowKelompok != "") {

                         $dataFromKelompok = implode(',', $dataRowKelompok);
                         $query_kelompok_fix.=" Kelompok_ID IN (" . $dataFromKelompok . ")";

                         // $query_kelompok_fix="(";
                         // $cek=0;
                         // for($i=0;$i<$panjang;$i++)
                         // {
                         // $cek=1;
                         // if($i==0)
                         // $query_kelompok_fix.="Kelompok_ID = '".$dataRow2[$i]."'";
                         // else
                         // $query_kelompok_fix.=" or Kelompok_ID = '".$dataRow2[$i]."'";
                         // }
                         // if ($cek==1){
                         // $query_kelompok_fix.=")";}
                         // else{
                         // $query_kelompok_fix="";}
                    }
               }
          }
          //===========================================
          if ($lokasi != "") {
				// echo "masuk lokasi";
               $temp = explode(",", $lokasi);
               $panjang = count($temp);
               $cek = 0;
               for ($i = 0; $i < $panjang; $i++) {
                    $cek = 1;

                    if ($i == 0)
                         $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                    else
                         $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
               }


               $query_change_satker = "SELECT KodeLokasi FROM Lokasi 
												WHERE $query_lokasi";
               $exec_query_change_satker = $this->sql->query($query_change_satker) or die($this->sql->error());
               while ($proses_kode = $this->sql->fetch_array($exec_query_change_satker)) {


                    if ($proses_kode['KodeLokasi'] != "") {
                         $query_return_kode = "SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }


                    $exec_query_return_kode = $this->sql->query($query_return_kode) or die($this->sql->error());

                    while ($proses_kode2 = $this->sql->fetch_array($exec_query_return_kode)) {
                         $dataRowLokasi[] = $proses_kode2['Lokasi_ID'];
                    }

                    if ($dataRowLokasi != "") {

                         $dataFromLokasi = implode(',', $dataRowLokasi);
                         $query_lokasi_fix.=" Lokasi_ID IN (" . $dataFromLokasi . ")";
                         // $panjang=count($dataRow2);
                         // $query_lokasi_fix="(";
                         // $cek=0;
                         // for($i=0;$i<$panjang;$i++)
                         // {
                         // $cek=1;
                         // if($i==0)
                         // $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                         // else
                         // $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                         // }
                         // if ($cek==1){
                         // $query_lokasi_fix.=")";}
                         // else{
                         // $query_lokasi_fix="";}
                    }
               }
          }
		  // echo $query_lokasi_fix;
		  // exit;
          //============================================
          if ($satker != "") {
			// echo "masukk";
               $temp = explode(",", $satker);
               $panjang = count($temp);
               $cek = 0;
               for ($i = 0; $i < $panjang; $i++) {
                    $cek = 1;
                    if ($i == 0)
                         $query_satker.="Satker_ID ='$temp[$i]'";
                    else
                         $query_satker.=" or Satker_ID ='$temp[$i]'";
               }


               $query_change_satker = "SELECT KodeSektor,KodeSatker,KodeUnit,Gudang,NamaSatker FROM Satker 
												WHERE $query_satker";
				// pr($query_change_satker);								
               $exec_query_change_satker = $this->sql->query($query_change_satker) or die($this->sql->error());
               while ($proses_kode = $this->sql->fetch_array($exec_query_change_satker)) {
                    // pr($proses_kode);
					//$dataRow[]=$proses_kode;

                    /*if ($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "") {
                         $query_return_kode = "SELECT Satker_ID FROM Satker WHERE (KodeSektor='" . $proses_kode['KodeSektor'] . "' OR KodeSatker='" . $proses_kode['KodeSatker'] . "')";
                    }
                    if ($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] == "") {
                         $query_return_kode = "SELECT Satker_ID FROM Satker WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "'";
					}*/
					
					if($proses_kode['KodeSektor'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != "" && $proses_kode['Gudang'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "' AND
													Gudang='" . $proses_kode['Gudang'] . "'";
					}
					// pr($query_return_kode);
                    //ini dari ka andreas

                    $exec_query_return_kode = $this->sql->query($query_return_kode) or die($this->sql->error());
                    while ($proses_kode2 = $this->sql->fetch_array($exec_query_return_kode)) {
                         $dataRow2[] = $proses_kode2['Satker_ID'];
                    }


                    if ($dataRow2 != "") {
                         $panjang = count($dataRow2);
                         //$query_satker_fix="(";

                         $dataFromSKPD = implode(',', $dataRow2);
                         //print_r($dataFromSKPD);
                         //$query_satker_fix.=" LastSatker_ID IN (".$dataFromSKPD.")";
                         if ($parameterModul == 'pengadaan') {
                              $query_satker_fix.=" OrigSatker_ID IN (" . $dataFromSKPD . ")";
                         } else if ($parameterModul == 'layanan') {
                              $query_satker_fix.=" OrigSatker_ID IN (" . $dataFromSKPD . ")";
                         } else {
                              $query_satker_fix.=" LastSatker_ID IN (" . $dataFromSKPD . ")";
                         }

                         // $cek=0;
                         // for($i=0;$i<$panjang;$i++)
                         // {
                         // $cek=1;
                         // if($i==0)
                         // $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                         // else
                         // $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                         // }
                         // if ($cek==1){
                         // $query_satker_fix.=")";}
                         // else{
                         // $query_satker_fix="";}
                    }
               }
          }
          //============================================
          if ($ngo != "") {

               $query_ngo = " Satker_ID IN ({$ngo})";
               // $panjang=count($temp);
               // $cek=0;
               // for($i=0;$i<$panjang;$i++)
               // {
               // $cek=1;
               // if($i==0)
               // $query_ngo.="Satker_ID ='$temp[$i]'";
               // else
               // $query_ngo.=" or Satker_ID ='$temp[$i]'";
               // }


               $query_change_ngo = "SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker WHERE $query_ngo";
               //pr($query_change_ngo);
               $exec_query_change_ngo = $this->sql->query($query_change_ngo) or die($this->sql->error());
               while ($proses_kode = $this->sql->fetch_array($exec_query_change_ngo)) {

                    if ($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "") {
                         $query_return_kode = "SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '" . $proses_kode['KodeSektor'] . "%' OR KodeSatker='$proses_kode[KodeSatker]')";
                    }
                    if ($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] == "") {
                         $query_return_kode = "SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '" . $proses_kode['KodeSektor'] . "%')";
                    }


                    $exec_query_return_kode = $this->sql->query($query_return_kode) or die($this->sql->error());
                    while ($proses_kode2 = $this->sql->fetch_array($exec_query_return_kode)) {
                         $dataRowNGO[] = $proses_kode2['Satker_ID'];
                    }

                    if ($dataRowNGO != "") {
                         $dataFromNGO = implode(',', $dataRowNGO);
                         $query_ngo_fix = " LastSatker_ID IN (" . $dataFromNGO . ")";
                         // $panjang=count($dataRow2);
                         // $query_ngo_fix="(";
                         // $cek=0;
                         // for($i=0;$i<$panjang;$i++)
                         // {
                         // $cek=1;
                         // if($i==0)
                         // $query_ngo_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                         // else
                         // $query_ngo_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                         // }
                         // if ($cek==1){
                         // $query_ngo_fix.=")";}
                         // else{
                         // $query_ngo_fix="";}
                    }
               }
               //pr($query_satker_fix);
          }
          //============================================
          $parameter_sql = "";

          if ($kd_idaset != "") {
               $parameter_sql = $query_kd_idaset;
          }
          if ($kd_namaaset != "" && $parameter_sql != "") {
               $parameter_sql = $parameter_sql . " AND " . $query_kd_namaaset;
          }
          if ($kd_namaaset != "" && $parameter_sql == "") {
               $parameter_sql = $query_kd_namaaset;
          }
          if ($kd_nokontrak != "" && $parameter_sql != "") {
			// echo "masukk kontrak";
               $parameter_sql = $parameter_sql . " AND " . $query_no_kontrak;
          }
          if ($kd_nokontrak != "" && $parameter_sql == "") {
               $parameter_sql = $query_no_kontrak;
          }
          if ($kd_tahun != "" && $parameter_sql != "") {
               $parameter_sql = $parameter_sql . " AND " . $query_kd_tahun;
          }
          if ($kd_tahun != "" && $parameter_sql == "") {
               $parameter_sql = $query_kd_tahun;
          }
          if ($kelompok != "" && $parameter_sql != "") {
               $parameter_sql = $parameter_sql . " AND " . $query_kelompok_fix;
          }
          if ($kelompok != "" && $parameter_sql == "") {
               $parameter_sql = $query_kelompok_fix;
          }
          if ($lokasi != "" && $parameter_sql != "") {
               $parameter_sql = $parameter_sql . " AND " . $query_lokasi_fix;
          }
          if ($lokasi != "" && $parameter_sql == "") {
               $parameter_sql = $query_lokasi_fix;
          }
          if ($satker != "" && $parameter_sql != "") {
               $parameter_sql = $parameter_sql . " AND " . $query_satker_fix;
          }
          if ($satker != "" && $parameter_sql == "") {
               $parameter_sql = $query_satker_fix;
          }
          if ($ngo != "" && $parameter_sql != "") {
               $parameter_sql = $parameter_sql . " AND " . $query_ngo_fix;
          }
          if ($ngo != "" && $parameter_sql == "") {
               $parameter_sql = $query_ngo_fix;
          }

		
          if ($parameter_sql != "") {
               $parameter_sql = " WHERE " . $parameter_sql . "";
          } else {
               $parameter_sql = trim($sql_where);
          }
// pr('ada ='.$parameter_sql);
          // pr($parameter_sql);
		  // exit;
		  $sqlcount = "SELECT Aset_ID FROM Aset $parameter_sql";
		  // pr($sqlcount);	
          $sql = "SELECT Aset_ID FROM Aset $parameter_sql";
		  // pr($sql);
		  // exit;
          if ($parameter_sql != 'WHERE') {

               // echo 'ada1';
               $queryCount = $sqlcount . ' AND ' . $sql_param_request;
               $query = $sql . ' AND ' . $sql_param_request;
          } else {


               $queryCount = $sqlcount . ' ' . $sql_param_request;
               $query = $sql . ' ' . $sql_param_request;
          }
		
          
          $res = $this->sql->query($queryCount);
          while ($rows = $this->sql->fetch_array($res)) {
               $dataCount[] = $rows['Aset_ID'];
          }
			// pr($dataCount);
          $_SESSION['parameter_sql_total'] = count($dataCount);

          $_SESSION['parameter_sql'] = $query;

		  // pr($query);
          $rows = $this->sql->_fetch_array($query, 1);
          $_SESSION['parameter_sql_total'] = count($rows);
          return $rows;
     }

     public function getAsetUser($data) {
          /* parameter data dalam bentuk serial untuk diexplode */
			// pr($data);
          $dataImplode = explode(',', $data['Aset_ID']);
          foreach ($dataImplode as $asetid) {
               $sql = "SELECT Aset_ID FROM Aset WHERE UserNm = {$this->UserSes['ses_uoperatorid']} AND Aset_ID = {$asetid} LIMIT 1";
               // pr($sql);
               $res = $this->sql->_fetch_array($sql, 0);
               if ($res) {
                    $dataAsetUser[] = $res['Aset_ID'];
               }
          }

          return $dataAsetUser;
     }

     function back($url=false, $text=false, $paging=false, $nextParam=false)
     {
          
          
          if ($nextParam) $param = "&{$nextParam}";

          $prev = $_SERVER['PHP_SELF'].'?pid='.($paging-1).$nextParam;
          $next = $_SERVER['PHP_SELF'].'?pid='.($paging+1).$nextParam;

          if ($text) $value = $text;
          else $value = "Kembali ke halaman sebelumnya";
          ?>
          <div class="detailRight">
               <ul>
                    <li>
                         <a href="<?php echo $url; ?>">
                                 <input type="submit" name="Lanjut" class="btn" value="<?=$value?>" >
                          </a>
                    </li>
                    <?php if ($paging):?>
                    <li>
                         <input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid'] ?>">
                           <input type="hidden" class="hiddenrecord" value="<?php echo @$count ?>">
                            <ul class="pager">
                                   <li><a href="<?=$prev?>" class="buttonprev" >Previous</a></li>
                                   <li>Page</li>
                                   <li><a href="<?=$next?>" class="buttonnext1">Next</a></li>
                              </ul>
                    </li>
                    <?php endif;?>
               </ul>
                    
          </div>
          <br><br>
          <?php
     }
}

?>
