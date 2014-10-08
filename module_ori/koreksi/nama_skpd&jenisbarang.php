<body >	
<table cellspacing="6">
        <tr>
            <td>Jenis Barang<br>	
                     <input type="text" name="p_jenisbarang" id="lda_kelompok3" style="width:450px;" readonly="readonly" placeholder="<?php if ($dataArr->Uraian !=''){echo $dataArr->Uraian;} else {echo '(Semua Jenis Barang)';}?>">
             <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
                <div class="inner" style="display:none;">
                        <style>
                                .tabel th {
                                        background-color: #eeeeee;
                                        border: 1px solid #dddddd;
                                }
                                .tabel td {
                                        border: 1px solid #dddddd;
                                }
                        </style>
                           <?php
                                //include "$path/function/dropdown/radio_function_kelompok.php";
                               $alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
                                $alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
                                js_radiopengadaankelompok($alamat_simpul_kelompok,
                                $alamat_search_kelompok,"lda_kelompok3","kelompok_id3",'kelompok3','p_kodeaset','kis');
                                $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                radiopengadaankelompok($style,"kelompok_id3",'kelompok3',"kis|$dataArr->Kelompok_ID");
                                ?>
                </div>
           </td>
     </tr>
</table>     

<table border="0" cellspacing="6">	
       <tr>
             <td>Jenis Aset</td>
              <td>Bersejarah</td>
      </tr>
       <tr>
           <td>
                  <select name="p_jenisaset">
                           <option value="0"<?php if($dataArr->Jenisasetpengadaan== '0')echo 'selected'?>>-</option>
                           <option value="1"<?php if($dataArr->Jenisasetpengadaan== '1')echo 'selected'?>>Operasional</option>
                          <option value="2"<?php if($dataArr->Jenisasetpengadaan== '2')echo 'selected'?>>Program</option>
                          
                   </select>
          <td>
                   <select name="p_bersejarah" value="">
                       <option value="0"<?php if ($dataArr->Bersejarah== '0') echo 'selected'?>>Tidak Bersejarah</option>
                        <option value="1"<?php if ($dataArr->Bersejarah== '1') echo 'selected'?>>Bernilai Sejarah</option>   
                   </select>
          </td>
        </tr>
</table>

                <ol id="parent1"  class="formset">
                        <?php
                        include "gol1_tanah.php";
                        ?>
                </ol>

                <ol id="parent2"  class="formset">
                        <?php
                        include "gol2_peralatan&mesin.php";
                        ?>
                </ol>

                <ol id="parent3" class="formset">
                        <?php
                        include "gol3_gedung&bangunan.php";
                        ?>
                </ol>

                <ol id="parent4" class="formset">
                        <?php
                        include "gol4_jalan,irigasi&jaringan.php";
                        ?>
                </ol>

                <ol id="parent5" class="formset">

                        <?php
                        include "gol5_aset_tetaplainnya.php";
                        ?>
                </ol>

                <ol id="parent6" class="formset">
                        <?php
                        include "gol6_konstruksi_pengerjaan.php";
                        ?>
                </ol>

                <ol id="parent7" class="formset">
                        <?php
                        include "gol7_persediaan.php";
                         ?>
                </ol>
</body>
