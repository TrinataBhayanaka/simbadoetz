<?php /* Smarty version Smarty-3.1.15, created on 2015-12-02 15:33:20
         compiled from "app/view/master_template.html" */ ?>
<?php /*%%SmartyHeaderCode:1393858364544772d9d3aa38-32011618%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21e0b286e9ba837e2c88d8aa8516785961167507' => 
    array (
      0 => 'app/view/master_template.html',
      1 => 1449035942,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1393858364544772d9d3aa38-32011618',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_544772d9d52763_95413832',
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544772d9d52763_95413832')) {function content_544772d9d52763_95413832($_smarty_tpl) {?>
 <?php echo $_smarty_tpl->getSubTemplate ("master_template/meta.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	
    <div class="wrapper">
      
 <?php echo $_smarty_tpl->getSubTemplate ("master_template/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	
      <!-- Left side column. contains the logo and sidebar -->
     
 <?php echo $_smarty_tpl->getSubTemplate ("master_template/sidebar.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	

      <!-- Content Wrapper. Contains page content -->
      <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

      
 <?php echo $_smarty_tpl->getSubTemplate ("master_template/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	
    </div><!-- ./wrapper -->

 <?php echo $_smarty_tpl->getSubTemplate ("master_template/jsplugin.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	
  </body>
</html>

	
	
	<?php }} ?>
