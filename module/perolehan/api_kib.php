<?

  include "../../config/database.php";  
  open_connection();
   $kib = $_GET['kib'];
//echo "masuykkkk $kib ";
if(isset($kib))
{
    
    switch ($kib)
    {
        case 'KIB-A':
            {
                
                echo "  <ol id=\"inventaris1\"  class=\"formset\"> 
                </ol>";
            }
            break;
        case 'KIB-B':
            {
                
                 echo "  <ol id=\"inventaris2\"  class=\"formset\">";
	$query="select * from Kelompok where Golongan='02' and Bidang is not NULL and Kelompok is NULL and Sub is NULL and SubSub is NULL";
	$result=mysql_query($query) or die(mysql_error()); 
	echo "Bidang Aset           :
                        <select  name=\"bidang\">
	";
	echo "<option value=\"\" style=\"width:450px;\">Semua Bidang</option>"; 
	while($row=mysql_fetch_object($result)){
		$kode=$row->Kelompok_ID;
		$uraian=$row->Uraian;	
		 echo "<option value=\"$kode\" style=\"width:450px;\">$uraian</option>";   
	}
		echo "</select>";
                echo "</ol>";
            }
            break;
        case 'KIB-C':
            {
                  echo "  <ol id=\"inventaris3\"  class=\"formset\">";
	$query="select * from Kelompok where Golongan='03' and Bidang is not NULL and Kelompok is NULL and Sub is NULL and SubSub is NULL" ;
                $result=mysql_query($query) or die(mysql_error()); 
	echo "Bidang Aset           :
                        <select  name=\"bidang\">
	";
	echo "<option value=\"\" style=\"width:450px;\">Semua Bidang</option>"; 
	while($row=mysql_fetch_object($result)){
		$kode=$row->Kelompok_ID;
		$uraian=$row->Uraian;	
		 echo "<option value=\"$kode\" style=\"width:450px;\">$uraian</option>";   
	}
		echo "</select>";
                echo "</ol>";

            }
            break;
        case 'KIB-D':
            {
                 echo "  <ol id=\"inventaris4\"  class=\"formset\">";
	$query="select * from Kelompok where Golongan='04' and Bidang is not NULL and Kelompok is NULL and Sub is NULL and SubSub is NULL" ;
                $result=mysql_query($query) or die(mysql_error()); 
	echo "Bidang Aset           :
                        <select  name=\"bidang\">
	";
	echo "<option value=\"\" style=\"width:450px;\">Semua Bidang</option>"; 
	while($row=mysql_fetch_object($result)){
		$kode=$row->Kelompok_ID;
		$uraian=$row->Uraian;	
		 echo "<option value=\"$kode\" style=\"width:450px;\">$uraian</option>";   
	}
		echo "</select>";
                echo "</ol>";
            }
            break;
        case 'KIB-E':
            {
                 echo "  <ol id=\"inventaris5\"  class=\"formset\">";
	$query="select * from Kelompok where Golongan='05' and Bidang is not NULL and Kelompok is NULL and Sub is NULL and SubSub is NULL" ;
               echo "Bidang Aset           :
                        <select  name=\"bidang\">
	";
	echo "<option value=\"\" style=\"width:450px;\">Semua Bidang</option>"; 
	$result=mysql_query($query) or die(mysql_error()); 
	while($row=mysql_fetch_object($result)){
		$kode=$row->Kelompok_ID;
		$uraian=$row->Uraian;	
		 echo "<option value=\"$kode\" style=\"width:450px;\">$uraian</option>";   
	}
		echo "</select>";
                echo "</ol>";
            }
            break;
        case 'KIB-F':
            {
                  echo "  <ol id=\"inventaris6\"  class=\"formset\">";
	      
                echo "</ol>";
            }
            break;
    }
}
?>
