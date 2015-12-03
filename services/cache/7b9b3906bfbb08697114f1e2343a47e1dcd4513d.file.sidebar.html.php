<?php /* Smarty version Smarty-3.1.15, created on 2015-12-03 03:44:53
         compiled from "app/view/master_template/sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:17497404015659a413a40509-10169281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b9b3906bfbb08697114f1e2343a47e1dcd4513d' => 
    array (
      0 => 'app/view/master_template/sidebar.html',
      1 => 1449113583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17497404015659a413a40509-10169281',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5659a413a4cb54_83571092',
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5659a413a4cb54_83571092')) {function content_5659a413a4cb54_83571092($_smarty_tpl) {?> <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
         
        
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
" id="clickpage">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-file-archive-o"></i> <span>Daftar Aset Tetap</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=1" id="click" class="page"><i class="fa fa-inbox"></i> Tanah</a>
                </li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=2" id="click" class="page"><i class="fa fa-gears"></i> Peralatan dan Mesin</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=3"><i class="fa fa-building-o"></i> Gedung dan Bangunan</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=4" id="click" class="page"><i class="fa fa-road"></i> Jalan, Irigasi dan Jaringan</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=5" id="click" class="page"><i class="fa fa-list"></i> Aset Tetap Lainnya</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=6" id="click" class="page"><i class="fa fa-truck"></i> Konstruksi Dalam Pengerjaan</a></li>
              </ul>
            </li>
            <li class="active treeview">
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=7" id="clickpage">
                <i class="fa fa-file-archive-o"></i>
                <span>Daftar Aset Lainnya</span>
              </a>
            </li>
            <li class="active treeview">
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=8" id="clickpage">
                <i class="fa fa-file-archive-o"></i>
                <span>Daftar Barang Non Aset</span>
              </a>
            </li>
            <li class="active treeview">
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=9" id="clickpage">
                <i class="fa fa-file-archive-o"></i>
                <span>Rekapitulasi Barang ke Neraca</span>
              </a>
            </li>

            <li class="active treeview">
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=10" id="clickpage">
                <i class="fa fa-file-archive-o"></i>
                <span>Kode Satker</span>
              </a>
            </li>

            <li class="active treeview">
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/index/?page=11" id="clickpage">
                <i class="fa fa-file-archive-o"></i>
                <span>Kode Kelompok</span>
              </a>
            </li>

            <li class="active treeview">
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData" id="clickpage">
                <i class="fa fa-refresh"></i>
                <span>Mengolah Data Services</span>
              </a>
            </li>
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside><?php }} ?>
