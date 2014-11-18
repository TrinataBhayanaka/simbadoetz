<?php

$url = $url_rewrite."/services/getkib.php?req=1";
$get = json_decode(file_get_contents($url));
// echo $get->data[0]->kodeKelompok;

// pr($get);


?>

<table style="border-collapse:collapse" border="1" width=>
<tr>
    <th colspan=2 bgcolor="#cce599" height="25px">KIB A</th>
</tr>
<tr>
    <td align="">Aset_ID</td>
    <td align=""><?=$get->data[0]->Aset_ID?></td>
</tr>
<tr>
    <td><p class="data_tabel">kodeKelompok</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->kodeKelompok?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">kodeSatker</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->kodeSatker?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">Tahun</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->Tahun?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">NilaiPerolehan</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->NilaiPerolehan?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">AsalUsul</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->AsalUsul?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">Info</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->Info?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">TglPerolehan</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->TglPerolehan?>/p></td>
</tr>
<tr>
    <td><p class="data_tabel">TglPembukuan</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->TglPembukuan?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">noRegister</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->noRegister?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">Alamat</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->Alamat?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">LuasTotal</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->LuasTotal?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">HakTanah</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->HakTanah?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">NoSertifikat</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->NoSertifikat?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">TglSertifikat</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->TglSertifikat?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">Penggunaan</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->Penggunaan?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">kodeRuangan</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->kodeRuangan?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">kodeLokasi</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->kodeLokasi?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">Kode</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->Kode?></p></td>
</tr>
<tr>
    <td><p class="data_tabel">Uraian</p></td>
    <td><p class="data_tabel"><?=$get->data[0]->Uraian?></p></td>
</tr>
</table>
