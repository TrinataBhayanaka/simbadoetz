    <?php
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        $no_penetapan=$_POST['peman_valid_filt_nopenet'];
        $tgl_penetapan=$_POST['peman_valid_filt_tglpenet'];
        $tgl_fix=format_tanggal_db2($tgl_penetapan);
        $tipe_pemanfaatan=$_POST['peman_valid_filt_tipe'];
        $alasan=$_POST['peman_valid_filt_alasan'];
        $submit=$_POST['tampil_valid_filter'];
        
        //open_connection();
        
        if ($no_penetapan!=""){
            $query_no_penetapan="NoSKKDH LIKE '%$no_penetapan%'";
            }
            if($tgl_penetapan!=""){
            $query_tgl_penetapan="TglSKKDH LIKE '%$tgl_fix%'";
            }
            if($tipe_pemanfaatan!=""){
            $query_tipe_pemanfaatan="TipePemanfaatan LIKE '%$tipe_pemanfaatan%'";
            }
            if($alasan!=""){
            $query_alasan="Keterangan LIKE '%$alasan%'";
            }

            $parameter_sql="";
            if($no_penetapan!=""){
            $parameter_sql=$query_no_penetapan;
            }
            if($tgl_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_penetapan;
            }
            if($tgl_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_penetapan;
            }
            if($tipe_pemanfaatan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tipe_pemanfaatan;
            }
            if($tgl_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_tipe_pemanfaatan;
            }
            if($alasan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_alasan;
            }
            if ($alasan!="" && $parameter_sql==""){
            $parameter_sql=$query_alasan;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
            
            //echo "$parameter_sql";
            
            $_SESSION['parameter_sql'] = $parameter_sql;
            
            
            $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemanfaatan' AND UserSes = '$_SESSION[ses_uid]'";
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
                if ($no_penetapan=="" && $tgl_penetapan=="" && $tipe_pemanfaatan=="" && $alasan==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php";
                            }
                    </script>
    <?php
            }
        }
    ?>

<html>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Validasi data ?");
		if (r==true)
		  {
		  alert("Data sudah tervalidasi");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar.php";
		  }
		}
	</script>
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
                                Validasi Pemanfaatan
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php"><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="#"><input type="submit" value="Cetak Daftar Aset (PDF)"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_valid.php"><input type="submit" value="Daftar Barang"></a>
                                </div>
                                
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_proses.php">
                                <table  width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
                                    <tbody>
                                        <tr>
                                            <td colspan=5><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                                        &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
                                                                        <p style="float:right;"><input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/></p>
                                            </td>
                                        </tr>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="50px" align="center" style="border: 1px solid #004933;">Pilihan</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Nomor SKKDH</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Tanggal SKKDH</th>
                                            <th width="80px" align="center" style="border: 1px solid #004933;">Keterangan</th>
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
                                        
                                        $query="SELECT Pemanfaatan_ID FROM Pemanfaatan $_SESSION[parameter_sql]  FixPemanfaatan=1 AND Status=0 ORDER BY Aset_ID ASC limit $offset, $jmlperhalaman";
                                        $query_total_record="SELECT COUNT(*) FROM Pemanfaatan $_SESSION[parameter_sql]  FixPemanfaatan=1 AND Status=0";
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
                                            foreach ($dataArray as $pemanfaatan_id)
                                                {
                                                    $query2="SELECT * FROM Pemanfaatan
                                                                    WHERE  Pemanfaatan_ID = $pemanfaatan_id->Pemanfaatan_ID
                                                                    ORDER BY Pemanfaatan_ID asc ";
                                                    //print_r($query);                
                                                    $exec=$DBVAR->query($query2) or die(mysql_error());
                                                    $row[] = $DBVAR->fetch_object($exec);       
                                                }
                                            }
                                        
                                           
                                            
                                               if($row!=""){ 
                                       foreach ($row as $value){
                                            ?>
                                        <tr>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;"><?php echo "$i";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                                                <input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPemanfaatan" value="<?php echo $value->Pemanfaatan_ID;?>" <?php for ($j = 0; $j <= count($explode); $j++){if ($explode[$j]==$value->Pemanfaatan_ID) echo 'checked';}?>/>
                                            </td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$value->NoSKKDH";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$value->TglSKKDH; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$value->Keterangan";?></td>
                                        </tr>
                                        </tr>
                                                <?php $i++; }} ?>
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
			    var modParam = 'ValidasiPemanfaatan';
			    
			    
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
			    var modParam = 'ValidasiPemanfaatan';
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



