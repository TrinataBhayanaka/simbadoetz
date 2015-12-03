<?php /* Smarty version Smarty-3.1.15, created on 2015-12-03 09:13:50
         compiled from "app/view/module/daftar_aset_tetap/peralatandanmesin.html" */ ?>
<?php /*%%SmartyHeaderCode:1214642465565c1a2318ab45-93936951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2027e06cd6ae819999751f585867410db3b54c3e' => 
    array (
      0 => 'app/view/module/daftar_aset_tetap/peralatandanmesin.html',
      1 => 1449093333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1214642465565c1a2318ab45-93936951',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565c1a231f9d19_72755125',
  'variables' => 
  array (
    'baseApplication' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565c1a231f9d19_72755125')) {function content_565c1a231f9d19_72755125($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Peralatan dan Mesin
            <small>Daftar Aset Tetap</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Daftar Aset Tetap</a></li>
            <li class="active">Peralatan dan Mesin</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
         
          <div class="row">
            <!-- right column -->
        <div class="col-md-12">
          <!-- Form Input Services -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Form Input Services</h3>
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
                      <input id="kodesatker" name="kodesatker" type="text" ng-model="satker" class="col-md-12"/>
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-info pull-left" id="tombol" type="submit">Create Link Url</button>
              </div>

              <div class="box-footer">
              <span id="linkUrl" style="display:none" ><i>
                <a href="<?php echo $_smarty_tpl->tpl_vars['baseApplication']->value;?>
report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_mesin.php?menuID=&mode=&tab=&skpd_id={{satker}}&tglawalperolehan={{tahunAwal}}&tglakhirperolehan={{tahunAkhir}}&tipe_file=3" target="_blank"><?php echo $_smarty_tpl->tpl_vars['baseApplication']->value;?>
report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_mesin.php?menuID=&mode=&tab=&skpd_id=<strong>{{satker}}</strong>&tglawalperolehan=<strong>{{tahunAwal}}</strong>&tglakhirperolehan=<strong>{{tahunAkhir}}</strong>&tipe_file=<strong>3</strong></a></i>
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
