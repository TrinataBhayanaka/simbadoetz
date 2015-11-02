
<?php

class STORE_ADMIN extends DB {
    
    public function store_table_admin ($table, $param, $bool)
    {
        // id = 1, nama = 'ada', ket = 'oke'
        // insert into table (id, nama, ket) values (1, 'ada', 'oke');
        // $data = "id = 1, nama = 'ada', ket = 'oke'";
        // store_table_admin('Operator', nama='ovan', true);
        // true untuk insert dengan field seleksi sedangkan false untuk insert tanpa neggunakan field
        
        $data = $param;
        
        if ($bool == TRUE)
        {
            
            $explode = explode (',', $data);
            foreach ($explode as $value)
            {
                $get_field = explode ('=',$value);
                $store_field [] = $get_field[0];
                $store_data [] = $get_field[1];
            }
            
            //print_r($store);
            $field = implode (',',$store_field);
            $data = implode (',',$store_data);
            
            $query = "INSERT INTO $table ($field) VALUES ($data)";
        }
        else
        {
            /* $data = false */
            $query = "INSERT INTO $table VALUES ($data)";    
        }
        
        // print_r($query);
        $result = $this->query($query) or die ($this->error());
        
        return true;
        
    }
    
    public function admin_store_kel_barang ()
    {
        
    }
    
    public function admin_store_images($param)
    {
		
        if ($_FILES[$param['file']]["name"] !='')
	{
            if ((($_FILES[$param['file']]["type"] == "image/png") || ($_FILES[$param['file']]["type"] == "image/jpg") || ($_FILES[$param['file']]["type"] == "image/jpeg")))
            {
                
                if ($_FILES[$param['file']]["error"] > 0)
                {
                    echo "Return Code: " . $_FILES[$param['file']]["error"] . "<br />";
                }
                else
                {
                    // if (file_exists("$param[path]" . $_FILES[$param['file']]["name"]))
                    // {
                        //echo $_FILES["image"]["name"] . " already exists. ";
                        
						// rename("$param[path]/".$_FILES[$param['file']]["name"], "$param[path]/$param[file_name]");
                        
      //               }
                    // pr($param);
                    // exit;
                    move_uploaded_file($_FILES[$param['file']]["tmp_name"],"$param[path]/" . $param["file_name"]);
                    //rename("$param[path]/".$_FILES[$param['file']]["name"], "$param[path]/$param[file_name]");
					
                    //echo "$param[path]/". $_FILES[$param['file']]["name"]; 
                    
                    //exit;
                }
            }
            else
            {
                //echo 'invalid file';
                echo '<script type=text/javascript>alert("Invalid File")</script>';
            }
        }
    }
    
    public function admin_store_app_config ($param)
    {
        switch ($param['mode'])
        {
            case '1':
                $query = "INSERT INTO tbl_app_config (app_id, app_location, app_admin_logo, app_admin_title , app_created_by, app_status,tahun_aktif )
                            VALUES (NULL, '$param[NAMA_KABUPATEN]', '$param[file_name]', '$param[title]',
                            '$param[teks_footer]', 1,'$param[tahun_aktif]')";
                
                $result = $this->query($query) or die ($this->error());
                
                return true;
            
                break;
            case '2':

                if ($_FILES[$param['file_header']]['name']){
                    $fieldArr[] = 'app_header_value';
                    $dataArr[] = "'{$_FILES[$param['file_header']]['name']}'";
                }

                if ($_FILES[$param['file_konten']]['name']){
                    $fieldArr[] = 'app_content_value';
                    $dataArr[] = "'{$_FILES[$param['file_header']]['name']}'";
                }

                $fieldArr = array('app_title', 'app_header_status', 
                            'app_content_status', 'app_location', 'app_location_code', 'app_location_desc', 'app_status');
                $dataArr = array("'{$param['title']}'", 1,
                                1, "'{$param['NAMA_KABUPATEN']}'", "'{$param['app_location_code']}'", "'{$param['app_location_desc']}'",1);

                
                // pr($dataArr);



                $field = implode(',', $fieldArr);
                $data = implode(',', $dataArr);


                /*
                $query = "INSERT INTO tbl_app_config ( app_id, app_title, app_header_value, app_header_status, app_content_value,
                            app_content_status, app_location, app_location_code, app_location_desc, app_status )
                            VALUES ( NULL, '$param[title]', '".$_FILES[$param['file_header']]['name']."', 1, '".$_FILES[$param['file_konten']]['name']."',
                                1,'$param[NAMA_KABUPATEN]', '$param[app_location_code], '$param[app_location_desc]','1 )";
                */
                $query = "INSERT INTO tbl_app_config ({$field}) VALUES ({$data}) ";
                // pr($query);
                $result = $this->query($query) or die ($this->error());
                
              
                return true;
            
                break;
            
        }
        
    }
    
    public function admin_store_app_logo ($param)
    {
        $query = "INSERT INTO tbl_app_logo (logo_id, logo_desc, logo_file) VALUES (NULL, '$param[desc]', '".$_FILES[$param['file']]['name']."')";
        $result = $this->query($query) or die ($this->error());
                
        return true;
    }
    
    function saveNews($data=array())
    {

        $date = date("Y-m-d H:i:s");
        if ($data['id']>0){

            $query = "UPDATE tbl_news SET title = '{$data['title']}', brief = '{$data['brief']}', 
                    content = '{$data['content']}', n_status = {$data['n_status']} 
                    WHERE id = {$data['id']}";
        }else{

            $query = "INSERT INTO tbl_news (title, brief, content, created_date, n_status) 
                    VALUES ('{$data['title']}', '{$data['brief']}', '{$data['content']}','{$date}', {$data['n_status']})";
        }
        
        // pr($query);
        $result = $this->query($query) or die ($this->error());
        if ($result) return true;
        return false;
    }
}
?>

