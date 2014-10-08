    <?php
        include "../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
        
        $nm_aset=$_POST['peman_pengem_filt_add_nmaset'];
        $no_kontrak=$_POST['peman_pengem_filt_add_nokontrak'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil_filter_add'];
        
        //open_connection();
        
        if ($nm_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a LEFT JOIN PemanfaatanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
                $exec_query_nama_aset=mysql_query($query_nama_aset) or die(mysql_error());
                if(mysql_num_rows($exec_query_nama_aset))
                {
                    while($row=mysql_fetch_array($exec_query_nama_aset))
                    {
                        $dataRow[]=$row['Aset_ID'];
                    }
                    $implode=  implode(',',$dataRow);
                }
                if($implode!=""){
            $query_nama="Aset_ID IN ($implode)";
                }else{
                    $query_nama = "Aset_ID IN (NULL)";
                }
                $query_alias_nama_aset="A.NamaAset LIKE '%$nm_aset%'";
            
            //$query_nama="a.NamaAset LIKE '%$nm_aset%'";
            }
            
            if($no_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = mysql_query($query_ka_no_kontrak) or die (mysql_error());
                if (mysql_num_rows($result))
                { 
                    while ($data = mysql_fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                    if($dataImplode){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                    }else{
                        $query_no_kontrak ="Aset_ID IN (NULL)";
                    }
                    $query_alias_no_kontrak="KTR.NoKontrak LIKE '%$no_kontrak%'";  
            //$query_no_kontrak="c.NoKontrak LIKE '%$no_kontrak%'";
            }
            
            if($satker!=""){
                    $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                WHERE $query_satker";
        //print_r($query_change_satker);
        $exec_query_change_satker=  mysql_query($query_change_satker) or die(mysql_error());
        while($proses_kode=mysql_fetch_array($exec_query_change_satker)){
                //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=mysql_query($query_return_kode) or die(mysql_error());
                while($proses_kode2=mysql_fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT Aset_ID FROM Aset 
                                                WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  mysql_query($query_change_satker_fix) or die(mysql_error());
                if(mysql_num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=mysql_fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Aset_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Aset_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Aset_ID IN (NULL)";
                }
                $query_alias_satker="PMNFA.Aset_ID IN ($gabung)";
            }

            $parameter_sql="";
            $parameter_sql_report="";
            
            if($nm_aset!=""){
            $parameter_sql=$query_nama;
            $parameter_sql_report=$query_alias_nama_aset;
            }
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            $parameter_sql_report=$query_alias_no_kontrak;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            $parameter_sql_report=$query_alias_satker;
            }
            
                if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
               
               if($parameter_sql_report!="" ) {
		$parameter_sql_report="WHERE ".$parameter_sql_report." AND ";
               }
               else
               {
                   $parameter_sql_report = " WHERE ";
               }
            
            //echo "$parameter_sql";
            
            $_SESSION['parameter_sql'] = $parameter_sql;
            $_SESSION['parameter_sql_report'] = $parameter_sql_report;
            
            
            $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PengembalianPemanfaatan' AND UserSes = '$_SESSION[ses_uid]'";
            //print_r($query_apl);
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
            if($dataAsetList!=''){
            $explode = array_unique($dataAsetList);
                }
                                                
        
        if (isset($submit)){
                if ($nm_aset=="" && $no_kontrak=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter2.php";
                            }
                    </script>
    <?php
            }
        }
    ?>

<html>
    <?php
        
    ?>
        <body onload="enable()">
                        <script language="Javascript" type="text/javascript">  
                            function enable(){  
                            var tes=document.getElementsByTagName('*');
                            var button=document.getElementById('submit');
                            var boxeschecked=0;
                            for(k=0;k<tes.length;k++)
                            {
                                if(tes[k].className=='checkbox')
                                    {
                                        //
                                        tes[k].checked == true  ? boxeschecked++: null;
                                    }
                            }
                            //alert(boxeschecked);
                            if(boxeschecked!=0)
                                button.disabled=false;
                            else
                                button.disabled=true;
                            }
                        </script>
            <div id="content">
                <?php
                    //include "$path/title.php";
                    include "$path/menu.php";
                ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Pengembalian Pemanfaatan	
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_filter2.php"><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <?php
                                    $param=  urlencode($_SESSION['parameter_sql_report']);
                                    //echo "$param";
                                ?>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/tes_class_pengembalian_pemanfaatan_cetak_seluruh.php?menu_id=36&mode=1&parameter=$param";?>" target="_blank"><input type="submit" value="Cetak Daftar Aset (PDF)"></a>
                                </div>
                                
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_pengembalian_eksekusi_data.php">
                                <table  width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
                                    <tbody>
                                        <tr>
                                            <td colspan=6><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                                        &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
                                                                        <p style="float:right;"><input type="submit" name="submit" value="Lanjutkan" id="submit" disabled/></p>
                                            </td>
                                        </tr>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="50px" align="center" style="border: 1px solid #004933;">Pilihan</th>
                                            <th width="500px" align="left" style="border: 1px solid #004933;">&nbsp;Informasi Aset</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">No SKKDH Pemanfaatan</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Tgl Sekarang</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Tgl Habis Pemanfaatan</th>
                                        </tr>
                                        <?php
                                            
                                                $hal = $_GET[hal];
                                                if(!isset($_GET['hal'])){ 
                                                    $page = 1; 
                                                } else { 
                                                    $page = $_GET['hal']; 
                                                }
                                                $jmlperhalaman = 10;  // jumlah record per halaman
                                                $offset = (($page * $jmlperhalaman) - $jmlperhalaman);
                                                $i=$page + ($page - 1) * ($jmlperhalaman - 1);  
                                                
                                                $query="SELECT Aset_ID FROM PemanfaatanAset $_SESSION[parameter_sql]  Status=1 AND StatusPengembalian=0 ORDER BY Aset_ID asc limit $offset, $jmlperhalaman";
                                                $query_total_record="SELECT COUNT(*) FROM PemanfaatanAset $_SESSION[parameter_sql]  Status=1 AND StatusPengembalian=0";
                                                //print_r($query_total_record);
                                                $result = $DBVAR->query($query) or die($DBVAR->error());
                                                $total_record = mysql_result($DBVAR->query($query_total_record),0);
                                               //print_r($total_record);
                                                $rows = $DBVAR->num_rows($result);


                                                while ($data = $DBVAR->fetch_object($result))
                                                {
                                                    //if ($data->Aset_ID == $dataArrayAset->Aset_ID) ?
                                                    $dataArray[] = $data;
                                                }
        
                                                echo '<pre>';
                                                 //print_r($dataArray);
                                                 echo '</pre>';
                                                 if($dataArray!=""){
                                                 foreach ($dataArray as $Aset_ID)
                                                {
                                                    $query2="SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                                                    c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.NoSKKDH, g.TglSelesai, h.Kode
                                                                    FROM PemanfaatanAset AS b
                                                                    LEFT JOIN Pemanfaatan AS g ON b.Pemanfaatan_ID=g.Pemanfaatan_ID
                                                                    LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                                                    LEFT JOIN KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                                                    LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                                                    LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                                    LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                                    LEFT JOIN Kelompok AS h ON a.Kelompok_ID=h.Kelompok_ID
                                                                    WHERE  b.Aset_ID = $Aset_ID->Aset_ID
                                                                    ORDER BY b.Aset_ID asc ";
                                                    //print_r($query);                
                                                    $exec=$DBVAR->query($query2) or die(mysql_error());
                                                    $row[] = $DBVAR->fetch_object($exec);       
                                                    }
                                                 }
                                                
                                               
                                                
                                                
                                                
                                                if($row!=""){
                                            foreach ($row as $value){
                                    ?>
                                        <tr>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;"><?php echo "$i.";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                                                 <input type="checkbox" class="checkbox" onchange="enable()" name="PengembalianPemanfaatan" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($explode); $j++){if ($explode[$j]==$value->Aset_ID) echo 'checked';}?>/>
                                            </td>
                                            <td align="left" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                                                <table width="100%">
                                                    <tr>
                                                        <td><?php echo "$value->Aset_ID";?> ( Aset ID - System NUmber )<td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo "$value->NomorReg";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo "$value->Kode";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo "$value->NamaAset";?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><hr></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td rowspan=4 style="border:1px solid grey; border-width:1px 1px 1px 1px;">...</td>
                                                                    <td>No. Kontrak</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>:  </td>
                                                                    <td><?php echo "$value->NoKontrak";?></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Satker</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>:  </td>
                                                                    <td><?php echo "$value->NamaSatker";?></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Lokasi</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>:  </td>
                                                                    <td><?php echo "$value->NamaLokasi";?></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Status</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>&nbsp;</td>
                                                                    <td>:  </td>
                                                                    <td>---</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: red; font-weight: bold;"><?php echo "$value->NoSKKDH";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: red; font-weight: bold;"><?php $date=date('d/m/Y'); echo "$date";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: red; font-weight: bold;"><?php $change2=$value->TglSelesai; $change3=format_tanggal_db3($change2); echo "$change3";?></td>
                                        </tr>
                                        <?php $i++; } }?>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Pilihan</th>
                                            <th width="300px" align="left" style="border: 1px solid #004933;">&nbsp;Informasi Aset</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">No SKKDH Pemanfaatan</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Tgl Sekarang</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Tgl Habis Pemanfaatan</th>
                                        </tr>
                                    </tbody>
                                </table>
                                    &nbsp;
                                    <?php
                                        $total_halaman = ceil($total_record / $jmlperhalaman);
                                        echo "<center><b style='color:#004933;'>Halaman :</b><br />";
                                    ?>
                                        <div class="paging">
                                    <?php
                                        $perhal=5;
                                        if($hal > 1){ 
                                            $prev = ($page - 1); 
                                            echo "<a href=$_SERVER[PHP_SELF]?hal=1 class='preevnext'> << First </a>  <a href=$_SERVER[PHP_SELF]?hal=$prev class='preevnext'> < Previous </a> "; 
                                            echo "<span class='disabled'>...</span>";
                                        }
                                        if($total_halaman<=10){
                                        $hal1=1;
                                        $hal2=$total_halaman;
                                        }else{
                                        $hal1=$hal-$perhal;
                                        $hal2=$hal+$perhal;
                                        }
                                        if($hal<=5){
                                        $hal1=1;
                                        }
                                        if($hal<$total_halaman){
                                        $hal2=$hal+$perhal;
                                        }else{
                                        $hal2=$hal;
                                        }
                                        for($i = $hal1; $i <= $hal2; $i++){ 
                                            if(($hal) == $i){ 
                                                echo "<span class='current'>$i</span>"; 
                                                } else { 
                                            if($i<=$total_halaman){
                                                    echo "<a href=$_SERVER[PHP_SELF]?hal=$i>$i</a> "; 
                                            }
                                            } 
                                        }
                                        if($hal < $total_halaman){
                                            echo "<span class='disabled'>...</span>";
                                            $next = ($page + 1); 
                                            echo "<a href=$_SERVER[PHP_SELF]?hal=$next class='prevnext'> Next > </a>  <a href=$_SERVER[PHP_SELF]?hal=$total_halaman class='prevnext'> Last >> </a>"; 
                                        } 
                                        ?>
                                        </div>
                                        <?php
                                        echo "</center>"; 
                                        ?>
                                </form>    
                                    
                            </div>
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
                        
			//alert(value);
                        if ((check == true) || (check == 'checked'))
                            {
                                $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                //window.location.href='?hal=<?php echo $page;?>';
                                })

                            }
                            else
                                {
                                    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                //window.location.href='?hal=<?php echo $page;?>';
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
			    var modParam = 'PengembalianPemanfaatan';
			    
			    
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
                                window.location.href='?hal=<?php echo $page;?>';
                                })
			});
			$("#kosongkanHalamanIni").click(function () {
			    //alert('ada');
			   // $('.checkbox').removeAttr('checked', '1');
			    var panjang=$(".checkbox:checked").length;
			    var value =updateCheckboxEmpty();
			    var modParam = 'PengembalianPemanfaatan';
			    //alert(value);
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
                                window.location.href='?hal=<?php echo $page;?>';
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
                            window.location.href='?hal=<?php echo $_GET['hal']?>';
                        });   
                   });
                   
               </script>
            
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	



