<?php /* Smarty version Smarty-3.1.15, created on 2015-12-02 07:38:30
         compiled from "app/view/module/daftarbarangnonaset.html" */ ?>
<?php /*%%SmartyHeaderCode:2032375783565e9ff61116d0-03955738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba89b9fdfd2cbb89944fa9a269b63d56abacdb0f' => 
    array (
      0 => 'app/view/module/daftarbarangnonaset.html',
      1 => 1449041648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2032375783565e9ff61116d0-03955738',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'baseApplication' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565e9ff6129d56_84628368',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565e9ff6129d56_84628368')) {function content_565e9ff6129d56_84628368($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Barang Non Aset
            <!-- <small>Daftar Aset Tetap</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <!-- <li><a href="#"> Daftar Aset Tetap</a></li> -->
            <li class="active">Daftar Barang Non Aset</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
 <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Penjelasan Parameter Services</h3>
                </div>
                <!-- /.box-header -->
                <table class="table table-bordered">
                  <tbody><tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 200px">Parameter</th>
                    <th>Keterangan</th>
                  </tr>
                  <tr>
                    <td>1.</td>
                    <td>skpd_id</td>
                    <td>Diisi dengan kode Satker contoh :<strong> 04.02</strong></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>tglawalperolehan</td>
                    <td>Diisi dengan Format Tanggal yy-mm-dd contoh :<strong> 2015-12-02</strong></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>tglakhirperolehan</td>
                    <td>Diisi dengan Format Tanggal yy-mm-dd contoh :<strong> 2015-12-02</strong></td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>tipe_file</td>
                    <td>Diisi dengan <strong>3</strong></td>
                  </tr>
                </tbody>
              </table>
              </div>
              <!-- /.box -->

              


            </div>
          </div>
          <div class="row">
            <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" ng-app="">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3" >Tahun Awal</label>

                  <div class="col-sm-8">
                    <input type="text" placeholder="Tahun Awal" id="datepicker" ng-model="tahunAwal" class="tahunAwal form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Tahun Akhir</label>

                  <div class="col-sm-8">
                    <input type="text" placeholder="Tahun Akhir" id="datepicker" ng-model="tahunAkhir" class="tahunAkhir form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputPassword3">Kode Satker</label>

                  <div class="col-sm-8">
                    <select  class="form-control" ng-model="satker">
                        <option value="">--Pilih Satker--</option>
                        <option value="04.02">Dinas</option>
                    </select>
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-info pull-left" id="tombol" type="submit">Create Link Url</button>
              </div>

              <div class="box-footer">
              <span id="linkUrl" style="display:none" >
                <a href="<?php echo $_smarty_tpl->tpl_vars['baseApplication']->value;?>
report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php?menuID=&mode=&tab=&skpd_id={{satker}}&tglawalperolehan={{tahunAwal}}&tglakhirperolehan={{tahunAkhir}}&tipe_file=3" target="_blank"><?php echo $_smarty_tpl->tpl_vars['baseApplication']->value;?>
report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php?menuID=&mode=&tab=&skpd_id={{satker}}&tglawalperolehan={{tahunAwal}}&tglakhirperolehan={{tahunAkhir}}&tipe_file=3</a>
                </span>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
         
        </div>
        <!-- left column -->
           
        <!--/.col (left) -->
        
        <!--/.col (right) -->
      </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
<?php }} ?>
