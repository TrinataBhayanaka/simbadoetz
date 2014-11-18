<div class="datalist" style="padding:3px 5px 2px 5px;" align="left">
    <form name="form_data_user" id="idform_data_user" method="POST" action="">
        User ID<br>
        <input name="idchkusernm" id="idchkusernm" value="" type="hidden">
        <input name="idusernm" id="idusernm" readonly="readonly" type="text"><br>
        Enter new password<br>
        <input name="idnewpass" disabled="disabled" id="idnewpass" type="password"><br>
        Nama Lengkap<br>
        <input name="idnamaoperator" id="idnamaoperator" readonly="readonly" style="width: 95%;" type="text"><br>
        NIP Operator (hanya jika memiliki)<br>
        <input name="idnip" id="idnip" readonly="readonly" type="text"><br>
        Satker<br>
        <input name="idsatker" id="idsatker" value="" type="hidden">
        <input name="idkdsatker" id="idkdsatker" style="width: 20%;" readonly="readonly" type="text">
        <input name="btn_satker" id="btn_satker" value="Pilih" readonly="readonly" disabled="disabled" type="button">
        <input name="idnmsatker" id="idnmsatker" readonly="readonly" style="width: 92%;" type="text">
        <div id="id_getsatker"></div>
        Jabatan Operator<br>
        <select style="width:95%;" name="idjabatan" id="idjabatan" disabled="disabled">
            <option selected="selected" value="-"></option>
            <option value="Administrators">Administrators</option>
            <option value="Guests">Guests</option>
            <option value="Pengelola BMD">Pengelola BMD</option>
            <option value="Pengurus Barang">Pengurus Barang</option>
            <option value="Penyimpan Barang">Penyimpan Barang</option>
            <option value="Tim Pemeriksa Gudang">Tim Pemeriksa Gudang</option>
            <option value="Tim Penilai">Tim Penilai</option>
            <option value="Tim Standarisasi">Tim Standarisasi</option>
        </select><br>
        <input name="idAdmin" id="idAdmin" disabled="disabled" type="checkbox">&nbsp;Akses Administrator<br>
        <br>
        <div style="margin-bottom:10px;" align="right">
            <input style="width: 80px;" name="btn_action" disabled="disabled" value="Edit" onclick="set_page_location_as( 'e' );" type="button">
            <input style="width: 80px;" name="btn_action" disabled="disabled" value="Hapus" onclick="window.confirm('Anda benar-benar ingin menghapus data ini?');" type="submit">
        </div>
    </form>
</div>