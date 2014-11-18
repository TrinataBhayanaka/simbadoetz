<?php
ob_start();

include "../../config/config.php";
include "$path/header.php";
include "$path/title.php";

include "$path/menu.php";
            
$DBVAR = new DB();

// clear session
unset($_SESSION['pemindahtanganan']);

//print_r($_POST);
            
            $bupt_idaset = $_POST['bupt_idaset'];
            $bupt_namaaset = $_POST['bupt_namaaset'];
            $bupt_nokontrak = $_POST['bupt_nokontrak'];
            $bupt_tahun = $_POST['bupt_tahun'];
            $submit = $_POST['tampil'];

	    if ($_GET['pid']==0)
	    {
		echo '<script type=text/javascript> window.location.href="?pid=1";</script>';
	    }
	    if ($_GET['pid']== 1)
	    {
		$paging = ((($_GET['pid'] - 1) * 10));
	    }else
	    {
		$paging = ((($_GET['pid'] - 1) * 10) + 1);
	    }
	    
    
	    if (isset($submit))
	    {
		if ($bupt_idaset != ""){
		
			if($bupt_namaaset !=""){
				
				if($bupt_tahun !=""){
				
				    //$query ="SELECT Aset_ID FROM Aset WHERE Aset_ID = $bupt_idaset AND NamaAset = $bupt_namaaset AND TglPerolehan LIKE '$bupt_tahun%' ";
				    $queryParam = "WHERE a.Aset_ID = $bupt_idaset AND a.NamaAset = '$bupt_namaaset' AND a.TglPerolehan LIKE '$bupt_tahun%'";
				    //print_r($query);
				}
				else
				{
					    $queryParam ="WHERE a.Aset_ID = $bupt_idaset AND a.NamaAset = '$bupt_namaaset' ";
					    //$query ="SELECT Aset_ID FROM Aset WHERE Aset_ID = $bupt_idaset AND NamaAset = $bupt_namaaset ";				    	    
				}
			}
			else
			{
				    $queryParam ="WHERE a.Aset_ID = $bupt_idaset";
				//$query ="SELECT Aset_ID FROM Aset WHERE Aset_ID = $bupt_idaset";
			}
			
		    }
		    else if ($bupt_namaaset !='')
		    {
			if($bupt_tahun !=""){
				
				    $queryParam = "WHERE a.NamaAset = '$bupt_namaaset' AND a.TglPerolehan LIKE '$bupt_tahun%'";
				    
				}
				else
				{
					    $queryParam ="WHERE a.NamaAset = '$bupt_namaaset' ";
					    				    	    
				}
				
			
		    }
		    else if ($bupt_tahun !='')
		    {
			$queryParam = "WHERE a.TglPerolehan LIKE '$bupt_tahun%'";
			
		    }
		    else
		    {
			$queryParam ="";
		    }
		    
		    
		    unset($_SESSION['query']);
	    }
            
	    if (!isset($_SESSION['query']))
	    {
		$_SESSION['query'] = $queryParam;
	    }
	    
	    
	    /*
	    $query = $_SESSION['query'];
	    
	    
	    $result = $DBVAR->query($query) or die ($DBVAR->error());
	    
	    $rows = $DBVAR->num_rows($result);
	    if ($rows)
	    {
			while ($data = $DBVAR->fetch_object($result))
			{
				    $dataID[] = $data->Aset_ID;
			}	
	    }
	    */
	    //print_r($dataID);
	    
	    //foreach ($dataID as $key => $value)
	    //{
			$query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
				a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
				a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
				a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
				c.Kelompok, c.Uraian, c.Kode,
				d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
				e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
				f.InfoKondisi
				FROM Aset AS a 
				LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
				LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
				LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
				LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
				$queryParam ORDER BY a.Aset_ID ASC LIMIT $paging, 10";
				//print_r($query);
			$result = $DBVAR->query($query) or die($DBVAR->error());
			$rows = $DBVAR->num_rows($result);
			
			if ($rows)
			{
				while ($data = $DBVAR->fetch_object($result))
				{
				    $dataArray [] = $data;
                                    
				}
				
			}
			
	    //}
	    
	    
	    /// query ke apl_userlist
	    $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Pemindahtanganan' AND UserSes = '12345' ";
	    $result = $DBVAR->query($query) or die ($DBVAR->error());
	    $rows = $DBVAR->num_rows($result);
	    if ($rows)
	    {
			$data = $DBVAR->fetch_object($result);
			$dataList = $data->aset_list;
	    }
	    
	    $explodeList = explode (',',$dataList);
	    
	    echo '<pre>';
	    //print_r($dataArray);
	    echo '</pre>';
	    
            ?>
<html>
<body>
	    <script type="text/javascript">
            function show_confirm()
	    {
	    var r=confirm("Cetak dokumen");
                    
            if (r==true)
            {
			alert("Dokumen telah dicetak");
                        }
                        else
                        {
                        alert("Batal cetak dokumen");
                        }
                        
	    }	
	    function pilih()
                       {
                           //alert("ada");
                           document.getElementById('checkbox').checked = true;
                           
                           
                       }
                       
                       function kosong()
                       {
                           document.getElementById('checkbox').checked = false;
                       }
		       
		       
            
            </script>
                   

    <div id="tengah1">	
    <div id="frame_tengah1">
    <div id="frame_gudang">
    <div id="topright">Buat Usulan Pemindahtanganan</div>
    <div id="bottomright">
        

    <div> 
        
        <table border="1" width="100%">
            <tr>
                <td><strong>Filter data: Tidak ada filter (View seluruh data)</strong></td>
            </tr>
        </table>
    </div>
         <form method="POST" action="<?php echo"$url_rewrite"?>/module/pemindahtanganan/usulan_pemindahtanganan.php">   
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
                
                <input type="button" onclick="show_confirm()" value="Cetak seluruh data" />
                <td width=25% align=right>
                <script type="text/javascript">
                
                </script>
                <input type="submit" onclick="show_confirm()" value="Cetak dari daftar data" />
                </td>
                
        </tr>
        </table>
        <table border=0 width=100%>
        <tr>
                <td width=50%></td>
                <td width=50% colspan="2" align=right>Waktu proses: 0.320detik. Jumlah 1 aset dalam 1 halaman</td>
        </tr>
        
        </table>
            
       
</div>         
        
        <div>  
        <table border="0" width=100%>
         
            <tr>
                <td width=13% align=left>Pilihan:</td>
                <td width=18% align=left></td>
                <td width=18% align=left></td>
                <td width=44% align=left></td>
        </tr>
                <tr>
                <td width=13% align=left><a href="#" onclick="pilih()"><u>Pilih halaman ini</u></a></td>
                <td width=18% align=left><a href="?page=2"><u>Kosongkan halaman ini</u></a></td>
                <td width=18% align=left><a href="?page=3"><u>Bersihkan halaman ini</u></a></td><td width=40% align=right>
                <td width=44% align=right>
                
                <td align="right"><input type="submit" align="right" value="Usulan Pemindahtanganan" ></td>
                </td>
        </tr>
        </table>          


            </div>
        
            <div> 
                <table border="0" width=100%>
        <td colspan ="2" align="right">
            <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
            <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
        </td>
        
        </table> 
           
    <table border="1" width=100%>
        <tr bgcolor="#004933">
                <td width=2% align=left></td>
                <td style="color:white;" colspan="2" width=49% align=left>Informasi Aset</td>
        </tr>
        
                    <?php 
    
    if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
    if (!empty($dataArray))
    {
        $disabled = '';
    $pid = 0;
    
    foreach ($dataArray as $key => $value)
    {
       
	
    
	    $noRegistrasi = $value->Pemilik.'.'.$value->KodePropPerMen.'.'.
                            $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
                            substr($dataArray->Tahun, 2,2).'.'.$value->KodeUnit;
            
            $noRegistrasi2 = $value->KodePropPerMen.'.'.
                             $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
                             substr($value->Tahun, 2,2).'.'.$value->KodeUnit;
            
            
            //$kodeKelompok = $value['aset']->Kode.'.'.$b[0].$b[1].$b[2].$b[3].$value['aset']->NomorReg;
            //$kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$value['aset']->NomorReg;
    
    ?>
        <tr>
            
        <td align="center" style="border: 2px solid #dddddd;"><?php echo $no?></td>
        <td width=2% align=center style="border: 2px solid #dddddd;" colspan="">
            <input type="checkbox" class="checkbox" name="Pemindahtanganan" value="<?php echo $value->Aset_ID?>" <?php for ($i = 0; $i <= count($explode); $i++){if (in_array($value->Aset_ID, $explodeList)) echo 'checked';}?>></td>
         <td style="border: 2px solid #dddddd;">
            

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
                        <td style="font-weight:bold;"><?php echo $noRegistrasi?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $noRegistrasi2?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
                    </tr>

                </table>

                <br>
                <hr />
                <table>
                    <tr>
                        <td width="30%"> No.Kontrak</td> <td><?php echo $value->Kontrak_ID?></td>
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
    }
    }
    else
    {
        $disabled = 'disabled';
        echo '<tr><td align=center colspan=5>Tidak ada data</td></tr>';
    }
    ?>   
            
                </table>
       
        </table>
                
                
                                                                        </div>
                                                                <div>
                                                      
        <table border="0" width=100%>
        <td colspan ="2" align="right">
            <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
            <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
        </td>
        
        </table>  
                                                                        <table border="0" width=100%>
         
           
                <tr>
                <td width=13% align=left><a href="#" onclick="pilih()"><u>Pilih halaman ini</u></a></td>
                <td width=18% align=left><a href="?page=2"><u>Kosongkan halaman ini</u></a></td>
                <td width=18% align=left><a href="?page=3"><u>Bersihkan halaman ini</u></a></td><td width=40% align=right>
                <td width=44% align=right>
                <script type="text/javascript">
                function show_confirm()
                {
                    
                
                var r=confirm("Download Daftar pemindahtanganan ");
                if (r==true)
                        {
                        alert("Open Daftar pemindahtanganan");
                        }
                        else
                        {
                        alert("Batal");
                        }
                        }
                </script>
                <td align="right"><input type="submit" align="right" value="Usulan Pemindahtanganan" onclick="window.location='<?php echo"$url_rewrite";?>/module/pemindahtanganan/usulan_pemindahtanganan_aset.php'"></td>
                </td>
        </tr>
        </table>           
      
                                                                                                                </div>
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
                        //alert(check);
                        if (check == 'checked')
                            {
                                $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam}, function(data){
                                //$('#check').html('');
                               // alert(data);
                                })

                            }
                            else
                                {
                                    $.post('<?php echo $url_rewrite;?>/function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam}, function(data){
                                //$('#check').html('');
                                //alert(data);
                                })
                                }
                        
                   });
                   
               </script>
		<?php
                include "$path/footer.php";
                ?>
	</body>
</html>	
