<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function upload_gambar($file,$folder,$type){

    $folder_resize=$folder;
    if(!file_exists($folder)) {
        mkdir($folder, 0777);
    } 

    if($type==1){
        $allowed = array ('image/pjpeg','image/jpeg', 'image/jpeg',
                   'image/JPG', 'image/X-PNG','image/PNG', 'image/png',
                    'image/x-png');
    }
    else if($type==2){
        $allowed = array ('application/msword','application/pdf');
        
    }
    else if($type==3)
    {
        $allowed = array ('application/dbase', 'application/x-dbase', 'application/dbf', 'application/x-dbf', 'zz-application/zz-winassoc-dbf');
    } 
    else if($type==4)
    {
         $allowed = array ('application/zip', 'application/x-zip', 'application/x-zip-compressed', 'application/octet-stream',
             'application/x-compress', 'application/x-compressed', 'multipart/x-zip');
    }
    
    $c=$_FILES[$file]['type'];
    
     $filename=$_FILES[$file]['name'];
    
     $b=in_array($c, $allowed); 
    // echo("Masuk $c $filename $type bb=$b");
     $type=$_FILES[$file]['type']; 
//	      echo "<h2>$type</h2>";
     if (in_array($_FILES[$file]['type'], $allowed))
    {
      // echo("Masuk 112");
            //Where the file must be uploaded to
            if($folder) $folder .= '/';//Add a '/' at the end of the folder
            $uploadfile = $folder . $filename;
            $result = "$uploadfile  ..";
            //Move the file from the stored location to the new location
            if (move_uploaded_file($_FILES[$file]['tmp_name'], $uploadfile)) {
                chmod("$uploadfile",0777);

                $file1=$_FILES[$file]['name'];
    	
            //    $result .= "harusnya masuk $uploadfile ....";
            } else {
                if(!$_FILES[$file_id]['size']) { //Check if the file is made
                    unlink($uploadfile);//Delete the Empty file
                    $file_name = '';
                    $result .= "Empty file found - please use a valid file."; //Show the error message
                } else {
                    chmod($uploadfile,0777);//Make it universally writable.
                }
            }
            $result="";
             //echo("<script>alert('Upload Telah Berhasil');</script>");
         return 1;    
    }
    else{
        echo("<script>alert('Maaf Anda Mengupload tipe file yang salah');</script>");
      $result="Maaf Anda Mengupload tipe file yang salah";  
    }
  
    return 0;
}

function delete_directory($dirname) {
   if (is_dir($dirname))
      $dir_handle = opendir($dirname);
   if (!$dir_handle)
      return false;
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if (!is_dir($dirname."/".$file))
            unlink($dirname."/".$file);
         else
            delete_directory($dirname.'/'.$file);
      }
   }
   closedir($dir_handle);
   rmdir($dirname);
   return true;
}
?>
