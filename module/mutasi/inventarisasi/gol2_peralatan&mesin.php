
<table border="0" cellspacing="6">
        <tr>
                <td>Merk Peralatan</td>
                <td>Tipe/Model</td>
        </tr>
        <tr>
                <td>
                   <input type="text" name="p_gmsn_peralatan" value="<?=$dataArr->Merk?>"size=30 disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_tipemodel" value="<?=$dataArr->Model?>"size=30 disabled>
                </td>
        </tr>
        <tr>
                <td>Ukuran</td>
                <td>Silinder</td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>
                        <input type="text" name="p_gmsn_ukuran" value="<?=$dataArr->UkuranMesin?>" size=30 disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_silinder" value="<?=$dataArr->Silinder?>" size=10 disabled>
                </td>
                <td align=left width=10>cc</td>
        </tr>
</table>
<table border="0" cellspacing="6">
        <tr>
                <td>Merk Mesin</td>
                <td>Jumlah Mesin</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_merek" value="<?=$dataArr->MerkMesin?>" size=30 disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_jumlahmesin" value="<?=$dataArr->JumlahMesin?>" size=10 disabled>
                </td>
        </tr>
        <tr>
                <td>Bahan Material</td>
                <td>No Seri Pabrik</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_material" value="<?=$dataArr->MaterialMesin?>" size=30 disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_noseripabrik" value="<?=$dataArr->NoSeri?>"size=30 disabled>
                </td>
        </tr>
        <tr>
                <td>Nomor Rangka</td>
                <td>Nomor Mesin</td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_rangka" value="<?=$dataArr->NoRangka?>" size=30 disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_nomesin" value="<?=$dataArr->NoMesin?>" size=30 disabled>
                </td>
        </tr>
        <tr>
                <td>Nomor Polisi</td>
                <td>Tanggal STNK </td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_nopolisi" value="<?=$dataArr->NoSTNK?>"size=30 disabled>
                </td>
                <td>
                        <input id="tanggal8"type="text" name="p_gmsn_tglstnk" value="<?=$dataArr->TglSTNK?>"size=15 disabled>
                </td>
        </tr>
        <tr>
                <td>Nomor BPKB</td>
                <td>Tanggal BPKB</td>

        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_nobpkb" value="<?=$dataArr->NoBPKB?>"size=30 disabled>
                </td>
                <td>
                         <input id="tanggal10"type="text" name="p_gmsn_tglbpkb" value="<?=$dataArr->TglBPKB?>"size=15 disabled>
                       
                </td>
        </tr>
        <tr>
                <td>Nomor Dokumen lain</td>
                <td>Tanggal Dokumen lain </td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_nodokumenlain" value="<?=$dataArr->NoDokumenMesin?>" size=30 disabled>
                </td>
                <td>
                    <input id="tanggal7"type="text" name="p_gmsn_tgldokumenlain" value="<?=$dataArr->TglDokumenMesin?>"size=15 disabled>
      
                </td>
        </tr>
        <tr>
                <td>Tahun Pembuatan</td>
                <td>Bahan Bakar</td>
        </tr>
        <tr>
                <td>
                    <input type="text" name="p_gmsn_tahunpembutan" value="<?=$dataArr->TahunBuat?>" size="4" disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_bahanbakar" value="<?=$dataArr->BahanBakar?>" size=30 disabled>
                </td>
        </tr>
        <tr>
                <td>Pabrik</td>
                <td>Negara Asal </td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_pabrik" value="<?=$dataArr->Pabrik?>"size=30 disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_negaraasal" value="<?=$dataArr->NegaraAsal?>"size=30 disabled>
                </td>
        </tr>
        <tr>
                <td>Kapasitas/Tonase</td>
                <td>Bobot/Berat </td>
        </tr>
        <tr>
                <td>
                        <input type="text" name="p_gmsn_kapasitas" value="<?=$dataArr->Kapasitas?>"size=8 disabled>
                </td>
                <td>
                        <input type="text" name="p_gmsn_bobot" value="<?=$dataArr->Bobot?>" size=8 style="text-align:right;" disabled>
                </td>
        </tr>
        <tr>
                <td>Negara Perakitan</td>
        </tr>	
        <tr>
                <td>
                       
                        <input type="text" name="p_gmsn_negaraperakitan" value="<?=$dataArr->NegaraRakit?>"size=30 disabled>
                </td>
        </tr>
</table>