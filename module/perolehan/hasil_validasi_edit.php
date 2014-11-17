<?php ob_start(); 
?>
<html>
<?php
        include "../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
        ?>    
<body>
            <?php
        
            include "$path/menu.php";
            
			
			
			$submit = $_POST ['submit'];
                if (isset($submit))
                    {
						unset($_SESSION['parameter_sql']);
						
						$data['kd_idaset']= $_POST['kd_idaset'];
						$data['kd_namaaset'] = $_POST['kd_namaaset'];
						$data['kd_nokontrak'] = $_POST['kd_nokontrak'];
						$data['kd_tahun'] = $_POST['kd_tahun'];
						$data['satker'] = $_POST['skpd_id'];
						$data['ngo'] = $_POST['ngo_id'];
						$data['paging'] = $_GET['pid'];
						$data['sql_where'] = TRUE;
						$data['sql'] = " StatusValidasi = 0";
						$data['modul'] = "pengadaan";
						
						
						$dataTotal = $HELPER_FILTER->filter_module($data);
						
						if($kd_idaset=="" && $kd_namaaset=="" && $kd_nokontrak=="" && $kd_tahun=="" && $kelompok=="" && $lokasi=="" && $satker=="" && $ngo==""){
							?>
							<script>var r=confirm('Tidak ada isian filter');
							if (r==false)
							{
									document.location="<?php echo "$url_rewrite/module/koreksi/";?>koreksi_data_aset.php";
							}
							</script>
						<?php
						}
                    }
                    
                    ?>
<!--tambah ini--> 
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
<!--tambah ini-->		           
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Validasi Barang Pengadaan</div>
<div id="bottomright">

<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left">Filter data : <u>Tidak ada filter (View seluruh data)</u></th>
    </tr>
</table>
<br>
<div align="right">
<input type="button"
            value="Kembali ke halaman utama : Cari Aset"
            onclick="document.location='validasi.php'"
            title="Kembali ke halaman utama : Cari Aset">
<input type="button"
            value="Cetak daftar aset (PDF)"
            onclick=""
            title="Cetak daftar aset (PDF)"><br>
<input type="button"
            value="Daftar Validasi Barang"
            onclick="document.location='daftar_validasi_barang.php'"
            title="Daftar Validasi Barang"><br>
Jumlah Data yang ditemukan : <?php echo $_SESSION['parameter_sql_total']?> Record
<div>
<?php
//$offset = @$_POST['record'];
?>
	<!--<form method="post" action="">Tampilkan data :
	<select name="record">
		<option value="10" <?php //if ($offset == 10) echo 'selected'?>>10</option>
		<option value="100" <?php //if ($offset == 100) echo 'selected'?>>100</option>
		<option value="200" <?php //if ($offset == 200) echo 'selected'?>>200</option>
		<option value="300" <?php //if ($offset == 300) echo 'selected'?>>300</option>
		<option value="300" <?php //if ($offset == 400) echo 'selected'?>>400</option>
		<option value="300" <?php //if ($offset == 500) echo 'selected'?>>500</option>
		<option value="300" <?php //if ($offset == 600) echo 'selected'?>>600</option>
		<option value="300" <?php //if ($offset == 700) echo 'selected'?>>700</option>
		<option value="300" <?php //if ($offset == 800) echo 'selected'?>>800</option>
		<option value="300" <?php //if ($offset == 900) echo 'selected'?>>900</option>
		
	</select> <input type="submit" value="Tampilkan" name="search">
	</form>
</div>
</div>
<div>
    <br>
</div>-->


<!-- Begin frame -->
<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    
    <tr>
        
        <td colspan ="3" align="right">
                <table border="0" width="100%">
                        <tr>
                                <td width="130px"><span><a href="#" onclick="" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
                                <td  align=left><a href="#" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
                                <td align="right">
                                        <span><input type="button" value="Hapus data" onclick="window.location.href='validasi_data_aset.php?param=delete'"></span>
                                        <span><input type="button" value="Validasi data" onclick="window.location.href='validasi_data_aset.php?param=validasi'"></span>
                                </td>
                                <td align="right" width="100px">
                                        <span><input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                        <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'"></span>
                                </td>
                        </tr>
                </table>
        </td>
    </tr>
</table>
<div style="overflow: scroll; height: 1000px;">
<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    <!--
    <tr>
        
        <td colspan ="3" align="right">
                <table border="0" width="100%">
                        <tr>
                                <td width="130px"><span><a href="#" onclick="" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
                                <td  align=left><a href="#" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
                                <td align="right">
                                        <span><input type="button" value="Hapus yang dipilih" onclick=""></span>
                                        <span><input type="button" value="Validasi yang dipilih" onclick=""></span>
                                </td>
                                <td align="right" width="100px">
                                        <span><input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                        <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'"></span>
                                </td>
                        </tr>
                </table>
                
                
            
        </td>
    </tr>-->
    <tr>
        <td width='5%' style="background-color: #eeeeee; border: 2px solid #dddddd;"></td>
        <td colspan='3' style="background-color: #eeeeee; border: 2px solid #dddddd;font-weight:bold;"> Informasi Aset</td>
    </tr>
    
    <?php
		
		$param = $_SESSION['parameter_sql'];
		print_r($param);
		
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC limit 0, $offset";
			//print_r($query);
		}else{
			$paging = paging($_GET['pid']);
		
			$query="$param ORDER BY Aset_ID ASC limit $paging, 10";
			echo"<pre>";
			print_r($query);
			echo"</pre>";
		}
		
		
		// if ($param !='WHERE')
        // {
			// echo 'dadaada';
			// $query="SELECT Aset_ID FROM Aset $param AND StatusValidasi=0 ORDER BY Aset_ID ASC limit $paging, 10";
			// $validasi_button_disable = '';
        
		// }else{
		
			// echo 'ada';
			// $query="SELECT Aset_ID FROM Aset $param StatusValidasi=0 ORDER BY Aset_ID ASC limit $paging, 10";
			// if ($_GET['pid']==0){
				// echo '<script type=text/javascript>alert("kembali ke validasi barang"); window.location.href="?pid=1";</script>';
			// }
			
        // }
		
		//pr($query);
        $res = mysql_query($query) or die(mysql_error());
		if ($result){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_object($res))
			{
				
				$dataArray[] = $data;
			}
		}
		
		
		if($dataArray!=""){
			foreach ($dataArray as $Aset_ID){
				$query2="SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
								a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
								d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
								FROM Aset AS a 
								LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
								LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
								LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
								LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
								LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
								LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
								WHERE a.Aset_ID = $Aset_ID->Aset_ID
								ORDER BY a.Aset_ID asc ";
				// pr($query2);
				$exec=mysql_query($query2) or die(mysql_error());
				$row[] = mysql_fetch_object($exec);       
			}
		}
        
        ?>

    
    <?php
    
    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi'";
        $result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
        $data_apl = $DBVAR->fetch_object($result_apl);
        
        $array = explode(',',$data_apl->aset_list);
        
	foreach ($array as $id)
	{
	    if ($id !='')
	    {
		$dataAsetList[] = $id;
	    }
	}
	
	if ($dataAsetList !='')
	{
	    $explode = array_unique($dataAsetList);
	}
	
	//print_r($explode);
        
        
    if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
    if (!empty($row))
    {
        $disabled = '';
    
    foreach ($row as $key => $value)
    {
        //echo $value->Aset_ID;
    
    ?>
    <tr>
        <td align="center" style="border: 2px solid #dddddd;"><?php echo $no?></td>
        <td width="10px" align="center">
                <input type="checkbox" id="checkbox" class="checkbox" name="validasi" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
        </td>
        <td style="border: 2px solid #dddddd;">

                <table width='100%'>
                    <tr>
                        <td height="10px"></td>
                    </tr>

                    <tr>
                        <td>
                            <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
                            <span>( Aset ID - System Number )</span>
                        </td>
                        <!--
                        <td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
                            
                             <a href='validasi_data_aset.php?id=<?php //echo $value->Aset_ID?>'>Validasi</a></span>
                        </td>-->
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NomorReg?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->Kode?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
                    </tr>

                </table>

                <br>
                <hr />
                <table>
                    <tr>
                        <td width="30%"> No.Kontrak</td> <td><?php echo $value->NoKontrak?></td>
                    </tr>
                    <tr>
                        <td>Satker</td> <td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td> <td><?php echo $value->NamaLokasi?></td>
                    </tr>
                    <tr>
                        <td>Status</td> <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
                    </tr>

                </table>
         </td>
    </tr>
    <?php
        $no++;
    }
    }
    else
    {
        $disabled = 'disabled';
    }
    ?>
    <tr>
        <td width='5%' style="background-color: #eeeeee; border: 2px solid #dddddd;"></td>
        <td colspan='3' style="background-color: #eeeeee; border: 2px solid #dddddd;font-weight:bold;">&nbspInformasi Aset</td>
        
    </tr>
    <tr>
        <td colspan ="3" align="right">
            <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
            <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
        </td>
    </tr>
</table>


</div>
<!-- End Frame -->

</div>
</div>
</div>
</div>
        <script>
                   $('.checkbox').click(function()
                   {
                       
                        var check = $(this).attr('checked');
                        var modParam = $(this).attr('name');
                        var value = $(this).val();
                        
			//alert(check);
                        if ((check == 'checked') || (check == true))
                            {
                                $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                //document.getElementById('katalogButton').disabled=true;
                                })

                            }
                            else
                                {
                                    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                })
                                }
                        
                   });
                   
                   
		   $(function(){
			
			function updateCheckbox() {         
			var allVals = '';
			var i = 1;
			
			$('.checkbox:checked').each(function() {
			  
			  if (i == 1)
			  {
			    
			    allVals+=$(this).val();  
			  }
			  else
			  {
			    allVals+=","+$(this).val();
			  }
			  
			  i++;
			});
			$('#t').val(allVals)
			return allVals;
		    }
		    
		    function updateCheckboxEmpty() {         
			var allVals = '';
			var i = 1;
			
			$('.checkbox:checked').each(function() {
			  
			  if (i == 1)
			  {
			    
			    allVals+=$(this).val();  
			  }
			  else
			  {
			    allVals+=","+$(this).val();
			  }
			  
			  i++;
			});
			$('#t').val(allVals)
			return allVals;
		    }

			// add multiple select / deselect functionality
			$("#pilihHalamanIni").click(function () {
			    //alert('ada');
			    $('.checkbox').attr('checked', '1');
			    var panjang=$(".checkbox:checked").length;
			    //var cek = $('.checkbox:checked').val();
			    var value =updateCheckbox();
			    var modParam = 'validasi';
			    
			    
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
                                window.location.href='?pid=<?php echo $_GET['pid']?>';
                                })
			});
			$("#kosongkanHalamanIni").click(function () {
			    //alert('ada');
			   // $('.checkbox').removeAttr('checked', '1');
			    var panjang=$(".checkbox:checked").length;
			    var value =updateCheckboxEmpty();
			    var modParam = 'validasi';
			    
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                window.location.href='?pid=<?php echo $_GET['pid']?>';
                                })
			});
		     
			// if all checkbox are selected, check the selectall checkbox
			// and viceversa
			$(".checkbox").click(function(){
		     
			    if($(".checkbox").length == $(".checkbox:checked").length) {
				
				$("#pilihHalamanIni").attr("checked", "checked");
			    } else {
				//    $("#pilihHalamanIni").attr("checked", "checked");
				$("#pilihHalamanIni").removeAttr("checked");
			    }
		     
			});
		    });
		   
		   
                   $('#bersihkanHalamanIni').click(function()
                   {
                       var modParam = $(this).attr('name');
                       //alert(modParam);
                       $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:'', parameter:'clear', mod:modParam}, function(data)
                            
                        {
                            //alert(data);
                            window.location.href='?pid=<?php echo $_GET['pid']?>';
                        });   
                   });
                   
               </script>

	<?php
        include "$path/footer.php";
        ?>
	</body>
</html>	
