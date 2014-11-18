<?php
 include "../../config/config.php";

    include"$path/header.php";
    include"$path/title.php";
    
    
   $DBVAR = new DB();
    
   
    if (isset($_GET['act']))
    {
        $query = "SELECT * FROM apl_userasetlist WHERE aset_action = 'tambahpenghapusan'";
        $result = $DBVAR->query($query);
        //print_r($query);
        if (mysql_num_rows($result))
        {
           
            while ($dataList = $DBVAR->fetch_object($result))
            {
                $dataLisrArr[] = $dataList;
                
            }
        }
        echo '<pre>';
        //print_r($dataLisrArr);
        echo '</pre>';
           $i = 0;
    
            foreach ($dataLisrArr as $key => $value)
            {
                $aset_list =  $value->aset_list;
            }
            $explode = explode (',',$aset_list);

            foreach ($explode as $key => $value)
            {
                if ($value !='')
                {
                    $sql = "
                SELECT * FROM KontrakAset ka
                INNER JOIN Aset aset ON aset.Aset_ID = ka.Aset_ID
                INNER JOIN Kontrak kontrak ON kontrak.Kontrak_ID = ka.Kontrak_ID
                INNER JOIN Satker satker ON aset.LastSatker_ID = satker.Satker_ID
                WHERE ka.Aset_ID IN  ({$value}) AND aset.Dihapus <> 1 ";
                    //print_r($sql);
                $resultShow =  $DBVAR->query($sql);
                $data = $DBVAR->fetch_object($resultShow);
                $dataShow[] = $data;
                }
                

            }
    }
   
   
       function getRequest($params){
          return   mysql_escape_string(strip_tags(stripslashes($_REQUEST[$params])));
       
       }
       
        //select data from tbl asset by id if assetid not null
        $assetID = getRequest('assetid');
        
       
        //print_r($assetID);
       if($assetID!='') {
           $sql = "
           SELECT * FROM KontrakAset ka
           INNER JOIN Aset aset ON aset.Aset_ID = ka.Aset_ID
           INNER JOIN Kontrak kontrak ON kontrak.Kontrak_ID = ka.Kontrak_ID
           WHERE ka.Aset_ID IN  ({$assetID}) AND aset.Dihapus <> 1 ";
           
           //print_r($sql);
           
           //$rows = query($sql,true); //param $sql, true/false will fecth data
           
             $result = $DBVAR->query($sql); 
           $rows = $DBVAR->num_rows($result); 
           if ($rows)
           { 
               $data = $DBVAR->fetch_object($result);
                
           }
           
       }
          //buat flag hapus
       $hapus = getRequest('hapus');
      //print_r($_POST);
         if($_POST['btn_action']){
             
              $assetHapusId= getRequest('assetHapusId');
              $tglHapus= getRequest('buph_pph_tanggalawal');
              $date = explode ('/',$tglHapus);
              //print_r($date);
              $dateFix = $date[2].'/'.$date[1].'/'.$date[0];
              $alasanHapus= getRequest('infohapus');
              $NoSKHapus= getRequest('idnoskhapus');
              foreach ($_POST['assetHapusId'] as $value)
              {
                  $sql = "UPDATE Aset set Dihapus=1, TglHapus ='{$dateFix}' ,AlasanHapus='{$alasanHapus}' , NoSKHapus 	='{$NoSKHapus}' 
                WHERE Aset_ID IN ({$value}) ";
                //print_r($sql);
              }
               
            $result = $DBVAR->query($sql);
             if ($result)
             {
                 //header('location:penetapan_penghapusan_tambah.php');
             }
             //header('location:penetapan_penghapusan_tambah.php');
         }                   
                  
            if($_GET['idHapus']){
             
                $Aset_ID = $_GET['idHapus'];
              $assetHapusId= getRequest('assetHapusId');
              $tglHapus= getRequest('buph_pph_tanggalawal');
              $date = explode ('/',$tglHapus);
              //print_r($date);
              $dateFix = $date[2].'/'.$date[1].'/'.$date[0];
              $alasanHapus= getRequest('infohapus');
              $NoSKHapus= getRequest('idnoskhapus');
              
                  $sql = "UPDATE Aset set Dihapus=0 WHERE Aset_ID IN ({$Aset_ID}) ";
                //print_r($sql);
             
               
            $result = $DBVAR->query($sql);
             if ($result)
             {
                 //header('location:penetapan_penghapusan_tambah.php');
             }
             //header('location:penetapan_penghapusan_tambah.php');
         }                
         
          //select for hapus data list
          $sql = "
           SELECT * FROM KontrakAset ka
           INNER JOIN Aset aset ON aset.Aset_ID = ka.Aset_ID
           INNER JOIN Kontrak kontrak ON kontrak.Kontrak_ID = ka.Kontrak_ID
           WHERE Dihapus =1";
           
          $resultHapus =  $DBVAR->query($sql);
          //echo mysql_num_rows($resultHapus);
          while ($Hapus = $DBVAR->fetch_object($resultHapus))
          {
              $dataHapus[] = $Hapus;
          }
          echo '<pre>';
          //print_r($dataHapus);
          echo '</pre>';
          
          //select for update
           if($_GET['idUpdate']){
           
              $sql_update ="SELECT * FROM Aset WHERE Aset_id = $_GET ['idUpdate']";
              
              $resultUpdate = $DBVAR -> query($sql_update);
              $dataUpdate =$DBVAR -> fetch_object($result_update);
              
              //print_r($dataUpdate);
           }                           
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
                                function showSpo(data)
                                    {
                                        var id = data.id;
                                        //alert(id);
                                        spoiler = document.getElementById("show_"+id).style.display;

                                        if (spoiler == "")
                                            {
                                                document.getElementById("show_"+id).style.display = "none";
                                            }
                                        else
                                            {
                                                document.getElementById("show_"+id).style.display = "";
                                            }
                                    }
                                    function showSpo1(data)
                                    {
                                        
                                        var id = data.id;
                                        //alert(id);
                                        spoiler1 = document.getElementById("subshow_"+id).style.display;

                                        if (spoiler1 == "")
                                            {
                                                document.getElementById("subshow_"+id).style.display = "none";
                                            }
                                        else
                                            {
                                                document.getElementById("subshow_"+id).style.display = "";
                                            }
                                    }
		
                                    function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="distribusi_barang_filter.php";
		  }
		}
	</script>
                  <script>
                    $(function()
                    {
                    
                    $('#tanggal12').datepicker($.datepicker.regional['id']);
                    }

                    );
                </script>   
                <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                        <?php
                            include"$path/menu.php";
                            
                        
                        ?>	
                  </div>
			
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Penetapan Penghapusan
                                                </div>
                                                        <div id="bottomright">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="50%" align="left" style="border:0px;">
                                                                            <input type="button" id="frmfilter" name="frmfilter" value="Kembali ke form filter" onclick="document.location='penetapan_penghapusan_filter.php'">
                                                                        </td>
                                                                        <td width="50%" align="right" style="border:0px;">
                                                                            <input type="submit" id="idbtnact"  name="idbtnact"  value="Tambah Data">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            <form action="" method="POST" >
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td style="padding:0px;">
                                                                            <div style="margin-top:10px;">
                                                                                <tr>
                                                                                    <td colspan="2" style="margin-top:0px; font-weight:bold; border:1px solid #999; padding:4px;text-decoration:underline;">Daftar Aset yang akan dihapuskan:</td>
                                                                                 </tr>   
                                                                                   <?php 
                                                                                       if($data){
                                                                                           $i = 0;
                                                                                           $no = 1;
                                                                                   foreach($dataShow as $key => $val){
                                                                                       ?>
                                                                                 <tr>
                                                                                     <td style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;">
                                                                                        <table width="100%" border="0">
                                                                                           <tr> 
                                                                                               <td width='0' rowspan="2"><?php echo $no;?>.</td>
                                                                                                <td width='0'><?=$val->NoKontrak?></td><td align="right"><input type="button" onclick="showSpo(this)" value="View Detail" id="<?php echo $i;?>"></td>
                                                                                                <tr>
                                                                                                <td width='0'><?=$val->NamaAset?></td>
                                                                                                </tr>
                                                                                                <td align="right" style="border-style:none;"rowspan="2"></td>
                                                                                                <input type="hidden" name="assetHapusId[]" value="<?php echo $val->Aset_ID?>" >
                                                                                           </tr>
                                                                                           <tr >
                                                                                            <td colspan="3" align="center">
                                                                                                <div  id="show_<?php echo $i?>" style="border:1px solid #dddddd; display: none;">
                                                                                                        <table width="100%">
                                                                                                            <tr>
                                                                                                                <td width="45px"><input type="text" value="99" readonly="readonly" size="1%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                                <td width="7%"><input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                                <td width="160px"><input type="text" value="02.03.01.02.02" readonly="readonly" style="text-align:center; font-weight:bold;"></td>
                                                                                                                <td>-
                                                                                                                    <input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">
                                                                                                                </td>
                                                                                                                <td align="right" style="border-style:none;"><input type="button" onclick="showSpo1(this)" value="Sub Detail" id="<?php echo $i;?>"></td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <table width="97%" border="1" style="border-collapse:collapse;">
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                        <table width="97%" border="0">
                                                                                                                            <tr>
                                                                                                                                <td >Nama Aset</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $val ->NamaAset?></td>
                                                                                                                            </tr>   
                                                                                                                            <tr>
                                                                                                                                <td>Satuan Kerja</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $val->NamaSatker?></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td>Jenis Barang</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $val ->NamaAset?></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                    <td colspan="2"><hr /></td>
                                                                                                                            </tr>
                                                                                                                          </table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                          </table>
                                                                                                     <div  id="subshow_<?php echo $i?>" style="width:99%; height:200px; overflow:auto; border:1px solid #dddddd; display: none;">
                                                                                                        <table width="0%" border="1" style="border-collapse:collapse;">
                                                                                                            <tr>
                                                                                                                    <td>
                                                                                                                            <table width="98%">
                                                                                                                                <tr>
                                                                                                                                    <td colspan="2" style="background-color:#CCCCCC;">Informasi Tambahan</td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Nomor Kontrak</td>
                                                                                                                                    <td><input type="text" value="-" readonly="readonly" name="bup_it_get_nokontrak"></td>
                                                                                                                                <tr>
                                                                                                                                    <td><td>Tidak ada informasi</td></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Operasional/Program</td>
                                                                                                                                    <td>
                                                                                                                                        <select name="bup_it_get_asetOpr">
                                                                                                                                            <option></option>
                                                                                                                                            <option selected="selected">Program</option>
                                                                                                                                            <option>Operasional</option>
                                                                                                                                        </select>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Kuantitas</td>
                                                                                                                                    <td><input type="text" name="bup_it_get_kuantitas" value="1" size="2"> Satuan <input type="text" name="bup_it_get_satuan" value="unit"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Cara Perolehan</td>
                                                                                                                                    <td>
                                                                                                                                        <select name="bup_it_get_perolehan">
                                                                                                                                            <option>-</option>
                                                                                                                                            <option>Pengadaan</option>
                                                                                                                                            <option>Hibah</option>
                                                                                                                                        </select>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Tanggal Perolehan</td>
                                                                                                                                    <td><input type="text" name="bup_it_get_tanggal" readonly="readonly"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Nilai Perolehan</td>
                                                                                                                                    <td><input type="text" value="0" style="text-align:right" name="bup_it_get_nilai" readonly="readonly"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Alamat</td>
                                                                                                                                    <td><textarea cols="130" name ="bup_it_get_alamat"rows="2"></textarea></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td></td>
                                                                                                                                    <td>RT/RW <input type="text" name="bup_it_get_rtrw " readonly="readonly" size="3"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Lokasi</td>
                                                                                                                                    <td><input type="text" readonly="readonly" name="bup_it_get_lokasi" size="100"> <input type="button" value="Cari Lokasi" disabled="disabled"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Koordinat</td>
                                                                                                                                    <td>Bujur Lintang</td>
                                                                                                                                </tr>
                                                                                                                                </tr>
                                                                                                                            </table>
                                                                                                                    </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                    </div>
                                                                                               </td>
                                                                                       </tr>
                                                                                        </table>
                                                                                     </td>
                                                                                 </tr>      
                                                                                        <?php 
                                                                                    
                                                                                     $i++;
                                                                                     $no++;
                                                                                    } ?>
                                                                                             
                                                                                    <?php 
                                                                                   
                                                                                    } ?>
                                                                                </div>
                                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0"style="padding: 10px; border:1px solid #999;">
                                                                                        <tr>
                                                                                            <td valign="top" colspan="3" align="center" width="10px">
                                                                                                    <input type="hidden" name="jmlaset" id="jmlaset" value="0">
                                                                                                    <input type="button" id="btn_tambahaset"value="Tambah Aset" onclick="window.open('tambah_aset_penghapusan.php','','width=600,height=600,scrollbars=Yes')">
                                                                                            </td>				
                                                                                        </tr>
                                                                                    </table>           
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><hr size="1"></td>
                                                                    </tr>
                                                                <table width='100%'>
                                                                    <tr>
                                                                        <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                              <tr>
                                                                                    <td nowrap="true" align="left" valign="top">
                                                                                        Keterangan Penghapusan<br>
                                                                                        <textarea style="width: 500px; height: 100px;" id="idinfohapus" name="infohapus"></textarea>
                                                                                    </td>
                                                                                </tr>
                                                                    <tr>
                                                                        <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                            <table cellspacing="0">
                                                                                <tr>
                                                                                    <td nowrap="true" align="left" valign="top">
                                                                                        Nomor SK Penghapusan<br>
                                                                                        <input type="text" style="width: 280px;" id="idnoskhapus" name="idnoskhapus"onchange="toggle_data_valid()"onkeydown="toggle_data_valid()"onkeypress="toggle_data_valid()"onkeyup="toggle_data_valid()"  value="">
                                                                                    </td>
                                                                                    <td nowrap="true">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                    <td nowrap="true" align="left" valign="top">
                                                                                            Tanggal SK Penghapusan<br>
                                                                                            <input type="text" name="buph_pph_tanggalawal" style="width:150px;" id="tanggal12">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th colspan="4" align="center" >
                                                                            <input type="submit" name="btn_action" id="btn_action" value="Hapus" onclick="return window.confirm( 'Data Aset yang akan di hapuskan sudah benar??' );">
                                                                            <input type="button" name="btn_action" id="btn_action_cancel"  style="width:100px;"  value="Batal"  onclick="document.location='penetapan_penghapusan_daftar_isi.php';">
                                                                        </th>
                                                                    </tr>
                                                                </table>
                                                            </form>
                                                                <table class="listdata" width="100%" border="1"cellpadding="0" cellspacing="0"style="padding:2px; margin-top:0px; border: 1px solid #cccccc; border-width: 0px 1px 0px 1px;border-collapse:collapse;">
                                                                    <tr>
                                                                        <th align="center" width="40px" style="background-color:#eeeeee;">No</th>
                                                                        <th align="center" width="170px" style="background-color:#eeeeee;">Nomor Penghapusan</th>
                                                                        <th align="center" width="150px" style="background-color:#eeeeee;">Tgl Penghapusan</th>
                                                                        <th align="center" width="%" style="background-color:#eeeeee;">Detail Penghapusan</th>
                                                                        <th align="center" width="85px" style="background-color:#eeeeee;">Tindakan</th>
                                                                    </tr>
                                                                
                                                                          <?php 
                                                                                   if($dataHapus){
                                                                                       $no = 1;
                                                                                       
                                                                                   foreach($dataHapus as $key => $val){?>
                                                                                  <tr>
                                                                                        <td align="center" class="listdata" valign="top" ><?=$no?></td>
                                                                                        <td align="center"   class="listdata" valign="top" ><?=$val->NoSKHapus ?></td>
                                                                                        <td align="center"  class="listdata" valign="top" ><?=$val->TglHapus ?></td>
                                                                                        <td align="center"  class="listdata" valign="top" ><?=$val->AlasanHapus  ?></td>
                                                                                        <td align="center"  class="listdata" valign="top" ><a href="?update=1&idUpdate=<?=$val->Aset_ID ?>" >update</a> | <a href="?delete=1&idHapus=<?=$val->Aset_ID ?>" >delete</a></td>
                                                                                     </tr>
                                                                                      <?php 
                                                                                      $no++;
                                                                                      }
                                                                                      
                                                                                      }else
                                                                                          { ?>                                                                                         
                                                                         
                                                                      <tr>
                                                                        <td align="center" colspan="5"style="padding:15px 5px 10px 5px; color: #cc3333; font-weight: bold;">..:: Tidak ada data ::..</td>
                                                                    </tr>
                                                                          <?php } ?>  
                                                                </table>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        <?php
                include"$path/footer.php";
        ?>
</body>
</html>	
