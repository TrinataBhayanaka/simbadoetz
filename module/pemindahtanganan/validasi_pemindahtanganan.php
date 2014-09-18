    <?php
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        $menu_id = 44;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $submit=$_POST['tampil_valid_filter'];
        $no_penetapan=$_POST['bupt_val_noskpemindahtanganan'];
        $tgl_penetapan=$_POST['bupt_val_tglskpemindahtanganan'];
        $satker=$_POST['skpd_id'];
		// pr($_SESSION);
        $paging = $LOAD_DATA->paging($_GET['pid']);    
            
        if (isset($submit))
                            {
                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
                                        $data = $RETRIEVE->retrieve_validasi_pemindahtanganan_filter($parameter);
                            }

        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
        $data = $RETRIEVE->retrieve_validasi_pemindahtanganan_filter($parameter);
		// pr($data);
        echo '<pre>';
        //print_r($data);
        echo '</pre>';	
        
        
        if (isset($submit)){
                if ($no_penetapan=="" && $tgl_penetapan=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite"; ?>/module/pemindahtanganan/validasi_filter_pemindahtanganan.php";
                            }
                    </script>
    <?php
            }
        }
    ?>

<html>
    <?php
        
    ?>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Validasi data ?");
		if (r==true)
		  {
		  alert("Data sudah tervalidasi");
		  document.location="<?php echo "$url_rewrite"; ?>/module/pemindahtanganan/validasi_filter_pemindahtanganan.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite"; ?>/module/pemindahtanganan/validasi_pemindahtanganan.php";
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
			<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": []
				} );
			} );
		</script>
            <div id="content">
                <?php
                   
                    include "$path/menu.php";
                ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Validasi Pemindahtanganan
                            </div>
							<form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan_proses.php">
								
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_filter_pemindahtanganan.php"><input type="button" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan_daftar_valid.php?pid=1"><input type="button" value="Daftar Barang"></a>
                                </div>
                                <table width='100%' border='0' style="border-collapse:collapse;border: 0px solid #dddddd;">
									<tr>
										<td colspan ="3" align="right">
											<table border="0" width="100%">
												<tr>
													<td align="right" width="200px">
															<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
															<input type="hidden" class="hiddenrecord" value="<?php echo @$data['count']?>">
															<span><input type="button" value="<< Prev" class="buttonprev"/>
															Page
															<input type="button" value="Next >>" class="buttonnext"/></span>
														
													</td>
												</tr>
											</table>
										</td>
									</tr>
									 <tr>
                                            <td colspan=5><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                                        &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
                                                <?php
                                                    $cek=$data['dataAsetlist'];
                                                ?>
                                                <p style="float:right;"><input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/></p>
                                            </td>
                                        </tr>
								</table>
								<br/>
								<table>
								
								</table>
                                <div id="demo">
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
								<thead>
								
                                       
                                        <tr >
                                            <th width="20px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                            <th width="50px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Pilihan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor Pemindahtanganan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tanggal Pemindahtanganan</th>
                                            <th width="80px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Lokasi Pemindahtanganan</th>
                                        </tr>
                                        </thead>
										<tbody>
										
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
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: black; font-weight: ;"><?php echo "$no.";?></td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: black; font-weight: ;">
                                                <input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPemindahtanganan" value="<?php echo $value['BASP_ID'];?>" <?php for ($j = 0; $j <= count($data['dataAsetlist']); $j++){if ($data['dataAsetlist'][$j]==$value['BASP_ID']) echo 'checked';}?>/>
                                            </td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$value[NoBASP]";?></td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php $change=$value['TglBASP']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$value[LokasiBASP]";?></td>
                                        </tr>
                                        </tr>
                                                <?php $no++; $pid++; }} ?>
                                    </tbody>
									<tfoot>
									</tfoot>
                                </table>
								</div>
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
			    var modParam = 'ValidasiPemindahtanganan';
			    
			    
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
			    var modParam = 'ValidasiPemindahtanganan';
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



