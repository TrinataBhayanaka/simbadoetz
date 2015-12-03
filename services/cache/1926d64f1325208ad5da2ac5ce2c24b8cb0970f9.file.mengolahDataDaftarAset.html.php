<?php /* Smarty version Smarty-3.1.15, created on 2015-12-03 09:56:20
         compiled from "app/view/module/mengolahDataDaftarAset.html" */ ?>
<?php /*%%SmartyHeaderCode:1482634660565fe9d4e9b113-95465105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1926d64f1325208ad5da2ac5ce2c24b8cb0970f9' => 
    array (
      0 => 'app/view/module/mengolahDataDaftarAset.html',
      1 => 1449136578,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1482634660565fe9d4e9b113-95465105',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565fe9d4eb3557_35862800',
  'variables' => 
  array (
    'basedomain' => 0,
    'JsonDecode' => 0,
    'DataJsonDecode' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565fe9d4eb3557_35862800')) {function content_565fe9d4eb3557_35862800($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mengolah Data Services Simbada <i>(Contoh)</i>
            <!-- <small>Daftar Aset Tetap</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <!-- <li><a href="#"> Daftar Aset Tetap</a></li> -->
            <li class="active">Kode Satker</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
         <div class="row">
              <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=1">Penjelasan</a></li>
                  <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=2">Daftar Aset Tetap</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=3">Kode Satker</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=4">Kode Kelompok</a></li>
                 
                  <li class="pull-right"><a class="text-muted" href="#"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                  <div id="tab_1" class="tab-pane active">
                    <div class="row">
                      <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab_1">Get Data</a></li>
                            <li><a data-toggle="tab" href="#tab_2">Fetch Data</a></li>
                            <li><a data-toggle="tab" href="#tab_3">View Data</a></li>
                            
                            <li class="pull-right"><a class="text-muted" href="#"><i class="fa fa-gear"></i></a></li>
                          </ul>
                          <div class="tab-content">
                            <div id="tab_1" class="tab-pane active">
                              <b>Get Data Via Url:</b>
<pre style="font-weight: 600;">
&lt;?php
$url='http://localhost/simbadoetz/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php?menuID=&amp;mode=&amp;tab=&amp;skpd_id=04.02.02&amp;tglawalperolehan=&amp;tglakhirperolehan=2014-12-31&amp;tipe_file=3';

$resultJsonEncode=file_get_contents($url);
?&gt;
</pre>
<b>Result :</b>

<pre style="font-weight: 600;">
[{"Satker_ID":"28","Tahun":null,"KodeSektor":"04","KodeSatker":"04.02","kode":"04.02","NamaSatker":"DINAS PENDAPATAN, PENGELOLAAN KEUANGAN DAN ASET DAERAH","AlamatSatker":null,"NGO":"0","RAND_ID":null,"IndukSatker":null,"NGO1_ID":null,"NGO2_ID":null,"NGO3_ID":null,"NGO4_ID":null,"CNOTE1":null,"CNOTE2":null,"Gudang":null,"KodeUnit":null,"Tmp_KodeSatker":null,"KotaSatker":null,"BuatKIB":null,"Kd_Ruang":null},{"Satker_ID":"72","Tahun":null,"KodeSektor":"04","KodeSatker":"04.02","kode":"04.02.01","NamaSatker":"DINAS PENDAPAAN, PENGELOLAAN KEUANGAN DAN ASET DAERAH","AlamatSatker":null,"NGO":"0","RAND_ID":null,"IndukSatker":null,"NGO1_ID":null,"NGO2_ID":null,"NGO3_ID":null,"NGO4_ID":null,"CNOTE1":null,"CNOTE2":null,"Gudang":null,"KodeUnit":"01","Tmp_KodeSatker":null,"KotaSatker":null,"BuatKIB":null,"Kd_Ruang":null},{"Satker_ID":"195","Tahun":"0","KodeSektor":"04","KodeSatker":"04.02","kode":"04.02.01.01","NamaSatker":"DINAS PENDAPATAN, PENGELOLAAN KEUANGAN DAN ASET DAERAH","AlamatSatker":null,"NGO":"0","RAND_ID":null,"IndukSatker":null,"NGO1_ID":null,"NGO2_ID":null,"NGO3_ID":null,"NGO4_ID":null,"CNOTE1":null,"CNOTE2":null,"Gudang":"01","KodeUnit":"01","Tmp_KodeSatker":null,"KotaSatker":null,"BuatKIB":null,"Kd_Ruang":null}]
</pre>

                            </div><!-- /.tab-pane -->
                            <div id="tab_2" class="tab-pane">
                            <b>Fetch Data dengan Json_decode :</b>
<pre style="font-weight: 600;">
&lt;?php
$url='http://localhost/simbadoetz/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php?menuID=&amp;mode=&amp;tab=&amp;skpd_id=04.02.02&amp;tglawalperolehan=&amp;tglakhirperolehan=2014-12-31&amp;tipe_file=3';

$resultJsonEncode=file_get_contents($url);

$resultJsonDecode=json_decode($resultJson);
?&gt;
</pre>
                            <b>Result :</b>
<pre style="font-weight: 600;">
<?php echo pr($_smarty_tpl->tpl_vars['JsonDecode']->value);?>

</pre>

                            </div><!-- /.tab-pane -->
                            <div id="tab_3" class="tab-pane">
                              
                              <pre style="font-weight: 600;">
&lt;?php
$url='http://localhost/simbadoetz/services/home/satker/?term=04.02';

$resultJsonEncode=file_get_contents($url);

$resultJsonDecode=json_decode($resultJson);

$result=(array)$resultJsonDecode;
$DataJsonDecode=$result['04.02.01.01']->Tanah;

echo  "&lt;table border=&quot;1&quot; width=&quot;100%&quot;&gt;
            &lt;thead&gt;
              &lt;tr&gt;
                &lt;th&gt;Uraian&lt;/th&gt;
                &lt;th&gt;Alamat&lt;/th&gt;
                &lt;th&gt;Luas Total&lt;/th&gt;
                &lt;th&gt;Nilai Perolehan&lt;/th&gt;
              &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
";
foreach ($DataJsonDecode as $key => $val){
        echo "&lt;tr&gt;";
        echo "&lt;td&gt;".$val->Uraian."&lt;/td&gt;";
        echo "&lt;td&gt;".$val->Alamat."&lt;/td&gt;";
        echo "&lt;td&gt;".$val->LuasTotal."&lt;/td&gt;";
        echo "&lt;td&gt;".$val->NilaiPerolehan."&lt;/td&gt;";
        echo "&lt;/tr&gt;";
}
echo "   &lt;tbody&gt;
      &lt;/table&gt;";
?&gt;
</pre>
                            <b>Result :</b>
          <table border="1" width="100%">
            <thead>
              <tr>
                <th>Uraian</th>
                <th>Alamat</th>
                <th>Luas Total</th>
                <th>Nilai Perolehan</th>
              </tr>
            </thead>
            <tbody>
              
              <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['DataJsonDecode']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                <tr>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->Uraian;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->Alamat;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->LuasTotal;?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['val']->value->NilaiPerolehan;?>
</td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
                            </div><!-- /.tab-pane -->
                          </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                      </div><!-- /.col -->

                     
                    </div>
                  </div><!-- /.tab-pane -->
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
         </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
<?php }} ?>
