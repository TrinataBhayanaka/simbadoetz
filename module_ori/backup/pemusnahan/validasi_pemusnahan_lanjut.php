    <?php
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        $menu_id = 48;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $no_penetapan=$_POST['buph_val_noskpemusnahan'];
        $tgl_penetapan_awal=$_POST['buph_val_tgl_awal'];
        $tgl_awal_fix=format_tanggal_db2($tgl_penetapan_awal);
        $tgl_penetapan_akhir=$_POST['buph_val_tgl_akhir'];
        $tgl_akhir_fix=format_tanggal_db2($tgl_penetapan_akhir);
        $lokasi=$_POST['lokasi_id'];
        $submit=$_POST['tampil_filter'];
        
        
        $paging = $LOAD_DATA->paging($_GET['pid']);    
        $ses_uid=$_SESSION['ses_uid'];

        if (isset($submit))
                            {
                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging,'ses_uid'=>$ses_uid);
                                        $data = $RETRIEVE->retrieve_validasi_pemusnahan($parameter);
                            }

        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging,'ses_uid'=>$ses_uid);
        $data = $RETRIEVE->retrieve_validasi_pemusnahan($parameter);

        echo '<pre>';
        //print_r($data);
        echo '</pre>';
        
        
         
        
        if (isset($submit)){
                if ($no_penetapan=="" && $tgl_penetapan_awal=="" && $tgl_penetapan_akhir=="" && $lokasi==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_filter.php";
                            }
                    </script>
    <?php
            }
        }
    ?>

<html>
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
                                Validasi Pemusnahan
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_filter.php"><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>pemusnahan_validasi_daftar_valid.php?pid=1"><input type="submit" value="Daftar Barang"></a>
                                </div>
                                
                                <table border="0" width=100%>
                                <td colspan ="2" align="right">
                                    <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                    <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                                </td>
                                </table>
                                
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemusnahan/"; ?>validasi_pemusnahan_proses.php">
                                <table  width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
                                    <tbody>
                                        <tr>
                                            <td colspan=5><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                                        &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
                                                                        <?php
                                                                            $cek=$data['asetList'];
                                                                        ?>
                                                                        <p style="float:right;"><input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/></p>
                                            </td>
                                        </tr>
                                        <tr style="background-color:#004933; color:white; height:20px;">
                                            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                            <th width="50px" align="center" style="border: 1px solid #004933;">Pilihan</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Nomor BA Pemusnahan</th>
                                            <th width="100px" align="center" style="border: 1px solid #004933;">Tanggal BA Pemusnahan</th>
                                            <th width="80px" align="center" style="border: 1px solid #004933;">Nama Penandatangan</th>
                                        </tr>
                                        
                                            <?php
                                        
                                        
                                            
                                            


                                                    if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
                                                    if (!empty($data['dataArr']))
                                                    {
                                                        $disabled = '';
                                                        $pid = 0;
                                                foreach($data['dataArr'] as $key => $value)
                                                    {    
                                            ?>
                                        <tr>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;"><?php echo "$no.";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                                                <input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPemusnahan" value="<?php echo $value['BAPemusnahan_ID'];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value['BAPemusnahan_ID']) echo 'checked';}?>/>
                                            </td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$value[NoBAPemusnahan]";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php $change=$value['TglBAPemusnahan']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="border: 1px solid #004933; height:100px; color: #cc3333; font-weight: bold;"><?php echo "$value[NamaPenandatangan]";?></td>
                                        </tr>
                                        </tr>
                                                <?php $no++; $pid++; }} ?>
                                    </tbody>
                                </table>
                                    &nbsp;
                                    <?php
                                    /*
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
                                     * 
                                     */
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
                                //window.location.href='?pid=<?php echo $_GET['pid'];?>';
                                })

                            }
                            else
                                {
                                    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                //window.location.href='?pid=<?php echo $_GET['pid'];?>';
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
			    var modParam = 'ValidasiPemusnahan';
			    
			    
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
                                window.location.href='?pid=<?php echo $_GET['pid'];?>';
                                })
			});
			$("#kosongkanHalamanIni").click(function () {
			    //alert('ada');
			   // $('.checkbox').removeAttr('checked', '1');
			    var panjang=$(".checkbox:checked").length;
			    var value =updateCheckboxEmpty();
			    var modParam = 'ValidasiPemusnahan';
			    //alert(value);
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
                                window.location.href='?pid=<?php echo $_GET['pid'];?>';
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
            <?php
                include"$path/footer.php";
            ?>
        </body>
</html>	



