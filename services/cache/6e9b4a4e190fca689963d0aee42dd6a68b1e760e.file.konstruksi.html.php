<?php /* Smarty version Smarty-3.1.15, created on 2015-12-02 16:21:10
         compiled from "app/view/module/daftar_aset_tetap/konstruksi.html" */ ?>
<?php /*%%SmartyHeaderCode:1876792673565e9ff24ec432-45849584%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e9b4a4e190fca689963d0aee42dd6a68b1e760e' => 
    array (
      0 => 'app/view/module/daftar_aset_tetap/konstruksi.html',
      1 => 1449048619,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1876792673565e9ff24ec432-45849584',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565e9ff2507108_92966718',
  'variables' => 
  array (
    'baseApplication' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565e9ff2507108_92966718')) {function content_565e9ff2507108_92966718($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Konstruksi Dalam Pengerjaan
            <small>Daftar Aset Tetap</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Daftar Aset Tetap</a></li>
            <li class="active">Konstruksi Dalam Pengerjaan</li>
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
report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_kdp.php?menuID=&mode=&tab=&skpd_id={{satker}}&tglawalperolehan={{tahunAwal}}&tglakhirperolehan={{tahunAkhir}}&tipe_file=3" target="_blank"><?php echo $_smarty_tpl->tpl_vars['baseApplication']->value;?>
report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_kdp.php?menuID=&mode=&tab=&skpd_id=<strong>{{satker}}</strong>&tglawalperolehan=<strong>{{tahunAwal}}</strong>&tglakhirperolehan=<strong>{{tahunAkhir}}</strong>&tipe_file=<strong>3</strong></a>
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
