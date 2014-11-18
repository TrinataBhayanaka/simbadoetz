<?php
ob_start();

include "../../config/config.php";
include "$path/header.php";
include "$path/title.php";

include "$path/menu.php";

            $bupt_idaset = $_POST['bupt_idaset'];
            $bupt_namaaset = $_POST['bupt_namaaset'];
            $bupt_nokontrak = $_POST['bupt_nokontrak'];
            $bupt_tahun = $_POST['bupt_tahun'];
            $kelompok= $_POST['kelompok_id'];
            $lokasi= $_POST['lokasi_id'];
            $satker= $_POST['skpd_id'];
            $ngo= $_POST['ngo_id'];
            
$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);



//print_r($_POST);
            
            
            
            $submit = $_POST['tampil'];
             
                       /* 
                       $hal = $_GET[hal];
                                                if(!isset($_GET['hal'])){ 
                                                    $page = 1; 
                                                } else { (
    [menu_without_login] => 2,3,4,5,7,8,9,50,51
    [ses_uid] => e714ks3qnrbi1bv84i5tb4lhbuhb3hoakf2j9hdm145pk4ajfbi0
    [ses_uoperatorid] => 49
    [ses_uname] => admin
    [ses_uaksesadmin] => 1
    [ses_usatkerid] => 0
    [ses_unamaoperator] => Administrator
    [ses_ujabatan] => 1
    [ses_uhakakses] => 1,2,3,4,5,6,7,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51
    [ses_ushowmenu] => 
    [ses_ujabatanaksesmenu] => 
                                                    $page = $_GET['hal']; 
                                                }
                                                $jmlperhalaman = 10;  // jumlah record per halaman
                                                $offset = (($page * $jmlperhalaman) - $jmlperhalaman);
                                                $i=$page + ($page - 1) * ($jmlperhalaman - 1);
                          */ 
                             $paging = $LOAD_DATA->paging($_GET['pid']);    
                             
                            // $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser['ses_uid']]="";
                             
                             if (isset($submit))
                                {
                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            
                                            $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
                                            $data = $RETRIEVE->retrieve_pemindahtanganan_filter($parameter);
                                }
                                
                                echo '<pre>';
                                //print_r($data);
                                echo '</pre>';
                                
                                $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
                                $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
                                $data = $RETRIEVE->retrieve_pemindahtanganan_filter($parameter);


                                echo '<pre>';
                                //print_r($_SESSION);
                                echo '</pre>';
                                
                            
                           
            
                        if (isset($submit)){
                                if ($bupt_idaset=="" && $bupt_namaaset=="" && $bupt_nokontrak=="" && $bupt_tahun=="" && $kelompok=="" && $lokasi=="" && $satker=="" && $ngo==""){
                        ?>
                            <script>var r=confirm('Tidak ada isian filter');
                                if (r==false){
                                document.location='pemindahtanganan.php';
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
                   

    <div id="tengah1">	
    <div id="frame_tengah1">
    <div id="frame_gudang">
    <div id="topright">Buat Usulan Pemindahtanganan</div>
    <div id="bottomright">
        

    <div> 
        
        <table border="0" width="100%">
            <tr>
                <td><strong>Filter data: --- (View seluruh data)</strong></td>
            </tr>
        </table>
    </div>
         
        <div>
        <table border=0 width=100%>

        <tr>
                <td width=50%></td>
                <td colspan="2" width=25% align=right>
                        <input type="button" name="aset_act_btn" value="Kembali ke halaman utama: Cari Aset" onclick="window.location='<?php echo "$url_rewrite";?>/module/pemindahtanganan/pemindahtanganan.php';"></td>

        </tr>
        </table>
        
            <table border=0 width=100%>

        <tr>		
                <td width=60%></td>
                <td width=25% align=right>
                    <?php 
                        $param=urlencode($data['parameter_report']);
                        //echo $param;
                    ?>
                    <a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/tes_class_usulan_pemindahtanganan_cetak_seluruh.php?menu_id=42&mode=1&parameter=$param";?>" target="_blank"><input type="button" value="Cetak seluruh data" /></a>
                </td>
                <td width=25% align=right>
                <script type="text/javascript">
                
                </script>
                <a href="<?php echo "$url_rewrite/report/template/PEMINDAHTANGANAN/";?>tes_class_usulan_pemindahtanganan_dengan_pilihan.php?menu_id=42&mode=2" target="_blank"><input type="submit" value="Cetak dari daftar data" /></a>
                </td>
                
        </tr>
        <tr>
            <td colspan="3" align="right"><input type="submit" onclick="window.location='<?php echo "$url_rewrite/";?>module/pemindahtanganan/pemindahtanganan_daftar_aset_fix.php?pid=1';" value="Daftar Usulan Barang" /></td>
        </tr>
        </table>
        <table border="0" width=100%>
        <td colspan ="2" align="right">
            <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
            <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
        </td>
        </table> 
            
       
</div>         
        
        <div>  
        <form method="POST" action="<?php echo"$url_rewrite"?>/module/pemindahtanganan/usulan_pemindahtanganan.php" name="form">   
        <table border="0" width=100%>
         
            <tr>
                <td width=13% align=left>Pilihan:</td>
                <td width=18% align=left></td>
                <td width=18% align=left></td>
                <td width=44% align=left></td>
            </tr>
                <tr>
                <td colspan=3><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''"  id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
                                            
                <td></td>
                <?php
                    $cek=$data['asetList'];
                ?>
                <td align="right"><input type="submit" align="right" value="Usulan Pemindahtanganan" name="submit" id="submit" disabled/></td>
        </tr>
        </table>          


           
    <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px; clear:both;">
                                    <tr style="background-color:#004933; color:white; height:20px;">
                                        <th width="20px" align="center" style="border: 1px solid #004933;">No</th>
                                        <th width="100px" align="left" style="border: 1px solid #004933;" colspan="2">&nbsp;Informasi Aset</th>
                                    </tr>
        
                    <?php 
    
    if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
    if (!empty($data['dataArr']))
    {
        $disabled = '';
        $pid = 0;
   
    
    foreach ($data['dataArr'] as $key => $value)
    {
       
	
    /*
	    $noRegistrasi = $value->Pemilik.'.'.$value->KodePropPerMen.'.'.
                            $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
                            substr($dataArr->Tahun, 2,2).'.'.$value->KodeUnit;
            
            $noRegistrasi2 = $value->KodePropPerMen.'.'.
                             $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
                             substr($value->Tahun, 2,2).'.'.$value->KodeUnit;
            */
            
            //$kodeKelompok = $value['aset']->Kode.'.'.$b[0].$b[1].$b[2].$b[3].$value['aset']->NomorReg;
            //$kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$value['aset']->NomorReg;
    
    ?>
        <tr>
            
        <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;"><?php echo "$no";?></td>
        <td align="center" style="border: 1px solid #004933; height:100px; color: black; font-weight: bold;">
            <input type="checkbox" id="checkbox" onchange="enable()" class="checkbox" name="Usulan_Pemindahtanganan" value="<?php echo $value->Aset_ID?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>></td>
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
        $pid++;
        }}
    ?>   
            
                </table>
       
        </table>
                
                
                                                                      
             &nbsp;
                                <?php/*
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
                                 * * */
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
                        
			//alert(check);
                        if ((check ==true) || (check == 'checked'))
                            {
				//alert('ada');
                                $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam, type:''}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                //document.getElementById('katalogButton').disabled=true;
                                //window.location.href='?pid=<?php  echo $_GET['pid']?>';
                                })

                            }
                            else
                                {
                                    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam, type:''}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                //window.location.href='?pid=<?php  echo $_GET['pid']?>';
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
			    var modParam = 'Usulan_Pemindahtanganan';
			    
			    
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
                                window.location.href='?pid=<?php  echo $_GET['pid']?>';
                                })
			});
			$("#kosongkanHalamanIni").click(function () {
			    //alert('ada');
			   // $('.checkbox').removeAttr('checked', '1');
			    var panjang=$(".checkbox:checked").length;
			    var value =updateCheckboxEmpty();
			    var modParam = 'Usulan_Pemindahtanganan';
			    
			    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam, type:'array'}, function(data){
                                //$('#check').html('');
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
		   
		   /*
		   $('#pilihHalamanIni').click(function()
                   {
                      $('.checkbox').attr('checked', this.checked);
		      //var cek = $('.checkbox').attr('value');
		      var aset_id = $('#all_aset_id').attr('value');
                      alert(aset_id);
                   });
                   */
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
