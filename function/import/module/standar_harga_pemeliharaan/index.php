
<script type="text/javascript">
//buka window baru
function createTarget(t){
window.open("", t, "scrollbars=1,width=1500,height=550");
return true;
}

</script>

<link rel="stylesheet" href="../../function/css/simbada.css" type="text/css" media="screen" />
<table width='100%'>
<tr>
<td height="25px" bgcolor='#004933'><span style="font:14px Arial;padding:5px;font-weight:bold;color:whitesmoke;">IMPORT DATA XLS - STANDAR HARGA PEMELIHARAAN</span></td>
</tr>
<tr><td height='5px'></td></tr>
<tr>
<td>
<table width='100%' border='2' style="border-collapse:collapse;">
<tr>
<td style="padding:20px" align="center"><form method="post" enctype="multipart/form-data" action="<?php echo $url_rewrite?>/function/import/module/standar_harga_pemeliharaan/proses.php" onsubmit="return createTarget(this.target)" target="formtarget">
Silakan Pilih File Excel : <input name="userfile" type="file">
<input name="upload" type="submit" class="btn btn-primary" value="Import">
</form>
</td>
</tr>
</table>
</td>
</tr>
</table>