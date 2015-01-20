<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

   $menu_id = 39;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
		$aset_id=$_POST['bup_pp_sp_asetid'];
        $nama_aset=$_POST['bup_pp_sp_namaaset'];
        $no_kontrak=$_POST['bup_pp_sp_nokontrak'];
        $kd_tahun=$_POST['bup_pp_sp_tahun'];
        $kelompok=$_POST['kelompok_id'];
        $lokasi=$_POST['lokasi_id'];
        $satker=$_POST['skpd_id'];
       
        $submit=$_POST['submit'];
        
        
        $paging = $LOAD_DATA->paging($_GET['pid']);    
            
        if (isset($submit))
        {
            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
            $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
            // $get_data_filter = $RETRIEVE->retrieve_penetapan_penghapusan_filter($parameter);
        }else{

        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
        // $get_data_filter = $RETRIEVE->retrieve_penetapan_penghapusan_filter($parameter);

       }
	   // pr($get_data_filter);
		// $countdata = array_keys($get_data_filter['dataArr']);
		// $totaldata = end($countdata) + 1;
		
        
	?>
      
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
		// pr($_POST);
	$data = $PENGHAPUSAN->retrieve_penetapan_penghapusan_filter($_POST);

		// pr($data);
			?>
     
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
							function enable_submit(){
							var enable = document.getElementById('pilihHalamanIni');
							var button = document.getElementById('submit');
								if(enable){
									button.disabled = false;
								}
							}
							function disable_submit(){
							var disable = document.getElementById('kosongkanHalamanIni');
							var button = document.getElementById('submit');
								if(disable){
									button.disabled = true;
								}
							}
                        </script>

          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan Penghapusan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Penghapusan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: <?=$get_data_filter[count]?> filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/penghapusan/penetapan_penghapusan_tambah_aset.php";?>" class="btn">
								Kembali ke halaman utama: Cari Aset</a>
								
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$get_data_filter[count]?>">
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
			<form name="myform" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_tambah_data.php">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="example">
				<thead>
					<tr>
						
						<td align="right" colspan="5">
								<span><input type="submit" name="submit" class="btn" value="Penetapan Penghapusan" id="submit" disabled/></span>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Nomor Usulan</th>
						<th>Tgl Usulan</th>
						<th>Aset</th>
						<!--<th>Tindakan</th>-->
					</tr>
				</thead>
				<tbody>		
							 
				 <?php
                                        
					// pr($dataArr);
					$no=1;	
					// pr($data);
					if($data){
					foreach($data as $key => $hsl_data){
						
						if($dataArr!="")
							{
								(in_array($hsl_data['Usulan_ID'], $dataArr))   ? $disable = "return false" : $disable = "return true";
							}
				?>
						  
					<tr class="gradeA">
						<td><?php echo "$no";?></td>
						<td  class="checkbox-column">
							<?php
						if (($_SESSION['ses_uaksesadmin'] == 1)){
							?>
							<input type="checkbox" class="checkbox" onchange="enable()" name="penetapanpenghapusan[]" value="<?php echo $hsl_data[Usulan_ID];?>" 
							<?php for ($j = 0; $j <= count($get_data_filter['asetuser']); $j++){
								if ($get_data_filter['asetuser'][$j]==$hsl_data[Usulan_ID]) echo 'checked';}
							?>/>
							<?php
						}else{
							if ($get_data_filter['asetuser']){
							if (in_array($hsl_data[Usulan_ID], $get_data_filter['asetuser'])){
							?>
							<input type="checkbox" class="checkbox" onchange="enable()" name="penetapanpenghapusan[]" value="<?php echo $hsl_data[Usulan_ID];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$hsl_data[Usulan_ID]) echo 'checked';}?>/>							<?php
							}
						}
						}
						
						?>
						</td>
						<td>
							<?php echo "$hsl_data[Usulan_ID]";?>
						</td>
						<td><?php $change=$hsl_data[TglUpdate]; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
						<td>
							<ul type="1">
						<?php
						$dataAset = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_aset($hsl_data[Aset_ID]);
						// pr($dataAset);
							$noAset=1;
							foreach ($dataAset as $valueAset) {
								if($valueAset[StatusKonfirmasi]==1){
									$textLabel="Diterima";
									$labelColor="label label-success";
								}elseif($valueAset[StatusKonfirmasi]==2){
									$textLabel="Ditolak";
									$labelColor="label label-danger";
								}else{
									$textLabel="Ditunda";
									$labelColor="label label-warning";
								}
								echo "<li>".$noAset.".  Aset ID[".$valueAset['Aset_ID']."][".$valueAset['kodeSatker']."]<span class='".$labelColor."'>".$textLabel."</span></li>";
							$noAset++;
							}
						?>
							</ul>
						</td>
					</tr>
					
				     <?php $no++; } }?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>

			</form>
			</div>
			<div class="spacer"></div>
			
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>