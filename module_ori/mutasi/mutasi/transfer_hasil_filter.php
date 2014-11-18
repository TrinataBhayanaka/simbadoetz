<?php
    include "../../config/config.php";
    include "$path/header.php";
    include "$path/title.php";
    
    $aset_id=$_POST['mutasi_trans_filt_idaset'];
    $nama_aset=$_POST['mutasi_trans_filt_nmaset'];
    $nomor_kontrak=$_POST['mutasi_trans_filt_nokontrak'];
    $satker=$_POST['skpd_id'];
    $submit=$_POST['transfer'];
    
    //open_connection();
        
            if ($aset_id!=""){
            $query_aset_id="Aset_ID LIKE '%$aset_id%'";
            $query_alias_asetid="PGNA.Aset_ID LIKE '%$aset_id%'";  
            }
            
            if($nama_aset!=""){
              $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a INNER JOIN PenggunaanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nama_aset%'";
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
                $query_alias_nama_aset="A.NamaAset LIKE '%$nama_aset%'";  
            //$query_nama_aset="NamaAset LIKE '%$nama_aset%'";
            }
            
            if($nomor_kontrak){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$nomor_kontrak%'";
               
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
                    $query_alias_no_kontrak="KTR.NoKontrak LIKE '%$nomor_kontrak%'";  
            //$query_nomor_kontrak="NoKontrak LIKE '%$nomor_kontrak%'";
            }
            
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }


                    $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                            WHERE $query_satker";
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  mysql_query($query_change_satker) or die(mysql_error());
                    while($proses_kode=mysql_fetch_array($exec_query_change_satker)){
                        
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
                $query_alias_satker="PGNA.Aset_ID IN ($gabung)";
            }

            $parameter_sql="";
            $parameter_sql_report="";
            
            if($aset_id!=""){
            $parameter_sql=$query_aset_id;
            $parameter_sql_report=$query_alias_asetid;
            }
            if($nama_aset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nama;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_nama_aset;
            }
            if($nama_aset!="" && $parameter_sql==""){
            $parameter_sql=$query_nama;
            $parameter_sql_report=$query_alias_nama_aset;
            }
            if($nomor_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
            }
            if($nomor_kontrak!="" && $parameter_sql==""){
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
               
               $_SESSION['parameter_sql'] = $parameter_sql;
               
               $_SESSION['parameter_sql_report'] = $parameter_sql_report;

            //echo "$parameter_sql";
               
               
               
                                                
               $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Mutasi' AND UserSes = '$_SESSION[ses_uid]'";
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
            if ($aset_id=="" && $nama_aset=="" && $nomor_kontrak=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_antar_skpd.php";
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
                
                include "$path/menu.php";
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Transfer Antar SKPD
                        </div>
                        <div id="bottomright">
                            <div style="margin-bottom:10px; float:right;">
                                <a href="transfer_antar_skpd.php"><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                            </div>
                            <?php
                                $param=  urlencode($_SESSION['parameter_sql_report']);
                                //echo "$param";
                            ?>
                            <div style="margin-bottom:10px; float:right; clear:both;">
                                List Preview : <a href="<?php echo "$url_rewrite/report/template/MUTASI/tes_class_mutasi_transfer_cetak_seluruh.php?menu_id=22&mode=1&parameter=$param";?>" target="_blank"><input type="submit" value="Cetak Seluruh Data"></a>
                                <a href="<?php echo "$url_rewrite/report/template/MUTASI/tes_class_mutasi_transfer_dengan_pilihan.php?menu_id=22&mode=2";?>" target="_blank"><input type="submit" value="Cetak dari Daftar Anda"></a>
                            </div>
                            <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_daftar.php"><input type="submit" value="Daftar Barang Mutasi"></a>
                            </div>
                            
                            <form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_eksekusi.php">
                                <table  cellspacing="0" width="100%" style="padding:5px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
                                    <tbody>
                                        <tr>
                                            <td colspan=3>
                                                <p style="float:left;">
                                                    <u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                                        &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="kosongkanHalamanIni">Kosongkan Halaman Ini</u>
                                                </p>
                                                <p style="float:right;">
                                                    <!--<a href="transfer_eksekusi.php">-->
                                                        <input type="submit" name="submit" value="Pengeluaran Barang" id="submit" disabled/>
                                                    </a>
                                                </p>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="100px" align="left" style="border: 1px solid #004933;" colspan="2">&nbsp;Informasi Aset</th>
                                            <th></th>
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

                                            $query="SELECT Aset_ID FROM PenggunaanAset $_SESSION[parameter_sql]  Status=1 AND StatusMenganggur=0 AND StatusMutasi=0 ORDER BY Aset_ID asc limit $offset, $jmlperhalaman";
                                            $query_total_record="SELECT COUNT(*) FROM PenggunaanAset $_SESSION[parameter_sql]  Status=1 AND StatusMenganggur=0 AND StatusMutasi=0 ORDER BY Aset_ID asc";
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
                                                                c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                                                FROM PenggunaanAset AS b INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                                                INNER JOIN KontrakAset AS d ON b.Aset_ID=d.Aset_ID
                                                                INNER JOIN Kontrak AS c ON d.Kontrak_ID=c.Kontrak_ID
                                                                INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                                INNER JOIN Lokasi AS f ON a.Lokasi_ID=f.Lokasi_ID
                                                                INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
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
                                                <input type="checkbox" class="checkbox" onchange="enable()" name="Mutasi" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($explode); $j++){if ($explode[$j]==$value->Aset_ID) echo 'checked';}?>/>
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
                                                            <table width="50%">
                                                                <tr>
                                                                    <td rowspan=4 style="border:1px solid grey; border-width:1px 1px 1px 1px;">...</td>
                                                                    <td>No. Kontrak</td>
                                                                    <td>&nbsp; :</td>
                                                                    <td><?php echo "$value->NoKontrak";?></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Satker</td>
                                                                    <td>&nbsp; :</td>
                                                                    <td><?php echo "$value->NamaSatker";?></td>
                                                                </tr>
                                                                <tr align="left">
                                                                    <td>Lokasi</td>
                                                                    <td>&nbsp; :</td>
                                                                    <td><?php echo "$value->NamaLokasi";?></td>	
                                                                <tr align="left">				
                                                                    <td>Status</td>
                                                                    <td>&nbsp; :</td>
                                                                    <td>---</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php $i++; } }?>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="100px" align="left" style="border: 1px solid #004933;" colspan="2">&nbsp;Informasi Aset</th>
                                            <th></th>
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
			    var modParam = 'Mutasi';
			    //alert(value);
			    
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
			    var modParam = 'Mutasi';
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
