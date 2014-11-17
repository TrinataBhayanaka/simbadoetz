<?php
include "../../config/config.php";
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
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
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

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemindahtanganan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Validasi Pemindahtanganan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Validasi Pemindahtanganan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_filter_pemindahtanganan.php" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
							</li>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan_daftar_valid.php?pid=1" class="btn">
									 Daftar Barang
								 </a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemindahtanganan/"; ?>validasi_pemindahtanganan_proses.php">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						    <td colspan=5><p style="float:left;"><u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="pilihHalamanIni">Pilih halaman ini</u>&nbsp;&nbsp; || 
                                                                                                        &nbsp;&nbsp;<u onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor=''" id="kosongkanHalamanIni">Kosongkan Halaman Ini</u></p>
						<?php
							$cek=$data['dataAsetlist'];
						?>
						<p style="float:right;"><input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/></p>
					</td>
					</tr>
					<tr>
						<th>No</th>
						<th>Pilihan</th>
						<th>Nomor Pemindahtanganan</th>
						<th>Tanggal Pemindahtanganan</th>
						<th>Lokasi Pemindahtanganan</th>
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
					<tr class="gradeA">
						<td><?php echo "$no.";?></td>
						<td>
							<input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPemindahtanganan" value="<?php echo $value['BASP_ID'];?>" <?php for ($j = 0; $j <= count($data['dataAsetlist']); $j++){if ($data['dataAsetlist'][$j]==$value['BASP_ID']) echo 'checked';}?>/>
						</td>
						<td><?php echo "$value[NoBASP]";?></td>
						<td><?php $change=$value['TglBASP']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>	
						<?php echo "$value[LokasiBASP]";?>
						</td>
					</tr>
					
				     <?php $no++; $pid++; }} ?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
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
include "$path/footer.php";
?>