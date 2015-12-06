
<?php

class RETRIEVE_ADMIN extends DB {
    
    public function retrieve_menu_enable($param)
    {
        $query = "SELECT menuID FROM tbl_user_menu WHERE menuStatus = $param";
        $result = $this->query($query) or die ($this->error());
        while ($data = $this->fetch_object($result))
        {
            $dataMenu [] = $data->menuID;
        }
        
        return $dataMenu;
    }
    
    public function retrieve_table_admin ($table, $field, $condition)
    {
        /* SELECT * from operator 
         * SELECT id, nama from operator
         * SELECT * from operator where id = 1
         * SELECT id,nama from operator where id = 1
         */
        if ($condition !='')
        {
            $query = "SELECT $field FROM $table WHERE $condition";
        }
        else
        {
            $query = "SELECT $field FROM $table";
        }
        // print_r($query);
        $result = $this->query($query) or die ($this->error());
        $data = $this->fetch_object($result);
        
        return $data;
    }
    
    public function retrieve_admin_get_page_active ($page, $detail)
    {
        switch ($page)
        {
            case '1':
                $menu = "Menu Admin";
                break;
            case '2':
                $menu = "Akun";
                $menu_sub = "Kelompok Jabatan";
                ($detail == 'd') ? $menu_sub_sub = "Detail Jabatan" : $menu_sub_sub = "Hak Akses";
                break;
            case '3':
                $menu = "Akun";
                $menu_sub = "Users";
                ($detail == 'd') ? $menu_sub_sub = "Detail Operator" : $menu_sub_sub = "Hak Akses";
                break;
            case '4':
                $menu = "Satker";
                $menu_sub = "SKPD";
                //($detail == 'd') ? $menu_sub_sub = "Detail Jabatan" : $menu_sub_sub = "Hak Akses";
                break;
            case '5':
                $menu = "Satker";
                $menu_sub = "NGO";
                break;
            case '6':
                $menu = "Pejabat";
                $menu_sub = "Pejabat SKPD";
                break;
            case '7':
                $menu = "Kode";
                $menu_sub = "Kode Barang";
                break;
            case '8':
                $menu = "Kode";
                $menu_sub = "Kode Rekening";
                break;
            case '9':
                $menu = "Pejabat";
                $menu_sub = "Pejabat Daerah";
                break;
            case '10':
                $menu = "Pengaturan";
                $menu_sub = "Pengaturan Aplikasi";
                break;
            case '11':
                $menu = "Pengaturan";
                $menu_sub = "Pengaturan Report";
                break;
            case '12':
                $menu = "Pengaturan";
                $menu_sub = "Halaman Admin";
                break;
            case '14':
                $menu = "News Update";
                // $menu_sub = "News Update";
                break;
        }
        
        if ($menu_sub_sub !='')
        {
            
            $menu_admin = "$menu &raquo; $menu_sub &raquo; $menu_sub_sub";    
        }
        else if ($menu_sub !='')
        {
            $menu_admin = "$menu &raquo; $menu_sub";
        }
        else
        {
            $menu_admin = "$menu";
        }
        
        return $menu_admin;   
    }
    
    public function admin_retrieve_app_conf($NAMA_KABUPATEN)
    {
        
        $query = "SELECT * FROM tbl_app_config WHERE app_location_desc = '".trim($NAMA_KABUPATEN)."'";    
        // pr($query);exit;
        $result = $this->query($query) or die ($this->error());
        if ($this->num_rows($result))
        {
			
            $data = $this->fetch_object($result);
            $dataArr = $data;
        }
        
        return $dataArr;
    }
    
    public function admin_retrieve_app_logo($param)
    {
        
        $query = "SELECT * FROM tbl_app_logo WHERE logo_desc = '$param'";    
        
        $result = $this->query($query) or die ($this->error());
        if ($this->num_rows($result))
        {
            $data = $this->fetch_object($result);
            $dataArr = $data;
        }
        
        return $dataArr;
    }
    
    public function admin_retrieve_adm_menu_1()
    {
        $queryGroup = " SELECT menuID, menuStatus, menuAksesLogin
			FROM tbl_user_menu";
		
	
	$resultGroup = $this->query($queryGroup) or die ($this->error());
	$sumRec = $this->num_rows($resultGroup);
	if ($sumRec)
	{
	    
		while ($dataGroup = $this->fetch_object($resultGroup))
		{
			$dataArr['menuStatus'][] = $dataGroup->menuStatus;
			$dataArr['menuAksesLogin'][] = $dataGroup->menuAksesLogin;
			$dataArr['menuID'][] = $dataGroup->menuID;
		}
		
		
	}
	$showMenu = explode(',',$dataArr['group']['menuStatus']);
	$accessMenu = explode(',',$dataArr['group']['menuAksesLogin']);
	
	$queryParent = "SELECT * FROM tbl_user_menu_parent";
	
	$resultParent = $this->query($queryParent);
        while ($dataParent = $this->fetch_array($resultParent))
        {
            $dataParentArr [] = $dataParent;
            //hahhaa
        }
        
        return array ($dataArr, $dataParentArr);
    }
    
    public function admin_retrieve_adm_menu_2($param)
    {
        $queryMenu = "SELECT * FROM tbl_user_menu WHERE menuParent = ".$param['menuParentID'] . " ORDER BY menuID";
	// pr($queryMenu);   
    $resultMenu = $this->query($queryMenu);
		
	$no = 1;
    $res = $this->num_rows($resultMenu);
    // pr($res);
    if ($res > 0){
        while ($dataMenu = $this->fetch_array($resultMenu))
            {
                $dataArr [] = $dataMenu;
            }
            
            return $dataArr;
        }
    }
	

    function getNews($id=false)
    {
        $filter = "";

        if ($id) $filter = " AND id = {$id}";
        $sql = "SELECT * FROM tbl_news WHERE n_status IN(0,1) {$filter} ORDER BY created_date DESC";
        // pr($sql);
        $result = $this->query($sql);
        while ($data = $this->fetch_array($result))
        {
            $dataArr [] = $data;
         
        }
        
        return $dataArr;
    
    }

    function getActivity($debug=false)
    {
        $sql = array(
                'table'=>'activity_log AS l, activity AS a, operator AS o',
                'field'=>'l.*, a.activity_value, o.UserNm',
                'condition' => "1",
                'joinmethod' => 'LEFT JOIN',
                'join' => 'l.activity_id = a.activity_id, l.user_id = o.OperatorID'
                );

        $res = $this->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
}
?>

