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

		// pr($data);
		// $dataParam['nokontrak'] =$data['nokontrak'];
		// $dataParam['jenisaset'] =$data['jenisaset'];
		// $dataParam['kodeSatker'] =$data['kodeSatker'];
		// $dataParam['statusaset'] =$data['statusaset'];
		// $dataParam['kd_tahun'] =$data['kd_tahun'];
		// $dataParam['page'] =$data['page'];
		// pr($dataParam['page']);

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
								
								$checked = false;
								if ($value['checked']) $checked = true;

								$row[] = $this->additional('checkbox', array('name'=>$expl[1], 'value'=>$completeURi, 'checked'=>$checked));
			            	
			            	}else{
			            		$row[] = $this->additional('checkbox', array('name'=>$expl[1]));
			            	}
			            }
			            else $row[]=$value[$tmp[0]] . ' / ' . $value[$tmp[1]];

		        	}else{

		        		if ($val == 'no'){
			            	
			            	$row[]=$$val;

			            }else{
			            	$row[] = $value[$val];
			            } 
		        	}

		            

	            }    

	            
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
					if ($data['checked']) $checked = "checked = checked";
					return "<input type=\"checkbox\" id=\"checkbox\" class=\"checkbox\" onchange=\"enable()\" name=\"{$data['name']}[]\" value=\"{$data['value']}\" {$checked}>";
					break;
				
				case 'detail':
					return "<a href=$data[url]>
						   <input type='button' name='Lanjut' class='btn' value='Lihat Histori' >
						</a>";
					break;
				default:
					return false;
					break;
			}
		}

		return false;
	}
}
?>