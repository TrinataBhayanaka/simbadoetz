<?php
ob_start();

include "../../config/config.php";
include "$path/header.php";
include "$path/title.php";

include "$path/menu.php";

$menu_id = 38;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
            
            
            $bup_idaset = $_POST['bup_idaset'];
            $bup_namaaset = $_POST['bup_namaaset'];
            $bup_nokontrak = $_POST['bup_nokontrak'];
            $bup_tahun = $_POST['bup_tahun'];
            $kelompok = $_POST['kelompok_id'];
            $lokasi = $_POST['lokasi_id'];
            $satker = $_POST['skpd_id'];
            $ngo = $_POST['ngo_id'];
            $submit = $_POST['tampil'];
            
            
            
            $paging = $LOAD_DATA->paging($_GET['pid']);    
            
                    if (isset($submit))
                                        {
                                                    unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                                    $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
                                                    $data = $RETRIEVE->retrieve_usulan_penghapusan($parameter);
                                        }

                    $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
                    $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
                    $data = $RETRIEVE->retrieve_usulan_penghapusan($parameter);

                    echo '<pre>';
                    //print_r($data);
                    echo '</pre>';
                    
                    
            
            
                if(isset($submit)){
                    if($bup_idaset=="" && $bup_namaaset=="" && $bup_nokontrak=="" && $bup_tahun=="" && $kelompok=="" && $lokasi=="" && $satker=="" && $ngo==""){
                        echo "<script>var r=confirm('Tidak Ada Isian Filter'); 
                                    if(r==false){
                                        document.location='$url_rewrite/module/penghapusan/daftar_usulan_penghapusan_filter.php';
                                    }</script>";
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

    <div id="tengah1">	
    <div id="frame_tengah1">
    <div id="frame_gudang">
    <div id="topright">Buat Usulan Penghapusan</div>
    <div id="bottomright">
        
    <table width="100%">
        <tr>
            <td align="right">
        <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_usulan_daftar_usulan.php?pid=1"><input type="submit" value="Daftar Barang"></a>
            </td>
        </tr>
    </table>
         <form method="POST" action="<?php echo"$url_rewrite"?>/module/penghapusan/daftar_usulan_penghapusan_usul.php">   
        <div>
        <table border=0 width=100%>
            
        <tr>
                <td width=50%></td>
                <td colspan="2" width=25% align=right>
                        <input type="button" name="aset_act_btn" value="Kembali ke halaman utama: Cari Aset" onclick="window.location='<?php echo "$url_rewrite";?>/module/penghapusan/daftar_usulan_penghapusan_filter.php';"></td>

        </tr>
        </table>
        
            <table border=0 width=100%>

        <tr>		
                <td width=60%></td>
                <td width=25% align=right>
                <?php
                    $param=  urlencode($data['parameter']);
                    //echo "$param";
                ?>
                <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/tes_class_usulan_penghapusan_cetak_seluruh.php?menu_id=38&mode=1&parameter=$param";?>" target="_blank"><input type="button" value="Cetak seluruh data" /></a>
                <td width=25% align=right>
                <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/"?>tes_class_usulan_penghapusan_dengan_pilihan.php?menu_id=38&mode=2" target="_blank"><input type="button" value="Cetak dari daftar data" /></a>
                </td>
                
        </tr>
        </table>
</div>         
        <table border="0" width=100%>
            <td colspan ="2" align="right">
                <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
            </td>
        </table>
             
        
        <div>  
        <table border="0" width=100%>
         
            <tr>
                <td width=13% align=left>Pilihan:</td>
        </tr>
        <tr>
                <td colspan=3><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''"  id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
                                            <?php
                                                    $cek=$data['asetList'];
                                                ?>
                                            <p style="float:right;"><input type="submit" name="submit2" value="Usulan Penghapusan" id="submit" disabled/></p></td>
        </tr>
        </table>          


            </div>
        
            <div> 
                <table border="0" width=100%>
        <td colspan ="2" align="right">
            
        </td>
        
        </table> 
           
    <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
        <tr style="background-color:#004933; color:white; height:20px;">
            <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
            <th width="50px" align="center" style="border: 1px solid #004933;">Pilihan</th>
            <th width="500px" align="left" style="border: 1px solid #004933;">&nbsp;Informasi Aset</th>
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
            <input type="checkbox" class="checkbox" onchange="enable()" name="UsulanPenghapusan" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>/>
         </td>
        <td align="left" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                <table width='100%'>
                    <tr>
                        <td height="10px"></td>
                    </tr>

                    <tr>
                        <td>
                            <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo $value->Aset_ID?></span>
                            <span>( Aset ID - System Number )</span>
                        </td>
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
                        <td> No.Kontrak</td>
                        <td>&nbsp; :</td>
                        <td><?php echo $value->NoKontrak?></td>
                    </tr>
                    <tr>
                        <td>Satker</td>
                        <td>&nbsp; :</td>
                        <td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>&nbsp; :</td>
                        <td><?php echo $value->NamaLokasi?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>&nbsp; :</td>
                        <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
                    </tr>

                </table>
         </td>
    </tr>
<?php
        $no++; $pid++; }}
        //$pid++;
    /*
    }
    else
    {
        $disabled = 'disabled';
        echo '<tr><td align=center colspan=5>Tidak ada data</td></tr>';
    }*/
    ?>   
            
                </table>
       
        </table>
                
                
                                                                        </div>
                                                                <div>
                                                      
        <table border="0" width=100%>
        
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
                                                                                                                </div>
</form>
                                </div>
                        </div>
                </div>
        </div>
                  
                </td>
        </tr>
        </table>           
      
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
			    var modParam = 'UsulanPenghapusan';
			    
			    
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
			    var modParam = 'UsulanPenghapusan';
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
                include "$path/footer.php";
                ?>
	</body>
</html>	
