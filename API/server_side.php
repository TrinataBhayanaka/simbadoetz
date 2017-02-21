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

		$aColumns = $data['searchField'];

		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = $data['primaryField'];

		/* DB table to use */
		$sTable = $data['primaryTable'];

		if ($data['filter']){
			foreach ($data['filter'] as $key => $value) {
				
				$dataParam[$key] = $value;
			}
		}

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
		$data = $API->$data['APIFunction']($dataParam);	
		//pr($data);

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
				                               
             	$row = array();
		        
		        foreach ($SSData['view'] as $key => $val) {
		            //pr($val);
		        	$tmp = explode('|', $val);
		        	if (count($tmp)>1){
		        		
		        		if ($tmp[0] == 'detail'){

			            	$expl = explode('|', $val);

			            	if (count($expl)>2){
			            		$concate = array();
			            		$getParam = explode('&', $expl[2]);
			            		for ($i=0; $i < count($getParam); $i++) { 
			            			$expParam = explode('=', $getParam[$i]);
			            			$concate[] = $expParam[0] . '=' .$value[$expParam[1]];
			            		}

			            		$impl = implode('&', $concate);
			            		$completeURi = $impl; 
								
								$row[] = $this->additional('detail', array('url'=>$expl[1]. "?" . $completeURi));
			            	
			            	}else{
			            		$row[] = $this->additional('detail', array('url'=>$expl[1]));
			            	}
			            	
			            	
			            }else if ($tmp[0] == 'checkbox'){

			            	$expl = explode('|', $val);

			            	if (count($expl)>2){
			            		$concate = array();
			            		$getParam = explode('&', $expl[2]);
			            		for ($i=0; $i < count($getParam); $i++) { 
			            			
			            			$concate[] = $value[$getParam[$i]];
			            		}


			            		$impl = implode('_', $concate);
			            		$completeURi = $impl; 
								// pr($value);
								$checked = false;
								
								if ($value['checked']) $checked = true;
								// echo $tmp[1]; 
								if ($tmp[1]=="Layanan"){
									if ($value['noKontrak']!=""){
										$row[] = $this->span();
										
									}else{
										$row[] = $this->additional('checkbox', array('name'=>$expl[1], 'value'=>$completeURi, 'checked'=>$checked));
									} 
								}else{

									$row[] = $this->additional('checkbox', array('name'=>$expl[1], 'value'=>$completeURi, 'checked'=>$checked));
								}
								

								
			            	
			            	}else{
			            		$row[] = $this->additional('checkbox', array('name'=>$expl[1]));
			            	}
			            }else{
			            	//$row[]=$value[$tmp[0]] . ' / ' . $value[$tmp[1]];
			            	//revisi
			            	if($tmp['0'] == 'Merk'){
			            		$expl = explode('.', $value['kodeKelompok']);
			            		$Aset_ID = $value['Aset_ID'];
			            		if($expl['0'] == '02'){
				            		if($tmp['0'] == 'Merk' && $tmp['1'] == 'Model'){
				            			$query = "SELECT Merk,Model FROM mesin WHERE 
				            			          Aset_ID = '$Aset_ID'";
				            			$exe = $DBVAR->query($query);
				            			$res = $DBVAR->fetch_array($exe);
				            			$row[]=$res[0] . ' / ' . $res[1];
			            			}
				            	}else{
				            		//nothing
				            		$row[]='';
				            	}
			            	}else{
			            		$row[]=$value[$tmp[0]] . ' / ' . $value[$tmp[1]];	
			            	}
			            } 
			            

		        	}else{

		        		if ($val == 'no'){
			            	
			            	$row[]=$$val;

			            }else{
							//$row[] = $value[$val];
							//revisi
							if($val == 'NoSTNK'){
								$expl = explode('.', $value['kodeKelompok']);
			            		$Aset_ID = $value['Aset_ID'];
			            		if($expl['0'] == '02'){
			            			$query2 = "SELECT NoSTNK FROM mesin WHERE 
			            			          Aset_ID = '$Aset_ID'";
			            			$exe2 = $DBVAR->query($query2);
			            			$res2 = $DBVAR->fetch_array($exe2);
			            			$row[]=$res2[0];
			            			
				            	}else{
				            		//nothing
				            		$row[]='';
				            	}
							}else{
							   $row[] = $value[$val];
							}
			            } 
		        	}

		            

	            }    

	            //pr($row);
	            //exit;
		        $output['aaData'][] = $row;
		        $no++;
		  	}
		}

		return ($output);

	}

	function additional($id=false, $data)
	{


		if ($id){
			switch ($id) {
				case 'checkbox':
					$checked = "";
					$disabled = "";
					if ($data['checked']) $checked = "checked = checked";
					// if ($data['disabled']) $disabled = "disabled = disabled";
					return "<input type=\"checkbox\" id=\"checkbox\" class=\"icheck-input checkbox\" onchange=\"return AreAnyCheckboxesChecked();\" name=\"{$data['name']}[]\" value=\"{$data['value']}\" {$checked} >";
					break;
				
				case 'detail':
					return "<a href=$data[url]>
						   <input type='button' name='Lanjut' class='btn' value='Lihat Riwayat' >
						</a>";
					break;
				default:
					return false;
					break;
			}
		}

		return false;
	}

	function span()
	{
		return "<span>&nbsp;</span>";
	}
}
?>