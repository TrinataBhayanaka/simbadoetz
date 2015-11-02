<?php

class UPDATE_ADMIN extends DB {
    
    
    
    public function update_table_admin($table, $param, $condition)
    {
        /* cara penggunaan :
         * $table = nama tabel
         * $param = data (Operator_ID = 1, OperatorName = 'ovan')
         * $condition = ID = 1;
         */
        $query = "UPDATE FROM $table SET $param WHERE $condition";
        $result = $this->query($query) or die ($this->error());
        
        return true;
    }
    
    public function admin_update_app_conf($param)
    {
        $temp = substr($param['app_location_code'], 0, 6);

        $tmp = str_split($temp);
            $count=0;
            foreach ($tmp as $key => $value) {
                if($count == 2){
                    $code = $code.".".$value;
                    $count = 0;    
                } else {
                    $code = $code.$value;
                }
                $count++;
            }
            
        if(strlen($param['app_location_code']) < 7){
            $code_lokasi = $code;
        } else {
            $code_lokasi = $code.".".substr($param['app_location_code'], 6, 4);
        }
        // pr($code_lokasi);exit;
        switch ($param['mode'])
        {
            // admin
            case '1':
                if ($param['logo_admin'] !='')
                {
                    $query = "UPDATE tbl_app_config SET
                            app_admin_logo  = '$param[file_name]', tahun_aktif='$param[tahun_aktif]'
                            WHERE app_location_desc  = '$param[NAMA_KABUPATEN]'";
                    //print_r($query);
                    $result = $this->query($query) or die ($this->error());
                    
                    
                }
                $query = "UPDATE tbl_app_config SET app_admin_title = '$param[title]', tahun_aktif='$param[tahun_aktif]',
                        app_created_by = '$param[teks_footer]' WHERE app_location_desc  = '$param[NAMA_KABUPATEN]'";
                //print_r($query);
                $result = $this->query($query) or die ($this->error());
                return true;
                
                break;
            
            // frontend
            case '2':
                
                if ($param['file_header'] !='')
                {
                    $query = "UPDATE tbl_app_config SET
                            app_title = '$param[title]', tahun_aktif='$param[tahun_aktif]',
                            app_header_value = '".$_FILES[$param['file_header']]['name']."'
                            WHERE app_location_desc  = '$param[NAMA_KABUPATEN]'";
                    $result = $this->query($query) or die ($this->error());
                }
                if ($param['file_konten'] !='')
                {
                    $query = "UPDATE tbl_app_config SET
                            app_title = '$param[title]', tahun_aktif='$param[tahun_aktif]',
                            app_content_value = '".$_FILES[$param['file_konten']]['name']."'
                            WHERE app_location_desc  = '$param[NAMA_KABUPATEN]'";
                    $result = $this->query($query) or die ($this->error());
                }
                
                $query = "UPDATE tbl_app_config SET app_title = '$param[title]',
                            app_location_code = '$code_lokasi', tahun_aktif=$param[tahun_aktif],
                            app_location_desc = '$param[app_location_desc]'
                            WHERE app_location_desc  = '$param[NAMA_KABUPATEN]'";
                //  print_r($query);
                $result = $this->query($query) or die ($this->error());
                
                return true;
            
                break;
        }
        
        
    }
    
    public function admin_update_menu($param)
    {
        
        //$arrMenu = $param['allMenuID'];
	//$showMenu = $param['showMenu'];
	
        //print_r($showMenu);
    // pr($param);

    // exit;
	$query = "UPDATE tbl_user_menu SET menuStatus = 0 , menuAksesLogin = 0 ";
	$result = $this->query($query) or die ($this->error());
	
	if ($result)
	{
            if ($param['showMenu'] !='')
            {
                foreach ($param['showMenu'] as $value)
                {
                    //echo 'ada';
                    
                    $query = "UPDATE tbl_user_menu SET menuStatus = 1 WHERE menuID = $value";
                    //print_r($query);
                    $result = $this->query($query) or die ($this->error());
                }
            }
            
            
            if ($param['accessMenu'] !='')
            {
                foreach ($param['accessMenu'] as $val)
                {
                    //echo 'ada';
                    $query = "UPDATE tbl_user_menu SET menuAksesLogin = 1 WHERE menuID = $val";
                    //print_r($query);
                    $result = $this->query($query) or die ($this->error());
                }
            }
		
		
	}
        
    }
    
    public function admin_update_app_logo($param)
    {
        $query = "UPDATE tbl_app_logo SET logo_file = '".$_FILES[$param['file']]['name']."' WHERE logo_desc = '$param[desc]'";
        $result = $this->query($query) or die ($this->error());
        
        return true;
    }

    function locationUpdate($id=false, $nama=false )
    {
        if (!$id && !$nama) return false;

        // before update check if lokasi use by system
        $sql = "SELECT KodeLokasi FROM lokasi WHERE Lokasi_ID = {$id} LIMIT 1";
        $res = $this->query($sql) or die ($this->error());
        $data = $this->fetch_array($res);
        if ($data){

            $temp = substr($data['KodeLokasi'], 0, 6);

            $tmp = str_split($temp);
                $count=0;
                foreach ($tmp as $key => $value) {
                    if($count == 2){
                        $code = $code.".".$value;
                        $count = 0;    
                    } else {
                        $code = $code.$value;
                    }
                    $count++;
                }
                
            if(strlen($data['KodeLokasi']) < 7){
                $code_lokasi = $code;
            } else {
                $code_lokasi = $code.".".substr($data['KodeLokasi'], 6, 4);
            }

            // pr($code_lokasi);
            $query = "UPDATE tbl_app_config SET app_location_desc = '{$nama}' WHERE app_location_code = '{$code_lokasi}' LIMIT 1";
            $result = $this->query($query) or die ($this->error());
            
        }

        // exit;
        $query = "UPDATE lokasi SET NamaLokasi = '{$nama}' WHERE Lokasi_ID = {$id} LIMIT 1";
        $result = $this->query($query) or die ($this->error());
        if ($result)return true;
        return false;
    }
}
?>