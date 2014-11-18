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
            
            // echo "$parameter_sql";
            
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
                                document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php?pid";
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
				function disable_submit(){
					var enable = document.getElementById('pilihHalamanIni');
					var disable = document.getElementById('kosongkanHalamanIni');
					var button=document.getElementById('submit');
					if (disable){
						button.disabled=true;
					} 
				}
				function enable_submit(){
					var enable = document.getElementById('pilihHalamanIni');
					var disable = document.getElementById('kosongkanHalamanIni');
					var button=document.getElementById('submit');
					if (enable){
						button.disabled=false;
					} 
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
                                Validasi Pemanfaatan
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_filter.php"><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_daftar_valid.php?pid=1"><input type="submit" value="Daftar Barang"></a>
                                </div>
                                
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_validasi_proses.php?pid=1">
                                <div>
								<?php 
								$query="SELECT Pemanfaatan_ID FROM Pemanfaatan WHERE FixPemanfaatan=1 AND Status=0 ORDER BY Aset_ID ASC ";
                                        $result = $DBVAR->query($query) or die($DBVAR->error());
                                        
										while ($data = $DBVAR->fetch_object($result))
                                        {
                                            $dataArray[] = $data;
                                        }
										if($dataArray!=""){
                                            foreach ($dataArray as $pemanfaatan_id)
                                                {
													if($_SESSION['ses_uaksesadmin'] == 1){
														$query2="SELECT * FROM Pemanfaatan
                                                                    WHERE  Pemanfaatan_ID = $pemanfaatan_id->Pemanfaatan_ID
                                                                    ORDER BY Pemanfaatan_ID asc ";
                                                    }else{
														$query2="SELECT * FROM Pemanfaatan
                                                                    WHERE  Pemanfaatan_ID = $pemanfaatan_id->Pemanfaatan_ID
                                                                    AND UserNm = '$_SESSION[ses_uoperatorid]' ORDER BY Pemanfaatan_ID asc ";
													}
													$exec=$DBVAR->query($query2) or die(mysql_error());
                                                    $row[] = $DBVAR->fetch_object($exec);       
                                                }
                                            }
                                        $rows = $DBVAR->num_rows($exec);
										$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemanfaatan[]'";
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
										
										if ($dataAsetList !='')
										{
											$explode = array_unique($dataAsetList);
										}
								?>
                                <table  width="100%" style="padding:2px; margin-top:0px; border: 1px solid #dddddd; border-width: 1px 1px 1px 1px; clear:both;">
                                    <tbody>
                                        <tr>
                                            <td>
                                               <td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
												<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
												<td align=right>
													<input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/>
												</td>
												<td width="200px" align="right"><input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
													<input type="hidden" class="hiddenrecord" value="<?php echo @$rows?>">
													<input type="button" value="<< Prev" class="buttonprev"/>
													Page
													<input type="button" value="Next >>" class="buttonnext"/></td>
								        </tr>
								    </tbody>    
								</table>        
							   </div> 
							   
							<div id="demo">
							<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
								<thead>	        
                                        <tr>
                                            <th width="20px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                            <th width="50px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Pilihan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tanggal SKKDH</th>
                                            <th width="80px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan</th>
                                        </tr>
                                 </thead> 
										<?php
										if($row!=""){
											$page = @$_GET['pid'];
										if ($page > 1){
											$no = intval($page - 1 .'01');
										}else{
											$no = 1;
										}	  
										// pr($row);	
                                       foreach ($row as $value){
                                            $id = $value->Pemanfaatan_ID;
											?>
                                        <tr>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; : ; font-weight: ;"><?php echo "$no";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; : black; font-weight: ;">
                                                <input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPemanfaatan[]" value="<?php echo $id?>" 
												<?php for ($j = 0; $j <= count($explode); $j++){if ($explode[$j]==$id) echo 'checked';}?>/>
                                            </td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$value->NoSKKDH";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$value->TglSKKDH; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo "$value->Keterangan";?></td>
                                        </tr>
                                        </tr>
                                                <?php $no++; }}
                                                else
                                        {
											$disabled = 'disabled';
										}
                                                
                                                 ?>
                                    <tfoot></tfoot>
                                    </table>
									</div>
									<div class="spacer"></div>
								</form>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	



