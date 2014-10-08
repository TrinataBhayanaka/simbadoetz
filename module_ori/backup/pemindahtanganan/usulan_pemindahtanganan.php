<?php
include "../../config/config.php";
include"$path/header.php";
include"$path/title.php";

echo '<pre>';
//print_r($_POST);
echo '</pre>';
$submit=$_POST['submit'];

$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);


if (isset($submit))
                                {
                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            
                                            $data = $RETRIEVE->retrieve_penetapan_pemindahtanganan_filter();
                                }
                                
                                echo '<pre>';
                                //print_r($data);
                                echo '</pre>';
                                /*
                                $sessi = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser['ses_uid']];
                                $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
                                $data = $RETRIEVE->retrieve_penetapan_pemindahtanganan_filter($parameter);
                                 * 
                                 */
/*
$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
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

$explode = array_unique($dataAsetList);

$id = 0;
foreach($explode as $value)
{
       //$$key = $value;
       $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                            c.Kelompok, c.Uraian, c.Kode,
                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                            f.InfoKondisi, g.NoKontrak
                            FROM Aset AS a 
                            INNER JOIN KontrakAset AS h ON a.Aset_ID=h.Aset_ID
                            INNER JOIN Kontrak AS g ON g.Kontrak_ID=h.Kontrak_ID
                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                            WHERE a.ASET_ID = '$value' LIMIT 1";
        //print_r($query);
        $result = mysql_query($query) or die(mysql_error());
        $data[$id] = mysql_fetch_object($result);
        
        $id++;
}
   echo '<pre>';
   //print_r($data);
   echo '</pre>';
    */
?>
<html>
	
	
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Buat Usulan ?");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  document.location="<?php echo "$url_rewrite";?>/module/pemindahtanganan/usulan_pemindahtanganan_aset.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite";?>/module/pemindahtanganan/daftar_pemindahtanganan_barang.php?pid=1";
		  }
		}
	</script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	</head>
	<body>
	<div id="content">
                        <?php
                                include"$path/menu.php";
                        ?>
                  </div>
            <script type="text/javascript">
                function showSpo(data)
                {
                    var id = data.id;
                    //alert(id);
                    spoiler = document.getElementById("show_"+id).style.display;
                    
                    if (spoiler == "")
                        {
                            document.getElementById("show_"+id).style.display = "none";
                        }
                    else
                        {
                            document.getElementById("show_"+id).style.display = "";
                        }
                }
                function showSpo1(data)
                {
                    //alert("ada");
                    var id = data.id;
                    spoiler1 = document.getElementById("subshow_"+id).style.display;
                    
                    if (spoiler1 == "")
                        {
                            document.getElementById("subshow_"+id).style.display = "none";
                        }
                    else
                        {
                            document.getElementById("subshow_"+id).style.display = "";
                        }
                }
                
		</script>
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Buat Usulan Pemindahtanganan
                                                </div>
                                                        <div id="bottomright">
                                                            <form method="POST" action="<?php echo "$url_rewrite";?>/module/pemindahtanganan/usulan_pemindahtanganan_proses_aset.php">
                                                                <table width="99%" height="3%" border="1" style="border-collapse:collapse;">
                                                                        <div style="padding:2px;">
                                                                            <tr>
                                                                                    <td colspan="2" style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;text-decoration:underline;">Daftar Aset yang di usulkan untuk di hapus:</td>
                                                                            </tr>
                                                                            
                                                                            <?php
                                                                            $id =0;
                                                                            $no = 1;
                                                                            foreach ($data['dataArr'] as $keys => $nilai)
                                                                            {
                                                                            ?>
                                                                            <tr>
                                                                                <td style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;">
                                                                                    <table width="100%">
                                                                                        <tr>
                                                                                            <td width='10%' valign="top"><?php echo "$no.";?></td>
                                                                                            <td>
                                                                                            <b><input type="hidden" name="pemindahtanganan_usul_nama_aset[]" value="<?php echo "$nilai->Aset_ID";?><br/><?php echo "$nilai->NomorReg";?><br/><?php echo "$nilai->NamaAset";?>"><?php echo $nilai->Aset_ID?><br/><br/><span style="font-weight:bold;"><?php echo $nilai->NomorReg?></span><br/><br/><?php echo $nilai ->NamaAset?></b>
                                                                                            </td>
                                                                                            <td align="right" valign="top" style="border-style:none;"><input type="button" onclick="showSpo(this)" value="View Detail" id="<?php echo $id;?>" disabled="disabled"></td>
                                                                                            
                                                                                        </tr>
                                                                                        <tr >
                                                                                            <td colspan="3" align="center">
                                                                                                <div  id="show_<?php echo $id?>" style="border:1px solid #dddddd; display: none;">
                                                                                                        <table width="100%">
                                                                                                            <tr>
                                                                                                                <td width="45px"><input type="text" value="99" readonly="readonly" size="1%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                                <td width="7%"><input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">-</td>
                                                                                                                <td width="160px"><input type="text" value="02.03.01.02.02" readonly="readonly" style="text-align:center; font-weight:bold;"></td>
                                                                                                                <td>-
                                                                                                                    <input type="text" value="1" readonly="readonly" size="5%" style="text-align:center; font-weight:bold;">
                                                                                                                </td>
                                                                                                                <td align="right" style="border-style:none;"><input type="button" onclick="showSpo1(this)" value="Sub Detail" id="<?php echo $id?>"></td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                        <table width="100%" border="1" style="border-collapse:collapse;">
                                                                                                                <tr>
                                                                                                                    <td>
                                                                                                                        <table width="99%" border="0">
                                                                                                                            <tr>
                                                                                                                                <td >Nama Aset</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $nilai ->NamaAset?></td>
                                                                                                                            </tr>   
                                                                                                                            <tr>
                                                                                                                                <td>Satuan Kerja</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $nilai ->NamaSatker?></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td>Jenis Barang</td>
                                                                                                                                <td style="font-weight:bold;"><?php echo $nilai ->NamaAset?></td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                    <td colspan="2"><hr /></td>
                                                                                                                            </tr>
                                                                                                                          </table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                          </table>
                                                                                                     <div  id="subshow_<?php echo $id?>" style="width:99%; height:200px; overflow:auto; border:1px solid #dddddd; display: none;">
                                                                                                        <table width="100%" border="1" style="border-collapse:collapse;">
                                                                                                            <tr>
                                                                                                                    <td>
                                                                                                                            <table width="100%">
                                                                                                                                <tr>
                                                                                                                                    <td colspan="2" style="background-color:#CCCCCC;">Informasi Tambahan</td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Nomor Kontrak</td>
                                                                                                                                    <td><input type="text" value="<?php echo $nilai->NoKontrak?>" readonly="readonly" name="bupt_it_get_nokontrak"></td>
                                                                                                                                <tr>
                                                                                                                                    <td><td>Tidak ada informasi</td></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Operasional/Program</td>
                                                                                                                                    <td>
                                                                                                                                        <select name="bupt_it_get_asetOpr">
                                                                                                                                            <option></option>
                                                                                                                                            <option selected="selected">Program</option>
                                                                                                                                            <option>Operasional</option>
                                                                                                                                        </select>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Kuantitas</td>
                                                                                                                                    <td><input type="text" name="bupt_it_get_kuantitas" value="1" size="2"> Satuan <input type="text" name="bupt_it_get_satuan" value="unit"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Cara Perolehan</td>
                                                                                                                                    <td>
                                                                                                                                        <select name="bupt_it_get_perolehan">
                                                                                                                                            <option>-</option>
                                                                                                                                            <option>Pengadaan</option>
                                                                                                                                            <option>Hibah</option>
                                                                                                                                        </select>
                                                                                                                                    </td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Tanggal Perolehan</td>
                                                                                                                                    <td><input type="text" name="bupt_it_get_tanggal" readonly="readonly"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Nilai Perolehan</td>
                                                                                                                                    <td><input type="text" value="0" style="text-align:right" name="bupt_it_get_nilai" readonly="readonly"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Alamat</td>
                                                                                                                                    <td><textarea cols="130" name ="bupt_it_get_alamat"rows="2"></textarea></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td></td>
                                                                                                                                    <td>RT/RW <input type="text" name="bupt_it_get_rtrw " readonly="readonly" size="3"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Lokasi</td>
                                                                                                                                    <td><input type="text" readonly="readonly" name="bupt_it_get_lokasi" size="100"> <input type="button" value="Cari Lokasi" disabled="disabled"></td>
                                                                                                                                </tr>
                                                                                                                                <tr>
                                                                                                                                    <td>Koordinat</td>
                                                                                                                                    <td>Bujur Lintang</td>
                                                                                                                                </tr>
                                                                                                                                </tr>
                                                                                                                            </table>
                                                                                                                    </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </div>
                                                                                                    </div>
                                                                                               </td>
                                                                                       </tr>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                            $id++;
                                                                            $no++;
                                                                            }
                                                                            ?>
                                                                            
                                                                        </div>        
                                                                </table><br>
                                                                <table width="99%" height="3%" border="1" style="border-collapse:collapse;">
                                                                        <div style="padding:5px;">   
                                                                            <tr>
                                                                                    <td colspan="2" style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;text-decoration:underline;">Usulan Pemindahtanganan Aset</td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <th style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;"> <input type='submit' value="Usulan Pemindahtanganan" name="usul"> 
                                                                                        <input type='button' value='Batal' onclick="window.location='daftar_pemindahtanganan_barang.php?pid=1'" style="width:100px;"></th>
                                                                            </tr>
                                                                         </div>
                                                                </table>
								</form>
                                                        </div>
                                                </div>
                                        </div>
                                 </div>
                
        <?php
                include"$path/footer.php";
        ?>
</body>
</html>	
