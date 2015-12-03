<?php /* Smarty version Smarty-3.1.15, created on 2015-12-02 23:28:56
         compiled from "app/view/module/kodekelompok.html" */ ?>
<?php /*%%SmartyHeaderCode:955572260565f7447822752-31881569%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5dee33e301189a8d644adaa2c21d96ab60d0f1f' => 
    array (
      0 => 'app/view/module/kodekelompok.html',
      1 => 1449098932,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '955572260565f7447822752-31881569',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565f7447843de0_09752459',
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565f7447843de0_09752459')) {function content_565f7447843de0_09752459($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Kode Kelompok
            <!-- <small>Daftar Aset Tetap</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <!-- <li><a href="#"> Daftar Aset Tetap</a></li> -->
            <li class="active">Kode Kelompok</li>
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
                  <label class="col-sm-3 control-label" for="inputPassword3">Kode Kelompok</label>

                  <div class="col-sm-8">
                      <input id="kodekelompok" name="kodekelompok" type="text" ng-model="kodeKelompok" class="col-md-12"/>
                  </div>
                </div>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-info pull-left" id="tombol" type="submit">Create Link Url</button>
              </div>
              <div class="box-footer">
              <span id="linkUrl" style="display:none" ><i>
                <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/kelompok/?term={{kodeKelompok}}" target="_blank"><?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/kelompok/?term=<strong>{{kodeKelompok}}</strong></a></i>
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
