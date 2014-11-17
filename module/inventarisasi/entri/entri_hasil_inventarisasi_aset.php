        <?php
        
//        error_reporting(E_ALL);
        include "../../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
//        $USERAUTH = new UserAuth();

            $DBVAR = new DB();
            $SESSION = new Session();
            
//            $menu_id = 51;
            $SessionUser = $SESSION->get_session_user();
//            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

        ?>
<html>
    
    <body>
    
    <?php 
    include "$path/menu.php"; 
    echo '<pre>';
    //print_r($_POST);
    echo '</pre>';
    
    if (isset($_POST['Submit']))
        {
                if ($_POST['Aset_ID'] !='')
                {
                         $Aset_ID = $_POST['Aset_ID'];
                }
        }
                 
    
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
                            WHERE a.Aset_ID = $Aset_ID LIMIT 1";
	    print_r($query);
	    $result = $DBVAR->query($query) or die($DBVAR->error());
	    $check = $DBVAR->num_rows($result);
	    
	    if ($check)
            {
                $dataArr = $DBVAR->fetch_object($result);
	    
            }
	    
	    
            
               
	//print_r($dataArr);    
            
    
        foreach ($dataArr as $key => $value)
        {
                $$key = $value;
  
            
            $noRegistrasi = $value->Pemilik.'.'.$value->KodePropPerMen.'.'.
                        $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
                        substr($value->Tahun, 2,2).'.'.$value->KodeUnit;
           
            $noRegistrasi2 = $value->KodePropPerMen.'.'.
                         $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
                         substr($value->Tahun, 2,2).'.'.$value->KodeUnit;
            
            $kodeKelompok = $value->KodeUnit.'.'.$b[0].$b[1].$b[2].$b[3].$value->NomorReg;
            $kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$value->NomorReg;
//            echo $noRegistrasi2;
            
            
       }
        
    
    ?>
        
    <div id="tengah1">	
    <div id="frame_tengah1">
    <div id="frame_gudang">
    <div id="topright">Entri Hasil Inventarisasi Aset</div>
    <div id="bottomright">
        <form method="POST" action="<?php echo "$url_rewrite";?>/module/inventarisasi/entri/proses_entri_hasil_inventarisasi.php" >
            <input type="hidden" name="assetID" value="<?php echo $_POST['Aset_ID'] ?>" />
   


    

    <script>
        $(function()
                {
                $('#tanggal1').datepicker($.datepicker.regional['id']);
                $('#tanggal2').datepicker($.datepicker.regional['id']);
                $('#tanggal3').datepicker($.datepicker.regional['id']);
                $('#tanggal4').datepicker($.datepicker.regional['id']);
                $('#tanggal5').datepicker($.datepicker.regional['id']);
                $('#tanggal6').datepicker($.datepicker.regional['id']);
                $('#tanggal7').datepicker($.datepicker.regional['id']);
                $('#tanggal8').datepicker($.datepicker.regional['id']);
                $('#tanggal9').datepicker($.datepicker.regional['id']);
                $('#tanggal10').datepicker($.datepicker.regional['id']);
                $('#tanggal11').datepicker($.datepicker.regional['id']);
                $('#tanggal12').datepicker($.datepicker.regional['id']);
                $('#tanggal13').datepicker($.datepicker.regional['id']);
                $('#tanggal14').datepicker($.datepicker.regional['id']);
                $('#tanggal15').datepicker($.datepicker.regional['id']);
                
                
                $('#inv_ldahi_pemilik').change(function(){
                    
                    $('#inv_ldahi_nmr_register').val($(this).val());
                    
                });
                }
                
                
            );
    </script>

    <div>
    <table border=1 width="100%">
        <tr bgcolor="#004933" style="color:white;">
            <td>
                    <strong>Informasi Umum</strong>
            </td>
        </tr>
    </table>

    </div>

            <div>
    <table border=0 width=100%>
        <tr>		
            <td>Nomor register</td>
        </tr>
    </table>
    <table border=0>		
            <tr>
                <td>
                    <input type="text" id="inv_ldahi_nmr_register"  name="inv_ldahi_nmr_register" required="required" isdatepicker="true" readonly="readonly" size="2" 
                           value="<?php echo $Pemilik; ?>"
                           onkeypress="return numbersonly(event);"/>
                </td>
                <td>.</td>
                <td>
                    <input type="text" name="inv_ldahi_nmr_register_1" value="<?php echo $KodePropPerMen ?>" required="required" readonly="readonly" size=1 onkeypress="return numbersonly(event);"/>
                </td>
                <td>.</td>
                <td>
                    <input type="text" name="inv_ldahi_nmr_register_2" value="<?php echo $KodeKabPerMen ?>" required="required" readonly="readonly" size=1 onkeypress="return numbersonly(event);"/>
                </td>
                <td>.</td>
                <td>
                    <input type="text" name="inv_ldahi_nmr_register_3" value="<?php echo $KodeSatker ?>" required="required" readonly="readonly" size=1 onkeypress="return numbersonly(event);"/>
                </td>
                <td>.</td>
                <td>
                    <input type="text" name="inv_ldahi_nmr_register_4" value="<?php echo substr($Tahun, 2,2) ?>" required="required" readonly="readonly" size=1 onkeypress="return numbersonly(event);"/>
                </td>
                <td>.</td>
                <td>
                    <input type="text" name="inv_ldahi_nmr_register_6" value="<?php echo $kodeKelompok2 ?>" required="required" readonly="readonly" size=1 onkeypress="return numbersonly(event);"/>
                </td>
            </tr>
    </table>
    <table border=0>	
            <tr>
                <td>
                        <input type="text" name="inv_ldahi_nmr_register_7" value="<?php echo $kodeKelompok ?>" required="required" readonly="readonly" size=20 onkeypress="return numbersonly(event);"/>
                </td>
                <td>.</td>
                <td>
                        <input type="text" name="inv_ldahi_nmr_register_8" value="<?php echo $NomorReg ?>" required="required" size=6  onkeypress="return numbersonly(event);"/>
                </td>
    </table>
            <table border=0>		

            <tr>
                    <td>Pemilik <?php echo $Pemilik ?></td>
                    <td></td>
                    <td>SKPD</td>
                    <td></td>
                    <td>Kode Aset</td>
            </tr>	
            <tr>
                <td>
                    <select id=inv_ldahi_pemilik onchange="inv_ldahi_pemilik" name="inv_ldahi_pemilik">
                                <option value="00" <?php if($Pemilik=='00') echo 'selected' ?> >00 - Kementerian/Lembaga</option>
                                <option value="11" <?php if($Pemilik=='11')  echo 'selected' ?> >11 - Pemerintah Provinsi</option>
                                <option value="12" <?php if($Pemilik=='12')  echo 'selected' ?> >12 - Pemerintah Kabupaten/Kota</option>
                                <option value="99" <?php if($Pemilik=='99')  echo 'selected' ?> >99 - Yayasan/Masyarakat</option>
                    </select>

                </td>
                <td>-</td>
                <td>
                        <input type="text" name="inv_ldahi_skpd" id=inv_ldahi_skpd readonly="readonly" required="required" value="<?php echo $KodeSatker; ?>"/>
                </td>
                <td>-</td>
                <td>
                        <input type="text" id=inv_ldahi_kode_aset name="inv_ldahi_kode_aset" readonly="readonly" required="required" value="<?php echo $Kode; ?>" />
                </td>
            </tr>
    </table>	
    <table border=0>	
            <tr>
                    <td>Nama Aset</td>
            </tr>
            <tr>
                    <td>
                            <input type="text" name="inv_ldahi_nama_aset" required="required" value="<?php echo $NamaAset; ?>"  />
                    </td>
            </tr>
            <tr>
                    <td>Nama SKPD Sekarang</td>
            </tr>
            <tr>
                    <td>
                            <input type="text" name="inv_ldahi_skpd_skrg" readonly="readonly" required="required" value="<?php echo $NamaSatker; ?>" size=70 />
                    </td>
            </tr>
            <tr>
                    <td>Nama SKPD/NGO Asal</td>
            </tr>
            <tr>
                    <td>
                            <input type="text" name="inv_ldahi_skpd_ngo_asal" required="required" value="" size=70 />
                    </td>
            </tr>
    </table>
    <table border=0>
            <tr>
                    <td>Ruangan</td>
            </tr>
            <tr>
                <td>
                    <select id=inv_ldahi_ruangan name="inv_ldahi_ruangan" >
                            <option value="" ></option>

                    </select>
                </td>
                <td>
                        <input type="button" name="" value="Tambah" >
                </td>
            </tr>
    </table>

        <hr>
    <table>
        <tr>
            <td>
                <?php 
                include "../tabel.php";
                ?>
            </td>
        </tr>
    </table>
        <hr>         

    <table border=0 style="clear:both";>
            <tr>
                <td>Alamat</td>
                <td>RT/RW</td>
            </tr>
            <tr>
                <td>
                        <input type="text" name="inv_ldahi_alamat" readonly="readonly" required="required" value="<?php echo $Alamat; ?>" />
                </td>
                <td>
                        <input type="text" name="inv_ldahi_rt_rw" readonly="readonly" required="required" value="<?php echo $RTRW; ?>" />
                </td>
            </tr>
    </table>

<table border=0>
    <tr>
        <td>Desa</td>
        <td>Kecamatan</td>
    </tr>
    <tr>
        <td>
                <input type="text" name="inv_ldahi_desa" readonly="readonly" required="required" value="" size=45 />
        </td>
        <td>
                <input type="text" name="inv_ldahi_kecamatan" readonly="readonly" required="required" value="" size=45 />
        </td>
        <td></td>
    </tr>
    <tr>
        <td>Kabupaten</td>
        <td>Provinsi</td>
    </tr>
    <tr>
        <td>
                <input type="text" name="inv_ldahi_kabupaten" readonly="readonly" required="required" value=""size=45 />
        </td>
        <td>
                <input type="text" name="inv_ldahi_provinsi" readonly="readonly" required="required" value=""size=45 />
        </td>
        <td></td>
    </tr>


    <tr>
        <td>

            <input type="hidden" name="idgetkelompok" id="idgetkelompok" value=""/>
            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"
            value="Pilih Lokasi"
            onclick = "showSpoiler(this);"/>
            <div class="inner" style="display:none;">

            <div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">


                <table width="100%" align="left" border="0" class="tabel">

                        <tr>
                            <th align="left" border="0" nowrap colspan="3">
                            <input type="text" id="kelompok_search" style="width: 70%;" value=""/>
                            <input type="button" id="kelompok_btn_search" value="Cari" onclick="search_child( 'kelompok', '&prefix=kelompok&tag=' )"/>
                            </th>
                        </tr>
                        <tr id="kelompok_row_">

                            <th width="100px"> </th>
                            <th width="150px"align="center"><b>Kode</b></td>
                            <th width="500px" align="left"><b>Nama</b></td>
                        </tr>
                            <tr id="zzzzzzzzzz">
                            <td colspan="3" id="kelompok_data"></td>
                        </tr>
                        <tr>
                            <td width=1><input type="checkbox"></td>
                            <td class=Item><a href="./" class="Item" onClick="processTree (0); return false;" STYLE="text-decoration: none">12</a></td>
                            <td width=149 height=20 class=Item><a href="./" class=Item onClick="processTree (0); return false;">SUMATERA UTARA</a></td>
                        </tr>
                        <tr id='sub_1_1' class=SubItemRow>
                            <td width=1> <input type="checkbox"></td>
                            <td width=149 height=20 class=SubItem><a href="./" class=Item onClick="processTree (1); return false;">1201</a></td>
                            <td width=149 height=20 class=SubItem><a href="./"  class=Item onClick="processTree (1); return false;">NIAS</a></td>
                        </tr>

                        <tr id='sub_1_1_1' class=SubItemRow>
                            <td width=1>  <input type="checkbox"></td>
                            <td width=149 height=20 class=SubItem><a href="./"  class=Item onClick="processTree (1); return false;">1201060</a></td>
                            <td width=149 height=20 class=SubItem><a href="./"  class=Item onClick="processTree (1); return false;">IDANOGAWO</a></td>

                        </tr>

                        <tr id='sub_1_2' class=SubItemRow>
                            <td width=1> <input type="checkbox"></td>
                            <td width=149 height=20 class=SubItem><a href="./" class=Item onClick="processTree (2); return false;">1202</a></td>
                            <td width=149 height=20 class=SubItem><a href="./" class=Item onClick="processTree (2); return false;">MANDAILING NATAL</a></td>
                        </tr>

                        <tr id='sub_0_2_1' class=SubItemRow>
                            <td width=1>  <input type="checkbox"></td>
                            <td width=149 height=20 class=SubItem><a href="./" class=Item onClick="processTree (2); return false;">1202010</a></td>
                            <td width=149 height=20 class=SubItem><a href="./" class=Item onClick="processTree (2); return false;">BATAHAN</a></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                </table>
                    </div>
            </div>
        </td>
    </tr>
</table>

    <table border=0 width=100%>
        <tr>
            <td><hr width=100% size=1></td>
        </tr>
    </table>

        <?php 
        include "../tambah.php";
        ?>

    <table border=0 width=100%>
        <tr>
            <td><hr width=100% size=1></td>
        </tr>
    </table>
        
                        </div>  
    </form>
                  </div>
                  </div>
            </div>
	</div>

		<?php
                include "$path/footer.php";
                ?>
	</body>
</html>	
