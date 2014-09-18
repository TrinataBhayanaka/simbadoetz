<?php

if (isset($_POST['btn_save']))
{
   
    //print_r($Jabatan);
    $Jabatan = $_POST['nama_jabatan'];
    $Pejabat = $_POST['idnama'];
    $NIP = $_POST['idnip'];
    
    
    $i = 0;
    foreach ($Jabatan as $namaJabatan)
    {
        $query = "SELECT * FROM Pejabat WHERE NamaJabatan = '$namaJabatan'";
        
        $result = $DBVAR->query($query) or die ($DBVAR->error());
        if ($result)
        {
            // update
            $query = "UPDATE Pejabat SET NamaPejabat = '$Pejabat[$i]', NIPPejabat  = '$NIP[$i]'
                        WHERE  NamaJabatan = '$namaJabatan'";
            $result = $DBVAR->query($query) or die ($DBVAR->error());
            
        }
        else
        {
            // insert
            $query ="INSERT INTO Pejabat ( NamaJabatan, NamaPejabat, Satker_ID, NIPPejabat )
                    'VALUES ( '$namaJabatan', $Pejabat[$i], NULL, '$NIP[$i]')";
            $result = $DBVAR->query($query) or die ($DBVAR->error());
        }
        
        $i++;
    }
}

$query = "SELECT DISTINCT(NamaJabatan) FROM Pejabat";
$result = $DBVAR->query($query) or die ($DBVAR->error());
while ($data = $DBVAR->fetch_object($result))
{
    if (($data->NamaJabatan == 'Kepala Daerah') or ($data->NamaJabatan == 'Pengelola BMD'))
    {
        $dataArr [] = $data->NamaJabatan;
    }
    // $dataArr [] = $data->NamaJabatan;
}

// print_r($dataArr);
if ($dataArr > 0) :

foreach ($dataArr as $NamaJabatan)
{
    $query = "SELECT distinct(NamaPejabat) FROM Pejabat WHERE NamaJabatan = '$NamaJabatan'";
    $result = $DBVAR->query($query) or die ($DBVAR->error());
    while ($data = $DBVAR->fetch_object($result))
    {
        $dataPejabat [] = $data->NamaPejabat;
    }
    
}

//print_r($dataPejabat);
$i = 0;
foreach ($dataPejabat as $NamaPejabat)
{
    $query = "SELECT distinct(NIPPejabat) FROM Pejabat WHERE NamaPejabat = '$NamaPejabat'";
    $result = $DBVAR->query($query) or die ($DBVAR->error());
    while ($data = $DBVAR->fetch_object($result))
    {
        $dataNIP [] = $data->NIPPejabat;
    }
    
    $i++;
}

//print_r($dataNIP);
for ($i = 0; $i < count($dataArr); $i++)
{
    $dataArray [] = "$dataArr[$i]/$dataPejabat[$i]/$dataNIP[$i]";
}

endif;
//print_r($dataArray);
/*
echo '<pre>';
print_r($dataArray);
echo '</pre>';
*/
?>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
    <td>
        <form method="post" action=""> 
            <table align="center" width="100%" cellpadding="0" cellspacing="5" border="0">
                
                <!--
                <tr>
                <th class="datalist" align="center" width="50%">Daftar User</td>
                <th class="datalist" align="center" width="50%">Daftar Modul Proses</th></tr>
                -->
                
                <tr>
                    <td class="datalist" valign="top" align="left" width="35%">
                        <div class="datalist_head" align="left" style="font-weight:bold; margin-top:0px; padding:3px 5px 2px 5px;color: #3A574E;">
                            Pejabat Daerah
                        </div>
                        
                            
<br>  <br>
  <form method="POST" action="?init=d">
    <table width="60%" align="left">
      <tr>
        <th align="center">Jabatan</th>
        <th align="center">Nama Pejabat</th>
        <th align="center">NIP Pejabat</th>
      </tr>
      <tr>
        <td colspan="3"><hr></td>
      </tr>
      <?php
      
		if (is_array($dataArray)){
			for ($i = 0; $i < count($dataArray); $i++){
			list ($jabatan, $pejabat, $nip) = explode ('/',$dataArray[$i]);
		  ?>
			  <tr>
				<td align="left" valign="top" style="wisth:220px;"><?php echo $jabatan; ?></td>
				<td align="center" valign="top">&nbsp;<input type="text" style="width:350px"
						 name="idnama[]" id="idnama_0"
						 value="<?=$pejabat;?>">&nbsp;</td>
				<td align="center" valign="top">&nbsp;<input type="text" style="width:120px"
						 name="idnip[]" id="idnip_0"
						 value="<?=$nip?>">&nbsp;
				<input type="hidden" name="nama_jabatan[]" value="<?=$jabatan?>">
				</td>
			  </tr>
			  
			  <?php 
			  }
		}
      
	
      ?>
      
      <tr>
        <td colspan="3"><hr></td>
      </tr>
      <tr>
        <td colspan="3" align="right">
          <input type="submit" name="btn_save" value="Simpan"
                 onclick="return window.confirm('Simpan data ini?');">
          <input type="reset"  name="btn_cancel" value="Reset">
        </td>
      </tr>
    </table>
  </form>      </td>
    </tr>
    
  </table>
    </td>

    <!--
    <td width="*"></td>
    -->

  </tr>
</table>
