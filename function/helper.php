<?php

/* Fungsi helper sistem */

function pr($data) {
     echo '<pre>';
     print_r($data);
     echo '</pre>';
}

function vd($data) {
     echo '<pre>';
     var_dump($data);
     echo '</pre>';
}

function _p($data) {
     return clean($_POST[$data]);
}

function _g($data) {
     return clean($_GET[$data]);
}

function _r($data) {
     return clean($_REQUEST[$data]);
}

function clean($data) {
     return trim(strip_tags($data));
}

function redirect($data) {
     
     echo "<meta http-equiv=\"refresh\" content=\"0; url={$data}\">";

}

function encode($data=false)
{
     $hasil = base64_encode(serialize($data));
     return $hasil;
}

function decode($data=false)
{
     $hasil = unserialize(base64_decode($data));
     return $hasil;
}

function writelog($data) {
     $date = date('d-m-Y');
     $file = fopen("../log/log_sys_$date.txt", "w");
     if (isset($_SESSION['ses_aname'])) {
          $sess = $_SESSION['ses_aname'];
     } else if (isset($_SESSION['ses_uname'])) {
          $sess = $_SESSION['ses_uname'];
     } else {
          $sess = 'Sessi undefined';
     }
     fwrite($file, "$sess action $data ON " . date('Y-m-d H:i:s'));
     fclose($file);
}

function paging($data="", $length="") {
	
     $data = trim(strip_tags($data));
	// echo "data=".$data;
     if ($data == 1) {
          $paging = ((($data - 1) * $length));
		  
     } else {
          // $paging = ((($data - 1) * $length) + 1);
          $paging = ((($data - 1) * $length) );
		  // echo $paging; 
     }

     return $paging;
}

function newPaging($data) {

     // Langkah 1: Tentukan batas,cek halaman & posisi data
     $batas = $data['setPage'];
     $halaman = $data['halaman'];
     if (empty($halaman)) {
          $posisi = 0;
          $halaman = 1;
     } else {
          $posisi = ($halaman - 1) * $batas;
     }

     //Langkah 2: Sesuaikan perintah SQL
     $tampil = "SELECT * FROM anggota LIMIT $posisi,$batas";
     //print_r($tampil);
     $hasil = mysql_query($tampil);

     $no = $posisi + 1;
     while ($r = mysql_fetch_array($hasil)) {
          echo "<tr><td>$no</td><td>$r[nama]</td><td>$r[alamat]</td></tr>";
          $no++;
     }
     echo "</table><br>";

     //Langkah 3: Hitung total data dan halaman 
     $tampil2 = mysql_query("SELECT * FROM anggota");
     $jmldata = mysql_num_rows($tampil2);
     $jmlhal = ceil($jmldata / $batas);

     echo "<div class=paging>";
     // Link ke halaman sebelumnya (previous)
     if ($halaman > 1) {
          $prev = $halaman - 1;
          echo "<span class=prevnext><a href=$_SERVER[PHP_SELF]?halaman=$prev>« Prev</a></span> ";
     } else {
          echo "<span class=disabled>« Prev</span> ";
     }

     // Tampilkan link halaman 1,2,3 ...
     for ($i = 1; $i <= $jmlhal; $i++)
          if ($i != $halaman) {
               if (isset($_GET['setPage'])) {
                    $setPage = $_GET['setPage'];
                    echo " <a href=$_SERVER[PHP_SELF]?halaman=$i&setPage=$setPage>$i</a> ";
               } else {
                    echo " <a href=$_SERVER[PHP_SELF]?halaman=$i>$i</a> ";
               }
          } else {
               echo " <span class=current>$i</span> ";
          }

     // Link kehalaman berikutnya (Next)
     if ($halaman < $jmlhal) {
          $next = $halaman + 1;
          echo "<span class=prevnext><a href=$_SERVER[PHP_SELF]?halaman=$next>Next »</a></span>";
     } else {
          echo "<span class=disabled>Next »</span>";
     }
     echo "</div>";
}

function logAset($asetID=false, $satkerID=false, $lastSatkerID=false, $desc=false)
{

     if (!$asetID) return false;

     $date = date('Y-m-d H:i:s');

     $field = array('asetID','n_status');
     $data = array($asetID, 1);

     if ($satkerID){
          $field[] = 'satkerID';
          $data[] = $satkerID;
     } 
     if ($lastSatkerID){
          $field[] = 'lastSatkerID';
          $data[] = $lastSatkerID;
     } 
     if ($desc){
          $field[] = 'desc';
          $data[] = "'$desc'";
     } 



     $tmpField = implode(',', $field);
     $tmpData = implode(',', $data);


     $sql = "INSERT INTO tbl_log_aset ({$tmpField})
               VALUES ({$tmpData})";
     // pr($sql);
     $res = mysql_query($sql) or die(mysql_error());
     if ($res) return true;
     return false;
}

function ubahLokasi($lokasi=false, $satkerbaru=false)
{

     // lokasi

     if (!$lokasi) return false;
     if (!$satkerbaru) return false;

     $tmp = explode('.',$lokasi);
     $slice_firstcode = array_slice($tmp,0, count($tmp)-5, true);

     // satker
     $tmps = explode('.',$satkerbaru);
     $slice_firstcodes = array_slice($tmps,0, count($tmps)-2, true);

     $slice_firstcodeLast = array_slice($tmps,2, count($tmps), true);

     $slice_part2 = $tmp[5];

     $noLokasi_1 = implode('.',$slice_firstcode);
     $noLokasi_2 = implode('.',$slice_firstcodes);
     $noLokasi_3 = implode('.',$slice_firstcodeLast);

     $noLokasiFix = $noLokasi_1.".".$noLokasi_2.".".$slice_part2.".".$noLokasi_3;
     
     if ($noLokasiFix) return $noLokasiFix;
     return false;
}

function logFile($comment, $fileName=false, $method=false)
{
     
     global $path;
     /*
          method false = "a"
          method (true)1 = w
     */
     $paths = $path.'/log/';
     
     if (!$fileName) $fileName = 'Log-'.date('d-m-Y').'.txt';
     
     if ($method){
          $handle = fopen($paths.$fileName, "w");
     }else{
          $handle = fopen($paths.$fileName, "a");
     }
     
     fwrite($handle, "{$comment}"."\n");
     fclose($handle);
}

function openFile($filePath)
{

     if(file_exists($filePath)) {
          $handle = fopen($filePath, "r");
          $fileContents = fread($handle, filesize($filePath));
          fclose($handle);
          return $fileContents;
     }
     return false;
}
?>
