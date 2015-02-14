<?php

class ServerSide{

	function loadAPI($api)
	{

		$API = new $api;

		return $API;
	}

	function dTableData($data=array())
	{

		global $DBVAR, $url_rewrite;

		$API = $this->loadAPI($data['APIHelper']);

		// $dataParam['jenisaset'][0]=$data['jenisaset'];
		// if($data['jenisaset']=="2")$merk="m.Merk";
		// else $merk="";

		$aColumns = array('a.Aset_ID');

		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = $data['primaryField'];

		/* DB table to use */
		$sTable = $data['primaryTable'];

		$dataParam['nokontrak'] =$data['nokontrak'];
		$dataParam['jenisaset'] =$data['jenisaset'];
		$dataParam['kodeSatker'] =$data['kodeSatker'];
		$dataParam['statusaset'] =$data['statusaset'];
		$dataParam['kd_tahun'] =$data['kd_tahun'];
		$dataParam['page'] =$data['page'];

		$sLimit = "";
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
		     $sLimit = " " . intval($_GET['iDisplayStart']) . ", " .
		             intval($_GET['iDisplayLength']);
		}


		// Ordering
		 
		$sOrder = "";
		if (isset($_GET['iSortCol_0'])) {
		     $sOrder = "ORDER BY  ";
		     for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
		          if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
		               //$sOrder .= "'" . $aColumns[intval($_GET['iSortCol_' . $i])] . "' " .
		               $sOrder .= "" . $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
		                       ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
		          }
		     }

		     $sOrder = substr_replace($sOrder, "", -2);
		     if ($sOrder == "ORDER BY") {
		          $sOrder = "";
		     }
		}


		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		//$sWhere = "";
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
		     //$sWhere = "WHERE (";
		     $sWhere ="(";
		     for ($i = 0; $i < count($aColumns); $i++) {
		          if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
		               $sWhere .= "" . $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
		          }
		     }
		     $sWhere = substr_replace($sWhere, "", -3);
		     $sWhere .= ')';
		}

		/* Individual column filtering */
		for ($i = 0; $i < count($aColumns); $i++) {
		     if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
		          if ($sWhere == "") {
		        //       $sWhere = "WHERE ";
		               $tidakdipakai=0;
		          } else {
		               $sWhere .= " AND ";
		          }
		          $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
		     }
		}


		//echo $sWhere;
		$dataParam['condition']="$sWhere ";
		$dataParam['order']=$sOrder;  
		$dataParam['limit']="$sLimit";

		$SSData = $data;
		$data = $API->retrieve_layanan_aset_daftar($dataParam);	
		

		/* Data set length after filtering */
		$sQuery = "
				SELECT FOUND_ROWS()
			";
		$rResultFilterTotal = $DBVAR->query($sQuery);
		$aResultFilterTotal = $DBVAR->fetch_array($rResultFilterTotal);
		$iFilteredTotal = $aResultFilterTotal[0];

		
		/* Total data set length */
		$sQuery = "
				SELECT COUNT(`" . $sIndexColumn . "`)
				FROM   $sTable
			";

		//echo "$sQuery";
		$rResultTotal = $DBVAR->query($sQuery);
		$aResultTotal = $DBVAR->fetch_array($rResultTotal);
		//pr($aResultTotal );
		$iTotal = $aResultTotal[0];

		/*
		 * Output
		 */
		$output = array(
		    "sEcho" => intval($_GET['sEcho']),
		    "iTotalRecords" => $iTotal,
		    "iTotalDisplayRecords" => $iFilteredTotal,
		    "aaData" => array()
		);

		$no=$_GET['iDisplayStart']+1;
		if (!empty($data)){

		  	foreach ($data as $key => $value){
				// pr($get_data_filter);
				if($value[kondisi]==2){
					$kondisi="Rusak Ringan";
				}elseif($value[kondisi]==3){
					$kondisi="Rusak Berat";
				}elseif($value[kondisi]==1){
					$kondisi="Baik";
				}
				
				// $TglPerolehanTmp=explode("-", $value[TglPerolehan]);
				// $TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];
		                                          
             	$row = array();
		        
		        $detail="<a href=$url_rewrite/module/layanan/history_aset.php?id={$value[Aset_ID]}&jenisaset={$value[TipeAset]}>
						   <input type='button' name='Lanjut' class='btn' value='Lihat Histori' >
						</a>";
				$checkbox="<input type=\"checkbox\" id=\"checkbox\" class=\"checkbox\" onchange=\"enable()\" name=\"Layanan[]\" value=\"{$value['Aset_ID']}_{$value['TipeAset']}\">";
				$checkbox = "&nbsp;";
		        foreach ($SSData['view'] as $key => $val) {
		            
		        	$tmp = explode('|', $val);
		        	
		        	if (count($tmp)>1){

		        		$row[]=$value[$tmp[0]] . '-' . $value[$tmp[1]];

		        	}else{

		        		if ($val == 'no' or $val == 'checkbox'){
			            	$row[]=$$val;

			            }else if ($val == 'detail'){
			            	$row[] = $detail;
			            }else{
			            	$row[] = $value[$val];
			            } 
		        	}

		            

	            }    

	            /*
             	$checkbox="<input type=\"checkbox\" id=\"checkbox\" class=\"checkbox\" onchange=\"enable()\" name=\"Layanan[]\" value=\"{$value['Aset_ID']}_{$value['TipeAset']}\">";
	            $row[]=$no;
        	    $row[]=$checkbox;
		        $row[]=$value['noRegister'] ;
		        $row[]=$value['noKontrak'];
		        $row[]="{$value[kodeKelompok]}<br/>{$value[Uraian]}";
		        $row[]="[".$value[kodeSatker] ."]". $value[NamaSatker];
		        $row[]=$TglPerolehan;
		        $row[]=number_format($value[NilaiPerolehan]);
		        $detail="<a href=$url_rewrite/module/layanan/history_aset.php?id={$value[Aset_ID]}&jenisaset={$value[TipeAset]}>
		                     <input type='button' name='Lanjut' class='btn' value='Lihat Histori' >
		                 </a>";
		        $row[]=$detail;
		        */
		        $output['aaData'][] = $row;
		        $no++;
		  	}
		}

		return ($output);

	}
}
?>