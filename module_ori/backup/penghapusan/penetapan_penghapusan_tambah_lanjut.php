<?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
    
        $menu_id = 39;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $nama_aset=$_POST['bup_pp_sp_namaaset'];
        $no_kontrak=$_POST['bup_pp_sp_nokontrak'];
        $usulan=$_POST['bup_pp_sp_nousulan'];
        $satker=$_POST['skpd_id'];
        $aset_id=$_POST['bup_pp_sp_asetid'];
        $submit=$_POST['tampilhapus'];
        
        
        $paging = $LOAD_DATA->paging($_GET['pid']);    
            
        if (isset($submit))
        {
            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
            $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
            $data = $RETRIEVE->retrieve_penetapan_penghapusan_filter($parameter);
        }

        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
        $data = $RETRIEVE->retrieve_penetapan_penghapusan_filter($parameter);

        echo '<pre>';
        //print_r($data);
        echo '</pre>';
        
        
               if (isset($submit)){
            if ($nama_aset=="" && $no_kontrak=="" && $satker=="" && $usulan=="" && $aset_id==""){
    ?>
        <script>var r=confirm('Tidak ada isian filter');
            if (r==false){
            document.location='penetapan_penghapusan_tambah_aset.php';
            }
        </script>
     <?php
            }
        }
    
        
?>
<html>
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
                                                        <table width="100%" height="4%" border="1" style="border-collapse:collapse;">
                                                            <tr>
                                                                    <th colspan="2" align="left">Filter data : <u>Tidak ada filter (View seluruh data)</u></th>
                                                            </tr>
                                                        </table><br>
                                                            <div align="right">
                                                                <?php
                                                                $param=  urlencode($data['parameter']);
                                                                //echo "$param";
                                                                ?>
                                                                    <input type="button" name="aset_act_btn"value="Kembali ke halaman utama: Cari Aset" onclick="window.location='penetapan_penghapusan_tambah_aset.php'">
                                                                    <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/tes_class_penetapan_penghapusan_cetak_seluruh.php?menu_id=39&mode=1&parameter=$param";?>" target="_blank"><input type="button" value="Cetak daftar aset (PDF)"></a><br>
                                                                    
                                                            </div>
                                                        <table border="0" width=100%>
                                                                <td colspan ="2" align="right">
                                                                    <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                                                    <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                                                                </td>
                                                        </table>
                                                        <form name="myform" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_tambah_data.php">
                                                        
                                                        <table  width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan=3><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                                                                    &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''"  id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
                                                                                                <?php
                                                                                                    $cek=$data['asetList'];
                                                                                                ?>
                                                                                                <p style="float:right;"><input type="submit" name="submit2" value="Lanjutkan" id="submit" disabled/></p></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr style="background-color:#004933; color:white; height:20px;">
                                                                    <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                                                    <th width="100px" align="left" style="border: 1px solid #004933;" colspan="2">&nbsp;Informasi Aset</th>
                                                                    <th></th>
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
                                                                            <input type="checkbox" class="checkbox" onchange="enable()" name="PenetapanPenghapusan" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>/>
                                                                    </td>
                                                                    <td align="left" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
                                                                        <table width="100%">
                                                                            <tr>
                                                                                <td><?php echo $value->Aset_ID; ?> ( Aset ID - System Number )<td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?php  echo $value->NomorReg;?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?php  echo $value->Kode;?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?php echo $value->NamaAset;?></td>
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
                                                                                            <td> &nbsp; &nbsp; : </td>
                                                                                            <td><?php 
                                                                                            /*
                                                                                                            $asetid=$value->'Aset_ID'];
                                                                                                        $query_fix_kontrak_aset1="SELECT * FROM KontrakAset where Aset_ID='$asetid'";
                                                                                                        $exec_fix_kontrak_aset1=mysql_query($query_fix_kontrak_aset1);
                                                                                                        $hsl_data_fix_kontrak_aset1=  mysql_fetch_array($exec_fix_kontrak_aset1);
                                                                                                        $kontrak_id=$hsl_data_fix_kontrak_aset1['Kontrak_ID'];

                                                                                                        $query_fix_kontrak1="SELECT * FROM Kontrak where Kontrak_ID='$kontrak_id'";
                                                                                                        $exec_fix_kontrak1=mysql_query($query_fix_kontrak1);
                                                                                                        $hsl_data_fix_kontrak1=  mysql_fetch_array($exec_fix_kontrak1);
                                                                                                        */
                                                                                            echo $value->NoKontrak;

                                                                                            //echo $hsl_data_fix_kontrak1[NoKontrak];
                                                                                            ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Satker</td>
                                                                                            <td> &nbsp; &nbsp; : </td>
                                                                                            <td><?php
                                                                                                                        /*$satkeraset=$value->'LastSatker_ID'];
                                                                                                                        $query_fix_satker="SELECT * FROM Satker where Satker_ID='$satkeraset'";
                                                                                                                        $exec_fix_satker=mysql_query($query_fix_satker);
                                                                                                                        $hsl_data_fix_satker=  mysql_fetch_array($exec_fix_satker);
                                                                                                                        $id_aset=$hsl_data_fix_satker['NamaSatker'];

                                                                                                                        echo "$id_aset";
                                                                                                                        */
                                                                                                                        echo $value->NamaSatker;
                                                                                                                        ?>                             
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Lokasi</td>
                                                                                            <td> &nbsp; &nbsp; : </td>
                                                                                            <td><?php echo $value->NamaLokasi;?></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Status</td>
                                                                                            <td> &nbsp; &nbsp; : </td>
                                                                                            <td>---</td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <?php $no++; $pid++; } } ?>
                                                                <tr style="background-color:#004933; color:white; height:20px;">
                                                                    <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                                                    <th width="100px" align="left" style="border: 1px solid #004933;" colspan="2">&nbsp;Informasi Aset</th>
                                                                    <th></th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </form>

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
			    var modParam = 'PenetapanPenghapusan';
			    
			    
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
			    var modParam = 'PenetapanPenghapusan';
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
